<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce_loop, $wp_query;

$enter_anim		= apply_filters( "olea_options", "prod_enter_anim", "fadeIn" );

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) 
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', loop_columns() ); // loop_columns() - AS theme function

// Ensure visibility
if ( ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

$classes = array();
// Extra post classes

if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
 
// OLEA THEME EDITS:
// get total products:
$total = $wp_query->found_posts;
// for responsive grid:
if( $woocommerce_loop['columns'] % 2 == 0 ){ // more then 1 item and even
	$oe = '6';
}else{		// more then 1 item and odd
	$oe = '4';
};
//
// olea theme edit: set grid by columns number
$classes[] = 'large-' . floor( 12 / $woocommerce_loop['columns'] ) ;
$classes[] = 'item medium-'.$oe. ' small-12 column';
$classes[] = ($enter_anim != 'none') ? ' to-anim' : '';
// Remove opening and closing link tags
remove_action( 'woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open' );  // WC 2.5.0 >
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);  // WC 2.5.0 >
?>
<li <?php post_class( $classes ); ?> data-i="<?php echo esc_attr($woocommerce_loop['loop']); ?>">
	
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
		
	<?php
	$products_settings = apply_filters( "olea_options", "products_settings", array() ); 
	$zoom_button = !isset($products_settings['disable_zoom_button']) ? true : false;
	$link_button = !isset($products_settings['disable_link_button']) ? true : false;
	?>
	
	<div class="anim-wrap clearfix">
		
		<?php function_exists('woocommerce_show_product_loop_sale_flash') ? woocommerce_show_product_loop_sale_flash() : ''; ?>
		
		<?php
		echo (!$zoom_button && !$link_button) ? '<a href="'. esc_url(get_permalink()).'" title="'. the_title_attribute (array('echo' => 0)) .'">' : '';
		?> 
		
		<div class="item-img">
		
		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
			
			do_action( 'woocommerce_before_shop_loop_item_title' );
		?>

		</div>
				
		<?php echo (!$zoom_button && !$link_button) ? '</a>' : ''; ?>
	
		<div class="item-data">
				
			<?php 
			as_shop_buttons(); // in woocommerce_theme_edits.php
			
			as_shop_title_price(); // in woocommerce_theme_edits.php
			?>
		
		</div><!-- .item-data -->
				
		<div class="item-data-list">
				
			<?php
			as_shop_title_price(); // in woocommerce_theme_edits.php

			if ( $post->post_excerpt ) {
			?>
				<div itemprop="description">
					
					<?php echo apply_filters( 'woocommerce_short_description', strip_shortcodes( woocommerce_template_single_excerpt() ) ); // WC 2.5.0 > ?>
				</div>
			
			<?php
			}
			as_shop_buttons(); // in woocommerce_theme_edits.php
			?>
		
		</div><!-- .item-data -->
		
		<div class="clearfix"></div>
		
	</div><!-- .anim-wrap -->
		

</li>
<?php ?>