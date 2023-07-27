<?php
/* Template Name:Custom Team Members Template  */
 
//$post_id = $_GET['id'];
						//$fullname = get_field('full_name', $post_id);
						//$education = get_field('education', $post_id);
						//$designation = get_field('designation', $post_id);
						//$image = get_field('profile_image', $post_id);
?>
<?php get_header();?>

<div class="inner-bnr team-bnr">
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
				<img class="img-fluid bnr-simg" src="<?php bloginfo('template_directory'); ?>/assets/images/team-side-bnrimg.png" alt="side-bnrimg">
			</div>
		</div>
	</div>
</div>

<div class="container">	
	<div class="col-md-12 py-5">
		<div class="row">			
							<div class="single-team-member col-md-4">
                            <h4 class="member-details"><span class="member-name"><?php //echo $fullname; ?></span>,<span class="member-education"><?php //echo //$education;?></span></h4>
							<div class="member-image-square"><img src="<?php //echo $image['url'];?>" /></div></div>
                            <div class="single-team-member col-md-8">								
								<p class="other-details"><span class="member-position"><?php //echo $designation;?></span></p>
								<p class="bio"><?php //the_content();?></p>
							</div>
					
        </div>
		
    </div>
</div>	
<?php 
get_footer();
?>