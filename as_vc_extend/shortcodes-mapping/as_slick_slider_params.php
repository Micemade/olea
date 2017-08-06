<?php
add_action( 'vc_before_init', 'map_as_slick_slider' );
function map_as_slick_slider() {
	
	// IF WOOCOMMERCE IS ACTIVATED: 
	$is_product_tax	= taxonomy_exists( 'product_cat' );
	$is_port_tax	= taxonomy_exists( 'portfolio_category' );
	
	if( $is_product_tax ){
	
		$prod_cats_array = array(
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Product categories",'olea'),
				"param_name" => "product_cats",
				"value" => apply_filters('as_vc_terms', 'product_cat' ),
				"description" => __('select one or multiple, "Post types" must be set to "Products"','olea'),
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-4"
				//"weight" => 1
			)
		);
	}else{
		$prod_cats_array = array();
	}
	
	if( $is_port_tax ){
	
		$portfolio_cats_array = array(
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Portfolio categories",'olea'),
				"param_name" => "portfolio_cats",
				"value" => apply_filters('as_vc_terms', 'portfolio_category' ),
				"description" => __('select one or multiple, "Post types" must be set to "Portfolio categories"','olea'),
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-4"
				//"weight" => 2 
			)
		);
	
	}else{
		$portfolio_cats_array = array();
	}
	
	$main_array = array(

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
				"type" => "separator",
				"class" => "",
				"heading" => __("Post type and categories",'olea'),
				"param_name" => "sep_1",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Post type",'olea'),
				"param_name" => "post_type",
				"value" => array(
					'Post'		=> 'post',
					'Portfolio'	=> 'portfolio',
					'Product'	=> 'product'
					),
				"post" => "",
				"description" => "",
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-12"
			),
		);
			
		$main_array_2 = array(
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Blog post categories",'olea'),
				"param_name" => "post_cats",
				"value" => apply_filters('as_vc_terms', 'category' ),
				"description" => __('select one or multiple, "Post types" must be set to "Post"','olea'),
				"edit_field_class"=> "vc_col-sm-4"
				//"weight" => 100 
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Image settings and filtering",'olea'),
				"param_name" => "sep_2",
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
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Special filters",'olea'),
				"param_name" => "filters",
				"value" => array(
					'Latest'		=> 'latest',
					'Featured'		=> 'featured',
					'Random'		=> 'random',
					'Best selling (only WC products)'	=> 'best_sellers',
					'Best rated (only WC products)'	=> 'best_rated'
					),
				"std" => "latest",
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Total items",'olea'),
				"param_name" => "total_items",
				"value" => '8',
				"description" => __("how many items will scroll in slick scroller ?","olea"),
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Style and effects settings",'olea'),
				"param_name" => "sep_3",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Background color for text",'olea'),
				"param_name" => "overlay",
				"value" => '',
				"description" => __("Choose background color for item text (title, excerpt)","olea"),
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Links color",'olea'),
				"param_name" => "links_color",
				"value" => '',
				"description" => __("Choose color for item links","olea"),
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Text color",'olea'),
				"param_name" => "text_color",
				"value" => '',
				"description" => __("Choose color for item text","olea"),
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => "",
				"param_name" => "sep_3_1",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Use KenBurns effect ?",'olea'),
				"param_name" => "kenburns",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => __("KenBurns effect is slowly zooming and panning image","olea"),
				"edit_field_class"=> "vc_col-sm-6"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Use text layer animation ?",'olea'),
				"param_name" => "text_layer_anim",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
			
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Slider settings",'olea'),
				"param_name" => "sep_4",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Show navigation arrows ?",'olea'),
				"param_name" => "slider_navig",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => '',
				"edit_field_class"=> "vc_col-sm-3"
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Show navigation dots ?",'olea'),
				"param_name" => "slider_pagin",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => '',
				"edit_field_class"=> "vc_col-sm-3"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Slider timing",'olea'),
				"param_name" => "slider_auto",
				"value" => '',
				"description" => __('type in the timing for auto sliding items. If left blank no auto sliding will occur.','olea'),
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Fade images",'olea'),
				"param_name" => "fade_images",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => __("Use fading images instead of sliding","olea"),
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Thumbnails format",'olea'),
				"param_name" => "thumbs_format",
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
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Hide thumbnails navigation ?",'olea'),
				"param_name" => "hide_thumbs",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => '',
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Additional CSS classes",'olea'),
				"param_name" => "css_classes",
				"value" => '',
				"description" => __("add your custom css classes","olea"),
				"edit_field_class"=> "vc_col-sm-12"
			)
		);
	
	$params_array = array_merge( $main_array, $prod_cats_array, $portfolio_cats_array ,$main_array_2 );
	
	vc_map( array(
		"name" => __("Slick slider","olea"),
		"base" => "as_slick_slider",
		"class" => "",
		"weight"=> 1,
		'icon' =>'as_slick_slider',
		"category" => __('Olea theme elements','olea'),
		//'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		//'admin_enqueue_css' => array(get_template_directory_uri().'/as_vc_extend/shotcodes/css/input.css'),
		"params" => $params_array // end params array
		) // end array vc_map()
	); // end vc_map()
	
}
?>