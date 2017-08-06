<?php
/**
 *	The template part used for displaying header top ba.
 *
 *	@since olea 1.0
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$info_items = apply_filters( "olea_options", "topbar_info", array() );
if( count($info_items) ) {
	echo '<div class="table" style="height: 100%;">';
	echo '<div class="topbar-info">';
	foreach ( $info_items as $item ) {
		
		$toggle = !empty($item['toggle']) ? ' toggle' : '';
		
		echo '<div class="topbar-info-item">';
		
		echo $item['link'] ? '<a href="'. esc_url( $item['link'] ).'" title="'. esc_attr( $item['title'] ) .'" target="_blank">' : null;
		echo $item['icon'] ? '<span class="'. esc_attr( $item['icon'] ) . ' icon'. esc_attr( $toggle ) .'"></span>' : null;
		echo $item['title'] ? '<span class="title'. esc_attr($toggle) .'">'. esc_html( $item['title'] ).'</span>' : null;
		echo $item['link'] ? '</a>' : null;
		echo '</div>';
		
		
	}
	echo '</div>';
	echo '</div>';
}
?>