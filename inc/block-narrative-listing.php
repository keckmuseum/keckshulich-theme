<?php
require('snip-post-listing.php');

$posts_array = get_posts(
  array(
 	'posts_per_page'   => 5,
 	'offset'           => 0,
 	'category'         => '',
 	'category_name'    => '',
 	'orderby'          => 'date',
 	'order'            => 'DESC',
 	'include'          => '',
 	'exclude'          => '',
 	'meta_key'         => '',
 	'meta_value'       => '',
 	'post_type'        => 'narrative',
 	'post_mime_type'   => '',
 	'post_parent'      => 0, //0 = No parents, No masters
 	'author'	   => '',
 	'author_name'	   => '',
 	'post_status'      => 'publish',
 	'suppress_filters' => true
 )
);

keck_post_list($posts_array, 'listing-thumb');
