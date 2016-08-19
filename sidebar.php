<?php
/**
 * The sidebar containing the secondary widget area
 *
 * @subpackage City Informer
 * @since      City Informer 1.2
 */
?>
<div id="city_informer-sidebar" role="complementary">
	<?php if ( is_active_sidebar( 'sidebar-widgets' ) ) {
		dynamic_sidebar( 'sidebar-widgets' );
	} else {
		$args     = array(
			'before_widget' => '<aside class="widget %s">',
			'after_widget'  => '</aside>',
		);
		$instance = array();
		the_widget( 'WP_Widget_Recent_Posts', $instance, $args );
		the_widget( 'WP_Widget_Recent_Comments', $instance, $args );
		the_widget( 'WP_Widget_Archives', $instance, $args );
		the_widget( 'WP_Widget_Categories', $instance, $args );
	} ?>
</div><!-- #sidebar -->
