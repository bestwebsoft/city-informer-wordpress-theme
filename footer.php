<?php
/**
 * The template for displaying the footer
 *
 *
 * @subpackage City Informer
 * @since      City Informer 1.2
 */
?>
<div id="footer-wrapper">
	<footer id="main-footer" role="contentinfo">
		<span class="city_informer-info">
			<?php _e( 'Powered by', 'city-informer' ); ?>
			<a href="<?php echo esc_url( 'http://bestweblayout.com' ); ?>" target="_blank"> BestWebLayout </a>
			<?php _e( 'and', 'city-informer' ); ?>
			<a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>" target="_blank"> WordPress </a>
		</span>
		<span class="city_informer-copyright">
			<?php echo date( 'Y' ) . ' ';
			bloginfo( 'name' ); ?>
		</span>
	</footer> <!-- #main-footer -->
</div> <!-- #footer-wrapper -->
</div> <!-- #container -->
</div> <!-- #page-wrapper-->
<?php wp_footer(); ?>
</body>
</html>
