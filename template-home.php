<?php
/**
 * The home template file
 * Template Name: Homepage
 *
 * @package ThemeCom
 */

get_header();
?>
<script>
$(document).ready(function(){

    //Check to see if the window is top if not then display button
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('.scrollToTop').fadeIn();
        } else {
            $('.scrollToTop').fadeOut();
        }
    });

    //Click event to scroll to top
    $('.scrollToTop').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });

});

</script>

	<div class="col-lg-3">
		<?php get_sidebar(); ?>
	</div>
	<div class="col-lg-9">
	<div id="primary" class="content-area">
		<div class="home-row row ml-0 mr-0 woocommerce">
			<?php dynamic_sidebar('home-widget-1') ?>
		</div>
		<?php echo do_shortcode("[wcps id='1877']"); ?>
	</div><!-- #primary -->
	</div>
<a href="#" class="scrollToTop"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>

<?php
get_footer();
