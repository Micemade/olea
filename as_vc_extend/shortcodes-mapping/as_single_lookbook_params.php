<?php
add_action( 'vc_before_init', 'map_as_single_lookbook' );
function map_as_single_lookbook() {
	vc_map( array(
		"name" => __("Single lookbook","olea"),
		"base" => "as_single_lookbook",
		"class" => "",
		"weight"=> 1,
		'icon' =>'as_single_lookbook',
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
				"heading" => __("Block style",'olea'),
				"param_name" => "block_style",
				"value" => array(
					'Image right'	=> 'images_right',
					'Image left'	=> 'images_left',
					'Centered'		=> 'centered',
					'Centered Alt'	=> 'centered_alt',
					),
				"std" => 'images_right',
				"description" => "",
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
				"type" => "separator",
				"class" => "",
				"heading" => '',
				"param_name" => "sep_3",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Select lookbook item",'olea'),
				"param_name" => "single_lookbook",
				"value" => get_lookbook_array(),
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-12"
			),
			
						
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Lookbook item image settings","olea"),
				"param_name" => "sep_3",
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
				"std" => 'thumbnail',
				"description" => "",
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Background settings",'olea'),
				"param_name" => "sep_7",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),			
			
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Background color","olea"),
				"param_name" => "back_color",
				"value" => '',
				"description" => __("Choose background color","olea"),
				"edit_field_class"=> "vc_col-sm-6"
			),

			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Background color opacity",'olea'),
				"param_name" => "opacity",
				"value" => '',
				"description" => '',
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "separator",
				"class" => "",
				"heading" => "",
				"param_name" => "sep_8",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "textarea_html",
				"class" => "",
				"heading" => __("Lookbook additional content","olea"),
				"param_name" => "content",
				"value" => "",
				"description" => ""
			),

			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Additional settings",'olea'),
				"param_name" => "sep_9",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
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
function get_lookbook_array() {
	
	$args = array(
		'post_type'			=> 'lookbook',
		'posts_per_page'	=> -1,
		'suppress_filters'	=> true
	);
	$lookbooks_arr = array();  
	$lookbooks_obj = get_posts($args);
	if ( $lookbooks_obj ) {
		foreach( $lookbooks_obj as $lbook ) {
			
			$lookbooks_arr[$lbook->ID] = $lbook->post_title  ;
		}
	}else{
		$lookbooks_arr[0] = '';
	}
	
	$lookbooks_arr = array_flip($lookbooks_arr); 
	
	return $lookbooks_arr; 
	
}


?>