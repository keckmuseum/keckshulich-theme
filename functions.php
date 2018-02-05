<?php
require get_template_directory() . '/rm_theme/functions.php';

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
  // wp_enqueue_style( 'font-diplomata', '//fonts.googleapis.com/css?family=Diplomata+SC' );
  // wp_enqueue_style( 'font-michroma', '//fonts.googleapis.com/css?family=Michroma' );
  // wp_enqueue_style( 'font-quicksand', '//fonts.googleapis.com/css?family=Quicksand:300,400,500,700' );
  wp_enqueue_style( 'font-libre-baskerville', '//fonts.googleapis.com/css?family=Libre+Baskerville' );
  // wp_enqueue_style( 'font-bourbon', '//fonts.googleapis.com/css?family=Raleway' );
  wp_enqueue_style( 'font-raleway', '//fonts.googleapis.com/css?family=Raleway' );

  wp_enqueue_style( 'jquery_flipster',get_stylesheet_directory_uri() . '/bower_components/jquery-flipster/dist/jquery.flipster.min.css');
  wp_enqueue_style( 'jquery_photoswipe',get_stylesheet_directory_uri() . '/bower_components/photoswipe/dist/photoswipe.css');
  wp_enqueue_style( 'jquery_photoswipe_skin',get_stylesheet_directory_uri() . '/bower_components/photoswipe/dist/default-skin/default-skin.css');
  wp_enqueue_style( 'swiper',get_stylesheet_directory_uri() . '/bower_components/swiper/dist/css/swiper.min.css');

  wp_enqueue_style( 'rm_theme_app_css', get_stylesheet_directory_uri() . '/css/app.css' ); //Includes foundation 6
}
add_action( 'wp_enqueue_scripts', 'rm_theme_load_scripts' );
function rm_theme_load_scripts()
{
  wp_enqueue_script( 'jquery_2',get_stylesheet_directory_uri() . '/bower_components/jquery/dist/jquery.min.js' );
  wp_enqueue_script( 'motion_ui',get_stylesheet_directory_uri() . '/bower_components/motion-ui/dist/motion-ui.min.js', array('jquery_2') );
  wp_enqueue_script( 'what_input',get_stylesheet_directory_uri() . '/bower_components/what-input/dist/what-input.min.js', array('jquery_2') );
  wp_enqueue_script( 'foundation',get_stylesheet_directory_uri() . '/bower_components/foundation-sites/dist/js/foundation.min.js', array('jquery_2', 'what_input', 'motion_ui'), $in_footer=true );
  wp_enqueue_script( 'foundation-interchange',get_stylesheet_directory_uri() . '/bower_components/foundation-sites/dist/js/plugins/foundation.interchange.min.js', array('jquery_2', 'what_input', 'motion_ui', 'foundation'), $in_footer=true );
  wp_enqueue_script( 'jquery_flipster',get_stylesheet_directory_uri() . '/bower_components/jquery-flipster/dist/jquery.flipster.min.js', array('jquery_2'), $in_footer=true);
  wp_enqueue_script( 'jquery_photoswipe',get_stylesheet_directory_uri() . '/bower_components/photoswipe/dist/photoswipe.min.js', array('jquery_2'), $in_footer=true);
  wp_enqueue_script( 'jquery_photoswipe_ui',get_stylesheet_directory_uri() . '/bower_components/photoswipe/dist/photoswipe-ui-default.min.js', array('jquery_2','jquery_photoswipe'), $in_footer=true);
  wp_enqueue_script( 'jquery_photoswipe_init',get_stylesheet_directory_uri() . '/js/jquery-photoswipe-init.js', array('jquery_2','jquery_photoswipe'), $in_footer=true);
  wp_enqueue_script( 'rm_theme_app_js',get_stylesheet_directory_uri() . '/js/app.js', array('jquery_2','jquery_photoswipe','jquery_photoswipe_ui','jquery_flipster','jquery_photoswipe_init','jquery_cookie'), $in_footer=true );
  wp_enqueue_script( 'swiper',get_stylesheet_directory_uri() . '/bower_components/swiper/dist/js/swiper.min.js', array('jquery_2'), $in_footer=true );
  wp_enqueue_script( 'jquery_cookie',get_stylesheet_directory_uri() . '/bower_components/jquery.cookie/jquery.cookie.js', array('jquery_2'), $in_footer=true );
}

function rm_theme_modify_main_query( $query ) {
  if ( $query->is_archive() && $query->is_main_query() ) { // Run only on the archive
    $query->query_vars['posts_per_page'] = -1;
  }
}
add_action( 'pre_get_posts', 'rm_theme_modify_main_query' );

/*
 * Custom Image Sizes
 */
add_action( 'after_setup_theme', 'rm_theme_image_sizes' );
function rm_theme_image_sizes() {
  add_image_size( 'xs', 400, 400 );
  add_image_size( 's', 700, 700 );
  add_image_size( 'm', 1200, 1200 );
  add_image_size( 'l', 1600, 1600 );
  add_image_size( 'xl', 1920, 1920 );
  add_image_size( 'bond-detail', 400, 260 );
  add_image_size( 'bond-detail-zoom', 770, 510 );
  add_image_size( 'bond-listing-large', 680, 495 );
}
