<?php
/**
 * Template Name: Terms of Use
 *
 * @package ojis-travels-theme
 */

get_header(); ?>

<main id="main-content" class="site-main overflow-x-hidden">

    <!-- ═══════════════════════════════════════════════════════
         PAGE HERO
    ════════════════════════════════════════════════════════ -->
    <section class="page-hero relative overflow-hidden min-h-[280px] flex items-center bg-gradient-to-br from-charcoal to-forest" aria-label="<?php esc_attr_e( 'Terms of Use page header', 'ojis-travels-theme' ); ?>">
        <div class="hero-pattern absolute inset-0 opacity-5" aria-hidden="true"></div>
        <div class="relative max-w-4xl mx-auto px-6 pt-36 pb-16 text-center w-full">
            <span class="section-eyebrow-light"><?php esc_html_e( 'Legal', 'ojis-travels-theme' ); ?></span>
            <h1 class="text-4xl sm:text-5xl font-bold text-white mt-3 mb-4 leading-tight">
                <?php esc_html_e( 'Terms of Use', 'ojis-travels-theme' ); ?>
            </h1>
            <p class="text-white/60 text-sm">
                <?php esc_html_e( 'Last updated: January 2025', 'ojis-travels-theme' ); ?>
            </p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         CONTENT
    ════════════════════════════════════════════════════════ -->
    <section class="py-20 bg-offwhite" aria-labelledby="terms-content-heading">
        <div class="max-w-3xl mx-auto px-6">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-10 lg:p-14 prose-ojis space-y-10">

                <div>
                    <h2 id="terms-content-heading" class="text-2xl font-bold text-charcoal mb-4"><?php esc_html_e( 'Agreement to Terms', 'ojis-travels-theme' ); ?></h2>
                    <p class="text-muted leading-relaxed">
                        <?php esc_html_e( 'By accessing or using the website at ojistravels.com, you agree to be bound by these Terms of Use. If you do not agree to these terms, please do not use our website.', 'ojis-travels-theme' ); ?>
                    </p>
                    <p class="text-muted leading-relaxed mt-4">
                        <?php esc_html_e( 'These terms apply to all visitors, users, and others who access or use the website of OJIS Travels & Advisory ("OJIS", "we", "our", or "us").', 'ojis-travels-theme' ); ?>
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-charcoal mb-4"><?php esc_html_e( 'Use of the Website', 'ojis-travels-theme' ); ?></h2>
                    <p class="text-muted leading-relaxed mb-3"><?php esc_html_e( 'You agree to use this website only for lawful purposes and in a manner that does not infringe the rights of others. You must not:', 'ojis-travels-theme' ); ?></p>
                    <ul class="space-y-2 text-muted">
                        <?php foreach ( [
                            __( 'Use the site in any way that violates applicable local, national, or international laws or regulations.', 'ojis-travels-theme' ),
                            __( 'Transmit any unsolicited or unauthorised advertising or promotional material.', 'ojis-travels-theme' ),
                            __( 'Attempt to gain unauthorised access to any part of the website or its related systems.', 'ojis-travels-theme' ),
                            __( 'Reproduce, duplicate, copy, or resell any part of our website content without prior written permission.', 'ojis-travels-theme' ),
                        ] as $item ) : ?>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-eco text-base mt-0.5 flex-shrink-0" aria-hidden="true">arrow_forward_ios</span>
                            <span><?php echo esc_html( $item ); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-charcoal mb-4"><?php esc_html_e( 'Intellectual Property', 'ojis-travels-theme' ); ?></h2>
                    <p class="text-muted leading-relaxed">
                        <?php esc_html_e( 'All content on this website — including text, images, graphics, logos, photographs, videos, and other materials — is the property of OJIS Travels & Advisory or its content creators and is protected by applicable intellectual property laws.', 'ojis-travels-theme' ); ?>
                    </p>
                    <p class="text-muted leading-relaxed mt-4">
                        <?php esc_html_e( 'You may not reproduce, distribute, modify, or create derivative works of any content without our prior written consent, except for personal, non-commercial use.', 'ojis-travels-theme' ); ?>
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-charcoal mb-4"><?php esc_html_e( 'Editorial Content & OJIS Perspectives', 'ojis-travels-theme' ); ?></h2>
                    <p class="text-muted leading-relaxed">
                        <?php esc_html_e( 'The articles, stories, and perspectives published on this website are provided for informational and editorial purposes only. They represent the views and editorial judgment of OJIS Travels & Advisory and do not constitute professional advice. Whilst we aim to ensure accuracy, we make no warranties about the completeness or reliability of any information published.', 'ojis-travels-theme' ); ?>
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-charcoal mb-4"><?php esc_html_e( 'Advisory & Services Disclaimer', 'ojis-travels-theme' ); ?></h2>
                    <p class="text-muted leading-relaxed">
                        <?php esc_html_e( 'Information about our advisory services on this website is provided for general informational purposes and does not constitute a formal advisory engagement. A formal engagement is established only through a written agreement between OJIS Travels & Advisory and the client.', 'ojis-travels-theme' ); ?>
                    </p>
                    <p class="text-muted leading-relaxed mt-4">
                        <?php esc_html_e( 'Certification is performed independently by GSTC-accredited certification bodies. Our advisory services do not constitute certification and do not guarantee certification outcomes.', 'ojis-travels-theme' ); ?>
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-charcoal mb-4"><?php esc_html_e( 'External Links', 'ojis-travels-theme' ); ?></h2>
                    <p class="text-muted leading-relaxed">
                        <?php esc_html_e( 'Our website may contain links to third-party websites. These links are provided for your convenience and do not signify our endorsement of those websites. We have no responsibility for the content of linked external sites and accept no liability for any loss or damage that may arise from your use of them.', 'ojis-travels-theme' ); ?>
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-charcoal mb-4"><?php esc_html_e( 'Limitation of Liability', 'ojis-travels-theme' ); ?></h2>
                    <p class="text-muted leading-relaxed">
                        <?php esc_html_e( 'To the fullest extent permitted by law, OJIS Travels & Advisory shall not be liable for any indirect, incidental, special, or consequential damages arising from your use of, or inability to use, this website or its content.', 'ojis-travels-theme' ); ?>
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-charcoal mb-4"><?php esc_html_e( 'Changes to These Terms', 'ojis-travels-theme' ); ?></h2>
                    <p class="text-muted leading-relaxed">
                        <?php esc_html_e( 'We reserve the right to update these Terms of Use at any time. Changes will be posted on this page with a revised date. Your continued use of the website after any changes constitutes your acceptance of the updated terms.', 'ojis-travels-theme' ); ?>
                    </p>
                </div>

                <div class="border-t border-gray-100 pt-8">
                    <h2 class="text-2xl font-bold text-charcoal mb-4"><?php esc_html_e( 'Contact Us', 'ojis-travels-theme' ); ?></h2>
                    <p class="text-muted leading-relaxed">
                        <?php esc_html_e( 'If you have any questions about these Terms of Use, please contact us:', 'ojis-travels-theme' ); ?>
                    </p>
                    <div class="mt-4 flex flex-col gap-2 text-muted text-sm">
                        <p><strong class="text-charcoal"><?php esc_html_e( 'OJIS Travels & Advisory', 'ojis-travels-theme' ); ?></strong></p>
                        <p><?php esc_html_e( 'Email:', 'ojis-travels-theme' ); ?> <a href="mailto:info@ojistravels.com" class="text-forest hover:text-eco transition-colors duration-200">info@ojistravels.com</a></p>
                        <p><?php esc_html_e( 'Website:', 'ojis-travels-theme' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-forest hover:text-eco transition-colors duration-200">ojistravels.com</a></p>
                    </div>
                </div>

            </div>

            <div class="mt-8 text-center">
                <a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>" class="inline-flex items-center gap-2 text-sm text-forest font-semibold hover:text-eco-alt transition-colors duration-200">
                    <span class="material-symbols-outlined text-base" aria-hidden="true">privacy_tip</span>
                    <?php esc_html_e( 'View Privacy Policy', 'ojis-travels-theme' ); ?>
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
