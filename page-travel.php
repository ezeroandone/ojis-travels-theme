<?php
/**
 * Template Name: Travel
 *
 * Responsible Travel Advisory page.
 *
 * @package ojis-travels-theme
 */

get_header(); ?>

<main id="main-content" class="site-main overflow-hidden">

    <!-- ═══════════════════════════════════════════════════════
         PAGE HERO
    ════════════════════════════════════════════════════════ -->
    <section class="page-hero relative overflow-hidden min-h-[420px] flex items-center" aria-label="<?php esc_attr_e( 'Responsible Travel Advisory page header', 'ojis-travels-theme' ); ?>">
        <div
            class="absolute inset-0 bg-cover bg-center bg-no-repeat"
            style="background-image: url('<?php echo esc_url( OJIS_THEME_URI . '/assets/images/services-travel.jpg' ); ?>')"
            role="img"
            aria-label="<?php esc_attr_e( 'Responsible travel experiences across Africa and beyond', 'ojis-travels-theme' ); ?>"
        ></div>
        <div class="absolute inset-0 bg-gradient-to-br from-forest/80 via-charcoal/70 to-forest/70" aria-hidden="true"></div>
        <div class="hero-pattern absolute inset-0 opacity-5" aria-hidden="true"></div>
        <div class="relative max-w-7xl mx-auto px-6 pt-36 pb-20 text-center w-full">
            <span class="section-eyebrow-light"><?php esc_html_e( 'For Travelers', 'ojis-travels-theme' ); ?></span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mt-3 mb-6 leading-tight">
                <?php esc_html_e( 'Responsible Travel Advisory', 'ojis-travels-theme' ); ?>
            </h1>
            <p class="text-white/75 text-lg max-w-2xl mx-auto leading-relaxed">
                <?php esc_html_e( 'Helping travellers plan meaningful, responsible journeys that respect destinations, support local communities, and minimise environmental impact.', 'ojis-travels-theme' ); ?>
            </p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         INTRO
    ════════════════════════════════════════════════════════ -->
    <section class="py-24 bg-offwhite" aria-labelledby="travel-intro-heading">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                <div class="reveal-element">
                    <span class="section-eyebrow"><?php esc_html_e( 'Travel With Purpose', 'ojis-travels-theme' ); ?></span>
                    <h2 id="travel-intro-heading" class="section-heading mt-3">
                        <?php esc_html_e( 'Travel Better. Experience More. Leave a Lighter Footprint.', 'ojis-travels-theme' ); ?>
                    </h2>
                    <p class="text-muted leading-relaxed mt-4 mb-6">
                        <?php esc_html_e( 'We help travellers plan meaningful journeys through personalised consultations and thoughtfully designed itineraries that consider local communities, culture, and environmental impact.', 'ojis-travels-theme' ); ?>
                    </p>
                    <p class="text-muted leading-relaxed mb-8">
                        <?php esc_html_e( 'Whether you are planning a luxury escape, a group trip, or a corporate travel experience, we help you make more informed choices about where you stay, how you travel, and the value you create along the way.', 'ojis-travels-theme' ); ?>
                    </p>
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-primary inline-flex items-center gap-2">
                        <span class="material-symbols-outlined text-base" aria-hidden="true">flight_takeoff</span>
                        <?php esc_html_e( 'Plan Your Journey', 'ojis-travels-theme' ); ?>
                    </a>
                </div>

                <div class="reveal-element order-first lg:order-last">
                    <div class="rounded-3xl overflow-hidden shadow-2xl aspect-[4/3]">
                        <img
                            src="<?php echo esc_url( OJIS_THEME_URI . '/assets/images/services-travel.jpg' ); ?>"
                            alt="<?php esc_attr_e( 'Responsible travel experiences across Africa', 'ojis-travels-theme' ); ?>"
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
         SERVICES
    ════════════════════════════════════════════════════════ -->
    <section class="py-24 bg-white" aria-labelledby="travel-services-heading">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center max-w-2xl mx-auto mb-16 reveal-element">
                <span class="section-eyebrow"><?php esc_html_e( 'What We Offer', 'ojis-travels-theme' ); ?></span>
                <h2 id="travel-services-heading" class="section-heading mt-3">
                    <?php esc_html_e( 'Responsible Travel Services', 'ojis-travels-theme' ); ?>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php
                $travel_services = [
                    [
                        'icon'  => 'map',
                        'title' => __( 'Responsible Travel Planning', 'ojis-travels-theme' ),
                        'desc'  => __( 'Personalised travel consultations to help you plan responsible journeys that align with your values and leave a positive impact on the places you visit.', 'ojis-travels-theme' ),
                    ],
                    [
                        'icon'  => 'diamond',
                        'title' => __( 'Sustainable Luxury Travel', 'ojis-travels-theme' ),
                        'desc'  => __( 'Curated luxury travel experiences that do not compromise on comfort or conscience — selecting properties and operators with genuine sustainability credentials.', 'ojis-travels-theme' ),
                    ],
                    [
                        'icon'  => 'groups',
                        'title' => __( 'Group & Corporate Travel', 'ojis-travels-theme' ),
                        'desc'  => __( 'Thoughtfully designed group and corporate travel programmes that incorporate responsible practices, local community engagement, and meaningful experiences.', 'ojis-travels-theme' ),
                    ],
                ];
                foreach ( $travel_services as $k => $s ) : ?>
                <div
                    class="bg-offwhite rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 reveal-element"
                    style="transition-delay: <?php echo esc_attr( $k * 100 ); ?>ms"
                >
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-eco/10 mb-6">
                        <span class="material-symbols-outlined text-eco-alt text-2xl" aria-hidden="true"><?php echo esc_html( $s['icon'] ); ?></span>
                    </div>
                    <h3 class="text-xl font-bold text-charcoal mb-3 leading-snug"><?php echo esc_html( $s['title'] ); ?></h3>
                    <p class="text-muted text-sm leading-relaxed"><?php echo esc_html( $s['desc'] ); ?></p>
                </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         PHILOSOPHY STRIP
    ════════════════════════════════════════════════════════ -->
    <section class="py-16 bg-forest relative overflow-hidden" aria-label="<?php esc_attr_e( 'Travel philosophy', 'ojis-travels-theme' ); ?>">
        <div class="absolute inset-0 hero-pattern opacity-5" aria-hidden="true"></div>
        <div class="relative max-w-4xl mx-auto px-6 text-center reveal-element">
            <p class="text-eco font-semibold text-sm uppercase tracking-widest mb-4">
                <?php esc_html_e( 'Our Approach', 'ojis-travels-theme' ); ?>
            </p>
            <p class="text-white text-2xl sm:text-3xl font-bold leading-snug mb-4">
                <?php esc_html_e( '"It\'s not only about where we go, but about the value we create along the way."', 'ojis-travels-theme' ); ?>
            </p>
            <p class="text-white/70 text-base leading-relaxed">
                <?php esc_html_e( 'Every journey is an opportunity to connect with people, support communities, and engage with places in a meaningful and responsible way.', 'ojis-travels-theme' ); ?>
            </p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         CTA
    ════════════════════════════════════════════════════════ -->
    <section class="py-20 bg-gradient-to-br from-charcoal to-forest relative overflow-hidden" aria-label="<?php esc_attr_e( 'Travel inquiry call to action', 'ojis-travels-theme' ); ?>">
        <div class="absolute inset-0 hero-pattern opacity-5" aria-hidden="true"></div>
        <div class="relative max-w-4xl mx-auto px-6 text-center reveal-element">
            <span class="material-symbols-outlined text-eco text-5xl mb-6 block" aria-hidden="true">flight_takeoff</span>
            <h2 class="text-3xl font-bold text-white mb-4">
                <?php esc_html_e( 'Ready to Plan Your Journey?', 'ojis-travels-theme' ); ?>
            </h2>
            <p class="text-white/70 text-lg mb-8 max-w-xl mx-auto">
                <?php esc_html_e( 'Tell us about your travel goals and we will help you plan a meaningful, responsible experience.', 'ojis-travels-theme' ); ?>
            </p>
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-eco inline-flex items-center gap-2 px-8 py-4 text-base">
                <span class="material-symbols-outlined" aria-hidden="true">mail</span>
                <?php esc_html_e( 'Get in Touch', 'ojis-travels-theme' ); ?>
            </a>
        </div>
    </section>

</main>

<?php get_footer(); ?>
