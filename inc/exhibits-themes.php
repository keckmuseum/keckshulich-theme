<ul class="exhibit-themes">
<?php
  $terms = get_terms( array(
    'taxonomy' => 'theme',
    'hide_empty' => true,
    'parent' => 0
  ) );
if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
  foreach($terms as $term) {
    if(get_term_meta( $term->term_taxonomy_id,'theme-featured')) {
    ?>
    <li>
      <a href="/bond-themes/<?php echo $term->slug; ?>/" data-theme-id="<?php echo $term->term_id; ?>">
        <?php if(get_term_meta( $term->term_taxonomy_id,'theme-button-image')) { ?>
          <img src="<?php echo get_term_meta( $term->term_taxonomy_id,'theme-button-image')[0]; ?>" alt="" />
        <?php } ?>
        <span>
        <?php if(get_term_meta( $term->term_taxonomy_id,'theme-button-label')) { ?>
          <?php echo get_term_meta( $term->term_taxonomy_id,'theme-button-label')[0]; ?>
        <?php } else { ?>
          <?php echo $term->name; ?>
        <?php } ?>
        </span>
      </a>
    </li>
    <?php }
    }
  } ?>
</ul>
