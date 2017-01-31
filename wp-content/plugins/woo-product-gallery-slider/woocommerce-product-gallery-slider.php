<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://iamniloy.com
 * @since             1.0.0
 * @package           Woo_Product_Gallery_Slide
 *
 * @wordpress-plugin
 * Plugin Name:       Twist - Woocommerce Product Gallery Slider Free
 * Plugin URI:        https://wordpress.org/plugins/woo-product-gallery-slider/
 * Description:       Too Many Product Images in your Product Gallery ? This plugin will add a carousel in your Product Gallery. <a href="http://http://codecanyon.net/item/twist-product-gallery-slidercarousel-plugin-for-woocommerce/14849108?ref=NiloySarker">Get the Pro Version Now </a>
 * Version:           1.1.5
 * Author:            Niloy Sarker
 * Author URI:        http://iamniloy.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpgs
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'add_action_links' );

function add_action_links ( $links ) {
 $mylinks = array(
 '<a href="http://http://codecanyon.net/item/twist-product-gallery-slidercarousel-plugin-for-woocommerce/14849108?ref=NiloySarker">Get the Pro Version Now </a>',
 );
return array_merge( $links, $mylinks );
}



/**
	 * Register the JS & CSS for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	function wpgs_enqueue_files() {
		wp_enqueue_style( 'owl-carousel', plugin_dir_url( __FILE__ ) . 'public/css/owl.carousel.css', array(),  'all' );
		wp_enqueue_style( 'wpgs-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', false ); 
		
		wp_enqueue_style( 'wpgs-css', plugin_dir_url( __FILE__ ) . 'public/css/woocommerce-product-gallery-slider-public.css', array(),  'all' );
		
		wp_enqueue_script( 'owl-carousel', plugin_dir_url( __FILE__ ) . 'public/js/owl.carousel.min.js', array( 'jquery' ),  true );
		wp_enqueue_script( 'wpgs-js', plugin_dir_url( __FILE__ ) . 'public/js/woocommerce-product-gallery-slider-public.js', array( 'jquery' ),  true );
		
	}
	
add_action( 'wp_enqueue_scripts','wpgs_enqueue_files' );


	

function wpgs_option( $name )
{
    return  vp_option( "wpgs_option." . $name );
}
/**
 * Include Vafpress Framework
 */
require_once  'functions.php';

function wpgs_option_edits() {
  ?>
  <style type="text/css">
  .woocommerce .thumbnails .owl-nav .owl-prev ,.woocommerce .thumbnails .owl-nav .owl-next {

    background: <?php echo wpgs_option("wpgs_nav_cl"); ?>!important;
    color: <?php echo wpgs_option("wpgs_nav_ico_cl"); ?>!important; 
padding: 2px 10px;
    top: 40%;
    position: absolute;
    margin: 0px !important;
    font-size: 20px;	
}
.woocommerce .thumbnails .owl-dot.active{
	background:<?php echo wpgs_option("wpgs_nav_cl"); ?> !important;
}

  </style>
  <script type="text/javascript">
  (function( $ ) {
	'use strict';
	 $( document ).ready(function() {
		 	 $( '.woocommerce .thumbnails' ).owlCarousel({
				loop:false,
				slideBy:2,
				dots: false,
				nav: <?php echo wpgs_option("wpgs_nav"); ?>,
				items:<?php echo wpgs_option("wpgs_thumbanils"); ?>,
				margin:<?php echo wpgs_option("wpgs_thum_margin"); ?>,
				stagePadding: <?php echo wpgs_option("wpgs_stagepadding"); ?>,
				mouseDrag: false,
				navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],				
				autoplayTimeout: 5000,
				autoplayHoverPause:false,
				autoplay: <?php echo wpgs_option("wpgs_autoplay"); ?>, // type false | if you don't want auto play
			});    
	});
})( jQuery );

  </script>
  <?php
}
add_action( 'wp_head', 'wpgs_option_edits' );

