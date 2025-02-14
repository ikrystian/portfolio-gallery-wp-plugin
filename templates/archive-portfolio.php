<?php
get_header(); ?>
<main>
    <div class="portfolio-container">
        <div class="portfolio-preview">
            <div class="loading-spinner"></div>
            
            <img src="" alt="" class="preview-image">
            <div class="glitch__layers">
                <div class="glitch__layer"></div>
                <div class="glitch__layer"></div>
                <div class="glitch__layer"></div>
            </div>
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
                <a href="<?php the_permalink(); ?>" class="portfolio-item fade-in"
                     data-full="<?php echo esc_url($full_image); ?>"
                >
                    <figure style="view-transition-name: portfolio-image;"><?php the_post_thumbnail('custom-thumbnail'); ?></figure>
                    <div class="portfolio-item-overlay">
                        <span><?php the_title(); ?></span>
                    </div>
                </a>
			<?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const portfolioItems = document.querySelectorAll('.portfolio-item');
            portfolioItems.forEach((item, index) => {
                item.style.animationDelay = `${index * 0.2}s`;
                item.classList.add('fade-in');
            });
        });
    </script>

<?php get_footer(); ?>