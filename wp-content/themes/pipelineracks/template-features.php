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
 * Template Name: Features
 *
 */

get_header(); ?>

 <section class="container">
 <div class="col-md-12 features">
 <div class="row">

   <ul class="posts-grid row-fluid unstyled our-services ul-item-0">

<?php
            $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
            $args = array(
                'post_type' => 'features',
                'posts_per_page' => -1,
                'paged' => $paged
            );
            $wp_query = new WP_Query($args);


            if ($wp_query->have_posts()): while ($wp_query->have_posts()): $wp_query->the_post();
                    ?> 

   <li class="span3 list-item-1">
   <figure class="featured-thumbnail thumbnail">
  <?php
$thumbnail_id=get_the_post_thumbnail($post->ID);
preg_match ('/src="(.*)" class/',$thumbnail_id,$link);
?>

	   <a rel="prettyPhoto" href="<?php echo $link[1]; ?>" >
	     <?php the_post_thumbnail( 'thumbnail', array( 'class' => 'img-responsive' ) ); ?></a>
		 <span class="zoom-icon"></span>
	</figure>
	
	<div class="clear"></div>
	<div class="desc"><h5><a href="#"><?php the_title()?></a></h5></div>	
	</li>
<?php
						endwhile;
					endif;
					?>



   </ul>
 </div>
   
 </div>
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
                            <strong>Feature</strong>
                                    </li>
            </ul>
</div>

<div class="features-btm">
	<?php
					if (function_exists('ot_get_option')) {
						echo $features = ot_get_option('features');
						
					}
					?>
					</div>

		
		</div>

	  </div>
	</div>

</section>
  
    </div>
	  </div>

<?php get_footer(); ?>