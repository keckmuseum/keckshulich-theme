<?php get_header(); ?>
<section id="content" role="main">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div>
        <div>
          <header class="header">
            <h1 class="entry-title"><?php the_title(); ?></h1> <?php edit_post_link(); ?>
          </header>
          <section class="entry-content">
            <?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
            <?php the_content(); ?>
            <div class="entry-links"><?php wp_link_pages(); ?></div>
          </section>
        </div>
      </div>
    </article>
    <?php if ( ! post_password_required() ) comments_template( '', true ); ?>
  <?php endwhile; endif; ?>
  <?php
  if (is_front_page() || is_home()) {
  }
  else {
    if(is_active_sidebar('primary-widget-area')) {
      get_sidebar();
    }
  }
  ?>
</section>

<?php get_footer(); ?>
