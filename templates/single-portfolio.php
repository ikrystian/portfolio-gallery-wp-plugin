<?php
get_header(); ?>

	<div class="single-portfolio">
		<div class="portfolio-content">
			<h1><?php the_title(); ?></h1>
			<div class="portfolio-date"><?php echo get_the_date(); ?></div>
			<div class="portfolio-image">
				<?php the_post_thumbnail('full'); ?>
			</div>
			<div class="portfolio-text">
				<?php the_content(); ?>
			</div>
			<a href="<?php echo get_post_type_archive_link('portfolio'); ?>" class="back-to-portfolio">
				Back to Portfolio
			</a>
		</div>
	</div>

<?php get_footer();