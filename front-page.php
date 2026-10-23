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
                    <?php echo esc_html( get_theme_mod( 'ojis_hero_sub', __( 'Helping tourism and hospitality businesses turn sustainability into practical action — and communicate the value of what they do.', 'ojis-travels-theme' ) ) ); ?>
                </p>

                <!-- Dual CTA: For Businesses | For Travelers -->
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 hero-ctas">
                    <a
    href="<?php echo esc_url( home_url( '/contact' ) ); ?>"
    class="btn-primary inline-flex items-center gap-2 text-base px-8 py-4"
    aria-label="<?php esc_attr_e( 'Work with OJIS', 'ojis-travels-theme' ); ?>"
>
    <span class="material-symbols-outlined text-base" aria-hidden="true">handshake</span>
    <?php echo esc_html( get_theme_mod( 'ojis_hero_cta_primary', __( 'Work With OJIS', 'ojis-travels-theme' ) ) ); ?>
</a>
                    <a
    href="<?php echo esc_url( home_url( '/stories' ) ); ?>"
    class="btn-outline-white inline-flex items-center gap-2 text-base px-8 py-4"
    aria-label="<?php esc_attr_e( 'Explore OJIS Stories', 'ojis-travels-theme' ); ?>"
>
    <span class="material-symbols-outlined text-base" aria-hidden="true">auto_stories</span>
    <?php echo esc_html( get_theme_mod( 'ojis_hero_cta_secondary', __( 'Explore OJIS Stories', 'ojis-travels-theme' ) ) ); ?>
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
         SECTION 2 — WHO WE HELP
    ════════════════════════════════════════════════════════ -->
    <section class="py-24 bg-offwhite" aria-labelledby="who-we-help-heading">
        <div class="max-w-5xl mx-auto px-6">
            <div class="reveal-element">
                <span class="section-eyebrow mb-4 block"><?php esc_html_e( 'Who We Help', 'ojis-travels-theme' ); ?></span>
                <h2 id="who-we-help-heading" class="text-3xl sm:text-4xl font-bold text-charcoal leading-tight mb-6">
                    <?php esc_html_e( 'Tourism & Hospitality Businesses', 'ojis-travels-theme' ); ?>
                </h2>
                <p class="text-muted leading-relaxed mb-8 max-w-3xl text-lg">
                    <?php esc_html_e( 'Turn sustainability into action — and action into a story. OJIS combines advisory expertise with content creation and storytelling to help hospitality businesses strengthen their practices and communicate the value of what they do.', 'ojis-travels-theme' ); ?>
                </p>
                <div class="flex flex-wrap gap-3 mb-10">
                    <?php foreach ( [
                        __( 'Advisory',              'ojis-travels-theme' ),
                        __( 'Content &amp; Storytelling', 'ojis-travels-theme' ),
                        __( 'Responsible Travel',    'ojis-travels-theme' ),
                    ] as $tag ) : ?>
                    <span class="text-sm font-medium text-forest bg-forest/10 border border-forest/15 px-4 py-2 rounded-full">
                        <?php echo esc_html( $tag ); ?>
                    </span>
                    <?php endforeach; ?>
                </div>
                <a href="<?php echo esc_url( home_url( '/advisory' ) ); ?>" class="btn-primary inline-flex items-center gap-2">
                    <?php esc_html_e( 'Explore Advisory Services', 'ojis-travels-theme' ); ?>
                    <span class="material-symbols-outlined text-base" aria-hidden="true">arrow_forward</span>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         SECTION 2b — THREE PILLARS
    ════════════════════════════════════════════════════════ -->
    <section class="py-24 bg-forest relative overflow-hidden" aria-labelledby="three-pillars-heading">
        <div class="absolute inset-0 hero-pattern opacity-5" aria-hidden="true"></div>
        <div class="relative max-w-7xl mx-auto px-6">
            <div class="text-center mb-14 reveal-element">
                <span class="section-eyebrow-light mb-4 block"><?php esc_html_e( 'What We Do', 'ojis-travels-theme' ); ?></span>
                <h2 id="three-pillars-heading" class="text-3xl sm:text-4xl font-bold text-white leading-tight">
                    <?php esc_html_e( 'Three Connected Pillars', 'ojis-travels-theme' ); ?>
                </h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php
                $pillars = [
                    [
                        'number' => '01',
                        'icon'   => 'business_center',
                        'title'  => __( 'Sustainable Tourism &amp; Hospitality Advisory', 'ojis-travels-theme' ),
                        'desc'   => __( 'Practical sustainability guidance, strategy, assessments, and certification support for tourism and hospitality businesses.', 'ojis-travels-theme' ),
                        'link'   => home_url( '/advisory' ),
                        'cta'    => __( 'Learn More', 'ojis-travels-theme' ),
                    ],
                    [
                        'number' => '02',
                        'icon'   => 'auto_stories',
                        'title'  => __( 'Sustainable Tourism &amp; Hospitality Stories', 'ojis-travels-theme' ),
                        'desc'   => __( 'An editorial platform documenting the people, places, and practices shaping a more sustainable future for tourism and hospitality.', 'ojis-travels-theme' ),
                        'link'   => home_url( '/stories' ),
                        'cta'    => __( 'Read Stories', 'ojis-travels-theme' ),
                    ],
                    [
                        'number' => '03',
                        'icon'   => 'flight_takeoff',
                        'title'  => __( 'Responsible Travel Advisory', 'ojis-travels-theme' ),
                        'desc'   => __( 'Helping travellers plan meaningful, responsible journeys through personalised consultations and curated itineraries.', 'ojis-travels-theme' ),
                        'link'   => home_url( '/travel' ),
                        'cta'    => __( 'Plan Your Journey', 'ojis-travels-theme' ),
                    ],
                ];
                foreach ( $pillars as $k => $p ) : ?>
                <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-3xl p-8 reveal-element flex flex-col" style="transition-delay:<?php echo esc_attr( $k * 120 ); ?>ms">
                    <div class="flex items-center gap-3 mb-5">
                        <span class="text-white/40 text-4xl font-bold leading-none"><?php echo esc_html( $p['number'] ); ?></span>
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-eco/20 flex items-center justify-center">
                            <span class="material-symbols-outlined text-eco text-2xl" aria-hidden="true"><?php echo esc_html( $p['icon'] ); ?></span>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3 leading-snug"><?php echo esc_html( $p['title'] ); ?></h3>
                    <p class="text-white/70 text-sm leading-relaxed flex-1 mb-6"><?php echo esc_html( $p['desc'] ); ?></p>
                    <a href="<?php echo esc_url( $p['link'] ); ?>" class="inline-flex items-center gap-2 text-eco font-semibold text-sm hover:text-white transition-colors duration-200">
                        <?php echo esc_html( $p['cta'] ); ?>
                        <span class="material-symbols-outlined text-base" aria-hidden="true">arrow_forward</span>
                    </a>
                </div>
                <?php endforeach; ?>
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
                            <p class="text-eco text-sm font-semibold mt-1"><?php echo esc_html( get_theme_mod( 'ojis_founder_title', __( 'Founder | Sustainable Tourism & Hospitality Advisor | Creator & Storyteller', 'ojis-travels-theme' ) ) ); ?></p>
                            <p class="text-white/60 text-xs mt-2 leading-relaxed">
                                <?php esc_html_e( 'OJIS Travels & Advisory', 'ojis-travels-theme' ); ?>
                            </p>
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

                        <div class="space-y-4 text-lg text-charcoal leading-relaxed mb-6 font-medium">
                            <p><?php esc_html_e( 'I founded OJIS Travels & Advisory out of a deep passion for service to humanity, travel, and storytelling — and, above all, a belief that tourism can be a force for positive change.', 'ojis-travels-theme' ); ?></p>
                            <p><?php esc_html_e( 'I believe sustainability in tourism and hospitality, in Africa and around the world, should be practical, relevant, and achievable — not an abstract ideal, but something that can be understood, communicated, and applied in practice.', 'ojis-travels-theme' ); ?></p>
                        </div>

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
         SECTION — OUR PHILOSOPHY (after Founder)
    ════════════════════════════════════════════════════════ -->
    <section class="bg-forest relative overflow-hidden" aria-labelledby="philosophy-heading">
        <div class="absolute inset-0 hero-pattern opacity-5" aria-hidden="true"></div>
        <div class="relative max-w-5xl mx-auto px-6 pt-20 pb-20 text-center reveal-element">
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
                    <span class="section-eyebrow"><?php esc_html_e( 'OJIS Perspectives', 'ojis-travels-theme' ); ?></span>
                    <h2 id="insights-heading" class="section-heading mt-2">
                        <?php esc_html_e( 'OJIS Perspectives', 'ojis-travels-theme' ); ?>
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
         SECTION 7 — FINAL CTA
    ════════════════════════════════════════════════════════ -->
    <section
        class="py-24 bg-gradient-to-br from-forest to-charcoal relative overflow-hidden"
        aria-labelledby="final-cta-heading"
    >
        <div class="absolute inset-0 hero-pattern opacity-5" aria-hidden="true"></div>
        <div class="relative max-w-3xl mx-auto px-6 text-center">
            <div class="reveal-element">
                <span class="material-symbols-outlined text-eco text-5xl mb-6 block" aria-hidden="true">handshake</span>
                <h2 id="final-cta-heading" class="text-3xl sm:text-4xl font-bold text-white mb-4">
                    <?php esc_html_e( 'Let\'s create more responsible tourism — one practical step at a time.', 'ojis-travels-theme' ); ?>
                </h2>
                <p class="text-white/70 text-lg mb-10 leading-relaxed">
                    <?php esc_html_e( 'Whether you are a hospitality business, a destination, or a traveller, we have the expertise to support your sustainability journey.', 'ojis-travels-theme' ); ?>
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a
                        href="<?php echo esc_url( home_url( '/contact' ) ); ?>"
                        class="btn-eco inline-flex items-center gap-2 px-8 py-4 text-base"
                    >
                        <span class="material-symbols-outlined text-base" aria-hidden="true">handshake</span>
                        <?php esc_html_e( 'Work With OJIS', 'ojis-travels-theme' ); ?>
                    </a>
                    <a
                        href="<?php echo esc_url( home_url( '/contact' ) ); ?>"
                        class="btn-outline-white inline-flex items-center gap-2 px-8 py-4 text-base"
                    >
                        <span class="material-symbols-outlined text-base" aria-hidden="true">mail</span>
                        <?php esc_html_e( 'Start a Conversation', 'ojis-travels-theme' ); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
