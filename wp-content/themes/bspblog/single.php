<?php

/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header(); ?>
<?php 
while (have_posts()) : the_post();
$post_id = get_the_ID();
$post_type = get_post_type($post_id);
$permalink = get_permalink($post_id);

$post_date = get_the_date('F j, Y \a\t g:i A e', $post_id);
$author_name = get_the_author_meta('display_name', get_post_field('post_author', $post_id));
$permalink = get_permalink($post_id);
$theme_directory_uri = get_template_directory_uri();
$noimage = $theme_directory_uri . '/assets/images/on-image-placeholder.jpg';
				if (has_post_thumbnail($post_id)) {

					$thumbnail_id = get_post_thumbnail_id($post_id);
					$image_url = wp_get_attachment_url($thumbnail_id);
					

					$image_link = '<img src="' . esc_url($image_url) . '" alt="Featured Image" class="news-image">';
				} else {
					//$image_link = '<img src="' . esc_url($noimage) . '" alt="Featured Image" class="news-image">';
					$image_link = '';
				}
				$tags = wp_get_post_tags($post_id);

				$tag_names = array();
				foreach ($tags as $tag) {
					$tag_names[] = $tag->name; 
				}

				$multiple_pdf_attachment=get_field('multiple_pdf_attachment_for_post',$post_id);
				//echo ($multiple_pdf_attachment)[0]['poll_pdf_attachment']['url'];

endwhile;

?>
<div class="blog-detail-bnr pt-5">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-sm-10 col-12 offset-md-1 offset-sm-1">
				<div class="row page-banner">
					<?php //echo get_breadcrumbs(); ?>
					<div class="page-title">
						<h2><?php echo get_the_title(); ?></h2>
						 <p>By <?php echo $author_name;?></p> 
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php if($image_link) { ?>
<div class="container">

	<div class="col-md-12 pt-2 pb-5">
		<div class="row">
		
				<div class="single-poll col-12">
					<div class="single-poll-content">
						<div class="-single-poll-image">
							<?php
							echo $image_link;
							?>
						</div>

					</div>
				</div>

		</div>

	</div>

</div>
<?php } ?>
<div class="container">
	<div class="row">
		<div class="col-md-10 col-sm-10 col-12 offset-md-1 offset-sm-1">
		
				<div class="single-poll-content">
						<div class="single-poll-info">
						
							
							<?php the_content(); ?>
						</div>

				</div>
				
				<div class="share-and-dwn-btn">
				<?php //if(isset($multiple_pdf_attachment) && !empty($multiple_pdf_attachment)) {
					//foreach($multiple_pdf_attachment as $val){ ?>
		    <!-- <div class="download-pdf-file">
			<h3>Download the Poll</h3>                              
                                <div class="text-center">
								<a class="pdf-download" href="<?php //echo $val['post_pdf_attachment']['url'];?>" download><span>Download Attached PDF</span> <i class="fa-solid fa-file-arrow-down"></i></a>
								</div>							
			</div> -->
			<?php  //} } ?>
		<div class="share-social-icons">
					<h3>Share this:</h3>
					<?php dynamic_sidebar('sidebar-1'); ?>
				</div>
		</div>

		</div>

	</div>
</div>


<?php if($post_type=='post') { ?>
<div class="col-md-12 py-5">
<?php 

global $wpdb;
				
			$tag_names_list = "'" . implode("','", $tag_names) . "'";

			$query = "
				SELECT wp_posts.ID, wp_posts.post_title, wp_posts.post_content, wp_posts.post_date
				FROM {$wpdb->prefix}posts AS wp_posts
				LEFT JOIN {$wpdb->prefix}term_relationships AS tr ON wp_posts.ID = tr.object_id
				LEFT JOIN {$wpdb->prefix}term_taxonomy AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
				LEFT JOIN {$wpdb->prefix}terms AS t ON tt.term_id = t.term_id
				INNER JOIN {$wpdb->prefix}postmeta AS wp_postmeta ON wp_posts.ID = wp_postmeta.post_id
				WHERE (wp_posts.post_type = 'bsp_custom_polls' OR wp_posts.post_type = 'post')
				AND wp_posts.post_status = 'publish'		
				AND (tt.taxonomy = 'post_tag' AND t.name IN ($tag_names_list))
				GROUP BY wp_posts.ID, wp_posts.post_title, wp_posts.post_content, wp_posts.post_date
				ORDER BY wp_posts.post_date DESC
			";

			$results = $wpdb->get_results($query);
?>
<?php
 if ($results) : 	
?>
<h2 class="text-center mb-4">Related Posts</h2>

<section class="splide pb-md-5 mb-md-5 width_90" id="slider-related-posts" aria-label="related-posts slider">
        <div class="splide__track">
            <ul class="splide__list">
         <?php
			
		
			$options = array('tile-block', 'tile-block-red', 'tile-block-grey');
			foreach($results as $row) :
				$randomIndex = array_rand($options);
				$currentClass = $options[$randomIndex];
				$post_id = $row->ID;
				$post_type_data=get_post_type($post_id);
				$permalink = get_permalink($post_id);
				 if (has_post_thumbnail($post_id)) {
					$thumbnail_id = get_post_thumbnail_id($post_id);
					$image_url = wp_get_attachment_url($thumbnail_id);
					$theme_directory_uri = get_template_directory_uri();
					$noimage = $theme_directory_uri . '/assets/images/on-image-placeholder.jpg';
					$image_link = '<img src="' . esc_url($image_url) . '" alt="Featured Image" class="news-image">';
				} else {
					$image_link = '';
				}
		?>
                    <li class="splide__slide">
                       <div class="news-block">
					   <?php if(!empty($image_link) && $post_type_data=='post'){?>
								<div class="news-image"><?php echo $image_link;?></div>
								<?php } else { ?>
								<div class="news-image <?php echo $currentClass;?>"></div>	
								<?php } ?>	
								<div class="news-info">
									<h4 class="news-details"><span class="news-title"><?php echo $row->post_title; ?></span></h4>
									<!-- <p class="news-other-details"><span class="news-date"><?php echo date('M j, Y',strtotime($row->post_date));?></span></p> -->
									<!-- <p class="news-content"><?php echo trim_content_custom($row->post_content); ?></p> -->
									<!-- <p><a href="<?php echo $permalink; ?>">Read More</a></p> -->
								</div>
						</div>
                    </li>
					
					<?php
				endforeach;
		
			wp_reset_postdata();
                 ?>
            </ul>
        </div>
    </section>
<?php 	endif; ?>
</div>
<?php } ?>
</div>
<?php
get_footer();
?>