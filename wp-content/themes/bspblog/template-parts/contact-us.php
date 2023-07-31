<?php
/* Template Name: contact Template */

?>
<?php get_header();
if(isset($_POST['submit'])){
$name=$_POST['name'];
$email=$_POST['email'];
$organization=$_POST['organization'];
echo $message=$_POST['message'];
die();
}

?>
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
		<!-- Content of "Contact Us" page -->
       <?php echo do_shortcode('[custom_contact_form]'); ?>
		</div>
	</div>
</div>

<?php 
get_footer();
?>