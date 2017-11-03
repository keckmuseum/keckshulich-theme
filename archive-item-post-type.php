<?php
/*
 * Template Name: Bond Archive
 * Description: A bond archive template.
 */

get_header(); ?>

<div id="content" class="wrap">

	<?php
	$args = array(  'posts_per_page' => -1);
	$loop = new WP_Query( $args );
	if ( $loop->have_posts() ) : ?>
		<!-- header class="page-header">
			<?php
				// the_archive_title( '<h1 class="page-title">', '</h1>' );
				// the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header --><!-- .page-header -->
	<main role="main" aria-labelledby="bond-listing-title">
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
							<div class="exhibit-meta">
								<?php if (get_post_meta($post->ID, 'date', true)!='') { ?>
								<div class="date-issued" aria-labelled-by="h3">
									<h3>Date</h3>
									<p><?php echo get_post_meta($post->ID, 'date', true); ?></p>
								</div>
								<?php } ?>

								<?php if (get_post_meta($post->ID, 'location', true)!='') { ?>
								<div class="location" aria-labelled-by="h3">
									<h3>Location</h3>
									<p><?php echo get_post_meta($post->ID, 'location', true); ?></p>
								</div>
								<?php } ?>

								<?php if (get_post_meta($post->ID, 'amount', true)!='') { ?>
								<div class="amount" aria-labelled-by="h3">
									<h3>Amount</h3>
									<p>$<?php echo get_post_meta($post->ID, 'amount', true); ?></p>
								</div>
								<?php } ?>

								<?php if (get_the_terms($post->ID, 'signature')!='') { ?>
								<div class="signature" aria-labelled-by="h3">
									<h3>Signatures</h3>
									<ul><?php echo get_the_term_list( $post->ID, 'signature',
			'<li>', ';</li><li>', '</li>' ); ?></ul>
								</div>
								<?php } ?>



							</div>
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
						</div>
					</li>
				<?php

				endwhile;
					?>
				</ul>
			<?php else :


			endif; ?>

			</div><!-- #main -->
		</div><!-- #primary -->
	</main>
	<!-- <?php get_sidebar(); ?> -->
</div><!-- .wrap -->

<?php get_footer();
