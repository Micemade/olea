<?php
add_action( 'vc_before_init', 'map_as_heading' );
function map_as_heading() {
	vc_map( array(
		"name" => __("Heading","olea"),
		"base" => "as_heading",
		"class" => "",
		"weight"=> 1,
		'icon' =>'as_heading',
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
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Element subtitle",'olea'),
				"param_name" => "subtitle",
				"value" => "",
				"description" => "",
				
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
				"std"	=> 'center',
				"description" => "",
				
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
				"edit_field_class"=> "vc_col-sm-6"
			),
			
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Title color","olea"),
				"param_name" => "title_color",
				"value" => '',
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Subtitle color","olea"),
				"param_name" => "subtitle_color",
				"value" => '#999',
				"description" => "",
				
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Background color","olea"),
				"param_name" => "bck_color",
				"value" => '',
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Remove heading decoration",'olea'),
				"param_name" => "no_decoration",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => __('heading decorations are defined globally in theme options','olea'),
				"edit_field_class"=> "vc_col-sm-6",
				
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
					'Bigger'	=> '462.5%',
					'Really Big'=> '556.25%',
					'Smaller'	=> '237.5%',
					'Even smaller'=> '206.25%',					
					),
				"std"	=> '262.5%',
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Heading tag",'olea'),
				"param_name" => "tag",
				"value" => array(
					''		=> '',
					'h1'	=> 'h1',
					'h2'	=> 'h2',
					'h3'	=> 'h3',
					'h4'	=> 'h4',
					'h5'	=> 'h5',
					'h6'	=> 'h6',
					),
				"description" => __("Use wisely - heading tag affects the semantic structure and SEO.","olea"),
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => '',
				"param_name" => "sep_1",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Viewport enter animation",'olea'),
				"param_name" => "enter_anim",
				"value" => as_vc_animations_array('enter_animation'),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6",
				
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Animation delay ( in milliseconds )",'olea'),
				"param_name" => "anim_delay",
				"value" => '500',
				"description" => __("Type the value for delay of block animation delay. Use the miliseconds ( 1second = 1000 miliseconds; example: 100 for 1/10th of second )","olea"),
				"edit_field_class"=> "vc_col-sm-6",
				
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Absolute heading positioning","olea"),
				"param_name" => "sep_2",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Position heading to absolute ?",'olea'),
				"param_name" => "abs_heading",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => __('absolute heading is related to first relative parent','olea'),
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-3",
				
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Top position",'olea'),
				"param_name" => "abs_top",
				"value" => "",
				"description" => __("enter value AND unit (px, em, rem or %)","olea"),
				"edit_field_class"=> "vc_col-sm-3",
				
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Left position",'olea'),
				"param_name" => "abs_left",
				"value" => '11.5%',
				"description" => __("enter value AND unit (px, em, rem or %)","olea"),
				"edit_field_class"=> "vc_col-sm-3",	
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Right position",'olea'),
				"param_name" => "abs_right",
				"value" => '11.5%',
				"description" => __("enter value AND unit (px, em, rem or %)","olea"),
				"edit_field_class"=> "vc_col-sm-3",	
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => "",
				"param_name" => "sep_3",
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
				"edit_field_class"=> "vc_col-sm-12",
				
			)
			
			
		) // end params array
		) // end array vc_map()
	); // end vc_map()
}
?>