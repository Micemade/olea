<?php
/**
 *	Template part: Header mobile 
 *
 *	template for mobile devices - logo, main menu etc.
 */
global $olea_woo_is_active;
?>

<div class="row clearfix">

	<div id="site-title-mobile" class="small-12">
				
		<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> | <?php bloginfo( 'description' );?>" rel="home">
		
		<?php do_action( 'olea_logo' ); ?>
		
		</a>
		
	</div>

	<div class="mobile-sticky">
	
	
	<div class="menu-toggler">
	
		<span class="menu-title"><?php esc_html_e('Menu','olea'); ?></span>
		
		<a href="#" title="<?php esc_attr_e('Toggle menu','olea') ;?>">
			
			<span class="icon-menu"></span>
		
		</a>
		
		<div class="clearfix"></div>
	</div>

	<div class="mobile-dropdown">
	
		<?php
		$headblocks_option = apply_filters( "olea_options", "mobile_header_blocks", array() );
		if( isset( $headblocks_option['enabled'] ) ) {
		
			$headblocks = $headblocks_option['enabled'];
			
			foreach ( $headblocks as $block ) {
			
				$block_array_check =  strpos( $block, "|");
				// if are saved as resizable
				if( $block_array_check ) {
				
					$bl =  explode("|", $block ); // $bl[0] - block name, $bl[1] - block width
					
					switch ( $bl[0] ) {
					
						//////////////////////////////////////////
						case 'Shopping cart' :
						
						/**
						 *	IF WOOCOMMERCE is ACTIVATED
						 *
						 */
						if ( $olea_woo_is_active ) {
						
							global $woocommerce;
							
							echo '<div class="wrap-mini-cart-mobile">';
							
							$cart_count = $woocommerce->cart->cart_contents_count;
							$cart_link = get_permalink( wc_get_page_id( 'cart' ));
							$cart_action = apply_filters( "olea_options", "cart_action", "popup" );
						
							echo ($cart_action == 'page') ? '<a href="'. esc_url($cart_link) .'" class="olea-head-cart" id="olea-head-cart-mobile">' : '<div class="olea-head-cart mini-cart-toggle" id="olea-head-cart-mobile">';
							?>
									
								<span class="icon-shopping63 mini-cart-icon" aria-hidden="true"></span>
								
								<span class="cart-contents">
								
								<?php echo '<span class="count">'.intval($cart_count).'</span>'; ?>
								
								<?php echo wp_kses_post($woocommerce->cart->get_cart_total()); ?>
								
								</span>
								
								<div class="clearfix"></div>

							<?php echo ($cart_action == 'page') ? '</a>' : '</div>';

							echo '<div class="mini-cart-list"><span class="arrow-up"></span><div class="widget_shopping_cart_content">';
								
								woocommerce_get_template_part('mini','cart');
								
							echo '</div></div>'; //end mini cart

							echo '</div>'; // end wrap-mini-cart
						
						} // endif $olea_woo_is_active
						
						break;
						//////////////////////////////////////////
						
						case 'Menu mobile' :
						?>
						<nav id="main-nav-wrapper-mobile" class="small-12">
							
							<?php 
							if ( has_nav_menu( 'main-mobile' ) ) {
								$walker = new My_Walker;
								wp_nav_menu( array( 
									'theme_location'	=> 'main-mobile',
									//'menu'			=> 'Main menu',
									'walker'			=> $walker,
									'link_before'		=>'',
									'link_after'		=>'',
									'menu_id'			=> 'main-nav-mobile',
									'menu_class'		=> 'navigation ',
									'container'			=> false
									) 
								);
							}
							?>
							
						</nav>
						<div class="clearfix"></div>
						
						<?php 
						break;
						//////////////////////////////////////////
						case 'Search' :
						
							if( $olea_woo_is_active ) {
								as_get_product_search_form();
							}else{
								get_template_part('searchform','menu');
							}
						
						break;
						
	
						//////////////////////////////////////////
						case 'Widgets block' :
						
						if ( is_active_sidebar( 'sidebar-header' ) ) {
						
							dynamic_sidebar( 'sidebar-header' ); 
							
						}
						
						break;
						//////////////////////////////////////////
						case 'Widgets block 2' :
						
						if ( is_active_sidebar( 'sidebar-header-2' ) ) {
							
							dynamic_sidebar( 'sidebar-header-2' ); 
							
						}
						
						break;
						//////////////////////////////////////////
						case 'Widgets block 3' :
						
						if ( is_active_sidebar( 'sidebar-header-3' ) ) {
							
							dynamic_sidebar( 'sidebar-header-3' ); 
							
						}
						
						break;
						}
				}
			}
		
		}
		?>
	</div>
	
	</div>
	
	
</div>