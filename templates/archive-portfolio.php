<?php
get_header(); ?>

    <div class="portfolio-container">
        <div class="portfolio-preview">
            <div class="loading-spinner"></div>
            <img src="" alt="" class="preview-image">
        </div>
        <div class="portfolio-thumbnails hover14 column">
			<?php
			$args = array(
				'post_type' => 'portfolio',
				'posts_per_page' => -1
			);
			$query = new WP_Query($args);
			while ($query->have_posts()) : $query->the_post();
				$thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'custom-thumbnail');
				$full_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
				?>
                <div class="portfolio-item"
                     data-full="<?php echo esc_url($full_image); ?>"
                     data-link="<?php the_permalink(); ?>">

                    <figure><?php the_post_thumbnail('custom-thumbnail'); ?></figure>
                    <div class="portfolio-item-overlay">
                        <span><?php the_title(); ?></span>
                    </div>
                </div>
			<?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>

<?php get_footer();