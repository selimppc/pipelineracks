<?php 

require_once 'class-wonderplugin-gridgallery-list-table.php';
require_once 'class-wonderplugin-gridgallery-creator.php';

class WonderPlugin_Gridgallery_View {

	private $controller;
	private $list_table;
	private $creator;
	
	function __construct($controller) {
		
		$this->controller = $controller;
	}
	
	function add_metaboxes() {
		add_meta_box('overview_features', __('WonderPlugin Grid Gallery Features', 'wonderplugin_gridgallery'), array($this, 'show_features'), 'wonderplugin_gridgallery_overview', 'features', '');
		add_meta_box('overview_upgrade', __('Upgrade to Commercial Version', 'wonderplugin_gridgallery'), array($this, 'show_upgrade_to_commercial'), 'wonderplugin_gridgallery_overview', 'upgrade', '');
		add_meta_box('overview_news', __('WonderPlugin News', 'wonderplugin_gridgallery'), array($this, 'show_news'), 'wonderplugin_gridgallery_overview', 'news', '');
		add_meta_box('overview_contact', __('Contact Us', 'wonderplugin_gridgallery'), array($this, 'show_contact'), 'wonderplugin_gridgallery_overview', 'contact', '');
	}
	
	function show_upgrade_to_commercial() {
		?>
		<ul class="wonderplugin-feature-list">
			<li>Use on commercial websites</li>
			<li>Remove the wonderplugin.com watermark</li>
			<li>Priority techincal support</li>
			<li><a href="http://www.wonderplugin.com/order/?product=gridgallery" target="_blank">Upgrade to Commercial Version</a></li>
		</ul>
		<?php
	}
	
	function show_news() {
		
		include_once( ABSPATH . WPINC . '/feed.php' );
		
		$rss = fetch_feed( 'http://www.wonderplugin.com/feed/' );
		
		$maxitems = 0;
		if ( ! is_wp_error( $rss ) )
		{
			$maxitems = $rss->get_item_quantity( 5 );
			$rss_items = $rss->get_items( 0, $maxitems );
		}
		?>
		
		<ul class="wonderplugin-feature-list">
		    <?php if ( $maxitems > 0 ) {
		        foreach ( $rss_items as $item )
		        {
		        	?>
		        	<li>
		                <a href="<?php echo esc_url( $item->get_permalink() ); ?>" target="_blank" 
		                    title="<?php printf( __( 'Posted %s', 'wonderplugin_gridgallery' ), $item->get_date('j F Y | g:i a') ); ?>">
		                    <?php echo esc_html( $item->get_title() ); ?>
		                </a>
		                <p><?php echo $item->get_description(); ?></p>
		            </li>
		        	<?php 
		        }
		    } ?>
		</ul>
		<?php
	}
	
	function show_features() {
		?>
		<ul class="wonderplugin-feature-list">
			<li>Support images, YouTube, Vimeo and MP4/WebM videos</li>
			<li>Works on mobile, tablets and all major web browsers, including iPhone, iPad, Android, Firefox, Safari, Chrome, Internet Explorer 7/8/9/10/11 and Opera</li>
			<li>Built-in lightbox effect</li>
			<li>Pre-defined professional skins</li>
			<li>Fully responsive</li>
			<li>Easy-to-use wizard style user interface</li>
			<li>Instantly preview</li>
			<li>Provide shortcode and PHP code to insert the gridgallery to pages, posts or templates</li>
		</ul>
		<?php
	}
	
	function show_contact() {
		?>
		<p>Priority technical support is available for Commercial Version users at support@wonderplugin.com. Please include your license information, WordPress version, link to your gallery, all related error messages in your email.</p> 
		<?php
	}
	
	function print_overview() {
		
		?>
		<div class="wrap">
		<div id="icon-wonderplugin-gridgallery" class="icon32"><br /></div>
		<div id="wondergridgallerylightbox_options" data-skinsfoldername="skins/default/"  data-jsfolder="<?php echo WONDERPLUGIN_GRIDGALLERY_URL . 'engine/'; ?>" style="display:none;"></div>
			
		<h2><?php echo __( 'WonderPlugin Grid Gallery', 'wonderplugin_gridgallery' ) . ( (WONDERPLUGIN_GRIDGALLERY_VERSION_TYPE == "C") ? " Commercial Version" : " Free Version") . " " . WONDERPLUGIN_GRIDGALLERY_VERSION; ?> </h2>
		 
		<div id="welcome-panel" class="welcome-panel">
			<div class="welcome-panel-content">
				<h3>WordPress Image and Video Grid Gallery Plugin</h3>
				<div class="welcome-panel-column-container">
					<div class="welcome-panel-column">
						<h4>Get Started</h4>
						<a class="button button-primary button-hero" href="<?php echo admin_url('admin.php?page=wonderplugin_gridgallery_add_new'); ?>">Create A New Gallery</a>
					</div>
					<div class="welcome-panel-column welcome-panel-last">
						<h4>More Actions</h4>
						<ul>
							<li><a href="<?php echo admin_url('admin.php?page=wonderplugin_gridgallery_show_items'); ?>" class="welcome-icon welcome-widgets-menus">Manage Existing Galleries</a></li>
							<li><a href="http://www.wonderplugin.com/wordpress-gridgallery/help/" target="_blank" class="welcome-icon welcome-learn-more">Help Document</a></li>
							<?php  if (WONDERPLUGIN_GRIDGALLERY_VERSION_TYPE !== "C") { ?>
							<li><a href="http://www.wonderplugin.com/order/?product=gridgallery" target="_blank" class="welcome-icon welcome-view-site">Upgrade to Commercial Version</a></li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		<div id="dashboard-widgets-wrap">
			<div id="dashboard-widgets" class="metabox-holder columns-2">
	 
	                 <div id="postbox-container-1" class="postbox-container">
	                    <?php 
	                    do_meta_boxes( 'wonderplugin_gridgallery_overview', 'features', '' ); 
	                    do_meta_boxes( 'wonderplugin_gridgallery_overview', 'contact', '' ); 
	                    ?>
	                </div>
	 
	                <div id="postbox-container-2" class="postbox-container">
	                    <?php 
	                    if (WONDERPLUGIN_GRIDGALLERY_VERSION_TYPE != "C")
	                    	do_meta_boxes( 'wonderplugin_gridgallery_overview', 'upgrade', ''); 
	                    do_meta_boxes( 'wonderplugin_gridgallery_overview', 'news', ''); 
	                    ?>
	                </div>
	 
	        </div>
        </div>
            
		<?php
	}
	
	function print_edit_settings() {

		?>
		<div class="wrap">
		<div id="icon-wonderplugin-gridgallery" class="icon32"><br /></div>
			
		<h2><?php _e( 'Settings', 'wonderplugin_gridgallery' ); ?> </h2>
		<?php

		if ( isset($_POST['save-gridgallery-options']))
		{		
			unset($_POST['save-gridgallery-options']);
			
			$this->controller->save_settings($_POST);
			
			echo '<div class="updated"><p>Settings saved.</p></div>';
		}
						
		$userrole = $this->controller->get_userrole();
		$thumbnailsize = $this->controller->get_thumbnailsize();
				
		?>
		
		<h3>This page is only available for users of Administrator role.</h3>
		
        <form method="post">
        
        <table class="form-table">
        
        <tr valign="top">
			<th scope="row">Set minimum user role</th>
			<td>
				<select name="userrole">
				  <option value="Administrator" <?php echo ($userrole == 'manage_options') ? 'selected="selected"' : ''; ?>>Administrator</option>
				  <option value="Editor" <?php echo ($userrole == 'moderate_comments') ? 'selected="selected"' : ''; ?>>Editor</option>
				  <option value="Author" <?php echo ($userrole == 'upload_files') ? 'selected="selected"' : ''; ?>>Author</option>
				</select>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row">Select the default image size from Media Library for grid thumbnails</th>
			<td>
				<select name="thumbnailsize">
				  <option value="thumbnail" <?php echo ($thumbnailsize == 'thumbnail') ? 'selected="selected"' : ''; ?>>Thumbnail size</option>
				  <option value="medium" <?php echo ($thumbnailsize == 'medium') ? 'selected="selected"' : ''; ?>>Medium size</option>
				  <option value="large" <?php echo ($thumbnailsize == 'large') ? 'selected="selected"' : ''; ?>>Large size</option>
				  <option value="full" <?php echo ($thumbnailsize == 'full') ? 'selected="selected"' : ''; ?>>Full size</option>
				</select>
			</td>
		</tr>
				
        </table>
        
        <p class="submit"><input type="submit" name="save-gridgallery-options" id="save-gridgallery-options" class="button button-primary" value="Save Changes"  /></p>
        
        </form>
        
		</div>
		<?php
	}
			
		
	function print_items() {
		
		?>
		<div class="wrap">
		<div id="icon-wonderplugin-gridgallery" class="icon32"><br /></div>
		<div id="wondergridgallerylightbox_options" data-skinsfoldername="skins/default/"  data-jsfolder="<?php echo WONDERPLUGIN_GRIDGALLERY_URL . 'engine/'; ?>" style="display:none;"></div>
			
		<h2><?php _e( 'Manage Galleries', 'wonderplugin_gridgallery' ); ?> <a href="<?php echo admin_url('admin.php?page=wonderplugin_gridgallery_add_new'); ?>" class="add-new-h2"> <?php _e( 'New Gallery', 'wonderplugin_gridgallery' ); ?></a> </h2>
		
		<?php $this->process_actions(); ?>
		
		<form id="gridgallery-list-table" method="post">
		<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
		<?php 
		
		if ( !is_object($this->list_table) )
			$this->list_table = new WonderPlugin_Gridgallery_List_Table($this);
		
		$this->list_table->list_data = $this->controller->get_list_data();
		$this->list_table->prepare_items();
		$this->list_table->display();		
		?>								
        </form>
        
		</div>
		<?php
	}
	
	function print_item()
	{
		if ( !isset( $_REQUEST['itemid'] ) )
			return;
		
		?>
		<div class="wrap">
		<div id="icon-wonderplugin-gridgallery" class="icon32"><br /></div>
		<div id="wondergridgallerylightbox_options" data-skinsfoldername="skins/default/"  data-jsfolder="<?php echo WONDERPLUGIN_GRIDGALLERY_URL . 'engine/'; ?>" style="display:none;"></div>
					
		<h2><?php _e( 'View Grid Gallery', 'wonderplugin_gridgallery' ); ?> <a href="<?php echo admin_url('admin.php?page=wonderplugin_gridgallery_edit_item') . '&itemid=' . $_REQUEST['itemid']; ?>" class="add-new-h2"> <?php _e( 'Edit Grid Gallery', 'wonderplugin_gridgallery' ); ?>  </a> </h2>
		
		<div class="updated"><p style="text-align:center;">  <?php _e( 'To embed the gridgallery into your page, use shortcode', 'wonderplugin_gridgallery' ); ?> <strong><?php echo esc_attr('[wonderplugin_gridgallery id="' . $_REQUEST['itemid'] . '"]'); ?></strong></p></div>

		<div class="updated"><p style="text-align:center;">  <?php _e( 'To embed the gridgallery into your template, use php code', 'wonderplugin_gridgallery' ); ?> <strong><?php echo esc_attr('<?php echo do_shortcode(\'[wonderplugin_gridgallery id="' . $_REQUEST['itemid'] . '"]\'); ?>'); ?></strong></p></div>
		
		<?php
		echo $this->controller->generate_body_code( $_REQUEST['itemid'], true ); 
		?>	 
		
		</div>
		<?php
	}
	
	function process_actions()
	{
		
		if ( isset($_REQUEST['action']) && ($_REQUEST['action'] == 'delete') && isset( $_REQUEST['itemid'] ) )
		{
			$deleted = 0;
			
			if ( is_array( $_REQUEST['itemid'] ) )
			{
				foreach( $_REQUEST['itemid'] as $id)
				{
					$ret = $this->controller->delete_item($id);
					if ($ret > 0)
						$deleted += $ret;
				}
			}
			else
			{
				$deleted = $this->controller->delete_item( $_REQUEST['itemid'] );
			}
			
			if ($deleted > 0)
			{
				echo '<div class="updated"><p>';
				printf( _n('%d gallery deleted.', '%d galleries deleted.', $deleted), $deleted );
				echo '</p></div>';
			}
		}
		
		if ( isset($_REQUEST['action']) && ($_REQUEST['action'] == 'clone') && isset( $_REQUEST['itemid'] ) )
		{
			$cloned_id = $this->controller->clone_item( $_REQUEST['itemid'] );
			if ($cloned_id > 0)
			{
				echo '<div class="updated"><p>';
				printf( 'New gridgallery created with ID: %d', $cloned_id );
				echo '</p></div>';
			}
			else
			{
				echo '<div class="error"><p>';
				printf( 'The gridgallery cannot be cloned.' );
				echo '</p></div>';
			}
		}
	}

	function print_add_new() {
		
		?>
		<div class="wrap">
		<div id="icon-wonderplugin-gridgallery" class="icon32"><br /></div>
		<div id="wondergridgallerylightbox_options" data-skinsfoldername="skins/default/"  data-jsfolder="<?php echo WONDERPLUGIN_GRIDGALLERY_URL . 'engine/'; ?>" style="display:none;"></div>
		
		<h2><?php _e( 'New Gallery', 'wonderplugin_gridgallery' ); ?> <a href="<?php echo admin_url('admin.php?page=wonderplugin_gridgallery_show_items'); ?>" class="add-new-h2"> <?php _e( 'Manage Galleries', 'wonderplugin_gridgallery' ); ?>  </a> </h2>
		
		<?php 
		$this->creator = new WonderPlugin_Gridgallery_Creator($this);		
		echo $this->creator->render( -1, null, $this->controller->get_thumbnailsize() );
	}
	
	function print_edit_item()
	{
		if ( !isset( $_REQUEST['itemid'] ) )
			return;
	
		?>
		<div class="wrap">
		<div id="icon-wonderplugin-gridgallery" class="icon32"><br /></div>
		<div id="wondergridgallerylightbox_options" data-skinsfoldername="skins/default/"  data-jsfolder="<?php echo WONDERPLUGIN_GRIDGALLERY_URL . 'engine/'; ?>" style="display:none;"></div>
			
		<h2><?php _e( 'Edit Grid Gallery', 'wonderplugin_gridgallery' ); ?> <a href="<?php echo admin_url('admin.php?page=wonderplugin_gridgallery_show_item') . '&itemid=' . $_REQUEST['itemid']; ?>" class="add-new-h2"> <?php _e( 'View Grid Gallery', 'wonderplugin_gridgallery' ); ?>  </a> </h2>
		
		<?php 
		$this->creator = new WonderPlugin_Gridgallery_Creator($this);
		echo $this->creator->render( $_REQUEST['itemid'], $this->controller->get_item_data( $_REQUEST['itemid'] ), $this->controller->get_thumbnailsize()  );
	}
	
}