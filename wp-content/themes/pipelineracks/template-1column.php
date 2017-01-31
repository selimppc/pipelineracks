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
 * Template Name: 1columns
 *
 */

get_header(); ?>

 <section class="container">
<div class="row">

	<div class="col-md-12">
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