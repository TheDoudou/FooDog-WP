<?php
/**
 * The template for displaying the search.
 *
 * @package FooDog
 */

wp_parse_str( $query_string, $search_query );

foreach ($search_query as $value) {
	$search_string .= $value.'';
}

get_header(); 

$i = 0

?>


<!-- .content search -->
<div class="d-flex justify-content-center">
	<input class="search-search" id="searchsubmit" type="text" name="s" value="<?= $search_string; ?>">
</div>

<div class="container-fluid cat-header">
	<h2 class="OP_cat_page">Search : <?= $search_string.' ('.$wp_query->found_posts.')'; ?></h2>
</div>


<div class=" OP_article_global container">
	<div class="row ">
		<div class="col-md-11 container-fuild">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="row OP_article_solo">
				<div class="col-md-6">
					<?php the_post_thumbnail('single-post', array('class' => 'img-op attachment-latest size-latest wp-post-image img-fluid')); ?>
				</div>
				<div class="col-md-6 OP_text_article">
					<h4 class="OP_cat_article"><?php foreach( get_the_category() as $category ) { echo strtoupper($category->name.chr(127)); } ?></h4>
					<a href="<?php the_permalink(); ?>" class="link-title"><h3 class="OP_title_article"><?php the_title(); ?></h3></a>
					<p><?php the_excerpt(); ?></p>
					<a href="#" class="share_global"><i class="fa fa-share" ></i><p class="share">share</p></a>
				</div>
			</div>
			<?php $i++; endwhile; endif; ?>
			<div class="pagination_global">
			<?php 
			//var_dump(ceil(get_category(get_cat_ID(single_term_title("", false)))->category_count/$i));
				echo paginate_links( array(
					'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
					'total'        => ceil($wp_query->found_posts/8),
					'current'      => max( 1, get_query_var( 'paged' ) ),
					'format'       => '?paged=%#%',
					'show_all'     => false,
					'type'         => 'plain',
					'end_size'     => 1,
					'mid_size'     => 1,
					'prev_next'    => true,
					'prev_text'    => sprintf( '<i></i> %1$s', __( '<', 'text-domain' ) ),
					'next_text'    => sprintf( '%1$s <i></i>', __( '>', 'text-domain' ) ),
					'add_args'     => false,
					'add_fragment' => '',
				) ); ?>
			</div>
		</div>
	</div>
	<div class=" col-md-3">
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>