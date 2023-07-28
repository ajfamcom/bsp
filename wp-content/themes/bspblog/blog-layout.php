<?php
/*
Template Name: Blog Page
*/
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">

            <?php
            // The main WordPress loop
            if (have_posts()) :
                while (have_posts()) : the_post();
            ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="entry-meta">
                            <?php
                            the_time('F j, Y');
                            echo ' | ';
                            the_author();
                            ?>
                        </div>
                    </header>

                    <div class="entry-content">
                        <?php the_excerpt(); ?>
                    </div>

                    <footer class="entry-footer">
                        <a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
                    </footer>
                </article>

            <?php
                endwhile;
            else :
                // Display message for no posts
                echo 'No posts found.';
            endif;
            ?>
            
        </div><!-- .container -->
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>
