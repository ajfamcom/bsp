<?php
/**
 * Template Name:Home
 */
get_header(); ?>
<div class="top-header-block col-md-12"><?php	
			get_template_part( 'template-parts/home-top-section' );
		?></div>
<div class="most-popular-block">
	<div class="col-md-8">
		<div class="row">			
		<?php	
			get_template_part( 'template-parts/most-popular-posts' );
		?>
		</div>
    </div>
    <div class="col-md-4">
		<?php	
			get_template_part( 'template-parts/side-hot-categories' );
		?>
    </div>
</div>
<?php 
get_footer();
?>


