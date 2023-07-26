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
			<h2>Public Opinion Polling</h2>
			<p>Whether you are interested in a statewide sample or drilling down in Latinos, our firm has expertise in sample, mixed-mode methodology, and helping you understand and analyze public opinion</p>
			<h2>Message and Ad Testing</h2>
			<p>After baseline attitudes are established, we can help you communicate most effectively with the target audience through survey experiments and message testing that evaluate how different themes or advertisements resonate for your respondents as a whole, but also within key subgroups within the population</p>
			<h2>Data Analytics and Modeling</h2>
			<p>Big data can be overwhelming. Our team of data scientists have pioneered some of the leading methodology and statistical techniques to best assess large datasets and distill them into digestible patterns</p>
			<h2>Focus Groups and Qualitative</h2>
			<p class="mb-0">Whether it is at the start of a new project, or to wrap up a quantitative study, having in-depth conversations with everyday people is crucial to telling the full story and going beyond numbers. We have extensive experience with qualitative research, including focusing in on diverse and underrepresented populations.</p>
		</div>
		<div class="col-md-6 col-sm-6 col-12">
				<img class="img-fluid" src="<?php bloginfo('template_directory'); ?>/assets/images/services-pageimg.png" alt="bodyimage">
		</div>
	</div>
</div>

<?php 
get_footer();
?>