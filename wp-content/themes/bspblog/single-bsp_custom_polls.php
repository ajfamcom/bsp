<?php /* Template Name:Custom Polls Template  */ ?>

<?php get_header(); ?>

<?php 
while (have_posts()) : the_post();
$post_id = get_the_ID();
$permalink = get_permalink($post_id);
$download=get_field('pdf_attachment',$post_id);
$post_date = get_the_date('F j, Y \a\t g:i A e', $post_id);
$author_name = get_the_author_meta('display_name', get_post_field('post_author', $post_id));
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
				$search=get_pdf_metadata_custom($post_id);

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
						<p>WLRN 91.3 FM | By <?php echo $author_name;?> , Published <?php echo $post_date; ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

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
<div class="container">
	<div class="row">
		<div class="col-md-10 col-sm-10 col-12 offset-md-1 offset-sm-1">
		
				<div class="single-poll-content">
						<div class="single-poll-info">
						
							
							<?php the_content(); ?>
							
						</div>

				</div>
				
				<div class="share-and-dwn-btn">
		<div class="download-pdf-file my-md-5">
		<h3>Download the Poll</h3>
                              <?php if($download) { ?>
                                <a class="btn btn-primary pdf-download" href="<?php echo $download['url'];?>">Download Attached PDF <i class="fa-solid fa-file-arrow-down"></i></a>
							<?php  } ?>
							</div>
		
		
		<div class="share-social-icons my-5">
					<h3>Share this:</h3>
					<?php dynamic_sidebar('sidebar-1'); ?>
				</div>
				</div>
		</div>

	</div>
</div>



<div class="col-md-12 py-5">

<h2 class="text-center mb-4">Related Posts</h2>
<?php 
$keywordsArray = preg_split("/\r\n|\n|\r/", $search['Keywords']);      
$breakcode = array_map('trim', array_filter($keywordsArray));
//$breakcode = $search['dc:subject'];

?>
<section class="splide pb-md-5 mb-md-5 width_90" id="slider-related-posts" aria-label="related-posts slider">
        <div class="splide__track">
            <ul class="splide__list">
                <?php
global $wpdb;

if ($breakcode) {
    $addData = "";
    foreach ($breakcode as $val) {
        $addData .= "OR wp_postmeta.meta_value LIKE '%$val%'"; 
    }
}				


$search_text = 'Hispanic';//$search['Keywords'];
$break_search_text = array(); // Initialize the array

$query = "
    SELECT wp_posts.ID, wp_posts.post_title, wp_posts.post_content, wp_posts.post_date
    FROM {$wpdb->prefix}posts
    INNER JOIN {$wpdb->prefix}postmeta ON {$wpdb->prefix}posts.ID = {$wpdb->prefix}postmeta.post_id
    WHERE ({$wpdb->prefix}posts.post_type = 'bsp_custom_polls' OR {$wpdb->prefix}posts.post_type = 'post')
    AND {$wpdb->prefix}posts.post_status = 'publish' ";

$query .= " AND (
    wp_postmeta.meta_key = 'custom_pdf_keywords'
    AND (
        wp_postmeta.meta_value LIKE '%xxx%' ";

    $query .= $addData;

 $query .= ")
)";

$query .= " GROUP BY {$wpdb->prefix}posts.ID,{$wpdb->prefix}posts.post_title,{$wpdb->prefix}posts.post_content,{$wpdb->prefix}posts.post_date
    ORDER BY {$wpdb->prefix}posts.post_date DESC";

$results = $wpdb->get_results($query);
		
		if ($results) :
			foreach($results as $row) :

				$post_id = $row->ID;
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
                    <li class="splide__slide">
                       <div class="news-block">
								<div class="news-image"><?php echo $image_link;?></div>
								<div class="news-info">
									<h4 class="news-details"><span class="news-title"><?php echo $row->post_title; ?></span></h4>
									<p class="news-other-details"><span class="news-date"><?php echo date('M j, Y',strtotime($row->post_date));?></span></p>
									<p class="news-content"><?php echo trim_content_custom($row->post_content); ?></p>
									<p><a href="<?php echo $permalink; ?>">Read More</a></p>
								</div>
						</div>
                    </li>
					
					<?php
				endforeach;
			endif;
			wp_reset_postdata();
                 ?>
            </ul>
        </div>
    </section>

</div>
</div>
<?php
get_footer();
?>