<?php
/**
 *	Template part: Header Horizontal  01
 *	horizontal template for header
 */
global $olea_woo_is_active;
?>

<header id="site-menu" class="horizontal header-template-01">
	
	<div class="row clearfix topbar border-bottom">
	
			
		<div class="large-6 " style="height: 32px;">
		
			<?php get_template_part('topbar'); ?>
			
		</div>
		
		<div class="large-<?php echo $olea_woo_is_active ? '5' : '6'; ?>">
		
			<?php 
			// SECONDARY MENU
			
			get_template_part('secondary_menu');
			
			// SEARCH FORM
			if ( $olea_woo_is_active && defined( 'YITH_WCAS' ) ) {
				
					echo as_yith_ajax_search();
					
				}elseif( $olea_woo_is_active ) {
				
					as_get_product_search_form();
					
				}else{
					get_template_part('searchform','menu');
				}
				?>
		</div>
	
		
		<?php if ( $olea_woo_is_active ) { ?>
		<div class="large-1 ">			
			
			<?php get_template_part("woocommerce/headercart");?>
		
		</div>
		<?php } // end if $olea_woo_is_active ?>
	
	</div>
	
	<div class="row clearfix">

		<div id="site-title" class="large-3 ">
				
			<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> | <?php bloginfo( 'description' );?>" rel="home" class="home-link">
			
			<?php do_action( 'olea_logo' ); ?>

			</a>
			
		</div>
	
		<div class="large-9 ">
			

			
			<nav id="main-nav-wrapper">
										
				<?php 
				$walker = new My_Walker;
				wp_nav_menu( array( 
						'theme_location'	=> 'main-horizontal',
						//'menu'			=> 'Main menu',
						'walker'			=> $walker,
						'link_before'		=> '',
						'link_after'		=>'',
						'menu_id'			=> 'main-nav',
						'menu_class'		=> 'navigation horizontal to-stick',
						'container'			=> false
						) 
					);
				?>
				
			</nav>
		
		</div>
			
	</div><!-- .row clearfix-->
		
	<div class="row">
	
		<div class="small-12 breadcrumbs-holder <?php echo !is_home() ? 'border-top' : ''; ?>">
			<?php get_template_part('breadcrumbs'); ?>
		</div>
	
	</div>
	
	
</header>

<div id="site-menu-mobile">

	<?php get_template_part('header','mobile'); ?>

</div>