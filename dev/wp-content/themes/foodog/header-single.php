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
        <div class="banniere-nav row fixed-top">
<?php }?>
            <div class="col-md-4">
                <div class="hamburger-menu">
                    
                </div>
                <h1><a class="h1-single" href="index.php">FooDog</a></h1>
            </div>

            <div class="col-md-4">
                <form id="form-inbox" class=" input_global">
                    <label class="text_single_header">FooDog in your Inbox</label>
                    <input type="text" class="input-email" placeholder="YOUR EMAIL">
                    <button class="button-email" type="button">SIGN UP</button>
                </form>
            </div>
            <div class="logo_right col-md-4">
                <img src="wp-content/themes/foodog/assets/img/dog.png" class=" logoFarmer_small" alt="logo">
            </div>
        </div>
    </div>