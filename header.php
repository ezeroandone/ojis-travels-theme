<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?>
</head>

<body <?php body_class( 'font-sans bg-offwhite text-charcoal antialiased' ); ?>>
<?php wp_body_open(); ?>

<a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-[9999] focus:px-4 focus:py-2 focus:bg-forest focus:text-white focus:rounded-lg focus:text-sm focus:font-semibold">
    <?php esc_html_e( 'Skip to main content', 'ojis-travels-theme' ); ?>
</a>

<!-- ═══════════════════════════════════════════════════════
     SITE HEADER — Sticky, Glassmorphism
════════════════════════════════════════════════════════ -->
<header
    id="site-header"
    class="site-header fixed top-0 left-0 right-0 z-50 transition-all duration-300"
    role="banner"
>
    <!-- Glassmorphism backdrop layer -->
    <div
        id="header-backdrop"
        class="absolute inset-0 bg-white/90 backdrop-blur-md border-b border-white/20 shadow-sm opacity-0 transition-opacity duration-300"
        aria-hidden="true"
    ></div>

    <nav
        class="relative max-w-7xl mx-auto px-4 sm:px-6 h-16 sm:h-20 flex items-center"
        role="navigation"
        aria-label="<?php esc_attr_e( 'Primary Navigation', 'ojis-travels-theme' ); ?>"
    >
        <!-- ── Dual Logo: transparent (light) + scrolled (colour) ── -->
        <a
            href="<?php echo esc_url( home_url( '/' ) ); ?>"
            class="site-logo-link flex-shrink-0 group focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 rounded-lg"
            aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) . ' — ' . esc_html__( 'Return to homepage', 'ojis-travels-theme' ) ); ?>"
        >
            <?php
            // ── Determine logo URLs ─────────────────────────────────────────
            // Priority order for scrolled logo:
            //   1. ojis_logo_scrolled Customizer setting (our control)
            //   2. WordPress core custom_logo attachment URL
            //   3. Hardcoded fallback
            $logo_scrolled_default = OJIS_THEME_URI . '/assets/images/OJIS-Travels-Advisory-Logo.webp';

            // Check if WP core custom logo is set — use it as the scrolled default
            if ( has_custom_logo() ) {
                $custom_logo_id    = get_theme_mod( 'custom_logo' );
                $custom_logo_image = wp_get_attachment_image_src( $custom_logo_id, 'full' );
                if ( ! empty( $custom_logo_image[0] ) ) {
                    $logo_scrolled_default = $custom_logo_image[0];
                }
            }

            $logo_transparent = get_theme_mod(
                'ojis_logo_transparent',
                OJIS_THEME_URI . '/assets/images/OJIS-Travels-Advisory-Logo-Light.png'
            );
            $logo_scrolled = get_theme_mod( 'ojis_logo_scrolled', $logo_scrolled_default );
            $logo_height_px  = absint( get_theme_mod( 'ojis_logo_height', 40 ) );
            $logo_height_mob = max( 28, (int) round( $logo_height_px * 0.8 ) );
            ?>
            <!--
                Single <img id="site-logo-img">.
                JS swaps src between data-src-transparent and data-src-scrolled.
                Initial src is always the transparent (light) logo.
            -->
            <img
                id="site-logo-img"
                src="<?php echo esc_url( $logo_transparent ); ?>"
                data-src-transparent="<?php echo esc_url( $logo_transparent ); ?>"
                data-src-scrolled="<?php echo esc_url( $logo_scrolled ); ?>"
                alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
                class="site-logo-img"
                style="height:<?php echo esc_attr( $logo_height_mob ); ?>px; width:auto; display:block; object-fit:contain;"
                width="220"
                height="<?php echo esc_attr( $logo_height_px ); ?>"
                loading="eager"
                decoding="async"
            >
        </a>

        <!-- ── Desktop Navigation — centred spacer ───── -->
        <div class="hidden lg:flex flex-1 items-center justify-center gap-1" id="desktop-nav">
            <?php
            $menu_items = [
                [ 'label' => __( 'Home',     'ojis-travels-theme' ), 'url' => home_url( '/' ) ],
                [ 'label' => __( 'About Us', 'ojis-travels-theme' ), 'url' => home_url( '/about' ) ],
                [ 'label' => __( 'Services', 'ojis-travels-theme' ), 'url' => home_url( '/services' ) ],
                [ 'label' => __( 'Insights', 'ojis-travels-theme' ), 'url' => home_url( '/insights' ) ],
                [ 'label' => __( 'Contact',  'ojis-travels-theme' ), 'url' => home_url( '/contact' ) ],
            ];

            if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( [
                    'theme_location' => 'primary',
                    'menu_class'     => 'flex items-center gap-1',
                    'container'      => false,
                    'fallback_cb'    => false,
                    'items_wrap'     => '<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',
                ] );
            } else {
                echo '<ul class="flex items-center gap-1" role="menubar">';
                foreach ( $menu_items as $item ) {
                    $is_current   = ( trailingslashit( $item['url'] ) === trailingslashit( home_url( $_SERVER['REQUEST_URI'] ) ) );
                    $aria_current = $is_current ? ' aria-current="page"' : '';
                    $active_class = $is_current ? 'nav-link-item nav-link-active font-semibold' : 'nav-link-item';
                    printf(
                        '<li role="none"><a href="%s" class="nav-link nav-link-item relative px-4 py-2 text-sm font-medium %s transition-colors duration-200 rounded-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-1"%s>%s</a></li>',
                        esc_url( $item['url'] ),
                        esc_attr( $active_class ),
                        $aria_current,
                        esc_html( $item['label'] )
                    );
                }
                echo '</ul>';
            }
            ?>
        </div>

        <!-- ── Right-side actions (desktop CTA + mobile hamburger) ─── -->
        <!-- ml-auto pushes this group to the far right on ALL screen sizes.
             On mobile only the hamburger button is visible inside this group. -->
        <div class="ml-auto flex items-center gap-2 sm:gap-3">

            <!-- Desktop CTA — hidden below lg -->
            <a
                href="<?php echo esc_url( home_url( '/contact' ) ); ?>"
                class="header-cta-btn hidden lg:inline-flex items-center gap-2 text-sm"
                aria-label="<?php esc_attr_e( 'Book an Advisory Consultation', 'ojis-travels-theme' ); ?>"
            >
                <span class="material-symbols-outlined text-base" aria-hidden="true">calendar_month</span>
                <?php esc_html_e( 'Book a Consultation', 'ojis-travels-theme' ); ?>
            </a>

            <!-- Mobile hamburger — hidden at lg and above -->
            <button
                id="mobile-menu-toggle"
                class="header-mobile-toggle lg:hidden flex items-center justify-center w-10 h-10 rounded-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-white transition-colors duration-200"
                aria-expanded="false"
                aria-controls="mobile-menu"
                aria-label="<?php esc_attr_e( 'Open navigation menu', 'ojis-travels-theme' ); ?>"
            >
                <span class="material-symbols-outlined text-2xl menu-icon" aria-hidden="true">menu</span>
                <span class="material-symbols-outlined text-2xl close-icon hidden" aria-hidden="true">close</span>
            </button>

        </div>
    </nav>

    <!-- ── Mobile Menu ────────────────────────────────── -->
    <div
        id="mobile-menu"
        class="mobile-menu lg:hidden hidden absolute top-full left-0 right-0 bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-xl"
        role="dialog"
        aria-modal="true"
        aria-label="<?php esc_attr_e( 'Mobile navigation', 'ojis-travels-theme' ); ?>"
    >
        <nav class="max-w-7xl mx-auto px-6 py-6" aria-label="<?php esc_attr_e( 'Mobile Navigation', 'ojis-travels-theme' ); ?>">
            <ul class="flex flex-col gap-1" role="menu">
                <?php
                $mobile_items = [
                    [ 'label' => __( 'Home',     'ojis-travels-theme' ), 'url' => home_url( '/' ),         'icon' => 'home' ],
                    [ 'label' => __( 'About Us', 'ojis-travels-theme' ), 'url' => home_url( '/about' ),    'icon' => 'info' ],
                    [ 'label' => __( 'Services', 'ojis-travels-theme' ), 'url' => home_url( '/services' ), 'icon' => 'eco' ],
                    [ 'label' => __( 'Insights', 'ojis-travels-theme' ), 'url' => home_url( '/insights' ), 'icon' => 'article' ],
                    [ 'label' => __( 'Contact',  'ojis-travels-theme' ), 'url' => home_url( '/contact' ),  'icon' => 'mail' ],
                ];
                foreach ( $mobile_items as $item ) :
                ?>
                <li role="none">
                    <a
                        href="<?php echo esc_url( $item['url'] ); ?>"
                        class="flex items-center gap-3 px-4 py-3 text-base font-medium text-charcoal hover:text-forest hover:bg-forest/5 rounded-xl transition-colors duration-200"
                        role="menuitem"
                    >
                        <span class="material-symbols-outlined text-xl text-forest" aria-hidden="true"><?php echo esc_html( $item['icon'] ); ?></span>
                        <?php echo esc_html( $item['label'] ); ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>

            <div class="mt-6 pt-6 border-t border-gray-100">
                <a
                    href="<?php echo esc_url( home_url( '/contact' ) ); ?>"
                    class="btn-primary w-full justify-center inline-flex items-center gap-2"
                >
                    <span class="material-symbols-outlined text-base" aria-hidden="true">calendar_month</span>
                    <?php esc_html_e( 'Book a Consultation', 'ojis-travels-theme' ); ?>
                </a>
            </div>
        </nav>
    </div>
</header>
<!-- /site-header -->
