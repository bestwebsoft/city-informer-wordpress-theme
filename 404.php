<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @subpackage City Informer
 * @since City Informer 1.2
 */
get_header(); ?>
	<div id="container">
		<div id="content" role="main">
			<article>
				<header class="page-header">
					<h1 class="page-title"><?php _e( '404 Page Not Found', 'city_informer' ); ?></h1>
				</header>
				<div>
					<h2><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'city_informer' ); ?></h2>
					<?php get_search_form(); ?>
				</div>
			</article><!-- article -->
		</div> <!-- #content -->
		<?php get_sidebar(); ?>
	</div> <!-- #container -->
<?php get_footer(); ?>