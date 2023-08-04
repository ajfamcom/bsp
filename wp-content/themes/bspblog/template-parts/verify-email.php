<?php
/* Template Name: Verify Email*/
$page_id = get_the_ID();
$full_banner = get_field('full_banner', $page_id);
$image_over_banner = get_field('image_over_banner', $page_id);
$code=$_GET['c'];
$email_to_update=base64_decode($code);
global $wpdb;
$table_name = $wpdb->prefix . 'contactus'; 


$data_to_update = array(
    'email_verified' => 'Yes',
);

// Data format (change 'data_type' to the actual data type of the column)
$data_format = array(
    '%s', 
);
$sql="select * from wp_contactus where email='".$email_to_update."'";
$result=$wpdb->get_results($sql);
 
 if($result){
	$wpdb->update(
		$table_name,
		$data_to_update,
		array('email' => $email_to_update),
		$data_format,
		array('%s')
	 );
   $msg="Your email has been verified.";
}
else{
	$msg="This email doesnot exist!";
}

?>
<?php get_header();
?>
<div class="inner-bnr contact-bnr" style="background-image: linear-gradient(180deg, rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('<?php echo $full_banner['url']; ?>')">
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
				<img class="img-fluid bnr-simg" src="<?php echo $image_over_banner['url'];?>" alt="side-bnrimg">
			</div>
		</div>
	</div>
</div>

<div class="container py-5 my-md-5">
	<div class="row py-md-5 my-md-5">
		<div class="col-md-4 col-sm-12 col-12">
			<h2><?php echo $msg;?></h2>	
			
		</div>
		
	</div>
</div>
<?php 
get_footer();
?>