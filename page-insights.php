<?php
/**
 * Template Name: Insights / Blog
 *
 * @package ojis-travels-theme
 */

get_header(); ?>

<main id="main-content" class="site-main overflow-x-hidden">

    <!-- ═══════════════════════════════════════════════════════
         PAGE HERO — full-bleed image with overlay
    ════════════════════════════════════════════════════════ -->
    <?php
    $insights_hero_bg  = get_theme_mod( 'ojis_insights_hero_bg',          OJIS_THEME_URI . '/assets/images/insights-hero.jpg' );
    $insights_headline = get_theme_mod( 'ojis_insights_hero_bg_headline',  '' );
    $insights_sub      = get_theme_mod( 'ojis_insights_hero_bg_sub',       '' );
    ?>
    <section class="page-hero relative overflow-hidden min-h-[380px] flex items-center" aria-label="<?php esc_attr_e( 'Insights page header', 'ojis-travels-theme' ); ?>">
        <div
            class="absolute inset-0 bg-cover bg-center bg-no-repeat"
            style="background-image: url('<?php echo esc_url( $insights_hero_bg ); ?>')"
            role="img"
            aria-label="<?php esc_attr_e( 'OJIS Travels Insights — sustainable tourism perspectives', 'ojis-travels-theme' ); ?>"
        ></div>
        <div class="absolute inset-0 bg-gradient-to-br from-charcoal/85 to-forest/70" aria-hidden="true"></div>
        <div class="hero-pattern absolute inset-0 opacity-5" aria-hidden="true"></div>
        <div class="relative max-w-7xl mx-auto px-6 pt-36 pb-20 text-center w-full">
            <span class="section-eyebrow-light"><?php esc_html_e( 'Perspectives & Analysis', 'ojis-travels-theme' ); ?></span>
            <h1 class="text-4xl sm:text-5xl font-bold text-white mt-3 mb-6">
                <?php echo esc_html( $insights_headline ?: __( 'Insights', 'ojis-travels-theme' ) ); ?>
            </h1>
            <p class="text-white/75 text-lg max-w-2xl mx-auto leading-relaxed">
                <?php echo esc_html( $insights_sub ?: __( 'Sustainable tourism updates, hospitality industry analysis, and practical knowledge for responsible travel and business.', 'ojis-travels-theme' ) ); ?>
            </p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         POSTS GRID
    ════════════════════════════════════════════════════════ -->
    <section class="py-24 bg-offwhite" aria-labelledby="insights-list-heading">
        <div class="max-w-7xl mx-auto px-6">

            <h2 id="insights-list-heading" class="sr-only"><?php esc_html_e( 'All Insights Articles', 'ojis-travels-theme' ); ?></h2>

            <!-- Category filter -->
            <?php
            $categories = get_categories( [ 'hide_empty' => true ] );
            if ( ! empty( $categories ) ) : ?>
            <div class="flex flex-wrap gap-3 mb-12 reveal-element" role="navigation" aria-label="<?php esc_attr_e( 'Filter articles by category', 'ojis-travels-theme' ); ?>">
                <a href="<?php echo esc_url( home_url( '/insights' ) ); ?>" class="filter-chip filter-chip--active">
                    <?php esc_html_e( 'All Articles', 'ojis-travels-theme' ); ?>
                </a>
                <?php foreach ( $categories as $cat ) : ?>
                <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="filter-chip">
                    <?php echo esc_html( $cat->name ); ?>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php
            $paged     = get_query_var( 'paged' ) ?: 1;
            $the_query = new WP_Query( [
                'post_type'      => 'post',
                'posts_per_page' => 9,
                'paged'          => $paged,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
            ] );
            ?>

            <?php if ( $the_query->have_posts() ) : ?>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php $n = 0; while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <article
                        id="post-<?php the_ID(); ?>"
                        <?php post_class( 'bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col reveal-element' ); ?>
                        aria-labelledby="insights-post-<?php the_ID(); ?>"
                        style="transition-delay: <?php echo esc_attr( ( $n % 3 ) * 100 ); ?>ms"
                    >
                        <?php if ( has_post_thumbnail() ) : ?>
                        <a href="<?php the_permalink(); ?>" class="block overflow-hidden aspect-video" tabindex="-1" aria-hidden="true">
                            <?php the_post_thumbnail( 'ojis-card', [
                                'class'   => 'w-full h-full object-cover transition-transform duration-500 hover:scale-105',
                                'loading' => 'lazy',
                            ] ); ?>
                        </a>
                        <?php else : ?>
                        <div class="aspect-video bg-gradient-to-br from-forest/20 to-eco/10 flex items-center justify-center" aria-hidden="true">
                            <span class="material-symbols-outlined text-5xl text-forest/40">article</span>
                        </div>
                        <?php endif; ?>

                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex items-center gap-3 flex-wrap mb-3">
                                <?php
                                $cats = get_the_category();
                                if ( ! empty( $cats ) ) : ?>
                                <a
                                    href="<?php echo esc_url( get_category_link( $cats[0]->term_id ) ); ?>"
                                    class="text-xs font-semibold text-eco-alt bg-eco-alt/10 px-3 py-1 rounded-full hover:bg-eco-alt/20 transition-colors duration-200"
                                >
                                    <?php echo esc_html( $cats[0]->name ); ?>
                                </a>
                                <?php endif; ?>
                                <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" class="text-xs text-muted">
                                    <?php echo esc_html( get_the_date() ); ?>
                                </time>
                            </div>

                            <h2 id="insights-post-<?php the_ID(); ?>" class="text-lg font-bold text-charcoal mb-2 leading-snug">
                                <a href="<?php the_permalink(); ?>" class="hover:text-forest transition-colors duration-200">
                                    <?php the_title(); ?>
                                </a>
                            </h2>

                            <p class="text-muted text-sm leading-relaxed flex-1 mb-4">
                                <?php the_excerpt(); ?>
                            </p>

                            <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                                <div class="flex items-center gap-2 text-xs text-muted">
                                    <span class="material-symbols-outlined text-sm" aria-hidden="true">person</span>
                                    <?php the_author(); ?>
                                </div>
                                <a
                                    href="<?php the_permalink(); ?>"
                                    class="inline-flex items-center gap-1 text-xs font-semibold text-forest hover:text-eco-alt transition-colors duration-200"
                                    aria-label="<?php echo esc_attr( sprintf( __( 'Read more about %s', 'ojis-travels-theme' ), get_the_title() ) ); ?>"
                                >
                                    <?php esc_html_e( 'Read', 'ojis-travels-theme' ); ?>
                                    <span class="material-symbols-outlined text-sm" aria-hidden="true">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </article>
                    <?php $n++; endwhile; wp_reset_postdata(); ?>
                </div>

                <!-- Pagination -->
                <nav class="mt-16 flex justify-center" aria-label="<?php esc_attr_e( 'Posts pagination', 'ojis-travels-theme' ); ?>">
                    <?php
                    $pagination_args = [
                        'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                        'format'    => '?paged=%#%',
                        'current'   => $paged,
                        'total'     => $the_query->max_num_pages,
                        'prev_text' => '<span class="material-symbols-outlined">arrow_back</span>',
                        'next_text' => '<span class="material-symbols-outlined">arrow_forward</span>',
                        'type'      => 'array',
                    ];
                    $pages = paginate_links( $pagination_args );
                    if ( $pages ) :
                        echo '<div class="flex items-center gap-2">';
                        foreach ( $pages as $page ) {
                            echo '<span class="pagination-item">' . $page . '</span>';
                        }
                        echo '</div>';
                    endif;
                    ?>
                </nav>

            <?php else : ?>

                <div class="text-center py-24 reveal-element">
                    <span class="material-symbols-outlined text-8xl text-gray-200 block mb-6" aria-hidden="true">article</span>
                    <h2 class="text-2xl font-bold text-charcoal mb-4">
                        <?php esc_html_e( 'Insights Coming Soon', 'ojis-travels-theme' ); ?>
                    </h2>
                    <p class="text-muted max-w-md mx-auto mb-8 leading-relaxed">
                        <?php esc_html_e( 'We are working on bringing you expert perspectives on sustainable tourism and hospitality. Subscribe to be notified when we publish.', 'ojis-travels-theme' ); ?>
                    </p>
                    <a href="<?php echo esc_url( home_url( '/#newsletter' ) ); ?>" class="btn-primary inline-flex items-center gap-2">
                        <span class="material-symbols-outlined text-base" aria-hidden="true">notifications</span>
                        <?php esc_html_e( 'Subscribe for Updates', 'ojis-travels-theme' ); ?>
                    </a>
                </div>

            <?php endif; ?>

        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         SIDEBAR TOPICS / NEWSLETTER CTA
    ════════════════════════════════════════════════════════ -->
    <section class="py-20 bg-white" aria-labelledby="topics-heading">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- Topics -->
                <div class="md:col-span-2 reveal-element">
                    <h2 id="topics-heading" class="text-xl font-bold text-charcoal mb-6">
                        <?php esc_html_e( 'Topics We Cover', 'ojis-travels-theme' ); ?>
                    </h2>
                    <?php
                    $topics = [
                        [ 'icon' => 'eco',            'label' => __( 'Sustainable Tourism',         'ojis-travels-theme' ) ],
                        [ 'icon' => 'store',          'label' => __( 'Hospitality Best Practices',  'ojis-travels-theme' ) ],
                        [ 'icon' => 'public',         'label' => __( 'Africa Travel',               'ojis-travels-theme' ) ],
                        [ 'icon' => 'school',         'label' => __( 'Education & Training',        'ojis-travels-theme' ) ],
                        [ 'icon' => 'analytics',      'label' => __( 'Impact & Measurement',        'ojis-travels-theme' ) ],
                        [ 'icon' => 'policy',         'label' => __( 'Industry Standards & Policy', 'ojis-travels-theme' ) ],
                    ];
                    ?>
                    <div class="flex flex-wrap gap-3">
                        <?php foreach ( $topics as $topic ) : ?>
                        <span class="inline-flex items-center gap-2 bg-offwhite border border-gray-200 text-charcoal text-sm font-medium px-4 py-2 rounded-full">
                            <span class="material-symbols-outlined text-forest text-base" aria-hidden="true"><?php echo esc_html( $topic['icon'] ); ?></span>
                            <?php echo esc_html( $topic['label'] ); ?>
                        </span>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Newsletter mini -->
                <div class="bg-forest text-white rounded-2xl p-8 reveal-element">
                    <span class="material-symbols-outlined text-eco text-3xl mb-4 block" aria-hidden="true">mail</span>
                    <h3 class="text-lg font-bold mb-2"><?php esc_html_e( 'Never Miss an Insight', 'ojis-travels-theme' ); ?></h3>
                    <p class="text-white/70 text-sm mb-5">
                        <?php esc_html_e( 'Subscribe for fresh perspectives delivered straight to your inbox.', 'ojis-travels-theme' ); ?>
                    </p>
                    <form id="insights-newsletter-form" novalidate aria-label="<?php esc_attr_e( 'Newsletter subscription', 'ojis-travels-theme' ); ?>">
                        <label for="insights-email" class="sr-only"><?php esc_html_e( 'Email address', 'ojis-travels-theme' ); ?></label>
                        <input
                            type="email"
                            id="insights-email"
                            name="email"
                            placeholder="<?php esc_attr_e( 'Your email', 'ojis-travels-theme' ); ?>"
                            required
                            class="w-full bg-white/15 border border-white/20 text-white placeholder-white/40 rounded-xl px-4 py-3 text-sm mb-3 focus:outline-none focus:ring-2 focus:ring-eco focus:border-transparent"
                            aria-required="true"
                            aria-describedby="insights-newsletter-status"
                        >
                        <button type="submit" class="btn-eco w-full justify-center text-sm">
                            <?php esc_html_e( 'Subscribe', 'ojis-travels-theme' ); ?>
                        </button>
                        <p id="insights-newsletter-status" class="text-xs mt-3 text-white/60 hidden" role="status" aria-live="polite"></p>
                    </form>
                </div>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
