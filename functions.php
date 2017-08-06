<?php
/**
 *	The MAIN FUNCTIONS FILE - includes all the neccesary additional theme functions, classes etc.
 *
 *	@since olea 1.0
 */

/**
 * HTTP or HTTPS protocol
 */

function olea_is_ssl_func( $protocol ) {
	if ( is_ssl() ) {
		$protocol = "https";
	}else{
		$protocol = "http";
	}
	return $protocol;
}
add_filter( 'olea_is_ssl' , 'olea_is_ssl_func',10,1 );
/*
 *	OPTIONS FRAMEWORK - INCLUDED FROM "ADMIN" FOLDER
 *
 *
*/ 
// Paths to admin functions :
// if NOT CHILD THEME -use the paths and dir bellow:
if( !is_child_theme() ) {
	define('AS_OF_ADMIN_PATH', get_template_directory() . '/admin/');
	define('AS_OF_ADMIN_URI', get_template_directory_uri() . '/admin/');
	define('AS_OF_LAYOUT_PATH', AS_OF_ADMIN_PATH . '/layouts/');
}
//
//
//
$theme_data	= wp_get_theme();
$theme_slug	= sanitize_title( $theme_data );
define('THEMENAME', $theme_data);

// Name of the database row in wp_options table where your options are stored
define('OPTIONS', 'of_'.$theme_slug); 
//
// Build Options
require_once ( AS_OF_ADMIN_PATH . 'admin-interface.php' );	// Admin Interfaces 
require_once ( AS_OF_ADMIN_PATH . 'theme-options.php' );		// Options panel settings and custom settings
require_once ( AS_OF_ADMIN_PATH . 'admin-functions.php' ); 	// Theme actions based on options settings
/* end Options Framework */
#
#
#
/**
 *	MAIN INITIALIZATIONS:
 *
 */
if ( ! function_exists( 'as_theme_setup' ) ):
function as_theme_setup() {
	// MAX MEDIA WIDTH
	if ( ! isset( $content_width ) ) $content_width = 1400;
	// TRANSLATIONS:
	load_theme_textdomain( 'olea', get_template_directory() . '/languages' );
	// HTML TITLE META TAG:
	add_theme_support( 'title-tag' );
	// POST FORMATS:
	add_theme_support( 'post-formats', array( 'audio', 'video', 'gallery','image', 'quote', 'chat', 'link', 'status' ) );
	//	POST THUMBNAIL SUPPORT:
	add_theme_support( 'post-thumbnails', array( 'post', 'page', 'product', 'portfolio', 'lookbook' ) );
	// FEEDS:
	add_theme_support( 'automatic-feed-links' );
	//
	// MENUS:
	add_theme_support( 'menus' );
	register_nav_menu( 'main-horizontal',	esc_html__( 'Main horizontal menu','olea') );
	register_nav_menu( 'main-vertical',		esc_html__( 'Main vertical menu','olea') );
	register_nav_menu( 'main-mobile',		esc_html__( 'Main mobile menu','olea') );
	register_nav_menu( 'secondary',			esc_html__( 'Secondary menu','olea') );
	//
	//
	/*************** IMAGES ******************/
	//
	// IMAGE RESIZING SCRIPT
	// BFI Thumb
	if( ! function_exists( 'bfi_thumb' ) ) {
		require_once( trailingslashit( get_template_directory() ) . 'inc/functions/BFI_Thumb.php');	
	}
	//
	// IMAGE SIZES (AS = Aligator Studio)
	// - custom portrait and landscape formats
	//
	add_image_size( 'as-portrait', 500, 700, true );
	add_image_size( 'as-landscape', 1200 ,680, true );
	//
	add_filter('image_size_names_choose', 'as_image_sizes_mediapopup', 11, 1);
	//
	/************ end IMAGES  ***************/
	//
	// ENABLE SHORTCODES ON REGULAR TEXT WIDGET
	add_filter('widget_text', 'do_shortcode'); // te enable shortcodes in widgets
	//
	add_editor_style();
	//
	//
	// THEME WIDGETS
	include( trailingslashit( get_template_directory() ) . 'inc/widgets/widget_latest_images.php');
	include( trailingslashit( get_template_directory() ) . 'inc/widgets/widget_featured_images.php');
	include( trailingslashit( get_template_directory() ) . 'inc/widgets/widget_social.php');
	include( trailingslashit( get_template_directory() ) . 'inc/widgets/latest-custom-posts.php');
	//
	//
	// CUSTOM META BOXES
	require_once( trailingslashit( get_template_directory() ) . 'inc/Custom-Meta-Boxes/custom-meta-boxes.php' );
	require_once( trailingslashit( get_template_directory() ) . 'inc/functions/as-meta-boxes.php' );
	//
	//
	
}
endif;// as_theme_setup
add_action( 'after_setup_theme', 'as_theme_setup' );
//
//
//
/**
 *  OLEA OPTIONS 
 *  
 *  @param [in] $setting - setting ID to fetch from options
 *  @param [in] $default - default (fallback) value for setting
 *  @return settion option calue
 *  
 */
function olea_options_func( $setting, $default ) {
	global $as_of;
	
	if ( is_ssl() ) {
		$as_of =  str_replace( "http://", "https://", $as_of );
	}
		
	$single_setting = isset( $as_of[$setting] ) ? $as_of[$setting] : '';

	if( $single_setting && !empty( $single_setting ) ) {
		$option = $single_setting;
	}else{
		$option = $default;
	}
	
	return $option;
}
add_filter( "olea_options", "olea_options_func", 10,2 );
/**
 *	GLOBALS AND CONSTANTS 
 *
 *	const AS_PLACEHOLDER_IMAGE - used on all the places where no thumbnail image is not set.
 *	var $delimiter - used in breadcrumbs ( in directories inc/functions and woocommerce/shop)
 */
define ('AS_PLACEHOLDER_IMAGE', apply_filters( "olea_options", "placeholder_image", get_template_directory_uri().'/img/default/no-image.jpg' ) );
define ('AS_UNDERHEAD_IMAGE', apply_filters( "olea_options", "under_head", false ) );
$delimiter   = '<span class="delimiter"><span class="icon icon-angle-right"></span></span>'; // delimiter between crumbs
/**
 *  OLEA LOGO
 *  
 *  @return html - return html with logo
 *  
 */
function olea_logo_func() {
	
	$logo		= apply_filters( "olea_options", "site_logo", get_template_directory_uri().'/img/logo.svg' );
	$logo_desc	= apply_filters( "olea_options", "logo_desc", array() );
	$logo_on	= !empty ( $logo_desc['logo_on'] );
	$desc_on	= !empty ( $logo_desc['desc_on'] );
	
	echo '<h1>';
	if ( $logo_on &&  $logo  ) {
	
		echo '<img src="'. esc_url($logo).'" title="'. get_bloginfo( 'name' ).' | '. get_bloginfo( 'description' ).'" '. ( isset($logo_size)  ?  'height='. intval($logo_size)  :  '' ) .' alt='. get_bloginfo( 'name' ).'" />';
	
	 } else { 
	
		echo '<span>'. get_bloginfo( 'name' ).'</span>';
	} 	
	echo '</h1>';
	
	if ( $desc_on ) { 
		'<div id="site-description">'. get_bloginfo( 'description' ).'</div>';
	}
	
} 
add_action( 'olea_logo', 'olea_logo_func' );
/**
 *	WP Filesystem wrapper class: 
 */
include_once( trailingslashit( get_template_directory() ) . 'inc/functions/wp-filesystem.php' );
/**
 *	ADMIN FUNCTIONS:
 */
include( trailingslashit( get_template_directory() ) . 'inc/functions/admin_functions.php');
/**
 * MENU FUNCTIONS:
 */
include( trailingslashit( get_template_directory() ) . 'inc/functions/menus.php');
//
/**
 *	WIDGETS FUNCTIONS:
 */
include( trailingslashit( get_template_directory() ) . 'inc/functions/widgets.php');
//
/**
 *	BREADCRUMBS:
 */
include( trailingslashit( get_template_directory() ) . 'inc/functions/breadcrumbs.php');
//
/**
 *	PAGINATION:
 */
include( trailingslashit( get_template_directory() ) . 'inc/functions/pagination.php');
//
/**
 *	RUN ONCE class:
 */
include( trailingslashit( get_template_directory() ) . 'inc/functions/run_once_class.php');
//
/*
 *	COMMENTS:
 */
include( trailingslashit( get_template_directory() ) . 'inc/functions/comments.php');
//
/**
 *	AUDIO / VIDEO: 
 */
include( trailingslashit( get_template_directory() ) . 'inc/functions/audio-video.php');
//
/**
 *	IMAGE / GALLERY:
 */
include( trailingslashit( get_template_directory() ) . 'inc/functions/image-gallery.php');
//
//
/**
 *	ENQUEUE THEME STYLES:
 */
include( trailingslashit( get_template_directory() ) . 'inc/functions/enqueue_styles.php');
//
/**
 *	ENQUEUE THEME SCRIPTS:
 */
include( trailingslashit( get_template_directory() ) . 'inc/functions/enqueue_scripts.php');
//
/** 
 *	POST FORMATS:
 */
include( trailingslashit( get_template_directory() ) . 'inc/functions/post-meta.php');
/** 
 *	POST META:
 */
include( trailingslashit( get_template_directory() ) . 'inc/functions/post-formats.php');
//
/**
 *	MISCELANEUOUS POST FUNCTIONS:
 */
include( trailingslashit( get_template_directory() ) . 'inc/functions/misc_post_functions.php');
//
//
/**
 *	PLUGINS:
 */
include( trailingslashit( get_template_directory() ) . 'inc/functions/theme_inc_plugins.php');
//
/**
 *	AJAX functions - used in custom blocks (prefixed with AS) created for Aqua Page Builder plugin
 */
 include( trailingslashit( get_template_directory() ) . 'inc/functions/ajax.php'); //
/**
 *	WOOCOMMERCE
 */
include( trailingslashit( get_template_directory() ) . 'woocommerce/woocommerce-theme-edits.php');
//
//
/**
 *	VISUAL COMPOSER EXTENDING:
 */
include( trailingslashit( get_template_directory() ) . 'as_vc_extend/as_vc_init.php');

/**
 *  VISUAL COMPOSER AND REVOLUTION SLIDER NAG MESSAGES HIDING
 */
// Visual composer
if( class_exists('Vc_Manager') ) {
	add_action('vc_before_init', function(){
		if(defined('WPB_VC_VERSION')){
			$_COOKIE['vchideactivationmsg_vc11'] = WPB_VC_VERSION;
		}
	});
}
/**
 *	OLEA 1.2.0 update notice
 *	- includes ajax function in js/admin/admin.js
 *
 */

$template	= wp_get_theme(get_template());
if ( $template->exists() ) {
	$version = $template->get( 'Version' ) ;
	if ( version_compare( $version, '1.2.0', '<=') && !get_option( "olea_120_updated" ) ) {
		add_action( 'admin_notices', 'olea_v_120' );
	}
}
function olea_v_120() {
    
	echo '<div class="notice error olea-120-notice is-dismissible" >';
    echo '<p><strong>' . __( '<span class="title">OLEA v.1.2.0 IMPORTANT UPDATE NOTICE!</span><span class="text">Olea theme elements for Visual Composer has moved to separate plugin "Olea VC elements". <br><a href="themes.php?page=tgmpa-install-plugins" class="tgmpa-olea-install-link">Please use Olea required plugins system to install the plugin </a>. </span><span><strong>If plugin is already installed, close and disregard this notice. If this is the first time you run Olea, simply follow the required plugins installation procedure.</strong></span>', 'olea' ) .' </strong></p>';
    echo '</div>';
    
}
add_action( 'wp_ajax_olea120-update-option', 'olea_120_updated_func' );// for logged in users
function olea_120_updated_func() {
	update_option( "olea_120_updated", true );
}

// Check if plugin is active
$olea_VC_plugin = in_array( 'olea-vc-elements/olea-vc-elements.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
if ( !$olea_VC_plugin && version_compare( $version, '1.2.0', '<=')   ) {
	add_action( 'admin_notices', 'olea_force_plugin' );
}
function olea_force_plugin() {
    
	echo '<div class="notice error is-dismissible" >';
    echo '<p><strong>' . __( '<span class="title">"OLEA VC ELEMENTS" PLUGIN MUST BE INSTALLED to keep Olea working properly</span><br><br><span class="text">Theme elements for Visual Composer has moved to separate plugin "Olea VC elements". <br><a href="themes.php?page=tgmpa-install-plugins">Please use Olea required plugins system to install the plugin</a></span>', 'olea' ) .' </strong></p>';
    echo '</div>';
    
}
/**
 *  Remove srcset from wp_get_attachment_image
 */
add_filter( 'wp_get_attachment_image_attributes', function( $attr )
{
    if( isset( $attr['sizes'] ) )
        unset( $attr['sizes'] );

    if( isset( $attr['srcset'] ) )
        unset( $attr['srcset'] );

    return $attr;

 }, PHP_INT_MAX );

// Override the calculated image sizes
add_filter( 'wp_calculate_image_sizes', '__return_false',  PHP_INT_MAX );

// Override the calculated image sources
add_filter( 'wp_calculate_image_srcset', '__return_false', PHP_INT_MAX );

// Remove the reponsive stuff from the content
remove_filter( 'the_content', 'wp_make_content_images_responsive' );

//Load GitGub Theme Updater Class
if( is_admin() ) {
	require_once( trailingslashit( get_template_directory() ) . 'inc/class-theme-updater.php' );
}
/*
if (headers_sent()) {
    print_r("Headers are sent");
}
*/