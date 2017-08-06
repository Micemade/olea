<?php
/**
 *	Template part: Header Horizontal  02
 *	horizontal template for header
 */
global $olea_woo_is_active;
?>

<header id="site-menu" class="horizontal header-template-02">
	
	<div class="row clearfix topbar">
	
		
		<div class="large-12 " style="text-align: center">
		
			<?php get_template_part('topbar'); ?>
		
		</div>
		
	
	</div><!-- .topbar -->
	
	
	<div class="row clearfix border-bottom" data-equalizer>
		
		<div class="large-4  vertical-align" data-equalizer-watch>
		
			
			<div class="vertical-middle">
			
			<?php
			if ( $olea_woo_is_active && defined( 'YITH_WCAS' ) ) {
			
				echo as_yith_ajax_search();
				
			}elseif( $olea_woo_is_active ) {
				as_get_product_search_form();
			}else{
				get_template_part('searchform','menu');
			}
			?>
			
			</div>
		
		
		</div>
		
		
		<div id="site-title" class="large-4  vertical-align" data-equalizer-watch>
				
			<div class="vertical-middle">
			
			<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> | <?php bloginfo( 'description' );?>" rel="home" class="home-link">
			
			<?php do_action( 'olea_logo' ); ?>
			
			</div>
		
		</div>
				

		<div class="large-4  vertical-align" data-equalizer-watch>
		
			<div class="vertical-middle">
			
			<?php
			
			get_template_part('secondary_menu');
			
			if ( $olea_woo_is_active ) {
				get_template_part("woocommerce/headercart");
			}
			
			?>
			
			</div>
			
		</div>
		
		
		
		<div class="clearfix"></div>
		
	</div><!-- .row -->
	
	
	<div class="row">
	
		<nav id="main-nav-wrapper" class="large-12">
									
			<?php 
			$walker = new My_Walker;
			wp_nav_menu( array( 
					'theme_location'	=> 'main-horizontal',
					//'menu'			=> 'Main menu',
					'walker'			=> $walker,
					'link_before'		=> '',
					'link_after'		=>'',
					'menu_id'			=> 'main-nav',
					'menu_class'		=> 'navigation to-stick horizontal',
					'container'			=> false
					) 
				);
			?>
			
		</nav>

	</div>
	
	<div class="clearfix"></div>
	
	<div class="row">
	
		<div class="large-12 breadcrumbs-holder"><?php get_template_part('breadcrumbs'); ?></div>
	
	</div>
	
	
</header>

<div id="site-menu-mobile">

	<?php get_template_part('header','mobile'); ?>

</div>