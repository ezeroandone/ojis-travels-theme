<?php
/**
 * Template Name: About Us
 *
 * @package ojis-travels-theme
 */

get_header(); ?>

<main id="main-content" class="site-main overflow-x-hidden">

    <!-- ═══════════════════════════════════════════════════════
         PAGE HERO — full-bleed image with overlay
    ════════════════════════════════════════════════════════ -->
    <?php
    $about_hero_bg  = get_theme_mod( 'ojis_about_hero_bg',       OJIS_THEME_URI . '/assets/images/about-hero.jpg' );
    $about_headline = get_theme_mod( 'ojis_about_hero_bg_headline', '' );
    $about_sub      = get_theme_mod( 'ojis_about_hero_bg_sub',     '' );
    ?>
    <section class="page-hero relative overflow-hidden min-h-[420px] flex items-center" aria-label="<?php esc_attr_e( 'About Us page header', 'ojis-travels-theme' ); ?>">
        <div
            class="absolute inset-0 bg-cover bg-center bg-no-repeat"
            style="background-image: url('<?php echo esc_url( $about_hero_bg ); ?>')"
            role="img"
            aria-label="<?php esc_attr_e( 'OJIS Travels & Advisory — About Us', 'ojis-travels-theme' ); ?>"
        ></div>
        <div class="absolute inset-0 bg-gradient-to-br from-charcoal/80 via-forest/70 to-charcoal/70" aria-hidden="true"></div>
        <div class="hero-pattern absolute inset-0 opacity-5" aria-hidden="true"></div>
        <div class="relative max-w-7xl mx-auto px-6 pt-36 pb-20 text-center w-full">
            <span class="section-eyebrow-light"><?php esc_html_e( 'Our Story', 'ojis-travels-theme' ); ?></span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mt-3 mb-6 leading-tight">
                <?php echo esc_html( $about_headline ?: __( 'About OJIS Travels & Advisory', 'ojis-travels-theme' ) ); ?>
            </h1>
            <p class="text-white/75 text-lg max-w-2xl mx-auto leading-relaxed">
                <?php echo esc_html( $about_sub ?: __( 'A sustainable tourism and hospitality brand making sustainability practical, relevant, and accessible.', 'ojis-travels-theme' ) ); ?>
            </p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         INTRO
    ════════════════════════════════════════════════════════ -->
    <section class="py-24 bg-offwhite" aria-labelledby="about-intro-heading">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                <div class="reveal-element">
                    <span class="section-eyebrow"><?php esc_html_e( 'Who We Are', 'ojis-travels-theme' ); ?></span>
                    <h2 id="about-intro-heading" class="section-heading mt-3">
                        <?php esc_html_e( 'Sustainability Made Practical', 'ojis-travels-theme' ); ?>
                    </h2>
                    <div class="prose-ojis mt-6 space-y-5">
                        <p>
                            <?php esc_html_e( 'OJIS Travels & Advisory is a sustainable tourism and hospitality brand making sustainability practical, relevant, and accessible.', 'ojis-travels-theme' ); ?>
                        </p>
                        <p>
                            <?php esc_html_e( 'With a focus on Africa, we educate, amplify responsible practices, showcase practical solutions, and provide professional advisory services that empower travellers and hospitality businesses to make informed choices and take meaningful action.', 'ojis-travels-theme' ); ?>
                        </p>
                        <p>
                            <?php esc_html_e( 'By choosing OJIS, you are supporting our mission to advance a more responsible, resilient, and sustainable tourism and hospitality industry across Africa and beyond.', 'ojis-travels-theme' ); ?>
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-3 mt-8">
                        <?php
                        $tags = [
                            __( 'Sustainable Tourism',    'ojis-travels-theme' ),
                            __( 'Hospitality Advisory',  'ojis-travels-theme' ),
                            __( 'Africa-Focused',        'ojis-travels-theme' ),
                            __( 'GSTC Trained',          'ojis-travels-theme' ),
                        ];
                        foreach ( $tags as $tag ) : ?>
                        <span class="inline-block text-xs font-semibold text-forest bg-forest/10 border border-forest/20 px-4 py-2 rounded-full">
                            <?php echo esc_html( $tag ); ?>
                        </span>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="relative reveal-element">
                    <div class="rounded-3xl overflow-hidden shadow-2xl aspect-square">
                        <img
                            src="<?php echo esc_url( OJIS_THEME_URI . '/assets/images/about-brand.jpg' ); ?>"
                            alt="<?php esc_attr_e( 'OJIS Travels & Advisory — sustainability in practice across Africa', 'ojis-travels-theme' ); ?>"
                            class="w-full h-full object-cover"
                            loading="lazy"
                            width="700"
                            height="700"
                        >
                    </div>
                    <div class="absolute -bottom-6 -right-6 bg-forest text-white rounded-2xl p-6 shadow-xl max-w-[220px]">
                        <span class="material-symbols-outlined text-eco text-3xl mb-2 block" aria-hidden="true">verified</span>
                        <p class="text-sm font-semibold leading-snug">
                            <?php esc_html_e( 'GSTC Trained & Professionally Qualified', 'ojis-travels-theme' ); ?>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         MISSION & VISION
    ════════════════════════════════════════════════════════ -->
    <section class="py-24 bg-white" aria-labelledby="mission-vision-heading">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center max-w-2xl mx-auto mb-16 reveal-element">
                <span class="section-eyebrow"><?php esc_html_e( 'Our Purpose', 'ojis-travels-theme' ); ?></span>
                <h2 id="mission-vision-heading" class="section-heading mt-3">
                    <?php esc_html_e( 'Mission & Vision', 'ojis-travels-theme' ); ?>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Mission -->
                <div class="bg-forest text-white rounded-3xl p-10 reveal-element">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-white/10 mb-6">
                        <span class="material-symbols-outlined text-eco text-2xl" aria-hidden="true">flag</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4"><?php esc_html_e( 'Our Mission', 'ojis-travels-theme' ); ?></h3>
                    <p class="text-white/80 leading-relaxed">
                        <?php esc_html_e( 'Our mission is to make sustainable tourism and hospitality practical and actionable. Through education, advocacy, responsible travel solutions, and professional advisory, we empower travellers and hospitality businesses, particularly across Africa, to make informed choices, adopt responsible practices, and create lasting value for people, communities, businesses, and destinations.', 'ojis-travels-theme' ); ?>
                    </p>
                </div>

                <!-- Vision -->
                <div class="bg-offwhite border border-gray-100 rounded-3xl p-10 reveal-element" style="transition-delay: 150ms">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-forest/10 mb-6">
                        <span class="material-symbols-outlined text-forest text-2xl" aria-hidden="true">visibility</span>
                    </div>
                    <h3 class="text-2xl font-bold text-charcoal mb-4"><?php esc_html_e( 'Our Vision', 'ojis-travels-theme' ); ?></h3>
                    <p class="text-muted leading-relaxed">
                        <?php esc_html_e( 'We envision a future where responsible tourism and sustainable hospitality are the standard, not the exception, across Africa and beyond. A future where travellers make informed choices, hospitality businesses thrive responsibly, communities benefit meaningfully from tourism, and destinations are protected and strengthened for generations to come.', 'ojis-travels-theme' ); ?>
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         CORE PHILOSOPHY
    ════════════════════════════════════════════════════════ -->
    <section class="py-20 bg-offwhite" aria-labelledby="philosophy-heading">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <div class="reveal-element">
                <span class="section-eyebrow"><?php esc_html_e( 'Core Philosophy', 'ojis-travels-theme' ); ?></span>
                <h2 id="philosophy-heading" class="section-heading mt-3 mb-6">
                    <?php esc_html_e( 'Progress Over Perfection', 'ojis-travels-theme' ); ?>
                </h2>
                <p class="text-lg text-muted leading-relaxed max-w-3xl mx-auto">
                    <?php esc_html_e( 'Sustainability is not an all-or-nothing pursuit. We believe that every informed choice, every responsible action, and every step toward better practice contributes to a more sustainable future. Progress, not perfection, is the standard we hold ourselves and our partners to.', 'ojis-travels-theme' ); ?>
                </p>
                <div class="inline-flex items-center gap-3 mt-8 bg-white rounded-2xl px-8 py-4 shadow-sm border border-forest/10">
                    <span class="material-symbols-outlined text-forest text-2xl" aria-hidden="true">trending_up</span>
                    <span class="text-forest font-bold text-lg"><?php esc_html_e( '"Every step forward matters."', 'ojis-travels-theme' ); ?></span>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         FOUNDER STATEMENT (FULL)
    ════════════════════════════════════════════════════════ -->
    <section class="py-24 bg-white" aria-labelledby="founder-full-heading">
        <div class="max-w-6xl mx-auto px-6">

            <div class="text-center mb-14 reveal-element">
                <span class="section-eyebrow"><?php esc_html_e( 'From the Founder', 'ojis-travels-theme' ); ?></span>
                <h2 id="founder-full-heading" class="section-heading mt-3">
                    <?php esc_html_e( 'A Message from Our Founder', 'ojis-travels-theme' ); ?>
                </h2>
            </div>

            <!-- Two-column: founder image left, statement right -->
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-10 lg:gap-16 items-start reveal-element">

                <!-- ── Left column: Founder portrait ────── -->
                <div class="lg:col-span-2 flex flex-col items-center lg:items-start gap-6">
                    <div class="relative w-full max-w-xs mx-auto lg:mx-0">
                        <!-- Portrait -->
                        <div class="rounded-3xl overflow-hidden shadow-xl aspect-[3/4]">
                            <img
                                src="<?php echo esc_url( OJIS_THEME_URI . '/assets/images/founder.jpg' ); ?>"
                                alt="<?php esc_attr_e( 'Omoaghe Jeffrey Edene — Founder, OJIS Travels & Advisory', 'ojis-travels-theme' ); ?>"
                                class="w-full h-full object-cover object-top"
                                loading="lazy"
                                width="400"
                                height="533"
                            >
                        </div>
                        <!-- Decorative eco stripe -->
                        <div class="absolute bottom-0 left-0 right-0 h-1.5 bg-gradient-to-r from-eco to-eco-alt rounded-b-3xl" aria-hidden="true"></div>
                    </div>

                    <!-- Name & credentials under photo -->
                    <div class="text-center lg:text-left">
                        <p class="text-charcoal font-bold text-lg leading-snug">Omoaghe Jeffrey Edene</p>
                        <p class="text-forest text-sm font-semibold mt-1"><?php esc_html_e( 'Founder, OJIS Travels & Advisory', 'ojis-travels-theme' ); ?></p>
                        <p class="text-muted text-xs mt-2 leading-relaxed max-w-xs">
                            <?php esc_html_e( 'International Tourism & Hospitality Management', 'ojis-travels-theme' ); ?><br>
                            <?php esc_html_e( 'MSc Business Management (Hospitality Specialisation)', 'ojis-travels-theme' ); ?><br>
                            <?php esc_html_e( 'GSTC Trained Professional', 'ojis-travels-theme' ); ?>
                        </p>
                    </div>
                </div>

                <!-- ── Right column: Statement text ─────── -->
                <div class="lg:col-span-3">
                    <div class="bg-offwhite rounded-3xl p-8 lg:p-10 border border-gray-100 shadow-sm">

                        <!-- Proper typographic opening quote — using HTML entity, not icon -->
                        <div class="text-forest mb-6" aria-hidden="true">
                            <svg width="48" height="36" viewBox="0 0 48 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 36V22.5C0 16.5 1.5 11.625 4.5 7.875C7.5 4.125 11.625 1.5 16.875 0L19.5 4.5C16.25 5.625 13.75 7.5 12 10.125C10.25 12.625 9.375 15.375 9.375 18.375H18.75V36H0ZM27 36V22.5C27 16.5 28.5 11.625 31.5 7.875C34.5 4.125 38.625 1.5 43.875 0L46.5 4.5C43.25 5.625 40.75 7.5 39 10.125C37.25 12.625 36.375 15.375 36.375 18.375H45.75V36H27Z" fill="currentColor" opacity="0.25"/>
                            </svg>
                        </div>

                        <div class="space-y-5 text-charcoal leading-relaxed text-base">
                            <p><?php esc_html_e( 'Travel has the power to connect people, strengthen communities, preserve culture, and create opportunities. But how we travel and how hospitality businesses operate also matters.', 'ojis-travels-theme' ); ?></p>

                            <p><?php esc_html_e( 'I founded OJIS Travels & Advisory because I believe sustainability should be practical, relevant, and achievable. It should not be complicated or reserved for a select few.', 'ojis-travels-theme' ); ?></p>

                            <p><?php esc_html_e( 'As travel and hospitality continue to grow across Africa, we have an opportunity to shape that growth responsibly. At OJIS, we help turn good intentions into informed action by educating travellers, amplifying responsible practices, showcasing practical solutions, and supporting hospitality businesses through professional advisory services.', 'ojis-travels-theme' ); ?></p>

                            <p><?php esc_html_e( 'My background in International Tourism and Hospitality Management and an MSc in Business Management with a specialisation in Hospitality, combined with my professional experience, engagement, and professional training with the Global Sustainable Tourism Council (GSTC), shapes our practical approach to sustainability. Our approach considers people, culture, communities, the environment, business resilience, and long-term value.', 'ojis-travels-theme' ); ?></p>

                            <p><?php esc_html_e( 'Our philosophy is simple: progress over perfection. Every informed choice and responsible action can contribute to a more sustainable future.', 'ojis-travels-theme' ); ?></p>

                            <p><?php esc_html_e( 'When you choose OJIS, you are not simply choosing a travel or advisory service. You are supporting our mission to advance a more responsible, resilient, and sustainable tourism and hospitality industry.', 'ojis-travels-theme' ); ?></p>

                            <p class="font-semibold text-forest"><?php esc_html_e( 'Because the future of travel is not only about where we go, but also about the value we create along the way.', 'ojis-travels-theme' ); ?></p>
                        </div>

                        <!-- Closing signature line -->
                        <div class="mt-8 pt-6 border-t border-gray-200 flex items-center gap-4">
                            <div class="w-10 h-0.5 bg-eco rounded-full flex-shrink-0" aria-hidden="true"></div>
                            <cite class="not-italic text-sm font-semibold text-charcoal">
                                Omoaghe Jeffrey Edene
                                <span class="font-normal text-muted ml-1">— <?php esc_html_e( 'Founder', 'ojis-travels-theme' ); ?></span>
                            </cite>
                            <span class="text-muted text-xs ml-auto hidden sm:block">
                                <?php esc_html_e( 'International Tourism & Hospitality Management | MSc Business Management (Hospitality) | GSTC Trained', 'ojis-travels-theme' ); ?>
                            </span>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         CTA BAND
    ════════════════════════════════════════════════════════ -->
    <section class="py-20 bg-forest" aria-label="<?php esc_attr_e( 'Call to action', 'ojis-travels-theme' ); ?>">
        <div class="max-w-4xl mx-auto px-6 text-center reveal-element">
            <h2 class="text-3xl font-bold text-white mb-4">
                <?php esc_html_e( 'Ready to Take the Next Step?', 'ojis-travels-theme' ); ?>
            </h2>
            <p class="text-white/70 text-lg mb-8 max-w-xl mx-auto">
                <?php esc_html_e( 'Whether you are a traveller or a hospitality business, we have the expertise and tools to guide your sustainability journey.', 'ojis-travels-theme' ); ?>
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="<?php echo esc_url( home_url( '/services' ) ); ?>" class="btn-eco inline-flex items-center gap-2">
                    <span class="material-symbols-outlined text-base" aria-hidden="true">eco</span>
                    <?php esc_html_e( 'Explore Services', 'ojis-travels-theme' ); ?>
                </a>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-outline-white inline-flex items-center gap-2">
                    <span class="material-symbols-outlined text-base" aria-hidden="true">mail</span>
                    <?php esc_html_e( 'Get in Touch', 'ojis-travels-theme' ); ?>
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
