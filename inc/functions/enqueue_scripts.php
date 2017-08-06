<?php 
/**
 * SCRIPTS : ENQUEUE AND REGISTER
 *
 */
function as_theme_js() {
	
	$t_url = get_template_directory_uri(); 
	
	//
	//
	wp_enqueue_script('jquery', '','','',true);
	
	
	// REGISTERING
	
	wp_register_script('olea_theme_scripts', $t_url.'/js/theme_scripts.min.js');
	
	// ENQUEUING 
	
	wp_enqueue_script('olea_theme_scripts', $t_url.'/js/theme_scripts.min.js', array('jQuery'), '1.0', true);
	//
	//
	//
	//
	### THEME OPTIONS CSS AND JAVACRIPTS
	$dynamic_css_js = apply_filters( "olea_options", "dynamic_css_js", 0 );
	if( $dynamic_css_js ) {
	
		//DYNAMIC (AJAX) THEME OPTIONS JAVASCRIPT:
		wp_enqueue_script('options-js', admin_url('admin-ajax.php') . '?action=dynamic_js',array(), '1.0.0', 'all');
		
	}else{
	
		$theme_data		= wp_get_theme(); // get theme info
		$theme_slug		= sanitize_title( $theme_data ); // make Olea Fashion to be olea-fashion
		
		$uploads		= wp_upload_dir();
		$as_upload_dir	= trailingslashit($uploads['basedir']) . $theme_slug . '-options'; // DIRECTORY to uploads
		$as_upload_url	= trailingslashit($uploads['baseurl']) . $theme_slug . '-options'; // URL to uploads
		
		$as_upload_dir_exists = is_dir( $as_upload_dir );
		
		if( $as_upload_dir_exists ){
			
			wp_register_script('options-js', $as_upload_url . '/theme_options_js.js');
			wp_enqueue_script('options-js', $as_upload_url . '/theme_options_js.js', array('jQuery'), '1.0', true);
			
		}else{
		
			wp_register_script('options-js', get_stylesheet_directory_uri() . '/admin_save_options/theme_options_js.js');
			wp_enqueue_script('options-js', get_stylesheet_directory_uri().'/admin_save_options/theme_options_js.js', array('jQuery'), '1.0', true);		
		}
		
	}
		
	// Localize the script with our data.
	$translation_array = array( 
		'loading_qb' => __( 'Loading quick buy','olea' )

	);
	wp_localize_script( 'options-js', 'wplocalize_options', $translation_array );
	
} // END FUNC. theme_js()
add_action('wp_enqueue_scripts', 'as_theme_js');
//
//
/**
 *	DYNAMIC JS - AJAX 
 *
 */
function dynamic_js() {

	$file = get_template_directory().'/admin_save_options/theme_options_js.php';
	require($file);
	exit;
}
add_action('wp_ajax_dynamic_js', 'dynamic_js');
add_action('wp_ajax_nopriv_dynamic_js', 'dynamic_js');
//
//
/**
 *	ADD SOME ADMIN JS (and/or css)
 *
 */
function customAdminCode() {
	wp_register_script('as-admin-js', get_template_directory_uri(). '/js/admin.js');
	wp_enqueue_script( 'as-admin-js', get_template_directory_uri(). '/js/admin.js', array('jQuery'), '1.0', true );
}
add_action('admin_head', 'customAdminCode');
/*
function IE_stuff () {	
}
add_action('wp_head', 'IE_stuff');
*/
/**
 *	TYPEKIT scripts.
 *
 */
$google_typekit_toggle = apply_filters( "olea_options", "google_typekit_toggle", "google" );
if( $google_typekit_toggle == 'typekit' ) {

	function as_theme_typekit() {
			
		$typekit_id =  apply_filters( "olea_options", "typekit_id", "" );
		wp_enqueue_script( 'theme_typekit', '//use.typekit.net/'. $typekit_id .'.js');
	}
	add_action( 'wp_enqueue_scripts', 'as_theme_typekit' );

	function as_theme_typekit_inline() {
	  if ( wp_script_is( 'theme_typekit', 'done' ) ) {
	?>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<?php }
	}
	add_action( 'wp_head', 'as_theme_typekit_inline' );
} //endif
?>