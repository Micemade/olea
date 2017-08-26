<?php
/**
 * Add to wishlist button template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.0
 */

global $product ;
// 3.0.0 < Fallback conditional :
$product_id	= apply_filters( 'olea_wc_version', '3.0.0'  ) ? $product->get_id() : $product->id;

$icon 		= '<span class="icon-heart-outlined"></span>';
$classes	= 'add_to_wishlist tip-top';
$title_add	= __('Add to wishlist','olea');
$product_type = $product->get_type();
?>

<a href="<?php echo esc_url( add_query_arg( 'add_to_wishlist', $product_id ) ); ?>" data-product-id="<?php echo esc_attr($product_id); ?>" data-product-type="<?php echo esc_attr( $product_type ); ?>" class="<?php echo esc_attr($classes); ?>" title="<?php echo esc_attr($title_add); ?>" data-tooltip>
    <?php echo wp_kses_post($icon); ?> 
    <?php //echo wp_kses_post($label) ?>
</a>
<img src="<?php echo esc_url( get_template_directory_uri(). '/img/ajax-loader.gif' ); ?>" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />