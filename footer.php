<?php
/**
 * The template for displaying the footer
 *
 *
 * @subpackage City Informer
 * @since City Informer 1.2
 */
?>
			<div id="footer-wrapper">
				<footer id="main-footer" role="contentinfo">
					<span class="city_informer-info"> 
						<?php _e( 'Powered by', 'city_informer' ); ?> <a href="<?php echo esc_url( 'https://github.com/bestwebsoft' ); ?>" target="_blank"> BestWebSoft </a> 
						<?php _e( 'and', 'city_informer' ); ?> <a href="<?php echo esc_url( 'http://wordpress.org' ); ?>" target="_blank"> WordPress </a>
					</span>
					<span class="city_informer-copyright">&copy; 
						<?php echo date( 'Y' ) . ' '; bloginfo( 'name' ); ?>   
					</span>
				</footer> <!-- #main-footer -->
			</div> <!-- #footer-wrapper -->
		</div> <!-- #container -->
	</div> <!-- #page-wrapper-->
	<?php wp_footer(); ?>
</body>
</html>