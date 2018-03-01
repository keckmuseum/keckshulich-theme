<?php
/*
 * Template Name: Bond Archive
 * Description: A bond archive template.
 */

get_header(); ?>

<div id="content" class="wrap">

	<main role="main" aria-label="Bond Library">
		<a href="#exhibit-themes">Skip to Popular Bond Themes List</a>
		<div class="content-area exhibit-library">
			<div>
				<div>
					<div>
						<div>
							<section id="exhibit-filters" aria-describedby="header">
								<header>
									<p class="instructions">Choose multiple categories for sorting in the Advanced Search.</p>
								</header>
								<?php require('inc/exhibits-filters.php'); ?>
							</section>
							<div class="divider">&nbsp;</div>
							<section id="exhibit-themes" aria-describedby="header">
								<header>
									<a id="exhibit-themes"></a>
									<p class="instructions">Explore popular themes in the collection.</p>
								</header>
								<?php require('inc/exhibits-themes.php'); ?>
							</section>
						</div>
					</div>
				</div>
			</div>
		</div><!-- #primary -->
	</main>

<?php require('inc/exhibits-listing-overlay-template.php'); ?>

<?php get_footer();
