<?php
/**
 *	Template part: Header Vertical 
 *	vertical customizable template for header - float left with fixed position
 */
global $olea_woo_is_active;
?>

<header id="site-menu" class="vertical">
		
	<div class="row clearfix">

	<?php 
	$headblocks_option = apply_filters( "olea_options", "default_header_blocks", array() );
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
					
						get_template_part("woocommerce/headercart");
					
					} // endif $olea_woo_is_active
					
					break;
					//////////////////////////////////////////
					case 'Site title or logo' :
					?>
					<div id="site-title" class="small-12">
			
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> | <?php bloginfo( 'description' );?>" rel="home">
						
						
						<?php do_action( 'olea_logo' ); ?>
						
					</div>
					
					<?php 
					
					break;
					//////////////////////////////////////////
					case 'Menu' :
					?>
					<nav id="main-nav-wrapper" class="small-12">
						
						<?php 
						$walker = new My_Walker;
						wp_nav_menu( array( 
								'theme_location'	=> 'main-vertical',
								//'menu'			=> 'Main menu',
								'walker'			=> $walker,
								'link_before'		=>'',
								'link_after'		=>'',
								'menu_id'			=> 'main-nav',
								'menu_class'		=> 'navigation ',
								'container'			=> false
								) 
							);
						?>
						
					</nav>
					<div class="clearfix"></div>
					
					<?php 
					break;
					//////////////////////////////////////////
					case 'Search' :
					
						if ( $olea_woo_is_active && defined( 'YITH_WCAS' ) ) {
				
							echo as_yith_ajax_search();
							
						}elseif( $olea_woo_is_active ) {
							as_get_product_search_form();
						}else{
							get_template_part('searchform','menu');
						}
							
					break;
					//////////////////////////////////////////
					
					case 'Contact / Social' :
	
						get_template_part('topbar');
					
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
	
	</div><!-- .row -->
	
</header>

<div id="site-menu-mobile">

	<?php get_template_part('header','mobile'); ?>

</div>