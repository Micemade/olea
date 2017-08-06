<?php
/**
 *	REGISTER AND ENQUEUE ADMIN STYLES
 *
 */
function as_customAdminCSS() {
	wp_register_style('olea-admin-css', get_template_directory_uri(). '/css/admin/admin_styles.css', 'style');
	wp_enqueue_style( 'olea-admin-css');
}
add_action('admin_head', 'as_customAdminCSS');
function icons_styles_script() {

	wp_register_style( 'glyphs_css', get_template_directory_uri() . '/css/admin/glyphs.css', false, '1.0.0' );
	wp_enqueue_style( 'glyphs_css' );

}
add_action( 'admin_enqueue_scripts', 'icons_styles_script' );
//
/**
 *	REGISTER AND ENQUEUE THEME STYLES
 *
 */
function as_theme_styles() { 
	
	$t_url = get_template_directory_uri();
	
	/* 
	 * REGISTER GOOGLE FONTS 
	 */
	$protocol = apply_filters( 'olea_is_ssl','');
	
	$goo_body_setting	= apply_filters( "olea_options", "google_body", array('face'=>'Roboto', 'size'=>'16px', 'weight'=>'400', 'color'=>'#333333') );
	$goo_head_setting	= apply_filters( "olea_options", "google_headings", array('face'=>'Crushed', 'weight'=>'400', 'color'=>'') );
	
	$google_body		= $goo_body_setting['face'];
	$google_headings	= $goo_head_setting['face'];
	$one_google_font	= ( $google_body == $google_headings ) ? true : false;
	
	// Google font subsets
	$subsets = 'latin, latin-ext';
	$google_subsets = apply_filters( "olea_options", "google_subsets", array('latin','latin-ext') );
	if( ! empty( $google_subsets ) ) {
		$subsets = array_keys( $google_subsets );
		$subsets = implode(',',$subsets);
	}
	
	if( $google_body ) {
		$gooFontBody = str_replace(' ','+', $google_body );
		wp_register_style('google-font-body', esc_url($protocol . '://fonts.googleapis.com/css?family='. $gooFontBody .':300,400,600,700,800,400italic,700italic&subset=' . $subsets)  );
	}
	
	if( $google_headings && !$one_google_font ) {
		$gooFontHeads = str_replace(' ','+', $google_headings );
		wp_register_style('google-font-headings', esc_url( $protocol . '://fonts.googleapis.com/css?family='. $gooFontHeads .':300,400,600,700,800,400italic,700italic&subset=' . $subsets ) );
	}
	
	
	
	/* REGISTER STYLES*/
	
	wp_register_style( 'olea-main-css', esc_url( $t_url ) . '/style.css', '', '', 'all' );
	
	
	/* ENQUEUE STYLES */
	wp_enqueue_style( 'google-font-headings' );
	wp_enqueue_style( 'google-font-body' );

	wp_enqueue_style( 'olea-main-css' );


	### THEME SKIN
	wp_enqueue_style('theme-skin', admin_url('admin-ajax.php') . '?action=theme_skin_css',array(), '1.0.0', 'all');
	require_once ('theme_skin_fonts.php');
	
	
	### THEME OPTIONS CSS AND JAVACRIPTS
	$dynamic_css_js = apply_filters( "olea_options", "dynamic_css_js", 0 );
	
	if( $dynamic_css_js ) {
		//DYNAMIC (AJAX) THEME OPTIONS CSS:
		wp_enqueue_style('options-styles', admin_url('admin-ajax.php') . '?action=dynamic_css',array(), '1.0.0', 'all');
	}else{
		
		// FILES CREATING:
		$theme_data		= wp_get_theme();					// get theme info
		$theme_slug		= sanitize_title( $theme_data ); 	// make Olea Fashion to be olea-fashion
		
		$uploads		= wp_upload_dir();
		$as_upload_dir	= trailingslashit($uploads['basedir']) . $theme_slug . '-options'; // DIRECTORY to uploads
		$as_upload_url	= trailingslashit($uploads['baseurl']) . $theme_slug . '-options'; // URL to uploads
		
		$as_upload_dir_exists = is_dir( $as_upload_dir );
		
		// THEME OPTIONS CSS :
		if( $as_upload_dir_exists ){
			
			wp_register_style('options-styles', $as_upload_url . '/theme_options_styles.css', 'style');
			
		}else{
		
			wp_register_style('options-styles', get_stylesheet_directory_uri() . '/admin_save_options/theme_options_styles.css', 'style');
			
		}
		wp_enqueue_style( 'options-styles');
		//
		//
	}
		
}
add_action('wp_enqueue_scripts', 'as_theme_styles');
//
//
/**
 *	THEME SKIN
 *
 */
function theme_skin_css() {
	
	$theme_skin = apply_filters( "olea_options", "theme_skin", "narrow_red_rustic.php" );
	$file = get_template_directory().'/admin/layouts/'.$theme_skin;	
	require($file);
	exit;
}
add_action('wp_ajax_theme_skin_css', 'theme_skin_css');
add_action('wp_ajax_nopriv_theme_skin_css', 'theme_skin_css');
/**
 *	DYNAMIC CSS - AJAX 
 *
 */
function dynamic_css() {
	
	$file = get_template_directory().'/admin_save_options/theme_options_styles.php';	
	require($file);
	exit;
}
add_action('wp_ajax_dynamic_css', 'dynamic_css');
add_action('wp_ajax_nopriv_dynamic_css', 'dynamic_css');
//
//
//
/**
 *	CUSTOMIZE LOGIN PAGE.
 *
 */
// Add custom css for login page
function as_login_stylesheet() {

	### THEME OPTIONS CREATING FILES AND REGISTER/ENQUEUING 
	
	$theme_data		= wp_get_theme(); // get theme info
	$theme_slug		= sanitize_title( $theme_data ); // make Olea Fashion to be olea-fashion
	
	$uploads		= wp_upload_dir();
	$as_upload_dir	= trailingslashit($uploads['basedir']) . $theme_slug . '-options'; // DIRECTORY to uploads
	$as_upload_url	= trailingslashit($uploads['baseurl']) . $theme_slug . '-options'; // URL to uploads
	
	$as_upload_dir_exists = is_dir( $as_upload_dir );
		
	if( $as_upload_dir_exists ){
	
		wp_enqueue_style( 'custom-login', $as_upload_url . '/custom_login_css.css' );
		
    }else{
	
		wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/admin/css/customlogin.css' );
	}
	
}
add_action( 'login_enqueue_scripts', 'as_login_stylesheet' );
//
// Change link and title from Wordpress.org to site homepage
function as_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'as_login_logo_url' );

function as_login_logo_url_title() {	
    return get_bloginfo('name');
}
add_filter( 'login_headertitle', 'as_login_logo_url_title' );

?>