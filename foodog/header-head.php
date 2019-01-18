<?php
/**
 * The header HEAD for our theme.
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package FooDog
 */

header('Cache-Control: max-age=3600');
?>

<!DOCTYPE html>
<!--[if IE 9]> <html class="ie9 lt-ie10" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<meta name="Description" content="Food for dog.">
	<meta name="theme-color" content="#3367D6"/>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	<link href="<?php echo get_bloginfo('template_directory'); ?>/style.css" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
	<link rel="icon" href="wp-content/themes/foodog/assets/img/favicon.png" type="images/x-icon">
	<link rel="manifest" href="wp-content/themes/foodog/manifest.json">
	<script src="wp-content/themes/foodog/assets/js/upup.min.js"></script>
	<script>
		UpUp.start({
			'content-url': 'wp-content/themes/foodog/offline.html'
    	});
	</script>
	<title>FooDog</title>
	<?php wp_head(); ?>
</head>

<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-full" role="document">
    <div class="modal-content d-flex justify-content-center align-items-center">
      <div class="modal-body">

					<form  role="search" method="get" id="searchform" class="searchform" action="?s">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
						<input class="modal-search" id="searchsubmit" type="text" name="s" placeholder="Search ...">
					</form>
				
      </div>
    </div>
  </div>
</div>