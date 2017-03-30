        <footer id="footer" role="contentinfo">
          <div>
              <?php if ( is_active_sidebar( 'footer-items' ) ) : ?>
                  <ul>
                    <?php dynamic_sidebar( 'footer-items' ); ?>
                  </ul>
              <?php endif; ?>
          </div>
        </footer>
        <?php wp_footer(); ?>
        <a class="exit-off-canvas"></a>

  </body>
</html>
