<div class="exhibit-browser-overlay"></div>
<div class="exhibit-browser">
  <!-- <h1 id="bond-listing-title">Bond Browser</h1>
  <p><strong>Swipe left or right to browse the collection.</strong></p>
  <p><strong>Click on thumbnails for document detail.</strong></p> -->

  <?php
  if ( have_posts() ) : ?>

  <div class="content-area">
    <div class="site-main exhibits exhibits-carousel">

      <ul>
      <?php
      $i=0;
      /* Start the Loop */
      while ( have_posts() ) : the_post(); ?>
        <li id="exhibit-<?php echo $i; ?>">
          <div class="exhibit">
            <div class="inner">
              <h2><?php the_title(); ?></h2>
              <div class="exhibit-meta">
                <div>
                  <?php if (get_post_meta($post->ID, 'date', true)!='') { ?>
                  <div class="date-issued" aria-labelled-by="h3">
                    <h3>Date</h3>
                    <p><?php echo get_post_meta($post->ID, 'date', true); ?></p>
                  </div>
                  <?php } ?>

                  <?php if (get_post_meta($post->ID, 'location', true)!='') { ?>
                  <div class="location" aria-labelled-by="h3">
                    <h3>Location</h3>
                    <p><?php echo get_post_meta($post->ID, 'location', true); ?></p>
                  </div>
                  <?php } ?>

                  <?php if (get_post_meta($post->ID, 'amount', true)!='') { ?>
                  <div class="amount" aria-labelled-by="h3">
                    <h3>Amount</h3>
                    <p>$<?php echo get_post_meta($post->ID, 'amount', true); ?></p>
                  </div>
                  <?php } ?>

                  <?php if (get_the_terms($post->ID, 'signature')!='') { ?>
                  <div class="signature" aria-labelled-by="h3">
                    <h3>Signatures</h3>
                    <ul><?php echo get_the_term_list( $post->ID, 'signature',
        '<li>', '</li><li>', '</li>' ); ?></ul>
                  </div>
                  <?php } ?>


                </div>
                <a href="<?php echo get_permalink(); ?>">Explore Further</a>
              </div>
              <div class="exhibit-images">
                <a href="<?php echo get_permalink(); ?>">
                <?php
                  if(get_post_meta($post->ID, 'image', true)) {
                    $imgArray = wp_prepare_attachment_for_js(get_post_meta($post->ID, 'image', true)[0]);
                  ?>
                      <img
                        src="<?php echo $imgArray['url']; ?>"
                        alt="<?php echo $imgArray['alt']; ?>"
                      />
                  <?php } else { ?>
                    <img
                      src="placeholder.png"
                      alt=""
                    />
                  <?php } ?>
                </a>
              </div>
            </div>
          </div>
        </li>
      <?php
      $i++;
      endwhile;
        ?>
      </ul>

    </div><!-- #main -->
    <!-- <div class="exhibit-thumbnails">
        <ul>
        <?php
        /* Start the Loop */
        $i=0;
        while ( have_posts() ) : the_post(); ?>
          <li>
            <a href="#exhibit-<?php echo $i; ?>" title="<?php the_title(); ?>">
            <?php
              if(get_post_meta($post->ID, 'image', true)) {
              $imgArray = wp_prepare_attachment_for_js(get_post_meta($post->ID, 'image', true)[0]);

            ?>
                <img
                  src="<?php echo $imgArray['url']; ?>"
                  alt="Scroll to <?php echo $imgArray['alt']; ?>"
                />
              <?php }
              else { ?>
                <img
                  src="placeholder.png"
                  alt="Scroll to <?php echo $imgArray['alt']; ?>"
                />
              <?php } ?>
            </a>
          </li>
        <?php
        $i++;
        endwhile;
          ?>
        </ul>

    </div> -->
  </div><!-- #primary -->
  <?php endif; ?>
</div>
<!-- <?php get_sidebar(); ?> -->
</div><!-- .wrap -->
