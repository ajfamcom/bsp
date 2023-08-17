<?php
/* Template Name: About Us  */

?>
<?php get_header(); 
$page_id = get_the_ID();
$full_banner = get_field('full_banner', $page_id);
$image_over_banner = get_field('image_over_banner', $page_id);

		
		$post_id = get_the_ID();
		$top_image_one = get_field('top_image_one', $post_id);
		$top_image_two = get_field('top_image_two', $post_id);
		$first_para_title = get_field('first_para_title', $post_id);
		$first_para_description = get_field('first_para_description', $post_id);
		$second_para_title = get_field('second_para_title', $post_id);
		$second_para_description = get_field('second_para_description', $post_id);
		$proven_track_record_one=get_field('proven_track_record_one', $post_id);
		$proven_track_record_two=get_field('proven_track_record_two', $post_id);
		$proven_track_record_three=get_field('proven_track_record_three', $post_id);
		$proven_track_record_four=get_field('proven_track_record_four', $post_id);
		$concluding_para=get_field('concluding_para', $post_id);
		
?>

<div class="inner-bnr about-bnr" style="background-image: linear-gradient(180deg, rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('<?php echo $full_banner['url']; ?>')">
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

<div class="container py-5 my-xl-5">
	<div class="row py-md-5">
		<div class="col-md-5 col-sm-5 col-12">
			<div class="image-group">
				<img class="img-fluid" src="<?php echo $top_image_one['url']; ?>" alt="bodyimage">
				<img class="img-fluid" src="<?php echo $top_image_two['url']; ?>" alt="bodyimage">
			</div>
		</div>
		<div class="col-md-7 col-sm-7 col-12">
			<h2><?php echo $first_para_title;?></h2>
			<?php echo $first_para_description;?>
		    <h2><?php echo $second_para_title;?></h2>
			<?php echo $second_para_description;?>
		</div>
	</div>
</div>

<div class="track-record-section">
	<div class="container py-5">
		<div class="row">
			<div class="col-12 text-center">
				<h1>A Proven Track Record</h1>
				<p class="subtitle">We work with a large number of clients from various industries, including:</p>
			</div>
		</div>

		<div class="row">

			<div class="col-md-3 col-sm-4 col-12 my-2 my-xl-4">
				<div class="track-div h-100">
					<i class="fa-regular fa-circle-check"></i>
					<h4><?php echo $proven_track_record_one; ?></h4>
				</div>
			</div>
			<div class="col-md-3 col-sm-4 col-12 my-2 my-xl-4">
				<div class="track-div h-100">
					<i class="fa-regular fa-circle-check"></i>
					<h4><?php echo $proven_track_record_two; ?></h4>
				</div>
			</div>
			<div class="col-md-3 col-sm-4 col-12 my-2 my-xl-4">
				<div class="track-div h-100">
					<i class="fa-regular fa-circle-check"></i>
					<h4><?php echo $proven_track_record_three; ?></h4>
				</div>
			</div>
			<div class="col-md-3 col-sm-4 col-12 my-2 my-xl-4">
				<div class="track-div h-100">
					<i class="fa-regular fa-circle-check"></i>
					<h4><?php echo $proven_track_record_four; ?></h4>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12 text-center">
				<p class="mb-0"><?php echo $concluding_para; ?></p>
			</div>
		</div>
	</div>
</div>

<?php 
get_footer();
?>