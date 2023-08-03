<?php /**Template Name: Most Popular Posts */?>
<h1 class="title">Latest From BSP</h1>
<div class="col-md-7">
<?php

$args = array(
    'post_type' => 'polls',
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
    'post_type' => 'polls',
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
<div class="col-md-5">
<?php


$args = array(
    'post_type' => 'polls',
    'posts_per_page' => 3,
    'orderby' => 'date',
    'order' => 'ASC',    
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
    
);

$query = new WP_Query($args);

if ($query->have_posts()) :
    while ($query->have_posts()) :
        $query->the_post();
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

