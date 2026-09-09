<?php
/**
 * OJIS Travels Theme — SEO Layer
 *
 * Handles:
 *  - Meta title & description tags
 *  - Open Graph (Facebook, LinkedIn)
 *  - Twitter / X Card tags
 *  - Schema.org JSON-LD structured data (Organization, WebSite, Article, BreadcrumbList)
 *  - Canonical URL
 *  - XML Sitemap (robots-friendly, registered as a rewrite rule)
 *  - robots meta tag
 *
 * Works without a plugin. Does not conflict with Yoast/RankMath — if those
 * plugins are active their output takes priority via their own hooks.
 *
 * @package ojis-travels-theme
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ─── Only register our SEO output if no major SEO plugin is active ────────────
function ojis_seo_plugin_active(): bool {
    return (
        defined( 'WPSEO_VERSION' )        // Yoast SEO
        || defined( 'RANK_MATH_VERSION' ) // Rank Math
        || defined( 'AIOSEO_VERSION' )    // All in One SEO
        || class_exists( 'AIOSEOP_Core' )
    );
}

// ─── Remove WordPress's default <title> so we can own it fully ───────────────
function ojis_seo_remove_default_title(): void {
    if ( ojis_seo_plugin_active() ) return;
    remove_action( 'wp_head', '_wp_render_title_tag', 1 );
}
add_action( 'init', 'ojis_seo_remove_default_title' );

// ─── Main SEO <head> output ───────────────────────────────────────────────────
function ojis_seo_head(): void {
    if ( ojis_seo_plugin_active() ) return;

    global $post;

    // ── Gather data ───────────────────────────────────────────────────────────
    $site_name   = get_bloginfo( 'name' );
    $site_desc   = get_bloginfo( 'description' );
    $site_url    = home_url( '/' );
    $logo_url    = get_theme_mod( 'ojis_logo_scrolled', OJIS_THEME_URI . '/assets/images/OJIS-Travels-Advisory-Logo.webp' );
    $brand_color = '#1B4D3E';

    // Canonical + title + description
    if ( is_front_page() ) {
        $title       = $site_name . ' | Sustainable Tourism & Hospitality';
        $description = get_bloginfo( 'description' ) ?: 'OJIS Travels & Advisory — Making sustainable tourism and hospitality practical, relevant and accessible across Africa and beyond.';
        $canonical   = $site_url;
        $og_type     = 'website';
        $image_url   = get_theme_mod( 'ojis_hero_bg', OJIS_THEME_URI . '/assets/images/hero.webp' );

    } elseif ( is_singular( 'post' ) && $post ) {
        $title       = get_the_title() . ' | ' . $site_name;
        $description = has_excerpt() ? get_the_excerpt() : wp_trim_words( get_the_content(), 30, '...' );
        $canonical   = get_permalink();
        $og_type     = 'article';
        $image_url   = get_the_post_thumbnail_url( $post->ID, 'ojis-hero' ) ?: get_theme_mod( 'ojis_hero_bg', OJIS_THEME_URI . '/assets/images/hero.webp' );

    } elseif ( is_page() && $post ) {
        $title       = get_the_title() . ' | ' . $site_name;
        $description = has_excerpt() ? get_the_excerpt() : wp_trim_words( get_the_content(), 30, '...' );
        $canonical   = get_permalink();
        $og_type     = 'website';
        $image_url   = get_the_post_thumbnail_url( $post->ID, 'ojis-hero' ) ?: get_theme_mod( 'ojis_hero_bg', OJIS_THEME_URI . '/assets/images/hero.webp' );

    } elseif ( is_category() ) {
        $term        = get_queried_object();
        $title       = $term->name . ' | ' . $site_name;
        $description = $term->description ?: 'Browse ' . $term->name . ' articles from OJIS Travels & Advisory.';
        $canonical   = get_category_link( $term->term_id );
        $og_type     = 'website';
        $image_url   = get_theme_mod( 'ojis_hero_bg', OJIS_THEME_URI . '/assets/images/hero.webp' );

    } elseif ( is_search() ) {
        $title       = sprintf( __( 'Search: %s | %s', 'ojis-travels-theme' ), get_search_query(), $site_name );
        $description = sprintf( __( 'Search results for "%s" on OJIS Travels & Advisory.', 'ojis-travels-theme' ), get_search_query() );
        $canonical   = get_search_link();
        $og_type     = 'website';
        $image_url   = get_theme_mod( 'ojis_hero_bg', OJIS_THEME_URI . '/assets/images/hero.webp' );

    } else {
        $title       = wp_title( '|', false, 'right' ) . $site_name;
        $description = $site_desc;
        $canonical   = ( is_ssl() ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $og_type     = 'website';
        $image_url   = get_theme_mod( 'ojis_hero_bg', OJIS_THEME_URI . '/assets/images/hero.webp' );
    }

    // Sanitise description — strip HTML, limit to 160 chars
    $description = wp_strip_all_tags( $description );
    $description = mb_strimwidth( $description, 0, 160, '...' );
    $canonical   = esc_url( $canonical );

    // Social handles
    $twitter_handle = '@ojistravels';
    ?>

    <!-- ═══ SEO: Title ════════════════════════════════════════════ -->
    <title><?php echo esc_html( $title ); ?></title>
    <meta name="description" content="<?php echo esc_attr( $description ); ?>">
    <link rel="canonical" href="<?php echo esc_url( $canonical ); ?>">
    <?php if ( is_search() || ( isset( $post ) && get_post_status( $post ) === 'private' ) ) : ?>
    <meta name="robots" content="noindex, nofollow">
    <?php else : ?>
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <?php endif; ?>

    <!-- ═══ Open Graph ════════════════════════════════════════════ -->
    <meta property="og:type"        content="<?php echo esc_attr( $og_type ); ?>">
    <meta property="og:title"       content="<?php echo esc_attr( $title ); ?>">
    <meta property="og:description" content="<?php echo esc_attr( $description ); ?>">
    <meta property="og:url"         content="<?php echo esc_url( $canonical ); ?>">
    <meta property="og:site_name"   content="<?php echo esc_attr( $site_name ); ?>">
    <meta property="og:image"       content="<?php echo esc_url( $image_url ); ?>">
    <meta property="og:image:width"  content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale"       content="en_US">
    <?php if ( $og_type === 'article' && isset( $post ) ) : ?>
    <meta property="article:published_time" content="<?php echo esc_attr( get_the_date( 'c', $post ) ); ?>">
    <meta property="article:modified_time"  content="<?php echo esc_attr( get_the_modified_date( 'c', $post ) ); ?>">
    <meta property="article:author"         content="<?php echo esc_attr( get_the_author_meta( 'display_name', $post->post_author ) ); ?>">
    <?php endif; ?>

    <!-- ═══ Twitter / X Card ══════════════════════════════════════ -->
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:site"        content="<?php echo esc_attr( $twitter_handle ); ?>">
    <meta name="twitter:title"       content="<?php echo esc_attr( $title ); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr( $description ); ?>">
    <meta name="twitter:image"       content="<?php echo esc_url( $image_url ); ?>">

    <!-- ═══ Schema.org JSON-LD ════════════════════════════════════ -->
    <?php ojis_schema_jsonld( $og_type, $post ?? null, $title, $description, $image_url, $canonical, $site_name, $site_url, $logo_url, $brand_color ); ?>
    <?php
}
add_action( 'wp_head', 'ojis_seo_head', 1 );

// ─── Schema.org JSON-LD output ────────────────────────────────────────────────
function ojis_schema_jsonld(
    string  $type,
    ?object $post,
    string  $title,
    string  $description,
    string  $image_url,
    string  $canonical,
    string  $site_name,
    string  $site_url,
    string  $logo_url,
    string  $brand_color
): void {

    // Organization (always present)
    $org = [
        '@type'  => 'Organization',
        '@id'    => $site_url . '#organization',
        'name'   => $site_name,
        'url'    => $site_url,
        'logo'   => [
            '@type'  => 'ImageObject',
            'url'    => $logo_url,
            'width'  => 260,
            'height' => 80,
        ],
        'sameAs' => array_filter( [
            get_theme_mod( 'ojis_social_linkedin',  '' ),
            get_theme_mod( 'ojis_social_instagram', '' ),
            get_theme_mod( 'ojis_social_facebook',  '' ),
            get_theme_mod( 'ojis_social_tiktok',    '' ),
        ] ),
        'contactPoint' => [
            '@type'             => 'ContactPoint',
            'email'             => get_theme_mod( 'ojis_footer_email', 'info@ojistravels.com' ),
            'contactType'       => 'customer service',
            'areaServed'        => 'Africa',
            'availableLanguage' => 'English',
        ],
    ];

    // WebSite (always present) — enables Sitelinks Searchbox
    $website = [
        '@type'           => 'WebSite',
        '@id'             => $site_url . '#website',
        'url'             => $site_url,
        'name'            => $site_name,
        'description'     => get_bloginfo( 'description' ),
        'publisher'       => [ '@id' => $site_url . '#organization' ],
        'potentialAction' => [
            '@type'       => 'SearchAction',
            'target'      => [
                '@type'       => 'EntryPoint',
                'urlTemplate' => $site_url . '?s={search_term_string}',
            ],
            'query-input' => 'required name=search_term_string',
        ],
    ];

    $graph = [ $org, $website ];

    // Article schema for single posts
    if ( $type === 'article' && $post ) {
        $article = [
            '@type'            => 'Article',
            '@id'              => $canonical . '#article',
            'headline'         => $title,
            'description'      => $description,
            'image'            => $image_url,
            'datePublished'    => get_the_date( 'c', $post ),
            'dateModified'     => get_the_modified_date( 'c', $post ),
            'url'              => $canonical,
            'isPartOf'         => [ '@id' => $site_url . '#website' ],
            'publisher'        => [ '@id' => $site_url . '#organization' ],
            'author'           => [
                '@type' => 'Person',
                'name'  => get_the_author_meta( 'display_name', $post->post_author ),
            ],
            'mainEntityOfPage' => [ '@id' => $canonical ],
        ];
        $graph[] = $article;
    }

    // Breadcrumbs for single posts and pages
    if ( ( $type === 'article' || is_page() ) && $post ) {
        $crumbs   = [];
        $crumbs[] = [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Home',     'item' => $site_url ];
        if ( $type === 'article' ) {
            $crumbs[] = [ '@type' => 'ListItem', 'position' => 2, 'name' => 'Insights', 'item' => home_url( '/insights' ) ];
            $crumbs[] = [ '@type' => 'ListItem', 'position' => 3, 'name' => get_the_title( $post ), 'item' => $canonical ];
        } else {
            $crumbs[] = [ '@type' => 'ListItem', 'position' => 2, 'name' => get_the_title( $post ), 'item' => $canonical ];
        }
        $graph[] = [
            '@type'           => 'BreadcrumbList',
            'itemListElement' => $crumbs,
        ];
    }

    $json = wp_json_encode( [
        '@context' => 'https://schema.org',
        '@graph'   => $graph,
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );

    echo '<script type="application/ld+json">' . $json . '</script>' . "\n"; // phpcs:ignore
}

// ─── XML Sitemap ──────────────────────────────────────────────────────────────
function ojis_sitemap_rewrite(): void {
    add_rewrite_rule( '^ojis-sitemap\.xml$', 'index.php?ojis_sitemap=1', 'top' );
}
add_action( 'init', 'ojis_sitemap_rewrite' );

function ojis_sitemap_query_var( array $vars ): array {
    $vars[] = 'ojis_sitemap';
    return $vars;
}
add_filter( 'query_vars', 'ojis_sitemap_query_var' );

function ojis_sitemap_output(): void {
    if ( ! get_query_var( 'ojis_sitemap' ) ) return;

    header( 'Content-Type: application/xml; charset=UTF-8' );
    header( 'X-Robots-Tag: noindex' );

    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    // Homepage
    ojis_sitemap_url( home_url( '/' ), date( 'Y-m-d' ), 'daily', '1.0' );

    // Static pages
    $pages = get_pages( [ 'post_status' => 'publish' ] );
    foreach ( $pages as $p ) {
        ojis_sitemap_url( get_permalink( $p->ID ), get_the_modified_date( 'Y-m-d', $p->ID ), 'monthly', '0.8' );
    }

    // Posts
    $posts = get_posts( [ 'numberposts' => -1, 'post_status' => 'publish' ] );
    foreach ( $posts as $p ) {
        ojis_sitemap_url( get_permalink( $p->ID ), get_the_modified_date( 'Y-m-d', $p->ID ), 'weekly', '0.7' );
    }

    // Categories
    $cats = get_categories( [ 'hide_empty' => true ] );
    foreach ( $cats as $cat ) {
        ojis_sitemap_url( get_category_link( $cat->term_id ), date( 'Y-m-d' ), 'weekly', '0.5' );
    }

    echo '</urlset>';
    exit;
}
add_action( 'template_redirect', 'ojis_sitemap_output' );

function ojis_sitemap_url( string $loc, string $lastmod, string $changefreq, string $priority ): void {
    echo "<url>\n";
    echo '  <loc>' . esc_url( $loc ) . "</loc>\n";
    echo '  <lastmod>' . esc_html( $lastmod ) . "</lastmod>\n";
    echo '  <changefreq>' . esc_html( $changefreq ) . "</changefreq>\n";
    echo '  <priority>' . esc_html( $priority ) . "</priority>\n";
    echo "</url>\n";
}

// ─── Add sitemap link to robots.txt ───────────────────────────────────────────
function ojis_robots_txt( string $output ): string {
    $output .= "\nSitemap: " . esc_url( home_url( '/ojis-sitemap.xml' ) ) . "\n";
    return $output;
}
add_filter( 'robots_txt', 'ojis_robots_txt' );

// ─── Preconnect + DNS-prefetch for performance (helps Core Web Vitals) ────────
function ojis_resource_hints( array $hints, string $relation_type ): array {
    if ( $relation_type === 'preconnect' ) {
        $hints[] = [ 'href' => 'https://fonts.googleapis.com', 'crossorigin' => 'anonymous' ];
        $hints[] = [ 'href' => 'https://fonts.gstatic.com',   'crossorigin' => 'anonymous' ];
    }
    if ( $relation_type === 'dns-prefetch' ) {
        $hints[] = [ 'href' => '//fonts.googleapis.com' ];
        $hints[] = [ 'href' => '//fonts.gstatic.com' ];
    }
    return $hints;
}
add_filter( 'wp_resource_hints', 'ojis_resource_hints', 10, 2 );

// ─── Add image alt tags to post thumbnails if missing ─────────────────────────
function ojis_ensure_image_alt( string $html, int $post_id ): string {
    if ( strpos( $html, 'alt=""' ) !== false || strpos( $html, "alt=''" ) !== false ) {
        $alt  = esc_attr( get_the_title( $post_id ) );
        $html = str_replace( 'alt=""', 'alt="' . $alt . '"', $html );
        $html = str_replace( "alt=''", "alt='" . $alt . "'", $html );
    }
    return $html;
}
add_filter( 'post_thumbnail_html', 'ojis_ensure_image_alt', 10, 2 );

// ─── SEO Customizer settings ──────────────────────────────────────────────────
function ojis_seo_customizer( $wp_customize ): void {
    $wp_customize->add_panel( 'ojis_seo_panel', [
        'title'    => __( 'SEO Settings', 'ojis-travels-theme' ),
        'priority' => 35,
    ] );

    $wp_customize->add_section( 'ojis_seo_general', [
        'title' => __( 'General SEO', 'ojis-travels-theme' ),
        'panel' => 'ojis_seo_panel',
    ] );

    foreach ( [
        [ 'ojis_seo_home_title', '',       __( 'Homepage SEO Title (leave blank to auto-generate)', 'ojis-travels-theme' ), 'text'     ],
        [ 'ojis_seo_home_desc',  '',       __( 'Homepage Meta Description (max 160 chars)',          'ojis-travels-theme' ), 'textarea' ],
        [ 'ojis_twitter_handle', '@ojistravels', __( 'Twitter / X Handle',                           'ojis-travels-theme' ), 'text'     ],
        [ 'ojis_google_verify',  '',       __( 'Google Search Console Verification Code',            'ojis-travels-theme' ), 'text'     ],
    ] as [$id, $default, $label, $type] ) {
        $wp_customize->add_setting( $id, [
            'default'           => $default,
            'sanitize_callback' => ( $type === 'textarea' ) ? 'sanitize_textarea_field' : 'sanitize_text_field',
            'transport'         => 'refresh',
        ] );
        $wp_customize->add_control( $id, [
            'label'   => $label,
            'section' => 'ojis_seo_general',
            'type'    => $type,
        ] );
    }
}
add_action( 'customize_register', 'ojis_seo_customizer' );

// ─── Google Search Console verification meta tag ─────────────────────────────
function ojis_google_verify(): void {
    $code = get_theme_mod( 'ojis_google_verify', '' );
    if ( ! empty( $code ) ) {
        echo '<meta name="google-site-verification" content="' . esc_attr( $code ) . '">' . "\n";
    }
}
add_action( 'wp_head', 'ojis_google_verify', 2 );
