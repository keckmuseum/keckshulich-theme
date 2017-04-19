<?php if(get_theme_mod('rm_theme_hp_slideshow_slides')) { ?>
<section class="slideshow" role="region">
  <div>
    <div class="slideshow-container">

      <?php
        $slides = get_theme_mod('rm_theme_hp_slideshow_slides');
        $slides_decoded = json_decode($slides);
        foreach($slides_decoded as $slide){
          if($slide->image_url) {
          $slide_img_attr = wp_get_attachment_image_src( absint(rm_theme_get_image_by_url($slide->image_url)),'hero');
            ?>
            <figure class="slide">
              <a href="<?php echo $slide->link; ?>">
                <img src="<?php echo $slide_img_attr[0]; ?>" alt="<?php echo $slide->title; ?>" />
                <?php if($slide->title || $slide->text) { ?>
                <figcaption>
                  <?php echo $slide->title; ?>
                  <?php echo $slide->text; ?>
                </figcaption>
                <?php } ?>
              </a>
            </figure>
            <?php
          }
        }
      ?>
      <div class="slide-previous">&lt;</div>
      <div class="slide-next">&gt;</div>
    </div>
  </div>
</section>
<?php } ?>
