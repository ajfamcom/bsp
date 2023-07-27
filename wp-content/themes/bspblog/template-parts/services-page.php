<?php
/* Template Name: Services Template */

?>
<?php get_header(); ?>
<div class="inner-bnr services-bnr">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-8 col-12">
				<div class="row page-banner">
					<?php echo get_breadcrumbs(); ?>
					<div class="page-title">
						<h3><?php echo get_the_title(); ?></h3>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-12">
				<img class="img-fluid bnr-simg" src="<?php bloginfo('template_directory'); ?>/assets/images/services-side-bnrimg.png" alt="side-bnrimg">
			</div>
		</div>
	</div>
</div>

<div class="container py-5 my-md-5">
	<div class="row align-items-center py-md-5 my-md-5">
		<div class="col-md-6 col-sm-6 col-12">
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
        
?>
			<h2><?php the_title(); ?></h2>
			<p><?php the_content();?></p>
			<?php
    }
 wp_reset_postdata();    
} 
?>  			
		</div>
		<div class="col-md-6 col-sm-6 col-12">
		     <?php
				$post_id = get_the_ID();
				if (has_post_thumbnail($post_id)) {   
					$thumbnail_url = get_the_post_thumbnail_url($post_id, 'full');    
					echo '<img class="img-fluid" src="' . esc_url($thumbnail_url) . '" alt="' . get_the_title() . '">';
				}
             ?>
		</div>
	</div>
</div>

<?php 
get_footer();
?>