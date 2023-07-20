<?php
/**
 * Plugin Name: Manage Team
 * Description: Plugin for adding custom content with title, short-descriptions,full-description and image.
 * Version: 1.0.0
 * Author: Famcom
 * Author URI: https://famcom.com
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Invalid request.' );
}

define('CUSTOMCONTENT_PLUGINPATH',plugin_dir_path( __FILE__ ));
define('CUSTOMCONTENT_PLUGINURI',plugin_dir_url( __FILE__ ));

/*function myplugin_activate() {  
    //    
 }

 register_activation_hook( __FILE__, 'myplugin_activate' );
 */

function custom_plugin_team_post_type() {
	$labels = array(
	'name' => __('Manage Team', 'manage-team'),
	'singular_name' => __('Manage Team ', 'manage-team'),
	'add_new' => __('New Member', 'manage-team'),
	'add_new_item' => __('Add new member', 'manage-team'),
	'edit_item' => __('Edit Team ', 'manage-team'),
	'new_item' => __('New Team ', 'manage-team'),
	'view_item' => __('View Member ', 'manage-team'),
	'search_item' => __('Search Member ', 'manage-team'),
	'not_found' => __('No Team Member Found', 'manage-team'),
	'not_found_in_trash' => __('No Team Member found in trash', 'manage-team')
	);
    $args = array(
        'public' => true,
        'labels'  => $labels,
        'supports' => array( 'title', 'editor', 'thumbnail' ),
    );
    register_post_type( 'manage_team', $args );

/*
 $taxonomy_args = array(
        'hierarchical' => true,
        'label' => 'Service Categories',
        'rewrite' => array( 'slug' => 'service-category' ),
    );
    register_taxonomy( 'manage_team', 'manage_team', $taxonomy_args );
*/
    
}
add_action( 'init', 'custom_plugin_team_post_type' );
 
