<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- #content -->

	<?php get_template_part( 'template-parts/footer/footer-widgets' ); ?>

	<footer id="colophon" class="site-footer">

		<?php if ( has_nav_menu( 'footer' ) ) : ?>
			<nav aria-label="<?php esc_attr_e( 'Secondary menu', 'twentytwentyone' ); ?>" class="footer-navigation">
				<ul class="footer-navigation-wrapper">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'items_wrap'     => '%3$s',
							'container'      => false,
							'depth'          => 1,
							'link_before'    => '<span>',
							'link_after'     => '</span>',
							'fallback_cb'    => false,
						)
					);
					?>
				</ul><!-- .footer-navigation-wrapper -->
			</nav><!-- .footer-navigation -->
		<?php endif; ?>
		<div class="site-info">
			<div class="site-name">
				<?php if ( has_custom_logo() ) : ?>
					<div class="site-logo"><?php the_custom_logo(); ?></div>
				<?php else : ?>
					<?php if ( get_bloginfo( 'name' ) && get_theme_mod( 'display_title_and_tagline', true ) ) : ?>
						<?php if ( is_front_page() && ! is_paged() ) : ?>
							<?php bloginfo( 'name' ); ?>
						<?php else : ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
			</div><!-- .site-name -->

			<?php
			if ( function_exists( 'the_privacy_policy_link' ) ) {
				the_privacy_policy_link( '<div class="privacy-policy">', '</div>' );
			}
			?>

			<div class="powered-by">
				<?php
				printf(
					/* translators: %s: WordPress. */
					esc_html__( 'Proudly powered by %s.', 'twentytwentyone' ),
					'<a href="' . esc_url( __( 'https://wordpress.org/', 'twentytwentyone' ) ) . '">WordPress</a>'
				);
				?>
			</div><!-- .powered-by -->

		</div><!-- .site-info -->
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
	$('#search-data-btn').on('click',function(){
		
		let ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		let searchkey=$('#search-data').val();
		
		
				$.ajax({
					type : "post",					
					url : ajaxurl,
					data: {action:"fetchSearchResult",searchkeyword:searchkey},
					success: function(response) {
                        if(response){
							var searchdata=JSON.parse(response);
							
							resultSet='';
                             $.each(searchdata.result, function (index, item) {
            // Access properties of each result object
            var title = item.title;
            var description = item.description;
            var guid = item.guid;
			var posttitle = item.post_title;
            var postdescription = item.post_description;
            var postguid = item.post_guid;

            // Do something with the data (e.g., display it on the page)
           
			 resultSet +="<div>Post Title: " + posttitle +"<a href='"+ postguid +"'>Click Post page</a></div>";
			 resultSet +="<div>Title: " + title +" Description:"+ description +"<a href='"+ guid +"'>Click download page</a></div><br>";
        });
						  if(resultSet) {					  
								$('#result-data').empty();
								$('#result-data').append(resultSet);  
						  } else {
							    $('#result-data').empty();
								$('#result-data').append('No data found'); 
						  }
							
						}
						else {
							$('#result-data').empty();
		                    $('#result-data').append('No data found');
						}						
						
				
				     }
				})
	
	
	})
});
</script>
</body>
</html>
