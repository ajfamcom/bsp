<?php
/**
 * Block Styles
 *
 * @link https://developer.wordpress.org/reference/functions/register_block_style/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

if ( function_exists( 'register_block_style' ) ) {
	/**
	 * Register block styles.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @return void
	 */
	function twenty_twenty_one_register_block_styles() {
		// Columns: Overlap.
		register_block_style(
			'core/columns',
			array(
				'name'  => 'bspmain-columns-overlap',
				'label' => esc_html__( 'Overlap', 'bspmain' ),
			)
		);

		// Cover: Borders.
		register_block_style(
			'core/cover',
			array(
				'name'  => 'bspmain-border',
				'label' => esc_html__( 'Borders', 'bspmain' ),
			)
		);

		// Group: Borders.
		register_block_style(
			'core/group',
			array(
				'name'  => 'bspmain-border',
				'label' => esc_html__( 'Borders', 'bspmain' ),
			)
		);

		// Image: Borders.
		register_block_style(
			'core/image',
			array(
				'name'  => 'bspmain-border',
				'label' => esc_html__( 'Borders', 'bspmain' ),
			)
		);

		// Image: Frame.
		register_block_style(
			'core/image',
			array(
				'name'  => 'bspmain-image-frame',
				'label' => esc_html__( 'Frame', 'bspmain' ),
			)
		);

		// Latest Posts: Dividers.
		register_block_style(
			'core/latest-posts',
			array(
				'name'  => 'bspmain-latest-posts-dividers',
				'label' => esc_html__( 'Dividers', 'bspmain' ),
			)
		);

		// Latest Posts: Borders.
		register_block_style(
			'core/latest-posts',
			array(
				'name'  => 'bspmain-latest-posts-borders',
				'label' => esc_html__( 'Borders', 'bspmain' ),
			)
		);

		// Media & Text: Borders.
		register_block_style(
			'core/media-text',
			array(
				'name'  => 'bspmain-border',
				'label' => esc_html__( 'Borders', 'bspmain' ),
			)
		);

		// Separator: Thick.
		register_block_style(
			'core/separator',
			array(
				'name'  => 'bspmain-separator-thick',
				'label' => esc_html__( 'Thick', 'bspmain' ),
			)
		);

		// Social icons: Dark gray color.
		register_block_style(
			'core/social-links',
			array(
				'name'  => 'bspmain-social-icons-color',
				'label' => esc_html__( 'Dark gray', 'bspmain' ),
			)
		);
	}
	add_action( 'init', 'twenty_twenty_one_register_block_styles' );
}
