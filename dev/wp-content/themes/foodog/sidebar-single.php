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
<div id="secondary" class="sidebar  sidebar--main" role="complementary">
	<h2 class="titre_single_sidebar">FOLLOW US</h2>
	<?php dynamic_sidebar( 'sidebar-2' ); ?>

</div><!-- #secondary -->
