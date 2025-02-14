<?php
/**
 * Template Name: Empty Page
 */

defined('ABSPATH') || exit; // Zapobiega bezpośredniemu dostępowi do pliku
?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php wp_title(); ?></title>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
    <main>
    <div class="single-portfolio">
    <a href="<?php echo get_post_type_archive_link('portfolio'); ?>" class="back-to-portfolio">
                Back to Portfolio
            </a>
        <div class="portfolio-content">
<!--            <h1>--><?php //the_title(); ?><!--</h1>-->
<!--            <div class="portfolio-date">--><?php //echo get_the_date(); ?><!--</div>-->
            <div  style="view-transition-name: portfolio-image;" class="portfolio-image" id="portfolio-image">
                <?php the_post_thumbnail('full'); ?>
            </div>
            <div class="portfolio-text">
                <?php the_content(); ?>
            </div>

        </div>
    </div>
    </main>
    <?php wp_footer(); ?>
    </body>
    </html>



