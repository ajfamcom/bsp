<?php
/**
 * Plugin Name: Manage Services
 * Description: Plugin for adding custom content with title, short-descriptions,full-description and image.
 * Version: 1.0.0
 * Author: Famcom
 * Author URI: https://famcom.com
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Invalid request.' );
}



function custom_plugin_services_post_type() {
	$labels = array(
	'name' => __('Manage Services', 'manage-services'),
	'singular_name' => __('Manage Services ', 'manage-services'),
	'add_new' => __('New Service', 'manage-services'),
	'add_new_item' => __('Add new service', 'manage-services'),
	'edit_item' => __('Edit Manage Services ', 'manage-services'),
	'new_item' => __('New Manage Services ', 'manage-services'),
	'view_item' => __('View Services ', 'manage-services'),
	'search_item' => __('Search Services ', 'manage-services'),
	'not_found' => __('No Services Found', 'manage-services'),
	'not_found_in_trash' => __('No Services found in trash', 'manage-services')
	);
    $args = array(
        'public' => true,
        'labels'  => $labels,
        'supports' => array( 'title', 'editor', 'thumbnail' ),
    );
    register_post_type( 'manage_services', $args );


 $taxonomy_args = array(
        'hierarchical' => true,
        'label' => 'Service Categories',
        'rewrite' => array( 'slug' => 'service-category' ),
    );
    register_taxonomy( 'manage_services', 'manage_services', $taxonomy_args );

    
}
add_action( 'init', 'custom_plugin_services_post_type' );




