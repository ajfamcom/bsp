<?php /**Template Name:Home Top Section */ ?>


<div  class="col-md-12">
<div class="row"> 
    <p>Our Team</p>
    <p>Meet Our Team</p>
    <?php 
    $args = array(
        'post_type' => 'team_members',
        'posts_per_page' => 4,
    );
    
    $query = new WP_Query($args);
    
    if ($query->have_posts()) :
        while ($query->have_posts()) :
            $query->the_post();
            $post_id = get_the_ID();
            $fullname = get_field('full_name', $post_id);
            $education = get_field('education', $post_id);
            $designation = get_field('designation', $post_id);
            $image = get_field('profile_image', $post_id);
            ?> 
<div class="single-team-member col-md-3">
    <p class="member-image"><img src="<?php echo $image['url'];?>" width="200px;"/></p>
    <p class="member-details"><span class="member-name"><?php echo $fullname; ?></span>,<span class="member-education"><?php echo $education;?></span></p>
    <p class="other-details"><span class="member-position"><?php echo $designation;?></span></p>
    <p class="bio"><?php the_content(); ?></p>
</div>
<?php endwhile; ?>
<?php endif;?>
<p><a href="#."><button type="button" class="btn btn-primary">MEET THE TEAM</button></a></p>
</div>
</div>
