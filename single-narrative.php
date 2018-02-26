<?php
/*
 * Template Name: Narrative Parent Single
 * Description: A single narrative parent template.
 */
 get_header(); ?>
 <div class="wrap">
 	<div class="content-area">
 		<main id="content" class="site-main narrative" role="main" tabindex="2">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <?php get_template_part( 'entry' ); ?>
      <?php if ( ! post_password_required() ) comments_template( '', true ); ?>
      <?php endwhile; endif; ?>

      <?php require('inc/block-children.php'); ?>
    </main>
  </div>
</div>
<footer class="footer">
  <?php get_template_part( 'nav', 'below-single' ); ?>
</footer>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
