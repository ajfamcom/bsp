<?php
/* Template Name: contact Template */
$page_id = get_the_ID();
$full_banner = get_field('full_banner', $page_id);
$image_over_banner = get_field('image_over_banner', $page_id);
?>
<?php get_header();
?>

<div class="inner-bnr contact-bnr" style="background-image: linear-gradient(180deg, rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('<?php echo $full_banner['url']; ?>')">
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
				<img class="img-fluid bnr-simg" src="<?php echo $image_over_banner['url'];?>"  alt="side-bnrimg">
			</div>
		</div>
	</div>
</div>

<div class="container py-5 my-md-5">
	<div class="row py-xl-5">
		<div class="col-md-4 col-sm-4 col-12">
			<h2>Start working with our team today</h2>
			<p>Interested in polling or message testing research? Focus groups or qualitative interviews? Modeling and data analytics? Contact us today to discuss the possibilities...</p>
			<ul class="contact-social-links">
				<li><a href="#"><i class="fa-brands fa-facebook-f"></i> - Facebook</a></li>
				<li><a href="#"><i class="fa-brands fa-instagram"></i> - Instagram</a></li>
				<li><a href="#"><i class="fa-brands fa-twitter"></i> - Twitter</a></li>
			</ul>
		</div>
		<div class="col-md-8 col-sm-8 col-12">
		<!-- Content of "Contact Us" page -->
       <?php echo do_shortcode('[custom_contact_form]'); ?>
		</div>
	</div>
</div>
<?php 
get_footer();
?>