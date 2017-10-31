<?php
/*
 * Template Name: Bond Single
 * Description: A single bond template.
 */

get_header(); ?>

<div class="wrap">
	<div class="content-area">
		<main id="content" class="site-main exhibit" role="main" tabindex="2">
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				//the_title();
				?>
				<header role="menubar">
					<h1><?php echo get_the_term_list( $post->ID, 'company',
	'', ', ', '' ); ?></h1>
					<nav>
						<ul>
							<li><a href="#bond-images">Bond Images</a></li>
							<li><a href="#bond-details">Bond Details</a></li>
						</ul>
					</nav>
				</header>
				<div id="bond-images" class="images" tabindex="3" aria-labelled-by="h2">
					<h2>Bond Images</h2>
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
					<p>Front</p>
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
						<p>Back</p>
						<script type="text/javascript">

						</script>
						</div>
				</div>
				<div id="bond-details" class="meta" tabindex="4" aria-labelled-by="h2">
					<h2>Bond Details</h2>
					<?php if (get_the_terms($post->ID, 'theme')!='') { ?>
					<div class="theme" aria-labelled-by="h3">
						<h3>Theme:</h3>
						<p><?php echo get_the_term_list( $post->ID, 'theme',
'', ', ', '' ); ?></p>
					</div>
					<?php } ?>

					<?php if (get_post_meta($post->ID, 'date', true)!='') { ?>
					<div class="date-issued" aria-labelled-by="h3">
						<h3>Date Issued:</h3>
						<p><?php echo get_post_meta($post->ID, 'date', true); ?></p>
					</div>
					<?php } ?>

					<?php if (get_the_terms($post->ID, 'signature')!='') { ?>
					<div class="signature" aria-labelled-by="h3">
						<h3>Signatures:</h3>
						<ul><?php echo get_the_term_list( $post->ID, 'signature',
'<li>', '</li></li>', '</li>' ); ?></ul>
					</div>
					<?php } ?>

					<?php if (get_post_meta($post->ID, 'location', true)!='') { ?>
					<div class="location" aria-labelled-by="h3">
						<h3>Location:</h3>
						<p><?php echo get_post_meta($post->ID, 'location', true); ?></p>
					</div>
					<?php } ?>

					<?php if (get_post_meta($post->ID, 'description', true)!='') { ?>
					<div class="description" aria-labelled-by="h3">
						<h3>Description:</h3>
						<p><?php echo get_post_meta($post->ID, 'description', true); ?></p>
					</div>
					<?php } ?>

					<?php if (get_post_meta($post->ID, 'additional-detail', true)!='') { ?>
					<div class="additional-detail">
						<h3>Additional Detail:</h3>
						<p><?php //echo custom_boilerplate_metabox_view_list($post->ID, 'additional-detail'); ?></p>
					</div>
					<?php } ?>

					<!-- <p class="bond-date">Date: <?php echo date('M d, Y',strtotime(get_post_meta($post->ID, 'date', true))); ?></p>
					<p class="bond-accession">Accession Number: <?php echo get_post_meta($post->ID, 'accession', true); ?></p>

					<div class="bond-description">
						<?php the_content(); ?>
					</div>
					<p>
						<span class="bond-company">Company: <?php echo get_post_meta($post->ID, 'company', true); ?></span>
					</p>
					<p>
						<span class="bond-framed">Framed: <?php echo (get_post_meta($post->ID, 'framed', true))?'yes':'no'; ?></span>
					</p>
					<p>
						<span class="bond-framed">Black Binder: <?php echo (get_post_meta($post->ID, 'black-binder', true))?'yes':'no'; ?></span>
					</p>
					<p>
						<span class="bond-framed">Brown Binder: <?php echo (get_post_meta($post->ID, 'brown-binder', true))?'yes':'no'; ?></span>
					</p>
					<p>
						<span class="bond-dimensions">Dimensions: <?php echo get_post_meta($post->ID, 'dimensions', true); ?></span>
					</p>
					<p>
						<span class="bond-provenance">Provenance: <?php
							$provenance = get_post_meta($post->ID, 'provenance', true);
							if(is_array($provenance)) {
								$i=0;
								foreach($provenance as $item) {
									if($i>0){echo ', ';}
									echo $item;
									$i++;
								}
							} else {
								echo $provenance;
							}  ?></span>
					</p>
					<p>
						<span class="bond-location">Location: <?php echo get_post_meta($post->ID, 'location', true); ?></span>
					</p>
					<p>
						<span class="bond-keywords">Keywords: <?php
							$keywords = get_post_meta($post->ID, 'keywords', true);
							if(is_array($keywords)) {
								$i=0;
								foreach($keywords as $item) {
									if($i>0){echo ', ';}
									echo $item;
									$i++;
								}
							} else {
								echo $keywords;
							}  ?></span>
					</p>
					<p>
						<span class="bond-collection">Collection: <?php echo get_post_meta($post->ID, 'collection', true); ?></span>
					</p>
					<p>
						<span class="bond-rights">Rights: <?php echo get_post_meta($post->ID, 'rights', true); ?></span>
					</p>
					<p>
						<span class="bond-transcription">Transcription: <?php echo get_post_meta($post->ID, 'transcription', true); ?></span>
					</p>
					<p>
						<span class="bond-alt">Alt Text: <?php echo get_post_meta($post->ID, 'alt', true); ?></span>
					</p>
					<p>
						<span class="bond-notes">Notes: <?php echo get_post_meta($post->ID, 'notes', true); ?></span>
					</p> -->
				</div>


				<?php

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php // get_sidebar(); ?>
</div><!-- .wrap -->

<?php require('inc/photoswipe-root-elements.php'); ?>

<?php get_footer();
