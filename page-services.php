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
            <span class="section-eyebrow-light"><?php esc_html_e( 'Advisory Services', 'ojis-travels-theme' ); ?></span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mt-3 mb-6 leading-tight">
                <?php echo esc_html( $services_headline ?: __( 'Sustainable Tourism & Hospitality Advisory', 'ojis-travels-theme' ) ); ?>
            </h1>
            <p class="text-white/75 text-lg max-w-2xl mx-auto leading-relaxed">
                <?php echo esc_html( $services_sub ?: __( 'Practical, expert-led advisory services for tourism and hospitality businesses committed to making a meaningful difference.', 'ojis-travels-theme' ) ); ?>
            </p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         SERVICE 01 — SUSTAINABLE HOSPITALITY ADVISORY
    ════════════════════════════════════════════════════════ -->
    <section id="advisory" class="py-24 bg-offwhite" aria-labelledby="service-advisory-heading">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                <div class="reveal-element">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-forest/10 mb-6">
                        <span class="material-symbols-outlined text-forest text-3xl" aria-hidden="true">business_center</span>
                    </div>
                    <span class="section-eyebrow"><?php esc_html_e( 'Service 01', 'ojis-travels-theme' ); ?></span>
                    <h2 id="service-advisory-heading" class="section-heading mt-3">
                        <?php esc_html_e( 'Sustainable Hospitality Advisory', 'ojis-travels-theme' ); ?>
                    </h2>
                    <p class="text-muted leading-relaxed mt-4 mb-8">
                        <?php esc_html_e( 'We guide hotels, lodges, resorts and hospitality businesses toward long-term sustainability and resilience. Our services are grounded in GSTC frameworks and practical implementation experience.', 'ojis-travels-theme' ); ?>
                    </p>
                    <?php
                    $advisory_features = [
                        [ 'icon' => 'analytics', 'text' => __( 'Sustainability assessments and gap analysis',        'ojis-travels-theme' ) ],
                        [ 'icon' => 'route',     'text' => __( 'Strategy and action planning',                       'ojis-travels-theme' ) ],
                        [ 'icon' => 'checklist', 'text' => __( 'Practical implementation guidance',                  'ojis-travels-theme' ) ],
                        [ 'icon' => 'public',    'text' => __( 'SDG alignment and responsible operations',           'ojis-travels-theme' ) ],
                        [ 'icon' => 'verified',  'text' => __( 'Sustainability certification readiness and support', 'ojis-travels-theme' ) ],
                        [ 'icon' => 'school',    'text' => __( 'Staff awareness and training',                       'ojis-travels-theme' ) ],
                    ];
                    foreach ( $advisory_features as $f ) : ?>
                    <div class="flex items-start gap-3 mb-4">
                        <span class="material-symbols-outlined text-eco text-xl mt-0.5 flex-shrink-0" aria-hidden="true"><?php echo esc_html( $f['icon'] ); ?></span>
                        <p class="text-charcoal text-sm leading-relaxed"><?php echo esc_html( $f['text'] ); ?></p>
                    </div>
                    <?php endforeach; ?>
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-primary inline-flex items-center gap-2 mt-6">
                        <?php esc_html_e( 'Work With OJIS', 'ojis-travels-theme' ); ?>
                        <span class="material-symbols-outlined text-base" aria-hidden="true">arrow_forward</span>
                    </a>
                </div>

                <div class="reveal-element order-first lg:order-last">
                    <div class="rounded-3xl overflow-hidden shadow-2xl aspect-[4/3]">
                        <img
                            src="<?php echo esc_url( OJIS_THEME_URI . '/assets/images/advisory.webp' ); ?>"
                            alt="<?php esc_attr_e( 'Sustainable hospitality advisory session', 'ojis-travels-theme' ); ?>"
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
         SERVICE 02 — HOSPITALITY CONTENT & STORYTELLING
    ════════════════════════════════════════════════════════ -->
    <section id="content" class="py-24 bg-white" aria-labelledby="service-content-heading">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                <div class="reveal-element">
                    <div class="rounded-3xl overflow-hidden shadow-2xl aspect-[4/3]">
                        <img
                            src="<?php echo esc_url( OJIS_THEME_URI . '/assets/images/services-travel.jpg' ); ?>"
                            alt="<?php esc_attr_e( 'Hospitality content creation and storytelling', 'ojis-travels-theme' ); ?>"
                            class="w-full h-full object-cover"
                            loading="lazy"
                            width="700"
                            height="525"
                        >
                    </div>
                </div>

                <div class="reveal-element">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-eco/10 mb-6">
                        <span class="material-symbols-outlined text-eco-alt text-3xl" aria-hidden="true">photo_camera</span>
                    </div>
                    <span class="section-eyebrow"><?php esc_html_e( 'Service 02', 'ojis-travels-theme' ); ?></span>
                    <h2 id="service-content-heading" class="section-heading mt-3">
                        <?php esc_html_e( 'Hospitality Content &amp; Storytelling', 'ojis-travels-theme' ); ?>
                    </h2>
                    <p class="text-muted leading-relaxed mt-4 mb-8">
                        <?php esc_html_e( 'We create authentic visual content and compelling stories that help sustainable hospitality and tourism businesses communicate their value, connect with conscious travelers, and showcase the people, places, and practices behind their brand.', 'ojis-travels-theme' ); ?>
                    </p>
                    <?php
                    $content_features = [
                        [ 'icon' => 'auto_stories',  'text' => __( 'Sustainability storytelling and editorial content', 'ojis-travels-theme' ) ],
                        [ 'icon' => 'photo_camera',  'text' => __( 'Hotel and resort photography',                      'ojis-travels-theme' ) ],
                        [ 'icon' => 'videocam',      'text' => __( 'Short-form video and reels',                        'ojis-travels-theme' ) ],
                        [ 'icon' => 'language',      'text' => __( 'Website and social content',                        'ojis-travels-theme' ) ],
                        [ 'icon' => 'groups',        'text' => __( 'People, community, and impact stories',             'ojis-travels-theme' ) ],
                    ];
                    foreach ( $content_features as $f ) : ?>
                    <div class="flex items-start gap-3 mb-4">
                        <span class="material-symbols-outlined text-eco text-xl mt-0.5 flex-shrink-0" aria-hidden="true"><?php echo esc_html( $f['icon'] ); ?></span>
                        <p class="text-charcoal text-sm leading-relaxed"><?php echo esc_html( $f['text'] ); ?></p>
                    </div>
                    <?php endforeach; ?>
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-primary inline-flex items-center gap-2 mt-6">
                        <?php esc_html_e( 'Work With OJIS', 'ojis-travels-theme' ); ?>
                        <span class="material-symbols-outlined text-base" aria-hidden="true">arrow_forward</span>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         SERVICE 03 — RESPONSIBLE TRAVEL ADVISORY
    ════════════════════════════════════════════════════════ -->
    <section id="travel" class="py-24 bg-offwhite" aria-labelledby="service-travel-heading">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                <div class="reveal-element">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-forest/10 mb-6">
                        <span class="material-symbols-outlined text-forest text-3xl" aria-hidden="true">flight_takeoff</span>
                    </div>
                    <span class="section-eyebrow"><?php esc_html_e( 'Service 03', 'ojis-travels-theme' ); ?></span>
                    <h2 id="service-travel-heading" class="section-heading mt-3">
                        <?php esc_html_e( 'Responsible Travel Advisory', 'ojis-travels-theme' ); ?>
                    </h2>
                    <p class="text-muted leading-relaxed mt-4 mb-8">
                        <?php esc_html_e( 'We help travellers plan meaningful, responsible journeys. From personalised consultations to curated itineraries, we design travel experiences that respect destinations, support local communities, and minimise environmental impact.', 'ojis-travels-theme' ); ?>
                    </p>
                    <?php
                    $travel_features = [
                        [ 'icon' => 'map',     'text' => __( 'Responsible travel planning and consultation', 'ojis-travels-theme' ) ],
                        [ 'icon' => 'hotel',   'text' => __( 'Sustainable accommodation recommendations',    'ojis-travels-theme' ) ],
                        [ 'icon' => 'explore', 'text' => __( 'Curated responsible experiences',              'ojis-travels-theme' ) ],
                        [ 'icon' => 'groups',  'text' => __( 'Selected corporate and leisure travel support','ojis-travels-theme' ) ],
                    ];
                    foreach ( $travel_features as $f ) : ?>
                    <div class="flex items-start gap-3 mb-4">
                        <span class="material-symbols-outlined text-eco text-xl mt-0.5 flex-shrink-0" aria-hidden="true"><?php echo esc_html( $f['icon'] ); ?></span>
                        <p class="text-charcoal text-sm leading-relaxed"><?php echo esc_html( $f['text'] ); ?></p>
                    </div>
                    <?php endforeach; ?>
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-primary inline-flex items-center gap-2 mt-6">
                        <?php esc_html_e( 'Work With OJIS', 'ojis-travels-theme' ); ?>
                        <span class="material-symbols-outlined text-base" aria-hidden="true">arrow_forward</span>
                    </a>
                </div>

                <div class="reveal-element order-first lg:order-last">
                    <div class="rounded-3xl overflow-hidden shadow-2xl aspect-[4/3]">
                        <img
                            src="<?php echo esc_url( OJIS_THEME_URI . '/assets/images/services-education.jpg' ); ?>"
                            alt="<?php esc_attr_e( 'Responsible travel advisory and curated experiences', 'ojis-travels-theme' ); ?>"
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
                <span class="material-symbols-outlined" aria-hidden="true">handshake</span>
                <?php esc_html_e( 'Work With OJIS', 'ojis-travels-theme' ); ?>
            </a>
        </div>
    </section>

</main>

<?php get_footer(); ?>
