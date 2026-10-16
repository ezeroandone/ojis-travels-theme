<?php
/**
 * Template Name: Privacy Policy
 *
 * @package ojis-travels-theme
 */

get_header(); ?>

<main id="main-content" class="site-main overflow-x-hidden">

    <!-- ═══════════════════════════════════════════════════════
         PAGE HERO
    ════════════════════════════════════════════════════════ -->
    <section class="page-hero relative overflow-hidden min-h-[280px] flex items-center bg-gradient-to-br from-charcoal to-forest" aria-label="<?php esc_attr_e( 'Privacy Policy page header', 'ojis-travels-theme' ); ?>">
        <div class="hero-pattern absolute inset-0 opacity-5" aria-hidden="true"></div>
        <div class="relative max-w-4xl mx-auto px-6 pt-36 pb-16 text-center w-full">
            <span class="section-eyebrow-light"><?php esc_html_e( 'Legal', 'ojis-travels-theme' ); ?></span>
            <h1 class="text-4xl sm:text-5xl font-bold text-white mt-3 mb-4 leading-tight">
                <?php esc_html_e( 'Privacy Policy', 'ojis-travels-theme' ); ?>
            </h1>
            <p class="text-white/60 text-sm">
                <?php esc_html_e( 'Last updated: January 2025', 'ojis-travels-theme' ); ?>
            </p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         CONTENT
    ════════════════════════════════════════════════════════ -->
    <section class="py-20 bg-offwhite" aria-labelledby="privacy-content-heading">
        <div class="max-w-3xl mx-auto px-6">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-10 lg:p-14 prose-ojis space-y-10">

                <div>
                    <h2 id="privacy-content-heading" class="text-2xl font-bold text-charcoal mb-4"><?php esc_html_e( 'Introduction', 'ojis-travels-theme' ); ?></h2>
                    <p class="text-muted leading-relaxed">
                        <?php esc_html_e( 'OJIS Travels & Advisory ("OJIS", "we", "our", or "us") is committed to protecting your personal information and your right to privacy. This Privacy Policy explains how we collect, use, and safeguard your information when you visit our website at ojistravels.com or engage with our services.', 'ojis-travels-theme' ); ?>
                    </p>
                    <p class="text-muted leading-relaxed mt-4">
                        <?php esc_html_e( 'Please read this policy carefully. If you disagree with its terms, please discontinue use of our site.', 'ojis-travels-theme' ); ?>
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-charcoal mb-4"><?php esc_html_e( 'Information We Collect', 'ojis-travels-theme' ); ?></h2>
                    <p class="text-muted leading-relaxed mb-3"><?php esc_html_e( 'We may collect information about you in the following ways:', 'ojis-travels-theme' ); ?></p>
                    <ul class="space-y-3 text-muted">
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-eco text-base mt-0.5 flex-shrink-0" aria-hidden="true">check_circle</span>
                            <span><strong class="text-charcoal"><?php esc_html_e( 'Information you provide directly', 'ojis-travels-theme' ); ?></strong> — <?php esc_html_e( 'such as your name, email address, and message when you complete a contact or inquiry form.', 'ojis-travels-theme' ); ?></span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-eco text-base mt-0.5 flex-shrink-0" aria-hidden="true">check_circle</span>
                            <span><strong class="text-charcoal"><?php esc_html_e( 'Newsletter subscriptions', 'ojis-travels-theme' ); ?></strong> — <?php esc_html_e( 'your email address when you subscribe to our updates or newsletter.', 'ojis-travels-theme' ); ?></span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-eco text-base mt-0.5 flex-shrink-0" aria-hidden="true">check_circle</span>
                            <span><strong class="text-charcoal"><?php esc_html_e( 'Usage data', 'ojis-travels-theme' ); ?></strong> — <?php esc_html_e( 'information automatically collected when you visit our site, including IP address, browser type, pages visited, and time spent on the site, through tools such as Google Analytics.', 'ojis-travels-theme' ); ?></span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-charcoal mb-4"><?php esc_html_e( 'How We Use Your Information', 'ojis-travels-theme' ); ?></h2>
                    <p class="text-muted leading-relaxed mb-3"><?php esc_html_e( 'We use the information we collect to:', 'ojis-travels-theme' ); ?></p>
                    <ul class="space-y-2 text-muted">
                        <?php foreach ( [
                            __( 'Respond to your inquiries and provide the services you have requested.', 'ojis-travels-theme' ),
                            __( 'Send you newsletters, updates, and relevant communications (only if you have opted in).', 'ojis-travels-theme' ),
                            __( 'Improve our website, services, and user experience.', 'ojis-travels-theme' ),
                            __( 'Comply with applicable legal obligations.', 'ojis-travels-theme' ),
                        ] as $item ) : ?>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-eco text-base mt-0.5 flex-shrink-0" aria-hidden="true">arrow_forward_ios</span>
                            <span><?php echo esc_html( $item ); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-charcoal mb-4"><?php esc_html_e( 'Cookies', 'ojis-travels-theme' ); ?></h2>
                    <p class="text-muted leading-relaxed">
                        <?php esc_html_e( 'Our website may use cookies and similar tracking technologies to improve your browsing experience and analyse site traffic. You can control the use of cookies through your browser settings. Disabling cookies may affect some functionality of the site.', 'ojis-travels-theme' ); ?>
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-charcoal mb-4"><?php esc_html_e( 'Third-Party Services', 'ojis-travels-theme' ); ?></h2>
                    <p class="text-muted leading-relaxed">
                        <?php esc_html_e( 'We may use third-party services such as Google Analytics to understand how visitors interact with our website. These services may collect information sent by your browser as part of a web request. Their use of this information is governed by their own privacy policies.', 'ojis-travels-theme' ); ?>
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-charcoal mb-4"><?php esc_html_e( 'Data Sharing & Disclosure', 'ojis-travels-theme' ); ?></h2>
                    <p class="text-muted leading-relaxed">
                        <?php esc_html_e( 'We do not sell, trade, or rent your personal information to third parties. We may share your information only where required by law, to protect our rights, or with trusted service providers who assist us in operating our website and conducting our business, subject to confidentiality agreements.', 'ojis-travels-theme' ); ?>
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-charcoal mb-4"><?php esc_html_e( 'Your Rights', 'ojis-travels-theme' ); ?></h2>
                    <p class="text-muted leading-relaxed mb-3"><?php esc_html_e( 'Depending on your location, you may have the right to:', 'ojis-travels-theme' ); ?></p>
                    <ul class="space-y-2 text-muted">
                        <?php foreach ( [
                            __( 'Access the personal information we hold about you.', 'ojis-travels-theme' ),
                            __( 'Request correction of inaccurate information.', 'ojis-travels-theme' ),
                            __( 'Request deletion of your personal data.', 'ojis-travels-theme' ),
                            __( 'Withdraw consent for communications at any time.', 'ojis-travels-theme' ),
                        ] as $right ) : ?>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-eco text-base mt-0.5 flex-shrink-0" aria-hidden="true">arrow_forward_ios</span>
                            <span><?php echo esc_html( $right ); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <p class="text-muted leading-relaxed mt-4">
                        <?php esc_html_e( 'To exercise any of these rights, please contact us at info@ojistravels.com.', 'ojis-travels-theme' ); ?>
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-charcoal mb-4"><?php esc_html_e( 'Data Security', 'ojis-travels-theme' ); ?></h2>
                    <p class="text-muted leading-relaxed">
                        <?php esc_html_e( 'We take reasonable measures to protect your personal information from unauthorised access, use, or disclosure. However, no method of transmission over the internet is completely secure, and we cannot guarantee absolute security.', 'ojis-travels-theme' ); ?>
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-charcoal mb-4"><?php esc_html_e( 'Changes to This Policy', 'ojis-travels-theme' ); ?></h2>
                    <p class="text-muted leading-relaxed">
                        <?php esc_html_e( 'We may update this Privacy Policy from time to time. Any changes will be posted on this page with an updated revision date. We encourage you to review this policy periodically.', 'ojis-travels-theme' ); ?>
                    </p>
                </div>

                <div class="border-t border-gray-100 pt-8">
                    <h2 class="text-2xl font-bold text-charcoal mb-4"><?php esc_html_e( 'Contact Us', 'ojis-travels-theme' ); ?></h2>
                    <p class="text-muted leading-relaxed">
                        <?php esc_html_e( 'If you have questions or concerns about this Privacy Policy, please contact us:', 'ojis-travels-theme' ); ?>
                    </p>
                    <div class="mt-4 flex flex-col gap-2 text-muted text-sm">
                        <p><strong class="text-charcoal"><?php esc_html_e( 'OJIS Travels & Advisory', 'ojis-travels-theme' ); ?></strong></p>
                        <p><?php esc_html_e( 'Email:', 'ojis-travels-theme' ); ?> <a href="mailto:info@ojistravels.com" class="text-forest hover:text-eco transition-colors duration-200">info@ojistravels.com</a></p>
                        <p><?php esc_html_e( 'Website:', 'ojis-travels-theme' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-forest hover:text-eco transition-colors duration-200">ojistravels.com</a></p>
                    </div>
                </div>

            </div>

            <div class="mt-8 text-center">
                <a href="<?php echo esc_url( home_url( '/terms' ) ); ?>" class="inline-flex items-center gap-2 text-sm text-forest font-semibold hover:text-eco-alt transition-colors duration-200">
                    <span class="material-symbols-outlined text-base" aria-hidden="true">gavel</span>
                    <?php esc_html_e( 'View Terms of Use', 'ojis-travels-theme' ); ?>
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
