<?php /*Template Name: Polls Page*/?>

<?php
$page_id = get_the_ID();
$full_banner = get_field('full_banner', $page_id);
$image_over_banner = get_field('image_over_banner', $page_id);
?>
<?php get_header();?>

<div class="inner-bnr in-the-news-bnr" style="background-image: linear-gradient(180deg, rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('<?php echo $full_banner['url']; ?>')">
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
	<div class="col-md-12 py-md-5">
		<div class="row">
			<?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => 'news_analysis',
                'posts_per_page' => 3, 
                'paged' => $paged, 
                'meta_query' => array(
                    array(
                        'key' => 'news_status', 
                        'value'   => 'Active', 
                        'compare' => '=',
                    ),    
                ),
            );
                     
            
            $query = new WP_Query( $args );   
       
    
			if ($query->have_posts()) :
					while ($query->have_posts()) :
						$query->the_post();						
                        $post_id = get_the_ID();
                        $short_desc = get_field('short_description', $post_id);
                        $link_data = get_field('external_link', $post_id);
                        $link='javascript:void(0)';
                        $target="";
                        if($link_data){
                            $link= $link_data;
                            $target='_blank';
                        }
                        if (has_post_thumbnail($post_id)) {
                           
                            $thumbnail_id = get_post_thumbnail_id($post_id);                            
                            $image_url = wp_get_attachment_url($thumbnail_id);                         
                            $theme_directory_uri = get_template_directory_uri();    
                            $noimage = $theme_directory_uri . '/assets/images/on-image-placeholder.jpg';                          
                          
                            $image_link= '<img src="' . esc_url($image_url) . '" alt="Featured Image" class="news-image">';
                        } else {
                            $image_link= '<img src="' . esc_url($noimage) . '" alt="Featured Image" class="news-image">';
                        }
						?> 
							<div class="single-news col-md-4">
								<div class="news-image-square"><?php echo $image_link;?></div>
								<div class="news-info">
								<h4 class="news-details"><a href="<?php echo $link;?>" target="<?php echo  $target;?>" ><?php the_title();?></a></h4>
								</div>
							</div>
					<?php endwhile; ?>
			<?php endif;?>
        </div>
		        <!-- Pagination Links -->
                <div class="pagination">
                    <?php
                    echo paginate_links(array(
                        'total' => $query->max_num_pages,
                        'current' => $paged,
                        'prev_text' => '&laquo;',
                        'next_text' => '&raquo;',
                    ));
                    ?>
                </div>
    </div>
</div>	

<?php get_footer();?>
