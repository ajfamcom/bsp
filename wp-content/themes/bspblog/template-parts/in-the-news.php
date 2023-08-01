<?php /**Template Name:In the newss */?>
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
<h3 class="small-title">News And Analysis</h3>
<div class="col-md-12 py-md-5">
		<div class="row">
<?php
$args = array(
    'post_type' => 'news_analysis',
    'posts_per_page' => -1,    
    'meta_query' => array(
        array(
            'key' => 'news_status', 
            'value'   => 'Active', // Serialized value for 'Yes'
            'compare' => '='
        ),
      
    ),
);

$query = new WP_Query( $args );


if ($query->have_posts()) {
    while ($query->have_posts()) {
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
<div class="news-single-block">
    <div class="sidebar-img">
	<?php
    if (has_post_thumbnail()) {
    the_post_thumbnail(); 
    }
    ?>
    </div>
    <p><a href="<?php echo $link;?>" target="<?php echo  $target;?>" ><?php the_title();?></a></p>
</div>
<?php
    }
 wp_reset_postdata();
    
}

// Reset the query to avoid conflicts with other queries
 
?>  
</div>
</div>
</div>
