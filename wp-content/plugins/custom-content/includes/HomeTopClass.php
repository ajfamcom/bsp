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
            if($position=='Home-Top')  {
            the_title(); 
            the_content(); 
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
	    return '<span style="text-align:center;">'.$title.'</span>';
    }
    else{
        return $title;
    }
}


}

$HomeTop=new HomeTopClass();

 
