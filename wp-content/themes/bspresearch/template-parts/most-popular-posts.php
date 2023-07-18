<?php /**Template Name: Most Popular Posts */?>
<div class="col-md-6">




<?php
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 1,
    'orderby' => 'date',
    'order' => 'DESC',
);

$query = new WP_Query($args);

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        ?>
    <div>
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
        <?php
    }
 wp_reset_postdata();
    
}

// Reset the query to avoid conflicts with other queries
 
?>  
</div>
<div class="col-md-6">
<?php
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 3,  
    'offset' => 1, 
    'orderby' => 'date',
    'order' => 'DESC',
);


$query = new WP_Query($args);

if ($query->have_posts()) :
    while ($query->have_posts()) :
        $query->the_post();
        ?>
        <div class="row">
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<p style="width:100px;">
	<?php
    if (has_post_thumbnail()) {
    the_post_thumbnail(); 
    }
    ?>
    </p>
    <p><?php the_excerpt(); ?></p>
    <?php
    endwhile;
    wp_reset_postdata();
    ?>
    </div>
    <?php
else :
    echo 'No posts found.';
endif;
?>
</div>

