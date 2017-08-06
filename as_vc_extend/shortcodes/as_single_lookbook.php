<?php
function as_single_lookbook_func( $atts, $content = null ) { 
  
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
			'enter_anim'		=> 'fadeIn',
			'block_style'		=> 'images_right',
			
			'img_format'		=> 'medium',
			
			'back_color'		=> '',
			'opacity'			=> '100',

			'single_lookbook'	=> '',

			'css_classes'		=> '',
			'block_id'			=> generateRandomString()
			  
		), $atts ) );
		
	$content = wpb_js_remove_wpautop($content, true);
	
	/*	if ( $enter_anim != 'none' && !wp_style_is( 'animate', 'enqueued' )) {wp_register_style( 'animate', get_template_directory_uri() . '/css/animate.css');wp_enqueue_style( 'animate' );} */
	
	$display_args = array(
		'no_found_rows'		=> 1,
		'post_status'		=> 'publish',
		'post_type'			=> 'lookbook',
		'post_parent'		=> 0,
		'suppress_filters'	=> false,
		'numberposts'		=> 1,
		'include'			=> $single_lookbook
	);
	
	$main_content = get_posts($display_args);
	
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
	//wp_enqueue_script( 'wc-add-to-cart-variation' );
	
	
	echo '<style type="text/css" scoped>';
	if( $back_color ) {
		if( $block_style == 'centered' || $block_style == 'centered_alt' ) {
			echo '#'. esc_attr($block_id) .' .item-data { background-color: rgba('.hex2rgb( $back_color ).','.$opacity.') !important;}';
		}else{
			echo '#'. esc_attr($block_id) .' { background-color: rgba('.hex2rgb( $back_color ).','.$opacity.') !important;}';
		}
		
		echo '#'.$block_id.'.single-item-block .arrow:before { '. $arrow_color .' ; opacity: 1 !important; }';
	}
	
	echo '</style>';
	
	####################  HTML STARTS HERE: ###########################
	ob_start();
	
	echo $css_classes ? '<div class="'.esc_attr($css_classes).'">' : null;

	do_action('as_block_heading',  $title, $subtitle, $title_style, $sub_position, $title_color, $subtitle_color, $no_decoration, $title_size );
	
	?>
	
	<div id="<?php echo esc_attr($block_id); ?>" class="content-block single-item-block <?php echo esc_attr($block_style); ?>">			
		
		<?php
		
		echo $content ? wp_kses_post($content) : '';
		
		foreach ( $main_content as $post ) {
		
			setup_postdata( $post );
			
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
				
			<?php
			// IMAGE HTML
			$image_html  = '';
			$image_html .= '<div class="images-holder">';
				
				$image_html .=  $arrow ;
				$image_html .= '<div class="item-img">';
				
					$image_html .= '<div class="front">';
						$image_html .= as_image( $img_format );
					$image_html .= '</div>';// front
					
					$image_html .= '<div class="back">';
						$image_html .= '<div class="item-overlay"></div>';
						$image_html .= '<h3><a href="'. esc_url($link) .'">'. esc_html($post->post_title).'</a></h3>';
						$image_html .= '<div class="back-buttons">';
						
							$image_html .= '<a href="'. as_get_full_img_url() .'" class="item-zoom" data-rel="prettyPhoto" title="'. the_title_attribute (array('echo' => 0)) .'"><div class="icon icon-zoom-in" aria-hidden="true"></div></a>' ;
							
							$image_html .= '<a href="'. esc_url($link). '" title="'. the_title_attribute (array('echo' => 0)) .'"><div class="icon icon-link" aria-hidden="true"></div></a>';
						
						$image_html .= '</div>';// back-buttons
			
					$image_html .= '</div>';// back
					
				$image_html .= '</div>';// item-img
				
				$image_html .= '<p>'. get_the_excerpt() .'</p>';// item-img
				
			$image_html .= '</div>';// images-holder

			$allowed = array(
					'div' => array(
						'class' => array()
					),
					'a' => array(
						'href' => array(),
						'class' => array(),
						'rel' => array(),
						'data-rel' => array(),
						'title' => array(),
						'aria-hidden' => array()
					),
					'img' => array(
						'src' => array(),
						'class' => array(),
						'title' => array(),
						'alt' => array(),
					),
					'h3' => array(),
					'p' => array(),
				);
			
			
			if( $block_style != 'centered_alt' ) {
				
				echo wp_kses($image_html, $allowed);
			}
			?>
		
			<div class="item-data">
							
				<?php if( $olea_woo_is_active ) { ?>
				
				<?php 
				if ( $post->post_excerpt ) {
					
					echo wp_kses_post($post->post_excerpt);
				}
				?>
				<div class="post-content">
		
					<?php 
					
					$prod_meta		= get_post_meta( get_the_ID(), 'aslb-products', false );
								
					$prod_meta_arr	= explode( ',',$prod_meta[0] );
					
					$products_args	= array(
						'no_found_rows'		=> 0,
						'post_status'		=> 'publish',
						'post_type'			=> 'product',
						'post__in'			=> $prod_meta_arr,
						'post_parent'		=> 0,
						'suppress_filters'	=> false,
						'orderby'			=> 'post__in',
						'order'				=> 'DESC',
						'numberposts'		=> -1
					);
					
					$products = get_posts( $products_args );
					
					if( !empty($products) ) { 
					
						if ( !wp_script_is( 'wc-add-to-cart-variation', 'enqueued' )) {
											
							wp_register_script( 'wc-add-to-cart-variation', WP_PLUGIN_DIR . '/woocommerce/assets/frontend/add-to-cart-variation.min.js');
							wp_enqueue_script( 'wc-add-to-cart-variation' );
							
						}
						
						foreach( $products as $post ) {
						
							setup_postdata( $post );
							
							global $post, $product, $woocommerce, $wp_query;
							
							$id = $post->ID;
							?>
							
							<div class="lookbook-product">
															
								<?php echo as_image( 'thumbnail' );?> 
								
								<div class="product-info">
									
									<?php 
									
									echo '<h3><a href="'. esc_url(get_permalink($id)) .'" title="'. the_title_attribute (array('echo' => 0)) .'">'. esc_html(get_the_title( $id )) .'</a></h3>';
									
									woocommerce_template_loop_price();
									
									echo '<div class="quick-view-holder">';
									
									echo '<a href="#" class="quick-view tip-top"   title="'.  esc_attr__('Quick buy','olea').'" data-id="'.  esc_attr($id) .'" data-tooltip><span class="icon-eye"></span></a>';
									
									echo '<a href="' . get_permalink(). '" class="tip-top" title="' . esc_attr__('Details','olea') . '" data-tooltip><span class="icon icon-link" aria-hidden="true"></span></a>';
									
									echo '</div>'; // .quick-view-holder
									?>
									
									<div class="clearfix"></div>
									
								</div><!-- .product-info-->
							
							</div>
							
						<?php
						} // end foreach
						
						wp_reset_postdata();
					
					} //end if
					?>
					
				</div><!--post-content -->	
			
				<?php }else{ ?>
				
				<h4><?php esc_attr_e('WooCommerce plugin is not installed. Please install the plugin to add product associated with lookbook item','olea') ?></h4>
				
				<?php } ?>
			
			</div>
			
			<?php
			if( $block_style == 'centered_alt' ) {
				echo wp_kses($image_html, $allowed);
			}
			?>
			
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