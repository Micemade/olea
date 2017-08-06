<?php
//
/**
 *	WOOCOMMERCE init check
 *
 */
$olea_woo_is_active = false;
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	$olea_woo_is_active = true; // using as global variable in theme for on/off woo functions and hooks

	if( defined('WOOCOMMERCE_VERSION') ) {
		$olea_wc_version = WOOCOMMERCE_VERSION ;
	}

	$run_once = new run_once;
	if ($run_once->run('init_woo_theme_values')){
		init_woo_theme_values();
	}

}// endif in_array ...
/**
 *  WC VERSION CONTROL
 *
 *  @param [string] $vers_to_check - WC version to check
 *  @return $version_is_higher
 *
 */
function olea_wc_version_f( $vers_to_check ) {
	global $olea_wc_version, $olea_woo_is_active;
	if( ! $olea_woo_is_active ) return;
	$version_is_higher = false;
	if ( version_compare( $olea_wc_version, $vers_to_check ) >= 0 ) {
		$version_is_higher = true;
	}
	return $version_is_higher;
}
add_filter( 'olea_wc_version','olea_wc_version_f', 10, 1 );
// add major "WC 3.0.0" update class
function olea_wc2_7( $classes ) {
	if( apply_filters( 'olea_wc_version', '3.0.0' ) ) {
		$classes[] = "WC2.7";
	}
	return $classes;
}
add_filter('body_class', 'olea_wc2_7' );
/**
 *	YITH WISHLIST plugin init check
 *
 */
$as_wishlist_is_active = false;
if ( in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || class_exists( 'YITH_WCWL' ) ) {

	$as_wishlist_is_active = true;

}


	function init_woo_theme_values() {
		//
		$shop_catalog_image_size = array(
			'width' => 300,
			'height' => 180,
			'crop' => 1
		);
		$shop_single_image_size = array(
			'width' => 300,
			'height' => 300,
			'crop' => 1
		);
		$shop_thumbnail_image_size = array(
			'width' => 80,
			'height' => 80,
			'crop' => 1
		);
		update_option('shop_catalog_image_size', $shop_catalog_image_size );
		update_option('shop_single_image_size', $shop_single_image_size );
		update_option('shop_thumbnail_image_size', $shop_thumbnail_image_size );
		//
		update_option( 'woocommerce_frontend_css','no' ); // IMPORTANT - theme's WOO template CSS instead of plugin's
		update_option( 'woocommerce_menu_logout_link','no' ); // remove "Logout" menu item
		update_option( 'woocommerce_prepend_shop_page_to_urls','yes' );
		update_option( 'woocommerce_prepend_shop_page_to_products','yes' );
		update_option( 'woocommerce_prepend_category_to_products','yes' );
		//

	};

if( $olea_woo_is_active ) {


	function wooc_init () {

		add_theme_support( 'woocommerce' );

		add_filter( 'woocommerce_enqueue_styles', '__return_false' );

	}
	add_action('init','wooc_init');

	if( is_admin() ) {
		function dequeue_select2() {
			wp_dequeue_style( 'select2' );
			wp_deregister_style( 'select2' );
		}

		add_action( 'admin_init', 'dequeue_select2' );
	}

	/**
	 *	NUMBER OF PRODUCTS ON PRODUCTS PAGE:
	 *
	 */
	add_filter('loop_shop_per_page', 'products_per_page' );
	if (!function_exists('products_per_page')) {
		function products_per_page () {

			$products_page_settings = apply_filters( "olea_options", "products_page_settings", array(
									"Products per page"	=> 12,
									"Products columns"	=> 4,
									"Related total"		=> 3,
									"Related columns"	=> 3
								) );
			$products_number =  $products_page_settings['Products per page'];
			return $products_number;
		}
	}
	/**
	 *	NUMBER OF COLUMNS IN PRODUCTS AND PROD. TAXNOMIES PAGE
	 *
	 */
	add_filter('loop_shop_columns', 'loop_columns');
	if (!function_exists('loop_columns')) {

		function loop_columns() {

			$products_page_settings = apply_filters( "olea_options", "products_page_settings", array(
									"Products per page"	=> 12,
									"Products columns"	=> 4,
									"Related total"		=> 3,
									"Related columns"	=> 3
								) );
			$columns =  $products_page_settings['Products columns'];

			return $columns;

		}
	}
	/**
	 *	NUMBERS FOR RELATED PRODUCTS
	 *
	 **/
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
	add_action( 'woocommerce_after_single_product_summary', 'as_output_related_products', 20);
	if ( ! function_exists( 'as_output_related_products' ) ) {
		function as_output_related_products() {

			$products_page_settings = apply_filters( "olea_options", "products_page_settings", array(
									"Products per page"	=> 12,
									"Products columns"	=> 4,
									"Related total"		=> 3,
									"Related columns"	=> 3
								) );

			$related_total =  $products_page_settings['Related total'];
			$related_columns =  $products_page_settings['Related columns'];

			$args = array(
				'posts_per_page' => $related_total,
				'columns' => $related_columns,
				'orderby' => 'rand'
			);
			woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );

		}
	}

	/**
	 *	NUMBERS FOR UPSELL PRODUCTS
	 *
	 **/
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_upsells', 15 );

	if ( ! function_exists( 'woocommerce_output_upsells' ) ) {
		function woocommerce_output_upsells() {

			$total	= apply_filters( "olea_options", "upsell_total", "3" );
			$in_row	= apply_filters( "olea_options", "upsell_in_row", "3" );

			woocommerce_upsell_display( $total, $in_row);
		}
	}


	//
	/**
	 *	AJAX UPDATER OF CART
	 *
	 */
	add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
	function woocommerce_header_add_to_cart_fragment( $fragments ) {

		ob_start();
		$cart_count		= WC()->cart->cart_contents_count;
		$cart_link		= get_permalink( wc_get_page_id( 'cart' ));
		$cart_action	= apply_filters( "olea_options", "cart_action", "popup" );
		$title			= __("Click to view the products added to cart","olea");

		echo ($cart_action == 'page') ? '<a href="'. esc_url($cart_link) .'" class="olea-head-cart" id="olea-head-cart" title="'. esc_attr($title) .'">' : '<div class="olea-head-cart mini-cart-toggle" id="olea-head-cart" title="'. esc_attr($title) .'">';
		?>

			<span class="icon-shopping63 mini-cart-icon" aria-hidden="true"></span>

			<span class="cart-contents">

				<?php echo '<span class="count">'. intval($cart_count).'</span>'; ?>

				<?php echo wp_kses_post( WC()->cart->get_cart_total()); ?>

			</span>

			<div class="clearfix"></div>

		<?php echo ($cart_action == 'page') ? '</a>' : '</div>';

		$fragments['.olea-head-cart'] = ob_get_clean();

		return $fragments;
	}



	/**
	 *	PRODUCTS CATALOG / PROD.ARCHIVE PAGE IMAGES (shop page):
	 *
	 */
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

	add_action( 'woocommerce_before_shop_loop_item_title', 'as_loop_product_thumbnail', 20 );
	//
	if ( ! function_exists( 'as_loop_product_thumbnail' ) ) {

		function as_loop_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {

			global $post, $product, $yith_wcwl;

			$products_settings = apply_filters( "olea_options", "products_settings", array(
									'disable_zoom_button' => 'Disable zoom button',
									'disable_link_button' => 'Disable link button'
								) );

			// get image format from theme options:
			$of_imgformat = apply_filters( "olea_options", "shop_image_format", "medium" );
			if( $of_imgformat == 'plugin' ){
				$img_format = 'shop_catalog';
			}else{
				$img_format = $of_imgformat;
			}


			// 3.0.0 < Fallback conditional
			if( apply_filters( 'olea_wc_version', '3.0.0' )	) {
				$attachment_ids   = $product->get_gallery_image_ids();
			}else{
				$attachment_ids   = $product->get_gallery_attachment_ids();
			}
			
			if ( !empty( $attachment_ids ) ) {
				$image_url	= wp_get_attachment_image_src( $attachment_ids[0], 'full' );
				$img_url	= $image_url[0];
			}

			$title = '<a href="' . get_permalink(). '" title="'. esc_attr( strip_tags($post->post_title) ) .'"><h3>'. get_the_title(). '</h3></a>';

			echo '<div class="front">';

			echo as_image( $img_format );

			function_exists('woocommerce_template_loop_rating') ? woocommerce_template_loop_rating() : '';

			echo '</div>';

			echo '<div class="back">';

				echo '<div class="item-overlay"></div>';

				if ( $attachment_ids ) {
					
					echo '<div class="entry-image">' . wp_get_attachment_image(  $attachment_ids[0], $img_format, false, array( "class" => "back-image" ) ) . '</div>';

				}else{
					
					echo as_image( $img_format );
				}

				echo '<div class="back-buttons">';

					if( !isset($products_settings['disable_zoom_button']) ) {
						echo '<a href="'. as_get_full_img_url().'" class="item-zoom" data-rel="prettyPhoto" title="'. the_title_attribute (array('echo' => 0)) .'"><div class="icon icon-zoom-in" aria-hidden="true"></div></a>';
					}
					if( !isset($products_settings['disable_link_button']) ) {
						echo '<a href="'. get_permalink() .'" title="'.the_title_attribute (array('echo' => 0)) .'"><div class="icon icon-link" aria-hidden="true"></div></a>';
					}

				echo '</div>';



			echo '</div>';

		}
	}
	/**
	 *	CHANGE WOOCOMMERCE PLACEHOLDER IMAGE
	 *
	 */
	remove_filter('woocommerce_placeholder_img_src','woocommerce_placeholder_img_src');
	add_filter('woocommerce_placeholder_img_src','as_placeholder_img_src');
	function as_placeholder_img_src () {
		return apply_filters( "olea_options", "placeholder_image", get_template_directory_uri().'/img/default/no-image.jpg' );
	}
	/**
	 *	REMOVE WOO TITLE from PRIMARY div to head (like blog single page title)
	 *
	 */
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	add_action( 'as_single_product_summary', 'woocommerce_template_single_title', 5 );
	//
	/**
	 *	DEQUEUE PRETTYPHOTO FROM WOOC. PLUGIN IN FAVOUR OF THEME'S PRETTYPHOTO
	 *
	 */

	function prettyPhoto_dequeue () {

		wp_dequeue_style('woocommerce_prettyPhoto_css');
		wp_deregister_style('woocommerce_prettyPhoto_css');

		wp_dequeue_script('prettyPhoto');
		wp_dequeue_script('prettyPhoto-init');

	}
	add_action( 'wp_enqueue_scripts','prettyPhoto_dequeue', 1000 );

	/**
	 * Changing order in single product
	 *
	 */
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );



	/**
	 *	Quick view images
	 *
	 */
	add_action( 'product_quick_view_images', 'quick_view_images', 25 );
	function quick_view_images() {

		global $post, $woocommerce, $product;

		// GET IMAGE FORMAT FROM THEME OPTIONS (same as for single product page) :
		$of_imgformat = apply_filters( "olea_options", "single_product_image_format", "as-portrait" );
		
		if( $of_imgformat == 'plugin'  ){
			$img_format = 'shop_single';
		}else{
			$img_format = $of_imgformat;
		}

		$attachment_ids = $product->get_gallery_attachment_ids();
		// 3.0.0 < Fallback conditional
		if( apply_filters( 'olea_wc_version', '3.0.0' )	) {
			$attachment_ids   = $product->get_gallery_image_ids();
		}else{
			$attachment_ids   = $product->get_gallery_attachment_ids();
		}

		echo '<div class="images'. ( !empty( $attachment_ids ) ? ' owl-carousel  productslides'  : '') .'">';

		// MAIN PRODUCT IMAGE - POST THUMBNAIL (FEATURED IMAGE ETC.)
		if ( has_post_thumbnail() ) {

			$post_thumb_id				= get_post_thumbnail_id();
			$default_product_image_src	= wp_get_attachment_image_src( $post_thumb_id, $img_format );
			$default_product_image_url  = $default_product_image_src[0];

			$image_link  		= wp_get_attachment_url( $post_thumb_id );
			$image_class 		= 'attachment-' . $post_thumb_id ;
			$image_title 		= strip_tags( get_the_title( $post_thumb_id ) ) ;
			$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', $img_format ), array(
				'title' => esc_attr( $image_title ),
				'alt'	=> esc_attr( $image_title ),
				'class'	=> esc_attr( $image_class. ' featured' )
				) );
			$full_image			= as_get_full_img_url();
			$product_title		= esc_attr( strip_tags(get_the_title()));
			$product_link		= esc_attr( get_permalink() );

			echo apply_filters( 'woocommerce_single_product_image_html',sprintf('<div class="item-img"><a href="%2$s" data-o_href="%2$s" data-zoom-image="%4$s" class="larger-image-link woocommerce-main-image zoom" itemprop="image" data-rel="prettyPhoto[pp_gal-'.$post->ID.']" title="%3$s">%1$s</a></div>',

				$image,						// %1$s
				$full_image,				// %2$s
				$product_title,				// %3$s
				$default_product_image_url	// %4$s

			),  $post->ID );

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ) );

		}


		// PRODUCT GALLERY IMAGES
		if ( !empty( $attachment_ids ) ) {

			$loop = 0;
			$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

			foreach ( $attachment_ids as $attachment_id ) {

				$classes = array( 'zoom' );

				if ( $loop == 0 || $loop % $columns == 0 )
					$classes[] = 'first';

				if ( ( $loop + 1 ) % $columns == 0 )
					$classes[] = 'last';

				$image_link = wp_get_attachment_url( $attachment_id );

				if ( ! $image_link )
					continue;
				$image_class	= esc_attr( implode( ' ', $classes ) );
				$image_title	= esc_attr( strip_tags(get_the_title()) );
				$image			= wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', $img_format ), array(
					'title' => $image_title
					));
				$attachment_src = wp_get_attachment_image_src( $attachment_id, 'large' );

				$full_image		= esc_url( $attachment_src[0] );
				$product_title	= esc_attr( strip_tags( get_the_title() ) );
				$product_link	= esc_attr( get_permalink() );

				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class="item-img"><a href="%5$s" data-rel="prettyPhoto[pp_gal-'.$post->ID.']" title="%6$s" class="wc-product-gallery zoom">%4$s</a></div>',
					$image_link,	// 1
					$image_class,	// 2
					$image_title,	// 3
					$image,			// 4
					$full_image,	// 5
					$product_title	// 6

				), $attachment_id, $post->ID, $image_class );

				$loop++;
			}

		}
		echo '</div>';//. images
	}



	/**
	 *	Single product display images
	 *
	 *	- used in as-single-product-block.php and content-single.product.php
	 */
	add_action( 'do_single_product_images', 'single_product_images', 25, 1 );
	function single_product_images( $img_format = 'shop_single') {

		global $post, $woocommerce, $product;


		// SINGLE PRODUCT IMAGE FORMAT:
		$of_img_format = apply_filters( "olea_options", "single_product_image_format", "as-portrait" );

		if( is_product()) { // if on single product page:

			if( $of_img_format == 'plugin' ) {
				$img_format = 'shop_single';
			}else{
				$img_format = $of_img_format;
			}

		}else{ // if not on single product (single block or quick view):

			$img_format = $img_format;
		}

		// images in product gallery:
		// 3.0.0 < Fallback conditional
		if( apply_filters( 'olea_wc_version', '3.0.0' )	) {
			$attachment_ids = $product->get_gallery_image_ids();
		}else{
			$attachment_ids = $product->get_gallery_attachment_ids();
		}

		echo '<div class="images">';

		echo ( $attachment_ids ? '<div class="owl-carousel singleslides">' : '' );

		// MAIN PRODUCT IMAGE - post thumbnail (featured image etc.)
		if ( has_post_thumbnail() ) {

			$post_thumb_id				= get_post_thumbnail_id();
			$default_product_image_src	= wp_get_attachment_image_src( $post_thumb_id, $img_format );
			$default_product_image_url  = $default_product_image_src[0];

			$image_link  		= wp_get_attachment_url( $post_thumb_id );
			$image_class 		= 'attachment-' . $post_thumb_id ;
			$image_title 		= strip_tags( get_the_title( $post_thumb_id ) ) ;
			$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', $img_format ), array(
				'title' => esc_attr( $image_title ),
				'alt'	=> esc_attr( $image_title ),
				'class'	=> esc_attr( $image_class. ' featured' )
				) );
			$full_image			= as_get_full_img_url();
			$product_title		= esc_attr( strip_tags(get_the_title()));
			$product_link		= esc_attr( get_permalink() );

			echo apply_filters( 'woocommerce_single_product_image_html',sprintf('<div class="item-img item"><div class="front">%1$s</div><div class="back"><div class="item-overlay"></div><div class="back-buttons" itemscope><a href="%2$s" data-o_href="%2$s" data-zoom-image="%4$s" class="larger-image-link woocommerce-main-image zoom" itemprop="image" data-rel="prettyPhoto[pp_gal-'.$post->ID.']" title="%3$s"><div class="icon icon-zoom-in" aria-hidden="true"></div></a></div></div></div>',

				$image,						// %1$s
				$full_image,				// %2$s
				$product_title,				// %3$s
				$default_product_image_url	// %4$s

			),  $post->ID );

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ) );

		}

		/**	Product gallery images */

		if ( $attachment_ids ) {

			$loop = 0;
			$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

			foreach ( $attachment_ids as $attachment_id ) {

				$classes = array( 'zoom' );

				if ( $loop == 0 || $loop % $columns == 0 )
					$classes[] = 'first';

				if ( ( $loop + 1 ) % $columns == 0 )
					$classes[] = 'last';

				$image_link = wp_get_attachment_url( $attachment_id );

				if ( ! $image_link )
					continue;
				$image_class	= esc_attr( implode( ' ', $classes ) );
				$image_title	= esc_attr( strip_tags(get_the_title()) );
				$image			= wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', $img_format ), array(
					'title' => $image_title
					));
				$attachment_src = wp_get_attachment_image_src( $attachment_id, 'large' );

				$full_image		= esc_url( $attachment_src[0] );
				$product_title	= esc_attr( strip_tags( get_the_title() ) );
				$product_link	= esc_attr( get_permalink() );

				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class="item-img item"><div class="front">%4$s</div><div class="back"><div class="item-overlay"></div><div class="back-buttons"><a href="%5$s" data-rel="prettyPhoto[pp_gal-'.$post->ID.']" title="%6$s" class="wc-product-gallery zoom"><div class="icon icon-zoom-in" aria-hidden="true"></div></a> %7$s </div></div></div>',
					$image_link,	// 1
					$image_class,	// 2
					$image_title,	// 3
					$image,			// 4
					$full_image,	// 5
					$product_title,	// 6
					is_product() ? null : '<a href="'.$product_link .'" title="%6$s"><div class="icon icon-link" aria-hidden="true"></div></a>'	// 7

				), $attachment_id, $post->ID, $image_class );

				$loop++;
			}

		}

		echo ( $attachment_ids ? '</div>'  : '' );//. owl-carousel
		
		echo '</div>';//. images
	}



	if ( ! function_exists( 'as_get_product_search_form' ) ) {

		/**
		 * Output Product search forms - AS edit.
		 *
		 * @access public
		 * @param bool $echo (default: true)
		 * @return void
		 */
		function as_get_product_search_form( $echo = true  ) {
			do_action( 'as_get_product_search_form'  );

			$search_form_template = locate_template( 'product-searchform.php' );
			if ( '' != $search_form_template  ) {
				require $search_form_template;
				return;
			}

			$placeholder = esc_attr__('Search for products', 'olea');

			$form = '<div class="searchform-menu"><form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">

					<input type="search" value="' . get_search_query() . '" name="s" id="s" placeholder="' . $placeholder . '" />
					<button type="submit" class="icon-search" id="searchsubmit"></button>
					<input type="hidden" name="post_type" value="product" />

			</form></div>';

			if ( $echo  )
				echo apply_filters( 'as_get_product_search_form', $form );
			else
				return apply_filters( 'as_get_product_search_form', $form );
		}
	}

	/**
     * AS YITH AJAX SEARCH
     *
     *
     * @return echo
     */
	if ( !function_exists('as_yith_ajax_search') ) {

		function as_yith_ajax_search() {

			if ( !defined( 'YITH_WCAS' ) ) { return; }
			wp_enqueue_script('yith_wcas_jquery-autocomplete' );

			?>

			<div class="yith-ajaxsearchform-container searchform-menu">
			<form role="search" method="get" id="yith-ajaxsearchform" action="<?php echo esc_url( home_url( '/'  ) ) ?>">
				<div>

					<?php
					$label		= get_option('yith_wcas_search_input_label');
					$placehold	= $label ? $label : esc_attr__('Search for products','olea');
					?>

					<input type="search"
					   value="<?php echo get_search_query() ?>"
					   name="s"
					   id="yith-s"
					   class="yith-s"
					   placeholder="<?php echo $placehold; ?>"
					   data-loader-icon="<?php echo get_template_directory_uri() . '/img/ajax-loader.gif'; ?>"
					   data-min-chars="<?php echo get_option('yith_wcas_min_chars'); ?>" />

					<button type="submit" class="icon-search"></button>

					<input type="hidden" name="post_type" value="product" />
					<?php if ( defined( 'ICL_LANGUAGE_CODE' ) ): ?>
						<input type="hidden" name="lang" value="<?php echo( ICL_LANGUAGE_CODE ); ?>" />
					<?php endif ?>
				</div>
			</form>
			</div>
			<script type="text/javascript">

			jQuery(document).ready(function ($) {
				"use strict";

				var el = $('.yith-s'),
					loader_icon = el.data('loader-icon') == '' ? '' : el.data('loader-icon'),
					search_button = $('#yith-searchsubmit'),
					min_chars = el.data('min-chars');

				search_button.on('click', function(){
					var form = $(this).closest('form');
					if( form.find('.yith-s').val()==''){
						return false;
					}
					return true;
				});

				if( el.length == 0 ) el = $('#yith-s');

				el.each(function () {
					var $t = $(this),
						append_to = ( typeof  $t.data('append-to') == 'undefined') ? $t.closest('.yith-ajaxsearchform-container') : $t.data('append-to');

					el.yithautocomplete({
						minChars        : min_chars,
						appendTo        : append_to,
						serviceUrl      : woocommerce_params.ajax_url + '?action=yith_ajax_search_products',
						onSearchStart   : function () {
							$(this).css('background', 'url(' + loader_icon + ') no-repeat right center');
						},
						onSelect        : function (suggestion) {
							if (suggestion.id != -1) {
								window.location.href = suggestion.url;
							}
						}  ,
						onSearchComplete: function () {
							$t.css('background', 'transparent');
						}
					});
				});
			});
			</script>
		<?php
		} // end function as_yith_ajax_search
	} // end if function_exists as_yith_ajax_search
	/**
	 *	SHOP META BOX handling
	 *
	 *	- removing shop meta box if current page is not registered in WooCommerce as shop base
	 *	always removing "catalog-pre" meta box, EXCEPT if:  current edited page id == shop base page id
	 *
	 *	admin hooks: load-"ADMIN-PAGE"
	 */
	add_action( 'load-post.php', 'only_shop_page_meta' );
	function only_shop_page_meta() {

		$shop_base_id	= wc_get_page_id('shop');

		if( isset($_GET['post']) && $_GET['post'] != $shop_base_id ) {

			remove_meta_box( 'catalog-page-meta-box', 'page', 'normal' );
		}

	}
	add_action( 'load-post-new.php', 'remove_shop_page_meta' );
	function remove_shop_page_meta() {

		remove_meta_box( 'catalog-page-meta-box', 'page', 'normal' );

	}


	/**
	 *	AS WISHLIST - extending and changing YITH WISHLIST plugin ( plugin must be installed and activated )
	 * - deprecated from YITH WCWL 2.0.0
	 */
	if( class_exists( 'YITH_WCWL_UI' ) ) {


		add_action('as_wishlist_button','as_wishlist_button_func', 10); 						// FOR PB BLOCKS, CATALOG etc.
		//add_action( 'woocommerce_single_product_summary', 'as_wishlist_button_func', 35 );	// FOR SINGLES
		function as_wishlist_button_func() {

			yith_wcwl_get_template( 'add-to-wishlist.php' );			

		}

		/* end AS WISHLIST */

		/*
		 *	REMOVE ANNONYMOUS YITH HOOKS
		 *
		 *	- remove single product yith wishlist button, which is created
		 *  with anonymous function
		 */

		add_action('remove_YITH_wishlist_hooks', 'remove_anonymous_YITH_hooks');
		function remove_anonymous_YITH_hooks() {

			remove_anonymous_function_filter(
				'woocommerce_single_product_summary',
				YITH_WCWL_DIR . 'class.yith-wcwl-init.php',
				31
			);
			remove_anonymous_function_filter(
				'woocommerce_product_thumbnails',
				YITH_WCWL_DIR . 'class.yith-wcwl-init.php',
				21
			);
			remove_anonymous_function_filter(
				'woocommerce_after_single_product_summary',
				YITH_WCWL_DIR . 'class.yith-wcwl-init.php',
				11
			);

		}

		function dequeue_yith_styles() {
			wp_dequeue_style( 'yith-wcwl-font-awesome');
			wp_dequeue_style( 'yith-wcwl-font-awesome-ie7' );
			//wp_dequeue_style( 'yith-wcwl-main' );
		}

		add_action( 'wp_enqueue_scripts', 'dequeue_yith_styles' );


	}
	/**
	 *	end YITH WISHLIST related functions
	 */

	/**
	 *	PRODUCT CUSTOM ATTRIBUTES - REGISTER TO MENUS and CREATE THEME FILES
	 *	- register taxonomy pa_"custom prod att." to nav menus
	 *	- create "taxonomy-$custom attribute.php" file
	 */

	// get taxonomies and filter out PRODUCT ATTRIBUTES ( PREFIX PA_)
	function fetch_prod_atts() {
		$get_tax_args = array(
			'public'   => true,
			'_builtin' => false
		);
		$output = 'names'; // or objects
		$operator = 'and'; // 'and' or 'or'
		$taxonomies = get_taxonomies( $get_tax_args, $output, $operator );
		$product_attributes = array();
		if ( $taxonomies ) {
			foreach ( $taxonomies  as $taxonomy ) {
				if( strpos($taxonomy,'pa_')!== false ){
					$product_attributes[] = $taxonomy;
				}
			}
		}
		return $product_attributes;
	}

	add_action('admin_init', 'create_atts_files',10);
	function create_atts_files() {

		WP_Filesystem();
		global $wp_filesystem;

		$product_attributes	= fetch_prod_atts();
		$theme_folder		= get_template_directory();
		$content			= '<?php if ( ! defined( "ABSPATH" ) ) exit; wc_get_template( "archive-product.php" );?>';

		foreach( $product_attributes as $prod_att ) {

			$file	= $theme_folder .  '/taxonomy-' . $prod_att .'.php';

			if( !file_exists($file) ) {

				if ( ! $wp_filesystem->put_contents( $file , $content , 0644 ) ) {
					return true;
				}

			}

		}

	}

	add_filter('woocommerce_attribute_show_in_nav_menus', 'wc_reg_for_menus', 1, 2);
	function wc_reg_for_menus( $register, $name = '' ) {
		//if ( $name == 'pa_color' )
		$register = true;
		return $register;
	}
	/**
	 * Woocommerce custom  Size chart tab
	 *
	 **/
	require_once get_template_directory() . '/woocommerce/single-product/tabs/custom-size-wootab.php'; // woocommerce custom tabs



	/**
	 * RE-ARRANGE SHOP (CATALOG PAGE) LOOP HEADER
	 * - first remove actions, the re-activate them with different priority
	 * - add grid/list view buttons
	 */

	function as_woo_grid_list() {

		?>

		<nav class="gridlist-toggle">
			<a href="#" id="grid" title="<?php _e('Grid view', 'olea') ?>" class="icon-grid"></a>
			<a href="#" id="list" title="<?php _e('List view', 'olea') ?>" class="icon-list"></a>
		</nav>

		<?php

	}
	// - REARRANGEMENTS:
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);  // WC 2.5.0 >
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_single_excerpt', 5);
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

	add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 20 );
	add_action('woocommerce_before_shop_loop','as_woo_grid_list', 25);
	add_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 30 );


	function as_shop_buttons() {

		global $as_wishlist_is_active;

		if( defined('WPML_ON') ) { // if WPML plugin is active
			$id			= icl_object_id( get_the_ID(), 'product', false, ICL_LANGUAGE_CODE );
			$lang_code	= ICL_LANGUAGE_CODE;
		}else{
			$id			= get_the_ID();
			$lang_code	= '';
		}

		$buttons = apply_filters( "olea_options", "catalog_buttons", array(
									'shop_quick'		=> 'Quick buy button',
									'shop_buy_action'	=> 'Add to cart / Select options',
									'shop_wishlist'		=> 'Wishlist'
								) );

		echo '<div class="table"><div class="tablerow">';

		if( $buttons['shop_quick'] ) {
			echo '<div class="item-buttons-holder tablecell">';
				echo '<a href="#qv-holder" class="quick-view tip-top"   title="'.__('Quick view','olea').' - '. the_title_attribute (array('echo' => 0)) .'" data-id="'.$id.'" data-lang="'. esc_attr($lang_code) .'" data-tooltip><span class="icon-eye"></span></a>'; // Quick view button
			echo '</div>'; // tablecell

			if ( !wp_script_is( 'wc-add-to-cart-variation', 'enqueued' )) {

				wp_register_script( 'wc-add-to-cart-variation', WP_PLUGIN_DIR . '/woocommerce/assets/frontend/add-to-cart-variation.min.js');
				wp_enqueue_script( 'wc-add-to-cart-variation' );

			}

		}

		if( $buttons['shop_buy_action'] ) {
			echo '<div class="item-buttons-holder tablecell">';
				do_action( 'woocommerce_after_shop_loop_item' ); // "Add to cart button
			echo '</div>'; // tablecell
		}

		if( $buttons['shop_wishlist'] && $as_wishlist_is_active ) {
			echo '<div class="item-buttons-holder tablecell">';
				do_action('as_wishlist_button'); // Wishlist button
			echo '</div>'; // tablecell
		}

		echo '</div></div>'; // .table.tablerow

	} // end shop_buttons()

	function as_shop_title_price(){


		$buttons = apply_filters( "olea_options", "catalog_buttons", array(
									'shop_quick'		=> 'Quick buy button',
									'shop_buy_action'	=> 'Add to cart / Select options',
									'shop_wishlist'		=> 'Wishlist'
								) );

		$no_buttons =( !$buttons['shop_quick'] && !$buttons['shop_buy_action'] && !$buttons['shop_wishlist'] ) ?  true : false;

		echo $no_buttons ? '<div class="no-buttons">' : null;


		echo '<h3 class="prod-title"><a href="'. esc_attr(get_permalink()).'" title="'. the_title_attribute (array('echo' => 0)).'"> '. esc_html(get_the_title()).' </a></h3>';

		woocommerce_template_loop_price();

		echo $no_buttons ? '</div>' : null;

	}

	/**
	 *	LIMIT FOR VARIATIONS BEFORE AJAX
	 */
	function as_wc_ajax_variation_threshold( $qty, $product ) {
		return 50;
	}
	add_filter( 'woocommerce_ajax_variation_threshold', 'as_wc_ajax_variation_threshold', 10, 2 );

	/**
	 *	REMOVE FIRST / LAST CLASSES IN PRODUCTS PAGE
	 */
	function remove_first_last( $classes ) {
		if( is_woocommerce() || is_product() || is_active_widget( false,false,'woocommerce_products' ) ) {
			$classes = array_diff( $classes, array('first') );
			$classes = array_diff( $classes, array('last') );

		}

		return $classes;

	}
	add_filter('post_class','remove_first_last',10);


} // end if $olea_woo_is_active
/**
 *
 *  END OF WOOCOMMECE
 */
//
?>
