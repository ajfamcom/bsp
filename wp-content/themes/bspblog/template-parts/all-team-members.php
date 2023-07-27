<?php
/* Template Name:All team Members  */
$page_id = get_the_ID();
$full_banner = get_field('full_banner', $page_id);
$image_over_banner = get_field('image_over_banner', $page_id);
?>
<?php get_header();?>

<div class="inner-bnr team-bnr" style="background-image: url('<?php echo $full_banner; ?>'); background-size: cover;">
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

<div class="container">	
	<div class="col-md-12 py-5">
		<div class="row">
			<?php
			$args = array(
			'post_type'      => 'team_members',
			'posts_per_page' => -1,
			'meta_query'     => array(
				array(
					'key'     => 'member_status',
					'value'   => 'Active', 
					'compare' => '='
				),
				array(
					'key'     => 'member_display_on_homepage',
					'value'   => 'Yes', 
					'compare' => '='
				),
			),
			'meta_key'       => 'member_sort_order', 
			'orderby'        => 'meta_value_num',    
			'order'          => 'ASC',              
		    );
    
          $query = new WP_Query( $args );
    
			if ($query->have_posts()) :
					while ($query->have_posts()) :
						$query->the_post();
						$post_id = get_the_ID();
						$fullname = get_field('full_name', $post_id);
						$education = get_field('education', $post_id);
						$designation = get_field('designation', $post_id);
						$image = get_field('profile_image', $post_id);
						$permalink = get_permalink($post_id);

						?> 
							<div class="single-team-member col-md-4">
								<div class="member-image-square"><img src="<?php echo $image['url'];?>" /></div>
								<h4 class="member-details"><span class="member-name"><?php echo $fullname; ?></span>,<span class="member-education"><?php echo $education;?></span></h4>
								<p class="other-details"><span class="member-position"><?php echo $designation;?></span></p>
								<p class="bio"><a href="<?php echo $permalink;?>">Full Bio -></a></p>
							</div>
					<?php endwhile; ?>
			<?php endif;?>
        </div>
		
    </div>
</div>	
<?php 
get_footer();
?>