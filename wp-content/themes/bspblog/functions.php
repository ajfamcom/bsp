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


/*unction fetchSearchResult(){
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
*/

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
/*
 function custom_posts_search($search, $query) {
    global $wpdb;

    
    if (is_search() && !empty($query->query_vars['s'])) {

		
      
         $search_term = trim($query->query_vars['s']);
		    

		  $mquery='SELECT * FROM wp_posts WHERE (`post_content` LIKE "%'.$search_term.'%" || `post_title` LIKE "%'.$search_term.'%" || `post_excerpt` LIKE "%'.$search_term.'%") AND post_type="wpdmpro" AND post_status="publish" GROUP BY ID';
		$result =$wpdb->get_results($mquery);	
	
	 
		if($result){
		$search='';
		foreach($result as $data){	
			
			$search = "AND ({$wpdb->posts}.post_type='post') AND ({$wpdb->posts}.post_content LIKE '%[wpdm_package id=\'{$data->ID}\']%')";
		}
		
		return $search;
	   }
	   else{
		global $wpdb;
        $search = " AND 0 = 1";
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
 
 */
add_filter('posts_search', 'custom_posts_search', 10, 2);

function custom_posts_search($search, $query) {
    global $wpdb;

if (is_search() && !empty($query->query_vars['s'])) {		
    $search_term = trim($query->query_vars['s']);
    $visitor_ip = get_visitor_ip_address();
    $tablename = $wpdb->prefix . 'searchdata'; // Include the table prefix
    $insert_data = array(
        'keyword' => $search_term,
        'visitor_ip' => $visitor_ip,
        'search_page'=>'top_header'
    );
    $wpdb->insert($tablename, $insert_data);

    $search = '';
    $search .= " AND ({$wpdb->posts}.post_type='post' || {$wpdb->posts}.post_type='bsp_custom_polls' || {$wpdb->posts}.post_type='news_analysis' || {$wpdb->posts}.post_type='team_members' || {$wpdb->posts}.post_type='manage_services') ";	
    $search .= " AND ({$wpdb->posts}.post_content LIKE '%$search_term%' || {$wpdb->posts}.post_title LIKE '%$search_term%' || {$wpdb->posts}.post_excerpt LIKE '%$search_term%')";

    return $search;   
}
else if (is_search() && empty($query->query_vars['s'])) {	
    $search = " AND 0 = 1";
    return $search;
}

    
}

/* function remove_ast_container_class() {
    ?>
    <script>
        $(document).ready(function($) {
            // Replace 'site-primary-header-wrap' with the ID or class of the parent element of the div
            $('.site-primary-header-wrap').removeClass('ast-container');
			$('.site-primary-header-wrap').addClass('container');
        });
    </script>
    <?php
}
add_action('wp_footer', 'remove_ast_container_class'); */

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

function get_breadcrumbs() {
    $breadcrumbs = '<div class="breadcrumbs">';
    $breadcrumbs .= '<a href="' . home_url() . '">Home</a>';

    if (is_category() || is_single()) {
        $category = get_the_category();
        if ($category) {
            $breadcrumbs .= '';//'<span class="separator"> <i class="fa-solid fa-angles-right"></i> </span>';
            $breadcrumbs .= '';//'<a href="' . get_category_link($category[0]->term_id) . '">' . $category[0]->name . '</a>';
        }
    } elseif (is_page()) {
        $post = get_post();
        if ($post->post_parent) {
            $ancestors = get_post_ancestors($post->ID);
            $ancestors = array_reverse($ancestors);
            foreach ($ancestors as $ancestor) {
                $breadcrumbs .= '<span class="separator"> <i class="fa-solid fa-angles-right"></i> </span>';
                $breadcrumbs .= '<a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a>';
            }
        }
    }

    $breadcrumbs .= '<span class="separator"> <i class="fa-solid fa-angles-right"></i> </span>';
    $breadcrumbs .= '<span class="current">' . get_the_title() . '</span>';
    $breadcrumbs .= '</div>';

    return $breadcrumbs;
}


/*function remove_extra_p_tags($content) {
   
    $content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/i', '$1$2$3', $content);

    
    $content = preg_replace('/<p>\s*(.*)\s*<\/p>/i', '$1', $content);
    $content = preg_replace('/<div>\s*(.*)\s*<\/div>/i', '$1', $content);

    return $content;
}
add_filter('the_content', 'remove_extra_p_tags');*/

function remove_extra_p_tags_from_title($title) {
    // Remove <p> and <div> tags from the beginning and end of the title
    $title = preg_replace('/<p>\s*(.*)\s*<\/p>/i', '$1', $title);
    $title = preg_replace('/<div>\s*(.*)\s*<\/div>/i', '$1', $title);

    return $title;
}
add_filter('the_title', 'remove_extra_p_tags_from_title');

function get_custom_page_id($custom_post_type,$parent_slug){

$rewrite_slug = get_post_type_object($custom_post_type)->rewrite['slug'];	
	$page = get_page_by_path($parent_slug);
	
	if ($page) {
		
		$page_id = $page->ID;
		
	} else {
    $page_id =0;
}

return $page_id;
}

function custom_contact_form() {
    if ( isset( $_POST['submit_form'] ) ) {      

        require_once ABSPATH . WPINC . '/pluggable.php';
        $aname="BSP Research";
        $name = sanitize_text_field( $_POST['fname'] );
        $email = sanitize_email( $_POST['email'] );
        $message = esc_textarea( $_POST['message'] );
        $organization = sanitize_text_field( $_POST['organization'] );
        $is_signup = isset($_POST['signup'])?'Yes':'No';       
        $subject = 'Contact Form Submission';
        $to = get_option('admin_email');
        $headers = array(
            'From: ' . $aname . ' <' . $email . '>',
            'Content-Type: text/html; charset=UTF-8',
        );
        $all_message ='<p>Find details of a new contactus submission</p>';
        $all_message .='<p>Name:'.$name.'</p>';
        $all_message .='<p>Organization:'.$organization.'</p>';
        $all_message .='<p>Email:'.$email.'</p>';
        $all_message .='<p>Message:'.$message.'</p>';

        //save in db
        global $wpdb;        
        $table_name = $wpdb->prefix . 'contactus';

        $data = array(
            'fullname' => $name,
            'email' => $email,
            'message' => $message,
            'organization' => $organization,
            'is_signup' => $is_signup      
        );
        //mail to user
        $user_subject = 'Verify your email';
        $user_to = $email;
        $admin_name='BSP Research';
        $user_headers = array(
            'From: ' . $admin_name . ' <' . $email . '>',
            'Content-Type: text/html; charset=UTF-8',
        );
        $code=base64_encode($email);
        $user_link='<a href="https://bsp.thefamcomlab.com/verify-email?c='.$code.'">Verify Email</a>';
        $user_message='<p>Please click the link to verify your email address'.$user_link.'</p>';
    if(!empty($name) && !empty($email) && !empty($message)){
        $wpdb->insert( $table_name, $data );
        //wp_mail('dipti@famcominc.com', 'Test Email', 'This is a test email from WordPress.');
        wp_mail( $to, $subject, $all_message, $headers );  
        wp_mail( $user_to, $user_subject, $user_message, $user_headers );      
        $msg="Thank you for your inquiry! We will get back to you within 48 hours.We've sent you a confirmation email, please click the link to verify your address.";
    }
    else{
        $error="Please fill the reqired fields!";
    }
   
        //verfy user
        
    }
    ?>

    <div class="contact-form">		
        <h2>Contact Us</h2>
		<?php if(isset($msg)){?>
			<div class="alert alert-success alert-dismissible fade show mt-3 "><?php echo $msg;?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		    </div>
		<?php } ?>
        <?php if(isset($error)){?>
			<div class="alert alert-danger alert-dismissible fade show mt-3 "><?php echo $error;?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		    </div>
		<?php } ?>
        <form method="post" action="<?php echo site_url('contact-us/');?>">
            <div class="mb-3">
                <!-- <label for="name" class="form-label">Name</label> -->
                <input type="text" class="form-control" id="fname" name="fname" placeholder="Name*" required>
            </div>
            <div class="mb-3">
                <!-- <label for="organization" class="form-label">Organization</label> -->
                <input type="text" class="form-control" id="organization" name="organization" placeholder="Organization">
            </div>
            <div class="mb-3">
                <!-- <label for="email" class="form-label">Email</label> -->
                <input type="email" class="form-control" id="email" name="email" placeholder="Email*" required>
            </div>
            <div class="mb-3">
                <!-- <label for="message" class="form-label">Message</label> -->
                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Message*" required></textarea>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="signup" name="signup">
                <label class="form-check-label" for="signup">Sign me up for email list, promotions, and more</label>
            </div>
            <div class="text-center">
            <input type="submit" name="submit_form" class="btn btn-primary mt-4" value="Submit">
            </div>
        </form>
    </div>

    <?php
}
add_shortcode( 'custom_contact_form', 'custom_contact_form' );


/*function custom_polls_post_type() {
	$labels = array(
	'name' => __('Polls', 'polls'),
	'singular_name' => __('Polls ', 'polls'),
	'add_new' => __('New Poll ', 'polls'),
	'add_new_item' => __('Add New Poll ', 'polls'),
	'edit_item' => __('Edit Poll ', 'polls'),
	'new_item' => __('New Poll ', 'polls'),
	'view_item' => __('View Poll ', 'polls'),
	'search_item' => __('Search Polls ', 'polls'),
	'not_found' => __('No Poll Found', 'polls'),
	'not_found_in_trash' => __('No Poll found in trash', 'polls')
	);
    $args = array(
        'public' => true,
        'labels'  => $labels,
        'supports' => array( 'title', 'editor', 'thumbnail','comments' ),
        'taxonomies' => array('post_tag'),
    );
    register_post_type( 'polls', $args );
}*/

    //add_action('init','custom_polls_post_type');

    function custom_bsp_polls_post_type() {
        $labels = array(
        'name' => __('Polls', 'polls'),
        'singular_name' => __('Polls ', 'polls'),
        'add_new' => __('New Poll ', 'polls'),
        'add_new_item' => __('Add New Poll ', 'polls'),
        'edit_item' => __('Edit Poll ', 'polls'),
        'new_item' => __('New Poll ', 'polls'),
        'view_item' => __('View Poll ', 'polls'),
        'search_item' => __('Search Polls ', 'polls'),
        'not_found' => __('No Poll Found', 'polls'),
        'not_found_in_trash' => __('No Poll found in trash', 'polls')
        );
        $args = array(
            'public' => true,
            'labels'  => $labels,
            'supports' => array( 'title', 'editor', 'thumbnail','comments' ),
            'taxonomies' => array('post_tag'),
        );
        register_post_type( 'bsp_custom_polls', $args );
    }
    
        add_action('init','custom_bsp_polls_post_type');

    function custom_comment_form_fields($fields) {
        
        /*$fields['custom_field'] = '<div class="mb-3"><label for="custom_field" class="form-label">Custom Field</label> <span class="required">*</span>
            <input type="text" name="custom_field" id="custom_field" class="form-control" /></div>';*/
    
        
        $comment_field = $fields['comment'];
        unset($fields['comment']);
        //$fields['comment'] = $comment_field;
        $website_field = $fields['url'];
        unset($fields['url']);
        //$fields['url'] = $website_field;

        $author_field = $fields['author'];
        unset($fields['author']);

        $author_field = $fields['email'];
        unset($fields['email']);
       // $fields['author'] = $author_field;

        $checkbox_field = $fields['cookies'];
        unset($fields['cookies']);
        //$fields['cookies'] = $checkbox_field;

        //$fields['url'] = str_replace('class="comment-form-url"', 'class="comment-form-url form-control"', $fields['url']);
        //$fields['author'] = str_replace('class="comment-form-author"', 'class="comment-form-author form-control"', $fields['author']);
       // $fields['email'] = str_replace('class="comment-form-email"', 'class="comment-form-email form-control"', $fields['email']);
            $fields['comment'] = '<div class="row"><div class="mb-3 col-md-12"><label for="comment">Comment <span class="required">*</span></label> <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea></div>'; 
            $fields['url'] = '<div class="mb-3 col-md-6"><label for="url" class="form-label">Website</label> <span class="required">*</span>
            <input type="text" name="url" id="url" class="form-control" /></div>';
            $fields['author'] = '<div class="mb-3 col-md-6"><label for="author" class="form-label">Name</label> <span class="required">*</span>
            <input type="text" name="author" id="author" class="form-control" /></div>';
            $fields['email'] = '<div class="mb-3 col-md-12"><label for="email" class="form-label">Email</label> <span class="required">*</span>
            <input type="text" name="email" id="email" class="form-control" /></div></div>';    
    
        return $fields;
    }
    add_filter('comment_form_fields', 'custom_comment_form_fields');

    function get_visitor_ip_address() {
        $ip_address = '';
    
        if (isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR'])) {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }
    
        return $ip_address;
    }
    
function get_pdf_metadata_custom($postid,$type='polls') {
    $text='';
    $fpdi_pdf_parser_path = get_template_directory() . '/pdfparser-master/alt_autoload.php-dist';
    require_once $fpdi_pdf_parser_path;
    
    if($type=='polls'){
        
        $file = get_field('pdf_attachment', $postid);
    }
    else{
        $file = get_field('post_pdf_attachment', $postid);
    }
   
    if($file){
        $file_path='/var/www/html/bsp'.wp_make_link_relative($file['url']);//'/var/www/html/bsp/wp-content/uploads/2023/08/Univision-Arizona-Crosstab-October-2022.pdf';//
        $metaData='';
        
      
           
        $parser = new \Smalot\PdfParser\Parser();
        $pdf    = $parser->parseFile($file_path);
        $text   = $pdf->getDetails();
    }
    


        return $text;
}

function get_multiple_pdf_metadata_custom($postid,$type='polls') {
    $text='';
    //wp_set_post_tags($postid, array(), false);
    $custom_field_value='';
    $fpdi_pdf_parser_path = get_template_directory() . '/pdfparser-master/alt_autoload.php-dist';
    require_once $fpdi_pdf_parser_path;
    
    if($type=='polls'){
        
        $file_array = get_field('multiple_pdf_attachments', $postid);
        
    }
    else{
        $file_array_post = get_field('multiple_pdf_attachment_for_post', $postid);
    }
   
   if($file_array){

    foreach($file_array as $arr){
       if(!empty($arr['poll_pdf_attachment']['url'])){
       $file_path='/var/www/html/bsp'.wp_make_link_relative($arr['poll_pdf_attachment']['url']);//'/var/www/html/bsp/wp-content/uploads/2023/08/Univision-Arizona-Crosstab-October-2022.pdf';//
     
      
           
        $parser = new \Smalot\PdfParser\Parser();
        $pdf    = $parser->parseFile($file_path);
        $metadata   = $pdf->getDetails();

        //echo '<pre>';print_r($metadata);die();
        if (strpos($metadata['Keywords'], ',') !== false) {
           
            $keywordsArray = explode(",", $metadata['Keywords']);
            $keywordsArray = array_map('trim', array_filter($keywordsArray));
        } 
         elseif (strpos($metadata['Keywords'], ' ') !== false) {
            
            $keywordsArray = preg_split("/\r\n|\n|\r/", $metadata['Keywords']);        
            $keywordsArray = array_map('trim', array_filter($keywordsArray));
        } 
        else{
          
            $keywordsArray = preg_split("/\r\n|\n|\r/", $metadata['Keywords']);        
            $keywordsArray = array_map('trim', array_filter($keywordsArray));
        }
       
        
         if($keywordsArray){
           foreach($keywordsArray as $val){            
                $custom_field_value .= $val.',';            
          }
        }
    }

    }

   }
    /*****for post */
    if($file_array_post){

        foreach($file_array_post as $arr){
           if(!empty($arr['post_pdf_attachment']['url'])){
           $file_path='/var/www/html/bsp'.wp_make_link_relative($arr['post_pdf_attachment']['url']);//'/var/www/html/bsp/wp-content/uploads/2023/08/Univision-Arizona-Crosstab-October-2022.pdf';//
         
          
               
            $parser = new \Smalot\PdfParser\Parser();
            $pdf    = $parser->parseFile($file_path);
            $metadata   = $pdf->getDetails();
    
            //echo '<pre>';print_r($metadata);die();
            if (strpos($metadata['Keywords'], ',') !== false) {
               
                $keywordsArray = explode(",", $metadata['Keywords']);
                $keywordsArray = array_map('trim', array_filter($keywordsArray));
            } 
             elseif (strpos($metadata['Keywords'], ' ') !== false) {
                
                $keywordsArray = preg_split("/\r\n|\n|\r/", $metadata['Keywords']);        
                $keywordsArray = array_map('trim', array_filter($keywordsArray));
            } 
            else{
              
                $keywordsArray = preg_split("/\r\n|\n|\r/", $metadata['Keywords']);        
                $keywordsArray = array_map('trim', array_filter($keywordsArray));
            }
           
            
             if($keywordsArray){
               foreach($keywordsArray as $val){            
                    $custom_field_value .= $val.',';            
              }
            }
        }
    
        }
    
       }
   
       global $wpdb;

       $attachments = $wpdb->get_results(
           $wpdb->prepare(
               "SELECT ID, post_mime_type
               FROM $wpdb->posts
               WHERE post_parent = %d
               AND post_type = 'attachment'
               AND post_mime_type = %s                            
               ",
               $postid,
               'application/pdf'
           )
       );
       //$post = get_post($postid);
       
       
       if($attachments){
        //$attachment_urls = get_attached_media('application/pdf', $postid, 'urls');
       
       foreach ($attachments as $attachment) {
        
           // Retrieve attachment metadata and perform actions
           $attachment_id = $attachment->ID;
          

           $attachment_url = wp_get_attachment_url($attachment_id);
           
           $file_path='/var/www/html/bsp'.wp_make_link_relative( $attachment_url);
                $parser = new \Smalot\PdfParser\Parser();
                $pdf    = $parser->parseFile($file_path);
                $metadata   = $pdf->getDetails();
                
      
       if (strpos($metadata['Keywords'], ',') !== false) {
           
        $keywordsArray = explode(",", $metadata['Keywords']);
        $keywordsArray = array_map('trim', array_filter($keywordsArray));
    } 
     elseif (strpos($metadata['Keywords'], ' ') !== false) {
        
        $keywordsArray = preg_split("/\r\n|\n|\r/", $metadata['Keywords']);        
        $keywordsArray = array_map('trim', array_filter($keywordsArray));
    } 
    else{
      
        $keywordsArray = preg_split("/\r\n|\n|\r/", $metadata['Keywords']);        
        $keywordsArray = array_map('trim', array_filter($keywordsArray));
    }      

            if($keywordsArray){
           foreach($keywordsArray as $val){            
                $custom_field_value .= $val.',';            
          }
        }
       
   } 
}
   
return $custom_field_value;
}

/* 
function delete_tags_when_attachment_removed($attachment_id) {
    
    $post_id = wp_get_post_parent_id($attachment_id);

    if ($post_id) {
        
        $existing_tags = wp_get_post_tags($post_id, array('fields' => 'names'));

       
        $attachment_tags = wp_get_post_tags($attachment_id, array('fields' => 'names'));
        $updated_tags = array_diff($existing_tags, $attachment_tags);

        
        wp_set_post_tags($post_id, $updated_tags, false);
    }
}

add_action('delete_attachment', 'delete_tags_when_attachment_removed'); */


/****new code**** */
function save_pdf_meta($post_id) {
   
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    //if (!current_user_can('edit_post', $post_id)) return;

    
    $post_type = get_post_type($post_id);
    //wp_set_post_tags($post_id, array(), false);

    
    if ($post_type === 'bsp_custom_polls') {
        $metadata=get_multiple_pdf_metadata_custom($post_id,'polls');
                if($metadata)
            {
            
                $keywordsArray = explode(",", $metadata);
                $keywordsArray = array_map('trim', array_filter($keywordsArray));
                $existing_tags = wp_get_post_tags($post_id, array('fields' => 'names','status'=>'published'));                 
                $combined_tags = array_unique(array_merge($existing_tags, $keywordsArray));
                wp_set_post_tags($post_id, $combined_tags, false);
            } else{
                $existing_tags = wp_get_post_tags($post_id, array('fields' => 'names','status'=>'published'));
                wp_set_post_tags($post_id, $existing_tags, false);
            }

            

    } elseif ($post_type === 'post') {
        $metadata=get_multiple_pdf_metadata_custom($post_id,'post');
        if($metadata)
    {
    
        $keywordsArray = explode(",", $metadata);
        $keywordsArray = array_map('trim', array_filter($keywordsArray));
        $existing_tags = wp_get_post_tags($post_id, array('fields' => 'names','status'=>'published'));                 
        $combined_tags = array_unique(array_merge($existing_tags, $keywordsArray));
        wp_set_post_tags($post_id, $combined_tags, false);
    } else{
        $existing_tags = wp_get_post_tags($post_id, array('fields' => 'names','status'=>'published'));
        wp_set_post_tags($post_id, $existing_tags, false);
    }

    }
 
}


add_action('save_post', 'save_pdf_meta' , 20);


/********** */





add_filter('the_content', 'limit_custom_post_content');

function limit_custom_post_content($content) {
   
    if (get_post_type() === 'bsp_custom_polls') {
        
        $word_limit = 50;
        $words = explode(' ', $content);
        if (count($words) > $word_limit) {
            $content = implode(' ', array_slice($words, 0, $word_limit));
            $content .= '...'; 
        }
    }

    return $content;
}

function trim_content_custom($content){
    
        
        $word_limit = 50;
        $words = explode(' ', $content);
        if (count($words) > $word_limit) {
            $content = implode(' ', array_slice($words, 0, $word_limit));
            $content .= '...'; 
        }

    return $content;
}


// Override the custom logo output
function custom_override_custom_logo($html) {
    $theme_directory = get_template_directory_uri();

    
    $custom_image_url = esc_url($theme_directory . '/assets/images/logo-final.svg'); 

    $custom_logo_image = '<a href="'.site_url('/').'"><img src="'.$custom_image_url.'" alt="' . get_bloginfo('name') . '" width="151px" height="77px"></a>';

    // Return the custom logo image
    return $custom_logo_image;
}
add_filter('get_custom_logo', 'custom_override_custom_logo');

function custom_excerpt_more($more) {
    $post_id = get_the_ID();
			$post_type = get_post_type($post_id);
			
			if($post_type=='manage_services')
			{
				$permalink=site_url('services');
			}
			elseif($post_type=='news_analysis')
			{
				$link_data = get_field('external_link', $post_id);
				$link='javascript:void(0)';
				$target="";
				if($link_data){
					$link= $link_data;
					$target='_blank';
				}
				$permalink=$link;
			}
			else{
				$permalink = get_permalink($post_id);
			}
            //if($post_type=='manage_services' && $post_type=='news_analysis') {
                return ' <p><a class="read-more" href="' . $permalink . '" target="_blank">Read More</a></p>';
            //}            
    
}
add_filter('excerpt_more', 'custom_excerpt_more');



/* function delete_attachments_on_content_update($post_id) {
    $post = get_post($post_id);

    if ($post && $post->post_type === 'post') { // Adjust post type if needed
        $attachments = get_attached_media('', $post_id);

        foreach ($attachments as $attachment) {
            wp_delete_attachment($attachment->ID, true);
        }
    }
}



add_action('edit_post', 'delete_attachments_on_content_update'); */