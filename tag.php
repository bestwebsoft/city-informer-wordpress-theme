<?php 
/**
 * The template used to display Tag Archive pages
 * @subpackage City Informer
 * @since City Informer 1.2
 */
get_header(); ?>
	<div id="container">
		<div id="content" role="main">
			<?php if ( have_posts() ) { ?>
				<header class="entry-header">
					<h1 class="entry-title">
						<?php printf( __( 'Tag Archives:', 'city_informer' ) . ' %s', '<span>' . single_tag_title( '', false ) . '</span>' ); ?>
					</h1>
				</header>
				<?php while ( have_posts() ) : the_post();
					get_template_part( 'content', get_post_format() );
				endwhile;
				do_action( 'city_informer_page_nav' ); 
			} else { 
				get_template_part( 'content', 'none' ); 
			} ?>
		</div> <!-- #content -->
		<?php get_sidebar(); ?>
	</div> <!-- #container -->
<?php get_footer(); ?>	