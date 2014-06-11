<?php
/**
 * The template for displaying image attachments
 *
 * @subpackage City Informer
 * @since City Informer 1.2
 */
get_header(); ?>
	<div id="container">
		<div id="content" role="main" >
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'image-attachment' ); ?>>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="cat">
						<?php $metadata = wp_get_attachment_metadata(); ?>
						<a href="<?php echo esc_url( wp_get_attachment_url() ); ?>" title="<?php _e( 'Link to full-size image', 'city_informer'); ?>">
							<?php echo $metadata['width']; ?> &times; <?php echo $metadata['height']; ?>
						</a>
						<a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" title="<?php _e( 'Return to', 'city_informer'); ?> <?php echo esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ); ?>" rel="gallery">
							<?php echo get_the_title( $post->post_parent ) . "."; ?>
						</a>
						<?php edit_post_link( __( 'Edit', 'city_informer' ), '<span class="edit-link">', '</span>' ); ?>
					</div> <!-- .cat -->
				</header>
				<div class="entry">
					<div class="entry-attachment">
						<div class="attachment">
							<?php $attachments = array_values( get_children( array( 
								'post_parent' 		=> $post->post_parent, 
								'post_status' 		=> 'inherit', 
								'post_type' 		=> 'attachment', 
								'post_mime_type' 	=> 'image', 
								'order' 			=> 'ASC', 
								'orderby' 			=> 'menu_order ID',
							) ) );
							foreach ( $attachments as $k => $attachment ) {
								if ( $attachment->ID == $post->ID )
									break;
							} 
							$k++;
							if ( count( $attachments ) > 1 ) {
								if ( isset( $attachments[ $k ] ) ) {
									// get the URL of the next image attachment
									$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
								} else {
									// or get the URL of the first image attachment
									$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
								};
							} else {
								// or, if there's only 1 image, get the URL of the image
								$next_attachment_url = wp_get_attachment_url();
							}; ?>
							<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment">
								<?php $attachment_size = apply_filters( 'city_informer_attachment_size', array( 560, 460 ) );
								echo wp_get_attachment_image( $post->ID, $attachment_size ); ?>
							</a>
							<nav id="image-navigation" class="nav-single" role="navigation">
								<span class="city_informer-previous-image city_informer-nav-previous"><?php previous_image_link( false, '&lsaquo;&lsaquo; ' . __( 'Previous', 'city_informer' ) ); ?></span>
								<span class="city_informer-next-image city_informer-nav-next"><?php next_image_link( false, __( 'Next', 'city_informer' ) . ' &rsaquo;&rsaquo;'); ?></span>
							</nav>
							<?php if ( ! empty( $post->post_excerpt ) ) { ?>
								<div class="wp-caption-text">
									<?php the_excerpt(); ?>
								</div>
							<?php }; ?>
						</div><!-- .attachment -->
					</div><!-- .entry-attachment -->
					<div class="entry-description">
						<?php the_content();
						wp_link_pages( array( 
							'before' 	=> '<div class="page-links">' . __( 'Pages:', 'city_informer' ), 
							'after' 	=> '</div>' 
						) ); ?>
					</div><!-- .entry-description -->
				</div>	<!-- .entry -->	
			</article><!-- #post -->
			<?php comments_template(); ?>
		</div> <!-- #content -->
		<?php get_sidebar(); ?>
	</div> <!-- #container -->
<?php get_footer(); ?>	