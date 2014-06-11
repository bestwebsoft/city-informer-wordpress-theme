<?php 
/**
 * Slider template file.
 *
 * @subpackage City Informer
 * @since City Informer 1.2
 *
 */
global $wp_query;
/* save old value of variable wp_query */
$original_query = $wp_query;
/*add new and change value of variable wp_query*/
$wp_query = null;
$args = array( 
	'post_type'				=> 'post',
	'meta_key'				=> 'city_informer_add_slide',
	'meta_value'			=> 'on',
	'posts_per_page'		=> -1,
	'ignore_sticky_posts'	=> 1,
);
$wp_query = new WP_Query( $args );
if ( $wp_query->have_posts() ) { ?>
	<div class="container-slider">
		<div id="slides">
			<?php while ( $wp_query->have_posts() ) :  $wp_query->the_post(); ?>
				<div class="slidesjs-slide">
					<?php if ( has_post_thumbnail() ) { 
						the_post_thumbnail( 'slider-image' ); 
					} ?>
					<div class="slider-text aligncenter">
						<header class="slider-head aligncenter">
							<h1><?php the_title(); ?></h1>
						</header>
						<div class="slider-content aligncenter"><?php the_excerpt('10'); ?>
						</div>
						<a class="slider-more" href="<?php the_permalink(); ?>"><?php _e( 'learn more', 'city_informer' ); ?></a>
					</div>
					<div class="slide-wrapper">
					</div>					
				</div>
			<?php endwhile; ?>				
		</div> <!-- #slides -->
	</div><!-- #container-slider -->
<?php }; 
$wp_query = null;
$wp_query = $original_query;
wp_reset_postdata(); ?>