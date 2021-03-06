<?php
/*
 * Template Name: Bond Single
 * Description: A single bond template.
 */

get_header(); ?>

<div class="wrap">
	<div class="content-area">
		<main id="content" class="site-main exhibit" role="main">
			<a class="back-to-listing" href="/bonds/"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i><span>Back to Library</span></a>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				//the_title();
				?>


				<div id="bond-details" class="meta" tabindex="0" aria-labelled-by="bond-title">
					<header>
						<h1 id="bond-title"><?php the_title(); ?></h1>
					</header>
					<?php if (get_post_meta($post->ID, 'date', true)!='') { ?>
					<div tabindex="0" class="date-issued" aria-labelled-by="h2">
						<h2>Date</h2>
						<p><?php echo get_post_meta($post->ID, 'date', true); ?></p>
					</div>
					<?php } ?>

					<?php if (get_post_meta($post->ID, 'location', true)!='') { ?>
					<div tabindex="0" class="location" aria-labelled-by="h2">
						<h2>Location</h2>
						<p><?php echo get_post_meta($post->ID, 'location', true); ?></p>
					</div>
					<?php } ?>

					<?php if (get_post_meta($post->ID, 'amount', true)!='') { ?>
					<div tabindex="0" class="amount" aria-labelled-by="h2">
						<h2>Amount</h2>
						<p>$<?php echo get_post_meta($post->ID, 'amount', true); ?></p>
					</div>
					<?php } ?>

					<?php if (get_the_terms($post->ID, 'signature')!='') { ?>
					<div tabindex="0" class="signature" aria-labelled-by="h2">
						<h2>Signatures</h2>
						<ul><?php foreach (wp_get_object_terms( $post->ID, 'signature' ) as $term) {
												echo '<li>'.$term->name.'</li>';
											} ?></ul>
					</div>
					<?php } ?>

					<?php if (get_post_meta($post->ID, 'description', true)!='') { ?>
					<div tabindex="0" class="description" aria-labelled-by="h2">
						<h2>Description</h2>
						<p><?php echo get_post_meta($post->ID, 'description', true); ?></p>
					</div>
					<?php } ?>

					<?php if (get_post_meta($post->ID, 'notable-imagery', true)!='') { ?>
					<div tabindex="0" class="notable-imagery" aria-labelled-by="h2">
						<h2>Notable Bond Imagery</h2>
						<p><?php echo get_post_meta($post->ID, 'notable-imagery', true); ?></p>
					</div>
					<?php } ?>













					<?php if (get_post_meta($post->ID, 'additional-detail', true)!='') { ?>
					<div tabindex="0" aria-labelled-by="h2" class="additional-detail">
						<h2>Additional Detail</h2>
						<p><?php //echo custom_boilerplate_metabox_view_list($post->ID, 'additional-detail'); ?></p>
					</div>
					<?php } ?>

				</div>
				<div id="bond-images" class="images">
					<?php if(get_post_meta($post->ID, 'image', true)) { ?>
						<div class="image-front">
						<?php
							$image = get_post_meta($post->ID, 'image', true);
							if(is_array($image)) {
								$i=0;
								foreach($image as $item) {
									$imgArray = wp_prepare_attachment_for_js($item);
									?><a tabindex="0" aria-label="Front Image" href="<?php echo $imgArray['url']; ?>" data-size="<?php echo $imgArray['width']; ?>x<?php echo $imgArray['height']; ?>">
					            <img
												src="<?php echo wp_get_attachment_image_src($item, 'xs')[0] ?>"
												alt="<?php echo $imgArray['alt']; ?>"
											/>
					        </a>

									<?php
									$i++;
								}
							} else {
								echo $image;
							}  ?>
						<p aria-hidden="true" class="image-position">Front - Touch to enlarge</p>
						</div>
					<?php }
					if(get_post_meta($post->ID, 'image-back', true)) { ?>
						<div class="image-back">
							<?php
								$image = get_post_meta($post->ID, 'image-back', true);
								if(is_array($image)) {
									$i=0;
									foreach($image as $item) {
										$imgArray = wp_prepare_attachment_for_js($item);
										?><a tabindex="0" aria-label="Back Image" href="<?php echo $imgArray['url']; ?>" data-size="<?php echo $imgArray['width']; ?>x<?php echo $imgArray['height']; ?>">
						            <img
													src="<?php echo wp_get_attachment_image_src($item, 'xs')[0] ?>"
													alt="<?php echo $imgArray['alt']; ?>"
												/>
						        </a>
										<?php
										$i++;
									}
								} else {
									echo $image;
								}  ?>
							<p aria-hidden="true" class="image-position">Back - Touch to enlarge</p>
							<script type="text/javascript">

							</script>
							</div>
						<?php } ?>
				</div>


				<?php

			endwhile; // End of the loop.
			?>
			<?php if (get_post_meta($post->ID, 'accession', true)!='') { ?>
			<div class="accession" aria-labelled-by="h2">
				<h2>Accession No:</h2>
				<p><?php echo get_post_meta($post->ID, 'accession', true); ?></p>
			</div>
			<?php } ?>
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php // get_sidebar(); ?>
</div><!-- .wrap -->

<?php require('inc/photoswipe-root-elements.php'); ?>

<?php get_footer();
