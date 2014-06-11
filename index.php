<?php
/**
 * The main template file.
 *
 * @subpackage City Informer
 * @since City Informer 1.2
 */
get_header(); ?>
	<div id="container">
		<div id="content" role="main" >
			<?php if ( have_posts() ) {
				while( have_posts() ) : the_post(); 
					get_template_part( 'content', get_post_format() );
				endwhile; 
				do_action( 'city_informer_page_nav' );
			} else {
				// if no content
				get_template_part( 'content', 'none' );	
			} ?>
		</div> <!-- #content -->
		<?php get_sidebar(); ?>
	</div> <!-- #container -->
<?php get_footer(); ?>	