<?php
/*
 * Template Name: theme taxonomy
 * Description:
 */

get_header(); ?>

<div id="content" class="wrap">
	<?php

	// $args = array( 'post_type' => 'item-post-type', 'posts_per_page' => -1, 'order' => 'ASC');
	// $loop = new WP_Query();

	if ( have_posts() ) : ?>
		<!-- header class="page-header">
			<?php
				// the_archive_title( '<h1 class="page-title">', '</h1>' );
				// the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header --><!-- .page-header -->
		<?php require('inc/exhibits-carousel.php'); ?>
	<?php endif; ?>
	<!-- <?php get_sidebar(); ?> -->
</div><!-- .wrap -->

<?php get_footer();
