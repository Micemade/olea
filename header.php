<!DOCTYPE html>
<?php 
//  GLOBAL OPTIONS DATA
global $olea_woo_is_active;
//
?>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->

<!--[if !(IE 8) | !(IE 9)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,IE=10, chrome=1"><![endif]-->

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>

<?php
function body_layout($classes) {
	
	$orientation = apply_filters( "olea_options", "orientation", "horizontal" );
	
	if( $orientation == 'horizontal' ) {
		$class = 'horizontal-layout';
	}else{
		$class = 'vertical-layout';
	}
	$classes[] = $class;
	return $classes;
}
add_filter('body_class', 'body_layout');
?>


<?php wp_head(); ?>

</head>


<body <?php body_class();?> id="body">

<div id="bodywrap">

<?php 
/* #bodywrap is used to fix foundation tooltips 
 * div is referenced in as_custom.js for vertical layout - sub and mega menus position
 */
?>

<?php 
##  SIMPLE HORIZONTAL HEADER / PRELOADER / DEMO MODE
$orientation		= apply_filters( "olea_options", "orientation", 'horizontal' );
$predefined_headers = apply_filters( "olea_options", "predefined_headers", '01' );
$use_preloader		= apply_filters( "olea_options", "use_preloader", false );
$demo_mode			= apply_filters( "olea_options", "demo_mode", false );

if( $orientation  == 'horizontal' && $predefined_headers == 'simple' ) {
	echo '<div id="st-container" class="st-container">';
}
if( $use_preloader || $predefined_headers == 'simple' ) { 
	echo '<div id="dvLoading"></div>';
} 
if( $demo_mode ) {
	get_template_part('theme_demo_switcher');
	require_once( get_template_directory() . '/theme_demo_vars.php');
}
?>

	<?php
	
	/**
	 *	HEADER AND MENU ORIENTATION:
	 */
	$header = apply_filters( "olea_options", "orientation", "horizontal" );
		
	if( $header == 'horizontal' ){
		
		$predef_head = apply_filters( "olea_options", "predefined_headers", '01' );
		
		get_template_part( 'header','horizontal_'.$predef_head );
		
		$page_layout = ' horizontal';
		
	}elseif( $header == 'vertical' ) {
	
		get_template_part('header','vertical');
		
		$page_layout = ' vertical';
	}	
	
	/**
	 *	SETTINGS FOR FIXED HEADER OPTION
	 *  var global $post
	 */
	global $post;
	if( $post ) {
	
		$page_under_head = get_post_meta( $post->ID,'as_page_under_head' );
		$page_under_head_class	= ( $page_under_head && is_singular() ) ? ' page-under-head' : '';
		
	}else{
		$page_under_head_class = '';
	}
	?>
	
	
	<div id="page" class="page<?php echo esc_attr($page_layout); echo esc_attr($page_under_head_class); ?>">
	
	<?php if( $header == 'vertical' ) { ?>
	<div class="row">
	
		<?php $if_sec_menu = has_nav_menu( 'secondary' ) ? '6' : '12' ?>
		
		<div class="small-<?php echo esc_attr($if_sec_menu); ?> column breadcrumbs-holder">
		
			<?php
			$lang_sel = apply_filters( "olea_options", "lang_sel", false );
			if ( function_exists('as_languages_list') && $lang_sel  ) { 
				as_languages_list();
			}
			?>
			
			<?php get_template_part('breadcrumbs'); ?>
		
		</div>
		
		<div class="small-6 column" style="float: right !important;">
		
		<?php		
		if ( has_nav_menu( 'secondary' ) ) { 
			get_template_part('secondary_menu');
		}
		?>
		</div>
		
	</div>
	<?php } ?>
	
	<?php
	// IF CURRENT PAGE IS SHOP PAGE
	if( $olea_woo_is_active ) {
		$is_shop = ( is_shop() ||  is_cart() || is_checkout() || is_account_page()) ? true : false ;
	}else{
		$is_shop = false;
	}
	
	// DISPLAY PREV / NEXT POST ON SINGULAR PAGES
	if( $post ) {
		$hide_single_nav = get_post_meta( $post->ID,'as_hide_single_nav' );
		if( is_singular() && ! is_home() && !$hide_single_nav  && !$is_shop ) {
			echo as_prev_next_post();
		}
	}
?>