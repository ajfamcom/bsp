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






