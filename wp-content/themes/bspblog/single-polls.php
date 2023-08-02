<?php
/* Template Name:Custom Polls Template  */
$page_id = get_custom_page_id('team_members', 'our-team');
$full_banner = get_field('full_banner', $page_id);
$image_over_banner = get_field('image_over_banner', $page_id);
if (have_posts()) :
	while (have_posts()) : the_post();
		$post_id = get_the_ID();
		$fullname = get_field('full_name', $post_id);
		$education = get_field('education', $post_id);
		$designation = get_field('designation', $post_id);
		$image = get_field('profile_image', $post_id);
		$contact_email = get_field('contact_email', $post_id);
		$contact_phone = get_field('contact_phone', $post_id);
	endwhile;
endif;
?>
<?php get_header(); ?>

<div class="single-inner-bnr">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="row page-banner">
					<?php echo get_breadcrumbs(); ?>
					<div class="page-title">
						<h3><?php echo get_the_title(); ?></h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="col-md-12 py-5">
		<div class="row">
           <?php 
		   while (have_posts()) :
			the_post();
		   ?>
			<div class="single-poll col-12">
				<div class="single-poll-content">
					<div class="-single-poll-image">
					<img src="<?php echo $image['url']; ?>" />					
				    </div>
					<div class="single-poll-info">
						<h1 class="poll-title"><?php the_title();?></h1>						
						<?php the_content(); ?>
					</div>
					<div>
					<?php astra_primary_content_bottom(); ?>
					</div>
				</div>
			</div>
          <?php endwhile; ?>
		</div>

	</div>
</div>
<?php
get_footer();
?>