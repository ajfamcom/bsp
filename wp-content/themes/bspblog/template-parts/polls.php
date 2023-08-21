<?php
/* Template Name: Polls Page */

$page_id = get_the_ID();
$full_banner = get_field('full_banner', $page_id);
$image_over_banner = get_field('image_over_banner', $page_id);

$search_text = isset($_REQUEST['search_text']) ? $_REQUEST['search_text'] : '';
$from_date = isset($_REQUEST['from_date']) ? $_REQUEST['from_date'] : '';
$to_date = isset($_REQUEST['to_date']) ? $_REQUEST['to_date'] : '';

if ($search_text) {
    $search_term = trim($search_text);
    $visitor_ip = get_visitor_ip_address();
    $tablename = 'wp_searchdata';
    global $wpdb;
    $insert_data = array(
        'keyword' => $search_term,
        'visitor_ip' => $visitor_ip,
        'search_page' => 'polls_page'
    );
    $wpdb->insert($tablename, $insert_data);
}
?>

<?php get_header(); ?>

<div class="inner-bnr team-bnr" style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('<?php echo $full_banner['url']; ?>')">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8 col-12">
                <div class="row page-banner">
                    <?php echo get_breadcrumbs(); ?>
                    <div class="page-title">
                        <h3><?php echo get_the_title(); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-12">
                <img class="img-fluid bnr-simg" src="<?php echo $image_over_banner['url']; ?>" alt="side-bnrimg">
            </div>
        </div>
    </div>
</div>

<div class="container py-5 my-md-5">
    <div class="row">
        <div class="container mt-md-5">
            <form class="post-filter-form">
                <div class="post-fields">
                    <!-- Search Input -->
                    <input type="text" class="form-control" name="search_text" placeholder="Enter your search query" aria-label="Search" required value="<?php echo $search_text; ?>" autocomplete="off">
                </div>
                <div class="post-fields">
                    <!-- Search Input -->
                    <div class="input-group">
                        <input type="text" class="form-control datepicker" name="from_date" placeholder="From Date" value="<?php echo $from_date; ?>" autocomplete="off">
                    </div>
                </div>
                <div class="post-fields">
                    <!-- Search Input -->
                    <div class="input-group">
                        <input type="text" class="form-control datepicker" name="to_date" placeholder="To Date" value="<?php echo $to_date; ?>" autocomplete="off">
                    </div>
                </div>
                <div class="post-fields">
                    <!-- Search Button -->
                    <button type="submit" class="btn btn-default">Search</button>
                    <button type="button" class="btn btn-primary resetfrm" onclick="window.location.href = '<?php echo site_url('polls'); ?>'">Reset</button>
                </div>
            </form>
        </div>
    </div>

    <div class="highlight-post">
        <?php
        $fargs = array(
            'post_type' => 'bsp_custom_polls',
            'posts_per_page' => 1,
            'meta_query' => array(
                array(
                    'key' => 'is_featured_poll',
                    'value' => 'Yes',
                    'compare' => '='
                ),
            ),
        );

        $fquery = new WP_Query($fargs);

        if ($fquery->have_posts()) :
            while ($fquery->have_posts()) :
                $fquery->the_post();
                $post_id = get_the_ID();
                $permalink = get_permalink($post_id);
                if (has_post_thumbnail($post_id)) {

                    $thumbnail_id = get_post_thumbnail_id($post_id);
                    $image_url = wp_get_attachment_url($thumbnail_id);
                    $theme_directory_uri = get_template_directory_uri();
                    $noimage = $theme_directory_uri . '/assets/images/on-image-placeholder.jpg';

                    $image_link = '<img src="' . esc_url($image_url) . '" alt="Featured Image" class="img-fluid">';
                } else {
                    $image_link = '<img src="' . esc_url($noimage) . '" alt="Featured Image" class="img-fluid">';
                }
        ?>
                <div class="news-block">
                    <?php echo $image_link; ?>
                </div>
                <div class="news-block-content">
                    <h2 class="news-details"><span class="news-title"><?php the_title(); ?></span></h2>
                    <p class="news-other-details"><span class="news-date"><?php echo get_the_date('M j, Y'); ?></span></p>
                    <p class="news-content"><?php the_content(); ?></p>
                    <p><a href="<?php echo $permalink; ?>">Read More</a></p>
                </div>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>

    <div class="row">
        <?php
        if (isset($search_text) && isset($from_date) && isset($to_date) && !empty($search_text) && !empty($from_date) && !empty($to_date)) {

            global $wpdb;

            $year_from = date('Y', strtotime($from_date));
            $year_to = date('Y', strtotime($to_date));
            $posts_per_page = 6;
            $current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $offset = ($current_page - 1) * $posts_per_page;

            $search_text = '%' . $wpdb->esc_like($search_text) . '%';

            $query = $wpdb->prepare(
                "
                SELECT {$wpdb->prefix}posts.ID, {$wpdb->prefix}posts.post_title, {$wpdb->prefix}posts.post_content, {$wpdb->prefix}posts.post_date
                FROM {$wpdb->prefix}posts
                LEFT JOIN {$wpdb->prefix}term_relationships ON ({$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id)
                LEFT JOIN {$wpdb->prefix}term_taxonomy ON ({$wpdb->prefix}term_relationships.term_taxonomy_id = {$wpdb->prefix}term_taxonomy.term_taxonomy_id)
                LEFT JOIN {$wpdb->prefix}terms ON ({$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id)
                WHERE {$wpdb->prefix}posts.post_type = 'bsp_custom_polls'
                AND {$wpdb->prefix}posts.post_status = 'publish'
                AND (
                    {$wpdb->prefix}posts.post_title LIKE %s
                    OR {$wpdb->prefix}posts.post_content LIKE %s
                )
                AND YEAR({$wpdb->prefix}posts.post_date) BETWEEN %d AND %d
                ORDER BY {$wpdb->prefix}posts.post_date DESC
                LIMIT %d OFFSET %d
                ",
                $search_text,
                $search_text,
                $year_from,
                $year_to,
                $posts_per_page,
                $offset
            );

            $results = $wpdb->get_results($query);

            if ($results) {
                foreach ($results as $result) {
                    $post_id = $result->ID;
                    $post_title = $result->post_title;
                    $post_content = $result->post_content;
                    $post_date = date('M j, Y', strtotime($result->post_date));
                    $permalink = get_permalink($post_id);

                    if (has_post_thumbnail($post_id)) {
                        $thumbnail_id = get_post_thumbnail_id($post_id);
                        $image_url = wp_get_attachment_url($thumbnail_id);
                    } else {
                        $image_url = $noimage;
                    }
        ?>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="news-block">
                            <img src="<?php echo esc_url($image_url); ?>" alt="Poll Image" class="img-fluid">
                        </div>
                        <div class="news-block-content">
                            <h2 class="news-details"><span class="news-title"><?php echo $post_title; ?></span></h2>
                            <p class="news-other-details"><span class="news-date"><?php echo $post_date; ?></span></p>
                            <p class="news-content"><?php echo $post_content; ?></p>
                            <p><a href="<?php echo $permalink; ?>">Read More</a></p>
                        </div>
                    </div>
        <?php
                }
            } else {
                echo '<div class="col-12"><p>No results found.</p></div>';
            }
        } else {
            echo '<div class="col-12"><p>Please enter search criteria.</p></div>';
        }
        ?>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="load-more-btn text-center">
                <?php
                $total_results = count($results);
                $total_pages = ceil($total_results / $posts_per_page);
                if ($total_pages > 1) {
                    echo paginate_links(array(
                        'total' => $total_pages,
                        'current' => $current_page,
                    ));
                }
                ?>
            </div>
        </div>
    </div>

</div>

<?php get_footer(); ?>
