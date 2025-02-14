<?php
/*
Plugin Name: Custom Portfolio Plugin
Description: Adds portfolio custom post type with thumbnails and fullscreen view
Version: 1.0
*/

if (!defined('ABSPATH')) {
	exit;
}

// Register Custom Post Type
function register_portfolio_post_type() {
	$labels = array(
		'name'               => 'Portfolio',
		'singular_name'      => 'Portfolio Item',
		'menu_name'          => 'Portfolio',
		'add_new'           => 'Add New',
		'add_new_item'      => 'Add New Portfolio Item',
		'edit_item'         => 'Edit Portfolio Item',
		'new_item'          => 'New Portfolio Item',
		'view_item'         => 'View Portfolio Item',
		'search_items'      => 'Search Portfolio',
		'not_found'         => 'No portfolio items found',
		'not_found_in_trash'=> 'No portfolio items found in trash'
	);

	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'has_archive'         => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'query_var'           => true,
		'rewrite'             => array('slug' => 'portfolio'),
		'capability_type'     => 'post',
		'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
		'menu_icon'           => 'dashicons-format-gallery'
	);

	register_post_type('portfolio', $args);
}
add_action('init', 'register_portfolio_post_type');

// Add custom template for archive and single portfolio pages
function portfolio_template($template) {
	if (is_post_type_archive('portfolio')) {
		$new_template = plugin_dir_path(__FILE__) . 'templates/archive-portfolio.php';
		if (file_exists($new_template)) {
			return $new_template;
		}
	}
	if (is_singular('portfolio')) {
		$new_template = plugin_dir_path(__FILE__) . 'templates/single-portfolio.php';
		if (file_exists($new_template)) {
			return $new_template;
		}
	}
	return $template;
}
add_filter('template_include', 'portfolio_template');

// Enqueue scripts and styles
function portfolio_enqueue_scripts() {
	if (is_post_type_archive('portfolio') || is_singular('portfolio')) {
		wp_enqueue_style('portfolio-style', plugin_dir_url(__FILE__) . 'assets/css/portfolio.css');
		wp_enqueue_script('portfolio-script', plugin_dir_url(__FILE__) . 'assets/js/portfolio.js', array('jquery'), '1.0', true);
	}
}
add_action('wp_enqueue_scripts', 'portfolio_enqueue_scripts');

// Create necessary directories and files on plugin activation
function portfolio_plugin_activation() {
	// Create required directories
	$directories = array(
		'templates',
		'assets/css',
		'assets/js'
	);

	foreach ($directories as $dir) {
		$path = plugin_dir_path(__FILE__) . $dir;
		if (!file_exists($path)) {
			wp_mkdir_p($path);
		}
	}

	// Copy template files if they don't exist
	copy_template_file('archive-portfolio.php');
	copy_template_file('single-portfolio.php');
	copy_asset_file('css/portfolio.css');
	copy_asset_file('js/portfolio.js');
}
register_activation_hook(__FILE__, 'portfolio_plugin_activation');

function copy_template_file($filename) {
	$source = plugin_dir_path(__FILE__) . 'templates-default/' . $filename;
	$destination = plugin_dir_path(__FILE__) . 'templates/' . $filename;

	if (!file_exists($destination) && file_exists($source)) {
		copy($source, $destination);
	}
}

function copy_asset_file($path) {
	$source = plugin_dir_path(__FILE__) . 'assets-default/' . $path;
	$destination = plugin_dir_path(__FILE__) . 'assets/' . $path;

	if (!file_exists($destination) && file_exists($source)) {
		copy($source, $destination);
	}
}

function custom_plugin_add_image_sizes() {
	add_image_size('custom-thumbnail', 390, 260, true); // true = przycinanie do wymiarów
}
add_action('after_setup_theme', 'custom_plugin_add_image_sizes');
