<?php
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function as_meta_boxes( array $meta_boxes ) {
	
	global $olea_woo_is_active;
	
	$prefix = 'as_';
	
	// general settings meta boxes:
	$general_fields = array(
		
		array(
			'name'	=> __('Hide featured image','olea'),
			'desc'	=> 'in archives, taxonomy page and single pages header).',
			'id'	=> $prefix.'hide_featured_image',
			'type'  => 'checkbox',
		),
		array(
			'name'	=> __('Hide post title in archives','olea'),
			'desc'	=> 'useful when using Image or Quote post formats ',
			'id'	=> $prefix.'hide_archive_titles',
			'type'	=> 'checkbox',
		),
		array(
			'name'	=> __('Hide page title','olea'),
			'desc'  => __('applies only to pages not singular posts','olea'),
			'id'    => $prefix.'hide_title',
			'type'  => 'checkbox',
		),
		array(
			'name'	=> __('Page under header','olea'),
			'desc'  => __('page content "under" page header','olea'),
			'id'    => $prefix.'page_under_head',
			'type'  => 'checkbox',
		),
		array(
			'name'	=> __('Hide pages navigation','olea'),
			'desc'  => __('hide prev/next page navigation','olea'),
			'id'    => $prefix.'hide_single_nav',
			'type'  => 'checkbox',
		),
	);
	
	$meta_boxes[] = array(
		'title'		=> 'General settings',
		'pages'		=> array('post','page'),
		'fields'	=> $general_fields,
		'context'	=> 'side',
		'priority'	=> 'high'
	);
	
	// CUSTOM HEADER STYLING:
	
	$custom_header_css = array(
		array(
			'name'		=> __('Header background color','olea'),
			'desc'		=> '',
			'id' 		=> $prefix.'head_back_color',
			'type'		=> 'colorpicker',
			'cols'		=> 3
		),
		array(
			'name'		=> __('Header background opacity','olea'),
			'id'		=> $prefix.'head_back_opacity',
			'default'	=> '0.8',
			'type'		=> 'text_small',
			'cols'		=> 3
		),
		array(
			'name'		=> __('Header fonts color','olea'),
			'desc'  	=> '',
			'id' 		=> $prefix.'head_fonts_color',
			'type'		=> 'colorpicker',
			'cols'		=> 3
		),
		array(
			'name'		=> __('Header links color','olea'),
			'desc'  	=> '',
			'id' 		=> $prefix.'head_links_color',
			'type'		=> 'colorpicker',
			'cols'		=> 3
		),
		array(
			'name'		=> __('Header border lines color','olea'),
			'desc'  	=> '',
			'id' 		=> $prefix.'head_border_color',
			'type'		=> 'colorpicker',
			'cols'		=> 3
		),
		array(
			'name'		=> __('Header border lines opacity','olea'),
			'id'		=> $prefix.'head_border_opacity',
			'default'	=> '0.8',
			'type'		=> 'text_small',
			'cols'		=> 3
		),
		array(
			'name'		=> __('Header (title) image opacity','olea'),
			'id'		=> $prefix.'head_image_opacity',
			'default'	=> '',
			'type'		=> 'text_small',
			'cols'		=> 3
		),
		array(
			'name'		=> __('Page title color','olea'),
			'desc'  	=> '',
			'id' 		=> $prefix.'page_title_color',
			'type'		=> 'colorpicker',
			'cols'		=> 3
		),
	);
	
	
	
	$meta_boxes[] = array( 
		'title'		=> 'Header custom style', 
		'fields'	=> $custom_header_css,
		'pages'		=> array('page','post','portfolio'),
		'context'	=> 'normal',
		'priority'	=> 'high' 
	);
	
	
	
	
	// POST FORMAT MENU
	// add post format tabs menu first:
	$meta_boxes[] = array( 
		'title'		=> 'Post format tabs', 
		'fields'	=> array(),
		'pages'		=> array('page','post','portfolio'),
		'context'	=> 'normal',
		'priority'	=> 'high' 
	);
	
	// POST FORMAT meta boxes - gallery:
	$format_gallery_fields = array(
		
		array(
			'name'			=> __('Upload images','olea'), 
			'id'			=> $prefix.'gallery_images',
			'type'			=> 'image',
			'repeatable'	=> true,
			'sortable'		=> true,
			'show_size' 	=> true 
		),
		array(
			'name'		=> __('Gallery image format','olea'),
			'desc'		=> __('choose the format for image display in gallery.','olea'),
			'id'		=> $prefix.'gall_image_format',
			'type'		=> 'select',
			'options'	=> array(
				
				'thumbnail'		=> __('Thumbnail','olea'),
				'medium'		=> __('Medium','olea'),
				'as-portrait'	=> __('Olea portrait','olea'),
				'as-landscape'	=> __('Olea landscape','olea'),
				'large'			=> __('Large','olea')
			),
			'default'		=> 'as-portrait',
			'cols'			=> 4

		),
		array(
			'name'		=> __('Slider of images or thumbnails ?','olea'),
			'id'		=> $prefix . 'slider_thumbs',
			'type'		=> 'radio',
			'options'	=> array(			
				'slider'		=> 'Slider',
				'thumbnails'	=> 'Thumbnails', 
			),
			'default'	=> 'slider',
			'cols'		=> 4
		),

		array(
			'name'		=> __('Thumbnails columns (if there are more then one attached image)','olea'),
			'desc'		=> __('type in the number of thumbnails in a row. If left empty, the default number of <strong>3</strong> will be set','olea'),
			'id'		=> $prefix . 'thumb_columns',
			'type'		=> 'text_small',
			'default'	=> '3',
			'cols'		=> 4
		),
		
		array(
			'name'		=> __('Slider navigation','olea'),
			'desc'		=> __('add previous/next arrows (appear on hover)','olea'),
			'id'		=> $prefix . 'slider_nav',
			'type'		=> 'checkbox',
			'cols'		=> 3
		),
		
		array(
			'name'		=> __('Slider pagination','olea'),
			'desc'		=> __('add previous/next arrows (appear on hover)','olea'),
			'id'		=> $prefix . 'slider_pagin',
			'type'		=> 'checkbox',
			'cols'		=> 3
		),
		array(
			'name'		=> __('Slider timing','olea'),
			'desc'		=> __('interval between slide transitions ( in milliseconds )','olea'),
			'id'		=> $prefix . 'slider_timer',
			'type'		=> 'text_small',
			'default'	=> '5000',
			'cols'		=> 3
		),
		array(
			'name'		=> __('Slider transition effect','olea'),
			'desc'		=> __('choose the slider transition effect','olea'),
			'id'		=> $prefix . 'slider_trans',
			'type'		=> 'select',
			'options'	=> array(
				'none'		=> 'None',
				'fade'		=> 'Fade',
				'backSlide'	=> 'Back Slide',
				'goDown'	=> 'Go Down',
				'fadeUp'	=> 'Fade Up'
			),
			'cols'		=> 3,
			'allow_none'=> false, 
			'sortable'	=> false, 
			'repeatable'=> false
		),
		array(
			'name'		=> __('Slider items in desktop','olea'),
			'desc'		=> __('items displayed in slider in desktop view','olea'),
			'id'		=> $prefix . 'items_desktop',
			'type'		=> 'text_small',
			'default'	=> '4',
			'cols'		=> 3
		),
		
		array(
			'name'		=> __('Slider items in smaller desktop','olea'),
			'desc'		=> __('items displayed in slider in smaller desktop view','olea'),
			'id'		=> $prefix . 'items_desktop_s',
			'type'		=> 'text_small',
			'default'	=> '3',
			'cols'		=> 3
		),
		array(
			'name'		=> __('Slider items in tablet','olea'),
			'desc'		=> __('items displayed in slider in tablet view','olea'),
			'id'		=> $prefix . 'items_tablet',
			'type'		=> 'text_small',
			'default'	=> '2',
			'cols'		=> 3
		),
		array(
			'name'		=> __('Slider items in mobile','olea'),
			'desc'		=> __('items displayed in slider in mobile view','olea'),
			'id'		=> $prefix . 'items_mobile',
			'type'		=> 'text_small',
			'default'	=> '1',
			'cols'		=> 3
		),
		
	);
	
	$meta_boxes[] = array(
		'title'		=> 'Gallery settings',
		'pages'		=> array('post','portfolio'),
		'fields'	=> $format_gallery_fields,
		'context'	=> 'normal',
		'priority'	=> 'high'
	);
	
	
	
	// POST FORMAT meta boxes - AUDIO:
	$format_audio_fields = array(
		array( // Text Input
			'name'		=> __('Audio file','olea'), 
			'id'		=> $prefix.'audio_file',
			'type'		=> 'file',
			'file_type' => 'audio',
			'desc'	=> 'upload the audio file',
		),
	);
	
	$meta_boxes[] = array(
		'title'		=> 'Audio settings',
		'pages'		=> array('post','portfolio'),
		'fields'	=> $format_audio_fields,
		'context'	=> 'normal',
		'priority'	=> 'high'
	);
	
	// POST FORMAT meta boxes - VIDEO:
	$format_video_fields = array(
		array(
			'name'		=> __('Video host site','olea'),
			'desc'		=> __('choose the video host service site to fetch the video from (YouTube, Vimeo etc...)','olea'),
			'id'		=> $prefix.'video_host',
			'type'		=> 'select',
			'options'	=> array(
				'youtube'		=> 'YouTube',
				'screenr'		=> 'Screenr',
				'vimeo'			=> 'Vimeo',
				'dailymotion'	=> 'DailyMotion',
				'yahoo'			=> 'Yahoo',
				'bliptv'		=> 'BlipTV',
				'veoh'			=> 'Veoh',
				'viddler'		=> 'Viddler',
			),
			'cols' => 6,
			'default'     => 'youtube',
		),
		array(
			'name'		=> __('Video ID','olea'),
			'desc'		=> __('enter the video ID number or code, NOT the whole address','olea'),
			'id'		=> $prefix.'video_id',
			'type'		=> 'text',
			'cols' => 6,
			'default'    => '',
		 ),
		 array(
			'name'		=> __('Width of the video','olea'),
			'desc'		=> __('enter the width in PERCENTAGE - DO NOT ADD UNIT, JUST NUMBER','olea'),
			'id'		=> $prefix.'video_width',
			'type'		=> 'text',
			'cols' => 6,
			'default'	=> '100',
		 ),
		array(
			'name'		=> __('Height of the video','olea'),
			'desc'		=> __('enter the height - allowed units: px, em, %','olea'),
			'id'		=> $prefix.'video_height',
			'type'		=> 'text',
			'cols' => 6,
			'default'	 => '350px',
		),
		array(
			'name'		=> __('Featured image or video thumbnails','olea'),
			'desc'		=> __('show post featured image or fetch thumbnail of video from video host service.<br /><strong>NOTE: some services do not provide high resolution image so it is advisable to use featured image. Supported: YouTube, Screenr, Vimeo, Daily Motion and BlipTV</strong>','olea'),
			'id'		=> $prefix.'video_thumb',
			'type'		=> 'select',
			'options'	=> array(
				'featured'		=> __('Featured image','olea'),
				'host_thumb'	=> __('Video host thumbnail','olea')
			),
			'cols' => 12,
			'default'	=> 'three',
		),
	);
	$meta_boxes[] = array(
		'title'		=> 'Video settings',
		'pages'		=> array('post','portfolio'),
		'fields'	=> $format_video_fields,
		'context'	=> 'normal',
		'priority'	=> 'high'
	);
	
	
	// POST FORMAT meta boxes - QUOTE:
	$format_quote_fields = array(
		array(
			'name'	=> __('Quote author','olea'), 
			'desc'	=> __('enter the name and/or title of quote author.','olea'),
			'id'	=> $prefix.'quote_author',
			'type'	=> 'text',
		),

		array(
			'name'	=> __('Quote author URL','olea'), 
			'desc'	=> __('Enter full URL including http:// .','olea'),
			'id'	=> $prefix.'quote_author_url',
			'type'	=> 'url',
		),

		array(
			'name'	=> __('Avatar email for avatar image','olea'), 
			'desc'	=> __('If quote author uses gravatar.com quote author avatar can be displayed. If set, it will override the featured image.','olea'),
			'id'	=> $prefix.'avatar_email',
			'type'	=> 'text',
		),
	);
	$meta_boxes[] = array(
		'title'		=> 'Quote settings',
		'pages'		=> array('post'),
		'fields'	=> $format_quote_fields,
		'context'	=> 'normal',
		'priority'	=> 'high'
	);
	
	
	// POST FORMAT meta boxes - IMAGE:
	$format_image_fields = array(
		array( 
			'name'		=> __('NOTE:','olea'), 
			'desc'		=> '',
			'id'		=> $prefix.'image',
			'type'		=> 'text',
			'readonly'	=> true,
			'default'	=> __('simply select featured image for this post','olea'),
		)
	);
	$meta_boxes[] = array(
		'title'		=> 'Image settings',
		'pages'		=> array('post','portfolio'),
		'fields'	=> $format_image_fields,
		'context'	=> 'normal',
		'priority'	=> 'high'
	);
	
	
	/**
	 *	PORTFOLIO META BOXES
	 *
	 */
	
	$portfolio_fields = array(
		array(
			'name'		=> __('Tagline or slogan','olea'), 
			'desc'		=> __('optional tagline text.','olea'),
			'id'		=> $prefix.'tagline',
			'type'		=> 'text',
		),
		array(
			'name'		=> __('Layout mode','olea'),
			'desc'		=> '',
			'id'		=> $prefix.'single_layout',
			'type'		=> 'select',
			'options'	=> array(
				'float_left'	=> 'Float left',
				'float_right'	=> 'Float right',
				'centered'		=> 'Centered'
			),
			'cols' => 4,
			'default'     => 'float_left',
		),
		array(
			'name'		=> __('Featured image format','olea'),
			'desc'		=> '',
			'id'		=> $prefix.'feat_port_image_format',
			'type'		=> 'select',
			'options'	=> array(
				'thumbnail'		=> 'Thumbnail',
				'medium'		=> 'Medium',
				'as-portrait'	=> 'Olea portrait',
				'as-landscape'	=> 'Olea landscape',
				'large'			=> 'Large'
			),
			'cols' => 4,
			'default'     => 'thumbnail',
		),
		array(
			'name'		=> __('Number of related items','olea'), 
			'desc'		=> '',
			'id'		=> $prefix.'related_portfolios',
			'type'		=> 'text',
			'cols'		=> 4,
			'default'	=> 3
		),
		array(
			'name'		=> __('Button URL','olea'), 
			'desc'		=> __('If no url or no button label (next input field), no button will be displayed.','olea'),
			'id'		=> $prefix.'button_url',
			'type'		=> 'text',
			'cols'		=> 6,
			'default'	=> ''
		),	
		array(
			'name'		=> __('Button label','olea'), 
			'desc'		=> __('If no label or no button url (previous input field), no button will be displayed.','olea'),
			'id'		=> $prefix.'button_label',
			'type'		=> 'text',
			'cols'		=> 6,
			'default'	=> ''
		),
		array(
			'name'		=> 'Additional content',
			'desc'		=> __('Add some more info about your project','olea'),
			'id'		=>  $prefix.'additional_port', 
			'type'		=> 'wysiwyg',
			'options'	=> array( 'editor_height' => '100' )

		),
	);
	$meta_boxes[] = array(
		'title'		=> 'Portfolio item settings',
		'pages'		=> array('portfolio'),
		'fields'	=> $portfolio_fields,
		'context'	=> 'normal',
		'priority'	=> 'default'
	);

	
	/**
	 *	SHOP META BOXES
	 *	- if WooCommerce plugin is active these will show
	 */
	if( $olea_woo_is_active ) {
	
		$single_product_fields = array( 
			array ( 
				'id'		=> $prefix.'before_catalog',
				'name'		=> 'Before product catalog',
				'desc'		=> 'Display additional content on catalog page, BEFORE products catalog.',
				'type'		=> 'wysiwyg',
				'options'	=> array( 
									'editor_height'	=> '100' 
								)
			),
			array ( 
				'id'		=> $prefix.'after_catalog',
				'name'		=> 'After product catalog',
				'desc'		=> 'Display additional content on catalog page, AFTER products catalog.',
				'type'		=> 'wysiwyg',
				'options'	=> array( 
									'editor_height'	=> '100' 
								)
			),
			
		);				
		
		$meta_boxes[] = array(
			'title'		=> 'Catalog page meta box',
			'id'		=> 'catalog-page-meta-box',
			'pages'		=> array('page'),
			'fields'	=> $single_product_fields,
			'context'	=> 'normal',
			'priority'	=> 'low'
		);
	}
	
	/**
	 *	CUSTOM HEADER IMAGE:
	 *
	 */
	$custom_header_image_fields = array(
		
		array( 
			'id'			=> $prefix.'custom_head_image', 
			'name'			=> __('Custom header background image','olea'),
			'desc'			=> __('Replace default featured product background image header with custom image ','olea'),
			'type' 			=> 'image',
			'repeatable'	=> false,
			'show_size'		=> true 
		),
		array( 
			'id'			=> $prefix.'custom_head_image_format',
			'name'			=> __('Background image format','olea'),
			'type'			=> 'select',
			'options'		=> array(
					'thumbnail'		=> 'Thumbnail',
					'medium'		=> 'Medium',
					'as-portrait'	=> 'Olea portrait',
					'as-landscape'	=> 'Olea landscape',
					'large'			=> 'Large',
					'full'			=> 'Full'
				),
			'cols'			=> 6,
			'allow_none'	=> false,
			'sortable'		=> false,
			'repeatable'	=> false
		),
		array( 
			'id'			=> $prefix.'custom_head_image_repeat',
			'name'			=> __('Background image repeat','olea'),
			'type'			=> 'select',
			'options'		=> array(
					'repeat'	=> 'Repeat',
					'no-repeat'	=> 'No repeat',
					'repeat-x'	=> 'Repeat X',
					'repeat-y'	=> 'Repeat Y'
				),
			'cols'			=> 6,
			'allow_none'	=> true,
			'sortable'		=> false,
			'repeatable'	=> false
		),
		array( 
			'id'			=> $prefix.'custom_head_image_size',
			'name'			=> __('Background image size','olea'),
			'type'			=> 'select',
			'options'		=> array(
					'inherit'	=> 'Inherit',
					'50%'		=> '50%',
					'100% 100%'	=> '100%',
					'cover'		=> 'Cover',
					'contain'	=> 'Contain'
				),
			'cols'			=> 6,
			'allow_none'	=> false,
			'sortable'		=> false,
			'repeatable'	=> false
		),
		
		
		
	);
	$chmf_pages = $olea_woo_is_active ? array('post','product','portfolio') : array('post','portfolio');
	$meta_boxes[] = array(
		'title'		=> 'Custom header image',
		'id'		=> 'custom-header-image',
		'pages'		=> $chmf_pages,
		'fields'	=> $custom_header_image_fields,
		'context'	=> 'side',
		'priority'	=> 'low'
	);
	
	/**
	 *	LOOKBOOK PAGE TEMPLATE META BOXES
	 *
	 */
	
	if( post_type_exists( 'lookbook' ) ) {
	
		
		// LOOKBOOK PAGE TEMPLATE
		$lookbook_page_fields = array( 

			array(
				'id'		=> $prefix.'lookbook_cats',
				'name'		=> __('Lookbook categories','olea'),
				'desc'		=> __('Pick the lookbook categories of lookbook items.','olea'),
				'type'		=> 'taxonomy_select', 
				'taxonomy'	=> 'lookbook_category',
				'multiple'	=> true ,
				'cols' => 6,
			),
			array(
				'id'		=> $prefix.'lookbook_items',
				'name'		=> __('Number of lookbook items','olea'), 
				'desc'		=> __('Total items in lookbook page','olea'),
				'type'		=> 'text',
				'cols'		=> 3,
				'default'	=> 9
			),
			/* 
			array(
				'id'		=> $prefix.'lookbook_items_inrow',
				'name'		=> __('Number items in row','olea'), 
				'desc'		=> __('How many items per row','olea'),
				'type'		=> 'text',
				'cols'		=> 3,
				'default'	=> 2
			),
			 */
			array( 
				'id'			=> $prefix.'lookbook_items_inrow',
				'name'			=> __('Number items in row','olea'),
				'desc'		=> __('How many items per row','olea'),
				'type'			=> 'select',
				'options'		=> array(
						'1'		=> '1',
						'2'		=> '2',
						'3'		=> '3',
						'4'		=> '4',
						'6'		=> '6'
					),
				'default'		=> 2,
				'cols'			=> 3,
				'allow_none'	=> false,
				'sortable'		=> false,
				'repeatable'	=> false
			),
			
			array( 
				'id'			=> $prefix.'lookbook_image_format',
				'name'			=> __('Main lookbook image format','olea'),
				'type'			=> 'select',
				'options'		=> array(
						'thumbnail'		=> 'Thumbnail',
						'medium'		=> 'Medium',
						'as-portrait'	=> 'Olea portrait',
						'as-landscape'	=> 'Olea landscape',
						'large'			=> 'Large',
						'full'			=> 'Full'
					),
				'cols'			=> 6,
				'allow_none'	=> false,
				'sortable'		=> false,
				'repeatable'	=> false
			),
		);		
				
		$meta_boxes[] = array(
			'title'		=> __('Lookbook page settings','olea'),
			'id'		=> 'lookbook-page-settings',
			'pages'		=> array('page'),
			'fields'	=> $lookbook_page_fields,
			'context'	=> 'normal',
			'priority'	=> 'low'
		);
		

	
	}
	
	// FINALLY - OUTPUT META BOXES:
	return $meta_boxes;

}
add_filter( 'as_meta_boxes', 'as_meta_boxes' );
//
//
//
/**
 *	HIDE DEFAULT META BOXES
 *
 */
// initial default hiding of meta boxes - can be overridden by "Screen options" :
add_filter('default_hidden_meta_boxes', 'hide_meta_lock', 10, 2);
function hide_meta_lock( $hidden, $screen ) {
	
	$hidden = array();
	if ( 'post' == $screen->base ) {
		$hidden = array('postexcerpt','slugdiv','postcustom','trackbacksdiv', 'commentstatusdiv', 'commentsdiv', 'authordiv', 'revisionsdiv');
	}
	return $hidden;
}
// force hiding meta boxes - indepenent on "Screen options" :
$hidden_metaboxes = apply_filters( "olea_options", "hidden_metaboxes", 1 );
if( $hidden_metaboxes ) {
	add_filter( 'hidden_meta_boxes', 'custom_hidden_meta_boxes' );
	function custom_hidden_meta_boxes( $hidden ) {
		$hidden[] = 'postexcerpt';
		return $hidden;
	}
}
?>