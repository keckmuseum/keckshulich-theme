<?php
/*
 * Template Name: Bond Archive
 * Description: A bond archive template.
 */

get_header(); ?>

<div id="content" class="wrap">

	<main role="main" aria-labelledby="bond-listing-title">
		<!-- <h1 id="bond-listing-title">Bond Library</h1> -->

		<div class="content-area exhibit-library">
			<div>
				<div>
					<div>
						<div>
							<p class="instructions">Choose multiple categories for sorting in the Advanced Search.</p>
							<?php require('inc/exhibits-filters.php'); ?>
							<!-- <a href="#exhibit-browser">Open in Exhibit Browser</a> -->

							<div class="divider">&nbsp;</div>
							<p class="instructions">Explore popular themes in the collection.</p>
							<?php require('inc/exhibits-themes.php'); ?>

							<?php // require('inc/exhibits-grid.php'); ?>
						</div>
					</div>
				</div>
			</div>
		</div><!-- #primary -->
	</main>

<?php require('inc/exhibits-listing-overlay-template.php'); ?>

<?php get_footer();
