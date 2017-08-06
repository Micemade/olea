<?php
function as_ajax_prod_func( $atts, $content = null ) { 
  
	global $post, $wp_query, $olea_woo_is_active, $as_wishlist_is_active;

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
			'product_cats'		=> '',
			'prod_cat_menu'		=> 'images',
			'menu_columns'		=> '3',
			'tax_menu_align'	=> '',
			'img_format'		=> 'thumbnail',
			
			'zoom_button'		=> '',
			'link_button'		=> '',
			'anim'				=> 'anim-0',
			'data_anim'			=> 'anim-0',
			
			'shop_quick'		=> '',
			'shop_buy_action'	=> '',
			'shop_wishlist'		=> '',
			'hide_prod_info'	=> '',
			'filters'			=> 'latest',
			
			'total_items'		=> 8,
			'hide_slider'		=> '',
			'slider_navig'		=> '',
			'slider_pagin'		=> '',
			'slider_timing'		=> '',
			
			'items_desktop'		=>  4,
			'items_tablet'		=>	2,
			'items_mobile'		=> 1,
			
			
			'text_color'		=> '',
			'overlay_color'		=> '',
			'button_label'		=> '',
			'ap_link_button'	=> '',
			'outlined'			=> '',

			'css_classes'		=> '',
			'block_id'			=> generateRandomString()
			  
		), $atts ) );
	
	$content = wpb_js_remove_wpautop($content, true);
	
	
	$button 	= vc_build_link( $ap_link_button );
	$but_url		= $button['url'];
	$but_title	= $button['title'];
	$but_target		= $button['target'];
		
		
		$total_items = $total_items ? $total_items : -1;
				
		// SET POST TYPE VARIABLE
		$post_type = 'product';
		
		// PRODUCT FILTERS:
		$order_rand	= false;
		if ( $filters == 'featured' ){
			
			if( apply_filters( 'olea_wc_version', '3.0.0' ) ) {
				$args_filters['tax_query'] = array(
					array(
						'taxonomy' => 'product_visibility',
						'field'    => 'name',
						'terms'    => 'featured',
					)
				);
			}else{
				$args_filters = array( 
					'meta_key' => '_featured',
					'meta_value' => 'yes'
				);
			}
			remove_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
			
		}elseif( $filters == 'best_sellers' ){
			
			$args_filters = array( 
				'meta_key'	=> 'total_sales',
				'orderby'	=> 'meta_value_num'
			);
			remove_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
		
		}elseif( $filters == 'best_rated' ){
			
			$args_filters = array();
			add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
			
		}elseif( $filters == 'latest' ){
			
			$args_filters = array();
			remove_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
		
		}elseif( $filters == 'random' ){
		
			$order_rand	= true;
			$args_filters = array();
			remove_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
			
		}
		elseif( $filters == 'on_sale' ){
			
			$product_ids_on_sale    = wc_get_product_ids_on_sale();
			$product_ids_on_sale[]  = 0;
			$args_filters = array(
				'post__in' => $product_ids_on_sale
			);

			remove_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );

		}
		
		
		//
		// TAXONOMY FILTER ARGS
		if( $product_cats ){
			$tax_terms = $product_cats;
			$taxonomy = 'product_cat';
		}else{
			$tax_terms = '';
			$taxonomy = '';
		}
		
		####################  HTML STARTS HERE: ###########################
		ob_start();
		
		echo $css_classes ? '<div class="'.esc_attr($css_classes).'">' : null;
		
		
		do_action('as_block_heading',  $title, $subtitle, $title_style, $sub_position, $title_color, $subtitle_color, $no_decoration, $title_size );
		
		echo '<div id="prod-cats-'.esc_attr($block_id).'" class="content-wrapper">';
		
		########## TAXONOMY (PRODUCT CATEGORIES) MENU CREATING ##########
		$tax_terms_arr = explode(',', $tax_terms );
		
		if( $tax_terms && $prod_cat_menu !== 'no_menu' ) {
		
		if( $prod_cat_menu == 'images' ){
			 $cat_menu_css = 'cat-images';
		}elseif( $prod_cat_menu == 'no_images') {
			$cat_menu_css = 'cat-list';
		}else{
			$cat_menu_css = '';
		}
		
		
		
		if ( $text_color || $overlay_color ) {
			
			echo '<style scoped>';
			echo $text_color ? '#prod-cats-'.esc_attr($block_id).' ul .category-image .term h4 { color: '.esc_attr($text_color).';}' : null;						
			echo $overlay_color ? '#prod-cats-'.esc_attr($block_id).' ul .category-image a .item-overlay { background-color: '.esc_attr($overlay_color).';}' : null;
			echo '</style>';
		}			
		
		
		// GET TAXONOMY OBJECT:
		$term_Objects = array();
		
		foreach ( $tax_terms_arr as $term ) {
			if( term_exists( $term,  $taxonomy ) ) {
				$term_Objects[] = get_term_by( 'slug', $term, $taxonomy ); // get term object using slug
			}
		}
		
		
		// DISPLAY TAXONOMY MENU:
		if( !empty($term_Objects) ) {
			
			// SET MENU CLASSES:
			// menu items columns	
			if( $menu_columns == 'auto') {
				$grid_cat = '';
			}elseif( $menu_columns == 'stretch' ){
				$grid_cat = ' large-' . floor( 12 / count($term_Objects) ) . ' medium-' . floor( 12 / count($term_Objects) ) . ' small-12 column';
			}else{
				$grid_cat = ' large-' . floor( 12 / $menu_columns ) . ' medium-' . floor( 12 / $menu_columns ) . ' small-12 column';
			}
			// One menu item:
			$one_per_row = ( $menu_columns == 1 ) ? ' one-item-in-row' : '';
			$num_terms = count($term_Objects);
			
			
			// Get WC drag'n drop categories sorting:	
			$sorter = array();
			foreach ( $term_Objects as $key => $term_obj ) {
				$meta = get_term_meta( $term_obj->term_id );
				$sorter[] = $meta['order'][0];
			}
			array_multisort($sorter, $term_Objects);
			
			echo '<ul class="taxonomy-menu '. esc_attr($cat_menu_css) .' '.esc_attr($tax_menu_align) . esc_attr( $one_per_row ) .'">';
			
			foreach ( $term_Objects as $term_obj ) {
				
				if( $prod_cat_menu === 'images'  ) { // if images should be displayed:
					
					$thumbnail_id = get_woocommerce_term_meta( $term_obj->term_id, 'thumbnail_id' );
					$image = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail' );

					if ( $image ) {
			
						echo '<li class="category-image'. $grid_cat .' as-hover">';
						echo ($num_terms > 1) ? '<a href="#" class="'.$term_obj->slug .' ajax-products" data-id="'. $term_obj->slug .'">' : '<div>';
						
						echo '<div class="item-overlay"></div>';
						
						echo '<div class="term"><div class="table"><div class="tablerow"><div class="tablecell">';
						
						
						echo '<h4 class="box-title">' . $term_obj->name . '</h4></div></div></div></div>';
						echo '<img src="' . bfi_thumb( $image[0], array( 'width' => 600, 'height' => 250) ). '" alt="" />';
						echo ($num_terms > 1) ? '</a>' : '</div>';
						echo '</li>';
						
					}else{
					
						echo '<li class="category-image'. $grid_cat .' as-hover">';
						echo ($num_terms > 1) ? '<a href="#" class="'.$term_obj->slug .' ajax-products" data-id="'. $term_obj->slug .'">' : '<div>';
						
						echo '<div class="item-overlay">';
						if ( $overlay_color ) {
							echo '<style scoped>';
							echo $overlay_color ? '#prod-cats-'.$block_id.' ul .category-image a .item-overlay { background-color: '.$overlay_color.';}' : null;
							echo '</style>';
						}
						echo '</div>';
						
						echo '<div class="term"><div class="table"><div class="tablerow"><div class="tablecell">';
						
						if ( $text_color ) {
							echo '<style scoped>';
							echo $text_color ? '#prod-cats-'.$block_id.' ul .category-image .term h4 { color: '.$text_color.';}' : null;						
							echo '</style>';
						}
						
						echo '<h4 class="box-title">' . $term_obj->name . '</h4></div></div></div></div>';
						echo '<img src="' . bfi_thumb( AS_PLACEHOLDER_IMAGE, array( 'width' => 600, 'height' => 250) ). '" alt="" />';
						echo '<div class="arrow-down"></div>';
						echo ($num_terms > 1) ? '</a>' : '</div>';
						echo '</li>';
					}
					
				}elseif( $prod_cat_menu === 'no_images' ){
				
					echo '<li  class="category-link">';
					echo '<a href="#" class="'.$term_obj->slug .' ajax-products" data-id="'. $term_obj->slug .'">';
					echo '<div class="term box-title">' . $term_obj->name . '</div>';
					echo '</a>';
					echo '</li>';
				}
			
			} //end foreach
			
			echo '</ul>';
		
		}//endif (!empty($term_Objects))
		
		
		
		}// endif $tax_terms
		########## END TAXONOMY (PRODUCT CATEGORIES) MENU CREATING ##########
		?>
		
		<?php 
		
		// IN CASE NO SLIDER IS USED - ECHO THE GRID
		$l = 12 / $items_desktop;
		$t = 12 / $items_tablet;
		$m = 12 / $items_mobile;
		
		if ( $hide_slider ) {
			$no_slider = ' large-'.$l.' medium-'. $t . ' small-'.$m;
		}else{
			$no_slider = '';
		}
		/*
		IMPORTANT: HIDDEN INPUT TYPE - HOLDER OF VARS SENT VIA POST BY AJAX :
		*/
		?>
		<input type="hidden" class="varsHolder" name="ajax-vars" data-block_id="<?php echo esc_attr($block_id); ?>" data-tax = "<?php echo esc_attr($taxonomy); ?>"  data-ptype = "<?php echo esc_attr($post_type); ?>" data-totitems = "<?php echo esc_attr($total_items); ?>" data-filters = "<?php echo esc_attr($filters); ?>"  data-img= "<?php echo esc_attr($img_format); ?>"  data-shop_quick ="<?php echo esc_attr($shop_quick); ?>" data-shop_buy_action ="<?php echo esc_attr($shop_buy_action); ?>" data-shop_wishlist ="<?php echo esc_attr($shop_wishlist); ?>" data-enter_anim="<?php echo esc_attr($enter_anim); ?>" data-no_slider="<?php echo esc_attr($no_slider); ?>" data-zoom="<?php echo esc_attr($zoom_button); ?>" data-link="<?php echo esc_attr($link_button); ?>"  data-hide_prod_info="<?php echo esc_attr($hide_prod_info);?>" />
		
		
		<div class="clearfix"></div>

		<?php 
		
		// if there are taxonomies selected, turn on taxonomy filter:
		if( !empty($tax_terms) ) {
			
			$tax_filter_args = array('tax_query' => array(
								array(
									'taxonomy' => $taxonomy,
									'field' => 'slug', // can be 'slug' or 'id'
									'operator' => 'IN', // NOT IN to exclude
									'terms' => $tax_terms_arr,
									'include_children' => true
								)
							)
						);
		}else{
			$tax_filter_args = array();
		}
			
		
		$main_args = array(
			'no_found_rows'		=> 0,
			'post_status'		=> 'publish',
			'post_type'			=> $post_type,
			'post_parent'		=> 0,
			'suppress_filters'	=> false,
			'orderby'			=> $order_rand ? 'rand menu_order date' : 'menu_order date',
			'order'				=> 'DESC',
			'numberposts'		=> $total_items
		);
		
		$all_args = array_merge( $main_args, $args_filters, $tax_filter_args );

		$content = get_posts($all_args);
		
		?>	

		<div class="loading-animation" style="display: none;"></div>
		
		<?php if($enter_anim != 'none') {?>
		<script>
		(function( $ ){
			$.fn.anim_waypoints = function(blockId, enter_anim) {
				
				var thisBlock = $('#products-'+ blockId );
				if ( !window.isMobile && !window.isIE9 ) {
					var item = thisBlock.find('.item');
					
					item.waypoint(
						function(direction) {
							var item_ = $(this);
							if( direction === "up" ) {	
								item_.removeClass('animated '+ enter_anim).addClass('to-anim');
							}else if( direction === "down" ) {
								var i =  item_.attr('data-i');
								setTimeout(function(){
								   item_.addClass('animated '+ enter_anim).removeClass('to-anim');
								}, 100 * i);
							}
						}
						
					,{ offset: "98%" });
				}else{
					thisBlock.find('.item').each( function() {
						$(this).removeClass('to-anim');
					});
				}
				
			}
		})( jQuery );
		
		jQuery(document).ready( function($) {
			
			//$('#products-<?php echo $block_id; ?>' ).find('.item-data').matchHeight();
			
			$(document).anim_waypoints("<?php echo esc_attr($block_id); ?>"," <?php echo esc_attr($enter_anim);?>");
		
		});
		</script>
		<?php } ?>
		
		
		<div id="products-<?php echo esc_attr($block_id); ?>" class="content-block cb-1 woocommerce" >

			<?php if( !empty( $tax_terms_arr )) {?>
			<div class="cat-title">
				<div class="wrap"></div>
				<a href="#" class="ajax-products"<?php echo !empty( $tax_terms_arr ) ? ' data-id="' . implode(",", $tax_terms_arr) .'"' : null; // array to string ?>>
					
					<div class="icon-cancel3" aria-hidden="true" title="<?php esc_attr_e('Reset categories','olea'); ?>"></div> 
				</a>

			</div>
			<?php } ?>
			
			<?php
			// if the slider will loop or not
			$minimum_items	= ( count($content) < $items_desktop ) ? true : false ;
			$slider_loop	= ( $tax_terms || $minimum_items ) ? '0' : '1'; 
			?>
			
			<input type="hidden" class="slides-config" data-navigation="<?php echo $slider_navig ? '0' : '1'; ?>" data-pagination="<?php echo $slider_pagin ? '0' : '1'; ?>" data-auto="<?php echo esc_attr($slider_timing); ?>" data-desktop="<?php echo $items_desktop; ?>"  data-tablet="<?php echo esc_attr($items_tablet); ?>" data-mobile="<?php echo esc_attr($items_mobile); ?>" data-loop="<?php echo esc_attr($slider_loop); ?>" />
			
			<div class="category-content <?php echo !$hide_slider ? 'owl-carousel contentslides' : '';?><?php echo ' '. esc_attr($anim) ;?> <?php echo $data_anim == 'none' ? '' : esc_attr($data_anim); ?>"  id="ajax-prod-<?php echo esc_attr($block_id); ?>" <?php echo $hide_slider ? "data-masonry-options='{  \"itemSelector\": \".item\" }'" : 'data-equalizer'; ?>>
			
			<?php 
			$i = 1;
			
			//start products loop
			foreach ( $content as $post ) {
				
				setup_postdata( $post );
				
				global $product, $yith_wcwl;
				
				if( defined('WPML_ON') ) { // if WPML plugin is active
					$id	= icl_object_id( get_the_ID(), 'product', false, ICL_LANGUAGE_CODE ); 
					$lang_code	= ICL_LANGUAGE_CODE;
				}else{
					$id	= get_the_ID();
					$lang_code	= '';
				}
				$link = esc_url( get_permalink($id));
				
				
				// DATA for back image
				$img_width = $img_height = '';
				// 3.0.0 < Fallback conditional
				if( apply_filters( 'olea_wc_version', '3.0.0' )	) {
					$attachment_ids   = $product->get_gallery_image_ids();
				}else{
					$attachment_ids   = $product->get_gallery_attachment_ids();
				}
				
				if ( $attachment_ids ) {
					$image_url = wp_get_attachment_image_src( $attachment_ids[0], 'full'  );
					$img_url = $image_url[0];
					/* // IMAGE SIZES:
					$imgSizes = all_image_sizes(); // as custom function
					$img_width = $imgSizes[$img_format]['width'];
					$img_height = $imgSizes[$img_format]['height'];
					*/
				}
				// end DATA
				
				// 3.0.0 < Fallback conditional
				$cats = "";
				if( apply_filters( 'olea_wc_version', '3.0.0' ) ) {
					$cats =  wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">', '</span>' );
				}else{
					$cats = $product->get_categories( ', ', '<span class="posted_in">', '</span>' );
				}
				
				$prod_title = '<h4 class="prod-title">'.$cats.'<a href="'. $link .'" title="'. the_title_attribute (array('echo' => 0)).'"> ' . esc_attr(get_the_title()) .'</a></h4>';
				?>

				<div class="column item<?php echo esc_attr($no_slider); ?><?php echo ($enter_anim != 'none') ? ' to-anim' : '';  ?>" data-i="<?php echo esc_attr($i); ?>">
					
					<div class="anim-wrap" >
					
					<?php function_exists('woocommerce_show_product_loop_sale_flash') ? woocommerce_show_product_loop_sale_flash() : ''; ?>	
					
					<?php echo ($zoom_button && $link_button) ? '<a href="'.$link.'" title="'. the_title_attribute (array('echo' => 0)) .'">' : ''; ?>
					
					<div class="item-img">
						
						<div class="front">
													
							<?php function_exists('woocommerce_template_loop_rating') ? woocommerce_template_loop_rating() : ''; ?>
							
							<?php echo as_image( $img_format ); ?>
						
						</div>
						
						<div class="back">
						
							<div class="item-overlay"></div>

							<?php 
							
							echo $hide_prod_info ? wp_kses_post($prod_title) : '';
							
							if ( $attachment_ids ) {
								if( $img_width && $img_height ) {
									$params = array( 'width' => $img_width, 'height' => $img_height );
									echo '<img src="'. bfi_thumb( $img_url, $params ).'" alt="'. esc_attr(get_the_title()) .'" class="back-image" />';									
								}else{
									echo wp_get_attachment_image( $attachment_ids[0], $img_format );
								}
							}else{
								echo as_image( $img_format );
							}

							echo '<div class="back-buttons">';
															
							echo !$zoom_button ? '<a href="'.esc_url(as_get_full_img_url()).'" class="item-zoom" data-rel="prettyPhoto" title="'. the_title_attribute (array('echo' => 0)) .'"><div class="icon icon-zoom-in" aria-hidden="true"></div></a>' : null;
							
							
							echo !$link_button ? '<a href="'.esc_url($link).'" title="'. the_title_attribute (array('echo' => 0)) .'"><div class="icon icon-link" aria-hidden="true"></div></a>' : null;
							
							echo '</div>';
							
							?>
						
						</div>
						
					</div>
					
					<?php echo ($zoom_button && $link_button) ? '</a>' : ''; ?>
					
					<?php if ( !$hide_prod_info ) { ?>
					
					<div class="item-data"  data-equalizer-watch>
					
						<div class="table">
						
							<div class="tablerow">	
							
							<?php
							if( !$shop_quick ) {
								echo '<div class="item-buttons-holder tablecell">';
								echo '<a href="#qv-holder" class="quick-view tip-top"   title="'.__('Quick view','olea').' - '. the_title_attribute (array('echo' => 0)) .'" data-id="'.$id.'" data-lang="'. $lang_code .'" data-tooltip><span class="icon-eye"></span></a>';
								echo '</div>'; // tablecell
								
								if ( !wp_script_is( 'wc-add-to-cart-variation', 'enqueued' )) {
								
									wp_register_script( 'wc-add-to-cart-variation', WP_PLUGIN_DIR . '/woocommerce/assets/frontend/add-to-cart-variation.min.js');
									wp_enqueue_script( 'wc-add-to-cart-variation' );
								}
							}
							
							if( !$shop_buy_action ) {
								echo '<div class="item-buttons-holder tablecell">';
									//remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_single_excerpt', 25);
									do_action( 'woocommerce_after_shop_loop_item' );
								echo '</div>'; // tablecell
							}
							
							if( $as_wishlist_is_active && !$shop_wishlist ) {
								echo '<div class="item-buttons-holder tablecell">';
									do_action('as_wishlist_button');
								echo '</div>'; // tablecell
							}
							//
							?>
						
							</div>
						
						</div>
						
						<?php 
						// if all buttons disabled
						$no_buttons =( $shop_quick && $shop_buy_action && $shop_wishlist ) ?  true : false;
						
						echo $no_buttons ? '<div class="no-buttons">' : null;
						
						$edit_post = as_edit_post_link();
						
						echo wp_kses_post($prod_title . $edit_post);
						
						woocommerce_template_loop_price();
						
						echo $no_buttons ? '</div>' : null;
						?>
						<div class="clearfix"></div>
					
					</div><!-- .item-data -->
					
					<?php } // end if(!$hide_prod_info) ?>
					
				
				</div><!-- .anim-wrap -->
				
				</div><!-- .column -->
								
				<?php 
				$i++;
			}// END foreach
			
			wp_reset_query();
			
			?>
						
			</div>
			
			
			<?php if( $button_label && $but_url ) { ?>
			<div class="bottom-block-link">
			
				<a href="<?php echo esc_url( $but_url ); ?>" <?php echo ($but_target ? ' target="'.esc_attr($but_target).'" ' : '');?> class="button<?php echo  ($outlined ? ' outlined' : ''); ?>" <?php echo ($but_title ? 'title="'.esc_attr($but_title).'"' : 'title="'.esc_attr($button_label).'"'); ?> >
					<?php echo esc_html( $button_label ); ?>
				</a>
				
			</div>
			<?php } //endif; $button_label && $but_url ?>
			
			
			<div class="clearfix"></div>
			
		</div><!-- /.content-block cb-1 -->
		
		</div><!-- .content-wrapper-->
		
		<script>
		(function($) {
			"use strict";
			$(document).ready( function($) {
				
				
				$("li.vc_tta-tab>a").click( function() {
					var tab_id		= $(this).attr("href"),
						tabcontent	= $( tab_id ).find(".content-block");
					
					tabcontent.css( "opacity",0);
					
					setTimeout(
					function() {
						$.waypoints('refresh');
						//$(window).trigger('resize');
						Foundation.libs.equalizer.reflow();
						tabcontent.css( "opacity",1 );
					},1500);
					
					
				});
	
			});
		})(jQuery);
		</script>
		
		<?php
		####################  HTML ENDS HERE: ################################
		echo $css_classes ? '</div>' : null;
		
		####################  HTML OUTPUT ENDS HERE: #########################
	
		$output_string = ob_get_contents();
	   
		ob_end_clean();
		
		return $output_string ;

}
?>