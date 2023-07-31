<?php
/* Template Name: contact Template */

?>
<?php get_header(); ?>
<div class="inner-bnr contact-bnr">
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
				<img class="img-fluid bnr-simg" src="<?php bloginfo('template_directory'); ?>/assets/images/contact-side-bnrimg.png" alt="side-bnrimg">
			</div>
		</div>
	</div>
</div>

<div class="container py-5 my-md-5">
	<div class="row py-md-5 my-md-5">
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
		<div class="container mt-5">
         <h2>Contact Us</h2>
			<form>
			<div class="mb-3">
				<label for="name" class="form-label">Name</label>
				<input type="text" class="form-control" id="name" name="name" required>
			</div>
			<div class="mb-3">
				<label for="organization" class="form-label">Organization</label>
				<input type="text" class="form-control" id="organization" name="organization">
			</div>
			<div class="mb-3">
				<label for="email" class="form-label">Email</label>
				<input type="email" class="form-control" id="email" name="email" required>
			</div>
			<div class="mb-3">
				<label for="message" class="form-label">Message</label>
				<textarea class="form-control" id="message" name="message" rows="5" required></textarea>
			</div>
			<div class="form-check">
				<input type="checkbox" class="form-check-input" id="signup" name="signup">
				<label class="form-check-label" for="signup">Sign me up for email list, promotions, and more</label>
			</div>
			<button type="submit" class="btn btn-primary mt-3">Submit</button>
			</form>
  </div>
		</div>
	</div>
</div>

<?php 
get_footer();
?>