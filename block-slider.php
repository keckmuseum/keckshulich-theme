<?php if(get_theme_mod('rm_theme_hero_slides')) { ?>
<section id="hero">
  <?php
    $slides = get_theme_mod('rm_theme_hero_slides');
    $slides_decoded = json_decode($slides);
    foreach($slides_decoded as $slide){
      $slide_img_attr = wp_get_attachment_image_src( absint(rm_theme_get_image_by_url($slide->image_url)),'hero');
        ?>
        <figure>
          <a href="<?php echo $slide->link; ?>">
            <img src="<?php echo $slide_img_attr[0]; ?>" alt="<?php echo $slide->title; ?>" />
            <figcaption>
              <?php echo $slide->title; ?>
              <?php echo $slide->text; ?>
            </figcaption>
          </a>
        </figure>
        <?php
    }
  ?>
</section>
<?php } ?>
