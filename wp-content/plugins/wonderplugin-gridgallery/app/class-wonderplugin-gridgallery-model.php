<?php 

require_once 'wonderplugin-gridgallery-functions.php';

class WonderPlugin_Gridgallery_Model {

	private $controller;
	
	function __construct($controller) {
		
		$this->controller = $controller;
	}
	
	function get_upload_path() {
		
		$uploads = wp_upload_dir();
		return $uploads['basedir'] . '/wonderplugin-gridgallery/';
	}
	
	function get_upload_url() {
	
		$uploads = wp_upload_dir();
		return $uploads['baseurl'] . '/wonderplugin-gridgallery/';
	}
	
	function generate_body_code($id, $has_wrapper) {
		
		global $wpdb;
		$table_name = $wpdb->prefix . "wonderplugin_gridgallery";
		
		$ret = "";
		$item_row = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
		if ($item_row != null)
		{
			$data = str_replace('\\\"', '"', $item_row->data);
			$data = str_replace("\\\'", "'", $data);
			
			$data = json_decode($data);
			
			if (isset($data->customcss) && strlen($data->customcss) > 0)
			{
				$customcss = str_replace("\r", " ", $data->customcss);
				$customcss = str_replace("\n", " ", $customcss);
				$ret .= '<style type="text/css">' . $customcss . '</style>';
			}
			
			if (isset($data->skincss) && strlen($data->skincss) > 0)
			{
				$skincss = str_replace("\r", " ", $data->skincss);
				$skincss = str_replace("\n", " ", $skincss);
				$skincss = str_replace('#wonderplugingridgallery-GRIDGALLERYID',  '#wonderplugingridgallery-' . $id, $skincss);
				$ret .= '<style type="text/css">' . $skincss . '</style>';
			}
			
			// div data tag
			$ret .= '<div class="wonderplugingridgallery" id="wonderplugingridgallery-' . $id . '" data-gridgalleryid="' . $id . '" data-width="' . $data->width . '" data-height="' . $data->height . '" data-skin="' . $data->skin . '"';
			
			$boolOptions = array('random', 'shownavigation', 'hoverzoomin', 'responsive', 'mediumscreen', 'smallscreen', 'showtitle', 'lightboxshowtitle', 'lightboxshowdescription', 'lightboxresponsive', 'circularimage', 'firstimage');
			foreach ( $boolOptions as $key )
			{
				if (isset($data->{$key}) )
					$ret .= ' data-' . $key . '="' . ((strtolower($data->{$key}) === 'true') ? 'true': 'false') .'"';
			}
			
			$valOptions = array('thumbwidth', 'thumbheight', 'thumbtopmargin', 'thumbbottommargin', 'barheight', 'titlebottomcss', 'descriptionbottomcss', 'googleanalyticsaccount', 'gap', 'margin', 'borderradius', 'hoverzoominvalue', 'hoverzoominduration',
					'videoplaybutton', 'column', 'mediumcolumn', 'mediumscreensize', 'smallcolumn', 'smallscreensize', 'titlemode', 'titleeffect', 'titleeffectduration'
					);
			foreach ( $valOptions as $key )
			{
				if (isset($data->{$key}) )
					$ret .= ' data-' . $key . '="' . $data->{$key} . '"';
			}
			
			if (isset($data->dataoptions) && strlen($data->dataoptions) > 0)
			{
				$ret .= ' ' . stripslashes($data->dataoptions);
			}
				
			$ret .= ' data-jsfolder="' . WONDERPLUGIN_GRIDGALLERY_URL . 'engine/"'; 
			$ret .= ' data-skinsfoldername="skins/default/"';
			
			$totalwidth = ( isset($data->firstimage) && strtolower($data->firstimage) === 'true' ) ? $data->width : $data->width * $data->column + $data->gap * ($data->column -1);
				
			if (strtolower($data->responsive) === 'true')
				$ret .= ' style="display:none;position:relative;margin:0 auto;width:100%;max-width:' . $totalwidth . 'px;"';
			else 
				$ret .= ' style="display:none;position:relative;margin:0 auto;width:' . $totalwidth . 'px;"';
			
			$ret .= ' >';
			
			if (isset($data->slides) && count($data->slides) > 0)
			{
				$ret .= '<div class="wonderplugin-gridgallery-list" style="display:block;position:relative;max-width:100%;margin:0 auto;">';
				
				preg_match_all("/&lt;div\s.+&lt;\/div&gt;/", $data->gridtemplate, $templates);
								
				if (isset($templates) && count($templates) > 0 && count($templates[0]) > 0)
				{
					foreach ($templates[0] as &$template)
					{
						$template = str_replace('&lt;', '<', $template);
						$template = str_replace('&gt;', '>', $template);
					}
						
					$j = 0;
					foreach ($data->slides as $slide)
					{							
						$boolOptions = array('lightbox', 'displaythumbnail', 'lightboxsize');
						foreach ( $boolOptions as $key )
						{
							if (isset($slide->{$key}) )
								$slide->{$key} = ((strtolower($slide->{$key}) === 'true') ? true: false);
						}
						
						$code_template = '<div class="wonderplugin-gridgallery-item-container">';
							
						if ($slide->lightbox)
						{
							$code_template .= '<a class="wpgridlightbox-' . $id . '" data-group="wpgridgallery-' . $id . '" data-thumbnail="' . $slide->thumbnail . '"';
						
							if ($slide->type == 0)
							{
								$code_template .= ' href="' . $slide->image . '"';
							}
							else if ($slide->type == 1)
							{
								$code_template .= ' href="' . $slide->mp4 . '"';
								if ($slide->webm)
									$code_template .= ' data-webm="' . $slide->webm . '"';
							}
							else if ($slide->type == 2 || $slide->type == 3)
							{
								$code_template .= ' href="' . $slide->video . '"';
							}
						
							if ($slide->lightboxsize)
								$code_template .= ' data-width="' . $slide->lightboxwidth . '" data-height="' . $slide->lightboxheight . '"';
						
						}
						else
						{
							$code_template .= '<a href="' . $slide->weblink . '"';
							if ($slide->linktarget && strlen($slide->linktarget) > 0)
								$code_template .= ' target="' . $slide->linktarget . '"';
						}
						
						if ($slide->title && strlen($slide->title) > 0)
							$code_template .= ' title="' . str_replace("\"", "&quot;", $slide->title) . '"';
						
						if ($slide->description && strlen($slide->description) > 0)
							$code_template .= ' data-description="' .  str_replace("\"", "&quot;", $slide->description) . '"';
						
						$code_template .= '>';
							
						$code_template .= '<img src="';
						if ($slide->displaythumbnail)
							$code_template .= $slide->thumbnail;
						else
							$code_template .= $slide->image;
						$code_template .= '" />';
						$code_template .= '</a>';
							
						$code_template .= '</div>';
						
						$div_item = (isset($data->firstimage) && strtolower($data->firstimage) === 'true' && j > 0) ? '<div class="wonderplugin-gridgallery-item" style="display:none;"': '<div class="wonderplugin-gridgallery-item"';
						$div_template = str_replace('<div', $div_item, $templates[0][$j]);
						$div_template = str_replace('</div>', $code_template . "</div>", $div_template);	

						$ret .= $div_template;
						
						$j++;
						if ($j >= count($templates[0]))
							$j = 0;
					}
				}
				$ret .= '<div style="clear:both;"></div>';
				$ret .= '</div>';				
			}
			if ('F' == 'F')
				$ret .= '<div class="wonderplugin-gridgallery-engine"><a href="http://www.wonderplugin.com/wordpress-gridgallery/" title="'. get_option('wonderplugin-gridgallery-engine')  .'">' . get_option('wonderplugin-gridgallery-engine') . '</a></div>';
			$ret .= '</div>';
			
		}
		else
		{
			$ret = '<p>The specified grid gallery id does not exist.</p>';
		}
		return $ret;
	}
	
	function delete_item($id) {
		
		global $wpdb;
		$table_name = $wpdb->prefix . "wonderplugin_gridgallery";
		
		$ret = $wpdb->query( $wpdb->prepare(
				"
				DELETE FROM $table_name WHERE id=%s
				",
				$id
		) );
		
		return $ret;
	}
	
	function clone_item($id) {
	
		global $wpdb, $user_ID;
		$table_name = $wpdb->prefix . "wonderplugin_gridgallery";
		
		$cloned_id = -1;
		
		$item_row = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
		if ($item_row != null)
		{
			$time = current_time('mysql');
			$authorid = $user_ID;
			
			$ret = $wpdb->query( $wpdb->prepare(
					"
					INSERT INTO $table_name (name, data, time, authorid)
					VALUES (%s, %s, %s, %s)
					",
					$item_row->name,
					$item_row->data,
					$time,
					$authorid
			) );
				
			if ($ret)
				$cloned_id = $wpdb->insert_id;
		}
	
		return $cloned_id;
	}
	
	function is_db_table_exists() {
	
		global $wpdb;
		$table_name = $wpdb->prefix . "wonderplugin_gridgallery";
	
		return ( $wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name );
	}
	
	function is_id_exist($id)
	{
		global $wpdb;
		$table_name = $wpdb->prefix . "wonderplugin_gridgallery";
	
		$gridgallery_row = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
		return ($gridgallery_row != null);
	}
	
	function create_db_table() {
	
		global $wpdb;
		$table_name = $wpdb->prefix . "wonderplugin_gridgallery";
		
		$charset = '';
		if ( !empty($wpdb -> charset) )
			$charset = "DEFAULT CHARACTER SET $wpdb->charset";
		if ( !empty($wpdb -> collate) )
			$charset .= " COLLATE $wpdb->collate";
	
		$sql = "CREATE TABLE $table_name (
		id INT(11) NOT NULL AUTO_INCREMENT,
		name tinytext DEFAULT '' NOT NULL,
		data MEDIUMTEXT DEFAULT '' NOT NULL,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		authorid tinytext NOT NULL,
		PRIMARY KEY  (id)
		) $charset;";
			
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}
	
	function save_item($item) {
		
		if ( !$this->is_db_table_exists() )
			$this->create_db_table();
				
		global $wpdb, $user_ID;
		$table_name = $wpdb->prefix . "wonderplugin_gridgallery";
		
		$id = $item["id"];
		$name = $item["name"];
		
		unset($item["id"]);
		$data = json_encode($item);
		
		$time = current_time('mysql');
		$authorid = $user_ID;
		
		if ( ($id > 0) && $this->is_id_exist($id) )
		{
			$ret = $wpdb->query( $wpdb->prepare(
					"
					UPDATE $table_name
					SET name=%s, data=%s, time=%s, authorid=%s
					WHERE id=%d
					",
					$name,
					$data,
					$time,
					$authorid,
					$id
			) );
			
			if (!$ret)
			{
				return array(
						"success" => false,
						"id" => $id, 
						"message" => "Cannot update the gallery in database"
					);
			}
		}
		else
		{
			$ret = $wpdb->query( $wpdb->prepare(
					"
					INSERT INTO $table_name (name, data, time, authorid)
					VALUES (%s, %s, %s, %s)
					",
					$name,
					$data,
					$time,
					$authorid
			) );
			
			if (!$ret)
			{
				return array(
						"success" => false,
						"id" => -1,
						"message" => "Cannot insert the gallery to database"
				);
			}
			
			$id = $wpdb->insert_id;
		}
		
		return array(
				"success" => true,
				"id" => intval($id),
				"message" => "Gallery published!"
		);
	}
	
	function get_list_data() {
		
		global $wpdb;
		$table_name = $wpdb->prefix . "wonderplugin_gridgallery";
		
		$rows = $wpdb->get_results( "SELECT * FROM $table_name", ARRAY_A);
		
		$ret = array();
		
		if ( $rows )
		{
			foreach ( $rows as $row )
			{
				$ret[] = array(
							"id" => $row['id'],
							'name' => $row['name'],
							'data' => $row['data'],
							'time' => $row['time'],
							'author' => $row['authorid']
						);
			}
		}
	
		return $ret;
	}
	
	function get_item_data($id)
	{
		global $wpdb;
		$table_name = $wpdb->prefix . "wonderplugin_gridgallery";
	
		$ret = "";
		$item_row = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
		if ($item_row != null)
		{
			$ret = $item_row->data;
		}

		return $ret;
	}
	
	function get_userrole() {
	
		$userrole = get_option( 'wonderplugin_gridgallery_userrole' );
		if ( $userrole == false )
		{
			update_option( 'wonderplugin_gridgallery_userrole', 'manage_options' );
			$userrole = 'manage_options';
		}
	
		return $userrole;
	}
	
	function get_thumbnailsize() {
	
		$thumbnailsize = get_option( 'wonderplugin_gridgallery_thumbnailsize' );
		if ( $thumbnailsize == false )
		{
			update_option( 'wonderplugin_gridgallery_thumbnailsize', 'medium' );
			$thumbnailsize = 'medium';
		}
	
		return $thumbnailsize;
	}
	
	function save_settings($options) {
	
		if (!isset($options) || !isset($options['userrole']))
			$userrole = 'manage_options';
		else if ( $options['userrole'] == "Editor")
			$userrole = 'moderate_comments';
		else if ( $options['userrole'] == "Author")
			$userrole = 'upload_files';
		else
			$userrole = 'manage_options';
		update_option( 'wonderplugin_gridgallery_userrole', $userrole );
	
		if (isset($options) && isset($options['thumbnailsize']))
			$thumbnailsize = $options['thumbnailsize'];
		else
			$thumbnailsize = 'medium';
		update_option( 'wonderplugin_gridgallery_thumbnailsize', $thumbnailsize );
	}
}
