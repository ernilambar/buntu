<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Buntu
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function buntu_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'buntu_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function buntu_jetpack_setup
add_action( 'after_setup_theme', 'buntu_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function buntu_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function buntu_infinite_scroll_render
