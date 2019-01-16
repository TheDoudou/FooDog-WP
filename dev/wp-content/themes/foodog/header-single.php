<?php
/**
 * The header for single page.
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package FooDog
 */
?>

<?php get_header('head'); ?>

<body <?php body_class(); ?>>

<?php if (is_admin_bar_showing()) {?>
    <div class="header_admin_margin banniere-nav row fixed-top">
<?php } else { ?>
      <div class="banniere-nav  fixed-top">
<?php }?>
        <!-- Navbar start -->
        <?
            $categories = get_categories( array(
                'category__in'      => [4, 5, 6],
                'tag__not_in'       => [5, 6],
                'orderby' 		=> 'id',
                'order'   		=> 'ASC'
            ) );
        ?>
        <div class="pos-f-t">
            <div class="collapse" id="navbarToggleExternalContent">
                <div class="bg-inverse p-4">
                    <?php
                        foreach( $categories as $category ) {
                            $param = get_option("taxonomy_".$category->term_id);
                            if ($param['headhide'] == 0) {
                                echo '' . sprintf( 
                                    '<a href="%1$s" alt="%2$s">%3$s</a><br>',
                                    esc_url( get_category_link( $category->term_id ) ),
                                    esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
                                    esc_html( $category->name )
                                );
                            }
                        } 
                    ?>
                </div>
            </div>
            
            <nav class="navbar navbar-inverse bg-inverse row nav_single_global">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=" icon-bar"></span>
                <span class=" icon-bar"></span>
                <span class=" icon-bar"></span>
              </button>
              <div class="col-md-2 col-sm-2 col-xs-2 titre_nav_single">
                <h2> 
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				         <?php bloginfo( 'name' ); ?>
                    </a>
                </h2>
              </div> 
                
              
                <form class="form-inline form-newletter col-md-6">
                  <div class="form-group mb-2">
                    <p class="text-form">FooDog In Your Inbox</p>
                    <label for="staticEmail2" class="sr-only">Email</label>
                    <input type="email" class="form-control input-newletter" id="email" placeholder="Your email">
                  </div>
                  <button type="submit" class="btn btn-dark btn-sign mb-2">SIGN UP</button>
                </form>
                

                    
              <div class="col-md-3 col-sm-3 col-xs-2 logo_nav">
                <img src="wp-content/themes/foodog/assets/img/dog.png" class=" logoFarmer" alt="logo">
                <a class="search_single" href="#" data-toggle="modal" data-target="#searchModal"><span class="button-icon"><i class="fa fa-search"></i></span></a>
              </div>
            </nav>
            
          </div>
        </div>
      </div>