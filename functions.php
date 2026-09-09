<?php
/**
 * OJIS Travels Theme — Functions & Setup
 *
 * @package ojis-travels-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ─── Constants ────────────────────────────────────────────────────────────────
define( 'OJIS_VERSION',    '1.0.0' );
define( 'OJIS_THEME_URI',  get_template_directory_uri() );
define( 'OJIS_THEME_DIR',  get_template_directory() );
define( 'OJIS_AUTHOR',     'Opeyemi Oladejobi Akinkunmi' );
define( 'OJIS_AUTHOR_URI', 'https://ezeroandone.io' );

// ─── Load helpers ─────────────────────────────────────────────────────────────
require_once OJIS_THEME_DIR . '/inc/social-icons.php';
require_once OJIS_THEME_DIR . '/inc/github-updater.php';

// ─── Ensure logo Customizer defaults are correctly seeded in the database ─────
// get_theme_mod() returns stale DB values even when the default arg changes.
// This hook writes the correct defaults once per theme version so the right
// logo shows immediately after theme activation or theme file updates.
function ojis_seed_logo_defaults() {
    $version_key = 'ojis_logo_defaults_seeded_v2';

    // Only run once per theme version
    if ( get_option( $version_key ) ) return;

    $light_url = get_template_directory_uri() . '/assets/images/OJIS-Travels-Advisory-Logo-Light.png';
    $dark_url  = get_template_directory_uri() . '/assets/images/OJIS-Travels-Advisory-Logo.webp';

    // Only overwrite if the current saved value looks like the wrong logo
    // (i.e. it's the .webp when it should be the light PNG for the transparent slot)
    $current_transparent = get_theme_mod( 'ojis_logo_transparent', '' );

    // If empty OR if it contains the dark webp logo, reset to light logo
    if ( empty( $current_transparent ) || strpos( $current_transparent, 'OJIS-Travels-Advisory-Logo.webp' ) !== false ) {
        set_theme_mod( 'ojis_logo_transparent', $light_url );
    }

    // Ensure the scrolled logo is set to the colour version
    $current_scrolled = get_theme_mod( 'ojis_logo_scrolled', '' );
    if ( empty( $current_scrolled ) ) {
        set_theme_mod( 'ojis_logo_scrolled', $dark_url );
    }

    update_option( $version_key, true );
}
add_action( 'after_setup_theme', 'ojis_seed_logo_defaults', 5 );

// ─── Admin: Logo Reset Tool ────────────────────────────────────────────────────
// Provides a one-click reset button in WP Admin > Appearance to force correct logos.
function ojis_handle_logo_reset() {
    if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) return;
    if ( ! isset( $_GET['ojis_reset_logos'] ) ) return;
    if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ?? '' ) ), 'ojis_reset_logos' ) ) return;

    $light_url = get_template_directory_uri() . '/assets/images/OJIS-Travels-Advisory-Logo-Light.png';
    $dark_url  = get_template_directory_uri() . '/assets/images/OJIS-Travels-Advisory-Logo.webp';

    set_theme_mod( 'ojis_logo_transparent', $light_url );
    set_theme_mod( 'ojis_logo_scrolled',    $dark_url );
    // Clear the seed flag so it re-runs fresh
    delete_option( 'ojis_logo_defaults_seeded_v2' );

    wp_safe_redirect( add_query_arg( 'ojis_logos_reset', '1', admin_url( 'themes.php' ) ) );
    exit;
}
add_action( 'admin_init', 'ojis_handle_logo_reset' );

// Show admin notice with reset button and confirmation
function ojis_logo_admin_notice() {
    if ( ! current_user_can( 'manage_options' ) ) return;

    // Show success notice after reset
    if ( isset( $_GET['ojis_logos_reset'] ) ) {
        echo '<div class="notice notice-success is-dismissible"><p>'
            . '<strong>OJIS Theme:</strong> Logo settings have been reset. '
            . 'The light/white logo is now set for the transparent header state, '
            . 'and the colour logo for the scrolled state.'
            . '</p></div>';
        return;
    }

    // Check if the transparent logo is wrong (still set to the dark .webp)
    $current = get_theme_mod( 'ojis_logo_transparent', '' );
    if ( ! empty( $current ) && strpos( $current, 'OJIS-Travels-Advisory-Logo.webp' ) !== false ) {
        $reset_url = wp_nonce_url(
            add_query_arg( 'ojis_reset_logos', '1', admin_url( 'themes.php' ) ),
            'ojis_reset_logos'
        );
        echo '<div class="notice notice-warning is-dismissible"><p>'
            . '<strong>OJIS Theme — Logo Fix Required:</strong> '
            . 'The transparent header is still showing the colour logo. '
            . '<a href="' . esc_url( $reset_url ) . '" class="button button-primary" style="margin-left:8px;">Fix Logo Settings Now</a>'
            . ' &nbsp; or go to <a href="' . esc_url( admin_url( 'customize.php?autofocus[section]=ojis_header_logos' ) ) . '">Customize → Header Logos</a> to set them manually.'
            . '</p></div>';
    }
}
add_action( 'admin_notices', 'ojis_logo_admin_notice' );

// ─── Theme Setup ──────────────────────────────────────────────────────────────
function ojis_theme_setup() {
    load_theme_textdomain( 'ojis-travels-theme', OJIS_THEME_DIR . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', [
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style',
    ] );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'custom-logo', [
        'height'               => 80,
        'width'                => 260,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => [ 'site-title', 'site-description' ],
        'unlink-homepage-logo' => false,
    ] );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'editor-styles' );

    register_nav_menus( [
        'primary' => __( 'Primary Navigation', 'ojis-travels-theme' ),
        'footer'  => __( 'Footer Navigation',  'ojis-travels-theme' ),
    ] );

    add_image_size( 'ojis-hero',     1920, 1080, true );
    add_image_size( 'ojis-card',      800,  540, true );
    add_image_size( 'ojis-thumbnail', 480,  320, true );
}
add_action( 'after_setup_theme', 'ojis_theme_setup' );

// ─── Content Width ─────────────────────────────────────────────────────────────
function ojis_content_width() {
    $GLOBALS['content_width'] = 1280;
}
add_action( 'after_setup_theme', 'ojis_content_width', 0 );

// ─── Enqueue Assets ───────────────────────────────────────────────────────────
function ojis_enqueue_assets() {

    wp_enqueue_style(
        'ojis-google-fonts',
        'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'ojis-material-symbols',
        'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0',
        [],
        null
    );

    wp_enqueue_script( 'ojis-tailwind', 'https://cdn.tailwindcss.com', [], null, false );

    // Build Tailwind config from Customizer color values so live-preview works
    $color_forest   = get_theme_mod( 'ojis_color_forest',   '#1B4D3E' );
    $color_eco      = get_theme_mod( 'ojis_color_eco',      '#2ECC71' );
    $color_eco_alt  = get_theme_mod( 'ojis_color_eco_alt',  '#40C057' );
    $color_charcoal = get_theme_mod( 'ojis_color_charcoal', '#1A211E' );
    $color_offwhite = get_theme_mod( 'ojis_color_offwhite', '#F9FBF9' );
    $color_muted    = get_theme_mod( 'ojis_color_muted',    '#6B7280' );
    $font_body      = get_theme_mod( 'ojis_font_body',      'Plus Jakarta Sans' );

    $tailwind_config = "tailwind.config={theme:{extend:{colors:{"
        . "'forest':'" . esc_js( $color_forest )   . "',"
        . "'eco':'"    . esc_js( $color_eco )       . "',"
        . "'eco-alt':'" . esc_js( $color_eco_alt )  . "',"
        . "'charcoal':'" . esc_js( $color_charcoal ) . "',"
        . "'offwhite':'" . esc_js( $color_offwhite ) . "',"
        . "'muted':'"  . esc_js( $color_muted )     . "'"
        . "},fontFamily:{sans:['" . esc_js( $font_body ) . "','Inter','sans-serif']},"
        . "backdropBlur:{md:'12px'}}}}";
    wp_add_inline_script( 'ojis-tailwind', $tailwind_config );

    // Inject Customizer CSS variables for components that use var(--color-*)
    $logo_height_px  = absint( get_theme_mod( 'ojis_logo_height', 40 ) );
    $logo_height_mob = max( 28, (int) round( $logo_height_px * 0.8 ) );
    $custom_css = "
        :root {
            --color-forest:    " . esc_attr( $color_forest )   . ";
            --color-eco:       " . esc_attr( $color_eco )       . ";
            --color-eco-alt:   " . esc_attr( $color_eco_alt )   . ";
            --color-charcoal:  " . esc_attr( $color_charcoal )  . ";
            --color-offwhite:  " . esc_attr( $color_offwhite )  . ";
            --color-muted:     " . esc_attr( $color_muted )     . ";
            --font-sans:       '" . esc_attr( $font_body ) . "', Inter, sans-serif;
            --logo-height:     " . esc_attr( $logo_height_px )  . "px;
            --logo-height-mob: " . esc_attr( $logo_height_mob ) . "px;
        }
    ";
    wp_add_inline_style( 'ojis-main', $custom_css );

    wp_enqueue_style(
        'ojis-main',
        OJIS_THEME_URI . '/assets/css/main.css',
        [ 'ojis-google-fonts', 'ojis-material-symbols' ],
        OJIS_VERSION
    );

    wp_enqueue_script(
        'ojis-main-js',
        OJIS_THEME_URI . '/assets/js/main.js',
        [],
        OJIS_VERSION,
        true
    );

    wp_localize_script( 'ojis-main-js', 'ojisData', [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'ojis_nonce' ),
        'siteUrl' => get_site_url(),
    ] );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'ojis_enqueue_assets' );

// ─── Widgets / Sidebars ────────────────────────────────────────────────────────
function ojis_register_sidebars() {
    register_sidebar( [
        'name'          => __( 'Insights Sidebar', 'ojis-travels-theme' ),
        'id'            => 'insights-sidebar',
        'description'   => __( 'Widgets for the Insights/Blog sidebar.', 'ojis-travels-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-8">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title text-lg font-semibold text-charcoal mb-4 pb-2 border-b border-gray-200">',
        'after_title'   => '</h3>',
    ] );

    register_sidebar( [
        'name'          => __( 'Footer Widget Area', 'ojis-travels-theme' ),
        'id'            => 'footer-widgets',
        'description'   => __( 'Footer widget area.', 'ojis-travels-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title text-sm font-semibold uppercase tracking-widest text-gray-400 mb-4">',
        'after_title'   => '</h4>',
    ] );
}
add_action( 'widgets_init', 'ojis_register_sidebars' );

// ─── Custom Excerpt ────────────────────────────────────────────────────────────
function ojis_excerpt_length( $length ) { return 25; }
add_filter( 'excerpt_length', 'ojis_excerpt_length', 999 );
function ojis_excerpt_more( $more ) { return '...'; }
add_filter( 'excerpt_more', 'ojis_excerpt_more' );

// ─── Add nav-link-item class to WordPress-assigned primary menu items ──────────
// This ensures the transparent→scrolled colour CSS applies regardless of whether
// the fallback PHP menu or a WordPress-assigned menu is active.
function ojis_nav_link_classes( $classes, $item, $args ) {
    if ( isset( $args->theme_location ) && $args->theme_location === 'primary' ) {
        $classes[] = 'nav-link-item';
        // Also add nav-link for the underline animation
        $classes[] = 'nav-link';
        if ( in_array( 'current-menu-item', $classes, true ) || in_array( 'current_page_item', $classes, true ) ) {
            $classes[] = 'nav-link-active';
        }
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'ojis_nav_link_classes', 10, 3 );

// Also add the class to the <a> tag itself (WP applies nav_menu_css_class to <li>, not <a>)
function ojis_nav_link_atts( $atts, $item, $args ) {
    if ( isset( $args->theme_location ) && $args->theme_location === 'primary' ) {
        $existing  = $atts['class'] ?? '';
        $add       = 'nav-link nav-link-item relative px-4 py-2 text-sm font-medium transition-colors duration-200 rounded-lg focus:outline-none';
        $atts['class'] = trim( $existing . ' ' . $add );
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'ojis_nav_link_atts', 10, 3 );

// ─── AJAX: Newsletter Subscription ────────────────────────────────────────────
function ojis_newsletter_subscribe() {
    check_ajax_referer( 'ojis_nonce', 'nonce' );
    $email = sanitize_email( $_POST['email'] ?? '' );

    if ( ! is_email( $email ) ) {
        wp_send_json_error( [ 'message' => __( 'Please enter a valid email address.', 'ojis-travels-theme' ) ] );
    }

    $subscribers = get_option( 'ojis_newsletter_subscribers', [] );

    // Migrate legacy flat array to keyed array if needed
    if ( ! empty( $subscribers ) && isset( $subscribers[0] ) && is_string( $subscribers[0] ) ) {
        $migrated = [];
        foreach ( $subscribers as $e ) {
            $migrated[ $e ] = [ 'email' => $e, 'date' => '', 'status' => 'active' ];
        }
        $subscribers = $migrated;
    }

    if ( isset( $subscribers[ $email ] ) ) {
        wp_send_json_success( [ 'message' => __( 'You are already subscribed. Thank you!', 'ojis-travels-theme' ) ] );
    }

    $subscribers[ $email ] = [
        'email'  => $email,
        'date'   => current_time( 'Y-m-d H:i:s' ),
        'status' => 'active',
        'source' => sanitize_text_field( $_POST['source'] ?? 'website' ),
    ];
    update_option( 'ojis_newsletter_subscribers', $subscribers );
    wp_send_json_success( [ 'message' => __( 'Thank you for subscribing!', 'ojis-travels-theme' ) ] );
}
add_action( 'wp_ajax_ojis_newsletter',        'ojis_newsletter_subscribe' );
add_action( 'wp_ajax_nopriv_ojis_newsletter', 'ojis_newsletter_subscribe' );

// ─── AJAX: Contact / Advisory Form ────────────────────────────────────────────
function ojis_contact_form_submit() {
    check_ajax_referer( 'ojis_nonce', 'nonce' );

    $name    = sanitize_text_field( $_POST['name']    ?? '' );
    $email   = sanitize_email(      $_POST['email']   ?? '' );
    $subject = sanitize_text_field( $_POST['subject'] ?? '' );
    $message = sanitize_textarea_field( $_POST['message'] ?? '' );

    if ( empty( $name ) || ! is_email( $email ) || empty( $message ) ) {
        wp_send_json_error( [ 'message' => __( 'Please fill in all required fields.', 'ojis-travels-theme' ) ] );
    }

    $to      = get_option( 'admin_email' );
    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'Reply-To: ' . $name . ' <' . $email . '>',
    ];
    $body = sprintf(
        '<p><strong>Name:</strong> %s</p><p><strong>Email:</strong> %s</p><p><strong>Subject:</strong> %s</p><p><strong>Message:</strong><br>%s</p>',
        esc_html( $name ), esc_html( $email ), esc_html( $subject ), nl2br( esc_html( $message ) )
    );

    $sent = wp_mail( $to, 'Advisory Inquiry from ' . $name, $body, $headers );

    if ( $sent ) {
        wp_send_json_success( [ 'message' => __( 'Your message has been sent. We will be in touch shortly.', 'ojis-travels-theme' ) ] );
    } else {
        wp_send_json_error( [ 'message' => __( 'Something went wrong. Please try again or email us directly.', 'ojis-travels-theme' ) ] );
    }
}
add_action( 'wp_ajax_ojis_contact',        'ojis_contact_form_submit' );
add_action( 'wp_ajax_nopriv_ojis_contact', 'ojis_contact_form_submit' );

// ─── Newsletter Admin Menu ─────────────────────────────────────────────────────
function ojis_newsletter_admin_menu() {
    add_menu_page(
        __( 'OJIS Newsletter', 'ojis-travels-theme' ),
        __( 'Newsletter', 'ojis-travels-theme' ),
        'manage_options',
        'ojis-newsletter',
        'ojis_newsletter_admin_page',
        'dashicons-email-alt',
        58
    );
    add_submenu_page(
        'ojis-newsletter',
        __( 'Subscribers', 'ojis-travels-theme' ),
        __( 'Subscribers', 'ojis-travels-theme' ),
        'manage_options',
        'ojis-newsletter',
        'ojis_newsletter_admin_page'
    );
    add_submenu_page(
        'ojis-newsletter',
        __( 'Send Broadcast', 'ojis-travels-theme' ),
        __( 'Send Broadcast', 'ojis-travels-theme' ),
        'manage_options',
        'ojis-newsletter-broadcast',
        'ojis_newsletter_broadcast_page'
    );
    add_submenu_page(
        'ojis-newsletter',
        __( 'SMTP Settings', 'ojis-travels-theme' ),
        __( 'SMTP Settings', 'ojis-travels-theme' ),
        'manage_options',
        'ojis-newsletter-smtp',
        'ojis_newsletter_smtp_page'
    );
}
add_action( 'admin_menu', 'ojis_newsletter_admin_menu' );

// ─── Newsletter Admin: Handle POST actions ─────────────────────────────────────
function ojis_newsletter_admin_actions() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    // Delete single subscriber
    if (
        isset( $_GET['ojis_action'], $_GET['ojis_email'], $_GET['_wpnonce'] ) &&
        $_GET['ojis_action'] === 'delete_subscriber' &&
        wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ), 'ojis_delete_subscriber' )
    ) {
        $email       = sanitize_email( urldecode( $_GET['ojis_email'] ) );
        $subscribers = get_option( 'ojis_newsletter_subscribers', [] );
        unset( $subscribers[ $email ] );
        update_option( 'ojis_newsletter_subscribers', $subscribers );
        wp_safe_redirect( admin_url( 'admin.php?page=ojis-newsletter&deleted=1' ) );
        exit;
    }

    // Bulk delete
    if (
        isset( $_POST['ojis_bulk_action'], $_POST['_wpnonce_bulk'] ) &&
        wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_wpnonce_bulk'] ) ), 'ojis_bulk_action' ) &&
        $_POST['ojis_bulk_action'] === 'delete' &&
        ! empty( $_POST['subscriber_emails'] )
    ) {
        $subscribers = get_option( 'ojis_newsletter_subscribers', [] );
        foreach ( (array) $_POST['subscriber_emails'] as $email ) {
            unset( $subscribers[ sanitize_email( $email ) ] );
        }
        update_option( 'ojis_newsletter_subscribers', $subscribers );
        wp_safe_redirect( admin_url( 'admin.php?page=ojis-newsletter&bulk_deleted=1' ) );
        exit;
    }

    // Add subscriber manually
    if (
        isset( $_POST['ojis_add_subscriber'], $_POST['_wpnonce_add'] ) &&
        wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_wpnonce_add'] ) ), 'ojis_add_subscriber' )
    ) {
        $email = sanitize_email( $_POST['new_subscriber_email'] ?? '' );
        if ( is_email( $email ) ) {
            $subscribers = get_option( 'ojis_newsletter_subscribers', [] );
            if ( ! isset( $subscribers[ $email ] ) ) {
                $subscribers[ $email ] = [
                    'email'  => $email,
                    'date'   => current_time( 'Y-m-d H:i:s' ),
                    'status' => 'active',
                    'source' => 'manual',
                ];
                update_option( 'ojis_newsletter_subscribers', $subscribers );
            }
        }
        wp_safe_redirect( admin_url( 'admin.php?page=ojis-newsletter&added=1' ) );
        exit;
    }

    // Export CSV
    if (
        isset( $_GET['ojis_action'], $_GET['_wpnonce'] ) &&
        $_GET['ojis_action'] === 'export_csv' &&
        wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ), 'ojis_export_csv' )
    ) {
        $subscribers = get_option( 'ojis_newsletter_subscribers', [] );
        header( 'Content-Type: text/csv; charset=UTF-8' );
        header( 'Content-Disposition: attachment; filename="ojis-subscribers-' . date( 'Y-m-d' ) . '.csv"' );
        header( 'Pragma: no-cache' );
        $output = fopen( 'php://output', 'w' );
        fputcsv( $output, [ 'Email', 'Date Subscribed', 'Source', 'Status' ] );
        foreach ( $subscribers as $sub ) {
            fputcsv( $output, [
                $sub['email']  ?? '',
                $sub['date']   ?? '',
                $sub['source'] ?? '',
                $sub['status'] ?? '',
            ] );
        }
        fclose( $output );
        exit;
    }

    // Send broadcast
    if (
        isset( $_POST['ojis_send_broadcast'], $_POST['_wpnonce_broadcast'] ) &&
        wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_wpnonce_broadcast'] ) ), 'ojis_send_broadcast' )
    ) {
        $subject  = sanitize_text_field( $_POST['broadcast_subject'] ?? '' );
        $body_raw = wp_kses_post( $_POST['broadcast_body'] ?? '' );

        if ( empty( $subject ) || empty( $body_raw ) ) {
            wp_safe_redirect( admin_url( 'admin.php?page=ojis-newsletter-broadcast&error=empty' ) );
            exit;
        }

        $subscribers = get_option( 'ojis_newsletter_subscribers', [] );
        $active      = array_filter( $subscribers, fn( $s ) => ( $s['status'] ?? 'active' ) === 'active' );

        $site_name    = get_bloginfo( 'name' );
        $from_name    = get_option( 'ojis_smtp_from_name', $site_name );
        $from_email   = get_option( 'ojis_smtp_from_email', get_option( 'admin_email' ) );
        $unsubscribe_url = home_url( '/?ojis_unsubscribe=1&email=' );

        $headers = [
            'Content-Type: text/html; charset=UTF-8',
            'From: ' . $from_name . ' <' . $from_email . '>',
        ];

        $sent_count  = 0;
        $fail_count  = 0;
        $batch_limit = 50; // safety throttle per request
        $count       = 0;

        foreach ( $active as $sub ) {
            if ( $count >= $batch_limit ) break;
            $email       = $sub['email'] ?? '';
            $unsub_link  = $unsubscribe_url . rawurlencode( $email ) . '&token=' . wp_hash( $email );
            $email_body  = $body_raw
                . '<br><br><hr style="border:none;border-top:1px solid #eee;">'
                . '<p style="font-size:12px;color:#999;">You are receiving this because you subscribed at ' . esc_html( $site_name ) . '. '
                . '<a href="' . esc_url( $unsub_link ) . '" style="color:#999;">Unsubscribe</a></p>';

            if ( wp_mail( $email, $subject, $email_body, $headers ) ) {
                $sent_count++;
            } else {
                $fail_count++;
            }
            $count++;
        }

        set_transient( 'ojis_broadcast_result', [
            'sent'  => $sent_count,
            'fail'  => $fail_count,
            'total' => count( $active ),
        ], 60 );

        wp_safe_redirect( admin_url( 'admin.php?page=ojis-newsletter-broadcast&sent=1' ) );
        exit;
    }

    // Save SMTP settings
    if (
        isset( $_POST['ojis_save_smtp'], $_POST['_wpnonce_smtp'] ) &&
        wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_wpnonce_smtp'] ) ), 'ojis_save_smtp' )
    ) {
        $fields = [
            'ojis_smtp_host'       => 'sanitize_text_field',
            'ojis_smtp_port'       => 'absint',
            'ojis_smtp_user'       => 'sanitize_text_field',
            'ojis_smtp_from_email' => 'sanitize_email',
            'ojis_smtp_from_name'  => 'sanitize_text_field',
            'ojis_smtp_encryption' => 'sanitize_text_field',
            'ojis_smtp_auth'       => 'sanitize_text_field',
        ];
        foreach ( $fields as $key => $sanitizer ) {
            if ( isset( $_POST[ $key ] ) ) {
                update_option( $key, $sanitizer( $_POST[ $key ] ) );
            }
        }
        // Password stored separately (encrypted if available)
        if ( isset( $_POST['ojis_smtp_pass'] ) && $_POST['ojis_smtp_pass'] !== '••••••••' ) {
            update_option( 'ojis_smtp_pass', sanitize_text_field( $_POST['ojis_smtp_pass'] ) );
        }
        wp_safe_redirect( admin_url( 'admin.php?page=ojis-newsletter-smtp&saved=1' ) );
        exit;
    }
}
add_action( 'admin_init', 'ojis_newsletter_admin_actions' );

// ─── Unsubscribe handler (front-end) ──────────────────────────────────────────
function ojis_handle_unsubscribe() {
    if ( ! isset( $_GET['ojis_unsubscribe'] ) ) return;
    $email = sanitize_email( $_GET['email'] ?? '' );
    $token = sanitize_text_field( $_GET['token'] ?? '' );
    if ( is_email( $email ) && hash_equals( wp_hash( $email ), $token ) ) {
        $subscribers = get_option( 'ojis_newsletter_subscribers', [] );
        if ( isset( $subscribers[ $email ] ) ) {
            $subscribers[ $email ]['status'] = 'unsubscribed';
            update_option( 'ojis_newsletter_subscribers', $subscribers );
        }
        wp_die(
            '<p style="font-family:sans-serif;text-align:center;padding:2rem;">You have been unsubscribed. <a href="' . esc_url( home_url() ) . '">Return to site</a>.</p>',
            __( 'Unsubscribed', 'ojis-travels-theme' ),
            [ 'response' => 200 ]
        );
    }
}
add_action( 'init', 'ojis_handle_unsubscribe' );

// ─── SMTP: Hook into PHPMailer ─────────────────────────────────────────────────
function ojis_configure_smtp( $phpmailer ) {
    $host = get_option( 'ojis_smtp_host', '' );
    if ( empty( $host ) ) return; // only override if configured

    $phpmailer->isSMTP();
    $phpmailer->Host       = $host;
    $phpmailer->SMTPAuth   = (bool) get_option( 'ojis_smtp_auth', true );
    $phpmailer->Username   = get_option( 'ojis_smtp_user',  '' );
    $phpmailer->Password   = get_option( 'ojis_smtp_pass',  '' );
    $phpmailer->SMTPSecure = get_option( 'ojis_smtp_encryption', 'tls' ); // 'tls' or 'ssl'
    $phpmailer->Port       = (int) get_option( 'ojis_smtp_port', 587 );

    $from_email = get_option( 'ojis_smtp_from_email', get_option( 'admin_email' ) );
    $from_name  = get_option( 'ojis_smtp_from_name',  get_bloginfo( 'name' ) );
    if ( is_email( $from_email ) ) {
        $phpmailer->setFrom( $from_email, $from_name );
    }
}
add_action( 'phpmailer_init', 'ojis_configure_smtp' );

// ─── Admin styles for newsletter pages ────────────────────────────────────────
function ojis_admin_styles( $hook ) {
    if ( strpos( $hook, 'ojis-newsletter' ) === false ) return;
    wp_add_inline_style( 'wp-admin', '
        .ojis-admin-wrap { max-width: 1100px; }
        .ojis-admin-wrap h1 { display:flex; align-items:center; gap:8px; }
        .ojis-stat-cards { display:flex; gap:16px; flex-wrap:wrap; margin:16px 0 24px; }
        .ojis-stat-card { background:#fff; border:1px solid #ddd; border-radius:8px; padding:16px 24px; min-width:140px; }
        .ojis-stat-card .number { font-size:2rem; font-weight:700; color:#1B4D3E; line-height:1; }
        .ojis-stat-card .label  { font-size:12px; color:#666; margin-top:4px; }
        .ojis-table-wrap { background:#fff; border:1px solid #ddd; border-radius:8px; overflow:hidden; }
        .ojis-table-wrap table { border-collapse:collapse; width:100%; }
        .ojis-table-wrap th { background:#f6f7f7; padding:10px 16px; text-align:left; font-size:12px; text-transform:uppercase; letter-spacing:.05em; color:#555; border-bottom:1px solid #ddd; }
        .ojis-table-wrap td { padding:10px 16px; border-bottom:1px solid #f0f0f0; font-size:13px; vertical-align:middle; }
        .ojis-table-wrap tr:last-child td { border-bottom:none; }
        .ojis-table-wrap tr:hover td { background:#fafafa; }
        .ojis-badge { display:inline-block; padding:2px 10px; border-radius:20px; font-size:11px; font-weight:600; }
        .ojis-badge.active { background:#e6f9ed; color:#1B4D3E; }
        .ojis-badge.unsubscribed { background:#f5f5f5; color:#999; }
        .ojis-form-card { background:#fff; border:1px solid #ddd; border-radius:8px; padding:24px; max-width:640px; }
        .ojis-smtp-grid { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
        @media(max-width:600px){ .ojis-smtp-grid{grid-template-columns:1fr;} }
        .ojis-toolbar { display:flex; align-items:center; gap:12px; flex-wrap:wrap; margin-bottom:16px; }
        .ojis-toolbar input[type=search] { flex:1; min-width:200px; }
        .broadcast-editor { width:100%; min-height:280px; font-family:inherit; padding:12px; border:1px solid #ddd; border-radius:6px; font-size:14px; resize:vertical; }
    ' );
}
add_action( 'admin_enqueue_scripts', 'ojis_admin_styles' );

// ─── Newsletter Admin Page: Subscribers ───────────────────────────────────────
function ojis_newsletter_admin_page() {
    if ( ! current_user_can( 'manage_options' ) ) wp_die( __( 'Unauthorized', 'ojis-travels-theme' ) );

    $subscribers = get_option( 'ojis_newsletter_subscribers', [] );
    $total       = count( $subscribers );
    $active      = count( array_filter( $subscribers, fn( $s ) => ( $s['status'] ?? 'active' ) === 'active' ) );
    $unsub       = $total - $active;

    // Search filter
    $search = isset( $_GET['s'] ) ? sanitize_text_field( wp_unslash( $_GET['s'] ) ) : '';
    if ( $search ) {
        $subscribers = array_filter( $subscribers, fn( $s ) => stripos( $s['email'] ?? '', $search ) !== false );
    }

    // Notices
    foreach ( [
        'deleted'      => '<div class="notice notice-success is-dismissible"><p>Subscriber deleted.</p></div>',
        'bulk_deleted' => '<div class="notice notice-success is-dismissible"><p>Selected subscribers deleted.</p></div>',
        'added'        => '<div class="notice notice-success is-dismissible"><p>Subscriber added.</p></div>',
    ] as $key => $html ) {
        if ( isset( $_GET[ $key ] ) ) echo wp_kses_post( $html );
    }
    ?>
    <div class="wrap ojis-admin-wrap">
        <h1>
            <span class="dashicons dashicons-email-alt" style="font-size:28px;width:28px;height:28px;color:#1B4D3E;"></span>
            <?php esc_html_e( 'OJIS Newsletter — Subscribers', 'ojis-travels-theme' ); ?>
        </h1>

        <!-- Stat cards -->
        <div class="ojis-stat-cards">
            <div class="ojis-stat-card">
                <div class="number"><?php echo esc_html( $total ); ?></div>
                <div class="label"><?php esc_html_e( 'Total', 'ojis-travels-theme' ); ?></div>
            </div>
            <div class="ojis-stat-card">
                <div class="number" style="color:#2ECC71;"><?php echo esc_html( $active ); ?></div>
                <div class="label"><?php esc_html_e( 'Active', 'ojis-travels-theme' ); ?></div>
            </div>
            <div class="ojis-stat-card">
                <div class="number" style="color:#999;"><?php echo esc_html( $unsub ); ?></div>
                <div class="label"><?php esc_html_e( 'Unsubscribed', 'ojis-travels-theme' ); ?></div>
            </div>
        </div>

        <!-- Toolbar -->
        <div class="ojis-toolbar">
            <form method="get" style="display:flex;gap:8px;flex:1;">
                <input type="hidden" name="page" value="ojis-newsletter">
                <input type="search" name="s" value="<?php echo esc_attr( $search ); ?>" placeholder="<?php esc_attr_e( 'Search email…', 'ojis-travels-theme' ); ?>">
                <button type="submit" class="button"><?php esc_html_e( 'Search', 'ojis-travels-theme' ); ?></button>
            </form>
            <a href="<?php echo esc_url( wp_nonce_url( admin_url( 'admin.php?page=ojis-newsletter&ojis_action=export_csv' ), 'ojis_export_csv' ) ); ?>"
               class="button button-secondary">
                <span class="dashicons dashicons-download" style="vertical-align:middle;"></span>
                <?php esc_html_e( 'Export CSV', 'ojis-travels-theme' ); ?>
            </a>
        </div>

        <!-- Add subscriber -->
        <details style="margin-bottom:16px;">
            <summary style="cursor:pointer;font-weight:600;color:#1B4D3E;"><?php esc_html_e( '+ Add subscriber manually', 'ojis-travels-theme' ); ?></summary>
            <form method="post" style="display:flex;gap:8px;align-items:center;margin-top:12px;flex-wrap:wrap;">
                <?php wp_nonce_field( 'ojis_add_subscriber', '_wpnonce_add' ); ?>
                <input type="email" name="new_subscriber_email" required
                       placeholder="<?php esc_attr_e( 'email@example.com', 'ojis-travels-theme' ); ?>"
                       style="min-width:260px;">
                <button type="submit" name="ojis_add_subscriber" value="1" class="button button-primary">
                    <?php esc_html_e( 'Add Subscriber', 'ojis-travels-theme' ); ?>
                </button>
            </form>
        </details>

        <?php if ( empty( $subscribers ) ) : ?>
            <div class="ojis-form-card">
                <p><?php esc_html_e( 'No subscribers yet.', 'ojis-travels-theme' ); ?></p>
            </div>
        <?php else : ?>
        <!-- Bulk form -->
        <form method="post" id="subscribers-bulk-form">
            <?php wp_nonce_field( 'ojis_bulk_action', '_wpnonce_bulk' ); ?>
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px;">
                <select name="ojis_bulk_action">
                    <option value=""><?php esc_html_e( 'Bulk actions', 'ojis-travels-theme' ); ?></option>
                    <option value="delete"><?php esc_html_e( 'Delete selected', 'ojis-travels-theme' ); ?></option>
                </select>
                <button type="submit" class="button"
                    onclick="return confirm('<?php esc_attr_e( 'Delete selected subscribers?', 'ojis-travels-theme' ); ?>')">
                    <?php esc_html_e( 'Apply', 'ojis-travels-theme' ); ?>
                </button>
                <label style="margin-left:auto;font-size:12px;color:#666;">
                    <input type="checkbox" id="select-all-subs">
                    <?php esc_html_e( 'Select all', 'ojis-travels-theme' ); ?>
                </label>
            </div>
            <div class="ojis-table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th style="width:36px;"></th>
                            <th><?php esc_html_e( 'Email', 'ojis-travels-theme' ); ?></th>
                            <th><?php esc_html_e( 'Date Subscribed', 'ojis-travels-theme' ); ?></th>
                            <th><?php esc_html_e( 'Source', 'ojis-travels-theme' ); ?></th>
                            <th><?php esc_html_e( 'Status', 'ojis-travels-theme' ); ?></th>
                            <th><?php esc_html_e( 'Actions', 'ojis-travels-theme' ); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ( $subscribers as $sub ) :
                            $badge = ( ( $sub['status'] ?? 'active' ) === 'active' ) ? 'active' : 'unsubscribed';
                        ?>
                        <tr>
                            <td><input type="checkbox" name="subscriber_emails[]" value="<?php echo esc_attr( $sub['email'] ); ?>"></td>
                            <td><strong><?php echo esc_html( $sub['email'] ); ?></strong></td>
                            <td><?php echo esc_html( $sub['date'] ?: '—' ); ?></td>
                            <td><?php echo esc_html( ucfirst( $sub['source'] ?? '—' ) ); ?></td>
                            <td><span class="ojis-badge <?php echo esc_attr( $badge ); ?>"><?php echo esc_html( ucfirst( $sub['status'] ?? 'active' ) ); ?></span></td>
                            <td>
                                <a href="<?php echo esc_url( wp_nonce_url(
                                    admin_url( 'admin.php?page=ojis-newsletter&ojis_action=delete_subscriber&ojis_email=' . rawurlencode( $sub['email'] ) ),
                                    'ojis_delete_subscriber'
                                ) ); ?>"
                                   onclick="return confirm('<?php esc_attr_e( 'Delete this subscriber?', 'ojis-travels-theme' ); ?>')"
                                   class="button button-small">
                                    <?php esc_html_e( 'Delete', 'ojis-travels-theme' ); ?>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </form>
        <script>
        document.getElementById('select-all-subs').addEventListener('change',function(){
            document.querySelectorAll('#subscribers-bulk-form input[type=checkbox][name="subscriber_emails[]"]')
                .forEach(function(cb){ cb.checked = this.checked; }, this);
        });
        </script>
        <?php endif; ?>
    </div>
    <?php
}

// ─── Newsletter Admin Page: Broadcast ─────────────────────────────────────────
function ojis_newsletter_broadcast_page() {
    if ( ! current_user_can( 'manage_options' ) ) wp_die( __( 'Unauthorized', 'ojis-travels-theme' ) );

    $result = get_transient( 'ojis_broadcast_result' );
    if ( $result ) delete_transient( 'ojis_broadcast_result' );

    $subscribers  = get_option( 'ojis_newsletter_subscribers', [] );
    $active_count = count( array_filter( $subscribers, fn( $s ) => ( $s['status'] ?? 'active' ) === 'active' ) );
    $from_name    = get_option( 'ojis_smtp_from_name',  get_bloginfo( 'name' ) );
    $from_email   = get_option( 'ojis_smtp_from_email', get_option( 'admin_email' ) );
    ?>
    <div class="wrap ojis-admin-wrap">
        <h1>
            <span class="dashicons dashicons-megaphone" style="font-size:28px;width:28px;height:28px;color:#1B4D3E;"></span>
            <?php esc_html_e( 'Send Broadcast Email', 'ojis-travels-theme' ); ?>
        </h1>

        <?php if ( isset( $_GET['sent'] ) && $result ) : ?>
        <div class="notice notice-success is-dismissible">
            <p><?php printf(
                esc_html__( 'Broadcast sent. %d delivered, %d failed out of %d active subscribers.', 'ojis-travels-theme' ),
                (int) $result['sent'], (int) $result['fail'], (int) $result['total']
            ); ?></p>
        </div>
        <?php endif; ?>

        <?php if ( isset( $_GET['error'] ) ) : ?>
        <div class="notice notice-error"><p><?php esc_html_e( 'Subject and body are required.', 'ojis-travels-theme' ); ?></p></div>
        <?php endif; ?>

        <p style="color:#666;margin-bottom:20px;">
            <?php printf(
                esc_html__( 'This will send to %d active subscriber(s). From: %s <%s>. SMTP settings are configured under Newsletter > SMTP Settings.', 'ojis-travels-theme' ),
                $active_count,
                esc_html( $from_name ),
                esc_html( $from_email )
            ); ?>
        </p>

        <div class="ojis-form-card" style="max-width:720px;">
            <form method="post">
                <?php wp_nonce_field( 'ojis_send_broadcast', '_wpnonce_broadcast' ); ?>
                <table class="form-table">
                    <tr>
                        <th><label for="broadcast_subject"><?php esc_html_e( 'Subject', 'ojis-travels-theme' ); ?> <span style="color:red">*</span></label></th>
                        <td>
                            <input type="text" id="broadcast_subject" name="broadcast_subject"
                                   class="large-text" required
                                   placeholder="<?php esc_attr_e( 'Your email subject…', 'ojis-travels-theme' ); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th><label for="broadcast_body"><?php esc_html_e( 'Message (HTML allowed)', 'ojis-travels-theme' ); ?> <span style="color:red">*</span></label></th>
                        <td>
                            <textarea id="broadcast_body" name="broadcast_body"
                                      class="broadcast-editor" required
                                      placeholder="<?php esc_attr_e( 'Write your email content here… HTML is supported.', 'ojis-travels-theme' ); ?>"></textarea>
                            <p class="description"><?php esc_html_e( 'An unsubscribe link will be appended automatically to every email.', 'ojis-travels-theme' ); ?></p>
                        </td>
                    </tr>
                </table>
                <p>
                    <button type="submit" name="ojis_send_broadcast" value="1"
                            class="button button-primary button-large"
                            onclick="return confirm('<?php esc_attr_e( 'Send this broadcast to all active subscribers?', 'ojis-travels-theme' ); ?>')">
                        <span class="dashicons dashicons-email" style="vertical-align:middle;"></span>
                        <?php printf( esc_html__( 'Send to %d Subscribers', 'ojis-travels-theme' ), $active_count ); ?>
                    </button>
                </p>
            </form>
        </div>
    </div>
    <?php
}

// ─── Newsletter Admin Page: SMTP Settings ─────────────────────────────────────
function ojis_newsletter_smtp_page() {
    if ( ! current_user_can( 'manage_options' ) ) wp_die( __( 'Unauthorized', 'ojis-travels-theme' ) );
    ?>
    <div class="wrap ojis-admin-wrap">
        <h1>
            <span class="dashicons dashicons-admin-generic" style="font-size:28px;width:28px;height:28px;color:#1B4D3E;"></span>
            <?php esc_html_e( 'SMTP Configuration', 'ojis-travels-theme' ); ?>
        </h1>

        <?php if ( isset( $_GET['saved'] ) ) : ?>
        <div class="notice notice-success is-dismissible"><p><?php esc_html_e( 'SMTP settings saved.', 'ojis-travels-theme' ); ?></p></div>
        <?php endif; ?>

        <p style="color:#666;max-width:640px;margin-bottom:20px;">
            <?php esc_html_e( 'Configure your SMTP server below. WordPress will use these settings for all outgoing emails including newsletter broadcasts and contact form notifications. Install and activate a plugin like WP Mail SMTP if you prefer a GUI — these settings are picked up by this theme directly via PHPMailer.', 'ojis-travels-theme' ); ?>
        </p>

        <div class="ojis-form-card" style="max-width:680px;">
            <form method="post">
                <?php wp_nonce_field( 'ojis_save_smtp', '_wpnonce_smtp' ); ?>
                <div class="ojis-smtp-grid">
                    <div>
                        <label for="ojis_smtp_host"><strong><?php esc_html_e( 'SMTP Host', 'ojis-travels-theme' ); ?></strong></label><br>
                        <input type="text" id="ojis_smtp_host" name="ojis_smtp_host" class="large-text"
                               value="<?php echo esc_attr( get_option( 'ojis_smtp_host', '' ) ); ?>"
                               placeholder="smtp.gmail.com">
                    </div>
                    <div>
                        <label for="ojis_smtp_port"><strong><?php esc_html_e( 'SMTP Port', 'ojis-travels-theme' ); ?></strong></label><br>
                        <input type="number" id="ojis_smtp_port" name="ojis_smtp_port" class="small-text"
                               value="<?php echo esc_attr( get_option( 'ojis_smtp_port', 587 ) ); ?>"
                               placeholder="587">
                        <p class="description"><?php esc_html_e( '587 for TLS, 465 for SSL, 25 for none', 'ojis-travels-theme' ); ?></p>
                    </div>
                    <div>
                        <label for="ojis_smtp_encryption"><strong><?php esc_html_e( 'Encryption', 'ojis-travels-theme' ); ?></strong></label><br>
                        <select id="ojis_smtp_encryption" name="ojis_smtp_encryption">
                            <?php foreach ( [ 'tls' => 'TLS (recommended)', 'ssl' => 'SSL', '' => 'None' ] as $val => $label ) : ?>
                            <option value="<?php echo esc_attr( $val ); ?>"
                                <?php selected( get_option( 'ojis_smtp_encryption', 'tls' ), $val ); ?>>
                                <?php echo esc_html( $label ); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="ojis_smtp_auth"><strong><?php esc_html_e( 'Authentication', 'ojis-travels-theme' ); ?></strong></label><br>
                        <select id="ojis_smtp_auth" name="ojis_smtp_auth">
                            <option value="1" <?php selected( get_option( 'ojis_smtp_auth', '1' ), '1' ); ?>><?php esc_html_e( 'Yes (recommended)', 'ojis-travels-theme' ); ?></option>
                            <option value="0" <?php selected( get_option( 'ojis_smtp_auth', '1' ), '0' ); ?>><?php esc_html_e( 'No', 'ojis-travels-theme' ); ?></option>
                        </select>
                    </div>
                    <div>
                        <label for="ojis_smtp_user"><strong><?php esc_html_e( 'SMTP Username', 'ojis-travels-theme' ); ?></strong></label><br>
                        <input type="text" id="ojis_smtp_user" name="ojis_smtp_user" class="large-text"
                               value="<?php echo esc_attr( get_option( 'ojis_smtp_user', '' ) ); ?>"
                               autocomplete="off"
                               placeholder="your@email.com">
                    </div>
                    <div>
                        <label for="ojis_smtp_pass"><strong><?php esc_html_e( 'SMTP Password / App Password', 'ojis-travels-theme' ); ?></strong></label><br>
                        <input type="password" id="ojis_smtp_pass" name="ojis_smtp_pass" class="large-text"
                               value="<?php echo esc_attr( get_option( 'ojis_smtp_pass', '' ) ? '••••••••' : '' ); ?>"
                               autocomplete="new-password"
                               placeholder="<?php esc_attr_e( 'Leave blank to keep existing', 'ojis-travels-theme' ); ?>">
                        <p class="description"><?php esc_html_e( 'For Gmail, use an App Password, not your main password.', 'ojis-travels-theme' ); ?></p>
                    </div>
                    <div>
                        <label for="ojis_smtp_from_email"><strong><?php esc_html_e( 'From Email', 'ojis-travels-theme' ); ?></strong></label><br>
                        <input type="email" id="ojis_smtp_from_email" name="ojis_smtp_from_email" class="large-text"
                               value="<?php echo esc_attr( get_option( 'ojis_smtp_from_email', get_option( 'admin_email' ) ) ); ?>">
                    </div>
                    <div>
                        <label for="ojis_smtp_from_name"><strong><?php esc_html_e( 'From Name', 'ojis-travels-theme' ); ?></strong></label><br>
                        <input type="text" id="ojis_smtp_from_name" name="ojis_smtp_from_name" class="large-text"
                               value="<?php echo esc_attr( get_option( 'ojis_smtp_from_name', get_bloginfo( 'name' ) ) ); ?>">
                    </div>
                </div>

                <hr style="margin:20px 0;border:none;border-top:1px solid #eee;">
                <p>
                    <button type="submit" name="ojis_save_smtp" value="1" class="button button-primary button-large">
                        <?php esc_html_e( 'Save SMTP Settings', 'ojis-travels-theme' ); ?>
                    </button>
                    <a href="<?php echo esc_url( admin_url( 'admin.php?page=ojis-newsletter-smtp&ojis_test_smtp=1' ) ); ?>"
                       class="button button-secondary button-large" style="margin-left:8px;">
                        <?php esc_html_e( 'Send Test Email', 'ojis-travels-theme' ); ?>
                    </a>
                </p>
                <p class="description" style="margin-top:8px;">
                    <?php printf(
                        esc_html__( 'Test email will be sent to %s', 'ojis-travels-theme' ),
                        '<strong>' . esc_html( get_option( 'admin_email' ) ) . '</strong>'
                    ); ?>
                </p>
            </form>
        </div>

        <!-- Quick provider guide -->
        <div style="margin-top:32px;max-width:680px;">
            <h3><?php esc_html_e( 'Common SMTP Providers', 'ojis-travels-theme' ); ?></h3>
            <table class="widefat striped" style="font-size:13px;">
                <thead><tr>
                    <th><?php esc_html_e( 'Provider', 'ojis-travels-theme' ); ?></th>
                    <th><?php esc_html_e( 'Host', 'ojis-travels-theme' ); ?></th>
                    <th><?php esc_html_e( 'Port', 'ojis-travels-theme' ); ?></th>
                    <th><?php esc_html_e( 'Encryption', 'ojis-travels-theme' ); ?></th>
                    <th><?php esc_html_e( 'Note', 'ojis-travels-theme' ); ?></th>
                </tr></thead>
                <tbody>
                    <?php foreach ( [
                        [ 'Gmail',      'smtp.gmail.com',        587, 'TLS', 'Requires App Password (2FA must be on)' ],
                        [ 'Outlook',    'smtp.office365.com',    587, 'TLS', 'Use your Microsoft 365 credentials' ],
                        [ 'Zoho Mail',  'smtp.zoho.com',         587, 'TLS', 'Zoho Mail free tier works' ],
                        [ 'SendGrid',   'smtp.sendgrid.net',     587, 'TLS', 'Use API key as password' ],
                        [ 'Mailgun',    'smtp.mailgun.org',      587, 'TLS', 'SMTP credentials from Mailgun dashboard' ],
                        [ 'Brevo',      'smtp-relay.brevo.com',  587, 'TLS', 'Free tier: 300 emails/day' ],
                    ] as $r ) : ?>
                    <tr>
                        <td><strong><?php echo esc_html( $r[0] ); ?></strong></td>
                        <td><code><?php echo esc_html( $r[1] ); ?></code></td>
                        <td><?php echo esc_html( $r[2] ); ?></td>
                        <td><?php echo esc_html( $r[3] ); ?></td>
                        <td style="color:#666;"><?php echo esc_html( $r[4] ); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}

// ─── SMTP test email ───────────────────────────────────────────────────────────
function ojis_smtp_test_email() {
    if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) return;
    if ( ! isset( $_GET['ojis_test_smtp'] ) ) return;

    $to      = get_option( 'admin_email' );
    $subject = '[' . get_bloginfo( 'name' ) . '] SMTP Test';
    $body    = '<p>This is a test email sent from your OJIS Travels theme SMTP configuration.</p><p>If you received this, your SMTP is working correctly.</p>';
    $headers = [ 'Content-Type: text/html; charset=UTF-8' ];
    $sent    = wp_mail( $to, $subject, $body, $headers );

    wp_safe_redirect( admin_url( 'admin.php?page=ojis-newsletter-smtp&test_sent=' . ( $sent ? '1' : '0' ) ) );
    exit;
}
add_action( 'admin_init', 'ojis_smtp_test_email' );

// ─── Full Customizer Registration ─────────────────────────────────────────────
function ojis_customizer_settings( $wp_customize ) {

    // ══ Helper: register setting + control in one call ══════════════════
    // Usage: ojis_add_setting( $wp_customize, $id, $default, $sanitizer, $section, $label, $type, $extra )
    $r = function( $id, $default, $san, $section, $label, $type = 'text', $extra = [] ) use ( $wp_customize ) {
        $wp_customize->add_setting( $id, [
            'default'           => $default,
            'sanitize_callback' => $san,
            'transport'         => 'refresh',
        ] );
        $control_args = array_merge( [
            'label'   => $label,
            'section' => $section,
            'type'    => $type,
        ], $extra );
        $wp_customize->add_control( $id, $control_args );
    };

    // ══════════════════════════════════════════════════════════════════════
    // PANEL 1 — BRAND & DESIGN
    // ══════════════════════════════════════════════════════════════════════
    $wp_customize->add_panel( 'ojis_brand_panel', [
        'title'    => __( 'OJIS Brand & Design', 'ojis-travels-theme' ),
        'priority' => 28,
    ] );

    // ── Section: Header Logos ─────────────────────────────────────────────
    // Allows independent control of the transparent-state and scrolled-state logos.
    $wp_customize->add_section( 'ojis_header_logos', [
        'title'       => __( 'Header Logos', 'ojis-travels-theme' ),
        'description' => __( 'Set separate logos for the transparent header (over the hero) and the scrolled header (white backdrop). Changes take effect on page reload.', 'ojis-travels-theme' ),
        'panel'       => 'ojis_brand_panel',
        'priority'    => 5,
    ] );

    // Logo for transparent state (light/white version)
    $wp_customize->add_setting( 'ojis_logo_transparent', [
        'default'           => OJIS_THEME_URI . '/assets/images/OJIS-Travels-Advisory-Logo-Light.png',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ojis_logo_transparent', [
        'label'       => __( 'Transparent Header Logo', 'ojis-travels-theme' ),
        'description' => __( 'Shown when the header is over the hero (dark background). Use a light/white version of your logo.', 'ojis-travels-theme' ),
        'section'     => 'ojis_header_logos',
    ] ) );

    // Logo for scrolled state (colour/dark version)
    $wp_customize->add_setting( 'ojis_logo_scrolled', [
        'default'           => OJIS_THEME_URI . '/assets/images/OJIS-Travels-Advisory-Logo.webp',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ojis_logo_scrolled', [
        'label'       => __( 'Scrolled Header Logo', 'ojis-travels-theme' ),
        'description' => __( 'Shown when the header has scrolled down and the white glass backdrop is visible. Use your full-colour logo.', 'ojis-travels-theme' ),
        'section'     => 'ojis_header_logos',
    ] ) );

    // Logo height
    $wp_customize->add_setting( 'ojis_logo_height', [
        'default'           => '40',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( 'ojis_logo_height', [
        'label'       => __( 'Logo Height (px)', 'ojis-travels-theme' ),
        'description' => __( 'Height for both logos on desktop. Mobile uses a slightly smaller size automatically.', 'ojis-travels-theme' ),
        'section'     => 'ojis_header_logos',
        'type'        => 'number',
        'input_attrs' => [ 'min' => 24, 'max' => 80, 'step' => 2 ],
    ] );

    // ── Section: Colors ──────────────────────────────────────────────────
    $wp_customize->add_section( 'ojis_colors', [
        'title' => __( 'Colors', 'ojis-travels-theme' ),
        'panel' => 'ojis_brand_panel',
    ] );

    foreach ( [
        [ 'ojis_color_forest',   '#1B4D3E', __( 'Primary Forest Green', 'ojis-travels-theme' ) ],
        [ 'ojis_color_eco',      '#2ECC71', __( 'Accent Eco Green',     'ojis-travels-theme' ) ],
        [ 'ojis_color_eco_alt',  '#40C057', __( 'Accent Eco Alt',       'ojis-travels-theme' ) ],
        [ 'ojis_color_charcoal', '#1A211E', __( 'Charcoal / Dark',      'ojis-travels-theme' ) ],
        [ 'ojis_color_offwhite', '#F9FBF9', __( 'Background Off-White', 'ojis-travels-theme' ) ],
        [ 'ojis_color_muted',    '#6B7280', __( 'Muted Gray Text',      'ojis-travels-theme' ) ],
    ] as [$id, $default, $label] ) {
        $wp_customize->add_setting( $id, [
            'default'           => $default,
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'refresh',
        ] );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, [
            'label'   => $label,
            'section' => 'ojis_colors',
        ] ) );
    }

    // ── Section: Typography ──────────────────────────────────────────────
    $wp_customize->add_section( 'ojis_typography', [
        'title' => __( 'Typography', 'ojis-travels-theme' ),
        'panel' => 'ojis_brand_panel',
    ] );

    $wp_customize->add_setting( 'ojis_font_body', [
        'default'           => 'Plus Jakarta Sans',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( 'ojis_font_body', [
        'label'       => __( 'Body Font Family', 'ojis-travels-theme' ),
        'section'     => 'ojis_typography',
        'type'        => 'select',
        'choices'     => [
            'Plus Jakarta Sans' => 'Plus Jakarta Sans (Default)',
            'Inter'             => 'Inter',
            'Lato'              => 'Lato',
            'Open Sans'         => 'Open Sans',
            'Nunito'            => 'Nunito',
            'DM Sans'           => 'DM Sans',
            'Poppins'           => 'Poppins',
        ],
    ] );

    $wp_customize->add_setting( 'ojis_font_size_base', [
        'default'           => '16',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( 'ojis_font_size_base', [
        'label'       => __( 'Base Font Size (px)', 'ojis-travels-theme' ),
        'section'     => 'ojis_typography',
        'type'        => 'number',
        'input_attrs' => [ 'min' => 14, 'max' => 20, 'step' => 1 ],
    ] );

    // ── Section: Site Identity extras (footer tagline, contact, social) ─
    $wp_customize->add_section( 'ojis_site_identity', [
        'title'       => __( 'Social Media & Contact', 'ojis-travels-theme' ),
        'description' => __( 'Set your social media profile URLs and contact details. These appear in the footer and wherever social links are shown across the site.', 'ojis-travels-theme' ),
        'panel'       => 'ojis_brand_panel',
        'priority'    => 15,
    ] );

    $r( 'ojis_footer_tagline', 'Making sustainable tourism and hospitality practical, relevant, and accessible across Africa and beyond.',
        'sanitize_textarea_field', 'ojis_site_identity', __( 'Footer Brand Tagline', 'ojis-travels-theme' ), 'textarea' );

    $r( 'ojis_footer_email', 'info@ojistravels.com',
        'sanitize_email', 'ojis_site_identity', __( 'Contact Email', 'ojis-travels-theme' ) );

    $r( 'ojis_footer_location', 'Africa & Beyond',
        'sanitize_text_field', 'ojis_site_identity', __( 'Location Text', 'ojis-travels-theme' ) );

    // ── Social Media URLs ─────────────────────────────────────────────
    // These control the social icons in the footer and any social widget.
    $social_fields = [
        [ 'ojis_social_instagram', 'https://www.instagram.com/ojistravels_advisory',               __( 'Instagram URL',       'ojis-travels-theme' ) ],
        [ 'ojis_social_linkedin',  'https://www.linkedin.com/company/ojis-travels-advisory',        __( 'LinkedIn URL',        'ojis-travels-theme' ) ],
        [ 'ojis_social_facebook',  'https://web.facebook.com/profile.php?id=61591486179942',         __( 'Facebook URL',        'ojis-travels-theme' ) ],
        [ 'ojis_social_tiktok',    'https://www.tiktok.com/@ojistravels1',                           __( 'TikTok URL',          'ojis-travels-theme' ) ],
        [ 'ojis_social_twitter',   '',                                                               __( 'X (Twitter) URL',    'ojis-travels-theme' ) ],
        [ 'ojis_social_youtube',   '',                                                               __( 'YouTube URL',        'ojis-travels-theme' ) ],
        [ 'ojis_social_website',   'https://ojistravels.com',                                        __( 'Website / External', 'ojis-travels-theme' ) ],
    ];

    foreach ( $social_fields as [$setting_id, $default, $label] ) {
        $wp_customize->add_setting( $setting_id, [
            'default'           => $default,
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ] );
        $wp_customize->add_control( $setting_id, [
            'label'       => $label,
            'section'     => 'ojis_site_identity',
            'type'        => 'url',
            'description' => __( 'Leave blank to hide this icon.', 'ojis-travels-theme' ),
        ] );
    }

    // ══════════════════════════════════════════════════════════════════════
    // PANEL 2 — HOMEPAGE
    // ══════════════════════════════════════════════════════════════════════
    $wp_customize->add_panel( 'ojis_homepage_panel', [
        'title'    => __( 'Homepage', 'ojis-travels-theme' ),
        'priority' => 30,
    ] );

    // ── Section: Hero ────────────────────────────────────────────────────
    $wp_customize->add_section( 'ojis_hero_section', [
        'title' => __( 'Hero Section', 'ojis-travels-theme' ),
        'panel' => 'ojis_homepage_panel',
    ] );

    $wp_customize->add_setting( 'ojis_hero_bg', [
        'default'           => OJIS_THEME_URI . '/assets/images/hero.webp',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ojis_hero_bg', [
        'label'   => __( 'Hero Background Image', 'ojis-travels-theme' ),
        'section' => 'ojis_hero_section',
    ] ) );

    $r( 'ojis_hero_badge', 'Sustainable Travel & Hospitality',
        'sanitize_text_field', 'ojis_hero_section', __( 'Hero Badge Text', 'ojis-travels-theme' ) );

    $r( 'ojis_hero_headline', 'Making Sustainable Travel & Hospitality Practical, Relevant, and Accessible.',
        'sanitize_text_field', 'ojis_hero_section', __( 'Hero Headline', 'ojis-travels-theme' ), 'textarea' );

    $r( 'ojis_hero_sub', 'Empowering travellers and hospitality businesses across Africa to make informed choices and take meaningful action.',
        'sanitize_text_field', 'ojis_hero_section', __( 'Hero Subheadline', 'ojis-travels-theme' ), 'textarea' );

    $r( 'ojis_hero_cta_primary', 'Explore Our Services',
        'sanitize_text_field', 'ojis_hero_section', __( 'Primary CTA Label', 'ojis-travels-theme' ) );

    $r( 'ojis_hero_cta_secondary', 'Read Our Story',
        'sanitize_text_field', 'ojis_hero_section', __( 'Secondary CTA Label', 'ojis-travels-theme' ) );

    // ── Section: Pillars ─────────────────────────────────────────────────
    $wp_customize->add_section( 'ojis_pillars_section', [
        'title' => __( 'Core Pillars Section', 'ojis-travels-theme' ),
        'panel' => 'ojis_homepage_panel',
    ] );

    $r( 'ojis_pillars_heading', 'Our Three Core Pillars',
        'sanitize_text_field', 'ojis_pillars_section', __( 'Section Heading', 'ojis-travels-theme' ) );

    $r( 'ojis_pillars_sub', 'Every service we offer is grounded in these foundational commitments to people, planet, and purpose.',
        'sanitize_textarea_field', 'ojis_pillars_section', __( 'Section Subtext', 'ojis-travels-theme' ), 'textarea' );

    foreach ( range( 1, 3 ) as $n ) {
        $defaults = [
            1 => [ 'Education & Awareness',  'Equipping travellers and businesses with practical, actionable knowledge on sustainability.' ],
            2 => [ 'Responsible Solutions',   'Curating travel options and hospitality practices that genuinely respect people, cultures, and ecosystems.' ],
            3 => [ 'Professional Advisory',   'Guiding African hospitality brands toward long-term resilience and value creation.' ],
        ];
        $r( "ojis_pillar_{$n}_title", $defaults[$n][0],
            'sanitize_text_field', 'ojis_pillars_section', sprintf( __( 'Pillar %d Title', 'ojis-travels-theme' ), $n ) );
        $r( "ojis_pillar_{$n}_text", $defaults[$n][1],
            'sanitize_textarea_field', 'ojis_pillars_section', sprintf( __( 'Pillar %d Text', 'ojis-travels-theme' ), $n ), 'textarea' );
    }

    // ── Section: Services Overview ───────────────────────────────────────
    $wp_customize->add_section( 'ojis_services_overview', [
        'title' => __( 'Services Overview (Homepage)', 'ojis-travels-theme' ),
        'panel' => 'ojis_homepage_panel',
    ] );

    $r( 'ojis_services_heading', 'Practical Solutions for Sustainable Growth',
        'sanitize_text_field', 'ojis_services_overview', __( 'Section Heading', 'ojis-travels-theme' ) );

    $r( 'ojis_services_sub', 'From helping travellers make responsible choices to guiding hospitality businesses toward lasting impact, our services bridge the gap between good intentions and meaningful action.',
        'sanitize_textarea_field', 'ojis_services_overview', __( 'Section Subtext', 'ojis-travels-theme' ), 'textarea' );

    // Services image
    $wp_customize->add_setting( 'ojis_services_image', [
        'default'           => OJIS_THEME_URI . '/assets/images/advisory.webp',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ojis_services_image', [
        'label'   => __( 'Services Section Image', 'ojis-travels-theme' ),
        'section' => 'ojis_services_overview',
    ] ) );

    // ── Section: Impact Counters ─────────────────────────────────────────
    $wp_customize->add_section( 'ojis_counters_section', [
        'title' => __( 'Impact Counters', 'ojis-travels-theme' ),
        'panel' => 'ojis_homepage_panel',
    ] );

    $r( 'ojis_counters_heading', 'Progress Over Perfection',
        'sanitize_text_field', 'ojis_counters_section', __( 'Section Heading', 'ojis-travels-theme' ) );

    foreach ( [
        [ 1, '3',    '+',  'Core Service Areas'       ],
        [ 2, '100',  '%',  'Africa-Focused Approach'  ],
        [ 3, '1',    '',   'GSTC Trained Founder'     ],
        [ 4, '2026', '',   'Year of Full Operations'  ],
    ] as [$n, $val, $suf, $lbl] ) {
        $r( "ojis_counter_{$n}_value",  $val, 'sanitize_text_field', 'ojis_counters_section', sprintf( __( 'Counter %d Value', 'ojis-travels-theme' ), $n ) );
        $r( "ojis_counter_{$n}_suffix", $suf, 'sanitize_text_field', 'ojis_counters_section', sprintf( __( 'Counter %d Suffix', 'ojis-travels-theme' ), $n ) );
        $r( "ojis_counter_{$n}_label",  $lbl, 'sanitize_text_field', 'ojis_counters_section', sprintf( __( 'Counter %d Label', 'ojis-travels-theme' ), $n ) );
    }

    // ── Section: Founder Excerpt (Homepage) ──────────────────────────────
    $wp_customize->add_section( 'ojis_founder_excerpt', [
        'title' => __( 'Founder Statement (Homepage)', 'ojis-travels-theme' ),
        'panel' => 'ojis_homepage_panel',
    ] );

    $r( 'ojis_founder_quote', 'I founded OJIS Travels & Advisory because I believe sustainability should be practical, relevant, and achievable. It should not be complicated or reserved for a select few. Our philosophy is simple: progress over perfection.',
        'sanitize_textarea_field', 'ojis_founder_excerpt', __( 'Founder Quote', 'ojis-travels-theme' ), 'textarea' );

    $r( 'ojis_founder_name', 'Omoaghe Jeffrey Edene',
        'sanitize_text_field', 'ojis_founder_excerpt', __( 'Founder Name', 'ojis-travels-theme' ) );

    $r( 'ojis_founder_title', 'Founder, OJIS Travels & Advisory',
        'sanitize_text_field', 'ojis_founder_excerpt', __( 'Founder Title', 'ojis-travels-theme' ) );

    // ── Section: Newsletter CTA ──────────────────────────────────────────
    $wp_customize->add_section( 'ojis_newsletter_cta', [
        'title' => __( 'Newsletter CTA', 'ojis-travels-theme' ),
        'panel' => 'ojis_homepage_panel',
    ] );

    $r( 'ojis_newsletter_heading', 'Join the Movement for Responsible Travel',
        'sanitize_text_field', 'ojis_newsletter_cta', __( 'CTA Heading', 'ojis-travels-theme' ) );

    $r( 'ojis_newsletter_sub', 'Get sustainable travel insights, hospitality industry updates, and practical tips delivered to your inbox.',
        'sanitize_textarea_field', 'ojis_newsletter_cta', __( 'CTA Subtext', 'ojis-travels-theme' ), 'textarea' );

    // ══════════════════════════════════════════════════════════════════════
    // PANEL 3 — INNER PAGE HEROES
    // ══════════════════════════════════════════════════════════════════════
    $wp_customize->add_panel( 'ojis_pages_panel', [
        'title'    => __( 'Inner Page Heroes', 'ojis-travels-theme' ),
        'priority' => 32,
    ] );

    $page_heroes = [
        [ 'ojis_about_hero_bg',    OJIS_THEME_URI . '/assets/images/about-hero.jpg',    __( 'About Us',  'ojis-travels-theme' ) ],
        [ 'ojis_services_hero_bg', OJIS_THEME_URI . '/assets/images/services-hero.jpg', __( 'Services',  'ojis-travels-theme' ) ],
        [ 'ojis_insights_hero_bg', OJIS_THEME_URI . '/assets/images/insights-hero.jpg', __( 'Insights',  'ojis-travels-theme' ) ],
        [ 'ojis_contact_hero_bg',  OJIS_THEME_URI . '/assets/images/contact-hero.jpg',  __( 'Contact',   'ojis-travels-theme' ) ],
    ];

    foreach ( $page_heroes as [$id, $default, $page_name] ) {
        $section_id = $id . '_section';
        $wp_customize->add_section( $section_id, [
            'title' => sprintf( __( '%s Page', 'ojis-travels-theme' ), $page_name ),
            'panel' => 'ojis_pages_panel',
        ] );
        $wp_customize->add_setting( $id, [
            'default'           => $default,
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ] );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $id, [
            'label'   => sprintf( __( '%s Hero Image', 'ojis-travels-theme' ), $page_name ),
            'section' => $section_id,
        ] ) );
        // Also allow page-level headline overrides
        $r( $id . '_headline', '', 'sanitize_text_field', $section_id,
            sprintf( __( '%s Page Headline (leave blank for default)', 'ojis-travels-theme' ), $page_name ), 'text' );
        $r( $id . '_sub', '', 'sanitize_textarea_field', $section_id,
            sprintf( __( '%s Page Subheadline (leave blank for default)', 'ojis-travels-theme' ), $page_name ), 'textarea' );
    }
}
add_action( 'customize_register', 'ojis_customizer_settings' );

// ─── Social Links Widget ───────────────────────────────────────────────────────
class OJIS_Social_Links_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'ojis_social_links',
            __( 'OJIS Social Links', 'ojis-travels-theme' ),
            [ 'description' => __( 'Displays social media icon links. URLs default to Customizer values if left blank.', 'ojis-travels-theme' ) ]
        );
    }

    public function widget( $args, $instance ) {
        $title = ! empty( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';

        $networks = [
            'website'   => [ 'icon' => 'public',       'label' => __( 'Website',   'ojis-travels-theme' ), 'target' => '_blank' ],
            'linkedin'  => [ 'icon' => 'share',        'label' => __( 'LinkedIn',  'ojis-travels-theme' ), 'target' => '_blank' ],
            'twitter'   => [ 'icon' => 'tag',          'label' => __( 'X/Twitter', 'ojis-travels-theme' ), 'target' => '_blank' ],
            'instagram' => [ 'icon' => 'photo_camera', 'label' => __( 'Instagram', 'ojis-travels-theme' ), 'target' => '_blank' ],
            'facebook'  => [ 'icon' => 'group',        'label' => __( 'Facebook',  'ojis-travels-theme' ), 'target' => '_blank' ],
            'youtube'   => [ 'icon' => 'play_circle',  'label' => __( 'YouTube',   'ojis-travels-theme' ), 'target' => '_blank' ],
            'tiktok'    => [ 'icon' => 'music_note',   'label' => __( 'TikTok',    'ojis-travels-theme' ), 'target' => '_blank' ],
            'email'     => [ 'icon' => 'mail',         'label' => __( 'Email',     'ojis-travels-theme' ), 'target' => '_self'  ],
        ];

        $social_urls = [
            'website'   => ! empty( $instance['url_website'] )   ? $instance['url_website']   : get_theme_mod( 'ojis_social_website',   'https://ojistravels.com' ),
            'linkedin'  => ! empty( $instance['url_linkedin'] )  ? $instance['url_linkedin']  : get_theme_mod( 'ojis_social_linkedin',  'https://www.linkedin.com/company/ojis-travels-advisory' ),
            'twitter'   => ! empty( $instance['url_twitter'] )   ? $instance['url_twitter']   : get_theme_mod( 'ojis_social_twitter',   '' ),
            'instagram' => ! empty( $instance['url_instagram'] ) ? $instance['url_instagram'] : get_theme_mod( 'ojis_social_instagram', 'https://www.instagram.com/ojistravels_advisory' ),
            'facebook'  => ! empty( $instance['url_facebook'] )  ? $instance['url_facebook']  : get_theme_mod( 'ojis_social_facebook',  'https://web.facebook.com/profile.php?id=61591486179942' ),
            'youtube'   => ! empty( $instance['url_youtube'] )   ? $instance['url_youtube']   : get_theme_mod( 'ojis_social_youtube',   '' ),
            'tiktok'    => ! empty( $instance['url_tiktok'] )    ? $instance['url_tiktok']    : get_theme_mod( 'ojis_social_tiktok',    'https://www.tiktok.com/@ojistravels1' ),
            'email'     => 'mailto:' . ( ! empty( $instance['url_email'] ) ? sanitize_email( $instance['url_email'] ) : get_theme_mod( 'ojis_footer_email', 'info@ojistravels.com' ) ),
        ];

        echo wp_kses_post( $args['before_widget'] );
        if ( $title ) {
            echo wp_kses_post( $args['before_title'] ) . esc_html( $title ) . wp_kses_post( $args['after_title'] );
        }

        echo '<div class="ojis-social-widget flex flex-wrap gap-3" role="list" aria-label="' . esc_attr__( 'Social media links', 'ojis-travels-theme' ) . '">';
        foreach ( $networks as $key => $net ) {
            $url = $social_urls[ $key ] ?? '';
            if ( empty( $url ) || $url === 'mailto:' ) continue;
            $blank = ( $net['target'] === '_blank' );
            echo '<a href="' . esc_url( $url ) . '"'
                . ( $blank ? ' target="_blank" rel="noopener noreferrer"' : '' )
                . ' class="footer-social-link widget-social-link"'
                . ' aria-label="' . esc_attr( $net['label'] ) . '" role="listitem">'
                . ojis_social_svg( $key ) // phpcs:ignore WordPress.Security.EscapeOutput
                . '</a>';
        }
        echo '</div>';
        echo wp_kses_post( $args['after_widget'] );
    }

    public function form( $instance ) {
        $title    = $instance['title'] ?? __( 'Follow Us', 'ojis-travels-theme' );
        $networks = [ 'website', 'linkedin', 'twitter', 'instagram', 'facebook', 'youtube', 'tiktok', 'email' ];
        $labels   = [
            'website'   => 'Website URL', 'linkedin'  => 'LinkedIn URL',
            'twitter'   => 'X (Twitter) URL', 'instagram' => 'Instagram URL',
            'facebook'  => 'Facebook URL', 'youtube' => 'YouTube URL',
            'tiktok'    => 'TikTok URL',   'email'   => 'Email Address',
        ];
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'ojis-travels-theme' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
                   type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p style="color:#666;font-size:11px;">
            <?php esc_html_e( 'Leave blank to use values from Customize > OJIS Brand & Design > Footer & Identity.', 'ojis-travels-theme' ); ?>
        </p>
        <?php foreach ( $networks as $net ) :
            $val = $instance[ 'url_' . $net ] ?? ''; ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'url_' . $net ) ); ?>"><?php echo esc_html( $labels[ $net ] ); ?>:</label>
            <input class="widefat"
                   id="<?php echo esc_attr( $this->get_field_id( 'url_' . $net ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'url_' . $net ) ); ?>"
                   type="<?php echo $net === 'email' ? 'email' : 'url'; ?>"
                   value="<?php echo esc_attr( $val ); ?>">
        </p>
        <?php endforeach;
    }

    public function update( $new_instance, $old_instance ) {
        $instance          = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] ?? '' );
        foreach ( [ 'website', 'linkedin', 'twitter', 'instagram', 'facebook', 'youtube', 'tiktok' ] as $net ) {
            $instance[ 'url_' . $net ] = esc_url_raw( $new_instance[ 'url_' . $net ] ?? '' );
        }
        $instance['url_email'] = sanitize_email( $new_instance['url_email'] ?? '' );
        return $instance;
    }
}

function ojis_register_social_widget() {
    register_widget( 'OJIS_Social_Links_Widget' );
    // Dedicated sidebar for the social widget
    register_sidebar( [
        'name'          => __( 'Social Links Bar', 'ojis-travels-theme' ),
        'id'            => 'social-links-bar',
        'description'   => __( 'Place the OJIS Social Links widget here.', 'ojis-travels-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title text-sm font-semibold text-muted mb-3">',
        'after_title'   => '</h4>',
    ] );
}
add_action( 'widgets_init', 'ojis_register_social_widget' );

// ─── Custom Page Templates Registration ───────────────────────────────────────
function ojis_page_templates( $templates ) {
    $templates['page-about.php']    = __( 'About Us',           'ojis-travels-theme' );
    $templates['page-services.php'] = __( 'Services',           'ojis-travels-theme' );
    $templates['page-insights.php'] = __( 'Insights / Blog',    'ojis-travels-theme' );
    $templates['page-contact.php']  = __( 'Contact / Advisory', 'ojis-travels-theme' );
    return $templates;
}
add_filter( 'theme_page_templates', 'ojis_page_templates' );

// ─── Body Classes ──────────────────────────────────────────────────────────────
function ojis_body_classes( $classes ) {
    if ( ! is_singular() ) $classes[] = 'hentry';
    $classes[] = 'ojis-theme';
    return $classes;
}
add_filter( 'body_class', 'ojis_body_classes' );

// ─── Security ─────────────────────────────────────────────────────────────────
remove_action( 'wp_head', 'wp_generator' );
