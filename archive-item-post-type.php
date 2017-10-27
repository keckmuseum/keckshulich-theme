<?php
/*
 * Template Name: Bond Archive
 * Description: A bond archive template.
 */

get_header(); ?>

<div id="content" class="wrap">

	<?php if ( have_posts() ) : ?>
		<!-- header class="page-header">
			<?php
				// the_archive_title( '<h1 class="page-title">', '</h1>' );
				// the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header --><!-- .page-header -->
	<section role="main" aria-labelledby="bond-listing-title">
		<h1 id="bond-listing-title">Bond Listing</h1>
		<p><strong>Swipe left or right to browse the collection.</strong></p>
		<p><strong>Click on thumbnails for document detail.</strong></p>
	<?php endif; ?>

		<div class="content-area">
			<div class="site-main exhibits">
			<?php
			if ( have_posts() ) : ?>
				<ul>
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post(); ?>
					<li>
						<div class="exhibit">
							<h2><?php the_title(); ?></h2>
							<div class="exhibit-images">
								<a href="<?php echo get_permalink(); ?>">
								<?php
									$imgArray = wp_prepare_attachment_for_js(get_post_meta($post->ID, 'image', true)[0]);
								?>
										<img
											src="<?php echo $imgArray['url']; ?>"
											alt="<?php echo $imgArray['alt']; ?>"
										/>
								</a>
							</div>
							<div class="exhibit-meta">

								<?php
								 if(get_post_meta($post->ID, 'document-type', true)!=''){
									 ?><h3>Document Type</h3><?php
									 echo '<p>'.get_post_meta($post->ID, 'document-type', true).'</p>';
								 }
								 ?>
								<?php
								 if(get_post_meta($post->ID, 'date', true)!=''){
									 ?><h3>Date Issued</h3><?php
									 echo '<p>'.date('Y',strtotime(get_post_meta($post->ID, 'date', true))).'</p>';
								 }
								 ?>
								<?php
								 if(get_post_meta($post->ID, 'provenance', true)!=''){
									 ?><h3>Provenance</h3><?php
									 echo '<p>'.custom_boilerplate_metabox_view_list($post->ID, 'provenance').'</p>';
								 }
								 ?>
							 <?php
								if(get_post_meta($post->ID, 'location', true)!=''){
									?><h3>Location</h3><?php
									echo '<p>'.get_post_meta($post->ID, 'location', true).'</p>';
								}
								?>

							</div>
						</div>
					</li>
				<?php
					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					// get_template_part( 'template-parts/post/content', get_post_format() );

				endwhile;

				the_posts_pagination( array(
					'prev_text' => '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>',
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyseventeen' ) . ' </span>',
				) ); ?>
				</ul>
			<?php else :

				get_template_part( 'template-parts/post/content', 'none' );

			endif; ?>

			</div><!-- #main -->
		</div><!-- #primary -->
	</section>
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
