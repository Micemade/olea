<?php
function as_single_prod_func( $atts, $content = null ) { 
  
	global $post, $wp_query,  $olea_woo_is_active, $as_wishlist_is_active;
	
	extract( shortcode_atts( array(
			'title'				=> '',
			'subtitle'			=> '',
			'sub_position'		=> 'bellow',
			'title_style'		=> 'center',
			'title_color'		=> '',
			'subtitle_color'	=> '',
			'no_decoration'		=> '',
			'title_size'		=> '',
			'enter_anim'		=> 'none',
			'block_style'		=> 'images_right',
			
			'img_format'		=> 'thumbnail',
			'slider_navig'		=> '',
			'slider_pagin'		=> '',
			'slider_timing'		=> '',
			
			'back_color'		=> '',
			'opacity'			=> '100',
			'product_options'	=> 'reduced',
			'hide_short_desc'	=> '',
			'single_product'	=> '',
			'hide_wishlist'		=> '',
			'hide_addtocart'	=> '',
			'css_classes'		=> '',
			'block_id'			=> generateRandomString()
			  
		), $atts ) );
		
	$content = wpb_js_remove_wpautop($content, true);
	
	
	$display_args = array(
		'no_found_rows'		=> 1,
		'post_status'		=> 'publish',
		'post_type'			=> 'product',
		'post_parent'		=> 0,
		'suppress_filters'	=> false,
		'numberposts'		=> 1,
		'include'			=> $single_product
	);
	
	$content = get_posts( $display_args );
	
	$opacity = $opacity / 100;
	
	if( $block_style == 'images_right') {
		$arrow_color = 'border-left-color:rgba('.hex2rgb( $back_color ).','.$opacity.')  !important;' ;
	}elseif( $block_style == 'images_left'){
		$arrow_color = 'border-right-color:rgba('.hex2rgb( $back_color ).','.$opacity.')  !important;' ;
	}elseif( $block_style == 'centered'){
		$arrow_color = 'border-bottom-color:rgba('.hex2rgb( $back_color ).','.$opacity.')  !important;' ;
	}elseif( $block_style == 'centered_alt'){
		$arrow_color = 'border-top-color:rgba('.hex2rgb( $back_color ).','.$opacity.')  !important;' ;
	}else{
		$arrow_color = '';
	}
	
	// Enqueue variation scripts
	wp_enqueue_script( 'wc-add-to-cart-variation' );
	
	
	####################  HTML STARTS HERE: ###########################
	ob_start();
	
	echo $css_classes ? '<div class="'.esc_attr($css_classes).'">' : null;

	do_action('as_block_heading',  $title, $subtitle, $title_style, $sub_position, $title_color, $subtitle_color, $no_decoration, $title_size );
	
	?>
	
	<div id="<?php echo esc_attr($block_id); ?>" class="content-block single-item-block product <?php echo esc_attr($block_style); ?>">			
		
		<?php
		// SCOPED STYLES
		echo '<style type="text/css" scoped>';
		if( $back_color ) {
			if( $block_style == 'centered' || $block_style == 'centered_alt' ) {
				echo '#'. esc_attr($block_id) .' .item-data { background-color: rgba('.hex2rgb( $back_color ).','. $opacity.') !important;}';
			}else{
				echo '#'. esc_attr($block_id) .' { background-color: rgba('.hex2rgb( $back_color ).','.$opacity.') !important;}';
			}
			
			echo '#'. esc_attr($block_id) .'.single-item-block .arrow:before { '. $arrow_color .' ; opacity: 1 !important; }';
		}
		
		echo '</style>';
				
		foreach ( $content as $post ) {
		
			setup_postdata( $post );
			
			global $post, $product;

			$classes = array();	
			$classes = get_post_class();
			$classes[] = 'inner-wrapper item';
			
			echo '<div class="'. implode(' ',$classes).'">';
			
			$id = get_the_ID();
			$link = esc_url( get_permalink($id));
			
			if( $block_style == 'images_right') {
				$arrow = '<div class="arrow arrow-right"></div>';				
			}elseif( $block_style == 'images_left'){
				$arrow = '<div class="arrow arrow-left"></div>';
			}elseif( $block_style == 'centered'){
				$arrow = '<div class="arrow arrow-up"></div>';
			}elseif( $block_style == 'centered_alt'){
				$arrow = '<div class="arrow arrow-down"></div>';
			}
							
			?>					
				
			<?php if( $block_style != 'centered_alt' ) {  ?>
			<div class="images-holder">
							
				<?php echo wp_kses_post($arrow) ;?>
				
				<input type="hidden" class="slides-config" data-navigation="<?php echo esc_attr($slider_navig); ?>" data-pagination="<?php echo esc_attr($slider_pagin); ?>" data-auto="<?php echo esc_attr($slider_timing); ?>" />
				
				<?php do_action( 'do_single_product_images', $img_format );	?>
				
				<?php function_exists('woocommerce_show_product_loop_sale_flash') ? woocommerce_show_product_loop_sale_flash() : '';?>
				
			</div>
			<?php } ?>
		
			<div class="item-data woocommerce">
			
				<div class="wrap tablecell">
				
					<h3><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($post->post_title); ?></a></h3>
					
					<?php

					if( $product_options == 'reduced' ) { // as in catalog:
					
						echo '<div class="reduced" itemscope>';
						
						if ( $post->post_excerpt && !$hide_short_desc ) {
						?>
							<div itemprop="description" class="description">
							
								<?php echo apply_filters( 'woocommerce_short_description', substr( strip_shortcodes($post->post_excerpt), 0, 200 ) . ' ...' )?>
								
							</div>
						
						<?php }
						
						woocommerce_template_loop_price();
						
						echo '<div class="table"><div class="tablerow">	';
						
						// HIDE ADD TO CART
						if( !$hide_addtocart ) {
						
							echo '<div class="item-buttons-holder tablecell">';
								
									do_action( 'woocommerce_after_shop_loop_item' );
								
							echo '</div>';
						}
						
						if( $as_wishlist_is_active && !$hide_wishlist ) {
						
							echo '<div class="item-buttons-holder tablecell">';
							
								do_action( 'as_wishlist_button' );
							
							echo '</div>';
							
						}
						
						echo '</div></div>';// .tablecell .tablerow
						
						echo '</div>'; // .reduced
						
					}else{ // as in single product page: 
											
						// HIDE ADD TO CART
						if( $hide_addtocart ) {
							remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
						}
						
						// HIDE WISHLIST BUTTON
						if( $hide_wishlist ) {
							remove_action( 'woocommerce_single_product_summary', 'as_wishlist_button_func', 35 );
						}
						
						do_action( 'woocommerce_single_product_summary' );
						
					}
					?>
				
				</div>
			
			</div>
			
			<?php if( $block_style == 'centered_alt' ) {  ?>
			<div class="images-holder">
							
				<?php echo wp_kses_post($arrow);?>
				
				<input type="hidden" class="slides-config" data-navigation="<?php echo esc_attr($slider_navig); ?>" data-pagination="<?php echo esc_attr($slider_pagin); ?>" data-auto="<?php echo esc_attr($slider_timing); ?>"  />
				
				<?php do_action( 'do_single_product_images', $img_format );	?>
				
			</div>
			<?php } ?>
			
			
			<div class="clearfix"></div>
				
			
		
		<?php }// END foreach ?>

		</div>	
	
	
	</div><!-- /.content-block single-item-block -->
	
	<?php
	####################  HTML ENDS HERE: ###########################
	echo $css_classes ? '</div>' : null;

	####################  HTML OUTPUT ENDS HERE: #########################

	$output_string = ob_get_contents();
   
	ob_end_clean();
	
	return $output_string ;
}
?>