<?php
/**
 *	AS_VC_INCLUDES 
 *	include files depending on if child theme is active and file exists in child theme
 *	
 */
function as_vc_includes( $file ) {
	
	$child_file		= get_stylesheet_directory() . '/as_vc_extend/' . $file;
	$default_file	= get_template_directory(). '/as_vc_extend/' . $file;
	
	if( is_child_theme() ) {
		if( file_exists( $child_file ) ) {
			include( $child_file );
		}else{
			include( $default_file );
		}
			
	}else{
		include( $default_file );
	}
}

function VC_AS_init() {

	if( class_exists('Vc_Manager') ) {
	
		global $olea_woo_is_active;
		
		########## THEME VISUAL COMPOSER SHORTCODES
		
		as_vc_includes('shortcodes/as_ajax_cats.php');		// PRODUCTS AJAXED BY CATEGORIES
		as_vc_includes('shortcodes/as_filter_cats.php');	// POSTS, PORTFOLIO FILTERED BY CATEGORIES
		as_vc_includes('shortcodes/as_slick_slider.php');	// SLICK SLIDER
		as_vc_includes('shortcodes/as_menu.php');			// CUSTOM MENU
		as_vc_includes('shortcodes/as_banner.php');			// BANNER
		as_vc_includes('shortcodes/as_testimonials.php');	// TESTIMONIAL
		as_vc_includes('shortcodes/as_single_lookbook.php');// LOOKBOOK
		as_vc_includes('shortcodes/as_gmap.php');			// GOOGLE MAP
		as_vc_includes('shortcodes/as_heading.php');		// HEADING
		as_vc_includes('shortcodes/as_contact.php');		// CONTACT
		as_vc_includes('shortcodes/as_video.php');			// VIDEO PLAYER
		
		if( $olea_woo_is_active ) {
			as_vc_includes('shortcodes/as_ajax_prod.php');		// POSTS, PORTFOLIO AJAXED BY CATEGORIES
			as_vc_includes('shortcodes/as_filter_prod.php');	// PRODUCTS FILTERED BY CATEGORIES
			as_vc_includes('shortcodes/as_prod_cats.php');		// PRODUCT  CATEGORIES
			as_vc_includes('shortcodes/as_single_product.php');	// SINGLE PRODUCT
		}
		
		
		
		// SEPARATOR FOR FIELDS
		// callable in plugin "Olea VC elements" (required plugin)
		function as_vc_separator($settings, $value) {
			
			$separator_html  = '<div class="separator"></div>';
			
			return $separator_html;
		}
		

		
		/**
		 *	CUSTOM MENU CSS TO BODY TAG
		 */
		function custom_menu_body_class( $c ) {
			global $post;
			if( isset($post->post_content) && has_shortcode( $post->post_content, 'as_menu' ) ) {
				$c[] = 'has-custom-menu';
			}
			return $c;
		}
		add_filter( 'body_class', 'custom_menu_body_class' );
		
		/**
		 *	HEADINGS for all the blocks
		 */
		function as_block_heading_func( $title="", $subtitle="", $title_style="", $sub_position="", $title_color="", $subtitle_color="", $no_decoration="", $title_size="" ) {
						
			$heading = '<div class="header-holder '. $title_style.' titles-holder'. ($no_decoration ? ' no-decor' : '') .'">';
			
			// DISPLAY BLOCK TITLE AND "SUBTITLE":
			$sub = $subtitle ? '<div class="block-subtitle '. esc_attr($sub_position). ' ' .esc_attr($title_style) .'"'. (esc_attr($subtitle_color) ? ' style="color:'.esc_attr($subtitle_color).';"' : '') . '>' . esc_html($subtitle) . '</div>' : '';

			$title_css  = 'style="';
			$title_css .= $title_color ? 'color:'.esc_attr($title_color).'; ' : '';
			$title_css .= $title_size ? 'font-size:'.esc_attr($title_size).';' : '';
			$title_css .= '"';

			$heading .= $sub_position == 'above'  ? $sub : '';

			$heading .= $title ? '<h3 class="block-title '. esc_attr($title_style) .'" '. $title_css . '>' . esc_html($title) . '</h3>' : '';

			$heading .= $sub_position == 'bellow'  ? $sub : '';
			
			$heading .= '</div>';
			
			echo wp_kses_post($heading);
			
		}
		add_action('as_block_heading','as_block_heading_func', 10, 8);
		
		
		
	}// end if class_exists
	
	
}
//add_action('init','VC_AS_init');

/**
 *	VC ADMIN FUNCTIONS
 **/
function VC_AS_admin_init() {
	
	if( class_exists('Vc_Manager') ) {
	
		global $olea_woo_is_active;
		
		vc_set_as_theme();
		
		if( ! apply_filters( "olea_options", "vc_frontend", 0 ) ) {
			vc_disable_frontend();
		}
		
		
		as_vc_includes('shortcodes-mapping/as_ajax_cats_params.php');		// AJAXED CONTENT
		as_vc_includes('shortcodes-mapping/as_filter_cats_params.php');		// FILTERED CONTENT
		as_vc_includes('shortcodes-mapping/as_slick_slider_params.php'); 	// SLICK SLIDER
		as_vc_includes('shortcodes-mapping/as_menu_params.php'); 			// CUSTOM MENU
		as_vc_includes('shortcodes-mapping/as_banner_params.php'); 			// BANNER
		as_vc_includes('shortcodes-mapping/as_testimonials_params.php'); 	// TESTIMONIAL
		as_vc_includes('shortcodes-mapping/as_single_lookbook_params.php');	// LOOKBOOK
		as_vc_includes('shortcodes-mapping/as_gmap_params.php');			// GOOGLE MAP
		as_vc_includes('shortcodes-mapping/as_heading_params.php');			// HEADING
		as_vc_includes('shortcodes-mapping/as_contact_params.php');			// HEADING
		as_vc_includes('shortcodes-mapping/as_video_params.php');			// VIDEO PLAYER
		as_vc_includes('helpers/helpers.php');
		
		if( $olea_woo_is_active ) {
			as_vc_includes('shortcodes-mapping/as_ajax_prod_params.php');	// AJAXED PRODUCTS
			as_vc_includes('shortcodes-mapping/as_filter_prod_params.php');	// FILTERED PRODUCTS
			as_vc_includes('shortcodes-mapping/as_prod_cats_params.php');	// PRODUCT CATEGORIES
			as_vc_includes('shortcodes-mapping/as_single_prod_params.php');	// SINGLE PRODUCT
		}
		
		/**
		 *	GET TERMS ARRAY FOR SHORTCODES SETTINGS
		 *	as_vc_terms filter - term name and term slug switched with array_flip()
		 */
		
		function as_vc_terms_for_blocks_func( $taxonomy ) {
			
			if( ! taxonomy_exists( $taxonomy ) ) return;
			
			$as_terms_array = apply_filters('as_terms', $taxonomy );
			
			$as_vc_terms_array = isset($as_terms_array) ? array_flip($as_terms_array) : array();
			
			return $as_vc_terms_array;
				
		}
		add_filter('as_vc_terms','as_vc_terms_for_blocks_func', 10, 1);
		
		/**
		 *	GET MENUS ARRAY FOR SHORTCODES SETTINGS
		 *
		 */
		
		function as_vc_get_menus_func( $hide_empty = true ) {
		
			$menus = get_terms( 'nav_menu', array( 'hide_empty' =>  $hide_empty ) );
			$menu_array = array();
			$menu_array["== Pick a menu =="] = "no-menu"; 
			foreach( $menus as $menu ) {
				$menu_array[$menu->name] = $menu->slug ;
			}
			
			return $menu_array;
			
		}
		add_filter('as_vc_get_menus','as_vc_get_menus_func', 10);
		
		/**
		 *	Additional ROW settings
		 */
		
		$add_row_attributes = array(
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Parallax background image",'olea'),
				"param_name" => "parallax",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => __("check if you want to use parallax effect on background image",'olea'),
				//"edit_field_class"=> "vc_col-sm-6",
				'group' => __('Design Options','olea')
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Overlay color","olea"),
				"param_name" => "overlay_color",
				"value" => '',
				"description" => __("Choose color for overlay - between content and (paralax) background image","olea"),
				'group' => __('Design Options','olea')
			),			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('Overlay opacity','olea'),
				"param_name" => "overlay_opacity",
				"value" => '0.8',
				"description" => __('Default opacity for overlay - (change it, if you must)','olea'),
				"edit_field_class"=> "vc_col-sm-6",
				'group' => __('Design Options','olea')
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Full width content?",'olea'),
				"param_name" => "boxed",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => __("in case you're using \"Page builder template\" and want content block NOT to be boxed",'olea'),
				"edit_field_class"=> "vc_col-sm-3",
				'group' => __('Theme row settings','olea')
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Remove side gutter",'olea'),
				"param_name" => "no_side_gutt",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => __("remove horizontal spaces between elements inside row",'olea'),
				"edit_field_class"=> "vc_col-sm-3",
				'group' => __('Theme row settings','olea')
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Remove bottom gutter",'olea'),
				"param_name" => "no_bott_gutt",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => __("remove spaces bellow elements inside row",'olea'),
				"edit_field_class"=> "vc_col-sm-3",
				'group' => __('Theme row settings','olea')
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Equalize row elements",'olea'),
				"param_name" => "equalize",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => __("careful with this - an lead to undesired effects. Works only with theme blocks.",'olea'),
				"edit_field_class"=> "vc_col-sm-3",
				'group' => __('Theme row settings','olea')
			),
			/* ===== VIDEO TAB ===== */
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('YouTube video ID','olea'),
				"param_name" => "videourl",
				"value" => '',
				"description" => __('Enter ONLY video ID, not the whole address','olea'),
				"edit_field_class"=> "vc_col-sm-3",
				'group' => __('Theme row video settings','olea')
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __('Autoplay video','olea'),
				"param_name" => "autoplay",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-3",
				'group' => __('Theme row video settings','olea')
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __('Mute video','olea'),
				"param_name" => "mute",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-3",
				'group' => __('Theme row video settings','olea')
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __('Optimize display','olea'),
				"param_name" => "optimizedisplay",
				"value" =>array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-3",
				'group' => __('Theme row video settings','olea')
			),
			array(
				"type" => "separator",
				"class" => "",
				"heading" => "",
				"param_name" => "sep_video_1",
				"value" => '',
				"description" => "",
				"edit_field_class"=> "vc_col-sm-12",
				'group' => __('Theme row video settings','olea')
			),

			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __('Loop video','olea'),
				"param_name" => "loop",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-3",
				'group' => __('Theme row video settings','olea')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('Video sound volume','olea'),
				"param_name" => "volume",
				"value" => '50',
				"description" => __('Enter value between 0 - 100','olea'),
				"edit_field_class"=> "vc_col-sm-3",
				'group' => __('Theme row video settings','olea')
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __('Video quality','olea'),
				"param_name" => "quality",
				"value" => array(
						'Default'	=> 'default',
						'Small'		=> 'dmall',
						'Medium'	=> 'medium',
						'Large'		=> 'large',
						'hd720'		=> 'HD720',
						'hd1080'	=> 'HD1080',
						'High resolution'	=> 'highres'
					),
				"std" => "default",
				"description" =>"",
				"edit_field_class"=> "vc_col-sm-3",
				'group' => __('Theme row video settings','olea')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __('Video ratio','olea'),
				"param_name" => "ratio",
				"value" => array(
						'16/9'		=> '16/9',
						'4/3'		=> '4/3',
					),
				"std" => "16/9",
				"description" =>"",
				"edit_field_class"=> "vc_col-sm-3",
				'group' => __('Theme row video settings','olea')
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Embedded HTML 5 video","olea"),
				"param_name" => "sep_video_2",
				"value" => '',
				"description" => "",
				"edit_field_class"=> "vc_col-sm-12",
				'group' => __('Theme row video settings','olea')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('HTML 5 video','olea'),
				"param_name" => "htmlfivevideo",
				"value" => '',
				"description" => __('<strong>Self hosted video URL or URL to remote video files. </strong><br>
			Enter full path to video file name and exclude extension - the mp4, webm and ogg extension will be added automatically.<br>
			All required video file types OGV, WEBB and OGG files should be available (locally, self-hosted, or remote) for browser compatibility.','olea'),
				"edit_field_class"=> "vc_col-sm-3",
				'group' => __('Theme row video settings','olea')
			),

		);
		
		vc_add_params( 'vc_row', $add_row_attributes );
		
	}// end if class_exists
	
}
//add_action('after_setup_theme','VC_AS_admin_init');
?>