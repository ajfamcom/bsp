<?php
/* Template Name:Custom Team Members Template  */
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

			<div class="single-team-member col-12">
				<div class="single-team-mem-content">
					<div class="-single-member-image">
					<img src="<?php echo $image['url']; ?>" />
				    <p><i class="fa fa-envelope"></i><a href="mailto:<?php echo $contact_email; ?>"><?php echo $contact_email; ?></a></p>
                    <p><i class="fa fa-phone"></i><a href="tel:<?php echo $contact_phone; ?>"><?php echo $contact_phone; ?></a></p>

				    </div>
					<div class="single-member-info">
						<h1 class="member-details"><span class="member-name"><?php echo $fullname; ?></span>,<span class="member-education"><?php echo $education; ?></span></h1>
						<p class="other-details"><span class="member-position"><?php echo $designation; ?></span></p>
						<?php the_content(); ?>
					</div>
				</div>
			</div>

		</div>

	</div>
</div>
<?php
get_footer();
?>