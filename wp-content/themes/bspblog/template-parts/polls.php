<?php /*Template Name: Polls Page*/
$page_id = get_the_ID();
$full_banner = get_field('full_banner', $page_id);
$image_over_banner = get_field('image_over_banner', $page_id);
$search_text=isset($_REQUEST['search_text'])?$_REQUEST['search_text']:'';
$from_date=isset($_REQUEST['from_date'])?$_REQUEST['from_date']:'';
$to_date=isset($_REQUEST['to_date'])?$_REQUEST['to_date']:'';
	if ($search_text) {
		
		$search_term = trim($search_text);
		$visitor_ip =get_visitor_ip_address();
		$tablename='wp_searchdata';
		global $wpdb;
		$insert_data=array(
		'keyword'=>$search_term,
		'visitor_ip'=>$visitor_ip,
		'search_page'=>'polls_page'
		);
	$wpdb->insert($tablename,$insert_data);		  
	
	}
	$showt=isset($_REQUEST['show_type'])?$_REQUEST['show_type']:'list';
	$base_url = get_permalink();
	if($showt=='grid')
{
    $grid_active='active';
    $list_active='';
}
if($showt=='list')
{
    $grid_active='';
    $list_active='active';
}
		
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
<div class="container pt-5 mt-md-5">	
<div class="d-flex align-items-center gap-3 mb-4">
  <a class="section-format <?php echo $grid_active;?>" href="<?php echo add_query_arg('show_type', 'grid', $base_url); ?>"><i class="fa-solid fa-grip"></i></a>
  <a class="section-format <?php echo $list_active;?>" href="<?php echo add_query_arg('show_type', 'list', $base_url); ?>"><i class="fa-solid fa-bars"></i></a>    
</div>
</div>
<!--grid view -->
<div class="container grid-post pt-2 pb-5 mt-md-2 pb-5 mb-md-5 show-type-grid" <?php echo ($showt == 'grid') ? 'style="display:block;"' : 'style="display:none;"'; ?>>
	<div class="row">
		<div class="container">
			<form class="post-filter-form">
				<div class="post-fields">					
					<input type="text" class="form-control" name="search_text" placeholder="Enter your search query" aria-label="Search" required value="<?php echo $search_text;?>" autocomplete="off">
				</div>
				<div class="post-fields">				
					<div class="input-group">
					<input type="text" class="form-control datepicker" name="from_date" placeholder="From Date"  value="<?php echo $from_date; ?>" autocomplete="off">
				    </div>							
				</div>
				<div class="post-fields">				
					<div class="input-group">
					<input type="text" class="form-control datepicker" name="to_date" placeholder="To Date"  value="<?php echo $to_date; ?>" autocomplete="off">
				    </div>
				</div>
				<div class="post-fields">					
					<button type="submit" class="btn btn-default">Search</button>
					<button type="button" class="btn btn-primary resetfrm" onclick="window.location.href = '<?php echo site_url('polls');?>'">Reset</button>
				</div>
			</form>
		</div>
	</div>

	       

	<div class="row">
		<?php
		
		if(isset($search_text) && isset($from_date) && isset($to_date) && !empty($search_text) && !empty($from_date) && !empty($to_date))
		{		

			global $wpdb;

$year_from = $from_date;//date('Y', strtotime($from_date));
$year_to = $to_date;//date('Y', strtotime($to_date));
$posts_per_page = 6;
$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
$offset = ($current_page - 1) * $posts_per_page;

$search_text =  $wpdb->esc_like($search_text);

$query = $wpdb->prepare(
    "
    SELECT {$wpdb->prefix}posts.ID, {$wpdb->prefix}posts.post_title, {$wpdb->prefix}posts.post_content, {$wpdb->prefix}posts.post_date
    FROM {$wpdb->prefix}posts
    LEFT JOIN {$wpdb->prefix}term_relationships ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id)
    LEFT JOIN {$wpdb->prefix}term_taxonomy ON ({$wpdb->prefix}term_relationships.term_taxonomy_id = {$wpdb->prefix}term_taxonomy.term_taxonomy_id)
    LEFT JOIN {$wpdb->prefix}terms ON ({$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id)
    WHERE ({$wpdb->prefix}posts.post_type = 'bsp_custom_polls' OR {$wpdb->prefix}posts.post_type = 'post')
    AND {$wpdb->prefix}posts.post_status = 'publish'
    AND (
        {$wpdb->prefix}posts.post_title LIKE %s
        OR {$wpdb->prefix}posts.post_content LIKE %s
        OR {$wpdb->prefix}terms.name LIKE %s
    )
    AND YEAR({$wpdb->prefix}posts.post_date) >= %d AND YEAR({$wpdb->prefix}posts.post_date) <= %d
    GROUP BY {$wpdb->prefix}posts.ID
    ORDER BY {$wpdb->prefix}posts.post_date DESC
    LIMIT %d
    OFFSET %d
    ",
	"%{$search_text}%", // Post title
	"%{$search_text}%", // Post content
	"%{$search_text}%", // Term name
    $year_from,
    $year_to,
    $posts_per_page,
    $offset
);

$results = $wpdb->get_results($query);

		
		
		/***count query */
		$queryforcount = "
		SELECT {$wpdb->prefix}posts.ID, {$wpdb->prefix}posts.post_title, {$wpdb->prefix}posts.post_content, {$wpdb->prefix}posts.post_date
    FROM {$wpdb->prefix}posts
    LEFT JOIN {$wpdb->prefix}term_relationships ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id)
    LEFT JOIN {$wpdb->prefix}term_taxonomy ON ({$wpdb->prefix}term_relationships.term_taxonomy_id = {$wpdb->prefix}term_taxonomy.term_taxonomy_id)
    LEFT JOIN {$wpdb->prefix}terms ON ({$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id)
    WHERE ({$wpdb->prefix}posts.post_type = 'bsp_custom_polls' OR {$wpdb->prefix}posts.post_type = 'post')
    AND {$wpdb->prefix}posts.post_status = 'publish'
    AND (
        {$wpdb->prefix}posts.post_title LIKE %s
        OR {$wpdb->prefix}posts.post_content LIKE %s
        OR {$wpdb->prefix}terms.name LIKE %s
    )
    AND YEAR({$wpdb->prefix}posts.post_date) >= %d AND YEAR({$wpdb->prefix}posts.post_date) <= %d
    GROUP BY {$wpdb->prefix}posts.ID
    ORDER BY {$wpdb->prefix}posts.post_date DESC
	";
	
	$queryforcount = $wpdb->prepare($queryforcount,  "%{$search_text}%" ,  "%{$search_text}%" , "%{$search_text}%" , $year_from, $year_to);
	/***count query */
	    $resultsforcount = count($wpdb->get_results($queryforcount));		
		$total_count = $resultsforcount;		
		$max_num_pages = ceil($total_count / $posts_per_page);
		}
		else if(isset($search_text) && !empty($search_text) && empty($from_date) && empty($to_date))
		{		
            
			global $wpdb;			
			$posts_per_page = 6;
			$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$offset = ($current_page - 1) * $posts_per_page;			
			$search_text =  $wpdb->esc_like($search_text);			
			$query = $wpdb->prepare(
				"
				SELECT {$wpdb->prefix}posts.ID, {$wpdb->prefix}posts.post_title, {$wpdb->prefix}posts.post_content, {$wpdb->prefix}posts.post_date
				FROM {$wpdb->prefix}posts
				LEFT JOIN {$wpdb->prefix}term_relationships ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id)
				LEFT JOIN {$wpdb->prefix}term_taxonomy ON ({$wpdb->prefix}term_relationships.term_taxonomy_id = {$wpdb->prefix}term_taxonomy.term_taxonomy_id)
				LEFT JOIN {$wpdb->prefix}terms ON ({$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id)
				WHERE ({$wpdb->prefix}posts.post_type = 'bsp_custom_polls' OR {$wpdb->prefix}posts.post_type = 'post')
				AND {$wpdb->prefix}posts.post_status = 'publish'
				AND (
					OR {$wpdb->prefix}posts.post_title LIKE %s
					OR {$wpdb->prefix}posts.post_content LIKE %s
					OR {$wpdb->prefix}terms.name LIKE %s
				)				
				GROUP BY {$wpdb->prefix}posts.ID
				ORDER BY {$wpdb->prefix}posts.post_date DESC
				LIMIT %d
				OFFSET %d
				",
				"%{$search_text}%", // Post title
				"%{$search_text}%", // Post content
				"%{$search_text}%", // Term name				
				$posts_per_page,
				$offset
			);
			
			$results = $wpdb->get_results($query);		
					
					
					/***count query */
					$queryforcount = "
					SELECT {$wpdb->prefix}posts.ID, {$wpdb->prefix}posts.post_title, {$wpdb->prefix}posts.post_content, {$wpdb->prefix}posts.post_date
				FROM {$wpdb->prefix}posts
				LEFT JOIN {$wpdb->prefix}term_relationships ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id)
				LEFT JOIN {$wpdb->prefix}term_taxonomy ON ({$wpdb->prefix}term_relationships.term_taxonomy_id = {$wpdb->prefix}term_taxonomy.term_taxonomy_id)
				LEFT JOIN {$wpdb->prefix}terms ON ({$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id)
				WHERE ({$wpdb->prefix}posts.post_type = 'bsp_custom_polls' OR {$wpdb->prefix}posts.post_type = 'post')
				AND {$wpdb->prefix}posts.post_status = 'publish'
				AND (
					OR {$wpdb->prefix}posts.post_title LIKE %s
					OR {$wpdb->prefix}posts.post_content LIKE %s
					OR {$wpdb->prefix}terms.name LIKE %s
				)				
				GROUP BY {$wpdb->prefix}posts.ID
				ORDER BY {$wpdb->prefix}posts.post_date DESC
				";
				
				$queryforcount = $wpdb->prepare($queryforcount,  "%{$search_text}%" ,  "%{$search_text}%" ,  "%{$search_text}%" );
				/***count query */
					$resultsforcount = count($wpdb->get_results($queryforcount));		
					$total_count = $resultsforcount;		
					$max_num_pages = ceil($total_count / $posts_per_page);
		}
		else if(isset($search_text) && !empty($search_text) && !empty($from_date) && empty($to_date))
		{		

			global $wpdb;

				$year_from = date('Y', strtotime($from_date));

				$posts_per_page = 6;
				$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$offset = ($current_page - 1) * $posts_per_page;

				$search_text =  $wpdb->esc_like($search_text) ;

				$query = $wpdb->prepare(
					"
					SELECT {$wpdb->prefix}posts.ID, {$wpdb->prefix}posts.post_title, {$wpdb->prefix}posts.post_content, {$wpdb->prefix}posts.post_date
					FROM {$wpdb->prefix}posts
					LEFT JOIN {$wpdb->prefix}term_relationships ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id)
					LEFT JOIN {$wpdb->prefix}term_taxonomy ON ({$wpdb->prefix}term_relationships.term_taxonomy_id = {$wpdb->prefix}term_taxonomy.term_taxonomy_id)
					LEFT JOIN {$wpdb->prefix}terms ON ({$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id)
					WHERE ({$wpdb->prefix}posts.post_type = 'bsp_custom_polls' OR {$wpdb->prefix}posts.post_type = 'post')
					AND {$wpdb->prefix}posts.post_status = 'publish'
					AND (
						{$wpdb->prefix}posts.post_title LIKE %s
						OR {$wpdb->prefix}posts.post_content LIKE %s
						OR {$wpdb->prefix}terms.name LIKE %s
					)
					AND YEAR({$wpdb->prefix}posts.post_date) >= %d
					GROUP BY {$wpdb->prefix}posts.ID
					ORDER BY {$wpdb->prefix}posts.post_date DESC
					LIMIT %d
					OFFSET %d
					",
					"%{$search_text}%", // Post title
					"%{$search_text}%", // Post content
					"%{$search_text}%", // Term name
					$year_from,    
					$posts_per_page,
					$offset
				);

				$results = $wpdb->get_results($query);

		
						
						/***count query */
						$queryforcount = "
						SELECT {$wpdb->prefix}posts.ID, {$wpdb->prefix}posts.post_title, {$wpdb->prefix}posts.post_content, {$wpdb->prefix}posts.post_date
					FROM {$wpdb->prefix}posts
					LEFT JOIN {$wpdb->prefix}term_relationships ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id)
					LEFT JOIN {$wpdb->prefix}term_taxonomy ON ({$wpdb->prefix}term_relationships.term_taxonomy_id = {$wpdb->prefix}term_taxonomy.term_taxonomy_id)
					LEFT JOIN {$wpdb->prefix}terms ON ({$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id)
					WHERE ({$wpdb->prefix}posts.post_type = 'bsp_custom_polls' OR {$wpdb->prefix}posts.post_type = 'post')
					AND {$wpdb->prefix}posts.post_status = 'publish'
					AND (
						{$wpdb->prefix}posts.post_title LIKE %s
						OR {$wpdb->prefix}posts.post_content LIKE %s
						OR {$wpdb->prefix}terms.name LIKE %s
					)
					AND YEAR({$wpdb->prefix}posts.post_date) >= %d
					GROUP BY {$wpdb->prefix}posts.ID
					ORDER BY {$wpdb->prefix}posts.post_date DESC
					";
					
					$queryforcount = $wpdb->prepare($queryforcount,  "%{$search_text}%" ,  "%{$search_text}%" , "%{$search_text}%", $year_from);
					/***count query */
						$resultsforcount = count($wpdb->get_results($queryforcount));		
						$total_count = $resultsforcount;		
						$max_num_pages = ceil($total_count / $posts_per_page);
						}
						else if(isset($search_text) && !empty($search_text) && empty($from_date) && !empty($to_date))
						{		

							global $wpdb;


				$year_to = date('Y', strtotime($to_date));
				$posts_per_page = 6;
				$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$offset = ($current_page - 1) * $posts_per_page;

				$search_text =  $wpdb->esc_like($search_text) ;

				$query = $wpdb->prepare(
					"
					SELECT {$wpdb->prefix}posts.ID, {$wpdb->prefix}posts.post_title, {$wpdb->prefix}posts.post_content, {$wpdb->prefix}posts.post_date
					FROM {$wpdb->prefix}posts
					LEFT JOIN {$wpdb->prefix}term_relationships ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id)
					LEFT JOIN {$wpdb->prefix}term_taxonomy ON ({$wpdb->prefix}term_relationships.term_taxonomy_id = {$wpdb->prefix}term_taxonomy.term_taxonomy_id)
					LEFT JOIN {$wpdb->prefix}terms ON ({$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id)
					WHERE ({$wpdb->prefix}posts.post_type = 'bsp_custom_polls' OR {$wpdb->prefix}posts.post_type = 'post')
					AND {$wpdb->prefix}posts.post_status = 'publish'
					AND (
						{$wpdb->prefix}posts.post_title LIKE %s
						OR {$wpdb->prefix}posts.post_content LIKE %s
						OR {$wpdb->prefix}terms.name LIKE %s
					)
					AND YEAR({$wpdb->prefix}posts.post_date) <= %d
					GROUP BY {$wpdb->prefix}posts.ID
					ORDER BY {$wpdb->prefix}posts.post_date DESC
					LIMIT %d
					OFFSET %d
					",
					"%{$search_text}%", // Post title
					"%{$search_text}%", // Post content
					"%{$search_text}%", // Term name    
					$year_to,
					$posts_per_page,
					$offset
				);

				$results = $wpdb->get_results($query);

		
		
					/***count query */
					$queryforcount = "
					SELECT {$wpdb->prefix}posts.ID, {$wpdb->prefix}posts.post_title, {$wpdb->prefix}posts.post_content, {$wpdb->prefix}posts.post_date
				FROM {$wpdb->prefix}posts
				LEFT JOIN {$wpdb->prefix}term_relationships ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id)
				LEFT JOIN {$wpdb->prefix}term_taxonomy ON ({$wpdb->prefix}term_relationships.term_taxonomy_id = {$wpdb->prefix}term_taxonomy.term_taxonomy_id)
				LEFT JOIN {$wpdb->prefix}terms ON ({$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id)
				WHERE ({$wpdb->prefix}posts.post_type = 'bsp_custom_polls' OR {$wpdb->prefix}posts.post_type = 'post')
				AND {$wpdb->prefix}posts.post_status = 'publish'
				AND (
					{$wpdb->prefix}posts.post_title LIKE %s
					OR {$wpdb->prefix}posts.post_content LIKE %s
					OR {$wpdb->prefix}terms.name LIKE %s
				)
				AND YEAR({$wpdb->prefix}posts.post_date) <= %d
				GROUP BY {$wpdb->prefix}posts.ID
				ORDER BY {$wpdb->prefix}posts.post_date DESC
				";
				
				$queryforcount = $wpdb->prepare($queryforcount,  "%{$search_text}%" ,  "%{$search_text}%" ,"%{$search_text}%" , $year_to);
				/***count query */
					$resultsforcount = count($wpdb->get_results($queryforcount));		
					$total_count = $resultsforcount;		
					$max_num_pages = ceil($total_count / $posts_per_page);
					}
					else {
						
						global $wpdb;

						
						$posts_per_page = 6;
						$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$offset = ($current_page - 1) * $posts_per_page;			
						
						
						$query = $wpdb->prepare(
							"
							SELECT {$wpdb->prefix}posts.ID, {$wpdb->prefix}posts.post_title, {$wpdb->prefix}posts.post_content, {$wpdb->prefix}posts.post_date
							FROM {$wpdb->prefix}posts
							LEFT JOIN {$wpdb->prefix}term_relationships ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id)
							LEFT JOIN {$wpdb->prefix}term_taxonomy ON ({$wpdb->prefix}term_relationships.term_taxonomy_id = {$wpdb->prefix}term_taxonomy.term_taxonomy_id)
							LEFT JOIN {$wpdb->prefix}terms ON ({$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id)
							WHERE ({$wpdb->prefix}posts.post_type = 'bsp_custom_polls' OR {$wpdb->prefix}posts.post_type = 'post')
							AND {$wpdb->prefix}posts.post_status = 'publish'
							GROUP BY {$wpdb->prefix}posts.ID
							ORDER BY {$wpdb->prefix}posts.post_date DESC
							LIMIT %d
							OFFSET %d
							",				
							$posts_per_page,
							$offset
						);
						
						$results = $wpdb->get_results($query);	
								
								
								/***count query */
								$queryforcount = "
								SELECT {$wpdb->prefix}posts.ID, {$wpdb->prefix}posts.post_title, {$wpdb->prefix}posts.post_content, {$wpdb->prefix}posts.post_date
							FROM {$wpdb->prefix}posts
							LEFT JOIN {$wpdb->prefix}term_relationships ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id)
							LEFT JOIN {$wpdb->prefix}term_taxonomy ON ({$wpdb->prefix}term_relationships.term_taxonomy_id = {$wpdb->prefix}term_taxonomy.term_taxonomy_id)
							LEFT JOIN {$wpdb->prefix}terms ON ({$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id)
							WHERE ({$wpdb->prefix}posts.post_type = 'bsp_custom_polls' OR {$wpdb->prefix}posts.post_type = 'post')
							AND {$wpdb->prefix}posts.post_status = 'publish'
							GROUP BY {$wpdb->prefix}posts.ID
							ORDER BY {$wpdb->prefix}posts.post_date DESC
							";
							
							$queryforcount = $wpdb->prepare($queryforcount);
							/***count query */
								$resultsforcount = count($wpdb->get_results($queryforcount));		
								$total_count = $resultsforcount;		
								$max_num_pages = ceil($total_count / $posts_per_page);
					}
		
			if ($results) :
			$options = array('tile-block', 'tile-block-red', 'tile-block-grey');	
			foreach($results as $row) :
				$randomIndex = array_rand($options);
				$currentClass = $options[$randomIndex];	
				$post_id = $row->ID;
				$post_type=get_post_type($post_id);
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
				<div class="news-block grid-polls col-md-4">
					<?php if(!empty($image_link) && $post_type=='post'){?>
					 <div class="news-image"><?php echo $image_link; ?></div> 
					 <?php } else { ?>
					<div class="news-image <?php echo $currentClass;?>"> </div> 
					<?php } ?>
					<div class="news-info">
						<h4 class="news-details"><a href="<?php echo $permalink; ?>"><span class="news-title"><?php echo $row->post_title; ?></span></a></h4>
						<!-- <p class="news-other-details"><span class="news-date"><?php //echo date('M j, Y',strtotime($row->post_date));?></span></p>
						<p class="news-content"><?php //echo trim_content_custom($row->post_content); ?></p>
						<p><a href="<?php //echo $permalink; ?>">Read More</a></p> -->
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
					$pagination_links = paginate_links(array(
						'total' => $max_num_pages,
						'current' => $current_page,
						'base' => add_query_arg('show_type', 'grid', $base_url . '%_%'),
                        'format' => '?paged=%#%',
						'prev_text' => '&laquo;',
						'next_text' => '&raquo;',
					));
					echo $pagination_links;
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
<!--grid view-->
<!---list view --->
<div class="container tile-post pt-2 pb-5 mt-md-2 pb-5 mb-md-5 show-type-list" <?php echo ($showt == 'list') ? 'style="display:block;"' : 'style="display:none;"'; ?>>
	<div class="row">
		<div class="container">
			<form class="post-filter-form">
				<div class="post-fields">					
					<input type="text" class="form-control" name="search_text" placeholder="Enter your search query" aria-label="Search" required value="<?php echo $search_text;?>" autocomplete="off">
				</div>
				<div class="post-fields">				
					<div class="input-group">
					<input type="text" class="form-control datepicker" name="from_date" placeholder="From Date"  value="<?php echo $from_date; ?>" autocomplete="off">
				    </div>							
				</div>
				<div class="post-fields">				
					<div class="input-group">
					<input type="text" class="form-control datepicker" name="to_date" placeholder="To Date"  value="<?php echo $to_date; ?>" autocomplete="off">
				    </div>
				</div>
				<div class="post-fields">					
					<button type="submit" class="btn btn-default">Search</button>
					<button type="button" class="btn btn-primary resetfrm" onclick="window.location.href = '<?php echo site_url('polls');?>'">Reset</button>
				</div>
			</form>
		</div>
	</div>

	       

	<div class="polls-post-block">
		<?php
		
		if(isset($search_text) && isset($from_date) && isset($to_date) && !empty($search_text) && !empty($from_date) && !empty($to_date))
		{		

			global $wpdb;

$year_from = $from_date;//date('Y', strtotime($from_date));
$year_to = $to_date;//date('Y', strtotime($to_date));
$posts_per_page = 6;
$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
$offset = ($current_page - 1) * $posts_per_page;

$search_text =  $wpdb->esc_like($search_text) ;

$query = $wpdb->prepare(
    "
    SELECT {$wpdb->prefix}posts.ID, {$wpdb->prefix}posts.post_title, {$wpdb->prefix}posts.post_content, {$wpdb->prefix}posts.post_date
    FROM {$wpdb->prefix}posts
    LEFT JOIN {$wpdb->prefix}term_relationships ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id)
    LEFT JOIN {$wpdb->prefix}term_taxonomy ON ({$wpdb->prefix}term_relationships.term_taxonomy_id = {$wpdb->prefix}term_taxonomy.term_taxonomy_id)
    LEFT JOIN {$wpdb->prefix}terms ON ({$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id)
    WHERE ({$wpdb->prefix}posts.post_type = 'bsp_custom_polls' OR {$wpdb->prefix}posts.post_type = 'post')
    AND {$wpdb->prefix}posts.post_status = 'publish'
    AND (
        {$wpdb->prefix}posts.post_title LIKE %s
        OR {$wpdb->prefix}posts.post_content LIKE %s
        OR {$wpdb->prefix}terms.name LIKE %s
    )
    AND YEAR({$wpdb->prefix}posts.post_date) >= %d AND YEAR({$wpdb->prefix}posts.post_date) <= %d
    GROUP BY {$wpdb->prefix}posts.ID
    ORDER BY {$wpdb->prefix}posts.post_date DESC
    LIMIT %d
    OFFSET %d
    ",
	"%{$search_text}%", // Post title
	"%{$search_text}%", // Post content
	"%{$search_text}%", // Term name	
    $year_from,
    $year_to,
    $posts_per_page,
    $offset
);

$results = $wpdb->get_results($query);

		
		
		/***count query */
		$queryforcount = "
		SELECT {$wpdb->prefix}posts.ID, {$wpdb->prefix}posts.post_title, {$wpdb->prefix}posts.post_content, {$wpdb->prefix}posts.post_date
    FROM {$wpdb->prefix}posts
    LEFT JOIN {$wpdb->prefix}term_relationships ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id)
    LEFT JOIN {$wpdb->prefix}term_taxonomy ON ({$wpdb->prefix}term_relationships.term_taxonomy_id = {$wpdb->prefix}term_taxonomy.term_taxonomy_id)
    LEFT JOIN {$wpdb->prefix}terms ON ({$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id)
    WHERE ({$wpdb->prefix}posts.post_type = 'bsp_custom_polls' OR {$wpdb->prefix}posts.post_type = 'post')
    AND {$wpdb->prefix}posts.post_status = 'publish'
    AND (
        {$wpdb->prefix}posts.post_title LIKE %s
        OR {$wpdb->prefix}posts.post_content LIKE %s
        OR {$wpdb->prefix}terms.name LIKE %s
    )
    AND YEAR({$wpdb->prefix}posts.post_date) >= %d AND YEAR({$wpdb->prefix}posts.post_date) <= %d
    GROUP BY {$wpdb->prefix}posts.ID
    ORDER BY {$wpdb->prefix}posts.post_date DESC
	";
	
	$queryforcount = $wpdb->prepare($queryforcount, "%{$search_text}%" ,  "%{$search_text}%" ,  "%{$search_text}%" , $year_from, $year_to);
	/***count query */
	    $resultsforcount = count($wpdb->get_results($queryforcount));		
		$total_count = $resultsforcount;		
		$max_num_pages = ceil($total_count / $posts_per_page);
		}
		else if(isset($search_text) && !empty($search_text) && empty($from_date) && empty($to_date))
		{		

			global $wpdb;			
			$posts_per_page = 6;
			$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$offset = ($current_page - 1) * $posts_per_page;			
			$search_text = $wpdb->esc_like($search_text) ;			
			$query = $wpdb->prepare(
				"
				SELECT {$wpdb->prefix}posts.ID, {$wpdb->prefix}posts.post_title, {$wpdb->prefix}posts.post_content, {$wpdb->prefix}posts.post_date
				FROM {$wpdb->prefix}posts
				LEFT JOIN {$wpdb->prefix}term_relationships ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id)
				LEFT JOIN {$wpdb->prefix}term_taxonomy ON ({$wpdb->prefix}term_relationships.term_taxonomy_id = {$wpdb->prefix}term_taxonomy.term_taxonomy_id)
				LEFT JOIN {$wpdb->prefix}terms ON ({$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id)
				WHERE ({$wpdb->prefix}posts.post_type = 'bsp_custom_polls' OR {$wpdb->prefix}posts.post_type = 'post')
				AND {$wpdb->prefix}posts.post_status = 'publish'
				AND (
					{$wpdb->prefix}posts.post_title LIKE %s
					OR {$wpdb->prefix}posts.post_content LIKE %s
					OR {$wpdb->prefix}terms.name LIKE %s
				)				
				GROUP BY {$wpdb->prefix}posts.ID
				ORDER BY {$wpdb->prefix}posts.post_date DESC
				LIMIT %d
				OFFSET %d
				",
				"%{$search_text}%", // Post title
				"%{$search_text}%", // Post content
				"%{$search_text}%", // Term name				
				$posts_per_page,
				$offset
			);
			
			$results = $wpdb->get_results($query);		
					
					
					/***count query */
					$queryforcount = "
					SELECT {$wpdb->prefix}posts.ID, {$wpdb->prefix}posts.post_title, {$wpdb->prefix}posts.post_content, {$wpdb->prefix}posts.post_date
				FROM {$wpdb->prefix}posts
				LEFT JOIN {$wpdb->prefix}term_relationships ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id)
				LEFT JOIN {$wpdb->prefix}term_taxonomy ON ({$wpdb->prefix}term_relationships.term_taxonomy_id = {$wpdb->prefix}term_taxonomy.term_taxonomy_id)
				LEFT JOIN {$wpdb->prefix}terms ON ({$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id)
				WHERE ({$wpdb->prefix}posts.post_type = 'bsp_custom_polls' OR {$wpdb->prefix}posts.post_type = 'post')
				AND {$wpdb->prefix}posts.post_status = 'publish'
				AND (
					 {$wpdb->prefix}posts.post_title LIKE %s
					OR {$wpdb->prefix}posts.post_content LIKE %s
					OR {$wpdb->prefix}terms.name LIKE %s
				)				
				GROUP BY {$wpdb->prefix}posts.ID
				ORDER BY {$wpdb->prefix}posts.post_date DESC
				";
				
				$queryforcount = $wpdb->prepare($queryforcount,  "%{$search_text}%" ,  "%{$search_text}%" ,  "%{$search_text}%");
				/***count query */
					$resultsforcount = count($wpdb->get_results($queryforcount));		
					$total_count = $resultsforcount;		
					$max_num_pages = ceil($total_count / $posts_per_page);
		}
		else if(isset($search_text) && !empty($search_text) && !empty($from_date) && empty($to_date))
		{		

			global $wpdb;

				$year_from = date('Y', strtotime($from_date));

				$posts_per_page = 6;
				$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$offset = ($current_page - 1) * $posts_per_page;

				$search_text =  $wpdb->esc_like($search_text) ;

				$query = $wpdb->prepare(
					"
					SELECT {$wpdb->prefix}posts.ID, {$wpdb->prefix}posts.post_title, {$wpdb->prefix}posts.post_content, {$wpdb->prefix}posts.post_date
					FROM {$wpdb->prefix}posts
					LEFT JOIN {$wpdb->prefix}term_relationships ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id)
					LEFT JOIN {$wpdb->prefix}term_taxonomy ON ({$wpdb->prefix}term_relationships.term_taxonomy_id = {$wpdb->prefix}term_taxonomy.term_taxonomy_id)
					LEFT JOIN {$wpdb->prefix}terms ON ({$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id)
					WHERE ({$wpdb->prefix}posts.post_type = 'bsp_custom_polls' OR {$wpdb->prefix}posts.post_type = 'post')
					AND {$wpdb->prefix}posts.post_status = 'publish'
					AND (
						{$wpdb->prefix}posts.post_title LIKE %s
						OR {$wpdb->prefix}posts.post_content LIKE %s
						OR {$wpdb->prefix}terms.name LIKE %s
					)
					AND YEAR({$wpdb->prefix}posts.post_date) >= %d
					GROUP BY {$wpdb->prefix}posts.ID
					ORDER BY {$wpdb->prefix}posts.post_date DESC
					LIMIT %d
					OFFSET %d
					",
					"%{$search_text}%", // Post title
					"%{$search_text}%", // Post content
					"%{$search_text}%", // Term name
					$year_from,    
					$posts_per_page,
					$offset
				);

				$results = $wpdb->get_results($query);

		
						
						/***count query */
						$queryforcount = "
						SELECT {$wpdb->prefix}posts.ID, {$wpdb->prefix}posts.post_title, {$wpdb->prefix}posts.post_content, {$wpdb->prefix}posts.post_date
					FROM {$wpdb->prefix}posts
					LEFT JOIN {$wpdb->prefix}term_relationships ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id)
					LEFT JOIN {$wpdb->prefix}term_taxonomy ON ({$wpdb->prefix}term_relationships.term_taxonomy_id = {$wpdb->prefix}term_taxonomy.term_taxonomy_id)
					LEFT JOIN {$wpdb->prefix}terms ON ({$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id)
					WHERE ({$wpdb->prefix}posts.post_type = 'bsp_custom_polls' OR {$wpdb->prefix}posts.post_type = 'post')
					AND {$wpdb->prefix}posts.post_status = 'publish'
					AND (
						{$wpdb->prefix}posts.post_title LIKE %s
						OR {$wpdb->prefix}posts.post_content LIKE %s
						OR {$wpdb->prefix}terms.name LIKE %s
					)
					AND YEAR({$wpdb->prefix}posts.post_date) >= %d
					GROUP BY {$wpdb->prefix}posts.ID
					ORDER BY {$wpdb->prefix}posts.post_date DESC
					";
					
					$queryforcount = $wpdb->prepare($queryforcount,  "%{$search_text}%" ,  "%{$search_text}%" ,  "%{$search_text}%" , $year_from);
					/***count query */
						$resultsforcount = count($wpdb->get_results($queryforcount));		
						$total_count = $resultsforcount;		
						$max_num_pages = ceil($total_count / $posts_per_page);
						}
						else if(isset($search_text) && !empty($search_text) && empty($from_date) && !empty($to_date))
						{		

							global $wpdb;


				$year_to = date('Y', strtotime($to_date));
				$posts_per_page = 6;
				$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$offset = ($current_page - 1) * $posts_per_page;

				$search_text =  $wpdb->esc_like($search_text);

				$query = $wpdb->prepare(
					"
					SELECT {$wpdb->prefix}posts.ID, {$wpdb->prefix}posts.post_title, {$wpdb->prefix}posts.post_content, {$wpdb->prefix}posts.post_date
					FROM {$wpdb->prefix}posts
					LEFT JOIN {$wpdb->prefix}term_relationships ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id)
					LEFT JOIN {$wpdb->prefix}term_taxonomy ON ({$wpdb->prefix}term_relationships.term_taxonomy_id = {$wpdb->prefix}term_taxonomy.term_taxonomy_id)
					LEFT JOIN {$wpdb->prefix}terms ON ({$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id)
					WHERE ({$wpdb->prefix}posts.post_type = 'bsp_custom_polls' OR {$wpdb->prefix}posts.post_type = 'post')
					AND {$wpdb->prefix}posts.post_status = 'publish'
					AND (
						{$wpdb->prefix}posts.post_title LIKE %s
						OR {$wpdb->prefix}posts.post_content LIKE %s
						OR {$wpdb->prefix}terms.name LIKE %s
					)
					AND YEAR({$wpdb->prefix}posts.post_date) <= %d
					GROUP BY {$wpdb->prefix}posts.ID
					ORDER BY {$wpdb->prefix}posts.post_date DESC
					LIMIT %d
					OFFSET %d
					",
					"%{$search_text}%", // Post title
					"%{$search_text}%", // Post content
					"%{$search_text}%", // Term name    
					$year_to,
					$posts_per_page,
					$offset
				);

				$results = $wpdb->get_results($query);

		
		
					/***count query */
					$queryforcount = "
					SELECT {$wpdb->prefix}posts.ID, {$wpdb->prefix}posts.post_title, {$wpdb->prefix}posts.post_content, {$wpdb->prefix}posts.post_date
				FROM {$wpdb->prefix}posts
				LEFT JOIN {$wpdb->prefix}term_relationships ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id)
				LEFT JOIN {$wpdb->prefix}term_taxonomy ON ({$wpdb->prefix}term_relationships.term_taxonomy_id = {$wpdb->prefix}term_taxonomy.term_taxonomy_id)
				LEFT JOIN {$wpdb->prefix}terms ON ({$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id)
				WHERE ({$wpdb->prefix}posts.post_type = 'bsp_custom_polls' OR {$wpdb->prefix}posts.post_type = 'post')
				AND {$wpdb->prefix}posts.post_status = 'publish'
				AND (
					{$wpdb->prefix}posts.post_title LIKE %s
					OR {$wpdb->prefix}posts.post_content LIKE %s
					OR {$wpdb->prefix}terms.name LIKE %s
				)
				AND YEAR({$wpdb->prefix}posts.post_date) <= %d
				GROUP BY {$wpdb->prefix}posts.ID
				ORDER BY {$wpdb->prefix}posts.post_date DESC
				";
				
				$queryforcount = $wpdb->prepare($queryforcount, "%{$search_text}%" ,  "%{$search_text}%",  "%{$search_text}%", $year_to);
				/***count query */
					$resultsforcount = count($wpdb->get_results($queryforcount));		
					$total_count = $resultsforcount;		
					$max_num_pages = ceil($total_count / $posts_per_page);
					}
					else {
						
						global $wpdb;

						
						$posts_per_page = 6;
						$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$offset = ($current_page - 1) * $posts_per_page;			
						
						
						$query = $wpdb->prepare(
							"
							SELECT {$wpdb->prefix}posts.ID, {$wpdb->prefix}posts.post_title, {$wpdb->prefix}posts.post_content, {$wpdb->prefix}posts.post_date
							FROM {$wpdb->prefix}posts
							LEFT JOIN {$wpdb->prefix}term_relationships ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id)
							LEFT JOIN {$wpdb->prefix}term_taxonomy ON ({$wpdb->prefix}term_relationships.term_taxonomy_id = {$wpdb->prefix}term_taxonomy.term_taxonomy_id)
							LEFT JOIN {$wpdb->prefix}terms ON ({$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id)
							WHERE ({$wpdb->prefix}posts.post_type = 'bsp_custom_polls' OR {$wpdb->prefix}posts.post_type = 'post')
							AND {$wpdb->prefix}posts.post_status = 'publish'
							GROUP BY {$wpdb->prefix}posts.ID
							ORDER BY {$wpdb->prefix}posts.post_date DESC
							LIMIT %d
							OFFSET %d
							",				
							$posts_per_page,
							$offset
						);
						
						$results = $wpdb->get_results($query);	
								
								
								/***count query */
								$queryforcount = "
								SELECT {$wpdb->prefix}posts.ID, {$wpdb->prefix}posts.post_title, {$wpdb->prefix}posts.post_content, {$wpdb->prefix}posts.post_date
							FROM {$wpdb->prefix}posts
							LEFT JOIN {$wpdb->prefix}term_relationships ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id)
							LEFT JOIN {$wpdb->prefix}term_taxonomy ON ({$wpdb->prefix}term_relationships.term_taxonomy_id = {$wpdb->prefix}term_taxonomy.term_taxonomy_id)
							LEFT JOIN {$wpdb->prefix}terms ON ({$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id)
							WHERE ({$wpdb->prefix}posts.post_type = 'bsp_custom_polls' OR {$wpdb->prefix}posts.post_type = 'post')
							AND {$wpdb->prefix}posts.post_status = 'publish'
							GROUP BY {$wpdb->prefix}posts.ID
							ORDER BY {$wpdb->prefix}posts.post_date DESC
							";
							
							$queryforcount = $wpdb->prepare($queryforcount);
							/***count query */
								$resultsforcount = count($wpdb->get_results($queryforcount));		
								$total_count = $resultsforcount;		
								$max_num_pages = ceil($total_count / $posts_per_page);
					}
		
			if ($results) :
				$options = array('tile-block', 'tile-block-red', 'tile-block-grey');
			foreach($results as $row) :
				$randomIndex = array_rand($options);
                $currentClass = 'tile-block';//$options[$randomIndex];
				$post_id = $row->ID;
				$post_type=get_post_type($post_id);
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
				<div class="news-block list-polls <?php echo $currentClass;?>">
				<?php if(!empty($image_link) && $post_type=='post'){?>
						<div class="news-image"><?php echo $image_link; ?></div> 
					<?php }  ?>
						
					 
					<div class="news-info">
						<h4 class="news-details"><a href="<?php echo $permalink; ?>"><span class="news-title"><?php echo $row->post_title; ?></span></a></h4>
						<!-- <p class="news-other-details"><span class="news-date"><?php //echo date('M j, Y',strtotime($row->post_date));?></span></p>
						<p class="news-content"><?php //echo trim_content_custom($row->post_content); ?></p>
						<p><a href="<?php //echo $permalink; ?>">Read More</a></p> -->
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
					$pagination_links = paginate_links(array(
						'total' => $max_num_pages,
						'current' => $current_page,
						'base' => add_query_arg('show_type', 'list', $base_url . '%_%'),
                        'format' => '?paged=%#%',
						'prev_text' => '&laquo;',
						'next_text' => '&raquo;',
					));
					echo $pagination_links;
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
<!--list view -->
<?php 
get_footer();
?>
