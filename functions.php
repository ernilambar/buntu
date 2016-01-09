<?php

add_action( 'wp_enqueue_scripts', 'buntu_enqueue_styles' );

function buntu_enqueue_styles() {

    wp_enqueue_style( 'stargazer-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'buntu-style', get_stylesheet_directory_uri() . '/style.css', array('stargazer-style') );

}
