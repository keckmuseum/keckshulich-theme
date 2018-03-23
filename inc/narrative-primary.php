<div>
  <h1><?php echo get_the_title(); ?></h1>
  <?php if(get_post_meta( $post->ID,'banner-image',1)) { ?>
    <a class="banner-image" href="<?php echo get_permalink($post->ID); ?>">
      <img
        src="<?php echo wp_get_attachment_image_src(get_post_meta( $post->ID,'banner-image',1)[0],'full')[0]; ?>"
        alt="<?php echo get_the_title($post->ID); ?>"
        />
    </a>
    <span class="caption"><?php echo get_post_meta($post->ID, 'banner-image-caption',1); ?></span>
  <?php } ?>

</div>
<ul>
  <?php // $post = $wp_query->get_queried_object();

  $children = get_children(
    array(
      'post_parent' => $post->ID,
      // 'post_type'   => 'any',
      'numberposts' => -1,
      'post_status' => 'publish'
    )
  );

  require('snip-post-listing.php');

  foreach($children as $child) {
    ?><li>


        <div>
          <div>
            <?php if(get_post_meta( $child->ID,'listing-thumb',1)) { ?>
            <a href="<?php echo get_permalink($child->ID); ?>">
              <img
                src="<?php echo wp_get_attachment_image_src(get_post_meta( $child->ID,'listing-thumb',1)[0],'medium')[0]; ?>"
                alt="<?php echo get_the_title($child->ID); ?>"
                />
            </a>
          <?php } ?>
          </div>

          <?php if(get_post_meta( $child->ID,'primary-feature-image',1)) { ?>
            <a href="<?php echo get_permalink($child->ID); ?>">
              <img
                src="<?php echo wp_get_attachment_image_src(get_post_meta( $child->ID,'primary-feature-image',1)[0],'medium')[0]; ?>"
                alt="<?php echo get_the_title($child->ID); ?>"
                />
            </a>
          <?php } ?>
          <h2><a href="<?php echo get_permalink($child->ID); ?>"><?php echo get_the_title($child->ID); ?></a></h2>
          <?php echo get_post_meta( $child->ID,'primary-intro-text',1); ?>
        </div>
        <div>
          <?php

          $children = get_children(
            array(
              'post_parent' => $child->ID,
              // 'post_type'   => 'any',
              'numberposts' => -1,
              'post_status' => 'publish'
            )
          );

          keck_post_list($children,'listing-thumb');
         ?>
        </div>

    <?php
  }
  ?>
</ul>

<a class="related-bonds" href="">Related Bonds</a>
