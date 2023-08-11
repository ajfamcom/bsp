<?php /**Template Name:News And Analysis */?>
<h3 class="small-title">News And Analysis</h3>
<?php
$args = array(
    'post_type' => 'news_analysis',
    'posts_per_page' => 5,    
    'meta_query' => array(
        array(
            'key' => 'news_status', 
            'value'   => 'Active', // Serialized value for 'Yes'
            'compare' => '='
        ),
        array(
            'key' => 'display_on_homepage', 
            'value'   => 'Yes', // Serialized value for 'Yes'
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
        $theme_directory_uri = get_template_directory_uri();
        $noimage = $theme_directory_uri . '/assets/images/on-image-placeholder.jpg';
        ?>
<div class="news-single-block">
    <div class="sidebar-img">
	<?php
    if (has_post_thumbnail()) {
    the_post_thumbnail(); 
    }
    else{
        echo '<img src="'.$noimage.'" class="attachment-post-thumbnail size-post-thumbnail wp-post-image">';
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
