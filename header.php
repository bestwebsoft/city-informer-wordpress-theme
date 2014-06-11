<?php
/**
 * The Header template for our theme
 *
 * @subpackage City Informer
 * @since City Informer 1.2
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' )?>" />
	<meta name="viewport" content="width=device-width" /> <!-- For mobile browsers -->
	<title> <?php wp_title( '|', true, 'right' ); ?> </title>
	<!--[if (gte IE 6)&(lte IE 8)]>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/selectivizr-min.js"></script>
	<![endif]-->

	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="page-wrapper">
		<div id="main-header">
			<div id="city_informer-header-top-wrapper">
				<div id="city_informer-header-top" class="aligncenter">
					<header>
						<h1 class="city_informer-title">
							<a href="<?php echo esc_url( home_url() ); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo( 'name' ); ?></a>
						</h1>
						<h2 class="city_informer-description"> <?php bloginfo( 'description' ); ?></h2>
					</header>
					<div id="city_informer-navigation">
						<nav role="navigation">
							<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
						</nav>
					</div>
					<div class="clear"> </div>	
				</div><!-- #city_informer-header-top -->
			</div>  <!-- #city_informer-header-top-wrapper -->
			<div id="custom-header">
				<?php if( get_header_image() ) { ?>
					<div id="main-header" role="banner" style="height: <?php echo get_custom_header()->height . 'px;'; ?>">
						<div class="header-group">
							<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
						</div><!-- end .header-group -->
					</div><!-- end #main-header -->
				<?php } ?>		
			</div>	<!-- end #custom-header -->
			<div id="city_informer-header-bottom-wrapper">
				<div id="city_informer-header-bottom">
					<h2 class="city_informer-welcome"> <?php _e( 'Welcome to our blog!', 'city_informer' ); ?></h2> 
					<div class="city_informer-search-header">
						<?php get_search_form(); ?>
					</div>
					<!-- bread crumbs -->
					<?php do_action( 'city_informer_breadcrumbs' ); ?>
					<!-- end bread crumbs-->
				</div> <!-- #city_informer-header-bottom-->
			</div> <!-- #city_informer-header-bottom-wrapper-->
		</div> <!-- #main-header-->
		<!--  SLIDER  -->
		<?php if ( is_front_page() ) {
			get_template_part( 'slider' );
		}; ?>