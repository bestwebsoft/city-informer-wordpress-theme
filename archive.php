<?php
/**
 * The template for displaying Archive pages
 *
 * @subpackage City Informer
 * @since City Informer 1.2
 */
get_header(); ?>
	<div id="container">
		<div id="content" role="main">
			<?php if ( have_posts() ) { ?>
					<header class="entry-header">
						<h1 class="entry-title">
							<?php if ( is_day() )
								printf( __( 'Daily Archives:', 'city_informer' ) . ' %s', '<span>' . get_the_date() . '</span>' );
							elseif ( is_month() )
								printf( __( 'Monthly Archives:', 'city_informer' ) . ' %s', '<span>' . get_the_date( 'F Y' ) . '</span>' );
							elseif ( is_year() )
								printf( __( 'Yearly Archives:', 'city_informer' ) . ' %s', '<span>' . get_the_date( 'Y' ) . '</span>' );
							else
								_e( 'Archives', 'city_informer' ); ?>
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