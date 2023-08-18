<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<?php astra_content_bottom(); ?>
	</div> <!-- ast-container -->
	</div><!-- #content -->
<?php 
	astra_content_after();
		
	astra_footer_before();?>
	 
	<?php //astra_footer();
		
	astra_footer_after(); 
?>
	</div><!-- #page -->
<?php 
	astra_body_bottom(); 
	?>
	<footer>
		<div class="container">
	<div class="col-md-12 py-5">
		<div class="row">
			<!-- <p>BSP Research</p>
			<p>Start working with our team today</p>
			<small>Interested in polling or message testing research?Focus groups or qualitative interviews?Modeling and data analytics?Contact us today to discuss the possibilites...</small> -->
			<div class="logo">
			<img class="img-fluid" src="<?php bloginfo('template_directory'); ?>/assets/images/footer-logo.png">
			</div>
			<div class="row">
		<?php get_template_part( 'template-parts/footer/footer-widgets' ); ?>
         </div>
		</div>
     </div> 
	
	 <div class="col-md-12">
		 <div class="copyright">Copyright@ 2023 BSP Research _all Rights Reserved.</div>
     </div>
	 </div>
</footer>
	<?php   
	wp_footer(); 
?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/splidejs/4.1.4/css/splide.min.css" integrity="sha512-KhFXpe+VJEu5HYbJyKQs9VvwGB+jQepqb4ZnlhUF/jQGxYJcjdxOTf6cr445hOc791FFLs18DKVpfrQnONOB1g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/splidejs/4.1.4/js/splide.min.js" integrity="sha512-4TcjHXQMLM7Y6eqfiasrsnRCc8D/unDeY1UGKGgfwyLUCTsHYMxF7/UHayjItKQKIoP6TTQ6AMamb9w2GMAvNg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
	$(document).ready(function(){
    var ht=$(window).height();
     var wd=$(window).width();
     //alert(window.innerWidth);
		if (window.innerWidth <= 785) {
		$('.desktop-contact').css('display','none');
		$('.desktop-subscribe').css('display','none');
		$("#menu-primary li").slice(-2).hide();
		}
		else{
		$('.desktop-contact').css('display','block');
		$('.desktop-subscribe').css('display','block');
		$("#menu-primary li").slice(-2).show();
		}
     /* var isiPad = window.innerWidth <= 768 && window.innerHeight >= 768;
    if (isiPad) {
            $('.desktop-contact').css('display', 'none');
            $('.desktop-subscribe').css('display', 'none');
            $("#menu-primary li").slice(-2).hide();
        } else {
            $('.desktop-contact').css('display', 'block');
            $('.desktop-subscribe').css('display', 'block');
            $("#menu-primary li").slice(-2).show();
        }  */
	})
</script>
<script>
	$(document).ready(function($) {
            // Replace 'site-primary-header-wrap' with the ID or class of the parent element of the div
            $('.site-primary-header-wrap').removeClass('ast-container');
			$('.site-primary-header-wrap').addClass('container');
        });
		jQuery(document).ready(function($) {
    $('.datepicker').datepicker({
                minViewMode: 'years', // Show only years
                format: 'yyyy',       // Format to display only year
                autoclose: true
    });
});

	</script>
	<script>
 

 $( document ).ready(function() {
/*
var elems = $('#slider-related-posts');

if( elems.length ) {  

var splide = new Splide( '#slider-related-posts', {

  type     : 'loop',

  // padding: { left: '15.3%', right: '2rem' },

  height   : '10rem',

  focus    : 'left',

  // trimSpace: false,

  rewind: true,

  perPage : 3,

  perMove : 1,

  padding: '3rem',

  autoWidth: true,

  pagination: false,

  breakpoints: {

    1366: {

      perPage: 6,

      padding: { left: '8%', right: '2rem' },

    },

    640: {

      perPage: 2,

      padding: { left: '0rem', right: '2rem', },

      type     : 'loop',

      arrows: false,

      pagination: true,

      focus    : 'right',

    },

  }

} );


splide.mount();

}
*/

var elems = $('#slider-related-posts');

if( elems.length ) {  

var splide = new Splide( '#slider-related-posts', {
  type   : 'loop',
  padding: { left: '1rem', right: '7rem', },
  perPage: 4,
  perMove: 1,
  autoplay: true,
  drag   : 'free',
  focus  : 'left',
  gap: '20px',
  pagination: false,
  breakpoints: {
    1366: {
      perPage: 3,
    },
    640: {
      perPage: 2,
      padding: '3rem',
    },
    480: {
      perPage: 1,
      padding: '2rem',
    },

  }
} );

splide.mount();

 }


});
</script>

<?php
$full_url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<script>
     $(document).ready(function () {
        $('.copy-link-button').click(function () {
            var urlToCopy = '<?php echo $full_url;?>';
            copyToClipboard(urlToCopy);
        });

        function copyToClipboard(text) {
            var textArea = $('<textarea>');
            textArea.val(text);
            $('body').append(textArea);
            textArea.select();
            document.execCommand('copy');
            textArea.remove();

            alert('Link copied to clipboard: '+text);
        }
    }); 
</script>
<?php $show_type=($_GET['show_type'])?$_GET['show_type']:'show-type-grid'; ?>
<script>
     $(document).ready(function(){
        //alert('test');
        var stype='<?php echo $show_type; ?>';
        alert(stype);
        $('.show-type-list').css('display','none');
        $('.show-type-grid').css('display','none');
        $('.<?php echo $show_type;?>').css('display','none');
    }); 
    function show(showtype){
      if(showtype=='grid'){
        $('.show-type-list').css('display','none');
        $('.show-type-grid').css('display','block');
      }
      if(showtype=='list'){
        $('.show-type-list').css('display','block');
        $('.show-type-grid').css('display','none');
     }
    }
</script>
	</body>
</html>
