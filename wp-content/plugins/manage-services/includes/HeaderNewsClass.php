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
     
     $query = new WP_Query($args);    
     if ($query->have_posts()) {
         while ($query->have_posts()) {
             $query->the_post();
             $post_id = get_the_ID();
             $position = get_field('position', $post_id);
             $status = get_field('status', $post_id);
             if($position=='Header-Top' && $status=='Active')  {
                the_title(); 
                the_content(); 
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
 
