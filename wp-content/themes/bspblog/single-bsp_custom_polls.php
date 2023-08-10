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
				
			?>
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
<?php endwhile; ?>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-10 col-sm-10 col-12 offset-md-1 offset-sm-1">
		<?php 
		while (have_posts()) : the_post();
				$post_id = get_the_ID();
				$permalink = get_permalink($post_id);
				$download=get_field('pdf_attachment',$post_id);
				$post_date = get_the_date('F j, Y \a\t g:i A e', $post_id);
				$author_name = get_the_author_meta('display_name', get_post_field('post_author', $post_id));

				?>
				<div class="single-poll-content">
						<div class="single-poll-info">
							<h1 class="poll-title"><?php the_title(); ?></h1>
							<p>WLRN 91.3 FM | By <?php echo $author_name;?> , Published <?php echo $post_date; ?></p>
							<?php the_content(); ?>
							<p>
                              <?php if($download) { ?>
                                <a href="<?php echo $download['url'];?>">Download Pdf Attachment</a>
							<?php  } ?>
							</p>
						</div>

				</div>
				<div class="share-social-icons my-5">
					<h3>Share this:</h3>
					<?php dynamic_sidebar('sidebar-1'); ?>
				</div>
		<?php endwhile; ?>
		</div>

	</div>
</div>



<div class="col-md-12 py-5">
<?php 
while (have_posts()) : the_post();
$post_id = get_the_ID();
$search=get_pdf_metadata_custom($post_id);
print_r($search['dc:subject']);	
endwhile;
?>
<h3>Related Posts</h3>


<section class="splide pb-5 mb-5 width_90" id="slider-related-posts" aria-label="related-posts slider">
        <div class="splide__track">
            <ul class="splide__list">
                <?php // global $wpdb;

$search_text = $search['Keywords'];


$break_search_text = array(); // Initialize the array

if (strpos($search_text, ' ') !== false) {
    $break_search_text = explode(' ', $search_text);
} else {
    $break_search_text[] = $search_text;
}
print_r($break_search_text);
//({$wpdb->prefix}postmeta.meta_key = 'custom_pdf_keywords' AND {$wpdb->prefix}postmeta.meta_value IN (" . implode(',', $break_search_text) . "))
//OR ({$wpdb->prefix}postmeta.meta_key = 'related_post_keywords' AND {$wpdb->prefix}postmeta.meta_value LIKE %s)
//OR ({$wpdb->prefix}postmeta.meta_key = 'related_polls_keywords' AND {$wpdb->prefix}postmeta.meta_value LIKE %s) 
/* $query = "
    SELECT {$wpdb->prefix}posts.ID, {$wpdb->prefix}posts.post_title, {$wpdb->prefix}posts.post_content, {$wpdb->prefix}posts.post_date ,{$wpdb->prefix}posts.post_status='publish'
    FROM {$wpdb->prefix}posts
    LEFT JOIN {$wpdb->prefix}postmeta ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}postmeta.post_id)
    WHERE ({$wpdb->prefix}posts.post_type = 'bsp_custom_polls' OR {$wpdb->prefix}posts.post_type = 'post')
    AND {$wpdb->prefix}posts.post_status='publish'
    AND (
       
	    OR ({$wpdb->prefix}postmeta.meta_key = 'related_post_keywords' AND {$wpdb->prefix}postmeta.meta_value LIKE %s)
		OR ({$wpdb->prefix}postmeta.meta_key = 'related_polls_keywords' AND {$wpdb->prefix}postmeta.meta_value LIKE %s) 
		OR {$wpdb->prefix}posts.post_title LIKE %s                       
    )            
    GROUP BY {$wpdb->prefix}posts.ID, {$wpdb->prefix}posts.post_title, {$wpdb->prefix}posts.post_content, {$wpdb->prefix}posts.post_date
    ORDER BY {$wpdb->prefix}posts.post_date DESC
"; */
/* $query = "SELECT wp_posts.ID, wp_posts.post_title, wp_posts.post_content, wp_posts.post_date
FROM wp_posts
INNER JOIN wp_postmeta ON wp_posts.ID = wp_postmeta.post_id
WHERE wp_posts.post_type = 'post'
AND wp_posts.post_status = 'publish'
AND wp_postmeta.meta_key = 'custom_pdf_keywords' 
AND wp_postmeta.meta_value LIKE '%{$search_text}%' 
GROUP BY wp_posts.ID, wp_posts.post_title, wp_posts.post_content, wp_posts.post_date
ORDER BY wp_posts.post_date DESC;
"; */
 global $wpdb;

$search_text = '%' . $wpdb->esc_like($search_text) . '%'; // Escape and add wildcards

$query = "
    SELECT wp_posts.ID, wp_posts.post_title, wp_posts.post_content, wp_posts.post_date
    FROM {$wpdb->prefix}posts
    INNER JOIN {$wpdb->prefix}postmeta ON {$wpdb->prefix}posts.ID = {$wpdb->prefix}postmeta.post_id
    WHERE {$wpdb->prefix}posts.post_type = 'bsp_custom_polls'
    AND {$wpdb->prefix}posts.post_status = 'publish'
    AND (
		{$wpdb->prefix}postmeta.meta_key = 'custom_pdf_keywords' AND {$wpdb->prefix}postmeta.meta_value LIKE '$break_search_text[1]'
		OR {$wpdb->prefix}postmeta.meta_key = 'custom_pdf_keywords' AND {$wpdb->prefix}postmeta.meta_value LIKE '$break_search_text[2]'
		OR {$wpdb->prefix}posts.post_title LIKE '$search_text'
	)
	
    GROUP BY {$wpdb->prefix}posts.ID
    ORDER BY {$wpdb->prefix}posts.post_date DESC;
";
echo $query;

$results = $wpdb->get_results($query); 
// Define the search keywords
//$search_keywords = array('Midterm', 'Arizona', 'Statewide');

// Construct the WP_Query arguments
/* $args = array(
    'post_type' => 'bsp_custom_polls',  // Replace with your custom post type if needed
    'post_status' => 'publish',
    'meta_query' => array(
        'relation' => 'OR',  // Search for any keyword
        array(
            'key' => 'custom_pdf_keywords',  // Replace with your actual meta key
            'value' => $search_keywords,
            'compare' => 'LIKE',
        ),
    ),
); */


		
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
                       <div class="news-block col-md-4">
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
<style>.splide__arrow--next{    right: 5em;}</style>
</div>
</div>
<?php
get_footer();
?>