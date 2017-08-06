<?php
add_action( 'vc_before_init', 'map_as_testimonials' );
function map_as_testimonials() {
	vc_map( array(
		"name" => __("Testimonials","olea"),
		"base" => "as_testimonials",
		"class" => "",
		"weight"=> 1,
		'icon' =>'as_testimonials',
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
				"description" => ""
			),
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => "",
				"param_name" => "sep_5",
				"value" => '',
				"description" => __("For each testimonial item, add image, add testimonial text and testimonial auhor name, separated by new line","olea"),
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
                "type" => "attach_images",
                "heading" => __("Testimonial author images", "olea"),
                "param_name" => "images",
                "value" => "",
                "description" => __("Select images from media library.", "olea"),
				"edit_field_class"=> "vc_col-sm-8"
             ),
			 array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Image style",'olea'),
				"param_name" => "image_style",
				"value" => array(
					'Round' => 'round',
					'Square'=> 'square',
				),
				"std"	=> "round",
				"description" => "",
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "exploded_textarea",
				"heading" => __("Testimonial author name", 'olea'),
				"param_name" => "authors",
				"value" => __("Annette Begin,Humphrey Bogota,David Letterson", 'olea'),
				"description" => __("Use new line (press Enter) for each author", 'olea'),
				"admin_label" => true,
			),
			array(
				"type" => "textarea_html",
				"heading" => __("Testimonial text", "olea"),
				"param_name" => "content",
				"value" => "Testimonial text one - this is the best place to input your testimonial. Don't use any other.\n\nTestimonial text two - this is the best place to input your testimonial. Don't use any other.\n\nTestimonial text three - this is the best place to input your testimonial. Don't use any other.",
				"description" => __("Use new line (press Enter) for each testimonial text", "olea")
			),
			
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Testimonial text color","olea"),
				"param_name" => "text_color",
				"value" => '',
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Testimonial author color","olea"),
				"param_name" => "author_color",
				"value" => '#999',
				"description" => "",
				"edit_field_class"=> "vc_col-sm-6"
			),
			
			
			array(
				"type" => "separator",
				"class" => "",
				"heading" => "",
				"param_name" => "sep_6",
				"value" => '',
				"edit_field_class"=> "vc_col-sm-12"
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Hide slider navigation?",'olea'),
				"param_name" => "slider_navig",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => __('use prev / next arrows','olea'),
				"edit_field_class"=> "vc_col-sm-4"
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Hide slider pagination?",'olea'),
				"param_name" => "slider_pagin",
				"value" => array( __( 'Yes, please', 'olea' ) => 'yes' ),
				"description" => __('pagination dots bellow the slider','olea'),
				"edit_field_class"=> "vc_col-sm-4"
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Slider timing",'olea'),
				"param_name" => "slider_timing",
				"value" => '5000',
				"description" => __('If empty, no automatic sliding will happen.','olea'),
				"edit_field_class"=> "vc_col-sm-4"
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