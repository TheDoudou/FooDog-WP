<?php
/**
 * The sidebar for single page containing the main widget area.
 *
 * @package FooDog
 */
?>


<?php
if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>
<div id="secondary2" class="sidebar sidebar_joe sidebar--main" role="complementary">
	<h2 class="titre_single_sidebar">FOLLOW US</h2>
	<div>
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</div>

</div><!-- #secondary -->
