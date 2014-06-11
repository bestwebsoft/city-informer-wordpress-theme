<?php
/**
 * The default template for displaying content
 *
 * @subpackage City Informer
 * @since City Informer 1.2
 */
global $wp_query; ?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<header class="entry-header">		
		<h1>
			<?php if ( is_single() ) {
				the_title();
			} else { ?>
				<a href="<?php the_permalink();?>"><?php the_title(); ?></a> 
			<?php } ?>
		</h1>
		<div class="category"> 
			<?php if ( ! is_singular() ) {
				_e( 'Posted on', 'city_informer' ); echo ' '; ?><a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>	
				<?php if ( has_category() )
					echo __( 'in', 'city_informer' ) . ' '; the_category( ', ' ); 
			} ?>						
		</div> <!-- end .category -->
	</header> <!-- end .entry-header -->
	<div class="entry">
		<?php if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'featured-image' );	
			do_action( 'city_informer_post_caption' );
		}
		if ( is_search() || is_category() || is_archive() ) { 								
			the_excerpt();	
		} else {
			the_content();
			wp_link_pages( array( 
				'before' 		=> '<div class="post-page-links"><span class="post-page-links-title">' . __( 'Pages:', 'city_informer' ) . '</span>', 
				'after' 		=> '</div>', 
				'link_before' 	=> '<span>', 
				'link_after' 	=> '</span>', 
			) );					
		} 
		if ( has_tag() ) { ?>		
			<div class="post-tags">
				<?php the_tags( __( 'Tags:', 'city_informer' ) . ' ', ', ', '' ); ?> 
			</div> 
		<?php }
		if ( ! is_singular() ) { 
			if( $wp_query->current_post > 0 && ! is_single() ) { ?>
				<div class="scroll-up"><a href="#container">[<?php _e( 'Top', 'city_informer' ); ?>]</a></div>
			<?php } 
		} ?>
	</div>	<!-- end .entry -->	
</article>

