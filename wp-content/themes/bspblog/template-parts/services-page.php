<?php
/* Template Name: Services Template */
$page_id = get_the_ID();
$full_banner = get_field('full_banner', $page_id);
$image_over_banner = get_field('image_over_banner', $page_id);
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

<div class="container py-5 my-md-5">
	<div class="row align-items-center py-xl-5">

	<div class="col-12 text-center">
<h1>Lorem Ipsum Dummy text</h1>
<h2>Our Clients</h2>
<p>Our clients include office holders or candidates who have run for president, Congress, governor, and state legislator, plus a variety of national, congressional, gubernatorial party committees. We also boast as clients a wide range of think tanks, universities, advocacy groups, citizen organization, and other non-profits.</p>
	</div>

		<div class="col-md-6 col-sm-6 col-12">
		<?php
$args = array(
    'post_type' => 'manage_services',
    'posts_per_page' => -1,
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
			<h1><?php the_title(); ?></h1>
			<?php the_content();?>
			<?php
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