<?php
// Enqueue child theme stylesheets and scripts
function child_theme_scripts() {
    // Enqueue child theme stylesheet
    wp_enqueue_style( 'child-theme-style', get_stylesheet_uri() );

    // Enqueue child theme scripts
    // wp_enqueue_script( 'child-theme-script', get_stylesheet_directory_uri() . '/js/script.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'child_theme_scripts' );

// Add your custom functions below this line
/***********search start here***********/
function fetchSearchResult(){
	$response=array();
	global $wpdb;
	$search_query=trim($_POST['searchkeyword']);
	if($search_query){
	
	$query='SELECT * FROM wp_posts WHERE (`post_content` LIKE "%'.$search_query.'%" || `post_title` LIKE "%'.$search_query.'%" || `post_excerpt` LIKE "%'.$search_query.'%") AND post_type="wpdmpro" AND post_status="publish" GROUP BY ID';
	$result =$wpdb->get_results($query);
	
	
	
   
	if($result){
		$finaldata=array();
	    $sdata=array();
    foreach($result as $data){		
		//__wpdm_files
		 $postquery = "SELECT * FROM wp_posts WHERE post_content LIKE '%[wpdm_package id=\'$data->ID\']%'  AND post_status = 'publish'";
		
		$postresult =$wpdb->get_results($postquery);
		
		foreach($postresult as $res){	
		
		$sdata['title']=$data->post_title;
		$sdata['description']=$data->post_content;
		$sdata['guid']=$data->guid; //'download/'.$data->post_title.'/?wpdmdl='.$data->ID
		$sdata['post_title']=$res->post_title;
		$sdata['post_description']=$res->post_content;
		$sdata['post_guid']=$res->guid;
		array_push($finaldata,$sdata);
		}
	}
	
	$response['result']=$finaldata;
	}
	echo json_encode($response);
}
	
	die();
}
add_action("wp_ajax_fetchSearchResult", "fetchSearchResult");
add_action("wp_ajax_nopriv_fetchSearchResult", "fetchSearchResult");

/**Team Posts*/

function custom_teammember_register_post_type() {
	$labels = array(
	'name' => __('Team Members', 'team-members'),
	'singular_name' => __('Team Members ', 'team-members'),
	'add_new' => __('New Team Member ', 'team-members'),
	'add_new_item' => __('Add new Team Member ', 'team-members'),
	'edit_item' => __('Edit Team Member ', 'team-members'),
	'new_item' => __('New Team Member ', 'team-members'),
	'view_item' => __('View Team Member ', 'team-members'),
	'search_item' => __('Search Team Member ', 'team-members'),
	'not_found' => __('No Team Member Found', 'team-members'),
	'not_found_in_trash' => __('No Team Member found in trash', 'team-members')
	);
    $args = array(
        'public' => true,
        'labels'  => $labels,
        'supports' => array( 'title', 'editor', 'thumbnail' ),
    );
    register_post_type( 'team_members', $args );

/*
 $taxonomy_args = array(
        'hierarchical' => true,
        'label' => 'Custom Team-member Categories',
        'rewrite' => array( 'slug' => 'custom-team-member-category' ),
    );
    register_taxonomy( 'custom-team-member-category', 'team_members', $taxonomy_args );

 */   
}
add_action( 'init', 'custom_teammember_register_post_type' );




