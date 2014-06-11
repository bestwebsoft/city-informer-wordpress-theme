<?php 
/**
 * The sidebar containing the secondary widget area
 *
 * @subpackage City Informer
 * @since City Informer 1.2
 */
?>
<div id="city_informer-sidebar" role="complementary">
	<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Main Sidebar' ) ) { ?>
		<aside class="widget">
			<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
		</aside>
		<aside class="widget">
			<?php the_widget( 'WP_Widget_Recent_Comments' ); ?>
		</aside>
		<aside class="widget">
			<?php the_widget( 'WP_Widget_Archives' ); ?>
		</aside>
		<aside class="widget">
			<?php the_widget( 'WP_Widget_Categories' ); ?>
		</aside>		
	<?php }; ?>	
</div> <!-- #sidebar -->