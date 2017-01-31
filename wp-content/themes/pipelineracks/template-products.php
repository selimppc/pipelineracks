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
 * Template Name: Products
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
			 <div class="box_wrapper_title"><h1><span class="title-icon"></span>Categories</h1></div>
			 </div>
			 <div class="infoBoxContents">
			 
	  		<?php
//list terms in a given taxonomy using wp_list_categories  (also useful as a widget)
$orderby = 'name';
$show_count = 0; // 1 for yes, 0 for no
$pad_counts = 0; // 1 for yes, 0 for no
$hierarchical = 0; // 1 for yes, 0 for no
$taxonomy = 'brand';
$title = '';

$args = array(

  'orderby' => $orderby,
  'show_count' => $show_count,
  'pad_counts' => $pad_counts,
  'hierarchical' => $hierarchical,
  'taxonomy' => $taxonomy,
  'title_li' => $title
);
?>

 <?php //wp_list_categories( $args ); ?> 



<?php
 $categories = get_categories($args);  
                 
                     
                        foreach ($categories as $category) {  
                            $url = get_term_link($category);?>  
                           


			  <ul class="categories">
			  <li class="htooltip"> <a href="<?php echo $url;?>"><strong><?php echo $temp=$category->name; ?></strong></a></li>
			  
			   </ul>


<?php  }  ?>
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
                            <strong><?php the_title();?></strong>
                                    </li>
            </ul>
</div>



	  		<?php
//list terms in a given taxonomy using wp_list_categories  (also useful as a widget)
$orderby = 'name';
$show_count = 0; // 1 for yes, 0 for no
$pad_counts = 0; // 1 for yes, 0 for no
$hierarchical = 0; // 1 for yes, 0 for no
$taxonomy = 'brand';
$title = '';











$args = array(

  'orderby' => $orderby,
  'show_count' => $show_count,
  'pad_counts' => $pad_counts,
  'hierarchical' => $hierarchical,
  'taxonomy' => $taxonomy,
  'title_li' => $title
);
?>

 <?php //wp_list_categories( $args ); ?> 

<?php
 $categories = get_categories($args);  
                 
                     
                        foreach ($categories as $category) {  
                            $url = get_term_link($category);?>  
                            <a href="<?php //echo $url;?>"><h4 style="margin:30px 0px 15px;"><?php echo $temp=$category->name; ?></h4></a>

<?php
//WordPress loop for custom post type
 $my_query = new WP_Query("post_type=products&brand=$temp&posts_per_page=-1");

      while ($my_query->have_posts()) : $my_query->the_post(); ?>

	   
	    <div class="item-box">
		   <div class="row">
		    <div class="spacer">
			   <div class="col-md-3 col-sm-3">
				<div class="browseProductImageContainer">
					<?php 
					if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
					
						the_post_thumbnail('full', array('class' => 'img-responsive'));
					} 
					?>
				</div>
			   </div>

				<div class="col-md-6 col-sm-6">
					<div class="title-indent">
					<div class="item-box-desc">
					  <h4 class="product-name"><a><a href="<?php the_permalink() ?>"> <?php the_title(); ?></a></a></h4>
					
					  
					<?php the_content(); ?>
					
					  <div class="shipping"><p><?php echo post_custom('note');?></p></div>
					  <div class="detal">
						<a class="product-details" title="" href="<?php the_permalink() ?>">Product details</a>
						</div>
					</div>
					</div>
				  </div>

				 <div class="col-md-3 col-sm-3">
				    <p style="color:red;margin-bottom:5px !important;line-height:18px;"> 
					<?php
					 if(get_the_title()!="Surface Mounting Kit"){
						if (function_exists('ot_get_option')) {
							
							echo $notice = ot_get_option('notice');
						}
				     }
                    ?>
					</p>
					 <div class="product-price"><?php echo post_custom('price');?></div>
					 <!--<span class="addtocart-button">
						<input type="submit" title="Add to Cart" value="Add to Cart" class="addtocart-button cart-click" name="">
					</span>-->
					  <div class="checkoutbtn">
					<?php echo post_custom('proceed_to_checkout');?>
					</div>
                        <div class="paypalbtn">
					<?php echo post_custom('checkout_with_paypal');?>
					</div>
				
			   </div>
		   </div>

		  </div><!--/row-->
		  </div><!--item-box-->
<?php endwhile; ?>


						

                        <?php  
                        }  
			?>
		
		</div>

	  </div>
	</div>

</section>
  
    </div>
	  </div>

<?php get_footer(); ?>