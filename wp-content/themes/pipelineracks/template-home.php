<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 * Template Name: Home
 *
 */

get_header(); ?>

  <section>
    <div class="container">
      <section class="slider"><!-- data-autoplay = 'fals'e or miliseconds. Eg.: 5s = '5000' ; data-mouseover = stop on mouseover. 'true' or 'false') -->

				 <?php echo do_shortcode( '[responsive_slider]' ); ?> 
				

			</section>
			<!-- /SLIDER -->
      </div>
  </section>
  <section class="block block-banner" style="margin-top:20px">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="block-title">
				<strong><span>Stick it and Go!</span></strong>
				</div>
			 
			  <div class="block-content">
				<?php
					if (function_exists('ot_get_option')) {
						echo $test_input = ot_get_option('stick_it_and_go');
						
					}
					?>
				</div>
			 </div>
	
           
        
         <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="block-title">
				<strong><span>Products</span></strong>
				</div>
			 
			  <div class="block-content">
				<img class="img-responsive" src="<?php bloginfo('template_directory'); ?>/images/product-pic.jpg">
				<a class="shop_now_ban" href="<?php bloginfo('url'); ?>/products4.htm"> Buy Now</a>
				</div>
			 </div>
          <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="block-title">
				<strong><span>Photo Gallery</span></strong>
				</div>
			 
			  <div class="block-content">
				<img class="img-responsive" src="<?php bloginfo('template_directory'); ?>/images/gallery.jpg">
				<a class="shop_now_ban" href="<?php bloginfo('url'); ?>/photos_videos.htm"> View More</a>
				</div>
			 </div>


        </div>
      </div>
  
  </section>
    <section class="block block-service" style="margin-top:20px">
      <div class="container">
        <div class="row">
	  <div class="col-lg-8 col-md-8 col-sm-8">
	  <div class="lft">
	  	 <?php
			if (function_exists('ot_get_option')) {
				
				echo $test_input = ot_get_option('pipeline_introduction');
			}
			?>

	  </div>
	  </div>
	    <div class="col-lg-4 col-md-4 col-sm-4">
         <div class="rgt">
		<img class="img-responsive" src="<?php bloginfo('template_directory'); ?>/images/certificate.png">
	  </div>
	  </div>
	</div>
	</section>
    </div>

<?php get_footer(); ?>