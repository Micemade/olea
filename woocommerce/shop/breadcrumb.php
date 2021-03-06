<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $wp_query, $delimiter;

$prepend      = '';
$permalinks   = get_option( 'woocommerce_permalinks' );
$shop_page_id = wc_get_page_id( 'shop' );
$shop_page    = get_post( $shop_page_id );
$breadcrumb_html = "";

// If permalinks contain the shop page in the URI prepend the breadcrumb with shop
if ( $shop_page_id && strstr( $permalinks['product_base'], '/' . $shop_page->post_name ) && get_option( 'page_on_front' ) !== $shop_page_id ) {
	$prepend = $before . '<a href="' . get_permalink( $shop_page ) . '">' . $shop_page->post_title . '</a> ' . $after . $delimiter;
}

if ( ( ! is_home() && ! is_front_page() && ! ( is_post_type_archive() && get_option( 'page_on_front' ) == wc_get_page_id( 'shop' ) ) ) || is_paged() ) {

	$breadcrumb_html .= $wrap_before;

	if ( ! empty( $home ) ) {
		$breadcrumb_html .= $before . '<a class="home" href="' . apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) . '">' . $home . '</a>' . $after . $delimiter;
	}

	if ( is_category() ) {

		$cat_obj = $wp_query->get_queried_object();
		$this_category = get_category( $cat_obj->term_id );

		if ( $this_category->parent != 0 ) {
			$parent_category = get_category( $this_category->parent );
			$breadcrumb_html .= get_category_parents($parent_category, TRUE, $delimiter );
		}

		$breadcrumb_html .= $before . single_cat_title( '', false ) . $after;

	} elseif ( is_tax('product_cat') ) {

		$breadcrumb_html .= $prepend;

		$current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

		$ancestors = array_reverse( get_ancestors( $current_term->term_id, get_query_var( 'taxonomy' ) ) );

		foreach ( $ancestors as $ancestor ) {
			$ancestor = get_term( $ancestor, get_query_var( 'taxonomy' ) );

			$breadcrumb_html .= $before .  '<a href="' . get_term_link( $ancestor->slug, get_query_var( 'taxonomy' ) ) . '">' . esc_html( $ancestor->name ) . '</a>' . $after . $delimiter;
		}

		$breadcrumb_html .= $before . esc_html( $current_term->name ) . $after;

	} elseif ( is_tax('product_tag') ) {

		$queried_object = $wp_query->get_queried_object();
		$breadcrumb_html .= $prepend . $before . __( 'Products tagged &ldquo;', 'olea' ) . $queried_object->name . '&rdquo;' . $after;

	} elseif ( is_day() ) {

		$breadcrumb_html .= $before . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $after . $delimiter;
		$breadcrumb_html .= $before . '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $after . $delimiter;
		$breadcrumb_html .= $before . get_the_time('d') . $after;

	} elseif ( is_month() ) {

		$breadcrumb_html .= $before . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $after . $delimiter;
		$breadcrumb_html .= $before . get_the_time('F') . $after;

	} elseif ( is_year() ) {

		$breadcrumb_html .= $before . get_the_time('Y') . $after;

	} elseif ( is_post_type_archive('product') && get_option('page_on_front') !== $shop_page_id ) {

		$_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';

		if ( ! $_name ) {
			$product_post_type = get_post_type_object( 'product' );
			$_name = $product_post_type->labels->singular_name;
		}

		if ( is_search() ) {

			$breadcrumb_html .= $before . '<a href="' . get_post_type_archive_link('product') . '">' . $_name . '</a>' . $delimiter . __( 'Search results for &ldquo;', 'olea' ) . get_search_query() . '&rdquo;' . $after;

		} elseif ( is_paged() ) {

			$breadcrumb_html .= $before . '<a href="' . get_post_type_archive_link('product') . '">' . $_name . '</a>' . $after;

		} else {

			$breadcrumb_html .= $before . $_name . $after;

		}

	} elseif ( is_single() && ! is_attachment() ) {

		if ( get_post_type() == 'product' ) {

			$breadcrumb_html .= $prepend;

			if ( $terms = wp_get_post_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {

				$main_term = $terms[0];

				$ancestors = get_ancestors( $main_term->term_id, 'product_cat' );

				$ancestors = array_reverse( $ancestors );

				foreach ( $ancestors as $ancestor ) {
					$ancestor = get_term( $ancestor, 'product_cat' );

					$breadcrumb_html .= $before . '<a href="' . get_term_link( $ancestor->slug, 'product_cat' ) . '">' . $ancestor->name . '</a>' . $after . $delimiter;
				}

				$breadcrumb_html .= $before . '<a href="' . get_term_link( $main_term->slug, 'product_cat' ) . '">' . $main_term->name . '</a>' . $after . $delimiter;

			}

			$breadcrumb_html .= $before . esc_html( strip_tags( get_the_title() ) ) . $after;

		} elseif ( get_post_type() != 'post' ) {

			$post_type = get_post_type_object( get_post_type() );
			$slug = $post_type->rewrite;
				$breadcrumb_html .= $before . '<a href="' . get_post_type_archive_link( get_post_type() ) . '">' . $post_type->labels->singular_name . '</a>' . $after . $delimiter;
			$breadcrumb_html .= $before . esc_html( strip_tags( get_the_title() ) ) . $after;

		} else {

			$the_category = get_the_category();
			$cat = current( $the_category );
			$breadcrumb_html .= get_category_parents( $cat, true, $delimiter );
			$breadcrumb_html .= $before . esc_html( strip_tags( get_the_title() ) ) . $after;

		}

	} elseif ( is_404() ) {

		$breadcrumb_html .= $before . __( 'Error 404', 'olea' ) . $after;

	} elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' ) {

		$post_type = get_post_type_object( get_post_type() );

		if ( $post_type )
			$breadcrumb_html .= $before . $post_type->labels->singular_name . $after;

	} elseif ( is_attachment() ) {

		$parent = get_post( $post->post_parent );
		$cat = get_the_category( $parent->ID );
		$cat = $cat[0];
		$breadcrumb_html .= get_category_parents( $cat, true, '' . $delimiter );
		$breadcrumb_html .= $before . '<a href="' . get_permalink( $parent ) . '">' . $parent->post_title . '</a>' . $after . $delimiter;
		$breadcrumb_html .= $before . esc_html( strip_tags( get_the_title() ) ) . $after;

	} elseif ( is_page() && !$post->post_parent ) {

		$breadcrumb_html .= $before . esc_html( strip_tags( get_the_title() ) ) . $after;

	} elseif ( is_page() && $post->post_parent ) {

		$parent_id  = $post->post_parent;
		$breadcrumbs = array();

		while ( $parent_id ) {
			$page = get_page( $parent_id );
			$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title( $page->ID ) . '</a>';
			$parent_id  = $page->post_parent;
		}

		$breadcrumbs = array_reverse( $breadcrumbs );

		foreach ( $breadcrumbs as $crumb )
			$breadcrumb_html .= $crumb . '' . $delimiter;

		$breadcrumb_html .= $before . esc_html( strip_tags( get_the_title() ) ) . $after;

	} elseif ( is_search() ) {

		$breadcrumb_html .= $before . __( 'Search results for &ldquo;', 'olea' ) . get_search_query() . '&rdquo;' . $after;

	} elseif ( is_tag() ) {

			$breadcrumb_html .= $before . __( 'Posts tagged &ldquo;', 'olea' ) . single_tag_title('', false) . '&rdquo;' . $after;

	} elseif ( is_author() ) {

		$userdata = get_userdata($author);
		$breadcrumb_html .= $before . __( 'Author:', 'olea' ) . ' ' . $userdata->display_name . $after;

	}

	if ( get_query_var( 'paged' ) )
		$breadcrumb_html .= ' (' . __( 'Page', 'olea' ) . ' ' . get_query_var( 'paged' ) . ')';

	$breadcrumb_html .= $wrap_after;
	
	echo wp_kses_post($breadcrumb_html);

}