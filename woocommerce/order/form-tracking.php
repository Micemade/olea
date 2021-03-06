<?php
/**
 * Order tracking form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post;
?>

<form action="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" method="post" class="track_order">

	<div class="panel callout"><?php _e( 'To track your order please enter your Order ID in the box below and press return. This was given to you on your receipt and in the confirmation email you should have received.', 'olea' ); ?></div>

	<p class="form-row form-row-first"><label for="orderid"><?php _e( 'Order ID', 'olea' ); ?></label> <input class="input-text" type="text" name="orderid" id="orderid" placeholder="<?php _e( 'Found in your order confirmation email.', 'olea' ); ?>" /></p>
	<p class="form-row form-row-last"><label for="order_email"><?php _e( 'Billing Email', 'olea' ); ?></label> <input class="input-text" type="text" name="order_email" id="order_email" placeholder="<?php _e( 'Email you used during checkout.', 'olea' ); ?>" /></p>
	<div class="clear"></div>

	<div><input type="submit" class="button tiny" name="track" value="<?php _e( 'Track', 'olea' ); ?>" /></div>
	<?php wp_nonce_field( 'woocommerce-order_tracking' ); ?>

</form>