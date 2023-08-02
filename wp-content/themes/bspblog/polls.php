<?php
/*
Template Name: Polls Page
*/
get_header();
$page_id = get_the_ID();
$full_banner = get_field('full_banner', $page_id);
$image_over_banner = get_field('image_over_banner', $page_id);
?>
<?php get_header();?>

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
<div class="col-md-12 py-md-5">
		<div class="row">
			<?php
			$fargs = array(
			'post_type'      => 'polls',
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

						?> 
							<div class="news-block col-md-6">
								<div class="news-image"><img src="" /></div>
								
								</div>
							</div>
                            <div class="news-block col-md-6">
								
								<div class="news-info">
								<h4 class="news-details"><span class="news-title"><?php the_title(); ?></span></h4>
								<p class="news-other-details"><span class="news-date">date</span></p>
								<p class="news-content"><?php the_content();?></p>
                                <p><a href="<?php echo $permalink;?>">Read More</a></p>
								</div>
							</div>
					<?php endwhile; ?>
			<?php endif;?>
        </div>
		
    </div>	
	<div class="col-md-12 py-md-5">
		<div class="row">
			<?php
			$args = array(
			'post_type'      => 'post',
			'posts_per_page' => -1,			          
		    );
    
          $query = new WP_Query( $args );
    
			if ($query->have_posts()) :
					while ($query->have_posts()) :
						$query->the_post();
						$post_id = get_the_ID();
						
						$permalink = get_permalink($post_id);

						?> 
							<div class="news-block col-md-4">
								<div class="news-image"><img src="" /></div>
								<div class="news-info">
								<h4 class="news-details"><span class="news-title"><?php the_title(); ?></span></h4>
								<p class="news-other-details"><span class="news-date">date</span></p>
								<p class="news-content"><?php the_content();?></p>
                                <p><a href="<?php echo $permalink;?>">Read More</a></p>
								</div>
							</div>
					<?php endwhile; ?>
			<?php endif;?>
        </div>
		
    </div>
</div>	
<?php 
get_footer();
?>