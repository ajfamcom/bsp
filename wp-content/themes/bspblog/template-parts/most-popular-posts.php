<?php /**Template Name: Most Popular Posts */?>
<h1 class="title">Latest From BSP</h1>
<div class="col-lg-7 col-md-8">
<?php
$images = ['image1.jpg', 'image2.jpg', 'image3.jpg', 'image4.jpg', 'image5.jpg', 'image6.jpg'];

$theme_directory_uri = get_template_directory_uri();
$noimage = $theme_directory_uri . '/assets/images/on-image-placeholder.jpg';

// Generate a random index
$randomIndex = rand(0, 6);

// Get the random image filename
$randomImage = $images[$randomIndex];
$featimage = $theme_directory_uri . '/assets/home-page-images/'.$randomImage;
$args = array(
    'post_type' => 'bsp_custom_polls',
    'posts_per_page' => 1,    
    'meta_query' => array(
        array(
            'key' => 'is_featured_poll', 
            'value'   => 'Yes', // Serialized value for 'Yes'
            'compare' => 'LIKE'
        ),
    ),
);

$query = new WP_Query( $args );


if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();
        $featured_post = get_field('featured', $post_id);
        $post_date = get_the_date( 'M j, Y', $post_id );
        ?>
    <?php //if(isset($featured_post) && $featured_post[0]=='Yes'){ ?>
    <div class="featured-post">
    <div class="featured-post-img">
	<?php    
        echo '<img src="' . esc_url($featimage) . '" alt="Featured Image" class="img-fluid">';    
    ?>
    </div>
    <div class="featured-post-discription">
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	
    <p class="post-date"><?php echo $post_date;?></p>
    </div>
    </div>
    <?php //} ?>
        <?php
    }
 wp_reset_postdata();
    
}

// Reset the query to avoid conflicts with other queries
 
?>  
<?php
$args = array(
    'post_type' => 'bsp_custom_polls',
    'posts_per_page' => 1,    
    'meta_query' => array(
        array(
            'key' => 'is_sticky_poll', 
            'value'   => 'Yes', // Serialized value for 'Yes'
            'compare' => 'LIKE'
        ),
    ),
);
$stickimages = ['image7.jpg', 'image8.jpg', 'image9.jpg', 'image10.jpg', 'image11.jpg', 'image12.jpg'];
// Generate a random index
$randomIndexstick = rand(0, 6);

// Get the random image filename
$randomImagestick = $stickimages[$randomIndexstick];
$stickyimage = $theme_directory_uri . '/assets/home-page-images/'.$randomImagestick;
$query = new WP_Query( $args );

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();
       
        $post_date = get_the_date( 'M j, Y', $post_id );
        ?>
   
    <div class="static-post">
    <div class="static-post-img">
	<?php
    
        echo '<img src="' . esc_url($stickyimage) . '" alt="Featured Image" class="img-fluid">';
    
    ?>
    </div>
    <div class="static-post-discription">
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	
    <p class="post-date"><?php echo $post_date;?></p>
    </div>
    </div>
   
        <?php
    }
 wp_reset_postdata();
    
}
?>
</div>
<div class="col-lg-5 col-md-4">
<?php


/*$args = array(
    'post_type' => 'posts',
    'posts_per_page' => 3,
    'orderby' => 'date',
    'order' => 'DESC',    
    'meta_query' => array(
        array(
            'key' => 'is_featured_poll', 
            'value'   => 'No', // Serialized value for 'Yes'
            'compare' => '='
        ),
        array(
            'key' => 'is_sticky_poll', 
            'value'   => 'No', // Serialized value for 'Yes'
            'compare' => '='
        ),
    ),
    
);*/




$args_post_type1 = array(
    'post_type' => 'bsp_custom_polls',
    'posts_per_page' => 3,
    'orderby' => 'date',
    'order' => 'DESC',    
    'meta_query' => array(
        array(
            'key' => 'is_featured_poll', 
            'value'   => 'No', 
            'compare' => '='
        ),
        array(
            'key' => 'is_sticky_poll', 
            'value'   => 'No',
            'compare' => '='
        ),
    ),
    
);

$args_post_type2 = array(
    'post_type'      => 'post', 
    'posts_per_page' => 2, 
    'orderby' => 'date',
    'order' => 'DESC', 
);

// Query posts for post_type1
$query_post_type1 = new WP_Query($args_post_type1);

// Query posts for post_type2
$query_post_type2 = new WP_Query($args_post_type2);

// Merge the two query objects
$merged_query = new WP_Query();
$merged_query->posts = array_merge($query_post_type1->posts, $query_post_type2->posts);
$merged_query->post_count = count($merged_query->posts);

// Sort the merged query by date (optional)
usort($merged_query->posts, function ($a, $b) {
    return strcmp($b->post_date, $a->post_date);
});

$postrandomimages = ['image13.jpg', 'image14.jpg', 'image15.jpg', 'image16.jpg', 'image17.jpg', 'image18.jpg','image19.jpg', 'image20.jpg', 'image21.jpg', 'image22.jpg', 'image23.jpg', 'image24.jpg', 'image25.jpg','image26.jpg', 'image27.jpg', 'image28.jpg', 'image29.jpg', 'image30.jpg', 'image31.jpg'];



if ($merged_query->have_posts()) :
    while ($merged_query->have_posts()):
        $merged_query->the_post();
        
        $post_id = get_the_ID();
        $post_date = get_the_date( 'M j, Y', $post_id );
        // Generate a random index
            $randomIndexpost = rand(0, 19);

            // Get the random image filename
            $randomImageforpost = $postrandomimages[$randomIndexpost];
            $poststaticimage = $theme_directory_uri . '/assets/home-page-images/'.$randomImageforpost;
        ?>
        <div class="side-fpost">
        <div class="side-fpost-img">
	<?php
    
        echo '<img src="' . esc_url($poststaticimage) . '" alt="Featured Image" class="img-fluid">';
    
    ?>
    </div>
        <div class="side-fpost-discription">
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p class="post-date"><?php echo $post_date;?></p>
        </div>
</div>
    <?php
    endwhile;
    wp_reset_postdata();
    ?>
    <?php
else :
    echo 'No posts found.';
endif;
?>
</div>

