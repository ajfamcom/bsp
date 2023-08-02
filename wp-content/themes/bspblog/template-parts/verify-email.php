<?php
/* Template Name: Verify Email*/
$code=$_GET['c'];
$email_to_update=base64_decode($code);
global $wpdb;
$table_name = $wpdb->prefix . 'contactus'; 


$data_to_update = array(
    'email_verified' => 'Yes',
);

// Data format (change 'data_type' to the actual data type of the column)
$data_format = array(
    'char',
);

$wpdb->update(
    $table_name,
    $data_to_update,
    array('email' => $email_to_update),
    $data_format,
    array('%s')
);

?>
<?php get_header();
?>
<div class="inner-bnr contact-bnr">
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
				<img class="img-fluid bnr-simg" src="<?php bloginfo('template_directory'); ?>/assets/images/contact-side-bnrimg.png" alt="side-bnrimg">
			</div>
		</div>
	</div>
</div>

<div class="container py-5 my-md-5">
	<div class="row py-md-5 my-md-5">
		<div class="col-md-4 col-sm-12 col-12">
			<h2></h2>
			<p>Your email has been verified.</p>
			
		</div>
		
	</div>
</div>
<?php 
get_footer();
?>