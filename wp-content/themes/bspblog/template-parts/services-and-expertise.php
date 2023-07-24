<?php /**Template Name: Most Popular Posts */?>
<p><h3>Services And Expertise</h3></p>
<?php
$args = array(
    'post_type' => 'manage_services',
    'posts_per_page' => 4,
);
$query = new WP_Query( $args );
if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();
        
?>
    <div class="services-post">
    <h2><a href="#."><?php the_title(); ?></a></h2>
	<p>
	<?php
    if (has_post_thumbnail()) {
    the_post_thumbnail(); 
    }
    ?>
    </p>       
    </div>
        <?php
    }
 wp_reset_postdata();    
} 
?>  