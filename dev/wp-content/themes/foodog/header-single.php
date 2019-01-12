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
<?php }else{ ?>
      <div class="banniere-nav  fixed-top">
<?php }?>
            <!--Navbar-->
        <div class="pos-f-t">
            <div class="collapse" id="navbarToggleExternalContent">
                <div class="bg-inverse p-4">
                    <h4 class="text">Collapsed content</h4>
                    <span class="text-muted">Toggleable via the navbar brand.</span>
                </div>
            </div>
            
            <nav class="navbar navbar-inverse bg-inverse row nav_single_global">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=" icon-bar"></span>
                <span class=" icon-bar"></span>
                <span class=" icon-bar"></span>
              </button>
              <div class="col-md-2">
                <h2> FooDog</h2>
              </div> 
                
              
                <form class="form-inline form-newletter col-md-6">
                  <div class="form-group mb-2">
                    <p class="text-form">FooDog In Your Inbox</p>
                    <label for="staticEmail2" class="sr-only">Email</label>
                    <input type="email" class="form-control input-newletter" id="email" placeholder="Your email">
                  </div>
                  <button type="submit" class="btn btn-dark btn-sign mb-2">SIGN UP</button>
                </form>
              
              <div class="col-md-3 logo_nav">
                <img src="wp-content/themes/foodog/assets/img/dog.png" class=" logoFarmer" alt="logo">
                <a class="search_single" href=""><span class="button-icon"><i class="fa fa-search"></i></span></a>
              </div>
            </nav>
          </div>
        </div>
      </div>