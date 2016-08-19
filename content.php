<?php
/**
 * The default template for displaying content
 *
 * @subpackage City Informer
 * @since      City Informer 1.2
 */
global $wp_query; ?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<header class="entry-header">
		<h1>
			<?php if ( is_singular() ) {
				the_title();
			} else {
				the_title( '<a href="' . get_the_permalink() . '">', '</a>' );
			} ?>
		</h1>
		<div class="category">
			<?php if ( ! is_page() ) {
				_e( 'Posted on ', 'city-informer' );
				if ( is_singular() ) {
					printf( '<a href="%1$s" title="%2$s">%3$s</a>', esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ), the_title_attribute( 'echo=0' ), get_the_date() );
				} else {
					printf( '<a href="%1$s" title="%2$s">%3$s</a>', esc_url( get_the_permalink() ), the_title_attribute( 'echo=0' ), get_the_date() );
				}
				if ( has_category() ) {
					echo ' ' . __( 'in', 'city-informer' ) . ' ';
					the_category( ', ' );
				}
			}?>
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
				'before'      => '<div class="post-page-links"><span class="post-page-links-title">' . __( 'Pages:', 'city-informer' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		}
		if ( has_tag() ) { ?>
			<div class="post-tags">
				<?php the_tags( __( 'Tags:', 'city-informer' ) . ' ', ', ', '' ); ?>
			</div>
		<?php }
		if ( ! is_singular() ) {
			if ( $wp_query->current_post > 0 && ! is_single() ) { ?>
				<div class="scroll-up"><a href="#container">[<?php _e( 'Top', 'city-informer' ); ?>]</a></div>
			<?php }
		} ?>
	</div>  <!-- end .entry -->
</article>
