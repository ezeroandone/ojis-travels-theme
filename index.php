<?php
/**
 * OJIS Travels Theme — Fallback Index
 *
 * Handles: 404, category/tag/date archives, search results, and blog index.
 *
 * @package ojis-travels-theme
 */

get_header();

/* ── Determine hero content based on context ─────────────── */
$hero_eyebrow = '';
$hero_title   = '';
$hero_sub     = '';
$is_404       = is_404();

if ( $is_404 ) {
    $hero_eyebrow = __( '404 — Page Not Found', 'ojis-travels-theme' );
    $hero_title   = __( 'Oops. This page doesn\'t exist.', 'ojis-travels-theme' );
    $hero_sub     = __( 'The page you are looking for may have been moved, renamed, or no longer exists. Let\'s get you back on track.', 'ojis-travels-theme' );
} elseif ( is_archive() ) {
    $hero_eyebrow = __( 'OJIS Perspectives', 'ojis-travels-theme' );
    if ( is_category() ) {
        $hero_title = single_cat_title( '', false );
        $hero_sub   = get_the_archive_description();
        if ( empty( $hero_sub ) ) {
            $hero_sub = __( 'Exploring sustainable tourism and hospitality through an African perspective and a global outlook.', 'ojis-travels-theme' );
        }
    } elseif ( is_tag() ) {
        /* translators: %s: tag name */
        $hero_title = sprintf( __( 'Tag: %s', 'ojis-travels-theme' ), single_tag_title( '', false ) );
        $hero_sub   = __( 'Stories and insights tagged with this topic.', 'ojis-travels-theme' );
    } elseif ( is_date() ) {
        $hero_title = get_the_archive_title();
        $hero_sub   = __( 'Stories and insights published during this period.', 'ojis-travels-theme' );
    } else {
        $hero_title = get_the_archive_title();
        $hero_sub   = get_the_archive_description();
    }
} elseif ( is_search() ) {
    $hero_eyebrow = __( 'Search Results', 'ojis-travels-theme' );
    /* translators: %s: search query */
    $hero_title   = sprintf( __( 'Results for: "%s"', 'ojis-travels-theme' ), get_search_query() );
    $hero_sub     = __( 'Browse articles and stories matching your search.', 'ojis-travels-theme' );
} elseif ( is_home() && ! is_front_page() ) {
    $hero_eyebrow = __( 'OJIS Perspectives', 'ojis-travels-theme' );
    $hero_title   = single_post_title( '', false ) ?: __( 'Latest Stories', 'ojis-travels-theme' );
    $hero_sub     = __( 'Sustainable tourism and hospitality stories from Africa and around the world.', 'ojis-travels-theme' );
}
?>

<main id="main-content" class="site-main overflow-x-hidden">

    <?php if ( $hero_title ) : ?>
    <!-- ═══════════════════════════════════════════════════════
         PAGE HERO — full-bleed with dark overlay
    ════════════════════════════════════════════════════════ -->
    <section
        class="page-hero relative overflow-hidden min-h-[380px] flex items-center"
        aria-label="<?php echo esc_attr( $hero_title ); ?>"
    >
        <!-- Background image -->
        <div
            class="absolute inset-0 bg-cover bg-center bg-no-repeat"
            style="background-image: url('<?php echo esc_url( get_theme_mod( 'ojis_insights_hero_bg', OJIS_THEME_URI . '/assets/images/insights-hero.jpg' ) ); ?>')"
            role="img"
            aria-hidden="true"
        ></div>
        <!-- Dark overlay -->
        <div class="absolute inset-0 bg-gradient-to-br from-charcoal/90 via-charcoal/80 to-forest/70" aria-hidden="true"></div>
        <div class="hero-pattern absolute inset-0 opacity-5" aria-hidden="true"></div>

        <div class="relative max-w-7xl mx-auto px-6 pt-36 pb-20 text-center w-full">
            <?php if ( $hero_eyebrow ) : ?>
            <span class="section-eyebrow-light"><?php echo esc_html( $hero_eyebrow ); ?></span>
            <?php endif; ?>
            <h1 class="text-4xl sm:text-5xl font-bold text-white mt-3 mb-5 leading-tight">
                <?php echo esc_html( $hero_title ); ?>
            </h1>
            <?php if ( $hero_sub ) : ?>
            <p class="text-white/75 text-lg max-w-2xl mx-auto leading-relaxed">
                <?php echo esc_html( $hero_sub ); ?>
            </p>
            <?php endif; ?>

            <?php if ( $is_404 ) : ?>
            <!-- 404 actions -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mt-8">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-eco inline-flex items-center gap-2 px-8 py-4">
                    <span class="material-symbols-outlined text-base" aria-hidden="true">home</span>
                    <?php esc_html_e( 'Return Home', 'ojis-travels-theme' ); ?>
                </a>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-outline-white inline-flex items-center gap-2 px-8 py-4">
                    <span class="material-symbols-outlined text-base" aria-hidden="true">mail</span>
                    <?php esc_html_e( 'Contact Us', 'ojis-travels-theme' ); ?>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- ═══════════════════════════════════════════════════════
         CONTENT — posts grid or 404 suggestions
    ════════════════════════════════════════════════════════ -->
    <section class="py-20 bg-offwhite">
        <div class="max-w-7xl mx-auto px-6">

        <?php if ( have_posts() ) : ?>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php while ( have_posts() ) : the_post(); ?>
                <article
                    id="post-<?php the_ID(); ?>"
                    <?php post_class( 'bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col reveal-element' ); ?>
                    aria-labelledby="post-title-<?php the_ID(); ?>"
                >
                    <?php if ( has_post_thumbnail() ) : ?>
                    <a href="<?php the_permalink(); ?>" class="block overflow-hidden aspect-video" aria-hidden="true" tabindex="-1">
                        <?php the_post_thumbnail( 'ojis-card', [
                            'class'   => 'w-full h-full object-cover transition-transform duration-500 hover:scale-105',
                            'loading' => 'lazy',
                        ] ); ?>
                    </a>
                    <?php endif; ?>

                    <div class="p-6 flex flex-col flex-1">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="text-xs font-semibold uppercase tracking-widest text-eco-alt bg-eco-alt/10 px-3 py-1 rounded-full">
                                <?php the_category( ', ' ); ?>
                            </span>
                            <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" class="text-xs text-muted">
                                <?php echo esc_html( get_the_date() ); ?>
                            </time>
                        </div>

                        <h2 id="post-title-<?php the_ID(); ?>" class="text-xl font-bold text-charcoal mb-3 leading-snug">
                            <a href="<?php the_permalink(); ?>" class="hover:text-forest transition-colors duration-200">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <p class="text-muted text-sm leading-relaxed flex-1 mb-4">
                            <?php the_excerpt(); ?>
                        </p>

                        <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-1 text-sm font-semibold text-forest hover:text-eco transition-colors duration-200">
                            <?php esc_html_e( 'Read More', 'ojis-travels-theme' ); ?>
                            <span class="material-symbols-outlined text-base" aria-hidden="true">arrow_forward</span>
                        </a>
                    </div>
                </article>
                <?php endwhile; ?>
            </div>

            <?php the_posts_pagination( [
                'mid_size'  => 2,
                'prev_text' => '<span class="material-symbols-outlined" aria-hidden="true">arrow_back</span>',
                'next_text' => '<span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>',
            ] ); ?>

        <?php elseif ( $is_404 ) : ?>

            <!-- 404: suggested links -->
            <div class="max-w-2xl mx-auto text-center py-8">
                <p class="text-muted text-lg mb-10">
                    <?php esc_html_e( 'Here are some pages that might help:', 'ojis-travels-theme' ); ?>
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <?php
                    $suggestions = [
                        [ 'icon' => 'business_center', 'label' => __( 'Advisory',  'ojis-travels-theme' ), 'url' => home_url( '/advisory' ) ],
                        [ 'icon' => 'auto_stories',    'label' => __( 'Stories',   'ojis-travels-theme' ), 'url' => home_url( '/stories' ) ],
                        [ 'icon' => 'flight_takeoff',  'label' => __( 'Travel',    'ojis-travels-theme' ), 'url' => home_url( '/travel' ) ],
                        [ 'icon' => 'info',            'label' => __( 'About',     'ojis-travels-theme' ), 'url' => home_url( '/about' ) ],
                        [ 'icon' => 'mail',            'label' => __( 'Contact',   'ojis-travels-theme' ), 'url' => home_url( '/contact' ) ],
                        [ 'icon' => 'home',            'label' => __( 'Home',      'ojis-travels-theme' ), 'url' => home_url( '/' ) ],
                    ];
                    foreach ( $suggestions as $s ) : ?>
                    <a href="<?php echo esc_url( $s['url'] ); ?>" class="flex flex-col items-center gap-3 bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 text-charcoal hover:text-forest">
                        <span class="material-symbols-outlined text-forest text-3xl" aria-hidden="true"><?php echo esc_html( $s['icon'] ); ?></span>
                        <span class="font-semibold text-sm"><?php echo esc_html( $s['label'] ); ?></span>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>

        <?php else : ?>

            <!-- No results -->
            <div class="text-center py-12">
                <span class="material-symbols-outlined text-8xl text-gray-200 block mb-6" aria-hidden="true">search_off</span>
                <h2 class="text-2xl font-bold text-charcoal mb-4">
                    <?php esc_html_e( 'Nothing found', 'ojis-travels-theme' ); ?>
                </h2>
                <p class="text-muted mb-8 max-w-md mx-auto">
                    <?php esc_html_e( 'Try a different search or browse all our stories and perspectives.', 'ojis-travels-theme' ); ?>
                </p>
                <a href="<?php echo esc_url( home_url( '/stories' ) ); ?>" class="btn-primary inline-flex items-center gap-2">
                    <span class="material-symbols-outlined text-base" aria-hidden="true">auto_stories</span>
                    <?php esc_html_e( 'Browse All Stories', 'ojis-travels-theme' ); ?>
                </a>
            </div>

        <?php endif; ?>

        </div>
    </section>

</main>

<?php get_footer(); ?>
