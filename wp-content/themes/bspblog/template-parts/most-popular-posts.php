<?php /**Template Name: Most Popular Posts */?>
<h1 class="title">Latest From BSP</h1>
<div class="col-lg-7 col-md-8">
<?php

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
    if (has_post_thumbnail()) {
    the_post_thumbnail(); 
    }
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
    if (has_post_thumbnail()) {
    the_post_thumbnail(); 
    }
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
    'posts_per_page' => 1,
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




if ($merged_query->have_posts()) :
    while ($merged_query->have_posts()):
        $merged_query->the_post();
        
        $post_id = get_the_ID();
        $post_date = get_the_date( 'M j, Y', $post_id );
        ?>
        <div class="side-fpost">
        <div class="side-fpost-img">
	<?php
    if (has_post_thumbnail()) {
    the_post_thumbnail(); 
    }
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

