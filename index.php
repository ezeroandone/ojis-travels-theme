<?php
/**
 * OJIS Travels Theme — Fallback Index
 *
 * This template is the ultimate fallback. WordPress will use front-page.php
 * for the homepage and specific page templates for all custom pages.
 *
 * @package ojis-travels-theme
 */

get_header(); ?>

<main id="main-content" class="site-main min-h-screen bg-offwhite pt-24">
    <div class="container mx-auto px-6 py-20 max-w-7xl">

        <?php if ( have_posts() ) : ?>

            <header class="page-header mb-16 text-center">
                <?php
                if ( is_home() && ! is_front_page() ) {
                    echo '<h1 class="text-4xl font-bold text-charcoal">' . esc_html( single_post_title( '', false ) ) . '</h1>';
                } elseif ( is_archive() ) {
                    the_archive_title( '<h1 class="text-4xl font-bold text-charcoal mb-4">', '</h1>' );
                    the_archive_description( '<p class="text-muted text-lg mt-4 max-w-2xl mx-auto">', '</p>' );
                } elseif ( is_search() ) {
                    printf(
                        '<h1 class="text-4xl font-bold text-charcoal">%s <span class="text-forest">%s</span></h1>',
                        esc_html__( 'Search Results for:', 'ojis-travels-theme' ),
                        get_search_query()
                    );
                }
                ?>
            </header>

            <div class="posts-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col reveal-element' ); ?>>

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

                            <h2 class="text-xl font-bold text-charcoal mb-3 leading-snug">
                                <a href="<?php the_permalink(); ?>" class="hover:text-forest transition-colors duration-200">
                                    <?php the_title(); ?>
                                </a>
                            </h2>

                            <p class="text-muted text-sm leading-relaxed flex-1 mb-4">
                                <?php the_excerpt(); ?>
                            </p>

                            <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-1 text-sm font-semibold text-forest hover:text-eco transition-colors duration-200">
                                <?php esc_html_e( 'Read More', 'ojis-travels-theme' ); ?>
                                <span class="material-symbols-outlined text-base">arrow_forward</span>
                            </a>
                        </div>

                    </article>
                <?php endwhile; ?>
            </div>

            <?php
            // Pagination
            the_posts_pagination( [
                'mid_size'  => 2,
                'prev_text' => '<span class="material-symbols-outlined">arrow_back</span>',
                'next_text' => '<span class="material-symbols-outlined">arrow_forward</span>',
            ] );
            ?>

        <?php else : ?>

            <div class="not-found text-center py-20">
                <span class="material-symbols-outlined text-8xl text-gray-200 block mb-6">search_off</span>
                <h1 class="text-3xl font-bold text-charcoal mb-4">
                    <?php esc_html_e( 'Nothing found', 'ojis-travels-theme' ); ?>
                </h1>
                <p class="text-muted mb-8 max-w-md mx-auto">
                    <?php esc_html_e( 'It looks like nothing was found at this location. Try a different search or browse our latest insights.', 'ojis-travels-theme' ); ?>
                </p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-primary inline-flex items-center gap-2">
                    <span class="material-symbols-outlined">home</span>
                    <?php esc_html_e( 'Return Home', 'ojis-travels-theme' ); ?>
                </a>
            </div>

        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>
