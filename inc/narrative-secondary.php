  <?php // $post = $wp_query->get_queried_object();

  require('snip-post-listing.php'); ?>
      <h1><a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a></h1>

      <?php if(get_post_meta( $post->ID,'banner-image',1)) { ?>
        <a class="banner-image" href="<?php echo get_permalink($post->ID); ?>">
          <img
            src="<?php echo wp_get_attachment_image_src(get_post_meta( $post->ID,'banner-image',1)[0],'full')[0]; ?>"
            alt="<?php echo get_the_title($post->ID); ?>"
            />
        </a>
        <span class="caption"><?php echo get_post_meta($post->ID, 'banner-image-caption',1); ?></span>
      <?php } ?>


        <div>
          <?php echo get_post_meta( $post->ID,'detail-intro-text',1); ?>
        </div>


        <?php if(get_post_meta( $post->ID,'detail-bond-image',1)) { ?>
        <div>
          <a class="bond-image" href="<?php echo get_permalink($post->ID); ?>">
            <img
              src="<?php echo wp_get_attachment_image_src(get_post_meta( $post->ID,'detail-bond-image',1)[0],'full')[0]; ?>"
              alt="<?php echo get_the_title($post->ID); ?>"
              />
          </a>
          <div class="transcription"><?php echo get_post_meta( $post->ID,'detail-bond-image-transcription',1); ?></div>
          <div class="caption"><?php echo get_post_meta( $post->ID,'detail-bond-image-caption',1); ?></div>
          <?php } ?>

          <div>
            <?php echo get_post_meta( $post->ID,'detail-bond-text',1); ?>
          </div>
        </div>

        <div>
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <?php echo the_content(); ?>
          <?php endwhile; endif; ?>
        </div>




        <div>
          <?php
          $children = get_children(
            array(
              'post_parent' => $post->ID,
              // 'post_type'   => 'any',
              'numberposts' => -1,
              'post_status' => 'publish'
            )
          );

          keck_post_list($children,'listing-thumb');
           ?>
        </div>
