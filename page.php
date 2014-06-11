<?php
/**
 * The template for displaying all pages
 *
 * @subpackage City Informer
 * @since City Informer 1.2
 */
get_header(); ?>
	<div id="container">
		<div id="content" role="main">
			<?php if ( have_posts() ) {
				the_post(); 
				get_template_part( 'content', 'page' );
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			} else {
				// if no content
				get_template_part( 'content', 'none' );	
			} ?>
		</div> <!-- #content -->
		<?php get_sidebar(); ?>
	</div> <!-- #container -->
<?php get_footer(); ?>