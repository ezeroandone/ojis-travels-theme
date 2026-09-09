<!-- ═══════════════════════════════════════════════════════
     SITE FOOTER — 4-Column Dark Theme
════════════════════════════════════════════════════════ -->
<footer class="site-footer bg-charcoal text-white" role="contentinfo" aria-label="<?php esc_attr_e( 'Site Footer', 'ojis-travels-theme' ); ?>">

    <!-- ── Main Footer Grid ──────────────────────────── -->
    <div class="max-w-7xl mx-auto px-6 pt-20 pb-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8">

            <!-- Column 1: Brand ───────────────────── -->
            <div class="footer-brand lg:col-span-1 reveal-element">
                <a
                    href="<?php echo esc_url( home_url( '/' ) ); ?>"
                    class="inline-block mb-6 focus:outline-none focus-visible:ring-2 focus-visible:ring-eco rounded-lg"
                    aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) . ' — ' . esc_html__( 'Return to homepage', 'ojis-travels-theme' ) ); ?>"
                >
                    <img
                        src="<?php echo esc_url( OJIS_THEME_URI . '/assets/images/OJIS-Travels-Advisory-Logo-Light.png' ); ?>"
                        alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
                        class="h-10 w-auto object-contain"
                        width="180"
                        height="40"
                        loading="lazy"
                    >
                </a>

                <p class="text-gray-400 text-sm leading-relaxed mb-6 max-w-xs">
                    <?php echo esc_html( get_theme_mod( 'ojis_footer_tagline', __( 'Making sustainable tourism and hospitality practical, relevant, and accessible across Africa and beyond.', 'ojis-travels-theme' ) ) ); ?>
                </p>

                <!-- Social Links — Instagram, LinkedIn, Facebook, TikTok only (email shown in column 4) -->
                <div class="flex items-center flex-wrap gap-3 mt-2" role="list" aria-label="<?php esc_attr_e( 'Social media links', 'ojis-travels-theme' ); ?>">
                    <?php
                    // Email is intentionally excluded here — it appears in column 4 (Contact)
                    $social_items = [
                        [
                            'key'   => 'instagram',
                            'url'   => get_theme_mod( 'ojis_social_instagram', 'https://www.instagram.com/ojistravels_advisory' ),
                            'label' => __( 'OJIS Travels on Instagram', 'ojis-travels-theme' ),
                        ],
                        [
                            'key'   => 'linkedin',
                            'url'   => get_theme_mod( 'ojis_social_linkedin', 'https://www.linkedin.com/company/ojis-travels-advisory' ),
                            'label' => __( 'OJIS Travels on LinkedIn', 'ojis-travels-theme' ),
                        ],
                        [
                            'key'   => 'facebook',
                            'url'   => get_theme_mod( 'ojis_social_facebook', 'https://web.facebook.com/profile.php?id=61591486179942' ),
                            'label' => __( 'OJIS Travels on Facebook', 'ojis-travels-theme' ),
                        ],
                        [
                            'key'   => 'tiktok',
                            'url'   => get_theme_mod( 'ojis_social_tiktok', 'https://www.tiktok.com/@ojistravels1' ),
                            'label' => __( 'OJIS Travels on TikTok', 'ojis-travels-theme' ),
                        ],
                        [
                            'key'   => 'twitter',
                            'url'   => get_theme_mod( 'ojis_social_twitter', 'https://x.com/ojistravels?s=11' ),
                            'label' => __( 'OJIS Travels on X (Twitter)', 'ojis-travels-theme' ),
                        ],
                    ];

                    if ( ! function_exists( 'ojis_social_svg' ) ) {
                        require_once get_template_directory() . '/inc/social-icons.php';
                    }

                    foreach ( $social_items as $social ) :
                        $url = $social['url'] ?? '';
                        if ( empty( $url ) ) continue;
                    ?>
                    <a
                        href="<?php echo esc_url( $url ); ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="footer-social-link"
                        aria-label="<?php echo esc_attr( $social['label'] ); ?>"
                        role="listitem"
                    >
                        <?php echo ojis_social_svg( $social['key'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Column 2: Quick Links ─────────────── -->
            <div class="footer-links reveal-element">
                <h3 class="footer-col-heading">
                    <?php esc_html_e( 'Quick Links', 'ojis-travels-theme' ); ?>
                </h3>
                <nav aria-label="<?php esc_attr_e( 'Footer quick links', 'ojis-travels-theme' ); ?>">
                    <?php
                    if ( has_nav_menu( 'footer' ) ) {
                        wp_nav_menu( [
                            'theme_location' => 'footer',
                            'menu_class'     => 'flex flex-col gap-3',
                            'container'      => false,
                            'fallback_cb'    => false,
                            'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
                        ] );
                    } else {
                        $footer_links = [
                            [ 'label' => __( 'Home',     'ojis-travels-theme' ), 'url' => home_url( '/' ) ],
                            [ 'label' => __( 'About Us', 'ojis-travels-theme' ), 'url' => home_url( '/about' ) ],
                            [ 'label' => __( 'Services', 'ojis-travels-theme' ), 'url' => home_url( '/services' ) ],
                            [ 'label' => __( 'Insights', 'ojis-travels-theme' ), 'url' => home_url( '/insights' ) ],
                            [ 'label' => __( 'Contact',  'ojis-travels-theme' ), 'url' => home_url( '/contact' ) ],
                        ];
                        echo '<ul class="flex flex-col gap-3">';
                        foreach ( $footer_links as $link ) {
                            printf(
                                '<li><a href="%s" class="footer-link footer-arrow-link flex items-center gap-2"><span class="footer-arrow-icon material-symbols-outlined text-sm text-eco flex-shrink-0" aria-hidden="true">arrow_forward_ios</span>%s</a></li>',
                                esc_url( $link['url'] ),
                                esc_html( $link['label'] )
                            );
                        }
                        echo '</ul>';
                    }
                    ?>
                </nav>
            </div>

            <!-- Column 3: Services ────────────────── -->
            <div class="footer-services reveal-element">
                <h3 class="footer-col-heading">
                    <?php esc_html_e( 'Our Services', 'ojis-travels-theme' ); ?>
                </h3>
                <ul class="flex flex-col gap-3" role="list">
                    <?php
                    $services = [
                        __( 'Sustainable Travel Solutions', 'ojis-travels-theme' ),
                        __( 'Hospitality Advisory',         'ojis-travels-theme' ),
                        __( 'Corporate Training',           'ojis-travels-theme' ),
                        __( 'Impact Assessment',            'ojis-travels-theme' ),
                        __( 'Education & Advocacy',         'ojis-travels-theme' ),
                    ];
                    foreach ( $services as $service ) :
                    ?>
                    <li>
                        <a
                            href="<?php echo esc_url( home_url( '/services' ) ); ?>"
                            class="footer-link footer-arrow-link flex items-start gap-2"
                        >
                            <span class="footer-arrow-icon material-symbols-outlined text-sm text-eco mt-0.5 flex-shrink-0" aria-hidden="true">arrow_forward_ios</span>
                            <?php echo esc_html( $service ); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Column 4: Contact ─────────────────── -->
            <!-- Newsletter removed from footer (full newsletter CTA exists above the footer) -->
            <div class="footer-contact reveal-element">
                <h3 class="footer-col-heading">
                    <?php esc_html_e( 'Contact Us', 'ojis-travels-theme' ); ?>
                </h3>
                <p class="text-gray-400 text-sm mb-6 leading-relaxed">
                    <?php esc_html_e( 'We would love to hear from you. Reach out for advisory, travel planning, or any inquiry.', 'ojis-travels-theme' ); ?>
                </p>

                <?php $footer_email = get_theme_mod( 'ojis_footer_email', 'info@ojistravels.com' ); ?>

                <div class="flex flex-col gap-4">
                    <!-- Email -->
                    <a
                        href="mailto:<?php echo esc_attr( $footer_email ); ?>"
                        class="flex items-center gap-3 text-sm text-gray-300 hover:text-eco transition-colors duration-200 group"
                    >
                        <span class="flex-shrink-0 w-9 h-9 rounded-xl bg-white/8 border border-white/10 flex items-center justify-center group-hover:border-eco/40 transition-colors duration-200">
                            <span class="material-symbols-outlined text-eco text-base" aria-hidden="true">mail</span>
                        </span>
                        <span><?php echo esc_html( $footer_email ); ?></span>
                    </a>

                    <!-- Location -->
                    <div class="flex items-center gap-3 text-sm text-gray-400">
                        <span class="flex-shrink-0 w-9 h-9 rounded-xl bg-white/8 border border-white/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-eco text-base" aria-hidden="true">location_on</span>
                        </span>
                        <span><?php echo esc_html( get_theme_mod( 'ojis_footer_location', 'Africa & Beyond' ) ); ?></span>
                    </div>

                    <!-- Response time -->
                    <div class="flex items-center gap-3 text-sm text-gray-400">
                        <span class="flex-shrink-0 w-9 h-9 rounded-xl bg-white/8 border border-white/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-eco text-base" aria-hidden="true">schedule</span>
                        </span>
                        <span><?php esc_html_e( 'Response within 48 hours', 'ojis-travels-theme' ); ?></span>
                    </div>
                </div>

                <!-- Book a consultation CTA -->
                <a
                    href="<?php echo esc_url( home_url( '/contact' ) ); ?>"
                    class="inline-flex items-center gap-2 mt-6 text-sm font-semibold text-eco hover:text-white transition-colors duration-200"
                >
                    <?php esc_html_e( 'Book a Consultation', 'ojis-travels-theme' ); ?>
                    <span class="material-symbols-outlined text-base" aria-hidden="true">arrow_forward</span>
                </a>
            </div>

        </div>
    </div>

    <!-- ── Footer Bottom Bar ─────────────────────────── -->
    <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-6 py-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-gray-500 text-xs text-center sm:text-left">
                &copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.
                <?php esc_html_e( 'All rights reserved. Built with progress over perfection.', 'ojis-travels-theme' ); ?>
            </p>
            <div class="flex items-center gap-4">
                <a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>" class="text-gray-500 hover:text-gray-300 text-xs transition-colors duration-200">
                    <?php esc_html_e( 'Privacy Policy', 'ojis-travels-theme' ); ?>
                </a>
                <span class="text-gray-700" aria-hidden="true">&#183;</span>
                <a href="<?php echo esc_url( home_url( '/terms' ) ); ?>" class="text-gray-500 hover:text-gray-300 text-xs transition-colors duration-200">
                    <?php esc_html_e( 'Terms of Use', 'ojis-travels-theme' ); ?>
                </a>
            </div>
        </div>
    </div>

</footer>
<!-- /site-footer -->

<?php wp_footer(); ?>
</body>
</html>
