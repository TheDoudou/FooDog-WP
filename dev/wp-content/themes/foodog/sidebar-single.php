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
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
</div><!-- #secondary -->
