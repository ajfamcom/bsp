<?php
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


function custom_news_and_analysis_register_post_type() {
	$labels = array(
	'name' => __('News And Analysis', 'news-and-analysis'),
	'singular_name' => __('News And Analysis ', 'news-and-analysis'),
	'add_new' => __('New News And Analysis ', 'news-and-analysis'),
	'add_new_item' => __('Add new News And Analysis ', 'news-and-analysis'),
	'edit_item' => __('Edit News And Analysis ', 'news-and-analysis'),
	'new_item' => __('New News And Analysis ', 'news-and-analysis'),
	'view_item' => __('View News And Analysis ', 'news-and-analysis'),
	'search_item' => __('Search News And Analysis ', 'news-and-analysis'),
	'not_found' => __('No News And Analysis Found', 'news-and-analysis'),
	'not_found_in_trash' => __('No News And Analysis found in trash', 'team-members')
	);
    $args = array(
        'public' => true,
        'labels'  => $labels,
        'supports' => array( 'title', 'editor', 'thumbnail' ),
    );
    register_post_type( 'news_analysis', $args );
}
add_action( 'init', 'custom_news_and_analysis_register_post_type' );


// Add the filter to modify the search query
add_filter('posts_search', 'custom_posts_search', 10, 2);

function custom_posts_search($search, $query) {
    global $wpdb;

    // Check if the current query is a search query
    if (is_search() && !empty($query->query_vars['s'])) {
        // Get the search term
        $search_term = $query->query_vars['s'];

        // Modify the search SQL query to include your custom condition for the post_content field
// $search = " AND ({$wpdb->posts}.post_content LIKE '%[wpdm_package id=%' AND {$wpdb->posts}.post_status='publish')";
$mquery='SELECT * FROM wp_posts WHERE (`post_content` LIKE "%'.$search_term.'%" || `post_title` LIKE "%'.$search_term.'%" || `post_excerpt` LIKE "%'.$search_term.'%") AND post_type="wpdmpro" AND post_status="publish" GROUP BY ID';
$result =$wpdb->get_results($mquery);	
	
   
	if($result){
		
    foreach($result as $data){	
       	
		$search .= " AND ({$wpdb->posts}.post_content LIKE '%[wpdm_package id=\'{$data->ID}\']%')";
	}
  }
		
    }

    return $search;
}