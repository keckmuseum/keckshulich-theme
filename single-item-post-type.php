<?php
/*
 * Template Name: Bond Single
 * Description: A single bond template.
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main exhibit" role="main">
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				//the_title();
				?>
				<div class="images">
					<div class="image-front">
					<?php
						$image = get_post_meta($post->ID, 'image', true);
						if(is_array($image)) {
							$i=0;
							foreach($image as $item) {
								$imgArray = wp_prepare_attachment_for_js($item);
								?>
									<img
										src="<?php echo $imgArray['url']; ?>"
										alt="<?php echo $imgArray['alt']; ?>"
									/>
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
									?>
										<img
											src="<?php echo $imgArray['url']; ?>"
											alt="<?php echo $imgArray['alt']; ?>"
										/>
									<?php
									$i++;
								}
							} else {
								echo $image;
							}  ?>
						<p>Back</p>
						</div>
				</div>
				<div class="meta">
					<?php if (get_the_terms($post->ID, 'document-type')!='') { ?>
					<div class="document-type">
						<h2>Document Type:</h2>
						<p><?php echo get_the_term_list( $post->ID, 'document-type',
'', ', ', '' ); ?></p>
					</div>
					<?php } ?>

					<?php if (get_post_meta($post->ID, 'date', true)!='') { ?>
					<div class="date-issued">
						<h2>Date Issued:</h2>
						<p><?php echo date('M d, Y',strtotime(get_post_meta($post->ID, 'date', true))); ?></p>
					</div>
					<?php } ?>

					<?php if (get_the_terms($post->ID, 'provenance')!='') { ?>
					<div class="provenance">
						<h2>Provenance:</h2>
						<ul><?php echo get_the_term_list( $post->ID, 'provenance',
'<li>', '', '</li>' ); ?></ul>
					</div>
					<?php } ?>

					<?php if (get_post_meta($post->ID, 'location', true)!='') { ?>
					<div class="location">
						<h2>Location:</h2>
						<p><?php echo get_post_meta($post->ID, 'location', true); ?></p>
					</div>
					<?php } ?>

					<?php if (get_post_meta($post->ID, 'notes', true)!='') { ?>
					<div class="notes">
						<h2>Notes:</h2>
						<p><?php echo get_post_meta($post->ID, 'notes', true); ?></p>
					</div>
					<?php } ?>

					<?php if (get_post_meta($post->ID, 'additional-detail', true)!='') { ?>
					<div class="additional-detail">
						<h2>Additional Detail:</h2>
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
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
