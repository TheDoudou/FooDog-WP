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
            
            <nav class="navbar navbar-inverse bg-inverse">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=" icon-bar"></span>
                <span class=" icon-bar"></span>
                <span class=" icon-bar"></span>
              </button>
              <h2> FooDog</h2>
              <form class="form-inline">
                <div class="form-group mb-2">
                  <label for="staticEmail2" class="sr-only">Email</label>
                  <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="email@example.com">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                  <label for="inputPassword2" class="sr-only">Password</label>
                  <input type="password" class="form-control" id="inputPassword2" placeholder="Password">
                </div>
                  <button type="submit" class="btn btn-primary mb-2">Confirm identity</button>
              </form>
              <img src="wp-content/themes/foodog/assets/img/dog.png" class=" logoFarmer_small" alt="logo">
            </nav>
          </div>
        </div>
      </div>
