<?php 

if( ! class_exists( 'WP_List_Table' ) )
{
	require_once( ABSPATH . 'wp-admin/includes/screen.php' );
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class WonderPlugin_Gridgallery_List_Table extends WP_List_Table {

	private $view;
	public $list_data;
	
	public function __construct($view)
	{
		parent::__construct();
		$this->view = $view;
	}
	
	function get_columns()
	{
		$columns = array(
				'cb' => '<input type="checkbox" />',
				'id' => __('ID', 'wonderplugin_gridgallery'),
				'name' => __('Name', 'wonderplugin_gridgallery'),
				'shortcode' => __('Shortcode', 'wonderplugin_gridgallery'),
				'phpcode' => __('PHP code', 'wonderplugin_gridgallery'),
				'time' => __('Created', 'wonderplugin_gridgallery')
		);
		return $columns;
	}
		
	function prepare_items() 
	{
		
		$columns = $this->get_columns();
		$hidden = array();
		$sortable = $this->get_sortable_columns();
		$this->_column_headers = array($columns, $hidden, $sortable);
				
		usort( $this->list_data, array( &$this, 'usort_reorder' ) );
				
		$this->items = $this->list_data;
	}
	
	function get_sortable_columns() {
		
		$sortable_columns = array(
				'id'  => array('id',true),
				'name' => array('name',true),
				'time'   => array('time',true)
		);
		
		return $sortable_columns;
	}
	
	function usort_reorder( $a, $b ) {
		
		$orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'id';
		
		$order = ( ! empty($_GET['order'] ) ) ? $_GET['order'] : 'asc';
		
		if ($orderby == 'id')
			$result = ( (int) $a[$orderby] - (int) $b[$orderby] );
		else
			$result = strcmp( $a[$orderby], $b[$orderby] );
		
		return ( $order === 'asc' ) ? $result : -$result;
	}
	
	function column_cb($item) {
		
		return sprintf('<input type="checkbox" name="itemid[]" value="%s" />', $item['id']);
	}
	
	function column_default( $item, $column_name ) 
	{
		switch( $column_name ) {
			case 'id':
				$actions = array(
					'delete' => sprintf('<a href="?page=%s&action=%s&itemid=%s">Delete</a>', $_REQUEST['page'], 'delete', $item['id']),
					'clone' => sprintf('<a href="?page=%s&action=%s&itemid=%s">Clone</a>', $_REQUEST['page'], 'clone', $item['id']),
					'view' => sprintf('<a href="?page=%s&itemid=%s">View</a>', 'wonderplugin_gridgallery_show_item', $item['id']),
					'edit' => sprintf('<a href="?page=%s&itemid=%s">Edit</a>', 'wonderplugin_gridgallery_edit_item', $item['id'])
				);
				return sprintf('%1$s %2$s', $item['id'], $this->row_actions($actions) );
			case 'name':
			case 'time':
				return $item[ $column_name ];
			case 'shortcode':
				return esc_attr('[wonderplugin_gridgallery id="' . $item['id'] . '"]');
			case 'phpcode':
					return esc_attr('<?php echo do_shortcode(\'[wonderplugin_gridgallery id="' . $item['id'] . '"]\'); ?>');
			default:
				return $item[ $column_name ];
		}
	}
	
	function get_bulk_actions() {
		
		$actions = array(
				'delete' => 'Delete'
		);
		return $actions;
	}

}