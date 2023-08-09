<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

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
						//$metaData=get_pdf_metadata_custom($post_id);
						 $pdfkey=get_post_meta( $post_id, 'custom_pdf_keywords' );
						 print_r($pdfkey);
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
						//$pdf_file_path = 'path/to/your/pdf/file.pdf';
						
						/*if ($metadata) {
							// Process and display the metadata as needed
							$title = $metadata->get('Title');
							$author = $metadata->get('Author');
							$keywords = $metadata->get('Keywords');
							// ... Add more metadata properties as required
						
							echo "Title: $title<br>";
							echo "Author: $author<br>";
							echo "Keywords: $keywords<br>";
							// ... Output more metadata properties as needed
						} else {
							echo "No metadata found in the PDF.";
						}*/
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
						

			    </div>
                    <?php endwhile; ?>
		</div>

	</div>
</div>
<?php
get_footer();
?>