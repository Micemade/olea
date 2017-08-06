<?php
/**
 *	The template part used for displaying WooCommerce MiniCart.
 *
 *	@since olea 1.0
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

echo '<div class="wrap-mini-cart">';

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

echo '<div class="mini-cart-list"><span class="arrow-up"></span><div class="widget_shopping_cart_content">';
	
	wc_get_template_part('mini','cart');
	
echo '</div></div>'; //end mini cart

echo '</div>'; // end wrap-mini-cart

?>