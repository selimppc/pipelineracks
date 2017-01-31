<?php

class BWGViewOptions_bwg {
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
  public function display($reset = FALSE) {
    global $WD_BWG_UPLOAD_DIR;
    ?>
    <div style="clear: both; float: left; width: 99%;">
      <div style="float:left; font-size: 14px; font-weight: bold;">
        This section allows you to change settings for different views and general options.
        <a style="color: blue; text-decoration: none;" target="_blank" href="http://web-dorado.com/wordpress-gallery-guide-step-5/5-1.html">Read More in User Manual</a>
      </div>
      <div style="float: right; text-align: right;">
        <a style="text-decoration: none;" target="_blank" href="http://web-dorado.com/products/wordpress-photo-gallery-plugin.html">
          <img width="215" border="0" alt="web-dorado.com" src="<?php echo WD_BWG_URL . '/images/logo.png'; ?>" />
        </a>
      </div>
    </div>
    <script>
      function bwg_add_music(files) {
        document.getElementById("slideshow_audio_url").value = files[0]['url'];
      }
      function bwg_add_built_in_watermark_image(files) {
        document.getElementById("built_in_watermark_url").value = '<?php echo site_url() . '/' . $WD_BWG_UPLOAD_DIR; ?>' + files[0]['url'];
      }
      function bwg_add_watermark_image(files) {
        document.getElementById("watermark_url").value = '<?php echo site_url() . '/' . $WD_BWG_UPLOAD_DIR; ?>' + files[0]['url'];
      }
    </script>
    <?php
    $row = $this->model->get_row_data($reset);
    $built_in_watermark_fonts = array();
    foreach (scandir(path_join(WD_BWG_DIR, 'fonts')) as $filename) {
			if (strpos($filename, '.') === 0) continue;
			else $built_in_watermark_fonts[] = $filename;
		}
    $watermark_fonts = array(
      'arial' => 'Arial',
      'Lucida grande' => 'Lucida grande',
      'segoe ui' => 'Segoe ui',
      'tahoma' => 'Tahoma',
      'trebuchet ms' => 'Trebuchet ms',
      'verdana' => 'Verdana',
      'cursive' =>'Cursive',
      'fantasy' => 'Fantasy',
      'monospace' => 'Monospace',
      'serif' => 'Serif',
    );
    $effects = array(
      'none' => 'None',
      'cubeH' => 'Cube Horizontal',
      'cubeV' => 'Cube Vertical',
      'fade' => 'Fade',
      'sliceH' => 'Slice Horizontal',
      'sliceV' => 'Slice Vertical',
      'slideH' => 'Slide Horizontal',
      'slideV' => 'Slide Vertical',
      'scaleOut' => 'Scale Out',
      'scaleIn' => 'Scale In',
      'blockScale' => 'Block Scale',
      'kaleidoscope' => 'Kaleidoscope',
      'fan' => 'Fan',
      'blindH' => 'Blind Horizontal',
      'blindV' => 'Blind Vertical',
      'random' => 'Random',
    );
    ?>
    <form method="post" class="wrap" action="admin.php?page=options_bwg" style="float: left; width: 99%;">      
      <?php wp_nonce_field( 'options_bwg', 'bwg_nonce' ); ?>
      <span class="option-icon"></span>
      <h2>Edit options</h2>
      <div style="display: inline-block; width: 100%;">
        <div style="float: right;">
          <input class="button-primary" type="submit" onclick="if (spider_check_required('title', 'Title')) {return false;}; spider_set_input_value('task', 'save')" value="Save" />
          <input class="button-secondary" type="submit" onclick="if (confirm('Do you want to reset to default?')) {
                                                                 spider_set_input_value('task', 'reset');
                                                               } else {
                                                                 return false;
                                                               }" value="Reset all options" />
        </div>
      </div>
      <div style="display: none; width: 100%;" id="display_panel">
        <div style="float:left;">
          <div id="div_1" class="gallery_type" onclick="bwg_change_option_type('1')"> Global options</div><br/>
          <div id="div_8" class="gallery_type" onclick="bwg_change_option_type('8')"> Watermark</div><br/>
          <div id="div_2" class="gallery_type" onclick="bwg_change_option_type('2')"> Advertisement</div><br/>
          <div id="div_3" class="gallery_type" onclick="bwg_change_option_type('3')"> Lightbox</div><br/>
          <div id="div_4" class="gallery_type" onclick="bwg_change_option_type('4')"> Album options</div><br/>
          <div id="div_5" class="gallery_type" onclick="bwg_change_option_type('5')"> Slideshow</div><br/>
          <div id="div_6" class="gallery_type" onclick="bwg_change_option_type('6')"> Thumbnail options</div><br/>
          <div id="div_7" class="gallery_type" onclick="bwg_change_option_type('7')"> Image options</div><br/>
          <div id="div_9" class="gallery_type" onclick="bwg_change_option_type('9')"> Embed options</div><br/>
          <input type="hidden" id="type" name="type" value="<?php echo (isset($_POST["type"]) ? esc_html(stripslashes($_POST["type"])) : "1"); ?>"/>
        </div>

        <!--Global options-->
        <div class="spider_div_options" id="div_content_1">
          <table>
            <tbody>
              <tr>
                <td class="spider_label_options">
                  <label for="images_directory">Images directory:</label>
                </td>
                <td>
                  <input id="images_directory" name="images_directory" type="text" style="display:inline-block; width:100%;" value="<?php echo $row->images_directory; ?>" />
                  <input type="hidden" id="old_images_directory" name="old_images_directory" value="<?php echo $row->old_images_directory; ?>"/>
                  <div class="spider_description">Input an existing directory inside the Wordpress directory to store uploaded images.<br />Old directory content will be moved to the new one.</div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options">
                  <label for="upload_img_width">Image dimensions: </label>
                </td>
                <td>
                  <input type="text" name="upload_img_width" id="upload_img_width" value="<?php echo $row->upload_img_width; ?>" class="spider_int_input" /> x 
                  <input type="text" name="upload_img_height" id="upload_img_height" value="<?php echo $row->upload_img_height; ?>" class="spider_int_input" /> px
                  <div class="spider_description">The maximum size of the uploaded image (0 for original size).</div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options">
                  <label>Right click protection:</label>
                </td>
                <td>
                  <input type="radio" name="image_right_click" id="image_right_click_1" value="1" <?php if ($row->image_right_click) echo 'checked="checked"'; ?> /><label for="image_right_click_1">Yes</label>
                  <input type="radio" name="image_right_click" id="image_right_click_0" value="0" <?php if (!$row->image_right_click) echo 'checked="checked"'; ?> /><label for="image_right_click_0">No</label>
                  <div class="spider_description">Disable image right click possibility.</div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options">
                  <label>Gallery role:</label>
                </td>
                <td>
                  <input type="radio" name="gallery_role" id="gallery_role_1" value="1" <?php if ($row->gallery_role) echo 'checked="checked"'; ?> /><label for="gallery_role_1">Yes</label>
                  <input type="radio" name="gallery_role" id="gallery_role_0" value="0" <?php if (!$row->gallery_role) echo 'checked="checked"'; ?> /><label for="gallery_role_0">No</label>
                  <div class="spider_description">Only author can change a gallery.</div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options">
                  <label>Album role:</label>
                </td>
                <td>
                  <input type="radio" name="album_role" id="album_role_1" value="1" <?php if ($row->album_role) echo 'checked="checked"'; ?> /><label for="album_role_1">Yes</label>
                  <input type="radio" name="album_role" id="album_role_0" value="0" <?php if (!$row->album_role) echo 'checked="checked"'; ?> /><label for="album_role_0">No</label>
                  <div class="spider_description">Only author can change an album.</div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options">
                  <label>Image role:</label>
                </td>
                <td>
                  <input type="radio" name="image_role" id="image_role_1" value="1" <?php if ($row->image_role) echo 'checked="checked"'; ?> /><label for="image_role_1">Yes</label>
                  <input type="radio" name="image_role" id="image_role_0" value="0" <?php if (!$row->image_role) echo 'checked="checked"'; ?> /><label for="image_role_0">No</label>
                  <div class="spider_description">Only author can change an image.</div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options">
                  <label>Show search box:</label>
                </td>
                <td>
                  <input type="radio" name="show_search_box" id="show_search_box_1" value="1" <?php if ($row->show_search_box) echo 'checked="checked"'; ?> onClick="bwg_enable_disable('', 'tr_search_box_width', 'show_search_box_1')" /><label for="show_search_box_1">Yes</label>
                  <input type="radio" name="show_search_box" id="show_search_box_0" value="0" <?php if (!$row->show_search_box) echo 'checked="checked"'; ?> onClick="bwg_enable_disable('none', 'tr_search_box_width', 'show_search_box_0')" /><label for="show_search_box_0">No</label>
                 <div class="spider_description"></div>
                </td>
              </tr>
              <tr id="tr_search_box_width">
                <td class="spider_label_options">
                  <label for="search_box_width">Search box width: </label>
                </td>
                <td>
                  <input type="text" name="search_box_width" id="search_box_width" value="<?php echo $row->search_box_width; ?>" class="spider_int_input" /> px
                  <div class="spider_description"></div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options">
                  <label>Show "Order by" dropdown list:</label>
                </td>
                <td>
                  <input type="radio" name="show_sort_images" id="show_sort_images_1" value="1" <?php if ($row->show_sort_images) echo 'checked="checked"'; ?> /><label for="show_sort_images_1">Yes</label>
                  <input type="radio" name="show_sort_images" id="show_sort_images_0" value="0" <?php if (!$row->show_sort_images) echo 'checked="checked"'; ?> /><label for="show_sort_images_0">No</label>
                 <div class="spider_description"></div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options">
                  <label>Preload images:</label>
                </td>
                <td>
                  <input type="radio" name="preload_images" id="preload_images_1" value="1" <?php if ($row->preload_images) echo 'checked="checked"'; ?> onClick="bwg_enable_disable('', 'tr_preload_images_count', 'preload_images_1')" /><label for="preload_images_1">Yes</label>
                  <input type="radio" name="preload_images" id="preload_images_0" value="0" <?php if (!$row->preload_images) echo 'checked="checked"'; ?> onClick="bwg_enable_disable('none', 'tr_preload_images_count', 'preload_images_0')" /><label for="preload_images_0">No</label>
                 <div class="spider_description"></div>
                </td>
              </tr>	
              <tr id="tr_preload_images_count">
                <td class="spider_label_options">
                  <label for="preload_images_count">Count of images: </label>
                </td>
                <td>
                  <input type="text" name="preload_images_count" id="preload_images_count" value="<?php echo $row->preload_images_count; ?>" class="spider_int_input" />
                  <div class="spider_description">Count of images to preload (0 for all).</div>
                </td>
              </tr>
	      <tr>
                <td class="spider_label_options">
                  <label>Import from Media Library:</label>
                </td>
                <td>
                  <input type="radio" name="enable_ML_import" id="enable_ML_import_1" value="1" <?php if ($row->enable_ML_import) echo 'checked="checked"'; ?> /><label for="enable_ML_import_1">Yes</label>
                  <input type="radio" name="enable_ML_import" id="enable_ML_import_0" value="0" <?php if (!$row->enable_ML_import) echo 'checked="checked"'; ?> /><label for="enable_ML_import_0">No</label>
                 <div class="spider_description">Enable import from Media Library in file manager.</div>
                </td>
              </tr>
              <tr>
              <td class="spider_label_options">
                <label>Enable href attribute:</label>
              </td>
              <td>
                <input type="radio" name="enable_seo" id="enable_seo_1" value="1" <?php if ($row->enable_seo) echo 'checked="checked"'; ?> /><label for="enable_seo_1">Yes</label>
                <input type="radio" name="enable_seo" id="enable_seo_0" value="0" <?php if (!$row->enable_seo) echo 'checked="checked"'; ?> /><label for="enable_seo_0">No</label>
               <div class="spider_description">Disable this option only if it conflicts with your theme.</div>
              </td>
            </tr>
	    <tr>
                <td class="spider_label_options">
                  <label>Meta auto-fill:</label>
                </td>
                <td>
                  <input type="radio" name="read_metadata" id="read_metadata_1" value="1" <?php if ($row->read_metadata) echo 'checked="checked"'; ?> /><label for="read_metadata_1">Yes</label>
                  <input type="radio" name="read_metadata" id="read_metadata_0" value="0" <?php if (!$row->read_metadata) echo 'checked="checked"'; ?> /><label for="read_metadata_0">No</label>
                  <div class="spider_description">Enabling this option the meta description of the image will be automatically filled in image description field.</div>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
        
        <!--Watermark-->
        <div class="spider_div_options" id="div_content_8">
          <table style="width: 100%;">
            <tr>
              <td style="width: 50%; vertical-align: top; height: 100%; display: table-cell;">
                <table>
                  <tbody>
                    <tr id="tr_built_in_watermark_type">
                      <td class="spider_label_options">
                        <label>Watermark type: </label>
                      </td>
                      <td>
                        <input type="radio" name="built_in_watermark_type" id="built_in_watermark_type_none" value="none" <?php if ($row->built_in_watermark_type == 'none') echo 'checked="checked"'; ?> onClick="bwg_built_in_watermark('watermark_type_none')" />
                          <label for="built_in_watermark_type_none">None</label>
                        <input type="radio" name="built_in_watermark_type" id="built_in_watermark_type_text" value="text" <?php if ($row->built_in_watermark_type == 'text') echo 'checked="checked"'; ?> onClick="bwg_built_in_watermark('watermark_type_text')" onchange="preview_built_in_watermark()" />
                          <label for="built_in_watermark_type_text">Text</label>
                        <input type="radio" name="built_in_watermark_type" id="built_in_watermark_type_image" value="image" <?php if ($row->built_in_watermark_type == 'image') echo 'checked="checked"'; ?> onClick="bwg_built_in_watermark('watermark_type_image')" onchange="preview_built_in_watermark()" />
                          <label for="built_in_watermark_type_image">Image</label>
                          <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr id="tr_built_in_watermark_url">
                      <td class="spider_label_options">
                        <label for="built_in_watermark_url">Watermark url: </label>
                      </td>
                      <td>
                        <input type="text" id="built_in_watermark_url" name="built_in_watermark_url" style="width: 68%;" value="<?php echo $row->built_in_watermark_url; ?>" style="display:inline-block;" onchange="preview_built_in_watermark()" />
                         <?php
                         $query_url = add_query_arg(array('action' => 'addImages', 'width' => '700', 'height' => '550', 'extensions' => 'png', 'callback' => 'bwg_add_built_in_watermark_image'), admin_url('admin-ajax.php'));
                         $query_url = wp_nonce_url( $query_url, 'addImages', 'bwg_nonce' );
                         $query_url =  add_query_arg(array('TB_iframe' => '1'), $query_url );
                         ?>
                         <a href="<?php echo $query_url; ?>" id="button_add_built_in_watermark_image" class="button-primary thickbox thickbox-preview"
                           title="Add image" 
                           onclick="return false;"
                           style="margin-bottom:5px;">
                          Add Image
                        </a>
                        <div class="spider_description">Only .png format is supported.</div>
                      </td>
                    </tr>                    
                    <tr id="tr_built_in_watermark_text">
                      <td class="spider_label_options">
                        <label for="built_in_watermark_text">Watermark text: </label>
                      </td>
                      <td>
                        <input type="text" name="built_in_watermark_text" id="built_in_watermark_text" style="width: 100%;" value="<?php echo $row->built_in_watermark_text; ?>" onchange="preview_built_in_watermark()" onkeypress="preview_built_in_watermark()" />
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr id="tr_built_in_watermark_size">
                      <td class="spider_label_options">
                        <label for="built_in_watermark_size">Watermark size: </label>
                      </td>
                      <td>
                        <input type="text" name="built_in_watermark_size" id="built_in_watermark_size" value="<?php echo $row->built_in_watermark_size; ?>" class="spider_int_input" onchange="preview_built_in_watermark()" /> %
                        <div class="spider_description">Enter size of watermark in percents according to image.</div>
                      </td>
                    </tr>
                    <tr id="tr_built_in_watermark_font_size">
                      <td class="spider_label_options">
                        <label for="built_in_watermark_font_size">Watermark font size: </label>
                      </td>
                      <td>
                        <input type="text" name="built_in_watermark_font_size" id="built_in_watermark_font_size" value="<?php echo $row->built_in_watermark_font_size; ?>" class="spider_int_input" onchange="preview_built_in_watermark()" /> 
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr id="tr_built_in_watermark_font">
                      <td class="spider_label_options">
                        <label for="built_in_watermark_font">Watermark font style: </label>
                      </td>
                      <td>
                        <select name="built_in_watermark_font" id="built_in_watermark_font" style="width:150px;" onchange="preview_built_in_watermark()">
                          <?php
                          foreach ($built_in_watermark_fonts as $watermark_font) {
                            ?>
                            <option value="<?php echo $watermark_font; ?>" <?php if ($row->built_in_watermark_font == $watermark_font) echo 'selected="selected"'; ?>><?php echo $watermark_font; ?></option>
                            <?php
                          }
                          ?>
                        </select>
                        <?php 
                          foreach ($built_in_watermark_fonts as $watermark_font) {
                            ?>
                            <style>
                            @font-face {
                              font-family: <?php echo 'bwg_' . str_replace('.ttf', '', $watermark_font); ?>;
                              src: url("<?php echo WD_BWG_URL . '/fonts/' . $watermark_font; ?>");
                             }
                            </style>
                            <?php
                          }
                        ?>
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr id="tr_built_in_watermark_color">
                      <td class="spider_label_options">
                        <label for="built_in_watermark_color">Watermark color: </label>
                      </td>
                      <td>
                        <input type="text" name="built_in_watermark_color" id="built_in_watermark_color" value="<?php echo $row->built_in_watermark_color; ?>" class="color" onchange="preview_built_in_watermark()" />
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr id="tr_built_in_watermark_opacity">
                      <td class="spider_label_options">
                        <label for="built_in_watermark_opacity">Watermark opacity: </label>
                      </td>
                      <td>
                        <input type="text" name="built_in_watermark_opacity" id="built_in_watermark_opacity" value="<?php echo $row->built_in_watermark_opacity; ?>" class="spider_int_input" onchange="preview_built_in_watermark()" /> %
                        <div class="spider_description">Opacity value must be in the range of 0 to 100.</div>
                      </td>
                    </tr>
                    <tr id="tr_built_in_watermark_position">
                      <td class="spider_label_options">
                        <label>Watermark position: </label>
                      </td>
                      <td>
                        <table class="bwg_position_table">
                          <tbody>
                            <tr>
                              <td><input type="radio" value="top-left" name="built_in_watermark_position" <?php if ($row->built_in_watermark_position == "top-left") echo 'checked="checked"'; ?> onchange="preview_built_in_watermark()"></td>
                              <td><input type="radio" value="top-center" name="built_in_watermark_position" <?php if ($row->built_in_watermark_position == "top-center") echo 'checked="checked"'; ?> onchange="preview_built_in_watermark()"></td>
                              <td><input type="radio" value="top-right" name="built_in_watermark_position" <?php if ($row->built_in_watermark_position == "top-right") echo 'checked="checked"'; ?> onchange="preview_built_in_watermark()"></td>
                            </tr>
                            <tr>
                              <td><input type="radio" value="middle-left" name="built_in_watermark_position" <?php if ($row->built_in_watermark_position == "middle-left") echo 'checked="checked"'; ?> onchange="preview_built_in_watermark()"></td>
                              <td><input type="radio" value="middle-center" name="built_in_watermark_position" <?php if ($row->built_in_watermark_position == "middle-center") echo 'checked="checked"'; ?> onchange="preview_built_in_watermark()"></td>
                              <td><input type="radio" value="middle-right" name="built_in_watermark_position" <?php if ($row->built_in_watermark_position == "middle-right") echo 'checked="checked"'; ?> onchange="preview_built_in_watermark()"></td>
                            </tr>
                            <tr>
                              <td><input type="radio" value="bottom-left" name="built_in_watermark_position" <?php if ($row->built_in_watermark_position == "bottom-left") echo 'checked="checked"'; ?> onchange="preview_built_in_watermark()"></td>
                              <td><input type="radio" value="bottom-center" name="built_in_watermark_position" <?php if ($row->built_in_watermark_position == "bottom-center") echo 'checked="checked"'; ?> onchange="preview_built_in_watermark()"></td>
                              <td><input type="radio" value="bottom-right" name="built_in_watermark_position" <?php if ($row->built_in_watermark_position == "bottom-right") echo 'checked="checked"'; ?> onchange="preview_built_in_watermark()"></td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
              <td style="width: 50%; vertical-align: top;height: 100%; display: table-cell;">
                <span id="preview_built_in_watermark" style="display:table-cell; background-image:url('<?php echo WD_BWG_URL . '/images/watermark_preview.jpg'?>');background-size:100% 100%;width:400px;height:400px;padding-top: 4px; position:relative;">
                </span>
              </td>
            </tr>
          </table>
        </div>

        <!--Advertisement-->
        <div class="spider_div_options" id="div_content_2">
          <table style="width: 100%;">
            <tr>
              <td style="width: 50%; vertical-align: top; height: 100%; display: table-cell;">
                <table>
                  <tbody>
                    <tr id="tr_watermark_type">
                      <td class="spider_label_options">
                        <label>Advertisement type: </label>
                      </td>
                      <td>
                        <input type="radio" name="watermark_type" id="watermark_type_none" value="none" <?php if ($row->watermark_type == 'none') echo 'checked="checked"'; ?> onClick="bwg_watermark('watermark_type_none')" />
                          <label for="watermark_type_none">None</label>
                        <input type="radio" name="watermark_type" id="watermark_type_text" value="text" <?php if ($row->watermark_type == 'text') echo 'checked="checked"'; ?> onClick="bwg_watermark('watermark_type_text')" onchange="preview_watermark()" />
                          <label for="watermark_type_text">Text</label>
                        <input type="radio" name="watermark_type" id="watermark_type_image" value="image" <?php if ($row->watermark_type == 'image') echo 'checked="checked"'; ?> onClick="bwg_watermark('watermark_type_image')" onchange="preview_watermark()" />
                          <label for="watermark_type_image">Image</label>
                          <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr id="tr_watermark_url">
                      <td class="spider_label_options">
                        <label for="watermark_url">Advertisement url: </label>
                      </td>
                      <td>
                        <input type="text" id="watermark_url" name="watermark_url" style="width: 68%;" value="<?php echo $row->watermark_url; ?>" style="display:inline-block;" onchange="preview_watermark()" />
                        <?php
                        $query_url = add_query_arg(array('action' => 'addImages', 'width' => '700', 'height' => '550', 'extensions' => 'jpg,jpeg,png,gif', 'callback' => 'bwg_add_watermark_image'), admin_url('admin-ajax.php'));
                        $query_url = wp_nonce_url( $query_url, 'addImages', 'bwg_nonce' );
                        $query_url = add_query_arg(array('TB_iframe' => '1'), $query_url );
                        ?>
                        <a href="<?php echo $query_url; ?>" id="button_add_watermark_image" class="button-primary thickbox thickbox-preview"
                           title="Add image" 
                           onclick="return false;"
                           style="margin-bottom:5px;">
                          Add Image
                        </a>
                        <div class="spider_description">Enter absolute image file url or add file from Options page. (.jpg,.jpeg,.png,.gif formats are supported)</div>
                      </td>
                    </tr>                    
                    <tr id="tr_watermark_text">
                      <td class="spider_label_options">
                        <label for="watermark_text">Advertisement text: </label>
                      </td>
                      <td>
                        <input type="text" name="watermark_text" id="watermark_text" style="width: 100%;" value="<?php echo $row->watermark_text; ?>" onchange="preview_watermark()" onkeypress="preview_watermark()" />
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr id="tr_watermark_link">
                      <td class="spider_label_options">
                        <label for="watermark_link">Advertisement link: </label>
                      </td>
                      <td>
                        <input type="text" name="watermark_link" id="watermark_link" style="width: 100%;" value="<?php echo $row->watermark_link; ?>" onchange="preview_watermark()" onkeypress="preview_watermark()" />
                        <div class="spider_description">Enter a URL to open when the advertisement banner is clicked.</div>
                      </td>
                    </tr>
                    <tr id="tr_watermark_width_height">
                      <td class="spider_label_options">
                        <label for="watermark_width">Advertisement dimensions: </label>
                      </td>
                      <td>
                        <input type="text" name="watermark_width" id="watermark_width" value="<?php echo $row->watermark_width; ?>" class="spider_int_input" onchange="preview_watermark()" /> x 
                        <input type="text" name="watermark_height" id="watermark_height" value="<?php echo $row->watermark_height; ?>" class="spider_int_input" onchange="preview_watermark()" /> px
                        <div class="spider_description">Maximum values for watermark image width and height.</div>
                      </td>
                    </tr>
                    <tr id="tr_watermark_font_size">
                      <td class="spider_label_options">
                        <label for="watermark_font_size">Advertisement font size: </label>
                      </td>
                      <td>
                        <input type="text" name="watermark_font_size" id="watermark_font_size" value="<?php echo $row->watermark_font_size; ?>" class="spider_int_input" onchange="preview_watermark()" /> px
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr id="tr_watermark_font">
                      <td class="spider_label_options">
                        <label for="watermark_font">Advertisement font style: </label>
                      </td>
                      <td>
                        <select name="watermark_font" id="watermark_font" style="width:150px;" onchange="preview_watermark()">
                          <?php
                          foreach ($watermark_fonts as $watermark_font) {
                            ?>
                            <option value="<?php echo $watermark_font; ?>" <?php if ($row->watermark_font == $watermark_font) echo 'selected="selected"'; ?>><?php echo $watermark_font; ?></option>
                            <?php
                          }
                          ?>
                        </select>
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr id="tr_watermark_color">
                      <td class="spider_label_options">
                        <label for="watermark_color">Advertisement color: </label>
                      </td>
                      <td>
                        <input type="text" name="watermark_color" id="watermark_color" value="<?php echo $row->watermark_color; ?>" class="color" onchange="preview_watermark()" />
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr id="tr_watermark_opacity">
                      <td class="spider_label_options">
                        <label for="watermark_opacity">Advertisement opacity: </label>
                      </td>
                      <td>
                        <input type="text" name="watermark_opacity" id="watermark_opacity" value="<?php echo $row->watermark_opacity; ?>" class="spider_int_input" onchange="preview_watermark()" /> %
                        <div class="spider_description">Value must be between 0 to 100.</div>
                      </td>
                    </tr>
                    <tr id="tr_watermark_position">
                      <td class="spider_label_options">
                        <label>Advertisement position: </label>
                      </td>
                      <td>
                        <table class="bwg_position_table">
                          <tbody>
                            <tr>
                              <td><input type="radio" value="top-left" name="watermark_position" <?php if ($row->watermark_position == "top-left") echo 'checked="checked"'; ?> onchange="preview_watermark()"></td>
                              <td><input type="radio" value="top-center" name="watermark_position" <?php if ($row->watermark_position == "top-center") echo 'checked="checked"'; ?> onchange="preview_watermark()"></td>
                              <td><input type="radio" value="top-right" name="watermark_position" <?php if ($row->watermark_position == "top-right") echo 'checked="checked"'; ?> onchange="preview_watermark()"></td>
                            </tr>
                            <tr>
                              <td><input type="radio" value="middle-left" name="watermark_position" <?php if ($row->watermark_position == "middle-left") echo 'checked="checked"'; ?> onchange="preview_watermark()"></td>
                              <td><input type="radio" value="middle-center" name="watermark_position" <?php if ($row->watermark_position == "middle-center") echo 'checked="checked"'; ?> onchange="preview_watermark()"></td>
                              <td><input type="radio" value="middle-right" name="watermark_position" <?php if ($row->watermark_position == "middle-right") echo 'checked="checked"'; ?> onchange="preview_watermark()"></td>
                            </tr>
                            <tr>
                              <td><input type="radio" value="bottom-left" name="watermark_position" <?php if ($row->watermark_position == "bottom-left") echo 'checked="checked"'; ?> onchange="preview_watermark()"></td>
                              <td><input type="radio" value="bottom-center" name="watermark_position" <?php if ($row->watermark_position == "bottom-center") echo 'checked="checked"'; ?> onchange="preview_watermark()"></td>
                              <td><input type="radio" value="bottom-right" name="watermark_position" <?php if ($row->watermark_position == "bottom-right") echo 'checked="checked"'; ?> onchange="preview_watermark()"></td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
              <td style="width: 50%; vertical-align: top;height: 100%; display: table-cell;">
                <span id="preview_watermark" style="display:table-cell; background-image:url('<?php echo WD_BWG_URL . '/images/watermark_preview.jpg'?>');background-size:100% 100%;width:400px;height:400px;padding-top: 4px; position:relative;">
                </span>
              </td>
            </tr>
          </table>
        </div>

        <!--Lightbox-->
        <div class="spider_div_options" id="div_content_3">        
          <table style="width: 100%;">
            <tr>
              <td style="width: 50%; vertical-align: top;">
                <table style="display: inline-table;">
                  <tbody>			
                    <tr id="tr_popup_full_width">
                      <td class="spider_label_options">
                        <label>Full width lightbox:</label>
                      </td>
                      <td>
                        <input type="radio" name="popup_fullscreen" id="popup_fullscreen_1" value="1" <?php if ($row->popup_fullscreen) echo 'checked="checked"'; ?> onchange="bwg_popup_fullscreen(1)" /><label for="popup_fullscreen_1">Yes</label>
                        <input type="radio" name="popup_fullscreen" id="popup_fullscreen_0" value="0" <?php if (!$row->popup_fullscreen) echo 'checked="checked"'; ?> onchange="bwg_popup_fullscreen(0)" /><label for="popup_fullscreen_0">No</label>
                        <div class="spider_description">Enable full width feature for the lightbox.</div>
                      </td>
                    </tr>			
                    <tr id="tr_popup_dimensions" >
                      <td class="spider_label_options">
                        <label for="popup_width">Lightbox dimensions:</label>
                      </td>
                      <td>
                        <input type="text" name="popup_width" id="popup_width" value="<?php echo $row->popup_width; ?>" class="spider_int_input" /> x 
                        <input type="text" name="popup_height" id="popup_height" value="<?php echo $row->popup_height; ?>" class="spider_int_input" /> px
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr>
                      <td class="spider_label_options">
                        <label for="popup_type">Lightbox effect:</label>
                      </td>
                      <td>
                        <select name="popup_type" id="popup_type" style="width:150px;">
                          <?php
                          foreach ($effects as $key => $effect) {
                            ?>
                            <option value="<?php echo $key; ?>" <?php echo ($key != 'none' && $key != 'fade') ? 'disabled="disabled" title="This effect is disabled in free version."' : ''; ?> <?php if ($row->popup_type == $key) echo 'selected="selected"'; ?>><?php echo $effect; ?></option>
                            <?php
                          }
                          ?>
                        </select>
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr id="tr_popup_autoplay">
                      <td class="spider_label_options">
                        <label>Lightbox autoplay: </label>
                      </td>
                      <td>
                        <input type="radio" name="popup_autoplay" id="popup_autoplay_1" value="1" <?php if ($row->popup_autoplay) echo 'checked="checked"'; ?> /><label for="popup_autoplay_1">Yes</label>
                        <input type="radio" name="popup_autoplay" id="popup_autoplay_0" value="0" <?php if (!$row->popup_autoplay) echo 'checked="checked"'; ?> /><label for="popup_autoplay_0">No</label>
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr>
                      <td class="spider_label_options">
                        <label for="popup_interval">Time interval:</label>
                      </td>
                      <td>
                        <input type="text" name="popup_interval" id="popup_interval" value="<?php echo $row->popup_interval; ?>" class="spider_int_input" /> sec.
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr>
                      <td class="spider_label_options spider_free_version_label">
                        <label>Enable filmstrip:</label>
                      </td>
                      <td>
                        <input disabled="disabled" type="radio" name="popup_enable_filmstrip" id="popup_enable_filmstrip_1" value="1" <?php if ($row->popup_enable_filmstrip ) echo 'checked="checked"'; ?> onClick="bwg_enable_disable('', 'tr_popup_filmstrip_height', 'popup_enable_filmstrip_1')" /><label for="popup_enable_filmstrip_1">Yes</label>
                        <input disabled="disabled" type="radio" name="popup_enable_filmstrip" id="popup_enable_filmstrip_0" value="0" <?php if (!$row->popup_enable_filmstrip ) echo 'checked="checked"'; ?> onClick="bwg_enable_disable('none', 'tr_popup_filmstrip_height', 'popup_enable_filmstrip_0')" /><label for="popup_enable_filmstrip_0">No</label>
                        <div class="spider_description spider_free_version">This option is disabled in free version.</div>
                      </td>
                    </tr>
                    <tr id="tr_popup_filmstrip_height">
                      <td class="spider_label_options spider_free_version_label">
                        <label for="popup_filmstrip_height">Filmstrip size:</label>
                      </td>
                      <td class="spider_free_version_label">
                        <input disabled="disabled" type="text" name="popup_filmstrip_height" id="popup_filmstrip_height" value="<?php echo $row->popup_filmstrip_height; ?>" class="spider_int_input spider_free_version_label" /> px
                        <div class="spider_description spider_free_version">This option is disabled in free version.</div>
                      </td>
                    </tr>
                    <tr id="tr_popup_hit_counter">
                      <td class="spider_label_options spider_free_version_label">
                        <label>Display hit counter:</label>
                      </td>
                      <td>
                        <input disabled="disabled" type="radio" name="popup_hit_counter" id="popup_hit_counter_1" value="1" <?php if ($row->popup_hit_counter) echo 'checked="checked"'; ?> /><label for="popup_hit_counter_1">Yes</label>
                        <input disabled="disabled" type="radio" name="popup_hit_counter" id="popup_hit_counter_0" value="0" <?php if (!$row->popup_hit_counter) echo 'checked="checked"'; ?> /><label for="popup_hit_counter_0">No</label>
                        <div class="spider_description spider_free_version">This option is disabled in free version.</div>
                      </td>
                    </tr>
                    <tr>
                      <td class="spider_label_options">
                        <label> Show Next / Previous buttons:</label>
                      </td>
                      <td>
                        <input type="radio" name="autohide_lightbox_navigation" id="autohide_lightbox_navigation_1" value="1" <?php if ($row->autohide_lightbox_navigation ) echo 'checked="checked"'; ?> /><label for="autohide_lightbox_navigation_1">On hover</label>
                        <input type="radio" name="autohide_lightbox_navigation" id="autohide_lightbox_navigation_0" value="0" <?php if (!$row->autohide_lightbox_navigation ) echo 'checked="checked"'; ?> /><label for="autohide_lightbox_navigation_0">Always</label>
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr>
                      <td class="spider_label_options">
                        <label>Enable control buttons:</label>
                      </td>
                      <td>
                        <input type="radio" name="popup_enable_ctrl_btn" id="popup_enable_ctrl_btn_1" value="1" <?php if ($row->popup_enable_ctrl_btn) echo 'checked="checked"'; ?> onClick="bwg_enable_disable('', 'tr_popup_fullscreen', 'popup_enable_ctrl_btn_1');
                                                                                                                                                                                             bwg_enable_disable('', 'tr_popup_info', 'popup_enable_ctrl_btn_1');
                                                                                                                                                                                             bwg_enable_disable('', 'tr_popup_comment', 'popup_enable_ctrl_btn_1');
                                                                                                                                                                                             bwg_enable_disable('', 'tr_popup_facebook', 'popup_enable_ctrl_btn_1');
                                                                                                                                                                                             bwg_enable_disable('', 'tr_popup_twitter', 'popup_enable_ctrl_btn_1');
                                                                                                                                                                                             bwg_enable_disable('', 'tr_popup_google', 'popup_enable_ctrl_btn_1');
                                                                                                                                                                                             bwg_enable_disable('', 'tr_popup_pinterest', 'popup_enable_ctrl_btn_1');
                                                                                                                                                                                             bwg_enable_disable('', 'tr_popup_tumblr', 'popup_enable_ctrl_btn_1');
                                                                                                                                                                                             bwg_enable_disable('', 'tr_comment_moderation', 'comment_moderation_1');
                                                                                                                                                                                             bwg_enable_disable('', 'tr_popup_email', 'popup_enable_ctrl_btn_1');
                                                                                                                                                                                             bwg_enable_disable('', 'tr_popup_captcha', 'popup_enable_ctrl_btn_1');
                                                                                                                                                                                             bwg_enable_disable('', 'tr_popup_download', 'popup_enable_ctrl_btn_1');
                                                                                                                                                                                             bwg_enable_disable('', 'tr_popup_fullsize_image', 'popup_enable_ctrl_btn_1');" /><label for="popup_enable_ctrl_btn_1">Yes</label>
                        <input type="radio" name="popup_enable_ctrl_btn" id="popup_enable_ctrl_btn_0" value="0" <?php if (!$row->popup_enable_ctrl_btn) echo 'checked="checked"'; ?> onClick="bwg_enable_disable('none', 'tr_popup_fullscreen', 'popup_enable_ctrl_btn_0');
                                                                                                                                                                                             bwg_enable_disable('none', 'tr_popup_info', 'popup_enable_ctrl_btn_0');
                                                                                                                                                                                             bwg_enable_disable('none', 'tr_popup_comment', 'popup_enable_ctrl_btn_0');
                                                                                                                                                                                             bwg_enable_disable('none', 'tr_popup_facebook', 'popup_enable_ctrl_btn_0');
                                                                                                                                                                                             bwg_enable_disable('none', 'tr_popup_twitter', 'popup_enable_ctrl_btn_0');
                                                                                                                                                                                             bwg_enable_disable('none', 'tr_popup_google', 'popup_enable_ctrl_btn_0');
                                                                                                                                                                                             bwg_enable_disable('none', 'tr_popup_pinterest', 'popup_enable_ctrl_btn_0');
                                                                                                                                                                                             bwg_enable_disable('none', 'tr_popup_tumblr', 'popup_enable_ctrl_btn_0');
                                                                                                                                                                                             bwg_enable_disable('none', 'tr_comment_moderation', 'comment_moderation_0');
                                                                                                                                                                                             bwg_enable_disable('none', 'tr_popup_email', 'popup_enable_ctrl_btn_0');
                                                                                                                                                                                             bwg_enable_disable('none', 'tr_popup_captcha', 'popup_enable_ctrl_btn_0');
                                                                                                                                                                                             bwg_enable_disable('none', 'tr_popup_download', 'popup_enable_ctrl_btn_0');
                                                                                                                                                                                             bwg_enable_disable('none', 'tr_popup_fullsize_image', 'popup_enable_ctrl_btn_0');" /><label for="popup_enable_ctrl_btn_0">No</label>
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr id="tr_popup_fullscreen">
                      <td class="spider_label_options">
                        <label>Enable fullscreen:</label>
                      </td>
                      <td>
                        <input type="radio" name="popup_enable_fullscreen" id="popup_enable_fullscreen_1" value="1" <?php if ($row->popup_enable_fullscreen) echo 'checked="checked"'; ?> /><label for="popup_enable_fullscreen_1">Yes</label>
                        <input type="radio" name="popup_enable_fullscreen" id="popup_enable_fullscreen_0" value="0" <?php if (!$row->popup_enable_fullscreen) echo 'checked="checked"'; ?> /><label for="popup_enable_fullscreen_0">No</label>
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr id="tr_popup_info">
                      <td class="spider_label_options">
                        <label>Enable info:</label>
                      </td>
                      <td>
                        <input type="radio" name="popup_enable_info" id="popup_enable_info_1" value="1" <?php if ($row->popup_enable_info) echo 'checked="checked"'; ?> /><label for="popup_enable_info_1">Yes</label>
                        <input type="radio" name="popup_enable_info" id="popup_enable_info_0" value="0" <?php if (!$row->popup_enable_info) echo 'checked="checked"'; ?> /><label for="popup_enable_info_0">No</label>
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr id="tr_popup_info_always_show">
                      <td class="spider_label_options">
                        <label>Display info by default:</label>
                      </td>
                      <td>
                        <input type="radio" name="popup_info_always_show" id="popup_info_always_show_1" value="1" <?php if ($row->popup_info_always_show) echo 'checked="checked"'; ?> /><label for="popup_info_always_show_1">Yes</label>
                        <input type="radio" name="popup_info_always_show" id="popup_info_always_show_0" value="0" <?php if (!$row->popup_info_always_show) echo 'checked="checked"'; ?> /><label for="popup_info_always_show_0">No</label>
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr id="tr_popup_info_full_width">
                      <td class="spider_label_options">
                        <label>Full width info:</label>
                      </td>
                      <td>
                        <input type="radio" name="popup_info_full_width" id="popup_info_full_width_1" value="1" <?php if ($row->popup_info_full_width) echo 'checked="checked"'; ?>  /><label for="popup_info_full_width_1">Yes</label>
                        <input type="radio" name="popup_info_full_width" id="popup_info_full_width_0" value="0" <?php if (!$row->popup_info_full_width) echo 'checked="checked"'; ?>  /><label for="popup_info_full_width_0">No</label>
                        <div class="spider_description">Display image information based on the lightbox dimensions.</div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
              <td style="width: 50%; vertical-align: top;">
                <table style="display: inline-table;">
                  <tbody>
                    <tr id="tr_popup_rate">
                      <td class="spider_label_options spider_free_version_label">
                        <label>Enable rating:</label>
                      </td>
                      <td>
                        <input disabled="disabled" type="radio" name="popup_enable_rate" id="popup_enable_rate_1" value="1" <?php if ($row->popup_enable_rate) echo 'checked="checked"'; ?> /><label for="popup_enable_rate_1">Yes</label>
                        <input disabled="disabled" type="radio" name="popup_enable_rate" id="popup_enable_rate_0" value="0" <?php if (!$row->popup_enable_rate) echo 'checked="checked"'; ?> /><label for="popup_enable_rate_0">No</label>
                        <div class="spider_description spider_free_version">This option is disabled in free version.</div>
                      </td>
                    </tr>
                    <tr id="tr_popup_comment">
                      <td class="spider_label_options spider_free_version_label">
                        <label>Enable comments:</label>
                      </td>
                      <td>
                        <input disabled="disabled" type="radio" name="popup_enable_comment" id="popup_enable_comment_1" value="1" <?php if ($row->popup_enable_comment) echo 'checked="checked"'; ?> onClick="bwg_enable_disable('', 'tr_comment_moderation', 'popup_enable_comment_1');
                                                                                                                                                                                          bwg_enable_disable('', 'tr_popup_email', 'popup_enable_comment_1');
                                                                                                                                                                                          bwg_enable_disable('', 'tr_popup_captcha', 'popup_enable_comment_1');" /><label for="popup_enable_comment_1">Yes</label>
                        <input disabled="disabled" type="radio" name="popup_enable_comment" id="popup_enable_comment_0" value="0" <?php if (!$row->popup_enable_comment) echo 'checked="checked"'; ?> onClick="bwg_enable_disable('none', 'tr_comment_moderation', 'popup_enable_comment_0');
                                                                                                                                                                                           bwg_enable_disable('none', 'tr_popup_email', 'popup_enable_comment_0');
                                                                                                                                                                                            bwg_enable_disable('none', 'tr_popup_captcha', 'popup_enable_comment_0');" /><label for="popup_enable_comment_0">No</label>
                        <div class="spider_description spider_free_version">This option is disabled in free version.</div>
                      </td>
                    </tr>
                    <tr id="tr_comment_moderation">
                      <td class="spider_label_options spider_free_version_label">
                        <label>Enable comments moderation:</label>
                      </td>
                      <td>
                        <input disabled="disabled" type="radio" name="comment_moderation" id="comment_moderation_1" value="1" <?php if ($row->comment_moderation) echo 'checked="checked"'; ?> /><label for="comment_moderation_1">Yes</label>
                        <input disabled="disabled" type="radio" name="comment_moderation" id="comment_moderation_0" value="0" <?php if (!$row->comment_moderation) echo 'checked="checked"'; ?> /><label for="comment_moderation_0">No</label>
                        <div class="spider_description spider_free_version">This option is disabled in free version.</div>
                      </td>
                    </tr>
                    <tr id="tr_popup_email">
                      <td class="spider_label_options spider_free_version_label">
                        <label>Enable Email for comments:</label>
                      </td>
                      <td>
                        <input disabled="disabled" type="radio" name="popup_enable_email" id="popup_enable_email_1" value="1" <?php if ($row->popup_enable_email) echo 'checked="checked"'; ?> /><label for="popup_enable_email_1">Yes</label>
                        <input disabled="disabled" type="radio" name="popup_enable_email" id="popup_enable_email_0" value="0" <?php if (!$row->popup_enable_email) echo 'checked="checked"'; ?> /><label for="popup_enable_email_0">No</label>
                        <div class="spider_description spider_free_version">This option is disabled in free version.</div>
                      </td>
                    </tr>
                    <tr id="tr_popup_captcha">
                      <td class="spider_label_options spider_free_version_label">
                        <label>Enable Captcha for comments:</label>
                      </td>
                      <td>
                        <input disabled="disabled" type="radio" name="popup_enable_captcha" id="popup_enable_captcha_1" value="1" <?php if ($row->popup_enable_captcha) echo 'checked="checked"'; ?> /><label for="popup_enable_captcha_1">Yes</label>
                        <input disabled="disabled" type="radio" name="popup_enable_captcha" id="popup_enable_captcha_0" value="0" <?php if (!$row->popup_enable_captcha) echo 'checked="checked"'; ?> /><label for="popup_enable_captcha_0">No</label>
                        <div class="spider_description spider_free_version">This option is disabled in free version.</div>
                      </td>
                    </tr>
                    <tr id="tr_popup_fullsize_image">
                      <td class="spider_label_options">
                        <label>Enable original image display button:</label>
                      </td>
                      <td>
                        <input type="radio" name="popup_enable_fullsize_image" id="popup_enable_fullsize_image_1" value="1" <?php if ($row->popup_enable_fullsize_image) echo 'checked="checked"'; ?> /><label for="popup_enable_fullsize_image_1">Yes</label>
                        <input type="radio" name="popup_enable_fullsize_image" id="popup_enable_fullsize_image_0" value="0" <?php if (!$row->popup_enable_fullsize_image) echo 'checked="checked"'; ?> /><label for="popup_enable_fullsize_image_0">No</label>
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr id="tr_popup_download">
                      <td class="spider_label_options">
                        <label>Enable download button:</label>
                      </td>
                      <td>
                        <input type="radio" name="popup_enable_download" id="popup_enable_download_1" value="1" <?php if ($row->popup_enable_download) echo 'checked="checked"'; ?> /><label for="popup_enable_download_1">Yes</label>
                        <input type="radio" name="popup_enable_download" id="popup_enable_download_0" value="0" <?php if (!$row->popup_enable_download) echo 'checked="checked"'; ?> /><label for="popup_enable_download_0">No</label>
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr id="tr_popup_facebook">
                      <td class="spider_label_options spider_free_version_label">
                        <label>Enable Facebook button:</label>
                      </td>
                      <td>
                        <input disabled="disabled" type="radio" name="popup_enable_facebook" id="popup_enable_facebook_1" value="1" <?php if ($row->popup_enable_facebook) echo 'checked="checked"'; ?> /><label for="popup_enable_facebook_1">Yes</label>
                        <input disabled="disabled" type="radio" name="popup_enable_facebook" id="popup_enable_facebook_0" value="0" <?php if (!$row->popup_enable_facebook) echo 'checked="checked"'; ?> /><label for="popup_enable_facebook_0">No</label>
                        <div class="spider_description spider_free_version">This option is disabled in free version.</div>
                      </td>
                    </tr>
                    <tr id="tr_popup_twitter">
                      <td class="spider_label_options spider_free_version_label">
                        <label>Enable Twitter button:</label>
                      </td>
                      <td>
                        <input disabled="disabled" type="radio" name="popup_enable_twitter" id="popup_enable_facebook_1" value="1" <?php if ($row->popup_enable_twitter) echo 'checked="checked"'; ?> /><label for="popup_enable_twitter_1">Yes</label>
                        <input disabled="disabled" type="radio" name="popup_enable_twitter" id="popup_enable_facebook_0" value="0" <?php if (!$row->popup_enable_twitter) echo 'checked="checked"'; ?> /><label for="popup_enable_twitter_0">No</label>
                        <div class="spider_description spider_free_version">This option is disabled in free version.</div>
                      </td>
                    </tr>
                    <tr id="tr_popup_google">
                      <td class="spider_label_options spider_free_version_label">
                        <label>Enable Google+ button:</label>
                      </td>
                      <td>
                        <input disabled="disabled" type="radio" name="popup_enable_google" id="popup_enable_google_1" value="1" <?php if ($row->popup_enable_google) echo 'checked="checked"'; ?> /><label for="popup_enable_google_1">Yes</label>
                        <input disabled="disabled" type="radio" name="popup_enable_google" id="popup_enable_google_0" value="0" <?php if (!$row->popup_enable_google) echo 'checked="checked"'; ?> /><label for="popup_enable_google_0">No</label>
                        <div class="spider_description spider_free_version">This option is disabled in free version.</div>
                      </td>
                    </tr>
                    <tr id="tr_popup_pinterest">
                      <td class="spider_label_options spider_free_version_label">
                        <label>Enable Pinterest button:</label>
                      </td>
                      <td>
                        <input disabled="disabled" type="radio" name="popup_enable_pinterest" id="popup_enable_pinterest_1" value="1" <?php if ($row->popup_enable_pinterest) echo 'checked="checked"'; ?> /><label for="popup_enable_pinterest_1">Yes</label>
                        <input disabled="disabled" type="radio" name="popup_enable_pinterest" id="popup_enable_pinterest_0" value="0" <?php if (!$row->popup_enable_pinterest) echo 'checked="checked"'; ?> /><label for="popup_enable_pinterest_0">No</label>
                        <div class="spider_description spider_free_version">This option is disabled in free version.</div>
                      </td>
                    </tr>
                    <tr id="tr_popup_tumblr">
                      <td class="spider_label_options spider_free_version_label">
                        <label>Enable Tumblr button:</label>
                      </td>
                      <td>
                        <input disabled="disabled" type="radio" name="popup_enable_tumblr" id="popup_enable_tumblr_1" value="1" <?php if ($row->popup_enable_tumblr) echo 'checked="checked"'; ?> /><label for="popup_enable_tumblr_1">Yes</label>
                        <input disabled="disabled" type="radio" name="popup_enable_tumblr" id="popup_enable_tumblr_0" value="0" <?php if (!$row->popup_enable_tumblr) echo 'checked="checked"'; ?> /><label for="popup_enable_tumblr_0">No</label>
                        <div class="spider_description spider_free_version">This option is disabled in free version.</div>
                      </td>
                    </tr>
                    <tr id="tr_image_count">
                      <td class="spider_label_options">
                        <label>Show images count:</label>
                      </td>
                      <td>
                        <input type="radio" name="show_image_counts" id="show_image_counts_current_image_number_1" value="1" <?php if ($row->show_image_counts) echo 'checked="checked"'; ?> /><label for="show_image_counts_current_image_number_1">Yes</label>
                        <input type="radio" name="show_image_counts" id="show_image_counts_current_image_number_0" value="0" <?php if (!$row->show_image_counts) echo 'checked="checked"'; ?> /><label for="show_image_counts_current_image_number_0">No</label>
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
          </table>
        </div>

        <!--Album options-->
        <div class="spider_div_options" id="div_content_4">        
          <table>
            <tbody>
              <tr>
                <td class="spider_label_options">
                  <label for="album_column_number">Number of album columns: </label>
                </td>
                <td>
                  <input type="text" name="album_column_number" id="album_column_number" value="<?php echo $row->album_column_number; ?>" class="spider_int_input" />
                  <div class="spider_description"></div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options">
                  <label for="albums_per_page">Albums per page: </label>
                </td>
                <td>
                  <input type="text" name="albums_per_page" id="albums_per_page" value="<?php echo $row->albums_per_page; ?>" class="spider_int_input" />
                  <div class="spider_description"></div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options">
                  <label>Enable pagination:</label>
                </td>
                <td>
                  <input type="radio" name="album_enable_page" id="album_enable_page_1" value="1" <?php if ($row->album_enable_page) echo 'checked="checked"'; ?> /><label for="album_enable_page_1">Yes</label>
                  <input type="radio" name="album_enable_page" id="album_enable_page_0" value="0" <?php if (!$row->album_enable_page) echo 'checked="checked"'; ?> /><label for="album_enable_page_0">No</label>
                  <div class="spider_description"></div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options">
                  <label>Album view type:</label>
                </td>
                <td>
                  <input disabled="disabled" type="radio" name="album_view_type" id="album_view_type_1" value="thumbnail" <?php if ($row->album_view_type == "thumbnail") echo 'checked="checked"'; ?> /><label for="album_view_type_1">Thumbnail</label>
                  <input disabled="disabled" type="radio" name="album_view_type" id="album_view_type_0" value="masonry" <?php if ($row->album_view_type == "masonry") echo 'checked="checked"'; ?> /><label for="album_view_type_0">Masonry</label>
                  <div class="spider_description spider_free_version">This option is disabled in free version.</div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options">
                  <label>Show title:</label>
                </td>
                <td>
                  <input type="radio" name="album_title_show_hover" id="album_title_show_hover_1" value="hover" <?php if ($row->album_title_show_hover == "hover") echo 'checked="checked"'; ?> /><label for="album_title_show_hover_1">Show on hover</label><br />
                  <input type="radio" name="album_title_show_hover" id="album_title_show_hover_0" value="show" <?php if ($row->album_title_show_hover == "show") echo 'checked="checked"'; ?> /><label for="album_title_show_hover_0">Always show</label><br />
                  <input type="radio" name="album_title_show_hover" id="album_title_show_hover_2" value="none" <?php if ($row->album_title_show_hover == "none") echo 'checked="checked"'; ?> /><label for="album_title_show_hover_2">Don't show</label>
                  <div class="spider_description"></div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options">
                  <label>Show album/gallery name:</label>
                </td>
                <td>
                  <input type="radio" name="show_album_name_enable" id="show_album_name_enable_1" value="1" <?php if ($row->show_album_name) echo 'checked="checked"'; ?> /><label for="show_album_name_enable_1">Yes</label>
                  <input type="radio" name="show_album_name_enable" id="show_album_name_enable_0" value="0" <?php if (!$row->show_album_name) echo 'checked="checked"'; ?> /><label for="show_album_name_enable_0">No</label>
                  <div class="spider_description"></div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options">
                  <label>Enable extended album description:</label>
                </td>
                <td>
                  <input type="radio" name="extended_album_description_enable" id="extended_album_description_enable_1" value="1" <?php if ($row->extended_album_description_enable) echo 'checked="checked"'; ?> /><label for="extended_album_description_enable_1">Yes</label>
                  <input type="radio" name="extended_album_description_enable" id="extended_album_description_enable_0" value="0" <?php if (!$row->extended_album_description_enable) echo 'checked="checked"'; ?> /><label for="extended_album_description_enable_0">No</label>
                  <div class="spider_description"></div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options">
                  <label for="album_thumb_width">Album thumbnail dimensions: </label>
                </td>
                <td>
                  <input type="text" name="album_thumb_width" id="album_thumb_width" value="<?php echo $row->album_thumb_width; ?>" class="spider_int_input" /> x 
                  <input type="text" name="album_thumb_height" id="album_thumb_height" value="<?php echo $row->album_thumb_height; ?>" class="spider_int_input" /> px
                  <div class="spider_description"></div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options">
                  <label for="extended_album_height">Extended album height: </label>
                </td>
                <td>
                  <input type="text" name="extended_album_height" id="extended_album_height" value="<?php echo $row->extended_album_height; ?>" class="spider_int_input" /> px
                  <div class="spider_description"></div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!--Slideshow-->
        <div class="spider_div_options" id="div_content_5">
          <table style="width: 100%;">
            <tr>
              <td style="width: 50%; vertical-align: top;">
                <table style="display: inline-table;">
                  <tbody>
                    <tr>
                      <td class="spider_label_options">
                        <label for="slideshow_type">Slideshow effect: </label>
                      </td>
                      <td>
                        <select name="slideshow_type" id="slideshow_type" style="width:150px;">
                          <?php
                          foreach ($effects as $key => $effect) {
                            ?>
                            <option value="<?php echo $key; ?>" <?php echo ($key != 'none' && $key != 'fade') ? 'disabled="disabled" title="This effect is disabled in free version."' : ''; ?> <?php if ($row->slideshow_type == $key) echo 'selected="selected"'; ?>><?php echo $effect; ?></option>
                            <?php
                          }
                          ?>
                        </select>
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr>
                      <td class="spider_label_options">
                        <label for="slideshow_interval">Time interval: </label>
                      </td>
                      <td>
                        <input type="text" name="slideshow_interval" id="slideshow_interval" value="<?php echo $row->slideshow_interval; ?>" class="spider_int_input" /> sec.
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr>
                      <td class="spider_label_options">
                        <label for="slideshow_width">Slideshow dimensions: </label>
                      </td>
                      <td>
                        <input type="text" name="slideshow_width" id="slideshow_width" value="<?php echo $row->slideshow_width; ?>" class="spider_int_input" /> x 
                        <input type="text" name="slideshow_height" id="slideshow_height" value="<?php echo $row->slideshow_height; ?>" class="spider_int_input" /> px
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr>
                      <td class="spider_label_options">
                        <label>Enable autoplay: </label>
                      </td>
                      <td>
                        <input type="radio" name="slideshow_enable_autoplay" id="slideshow_enable_autoplay_yes" value="1" <?php if ($row->slideshow_enable_autoplay) echo 'checked="checked"'; ?> /><label for="slideshow_enable_autoplay_yes">Yes</label>
                        <input type="radio" name="slideshow_enable_autoplay" id="slideshow_enable_autoplay_no" value="0" <?php if (!$row->slideshow_enable_autoplay) echo 'checked="checked"'; ?> /><label for="slideshow_enable_autoplay_no">No</label>
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr>
                      <td class="spider_label_options">
                        <label>Enable shuffle: </label>
                      </td>
                      <td>
                        <input type="radio" name="slideshow_enable_shuffle" id="slideshow_enable_shuffle_yes" value="1" <?php if ($row->slideshow_enable_shuffle) echo 'checked="checked"'; ?> /><label for="slideshow_enable_shuffle_yes">Yes</label>
                        <input type="radio" name="slideshow_enable_shuffle" id="slideshow_enable_shuffle_no" value="0" <?php if (!$row->slideshow_enable_shuffle) echo 'checked="checked"'; ?> /><label for="slideshow_enable_shuffle_no">No</label>
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr>
                      <td class="spider_label_options">
                        <label> Show Next / Previous buttons:</label>
                      </td>
                      <td>
                        <input type="radio" name="autohide_slideshow_navigation" id="autohide_slideshow_navigation_1" value="1" <?php if ($row->autohide_slideshow_navigation) echo 'checked="checked"'; ?> /><label for="autohide_slideshow_navigation_1">On hover</label>
                        <input type="radio" name="autohide_slideshow_navigation" id="autohide_slideshow_navigation_0" value="0" <?php if (!$row->autohide_slideshow_navigation) echo 'checked="checked"'; ?> /><label for="autohide_slideshow_navigation_0">Always</label>
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr>
                      <td class="spider_label_options">
                        <label>Enable control buttons: </label>
                      </td>
                      <td>
                        <input type="radio" name="slideshow_enable_ctrl" id="slideshow_enable_ctrl_yes" value="1" <?php if ($row->slideshow_enable_ctrl) echo 'checked="checked"'; ?> /><label for="slideshow_enable_ctrl_yes">Yes</label>
                        <input type="radio" name="slideshow_enable_ctrl" id="slideshow_enable_ctrl_no" value="0" <?php if (!$row->slideshow_enable_ctrl) echo 'checked="checked"'; ?> /><label for="slideshow_enable_ctrl_no">No</label>
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr>
                      <td class="spider_label_options spider_free_version_label"><label>Enable slideshow filmstrip: </label></td>
                      <td>
                        <input disabled="disabled" type="radio" name="slideshow_enable_filmstrip" id="slideshow_enable_filmstrip_yes" value="1" <?php if ($row->slideshow_enable_filmstrip) echo 'checked="checked"'; ?> onClick="bwg_enable_disable('', 'tr_slideshow_filmstrip_height', 'slideshow_enable_filmstrip_yes')" /><label for="slideshow_enable_filmstrip_yes">Yes</label>
                        <input disabled="disabled" type="radio" name="slideshow_enable_filmstrip" id="slideshow_enable_filmstrip_no" value="0" <?php if (!$row->slideshow_enable_filmstrip) echo 'checked="checked"'; ?> onClick="bwg_enable_disable('none', 'tr_slideshow_filmstrip_height', 'slideshow_enable_filmstrip_no')" /><label for="slideshow_enable_filmstrip_no">No</label>
                        <div class="spider_description spider_free_version">This option is disabled in free version.</div>
                      </td>
                    </tr>
                    <tr id="tr_slideshow_filmstrip_height">
                      <td class="spider_label_options spider_free_version_label"><label for="slideshow_filmstrip_height">Slideshow filmstrip size: </label></td>
                      <td class="spider_free_version_label">
                        <input disabled="disabled" type="text" name="slideshow_filmstrip_height" id="slideshow_filmstrip_height" value="<?php echo $row->slideshow_filmstrip_height; ?>" class="spider_int_input spider_free_version_label" /> px
                        <div class="spider_description spider_free_version">This option is disabled in free version.</div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
              <td style="width: 50%; vertical-align: top;">
                <table style="width: 100%; display: inline-table;">
                  <tbody>
                    <tr>
                      <td class="spider_label_options"><label>Enable image title: </label></td>
                      <td>
                        <input type="radio" name="slideshow_enable_title" id="slideshow_enable_title_yes" value="1" <?php if ($row->slideshow_enable_title) echo 'checked="checked"'; ?> onClick="bwg_enable_disable('', 'tr_slideshow_title_position', 'slideshow_enable_title_yes')" /><label for="slideshow_enable_title_yes">Yes</label>
                        <input type="radio" name="slideshow_enable_title" id="slideshow_enable_title_no" value="0" <?php if (!$row->slideshow_enable_title) echo 'checked="checked"'; ?> onClick="bwg_enable_disable('none', 'tr_slideshow_title_position', 'slideshow_enable_title_no')" /><label for="slideshow_enable_title_no">No</label>
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr id="tr_slideshow_title_position">
                      <td class="spider_label_options"><label>Title position: </label></td>
                      <td>
                        <table class="bwg_position_table">
                          <tbody>
                            <tr>
                              <td><input type="radio" value="top-left" id="slideshow_title_topLeft" name="slideshow_title_position" <?php if ($row->slideshow_title_position == "top-left") echo 'checked="checked"'; ?>></td>
                              <td><input type="radio" value="top-center" id="slideshow_title_topCenter" name="slideshow_title_position" <?php if ($row->slideshow_title_position == "top-center") echo 'checked="checked"'; ?>></td>
                              <td><input type="radio" value="top-right" id="slideshow_title_topRight" name="slideshow_title_position" <?php if ($row->slideshow_title_position == "top-right") echo 'checked="checked"'; ?>></td>
                            </tr>
                            <tr>
                              <td><input type="radio" value="middle-left" id="slideshow_title_midLeft" name="slideshow_title_position" <?php if ($row->slideshow_title_position == "middle-left") echo 'checked="checked"'; ?>></td>
                              <td><input type="radio" value="middle-center" id="slideshow_title_midCenter" name="slideshow_title_position" <?php if ($row->slideshow_title_position == "middle-center") echo 'checked="checked"'; ?>></td>
                              <td><input type="radio" value="middle-right" id="slideshow_title_midRight" name="slideshow_title_position" <?php if ($row->slideshow_title_position == "middle-right") echo 'checked="checked"'; ?>></td>
                            </tr>
                            <tr>
                              <td><input type="radio" value="bottom-left" id="slideshow_title_botLeft" name="slideshow_title_position" <?php if ($row->slideshow_title_position == "bottom-left") echo 'checked="checked"'; ?>></td>
                              <td><input type="radio" value="bottom-center" id="slideshow_title_botCenter" name="slideshow_title_position" <?php if ($row->slideshow_title_position == "bottom-center") echo 'checked="checked"'; ?>></td>
                              <td><input type="radio" value="bottom-right" id="slideshow_title_botRight" name="slideshow_title_position" <?php if ($row->slideshow_title_position == "bottom-right") echo 'checked="checked"'; ?>></td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="spider_description">Image title position on slideshow</div>
                      </td>
                    </tr>
                    <tr id="tr_slideshow_full_width_title">
                      <td class="spider_label_options">
                        <label>Full width title:</label>
                      </td>
                      <td>
                        <input type="radio" name="slideshow_title_full_width" id="slideshow_title_full_width_1" value="1" <?php if ($row->slideshow_title_full_width) echo 'checked="checked"'; ?>  /><label for="slideshow_title_full_width_1">Yes</label>
                        <input type="radio" name="slideshow_title_full_width" id="slideshow_title_full_width_0" value="0" <?php if (!$row->slideshow_title_full_width) echo 'checked="checked"'; ?>  /><label for="slideshow_title_full_width_0">No</label>
                        <div class="spider_description">Display image title based on the slideshow dimensions.</div>
                      </td>
                    </tr>
                    <tr>
                      <td class="spider_label_options"><label>Enable image description: </label></td>
                      <td>
                        <input type="radio" name="slideshow_enable_description" id="slideshow_enable_description_yes" value="1" <?php if ($row->slideshow_enable_description) echo 'checked="checked"'; ?> onClick="bwg_enable_disable('', 'tr_slideshow_description_position', 'slideshow_enable_description_yes')" /><label for="slideshow_enable_description_yes">Yes</label>
                        <input type="radio" name="slideshow_enable_description" id="slideshow_enable_description_no" value="0" <?php if (!$row->slideshow_enable_description) echo 'checked="checked"'; ?> onClick="bwg_enable_disable('none', 'tr_slideshow_description_position', 'slideshow_enable_description_no')" /><label for="slideshow_enable_description_no">No</label>
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr id="tr_slideshow_description_position">
                      <td class="spider_label"><label>Description position: </label></td>
                      <td>
                        <table class="bwg_position_table">
                          <tbody>
                            <tr>
                              <td><input type="radio" value="top-left" id="slideshow_description_topLeft" name="slideshow_description_position" <?php if ($row->slideshow_description_position == "top-left") echo 'checked="checked"'; ?>></td>
                              <td><input type="radio" value="top-center" id="slideshow_description_topCenter" name="slideshow_description_position" <?php if ($row->slideshow_description_position == "top-center") echo 'checked="checked"'; ?>></td>
                              <td><input type="radio" value="top-right" id="slideshow_description_topRight" name="slideshow_description_position" <?php if ($row->slideshow_description_position == "top-right") echo 'checked="checked"'; ?>></td>
                            </tr>
                            <tr>
                              <td><input type="radio" value="middle-left" id="slideshow_description_midLeft" name="slideshow_description_position" <?php if ($row->slideshow_description_position == "middle-left") echo 'checked="checked"'; ?>></td>
                              <td><input type="radio" value="middle-center" id="slideshow_description_midCenter" name="slideshow_description_position" <?php if ($row->slideshow_description_position == "middle-center") echo 'checked="checked"'; ?>></td>
                              <td><input type="radio" value="middle-right" id="slideshow_description_midRight" name="slideshow_description_position" <?php if ($row->slideshow_description_position == "middle-right") echo 'checked="checked"'; ?>></td>
                            </tr>
                            <tr>
                              <td><input type="radio" value="bottom-left" id="slideshow_description_botLeft" name="slideshow_description_position" <?php if ($row->slideshow_description_position == "bottom-left") echo 'checked="checked"'; ?>></td>
                              <td><input type="radio" value="bottom-center" id="slideshow_description_botCenter" name="slideshow_description_position" <?php if ($row->slideshow_description_position == "bottom-center") echo 'checked="checked"'; ?>></td>
                              <td><input type="radio" value="bottom-right" id="slideshow_description_botRight" name="slideshow_description_position" <?php if ($row->slideshow_description_position == "bottom-right") echo 'checked="checked"'; ?>></td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="spider_description">Image description position on slideshow</div>
                      </td>
                    </tr>
                    <tr>
                      <td class="spider_label_options">
                        <label>Enable slideshow Music: </label>
                      </td>
                      <td>
                        <input type="radio" name="slideshow_enable_music" id="slideshow_enable_music_yes" value="1" <?php if ($row->slideshow_enable_music) echo 'checked="checked"'; ?> onClick="bwg_enable_disable('', 'tr_slideshow_music_url', 'slideshow_enable_music_yes')" /><label for="slideshow_enable_music_yes">Yes</label>
                        <input type="radio" name="slideshow_enable_music" id="slideshow_enable_music_no" value="0" <?php if (!$row->slideshow_enable_music) echo 'checked="checked"'; ?> onClick="bwg_enable_disable('none', 'tr_slideshow_music_url', 'slideshow_enable_music_no')"  /><label for="slideshow_enable_music_no">No</label>
                        <div class="spider_description"></div>
                      </td>
                    </tr>
                    <tr id="tr_slideshow_music_url">
                      <td class="spider_label_options">
                        <label for="slideshow_audio_url">Music url: </label>
                      </td>
                      <td>
                        <input type="text" id="slideshow_audio_url" name="slideshow_audio_url" style="width: 70%;" value="<?php echo $row->slideshow_audio_url; ?>" style="display:inline-block;" />
                        <?php
                        $query_url = add_query_arg(array('action' => 'addMusic', 'width' => '700', 'height' => '550', 'extensions' => 'aac,m4a,f4a,mp3,ogg,oga', 'callback' => 'bwg_add_music'), admin_url('admin-ajax.php'));
                        $query_url = wp_nonce_url( $query_url, 'addMusic', 'bwg_nonce' );
                        $query_url = add_query_arg(array('TB_iframe' => '1'), $query_url );
                        ?>
                        <a href="<?php echo $query_url; ?>" id="button_add_music" class="button-primary thickbox thickbox-preview"
                           title="Add music"
                           onclick="return false;"
                           style="margin-bottom:5px;">
                          Add Music
                        </a>
                        <div class="spider_description">Only .aac,.m4a,.f4a,.mp3,.ogg,.oga formats are supported.</div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
          </table>
        </div>

        <!--Thumbnail options-->
        <div class="spider_div_options" id="div_content_6">        
          <table>
            <tbody>
              <tr style="display:none;">
                <td class="spider_label_options">
                  <label>Masonry:</label>
                </td>
                <td>
                  <input type="radio" name="masonry" id="masonry_1" value="horizontal" <?php if ($row->masonry == "horizontal") echo 'checked="checked"'; ?> /><label for="masonry_1">Horizontal</label>
                  <input type="radio" name="masonry" id="masonry_0" value="vertical" <?php if ($row->masonry == "vertical") echo 'checked="checked"'; ?> /><label for="masonry_0">Vertical</label>
                  <div class="spider_description"></div>
                </td>
              </tr>
	      <tr style="display:none;">
                <td class="spider_label_options">
                  <label>Mosaic:</label>
                </td>
                <td>
                  <input type="radio" name="mosaic" id="mosaic_0" value="vertical" <?php if ($row->mosaic == "vertical") echo 'checked="checked"'; ?> /><label for="mosaic_0">Vertical</label>
                  <input type="radio" name="mosaic" id="mosaic_1" value="horizontal" <?php if ($row->mosaic == "horizontal") echo 'checked="checked"'; ?> /><label for="mosaic_1">Horizontal</label>
                  <div class="spider_description"></div>
                </td>
              </tr>
              <tr style="display:none;">
                <td class="spider_label_options">
                  <label>Resizable mosaic:</label>
                </td>
                <td>
                  <input type="radio" name="resizable_mosaic" id="resizable_mosaic_0" value="0" <?php if ($row->resizable_mosaic == "0") echo 'checked="checked"'; ?> /><label for="resizable_mosaic_0">No</label>
                  <input type="radio" name="resizable_mosaic" id="resizable_mosaic_1" value="1" <?php if ($row->resizable_mosaic == "1") echo 'checked="checked"'; ?> /><label for="resizable_mosaic_1">Yes</label>
                  <div class="spider_description"></div>
                </td>
              </tr>
              <tr style="display:none;">
                <td class="spider_label_options">
                  <label for="mosaic_total_width">Total width of mosaic: </label>
                </td>
                <td>
                  <input type="text" name="mosaic_total_width" id="mosaic_total_width" value="<?php echo $row->mosaic_total_width; ?>" class="spider_int_input" /> %
                  <div class="spider_description">Width of mosaic as a percentage of container's width.</div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options">
                  <label for="image_column_number">Number of image columns: </label>
                </td>
                <td>
                  <input type="text" name="image_column_number" id="image_column_number" value="<?php echo $row->image_column_number; ?>" class="spider_int_input" />
                  <div class="spider_description"></div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options">
                  <label for="images_per_page">Images per page: </label>
                </td>
                <td>
                  <input type="text" name="images_per_page" id="images_per_page" value="<?php echo $row->images_per_page; ?>" class="spider_int_input" />
                  <div class="spider_description"></div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options">
                  <label for="upload_thumb_width">Generated thumbnail dimensions: </label>
                </td>
                <td>
                  <input type="text" name="upload_thumb_width" id="upload_thumb_width" value="<?php echo $row->upload_thumb_width; ?>" class="spider_int_input" /> x 
                  <input type="text" name="upload_thumb_height" id="upload_thumb_height" value="<?php echo $row->upload_thumb_height; ?>" class="spider_int_input" /> px
                  <div class="spider_description">The maximum size of the generated thumbnail. Its dimensions should be larger than the ones of the frontend thumbnail.</div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options">
                  <label for="thumb_width">Frontend thumbnail dimensions: </label>
                </td>
                <td>
                  <input type="text" name="thumb_width" id="thumb_width" value="<?php echo $row->thumb_width; ?>" class="spider_int_input" /> x 
                  <input type="text" name="thumb_height" id="thumb_height" value="<?php echo $row->thumb_height; ?>" class="spider_int_input" /> px
                  <div class="spider_description">The default size of the thumbnail which will be displayed in the website.</div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options">
                  <label>Show image title:</label>
                </td>
                <td>
                  <input type="radio" name="image_title_show_hover" id="image_title_show_hover_1" value="hover" <?php if ($row->image_title_show_hover == "hover") echo 'checked="checked"'; ?> /><label for="image_title_show_hover_1">Show on hover</label><br />
                  <input type="radio" name="image_title_show_hover" id="image_title_show_hover_0" value="show" <?php if ($row->image_title_show_hover == "show") echo 'checked="checked"'; ?> /><label for="image_title_show_hover_0">Always show</label><br />
                  <input type="radio" name="image_title_show_hover" id="image_title_show_hover_2" value="none" <?php if ($row->image_title_show_hover == "none") echo 'checked="checked"'; ?> /><label for="image_title_show_hover_2">Don't show</label>
                  <div class="spider_description"></div>
                </td>
              </tr>
              <tr id="tr_thumb_show_name">
                <td class="spider_label_options"><label>Show gallery name: </label></td>
                <td>
                  <input type="radio" name="thumb_name" id="thumb_name_yes" value="1" <?php if ($row->showthumbs_name) echo 'checked="checked"'; ?> /><label for="thumb_name_yes">Yes</label>
                  <input type="radio" name="thumb_name" id="thumb_name_no" value="0"  <?php if (!$row->showthumbs_name) echo 'checked="checked"'; ?> /><label for="thumb_name_no">No</label>
                  <div class="spider_description"></div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options spider_free_version_label">
                  <label>Show description in Vertical Masonry view: </label>
                </td>
                <td>
                  <input disabled="disabled" type="radio" name="show_masonry_thumb_description" id="masonry_thumb_desc_1" value="1" <?php if ($row->show_masonry_thumb_description) echo 'checked="checked"'; ?> /><label for="masonry_thumb_desc_1">Yes</label>
                  <input disabled="disabled" type="radio" name="show_masonry_thumb_description" id="masonry_thumb_desc_0" value="0" <?php if (!$row->show_masonry_thumb_description) echo 'checked="checked"'; ?> /><label for="masonry_thumb_desc_0">No</label>
                  <div style="width: 200px;" class="spider_description spider_free_version">This option is disabled in free version.</div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options"><label>Enable image pagination: </label></td>
                <td>
                  <input type="radio" name="image_enable_page" id="image_enable_page_yes" value="1" <?php if ($row->image_enable_page) echo 'checked="checked"'; ?> /><label for="image_enable_page_yes">Yes</label>
                  <input type="radio" name="image_enable_page" id="image_enable_page_no" value="0" <?php if (!$row->image_enable_page) echo 'checked="checked"'; ?> /><label for="image_enable_page_no">No</label>
                  <div class="spider_description"></div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options"><label>Thumbnail click action: </label></td>
                <td>
                  <input type="radio" name="thumb_click_action" id="thumb_click_action_1" value="open_lightbox" <?php if ($row->thumb_click_action == 'open_lightbox') echo 'checked="checked"'; ?> onClick="bwg_enable_disable('none', 'tr_thumb_link_target', 'thumb_click_action_1')" /><label for="thumb_click_action_1">Open lightbox</label>
                  <input type="radio" name="thumb_click_action" id="thumb_click_action_2" value="redirect_to_url" <?php if ($row->thumb_click_action == 'redirect_to_url') echo 'checked="checked"'; ?> onClick="bwg_enable_disable('', 'tr_thumb_link_target', 'thumb_click_action_2')" /><label for="thumb_click_action_2">Redirect to url</label>
                  <div class="spider_description"></div>
                </td>
              </tr>
              <tr id="tr_thumb_link_target">
                <td class="spider_label_options"><label>Open in a new window: </label></td>
                <td>
                  <input type="radio" name="thumb_link_target" id="thumb_link_target_yes" value="1" <?php if ($row->thumb_link_target) echo 'checked="checked"'; ?> /><label for="thumb_link_target_yes">Yes</label>
                  <input type="radio" name="thumb_link_target" id="thumb_link_target_no" value="0" <?php if (!$row->thumb_link_target) echo 'checked="checked"'; ?> /><label for="thumb_link_target_no">No</label>
                  <div class="spider_description"></div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options"><label>Play icon over the video thumbnail: </label></td>
                <td>
                  <input type="radio" name="play_icon" id="play_icon_yes" value="1" <?php if ($row->play_icon) echo 'checked="checked"'; ?> /><label for="play_icon_yes">Yes</label>
                  <input type="radio" name="play_icon" id="play_icon_no" value="0" <?php if (!$row->play_icon) echo 'checked="checked"'; ?> /><label for="play_icon_no">No</label>
                  <div class="spider_description"></div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!--Image options-->
        <div class="spider_div_options" id="div_content_7">        
          <table>
            <tbody>
              <tr>
                <td class="spider_label_options">
                  <label>Enable image title for Image Browser view:</label>
                </td>
                <td>
                  <input type="radio" name="image_browser_title_enable" id="image_browser_title_enable_1" value="1" <?php if ($row->image_browser_title_enable) echo 'checked="checked"'; ?> /><label for="image_browser_title_enable_1">Yes</label>
                  <input type="radio" name="image_browser_title_enable" id="image_browser_title_enable_0" value="0" <?php if (!$row->image_browser_title_enable) echo 'checked="checked"'; ?> /><label for="image_browser_title_enable_0">No</label>
                  <div class="spider_description"></div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options">
                  <label>Enable image description for Image Browser view:</label>
                </td>
                <td>
                  <input type="radio" name="image_browser_description_enable" id="image_browser_description_enable_1" value="1" <?php if ($row->image_browser_description_enable) echo 'checked="checked"'; ?> /><label for="image_browser_description_enable_1">Yes</label>
                  <input type="radio" name="image_browser_description_enable" id="image_browser_description_enable_0" value="0" <?php if (!$row->image_browser_description_enable) echo 'checked="checked"'; ?> /><label for="image_browser_description_enable_0">No</label>
                  <div class="spider_description"></div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options">
                  <label for="image_browser_width">Image width for Image Browser view:</label>
                </td>
                <td>
                  <input type="text" name="image_browser_width" id="image_browser_width" value="<?php echo $row->image_browser_width; ?>" class="spider_int_input" /> px
                  <div class="spider_description"></div>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <div style="margin: 0;" class="spider_description spider_free_version">The Blog Style view is disabled in free version.</div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options spider_free_version_label">
                  <label>Enable image title for Blog Style view:</label>
                </td>
                <td class="spider_free_version_label">
                  <input disabled="disabled" type="radio" name="blog_style_title_enable" id="blog_style_title_enable_1" value="1" <?php if ($row->blog_style_title_enable) echo 'checked="checked"'; ?> /><label for="blog_style_title_enable_1">Yes</label>
                  <input disabled="disabled" type="radio" name="blog_style_title_enable" id="blog_style_title_enable_0" value="0" <?php if (!$row->blog_style_title_enable) echo 'checked="checked"'; ?> /><label for="blog_style_title_enable_0">No</label>
                  <div class="spider_description"></div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options spider_free_version_label">
                  <label for="blog_style_width">Image width for Blog Style view:</label>
                </td>
                <td class="spider_free_version_label">
                  <input disabled="disabled" type="text" name="blog_style_width" id="blog_style_width" value="<?php echo $row->blog_style_width; ?>" class="spider_int_input spider_free_version_label" /> px
                  <div class="spider_description"></div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options spider_free_version_label">
                  <label for="blog_style_images_per_page">Images per page in Blog Style view:</label>
                </td>
                <td class="spider_free_version_label">
                  <input disabled="disabled" type="text" name="blog_style_images_per_page" id="blog_style_images_per_page" value="<?php echo $row->blog_style_images_per_page; ?>" class="spider_int_input spider_free_version_label" />
                  <div class="spider_description"></div>
                </td>
              </tr>
              <tr>
                <td class="spider_label_options spider_free_version_label">
                  <label>Enable pagination for Blog Style view:</label>
                </td>
                <td class="spider_free_version_label">
                  <input disabled="disabled" type="radio" name="blog_style_enable_page" id="blog_style_enable_page_1" value="1" <?php if ($row->blog_style_enable_page) echo 'checked="checked"'; ?> /><label for="blog_style_enable_page_1">Yes</label>
                  <input disabled="disabled" type="radio" name="blog_style_enable_page" id="blog_style_enable_page_0" value="0" <?php if (!$row->blog_style_enable_page) echo 'checked="checked"'; ?> /><label for="blog_style_enable_page_0">No</label>
                  <div class="spider_description"></div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!--Embed options-->
        <div class="spider_div_options" id="div_content_9">
          <table>
            <tbody>
              <tr>
                <td class="spider_label_options spider_free_version_label">
                  <label >Gallery autoupdate interval:</label>
                </td>
                <td class="spider_free_version_label">
                  <input type="number" disabled="disabled" id="autoupdate_interval_hour" class="spider_int_input" min="0" max="24" value="0" />
                  hour
                  <input type="number" disabled="disabled" id="autoupdate_interval_min" class="spider_int_input" min="0" max="59" value="30" />
                  min
                  <div class="spider_description spider_free_version">Autoupdatable galleries are disabled in free version.</div>
                </td>
              </tr>
              
              <tr>
                <td class="spider_label_options spider_free_version_label">
                  <label>Instagram CLIENT ID:</label>
                </td>
                <td class="spider_free_version_label">
                  <input id="instagram_client_id" type="text" disabled="disabled" style="display:inline-block; width:100%;" value="" />
                 <div class="spider_description spider_free_version">Instagram galleries are disabled in free version.</div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>


      </div>
              
      <input id="task" name="task" type="hidden" value="" />
      <input id="current_id" name="current_id" type="hidden" value="<?php echo $row->id; ?>" />
      <script>
        window.onload = bwg_change_option_type('<?php echo isset($_POST['type']) ? esc_html($_POST['type']) : '1'; ?>');
        window.onload = bwg_inputs();
        window.onload = bwg_watermark('watermark_type_<?php echo $row->watermark_type ?>');
        window.onload = bwg_built_in_watermark('watermark_type_<?php echo $row->built_in_watermark_type ?>');
        window.onload = bwg_popup_fullscreen(<?php echo $row->popup_fullscreen; ?>);
        window.onload = bwg_enable_disable(<?php echo $row->show_search_box ? "'', 'tr_search_box_width', 'show_search_box_1'" : "'none', 'tr_search_box_width', 'show_search_box_0'" ?>);
        window.onload = bwg_enable_disable(<?php echo $row->preload_images ? "'', 'tr_preload_images_count', 'preload_images_1'" : "'none', 'tr_preload_images_count', 'preload_images_0'" ?>);
        window.onload = bwg_enable_disable(<?php echo $row->popup_enable_ctrl_btn ? "'', 'tr_popup_fullscreen', 'popup_enable_ctrl_btn_1'" : "'none', 'tr_popup_fullscreen', 'popup_enable_ctrl_btn_0'" ?>);
        window.onload = bwg_enable_disable(<?php echo $row->popup_enable_ctrl_btn ? "'', 'tr_popup_info', 'popup_enable_ctrl_btn_1'" : "'none', 'tr_popup_info', 'popup_enable_ctrl_btn_0'" ?>);
        window.onload = bwg_enable_disable(<?php echo $row->popup_enable_ctrl_btn ? "'', 'tr_popup_download', 'popup_enable_ctrl_btn_1'" : "'none', 'tr_popup_download', 'popup_enable_ctrl_btn_0'" ?>);
        window.onload = bwg_enable_disable(<?php echo $row->popup_enable_ctrl_btn ? "'', 'tr_popup_fullsize_image', 'popup_enable_ctrl_btn_1'" : "'none', 'tr_popup_fullsize_image', 'popup_enable_ctrl_btn_0'" ?>);
        window.onload = bwg_enable_disable(<?php echo $row->popup_enable_ctrl_btn ? "'', 'tr_popup_comment', 'popup_enable_ctrl_btn_1'" : "'none', 'tr_popup_comment', 'popup_enable_ctrl_btn_0'" ?>);
        window.onload = bwg_enable_disable(<?php echo $row->popup_enable_ctrl_btn ? ($row->popup_enable_comment ? "'', 'tr_comment_moderation', 'popup_enable_comment_1'" : "'none', 'tr_comment_moderation', 'popup_enable_comment_0'") : "'none', 'tr_comment_moderation', 'popup_enable_comment_0'" ?>);
        window.onload = bwg_enable_disable(<?php echo $row->popup_enable_ctrl_btn ? ($row->popup_enable_comment ? "'', 'tr_popup_email', 'popup_enable_comment_1'" : "'none', 'tr_popup_email', 'popup_enable_comment_0'") : "'none', 'tr_popup_email', 'popup_enable_comment_0'" ?>);
        window.onload = bwg_enable_disable(<?php echo $row->popup_enable_ctrl_btn ? ($row->popup_enable_comment ? "'', 'tr_popup_captcha', 'popup_enable_comment_1'" : "'none', 'tr_popup_captcha', 'popup_enable_comment_0'") : "'none', 'tr_popup_captcha', 'popup_enable_comment_0'" ?>);
        window.onload = bwg_enable_disable(<?php echo $row->popup_enable_ctrl_btn ? "'', 'tr_popup_facebook', 'popup_enable_ctrl_btn_1'" : "'none', 'tr_popup_facebook', 'popup_enable_ctrl_btn_0'" ?>);
        window.onload = bwg_enable_disable(<?php echo $row->popup_enable_ctrl_btn ? "'', 'tr_popup_twitter', 'popup_enable_ctrl_btn_1'" : "'none', 'tr_popup_twitter', 'popup_enable_ctrl_btn_0'" ?>);
        window.onload = bwg_enable_disable(<?php echo $row->popup_enable_ctrl_btn ? "'', 'tr_popup_google', 'popup_enable_ctrl_btn_1'" : "'none', 'tr_popup_google', 'popup_enable_ctrl_btn_0'" ?>);
        window.onload = bwg_enable_disable(<?php echo $row->popup_enable_ctrl_btn ? "'', 'tr_popup_pinterest', 'popup_enable_ctrl_btn_1'" : "'none', 'tr_popup_pinterest', 'popup_enable_ctrl_btn_0'" ?>);
        window.onload = bwg_enable_disable(<?php echo $row->popup_enable_ctrl_btn ? "'', 'tr_popup_thumblr', 'popup_enable_ctrl_btn_1'" : "'none', 'tr_popup_thumblr', 'popup_enable_ctrl_btn_0'" ?>);
        window.onload = bwg_enable_disable(<?php echo $row->popup_enable_filmstrip ? "'', 'tr_popup_filmstrip_height', 'popup_enable_filmstrip_1'" : "'none', 'tr_popup_filmstrip_height', 'popup_enable_filmstrip_0'" ?>);
        window.onload = bwg_enable_disable(<?php echo $row->slideshow_enable_filmstrip ? "'', 'tr_slideshow_filmstrip_height', 'slideshow_enable_filmstrip_yes'" : "'none', 'tr_slideshow_filmstrip_height', 'slideshow_enable_filmstrip_no'" ?>);
        window.onload = bwg_enable_disable(<?php echo $row->slideshow_enable_title ? "'', 'tr_slideshow_title_position', 'slideshow_enable_title_yes'" : "'none', 'tr_slideshow_title_position', 'slideshow_enable_title_no'" ?>);
        window.onload = bwg_enable_disable(<?php echo $row->slideshow_enable_description ? "'', 'tr_slideshow_description_position', 'slideshow_enable_description_yes'" : "'none', 'tr_slideshow_description_position', 'slideshow_enable_description_no'" ?>);
        window.onload = bwg_enable_disable(<?php echo $row->slideshow_enable_music ? "'', 'tr_slideshow_music_url', 'slideshow_enable_music_yes'" : "'none', 'tr_slideshow_music_url', 'slideshow_enable_music_no'" ?>);
        window.onload = bwg_enable_disable(<?php echo $row->thumb_click_action == 'open_lightbox' ? "'none', 'tr_thumb_link_target', 'thumb_click_action_1'" : "'', 'tr_thumb_link_target', 'thumb_click_action_2'" ?>);
        window.onload = preview_watermark();
        window.onload = preview_built_in_watermark();
      </script>
    </form>
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