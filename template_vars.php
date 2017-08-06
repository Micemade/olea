<?php 
/**
 *	The template part used for vars.
 *
 *	@since olea 1.0
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//
// ENTER ANIMATION FOR ARTICLES
$archive_enteranim	= apply_filters( "olea_options", "post_enter_anim_archive", "fadeIn" );
$tax_enteranim		= apply_filters( "olea_options", "post_enter_anim_tax", "fadeIn" );
$enter_anim			= $archive_enteranim ? $archive_enteranim : $tax_enteranim;
//
// FEATURED IMAGES SIZE
$fimg_size		= apply_filters( "olea_options", "blog_fetured_img_size",  array() );
$fimg_width		= isset( $fimg_size['Width']) ? $fimg_size['Width'] : null;
$fimg_height	= isset( $fimg_size['Height']) ? $fimg_size['Height'] : null;
?>