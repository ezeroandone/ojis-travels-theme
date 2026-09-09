<?php
/**
 * OJIS Travels Theme — Built-in Analytics
 *
 * Lightweight, privacy-first visitor tracking stored in the WordPress database.
 * No third-party scripts. GDPR-friendly (no persistent cookies, no cross-site tracking).
 *
 * Tracks per page-view:
 *  - URL path, post ID, page type
 *  - Referrer (domain only, no full URL)
 *  - Browser / OS (parsed from User-Agent)
 *  - Country (via IP geolocation using ip-api.com — free, no key required)
 *  - Session identifier (hashed IP+UA, not stored raw — no PII in DB)
 *  - Timestamp
 *
 * Dashboard: WordPress Admin → Analytics (top-level menu)
 *
 * @package ojis-travels-theme
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ─── Database table name ──────────────────────────────────────────────────────
function ojis_analytics_table(): string {
    global $wpdb;
    return $wpdb->prefix . 'ojis_analytics';
}

// ─── Create table on theme activation ────────────────────────────────────────
function ojis_analytics_install(): void {
    global $wpdb;
    $table      = ojis_analytics_table();
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS {$table} (
        id          BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        visited_at  DATETIME            NOT NULL,
        url_path    VARCHAR(500)        NOT NULL DEFAULT '',
        post_id     BIGINT(20) UNSIGNED NOT NULL DEFAULT 0,
        page_type   VARCHAR(60)         NOT NULL DEFAULT '',
        referrer    VARCHAR(255)        NOT NULL DEFAULT '',
        browser     VARCHAR(100)        NOT NULL DEFAULT '',
        os          VARCHAR(100)        NOT NULL DEFAULT '',
        device      VARCHAR(30)         NOT NULL DEFAULT '',
        country     VARCHAR(80)         NOT NULL DEFAULT '',
        session_id  VARCHAR(64)         NOT NULL DEFAULT '',
        is_new      TINYINT(1)          NOT NULL DEFAULT 0,
        PRIMARY KEY (id),
        KEY idx_visited_at (visited_at),
        KEY idx_url_path   (url_path(191)),
        KEY idx_session_id (session_id),
        KEY idx_page_type  (page_type)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );
    update_option( 'ojis_analytics_db_version', '1.0' );
}
add_action( 'after_switch_theme', 'ojis_analytics_install' );

// Also create on init if not yet installed
function ojis_analytics_maybe_install(): void {
    if ( get_option( 'ojis_analytics_db_version' ) !== '1.0' ) {
        ojis_analytics_install();
    }
}
add_action( 'init', 'ojis_analytics_maybe_install', 1 );

// ─── Track a page view (front-end, non-admin, non-bot) ───────────────────────
function ojis_track_pageview(): void {
    // Skip admin, bots, CLI, REST, logged-in admins
    if ( is_admin() || wp_is_json_request() || ( defined( 'WP_CLI' ) && WP_CLI ) ) return;
    if ( current_user_can( 'manage_options' ) ) return;

    $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';

    // Simple bot filter
    $bot_patterns = '/bot|crawl|slurp|spider|mediapartners|google|bingbot|yandex|baidu|duckduckbot|facebot|ia_archiver|semrush|ahrefsbot|mj12bot/i';
    if ( preg_match( $bot_patterns, $ua ) ) return;

    global $wpdb, $post;

    // ── Build record ──────────────────────────────────────────────────────────
    $url_path  = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '/';
    $url_path  = strtok( $url_path, '?' ); // strip query string
    $post_id   = is_singular() && $post ? (int) $post->ID : 0;

    $page_type = 'other';
    if ( is_front_page() )   $page_type = 'home';
    elseif ( is_page() )     $page_type = 'page';
    elseif ( is_single() )   $page_type = 'post';
    elseif ( is_archive() )  $page_type = 'archive';
    elseif ( is_search() )   $page_type = 'search';
    elseif ( is_404() )      $page_type = '404';

    // Referrer — domain only
    $referrer = '';
    if ( ! empty( $_SERVER['HTTP_REFERER'] ) ) {
        $ref_host = wp_parse_url( sanitize_url( wp_unslash( $_SERVER['HTTP_REFERER'] ) ), PHP_URL_HOST );
        $own_host = wp_parse_url( home_url(), PHP_URL_HOST );
        if ( $ref_host && $ref_host !== $own_host ) {
            $referrer = $ref_host;
        }
    }

    // Browser / OS / Device detection from User-Agent
    $parsed  = ojis_parse_ua( $ua );
    $browser = $parsed['browser'];
    $os      = $parsed['os'];
    $device  = $parsed['device'];

    // Session ID — hashed (IP + UA + date) — no raw PII stored
    $ip         = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '';
    $ip         = explode( ',', $ip )[0];
    $session_id = hash( 'sha256', $ip . $ua . date( 'Y-m-d' ) );

    // Is this a new session today?
    $is_new = (int) ! (bool) $wpdb->get_var( $wpdb->prepare(
        "SELECT id FROM " . ojis_analytics_table() . " WHERE session_id = %s AND visited_at >= %s LIMIT 1",
        $session_id,
        date( 'Y-m-d 00:00:00' )
    ) );

    // Country — async lookup via transient cache (ip-api.com, free, no key)
    $country = ojis_get_country( $ip );

    // ── Insert ────────────────────────────────────────────────────────────────
    $wpdb->insert(
        ojis_analytics_table(),
        [
            'visited_at' => current_time( 'mysql' ),
            'url_path'   => mb_substr( $url_path, 0, 500 ),
            'post_id'    => $post_id,
            'page_type'  => $page_type,
            'referrer'   => mb_substr( $referrer, 0, 255 ),
            'browser'    => $browser,
            'os'         => $os,
            'device'     => $device,
            'country'    => $country,
            'session_id' => $session_id,
            'is_new'     => $is_new,
        ],
        [ '%s', '%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d' ]
    );
}
add_action( 'wp', 'ojis_track_pageview', 20 );

// ─── Country lookup (cached 24 h per IP) ─────────────────────────────────────
function ojis_get_country( string $ip ): string {
    if ( empty( $ip ) || in_array( $ip, [ '127.0.0.1', '::1' ], true ) ) return 'Local';
    $key    = 'ojis_geo_' . md5( $ip );
    $cached = get_transient( $key );
    if ( $cached !== false ) return $cached;

    $response = wp_remote_get( 'http://ip-api.com/json/' . rawurlencode( $ip ) . '?fields=country', [ 'timeout' => 2 ] );
    $country  = 'Unknown';
    if ( ! is_wp_error( $response ) ) {
        $body = json_decode( wp_remote_retrieve_body( $response ), true );
        if ( ! empty( $body['country'] ) ) {
            $country = sanitize_text_field( $body['country'] );
        }
    }
    set_transient( $key, $country, DAY_IN_SECONDS );
    return $country;
}

// ─── Simple UA parser ─────────────────────────────────────────────────────────
function ojis_parse_ua( string $ua ): array {
    // Browser
    $browser = 'Unknown';
    foreach ( [
        'Edg'          => 'Edge',
        'OPR'          => 'Opera',
        'Opera'        => 'Opera',
        'Chrome'       => 'Chrome',
        'Safari'       => 'Safari',
        'Firefox'      => 'Firefox',
        'MSIE|Trident' => 'Internet Explorer',
        'SamsungBrowser' => 'Samsung Browser',
    ] as $pattern => $name ) {
        if ( preg_match( '/' . $pattern . '/i', $ua ) ) { $browser = $name; break; }
    }

    // OS
    $os = 'Unknown';
    foreach ( [
        'Windows NT 10' => 'Windows 10/11',
        'Windows NT'    => 'Windows',
        'Mac OS X'      => 'macOS',
        'iPhone'        => 'iOS (iPhone)',
        'iPad'          => 'iOS (iPad)',
        'Android'       => 'Android',
        'Linux'         => 'Linux',
        'CrOS'          => 'ChromeOS',
    ] as $pattern => $name ) {
        if ( stripos( $ua, $pattern ) !== false ) { $os = $name; break; }
    }

    // Device type
    $device = 'Desktop';
    if ( preg_match( '/tablet|ipad/i', $ua ) ) {
        $device = 'Tablet';
    } elseif ( preg_match( '/mobile|android|iphone|ipod|blackberry|opera mini|iemobile/i', $ua ) ) {
        $device = 'Mobile';
    }

    return compact( 'browser', 'os', 'device' );
}

// ─── Prune old records (keep 90 days) — runs weekly ──────────────────────────
function ojis_analytics_prune(): void {
    global $wpdb;
    $wpdb->query( $wpdb->prepare(
        "DELETE FROM " . ojis_analytics_table() . " WHERE visited_at < %s",
        date( 'Y-m-d H:i:s', strtotime( '-90 days' ) )
    ) );
}
if ( ! wp_next_scheduled( 'ojis_analytics_prune' ) ) {
    wp_schedule_event( time(), 'weekly', 'ojis_analytics_prune' );
}
add_action( 'ojis_analytics_prune', 'ojis_analytics_prune' );

// ─── Admin menu ───────────────────────────────────────────────────────────────
function ojis_analytics_menu(): void {
    add_menu_page(
        __( 'OJIS Analytics', 'ojis-travels-theme' ),
        __( 'Analytics', 'ojis-travels-theme' ),
        'manage_options',
        'ojis-analytics',
        'ojis_analytics_dashboard',
        'dashicons-chart-line',
        3
    );
}
add_action( 'admin_menu', 'ojis_analytics_menu' );

// ─── Dashboard page ───────────────────────────────────────────────────────────
function ojis_analytics_dashboard(): void {
    if ( ! current_user_can( 'manage_options' ) ) wp_die( __( 'Unauthorized', 'ojis-travels-theme' ) );

    global $wpdb;
    $table = ojis_analytics_table();

    // Date range
    $range = sanitize_key( $_GET['range'] ?? '30' );
    $days  = in_array( $range, [ '7', '30', '90' ], true ) ? (int) $range : 30;
    $from  = date( 'Y-m-d H:i:s', strtotime( "-{$days} days" ) );

    // ── Queries ───────────────────────────────────────────────────────────────
    $total_views    = (int) $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM {$table} WHERE visited_at >= %s", $from ) );
    $unique_visits  = (int) $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(DISTINCT session_id) FROM {$table} WHERE visited_at >= %s", $from ) );
    $new_visitors   = (int) $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM {$table} WHERE visited_at >= %s AND is_new = 1", $from ) );

    // Bounce rate — sessions with only 1 page view
    $all_sessions   = $wpdb->get_results( $wpdb->prepare( "SELECT session_id, COUNT(*) as cnt FROM {$table} WHERE visited_at >= %s GROUP BY session_id", $from ) );
    $bounced        = count( array_filter( $all_sessions, fn( $r ) => (int) $r->cnt === 1 ) );
    $bounce_rate    = $unique_visits > 0 ? round( $bounced / $unique_visits * 100 ) : 0;

    // Top pages
    $top_pages = $wpdb->get_results( $wpdb->prepare(
        "SELECT url_path, COUNT(*) as views FROM {$table} WHERE visited_at >= %s GROUP BY url_path ORDER BY views DESC LIMIT 10",
        $from
    ) );

    // Top referrers
    $top_refs = $wpdb->get_results( $wpdb->prepare(
        "SELECT referrer, COUNT(*) as cnt FROM {$table} WHERE visited_at >= %s AND referrer != '' GROUP BY referrer ORDER BY cnt DESC LIMIT 8",
        $from
    ) );

    // Top countries
    $top_countries = $wpdb->get_results( $wpdb->prepare(
        "SELECT country, COUNT(*) as cnt FROM {$table} WHERE visited_at >= %s GROUP BY country ORDER BY cnt DESC LIMIT 8",
        $from
    ) );

    // Devices
    $devices = $wpdb->get_results( $wpdb->prepare(
        "SELECT device, COUNT(*) as cnt FROM {$table} WHERE visited_at >= %s GROUP BY device ORDER BY cnt DESC",
        $from
    ) );

    // Browsers
    $browsers = $wpdb->get_results( $wpdb->prepare(
        "SELECT browser, COUNT(*) as cnt FROM {$table} WHERE visited_at >= %s GROUP BY browser ORDER BY cnt DESC LIMIT 6",
        $from
    ) );

    // Daily chart data
    $daily = $wpdb->get_results( $wpdb->prepare(
        "SELECT DATE(visited_at) as day, COUNT(*) as views, COUNT(DISTINCT session_id) as visitors
         FROM {$table} WHERE visited_at >= %s GROUP BY DATE(visited_at) ORDER BY day ASC",
        $from
    ) );
    $chart_labels  = wp_json_encode( array_column( $daily, 'day' ) );
    $chart_views   = wp_json_encode( array_map( fn( $r ) => (int) $r->views, $daily ) );
    $chart_visits  = wp_json_encode( array_map( fn( $r ) => (int) $r->visitors, $daily ) );

    // Export CSV
    if ( isset( $_GET['export'] ) && check_admin_referer( 'ojis_analytics_export' ) ) {
        header( 'Content-Type: text/csv; charset=UTF-8' );
        header( 'Content-Disposition: attachment; filename="ojis-analytics-' . date( 'Y-m-d' ) . '.csv"' );
        $rows = $wpdb->get_results( $wpdb->prepare(
            "SELECT visited_at, url_path, page_type, referrer, browser, os, device, country, is_new FROM {$table} WHERE visited_at >= %s ORDER BY visited_at DESC",
            $from
        ), ARRAY_A );
        $out = fopen( 'php://output', 'w' );
        fputcsv( $out, array_keys( $rows[0] ?? [] ) );
        foreach ( $rows as $row ) fputcsv( $out, $row );
        fclose( $out );
        exit;
    }

    $export_url = wp_nonce_url( admin_url( 'admin.php?page=ojis-analytics&export=1&range=' . $range ), 'ojis_analytics_export' );
    ?>
    <div class="wrap" style="max-width:1200px;">
        <h1 style="display:flex;align-items:center;gap:10px;">
            <span class="dashicons dashicons-chart-line" style="font-size:28px;width:28px;color:#1B4D3E;"></span>
            <?php esc_html_e( 'OJIS Analytics', 'ojis-travels-theme' ); ?>
        </h1>

        <!-- Range selector + export -->
        <div style="display:flex;align-items:center;gap:12px;margin:16px 0 24px;flex-wrap:wrap;">
            <?php foreach ( [ '7' => 'Last 7 days', '30' => 'Last 30 days', '90' => 'Last 90 days' ] as $val => $lbl ) : ?>
            <a href="<?php echo esc_url( admin_url( 'admin.php?page=ojis-analytics&range=' . $val ) ); ?>"
               class="button <?php echo $range === $val ? 'button-primary' : 'button-secondary'; ?>">
                <?php echo esc_html( $lbl ); ?>
            </a>
            <?php endforeach; ?>
            <a href="<?php echo esc_url( $export_url ); ?>" class="button button-secondary" style="margin-left:auto;">
                <span class="dashicons dashicons-download" style="vertical-align:middle;margin-right:4px;"></span>
                <?php esc_html_e( 'Export CSV', 'ojis-travels-theme' ); ?>
            </a>
        </div>

        <!-- Stat cards -->
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:16px;margin-bottom:28px;">
            <?php
            $stats = [
                [ 'label' => 'Total Page Views',  'value' => number_format( $total_views ),   'icon' => 'visibility',     'color' => '#1B4D3E' ],
                [ 'label' => 'Unique Visitors',   'value' => number_format( $unique_visits ), 'icon' => 'person',         'color' => '#2ECC71' ],
                [ 'label' => 'New Visitors',      'value' => number_format( $new_visitors ),  'icon' => 'person_add',     'color' => '#3498db' ],
                [ 'label' => 'Bounce Rate',       'value' => $bounce_rate . '%',              'icon' => 'logout',         'color' => '#e67e22' ],
            ];
            foreach ( $stats as $s ) : ?>
            <div style="background:#fff;border:1px solid #ddd;border-radius:10px;padding:20px 16px;text-align:center;">
                <span class="dashicons dashicons-<?php echo esc_attr( $s['icon'] ); ?>" style="font-size:28px;width:28px;height:28px;color:<?php echo esc_attr( $s['color'] ); ?>;"></span>
                <div style="font-size:2rem;font-weight:700;color:<?php echo esc_attr( $s['color'] ); ?>;line-height:1;margin:8px 0 4px;"><?php echo esc_html( $s['value'] ); ?></div>
                <div style="font-size:12px;color:#666;"><?php echo esc_html( $s['label'] ); ?></div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Chart -->
        <div style="background:#fff;border:1px solid #ddd;border-radius:10px;padding:24px;margin-bottom:28px;">
            <h3 style="margin:0 0 16px;"><?php esc_html_e( 'Daily Traffic', 'ojis-travels-theme' ); ?></h3>
            <canvas id="ojis-traffic-chart" height="80"></canvas>
        </div>

        <!-- Two column tables -->
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px;">

            <!-- Top pages -->
            <div style="background:#fff;border:1px solid #ddd;border-radius:10px;overflow:hidden;">
                <div style="padding:16px 20px;border-bottom:1px solid #eee;font-weight:600;"><?php esc_html_e( 'Top Pages', 'ojis-travels-theme' ); ?></div>
                <table style="width:100%;border-collapse:collapse;font-size:13px;">
                    <thead><tr style="background:#f6f7f7;">
                        <th style="padding:8px 16px;text-align:left;color:#555;"><?php esc_html_e( 'URL', 'ojis-travels-theme' ); ?></th>
                        <th style="padding:8px 16px;text-align:right;color:#555;"><?php esc_html_e( 'Views', 'ojis-travels-theme' ); ?></th>
                    </tr></thead>
                    <tbody>
                    <?php foreach ( $top_pages as $p ) : ?>
                    <tr style="border-top:1px solid #f0f0f0;">
                        <td style="padding:8px 16px;max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                            <a href="<?php echo esc_url( home_url( $p->url_path ) ); ?>" target="_blank" style="color:#1B4D3E;">
                                <?php echo esc_html( $p->url_path ?: '/' ); ?>
                            </a>
                        </td>
                        <td style="padding:8px 16px;text-align:right;font-weight:600;color:#1B4D3E;"><?php echo esc_html( number_format( (int) $p->views ) ); ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Top referrers -->
            <div style="background:#fff;border:1px solid #ddd;border-radius:10px;overflow:hidden;">
                <div style="padding:16px 20px;border-bottom:1px solid #eee;font-weight:600;"><?php esc_html_e( 'Top Referrers', 'ojis-travels-theme' ); ?></div>
                <table style="width:100%;border-collapse:collapse;font-size:13px;">
                    <thead><tr style="background:#f6f7f7;">
                        <th style="padding:8px 16px;text-align:left;color:#555;"><?php esc_html_e( 'Source', 'ojis-travels-theme' ); ?></th>
                        <th style="padding:8px 16px;text-align:right;color:#555;"><?php esc_html_e( 'Visits', 'ojis-travels-theme' ); ?></th>
                    </tr></thead>
                    <tbody>
                    <?php if ( empty( $top_refs ) ) : ?>
                    <tr><td colspan="2" style="padding:16px;color:#999;text-align:center;"><?php esc_html_e( 'No referral traffic in this period.', 'ojis-travels-theme' ); ?></td></tr>
                    <?php else : ?>
                    <?php foreach ( $top_refs as $r ) : ?>
                    <tr style="border-top:1px solid #f0f0f0;">
                        <td style="padding:8px 16px;"><?php echo esc_html( $r->referrer ?: __( 'Direct', 'ojis-travels-theme' ) ); ?></td>
                        <td style="padding:8px 16px;text-align:right;font-weight:600;color:#2ECC71;"><?php echo esc_html( number_format( (int) $r->cnt ) ); ?></td>
                    </tr>
                    <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Bottom row: countries / devices / browsers -->
        <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:20px;margin-bottom:20px;">
            <?php
            $bottom_tables = [
                [ 'heading' => 'Countries',  'data' => $top_countries, 'key' => 'country'  ],
                [ 'heading' => 'Devices',    'data' => $devices,       'key' => 'device'   ],
                [ 'heading' => 'Browsers',   'data' => $browsers,      'key' => 'browser'  ],
            ];
            foreach ( $bottom_tables as $bt ) : ?>
            <div style="background:#fff;border:1px solid #ddd;border-radius:10px;overflow:hidden;">
                <div style="padding:16px 20px;border-bottom:1px solid #eee;font-weight:600;"><?php echo esc_html( $bt['heading'] ); ?></div>
                <table style="width:100%;border-collapse:collapse;font-size:13px;">
                    <tbody>
                    <?php if ( empty( $bt['data'] ) ) : ?>
                    <tr><td style="padding:16px;color:#999;text-align:center;"><?php esc_html_e( 'No data.', 'ojis-travels-theme' ); ?></td></tr>
                    <?php else :
                        $max = (int) $bt['data'][0]->cnt;
                        foreach ( $bt['data'] as $row ) :
                            $pct = $max > 0 ? round( (int) $row->cnt / $max * 100 ) : 0;
                    ?>
                    <tr style="border-top:1px solid #f0f0f0;">
                        <td style="padding:8px 16px;">
                            <div style="font-size:12px;color:#444;margin-bottom:3px;"><?php echo esc_html( $row->{ $bt['key'] } ?: 'Unknown' ); ?></div>
                            <div style="height:6px;background:#f0f0f0;border-radius:3px;overflow:hidden;">
                                <div style="height:100%;width:<?php echo esc_attr( $pct ); ?>%;background:#1B4D3E;border-radius:3px;"></div>
                            </div>
                        </td>
                        <td style="padding:8px 16px;text-align:right;font-size:12px;font-weight:600;color:#666;white-space:nowrap;"><?php echo esc_html( number_format( (int) $row->cnt ) ); ?></td>
                    </tr>
                    <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
            <?php endforeach; ?>
        </div>

        <p style="color:#999;font-size:11px;margin-top:20px;">
            <?php esc_html_e( 'Data covers the last 90 days. Older records are pruned automatically. No cookies or cross-site tracking used.', 'ojis-travels-theme' ); ?>
        </p>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4/dist/chart.umd.min.js"></script>
    <script>
    (function() {
        const ctx = document.getElementById('ojis-traffic-chart');
        if (!ctx) return;
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo $chart_labels; // phpcs:ignore ?>,
                datasets: [
                    {
                        label: 'Page Views',
                        data: <?php echo $chart_views; // phpcs:ignore ?>,
                        borderColor: '#1B4D3E',
                        backgroundColor: 'rgba(27,77,62,0.08)',
                        borderWidth: 2,
                        pointRadius: 3,
                        tension: 0.4,
                        fill: true,
                    },
                    {
                        label: 'Unique Visitors',
                        data: <?php echo $chart_visits; // phpcs:ignore ?>,
                        borderColor: '#2ECC71',
                        backgroundColor: 'rgba(46,204,113,0.06)',
                        borderWidth: 2,
                        pointRadius: 3,
                        tension: 0.4,
                        fill: true,
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    tooltip: { mode: 'index', intersect: false }
                },
                scales: {
                    x: { grid: { display: false } },
                    y: { beginAtZero: true, grid: { color: '#f5f5f5' } }
                }
            }
        });
    })();
    </script>
    <?php
}
