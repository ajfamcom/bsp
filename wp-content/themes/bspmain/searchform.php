<?php
/**
 * The searchform.php template.
 *
 * Used any time that get_search_form() is called.
 *
 * @link https://developer.wordpress.org/reference/functions/wp_unique_id/
 * @link https://developer.wordpress.org/reference/functions/get_search_form/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

/*
 * Generate a unique ID for each form and a string containing an aria-label
 * if one was passed to get_search_form() in the args array.
 */
$bspmain_unique_id = wp_unique_id( 'search-form-' );

$bspmain_aria_label = ! empty( $args['aria_label'] ) ? 'aria-label="' . esc_attr( $args['aria_label'] ) . '"' : '';
?>
<form role="search" <?php echo $bspmain_aria_label; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?> method="get" class="search-form" action="#.">
	<label for="<?php echo esc_attr( $bspmain_unique_id ); ?>"><?php _e( 'Search&hellip;', 'bspmain' ); // phpcs:ignore: WordPress.Security.EscapeOutput.UnsafePrintingFunction -- core trusts translations ?></label>
	<input type="search" id="search-data" class="search-field" value="<?php echo get_search_query(); ?>" name="s" />
	<input type="button" id="search-data-btn" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'bspmain' ); ?>" style="background:black;padding:13px;color:white;font-size:20px;cursor:pointer;"/>
</form>
<div>Search Result:</div>
<div id="result-data"></div>
