<?php
/**
 *	The template part used for displaying SINGLE lookbook item.
 *
 *	@since olea 1.0
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//
?>

<div class="lookbook-single"> 
	
	<?php 
	if( has_post_thumbnail()  ) {
		
		echo '<div class="large-6 medium-6 small-12 column">';
				
				$img_size	= get_post_meta( get_the_ID(), 'aslb-img_size', true );
				$img_size	= $img_size ? $img_size : 'large';
				echo as_image( $img_size );
		
			echo '<br>';
			
			the_content();
			
		echo '</div>';
		
		
	}
	?>

	<div class="large-6 medium-6 small-12 column">
	
		
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
							
							echo '<h3><a href="'. esc_url( get_permalink($id) ) .'" title="'. the_title_attribute (array('echo' => 0)) .'">'. esc_html( get_the_title( $id ) ) .'</a></h3>';
							
							woocommerce_template_loop_price();
							
							echo '<div class="quick-view-holder">';
							
							echo '<a href="#" class="quick-view tip-top"   title="'.esc_attr__('Quick buy','olea').'" data-id="'. esc_attr($id) .'" data-tooltip><span class="icon-eye"></span></a>';
							
							echo '<a href="' . get_permalink(). '" class="tip-top" title="' . esc_attr__('Details','olea') . '" data-tooltip><span class="icon icon-link" aria-hidden="true"></span></a>';
							
							echo '</div>'; // .quick-view-holder
							?>
							
							<div class="clearfix"></div>
							
						</div>
				
					</div>
					
				<?php
				} // end foreach
				
				wp_reset_postdata();
			
			} //end if
			?>
			
		</div><!--post-content -->	

		<div class="clearfix"></div>
	
	</div>

</div>

<div class="clearfix"></div>