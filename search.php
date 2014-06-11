<?php
/**
 * The template for displaying Search Results pages.
 *
 * @subpackage City Informer
 * @since City Informer 1.2
 */
get_header(); ?>
	<div id="container">
		<div id="content" role="main">
			<header class="search-result">
				<h1 class="page-title"><?php printf( __( 'Search results for:', 'city_informer' ) . '  %s', get_search_query() ); ?></h1>
			</header>
			<div class="entry">
				<?php if ( have_posts() ) {
					while ( have_posts() ) : the_post(); 
						get_template_part( 'content', get_post_format() );
					endwhile;
					do_action( 'city_informer_page_nav' );
				} else {
					// if no content
					get_template_part( 'content', 'none' );	
				} ?>
			</div>
		</div> <!-- #content -->
		<?php get_sidebar(); ?>
	</div> <!-- #container -->
<?php get_footer(); ?>	