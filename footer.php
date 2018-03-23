        <footer id="footer">
          <div>
            <nav id="footer-menu" role="navigation">
              <?php wp_nav_menu( array(
                  'theme_location' => 'main-menu',
                  'container' => false,
                  //'menu_id' => 'nav',
                  'walker' => new rm_theme_walker_nav_menu,
                 ) ); ?>
            </nav>
          </div>
          <div>
          </div>
          <div>
            <?php logo("header","full"); ?>
            &copy <?php echo date('Y'); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
          </div>
        </footer>

        <?php wp_footer(); ?>

        <a class="exit-off-canvas"></a>

  </body>
</html>
