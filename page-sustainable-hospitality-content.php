<?php
/**
 * Template Name: Sustainable Hospitality Content
 *
 * @package ojis-travels-theme
 */

get_header(); ?>

<main id="main-content" class="site-main overflow-x-hidden">

    <!-- ═══════════════════════════════════════════════════════
         PAGE HERO — full-bleed image with overlay
    ════════════════════════════════════════════════════════ -->
    <section class="page-hero relative overflow-hidden min-h-[420px] flex items-center" aria-label="<?php esc_attr_e( 'Content & Storytelling page header', 'ojis-travels-theme' ); ?>">
        <div
            class="absolute inset-0 bg-cover bg-center bg-no-repeat"
            style="background-image: url('<?php echo esc_url( OJIS_THEME_URI . '/assets/images/services-hero.jpg' ); ?>')"
            role="img"
            aria-label="<?php esc_attr_e( 'OJIS Travels & Advisory — Sustainable Hospitality Content', 'ojis-travels-theme' ); ?>"
        ></div>
        <div class="absolute inset-0 bg-gradient-to-br from-forest/80 via-charcoal/70 to-forest/70" aria-hidden="true"></div>
        <div class="hero-pattern absolute inset-0 opacity-5" aria-hidden="true"></div>
        <div class="relative max-w-7xl mx-auto px-6 pt-36 pb-20 text-center w-full">
            <span class="section-eyebrow-light"><?php esc_html_e( 'Content & Storytelling', 'ojis-travels-theme' ); ?></span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mt-3 mb-6 leading-tight">
                <?php esc_html_e( 'Tell Your Sustainability Story.', 'ojis-travels-theme' ); ?>
            </h1>
            <p class="text-white/75 text-lg max-w-2xl mx-auto leading-relaxed">
                <?php esc_html_e( 'We create authentic visual content that helps sustainable hospitality and tourism businesses communicate their story, connect with conscious travelers and showcase the people, places and practices behind their brand.', 'ojis-travels-theme' ); ?>
            </p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         SERVICES STRIP
    ════════════════════════════════════════════════════════ -->
    <section class="py-10 bg-white border-b border-gray-100" aria-label="<?php esc_attr_e( 'Content services overview', 'ojis-travels-theme' ); ?>">
        <div class="max-w-4xl mx-auto px-6">
            <div class="flex flex-wrap justify-center gap-3">
                <?php foreach ( [
                    __( 'Photography',    'ojis-travels-theme' ),
                    __( 'Video',          'ojis-travels-theme' ),
                    __( 'Storytelling',   'ojis-travels-theme' ),
                    __( 'Social Content', 'ojis-travels-theme' ),
                ] as $tag ) : ?>
                <span class="text-sm font-semibold text-forest bg-forest/10 border border-forest/20 px-5 py-2.5 rounded-full">
                    <?php echo esc_html( $tag ); ?>
                </span>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         WHAT WE CREATE
    ════════════════════════════════════════════════════════ -->
    <section class="py-24 bg-offwhite" aria-labelledby="what-we-create-heading">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-14 reveal-element">
                <span class="section-eyebrow"><?php esc_html_e( 'Our Work', 'ojis-travels-theme' ); ?></span>
                <h2 id="what-we-create-heading" class="section-heading mt-3">
                    <?php esc_html_e( 'What We Create', 'ojis-travels-theme' ); ?>
                </h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                $content_cards = [
                    [ 'icon' => 'photo_camera', 'title' => __( 'Hotel & Resort Photography', 'ojis-travels-theme' ) ],
                    [ 'icon' => 'videocam',      'title' => __( 'Reels & Short-Form Video',   'ojis-travels-theme' ) ],
                    [ 'icon' => 'movie',         'title' => __( 'Sustainability Story Films', 'ojis-travels-theme' ) ],
                    [ 'icon' => 'landscape',     'title' => __( 'Destination Stories',        'ojis-travels-theme' ) ],
                    [ 'icon' => 'smartphone',    'title' => __( 'Social Media Content',       'ojis-travels-theme' ) ],
                    [ 'icon' => 'auto_stories',  'title' => __( 'Brand Storytelling',         'ojis-travels-theme' ) ],
                ];
                foreach ( $content_cards as $k => $card ) : ?>
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 reveal-element" style="transition-delay: <?php echo esc_attr( $k * 60 ); ?>ms">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-forest/10 mb-5">
                        <span class="material-symbols-outlined text-forest text-xl" aria-hidden="true"><?php echo esc_html( $card['icon'] ); ?></span>
                    </div>
                    <h3 class="font-semibold text-charcoal text-base leading-snug"><?php echo esc_html( $card['title'] ); ?></h3>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         ABOUT OJIS
    ════════════════════════════════════════════════════════ -->
    <section class="py-24 bg-gradient-to-br from-forest to-charcoal relative overflow-hidden" aria-labelledby="about-ojis-heading">
        <div class="absolute inset-0 hero-pattern opacity-5" aria-hidden="true"></div>
        <div class="relative max-w-4xl mx-auto px-6 reveal-element">
            <div class="text-center mb-10">
                <span class="section-eyebrow-light"><?php esc_html_e( 'Our Story', 'ojis-travels-theme' ); ?></span>
                <h2 id="about-ojis-heading" class="text-3xl sm:text-4xl font-bold text-white mt-3 mb-0">
                    <?php esc_html_e( 'OJIS Travels & Advisory', 'ojis-travels-theme' ); ?>
                </h2>
            </div>
            <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-3xl p-10">
                <div class="space-y-5 text-white/85 leading-relaxed text-base">
                    <p><?php esc_html_e( 'I founded OJIS Travels & Advisory out of a passion for service to humanity and a belief that tourism can be a force for positive change. I believe sustainability in tourism and hospitality, in Africa and beyond, should be practical, relevant, and achievable — not an abstract ideal, but something that can be understood, communicated, and applied in practice.', 'ojis-travels-theme' ); ?></p>
                    <p><?php esc_html_e( 'Our philosophy is simple: progress over perfection. Every informed choice, responsible action, and meaningful collaboration contributes to a more sustainable future.', 'ojis-travels-theme' ); ?></p>
                    <p><?php esc_html_e( 'As travel and hospitality continue to grow across Africa and around the world, we have an opportunity to shape that growth responsibly. At OJIS, we help turn good intentions into informed action by educating travelers\u2026', 'ojis-travels-theme' ); ?></p>
                </div>
                <div class="mt-8 pt-6 border-t border-white/20 flex items-center gap-4">
                    <div class="w-10 h-0.5 bg-eco rounded-full flex-shrink-0" aria-hidden="true"></div>
                    <cite class="not-italic text-sm font-semibold text-white">
                        Omoaghe Jeffrey Edene
                        <span class="font-normal text-white/60 ml-1">— <?php esc_html_e( 'Founder, OJIS Travels & Advisory', 'ojis-travels-theme' ); ?></span>
                    </cite>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         CTA
    ════════════════════════════════════════════════════════ -->
    <section class="py-20 bg-gradient-to-br from-charcoal to-forest relative overflow-hidden" aria-label="<?php esc_attr_e( 'Content services call to action', 'ojis-travels-theme' ); ?>">
        <div class="absolute inset-0 hero-pattern opacity-5" aria-hidden="true"></div>
        <div class="relative max-w-4xl mx-auto px-6 text-center reveal-element">
            <span class="material-symbols-outlined text-eco text-5xl mb-6 block" aria-hidden="true">photo_camera</span>
            <h2 class="text-3xl font-bold text-white mb-4">
                <?php esc_html_e( 'Ready to Tell Your Story?', 'ojis-travels-theme' ); ?>
            </h2>
            <p class="text-white/70 text-lg mb-8 max-w-xl mx-auto">
                <?php esc_html_e( 'Get in touch and let us help you communicate your sustainability journey.', 'ojis-travels-theme' ); ?>
            </p>
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-eco inline-flex items-center gap-2 px-8 py-4 text-base">
                <span class="material-symbols-outlined" aria-hidden="true">mail</span>
                <?php esc_html_e( 'Get In Touch', 'ojis-travels-theme' ); ?>
            </a>
        </div>
    </section>

</main>

<?php get_footer(); ?>
