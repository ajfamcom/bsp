<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?><!DOCTYPE html>
<?php astra_html_before(); ?>
<html <?php language_attributes(); ?>>
    
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/custom_style.css" type="text/css">
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/media-queries.css" type="text/css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<?php wp_head(); ?>
<?php astra_head_bottom(); ?>
<style>
	/* mobile menu Adjust the width of the off-canvas menu to control the slide effect */
.offcanvas {
    width: 250px; /* You can adjust this value to fit your design */
  }
  
  /* Add a transition effect to create the slide-in effect */
  .offcanvas-start {
    transform: translateX(-100%);
    transition: transform 0.3s ease-in-out;
  }
  
  .offcanvas.show {
    transform: translateX(0);
  }
  
  /* Custom style for the close button */
  .offcanvas-header .btn-close {
    position: absolute;
    top: 0;
    right: 0;
    padding: 1rem;
    z-index: 1;
    color:red;
  }
</style>
</head>
    
<body <?php astra_schema_body(); ?> <?php body_class(); ?>>
<?php astra_body_top(); ?>
<?php wp_body_open(); ?>

<a
	class="skip-link screen-reader-text"
	href="#content"
	role="link"
	title="<?php echo esc_attr( astra_default_strings( 'string-header-skip-link', false ) ); ?>">
		<?php echo esc_html( astra_default_strings( 'string-header-skip-link', false ) ); ?>
</a>

<div
<?php
	echo astra_attr(
		'site',
		array(
			'id'    => 'page',
			'class' => 'hfeed site',
		)
	);
	?>
>
	<?php
	astra_header_before();
	?>
	
    
	
	<?php

	astra_header();
	
	?>
   
	<?php

	astra_header_after();

	astra_content_before();
	?>
	<div id="content" class="site-content">
		<div class="main-content">
		<?php astra_content_top(); ?>
