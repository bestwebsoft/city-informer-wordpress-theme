<?php 
/**
 * The template for displaying search form
 *
 * @subpackage City Informer
 * @since City Informer 1.2
 */
?>
<form role="search" method="get" class="city_informer-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" name="s" id="s" class="city_informer-search-text" placeholder=" <?php _e( 'Enter search keyword', 'city_informer'); ?>" />
	<input type="submit" value="" class="city_informer-search-go"/>
</form>