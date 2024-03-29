<?php

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Defines compatibility functions with previous versions
 *
 * Created by impleCode.
 * Date: 10-Mar-15
 * Time: 12:49
 * Package: compatibility.php
 */
function product_adder_theme_check_notice() {
	// Necessary for extensions before v2.7.4 to work
}

add_action( 'init', 'ic_start_compatibility' );

function ic_start_compatibility() {
	/* $first_version = (string) get_option( 'first_activation_version' );
	  if ( version_compare( $first_version, '2.2.0' ) < 0 ) {
	  add_filter( 'get_product_short_description', 'compatibility_product_short_description', 10, 2 );
	  add_filter( 'get_product_description', 'compatibility_product_description', 10, 2 );
	  }
	 *
	 */

	add_filter( 'get_product_short_description', 'compatibility_product_short_description', 10, 2 );
	add_filter( 'get_product_description', 'compatibility_product_description', 10, 2 );
}

function compatibility_product_short_description( $product_desc, $product_id ) {
	if ( empty( $product_desc ) ) {
		$old_desc = get_post_meta( $product_id, '_shortdesc', true );
		if ( !empty( $old_desc ) ) {
			if ( current_user_can( 'edit_products' ) ) {
				update_post_meta( $product_id, 'excerpt', $old_desc );
				delete_post_meta( $product_id, '_shortdesc' );
			}
			return $old_desc;
		} else {
			$excerpt = get_post_meta( $product_id, 'excerpt', true );
			return $excerpt;
		}
	}
	return $product_desc;
}

function compatibility_product_description( $product_desc, $product_id ) {
	if ( empty( $product_desc ) ) {
		$old_desc = get_post_meta( $product_id, '_desc', true );
		if ( !empty( $old_desc ) ) {
			if ( current_user_can( 'edit_products' ) ) {
				update_post_meta( $product_id, 'content', $old_desc );
				delete_post_meta( $product_id, '_desc' );
			}
			return $old_desc;
		} else {
			$content = get_post_meta( $product_id, 'content', true );
			return $content;
		}
	}
	return $product_desc;
}

add_action( 'before_product_page', 'set_product_page_image_html' );

/**
 * Sets product page image html if was modified by third party
 */
function set_product_page_image_html() {
	if ( has_filter( 'post_thumbnail_html' ) ) {
		add_filter( 'post_thumbnail_html', 'get_default_product_page_image_html', 1 );
		add_filter( 'post_thumbnail_html', 'product_page_image_html', 99 );
	}
}

/**
 * Inserts default thumbnail html to global
 * @global type $product_page_image_html
 * @param type $html
 * @return type
 */
function get_default_product_page_image_html( $html ) {
	global $product_page_image_html;
	$product_page_image_html = $html;
	return $html;
}

/**
 * Replaces the product page image HTML with the default
 *
 * @global type $product_page_image_html
 * @param type $html
 * @return \type
 */
function product_page_image_html( $html ) {
	if ( is_ic_product_page() ) {
		global $product_page_image_html;
		return $product_page_image_html;
	}
	return $html;
}

/**
 * Compatibility with PHP <5.3 for ic_lcfirst
 *
 * @param string $string
 * @return string
 */
function ic_lcfirst( $string ) {
	if ( ic_is_multibyte( $string ) ) {
		$firstChar	 = mb_substr( $string, 0, 1 );
		$then		 = mb_substr( $string, 1, null );
		return mb_strtolower( $firstChar ) . $then;
	} else if ( function_exists( 'lcfirst' ) ) {
		return lcfirst( $string );
	} else {
		$string[ '0' ] = strtolower( $string[ '0' ] );
		return $string;
	}
}

/**
 * Compatibility with PHP <5.3 for ic_ucfirst
 *
 * @param type $string
 * @return type
 */
function ic_ucfirst( $string ) {
	if ( ic_is_multibyte( $string ) ) {
		$firstChar	 = mb_substr( $string, 0, 1 );
		$then		 = mb_substr( $string, 1, null );
		return mb_strtoupper( $firstChar ) . $then;
	} else if ( function_exists( 'ucfirst' ) ) {
		return ucfirst( $string );
	} else {
		$string[ '0' ] = strtoupper( $string[ '0' ] );
		return $string;
	}
}

function ic_is_multibyte( $string ) {
	if ( function_exists( 'mb_check_encoding' ) ) {
		return !mb_check_encoding( $string, 'ASCII' ) && mb_check_encoding( $string, 'UTF-8' );
	}
	return false;
}

/**
 * Check if any post type has the same rewrite parameter
 *
 * @return boolean
 */
function ic_check_rewrite_compatibility() {
	$post_types	 = get_post_types( array( 'publicly_queryable' => true ), 'object' );
	$slug		 = $post_types[ 'al_product' ]->rewrite[ 'slug' ];
	foreach ( $post_types as $post_type => $type ) {
		if ( $post_type != 'al_product' && isset( $type->rewrite[ 'slug' ] ) ) {
			if ( $type->rewrite[ 'slug' ] == $slug || $type->rewrite[ 'slug' ] == '/' . $slug ) {
				return false;
			}
		}
	}
	return true;
}

/**
 * Check if any post type has the same rewrite parameter
 *
 * @return boolean
 */
function ic_check_tax_rewrite_compatibility() {
	$taxonomies = get_taxonomies( array( 'public' => true ), 'object' );
	if ( isset( $taxonomies[ 'al_product-cat' ] ) ) {
		$slug = $taxonomies[ 'al_product-cat' ]->rewrite[ 'slug' ];
		foreach ( $taxonomies as $taxonomy_name => $tax ) {
			if ( $taxonomy_name != 'al_product-cat' && isset( $tax->rewrite[ 'slug' ] ) ) {
				if ( $tax->rewrite[ 'slug' ] == $slug || $tax->rewrite[ 'slug' ] == '/' . $slug ) {
					return false;
				}
			}
		}
	}
	return true;
}

//compatiblity prev 2.7.5
function ic_get_product_image( $product_id, $size = 'full', $attributes = array() ) {
	$image_id = get_post_thumbnail_id( $product_id );
	if ( !empty( $image_id ) ) {
		$image = wp_get_attachment_image( $image_id, $size, false, $attributes );
	} else {
		$image = '<img alt="default-image" src="' . default_product_thumbnail_url() . '" >';
	}
	return $image;
}

add_action( 'ic_pre_get_products_search', 'ic_product_search_fix' );

function ic_product_search_fix( $query ) {
	if ( !empty( $_GET[ 'post_type' ] ) ) {
		$query->query_vars[ 'post_type' ] = is_array( $_GET[ 'post_type' ] ) ? array_map( 'esc_attr', $_GET[ 'post_type' ] ) : esc_attr( $_GET[ 'post_type' ] );
	}
}

function ic_get_terms( $params = array() ) {
	global $wp_version;
	$params = apply_filters( 'ic_get_terms_params', $params );
	if ( !isset( $params[ 'update_term_meta_cache' ] ) ) {
		$params[ 'update_term_meta_cache' ] = false;
	}
	if ( version_compare( $wp_version, 4.5 ) < 0 ) {
		if ( !empty( $params[ 'taxonomy' ] ) ) {
			$terms = get_terms( $params[ 'taxonomy' ], $params );
		}
	} else {
		$terms = get_terms( $params );
	}

	return $terms;
}

add_action( 'before_product_page', 'ic_restore_wpautop' );

/**
 * Some themes and plugins remove wpautoop so we readd it for the product pages
 */
function ic_restore_wpautop() {
	if ( !has_filter( 'the_content', 'wpautop' ) ) {
		add_filter( 'the_content', 'wpautop' );
	}
}

if ( !function_exists( 'ic_array_key_last' ) ) {

	function ic_array_key_last( $array ) {
		if ( function_exists( "array_key_last" ) ) {
			return array_key_last( $array );
		}
		if ( !is_array( $array ) || empty( $array ) ) {
			return NULL;
		}

		return array_keys( $array )[ count( $array ) - 1 ];
	}

}