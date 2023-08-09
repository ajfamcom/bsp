<?php
/* Template Name:Custom Polls Template  */
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
								while (have_posts()) : the_post();
									$post_id=get_the_ID();
									
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
									
								     </div>
                                    </div>
									<div class="share-social-icons">
									<?php dynamic_sidebar( 'sidebar-1' ); ?>
									</div>		
		                    </div>

			        </div>
                                  <?php endwhile; ?>
		

	</div>
	<div class="col-md-12 py-5">
		<h3>Related Posts</h3>
	</div>
</div>
<?php
get_footer();
?>