<?php
/**
 * The template for displaying if no content.
 *
 * @subpackage City Informer
 * @since City Informer 1.2
 */
?>
<article>
	<header class="entry-header">
		<h1 class="page-title"><?php _e( 'Nothing Found', 'city_informer' ); ?></h1>
	</header>
	<div class="entry">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>
			<p><?php printf( __( 'Ready to publish your first post?', 'city_informer' ) . '<a href="%1$s">' . __( 'Get started here', 'city_informer' ) . '</a>.', admin_url( 'post-new.php' ) ); ?></p>
		<?php } elseif ( is_search() ) { ?>
			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'city_informer' ); ?></p>
			<?php get_search_form();
		} else { ?>
			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'city_informer' ); ?></p>
			<?php get_search_form();
		} ?>
	</div><!-- .entry -->
</article>