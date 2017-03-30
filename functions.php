<?php

add_action( 'wp_enqueue_scripts', 'rm_theme_parent_theme_enqueue_styles' );

function rm_theme_parent_theme_enqueue_styles() {
    wp_enqueue_style( 'rm_theme-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'rm_respond-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'rm_theme-style' )
    );

}
add_action( 'wp_enqueue_scripts', 'rm_theme_load_styles' );
function rm_theme_load_styles()
{
  wp_enqueue_style( 'rm_theme_app_css', get_stylesheet_directory_uri() . '/css/app.css' );
  wp_enqueue_style( 'font-quicksand', '//fonts.googleapis.com/css?family=Quicksand:300,400,500,700' );
}
add_action( 'wp_enqueue_scripts', 'rm_theme_load_scripts' );
function rm_theme_load_scripts()
{
  wp_enqueue_script( 'jquery_2','//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js' );
  wp_enqueue_script( 'motion_ui',get_stylesheet_directory_uri() . '/bower_components/motion-ui/dist/motion-ui.min.js' );
  wp_enqueue_script( 'what_input',get_stylesheet_directory_uri() . '/bower_components/what-input/dist/what-input.min.js' );
  wp_enqueue_script( 'foundation',get_stylesheet_directory_uri() . '/bower_components/foundation-sites/dist/js/foundation.min.js' );
  wp_enqueue_script( 'rm_theme_app_js',get_stylesheet_directory_uri() . '/js/app.js' );
}
/*
 * Custom Image Sizes
 */

 require get_template_directory() . '/rm_theme/functions.php';
