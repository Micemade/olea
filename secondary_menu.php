<?php
/**
 *	Template part to display secondary menu and/or languages selector in header.
 *
 *	@since olea 1.0
 */

/**
 *  WMPL support:
 */
global $olea_woo_is_active;

$lang_sel = apply_filters( "olea_options", "lang_sel", false );

if ( function_exists('as_languages_list') && $lang_sel  ) { 
	as_languages_list();
}
?>
<?php if ( has_nav_menu( 'secondary' ) ) { ?>
<nav id="secondary-nav">

	<?php 
	$walker = new My_Walker;
	wp_nav_menu( array( 
			'theme_location'	=> 'secondary',
			//'menu'			=> 'Main menu',
			'walker'			=>$walker,
			'link_before'		=>'',
			'link_after'		=>'',
			'menu_class'		=> 'navigation secondary',
			'container'			=> false 
			) 
		);
	?>
	
</nav>
<?php } ?>