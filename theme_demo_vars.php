<?php
/**
 *	HEADER ORIENTATION
 *
 */
if( isset($_GET['demo_orientation']) ) {
	if( $_GET['demo_orientation'] == 'horizontal') {
		$as_of['orientation'] = 'horizontal';
	}elseif($_GET['demo_orientation'] == 'vertical'){
		$as_of['orientation'] = 'vertical';
	}
}

/**
 *	HEADER TYPES
 *
 */
if( isset($_GET['predefined_headers']) ) {
	$as_of['predefined_headers'] = $_GET['predefined_headers'];
}

if( isset($_GET['min_header_anim']) ) {
	$as_of['min_header_anim'] =$_GET['min_header_anim'];
}

/**
 *	SHOP
 *
 */
// 4 COLUMNS IN CATALOG
if( isset($_GET['catalog_num'])  ) {

	if( $_GET['catalog_num'] == '3_columns' ) {
		$as_of['products_page_settings']['Products columns'] = 3;
	}
}
if( isset($_GET['catalog_num'])  ) {

	if( $_GET['catalog_num'] == '4_columns' ) {
		$as_of['products_page_settings']['Products columns'] = 4;
	}
}
if( isset($_GET['catalog_num'])  ) {

	if( $_GET['catalog_num'] == '5_columns' ) {
		$as_of['products_page_settings']['Products columns'] = 5;
	}
}
if( isset($_GET['catalog_num'])  ) {

	if( $_GET['catalog_num'] == '6_columns' ) {
		$as_of['products_page_settings']['Products columns'] = 6;
	}
}
// FULL WIDTH IN SINGLE PRODUCT PAGE
if( isset($_GET['single_full_width'])  ) {

	if( $_GET['single_full_width'] == true ) {
		$as_of['single_full_width'] = true;
	}
}
// DIFFERENT SINGLE PRODUCT IMAGE - MAGNIFIER
if( isset($_GET['single_product_images'])  ) {

	if( $_GET['single_product_images'] == 'magnifier' ) {
		$as_of['single_product_images'] = 'magnifier';
	}
}
/**
 *	THEME SKINS
 *
 
if( isset($_GET['demo_theme_skin'])  ) {

	$as_of['theme_skin'] = $_GET['demo_theme_skin'];

}*/
?>