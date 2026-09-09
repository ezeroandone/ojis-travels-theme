<?php
/**
 * OJIS Travels Theme — Single Post Template
 *
 * @package ojis-travels-theme
 */

get_header(); ?>

<main id="main-content" class="site-main bg-offwhite">

    <?php while ( have_posts() ) : the_post(); ?>

    <!-- ── Post Hero ────────────────────────────────── -->
    <section
        class="post-hero relative overflow-hidden bg-charcoal"
        aria-label="<?php esc_attr_e( 'Post header', 'ojis-travels-theme' ); ?>"
    >
        <?php if ( has_post_thumbnail() ) : ?>
        <div class="absolute inset-0">
            <?php the_post_thumbnail( 'ojis-hero', [
                'class' => 'w-full h-full object-cover opacity-30',
                'alt'   => '',
            ] ); ?>
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-charcoal/60 via-charcoal/80 to-charcoal" aria-hidden="true"></div>
        <?php endif; ?>

        <div class="relative max-w-4xl mx-auto px-6 pt-36 pb-16 text-center">

            <!-- Category breadcrumb -->
            <?php
            $cats = get_the_category();
            if ( ! empty( $cats ) ) : ?>
            <div class="flex items-center justify-center gap-2 mb-4">
                <a href="<?php echo esc_url( home_url( '/insights' ) ); ?>"
                   class="text-eco text-xs font-semibold uppercase tracking-widest hover:text-white transition-colors duration-200">
                    <?php esc_html_e( 'Insights', 'ojis-travels-theme' ); ?>
                </a>
                <span class="text-white/30" aria-hidden="true">/</span>
                <a href="<?php echo esc_url( get_category_link( $cats[0]->term_id ) ); ?>"
                   class="text-white/70 text-xs font-semibold uppercase tracking-widest hover:text-white transition-colors duration-200">
                    <?php echo esc_html( $cats[0]->name ); ?>
                </a>
            </div>
            <?php endif; ?>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight mb-6">
                <?php the_title(); ?>
            </h1>

            <!-- Post meta -->
            <div class="flex flex-wrap items-center justify-center gap-4 text-white/60 text-sm">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-base text-eco" aria-hidden="true">person</span>
                    <span><?php the_author(); ?></span>
                </div>
                <span class="text-white/30" aria-hidden="true">&#183;</span>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-base text-eco" aria-hidden="true">calendar_today</span>
                    <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                        <?php echo esc_html( get_the_date() ); ?>
                    </time>
                </div>
                <span class="text-white/30" aria-hidden="true">&#183;</span>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-base text-eco" aria-hidden="true">schedule</span>
                    <span>
                        <?php
                        $word_count  = str_word_count( wp_strip_all_tags( get_the_content() ) );
                        $read_time   = max( 1, (int) ceil( $word_count / 230 ) );
                        printf( esc_html( _n( '%d min read', '%d min read', $read_time, 'ojis-travels-theme' ) ), $read_time );
                        ?>
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- ── Post Body ─────────────────────────────────── -->
    <div class="max-w-4xl mx-auto px-6 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            <!-- Article content -->
            <article
                id="post-<?php the_ID(); ?>"
                <?php post_class( 'lg:col-span-8 bg-white rounded-3xl shadow-sm border border-gray-100 p-8 lg:p-12 prose-ojis' ); ?>
                itemscope
                itemtype="https://schema.org/Article"
            >
                <meta itemprop="headline"      content="<?php echo esc_attr( get_the_title() ); ?>">
                <meta itemprop="datePublished" content="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                <meta itemprop="dateModified"  content="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>">
                <meta itemprop="author"        content="<?php echo esc_attr( get_the_author() ); ?>">
                <?php if ( has_post_thumbnail() ) : ?>
                <meta itemprop="image" content="<?php echo esc_url( get_the_post_thumbnail_url( null, 'ojis-hero' ) ); ?>">
                <?php endif; ?>

                <div itemprop="articleBody">
                    <?php the_content(); ?>
                </div>

                <?php
                // Page links for multi-page posts
                wp_link_pages( [
                    'before' => '<nav class="page-links flex flex-wrap gap-2 mt-8 pt-8 border-t border-gray-100"><span class="text-sm font-semibold text-muted mr-2">' . esc_html__( 'Pages:', 'ojis-travels-theme' ) . '</span>',
                    'after'  => '</nav>',
                    'link_before' => '<span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-offwhite text-sm font-medium text-charcoal hover:bg-forest hover:text-white transition-colors duration-200">',
                    'link_after'  => '</span>',
                ] );
                ?>

                <!-- Tags -->
                <?php
                $tags = get_the_tags();
                if ( $tags ) : ?>
                <div class="flex flex-wrap items-center gap-2 mt-10 pt-8 border-t border-gray-100">
                    <span class="material-symbols-outlined text-muted text-base" aria-hidden="true">label</span>
                    <?php foreach ( $tags as $tag ) : ?>
                    <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"
                       class="text-xs font-semibold text-forest bg-forest/10 border border-forest/15 px-3 py-1.5 rounded-full hover:bg-forest hover:text-white transition-colors duration-200">
                        <?php echo esc_html( $tag->name ); ?>
                    </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Share row -->
                <div class="flex flex-wrap items-center gap-3 mt-8 pt-8 border-t border-gray-100">
                    <span class="text-sm font-semibold text-charcoal mr-2"><?php esc_html_e( 'Share:', 'ojis-travels-theme' ); ?></span>
                    <?php
                    $post_url   = rawurlencode( get_permalink() );
                    $post_title = rawurlencode( get_the_title() );
                    $shares = [
                        [ 'href' => 'https://www.linkedin.com/sharing/share-offsite/?url=' . $post_url, 'label' => 'LinkedIn', 'icon' => 'share' ],
                        [ 'href' => 'https://twitter.com/intent/tweet?url=' . $post_url . '&text=' . $post_title, 'label' => 'X / Twitter', 'icon' => 'tag' ],
                        [ 'href' => 'https://www.facebook.com/sharer/sharer.php?u=' . $post_url, 'label' => 'Facebook', 'icon' => 'group' ],
                    ];
                    foreach ( $shares as $s ) : ?>
                    <a href="<?php echo esc_url( $s['href'] ); ?>"
                       target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-1.5 text-xs font-medium text-muted hover:text-forest border border-gray-200 hover:border-forest/30 rounded-lg px-3 py-2 transition-colors duration-200"
                       aria-label="<?php echo esc_attr( sprintf( __( 'Share on %s', 'ojis-travels-theme' ), $s['label'] ) ); ?>">
                        <span class="material-symbols-outlined text-sm" aria-hidden="true"><?php echo esc_html( $s['icon'] ); ?></span>
                        <?php echo esc_html( $s['label'] ); ?>
                    </a>
                    <?php endforeach; ?>
                </div>

            </article>

            <!-- Sidebar -->
            <aside class="lg:col-span-4 flex flex-col gap-8" aria-label="<?php esc_attr_e( 'Post sidebar', 'ojis-travels-theme' ); ?>">

                <!-- Author card -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <div class="flex items-start gap-4">
                        <div class="w-14 h-14 rounded-full bg-forest/10 flex items-center justify-center flex-shrink-0 overflow-hidden">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 56, '', get_the_author(), [ 'class' => 'w-full h-full object-cover' ] ); ?>
                        </div>
                        <div>
                            <p class="font-bold text-charcoal text-sm"><?php the_author(); ?></p>
                            <p class="text-muted text-xs mt-1 leading-relaxed"><?php echo esc_html( get_the_author_meta( 'description' ) ?: __( 'OJIS Travels & Advisory', 'ojis-travels-theme' ) ); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Related posts -->
                <?php
                $related = new WP_Query( [
                    'post_type'           => 'post',
                    'posts_per_page'      => 3,
                    'post__not_in'        => [ get_the_ID() ],
                    'category__in'        => wp_get_post_categories( get_the_ID() ),
                    'ignore_sticky_posts' => true,
                    'orderby'             => 'rand',
                ] );
                if ( $related->have_posts() ) : ?>
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h2 class="text-sm font-bold text-charcoal uppercase tracking-wider mb-4">
                        <?php esc_html_e( 'Related Articles', 'ojis-travels-theme' ); ?>
                    </h2>
                    <ul class="flex flex-col gap-4">
                        <?php while ( $related->have_posts() ) : $related->the_post(); ?>
                        <li>
                            <a href="<?php the_permalink(); ?>" class="flex items-start gap-3 group">
                                <?php if ( has_post_thumbnail() ) : ?>
                                <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0">
                                    <?php the_post_thumbnail( 'thumbnail', [
                                        'class' => 'w-full h-full object-cover transition-transform duration-300 group-hover:scale-105',
                                        'alt'   => '',
                                    ] ); ?>
                                </div>
                                <?php endif; ?>
                                <div>
                                    <p class="text-sm font-semibold text-charcoal leading-snug group-hover:text-forest transition-colors duration-200">
                                        <?php the_title(); ?>
                                    </p>
                                    <time class="text-xs text-muted mt-1 block" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                        <?php echo esc_html( get_the_date() ); ?>
                                    </time>
                                </div>
                            </a>
                        </li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                </div>
                <?php endif; ?>

                <!-- CTA card -->
                <div class="bg-forest rounded-2xl p-6 text-white">
                    <span class="material-symbols-outlined text-eco text-3xl mb-3 block" aria-hidden="true">eco</span>
                    <h3 class="font-bold text-base mb-2"><?php esc_html_e( 'Ready to act on sustainability?', 'ojis-travels-theme' ); ?></h3>
                    <p class="text-white/70 text-sm mb-4 leading-relaxed"><?php esc_html_e( 'Talk to us about advisory services or planning a responsible journey.', 'ojis-travels-theme' ); ?></p>
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-eco inline-flex items-center gap-2 text-sm w-full justify-center">
                        <span class="material-symbols-outlined text-base" aria-hidden="true">mail</span>
                        <?php esc_html_e( 'Get in Touch', 'ojis-travels-theme' ); ?>
                    </a>
                </div>

            </aside>
        </div>

        <!-- Post navigation -->
        <nav class="mt-12 grid grid-cols-1 sm:grid-cols-2 gap-4" aria-label="<?php esc_attr_e( 'Post navigation', 'ojis-travels-theme' ); ?>">
            <?php
            $prev = get_previous_post();
            $next = get_next_post();
            if ( $prev ) : ?>
            <a href="<?php echo esc_url( get_permalink( $prev->ID ) ); ?>"
               class="flex items-center gap-4 bg-white rounded-2xl border border-gray-100 p-5 hover:border-forest/30 hover:shadow-md transition-all duration-200 group">
                <span class="material-symbols-outlined text-forest text-2xl flex-shrink-0 transition-transform duration-200 group-hover:-translate-x-1" aria-hidden="true">arrow_back</span>
                <div class="overflow-hidden">
                    <span class="text-xs text-muted uppercase tracking-wider block mb-1"><?php esc_html_e( 'Previous', 'ojis-travels-theme' ); ?></span>
                    <span class="text-sm font-semibold text-charcoal group-hover:text-forest transition-colors duration-200 line-clamp-2"><?php echo esc_html( get_the_title( $prev->ID ) ); ?></span>
                </div>
            </a>
            <?php endif;
            if ( $next ) : ?>
            <a href="<?php echo esc_url( get_permalink( $next->ID ) ); ?>"
               class="flex items-center gap-4 bg-white rounded-2xl border border-gray-100 p-5 hover:border-forest/30 hover:shadow-md transition-all duration-200 group text-right sm:col-start-2">
                <div class="overflow-hidden">
                    <span class="text-xs text-muted uppercase tracking-wider block mb-1"><?php esc_html_e( 'Next', 'ojis-travels-theme' ); ?></span>
                    <span class="text-sm font-semibold text-charcoal group-hover:text-forest transition-colors duration-200 line-clamp-2"><?php echo esc_html( get_the_title( $next->ID ) ); ?></span>
                </div>
                <span class="material-symbols-outlined text-forest text-2xl flex-shrink-0 transition-transform duration-200 group-hover:translate-x-1" aria-hidden="true">arrow_forward</span>
            </a>
            <?php endif; ?>
        </nav>

    </div>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>
