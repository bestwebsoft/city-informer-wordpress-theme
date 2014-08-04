<?php
/**
 * City Informer functions and definitions
 *
 * @subpackage City Informer
 * @since City Informer 1.2
 */



// sets up theme, theme support
function city_informer_setup() {
	load_theme_textdomain( 'city_informer', get_template_directory() . '/languages' );
	add_theme_support( 'post-thumbnails' ); 
	//image size for futured images
	add_image_size( 'featured-image', 560, 9999 ); 
	//image size for slider images
	add_image_size( 'slider-image', 1920 , 422, true );
	//add custom-header support
	$args = array(
		'width'  				=> 1920,
		'height' 				=> 100,
		'flex-width'			=> true,
		'flex-height'			=> true,
		'uploads' 				=> true,
		'header-text' 			=> true,
		'default-text-color' 	=> 'fff',
		'wp-head-callback'		=> 'city_informer_header_style',
	);
	add_theme_support( 'custom-header', $args );
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	// Styles the visual editor with editor-style.css
	add_editor_style();
	// Styles for default background arguments
	$background_args = array (
		'default-color'		=> 'e3e3e3',
		'default-image' 	=> get_template_directory_uri() . '/images/background.jpg',
	);
	add_theme_support( 'custom-background', $background_args );
	// Register navigation menu
	register_nav_menus ( array( 'header-menu' => 'Main Menu' ) );
	//set content width
	if ( ! isset( $content_width ) )
		$content_width = 620;
}

// title filter
function city_informer_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() )
		return $title;
	// Add the site name.
	$title .= get_bloginfo( 'name' );
	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";
	// Add a page number if necessary.
	if ( 2 <= $paged || 2 <= $page )
		$title = "$title $sep " . sprintf( __( 'Page', 'city_informer' ) . ' %s', max( $paged, $page ) );
	return $title;
}

// Registers main widget area
function city_informer_register_widget() {
	register_sidebar( array(
		'name'			=>	__( 'Main Sidebar', 'city_informer' ),
		'id'			=> 'sidebar-widgets',
		'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title'	=> '<h1 class="widget-title">',
		'after_title'	=> '</h1>',
	) ); 
}

/*********************************** FOR SLIDER ****************/
//adding metabox for show post in slider
function city_informer_metabox_for_slider() { 
	add_meta_box( 'city_informer_metabox_id', __( 'Add to slider' , 'city_informer' ), 'city_informer_metabox_for_slider_callback', 'post', 'normal' );
}

// add and save meta for post
function city_informer_save_post_meta_for_slider( $post_id ) { 
	global $post, $post_id;	
	// autosave meta for post
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return $post_id;
	elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}
	// save meta for post
	if ( wp_is_post_revision( $post_id ) )
		return $post_id;	
	if ( $post != null ) {
        if ( ( isset ( $_POST['city_informer_add_slide'] ) ) && ( $_POST['city_informer_add_slide'] == 'on' ) ) {
            update_post_meta( $post->ID, 'city_informer_add_slide', 'on' );
        }
        else {
            update_post_meta( $post->ID, 'city_informer_add_slide', 'off' );
        }
    }
}

//customize metabox
function city_informer_metabox_for_slider_callback() {
	global $post; 
	$screen = get_current_screen(); 
	// Add form elements for metabox ?>
	<label for='city_informer_add_slide'><?php echo __( 'To add this', 'city_informer' ) . ' ' . $screen->post_type . ' ' . __( 'into the slider, mark it', 'city_informer' ); ?></label>	
	<input type='checkbox' name='city_informer_add_slide' id='city_informer_add_slide' value='on' <?php if ( 'on' == get_post_meta( $post->ID, 'city_informer_add_slide', true ) ) { ?> checked='checked' <?php } ?> />
<?php }

//excerpt for slider
function city_informer_excerpt_length( $excerpt ) {  
	$length = 100;
	$excerpt = ( strlen( $excerpt ) > $length ) ? mb_substr( $excerpt, 0, $length ) . '...' : $excerpt;
	return $excerpt; 
}
/********************************END FOR SLIDER ****************/

// register scripts and styles
function city_informer_scripts_styles() {
	// load css
	wp_enqueue_style( 'city_informer_styles', get_stylesheet_uri() );
	// load js scripts
	wp_enqueue_script( 'city_informer_script', get_template_directory_uri().'/js/script.js', array( 'jquery' ), null, false );
	wp_enqueue_script( 'city_informer_script_slider', get_template_directory_uri().'/js/slider.js', array( 'jquery' ), null, false );
	wp_enqueue_script( 'city_informer_script_fileinput', get_template_directory_uri().'/js/fileinput.js', array( 'jquery' ), null, false );
	wp_enqueue_script( 'city_informer_script_selectbox', get_template_directory_uri().'/js/selectbox.js', array( 'jquery' ), null, false );
	// load styles for ie
	wp_enqueue_style( 'city_informer_style_ie', get_template_directory_uri() . "/styles/ie78.css" );
	wp_style_add_data( 'city_informer_style_ie', 'conditional', 'lt IE 9' );
	// load script for comment-reply
	if ( is_singular() ) wp_enqueue_script( "comment-reply" ); 	
}

// custom header
function city_informer_header_style() {
	$text_color = get_header_textcolor();
	$display_text = display_header_text();
	if ( $text_color == HEADER_TEXTCOLOR )/* If no custom options for text are set, return default. */
		return;
	/* If optins are set, we use them */ ?>
	<style type="text/css">
	<?php 
		if ( 'blank' == $text_color ) { /* If the user has set a custom color for the text use that */
		} else { ?>
		.site-title a {
			color: #<?php echo $text_color; ?> !important;
		}
	<?php } 
	if( ! $display_text ){ /* Display text or not */ ?>
		.site-title {
			display: none;
		}
	<?php } ?>
	</style>
	<?php
}
// Breadcrumbs
function city_informer_breadcrumbs() {
	global $post;
	global $author;
	$show_on_home = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$delimiter = '-'; // delimiter between crumbs
	$show_current = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$before = '<span class="current">'; // tag before the current crumb
	$after = '</span>'; // tag after the current crumb
	$text['home']     = __( 'Home', 'city_informer' ); /* Link text "Home" */
	$text['category'] = __( 'Category:', 'city_informer' ) . ' %s'; /* Text for a category page */
	$text['search']   = __( 'Results for:', 'city_informer' ) . ' %s'; /* Text for the search results page */
	$text['tag']      = __( 'Tags:', 'city_informer' ) . ' %s'; /* Text for the tag page */
	$text['author']   = __( 'Autors posts:', 'city_informer' ) . ' %s'; /* Text for the autor page */
	$text['404']      = __( 'Error 404', 'city_informer' ); /* Text for the page 404 */
	$home_link = home_url();
	// code for generate breadcrumbs
	if ( is_home() || is_front_page() ) {
	    if ( $show_on_home == 1 ) 
	    	echo '<div class="breadcrumbs"><a href="' . $home_link . '">' . sprintf( $text['home'] ) . '</a></div>';
	} else {
		echo '<div class="breadcrumbs"><a href="' . $home_link . '">' . sprintf( $text['home'] ) . '</a> ' . $delimiter . ' ';
	    if ( is_category() ) {
			$this_cat = get_category( get_query_var( 'cat' ), false );
			if ( $this_cat->parent != 0 ) 
				echo get_category_parents( $this_cat->parent, true, ' ' . $delimiter . ' ' );
			echo $before . sprintf( $text['category'], single_cat_title( '', false ) ) . $after;
		} elseif ( is_search() ) {
			echo $before . sprintf( $text['search'], get_search_query() ) . $after;	
		} elseif ( is_day() ) {
			echo '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a> ' . $delimiter . ' ';
			echo '<a href="' . get_month_link( get_the_time( 'Y' ),get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time( 'd' ) . $after;
		} elseif ( is_month() ) {
			echo '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time( 'F' ) . $after;	  
		} elseif ( is_year() ) {
			echo $before . get_the_time( 'Y' ) . $after;	  
		} elseif ( is_single() && ! is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object( get_post_type() );
				$slug = $post_type->rewrite;
				echo '<a href="' . $home_link . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
			if ( $show_current == 1 ) 
				echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents( $cat, true, ' ' . $delimiter . ' ' );
				if ( $show_current == 0 ) 
					$cats = preg_replace( "#^(.+)\s$delimiter\s$#", "$1", $cats );
					echo $cats;
				if ( $show_current == 1 ) 
					echo $before . get_the_title() . $after;
			}
		} elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' && ! is_404() ) {
			$post_type = get_post_type_object( get_post_type() );
			echo $before . $post_type->labels->singular_name . $after;
		} elseif ( is_attachment() ) {
			$parent = get_post( $post->post_parent );
			$cat = get_the_category( $parent->ID ); $cat = $cat[0];
			echo get_category_parents( $cat, true, ' ' . $delimiter . ' ' );
			echo '<a href="' . get_permalink( $parent ) . '">' . $parent->post_title . '</a>';
			if ( $show_current == 1 ) 
				echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after; 
		} elseif ( is_page() && ! $post->post_parent ) {
		  	if ( $show_current == 1 ) 
		  		echo $before . get_the_title() . $after;
		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ( $parent_id ) {
				$page = get_page( $parent_id );
				$breadcrumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse( $breadcrumbs );
			for ( $i = 0; $i < count( $breadcrumbs ); $i++ ) {
				echo $breadcrumbs[ $i ];
				if ( $i != count( $breadcrumbs )-1 )
					echo ' ' . $delimiter . ' ';
			}
			if ( $show_current == 1 )
				echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
		} elseif ( is_tag() ) {
			echo $before . sprintf( $text['tag'], single_tag_title( '', false ) ) . $after;
		} elseif ( is_author() ) {
			$userdata = get_userdata( $author );
			echo $before . sprintf( $text['author'], $userdata->display_name ) . $after;
		} elseif ( is_404() ) {
			echo $before . sprintf( $text['404'], '' ) . $after;
		}
		echo '</div>'; 
	}
} // end city_informer_breadcrumbs

// Post caption for thumbnail
function city_informer_the_post_caption( $size = '', $attr = '' ) {
	global $post;
	$thumb_id = get_post_thumbnail_id( $post->ID );
	$args = array(
		'post_type' 	=> 'attachment',
		'post_status' 	=> null,
		'parent' 		=> $post->ID,
		'include'  		=> $thumb_id,
	);
	$thumbnail_image = get_posts( $args );
	if ( $thumb_id && $thumbnail_image && isset( $thumbnail_image[0] ) ) {
		// Showing the thumbnail caption
		$caption = $thumbnail_image[0]->post_excerpt;
		if( $caption ) {
			$output = '<p class="thumbnail-caption-text">';
			$output .= $caption;
			$output .= '</p>';
			echo $output;
		};
	};
}

// Show pages navigation
function city_informer_page_nav() {
	if ( get_previous_posts_link() || get_next_posts_link() ) { 
		// div for navigation ?>
		<div class="city_informer-nav-link">
			<div class="alignleft"><?php next_posts_link( '&larr; ' . __( 'Older posts', 'city_informer' ) ); ?></div>
			<div class="alignright"><?php previous_posts_link( __( 'Newer posts', 'city_informer' ) . ' &rarr;' ); ?></div>
		</div><!-- .city_informer-nav-link -->
	<?php };
}

// function for ie 7-8
function city_informer_ie() { ?>
	<!--[if lte IE 9]>
		<script>
			var e = array[ article, aside, figcaption, figure, footer, header, hgroup, nav, section, time ];
			for ( var i = 0; i < e.length; i++ ) {
				document.createElement( e[i] );
			}
		</script>
		<style type="text/css" media="screen">
			blockquote, 
			#nav ul li:hover ul,
			.search_text,
			#content input[type="text"],
			#content input[type="password"],
			#content textarea,
			{
				behavior: url( '<?php echo get_template_directory_uri();?>/js/PIE.htc' );
			}
		</style> 
	<![endif]-->
<?php }

//Add actions
add_action( 'after_setup_theme', 'city_informer_setup' );
add_filter( 'wp_title', 'city_informer_title', 10, 2 );
add_action( 'widgets_init', 'city_informer_register_widget' );
add_action( 'add_meta_boxes', 'city_informer_metabox_for_slider' );
add_action( 'save_post', 'city_informer_save_post_meta_for_slider' );
add_filter( 'get_the_excerpt', 'city_informer_excerpt_length' );  

add_action( 'wp_enqueue_scripts', 'city_informer_scripts_styles' );
add_action( 'city_informer_breadcrumbs', 'city_informer_breadcrumbs' );
add_action( 'city_informer_post_caption', 'city_informer_the_post_caption' );

add_action( 'city_informer_page_nav', 'city_informer_page_nav' );

add_action( 'wp_print_scripts', 'city_informer_ie', 8 );
