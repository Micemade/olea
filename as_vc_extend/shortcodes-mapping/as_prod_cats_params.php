<?php
add_action( 'vc_before_init', 'map_as_prod_cats' );
function map_as_prod_cats() {
	vc_map( array(
		"name" => __("Product categories","olea"),
		"base" => "as_prod_cats",
		"class" => "",
		"weight"=> 1,
		'icon' =>'as_prod_cats',
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
				"std" => "none",
				"value" => as_vc_animations_array('enter_animation'),
				"description" => ""
			),

			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Product categories",'olea'),
				"param_name" => "product_cats",
				"value" => apply_filters('as_vc_terms', 'product_cat' ),
				"description" => __('select one or multiple product categories','olea'),
				"admin_label" => true,
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Categories menu",'olea'),
				"param_name" => "prod_cat_menu",
				"value" => array(
					'With category images'		=> 'images',
					'Without category images'	=> 'no_images',
					),
				"std" => "images",
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Menu columns",'olea'),
				"param_name" => "menu_columns",
				"value" => array(
					'1'			=> '1',
					'2'			=> '2',
					'3'			=> '3',
					'4'			=> '4',
					'6'			=> '6',
					'Auto stretch'	=> 'stretch',
					'Auto float'	=> 'auto',
					),
				"std" => "3",
				"description" => __("applies only if categories menu is \"With images\"", 'olea'),
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Categories menu alignment",'olea'),
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
				"type" => "textfield",
				"class" => "",
				"heading" => __("Image width",'olea'),
				"param_name" => "img_width",
				"value" => '300',
				"description" => 'set custom image width - must use height, too. This setting will override "Image format"',
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Image height",'olea'),
				"param_name" => "img_height",
				"value" => '180',
				"description" => 'set custom image height - must use width, too. This setting will override "Image format"',
				"edit_field_class"=> "vc_col-sm-6"
			),

			
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Text over category image color",'olea'),
				"param_name" => "text_color",
				"value" => '',
				"description" => __("Choose text color",'olea'),
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Category image overlay color",'olea'),
				"param_name" => "overlay_color",
				"value" => '',
				"description" => __("Choose text color",'olea'),
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