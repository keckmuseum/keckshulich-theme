<div class="exhibits-grid">
    <ul>
    <?php
    /* Start the Loop */
    $i=0;
    while ( have_posts() ) : the_post(); ?>
      <li>
        <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>">
        <?php
          if(get_post_meta($post->ID, 'image', true)) {
          $imgArray = wp_prepare_attachment_for_js(get_post_meta($post->ID, 'image', true)[0]);

        ?>
            <img
              src="<?php echo $imgArray['url']; ?>"
              alt="<?php echo $imgArray['alt']; ?>"
            />
          <?php }
          else { ?>
            <img
              src="placeholder.png"
              alt=""
            />
          <?php } ?>
        </a>
      </li>
    <?php
    $i++;
    endwhile;
      ?>
    </ul>

</div>
