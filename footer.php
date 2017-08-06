<?php
/**
 *	The Footer template.
 *
 *	@since olea 1.0
 */
?>

</div><!-- end #page -->

<?php
/**
*	HEADER AND MENU ORIENTATION:
*/
$orientation		= apply_filters( "olea_options", "orientation", "horizontal" );
$predefined_headers = apply_filters( "olea_options", "predefined_headers", "01" );
if( $orientation == 'vertical' ) {
	$page_layout = ' vertical';
}else{
	$page_layout = ' horizontal';
}
?>
	
	<?php if ( is_active_sidebar( 'bottom-page-widgets' ) ) { ?>
	<div class="row border-top">
		
		<div class="bottom-widgets">
	
		<?php dynamic_sidebar( 'bottom-page-widgets' );	?>
	
		<div class="clearfix"></div>
		
		</div>
		
	</div>
	<?php } ?>
	
	<footer id="footer" class="<?php echo esc_attr($page_layout); ?>">
	
		<?php // FOOTER WIDGETS //////////////////////////////// ?>
		
		<?php if ( is_active_sidebar( 'footer-widgets-1' ) || is_active_sidebar( 'footer-widgets-2' ) || is_active_sidebar( 'footer-widgets-3' ) ) : ?>

			<div id="footerwidgets">
				
				<div class="row border-bottom">		
										
					<?php 
					if ( is_active_sidebar( 'footer-widgets-1' ) ) {
						echo '<div>';
						dynamic_sidebar( 'footer-widgets-1' ); 
						echo '</div>';
					}
					if ( is_active_sidebar( 'footer-widgets-2' ) ){
						echo '<div>';
						dynamic_sidebar( 'footer-widgets-2' ); 
						echo '</div>';
					}		
					if ( is_active_sidebar( 'footer-widgets-3' ) ) {
						echo '<div>';
						dynamic_sidebar( 'footer-widgets-3' ); 
						echo '</div>';
					}
					if ( is_active_sidebar( 'footer-widgets-4' ) ) {
						echo '<div>';
						dynamic_sidebar( 'footer-widgets-4' ); 
						echo '</div>';
					}	
					?>
							
				</div><!-- / .row -->
			
			</div>

			<div class="row"><div class="footer-border clearfix small-12"></div></div>
		
		<?php endif; ?>
		
		<div class="credits">
		
			<div class="row">
				
				<?php if ( apply_filters( "olea_options", "footer_text", "" ) ) {
					
					echo esc_html( apply_filters( "olea_options", "footer_text", "" ) );

				}else{?>
				
					<p>&copy; <?php bloginfo('blog_url'); ?> <?php echo get_bloginfo('description') ? ' | '. get_bloginfo('description') : ''; ?></p>
				
				<?php }; // endif ?>
			
			</div> <!-- /row -->
		</div>
		
	</footer>

<?php 
// SOME WOOCOMMERCE STUFF:
global $woocommerce, $olea_woo_is_active;

if( $olea_woo_is_active ) {

	if( function_exists( 'wc_notice_count' ) ) {
		
		if( wc_notice_count() ) {
			echo '<div class="theme-shop-message">';
			do_action( 'woocommerce_before_single_product' );
			echo '</div>';
		}
		
	}else{
		// backward  < 2.1 compatibility:
		if( $woocommerce->error_count() > 0 || $woocommerce->message_count() > 0 ) {
			echo '<div class="theme-shop-message">';
			do_action( 'woocommerce_before_single_product' );
			echo '</div>';
		}
	}
	
}
?>

<a href="#0" class="to-top icon-chevron-small-up" title="<?php esc_attr_e('Top','olea'); ?>"></a>

<div class="active-mega arrow-left"><span class="arrow-left"></span><span class="arrow-left second"></span></div>

<?php 
##  IF SIMPLE HORIZONTAL HEADER IS SELECTED
if( $orientation == 'horizontal' && $predefined_headers == 'simple' ) {?>
</div><!-- .st-content -->

</div><!-- .st-pusher -->

</div><!-- #st-container -->
<?php } ?>

<div class="clearfix"></div>

</div><!-- end .bodywrap -->

<?php wp_footer(); ?>

</body>

</html>