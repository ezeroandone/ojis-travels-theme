<?php
/**
 * OJIS Travels Theme — Homepage (front-page.php)
 *
 * @package ojis-travels-theme
 */

get_header(); ?>

<main id="main-content" class="site-main overflow-x-hidden">

    <!-- ═══════════════════════════════════════════════════════
         SECTION 1 — HERO
    ════════════════════════════════════════════════════════ -->
    <section
        class="hero-section relative min-h-screen flex items-center justify-center overflow-hidden"
        aria-label="<?php esc_attr_e( 'Hero', 'ojis-travels-theme' ); ?>"
    >
        <!-- Background Image -->
        <?php $hero_bg = get_theme_mod( 'ojis_hero_bg', OJIS_THEME_URI . '/assets/images/hero.webp' ); ?>
        <div
            class="absolute inset-0 bg-cover bg-center bg-no-repeat"
            style="background-image: url('<?php echo esc_url( $hero_bg ); ?>')"
            role="img"
            aria-label="<?php esc_attr_e( 'African landscape representing sustainable tourism and hospitality', 'ojis-travels-theme' ); ?>"
        ></div>
        <div class="absolute inset-0 bg-gradient-to-br from-charcoal/85 via-forest/70 to-charcoal/60" aria-hidden="true"></div>
        <div class="absolute inset-0 hero-pattern opacity-5" aria-hidden="true"></div>

        <!-- Hero Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-6 pt-24 pb-24 sm:pb-16 flex flex-col lg:flex-row items-center gap-16">

            <div class="flex-1 text-center lg:text-left max-w-3xl">

                <!-- Eyebrow — African perspective line -->
                <p class="text-eco/90 text-xs sm:text-sm font-semibold uppercase tracking-widest mb-5 hero-badge">
                    <?php echo esc_html( get_theme_mod( 'ojis_hero_badge', __( 'African Perspective. Global Outlook. Local Impact.', 'ojis-travels-theme' ) ) ); ?>
                </p>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight tracking-tight mb-6 hero-headline">
                    <?php echo esc_html( get_theme_mod( 'ojis_hero_headline', __( 'Sustainable Tourism & Hospitality Made Practical.', 'ojis-travels-theme' ) ) ); ?>
                </h1>

                <p class="text-lg sm:text-xl text-white/80 leading-relaxed mb-10 max-w-2xl mx-auto lg:mx-0 hero-sub">
                    <?php echo esc_html( get_theme_mod( 'ojis_hero_sub', __( 'Helping tourism and hospitality businesses operate more sustainably — and travellers explore more responsibly.', 'ojis-travels-theme' ) ) ); ?>
                </p>

                <!-- Dual CTA: For Businesses | For Travelers -->
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 hero-ctas">
                    <a
                        href="<?php echo esc_url( home_url( '/services#advisory' ) ); ?>"
                        class="btn-primary inline-flex items-center gap-2 text-base px-8 py-4"
                        aria-label="<?php esc_attr_e( 'Advisory services for businesses', 'ojis-travels-theme' ); ?>"
                    >
                        <span class="material-symbols-outlined text-base" aria-hidden="true">business_center</span>
                        <?php echo esc_html( get_theme_mod( 'ojis_hero_cta_primary', __( 'For Businesses', 'ojis-travels-theme' ) ) ); ?>
                    </a>
                    <a
                        href="<?php echo esc_url( home_url( '/services#travel' ) ); ?>"
                        class="btn-outline-white inline-flex items-center gap-2 text-base px-8 py-4"
                        aria-label="<?php esc_attr_e( 'Sustainable travel services for travellers', 'ojis-travels-theme' ); ?>"
                    >
                        <span class="material-symbols-outlined text-base" aria-hidden="true">flight_takeoff</span>
                        <?php echo esc_html( get_theme_mod( 'ojis_hero_cta_secondary', __( 'For Travelers', 'ojis-travels-theme' ) ) ); ?>
                    </a>
                </div>

                <!-- Tagline strip — hidden on mobile to avoid scroll-button overlap -->
                <p class="hidden sm:block mt-10 text-white/50 text-xs uppercase tracking-widest hero-badge">
                    <?php esc_html_e( 'People &bull; Places &bull; A More Sustainable Tomorrow', 'ojis-travels-theme' ); ?>
                </p>
            </div>

            <!-- Hero stat cards -->
            <div class="hidden lg:flex flex-col gap-4 flex-shrink-0 hero-stats">
                <?php
                $stats = [
                    [ 'value' => '3+',     'label' => __( 'Service Areas',        'ojis-travels-theme' ), 'icon' => 'category' ],
                    [ 'value' => 'Africa', 'label' => __( 'Primary Focus Region', 'ojis-travels-theme' ), 'icon' => 'public'   ],
                    [ 'value' => 'GSTC',   'label' => __( 'Trained Professional', 'ojis-travels-theme' ), 'icon' => 'verified' ],
                ];
                foreach ( $stats as $stat ) : ?>
                <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-5 text-white min-w-[180px]">
                    <div class="flex items-center gap-3 mb-1">
                        <span class="material-symbols-outlined text-eco text-xl" aria-hidden="true"><?php echo esc_html( $stat['icon'] ); ?></span>
                        <span class="text-2xl font-bold"><?php echo esc_html( $stat['value'] ); ?></span>
                    </div>
                    <p class="text-white/70 text-sm"><?php echo esc_html( $stat['label'] ); ?></p>
                </div>
                <?php endforeach; ?>
            </div>

        </div>

        <!-- Scroll indicator — sits outside content flow, clear of tagline on all screens -->
        <button
            id="hero-scroll-btn"
            class="hero-scroll-indicator absolute bottom-6 sm:bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1 cursor-pointer bg-transparent border-0 p-2 rounded-xl hover:scale-110 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 transition-transform duration-200"
            aria-label="<?php esc_attr_e( 'Scroll to next section', 'ojis-travels-theme' ); ?>"
            type="button"
        >
            <span class="hidden sm:block text-white/60 text-xs uppercase tracking-widest font-medium"><?php esc_html_e( 'Scroll', 'ojis-travels-theme' ); ?></span>
            <span class="material-symbols-outlined text-white/60 text-2xl" aria-hidden="true">keyboard_arrow_down</span>
        </button>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         SECTION 2 — B2B + B2C SERVICES (replaces old pillars/overview)
    ════════════════════════════════════════════════════════ -->
    <section class="py-0 bg-offwhite" aria-label="<?php esc_attr_e( 'Services for businesses and travellers', 'ojis-travels-theme' ); ?>">
        <div class="max-w-7xl mx-auto px-6">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 lg:gap-px bg-gray-200">

                <!-- ── For Businesses ─────────────────────── -->
                <div id="services-businesses" class="bg-offwhite py-20 px-8 lg:px-14 reveal-element">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-forest/10 mb-6">
                        <span class="material-symbols-outlined text-forest text-2xl" aria-hidden="true">business_center</span>
                    </div>
                    <span class="section-eyebrow mb-4 block"><?php esc_html_e( 'For Tourism & Hospitality Businesses', 'ojis-travels-theme' ); ?></span>
                    <h2 class="text-2xl sm:text-3xl font-bold text-charcoal leading-tight mb-4">
                        <?php esc_html_e( 'Turn sustainability into practical action.', 'ojis-travels-theme' ); ?>
                    </h2>
                    <p class="text-muted leading-relaxed mb-6">
                        <?php esc_html_e( 'OJIS works with hotels, hospitality businesses and tourism organisations to identify practical opportunities to improve sustainability, strengthen operations and create positive impact.', 'ojis-travels-theme' ); ?>
                    </p>
                    <p class="text-xs font-semibold uppercase tracking-widest text-muted mb-3"><?php esc_html_e( 'Services include:', 'ojis-travels-theme' ); ?></p>
                    <div class="flex flex-wrap gap-2 mb-8">
                        <?php foreach ( [
                            __( 'Sustainability Advisory',        'ojis-travels-theme' ),
                            __( 'Sustainability Assessments',     'ojis-travels-theme' ),
                            __( 'Strategy & Action Planning',     'ojis-travels-theme' ),
                            __( 'Staff Awareness & Training',     'ojis-travels-theme' ),
                            __( 'Responsible Tourism Guidance',   'ojis-travels-theme' ),
                        ] as $tag ) : ?>
                        <span class="text-xs font-medium text-forest bg-forest/10 border border-forest/15 px-3 py-1.5 rounded-full">
                            <?php echo esc_html( $tag ); ?>
                        </span>
                        <?php endforeach; ?>
                    </div>
                    <a href="<?php echo esc_url( home_url( '/services' ) ); ?>" class="btn-primary inline-flex items-center gap-2">
                        <?php esc_html_e( 'Explore Advisory Services', 'ojis-travels-theme' ); ?>
                        <span class="material-symbols-outlined text-base" aria-hidden="true">arrow_forward</span>
                    </a>
                </div>

                <!-- ── For Travelers ──────────────────────── -->
                <div id="services-travelers" class="bg-white py-20 px-8 lg:px-14 reveal-element" style="transition-delay:120ms">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-eco/10 mb-6">
                        <span class="material-symbols-outlined text-eco-alt text-2xl" aria-hidden="true">flight_takeoff</span>
                    </div>
                    <span class="section-eyebrow mb-4 block"><?php esc_html_e( 'For Travelers', 'ojis-travels-theme' ); ?></span>
                    <h2 class="text-2xl sm:text-3xl font-bold text-charcoal leading-tight mb-4">
                        <?php esc_html_e( 'Travel better. Experience more. Leave a lighter footprint.', 'ojis-travels-theme' ); ?>
                    </h2>
                    <p class="text-muted leading-relaxed mb-6">
                        <?php esc_html_e( 'We help travellers plan meaningful journeys through personalised consultations and thoughtfully designed itineraries that consider local communities, culture and environmental impact.', 'ojis-travels-theme' ); ?>
                    </p>
                    <p class="text-xs font-semibold uppercase tracking-widest text-muted mb-3"><?php esc_html_e( 'Services include:', 'ojis-travels-theme' ); ?></p>
                    <div class="flex flex-wrap gap-2 mb-8">
                        <?php foreach ( [
                            __( 'Sustainable Travel Consultations',         'ojis-travels-theme' ),
                            __( 'Personalised Itineraries',                 'ojis-travels-theme' ),
                            __( 'Responsible Accommodation Recommendations','ojis-travels-theme' ),
                            __( 'Destination Planning',                     'ojis-travels-theme' ),
                        ] as $tag ) : ?>
                        <span class="text-xs font-medium text-eco-alt bg-eco/10 border border-eco/20 px-3 py-1.5 rounded-full">
                            <?php echo esc_html( $tag ); ?>
                        </span>
                        <?php endforeach; ?>
                    </div>
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-eco inline-flex items-center gap-2">
                        <?php esc_html_e( 'Plan Your Journey', 'ojis-travels-theme' ); ?>
                        <span class="material-symbols-outlined text-base" aria-hidden="true">arrow_forward</span>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         SECTION 3 — BRAND PHILOSOPHY + IMPACT COUNTERS (unified)
    ════════════════════════════════════════════════════════ -->
    <section class="bg-forest relative overflow-hidden" aria-labelledby="philosophy-heading">
        <div class="absolute inset-0 hero-pattern opacity-5" aria-hidden="true"></div>

        <!-- Philosophy headline block -->
        <div class="relative max-w-5xl mx-auto px-6 pt-20 pb-14 text-center reveal-element">
            <span class="section-eyebrow-light mb-6 block"><?php esc_html_e( 'Our Philosophy', 'ojis-travels-theme' ); ?></span>
            <h2 id="philosophy-heading" class="text-3xl sm:text-4xl font-bold text-white mb-6 leading-tight">
                <?php esc_html_e( 'Progress Over Perfection', 'ojis-travels-theme' ); ?>
            </h2>
            <p class="text-white/80 text-lg leading-relaxed mb-6 max-w-3xl mx-auto">
                <?php esc_html_e( 'Whether we are helping a hotel improve its operations or helping a traveller make more responsible choices, our goal remains the same:', 'ojis-travels-theme' ); ?>
            </p>
            <p class="text-eco font-semibold text-xl mb-8">
                <?php esc_html_e( 'To make sustainable tourism practical, relevant and accessible.', 'ojis-travels-theme' ); ?>
            </p>
            <div class="inline-flex items-center gap-3 bg-white/10 border border-white/20 rounded-2xl px-8 py-4">
                <span class="material-symbols-outlined text-eco text-xl" aria-hidden="true">public</span>
                <span class="text-white font-medium text-sm tracking-wide">
                    <?php esc_html_e( 'African Perspective. Global Outlook. Local Impact.', 'ojis-travels-theme' ); ?>
                </span>
            </div>
        </div>

        <!-- Impact counters — directly inside the philosophy section, no separate section -->
        <div class="relative border-t border-white/10 bg-charcoal/30 py-16">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                    <?php
                    $counters = [
                        [ 'end' => get_theme_mod( 'ojis_counter_1_value', '3' ),    'suffix' => get_theme_mod( 'ojis_counter_1_suffix', '+' ),  'label' => get_theme_mod( 'ojis_counter_1_label', __( 'Core Service Areas',       'ojis-travels-theme' ) ), 'icon' => 'category'  ],
                        [ 'end' => get_theme_mod( 'ojis_counter_2_value', '100' ),  'suffix' => get_theme_mod( 'ojis_counter_2_suffix', '%' ),  'label' => get_theme_mod( 'ojis_counter_2_label', __( 'Africa-Focused Approach',  'ojis-travels-theme' ) ), 'icon' => 'public'    ],
                        [ 'end' => get_theme_mod( 'ojis_counter_3_value', '1' ),    'suffix' => get_theme_mod( 'ojis_counter_3_suffix', '' ),   'label' => get_theme_mod( 'ojis_counter_3_label', __( 'GSTC Trained Founder',     'ojis-travels-theme' ) ), 'icon' => 'school'    ],
                        [ 'end' => get_theme_mod( 'ojis_counter_4_value', '2026' ), 'suffix' => get_theme_mod( 'ojis_counter_4_suffix', '' ),   'label' => get_theme_mod( 'ojis_counter_4_label', __( 'Year of Full Operations',  'ojis-travels-theme' ) ), 'icon' => 'event'     ],
                    ];
                    foreach ( $counters as $k => $counter ) : ?>
                    <div class="reveal-element" style="transition-delay: <?php echo esc_attr( $k * 100 ); ?>ms">
                        <span class="material-symbols-outlined text-eco text-3xl mb-3 block" aria-hidden="true"><?php echo esc_html( $counter['icon'] ); ?></span>
                        <div
                            class="impact-counter text-5xl font-bold text-white mb-2"
                            data-end="<?php echo esc_attr( $counter['end'] ); ?>"
                            data-suffix="<?php echo esc_attr( $counter['suffix'] ); ?>"
                            aria-label="<?php echo esc_attr( $counter['end'] . $counter['suffix'] . ' ' . $counter['label'] ); ?>"
                        >0</div>
                        <p class="text-white/70 text-sm"><?php echo esc_html( $counter['label'] ); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         SECTION 5 — FOUNDER STATEMENT EXCERPT
    ════════════════════════════════════════════════════════ -->
    <section
        class="py-24 bg-offwhite"
        aria-labelledby="founder-heading"
    >
        <div class="max-w-6xl mx-auto px-6">

            <!-- Section label -->
            <div class="text-center mb-12 reveal-element">
                <span class="section-eyebrow"><?php esc_html_e( 'From the Founder', 'ojis-travels-theme' ); ?></span>
                <h2 id="founder-heading" class="section-heading mt-3">
                    <?php esc_html_e( 'A Message from Our Founder', 'ojis-travels-theme' ); ?>
                </h2>
            </div>

            <!-- Card: photo left, quote right -->
            <div class="bg-white rounded-3xl shadow-md border border-gray-100 overflow-hidden reveal-element">
                <div class="grid grid-cols-1 lg:grid-cols-5">

                    <!-- Left: founder portrait + identity -->
                    <div class="lg:col-span-2 bg-gradient-to-b from-forest to-charcoal flex flex-col items-center justify-center p-10 gap-6 text-center">

                        <!-- Founder photo -->
                        <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-eco/40 shadow-xl flex-shrink-0">
                            <img
                                src="<?php echo esc_url( OJIS_THEME_URI . '/assets/images/founder.jpg' ); ?>"
                                alt="<?php esc_attr_e( 'Omoaghe Jeffrey Edene — Founder, OJIS Travels & Advisory', 'ojis-travels-theme' ); ?>"
                                class="w-full h-full object-cover object-top"
                                loading="lazy"
                                width="128"
                                height="128"
                            >
                        </div>

                        <div>
                            <p class="text-white font-bold text-lg leading-snug"><?php echo esc_html( get_theme_mod( 'ojis_founder_name', 'Omoaghe Jeffrey Edene' ) ); ?></p>
                            <p class="text-eco text-sm font-semibold mt-1"><?php echo esc_html( get_theme_mod( 'ojis_founder_title', __( 'Founder', 'ojis-travels-theme' ) ) ); ?></p>
                            <p class="text-white/60 text-xs mt-2 leading-relaxed">
                                <?php esc_html_e( 'OJIS Travels & Advisory', 'ojis-travels-theme' ); ?>
                            </p>
                        </div>

                        <!-- Credentials badges -->
                        <div class="flex flex-wrap justify-center gap-2 mt-2">
                            <?php foreach ( [
                                'Tourism & Hospitality',
                                'MSc Business Management',
                                'GSTC Trained',
                            ] as $cred ) : ?>
                            <span class="text-xs text-white/70 bg-white/10 border border-white/15 px-3 py-1 rounded-full">
                                <?php echo esc_html( $cred ); ?>
                            </span>
                            <?php endforeach; ?>
                        </div>

                    </div>

                    <!-- Right: quote content -->
                    <div class="lg:col-span-3 p-10 lg:p-14 flex flex-col justify-center">

                        <!-- Proper typographic open-quote SVG -->
                        <div class="text-forest mb-5" aria-hidden="true">
                            <svg width="44" height="34" viewBox="0 0 48 36" fill="currentColor" opacity="0.3" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 36V22.5C0 16.5 1.5 11.625 4.5 7.875C7.5 4.125 11.625 1.5 16.875 0L19.5 4.5C16.25 5.625 13.75 7.5 12 10.125C10.25 12.625 9.375 15.375 9.375 18.375H18.75V36H0ZM27 36V22.5C27 16.5 28.5 11.625 31.5 7.875C34.5 4.125 38.625 1.5 43.875 0L46.5 4.5C43.25 5.625 40.75 7.5 39 10.125C37.25 12.625 36.375 15.375 36.375 18.375H45.75V36H27Z"/>
                            </svg>
                        </div>

                        <blockquote class="text-lg text-charcoal leading-relaxed mb-6 font-medium">
                            <?php echo esc_html( get_theme_mod( 'ojis_founder_quote', __( 'I founded OJIS Travels & Advisory because I believe sustainability should be practical, relevant, and achievable — not complicated or reserved for a select few. Our philosophy is simple: progress over perfection. Every informed choice and responsible action contributes to a more sustainable future.', 'ojis-travels-theme' ) ) ); ?>
                        </blockquote>

                        <!-- Philosophy pull-quote -->
                        <div class="border-l-4 border-eco pl-5 mb-8">
                            <p class="text-forest font-semibold text-base italic">
                                <?php esc_html_e( '"Progress over perfection. Every step forward matters."', 'ojis-travels-theme' ); ?>
                            </p>
                        </div>

                        <a
                            href="<?php echo esc_url( home_url( '/about' ) ); ?>"
                            class="inline-flex items-center gap-2 text-forest font-semibold text-sm hover:text-eco-alt transition-colors duration-200 group"
                        >
                            <?php esc_html_e( 'Read the Full Statement', 'ojis-travels-theme' ); ?>
                            <span class="material-symbols-outlined text-base transition-transform duration-200 group-hover:translate-x-1" aria-hidden="true">arrow_forward</span>
                        </a>

                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         SECTION 6 — LATEST INSIGHTS
    ════════════════════════════════════════════════════════ -->
    <?php
    $recent_posts = new WP_Query( [
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ] );

    if ( $recent_posts->have_posts() ) : ?>
    <section
        class="py-24 bg-white"
        aria-labelledby="insights-heading"
    >
        <div class="max-w-7xl mx-auto px-6">

            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6 mb-12 reveal-element">
                <div>
                    <span class="section-eyebrow"><?php esc_html_e( 'Stay Informed', 'ojis-travels-theme' ); ?></span>
                    <h2 id="insights-heading" class="section-heading mt-2">
                        <?php esc_html_e( 'Latest Insights', 'ojis-travels-theme' ); ?>
                    </h2>
                </div>
                <a
                    href="<?php echo esc_url( home_url( '/insights' ) ); ?>"
                    class="inline-flex items-center gap-2 text-forest font-semibold text-sm hover:text-eco-alt transition-colors duration-200 flex-shrink-0"
                >
                    <?php esc_html_e( 'View All Articles', 'ojis-travels-theme' ); ?>
                    <span class="material-symbols-outlined text-base" aria-hidden="true">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
                <article class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col reveal-element" aria-labelledby="post-title-<?php the_ID(); ?>">
                    <?php if ( has_post_thumbnail() ) : ?>
                    <a href="<?php the_permalink(); ?>" class="block overflow-hidden aspect-video" tabindex="-1" aria-hidden="true">
                        <?php the_post_thumbnail( 'ojis-card', [
                            'class'   => 'w-full h-full object-cover transition-transform duration-500 hover:scale-105',
                            'loading' => 'lazy',
                        ] ); ?>
                    </a>
                    <?php endif; ?>
                    <div class="p-6 flex flex-col flex-1">
                        <div class="flex items-center gap-2 mb-3">
                            <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" class="text-xs text-muted">
                                <?php echo esc_html( get_the_date() ); ?>
                            </time>
                        </div>
                        <h3 id="post-title-<?php the_ID(); ?>" class="text-lg font-bold text-charcoal mb-2 leading-snug">
                            <a href="<?php the_permalink(); ?>" class="hover:text-forest transition-colors duration-200">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                        <p class="text-muted text-sm leading-relaxed flex-1 mb-4"><?php the_excerpt(); ?></p>
                        <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-1 text-sm font-semibold text-forest hover:text-eco-alt transition-colors duration-200">
                            <?php esc_html_e( 'Read More', 'ojis-travels-theme' ); ?>
                            <span class="material-symbols-outlined text-base" aria-hidden="true">arrow_forward</span>
                        </a>
                    </div>
                </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>

        </div>
    </section>
    <?php endif; ?>

    <!-- ═══════════════════════════════════════════════════════
         SECTION 6b — VALUES STRIP (visual density + brand reinforcement)
    ════════════════════════════════════════════════════════ -->
    <section class="py-16 bg-offwhite border-y border-gray-200" aria-label="<?php esc_attr_e( 'Why OJIS', 'ojis-travels-theme' ); ?>">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php
                $values = [
                    [ 'icon' => 'verified',      'title' => __( 'GSTC-Grounded',        'ojis-travels-theme' ), 'text' => __( 'Our advisory is rooted in Global Sustainable Tourism Council frameworks and real-world experience.', 'ojis-travels-theme' ) ],
                    [ 'icon' => 'public',        'title' => __( 'African Perspective',   'ojis-travels-theme' ), 'text' => __( 'We understand the specific context, opportunities and challenges of tourism across Africa.', 'ojis-travels-theme' ) ],
                    [ 'icon' => 'trending_up',   'title' => __( 'Practical Approach',    'ojis-travels-theme' ), 'text' => __( 'No jargon. No one-size-fits-all. Actionable guidance tailored to your business or journey.', 'ojis-travels-theme' ) ],
                    [ 'icon' => 'handshake',     'title' => __( 'Progress Over Perfection', 'ojis-travels-theme' ), 'text' => __( 'Every informed step forward contributes to a more responsible, resilient tourism sector.', 'ojis-travels-theme' ) ],
                ];
                foreach ( $values as $v ) : ?>
                <div class="flex items-start gap-4 reveal-element">
                    <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-forest/10 flex items-center justify-center mt-0.5">
                        <span class="material-symbols-outlined text-forest text-lg" aria-hidden="true"><?php echo esc_html( $v['icon'] ); ?></span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-charcoal text-sm mb-1"><?php echo esc_html( $v['title'] ); ?></h3>
                        <p class="text-muted text-xs leading-relaxed"><?php echo esc_html( $v['text'] ); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         SECTION 7 — NEWSLETTER CTA
    ════════════════════════════════════════════════════════ -->
    <section
        class="py-24 bg-gradient-to-br from-forest to-charcoal relative overflow-hidden"
        aria-labelledby="newsletter-cta-heading"
    >
        <div class="absolute inset-0 hero-pattern opacity-5" aria-hidden="true"></div>
        <div class="relative max-w-3xl mx-auto px-6 text-center">
            <div class="reveal-element">
                <span class="material-symbols-outlined text-eco text-5xl mb-6 block" aria-hidden="true">eco</span>
                <h2 id="newsletter-cta-heading" class="text-3xl sm:text-4xl font-bold text-white mb-4">
                    <?php echo esc_html( get_theme_mod( 'ojis_newsletter_heading', __( 'Join the Movement for Responsible Travel', 'ojis-travels-theme' ) ) ); ?>
                </h2>
                <p class="text-white/70 text-lg mb-10 leading-relaxed">
                    <?php echo esc_html( get_theme_mod( 'ojis_newsletter_sub', __( 'Get sustainable travel insights, hospitality industry updates, and practical tips delivered to your inbox.', 'ojis-travels-theme' ) ) ); ?>
                </p>

                <form
                    id="homepage-newsletter-form"
                    class="flex flex-col sm:flex-row gap-3 max-w-xl mx-auto"
                    novalidate
                    aria-label="<?php esc_attr_e( 'Newsletter subscription', 'ojis-travels-theme' ); ?>"
                >
                    <label for="homepage-email" class="sr-only"><?php esc_html_e( 'Email address', 'ojis-travels-theme' ); ?></label>
                    <input
                        type="email"
                        id="homepage-email"
                        name="email"
                        placeholder="<?php esc_attr_e( 'Enter your email address', 'ojis-travels-theme' ); ?>"
                        required
                        autocomplete="email"
                        class="flex-1 bg-white/15 border border-white/25 text-white placeholder-white/50 rounded-xl px-5 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-eco focus:border-transparent transition-all duration-200"
                        aria-required="true"
                        aria-describedby="homepage-newsletter-status"
                    >
                    <button
                        type="submit"
                        class="btn-eco inline-flex items-center justify-center gap-2 px-7 py-4 flex-shrink-0"
                        aria-label="<?php esc_attr_e( 'Subscribe to newsletter', 'ojis-travels-theme' ); ?>"
                    >
                        <?php esc_html_e( 'Subscribe', 'ojis-travels-theme' ); ?>
                        <span class="material-symbols-outlined text-base" aria-hidden="true">send</span>
                    </button>
                </form>
                <p id="homepage-newsletter-status" class="mt-4 text-sm text-white/70 hidden" role="status" aria-live="polite"></p>
                <p class="text-white/40 text-xs mt-4">
                    <?php esc_html_e( 'No spam, ever. Unsubscribe at any time.', 'ojis-travels-theme' ); ?>
                </p>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
