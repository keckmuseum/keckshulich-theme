<?php
/*
 * Template Name: Bond Single
 * Description: A single bond template.
 */

get_header(); ?>

<div class="wrap">
	<div class="content-area">
		<main id="content" class="site-main exhibit" role="main" tabindex="2">
			<a class="back-to-listing" href="/bonds/">X</a>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				//the_title();
				?>


				<div id="bond-details" class="meta" tabindex="4" aria-labelled-by="h2">
					<header role="menubar">
						<h1><?php the_title(); ?></h1>
						<!-- <nav>
							<ul>
								<li><a href="#bond-images">Bond Images</a></li>
								<li><a href="#bond-details">Bond Details</a></li>
							</ul>
						</nav> -->
					</header>
					<?php if (get_post_meta($post->ID, 'date', true)!='') { ?>
					<div class="date-issued" aria-labelled-by="h2">
						<h2>Date:</h2>
						<p><?php echo get_post_meta($post->ID, 'date', true); ?></p>
					</div>
					<?php } ?>

					<?php if (get_post_meta($post->ID, 'location', true)!='') { ?>
					<div class="location" aria-labelled-by="h2">
						<h2>Location:</h2>
						<p><?php echo get_post_meta($post->ID, 'location', true); ?></p>
					</div>
					<?php } ?>

					<?php if (get_post_meta($post->ID, 'amount', true)!='') { ?>
					<div class="amount" aria-labelled-by="h2">
						<h2>Amount:</h2>
						<p>$<?php echo get_post_meta($post->ID, 'amount', true); ?></p>
					</div>
					<?php } ?>

					<?php if (get_the_terms($post->ID, 'signature')!='') { ?>
					<div class="signature" aria-labelled-by="h2">
						<h2>Signatures:</h2>
						<ul><?php echo get_the_term_list( $post->ID, 'signature',
'<li>', ';</li><li>', '</li>' ); ?></ul>
					</div>
					<?php } ?>

					<?php if (get_post_meta($post->ID, 'description', true)!='') { ?>
					<div class="description" aria-labelled-by="h2">
						<h2>Description:</h2>
						<p><?php echo get_post_meta($post->ID, 'description', true); ?></p>
					</div>
					<?php } ?>

					<?php if (get_post_meta($post->ID, 'notable-imagery', true)!='') { ?>
					<div class="notable-imagery" aria-labelled-by="h2">
						<h2>Notable Bond Imagery:</h2>
						<p><?php echo get_post_meta($post->ID, 'notable-imagery', true); ?></p>
					</div>
					<?php } ?>

					<?php if (get_the_terms($post->ID, 'theme')!='') { ?>
					<!-- <div class="theme" aria-labelled-by="h2">
						<h2>Theme:</h2>
						<p><?php echo get_the_term_list( $post->ID, 'theme',
'', ', ', '' ); ?></p>
					</div> -->
					<?php } ?>











					<?php if (get_post_meta($post->ID, 'additional-detail', true)!='') { ?>
					<div class="additional-detail">
						<h2>Additional Detail:</h2>
						<p><?php //echo custom_boilerplate_metabox_view_list($post->ID, 'additional-detail'); ?></p>
					</div>
					<?php } ?>

				</div>
				<div id="bond-images" class="images" tabindex="3" aria-labelled-by="h2">
					<div class="image-front">
					<?php
						$image = get_post_meta($post->ID, 'image', true);
						if(is_array($image)) {
							$i=0;
							foreach($image as $item) {
								$imgArray = wp_prepare_attachment_for_js($item);
								?><a href="<?php echo $imgArray['url']; ?>" data-size="<?php echo $imgArray['width']; ?>x<?php echo $imgArray['height']; ?>">
				            <img
											src="<?php echo $imgArray['url']; ?>"
											alt="<?php echo $imgArray['alt']; ?>"
										/>
				        </a>

								<?php
								$i++;
							}
						} else {
							echo $image;
						}  ?>
					<p class="image-position">Front</p>
					</div>
					<div class="image-back">
						<?php
							$image = get_post_meta($post->ID, 'image-back', true);
							if(is_array($image)) {
								$i=0;
								foreach($image as $item) {
									$imgArray = wp_prepare_attachment_for_js($item);
									?><a href="<?php echo $imgArray['url']; ?>" data-size="<?php echo $imgArray['width']; ?>x<?php echo $imgArray['height']; ?>">
					            <img
												src="<?php echo $imgArray['url']; ?>"
												alt="<?php echo $imgArray['alt']; ?>"
											/>
					        </a>
									<?php
									$i++;
								}
							} else {
								echo $image;
							}  ?>
						<p class="image-position">Back</p>
						<script type="text/javascript">

						</script>
						</div>
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
