<?php
/**
 * Plugin Name: Custom Content
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
	'name' => __('Custom Content', 'custom-content'),
	'singular_name' => __('Custom Content ', 'custom-content'),
	'add_new' => __('New Custom Content ', 'custom-content'),
	'add_new_item' => __('Add new Custom Content ', 'custom-content'),
	'edit_item' => __('Edit Custom Content ', 'custom-content'),
	'new_item' => __('New Custom Content ', 'custom-content'),
	'view_item' => __('View Custom Content ', 'custom-content'),
	'search_item' => __('Search Custom Content ', 'custom-content'),
	'not_found' => __('No The Custom Content Found', 'custom-content'),
	'not_found_in_trash' => __('No The Custom Content found in trash', 'custom-content')
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
include CUSTOMCONTENT_PLUGINPATH."includes/HomeTopClass.php";
include CUSTOMCONTENT_PLUGINPATH."includes/HeaderNewsClass.php";



