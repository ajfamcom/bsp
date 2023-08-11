<?php
get_header(); // Include the header
?>

<div class="container my-5 pb-md-3">
    <h2>Search Results for: <?php echo get_search_query(); ?></h2>

    <?php if (have_posts()) : ?>
        <ul class="list-unstyled">
            <?php while (have_posts()) : the_post(); ?>
			<?php 
			$post_id = get_the_ID();
			$post_type = get_post_type($post_id);
			
			if($post_type=='manage_services')
			{
				$permalink=site_url('services');
			}
			elseif($post_type=='news_analysis')
			{
				$link_data = get_field('external_link', $post_id);
				$link='javascript:void(0)';
				$target="";
				if($link_data){
					$link= $link_data;
					$target='_blank';
				}
				$permalink=$link;
			}
			else{
				$permalink = get_permalink($post_id);
			}
			?>
                <li>
                    <h3><a href="<?php echo  $permalink; ?>"><?php the_title(); ?></a></h3>
                    <?php the_excerpt(); ?>
                </li>
            <?php endwhile; ?>
        </ul>

        <?php
        global $wp_query;

        // Pagination
        $total_pages = $wp_query->max_num_pages;
        if ($total_pages > 1) {
            echo '<div class="pagination">';
            echo paginate_links(array(
                'total' => $total_pages,
                'prev_text' => __('&laquo;'),
                'next_text' => __('&raquo;'),
            ));
            echo '</div>';
        }
        ?>
    <?php else : ?>
        <p>No results found.</p>
    <?php endif; ?>
</div>

<?php
get_footer(); // Include the footer
?>
