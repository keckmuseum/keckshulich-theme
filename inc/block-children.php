<?php
require('snip-post-listing.php');

$post = $wp_query->get_queried_object();

$children = get_children(
  array(
    'post_parent' => $post->ID,
    // 'post_type'   => 'any',
    'numberposts' => -1,
    'post_status' => 'publish'
  )
);

keck_post_list($children);
