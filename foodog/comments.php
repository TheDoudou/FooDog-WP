<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package FooDog
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
} ?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<div class="comments-area-title">
			<h3 class="comments-title"><?php
			if ( have_comments() ) {
					echo number_format_i18n( get_comments_number() ) . ' ' . _n( 'Comment', 'Comments', get_comments_number(), 'silk-lite' );
				} else {
					echo esc_html__( 'There are no comments', 'silk-lite' );
				} ?></h3>
			<?php echo '<a class="comments_add-comment" href="#reply-title">' . esc_html__( 'Add Yours', 'silk-lite' ) . '</a>'; ?>
		</div>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'silk-lite' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'silk-lite' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'silk-lite' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php
			/* Loop through and list the comments. Tell wp_list_comments()
			 * to use hive_comment() to format the comments.
			 * See hive_comment() in inc/extras.php for more.
			 */
			wp_list_comments( array( 'callback' => 'silklite_comment', 'short_ping' => true ) ); ?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'silk-lite' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'silk-lite' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'silk-lite' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'silk-lite' ); ?></p>
	<?php endif; ?>

	<?php
	$args = array(
		'title_reply'	=>'LEAVE A RESPONSE',
		'label_submit'	=> 'LEAVE A COMMENT',
		'class_submit'	=> 'submit btn btn-coment',
		'fields'		=> '
			<div class=" ">
				<p class="comment-form-comment  ">
				<label for="comment1"> </label>
					<textarea name="comment" aria-required="true" class="col-md-12 textArea-comment form-control" id="comment1"  placeholder="Write your comment here ..."></textarea>
				</p>
				<div class=" input_comment">
					<input type="text" class="form-control col-md-4 col-xs-12" id="name1" placeholder="Name ...">
					<input type="email" class="form-control col-md-4 col-xs-12" id="mail3" placeholder="Email ...">
					<input type="text" class="form-control col-md-4 col-xs-12" id="site1" placeholder="Website ...">
				</div>
			</div>
			',
		'comment_field'	=> '',
		'comment_notes_before' 	=> '',
);

	comment_form( $args ); ?>

</div><!-- #comments -->