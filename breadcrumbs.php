<?php
/**
 *	Template part to display breadcrumbs.
 *
 *	@since olea 1.0
 */
global  $olea_woo_is_active;

if( apply_filters( "olea_options", "show_breadcrumbs", true ) && !is_home() ) {
	
	$post_type = get_post_type();
		
	if( $olea_woo_is_active ) {
		$is_shop = ( is_shop() || is_woocommerce() || is_cart() || is_checkout()) ? true : false ;
	}else{
		$is_shop = false;
	}
	
	if ( $post_type != 'product' && !$is_shop ) {
	
		if (function_exists('dimox_breadcrumbs')  ) {					
			
			dimox_breadcrumbs();
		}
	}else{
	
		do_action('woocommerce_before_main_content'); // to hook woocommerce breadcrumb
	
	}
}

/**
 *  WMPL support:
 */
$lang_sel = apply_filters( "olea_options", "lang_sel", false );
if ( function_exists('as_languages_list') && $lang_sel  ) { 
	as_languages_list();
}
?>
<?php if( apply_filters( "olea_options", "demo_mode", false ) ) { ?>
<div id="language_list">
<ul>
	<?php
	$flag_en = get_template_directory_uri() .'/img/demo_flag_en.png';
	$flag_it = get_template_directory_uri() .'/img/demo_flag_it.png';
	?>
	<li><img src="<?php echo esc_attr($flag_en);?>" height="12" alt="en" width="18"></li>
	<li><a href="#"><img src="<?php echo esc_attr($flag_it);?>" height="12" alt="it" width="18"></a></li>
</ul>
</div>
<?php } ?>