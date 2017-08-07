<?php
/**
 * This file is a configuration for importing required and recommended plugins.
 *
 * @package	   TGM-Plugin-Activation
 * @subpackage Theme plugins
 * @version	   2.6.1
 * @author	   Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author	   Gary Jones <gamajo@gamajo.com>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license	   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */

require_once trailingslashit( get_template_directory() ) . 'inc/tgm-plugin-activation/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for Olea theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// REQUIRED PLUGINS
		array(
			'name' 				=> 'GitHub Updater',
			'slug' 				=> 'github-updater',
			'source'			=> get_template_directory() . '/inc/plugins/github-updater.zip',
			'required' 			=> true,
			'force_activation' 	=> true,
			'force_deactivation'=> false,
		),
		array(
			'name' 				=> 'WooCommerce',
			'slug' 				=> 'woocommerce',
			'required' 			=> true,
		),
		array(
			'name' 				=> 'Visual Composer',
			'slug' 				=> 'js_composer',
			'source'			=> 'http://aligator-studio.com/tgm_pa_plugins/js_composer.zip',
			'external_url' 		=> 'http://aligator-studio.com/tgm_pa_plugins',
			'required' 			=> true,
			'force_activation' 	=> false,
			'force_deactivation'=> false,
		),	
		array(
			'name' 				=> 'Olea VC elements',
			'slug' 				=> 'olea-vc-elements',
			'source'			=> 'http://aligator-studio.com/tgm_pa_plugins/olea-vc-elements.zip',
			'external_url'		=> 'http://aligator-studio.com/tgm_pa_plugins/',
			'required' 			=> true,
			'force_activation' 	=> false,
			'force_deactivation'=> false,
		),
		array(
			'name' 				=> 'Revolution Slider',
			'slug' 				=> 'revslider',
			//'source'			=> get_template_directory() . '/inc/plugins/revslider.zip',
			'source'			=> 'http://aligator-studio.com/tgm_pa_plugins/revslider.zip',
			'external_url'		=> 'http://aligator-studio.com/tgm_pa_plugins/',
			'required' 			=> true,
		),
		array(
			'name' 				=> 'WP Envato Market',
			'slug' 				=> 'envato-market',
			'source'			=> 'http://envato.github.io/wp-envato-market/dist/envato-market.zip',
			'required' 			=> true,
		),
		array(
			'name' 				=> 'WooCommerce Lookbook',
			'slug' 				=> 'woocommerce-as-lookbook',
			'source'			=> 'http://aligator-studio.com/tgm_pa_plugins/woocommerce-as-lookbook.zip',
			'external_url'		=> 'http://aligator-studio.com/tgm_pa_plugins/',
			'required' 			=> true,
			'force_activation' 	=> false,
			'force_deactivation'=> false,
		),
		
		
		// 
		//	Recommended plugins
		//	
		//
		
		array(
			'name' 				=> 'AS Portfolio',
			'slug' 				=> 'as-portfolio',
			'source'			=> 'http://aligator-studio.com/tgm_pa_plugins/as-portfolio.zip',
			'external_url'		=> 'http://aligator-studio.com/tgm_pa_plugins/',
			'required' 			=> false,
			'force_activation' 	=> false,
			'force_deactivation'=> false,
		),
		array(
			'name' 				=> 'Attachment importer',
			'slug' 				=> 'attachment-importer',
			'required' 			=> false,
		),
		array(
			'name' 				=> 'Cresta Social Share Counter',
			'slug' 				=> 'cresta-social-share-counter',
			'required' 			=> false,
		),
		array(
			'name' 				=> 'YITH WooCommerce Wishlist',
			'slug' 				=> 'yith-woocommerce-wishlist',
			'required' 			=> false,
		),
		array(
			'name' 				=> 'YITH WooCommerce Ajax Search',
			'slug' 				=> 'yith-woocommerce-ajax-search',
			'required' 			=> false,
		),
		
		array(
			'name' 				=> 'WooCommerce ShareThis Integration',
			'slug' 				=> 'woocommerce-sharethis-integration',
			'required' 			=> false
		),	
		
		array(
			'name'     				=> 'WP Tab Widget',
			'slug'     				=> 'wp-tab-widget',
			'required' 				=> false,
			'version' 				=> '1.2',
			'force_activation' 		=> false, 
			'force_deactivation' 	=> false
		),			
		
	);


	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'default_path' => '',						// Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins',	// Menu slug.
        'has_notices'  => true,						// Show admin notices or not.
        'dismissable'  => true,						// If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',						// If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => true,						// Automatically activate plugins after installation or not.
        'message'      => '',						// Message to output right before the plugins table.
		
		// 'strings'	=> array(); // check for edit in inc/tgm-plugin-activation/class-tgm-plugin-activation.php file
	);

	tgmpa( $plugins, $config );

}