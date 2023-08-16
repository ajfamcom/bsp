<?php /**Template Name: Services and expertise */?>
<h3>Services And Expertise</h3>
<?php
$args = array(
    'post_type' => 'manage_services',
    'posts_per_page' => 4,
    'meta_key'       => 'services_sort_order', // New parameter for sorting
    'orderby'        => 'meta_value_num',    // Sort by numeric value of meta_key
    'order'          => 'ASC',              // Ascending order
);
$query = new WP_Query( $args );
if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();
        $theme_directory_uri = get_template_directory_uri();
		$noimage = $theme_directory_uri . '/assets/images/on-image-placeholder.jpg';
?>
    <div class="services-post">
    <h2><a href="<?php echo site_url('services/');?>"><?php the_title(); ?></a></h2>
	<div class="services-featured-image">
	<?php
    if (has_post_thumbnail()) {
    the_post_thumbnail(); 
    }
    else{
        echo '<img src="' . esc_url($noimage) . '" alt="Featured Image" class="attachment-post-thumbnail size-post-thumbnail wp-post-image">';
    }
    ?>
    </div>       
    </div>
        <?php
    }
 wp_reset_postdata();    
} 
?>  