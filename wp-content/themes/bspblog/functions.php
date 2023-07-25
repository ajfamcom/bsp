<?php
/**
 * Astra functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Define Constants
 */
define( 'ASTRA_THEME_VERSION', '4.1.6' );
define( 'ASTRA_THEME_SETTINGS', 'astra-settings' );
define( 'ASTRA_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'ASTRA_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );
define( 'ASTRA_PRO_UPGRADE_URL', 'https://wpastra.com/pro/?utm_source=dashboard&utm_medium=free-theme&utm_campaign=upgrade-now' );
define( 'ASTRA_PRO_CUSTOMIZER_UPGRADE_URL', 'https://wpastra.com/pro/?utm_source=customizer&utm_medium=free-theme&utm_campaign=upgrade' );

/**
 * Minimum Version requirement of the Astra Pro addon.
 * This constant will be used to display the notice asking user to update the Astra addon to the version defined below.
 */
define( 'ASTRA_EXT_MIN_VER', '4.1.0' );

/**
 * Setup helper functions of Astra.
 */
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-theme-options.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-theme-strings.php';
require_once ASTRA_THEME_DIR . 'inc/core/common-functions.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-icons.php';

/**
 * Update theme
 */
require_once ASTRA_THEME_DIR . 'inc/theme-update/astra-update-functions.php';
require_once ASTRA_THEME_DIR . 'inc/theme-update/class-astra-theme-background-updater.php';

/**
 * Fonts Files
 */
require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-font-families.php';
if ( is_admin() ) {
	require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-fonts-data.php';
}

require_once ASTRA_THEME_DIR . 'inc/lib/webfont/class-astra-webfont-loader.php';
require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-fonts.php';

require_once ASTRA_THEME_DIR . 'inc/dynamic-css/custom-menu-old-header.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/container-layouts.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/astra-icons.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-walker-page.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-enqueue-scripts.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-gutenberg-editor-css.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-wp-editor-css.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/block-editor-compatibility.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/inline-on-mobile.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/content-background.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-dynamic-css.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-global-palette.php';

/**
 * Custom template tags for this theme.
 */
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-attr.php';
require_once ASTRA_THEME_DIR . 'inc/template-tags.php';

require_once ASTRA_THEME_DIR . 'inc/widgets.php';
require_once ASTRA_THEME_DIR . 'inc/core/theme-hooks.php';
require_once ASTRA_THEME_DIR . 'inc/admin-functions.php';
require_once ASTRA_THEME_DIR . 'inc/core/sidebar-manager.php';

/**
 * Markup Functions
 */
require_once ASTRA_THEME_DIR . 'inc/markup-extras.php';
require_once ASTRA_THEME_DIR . 'inc/extras.php';
require_once ASTRA_THEME_DIR . 'inc/blog/blog-config.php';
require_once ASTRA_THEME_DIR . 'inc/blog/blog.php';
require_once ASTRA_THEME_DIR . 'inc/blog/single-blog.php';

/**
 * Markup Files
 */
require_once ASTRA_THEME_DIR . 'inc/template-parts.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-loop.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-mobile-header.php';

/**
 * Functions and definitions.
 */
require_once ASTRA_THEME_DIR . 'inc/class-astra-after-setup-theme.php';

// Required files.
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-admin-helper.php';

require_once ASTRA_THEME_DIR . 'inc/schema/class-astra-schema.php';

/* Setup API */
require_once ASTRA_THEME_DIR . 'admin/includes/class-astra-api-init.php';

if ( is_admin() ) {
	/**
	 * Admin Menu Settings
	 */
	require_once ASTRA_THEME_DIR . 'inc/core/class-astra-admin-settings.php';
	require_once ASTRA_THEME_DIR . 'admin/class-astra-admin-loader.php';
	require_once ASTRA_THEME_DIR . 'inc/lib/astra-notices/class-astra-notices.php';
}

/**
 * Metabox additions.
 */
require_once ASTRA_THEME_DIR . 'inc/metabox/class-astra-meta-boxes.php';

require_once ASTRA_THEME_DIR . 'inc/metabox/class-astra-meta-box-operations.php';

/**
 * Customizer additions.
 */
require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-customizer.php';

/**
 * Astra Modules.
 */
require_once ASTRA_THEME_DIR . 'inc/modules/posts-structures/class-astra-post-structures.php';
require_once ASTRA_THEME_DIR . 'inc/modules/related-posts/class-astra-related-posts.php';

/**
 * Compatibility
 */
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-gutenberg.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-jetpack.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/woocommerce/class-astra-woocommerce.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/edd/class-astra-edd.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/lifterlms/class-astra-lifterlms.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/learndash/class-astra-learndash.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-beaver-builder.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-bb-ultimate-addon.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-contact-form-7.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-visual-composer.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-site-origin.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-gravity-forms.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-bne-flyout.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-ubermeu.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-divi-builder.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-amp.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-yoast-seo.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-starter-content.php';
require_once ASTRA_THEME_DIR . 'inc/addons/transparent-header/class-astra-ext-transparent-header.php';
require_once ASTRA_THEME_DIR . 'inc/addons/breadcrumbs/class-astra-breadcrumbs.php';
require_once ASTRA_THEME_DIR . 'inc/addons/scroll-to-top/class-astra-scroll-to-top.php';
require_once ASTRA_THEME_DIR . 'inc/addons/heading-colors/class-astra-heading-colors.php';
require_once ASTRA_THEME_DIR . 'inc/builder/class-astra-builder-loader.php';

// Elementor Compatibility requires PHP 5.4 for namespaces.
if ( version_compare( PHP_VERSION, '5.4', '>=' ) ) {
	require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-elementor.php';
	require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-elementor-pro.php';
	require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-web-stories.php';
}

// Beaver Themer compatibility requires PHP 5.3 for anonymus functions.
if ( version_compare( PHP_VERSION, '5.3', '>=' ) ) {
	require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-beaver-themer.php';
}

require_once ASTRA_THEME_DIR . 'inc/core/markup/class-astra-markup.php';

/**
 * Load deprecated functions
 */
require_once ASTRA_THEME_DIR . 'inc/core/deprecated/deprecated-filters.php';
require_once ASTRA_THEME_DIR . 'inc/core/deprecated/deprecated-hooks.php';
require_once ASTRA_THEME_DIR . 'inc/core/deprecated/deprecated-functions.php';


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

    
    if (is_search() && !empty($query->query_vars['s'])) {

		
      
         $search_term = $query->query_vars['s'];
		    

		$mquery='SELECT * FROM wp_posts WHERE (`post_content` LIKE "%'.$search_term.'%" || `post_title` LIKE "%'.$search_term.'%" || `post_excerpt` LIKE "%'.$search_term.'%") AND post_type="wpdmpro" AND post_status="publish" GROUP BY ID';
		$result =$wpdb->get_results($mquery);	
	
	 
		if($result){
		 $search ='';	
		foreach($result as $data){	
			
			$search .= " ({$wpdb->posts}.post_type='post') AND ({$wpdb->posts}.post_content LIKE '%[wpdm_package id=\'{$data->ID}\']%')";
		}
		return $search;
	   }
		
    }

	else if (is_search()  && empty($query->query_vars['s'])) {

	
		global $wpdb;
        $search = " AND 0 = 1";
		return $search;
    }
	else{

	}
    
}

function remove_ast_container_class() {
    ?>
    <script>
        jQuery(document).ready(function($) {
            // Replace 'site-primary-header-wrap' with the ID or class of the parent element of the div
            $('.site-primary-header-wrap').removeClass('ast-container');
			$('.site-primary-header-wrap').addClass('container');
        });
    </script>
    <?php
}
add_action('wp_footer', 'remove_ast_container_class');

/*function replace_readmore_with_post_date( $content ) {
    global $post;
    
    // Check if it's a single post and not a page or custom post type
    if ( is_single() && $post->post_type === 'post' ) {
        $post_date = get_the_date( 'F j, Y', $post->ID );
        $read_more_text = '<a href="' . esc_url( get_permalink() ) . '">' . $post_date . '</a>';
        $content = str_replace( 'Read more', $read_more_text, $content );
    }

    return $content;
}
add_filter( 'the_content', 'replace_readmore_with_post_date' );*/
