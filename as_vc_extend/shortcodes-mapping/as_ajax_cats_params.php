<?php
add_action( 'vc_before_init', 'map_as_ajax_cats' );
function map_as_ajax_cats() {
	vc_map( array(
		"name" => __("Ajax load content","olea"),
		"base" => "as_ajax_cats",
		"class" => "",
		"weight"=> 1,
		'icon' =>'as_ajax_cats',
		"category" => __('Olea theme elements','olea'),
		//'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		//'admin_enqueue_css' => array(get_template_directory_uri().'/as_vc_extend/shotcodes/css/input.css'),
		"params" => array(
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Element title",'olea'),
				"param_name" => "title",
				"value" => "",
				"description" => "",
				"admin_label" => true,
				"group"	=> "Title and subtitle settings",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Element subtitle",'olea'),
				"param_name" => "subtitle",
				"value" => "",
				"description" => "",
				"group"	=> "Title and subtitle settings",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Element title style",'olea'),
				"param_name" => "title_style",
				"value" => array(
					'Center'		=> 'center',
					'Float left'	=> 'float_left',
					'Float right'	=> 'float_right'
					),
				"std" => "center",
				"description" => "",
				"group"	=> "Title and subtitle settings",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Element subtitle style",'olea'),
				"param_name" => "sub_position",
				"value" => array(
					'Bellow heading'	=> 'bellow',
					'Above heading'		=> 'above',
	
					),
				"std" => "bellow",
				"description" => "",
				"group"	=> "Title and subtitle settings",
				"edit_field_class"=> "vc_col-sm-6"
			),
			
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Title color","olea"),
				"param_name" => "title_color",
				"value" => '',
				"description" => "",
				"group"	=> "Title and subtitle settings",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Subtitle color","olea"),
				"param_name" => "subtitle_color",
				"value" => '#999',
				"description" => "",
				"group"	=> "Title and subtitle settings",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Remove heading decoration",'olea'),
				"param_name" => "no_decoration",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => __('heading decorations are defined globally in theme options','olea'),
				"edit_field_class"=> "vc_col-sm-6",
				"group"	=> "Title and subtitle settings",
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Title additional sizing",'olea'),
				"param_name" => "title_size",
				"value" => array(
					'Normal'	=> '262.5%',
					'Larger'	=> '325%',
					'Big'		=> '368.75%',
					'Smaller'	=> '237.5%',
					),
				"std" =>  '262.5%',
				"description" => "",
				"group"	=> "Title and subtitle settings",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Viewport enter animation",'olea'),
				"param_name" => "enter_anim",
				"value" => as_vc_animations_array('enter_animation'),
				"std" => "none",
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
				array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Block style",'olea'),
				"param_name" => "block_style",
				"value" => array(
					'Style 1 (general)'		=> 'style1',
					'Style 2 (blog posts)'	=> 'style2',
					'Style 3 (portfolio)'	=> 'style3'
					),
				"std" => "style1",
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
						
			array(
				"type" => "separator",
				"class" => "",
				"heading" => '',
				"param_name" => "sep_3",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),

			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Post types and categories",'olea'),
				"param_name" => "sep_3",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Post types",'olea'),
				"param_name" => "post_type",
				"value" => array(
					'Post'=> 'post',
					'Portfolio' => 'portfolio',
					'Product' => 'product'
					),
				"std" => "post",
				"description" => "",
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-4"
				
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Taxonomy menu style",'olea'),
				"param_name" => "tax_menu_style",
				"value" => array(
					'Inline menu'	=> 'inline',
					'Dropdown menu'	=> 'dropdown',
					'None'		=>'none' 
					),
				"std" => "inline",
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Taxonomy menu alignment",'olea'),
				"param_name" => "tax_menu_align",
				"value" => array(
					'Center'		=> 'center',
					'Align left'	=> 'align_left',
					'Align right'	=> 'align_right',
					),
				"std" => "center",
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => '',
				"param_name" => "sep_4",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Post categories",'olea'),
				"param_name" => "post_cats",
				"value" => apply_filters('as_vc_terms', 'category' ),
				"description" => __('select one or multiple, "Post types" must be set to "Post"','olea'),
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Portfolio  categories",'olea'),
				"param_name" => "portfolio_cats",
				"value" => apply_filters('as_vc_terms', 'portfolio_category' ),
				"description" => __('select one or multiple, "Post types" must be set to "Portfolio"','olea'),
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Product  categories",'olea'),
				"param_name" => "product_cats",
				"value" => apply_filters('as_vc_terms', 'product_cat' ),
				"description" => __('select one or multiple, "Post types" must be set to "Portfolio"','olea'),
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Image settings",'olea'),
				"param_name" => "sep_4",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Image format",'olea'),
				"param_name" => "img_format",
				"value" => array(
					'Thumbnail'		=> 'thumbnail',
					'Medium'		=> 'medium',
					'Olea portrait'	=> 'as-portrait',
					'Olea landscape'=> 'as-landscape',
					'Large'			=> 'large',
					'Full'			=> 'full'
					),
				"std" => "thumbnail",
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Custom image width",'olea'),
				"param_name" => "custom_image_width",
				"value" => '',
				"description" => 'set custom image width - must use height, too. This setting will override "Image format"',
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Custom image height",'olea'),
				"param_name" => "custom_image_height",
				"value" => '',
				"description" => 'set custom image height - must use width, too. This setting will override "Image format"',
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => '',
				"param_name" => "sep_6",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Total items",'olea'),
				"param_name" => "total_items",
				"value" => '12',
				"description" => __('If empty, all items will e showed.','olea'),
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Disable slider",'olea'),
				"param_name" => "hide_slider",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => '',
				"edit_field_class"=> "vc_col-sm-3"
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Slider navigation?",'olea'),
				"param_name" => "slider_navig",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => __('use prev / next arrows','olea'),
				"edit_field_class"=> "vc_col-sm-3"
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Slider pagination?",'olea'),
				"param_name" => "slider_pagin",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => __('pagination dots bellow the slider','olea'),
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Slider timing",'olea'),
				"param_name" => "slider_timing",
				"value" => '',
				"description" => __('If empty, no automatic sliding will happen.','olea'),
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Show only featured ?",'olea'),
				"param_name" => "only_featured",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => __('show only featured posts or portfolio items','olea'),
				"edit_field_class"=> "vc_col-sm-6",
			),
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Responsive slider settings",'olea'),
				"param_name" => "sep_6",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Items in desktop view",'olea'),
				"param_name" => "items_desktop",
				"value" => "3",
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Items in tablet view",'olea'),
				"param_name" => "items_tablet",
				"value" => "2",
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Items in mobile view",'olea'),
				"param_name" => "items_mobile",
				"value" => "1",
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => '',
				"param_name" => "sep_8",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Hide zoom button?",'olea'),
				"param_name" => "zoom_button",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => __('display button for zooming image','olea'),
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Hide link button ?",'olea'),
				"param_name" => "link_button",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => __('display button with link to post/portfolio item','olea'),
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Animations settings for items",'olea'),
				"param_name" => "sep_6",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Hover image animation",'olea'),
				"param_name" => "anim",
				"value" => as_vc_animations_array('hover_animation'),
				"std" => "anim-0",
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Post text animation",'olea'),
				"param_name" => "data_anim",
				"value" => as_vc_animations_array('info_animation'),
				"std" => "anim-0",
				"description" => __("APPLICABLE ONLY FOR BLOCK STYLE 3",'olea'),
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Additional settings",'olea'),
				"param_name" => "sep_7",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('Button label','olea'),
				"param_name" => "button_label",
				"value" => '',
				"description" => __("If this setting is empty, and link is set, link will apply to whole banner.","olea"),
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "vc_link",
				"class" => "",
				"heading" => __("Add link",'olea'),
				"param_name" => "ac_link_button", //ap_ prefix as "Ajax content"
				"value" => "",
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Outlined button ?",'olea'),
				"param_name" => "outlined",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => __("Convert button to outlined button without background.","olea"),
				"edit_field_class"=> "vc_col-sm-6"
			),

			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('Additional CSS classes','olea'),
				"param_name" => "css_classes",
				"value" => '',
				"description" => __('Adds a wrapper div with additional css classes for more styling control','olea'),
				"edit_field_class"=> "vc_col-sm-12"
			)

		) // end params array
		) // end array vc_map()
	); // end vc_map()
}
?>