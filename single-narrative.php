<?php
/*
 * Template Name: Narrative Parent Single
 * Description: A single narrative parent template.
 */
 get_header();

 global $post;
 $is_child = (is_single() && $post->post_parent)?1:0;

 ?>
 <div class="wrap">
 	<div class="content-area">
 		<main id="content" class="site-main narrative<?php echo ($is_child)?' child':''; ?>" role="main" tabindex="2">
      <?php /*if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <?php get_template_part( 'entry' ); ?>
      <?php if ( ! post_password_required() ) comments_template( '', true ); ?>
      <?php endwhile; endif;*/ ?>

      <?php if ($is_child) {
        include('inc/narrative-secondary.php');
      } else {
        include('inc/narrative-primary.php');
      } ?>

    </main>
  </div>
</div>

<?php get_footer(); ?>
