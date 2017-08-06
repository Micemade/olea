<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( $order ) : ?>

	<?php if ( $order->has_status( 'failed' ) ) : ?>

		<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'olea' ); ?></p>

		<p><?php
			if ( is_user_logged_in() )
				_e( 'Please attempt your purchase again or go to your account page.', 'olea' );
			else
				_e( 'Please attempt your purchase again.', 'olea' );
		?></p>

		<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'olea' ) ?></a>
			<?php if ( is_user_logged_in() ) : ?>
			<a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>" class="button pay"><?php _e( 'My Account', 'olea' ); ?></a>
			<?php endif; ?>
		</p>

	<?php else : ?>

		<h3 class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php _e( 'Thank you. Your order has been received.', 'olea' ); ?></h3>

		<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">
			<li class="woocommerce-order-overview__order order">
				<?php _e( 'Order Number:', 'olea' ); ?>
				<strong><?php echo esc_html($order->get_order_number()); ?></strong>
			</li>
			<li class="woocommerce-order-overview__date date">
				<?php _e( 'Date:', 'olea' ); ?>
				<strong><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></strong>
			</li>
			<li class="woocommerce-order-overview__total total">
				<?php _e( 'Total:', 'olea' ); ?>
				<strong><?php echo wp_kses_post($order->get_formatted_order_total()); ?></strong>
			</li>
			<?php if ( $order->payment_method_title ) : ?>
			<li class="woocommerce-order-overview__payment-method method">
				<?php _e( 'Payment Method:', 'olea' ); ?>
				<strong><?php echo esc_html($order->payment_method_title); ?></strong>
			</li>
			<?php endif; ?>
		</ul>
		<div class="clear"></div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
	<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

<?php else : ?>

	<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php _e( 'Thank you. Your order has been received.', 'olea' ); ?></p>

<?php endif; ?>