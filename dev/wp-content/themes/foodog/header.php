<?php
/**
 * The header for our theme.
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package FooDog
 */
?>

<?php get_header('head'); ?>

<body <?php body_class(); ?>>
<?php if (is_admin_bar_showing()) ?>
	<div class="header_admin_padding"></div>
	

<div id="page" class="site">

	<header id="masthead" class="site-header row" role="banner">
	<div class="site-branding col-md-12 container">
		<h1 class="site-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php bloginfo( 'name' ); ?>
			</a>
		</h1>
	</div>
		<!-- social link -->
	<div class=" col-md-12 social_nav" id="">
		<a class="social_link" href="" aria-hidden="true"><span class="button-icon"><i class="fa fa-facebook"></i></span></a>
		<a class="social_link" href="" aria-hidden="true"><span class="button-icon"><i class="fa fa-twitter"></i></span></a>
		<a class="social_link" href="" aria-hidden="true"><span class="button-icon"><i class="fa fa-instagram"></i></span></a>
		<a class="social_link" href="#" data-toggle="modal" data-target="#searchModal" aria-hidden="true"><span class="button-icon"><i class="fa fa-search"></i></span></a>
	</div>	
		<!-- .site-branding -->
	
	<?
	$categories = get_categories( array(
		'category__in'      => [4, 5, 6],
        'tag__not_in'       => [5, 6],
		'orderby' 		=> 'id',
		'order'   		=> 'ASC'
	) );
	?>
	
	<!--
	<nav id="" class="main-navigation cat_nav container site-navigation" role="navigation">

	<?php
		/*
		foreach( $categories as $category ) {
			$param = get_option("taxonomy_".$category->term_id);
			if ($param['headhide'] == 0) {
				echo '' . sprintf( 
					'<a href="%1$s" alt="%2$s">%3$s</a>',
					esc_url( get_category_link( $category->term_id ) ),
					esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
					esc_html( $category->name )
				);
			}
		}
		*/
	?>

		
	</nav>
	 -->
			
	<!-- -->

	<nav  class="navbar navbar-expand-lg navbar-light main-navigation cat_nav container" style="">
		<button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navbarToggleContent" aria-controls="navbarToggleContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<!-- this d-flex break the toggle -->
		<div id="navbarToggleContent" class="collapse navbar-collapse d-flex justify-content-center" id="navbarNav">
			<ul class="navbar-nav">
				
				<?php
					//*
					foreach( $categories as $category ) {
						$param = get_option("taxonomy_".$category->term_id);
						if ($param['headhide'] == 0) {
							echo '' . sprintf( 
								'<li class="nav-item site-navigation" ><a class="" href="%1$s" alt="%2$s">%3$s</a></li>',
								esc_url( get_category_link( $category->term_id ) ),
								esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
								esc_html( $category->name )
							);
						}
					} 
					//*/
				?>
			</ul>
		</div>
	</nav>
	<!-- -->
		<!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
