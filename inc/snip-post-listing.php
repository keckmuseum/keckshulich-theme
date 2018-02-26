<?php

function keck_post_list($posts_array){
  if(is_array($posts_array)) { ?>
    <ul>
    <?php foreach($posts_array as $post) { ?>
      <li>
        <?php if(get_post_meta( $post->ID,'listing-image')) { ?>
          <a href="<?php echo get_permalink($post->ID); ?>">
            <img src="<?php echo wp_get_attachment_image_src(get_post_meta( $post->ID,'listing-image')[0][0],'thumbnail')[0]; ?>" alt="<?php echo get_the_title($post->ID); ?>" />
          </a>
        <?php } else { ?>
          <a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a>
        <?php } ?>
      </li>
    <?php } ?>
  </ul>
<?php }
}
