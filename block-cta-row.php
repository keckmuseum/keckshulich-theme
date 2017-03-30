<?php if(get_theme_mod('rm_theme_cta_row')) { ?>
<div class="cta-row">
  <div>
    <div>
      <?php
        $columns = get_theme_mod('rm_theme_cta_row');
        $columns_decoded = json_decode($columns);
        foreach($columns_decoded as $column) {
      ?>
      <section>
        <header>
          <h2><?php echo $column->title; ?></h2>
        </header>
        <?php echo wpautop( $column->text ); ?>
        <a href="<?php echo $column->link; ?>"><?php echo $column->button_text; ?></a>
      </section>
      <?php } ?>
    </div>
  </div>
</div>
<?php } ?>
