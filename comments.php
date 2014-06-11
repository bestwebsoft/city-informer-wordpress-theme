<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @subpackage City Informer
 * @since City Informer 1.2
*/ 
if ( post_password_required() ) {
	return;
} ?>
<div class="comments">
	<?php if ( have_comments() ) { ?>
		<h2>
			<?php comments_number( __( 'No Comments', 'city_informer' ), __( 'One Comment', 'city_informer' ), '% ' . __( 'Comments', 'city_informer' ) );	
			echo (' ') . __( 'for', 'city_informer' ) . (' ');
			the_title(); ?>
		</h2>		
		<ul class="comment-list">
			<?php wp_list_comments( array( 'avatar_size'=> 34 ) ); ?>
		</ul>
		<?php if ( ! comments_open() ) { ?>
			<p class="no-comments"><?php _e( 'Comments are closed.', 'city_informer' ); ?></p>
		<?php }
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
			<nav id="comments-nav" role="navigation">
				<div id="prev-comments"><?php previous_comments_link( '&laquo; ' . __( 'Previous Comments', 'city_informer' ) ); ?></div>
				<div id="next-comments"><?php next_comments_link( __( 'Next Comments', 'city_informer' ) . ' &raquo;' ); ?></div>
			</nav><!-- #comments-nav -->
		<?php }
	}
	comment_form(); ?>
</div>