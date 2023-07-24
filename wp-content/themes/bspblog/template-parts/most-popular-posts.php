<?php /**Template Name: Most Popular Posts */?>
<h1 class="title">Latest From BSP</h1>
<div class="col-md-7">
<?php

$args = array(
    'post_type' => 'post',
    'posts_per_page' => 1,    
    'meta_query' => array(
        array(
            'key' => 'is_featured_post', 
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
        
        ?>
    <?php //if(isset($featured_post) && $featured_post[0]=='Yes'){ ?>
    <div class="featured-post">
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<p style="width:300px;">
	<?php
    if (has_post_thumbnail()) {
    the_post_thumbnail(); 
    }
    ?>
    </p>
    <p><?php the_excerpt(); ?></p>
   
    </div>
    <?php //} ?>
        <?php
    }
 wp_reset_postdata();
    
}

// Reset the query to avoid conflicts with other queries
 
?>  
<div class="static-post"><img src=""><>Georgios Political power grows</h3>Septemeber 7,2023</div>
</div>
<div class="col-md-5">
<?php


$args = array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'orderby' => 'date',
    'order' => 'ASC',    
    'meta_query' => array(
        array(
            'key' => 'is_featured_post', 
            'value'   => 'No', // Serialized value for 'Yes'
            'compare' => '='
        ),
    ),
    
);

$query = new WP_Query($args);

if ($query->have_posts()) :
    while ($query->have_posts()) :
        $query->the_post();
        ?>
        <div class="side-fpost">
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<p style="width:100px;">
	<?php
    if (has_post_thumbnail()) {
    the_post_thumbnail(); 
    }
    ?>
    </p>
    <p><?php the_excerpt(); ?></p></div>
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

