<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wp_query, $product, $woocommerce_loop;

// Store loop count we're currently on.
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', loop_columns() );
}


$prod_cat_options = apply_filters( "olea_options", "prod_cats_sett", array(
									"Categories columns"=> 3,
									"Image width"		=> '',
									"Image height"		=> '',
								) );
$cat_columns	= !empty( $prod_cat_options ) ? $prod_cat_options['Categories columns'] : '';
$img_width		= !empty( $prod_cat_options ) ? $prod_cat_options['Image width'] : '';
$img_height		= !empty( $prod_cat_options ) ? $prod_cat_options['Image height'] : '';


$cat_columns	= $cat_columns ? $cat_columns : $woocommerce_loop['columns'];
	
// OLEA THEME EDIT:
$classes = array();
// total products:
$total = $wp_query->found_posts;
// for responsive grid:
if( $total == 1 ) {
	$oe = '12';
}elseif( $cat_columns % 2 == 0 ){ // more then 1 item and even
	$oe = '6';
}else{		// more then 1 item and odd
	$oe = '4';
};
//
// olea theme edit: set grid by columns number
$classes[]		= 'large-' . floor( 12 / $cat_columns );
// olea theme edit: add grid css
$classes[]		= 'item medium-'.$oe. ' small-12 column item';
$classes[] 		= 'product-category product';
$classes_final	= implode( " ", $classes );
?>

<div <?php wc_product_cat_class( $classes_final, $category ); ?>>

	<?php 
	/**
	 * woocommerce_before_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_open - 10
	 * DISABLED:
	 */
	//do_action( 'woocommerce_before_subcategory', $category ); // used custom link with "anim-wrap" class
	?>

	<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">

		<div class="item-overlay"></div>
		
		<div class="term">
			
			<span class="table"><span class="tablerow"><span class="tablecell">
			
			<h4 class="box-title">
			
			<?php
				echo esc_html($category->name);
				
				if ( $category->count > 0 )
					echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count button round">' . $category->count . '</mark>', $category );
			?>
			</h4>	
			
			</span></span></span>
		
		</div>		
		<?php
		/**
		 * woocommerce_before_subcategory_title hook
		 *
		 * @hooked woocommerce_subcategory_thumbnail - 10
		 */
		//do_action( 'woocommerce_before_subcategory_title', $category ); 
		//
		$cat_img_size  		= apply_filters( 'single_product_cat_img_size', 'thumbnail' );
		$dimensions    		= wc_get_image_size( $cat_img_size );
		$thumbnail_id  		= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );

		if ( $thumbnail_id ) {
		
			$image = wp_get_attachment_image_src( $thumbnail_id, $cat_img_size  );
			$image = $image[0];
			
			if( $img_width && $img_height ) {
			
				echo '<div class="entry-image"><img src="' . esc_url( bfi_thumb( $image, array( 'width' => $img_width, 'height' => $img_height) ) ). '" alt="" /></div>';
			
			}else{
				
				echo '<div class="entry-image"><img src="' . esc_url($image) . '" alt="' . esc_attr( $category->name ) . '" width="' . esc_attr($dimensions['width'] )  . '" height="' . esc_attr( $dimensions['height'] ) . '" /></div>';
			}
			
		} else {
		
			$image = woocommerce_placeholder_img_src();
			
			echo '<div class="entry-image"><img src="' . esc_url( bfi_thumb( AS_PLACEHOLDER_IMAGE, array( 'width' => $dimensions['width'], 'height' => $dimensions['height']) ) ). '" alt="" /></div>';
		}
		?>

		<?php
			/**
			 * woocommerce_after_subcategory_title hook
			 */
			do_action( 'woocommerce_after_subcategory_title', $category );
		?>

	</a>

	<?php 
	/**
	 * woocommerce_after_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_close - 10
	 * DISABLED
	 */
	//do_action( 'woocommerce_after_subcategory', $category ); ?>

</div>