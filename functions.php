<?php

function buntu_enqueue_styles() {

    wp_enqueue_style( 'stargazer-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'buntu-style', get_stylesheet_directory_uri() . '/style.css', array('stargazer-style') );

}

add_action( 'wp_enqueue_scripts', 'buntu_enqueue_styles' );

function buntu_theme_setup() {

}

add_action( 'after_setup_theme', 'buntu_theme_setup', 11 );

function buntu_color_primary_default( $color ) {
    $color = '230d5b';
    return $color;
}

add_filter( 'theme_mod_color_primary', 'buntu_color_primary_default' );
