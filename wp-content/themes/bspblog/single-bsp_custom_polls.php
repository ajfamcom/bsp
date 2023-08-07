<?php
/* Template Name:Custom Polls Template  */

$attachment_id = get_the_ID(); 
$metadata = get_post_meta($attachment_id, 'custom_pdf_meta', true);

if ($metadata) {
    // Process and display the metadata
    // For example, if the 'Keywords' metadata exists, you can access it like:
    $keywords = $metadata->get('Keywords');
    if ($keywords) {
        echo 'Keywords: ' . $keywords;
    }
}
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
						<div>
						<?php 
						$meta=get_pdf_metadata($download_attachment['url']);
						print_r($meta);
						?></div>
						<div class="tags">
								<?php
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