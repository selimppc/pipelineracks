<?php 

require_once 'class-wonderplugin-gridgallery-model.php';
require_once 'class-wonderplugin-gridgallery-view.php';

class WonderPlugin_Gridgallery_Controller {

	private $view, $model;

	function __construct() {

		$this->model = new WonderPlugin_Gridgallery_Model($this);	
		$this->view = new WonderPlugin_Gridgallery_View($this);
		$this->init();
	}
	
	function add_metaboxes()
	{
		$this->view->add_metaboxes();
	}
	
	function show_overview() {
		
		$this->view->print_overview();
	}
	
	function show_items() {
	
		$this->view->print_items();
	}
	
	function add_new() {
		
		$this->view->print_add_new();
	}
	
	function show_item()
	{
		$this->view->print_item();
	}
	
	function edit_item()
	{
		$this->view->print_edit_item();
	}
	
	function generate_body_code($id, $has_wrapper) {
		
		return $this->model->generate_body_code($id, $has_wrapper);
	}
	
	function delete_item($id)
	{
		return $this->model->delete_item($id);
	}
	
	function clone_item($id)
	{
		return $this->model->clone_item($id);
	}
	
	function save_item($item)
	{	
		return $this->model->save_item($item);	
	}
	
	function get_list_data() {
	
		return $this->model->get_list_data();
	}
	
	function get_item_data($id) {
		
		return $this->model->get_item_data($id);
	}
	
	function init() {
	
		$engine = array("WordPress Grid Gallery Plugin", "WordPress Grid Gallery");
		$option_name = 'wonderplugin-gridgallery-engine';
		if ( get_option( $option_name ) == false )
			update_option( $option_name, $engine[array_rand($engine)] );
	}
	
	function edit_settings()
	{
		$this->view->print_edit_settings();
	}
	
	function save_settings($options)
	{
		$this->model->save_settings($options);
	}
	
	function get_userrole()
	{
		return $this->model->get_userrole();
	}
	
	function get_thumbnailsize()
	{
		return $this->model->get_thumbnailsize();
	}
}