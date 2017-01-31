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
 * Template Name: 2columns
 *
 */

get_header(); ?>

 <section class="container">
<div class="row">
	<div class="col-md-3 hidden-xs">
	  <div id="left-content">
	 
		 
		  <div class="infoBoxWrapper list first">
		   <div class="box_wrapper">
		     <div class="infoBoxHeading">
			 
			 </div>
			 
		

		  </div>
		  <div class="block block-shipping">
		    <img class="img-responsive" src="<?php bloginfo('template_directory'); ?>/images/free-shipping.png">
		  </div>
		  <div class="block block-certificate">
		   <img src="<?php bloginfo('template_directory'); ?>/images/certificate.png">
		  </div>
		 <!-- <div class="block block-socials">
		  <h3><span><span>Follow Us</span></span></h3>
		  <ul class="social">
			<li><a target="_blank" href="https://www.facebook.com/"><img src="images/facebook.jpg"></a></li>
			<li><a target="_blank" href="http://www.twitter.com/"><img src="images/twitter.jpg"></a></li>
			<li><a target="_blank" href="http://www.youtube.com/"><img src="images/youtube.jpg"></a></li>
			</ul>
		  </div>-->
		</div>
	  </div>
	  
	   </div>
	<div class="col-md-9">
      <div id="right-content">
	  <div style="padding:20px;">
	  <div class="breadcrumbs">
    <ul>
                    <li class="home">
                            <a title="Go to Home Page" href="#">Home</a>
                                        <span>/ </span>
                        </li>
                    <li class="category5">
                            <strong><?php the_title()?></strong>
                                    </li>
            </ul>
</div>

<div class="page-title">
        <h1><?php the_title()?> </h1>
</div>


	
		<?php
					if (have_posts()): while (have_posts()): the_post();
                    ?>
					 <?php
							the_content();
						endwhile;
					endif;
					?>

		
		</div>

	  </div>
	</div>

</section>
  
    </div>
	  </div>

<?php get_footer(); ?>