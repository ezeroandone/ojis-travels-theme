<?php
/**
 * Template Name: Services
 *
 * @package ojis-travels-theme
 */

get_header(); ?>

<main id="main-content" class="site-main overflow-x-hidden">

    <!-- ═══════════════════════════════════════════════════════
         PAGE HERO — full-bleed image with overlay
    ════════════════════════════════════════════════════════ -->
    <?php
    $services_hero_bg  = get_theme_mod( 'ojis_services_hero_bg',           OJIS_THEME_URI . '/assets/images/services-hero.jpg' );
    $services_headline = get_theme_mod( 'ojis_services_hero_bg_headline',   '' );
    $services_sub      = get_theme_mod( 'ojis_services_hero_bg_sub',        '' );
    ?>
    <section class="page-hero relative overflow-hidden min-h-[420px] flex items-center" aria-label="<?php esc_attr_e( 'Services page header', 'ojis-travels-theme' ); ?>">
        <div
            class="absolute inset-0 bg-cover bg-center bg-no-repeat"
            style="background-image: url('<?php echo esc_url( $services_hero_bg ); ?>')"
            role="img"
            aria-label="<?php esc_attr_e( 'OJIS Travels & Advisory — Services', 'ojis-travels-theme' ); ?>"
        ></div>
        <div class="absolute inset-0 bg-gradient-to-br from-forest/80 via-charcoal/70 to-forest/70" aria-hidden="true"></div>
        <div class="hero-pattern absolute inset-0 opacity-5" aria-hidden="true"></div>
        <div class="relative max-w-7xl mx-auto px-6 pt-36 pb-20 text-center w-full">
            <span class="section-eyebrow-light"><?php esc_html_e( 'What We Offer', 'ojis-travels-theme' ); ?></span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mt-3 mb-6 leading-tight">
                <?php echo esc_html( $services_headline ?: __( 'Our Services', 'ojis-travels-theme' ) ); ?>
            </h1>
            <p class="text-white/75 text-lg max-w-2xl mx-auto leading-relaxed">
                <?php echo esc_html( $services_sub ?: __( 'Practical, expert-led solutions for travellers and hospitality businesses committed to making a meaningful difference.', 'ojis-travels-theme' ) ); ?>
            </p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         SERVICE A — FOR TRAVELERS
    ════════════════════════════════════════════════════════ -->
    <section class="py-24 bg-offwhite" aria-labelledby="service-travelers-heading">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                <div class="reveal-element">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-forest/10 mb-6">
                        <span class="material-symbols-outlined text-forest text-3xl" aria-hidden="true">flight_takeoff</span>
                    </div>
                    <span class="section-eyebrow"><?php esc_html_e( 'For Travelers', 'ojis-travels-theme' ); ?></span>
                    <h2 id="service-travelers-heading" class="section-heading mt-3">
                        <?php esc_html_e( 'Responsible Travel Experiences', 'ojis-travels-theme' ); ?>
                    </h2>
                    <p class="text-muted leading-relaxed mt-4 mb-8">
                        <?php esc_html_e( 'We help travellers plan meaningful, responsible journeys. Whether you are looking for a sustainable luxury escape, a group trip, or a corporate travel experience, we curate itineraries that respect destinations, support local communities and minimise environmental footprint.', 'ojis-travels-theme' ); ?>
                    </p>

                    <?php
                    $travelers_features = [
                        [ 'icon' => 'map',     'text' => __( 'Responsible Travel Planning', 'ojis-travels-theme' ) ],
                        [ 'icon' => 'diamond', 'text' => __( 'Sustainable Luxury Travel',   'ojis-travels-theme' ) ],
                        [ 'icon' => 'groups',  'text' => __( 'Group & Corporate Travel',    'ojis-travels-theme' ) ],
                    ];
                    foreach ( $travelers_features as $f ) : ?>
                    <div class="flex items-start gap-3 mb-4">
                        <span class="material-symbols-outlined text-eco text-xl mt-0.5 flex-shrink-0" aria-hidden="true"><?php echo esc_html( $f['icon'] ); ?></span>
                        <p class="text-charcoal text-sm leading-relaxed"><?php echo esc_html( $f['text'] ); ?></p>
                    </div>
                    <?php endforeach; ?>

                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-primary inline-flex items-center gap-2 mt-6">
                        <?php esc_html_e( 'Enquire About Travel', 'ojis-travels-theme' ); ?>
                        <span class="material-symbols-outlined text-base" aria-hidden="true">arrow_forward</span>
                    </a>
                </div>

                <div class="reveal-element order-first lg:order-last">
                    <div class="rounded-3xl overflow-hidden shadow-2xl aspect-[4/3]">
                        <img
                            src="<?php echo esc_url( OJIS_THEME_URI . '/assets/images/services-travel.jpg' ); ?>"
                            alt="<?php esc_attr_e( 'Sustainable travel experiences curated across Africa', 'ojis-travels-theme' ); ?>"
                            class="w-full h-full object-cover"
                            loading="lazy"
                            width="700"
                            height="525"
                        >
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         SERVICE B — FOR HOSPITALITY BUSINESSES
    ════════════════════════════════════════════════════════ -->
    <section class="py-24 bg-white" aria-labelledby="service-hospitality-heading">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                <div class="reveal-element">
                    <div class="rounded-3xl overflow-hidden shadow-2xl aspect-[4/3]">
                        <img
                            src="<?php echo esc_url( OJIS_THEME_URI . '/assets/images/advisory.webp' ); ?>"
                            alt="<?php esc_attr_e( 'Hospitality advisory and consulting session', 'ojis-travels-theme' ); ?>"
                            class="w-full h-full object-cover"
                            loading="lazy"
                            width="700"
                            height="525"
                        >
                    </div>
                </div>

                <div class="reveal-element">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-eco/10 mb-6">
                        <span class="material-symbols-outlined text-eco-alt text-3xl" aria-hidden="true">hotel</span>
                    </div>
                    <span class="section-eyebrow"><?php esc_html_e( 'For Hospitality Businesses', 'ojis-travels-theme' ); ?></span>
                    <h2 id="service-hospitality-heading" class="section-heading mt-3">
                        <?php esc_html_e( 'Sustainable Hospitality Services', 'ojis-travels-theme' ); ?>
                    </h2>
                    <p class="text-muted leading-relaxed mt-4 mb-8">
                        <?php esc_html_e( 'We guide hotels, lodges, resorts and hospitality businesses toward long-term sustainability and resilience. Our services are grounded in GSTC frameworks and real-world implementation experience.', 'ojis-travels-theme' ); ?>
                    </p>

                    <?php
                    $hospitality_features = [
                        [ 'icon' => 'analytics',     'text' => __( 'Sustainable Hospitality Consulting',            'ojis-travels-theme' ), 'note' => '' ],
                        [ 'icon' => 'photo_camera',  'text' => __( 'Sustainable Hospitality Content & Storytelling', 'ojis-travels-theme' ), 'note' => '<a href="/sustainable-hospitality-content" class="text-eco-alt underline">Learn more about our content services &rarr;</a>' ],
                        [ 'icon' => 'verified',      'text' => __( 'Sustainability Certification Support',           'ojis-travels-theme' ), 'note' => '' ],
                    ];
                    foreach ( $hospitality_features as $f ) : ?>
                    <div class="flex items-start gap-3 mb-4">
                        <span class="material-symbols-outlined text-eco text-xl mt-0.5 flex-shrink-0" aria-hidden="true"><?php echo esc_html( $f['icon'] ); ?></span>
                        <div>
                            <p class="text-charcoal text-sm leading-relaxed"><?php echo esc_html( $f['text'] ); ?></p>
                            <?php if ( ! empty( $f['note'] ) ) : ?>
                            <p class="text-xs mt-1"><?php echo wp_kses( $f['note'], [ 'a' => [ 'href' => [], 'class' => [] ] ] ); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-primary inline-flex items-center gap-2 mt-6">
                        <?php esc_html_e( 'Request Advisory Services', 'ojis-travels-theme' ); ?>
                        <span class="material-symbols-outlined text-base" aria-hidden="true">arrow_forward</span>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         SERVICE C — FOR DESTINATIONS & ORGANIZATIONS
    ════════════════════════════════════════════════════════ -->
    <section class="py-24 bg-offwhite" aria-labelledby="service-destinations-heading">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                <div class="reveal-element">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-eco/10 mb-6">
                        <span class="material-symbols-outlined text-eco-alt text-3xl" aria-hidden="true">language</span>
                    </div>
                    <span class="section-eyebrow"><?php esc_html_e( 'For Destinations & Organizations', 'ojis-travels-theme' ); ?></span>
                    <h2 id="service-destinations-heading" class="section-heading mt-3">
                        <?php esc_html_e( 'Sustainable Destination & Strategy Services', 'ojis-travels-theme' ); ?>
                    </h2>
                    <p class="text-muted leading-relaxed mt-4 mb-8">
                        <?php esc_html_e( 'We work with destinations, tourism boards and organisations to develop practical sustainability strategies, community-based tourism initiatives and long-term destination management frameworks.', 'ojis-travels-theme' ); ?>
                    </p>

                    <?php
                    $destinations_features = [
                        [ 'icon' => 'explore',      'text' => __( 'Sustainable Destination Consulting',   'ojis-travels-theme' ) ],
                        [ 'icon' => 'diversity_3',  'text' => __( 'Community-Based Tourism Development', 'ojis-travels-theme' ) ],
                        [ 'icon' => 'trending_up',  'text' => __( 'Sustainable Tourism Strategy',        'ojis-travels-theme' ) ],
                    ];
                    foreach ( $destinations_features as $f ) : ?>
                    <div class="flex items-start gap-3 mb-4">
                        <span class="material-symbols-outlined text-eco text-xl mt-0.5 flex-shrink-0" aria-hidden="true"><?php echo esc_html( $f['icon'] ); ?></span>
                        <p class="text-charcoal text-sm leading-relaxed"><?php echo esc_html( $f['text'] ); ?></p>
                    </div>
                    <?php endforeach; ?>

                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-primary inline-flex items-center gap-2 mt-6">
                        <?php esc_html_e( 'Discuss Your Project', 'ojis-travels-theme' ); ?>
                        <span class="material-symbols-outlined text-base" aria-hidden="true">arrow_forward</span>
                    </a>
                </div>

                <div class="reveal-element order-first lg:order-last">
                    <div class="rounded-3xl overflow-hidden shadow-2xl aspect-[4/3]">
                        <img
                            src="<?php echo esc_url( OJIS_THEME_URI . '/assets/images/services-education.jpg' ); ?>"
                            alt="<?php esc_attr_e( 'Sustainable destination consulting and community-based tourism development', 'ojis-travels-theme' ); ?>"
                            class="w-full h-full object-cover"
                            loading="lazy"
                            width="700"
                            height="525"
                        >
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         GSTC DISCLAIMER
    ════════════════════════════════════════════════════════ -->
    <section class="py-10 bg-offwhite border-t border-gray-100" aria-label="<?php esc_attr_e( 'GSTC disclaimer', 'ojis-travels-theme' ); ?>">
        <div class="max-w-5xl mx-auto px-6">
            <div class="flex items-start gap-4 bg-white rounded-2xl border border-amber-100 px-6 py-5 shadow-sm">
                <span class="material-symbols-outlined text-amber-500 text-xl flex-shrink-0 mt-0.5" aria-hidden="true">info</span>
                <p class="text-sm text-muted leading-relaxed">
                    <strong class="text-charcoal font-semibold"><?php esc_html_e( 'Please note:', 'ojis-travels-theme' ); ?></strong>
                    <?php esc_html_e( 'Certification is performed independently by GSTC-accredited certification bodies. Our advisory services do not constitute certification or guarantee certification outcomes.', 'ojis-travels-theme' ); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         CTA — ADVISORY INQUIRY
    ════════════════════════════════════════════════════════ -->
    <section class="py-20 bg-gradient-to-br from-charcoal to-forest relative overflow-hidden" aria-label="<?php esc_attr_e( 'Advisory inquiry call to action', 'ojis-travels-theme' ); ?>">
        <div class="absolute inset-0 hero-pattern opacity-5" aria-hidden="true"></div>
        <div class="relative max-w-4xl mx-auto px-6 text-center reveal-element">
            <span class="material-symbols-outlined text-eco text-5xl mb-6 block" aria-hidden="true">handshake</span>
            <h2 class="text-3xl font-bold text-white mb-4">
                <?php esc_html_e( 'Ready to Work Together?', 'ojis-travels-theme' ); ?>
            </h2>
            <p class="text-white/70 text-lg mb-8 max-w-xl mx-auto">
                <?php esc_html_e( 'Tell us about your goals and we will connect you with the right service to move your sustainability journey forward.', 'ojis-travels-theme' ); ?>
            </p>
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-eco inline-flex items-center gap-2 px-8 py-4 text-base">
                <span class="material-symbols-outlined" aria-hidden="true">calendar_month</span>
                <?php esc_html_e( 'Book a Consultation', 'ojis-travels-theme' ); ?>
            </a>
        </div>
    </section>

</main>

<?php get_footer(); ?>
