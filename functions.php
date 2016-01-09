<?php

function buntu_enqueue_styles() {

    wp_enqueue_style( 'stargazer-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'buntu-style', get_stylesheet_directory_uri() . '/style.css', array('stargazer-style') );

}

add_action( 'wp_enqueue_scripts', 'buntu_enqueue_styles' );

function buntu_theme_setup() {

    unregister_default_headers( array(
        'horizon',
        'orange-burn',
        'planet-burst',
        'space-splatters',
    ) );

}

add_action( 'after_setup_theme', 'buntu_theme_setup', 99 );

function buntu_color_primary_default( $color ) {
    $color = '230d5b';
    return $color;
}

add_filter( 'theme_mod_color_primary', 'buntu_color_primary_default' );

function buntu_custom_header() {

    add_theme_support(
        'custom-header',
        array(
            'default-image'          => '%s/images/headers/planets-blue.jpg',
            'random-default'         => false,
            'width'                  => 1175,
            'height'                 => 400,
            'flex-width'             => true,
            'flex-height'            => true,
            'default-text-color'     => '252525',
            'header-text'            => true,
            'uploads'                => true,
            'wp-head-callback'       => 'stargazer_custom_header_wp_head'
        )
    );

}

add_action( 'after_setup_theme', 'buntu_custom_header' );
