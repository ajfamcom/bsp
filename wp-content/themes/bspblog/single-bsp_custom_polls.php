<?php /* Template Name:Custom Polls Template  */ ?>

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
									$permalink = get_permalink($post_id);
											if (has_post_thumbnail($post_id)) {

												$thumbnail_id = get_post_thumbnail_id($post_id);
												$image_url = wp_get_attachment_url($thumbnail_id);
												$theme_directory_uri = get_template_directory_uri();
												$noimage = $theme_directory_uri . '/assets/images/on-image-placeholder.jpg';

												$image_link = '<img src="' . esc_url($image_url) . '" alt="Featured Image" class="news-image">';
											} else {
												$image_link = '<img src="' . esc_url($noimage) . '" alt="Featured Image" class="news-image">';
											}
								?>
				            <div class="single-poll col-12">
								    <div class="single-poll-content">
											<div class="-single-poll-image">
											<?php
											 echo $image_link;
				                            ?>					
											</div>
											<div class="single-poll-info">
												<h1 class="poll-title"><?php the_title();?></h1>						
												<?php the_content(); ?>	
											</div>
									
								     </div>
                                    </div>
									<div class="share-social-icons">
										<h3>Share this:</h3>
									    <?php dynamic_sidebar( 'sidebar-1' ); ?>
									</div>		
		                    </div>

			        </div>
                                  <?php endwhile; ?>
		

	</div>
	<div class="col-md-12 py-5">
		<h3>Related Posts</h3>
		<section class="splide" aria-labelledby="carousel-heading">
        <h2 id="carousel-heading">Splide Basic HTML Example</h2>
			<div class="splide__track">
					<ul class="splide__list">
						<li class="splide__slide">Slide 01</li>
						<li class="splide__slide">Slide 02</li>
						<li class="splide__slide">Slide 03</li>
					</ul>
			</div>
        </section>
	</div>
</div>
<?php
get_footer();
?>