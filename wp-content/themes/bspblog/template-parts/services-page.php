<?php
/* Template Name: Services Template */

?>
<?php get_header(); ?>
<div class="inner-bnr services-bnr">
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
				<img class="img-fluid bnr-simg" src="<?php bloginfo('template_directory'); ?>/assets/images/services-side-bnrimg.png" alt="side-bnrimg">
			</div>
		</div>
	</div>
</div>

<div class="container py-5 my-md-5">
	<div class="row py-md-5 my-md-5">
		<div class="col-md-6 col-sm-6 col-12">
			<h2>Cultural Competence in Today's America</h2>
			<p>For the past 20 years, we have helped political, corporate and community-based organizations understand a diverse America, and craft the best messages to communicate. Our process is designed to work with you, solicit your input, so we can empower your organization with the specific and customized messages, data and tools needed to succeed. Our team deeply understands the diversity that is America today.</p>
			<h2>Our Analytical Approach</h2>
			<p>Bad data is worse than just guessing, it leads you to the wrong conclusions. Our first priority is to make sure we have accurate, culturally competent and representative data to inform our models and analysis. Today, there is vast variability in the quality of data, especially when it comes to Latinos, immigrants and under-represented Americans. Do not accept low quality data to inform your project. Our data scientists have quite literally written the book on research methodology, modeling and data analytics of communities of color.</p>
		</div>
		<div class="col-md-6 col-sm-6 col-12">
				<img class="img-fluid" src="<?php bloginfo('template_directory'); ?>/assets/images/services-pageimg.png" alt="bodyimage">
		</div>
	</div>
</div>

<?php 
get_footer();
?>