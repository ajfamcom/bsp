<?php
get_header(); // Include the header
?>

<div class="container mt-5">
    <h2>Search Results for: <?php echo get_search_query(); ?></h2>

    <?php if (have_posts()) : ?>
        <ul class="list-unstyled">
            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p><?php the_excerpt(); ?></p>
                </li>
            <?php endwhile; ?>
        </ul>

        <?php
        global $wp_query;

        // Pagination
        $total_pages = $wp_query->max_num_pages;
        if ($total_pages > 1) {
            echo '<nav aria-label="Search results pagination">';
            echo paginate_links(array(
                'total' => $total_pages,
                'prev_text' => __('&laquo; Previous'),
                'next_text' => __('Next &raquo;'),
            ));
            echo '</nav>';
        }
        ?>
    <?php else : ?>
        <p>No results found.</p>
    <?php endif; ?>
</div>

<?php
get_footer(); // Include the footer
?>
