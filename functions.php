<?php

function buntu_enqueue_styles() {

    wp_enqueue_style( 'stargazer-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'buntu-style', get_stylesheet_directory_uri() . '/style.css', array('stargazer-style') );
    wp_enqueue_script( 'buntu-custom', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ), '1.0.0', true );

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
            'default-text-color'     => '230d5b',
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

if ( ! function_exists( 'buntu_add_goto_top' ) ) :

    /**
     * Go to top.
     *
     * @since 1.0.0
     */
    function buntu_add_goto_top() {

        echo '<a href="#container" class="scrollup" id="btn-scrollup"><span class="screen-reader-text">' . __( 'Go to top', 'buntu' ) . '</span></a>';

    }

endif;

add_action( 'wp_footer', 'buntu_add_goto_top' );
