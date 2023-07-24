<?php
class HomeTopClass {

public function __construct(){
    
    add_shortcode( 'home_top', array($this,'display_home_top_section'));
    add_filter('the_title', array($this,'top_section_title'));
}

public function display_home_top_section() {
       
    $args = array(
        'post_type' => 'custom_content',
        'posts_per_page' => -1, 
        /*'tax_query' => array(
            array(
            'taxonomy' => 'custom_category',
            'field' => 'term_id',
            'terms' => 24)
        )*/
    );
    
    $query = new WP_Query($args);    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();  
            $post_id = get_the_ID();
            $position = get_field('position', $post_id);
            $status = get_field('status', $post_id);
            if($position=='Home-Top' && $status=='Active')  {
                $line1=get_field('line1', $post_id);
                $line2=get_field('line2', $post_id);
                $line3=get_field('line3', $post_id);
                $status=get_field('status', $post_id);
                $link=get_field('link', $post_id);
               
                
                $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
                echo '<div class="banner">
                <img width="500" src="'.$feat_image.'" decoding="async" loading="lazy" style="background:cover;">
                <div class="container">
                    <div class="row">
                    <div class="col-md-8 col-sm-8 col-12 offset-md-2 offset-sm-2">
                  <h1 class="bnr-title">'.the_title().'<span style="color:red;">'.$line1.'<span>'.'<span style="color:green;">'.$line2.'</span>'.'</h1>
                  <p class="bnr-snbtitle">'.$line3.'</p>
                  <a href="'.$link.'" class="btn btn-primary">CONTACT US</a>
                  </div>
                </div>
                </div>
              </div>';           
            
            }
        }
        wp_reset_postdata();
    } else {
        // No posts found
    }
    

    
}

public function top_section_title($title) {
    global $id, $post;
    
        //if(!is_admin() && has_term( '25' ,'custom_category',$id)){
        $position = get_field('position', $id);
       if(!is_admin() && $position=='Home-Top'){     
	    return '<h4>'.trim(strip_tags($title)).'</h4>';
    }
    else{
        return $title;
    }
}


}

$HomeTop=new HomeTopClass();

 
