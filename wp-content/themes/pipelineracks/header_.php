<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<link href="<?php bloginfo('template_directory'); ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php bloginfo('template_directory'); ?>/css/layout.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/bootstrap.min.js"></script>
<link href="<?php bloginfo('template_directory'); ?>/css/font-awesome.css" rel="stylesheet">

<?php wp_head(); ?>
<script>
$(function(){
    var height = 0;
    $('.hide').show();
    $('#right-content').each(function(){
        height = Math.max( height, $(this).outerHeight() )
    });
    $('.hide').hide();
    $('#left-content,#right-content').outerHeight(height);
});
</script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header>
  <div class="container">
    <div class="row">
      <div class="logo-container col-xs-7 col-sm-7">
	   <h1 class="logo"><a class="logo" href="<?php bloginfo('url'); ?>"><img class="img-responsive" src="<?php bloginfo('template_directory'); ?>/images/logo.png"></a></h1>
	   </div>
	    <div class="logo-container col-xs-5 col-sm-5">
	   <h1 class="logo"><a class="logo" href="<?php bloginfo('url'); ?>/products4/rail-trucks/"><img class="img-responsive" src="<?php bloginfo('template_directory'); ?>/images/pipelinerack-banner.png"></a></h1>
	   </div>
	  </div>
	  <div class="row">
      <div class="col-xs-12 col-sm-12">    
	  <div class="nav-container">
         
		    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'sf-menu', 'container'=>'ul' ) ); ?>
		</div>
      </div>
    </div>
  </div>
</header>
<div id="wrapper">