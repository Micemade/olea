<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $woocommerce, $product;

// Theme options:
$single_product_images			= apply_filters( "olea_options", "single_product_images", "slider" );
$single_product_image_format	= apply_filters( "olea_options", "single_product_image_format", "as-portrait" );

$magnifier = false;
if( $single_product_images == 'magnifier' ) {
	$magnifier = true;
};

if( $single_product_image_format == 'plugin' ) {
	$img_format = 'shop_single';
}else{
	$img_format = $single_product_image_format;
}

?>
<div class="images item">


	<?php
		if ( has_post_thumbnail() ) {

			$post_thumb_id		= get_post_thumbnail_id();
			$props				= wc_get_product_attachment_props( $post_thumb_id, $post );

			// Default (featured) image
			$default_product_image_src	= wp_get_attachment_image_src( $post_thumb_id, $img_format );
			$default_product_image_url  = $default_product_image_src[0];

			$image_class 		= esc_attr( 'attachment-' . $post_thumb_id ).' featured';
			$full_image			= as_get_full_img_url();
			$product_title		= the_title_attribute(array('echo' => 0));
			$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', $img_format ), array(
				'title'	=> $props['title'],
				'alt'	=> $props['alt'],
				'class'	=> $image_class,
				'id'	=> 'prod-image-'.$post->ID
			) );


			// 3.0.0 < Fallback conditional
			if( apply_filters( 'olea_wc_version', '3.0.0' )	) {
				$attachment_count   = count( $product->get_gallery_image_ids() );
			}else{
				$attachment_count   = count( $product->get_gallery_attachment_ids() );
			}
			if ( $attachment_count > 0 ) {
				$gallery = '[pp_gal-'.$post->ID.']';
			} else {
				$gallery = '';
			}


			if( !$magnifier ) {

				echo apply_filters( 'woocommerce_single_product_image_html',sprintf('<div class="anim-wrap"><div class="item-img"><div class="front">%1$s</div><div class="back"><div class="item-overlay"></div><div class="back-buttons"><a href="%2$s" data-o_href="%2$s" data-zoom-image="%4$s" class="larger-image-link woocommerce-main-image zoom" itemprop="image" title="%3$s" rel="prettyPhoto' . $gallery . '"><span class="icon icon-zoom-in" aria-hidden="true"></span></a></div></div></div></div>',

					$image,						// %1$s
					$full_image,				// %2$s
					$product_title,				// %3$s
					$default_product_image_url	// %4$s
				), $post->ID );

			}else{


				echo apply_filters( 'woocommerce_single_product_image_html',sprintf(

				'<div class="item-img">'.
					'<a href="%2$s" data-o_href="%2$s"  data-zoom-image="%4$s" class="larger-image-link woocommerce-main-image zoom"  itemprop="image" title="%3$s" data-rel="prettyPhoto">'.
						'<div class="front">%1$s</div>'.
					'</a>'.
				'</div>'
				,

					$image,						// %1$s
					$full_image,				// %2$s
					$product_title,				// %3$s
					$default_product_image_url	// %4$s
				), $post->ID );

				echo '
				<style>.zoomContainer {z-index: 10;}</style>

				<script type="text/javascript">
				(function($) {
				"use strict";
					$(document).ready(function() {

						$("#prod-image-'.$post->ID .'").elevateZoom({
							gallery				: "gallery-'.$post->ID.'",
							zoomType			: "window",
							cursor				: "pointer",
							galleryActiveClass	: "active",
							imageCrossfade		: true,
							loadingIcon			: "'. get_template_directory_uri() .'/img/ajax-loader.gif",
							zoomWindowPosition	: "magnifier-container",
							zoomWindowWidth		: 300,
							zoomWindowHeight	: 300,
							zoomWindowFadeIn	: 500,
							zoomWindowFadeOut	: 500,
							lensFadeIn			: 500,
							lensFadeOut			: 500,
							responsive			: true,
							scrollZoom			: true,
							constrainType		:"width",
							borderSize			: 1,
							borderColour		: "#999"

						});

					}); // end doc ready

				})(jQuery);
				</script>
				';

			}

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ) );

		}
	?>

	<div id="magnifier-container"></div>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>