<?php
/**
 * The Sidebar containing the main widget area.
 */

$layout			= apply_filters( "olea_options", "layout", "float_left" );
$empty_sidebar	= apply_filters( "olea_options", "empty_sidebar_meta", "empty_notice" );
?>

<?php if( $layout != 'full_width' ) { ?>

<span class="large-offset-<?php echo $layout == 'float_left' ? '8' : '3' ?> sections-border<?php echo $layout == 'float_right' ? ' float_left' : null ?>"></span>

<?php }; ?>


<div id="secondary" class="widget-area large-<?php echo ( $layout == 'full_width' ) ? '12' : '4'?>  medium-12 small-12 <?php echo $layout == 'float_right' ? ' float_left' : null ?>" role="complementary">
	
	
	
	<?php if ( ! dynamic_sidebar( 'sidebar' ) )  { 

		if( $empty_sidebar == 'meta_login' ) { ?>
		
		<aside id="meta" class="widget">
		
			<h4 class="widget-title"><?php esc_html_e( 'Meta', 'olea' ); ?></h4>
			<ul>
				<?php wp_register(); ?>
				<aside><?php wp_loginout(); ?></aside>
				<?php wp_meta(); ?>
			</ul>
			
		</aside>
		
	<?php
		
		}elseif( $empty_sidebar == 'empty_notice' ){
		
			echo '<aside class="widget"><p class="empty-sidebar">'. esc_html__("You haven't set any widget for Sidebar. Please, add some widgets or choose Full width page in theme options or page custom meta settings.",'olea') .'</p></aside>';
		
		}
		?>

	<?php }; // end sidebar widget area ?>
	
	
</div><!-- #secondary .widget-area -->

<div class="clearfix"></div>	