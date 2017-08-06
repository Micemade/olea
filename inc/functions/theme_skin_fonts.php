<?php
$protocol = apply_filters( 'olea_is_ssl','');;
$theme_skin = apply_filters( "olea_options", "theme_skin", "narrow_red_rustic.php" );

if( $theme_skin == 'montserrat.php' ) {
	// HEADINGS & BODY
	wp_register_style('theme-skin-headings-font', $protocol . '://fonts.googleapis.com/css?family=Montserrat:300,400,600,700,800,400italic,700italic&subset=latin,latin-ext'  );

}elseif( $theme_skin == 'playfair.php' ) {
	// HEADINGS 
	wp_register_style('theme-skin-headings-font', $protocol .  '://fonts.googleapis.com/css?family=Playfair+Display:300,400,600,700,800,400italic,700italic&subset=latin,latin-ext'  );
	// BODY
	wp_register_style('theme-skin-body-font', $protocol .  '://fonts.googleapis.com/css?family=Lato:300,400,600,700,800,400italic,700italic&subset=latin,latin-ext'  );
	
}elseif( $theme_skin == 'rose_sorts_mill_goudy.php' ) {
	// HEADINGS 
	wp_register_style('theme-skin-headings-font', $protocol . '://fonts.googleapis.com/css?family=Sorts+Mill+Goudy:300,400,600,700,800,400italic,700italic&subset=latin,latin-ext'  );
	// BODY
	wp_register_style('theme-skin-body-font', $protocol .  '://fonts.googleapis.com/css?family=Dosis:300,400,600,700,800,400italic,700italic&subset=latin,latin-ext'  );
	
}elseif( $theme_skin == 'open_sans_light.php' ) {
	// HEADINGS 
	wp_register_style('theme-skin-headings-font', $protocol .  '://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800,400italic,700italic&subset=latin,latin-ext'  );
	// BODY
	wp_register_style('theme-skin-body-font', $protocol .  '://fonts.googleapis.com/css?family=Cabin:300,400,600,700,800,400italic,700italic&subset=latin,latin-ext'  );
	
}elseif( $theme_skin == 'narrow_titles.php' ) {
	// HEADINGS 
	wp_register_style('theme-skin-headings-font', $protocol .  '://fonts.googleapis.com/css?family=Fjalla+One:300,400,600,700,800,400italic,700italic&subset=latin,latin-ext'  );
	// BODY
	wp_register_style('theme-skin-body-font', $protocol .  '://fonts.googleapis.com/css?family=Raleway:300,400,600,700,800,400italic,700italic&subset=latin,latin-ext'  );
	
}elseif( $theme_skin == 'narrow_red_rustic.php' ) {
	// HEADINGS 
	wp_register_style('theme-skin-headings-font', $protocol .  '://fonts.googleapis.com/css?family=Crushed:300,400,600,700,800,400italic,700italic&subset=latin,latin-ext'  );
	// BODY
	wp_register_style('theme-skin-body-font', $protocol .  '://fonts.googleapis.com/css?family=Lato:300,400,600,700,800,400italic,700italic&subset=latin,latin-ext'  );
}
wp_enqueue_style( 'theme-skin-headings-font' );
wp_enqueue_style( 'theme-skin-body-font' );
?>