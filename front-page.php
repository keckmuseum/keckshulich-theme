<?php
/*
Template Name: Home
Template Post Type: page
*/
?>
<?php get_header(); ?>
<?php get_template_part('block-cta-row'); ?>
<?php get_template_part('block-slider'); ?>
<?php
$content='';
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <?php $content.=get_the_content(); ?>
<?php endwhile; endif;
if ($content!='') { ?>
<main>
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <?php if(get_theme_mod('rm_theme_front_page_show_title')) { ?>
        <header class="header">
          <h1 class="entry-title"><?php the_title(); ?></h1> <?php edit_post_link(); ?>
        </header>
      <?php } ?>
      <section class="entry-content">
        <?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
        <?php the_content(); ?>
        <div class="entry-links"><?php wp_link_pages(); ?></div>
      </section>
    </article>
    <?php if ( ! post_password_required() ) comments_template( '', true ); ?>
  <?php endwhile; endif; ?>
</main>
<?php } ?>
<?php get_footer(); ?>
