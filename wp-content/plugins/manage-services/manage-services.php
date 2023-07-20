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

define('CUSTOMCONTENT_PLUGINPATH',plugin_dir_path( __FILE__ ));
define('CUSTOMCONTENT_PLUGINURI',plugin_dir_url( __FILE__ ));

/*function myplugin_activate() {  
    //    
 }

 register_activation_hook( __FILE__, 'myplugin_activate' );
 */

function custom_plugin_register_post_type() {
	$labels = array(
	'name' => __('Manage Services', 'manage-services'),
	'singular_name' => __('Manage Services ', 'manage-services'),
	'add_new' => __('New Manage Services ', 'manage-services'),
	'add_new_item' => __('Add new Manage Services ', 'manage-services'),
	'edit_item' => __('Edit Manage Services ', 'manage-services'),
	'new_item' => __('New Manage Services ', 'manage-services'),
	'view_item' => __('View Manage Services ', 'manage-services'),
	'search_item' => __('Search Manage Services ', 'manage-services'),
	'not_found' => __('No The Manage Services Found', 'manage-services'),
	'not_found_in_trash' => __('No The Manage Services found in trash', 'manage-services')
	);
    $args = array(
        'public' => true,
        'labels'  => $labels,
        'supports' => array( 'title', 'editor', 'thumbnail' ),
    );
    register_post_type( 'custom_content', $args );


 $taxonomy_args = array(
        'hierarchical' => true,
        'label' => 'Custom Categories',
        'rewrite' => array( 'slug' => 'custom-category' ),
    );
    register_taxonomy( 'custom_category', 'custom_content', $taxonomy_args );

    
}
add_action( 'init', 'custom_plugin_register_post_type' );
//include CUSTOMCONTENT_PLUGINPATH."includes/HomeTopClass.php";
//include CUSTOMCONTENT_PLUGINPATH."includes/HeaderNewsClass.php";



