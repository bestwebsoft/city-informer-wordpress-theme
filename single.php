<?php
/**
 * The template for displaying all single posts
 *
 * @subpackage City Informer
 * @since City Informer 1.2
 */
get_header(); ?>
	<div id="container">
		<div id="content" role="main">
			<?php if ( have_posts() ) {
				the_post(); 
				get_template_part( 'content', get_post_format() ); ?>
				<nav id="post-nav" class="post-navigation" role="navigation">
					<div class="post-nav-prev alignleft"><?php previous_post_link( '%link', '&laquo; %title' ); ?></div>
					<div class="post-nav-next alignright"><?php next_post_link( '%link', '%title &raquo;' ); ?></div>
					<div class="clear"></div>
				</nav><!-- #post-nav .post-navigation -->
				<?php if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			} else {
				// if no comtent
				get_template_part( 'content', 'none' );	
			} ?>
		</div> <!-- #content -->
		<?php get_sidebar(); ?>
	</div> <!-- #container -->
<?php get_footer(); ?>	