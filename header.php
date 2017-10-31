<!DOCTYPE html>
<head>
<html class="no-js" <?php language_attributes(); ?>>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width" />
  <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
      <header id="header" role="banner" aria-label="Website Header">
        <a href="#content">Skip to Main Content</a>
        <?php if (get_theme_mod('rm_theme_header_bg')) {
          $header_img_attr = wp_get_attachment_image_src( absint(get_theme_mod('rm_theme_header_bg')),'header_bg'); ?>
          <img src="<?php echo $header_img_attr[0]; ?>" width="<?php echo $header_img_attr[1]; ?>" height="<?php echo $header_img_attr[2]; ?>" alt="" />
        <?php } ?>
        <div>
          <div>
            <div>
              <div id="branding">
                <div id="site-title">
                  <?php logo("header","full"); ?>
                </div>
              </div>

              <!-- <button id="menu-button" data-responsive-toggle="menu">
                <span data-toggle>Menu</span>
              </button>

              <nav id="menu" role="navigation"> -->
                <!-- div id="search">
                  <?php //get_search_form(); ?>
                </div -->
                <?php /* wp_nav_menu( array(
                        'theme_location' => 'main-menu',
                        'container' => false,
                        //'menu_id' => 'nav',
                        'walker' => new rm_theme_walker_nav_menu,
                       ) ); */ ?>
              <!-- </nav> -->
            </div>
          </div>
        </div>
      </header>
