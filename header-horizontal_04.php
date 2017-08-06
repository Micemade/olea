<?php
/**
 *	Template part: Header Horizontal  04
 *	horizontal template for header
 */
global $olea_woo_is_active ;
?>

<header id="site-menu" class="horizontal header-template-04">
	
	
	<div class="row clearfix topbar">
		
		<div class="large-6 columns">
		
			<?php get_template_part('secondary_menu'); ?>
						
		</div>
		
		<div class="large-6 columns">
		
			<?php get_template_part('topbar'); ?>
		
		</div>
	
	</div><!-- .row -->
		
	
	
	<div class="row clearfix border-bottom" data-equalizer>

		<div id="site-title" class="large-3 vertical-align" data-equalizer-watch>
				
			<div class="vertical-middle">
			
			<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> | <?php bloginfo( 'description' );?>" rel="home" class="home-link">
			
			<?php do_action( 'olea_logo' ); ?>
			
			</a>
		
			</div>
			
		</div>
	

		<div class="large-9 vertical-align" data-equalizer-watch>
			
			<div class="vertical-middle">
				
				<nav id="main-nav-wrapper" class="large-10">
										
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
			
			</div><!-- .vertical-middle -->
			
			
			<div class="vertical-middle">
			
				<?php if ( $olea_woo_is_active ) {
				
					get_template_part("woocommerce/headercart");
				 
				} // endif $olea_woo_is_active 
				?>
			</div><!-- .vertical-middle -->
				
			
		
		</div>
		

	</div>
	
	<div class="row"  style="padding: 1rem 0;">
	
		<div class="large-12" >
		
		<?php
		if ( $olea_woo_is_active && defined( 'YITH_WCAS' ) ) {
		
			echo as_yith_ajax_search();
			
		}elseif( $olea_woo_is_active ) {
			as_get_product_search_form();
		}else{
			get_template_part('searchform','menu');
		}
		?>
	
		</div><!--.column -->
		
	</div><!--.row -->
	
	<div class="clearfix"></div>
	
	<div class="row">
	
		<div class="large-12 breadcrumbs-holder"><?php get_template_part('breadcrumbs'); ?></div>
	
	</div>			
	
	
</header>

<div id="site-menu-mobile">

	<?php get_template_part('header','mobile'); ?>

</div>