<?php

class BWGViewUninstall_bwg {
  ////////////////////////////////////////////////////////////////////////////////////////
  // Events                                                                             //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Constants                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Variables                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  private $model;


  ////////////////////////////////////////////////////////////////////////////////////////
  // Constructor & Destructor                                                           //
  ////////////////////////////////////////////////////////////////////////////////////////
  public function __construct($model) {
    $this->model = $model;
  }
  ////////////////////////////////////////////////////////////////////////////////////////
  // Public Methods                                                                     //
  ////////////////////////////////////////////////////////////////////////////////////////
  public function display() {
    global $wpdb;
    $prefix = $wpdb->prefix;
    ?>
    <form method="post" action="admin.php?page=uninstall_bwg" style="width:99%;">
      <?php wp_nonce_field( 'uninstall_bwg', 'bwg_nonce' ); ?>
      <div class="wrap">
        <span class="uninstall_icon"></span>
        <h2>Uninstall Photo Gallery</h2>
        <p>
          Deactivating Photo Gallery plugin does not remove any data that may have been created. To completely remove this plugin, you can uninstall it here.
        </p>
        <p style="color: red;">
          <strong>WARNING:</strong>
          Once uninstalled, this can't be undone. You should use a Database Backup plugin of WordPress to back up all the data first.
        </p>
        <p style="color: red">
          <strong>The following Database Tables will be deleted:</strong>
        </p>
        <table class="widefat">
          <thead>
            <tr>
              <th>Database Tables</th>
            </tr>
          </thead>
          <tr>
            <td valign="top">
              <ol>
                  <li><?php echo $prefix; ?>bwg_album</li>
                  <li><?php echo $prefix; ?>bwg_album_gallery</li>
                  <li><?php echo $prefix; ?>bwg_gallery</li>
                  <li><?php echo $prefix; ?>bwg_image</li>
                  <li><?php echo $prefix; ?>bwg_image_comment</li>
                  <li><?php echo $prefix; ?>bwg_image_rate</li>
                  <li><?php echo $prefix; ?>bwg_image_tag</li>
                  <li><?php echo $prefix; ?>bwg_option</li>
                  <li><?php echo $prefix; ?>bwg_theme</li>
                  <li><?php echo $prefix; ?>bwg_shortcode</li>
              </ol>
            </td>
          </tr>
          <tfoot>
            <tr>
              <th>
                <input type="checkbox" name="bwg_delete_files" id="bwg_delete_files" style="vertical-align: middle;" />
                <label for="bwg_delete_files">&nbsp;Delete the folder containing uploaded images.</label>
              </th>
            </tr>
          </tfoot>
        </table>
        <p style="text-align: center;">
          Do you really want to uninstall Photo Gallery?
        </p>
        <p style="text-align: center;">
          <input type="checkbox" name="Photo Gallery" id="check_yes" value="yes" />&nbsp;<label for="check_yes">Yes</label>
        </p>
        <p style="text-align: center;">
          <input type="submit" value="UNINSTALL" class="button-primary" onclick="if (check_yes.checked) { 
                                                                                    if (confirm('You are About to Uninstall Photo Gallery from WordPress.\nThis Action Is Not Reversible.')) {
                                                                                        spider_set_input_value('task', 'uninstall');
                                                                                    } else {
                                                                                        return false;
                                                                                    }
                                                                                  }
                                                                                  else {
                                                                                    return false;
                                                                                  }" />
        </p>
      </div>
      <input id="task" name="task" type="hidden" value="" />
    </form>
  <?php
  }

  public function uninstall() {
    $flag = TRUE;
    if (isset($_POST['bwg_delete_files'])) {
      function delfiles($del_file) {
        if (is_dir($del_file)) {
          $del_folder = scandir($del_file);
          foreach ($del_folder as $file) {
            if ($file != '.' and $file != '..') {
              delfiles($del_file . '/' . $file);
            }
          }
          if (!rmdir($del_file)) {
            $flag = FALSE;
          }
        }
        else {
          if (!unlink($del_file)) {
            $flag = FALSE;
          }
        }
      }
      global $WD_BWG_UPLOAD_DIR;
      if ($WD_BWG_UPLOAD_DIR) {
        if (is_dir(ABSPATH . $WD_BWG_UPLOAD_DIR)) {
          delfiles(ABSPATH . $WD_BWG_UPLOAD_DIR);
        }
      }
    }
    global $wpdb;
    $this->model->delete_db_tables();
    $prefix = $wpdb->prefix;
    $deactivate_url = wp_nonce_url('plugins.php?action=deactivate&amp;plugin=photo-gallery/photo-gallery.php', 'deactivate-plugin_photo-gallery/photo-gallery.php');
    ?>
    <div id="message" class="updated fade">
      <p>The following Database Tables successfully deleted:</p>
      <p><?php echo $prefix; ?>bwg_album,</p>
      <p><?php echo $prefix; ?>bwg_album_gallery,</p>
      <p><?php echo $prefix; ?>bwg_gallery,</p>
      <p><?php echo $prefix; ?>bwg_image,</p>
      <p><?php echo $prefix; ?>bwg_image_comment,</p>
      <p><?php echo $prefix; ?>bwg_image_rate,</p>
      <p><?php echo $prefix; ?>bwg_image_tag,</p>
      <p><?php echo $prefix; ?>bwg_option,</p>
      <p><?php echo $prefix; ?>bwg_theme,</p>
      <p><?php echo $prefix; ?>bwg_shortcode.</p>
    </div>
    <?php
    if (isset($_POST['bwg_delete_files'])) {
    ?>
    <div class="<?php echo ($flag) ? 'updated' : 'error'?>">
      <p><?php echo ($flag) ? 'The folder was successfully deleted.' : 'An error occurred when deleting the folder.'?></p>
    </div>
    <?php
    }
    ?>
    <div class="wrap">
      <h2>Uninstall Photo Gallery</h2>
      <p><strong><a href="<?php echo $deactivate_url; ?>">Click Here</a> To Finish the Uninstallation and Photo Gallery will be Deactivated Automatically.</strong></p>
      <input id="task" name="task" type="hidden" value="" />
    </div>
  <?php
  }
  
  ////////////////////////////////////////////////////////////////////////////////////////
  // Getters & Setters                                                                  //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Private Methods                                                                    //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Listeners                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
}