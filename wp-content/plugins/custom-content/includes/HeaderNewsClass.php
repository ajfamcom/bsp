<?php
class HeaderNewsClass {

public function __construct(){    
    add_shortcode( 'news_header', array($this,'display_news_header_section'));    
    add_filter('the_title', array($this,'news_section_title'));
}

public function display_news_header_section() {
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
      $polls_args = array(
        'post_type' => 'bsp_custom_polls',
        'posts_per_page' => 1, 
        'orderby' => 'post_date',
        'order' => 'DESC',    
        
    );
    
    $polls_query = new WP_Query( $polls_args );
    if ($polls_query->have_posts()) {
        while ($polls_query->have_posts()) {
            $polls_query->the_post();
                      
              $title_of_poll=get_the_title();; 
        }
        wp_reset_postdata();
    } 

    //$title_of_poll='Test data here';
    
     $query = new WP_Query($args);    
     if ($query->have_posts()) {
         while ($query->have_posts()) {
             $query->the_post();
             $post_id = get_the_ID();
             $position = get_field('position', $post_id);
             $status = get_field('status', $post_id);
             $line1=get_field('line1', $post_id);
                $line2=get_field('line2', $post_id);
                $line3=get_field('line3', $post_id);                
                $link=get_field('link', $post_id);
             if($position=='Header-Top' && $status=='Active')  {
                the_title();
                echo '<p><a class="news-txt" href="'.$link.'">'.$line1.' '.$line2.' '.$line3.'</a></p>'; 
             }
            
         }
         wp_reset_postdata();
     } else {
         // No posts found
     }
     
 
     
 }

 
 public function news_section_title($title) {
     global $id, $post;
     
     $position = get_field('position', $id);
     if(!is_admin() && $position=='Header-Top'){     
     return '<span style="text-align:justify;">'.$title.'</span>';
     }     
     else{
         return $title;
     }
 }


}
$NewsHeader=new HeaderNewsClass();
 
