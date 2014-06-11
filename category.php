<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @subpackage City Informer
 * @since City Informer 1.2
 */
get_header(); ?>
	<div id="container">
		<div id="content" role="main">
			<?php if ( have_posts() ) { ?>
				<article class="post">
					<header class="entry-header">
						<h1>
							<?php printf( __( 'Category Archives:', 'city_informer' ) . ' %s', ' <span>' . single_cat_title( '', false ) . '</span>' ); ?>
						</h1>
					</header>
					<?php if ( category_description() ) { // show an optional category description ?>
						<div><?php echo category_description(); ?></div>
					<?php } ?>
				</article>
				<?php while( have_posts() ) : the_post();
					get_template_part( 'content', get_post_format() );
				endwhile;
				/* page navigation */
				do_action( 'city_informer_page_nav' );
			} else {
				get_template_part( 'content-none', get_post_format() );
			} ?>
		</div> <!-- #content -->
		<?php get_sidebar(); ?>
	</div> <!-- #container -->
<?php get_footer(); ?>	