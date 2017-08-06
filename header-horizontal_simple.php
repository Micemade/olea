<?php
/**
 *	Template part: Header Horizontal  04
 *	horizontal template for header
 */
global $olea_woo_is_active;

$anim = apply_filters( "olea_options", "min_header_anim", "1" );
?>


<?php if( $anim == '3' || $anim == '6' || $anim == '7' || $anim == '8' || $anim == '14' ) {
	echo '<div class="st-pusher">';
}
?>
<nav class="st-menu st-effect-<?php echo esc_attr($anim); ?>" id="menu-<?php echo esc_attr($anim); ?>">

	<div class="clearfix"></div>
	
	
	<nav id="main-nav-wrapper" class="large-12 column side-subs">
	<?php 
	$walker = new My_Walker;
	wp_nav_menu( array( 
			'theme_location'	=> 'main-horizontal',
			//'menu'			=> 'Main menu',
			'walker'			=> $walker,
			'link_before'		=> '',
			'link_after'		=>'',
			'menu_id'			=> 'main-nav',
			'menu_class'		=> 'navigation ',
			'container'			=> false
			) 
		);
	?>
	</nav>
	
	<div class="small-12 column">
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
			
	<div class="large-12 column">
	
		<?php get_template_part('secondary_menu'); ?>
					
	</div>
	
	<div class="large-12 column">
	
		<?php get_template_part('topbar'); ?>
		
	</div>	
	
</nav>


<?php if( $anim == '1' || $anim == '2' || $anim == '4' || $anim == '5' || $anim == '9' || $anim == '10' || $anim == '11' || $anim == '12' || $anim == '13' ) {
	echo '<div class="st-pusher">';
}
?>



<div class="st-content">

<header id="site-menu" class="horizontal header-template-simple">
	
	
	<div class="row clearfix" data-equalizer>

		<div class="vertical-align">
		
			<div class="vertical-middle">
			
				<div class="small-1 columns" style="position: relative;"  id="st-trigger-effects" data-equalizer-watch>

					<a data-effect="st-effect-<?php echo esc_attr('olea'); ?>" class="icon-menu sidemenu-toggler to-stick" href=""></a>
					
				</div>
			
			</div><!-- .vertical-middle -->	
			
			
			<div class="vertical-middle">
		
				<div id="site-title" class="small-9 columns" data-equalizer-watch>
				
				<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> | <?php bloginfo( 'description' );?>" rel="home" class="home-link">
				
				<?php do_action( 'olea_logo' ); ?>
				
				</a>

				</div>
				
			</div><!-- .vertical-middle -->	
		
		<div class="vertical-middle">
		
		<?php 
		if ( $olea_woo_is_active ) { 
		
			echo '<div class="small-2 column" style="float: right;" data-equalizer-watch>';
			
			get_template_part("woocommerce/headercart");
			
			echo '</div>';
		 
		} // endif $olea_woo_is_active 
		?>
		
		<div class="clearfix"></div>

		</div><!-- .vertical-middle -->	
		
	</div><!-- .vertical-align -->	
	
	<div class="clearfix"></div>
	
	<div class="row">
	
		<div class="large-12 column breadcrumbs-holder"><?php get_template_part('breadcrumbs'); ?></div>
	
	</div>		
	

</header>