<?php
/**
 *	Template part: Header Horizontal  05
 *	horizontal template for header
 */
global $olea_woo_is_active;

##  IF SIMPLE HORIZONTAL HEADER IS SELECTED
$orientation		= apply_filters( "olea_options", "orientation", "horizontal" );
$predefined_headers = apply_filters( "olea_options", "predefined_headers", "01" );
if( $orientation == 'horizontal' && $predefined_headers == 'simple' ) {
?>
<div class="st-content">
<?php } ?>

<header id="site-menu" class="horizontal header-template-05">
	
	
	<div class="row clearfix topbar">
		
		<div class="large-6 columns">
		
			<?php get_template_part('secondary_menu'); ?>
						
		</div>
		
		<div class="large-6 columns">
		
			<?php get_template_part('topbar'); ?>
		
		</div>
		
		<div class="large-12 columns">
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
	

	<span class="topbar-toggle icon-angle-down"></span>
	
	
	<div class="row clearfix" style="padding: 1rem 0;" data-equalizer>

		<div id="site-title" class="large-3 columns vertical-align" data-equalizer-watch>
				
			<div class="vertical-middle">
			
			<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> | <?php bloginfo( 'description' );?>" rel="home" class="home-link">
			
			<?php do_action( 'olea_logo' ); ?>
			
			</a>
					
			</div>
			
		</div>
	

		<div class="large-9 columns vertical-align" style="position: relative;"  data-equalizer-watch>
			
			<div class="vertical-middle">
				
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
						'menu_class'		=> 'navigation to-stick horizontal',
						'container'			=> false
						) 
					);
				?>
				</nav>
			</div><!-- .vertical-middle -->
			
			<div class="vertical-middle">
				<?php 
				if ( $olea_woo_is_active ) { 
				
					get_template_part("woocommerce/headercart");
				 
				} // endif $olea_woo_is_active 
				?>

			
			</div><!-- .vertical-middle -->
			
		</div>
		
		
		<div class="clearfix"></div>

	</div>
	
	
	<div class="clearfix"></div>
	
	<div class="row">
	
		<div class="large-12 column breadcrumbs-holder"><?php get_template_part('breadcrumbs'); ?></div>
	
	</div>
	
	
</header>

<div id="site-menu-mobile">

	<?php get_template_part('header','mobile'); ?>

</div>