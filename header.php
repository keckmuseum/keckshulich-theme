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

              <div id="menu-button" class="title-bar" data-responsive-toggle="menu" data-hide-for="medium">
                <button data-toggle="menu">
                  <span>Menu</span>
                </button>
              </div>

              <nav id="menu" role="navigation" data-toggler=".expanded">
                <?php wp_nav_menu( array(
                        'theme_location' => 'main-menu',
                        'container' => false,
                        //'menu_id' => 'nav',
                        'walker' => new rm_theme_walker_nav_menu,
                       ) ); ?>
              </nav>

              <!-- <div id="search">
               <?php // get_search_form(); ?>
              </div> -->

              <!-- <a class="logo-unr" href="https://www.unr.edu"><img src="/content/themes/keckshulich/images/logo-unr-white-transparent.svg" alt="University of Nevada, Reno" /></a> -->
            </div>
          </div>
        </div>
        <div class="unr-header">
          <div>
            <div>
              <a href="https://www.unr.edu">
                <img src="<?php echo get_template_directory_uri(); ?>/images/logo-unr-blue.png" alt="University of Nevada, Reno Logo" />University of Nevada, Reno
              </a>
            </div>
          </div>
        </div>
      </header>
