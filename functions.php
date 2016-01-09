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

add_action( 'after_setup_theme', 'buntu_theme_setup', 20 );

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

function buntu_background_color( $color ) {
    $color = '6b269d';
    return $color;
}

add_filter( 'theme_mod_background_color', 'buntu_background_color' );

function buntu_register_menus() {

    register_nav_menu( 'primary',   _x( 'Primary',   'nav menu location', 'buntu' ) );
    register_nav_menu( 'secondary', _x( 'Secondary', 'nav menu location', 'buntu' ) );
    register_nav_menu( 'footer',    _x( 'Footer',    'nav menu location', 'buntu' ) );
    register_nav_menu( 'social',    _x( 'Social',    'nav menu location', 'buntu' ) );

}

add_action( 'init', 'buntu_register_menus', 1 );
