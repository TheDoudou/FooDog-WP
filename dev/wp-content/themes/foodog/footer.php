<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package FooDog
 */
?>
<footer>	    
    <div class="container">
        <div class="row">
            <div class=" sidebar-footer col-md-4 col-xs-12">
                <aside class="footer-categories">
                    <h3 class="h3-title"> CATEGORIES </h3>
                    <ul class="footer-ul">
                        <!--<li class="footer-li"><a class="footer-a" href="#">Community</a></li>-->
                        <?php
                            $categories = get_categories( array(
                                'orderby' 		=> 'id',
                                'order'   		=> 'ASC'
                            ) );
                        
                            foreach( $categories as $category ) {
                                $param = get_option("taxonomy_".$category->term_id);
                                if ($param['foothide'] == 0) {
                                    echo '' . sprintf( 
                                        '<li class="footer-li"><a class="footer-a" href="%1$s" alt="%2$s">%3$s</a></li>',
                                        esc_url( get_category_link( $category->term_id ) ),
                                        esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
                                        esc_html( $category->name )
                                    );
                                }
                            } 
                        ?>
                    </ul>
                </aside>
            </div>
            <div class=" sidebar-footer col-md-4 col-xs-12">
                <aside class="footer-categories">
                    <h3 class="h3-title">POPULAR POSTS </h3>
                    <ul class="footer-ul-posts">
                        <?php
                            $popularpost = new WP_Query( array( 'posts_per_page' => 3, 'meta_key' => '_foodog_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
                            while ( $popularpost->have_posts() ) : $popularpost->the_post();
                        ?>
                        <article class="article-posts">
                            <?php the_post_thumbnail('', array('class' => 'img-pop-footer attachment-latest size-latest wp-post-image')); ?>
                            <li class="footer-li-posts"><a class="footer-a-posts" href="?p=<? the_ID(); ?>"><?php the_title();?></a></li>
                        </article>
                        <?php endwhile; ?>
                    </ul>
                </aside>
            </div>
            <div class=" sidebar-footer col-md-4 col-xs-12">
                <aside class="footer-categories">
                    <!-- <h3 class="h3-title"> INSTAGRAM </h3>
                    <div class="row">
                        <div class="col-xs-4">
                            <img class="img-instagram" src="https://devfoodog.thedoudou.myds.me/wp-content/uploads/2019/01/freyaeverafter_-skinny.jpg">
                        </div>
                        <div class="col-xs-4">
                            <img class="img-instagram" src="https://devfoodog.thedoudou.myds.me/wp-content/uploads/2019/01/freyaeverafter_-skinny.jpg">
                        </div>
                        <div class="col-xs-4">
                            <img class="img-instagram" src="https://devfoodog.thedoudou.myds.me/wp-content/uploads/2019/01/freyaeverafter_-skinny.jpg">
                        </div>
                        <div class="col-xs-4">
                            <img class="img-instagram" src="https://devfoodog.thedoudou.myds.me/wp-content/uploads/2019/01/freyaeverafter_-skinny.jpg">
                        </div>
                        <div class="col-xs-4">
                            <img class="img-instagram" src="https://devfoodog.thedoudou.myds.me/wp-content/uploads/2019/01/freyaeverafter_-skinny.jpg">
                        </div>
                        <div class="col-xs-4">
                            <img class="img-instagram" src="https://devfoodog.thedoudou.myds.me/wp-content/uploads/2019/01/freyaeverafter_-skinny.jpg">
                        </div>
                        <div class="col-xs-4">
                            <img class="img-instagram" src="https://devfoodog.thedoudou.myds.me/wp-content/uploads/2019/01/freyaeverafter_-skinny.jpg">
                        </div>
                        <div class="col-xs-4">
                            <img class="img-instagram" src="https://devfoodog.thedoudou.myds.me/wp-content/uploads/2019/01/freyaeverafter_-skinny.jpg">
                        </div>
                        <div class="col-xs-4">
                            <img class="img-instagram" src="https://devfoodog.thedoudou.myds.me/wp-content/uploads/2019/01/freyaeverafter_-skinny.jpg">
                        </div>
                    </div> -->
                    <?php dynamic_sidebar( 'sidebar-3' ); ?>
                </aside>
            </div>
        </div>
    </div>
                    
    <div class="footer-bottom">
        <div class="icon-footer">
            <i class="footer-icon1 fa fa-facebook"></i>
            <i class="footer-icon2 fa fa-twitter"></i>
            <i class="footer-icon3 fa fa-instagram"></i>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

<script>

</script>
</body>
</html>


