<?php
get_header(); ?>

 <section class="container">
<div class="row">
	<div class="col-md-3">
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
$hierarchical = 1; // 1 for yes, 0 for no
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
	  <div style="padding:15px 10px 10px 10px;">
	  <div class="breadcrumbs">
    <ul>
                    <li class="home">
                            <a title="Go to Home Page" href="<?php bloginfo('url'); ?>">Home</a>
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

	
	<div class="col-md-6 col-sm-6 col-xs-12">
<div class="row">
<?php
	global $post;
	$product_slider_data_r = get_post_meta($post->ID,'product-slider', true); // 
	
	if(!empty($product_slider_data_r)){
		echo '<div class="detail-carousel interior-slider clearfix">';
		foreach($product_slider_data_r as $product_slider){											
			$image_url = wp_get_attachment_url( $product_slider['photo'] );
?>
				<div class="item" data-dot="<span style='background-image: url(<?=$image_url?>)'></span>">
					<img src="<?=$image_url?>" alt="" class="full-width">
				</div>
<?php 
		}
		echo '</div>';
	}else{
		
		if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
			the_post_thumbnail('full', array('class' => 'img-responsive'));
		}
	}
?>

</div>
</div>

<div class="col-md-6 col-sm-6 col-xs-12">
	
	<?php
	if (have_posts()): while (have_posts()): the_post();
	?>
	<?php
			the_content();
		endwhile;
	endif;
	?>
	
	<div class="product-price">Price: <?php echo post_custom('price');?></div>
	
	<div class="checkoutbtn">
		<?php echo post_custom('proceed_to_checkout');?>
	</div>
	<div class="paypalbtn">
		<?php echo post_custom('checkout_with_paypal');?>
	</div> 

</div>




	   
		
		</div>

	  </div>
	</div>

</section>
  
    </div>
	  </div>
	  
	    <style type="text/css">
			.detail-carousel .owl-dots {
			    position: absolute;
			    top: 0;
			    left: 0;
			    width: 50px;
                          }  
			.detail-carousel .owl-dots span {
				display: block;
				width: 100%;
				height: 50px;
				background-color: transparent;
				padding: 0;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
				background-position: center center;
				border: none;
   margin-bottom:5px;
			}
				.owl-carousel .owl-stage-outer{
					left:55px;
                                       width:82%;
				}

		</style>

<?php get_footer(); ?>