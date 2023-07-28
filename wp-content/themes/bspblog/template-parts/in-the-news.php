<?php/* Template Name: In the news  */

?>
<?php get_header(); 
$page_id = get_the_ID();
$full_banner = get_field('full_banner', $page_id);
$image_over_banner = get_field('image_over_banner', $page_id);		
		
?>




<?php 
get_footer();
?>