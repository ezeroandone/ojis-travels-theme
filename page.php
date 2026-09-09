<?php
/**
 * OJIS Travels Theme — Generic Page Template
 *
 * @package ojis-travels-theme
 */

get_header(); ?>

<main id="main-content" class="site-main min-h-screen bg-offwhite">

    <!-- Page Hero -->
    <section class="page-hero bg-gradient-to-br from-forest to-charcoal pt-36 pb-16 relative overflow-hidden" aria-label="<?php esc_attr_e( 'Page header', 'ojis-travels-theme' ); ?>">
        <div class="absolute inset-0 hero-pattern opacity-5" aria-hidden="true"></div>
        <div class="relative max-w-4xl mx-auto px-6 text-center">
            <h1 class="text-4xl sm:text-5xl font-bold text-white leading-tight">
                <?php the_title(); ?>
            </h1>
            <?php if ( has_excerpt() ) : ?>
            <p class="text-white/75 text-lg mt-4 max-w-2xl mx-auto leading-relaxed">
                <?php echo wp_kses_post( get_the_excerpt() ); ?>
            </p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Page Content -->
    <div class="max-w-4xl mx-auto px-6 py-20">
        <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'bg-white rounded-3xl shadow-sm border border-gray-100 p-10 lg:p-14 prose-ojis' ); ?>>
            <?php
            the_content();

            wp_link_pages( [
                'before' => '<div class="page-links mt-8 pt-8 border-t border-gray-100">' . esc_html__( 'Pages:', 'ojis-travels-theme' ),
                'after'  => '</div>',
            ] );
            ?>
        </article>
        <?php endwhile; ?>
    </div>

</main>

<?php get_footer(); ?>
