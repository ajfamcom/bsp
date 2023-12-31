<?php
/**
 * Template part for displaying the Mobile Header
 *
 * @package Astra Builder
 */

$astra_mobile_header_type = astra_get_option( 'mobile-header-type' );

if ( 'full-width' === $astra_mobile_header_type ) {

	$astra_mobile_header_type = 'off-canvas';
}

?>
<div id="ast-mobile-header" class="ast-mobile-header-wrap " data-type="<?php echo esc_attr( $astra_mobile_header_type ); ?>">
<div class="col-md-12"><?php echo get_template_part( "template-parts/mobile-header-section" );?></div>
	<?php
		do_action( 'astra_mobile_header_bar_top' );

		/**
		 * Astra Top Header
		 */
		do_action( 'astra_mobile_above_header' );

		/**
		 * Astra Main Header
		 */
		do_action( 'astra_mobile_primary_header' );

		/**
		 * Astra Mobile Bottom Header
		 */
		do_action( 'astra_mobile_below_header' );

		astra_main_header_bar_bottom();
	?>
<?php
if ( ( 'dropdown' === astra_get_option( 'mobile-header-type' ) && Astra_Builder_Helper::is_component_loaded( 'mobile-trigger', 'header' ) ) || is_customize_preview() ) {
	$astra_content_alignment = astra_get_option( 'header-offcanvas-content-alignment', 'flex-start' );
	$astra_alignment_class   = 'content-align-' . $astra_content_alignment . ' ';
	?>
	<div class="ast-mobile-header-content <?php echo esc_attr( $astra_alignment_class ); ?>">
		<?php do_action( 'astra_mobile_header_content', 'popup', 'content' ); ?>
	</div>
<?php } ?>
</div>
