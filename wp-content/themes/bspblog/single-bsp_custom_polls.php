<?php /* Template Name:Custom Polls Template  */ ?>

<?php get_header(); ?>

<div class="blog-detail-bnr pt-5">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-sm-10 col-12 offset-md-1 offset-sm-1">
				<div class="row page-banner">
					<?php echo get_breadcrumbs(); ?>
					<div class="page-title">
						<h2><?php echo get_the_title(); ?></h2>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">

	<div class="col-md-12 pt-2 pb-5">
		<div class="row">
			<?php
			while (have_posts()) : the_post();
				$post_id = get_the_ID();
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

				$download = get_field('pdf_attachment', $post_id);
			?>
				<div class="single-poll col-12">
					<div class="single-poll-content">
						<div class="-single-poll-image">
							<?php
							echo $image_link;
							?>
						</div>

						<div class="single-poll-info">
							<h1 class="poll-title"><?php the_title(); ?></h1>
							<p>WLRN 91.3 FM | By Tim Padget,Published November 15,2022 at 6:33 AM EST</p>
							<?php the_content(); ?>
							<p><?php if ($download) { ?><a href="<?php echo $download['url']; ?>" target="_blank">Download Article</a><?php } ?></p>
						</div>

					</div>
				</div>
		</div>

	</div>
<?php endwhile; ?>


</div>


<div class="container">
	<div class="row">
		<div class="col-md-10 col-sm-10 col-12 offset-md-1 offset-sm-1">

			<div class="single-poll-content">
				<div class="single-poll-info">
					<h1 class="poll-title"><?php the_title(); ?></h1>
					<p>WLRN 91.3 FM | By Tim Padget,Published November 15,2022 at 6:33 AM EST</p>
					<?php the_content(); ?>
				</div>

			</div>
			<div class="share-social-icons my-5">
				<h3>Share this:</h3>
				<?php dynamic_sidebar('sidebar-1'); ?>
			</div>

		</div>

	</div>
</div>


<div class="col-md-12 py-5">

	<section class="splide" aria-labelledby="carousel-heading" id="slider-related-posts">
		<h2 id="carousel-heading text-center">Related Posts</h2>
		<div class="splide__track">
			<ul class="splide__list">
				<?php
				$fargs = array(
					'post_type'      => 'bsp_custom_polls',
					'posts_per_page' => -1,
					'meta_query'     => array(
						array(
							'key'     => 'is_featured_poll',
							'value'   => 'No',
							'compare' => '='
						),
					),
				);

				$fquery = new WP_Query($fargs);

				if ($fquery->have_posts()) :
					while ($fquery->have_posts()) :
						$fquery->the_post();
						$post_id = get_the_ID();

						$permalink = get_permalink($post_id);
						if (has_post_thumbnail($post_id)) {

							$thumbnail_id = get_post_thumbnail_id($post_id);
							$image_url = wp_get_attachment_url($thumbnail_id);
							$theme_directory_uri = get_template_directory_uri();
							$noimage = $theme_directory_uri . '/assets/images/on-image-placeholder.jpg';

							$image_link = '<img src="' . esc_url($image_url) . '" alt="Featured Image" class="img-fluid">';
						} else {
							$image_link = '<img src="' . esc_url($noimage) . '" alt="Featured Image" class="img-fluid">';
						}
				?>
						<li class="splide__slide">
							<div class="news-block col-md-4">
								<div class="news-image"><?php echo $image_link; ?></div>
								<div class="news-info">
									<h4 class="news-details"><span class="news-title"><?php the_title(); ?></span></h4>
									<p class="news-other-details"><span class="news-date"><?php echo get_the_date('M j, Y'); ?></span></p>
									<p class="news-content"><?php the_content(); ?></p>
									<p><a href="<?php echo $permalink; ?>">Read More</a></p>
								</div>
							</div>
						</li>
				<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>

			</ul>
		</div>
	</section>
</div>
</div>
<?php
get_footer();
?>