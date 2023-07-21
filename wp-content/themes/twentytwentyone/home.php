<?php
/* Template Name: Home */

get_header(); ?>

<div>SLIDER IMAGES</div>

<div>About Us Content</div>

<div>Recent Research</div>

<div>
	<h3>Services and expertise</h3>
<?php if ( is_active_sidebar( 'services-expertise-area' ) ) : ?>
    <div class="custom-widget-area">
        <?php dynamic_sidebar( 'services-expertise-area' ); ?>
    </div>
<?php endif; ?>

</div>

<div><h3>Team Section</h3>
<?php
$page_id = 11; // Replace 123 with the ID of the page you want to retrieve data from

$page_data = get_page($page_id); // Retrieve the page data

if ($page_data) {
    $page_title = $page_data->post_title; // Get the page title
    $page_content = apply_filters('the_content', $page_data->post_content); // Get the page content
    
    // Output the page title and content
    echo '<h1>' . $page_title . '</h1>';
    echo '<div>' . $page_content . '</div>';
}
?>
</div>
<?php

get_footer();
