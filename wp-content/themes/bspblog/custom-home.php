<?php
/**
 * Template Name:Custom Home
 */
get_header(); ?>
<?php
$args = array(
        'post_type' => 'custom_content',
        'posts_per_page' => -1,      
    );
    
    $query = new WP_Query($args);    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();  
            $post_id = get_the_ID();
            if (has_post_thumbnail($post_id)) {   
	    $thumbnail_url = get_the_post_thumbnail_url($post_id, 'full');
            }
         }
     } 
?> 

<div class="banner-section" style="background-image: url('<?php echo $thumbnail_url; ?>'); background-size: cover;">
	    <?php	
			get_template_part( 'template-parts/home-top-section' );
		?>
</div>


<div class="container">
<div class="services-block">
		<?php	
			get_template_part( 'template-parts/services-and-expertise' );
		?>
</div>
</div>

<div class="container pb-5 mb-5">
<div class="most-popular-block pb-md-4">
	<div class="row gx-md-5">
	<div class="col-md-9">		
		<div class="row">
			<?php	
			get_template_part( 'template-parts/most-popular-posts' );
			?>
			</div>
    </div>
    <div class="col-md-3">
	<div class="row">
		<?php	
			get_template_part( 'template-parts/news-and-analysis' );
		?>
	</div>
    </div>
	</div>
</div>
</div>

<div class="team-members-block">
	<div class="container">
			<?php	
			get_template_part( 'template-parts/team-members' );
			?>
</div>
</div>
<?php 
get_footer();
?>


