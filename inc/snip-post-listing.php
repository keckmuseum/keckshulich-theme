<?php

function keck_post_list($posts_array, $image_slug, $image_size='thumbnail'){
  if(is_array($posts_array)) { ?>
    <ul>
    <?php foreach($posts_array as $post) { ?>
      <li>
        <?php if(get_post_meta( $post->ID,$image_slug,1)) { ?>
          <a href="<?php echo get_permalink($post->ID); ?>">
            <img
              src="<?php echo wp_get_attachment_image_src(get_post_meta( $post->ID,$image_slug,1)[0],$image_size)[0]; ?>"
              alt="<?php echo get_the_title($post->ID); ?>"
              />
          </a>
        <?php } ?>
          <a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a>
      </li>
    <?php } ?>
  </ul>
<?php }
}
