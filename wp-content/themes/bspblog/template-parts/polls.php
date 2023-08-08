<?php /*Template Name: Polls Page*/

$page_id = get_the_ID();
$full_banner = get_field('full_banner', $page_id);
$image_over_banner = get_field('image_over_banner', $page_id);
$search_text=isset($_POST['search_text'])?$_POST['search_text']:'';
$from_date=isset($_POST['from_date'])?$_POST['from_date']:'';
$to_date=isset($_POST['to_date'])?$_POST['to_date']:'';
?>
<?php 

get_header();

?>

<div class="inner-bnr team-bnr" style="background-image: linear-gradient(180deg, rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('<?php echo $full_banner['url']; ?>')">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-8 col-12">
				<div class="row page-banner">
					<?php echo get_breadcrumbs(); ?>
					<div class="page-title">
						<h3><?php echo get_the_title(); ?></h3>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-12">
				<img class="img-fluid bnr-simg" src="<?php echo $image_over_banner['url'];?>" alt="side-bnrimg">
			</div>
		</div>
	</div>
</div>

<div class="container py-5 my-md-5">
	<div class="row">
		<div class="container mt-5">
			<form class="row g-2" method="POST">
				<div class="col-md-3">
					<!-- Search Input -->
					<input type="text" class="form-control" name="search_text" placeholder="Enter your search query" aria-label="Search" required>
				</div>
				<div class="col-md-3">
					<!-- Search Input -->
					<input type="text" class="form-control" name="from_date" placeholder="From date" aria-label="Search" required>
				</div>
				<div class="col-md-3">
					<!-- Search Input -->
					<input type="text" class="form-control" name="to_date" placeholder="To date" aria-label="Search" required>
				</div>
				<div class="col-md-3">
					<!-- Search Button -->
					<button type="submit" class="btn btn-primary w-100">Search</button>
				</div>
			</form>
		</div>
	</div>

	<div class="highlight-post">
		<?php
		
		 $fargs = array(
			'post_type'      => 'bsp_custom_polls',
			'posts_per_page' => 1,
			'meta_query'     => array(
				array(
					'key'     => 'is_featured_poll',
					'value'   => 'Yes', 
					'compare' => '='
				),				
			),			          
		); 

		$fquery = new WP_Query( $fargs );

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
				<div class="news-block">
					<?php echo $image_link;?>
				</div>
				<div class="news-block-content">
						<h2 class="news-details"><span class="news-title"><?php the_title(); ?></span></h2>
						<p class="news-other-details"><span class="news-date"><?php echo get_the_date('M j, Y');?></span></p>
						<p class="news-content"><?php the_content();?></p>
						<p><a href="<?php echo $permalink;?>">Read More</a></p>
				</div>
		<?php
			endwhile;
			wp_reset_postdata();
		endif;
		?>
	</div>

	<div class="row">
		<?php
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		if(isset($search_text) && isset($from_date) && isset($to_date))
		{
			global $wpdb;

				$query = "SELECT * FROM {$wpdb->prefix}posts
						INNER JOIN {$wpdb->prefix}postmeta ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}postmeta.post_id)
						WHERE {$wpdb->prefix}posts.post_type = 'bsp_custom_polls'
						AND {$wpdb->prefix}postmeta.meta_key = 'is_featured_poll'
						AND {$wpdb->prefix}postmeta.meta_value = 'No'
						LIMIT 2";

				
			
			/*$args = array(
				'post_type'      => 'bsp_custom_polls',
				'posts_per_page' => 2, // Adjust the number of posts per page as per your requirement
				'paged'          => $paged,
				'meta_query'     => array(
					'relation' => 'OR', // Outer relation is OR
					array(
						'relation' => 'AND', // First nested relation is AND
						array(
							'key'     => 'is_featured_poll',
							'value'   => 'No',
							'compare' => '='
						),
						array(
							'key'     => 'custom_pdf_keywords', // Replace with the first meta key you want to query
							'value'   => $search_text, // Replace with the value you want to search for
							'compare' => 'LIKE', // You can use other comparison operators like '>', '<', 'IN', etc.
						),
					),
					array(
						'key' => 'created_at', // Replace with your meta key (or 'post_date' for default post date)
						'value' => array($from_date, $to_date), // Replace with your date range
						'compare' => 'BETWEEN',
						'type' => 'DATE'
					)
				),
			);*/
		}
		else {
			/* $args = array(
				'post_type' => 'bsp_custom_polls',
				'posts_per_page' => 2, // Adjust the number of posts per page as per your requirement
				'paged' => $paged,
				'meta_query'     => array(
					array(
						'key'     => 'is_featured_poll',
						'value'   => 'No', 
						'compare' => '='
					),				
				),
			); */
			                   global $wpdb;

								$posts_per_page = 2;
								$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
								$offset = ($current_page - 1) * $posts_per_page;

								$query = "
									SELECT {$wpdb->prefix}posts.*
									FROM {$wpdb->prefix}posts
									LEFT JOIN {$wpdb->prefix}postmeta ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}postmeta.post_id)
									WHERE {$wpdb->prefix}posts.post_type = 'bsp_custom_polls'
									AND {$wpdb->prefix}postmeta.meta_key = 'is_featured_poll'
									AND {$wpdb->prefix}postmeta.meta_value = 'No'
									ORDER BY {$wpdb->prefix}posts.post_date DESC
									LIMIT %d
									OFFSET %d
								";

								$query = $wpdb->prepare($query, $posts_per_page, $offset);

								$results = $wpdb->get_results($query);

								// Query to count total posts matching the condition
								$count_query = "
									SELECT COUNT({$wpdb->prefix}posts.ID) AS total_count
									FROM {$wpdb->prefix}posts
									LEFT JOIN {$wpdb->prefix}postmeta ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}postmeta.post_id)
									WHERE {$wpdb->prefix}posts.post_type = 'bsp_custom_polls'
									AND {$wpdb->prefix}postmeta.meta_key = 'is_featured_poll'
									AND {$wpdb->prefix}postmeta.meta_value = 'No'
								";

								$total_count = $wpdb->get_var($count_query);

								$max_num_pages = ceil($total_count / $posts_per_page);
		}
		
		$results = $wpdb->get_results($query);		
		
		//$query = new WP_Query($args);

		if ($results) :
			foreach($results as $row) :
				print_r($row);
				//$query->the_post();
				//$post_id = get_the_ID();

				//$permalink = get_permalink($post_id);
				/* if (has_post_thumbnail($post_id)) {

					$thumbnail_id = get_post_thumbnail_id($post_id);
					$image_url = wp_get_attachment_url($thumbnail_id);
					$theme_directory_uri = get_template_directory_uri();
					$noimage = $theme_directory_uri . '/assets/images/on-image-placeholder.jpg';

					$image_link = '<img src="' . esc_url($image_url) . '" alt="Featured Image" class="news-image">';
				} else {
					$image_link = '<img src="' . esc_url($noimage) . '" alt="Featured Image" class="news-image">';
				} */
		?>
				<div class="news-block col-md-4">
					<div class="news-image"><?php //echo $image_link; ?></div>
					<div class="news-info">
						<h4 class="news-details"><span class="news-title"><?php //the_title(); ?></span></h4>
						<p class="news-other-details"><span class="news-date"><?php //echo get_the_date('M j, Y');?></span></p>
						<p class="news-content"><?php //the_content(); ?></p>
						<p><a href="<?php //echo $permalink; ?>">Read More</a></p>
					</div>
				</div>
		<?php
			endforeach;
			wp_reset_postdata();
			
		?>
			<!-- Pagination -->
			<div class="col-md-12">
				<div class="pagination">
					<?php
					echo paginate_links(array(
						'total' => $max_num_pages,
						'current' => $paged,
						'prev_text' => '&laquo;',
						'next_text' => '&raquo;',
					));
					?>
				</div>
			</div>
		<?php
		else :
			echo 'No polls found.';
		endif;
		?>
	</div>

</div>	
<?php 
get_footer();
?>
