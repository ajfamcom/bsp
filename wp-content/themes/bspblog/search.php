<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

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
    <?php else : ?>
        <p>No results found.</p>
    <?php endif; ?>
</div>

<?php
get_footer(); // Include the footer
?>

