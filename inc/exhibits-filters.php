<div class="exhibits-filters">
  <!-- /wp-json/wp/v2/bonds/?bond-themes=17&bond-signatures=10 -->
  <?php
    $cpth_theme_field_helper = new cpth_theme_field_helper;
  ?>
  <div class="filter">
    <?php $cpth_theme_field_helper->taxonomy_selector('theme', '--Theme--', 'Theme'); ?>
  </div>
  <div class="filter">
    <?php $cpth_theme_field_helper->taxonomy_selector('date-range', '--Date Range--', 'Date Range'); ?>
  </div>
  <div class="filter">
    <?php $cpth_theme_field_helper->taxonomy_selector('region', '--Region--', 'Region'); ?>
  </div>
  <div class="actions">
    <a href="#search">Search</a>
    <a href="#clear">Clear</a>
  </div>
</div>
