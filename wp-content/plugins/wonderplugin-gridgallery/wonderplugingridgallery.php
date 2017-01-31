<?php
/*
Plugin Name: WonderPlugin Grid Gallery
Plugin URI: http://www.wonderplugin.com
Description: WordPress Image and Video Grid Gallery Plugin
Version: 2.4
Author: Magic Hills Pty Ltd
Author URI: http://www.wonderplugin.com
License: Copyright 2014 Magic Hills Pty Ltd, All Rights Reserved
*/

define('WONDERPLUGIN_GRIDGALLERY_VERSION', '2.4');
define('WONDERPLUGIN_GRIDGALLERY_URL', plugin_dir_url( __FILE__ ));
define('WONDERPLUGIN_GRIDGALLERY_PATH', plugin_dir_path( __FILE__ ));

require_once 'app/class-wonderplugin-gridgallery-controller.php';

class WonderPlugin_Gridgallery_Plugin {
	
	function __construct() {
	
		$this->init();
	}
	
	public function init() {
		
		// init controller
		$this->wonderplugin_gridgallery_controller = new WonderPlugin_Gridgallery_Controller();
		
		add_action( 'admin_menu', array($this, 'register_menu') );
		
		add_shortcode( 'wonderplugin_gridgallery', array($this, 'shortcode_handler') );
		
		add_action( 'wp_footer', array($this, 'print_lightbox_options') );
		add_action( 'init', array($this, 'register_script') );
		add_action( 'wp_enqueue_scripts', array($this, 'enqueue_script') );
		
		if ( is_admin() )
		{
			add_action( 'wp_ajax_wonderplugin_gridgallery_save_item', array($this, 'wp_ajax_save_item') );
			add_action( 'admin_init', array($this, 'admin_init_hook') );
		}
	}
	
	function register_menu()
	{
		
		$userrole = $this->get_userrole();
		
		$menu = add_menu_page(
				__('WonderPlugin Grid Gallery', 'wonderplugin_gridgallery'),
				__('WonderPlugin Grid Gallery', 'wonderplugin_gridgallery'),
				$userrole,
				'wonderplugin_gridgallery_overview',
				array($this, 'show_overview'),
				WONDERPLUGIN_GRIDGALLERY_URL . 'images/logo-16.png' );
		add_action( 'admin_print_styles-' . $menu, array($this, 'enqueue_admin_script') );
		
		$menu = add_submenu_page(
				'wonderplugin_gridgallery_overview',
				__('Overview', 'wonderplugin_gridgallery'),
				__('Overview', 'wonderplugin_gridgallery'),
				$userrole,
				'wonderplugin_gridgallery_overview',
				array($this, 'show_overview' ));
		add_action( 'admin_print_styles-' . $menu, array($this, 'enqueue_admin_script') );
		
		$menu = add_submenu_page(
				'wonderplugin_gridgallery_overview',
				__('New Gallery', 'wonderplugin_gridgallery'),
				__('New Gallery', 'wonderplugin_gridgallery'),
				$userrole,
				'wonderplugin_gridgallery_add_new',
				array($this, 'add_new' ));
		add_action( 'admin_print_styles-' . $menu, array($this, 'enqueue_admin_script') );
		
		$menu = add_submenu_page(
				'wonderplugin_gridgallery_overview',
				__('Manage Galleries', 'wonderplugin_gridgallery'),
				__('Manage Galleries', 'wonderplugin_gridgallery'),
				$userrole,
				'wonderplugin_gridgallery_show_items',
				array($this, 'show_items' ));
		add_action( 'admin_print_styles-' . $menu, array($this, 'enqueue_admin_script') );
		
		$menu = add_submenu_page(
				'wonderplugin_gridgallery_overview',
				__('Settings', 'wonderplugin_gridgallery'),
				__('Settings', 'wonderplugin_gridgallery'),
				'manage_options',
				'wonderplugin_gridgallery_edit_settings',
				array($this, 'edit_settings' ) );
		add_action( 'admin_print_styles-' . $menu, array($this, 'enqueue_admin_script') );
		
		$menu = add_submenu_page(
				null,
				__('View Gallery', 'wonderplugin_gridgallery'),
				__('View Gallery', 'wonderplugin_gridgallery'),	
				$userrole,	
				'wonderplugin_gridgallery_show_item',	
				array($this, 'show_item' ));
		add_action( 'admin_print_styles-' . $menu, array($this, 'enqueue_admin_script') );
		
		$menu = add_submenu_page(
				null,
				__('Edit Gallery', 'wonderplugin_gridgallery'),
				__('Edit Gallery', 'wonderplugin_gridgallery'),
				$userrole,
				'wonderplugin_gridgallery_edit_item',
				array($this, 'edit_item' ) );
		add_action( 'admin_print_styles-' . $menu, array($this, 'enqueue_admin_script') );
	}
	
	function register_script()
	{		
		wp_register_script('wonderplugin-gridgallery-template-script', WONDERPLUGIN_GRIDGALLERY_URL . 'app/wonderplugingridgallerytemplate.js', array('jquery'), WONDERPLUGIN_GRIDGALLERY_VERSION, false);
		wp_register_script('wonderplugin-gridgallery-lightbox-script', WONDERPLUGIN_GRIDGALLERY_URL . 'engine/wonderplugingridlightbox.js', array('jquery'), WONDERPLUGIN_GRIDGALLERY_VERSION, false);
		wp_register_script('wonderplugin-gridgallery-script', WONDERPLUGIN_GRIDGALLERY_URL . 'engine/wonderplugingridgallery.js', array('jquery'), WONDERPLUGIN_GRIDGALLERY_VERSION, false);
		wp_register_script('wonderplugin-gridgallery-creator-script', WONDERPLUGIN_GRIDGALLERY_URL . 'app/wonderplugin-gridgallery-creator.js', array('jquery'), WONDERPLUGIN_GRIDGALLERY_VERSION, false);
		wp_register_style('wonderplugin-gridgallery-admin-style', WONDERPLUGIN_GRIDGALLERY_URL . 'wonderplugingridgallery.css');
	}
	
	function enqueue_script()
	{
		wp_enqueue_script('wonderplugin-gridgallery-lightbox-script');
		wp_enqueue_script('wonderplugin-gridgallery-script');
	}
	
	function enqueue_admin_script($hook)
	{
		wp_enqueue_script('post');
		if (function_exists("wp_enqueue_media"))
		{
			wp_enqueue_media();
		}
		else
		{
			wp_enqueue_script('thickbox');
			wp_enqueue_style('thickbox');
			wp_enqueue_script('media-upload');
		}
		wp_enqueue_script('wonderplugin-gridgallery-template-script');
		wp_enqueue_script('wonderplugin-gridgallery-lightbox-script');
		wp_enqueue_script('wonderplugin-gridgallery-script');
		wp_enqueue_script('wonderplugin-gridgallery-creator-script');
		wp_enqueue_style('wonderplugin-gridgallery-admin-style');
	}
	
	function print_lightbox_options()
	{
		echo $this->generate_lightbox_options();
	}
	
	function generate_lightbox_options()
	{
		return '<div id="wondergridgallerylightbox_options" data-skinsfoldername="skins/default/"  data-jsfolder="' . WONDERPLUGIN_GRIDGALLERY_URL . 'engine/" style="display:none;"></div>';
	}
	
	function admin_init_hook()
	{
		// change text of history media uploader
		if (!function_exists("wp_enqueue_media"))
		{
			global $pagenow;
			
			if ( 'media-upload.php' == $pagenow || 'async-upload.php' == $pagenow ) {
				add_filter( 'gettext', array($this, 'replace_thickbox_text' ), 1, 3 );
			}
		}
		
		// add meta boxes
		$this->wonderplugin_gridgallery_controller->add_metaboxes();
	}
	
	function replace_thickbox_text($translated_text, $text, $domain) {
		
		if ('Insert into Post' == $text) {
			$referer = strpos( wp_get_referer(), 'wonderplugin-gridgallery' );
			if ( $referer != '' ) {
				return __('Insert into gridgallery', 'wonderplugin_gridgallery' );
			}
		}
		return $translated_text;
	}
	
	function show_overview() {
		
		$this->wonderplugin_gridgallery_controller->show_overview();
	}
	
	function show_items() {
		
		$this->wonderplugin_gridgallery_controller->show_items();
	}
	
	function add_new() {
		
		$this->wonderplugin_gridgallery_controller->add_new();
	}
	
	function show_item() {
		
		$this->wonderplugin_gridgallery_controller->show_item();
	}
	
	function edit_item() {
	
		$this->wonderplugin_gridgallery_controller->edit_item();
	}
	
	function edit_settings() {
	
		$this->wonderplugin_gridgallery_controller->edit_settings();
	}
	
	function get_userrole() {
	
		return $this->wonderplugin_gridgallery_controller->get_userrole();
	}
	
	function shortcode_handler($atts) {
		
		if ( !isset($atts['id']) )
			return __('Please specify a gridgallery id', 'wonderplugin_gridgallery');
				
		return $this->generate_lightbox_options() . "\r\n" . $this->wonderplugin_gridgallery_controller->generate_body_code( $atts['id'], false);
	}
	
	function wp_ajax_save_item() {
		
		$items = json_decode(stripcslashes($_POST["item"]), true);
		
		foreach ($items as $key => &$value)
		{
			if ($value === true)
				$value = "true";
			
			if ($value === false)
				$value = "false";
		}
		
		if (isset($items["slides"]) && count($items["slides"]) > 0)
		{
			foreach ($items["slides"] as $key => &$slide)
			{
				foreach ($slide as $key => &$value)
				{
					if ($value === true)
						$value = "true";
						
					if ($value === false)
						$value = "false";
				}
			}
		}
		
		header('Content-Type: application/json');
		echo json_encode($this->wonderplugin_gridgallery_controller->save_item($items));
		die();
	}
	
}

/**
 * Init the plugin
 */
$wonderplugin_gridgallery_plugin = new WonderPlugin_Gridgallery_Plugin();

/**
 * Global php function
 * @param $id
 */
function wonderplugin_gridgallery($id) {

	echo $wonderplugin_gridgallery_plugin->generate_lightbox_options() . "\r\n" . $wonderplugin_gridgallery_plugin->wonderplugin_gridgallery_controller->generate_body_code($id, false);
}

/**
 * Uninstallation
 */
function wonderplugin_gridgallery_uninstall() {

	global $wpdb;
	$table_name = $wpdb->prefix . "wonderplugin_gridgallery";
	$wpdb->query("DROP TABLE IF EXISTS $table_name");
}

if ( function_exists('register_uninstall_hook') )
{
	register_uninstall_hook( __FILE__, 'wonderplugin_gridgallery_uninstall' );
}

define('WONDERPLUGIN_GRIDGALLERY_VERSION_TYPE', 'F');
