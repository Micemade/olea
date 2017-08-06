<?php
add_action( 'vc_before_init', 'map_as_single_prod' );
function map_as_single_prod() {
	vc_map( array(
		"name" => __("Single product","olea"),
		"base" => "as_single_prod",
		"class" => "",
		"weight"=> 1,
		'icon' =>'as_single_prod',
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
				"admin_label" => true,
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
				"heading" => __("Select product",'olea'),
				"param_name" => "single_product",
				"value" => get_products_array(),
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-12"
			),
			
						
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Product image and gallery slider settings","olea"),
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
				"param_name" => "slider_navig",
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
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Display options","olea"),
				"param_name" => "sep_4",
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
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Background color opacity",'olea'),
				"param_name" => "opacity",
				"value" => '',
				"description" => '',
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Product details options",'olea'),
				"param_name" => "product_options",
				"value" => array(
					'Reduced product options'	=> 'reduced',
					'Full product options'		=> 'full'
					),
				"std" => 'reduced',
				"description" => "",
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Hide product short description ?",'olea'),
				"param_name" => "hide_short_desc",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-3"
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
function get_products_array() {
	
	$args = array(
		'post_type'			=> 'product',
		'posts_per_page'	=> -1,
		'suppress_filters'	=> true
	);
	$products_arr = array();  
	$products_obj = get_posts($args);
	if ( $products_obj ) {
		foreach( $products_obj as $prod ) {
			
			$products_arr[$prod->ID] = $prod->post_title  ;
		}
	}else{
		$products_arr[0] = '';
	}
	
	$products_arr = array_flip($products_arr); 
	
	return $products_arr; 
	
}


?>