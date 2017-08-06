<?php
add_action( 'vc_before_init', 'map_as_banner' );
function map_as_banner() {
	vc_map( array(
		"name" => __("Banner","olea"),
		"base" => "as_banner",
		"class" => "",
		"weight"=> 1,
		'icon' =>'as_banner',
		"category" => __('Olea theme elements','olea'),
		//'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		//'admin_enqueue_css' => array(get_template_directory_uri().'/as_vc_extend/shotcodes/css/input.css'),
		"params" => array(
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Banner text settings","olea"),
				"param_name" => "sep_3",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Banner title",'olea'),
				"param_name" => "title",
				"value" => "",
				"description" => "",
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-12"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Title size",'olea'),
				"param_name" => "title_size",
				"value" => array(
					'Normal'		=> 'normal',
					'Medium'		=> 'medium',
					'Large'			=> 'large',
					'Extra large'	=> 'extra_large',
					),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Banner subtitle",'olea'),
				"param_name" => "subtitle",
				"value" => "",
				"description" => "",
				"admin_label" => true,
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "textarea",
				"class" => "",
				"heading" => __("Banner text",'olea'),
				"param_name" => "text",
				"value" => "",
				"description" => "",
				"edit_field_class"=> "vc_col-sm-12"
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Banner text color","olea"),
				"param_name" => "text_color",
				"value" => '',
				"description" => __("Choose text color","olea"),
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Text float",'olea'),
				"param_name" => "text_align",
				"value" => array(
					'Center'	=> 'center',
					'Left'		=> 'left',
					'Right'		=> 'right'
					),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Disable invert colors on hover effect",'olea'),
				"param_name" => "disable_invert",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Theme background image settings",'olea'),
				"param_name" => "sep_1",
				"value" => '',
				"desc" => __("these settings override CSS editor (in Layout and styles settings). Main reason for that here you can choose registered image size (good for loading time etc.)","olea"),
				"edit_field_class"=> "vc_col-sm-12"
			),
			array(
				"type" => "attach_image",
				"class" => "",
				"heading" => __("Banner backimage",'olea'),
				"param_name" => "attach_id",
				"value" => "",
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
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
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
			
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Background size",'olea'),
				"param_name" => "back_size",
				"value" => array(
						''			=> '',
						'50%'		=> '50%',
						'100% 100%'	=> '100%',
						'Cover'		=> 'cover',
						'Contain'	=> 'contain'
					),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Background position",'olea'),
				"param_name" => "back_position",
				"value" => "",
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => "",
				"param_name" => "sep_3_0",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Block opacity",'olea'),
				"param_name" => "block_opacity",
				"value" => "",
				"description" => __("If zero or empty, it will be ignored","olea"),
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("BLOCK overlay color",'olea'),
				"param_name" => "block_overlay",
				"value" => '',
				"description" => __("Choose overlay color for all block (text block has it's separate color controls )","olea"),
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Text padding",'olea'),
				"param_name" => "text_padding",
				"value" => "",
				"description" => __("If zero or empty, it will be ignored","olea"),
				"edit_field_class"=> "vc_col-sm-3"
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("TEXT overlay color",'olea'),
				"param_name" => "overlay",
				"value" => '',
				"description" => __("Choose overlay color","olea"),
				"edit_field_class"=> "vc_col-sm-3"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Overlay opacity",'olea'),
				"param_name" => "overlay_opacity",
				"value" => "",
				"description" => __("If zero or empty, it will be ignored","olea"),
				"edit_field_class"=> "vc_col-sm-3"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Text border style",'olea'),
				"param_name" => "border",
				"value" => array(
					'None'		=> 'none',
					'Solid'		=> 'solid',
					'Dashed'	=> 'dashed',
					'Dotted'	=> 'dotted',
					'Double'	=> 'double'
					),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-3"
			),
			
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Layout and styles settings",'olea'),
				"param_name" => "sep_1_1",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			array(
				'type' => 'css_editor',
				'heading' => __( 'Css', 'olea' ),
				'param_name' => 'css',
				//'group' => __( 'Design Options', 'olea' ),
			),
			
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Animation settings","olea"),
				"param_name" => "sep_2",
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
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Animation delay",'olea'),
				"param_name" => "anim_delay",
				"value" => "",
				"description" => __("Type the value for delay of block animation delay. Use the miliseconds ( 1second = 1000 miliseconds; example: 100 for 1/10th of second )","olea"),
				"edit_field_class"=> "vc_col-sm-6"
			),
			
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => __("Button settings","olea"),
				"param_name" => "sep_3",
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
				"param_name" => "link_button",
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
			
			/* 
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('Button link','olea'),
				"param_name" => "link",
				"value" => '',
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Open in new tab/window",'olea'),
				"param_name" => "target",
				"value" => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
			 */
			
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => "",
				"param_name" => "sep_4",
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
?>