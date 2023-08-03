<?php
/* Template Name:Custom Polls Template  */
$page_id = get_custom_page_id('team_members', 'our-team');
$full_banner = get_field('full_banner', $page_id);
$image_over_banner = get_field('image_over_banner', $page_id);
if (have_posts()) :
	while (have_posts()) : the_post();
		$post_id = get_the_ID();
		$fullname = get_field('full_name', $post_id);
		$education = get_field('education', $post_id);
		$designation = get_field('designation', $post_id);
		$image = get_field('profile_image', $post_id);
		$contact_email = get_field('contact_email', $post_id);
		$contact_phone = get_field('contact_phone', $post_id);
	endwhile;
endif;
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
						$download_attachment=get_field('pdf_attachment',$post_id);
print_r($download_attachment);
					?>
				<div class="single-poll col-12">
						<div class="single-poll-content">
							<div class="-single-poll-image">
							<img src="<?php echo $image['url']; ?>" />					
							</div>
							<div class="single-poll-info">
								<h1 class="poll-title"><?php the_title();?></h1>						
								<?php the_content(); ?>			
						
								<?php if($download_attachment):?>
								<p><a href="<?php echo esc_url($download_attachment['url']); ?>" target="_blank" rel="nofollow">Download PDF</a></p>
								<?php endif; ?>
							</div>
							
						</div>
						<div class="tags">
								<?php
									// Assuming you are in the loop for your custom post type
									$tags = get_the_terms(get_the_ID(), 'post_tag');
									if ($tags && !is_wp_error($tags)) {
										echo '<ul class="poll-tags">';
										foreach ($tags as $tag) {
											echo '<li><a href="' . esc_url(get_term_link($tag)) . '">' . esc_html($tag->name) . '</a></li>';
										}
										echo '</ul>';
									}
									?>
						</div>
						<div class="comments-section">
									<?php if (comments_open() || get_comments_number()) : ?>
										<h2><?php comments_number('No Comments', '1 Comment', '% Comments'); ?></h2>
										<?php
										if (comments_open()) {																
																					
											comment_form();
											
										} else {
											echo '<p>Comments are closed.</p>';
										}
										?>
									<?php endif; ?>
                        </div>

			    </div>
                    <?php endwhile; ?>
		</div>

	</div>
</div>
<?php
get_footer();
?>