<?php /**Template Name:In the newss */?>
<?php
$page_id = get_the_ID();
$full_banner = get_field('full_banner', $page_id);
$image_over_banner = get_field('image_over_banner', $page_id);
$showt=isset($_REQUEST['show_type'])?$_REQUEST['show_type']:'grid';
$base_url = get_permalink();
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

<div class="container pt-5 mt-md-5">	
<div class="d-flex align-items-center gap-3 mb-4">
  <!--   <a href="#" onclick="show('grid');"><i style="background-color: #153d67;" class="fa-solid fa-grip fs-2 rounded-3 text-white py-1 px-2"></i></a>
    <a href="#" onclick="show('list');"><i style="background-color: #153d67;" class="fa-solid fa-grip-lines fs-2 rounded-3 text-white py-1 px-2"></i></a> -->
    <a class="section-format" href="<?php echo add_query_arg('show_type', 'grid', $base_url); ?>"><i class="fa-solid fa-grip fs-4 py-1 px-2"></i></a>
    <a class="section-format" href="<?php echo add_query_arg('show_type', 'list', $base_url); ?>"><i class="fa-solid fa-bars fs-4 py-1 px-2"></i></a>
    
</div>
</div>
<div class="container grid-post pt-2 pb-5 mt-md-2 pb-5 mb-md-5 show-type-grid" <?php echo ($showt == 'grid') ? 'style="display:block;"' : 'style="display:none;"'; ?>>	
	<div class="col-md-12">

   

		<div class="row">
			<?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => 'news_analysis',
                'posts_per_page' => 12, 
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
            
    
             $counter = 0;
            
			if ($query->have_posts()) :
					while ($query->have_posts()) :
                        $currentClass = ($counter % 3 === 0) ? "gray-tile" : (($counter % 3 === 1) ? "red-tile" : "blue-tile");
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
                       
						?> 
							<div class="single-news col-md-4 <?php echo $currentClass;?>">								
								<div class="news-info">
								<h4 class="news-details"><a href="<?php echo $link;?>" target="<?php echo  $target;?>" ><?php the_title();?></a></h4>
								</div>
							</div>
					<?php 
                $counter++;
                endwhile; ?>
                   <?php wp_reset_postdata();?>
			<?php endif;?>
        </div>
		        <!-- Pagination Links -->
                <div class="pagination">
                    <?php
                    echo paginate_links(array(
                        'total' => $query->max_num_pages,
                        'current' => $paged,
                        'base' => add_query_arg('show_type', 'grid', $base_url . '%_%'),
                        'format' => '?paged=%#%',
                        'prev_text' => '&laquo;',
                        'next_text' => '&raquo;',
                    ));
                    ?>
                </div>
    </div>
</div>	


<div class="container tile-post pt-2 pb-5 mt-md-2 pb-5 mb-md-5 show-type-list" <?php echo ($showt == 'list') ? 'style="display:block;"' : 'style="display:none;"'; ?>>
  <div class="row">
    <div class="col-12">
        <div class="tile-blog-post">
        <?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => 'news_analysis',
                'posts_per_page' => 12, 
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
       
           
    
            $counter = 0;
			if ($query->have_posts()) :
					while ($query->have_posts()) :
                        $currentClass = ($counter % 3 === 0) ? "gray-tile" : (($counter % 3 === 1) ? "red-tile" : "blue-tile");
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
                       
						?>     
        <h4 class="news-details <?php echo $currentClass;?>"><a href="<?php echo $link;?>" target="<?php echo  $target;?>" ><?php the_title();?></a></h4>
        <?php 
        $counter++;
        endwhile;
wp_reset_postdata();
    endif;
        ?>
        </div>
    </div>
    <div class="pagination">
                    <?php
                    echo paginate_links(array(
                        'total' => $query->max_num_pages,
                        'current' => $paged,
                        'base' => add_query_arg('show_type', 'list', $base_url . '%_%'),
                        'format' => '?paged=%#%',
                        'prev_text' => '&laquo;',
                        'next_text' => '&raquo;',
                    ));
                    ?>
                </div>
  </div>
</div>
<script> 
    function show(showtype){
      if(showtype=='grid'){
        $('.show-type-list').css('display','none');
        $('.show-type-grid').css('display','block');
      }
      if(showtype=='list'){
        $('.show-type-list').css('display','block');
        $('.show-type-grid').css('display','none');
     }
    }
</script>
<?php get_footer();?>
