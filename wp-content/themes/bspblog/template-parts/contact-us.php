<?php
/* Template Name: contact Template */
$page_id = get_the_ID();
$full_banner = get_field('full_banner', $page_id);
$image_over_banner = get_field('image_over_banner', $page_id);
?>
<?php get_header();
?>
<?php 
 if ( isset( $_POST['submit_form'] ) ) {      

	require_once ABSPATH . WPINC . '/pluggable.php';
	require_once get_template_directory() . '/bspblog-config.php';

	$aname="BSP Research";
	$name = sanitize_text_field( $_POST['fname'] );
	$email = sanitize_email( $_POST['email'] );
	$message = esc_textarea( $_POST['message'] );
	$organization = sanitize_text_field( $_POST['organization'] );
	$is_signup = isset($_POST['signup'])?'Yes':'No';       
	$subject = 'Contact Form Submission';
	$to = get_option('admin_email');
	$headers = array(
		'From: ' . $aname . ' <' . $email . '>',
		'Content-Type: text/html; charset=UTF-8',
	);
	$all_message ='<p>Find details of a new contactus submission</p>';
	$all_message .='<p>Name:'.$name.'</p>';
	$all_message .='<p>Organization:'.$organization.'</p>';
	$all_message .='<p>Email:'.$email.'</p>';
	$all_message .='<p>Message:'.$message.'</p>';
	if($is_signup=='Yes')
	{
	   
		@add_or_update_member(MAILCHIMP_ID,$email,$name);
	}
	
	//save in db
	global $wpdb;        
	$table_name = $wpdb->prefix . 'contactus';

	$data = array(
		'fullname' => $name,
		'email' => $email,
		'message' => $message,
		'organization' => $organization,
		'is_signup' => $is_signup      
	);
	//mail to user
	$user_subject = 'Verify your email';
	$user_to = $email;
	$admin_name='BSP Research';
	$user_headers = array(
		'From: ' . $admin_name . ' <' . $email . '>',
		'Content-Type: text/html; charset=UTF-8',
	);
	$code=base64_encode($email);
	$user_link='<a href="https://bsp.thefamcomlab.com/verify-email?c='.$code.'">Verify Email</a>';
	$user_message='<p>Please click the link to verify your email address'.$user_link.'</p>';
if(!empty($name) && !empty($email) && !empty($message)){
	$wpdb->insert( $table_name, $data );
	//wp_mail('dipti@famcominc.com', 'Test Email', 'This is a test email from WordPress.');
   
   
	wp_mail( $to, $subject, $all_message, $headers );  
	wp_mail( $user_to, $user_subject, $user_message, $user_headers );      
	$msg="Thank you for your inquiry! We will get back to you within 48 hours.We've sent you a confirmation email, please click the link to verify your address.";
	
	
}
else{
	$error="Please fill the reqired fields!";
}

	//verfy user
	
}
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
				<img class="img-fluid bnr-simg" src="<?php echo $image_over_banner['url'];?>"  alt="side-bnrimg">
			</div>
		</div>
	</div>
</div>

<div class="container py-5 my-md-5">
	<div class="row py-xl-5">
		<div class="col-md-4 col-sm-4 col-12">
			<h2>Start working with our team today</h2>
			<p>Interested in polling or message testing research? Focus groups or qualitative interviews? Modeling and data analytics? Contact us today to discuss the possibilities...</p>
			<ul class="contact-social-links">
				<li><a href="#"><i class="fa-brands fa-facebook-f"></i> - Facebook</a></li>
				<li><a href="#"><i class="fa-brands fa-instagram"></i> - Instagram</a></li>
				<li><a href="#"><i class="fa-brands fa-twitter"></i> - Twitter</a></li>
			</ul>
		</div>
		<div class="col-md-8 col-sm-8 col-12">
		<!-- Content of "Contact Us" page -->
       <?php //echo do_shortcode('[custom_contact_form]'); ?>
	   <div class="contact-form">		
        <h2>Contact Us</h2>
		<?php if(isset($msg)){?>
			<div class="alert alert-success alert-dismissible fade show mt-3 "><?php echo $msg;?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		    </div>
		<?php } ?>
        <?php if(isset($error)){?>
			<div class="alert alert-danger alert-dismissible fade show mt-3 "><?php echo $error;?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		    </div>
		<?php } ?>
        <form method="post" action="<?php echo site_url('contact-us/');?>">
            <div class="mb-3">
                <!-- <label for="name" class="form-label">Name</label> -->
                <input type="text" class="form-control" id="fname" name="fname" placeholder="Name*" required>
            </div>
            <div class="mb-3">
                <!-- <label for="organization" class="form-label">Organization</label> -->
                <input type="text" class="form-control" id="organization" name="organization" placeholder="Organization">
            </div>
            <div class="mb-3">
                <!-- <label for="email" class="form-label">Email</label> -->
                <input type="email" class="form-control" id="email" name="email" placeholder="Email*" required>
            </div>
            <div class="mb-3">
                <!-- <label for="message" class="form-label">Message</label> -->
                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Message*" required></textarea>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="signup" name="signup">
                <label class="form-check-label" for="signup">Sign me up for emails and updates</label>
            </div>
            <div class="text-center">
            <input type="submit" name="submit_form" class="btn btn-primary mt-4" value="Submit">
            </div>
        </form>
    </div>
		</div>
	</div>
</div>
<?php 
get_footer();
?>