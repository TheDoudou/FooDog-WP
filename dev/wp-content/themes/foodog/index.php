<?php
/**
 * The main template file.
 *
 * @package FooDog
 */


get_header(); ?>

<div id="primary" class="content-area container">
    <main id="main" class="site-main" role="main">

    <?php if ( have_posts() ) : ?>
       <div class=" global_article_header row">
            <!-- Header post -->
            <div class="article_headerBig col-md-7">
                <?php $query = new WP_Query(Array('tag' => 'headerbig', 'posts_per_page' => 1 )); ?>
                <?php if( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
                    <?php the_post_thumbnail('', array('class' => 'img-headerbig attachment-latest size-latest headerbig wp-post-image img-fluid')); ?>
                    <h4 class="cat_article_header"><?php echo strtoupper(get_the_category()[0]->name); ?><h4>
                    <a href="<?php the_permalink(); ?>"class="link-title"><h3 class="title_article_header_big" ><?php the_title(); ?></h3></a>
                <?php endwhile; endif; ?>
                <?php wp_reset_postdata(); ?>
            </div>

            
            <div class="col-md-5 article_header_right_global"> 
                <?php $query = new WP_Query(Array('tag' => 'header', 'posts_per_page' => 4 )); ?>
                    <div class="row">
                    <?php if( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
                        <div class=" col-md-6 article_header_right "> 
                            <?php if ( has_post_thumbnail() ) { ?>    
                                <a href="<?php the_permalink(); ?>" class="entry-featured  entry-thumbnail" aria-hidden="true">
                                    <?php   //the_post_thumbnail( foodog_get_thumbnail_size() );
                                        the_post_thumbnail('', array('class' => 'img-header attachment-latest size-latest wp-post-image img-fluid')); ?>
                                    <div class="entry-image-border"></div>
                                </a> 
                        
                        <?php } ?>
                        <a href="<?php the_permalink(); ?>"class="link-title"><h3 class="title_article_header" ><?php the_title(); ?></h3></a>
                    </div>
                    <?php endwhile; endif; ?>
                    
                    <?php wp_reset_postdata(); ?>
                </div>      
            </div>
        </div>                    

        <!-- Featured post -->
        <div class="row">
            <div class="col-md-9">
                <h2 class="section_article">FEATURED POST</h2>
                <?php
                $args = array(
                    'cat' => 7,
                    'posts_per_page' => 3
                );
                
                $query = new WP_Query( $args );
                
                
                if ( $query->have_posts() ) { ?>
                    <div class="row container global_article">
                    <?php while ( $query->have_posts() ) {
                        $query->the_post(); ?>
                        <div class=" col-md-11 article">
                            
                                <span class="img_artcile"><?php the_post_thumbnail('latest'); ?></span>
                                <div class="article_right">
                                <h4 class="cat_article"><?php foreach ( get_the_category() as $category) { echo strtoupper($category->name).chr(127); } ?></h4>
                                <a href="<?php the_permalink(); ?>" class="link-title"><h3 class="title_article"><?php the_title(); ?></h3></a>
                                <p><?php echo wp_trim_words( get_the_content(), 35, ' ...'); ?></p>
                                <a href="#" class="share_global"><i class="fa fa-share" ></i><p class="share">share</p></a>
                            </div>
                        </div>
                    <?php }; ?>
                    </div><br>
                <?php };
                wp_reset_postdata(); ?>


                <!-- Latest post -->
                <h2 class="section_article">LATEST POST</h2> 
                <?
                $args = array(
                    'category__not_in' => [7],
                    'posts_per_page'    => 6,
                    'paged'             => $paged
                );
                
                $query = new WP_Query( $args );
                
                
                if ( $query->have_posts() ) { ?>
                    <div class="row container global_article1">
                    <?php while ( $query->have_posts() ) {
                        $query->the_post(); ?>
                        <div class=" col-md-5 article1">
                            <span class="img_artcile1"><?php the_post_thumbnail('latest', array('class' => 'img-latest attachment-latest size-latest wp-post-image img-fluid')); ?></span>
                            <h4 class="cat_article1"><?php foreach ( get_the_category() as $category) { echo strtoupper($category->name).chr(127); } ?></h4>
                            <a href="<?php the_permalink(); ?>" class="link-title"><h3 class="title_article1"><?php the_title(); ?></h3></a>
                            <p class="text_article1"><?php echo wp_trim_words( get_the_content(), 15, ' ...'); ?></p>
                        </div>
                    <?php }; ?>
                    </div>
                <?php }; ?>
                
                <div class="pagination_global">
                <?php   echo paginate_links( array(
                            'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                            'total'        => $query->max_num_pages,
                            'current'      => max( 1, get_query_var( 'paged' ) ),
                            'format'       => '?paged=%#%',
                            'show_all'     => false,
                            'type'         => 'plain',
                            'end_size'     => 1,
                            'mid_size'     => 1,
                            'prev_next'    => true,
                            'prev_text'    => sprintf( '<i></i> %1$s', __( '<', 'text-domain' ) ),
                            'next_text'    => sprintf( '%1$s <i></i>', __( '>', 'text-domain' ) ),
                            'add_args'     => false,
                            'add_fragment' => '',
                        ) );
                        wp_reset_postdata(); ?>
                </div>
            <?php else : ?>

                <p>Aucun post sur ce blog.</p>

            <?php endif; ?>
            </div>
            <div class="col-md-3 sidebar_right">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>