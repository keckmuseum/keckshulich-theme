
<?php
if(get_theme_mod('rm_theme_cta_row')) {
  $about_blocks = get_theme_mod('rm_theme_about');
  $about_blocks_decoded = json_decode($about_blocks);
  foreach($about_blocks_decoded as $about_block) {
?>
<article>
  <div class="copy">
    <header>
      <h2><?php echo $about_block->title; ?></h2>
    </header>
    <?php echo wpautop( $about_block->text ); ?>
  </div>
  <img src="<?php echo $about_block->image_url; ?>" alt="<?php echo $about_block->title; ?>" />
</article>
<?php }
} ?>
