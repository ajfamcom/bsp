<?php
/* Template Name: Services Page Template */
$page_id = get_the_ID();
$full_banner = get_field('full_banner', $page_id);
$image_over_banner = get_field('image_over_banner', $page_id);
$top_header = get_field('top_header', $page_id);
?>
<?php get_header(); ?>
<div class="inner-bnr services-bnr" style="background-image: linear-gradient(180deg, rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('<?php echo $full_banner['url']; ?>')">
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
				<img class="img-fluid bnr-simg" src="<?php echo $image_over_banner['url'];?>" alt="side-bnrimg">
			</div>
		</div>
	</div>
</div>


<div class="container py-5 mt-xl-5 border-bottom">
    <div class="row gx-5 pt-5 pb-3">
        <div class="col-md-5">
		<?php if($top_header){?>
			<h3><i><?php echo $top_header;?></i></h3>
		<?php } ?>
		</div>
        <div class="col-md-7">
		<?php
$args = array(
    'post_type' => 'manage_services',
    'posts_per_page' => 1,
    'meta_key'       => 'page_data_sort_order', // New parameter for sorting
    'orderby'        => 'meta_value_num',    // Sort by numeric value of meta_key
    'order'          => 'ASC',              // Ascending order
);
$query = new WP_Query( $args );
if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();
        
?>
            <h3 class="services-heading"><?php the_title();?></h3>
			<?php the_content();?>
<?php } 
wp_reset_postdata();
}
?>
        </div>
    </div>
</div>


<div class="container pt-3 pb-5 mt-md-3 mb-mb-5">
	<div class="row align-items-center py-xl-5">

		<div class="col-md-6 col-sm-6 col-12">
		<?php
$args = array(
    'post_type' => 'manage_services',
    'posts_per_page' => -1,
    'meta_key'       => 'page_data_sort_order', 
    'orderby'        => 'meta_value_num',    
    'order'          => 'ASC',
	         
);
$query = new WP_Query( $args );
if ($query->have_posts()) {
	$iteration = 1;
    while ($query->have_posts()) {
		
        $query->the_post();
        $post_id = get_the_ID();
        if ($iteration > 1) {
?>
			<h1><?php the_title(); ?></h1>
			<?php the_content();?>
			<?php
			
    }
	$iteration++; 
}
 wp_reset_postdata();    
} 
?>  			
		</div>
		<div class="col-md-6 col-sm-6 col-12">
		     <?php
				
				if (has_post_thumbnail($page_id)) {   
					$thumbnail_url = get_the_post_thumbnail_url($page_id, 'full');    
					echo '<img class="img-fluid" src="' . esc_url($thumbnail_url) . '" alt="' . get_the_title() . '">';
				}
             ?>
		</div>
	</div>
</div>

<?php 
get_footer();
?>