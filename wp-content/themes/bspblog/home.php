<?php
/**
 * Template Name:Home
 */
get_header(); ?>


<div class="banner-section">
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
	<div class="row">
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


