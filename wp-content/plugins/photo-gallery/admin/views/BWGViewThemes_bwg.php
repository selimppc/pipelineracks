<?php

class  BWGViewThemes_bwg {
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
    $rows_data = $this->model->get_rows_data();
    $page_nav = $this->model->page_nav();
    $search_value = ((isset($_POST['search_value'])) ? esc_html($_POST['search_value']) : '');
    $search_select_value = ((isset($_POST['search_select_value'])) ? (int)$_POST['search_select_value'] : 0);
    $asc_or_desc = ((isset($_POST['asc_or_desc'])) ? esc_html($_POST['asc_or_desc']) : 'asc');
    $order_by = (isset($_POST['order_by']) ? esc_html($_POST['order_by']) : 'id');
    $order_class = 'manage-column column-title sorted ' . $asc_or_desc;
    $ids_string = '';
    $per_page = $this->model->per_page();
	$pager = 0;
    ?>
    <div style="clear: both; float: left; width: 99%;">
      <div style="float:left; font-size: 14px; font-weight: bold;">
        This section allows you to create, edit and delete themes.
        <a style="color: blue; text-decoration: none;" target="_blank" href="http://web-dorado.com/wordpress-gallery-guide-step-6/6-1.html">Read More in User Manual</a>
        <?php
        if (get_option("wd_bwg_theme_version")) {
          ?>
          <br />
          This feature is disabled for the non-commercial version.
          <?php
        }
        ?>
      </div>
      <div style="float: right; text-align: right;">
        <a style="text-decoration: none;" target="_blank" href="http://web-dorado.com/products/wordpress-photo-gallery-plugin.html">
          <img width="215" border="0" alt="web-dorado.com" src="<?php echo WD_BWG_URL . '/images/logo.png'; ?>" />
        </a>
      </div>
    </div>
    <?php
    if (get_option("wd_bwg_theme_version")) {
      ?>
      <div style="clear: both; float: left; width: 97%;">
        <img style="max-width: 100%;" src="<?php echo WD_BWG_URL . '/images/theme_thumbnails.png'; ?>" />
        <img style="max-width: 100%;" src="<?php echo WD_BWG_URL . '/images/theme_masonry.png'; ?>" />
        <img style="max-width: 100%;" src="<?php echo WD_BWG_URL . '/images/theme_slideshow.png'; ?>" />
        <img style="max-width: 100%;" src="<?php echo WD_BWG_URL . '/images/theme_image_browser.png'; ?>" />
        <img style="max-width: 100%;" src="<?php echo WD_BWG_URL . '/images/theme_compact_album.png'; ?>" />
        <img style="max-width: 100%;" src="<?php echo WD_BWG_URL . '/images/theme_extended_album.png'; ?>" />
        <img style="max-width: 100%;" src="<?php echo WD_BWG_URL . '/images/theme_blog_style.png'; ?>" />
        <img style="max-width: 100%;" src="<?php echo WD_BWG_URL . '/images/theme_lightbox.png'; ?>" />
        <img style="max-width: 100%;" src="<?php echo WD_BWG_URL . '/images/theme_page_navigation.png'; ?>" />
      </div>
      <?php
      die();
    }
    ?>
    <form class="wrap" id="themes_form" method="post" action="admin.php?page=themes_bwg" style="float: left; width: 99%;">
      <?php wp_nonce_field( 'themes_bwg', 'bwg_nonce' ); ?>
      <span class="theme_icon"></span>
      <h2>
        Themes
        <a href="" class="add-new-h2" onclick="spider_set_input_value('task', 'add');
                                               spider_form_submit(event, 'themes_form')">Add new</a>
      </h2>
      <div class="buttons_div">
        <input class="button-secondary" type="submit" onclick="if (confirm('Do you want to delete selected items?')) {
                                                       spider_set_input_value('task', 'delete_all');
                                                     } else {
                                                       return false;
                                                     }" value="Delete"/>
      </div>
      <div class="tablenav top">
        <?php
        WDWLibrary::search('Title', $search_value, 'themes_form');
        WDWLibrary::html_page_nav($page_nav['total'], $pager++, $page_nav['limit'], 'themes_form', $per_page);
        ?>
      </div>
      <table class="wp-list-table widefat fixed pages">
        <thead>
          <th class="manage-column column-cb check-column table_small_col"><input id="check_all" type="checkbox" style="margin:0;"/></th>
          <th class="table_small_col <?php if ($order_by == 'id') { echo $order_class; } ?>">
            <a onclick="spider_set_input_value('task', '');
              spider_set_input_value('order_by', 'id');
              spider_set_input_value('asc_or_desc', '<?php echo ((isset($_POST['asc_or_desc']) && isset($_POST['order_by']) && (esc_html($_POST['order_by']) == 'id') && esc_html($_POST['asc_or_desc']) == 'asc') ? 'desc' : 'asc'); ?>');
              spider_form_submit(event, 'themes_form')" href="">
              <span>ID</span><span class="sorting-indicator"></span></a>
          </th>
          <th class="<?php if ($order_by == 'name') { echo $order_class; } ?>">
            <a onclick="spider_set_input_value('task', '');
              spider_set_input_value('order_by', 'name');
              spider_set_input_value('asc_or_desc', '<?php echo ((isset($_POST['asc_or_desc']) && isset($_POST['order_by']) && (esc_html($_POST['order_by']) == 'title') && esc_html($_POST['asc_or_desc']) == 'asc') ? 'desc' : 'asc'); ?>');
              spider_form_submit(event, 'themes_form')" href="">
              <span>Name</span><span class="sorting-indicator"></span></a>
          </th>
          <th class="table_big_col <?php if ($order_by == 'default_theme') { echo $order_class; } ?>">
            <a onclick="spider_set_input_value('task', '');
              spider_set_input_value('order_by', 'default_theme');
              spider_set_input_value('asc_or_desc', '<?php echo ((isset($_POST['asc_or_desc']) && isset($_POST['order_by']) && (esc_html($_POST['order_by']) == 'default_theme') && esc_html($_POST['asc_or_desc']) == 'asc') ? 'desc' : 'asc'); ?>');
              spider_form_submit(event, 'themes_form')" href="">
              <span>Default</span><span class="sorting-indicator"></span></a>
          </th>
          <th class="table_big_col">Edit</th>
          <th class="table_big_col">Delete</th>
        </thead>
        <tbody id="tbody_arr">
          <?php
          if ($rows_data) {
            foreach ($rows_data as $row_data) {
              $alternate = (!isset($alternate) || $alternate == 'class="alternate"') ? '' : 'class="alternate"';
              $default_image = (($row_data->default_theme) ? 'default' : 'notdefault');
              $default = (($row_data->default_theme) ? '' : 'setdefault');
              ?>
              <tr id="tr_<?php echo $row_data->id; ?>" <?php echo $alternate; ?>>
                <td class="table_small_col check-column">
                  <input id="check_<?php echo $row_data->id; ?>" name="check_<?php echo $row_data->id; ?>" type="checkbox"/>
                </td>
                <td class="table_small_col"><?php echo $row_data->id; ?></td>
                <td>
                  <a onclick="spider_set_input_value('task', 'edit');
                              spider_set_input_value('current_id', '<?php echo $row_data->id; ?>');
                              spider_form_submit(event, 'themes_form')" href="" title="Edit"><?php echo $row_data->name; ?></a>
                </td>
                <td class="table_big_col">
                  <?php
                  if ($default != '') {
                    ?>
                    <a onclick="spider_set_input_value('task', '<?php echo $default; ?>');
                                spider_set_input_value('current_id', '<?php echo $row_data->id; ?>');
                                spider_form_submit(event, 'themes_form')" href="">
                    <?php
                  }
                  ?>
                  <img src="<?php echo WD_BWG_URL . '/images/' . $default_image . '.png'; ?>" />
                  <?php
                  if ($default != '') {
                    ?>
                    </a>
                    <?php
                    }
                  ?>
                </td>
                <td class="table_big_col">
                  <a onclick="spider_set_input_value('task', 'edit');
                              spider_set_input_value('current_id', '<?php echo $row_data->id; ?>');
                              spider_form_submit(event, 'themes_form')" href="">Edit</a>
                </td>
                <td class="table_big_col">
                  <a onclick="spider_set_input_value('task', 'delete');
                              spider_set_input_value('current_id', '<?php echo $row_data->id; ?>');
                              spider_form_submit(event, 'themes_form')" href="">Delete</a>
                </td>
              </tr>
              <?php
              $ids_string .= $row_data->id . ',';
            }
          }
          ?>
        </tbody>
      </table>
      <div class="tablenav bottom">
        <?php
        WDWLibrary::html_page_nav($page_nav['total'], $pager++, $page_nav['limit'], 'themes_form', $per_page);
        ?>
      </div>
      <input id="task" name="task" type="hidden" value=""/>
      <input id="current_id" name="current_id" type="hidden" value=""/>
      <input id="ids_string" name="ids_string" type="hidden" value="<?php echo $ids_string; ?>"/>
      <input id="asc_or_desc" name="asc_or_desc" type="hidden" value="asc"/>
      <input id="order_by" name="order_by" type="hidden" value="<?php echo $order_by; ?>"/>
    </form>
    <?php
  }

  public function edit($id, $reset) {
    $row = $this->model->get_row_data($id, $reset);
    $page_title = (($id != 0) ? 'Edit theme ' . $row->name : 'Create new theme');
    $current_type = WDWLibrary::get('current_type', 'Thumbnail');
    $border_styles = array(
      'none' => 'None',
      'solid' => 'Solid',
      'dotted' => 'Dotted',
      'dashed' => 'Dashed',
      'double' => 'Double',
      'groove' => 'Groove',
      'ridge' => 'Ridge',
      'inset' => 'Inset',
      'outset' => 'Outset',
    );
    $font_families = array(
      'arial' => 'Arial',
      'lucida grande' => 'Lucida grande',
      'segoe ui' => 'Segoe ui',
      'tahoma' => 'Tahoma',
      'trebuchet ms' => 'Trebuchet ms',
      'verdana' => 'Verdana',
      'cursive' =>'Cursive',
      'fantasy' => 'Fantasy',
      'monospace' => 'Monospace',
      'serif' => 'Serif',
    );
    $aligns = array(
      'left' => 'Left',
      'center' => 'Center',
      'right' => 'Right',
    );
    $font_weights = array(
      'lighter' => 'Lighter',
      'normal' => 'Normal',
      'bold' => 'Bold',
    );
    $hover_effects = array(
      'none' => 'None',
      'rotate' => 'Rotate',
      'scale' => 'Scale',
      'skew' => 'Skew',
    );
    $button_styles = array(
      'fa-chevron' => 'Chevron',
      'fa-angle' => 'Angle',
      'fa-angle-double' => 'Double',
    );
    $rate_icons = array(
      'star' => 'Star',
      'bell' => 'Bell',
      'circle' => 'Circle',
      'flag' => 'Flag',
      'heart' => 'Heart',
      'square' => 'Square',
    );
    ?>
   <div style="clear: both; float: left; width: 99%;">
      <div style="float:left; font-size: 14px; font-weight: bold;">
        This section allows you to add/edit theme.
        <a style="color: blue; text-decoration: none;" target="_blank" href="http://web-dorado.com/wordpress-gallery-guide-step-6/6-1.html">Read More in User Manual</a>
      </div>
      <div style="float: right; text-align: right;">
        <a style="text-decoration: none;" target="_blank" href="http://web-dorado.com/products/wordpress-photo-gallery-plugin.html">
          <img width="215" border="0" alt="web-dorado.com" src="<?php echo WD_BWG_URL . '/images/logo.png'; ?>" />
        </a>
      </div>
    </div>
    <form class="wrap" method="post" action="admin.php?page=themes_bwg" style="float: left; width: 99%;">
      <?php wp_nonce_field( 'themes_bwg', 'bwg_nonce' ); ?>
      <span class="theme_icon"></span>
      <h2><?php echo $page_title; ?></h2>
      <div style="float: right; margin: 0 5px 0 0;">
        <input class="button-secondary" type="submit" onclick="if (spider_check_required('name', 'Name')) {return false;}; spider_set_input_value('task', 'save')" value="Save"/>
        <input class="button-secondary" type="submit" onclick="if (spider_check_required('name', 'Name')) {return false;}; spider_set_input_value('task', 'apply')" value="Apply"/>
        <input class="button-secondary" type="submit" onclick="spider_set_input_value('task', 'cancel')" value="Cancel"/>
        <input title="Reset to default theme" class="button-primary" type="submit" onclick="if (confirm('Do you want to reset to default?')) {
                                                                 spider_set_input_value('task', 'reset');
                                                               } else {
                                                                 return false;
                                                               }" value="Reset"/>
      </div>
      <div style="float: left; margin: 10px 0 0; display: none;" id="type_menu">
        <div id="type_Thumbnail" class="theme_type" onclick="bwg_change_theme_type('Thumbnail')">Thumbnails</div>
        <div id="type_Masonry" class="theme_type" style="opacity: 0.4; filter: Alpha(opacity=40);" title="This tab is disabled in free version">Masonry</div>
        <div id="type_Mosaic" class="theme_type" style="opacity: 0.4; filter: Alpha(opacity=40);" title="This tab is disabled in free version">Mosaic</div>
        <div id="type_Slideshow" class="theme_type" onclick="bwg_change_theme_type('Slideshow')">Slideshow</div>
        <div id="type_Image_browser" class="theme_type" onclick="bwg_change_theme_type('Image_browser')">Image Browser</div>
        <div id="type_Compact_album" class="theme_type" onclick="bwg_change_theme_type('Compact_album')">Compact Album</div>
        <div id="type_Masonry_album" class="theme_type" style="opacity: 0.4; filter: Alpha(opacity=40);" title="This tab is disabled in free version">Masonry Album</div>
        <div id="type_Extended_album" class="theme_type" onclick="bwg_change_theme_type('Extended_album')">Extended Album</div>
        <div id="type_Blog_style" class="theme_type" style="opacity: 0.4; filter: Alpha(opacity=40);" title="This tab is disabled in free version">Blog Style</div>
        <div id="type_Lightbox" class="theme_type" onclick="bwg_change_theme_type('Lightbox')">Lightbox</div>
        <div id="type_Navigation" class="theme_type" onclick="bwg_change_theme_type('Navigation')">Page Navigation</div>
        <input type="hidden" id="current_type" name="current_type" value="<?php echo $current_type; ?>" />
      </div>
      <fieldset class="spider_fieldset">
        <legend>Parameters</legend>
        <table style="clear:both;">
          <tbody>
          <tr>
            <td class="spider_label"><label for="name">Name: <span style="color:#FF0000;"> * </span> </label></td>
            <td><input type="text" id="name" name="name" value="<?php echo $row->name; ?>" class="spider_text_input"/></td>
          </tr>
          </tbody>
        </table>

        <fieldset class="spider_type_fieldset" id="Thumbnail">
          <fieldset class="spider_child_fieldset" id="Thumbnail_1">
            <table style="clear:both;">
              <tbody>
                <tr>
                  <td class="spider_label"><label for="thumb_margin">Margin: </label></td>
                  <td>
                    <input type="text" name="thumb_margin" id="thumb_margin" value="<?php echo $row->thumb_margin; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="thumb_padding">Padding: </label></td>
                  <td>
                    <input type="text" name="thumb_padding" id="thumb_padding" value="<?php echo $row->thumb_padding; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="thumb_border_width">Border width: </label></td>
                  <td>
                    <input type="text" name="thumb_border_width" id="thumb_border_width" value="<?php echo $row->thumb_border_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="thumb_border_style">Border style: </label></td>
                  <td>
                    <select name="thumb_border_style" id="thumb_border_style">
                      <?php
                      foreach ($border_styles as $key => $border_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->thumb_border_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $border_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="thumb_border_color">Border color:</label></td>
                  <td>
                    <input type="text" name="thumb_border_color" id="thumb_border_color" value="<?php echo $row->thumb_border_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="thumb_border_radius">Border radius: </label></td>
                  <td>
                    <input type="text" name="thumb_border_radius" id="thumb_border_radius" value="<?php echo $row->thumb_border_radius; ?>" class="spider_char_input" />
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="thumb_box_shadow">Shadow: </label></td>
                  <td>
                    <input type="text" name="thumb_box_shadow" id="thumb_box_shadow" value="<?php echo $row->thumb_box_shadow; ?>" class="spider_box_input" />
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="thumb_hover_effect">Hover effect: </label></td>
                  <td>
                    <select name="thumb_hover_effect" id="thumb_hover_effect" class="spider_int_input">
                      <?php
                      foreach ($hover_effects as $key => $hover_effect) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->thumb_hover_effect == $key) ? 'selected="selected"' : ''); ?>><?php echo $hover_effect; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="thumb_hover_effect_value">Hover effect value: </label></td>
                  <td>
                    <input type="text" name="thumb_hover_effect_value" id="thumb_hover_effect_value" value="<?php echo $row->thumb_hover_effect_value; ?>" class="spider_char_input"/>
                    <div class="spider_description">E.g. Rotate: 10deg, Scale: 1.5, Skew: 10deg.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label>Transition: </label></td>
                  <td id="thumb_transition">
                    <input type="radio" name="thumb_transition" id="thumb_transition1" value="1"<?php if ($row->thumb_transition == 1) echo 'checked="checked"'; ?> />
                    <label for="thumb_transition1" id="thumb_transition1_lbl">Yes</label>
                    <input type="radio" name="thumb_transition" id="thumb_transition0" value="0"<?php if ($row->thumb_transition == 0) echo 'checked="checked"'; ?> />
                    <label for="thumb_transition0" id="thumb_transition0_lbl">No</label>
                  </td>
                </tr>
              </tbody>
            </table>
          </fieldset>
          <fieldset class="spider_child_fieldset" id="Thumbnail_2">
            <table style="clear:both;">
              <tbody>
                <tr>
                  <td class="spider_label">
                    <label for="thumb_bg_color">Thumbnail background color: </label>
                  </td>
                  <td>
                    <input type="text" name="thumb_bg_color" id="thumb_bg_color" value="<?php echo $row->thumb_bg_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="thumb_transparent">Thumbnail transparency: </label></td>
                  <td>
                    <input type="text" name="thumb_transparent" id="thumb_transparent" value="<?php echo $row->thumb_transparent; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> %
                    <div class="spider_description">Value must be between 0 to 100.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="thumbs_bg_color">Full background color: </label></td>
                  <td>
                    <input type="text" name="thumbs_bg_color" id="thumbs_bg_color" value="<?php echo $row->thumbs_bg_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="thumb_bg_transparent">Full background transparency: </label></td>
                  <td>
                    <input type="text" name="thumb_bg_transparent" id="thumb_bg_transparent" value="<?php echo $row->thumb_bg_transparent; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> %
                    <div class="spider_description">Value must be between 0 to 100.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="thumb_align">Alignment: </label></td>
                  <td>
                    <select name="thumb_align" id="thumb_align">
                      <?php
                      foreach ($aligns as $key => $align) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->thumb_align == $key) ? 'selected="selected"' : ''); ?>><?php echo $align; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
              </tbody>
            </table>
          </fieldset>
          <fieldset class="spider_child_fieldset" id="Thumbnail_3">
            <table style="clear:both;">
              <tbody>
                <tr>
                  <td class="spider_label"><label>Title position: </label></td>
                  <td>
                    <input type="radio" name="thumb_title_pos" id="thumb_title_pos1" value="top" <?php if ($row->thumb_title_pos == "top") echo 'checked="checked"'; ?> />
                    <label for="thumb_title_pos1" id="thumb_title_pos1_lbl">Top</label>
                    <input type="radio" name="thumb_title_pos" id="thumb_title_pos0" value="bottom" <?php if ($row->thumb_title_pos == "bottom") echo 'checked="checked"'; ?> />
                    <label for="thumb_title_pos0" id="thumb_title_pos0_lbl">Bottom</label>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="thumb_title_font_size">Title font size: </label></td>
                  <td>
                    <input type="text" name="thumb_title_font_size" id="thumb_title_font_size" value="<?php echo $row->thumb_title_font_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="thumb_title_font_color">Title font color: </label></td>
                  <td>
                    <input type="text" name="thumb_title_font_color" id="thumb_title_font_color" value="<?php echo $row->thumb_title_font_color; ?>" class="color" />
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="thumb_title_font_style">Title font family: </label></td>
                  <td>
                    <select name="thumb_title_font_style" id="thumb_title_font_style">
                      <?php
                      foreach ($font_families as $key => $font_family) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->thumb_title_font_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $font_family; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="thumb_title_font_weight">Title font weight: </label></td>
                  <td>
                    <select name="thumb_title_font_weight" id="thumb_title_font_weight">
                      <?php
                      foreach ($font_weights as $key => $font_weight) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->thumb_title_font_weight == $key) ? 'selected="selected"' : ''); ?>><?php echo $font_weight; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="thumb_title_shadow">Title box shadow: </label></td>
                  <td>
                    <input type="text" name="thumb_title_shadow" id="thumb_title_shadow" value="<?php echo $row->thumb_title_shadow; ?>" class="spider_box_input" />
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="thumb_title_margin">Title margin: </label></td>
                  <td>
                    <input type="text" name="thumb_title_margin" id="thumb_title_margin" value="<?php echo $row->thumb_title_margin; ?>" class="spider_char_input" />
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
              </tbody>
            </table>
          </fieldset>
        </fieldset>

        <fieldset class="spider_type_fieldset" id="Masonry">
          <fieldset class="spider_child_fieldset" id="Masonry_1">
            <table style="clear:both;">
              <tbody>
                <tr>
                  <td class="spider_label"><label for="masonry_thumb_padding">Padding: </label></td>
                  <td>
                    <input type="text" name="masonry_thumb_padding" id="masonry_thumb_padding" value="<?php echo $row->masonry_thumb_padding; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="masonry_thumb_border_width">Border width: </label></td>
                  <td>
                    <input type="text" name="masonry_thumb_border_width" id="masonry_thumb_border_width" value="<?php echo $row->masonry_thumb_border_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="masonry_thumb_border_style">Border style: </label></td>
                  <td>
                    <select name="masonry_thumb_border_style" id="masonry_thumb_border_style">
                      <?php
                      foreach ($border_styles as $key => $border_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->masonry_thumb_border_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $border_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="masonry_thumb_border_color">Border color: </label></td>
                  <td>
                    <input type="text" name="masonry_thumb_border_color" id="masonry_thumb_border_color" value="<?php echo $row->masonry_thumb_border_color; ?>" class="color" />
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="masonry_thumb_border_radius">Border radius: </label></td>
                  <td>
                    <input type="text" name="masonry_thumb_border_radius" id="masonry_thumb_border_radius" value="<?php echo $row->masonry_thumb_border_radius; ?>" class="spider_char_input" />
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
              </tbody>
            </table>
          </fieldset>
          <fieldset class="spider_child_fieldset" id="Masonry_2">
            <table style="clear:both;">
              <tbody>
                <tr>
                  <td class="spider_label"><label for="masonry_thumb_transparent">Transparency: </label></td>
                  <td>
                    <input type="text" name="masonry_thumb_transparent" id="masonry_thumb_transparent" value="<?php echo $row->masonry_thumb_transparent; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> %
                    <div class="spider_description">Value must be between 0 to 100.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="masonry_thumbs_bg_color">Background color: </label></td>
                  <td>
                    <input type="text" name="masonry_thumbs_bg_color" id="masonry_thumbs_bg_color" value="<?php echo $row->masonry_thumbs_bg_color; ?>" class="color" />
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="masonry_thumb_bg_transparent">Background transparency: </label></td>
                  <td>
                    <input type="text" name="masonry_thumb_bg_transparent" id="masonry_thumb_bg_transparent" value="<?php echo $row->masonry_thumb_bg_transparent; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> %
                    <div class="spider_description">Value must be between 0 to 100.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="masonry_thumb_align0">Alignment: </label></td>
                  <td>
                    <select name="masonry_thumb_align" id="masonry_thumb_align">
                      <?php
                      foreach ($aligns as $key => $align) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->masonry_thumb_align == $key) ? 'selected="selected"' : ''); ?>><?php echo $align; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
              </tbody>
            </table>
          </fieldset>
          <fieldset class="spider_child_fieldset" id="Masonry_3">
            <table style="clear:both;">
              <tbody>
                <tr>
                  <td class="spider_label"><label for="masonry_thumb_hover_effect">Hover effect: </label></td>
                  <td>
                    <select name="masonry_thumb_hover_effect" id="masonry_thumb_hover_effect" class="spider_int_input">
                      <?php
                      foreach ($hover_effects as $key => $hover_effect) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->masonry_thumb_hover_effect == $key) ? 'selected="selected"' : ''); ?>><?php echo $hover_effect; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="masonry_thumb_hover_effect_value">Hover effect value: </label></td>
                  <td>
                    <input type="text" name="masonry_thumb_hover_effect_value" id="masonry_thumb_hover_effect_value" value="<?php echo $row->masonry_thumb_hover_effect_value; ?>" class="spider_char_input" />
                    <div class="spider_description">E.g. Rotate: 10deg, Scale: 1.5, Skew: 10deg.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label>Transition: </label></td>
                  <td id="masonry_thumb_transition">
                    <input type="radio" name="masonry_thumb_transition" id="masonry_thumb_transition1" value="1"<?php if ($row->masonry_thumb_transition == 1) echo 'checked="checked"'; ?> />
                    <label for="masonry_thumb_transition1" id="masonry_thumb_transition1_lbl">Yes</label>
                    <input type="radio" name="masonry_thumb_transition" id="masonry_thumb_transition0" value="0"<?php if ($row->masonry_thumb_transition == 0) echo 'checked="checked"'; ?> />
                    <label for="masonry_thumb_transition0" id="masonry_thumb_transition0_lbl">No</label>
                  </td>
                </tr>
		<tr>
                  <td class="spider_label"><label for="masonry_description_font_size">Description font size: </label></td>
                  <td>
                    <input type="text" name="masonry_description_font_size" id="masonry_description_font_size" value="<?php echo $row->masonry_description_font_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="masonry_description_color">Description font color: </label></td>
                  <td>
                    <input type="text" name="masonry_description_color" id="masonry_description_color" value="<?php echo $row->masonry_description_color; ?>" class="color" />
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="masonry_description_font_style">Description font family: </label></td>
                  <td>
                    <select name="masonry_description_font_style" id="masonry_description_font_style">
                      <?php
                      foreach ($font_families as $key => $font_family) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->masonry_description_font_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $font_family; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
              </tbody>
            </table>
          </fieldset>
        </fieldset>
        
        <fieldset class="spider_type_fieldset" id="Slideshow">
          <fieldset class="spider_child_fieldset" id="Slideshow_1">
            <table style="clear:both;">
              <tbody>
                <tr>
                  <td class="spider_label"><label for="slideshow_cont_bg_color">Background color: </label></td>
                  <td>
                    <input type="text" name="slideshow_cont_bg_color" id="slideshow_cont_bg_color" value="<?php echo $row->slideshow_cont_bg_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_rl_btn_size">Right, left buttons size: </label></td>
                  <td>
                    <input type="text" name="slideshow_rl_btn_size" id="slideshow_rl_btn_size" value="<?php echo $row->slideshow_rl_btn_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_play_pause_btn_size">Play, pause buttons size: </label></td>
                  <td>
                    <input type="text" name="slideshow_play_pause_btn_size" id="slideshow_play_pause_btn_size" value="<?php echo $row->slideshow_play_pause_btn_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_rl_btn_color">Buttons color: </label></td>
                  <td>
                    <input type="text" name="slideshow_rl_btn_color" id="slideshow_rl_btn_color" value="<?php echo $row->slideshow_rl_btn_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_close_btn_transparent">Buttons transparency: </label></td>
                  <td>
                    <input type="text" name="slideshow_close_btn_transparent" id="slideshow_close_btn_transparent" value="<?php echo $row->slideshow_close_btn_transparent; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> %
                    <div class="spider_description">Value must be between 0 to 100.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_close_rl_btn_hover_color">Buttons hover color: </label></td>
                  <td>
                    <input type="text" name="slideshow_close_rl_btn_hover_color" id="slideshow_close_rl_btn_hover_color" value="<?php echo $row->slideshow_close_rl_btn_hover_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_rl_btn_width">Right, left buttons width: </label></td>
                  <td>
                    <input type="text" name="slideshow_rl_btn_width" id="slideshow_rl_btn_width" value="<?php echo $row->slideshow_rl_btn_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_rl_btn_height">Right, left buttons height: </label></td>
                  <td>
                    <input type="text" name="slideshow_rl_btn_height" id="slideshow_rl_btn_height" value="<?php echo $row->slideshow_rl_btn_height; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_rl_btn_bg_color">Right, left buttons background color: </label></td>
                  <td>
                    <input type="text" name="slideshow_rl_btn_bg_color" id="slideshow_rl_btn_bg_color" value="<?php echo $row->slideshow_rl_btn_bg_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_rl_btn_border_width">Right, left buttons border width: </label></td>
                  <td>
                    <input type="text" name="slideshow_rl_btn_border_width" id="slideshow_rl_btn_border_width" value="<?php echo $row->slideshow_rl_btn_border_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_rl_btn_border_style">Right, left buttons border style: </label></td>
                  <td>
                    <select name="slideshow_rl_btn_border_style" id="slideshow_rl_btn_border_style">
                      <?php
                      foreach ($border_styles as $key => $border_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->slideshow_rl_btn_border_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $border_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_rl_btn_border_color">Right, left buttons border color: </label></td>
                  <td>
                    <input type="text" name="slideshow_rl_btn_border_color" id="slideshow_rl_btn_border_color" value="<?php echo $row->slideshow_rl_btn_border_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_rl_btn_border_radius">Right, left buttons border radius: </label></td>
                  <td>
                    <input type="text" name="slideshow_rl_btn_border_radius" id="slideshow_rl_btn_border_radius" value="<?php echo $row->slideshow_rl_btn_border_radius; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_rl_btn_style">Right, left buttons style: </label></td>
                  <td>
                    <select name="slideshow_rl_btn_style" id="slideshow_rl_btn_style">
                      <?php
                      foreach ($button_styles as $key => $button_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->slideshow_rl_btn_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $button_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_rl_btn_box_shadow">Right, left buttons box shadow: </label></td>
                  <td>
                    <input type="text" name="slideshow_rl_btn_box_shadow" id="slideshow_rl_btn_box_shadow" value="<?php echo $row->slideshow_rl_btn_box_shadow; ?>" class="spider_box_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
              </tbody>
            </table>
          </fieldset>
          <fieldset class="spider_child_fieldset" id="Slideshow_2">
            <table style="clear:both;">
              <tbody>
                <tr>
                  <td class="spider_label"><label>Filmstrip/Slider bullet position: </label></td>
                  <td>
                    <select name="slideshow_filmstrip_pos" id="slideshow_filmstrip_pos">
                      <option value="top" <?php echo (($row->slideshow_filmstrip_pos == "top") ? 'selected="selected"' : ''); ?>>Top</option>
                      <option value="right" <?php echo (($row->slideshow_filmstrip_pos == "right") ? 'selected="selected"' : ''); ?>>Right</option>
                      <option value="bottom" <?php echo (($row->slideshow_filmstrip_pos == "bottom") ? 'selected="selected"' : ''); ?>>Bottom</option>
                      <option value="left" <?php echo (($row->slideshow_filmstrip_pos == "left") ? 'selected="selected"' : ''); ?>>Left</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_filmstrip_thumb_margin">Filmstrip margin: </label></td>
                  <td>
                    <input type="text" name="slideshow_filmstrip_thumb_margin" id="slideshow_filmstrip_thumb_margin" value="<?php echo $row->slideshow_filmstrip_thumb_margin; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_filmstrip_thumb_border_width">Filmstrip border width: </label></td>
                  <td>
                    <input type="text" name="slideshow_filmstrip_thumb_border_width" id="slideshow_filmstrip_thumb_border_width" value="<?php echo $row->slideshow_filmstrip_thumb_border_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_filmstrip_thumb_border_style">Filmstrip border style: </label>
                  </td>
                  <td>
                    <select name="slideshow_filmstrip_thumb_border_style" id="slideshow_filmstrip_thumb_border_style">
                      <?php
                      foreach ($border_styles as $key => $border_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->slideshow_filmstrip_thumb_border_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $border_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_filmstrip_thumb_border_color">Filmstrip border color: </label></td>
                  <td>
                    <input type="text" name="slideshow_filmstrip_thumb_border_color" id="slideshow_filmstrip_thumb_border_color" value="<?php echo $row->slideshow_filmstrip_thumb_border_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_filmstrip_thumb_border_radius">Filmstrip border radius: </label></td>
                  <td>
                    <input type="text" name="slideshow_filmstrip_thumb_border_radius" id="slideshow_filmstrip_thumb_border_radius" value="<?php echo $row->slideshow_filmstrip_thumb_border_radius; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_filmstrip_thumb_active_border_width">Filmstrip active border width: </label></td>
                  <td>
                    <input type="text" name="slideshow_filmstrip_thumb_active_border_width" id="slideshow_filmstrip_thumb_active_border_width" value="<?php echo $row->slideshow_filmstrip_thumb_active_border_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/>px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_filmstrip_thumb_active_border_color">Filmstrip active border color: </label></td>
                  <td>
                    <input type="text" name="slideshow_filmstrip_thumb_active_border_color" id="slideshow_filmstrip_thumb_active_border_color" value="<?php echo $row->slideshow_filmstrip_thumb_active_border_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr id="tr_appWidth">
                  <td class="spider_label"><label for="slideshow_filmstrip_thumb_deactive_transparent">Filmstrip deactive transparency: </label></td>
                  <td>
                    <input type="text" name="slideshow_filmstrip_thumb_deactive_transparent" id="slideshow_filmstrip_thumb_deactive_transparent" value="<?php echo $row->slideshow_filmstrip_thumb_deactive_transparent; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> %
                    <div class="spider_description">Value must be between 0 to 100.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_filmstrip_rl_bg_color">Filmstrip right, left buttons background color: </label></td>
                  <td>
                    <input type="text" name="slideshow_filmstrip_rl_bg_color" id="slideshow_filmstrip_rl_bg_color" value="<?php echo $row->slideshow_filmstrip_rl_bg_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_filmstrip_rl_btn_color">Filmstrip right, left buttons color: </label></td>
                  <td>
                    <input type="text" name="slideshow_filmstrip_rl_btn_color" id="slideshow_filmstrip_rl_btn_color" value="<?php echo $row->slideshow_filmstrip_rl_btn_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_filmstrip_rl_btn_size">Filmstrip right, left buttons size: </label></td>
                  <td>
                    <input type="text" name="slideshow_filmstrip_rl_btn_size" id="slideshow_filmstrip_rl_btn_size" value="<?php echo $row->slideshow_filmstrip_rl_btn_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)" /> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_dots_width">Slider bullet width: </label></td>
                  <td>
                    <input type="text" name="slideshow_dots_width" id="slideshow_dots_width" value="<?php echo $row->slideshow_dots_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_dots_height">Slider bullet height: </label></td>
                  <td>
                    <input type="text" name="slideshow_dots_height" id="slideshow_dots_height" value="<?php echo $row->slideshow_dots_height; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_dots_border_radius">Slider bullet border radius: </label></td>
                  <td>
                    <input type="text" name="slideshow_dots_border_radius" id="slideshow_dots_border_radius" value="<?php echo $row->slideshow_dots_border_radius; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_dots_background_color">Slider bullet background color: </label></td>
                  <td>
                    <input type="text" name="slideshow_dots_background_color" id="slideshow_dots_background_color" value="<?php echo $row->slideshow_dots_background_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_dots_margin">Slider bullet margin: </label></td>
                  <td>
                    <input type="text" name="slideshow_dots_margin" id="slideshow_dots_margin" value="<?php echo $row->slideshow_dots_margin; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_dots_active_background_color">Slider bullet active background color: </label></td>
                  <td>
                    <input type="text" name="slideshow_dots_active_background_color" id="slideshow_dots_active_background_color" value="<?php echo $row->slideshow_dots_active_background_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_dots_active_border_width">Slider bullet active border width: </label></td>
                  <td>
                    <input type="text" name="slideshow_dots_active_border_width" id="slideshow_dots_active_border_width" value="<?php echo $row->slideshow_dots_active_border_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_dots_active_border_color">Slider bullet active border color: </label></td>
                  <td>
                    <input type="text" name="slideshow_dots_active_border_color" id="slideshow_dots_active_border_color" value="<?php echo $row->slideshow_dots_active_border_color; ?>" class="color"/>
                  </td>
                </tr>
              </tbody>
            </table>
          </fieldset>
          <fieldset class="spider_child_fieldset" id="Slideshow_3">
            <table style="clear:both;">
              <tbody>
                <tr>
                  <td class="spider_label"><label for="slideshow_title_background_color">Title background color: </label></td>
                  <td>
                    <input type="text" name="slideshow_title_background_color" id="slideshow_title_background_color" value="<?php echo $row->slideshow_title_background_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_title_opacity">Title transparency: </label></td>
                  <td>
                    <input type="text" name="slideshow_title_opacity" id="slideshow_title_opacity" value="<?php echo $row->slideshow_title_opacity; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> %
                    <div class="spider_description">Value must be between 0 to 100.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_title_border_radius">Title border radius: </label></td>
                  <td>
                    <input type="text" name="slideshow_title_border_radius" id="slideshow_title_border_radius" value="<?php echo $row->slideshow_title_border_radius; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_title_padding">Title padding: </label></td>
                  <td>
                    <input type="text" name="slideshow_title_padding" id="slideshow_title_padding" value="<?php echo $row->slideshow_title_padding; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_title_font_size">Title font size: </label></td>
                  <td>
                    <input type="text" name="slideshow_title_font_size" id="slideshow_title_font_size" value="<?php echo $row->slideshow_title_font_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)" /> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_title_color">Title color: </label></td>
                  <td>
                    <input type="text" name="slideshow_title_color" id="slideshow_title_color" value="<?php echo $row->slideshow_title_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_title_font">Title font family: </label></td>
                  <td>
                    <select name="slideshow_title_font" id="slideshow_title_font">
                      <?php
                      foreach ($font_families as $key => $font_family) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->slideshow_title_font == $key) ? 'selected="selected"' : ''); ?>><?php echo $font_family; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_description_background_color">Description background color: </label></td>
                  <td>
                    <input type="text" name="slideshow_description_background_color" id="slideshow_description_background_color" value="<?php echo $row->slideshow_description_background_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_description_opacity">Description transparency: </label></td>
                  <td>
                    <input type="text" name="slideshow_description_opacity" id="slideshow_description_opacity" value="<?php echo $row->slideshow_description_opacity; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> %
                    <div class="spider_description">Value must be between 0 to 100.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_description_border_radius">Description border radius: </label></td>
                  <td>
                    <input type="text" name="slideshow_description_border_radius" id="slideshow_description_border_radius" value="<?php echo $row->slideshow_description_border_radius; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_description_padding">Description padding: </label></td>
                  <td>
                    <input type="text" name="slideshow_description_padding" id="slideshow_description_padding" value="<?php echo $row->slideshow_description_padding; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_description_font_size">Description font size: </label></td>
                  <td>
                    <input type="text" name="slideshow_description_font_size" id="slideshow_description_font_size" value="<?php echo $row->slideshow_description_font_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_description_color">Description color: </label></td>
                  <td>
                    <input type="text" name="slideshow_description_color" id="slideshow_description_color" value="<?php echo $row->slideshow_description_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="slideshow_description_font">Description font family: </label></td>
                  <td>
                    <select name="slideshow_description_font" id="slideshow_description_font">
                      <?php
                      foreach ($font_families as $key => $font_family) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->slideshow_description_font == $key) ? 'selected="selected"' : ''); ?>><?php echo $font_family; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
              </tbody>
            </table>
          </fieldset>
        </fieldset>

        <fieldset class="spider_type_fieldset" id="Image_browser">
          <fieldset class="spider_child_fieldset" id="Image_browser_1">
            <table style="clear:both;">
              <tbody>
                <tr>
                  <td class="spider_label"><label for="image_browser_full_padding">Full padding: </label></td>
                  <td>
                    <input type="text" name="image_browser_full_padding" id="image_browser_full_padding" value="<?php echo $row->image_browser_full_padding; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="image_browser_full_bg_color">Full background color: </label></td>
                  <td>
                    <input type="text" name="image_browser_full_bg_color" id="image_browser_full_bg_color" value="<?php echo $row->image_browser_full_bg_color; ?>" class="color" />
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="image_browser_full_transparent">Full background transparency: </label></td>
                  <td>
                    <input type="text" name="image_browser_full_transparent" id="image_browser_full_transparent" value="<?php echo $row->image_browser_full_transparent; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> %
                    <div class="spider_description">Value must be between 0 to 100.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="image_browser_full_border_radius">Full border radius: </label></td>
                  <td>
                    <input type="text" name="image_browser_full_border_radius" id="image_browser_full_border_radius" value="<?php echo $row->image_browser_full_border_radius; ?>" class="spider_char_input" />
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="image_browser_full_border_width">Full border width: </label></td>
                  <td>
                    <input type="text" name="image_browser_full_border_width" id="image_browser_full_border_width" value="<?php echo $row->image_browser_full_border_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="image_browser_full_border_style">Full border style: </label></td>
                  <td>
                    <select name="image_browser_full_border_style" id="image_browser_full_border_style">
                      <?php
                      foreach ($border_styles as $key => $border_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->image_browser_full_border_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $border_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="image_browser_full_border_color">Full border color: </label></td>
                  <td>
                    <input type="text" name="image_browser_full_border_color" id="image_browser_full_border_color" value="<?php echo $row->image_browser_full_border_color; ?>" class="color" />
                  </td>
                </tr>
              </tbody>
            </table>
          </fieldset>
          <fieldset class="spider_child_fieldset" id="Image_browser_2">
            <table style="clear:both;">
              <tbody>
                <tr>
                  <td class="spider_label"><label for="image_browser_align0">Alignment: </label></td>
                  <td>
                    <select name="image_browser_align" id="image_browser_align">
                      <?php
                      foreach ($aligns as $key => $align) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->image_browser_align == $key) ? 'selected="selected"' : ''); ?>><?php echo $align; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="image_browser_margin">Margin: </label></td>
                  <td>
                    <input type="text" name="image_browser_margin" id="image_browser_margin" value="<?php echo $row->image_browser_margin; ?>" class="spider_char_input" />
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="image_browser_padding">Padding: </label></td>
                  <td>
                    <input type="text" name="image_browser_padding" id="image_browser_padding" value="<?php echo $row->image_browser_padding; ?>" class="spider_char_input" />
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="image_browser_border_width">Border width: </label></td>
                  <td>
                    <input type="text" name="image_browser_border_width" id="image_browser_border_width" value="<?php echo $row->image_browser_border_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="image_browser_border_style">Border style: </label></td>
                  <td>
                    <select name="image_browser_border_style" id="image_browser_border_style">
                      <?php
                      foreach ($border_styles as $key => $border_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->image_browser_border_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $border_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="image_browser_border_color">Border color: </label></td>
                  <td>
                    <input type="text" name="image_browser_border_color" id="image_browser_border_color" value="<?php echo $row->image_browser_border_color; ?>" class="color" />
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="image_browser_border_radius">Border radius: </label></td>
                  <td>
                    <input type="text" name="image_browser_border_radius" id="image_browser_border_radius" value="<?php echo $row->image_browser_border_radius; ?>" class="spider_char_input" />
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="image_browser_bg_color">Background color: </label></td>
                  <td>
                    <input type="text" name="image_browser_bg_color" id="image_browser_bg_color" value="<?php echo $row->image_browser_bg_color; ?>" class="color" />
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="image_browser_transparent">Background transparency: </label></td>
                  <td>
                    <input type="text" name="image_browser_transparent" id="image_browser_transparent" value="<?php echo $row->image_browser_transparent; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> %
                    <div class="spider_description">Value must be between 0 to 100.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="image_browser_box_shadow">Box shadow: </label></td>
                  <td>
                    <input type="text" name="image_browser_box_shadow" id="image_browser_box_shadow" value="<?php echo $row->image_browser_box_shadow; ?>" class="spider_box_input" />
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
              </tbody>
            </table>
          </fieldset>
          <fieldset class="spider_child_fieldset" id="Image_browser_3">
            <table style="clear:both;">
              <tbody>
                <tr>
                  <td class="spider_label"><label for="image_browser_image_description_align0">Title alignment: </label></td>
                  <td>
                    <select name="image_browser_image_description_align" id="image_browser_image_description_align">
                      <?php
                      foreach ($aligns as $key => $align) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->image_browser_image_description_align == $key) ? 'selected="selected"' : ''); ?>><?php echo $align; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="image_browser_img_font_size">Font size: </label></td>
                  <td>
                    <input type="text" name="image_browser_img_font_size" id="image_browser_img_font_size" value="<?php echo $row->image_browser_img_font_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="image_browser_img_font_color">Font color: </label></td>
                  <td>
                    <input type="text" name="image_browser_img_font_color" id="image_browser_img_font_color" value="<?php echo $row->image_browser_img_font_color; ?>" class="color" />
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="image_browser_img_font_family">Font family: </label></td>
                  <td>
                    <select name="image_browser_img_font_family" id="image_browser_img_font_family">
                      <?php
                      foreach ($font_families as $key => $font_family) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->image_browser_img_font_family == $key) ? 'selected="selected"' : ''); ?>><?php echo $font_family; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="image_browser_image_description_margin">Description margin: </label></td>
                  <td>
                    <input type="text" name="image_browser_image_description_margin" id="image_browser_image_description_margin" value="<?php echo $row->image_browser_image_description_margin; ?>" class="spider_char_input" />
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="image_browser_image_description_padding">Description padding: </label></td>
                  <td>
                    <input type="text" name="image_browser_image_description_padding" id="image_browser_image_description_padding" value="<?php echo $row->image_browser_image_description_padding; ?>" class="spider_char_input" />
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="image_browser_image_description_border_width">Description border width: </label></td>
                  <td>
                    <input type="text" name="image_browser_image_description_border_width" id="image_browser_image_description_border_width" value="<?php echo $row->image_browser_image_description_border_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)" /> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="image_browser_image_description_border_style">Description border style: </label></td>
                  <td>
                    <select name="image_browser_image_description_border_style" id="image_browser_image_description_border_style">
                      <?php
                      foreach ($border_styles as $key => $border_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->image_browser_image_description_border_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $border_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="image_browser_image_description_border_color">Description border color: </label></td>
                  <td>
                    <input type="text" name="image_browser_image_description_border_color" id="image_browser_image_description_border_color" value="<?php echo $row->image_browser_image_description_border_color; ?>" class="color" />
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="image_browser_image_description_border_radius">Description border radius: </label></td>
                  <td>
                    <input type="text" name="image_browser_image_description_border_radius" id="image_browser_image_description_border_radius" value="<?php echo $row->image_browser_image_description_border_radius; ?>" class="spider_char_input" />
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="image_browser_image_description_bg_color">Description background color: </label></td>
                  <td>
                    <input type="text" name="image_browser_image_description_bg_color" id="image_browser_image_description_bg_color" value="<?php echo $row->image_browser_image_description_bg_color; ?>" class="color" />
                  </td>
                </tr>
              </tbody>
            </table>
          </fieldset>
        </fieldset>

        <fieldset class="spider_type_fieldset" id="Compact_album">
          <fieldset class="spider_child_fieldset" id="Compact_album_1">
            <table style="clear:both;">
              <tbody>
                <tr>
                  <td class="spider_label"><label for="album_compact_thumb_padding">Padding: </label></td>
                  <td>
                    <input type="text" name="album_compact_thumb_padding" id="album_compact_thumb_padding" value="<?php echo $row->album_compact_thumb_padding; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_compact_thumb_margin">Margin: </label></td>
                  <td>
                    <input type="text" name="album_compact_thumb_margin" id="album_compact_thumb_margin" value="<?php echo $row->album_compact_thumb_margin; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_compact_thumb_border_width">Border width: </label></td>
                  <td>
                    <input type="text" name="album_compact_thumb_border_width" id="album_compact_thumb_border_width" value="<?php echo $row->album_compact_thumb_border_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_compact_thumb_border_style">Border style: </label></td>
                  <td>
                    <select name="album_compact_thumb_border_style" id="album_compact_thumb_border_style">
                      <?php
                      foreach ($border_styles as $key => $border_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->album_compact_thumb_border_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $border_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_compact_thumb_border_color">Border color: </label></td>
                  <td>
                    <input type="text" name="album_compact_thumb_border_color" id="album_compact_thumb_border_color" value="<?php echo $row->album_compact_thumb_border_color; ?>" class="color" />
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_compact_thumb_border_radius">Border radius: </label></td>
                  <td>
                    <input type="text" name="album_compact_thumb_border_radius" id="album_compact_thumb_border_radius" value="<?php echo $row->album_compact_thumb_border_radius; ?>" class="spider_char_input" />
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_compact_thumb_box_shadow">Shadow: </label></td>
                  <td>
                    <input type="text" name="album_compact_thumb_box_shadow" id="album_compact_thumb_box_shadow" value="<?php echo $row->album_compact_thumb_box_shadow; ?>" class="spider_box_input" />
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_compact_thumb_hover_effect">Hover effect: </label></td>
                  <td>
                    <select name="album_compact_thumb_hover_effect" id="album_compact_thumb_hover_effect">
                      <?php
                      foreach ($hover_effects as $key => $hover_effect) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->album_compact_thumb_hover_effect == $key) ? 'selected="selected"' : ''); ?>><?php echo $hover_effect; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_compact_thumb_hover_effect_value">Hover effect value: </label></td>
                  <td>
                    <input type="text" name="album_compact_thumb_hover_effect_value" id="album_compact_thumb_hover_effect_value" value="<?php echo $row->album_compact_thumb_hover_effect_value; ?>" class="spider_char_input" />
                    <div class="spider_description">E.g. Rotate: 10deg, Scale: 1.5, Skew: 10deg.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label>Thumbnail transition: </label></td>
                  <td id="album_compact_thumb_transition">
                    <input type="radio" name="album_compact_thumb_transition" id="album_compact_thumb_transition1" value="1"<?php if ($row->album_compact_thumb_transition == 1) echo 'checked="checked"'; ?> />
                    <label for="album_compact_thumb_transition1" id="album_compact_thumb_transition1_lbl">Yes</label>
                    <input type="radio" name="album_compact_thumb_transition" id="album_compact_thumb_transition0" value="0"<?php if ($row->album_compact_thumb_transition == 0) echo 'checked="checked"'; ?> />
                    <label for="album_compact_thumb_transition0" id="album_compact_thumb_transition0_lbl">No</label>
                  </td>
                </tr>
              </tbody>
            </table>
          </fieldset>
          <fieldset class="spider_child_fieldset" id="Compact_album_2">
            <table style="clear:both;">
              <tbody>
                <tr>
                  <td class="spider_label"><label for="album_compact_thumb_bg_color">Thumbnail background color: </label></td>
                  <td>
                    <input type="text" name="album_compact_thumb_bg_color" id="album_compact_thumb_bg_color" value="<?php echo $row->album_compact_thumb_bg_color; ?>" class="color" />
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_compact_thumb_transparent">Thumbnail transparency: </label></td>
                  <td>
                    <input type="text" name="album_compact_thumb_transparent" id="album_compact_thumb_transparent" value="<?php echo $row->album_compact_thumb_transparent; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> %
                    <div class="spider_description">Value must be between 0 to 100.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_compact_thumbs_bg_color">Full background color: </label></td>
                  <td>
                    <input type="text" name="album_compact_thumbs_bg_color" id="album_compact_thumbs_bg_color" value="<?php echo $row->album_compact_thumbs_bg_color; ?>" class="color" />
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_compact_thumb_bg_transparent">Full background transparency: </label></td>
                  <td>
                    <input type="text" name="album_compact_thumb_bg_transparent" id="album_compact_thumb_bg_transparent" value="<?php echo $row->album_compact_thumb_bg_transparent; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> %
                    <div class="spider_description">Value must be between 0 to 100.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_compact_thumb_align0">Alignment: </label></td>
                  <td>
                    <select name="album_compact_thumb_align" id="album_compact_thumb_align">
                      <?php
                      foreach ($aligns as $key => $align) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->album_compact_thumb_align == $key) ? 'selected="selected"' : ''); ?>><?php echo $align; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
              </tbody>
            </table>
          </fieldset>
          <fieldset class="spider_child_fieldset" id="Compact_album_3">
            <table style="clear:both;">
              <tbody>
                <tr>
                  <td class="spider_label"><label>Title position: </label></td>
                  <td>
                    <input type="radio" name="album_compact_thumb_title_pos" id="album_compact_thumb_title_pos1" value="top" <?php if ($row->album_compact_thumb_title_pos == "top") echo 'checked="checked"'; ?> />
                    <label for="album_compact_thumb_title_pos1" id="album_compact_thumb_title_pos1_lbl">Top</label>
                    <input type="radio" name="album_compact_thumb_title_pos" id="album_compact_thumb_title_pos0" value="bottom" <?php if ($row->album_compact_thumb_title_pos == "bottom") echo 'checked="checked"'; ?> />
                    <label for="album_compact_thumb_title_pos0" id="album_compact_thumb_title_pos0_lbl">Bottom</label>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_compact_title_font_size">Title font size: </label></td>
                  <td>
                    <input type="text" name="album_compact_title_font_size" id="album_compact_title_font_size" value="<?php echo $row->album_compact_title_font_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_compact_title_font_color">Title font color: </label></td>
                  <td>
                    <input type="text" name="album_compact_title_font_color" id="album_compact_title_font_color" value="<?php echo $row->album_compact_title_font_color; ?>" class="color" />
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_compact_title_font_style">Title font family: </label></td>
                  <td>
                    <select name="album_compact_title_font_style" id="album_compact_title_font_style">
                      <?php
                      foreach ($font_families as $key => $font_family) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->album_compact_title_font_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $font_family; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_compact_title_font_weight">Title font weight: </label></td>
                  <td>
                    <select name="album_compact_title_font_weight" id="album_compact_title_font_weight">
                      <?php
                      foreach ($font_weights as $key => $font_weight) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->album_compact_title_font_weight == $key) ? 'selected="selected"' : ''); ?>><?php echo $font_weight; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_compact_title_shadow">Title box shadow: </label></td>
                  <td>
                    <input type="text" name="album_compact_title_shadow" id="album_compact_title_shadow" value="<?php echo $row->album_compact_title_shadow; ?>" class="spider_box_input" />
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_compact_title_margin">Title margin: </label></td>
                  <td>
                    <input type="text" name="album_compact_title_margin" id="album_compact_title_margin" value="<?php echo $row->album_compact_title_margin; ?>" class="spider_char_input" />
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_compact_back_font_size">Font size: </label></td>
                  <td>
                    <input type="text" name="album_compact_back_font_size" id="album_compact_back_font_size" value="<?php echo $row->album_compact_back_font_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_compact_back_font_color">Font color: </label></td>
                  <td>
                    <input type="text" name="album_compact_back_font_color" id="album_compact_back_font_color" value="<?php echo $row->album_compact_back_font_color; ?>" class="color" />
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_compact_back_font_style">Font family: </label></td>
                  <td>
                    <select name="album_compact_back_font_style" id="album_compact_back_font_style">
                      <?php
                      foreach ($font_families as $key => $font_family) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->album_compact_back_font_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $font_family; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_compact_back_font_weight">Font weight: </label></td>
                  <td>
                    <select name="album_compact_back_font_weight" id="album_compact_back_font_weight">
                      <?php
                      foreach ($font_weights as $key => $font_weight) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->album_compact_back_font_weight == $key) ? 'selected="selected"' : ''); ?>><?php echo $font_weight; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_compact_back_padding">Back padding: </label></td>
                  <td>
                    <input type="text" name="album_compact_back_padding" id="album_compact_back_padding" value="<?php echo $row->album_compact_back_padding; ?>" class="spider_char_input" />
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
              </tbody>
            </table>
          </fieldset>
        </fieldset>

        <fieldset class="spider_type_fieldset" id="Extended_album">
          <fieldset class="spider_child_fieldset" id="Extended_album_1">
            <table style="clear:both;">
              <tbody>
                <tr>
                  <td class="spider_label"><label for="album_extended_thumb_margin">Thumbnail margin: </label></td>
                  <td>
                    <input type="text" name="album_extended_thumb_margin" id="album_extended_thumb_margin" value="<?php echo $row->album_extended_thumb_margin; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_thumb_padding">Thumbnail padding: </label></td>
                  <td>
                    <input type="text" name="album_extended_thumb_padding" id="album_extended_thumb_padding" value="<?php echo $row->album_extended_thumb_padding; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_thumb_border_width">Thumbnail border width: </label></td>
                  <td>
                    <input type="text" name="album_extended_thumb_border_width" id="album_extended_thumb_border_width" value="<?php echo $row->album_extended_thumb_border_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_thumb_border_style">Thumbnail border style: </label></td>
                  <td>
                    <select name="album_extended_thumb_border_style" id="album_extended_thumb_border_style">
                      <?php
                      foreach ($border_styles as $key => $border_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->album_extended_thumb_border_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $border_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_thumb_border_color">Thumbnail border color: </label></td>
                  <td>
                    <input type="text" name="album_extended_thumb_border_color" id="album_extended_thumb_border_color" value="<?php echo $row->album_extended_thumb_border_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_thumb_border_radius">Thumbnail border radius: </label></td>
                  <td>
                    <input type="text" name="album_extended_thumb_border_radius" id="album_extended_thumb_border_radius" value="<?php echo $row->album_extended_thumb_border_radius; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_thumb_box_shadow">Thumbnail box shadow: </label></td>
                  <td>
                    <input type="text" name="album_extended_thumb_box_shadow" id="album_extended_thumb_box_shadow" value="<?php echo $row->album_extended_thumb_box_shadow; ?>" class="spider_box_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label>Thumbnail transition: </label></td>
                  <td id="album_extended_thumb_transition">
                    <input type="radio" name="album_extended_thumb_transition" id="album_extended_thumb_transition1" value="1"<?php if ($row->album_extended_thumb_transition == 1) echo 'checked="checked"'; ?> />
                    <label for="album_extended_thumb_transition1" id="album_extended_thumb_transition1_lbl">Yes</label>
                    <input type="radio" name="album_extended_thumb_transition" id="album_extended_thumb_transition0" value="0"<?php if ($row->album_extended_thumb_transition == 0) echo 'checked="checked"'; ?> />
                    <label for="album_extended_thumb_transition0" id="album_extended_thumb_transition0_lbl">No</label>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_thumb_align0">Thumbnail alignment: </label></td>
                  <td>
                    <select name="album_extended_thumb_align" id="album_extended_thumb_align">
                      <?php
                      foreach ($aligns as $key => $align) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->album_extended_thumb_align == $key) ? 'selected="selected"' : ''); ?>><?php echo $align; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_thumb_transparent">Thumbnail transparency: </label></td>
                  <td>
                    <input type="text" name="album_extended_thumb_transparent" id="album_extended_thumb_transparent" value="<?php echo $row->album_extended_thumb_transparent; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> %
                    <div class="spider_description">Value must be between 0 to 100.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_thumb_hover_effect">Thumbnail hover effect: </label></td>
                  <td>
                    <select name="album_extended_thumb_hover_effect" id="album_extended_thumb_hover_effect">
                      <?php
                      foreach ($hover_effects as $key => $hover_effect) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->album_extended_thumb_hover_effect == $key) ? 'selected="selected"' : ''); ?>><?php echo $hover_effect; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_thumb_hover_effect_value">Hover effect value: </label></td>
                  <td>
                    <input type="text" name="album_extended_thumb_hover_effect_value" id="album_extended_thumb_hover_effect_value" value="<?php echo $row->album_extended_thumb_hover_effect_value; ?>" class="spider_char_input"/>
                    <div class="spider_description">E.g. Rotate: 10deg, Scale: 1.5, Skew: 10deg.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_thumb_bg_color">Thumbnail background color: </label></td>
                  <td>
                    <input type="text" name="album_extended_thumb_bg_color" id="album_extended_thumb_bg_color" value="<?php echo $row->album_extended_thumb_bg_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_thumbs_bg_color">Thumbnails background color: </label></td>
                  <td>
                    <input type="text" name="album_extended_thumbs_bg_color" id="album_extended_thumbs_bg_color" value="<?php echo $row->album_extended_thumbs_bg_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_thumb_bg_transparent">Thumbnail background transparency: </label></td>
                  <td>
                    <input type="text" name="album_extended_thumb_bg_transparent" id="album_extended_thumb_bg_transparent" value="<?php echo $row->album_extended_thumb_bg_transparent; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> %
                    <div class="spider_description">Value must be between 0 to 100.</div>
                  </td>
                </tr>
              </tbody>
            </table>
          </fieldset>
          <fieldset class="spider_child_fieldset" id="Extended_album_2">
            <table style="clear:both;">
              <tbody>
                <tr>
                  <td class="spider_label"><label for="album_extended_thumb_div_padding">Thumbnail div padding: </label></td>
                  <td>
                    <input type="text" name="album_extended_thumb_div_padding" id="album_extended_thumb_div_padding" value="<?php echo $row->album_extended_thumb_div_padding; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_thumb_div_bg_color">Thumbnail div background color: </label></td>
                  <td>
                    <input type="text" name="album_extended_thumb_div_bg_color" id="album_extended_thumb_div_bg_color" value="<?php echo $row->album_extended_thumb_div_bg_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_thumb_div_border_width">Thumbnail div border width: </label>
                  </td>
                  <td>
                    <input type="text" name="album_extended_thumb_div_border_width" id="album_extended_thumb_div_border_width" value="<?php echo $row->album_extended_thumb_div_border_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_thumb_div_border_style">Thumbnail div border style: </label></td>
                  <td>
                    <select name="album_extended_thumb_div_border_style" id="album_extended_thumb_div_border_style">
                      <?php
                      foreach ($border_styles as $key => $border_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->album_extended_thumb_div_border_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $border_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_thumb_div_border_color">Thumbnail div border color: </label></td>
                  <td>
                    <input type="text" name="album_extended_thumb_div_border_color" id="album_extended_thumb_div_border_color" value="<?php echo $row->album_extended_thumb_div_border_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_thumb_div_border_radius">Thumbnail div border radius: </label></td>
                  <td>
                    <input type="text" name="album_extended_thumb_div_border_radius" id="album_extended_thumb_div_border_radius" value="<?php echo $row->album_extended_thumb_div_border_radius; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_div_margin">Margin: </label></td>
                  <td>
                    <input type="text" name="album_extended_div_margin" id="album_extended_div_margin" value="<?php echo $row->album_extended_div_margin; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_div_padding">Padding: </label></td>
                  <td>
                    <input type="text" name="album_extended_div_padding" id="album_extended_div_padding" value="<?php echo $row->album_extended_div_padding; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_div_bg_color">Background color: </label></td>
                  <td>
                    <input type="text" name="album_extended_div_bg_color" id="album_extended_div_bg_color" value="<?php echo $row->album_extended_div_bg_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_div_bg_transparent">Background transparency: </label></td>
                  <td>
                    <input type="text" name="album_extended_div_bg_transparent" id="album_extended_div_bg_transparent" value="<?php echo $row->album_extended_div_bg_transparent; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> %
                    <div class="spider_description">Value must be between 0 to 100.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_div_border_radius">Border radius: </label></td>
                  <td>
                    <input type="text" name="album_extended_div_border_radius" id="album_extended_div_border_radius" value="<?php echo $row->album_extended_div_border_radius; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_div_separator_width">Separator width: </label></td>
                  <td>
                    <input type="text" name="album_extended_div_separator_width" id="album_extended_div_separator_width" value="<?php echo $row->album_extended_div_separator_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_div_separator_style">Separator style: </label></td>
                  <td>
                    <select name="album_extended_div_separator_style" id="album_extended_div_separator_style">
                      <?php
                      foreach ($border_styles as $key => $border_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->album_extended_div_separator_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $border_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_div_separator_color">Separator color: </label></td>
                  <td>
                    <input type="text" name="album_extended_div_separator_color" id="album_extended_div_separator_color" value="<?php echo $row->album_extended_div_separator_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_back_padding">Back padding: </label></td>
                  <td>
                    <input type="text" name="album_extended_back_padding" id="album_extended_back_padding" value="<?php echo $row->album_extended_back_padding; ?>" class="spider_char_input" />
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_back_font_size">Back font size: </label></td>
                  <td>
                    <input type="text" name="album_extended_back_font_size" id="album_extended_back_font_size" value="<?php echo $row->album_extended_back_font_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_back_font_color">Back font color: </label></td>
                  <td>
                    <input type="text" name="album_extended_back_font_color" id="album_extended_back_font_color" value="<?php echo $row->album_extended_back_font_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_back_font_style">Back font family: </label></td>
                  <td>
                    <select name="album_extended_back_font_style" id="album_extended_back_font_style">
                      <?php
                      foreach ($font_families as $key => $font_family) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->album_extended_back_font_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $font_family; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_back_font_weight">Back font weight: </label></td>
                  <td>
                    <select name="album_extended_back_font_weight" id="album_extended_back_font_weight">
                      <?php
                      foreach ($font_weights as $key => $font_weight) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->album_extended_back_font_weight == $key) ? 'selected="selected"' : ''); ?>><?php echo $font_weight; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
            </tbody>
            </table>
          </fieldset>
          <fieldset class="spider_child_fieldset" id="Extended_album_3">
            <table style="clear:both;">
              <tbody>
                <tr>
                  <td class="spider_label"><label for="album_extended_text_div_padding">Text div padding: </label></td>
                  <td>
                    <input type="text" name="album_extended_text_div_padding" id="album_extended_text_div_padding" value="<?php echo $row->album_extended_text_div_padding; ?>" class="spider_char_input" />
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_text_div_border_width">Text div border width: </label></td>
                  <td>
                    <input type="text" name="album_extended_text_div_border_width" id="album_extended_text_div_border_width" value="<?php echo $row->album_extended_text_div_border_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_text_div_border_style">Text border style: </label></td>
                  <td>
                    <select name="album_extended_text_div_border_style" id="album_extended_text_div_border_style">
                      <?php
                      foreach ($border_styles as $key => $border_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->album_extended_text_div_border_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $border_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_text_div_border_color">Text border color: </label></td>
                  <td>
                    <input type="text" name="album_extended_text_div_border_color" id="album_extended_text_div_border_color" value="<?php echo $row->album_extended_text_div_border_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_text_div_border_radius">Text div border radius: </label></td>
                  <td>
                    <input type="text" name="album_extended_text_div_border_radius" id="album_extended_text_div_border_radius" value="<?php echo $row->album_extended_text_div_border_radius; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_text_div_bg_color">Text background color: </label></td>
                  <td>
                    <input type="text" name="album_extended_text_div_bg_color" id="album_extended_text_div_bg_color" value="<?php echo $row->album_extended_text_div_bg_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_title_margin_bottom">Title margin: </label></td>
                  <td>
                    <input type="text" name="album_extended_title_margin_bottom" id="album_extended_title_margin_bottom" value="<?php echo $row->album_extended_title_margin_bottom; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_title_padding">Title padding: </label></td>
                  <td>
                    <input type="text" name="album_extended_title_padding" id="album_extended_title_padding" value="<?php echo $row->album_extended_title_padding; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_title_span_border_width">Title border width: </label></td>
                  <td>
                    <input type="text" name="album_extended_title_span_border_width" id="album_extended_title_span_border_width" value="<?php echo $row->album_extended_title_span_border_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_title_span_border_style">Title border style: </label></td>
                  <td>
                    <select name="album_extended_title_span_border_style" id="album_extended_title_span_border_style">
                      <?php
                      foreach ($border_styles as $key => $border_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->album_extended_title_span_border_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $border_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_title_span_border_color">Title border color: </label></td>
                  <td>
                    <input type="text" name="album_extended_title_span_border_color" id="album_extended_title_span_border_color" value="<?php echo $row->album_extended_title_span_border_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_title_font_size">Title font size: </label></td>
                  <td>
                    <input type="text" name="album_extended_title_font_size" id="album_extended_title_font_size" value="<?php echo $row->album_extended_title_font_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_title_font_color">Title font color: </label></td>
                  <td>
                    <input type="text" name="album_extended_title_font_color" id="album_extended_title_font_color" value="<?php echo $row->album_extended_title_font_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_title_font_style">Title font family: </label></td>
                  <td>
                    <select name="album_extended_title_font_style" id="album_extended_title_font_style">
                      <?php
                      foreach ($font_families as $key => $font_family) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->album_extended_title_font_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $font_family; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_title_font_weight">Title font weight: </label></td>
                  <td>
                    <select name="album_extended_title_font_weight" id="album_extended_title_font_weight">
                      <?php
                      foreach ($font_weights as $key => $font_weight) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->album_extended_title_font_weight == $key) ? 'selected="selected"' : ''); ?>><?php echo $font_weight; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_desc_padding">Description padding: </label></td>
                  <td>
                    <input type="text" name="album_extended_desc_padding" id="album_extended_desc_padding" value="<?php echo $row->album_extended_desc_padding; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_desc_span_border_width">Description border width: </label></td>
                  <td>
                    <input type="text" name="album_extended_desc_span_border_width" id="album_extended_desc_span_border_width" value="<?php echo $row->album_extended_desc_span_border_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_desc_span_border_style">Description border style: </label></td>
                  <td>
                    <select name="album_extended_desc_span_border_style" id="album_extended_desc_span_border_style">
                      <?php
                      foreach ($border_styles as $key => $border_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->album_extended_desc_span_border_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $border_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_desc_span_border_color">Description border color: </label></td>
                  <td>
                    <input type="text" name="album_extended_desc_span_border_color" id="album_extended_desc_span_border_color" value="<?php echo $row->album_extended_desc_span_border_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_desc_font_size">Description font size: </label></td>
                  <td>
                    <input type="text" name="album_extended_desc_font_size" id="album_extended_desc_font_size" value="<?php echo $row->album_extended_desc_font_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_desc_font_color">Description font color: </label></td>
                  <td>
                    <input type="text" name="album_extended_desc_font_color" id="album_extended_desc_font_color" value="<?php echo $row->album_extended_desc_font_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_desc_font_style">Description font family: </label></td>
                  <td>
                    <select name="album_extended_desc_font_style" id="album_extended_desc_font_style">
                      <?php
                      foreach ($font_families as $key => $font_family) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->album_extended_desc_font_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $font_family; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_desc_font_weight">Description font weight: </label></td>
                  <td>
                    <select name="album_extended_desc_font_weight" id="album_extended_desc_font_weight">
                      <?php
                      foreach ($font_weights as $key => $font_weight) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->album_extended_desc_font_weight == $key) ? 'selected="selected"' : ''); ?>><?php echo $font_weight; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_desc_more_size">Description more size: </label></td>
                  <td>
                    <input type="text" name="album_extended_desc_more_size" id="album_extended_desc_more_size" value="<?php echo $row->album_extended_desc_more_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="album_extended_desc_more_color">Description more color: </label></td>
                  <td>
                    <input type="text" name="album_extended_desc_more_color" id="album_extended_desc_more_color" value="<?php echo $row->album_extended_desc_more_color; ?>" class="color"/>
                  </td>
                </tr>
              </tbody>
            </table>
          </fieldset>
        </fieldset>

        <fieldset class="spider_type_fieldset" id="Blog_style">
          <fieldset class="spider_child_fieldset" id="Blog_style_1">
            <table style="clear:both;">
              <tbody>
                <tr>
                  <td class="spider_label"><label for="blog_style_bg_color">Background color: </label></td>
                  <td>
                    <input type="text" name="blog_style_bg_color" id="blog_style_bg_color" value="<?php echo $row->blog_style_bg_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="blog_style_transparent">Background transparency: </label></td>
                  <td>
                    <input type="text" name="blog_style_transparent" id="blog_style_transparent" value="<?php echo $row->blog_style_transparent; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> %
                    <div class="spider_description">Value must be between 0 to 100.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="blog_style_align0">Alignment: </label></td>
                  <td>
                    <select name="blog_style_align" id="blog_style_align">
                      <?php
                      foreach ($aligns as $key => $align) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->blog_style_align == $key) ? 'selected="selected"' : ''); ?>><?php echo $align; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="blog_style_margin">Margin: </label></td>
                  <td>
                    <input type="text" name="blog_style_margin" id="blog_style_margin" value="<?php echo $row->blog_style_margin; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="blog_style_padding">Padding: </label></td>
                  <td>
                    <input type="text" name="blog_style_padding" id="blog_style_padding" value="<?php echo $row->blog_style_padding; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="blog_style_box_shadow">Box shadow: </label></td>
                  <td>
                    <input type="text" name="blog_style_box_shadow" id="blog_style_box_shadow" value="<?php echo $row->blog_style_box_shadow; ?>" class="spider_box_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                </tbody>
            </table>
          </fieldset>
          <fieldset class="spider_child_fieldset" id="Blog_style_2">
            <table style="clear:both;">
              <tbody>
                <tr>
                  <td class="spider_label"><label for="blog_style_img_font_family">Font family: </label></td>
                  <td>
                    <select name="blog_style_img_font_family" id="blog_style_img_font_family">
                      <?php
                      foreach ($font_families as $key => $font_family) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->blog_style_img_font_family == $key) ? 'selected="selected"' : ''); ?>><?php echo $font_family; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="blog_style_img_font_size">Font size: </label></td>
                  <td>
                    <input type="text" name="blog_style_img_font_size" id="blog_style_img_font_size" value="<?php echo $row->blog_style_img_font_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="blog_style_img_font_color">Font color: </label></td>
                  <td>
                    <input type="text" name="blog_style_img_font_color" id="blog_style_img_font_color" value="<?php echo $row->blog_style_img_font_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="blog_style_border_width">Border width: </label></td>
                  <td>
                    <input type="text" name="blog_style_border_width" id="blog_style_border_width" value="<?php echo $row->blog_style_border_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="blog_style_border_style">Border style: </label></td>
                  <td>
                    <select name="blog_style_border_style" id="blog_style_border_style">
                      <?php
                      foreach ($border_styles as $key => $border_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->blog_style_border_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $border_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="blog_style_border_color">Border color: </label></td>
                  <td>
                    <input type="text" name="blog_style_border_color" id="blog_style_border_color" value="<?php echo $row->blog_style_border_color; ?>" class="color" />
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="blog_style_border_radius">Border radius: </label></td>
                  <td>
                    <input type="text" name="blog_style_border_radius" id="blog_style_border_radius" value="<?php echo $row->blog_style_border_radius; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
              </tbody>
            </table>
          </fieldset>
          <fieldset class="spider_child_fieldset" id="Blog_style_3">
            <table style="clear:both;">
              <tbody>
                <tr>
                  <td class="spider_label"><label for="blog_style_share_buttons_margin">Buttons and title margin: </label></td>
                  <td>
                    <input type="text" name="blog_style_share_buttons_margin" id="blog_style_share_buttons_margin" value="<?php echo $row->blog_style_share_buttons_margin; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="blog_style_share_buttons_font_size">Buttons size: </label></td>
                  <td>
                    <input type="text" name="blog_style_share_buttons_font_size" id="blog_style_share_buttons_font_size" value="<?php echo $row->blog_style_share_buttons_font_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="blog_style_share_buttons_color">Buttons color: </label></td>
                  <td>
                    <input type="text" name="blog_style_share_buttons_color" id="blog_style_share_buttons_color" value="<?php echo $row->blog_style_share_buttons_color; ?>" class="color"/>
                  </td>
                </tr>
               <tr>
                  <td class="spider_label"><label for="blog_style_share_buttons_border_width">Buttons and title border width: </label></td>
                  <td>
                    <input type="text" name="blog_style_share_buttons_border_width" id="blog_style_share_buttons_border_width" value="<?php echo $row->blog_style_share_buttons_border_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="blog_style_share_buttons_border_style">Buttons and title border style: </label></td>
                  <td>
                    <select name="blog_style_share_buttons_border_style" id="blog_style_share_buttons_border_style">
                      <?php
                      foreach ($border_styles as $key => $border_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->blog_style_share_buttons_border_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $border_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="blog_style_share_buttons_border_color">Buttons and title border color: </label></td>
                  <td>
                    <input type="text" name="blog_style_share_buttons_border_color" id="blog_style_share_buttons_border_color" value="<?php echo $row->blog_style_share_buttons_border_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="blog_style_share_buttons_border_radius">Buttons and title border radius: </label></td>
                  <td>
                    <input type="text" name="blog_style_share_buttons_border_radius" id="blog_style_share_buttons_border_radius" value="<?php echo $row->blog_style_share_buttons_border_radius; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="blog_style_share_buttons_bg_color">Buttons and title background color: </label></td>
                  <td>
                    <input type="text" name="blog_style_share_buttons_bg_color" id="blog_style_share_buttons_bg_color" value="<?php echo $row->blog_style_share_buttons_bg_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="blog_style_share_buttons_bg_transparent">Buttons and title background transparency: </label></td>
                  <td>
                    <input type="text" name="blog_style_share_buttons_bg_transparent" id="blog_style_share_buttons_bg_transparent" value="<?php echo $row->blog_style_share_buttons_bg_transparent; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> %
                    <div class="spider_description">Value must be between 0 to 100.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="blog_style_share_buttons_align0">Buttons or title alignment: </label></td>
                  <td>
                    <select name="blog_style_share_buttons_align" id="blog_style_share_buttons_align">
                      <?php
                      foreach ($aligns as $key => $align) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->blog_style_share_buttons_align == $key) ? 'selected="selected"' : ''); ?>><?php echo $align; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
              </tbody>
            </table>
          </fieldset>
        </fieldset>

        <fieldset class="spider_type_fieldset" id="Lightbox">
          <fieldset class="spider_child_fieldset" id="Lightbox_1">
            <table style="clear:both;">
              <tbody>
                <tr id="lightbox_overlay_bg">
                  <td class="spider_label"><label for="lightbox_overlay_bg_color">Overlay background color: </label></td>
                  <td>
                    <input type="text" name="lightbox_overlay_bg_color" id="lightbox_overlay_bg_color" value="<?php echo $row->lightbox_overlay_bg_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr id="lightbox_overlay">
                  <td class="spider_label"><label for="lightbox_overlay_bg_transparent">Overlay background transparency: </label></td>
                  <td>
                    <input type="text" name="lightbox_overlay_bg_transparent" id="lightbox_overlay_bg_transparent" value="<?php echo $row->lightbox_overlay_bg_transparent; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> %
                    <div class="spider_description">Value must be between 0 to 100.</div>
                  </td>
                </tr>
                <tr id="lightbox_bg">
                  <td class="spider_label"><label for="lightbox_bg_color">Lightbox background color: </label></td>
                  <td>
                    <input type="text" name="lightbox_bg_color" id="lightbox_bg_color" value="<?php echo $row->lightbox_bg_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr id="lightbox_cntrl1">
                  <td class="spider_label"><label for="lightbox_ctrl_btn_height">Control buttons height: </label></td>
                  <td>
                    <input type="text" name="lightbox_ctrl_btn_height" id="lightbox_ctrl_btn_height" value="<?php echo $row->lightbox_ctrl_btn_height; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr id="lightbox_cntrl2">
                  <td class="spider_label"><label for="lightbox_ctrl_btn_margin_top">Control buttons margin (top): </label></td>
                  <td>
                    <input type="text" name="lightbox_ctrl_btn_margin_top" id="lightbox_ctrl_btn_margin_top" value="<?php echo $row->lightbox_ctrl_btn_margin_top; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr id="lightbox_cntrl3">
                  <td class="spider_label"><label for="lightbox_ctrl_btn_margin_left">Control buttons margin (left): </label></td>
                  <td>
                    <input type="text" name="lightbox_ctrl_btn_margin_left" id="lightbox_ctrl_btn_margin_left" value="<?php echo $row->lightbox_ctrl_btn_margin_left; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr id="lightbox_cntrl9">
                  <td class="spider_label"><label>Control buttons position: </label></td>
                  <td>
                    <input type="radio" name="lightbox_ctrl_btn_pos" id="lightbox_ctrl_btn_pos1" value="top"<?php if ($row->lightbox_ctrl_btn_pos == "top") echo 'checked="checked"'; ?> />
                    <label for="lightbox_ctrl_btn_pos1" id="lightbox_ctrl_btn_pos1_lbl">Top</label>
                    <input type="radio" name="lightbox_ctrl_btn_pos" id="lightbox_ctrl_btn_pos0" value="bottom"<?php if ($row->lightbox_ctrl_btn_pos == "bottom") echo 'checked="checked"'; ?> />
                    <label for="lightbox_ctrl_btn_pos0" id="lightbox_ctrl_btn_pos0_lbl">Bottom</label>
                  </td>
                </tr>
                <tr id="lightbox_cntrl8">
                  <td class="spider_label"><label for="lightbox_ctrl_cont_bg_color">Control buttons background color: </label></td>
                  <td>
                    <input type="text" name="lightbox_ctrl_cont_bg_color" id="lightbox_ctrl_cont_bg_color" value="<?php echo $row->lightbox_ctrl_cont_bg_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr id="lightbox_cntrl5">
                  <td class="spider_label"><label for="lightbox_ctrl_cont_border_radius">Control buttons container border radius: </label></td>
                  <td>
                    <input type="text" name="lightbox_ctrl_cont_border_radius" id="lightbox_ctrl_cont_border_radius" value="<?php echo $row->lightbox_ctrl_cont_border_radius; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr id="lightbox_cntrl6">
                  <td class="spider_label"><label for="lightbox_ctrl_cont_transparent">Control buttons container background transparency: </label></td>
                  <td>
                    <input type="text" name="lightbox_ctrl_cont_transparent" id="lightbox_ctrl_cont_transparent" value="<?php echo $row->lightbox_ctrl_cont_transparent; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> %
                    <div class="spider_description">Value must be between 0 to 100.</div>
                  </td>
                </tr>
                <tr id="lightbox_cntrl10">
                  <td class="spider_label"><label for="lightbox_ctrl_btn_align0">Control buttons alignment: </label></td>
                  <td>
                    <select name="lightbox_ctrl_btn_align" id="lightbox_ctrl_btn_align">
                      <?php
                      foreach ($aligns as $key => $align) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->lightbox_ctrl_btn_align == $key) ? 'selected="selected"' : ''); ?>><?php echo $align; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr id="lightbox_cntrl7">
                  <td class="spider_label"><label for="lightbox_ctrl_btn_color">Control buttons color: </label></td>
                  <td>
                    <input type="text" name="lightbox_ctrl_btn_color" id="lightbox_ctrl_btn_color" value="<?php echo $row->lightbox_ctrl_btn_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr id="lightbox_cntrl4">
                  <td class="spider_label"><label for="lightbox_ctrl_btn_transparent">Control buttons transparency: </label></td>
                  <td>
                    <input type="text" name="lightbox_ctrl_btn_transparent" id="lightbox_ctrl_btn_transparent" value="<?php echo $row->lightbox_ctrl_btn_transparent; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> %
                    <div class="spider_description">Value must be between 0 to 100.</div>
                  </td>
                </tr>
                <tr id="lightbox_toggle1">
                  <td class="spider_label"><label for="lightbox_toggle_btn_height">Toggle button height: </label></td>
                  <td>
                    <input type="text" name="lightbox_toggle_btn_height" id="lightbox_toggle_btn_height" value="<?php echo $row->lightbox_toggle_btn_height; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr id="lightbox_toggle2">
                  <td class="spider_label"><label for="lightbox_toggle_btn_width">Toggle button width: </label></td>
                  <td>
                    <input type="text" name="lightbox_toggle_btn_width" id="lightbox_toggle_btn_width" value="<?php echo $row->lightbox_toggle_btn_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr id="lightbox_close1">
                  <td class="spider_label"><label for="lightbox_close_btn_border_radius">Close button border radius: </label>
                  </td>
                  <td>
                    <input type="text" name="lightbox_close_btn_border_radius" id="lightbox_close_btn_border_radius" value="<?php echo $row->lightbox_close_btn_border_radius; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr id="lightbox_close2">
                  <td class="spider_label"><label for="lightbox_close_btn_border_width">Close button border width: </label></td>
                  <td>
                    <input type="text" name="lightbox_close_btn_border_width" id="lightbox_close_btn_border_width" value="<?php echo $row->lightbox_close_btn_border_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr id="lightbox_close12">
                  <td class="spider_label"><label for="lightbox_close_btn_border_style">Close button border style: </label></td>
                  <td>
                    <select name="lightbox_close_btn_border_style" id="lightbox_close_btn_border_style">
                      <?php
                      foreach ($border_styles as $key => $border_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->lightbox_close_btn_border_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $border_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr id="lightbox_close13">
                  <td class="spider_label"><label for="lightbox_close_btn_border_color">Close button border color: </label></td>
                  <td>
                    <input type="text" name="lightbox_close_btn_border_color" id="lightbox_close_btn_border_color" value="<?php echo $row->lightbox_close_btn_border_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr id="lightbox_close3">
                  <td class="spider_label"><label for="lightbox_close_btn_box_shadow">Close button box shadow: </label></td>
                  <td>
                    <input type="text" name="lightbox_close_btn_box_shadow" id="lightbox_close_btn_box_shadow" value="<?php echo $row->lightbox_close_btn_box_shadow; ?>" class="spider_box_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr id="lightbox_close11">
                  <td class="spider_label"><label for="lightbox_close_btn_bg_color">Close button background color: </label></td>
                  <td>
                    <input type="text" name="lightbox_close_btn_bg_color" id="lightbox_close_btn_bg_color" value="<?php echo $row->lightbox_close_btn_bg_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr id="lightbox_close9">
                  <td class="spider_label"><label for="lightbox_close_btn_transparent">Close button transparency: </label></td>
                  <td>
                    <input type="text" name="lightbox_close_btn_transparent" id="lightbox_close_btn_transparent" value="<?php echo $row->lightbox_close_btn_transparent; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> %
                  </td>
                </tr>
                <tr id="lightbox_close5">
                  <td class="spider_label"><label for="lightbox_close_btn_width">Close button width: </label></td>
                  <td>
                    <input type="text" name="lightbox_close_btn_width" id="lightbox_close_btn_width" value="<?php echo $row->lightbox_close_btn_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr id="lightbox_close6">
                  <td class="spider_label"><label for="lightbox_close_btn_height">Close button height: </label></td>
                  <td>
                    <input type="text" name="lightbox_close_btn_height" id="lightbox_close_btn_height" value="<?php echo $row->lightbox_close_btn_height; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr id="lightbox_close7">
                  <td class="spider_label"><label for="lightbox_close_btn_top">Close button top: </label></td>
                  <td>
                    <input type="text" name="lightbox_close_btn_top" id="lightbox_close_btn_top" value="<?php echo $row->lightbox_close_btn_top; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr id="lightbox_close8">
                  <td class="spider_label"><label for="lightbox_close_btn_right">Close button right: </label></td>
                  <td>
                    <input type="text" name="lightbox_close_btn_right" id="lightbox_close_btn_right" value="<?php echo $row->lightbox_close_btn_right; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr id="lightbox_close4">
                  <td class="spider_label"><label for="lightbox_close_btn_size">Close button size: </label></td>
                  <td>
                    <input type="text" name="lightbox_close_btn_size" id="lightbox_close_btn_size" value="<?php echo $row->lightbox_close_btn_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr id="lightbox_close14">
                  <td class="spider_label"><label for="lightbox_close_btn_color">Close button color: </label></td>
                  <td>
                    <input type="text" name="lightbox_close_btn_color" id="lightbox_close_btn_color" value="<?php echo $row->lightbox_close_btn_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr id="lightbox_close10">
                  <td class="spider_label"><label for="lightbox_close_btn_full_color">Fullscreen close button color: </label></td>
                  <td>
                    <input type="text" name="lightbox_close_btn_full_color" id="lightbox_close_btn_full_color" value="<?php echo $row->lightbox_close_btn_full_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr id="lightbox_comment24">
                  <td class="spider_label"><label for="lightbox_comment_share_button_color">Share buttons color: </label></td>
                  <td>
                    <input type="text" name="lightbox_comment_share_button_color" id="lightbox_comment_share_button_color" value="<?php echo $row->lightbox_comment_share_button_color; ?>" class="color" />
                  </td>
                </tr>
              </tbody>
            </table>
          </fieldset>
          <fieldset class="spider_child_fieldset" id="Lightbox_2">
            <table style="clear:both;">
              <tbody>
                <tr id="lightbox_right_left11">
                  <td class="spider_label"><label for="lightbox_rl_btn_style">Right, left buttons style: </label></td>
                  <td>
                    <select name="lightbox_rl_btn_style" id="lightbox_rl_btn_style" class="spider_int_input">
                      <?php
                      foreach ($button_styles as $key => $button_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->lightbox_rl_btn_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $button_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr id="lightbox_right_left7">
                  <td class="spider_label"><label for="lightbox_rl_btn_bg_color">Right, left buttons background color: </label></td>
                  <td>
                    <input type="text" name="lightbox_rl_btn_bg_color" id="lightbox_rl_btn_bg_color" value="<?php echo $row->lightbox_rl_btn_bg_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_rl_btn_transparent">Right, left buttons transparency: </label></td>
                  <td>
                    <input type="text" name="lightbox_rl_btn_transparent" id="lightbox_rl_btn_transparent" value="<?php echo $row->lightbox_rl_btn_transparent; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> %
                  </td>
                </tr>
                <tr id="lightbox_right_left3">
                  <td class="spider_label"><label for="lightbox_rl_btn_box_shadow">Right, left buttons box shadow: </label></td>
                  <td>
                    <input type="text" name="lightbox_rl_btn_box_shadow" id="lightbox_rl_btn_box_shadow" value="<?php echo $row->lightbox_rl_btn_box_shadow; ?>" class="spider_box_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr id="lightbox_right_left4">
                  <td class="spider_label"><label for="lightbox_rl_btn_height">Right, left buttons height: </label></td>
                  <td>
                    <input type="text" name="lightbox_rl_btn_height" id="lightbox_rl_btn_height" value="<?php echo $row->lightbox_rl_btn_height; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr id="lightbox_right_left5">
                  <td class="spider_label"><label for="lightbox_rl_btn_width">Right, left buttons width: </label></td>
                  <td>
                    <input type="text" name="lightbox_rl_btn_width" id="lightbox_rl_btn_width" value="<?php echo $row->lightbox_rl_btn_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr id="lightbox_right_left6">
                  <td class="spider_label"><label for="lightbox_rl_btn_size">Right, left buttons size: </label></td>
                  <td>
                    <input type="text" name="lightbox_rl_btn_size" id="lightbox_rl_btn_size" value="<?php echo $row->lightbox_rl_btn_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr id="lightbox_close15">
                  <td class="spider_label"><label for="lightbox_close_rl_btn_hover_color">Right, left, close buttons hover color: </label></td>
                  <td>
                    <input type="text" name="lightbox_close_rl_btn_hover_color" id="lightbox_close_rl_btn_hover_color" value="<?php echo $row->lightbox_close_rl_btn_hover_color; ?>" class="color" />
                  </td>
                </tr>
                <tr id="lightbox_right_left10">
                  <td class="spider_label"><label for="lightbox_rl_btn_color">Right, left buttons color: </label></td>
                  <td>
                    <input type="text" name="lightbox_rl_btn_color" id="lightbox_rl_btn_color" value="<?php echo $row->lightbox_rl_btn_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr id="lightbox_right_left1">
                  <td class="spider_label"><label for="lightbox_rl_btn_border_radius">Right, left buttons border radius: </label></td>
                  <td>
                    <input type="text" name="lightbox_rl_btn_border_radius" id="lightbox_rl_btn_border_radius" value="<?php echo $row->lightbox_rl_btn_border_radius; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr id="lightbox_right_left2">
                  <td class="spider_label"><label for="lightbox_rl_btn_border_width">Right, left buttons border width: </label></td>
                  <td>
                    <input type="text" name="lightbox_rl_btn_border_width" id="lightbox_rl_btn_border_width" value="<?php echo $row->lightbox_rl_btn_border_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr id="lightbox_right_left8">
                  <td class="spider_label"><label for="lightbox_rl_btn_border_style">Right, left buttons border style: </label></td>
                  <td>
                    <select name="lightbox_rl_btn_border_style" id="lightbox_rl_btn_border_style">
                      <?php
                      foreach ($border_styles as $key => $border_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->lightbox_rl_btn_border_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $border_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr id="lightbox_right_left9">
                  <td class="spider_label"><label for="lightbox_rl_btn_border_color">Right, left buttons border color: </label></td>
                  <td>
                    <input type="text" name="lightbox_rl_btn_border_color" id="lightbox_rl_btn_border_color" value="<?php echo $row->lightbox_rl_btn_border_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr id="lightbox_filmstrip12">
                  <td class="spider_label"><label>Filmstrip position: </label></td>
                  <td>
                    <select name="lightbox_filmstrip_pos" id="lightbox_filmstrip_pos">
                      <option value="top" <?php echo (($row->lightbox_filmstrip_pos == "top") ? 'selected="selected"' : ''); ?>>Top</option>
                      <option value="right" <?php echo (($row->lightbox_filmstrip_pos == "right") ? 'selected="selected"' : ''); ?>>Right</option>
                      <option value="bottom" <?php echo (($row->lightbox_filmstrip_pos == "bottom") ? 'selected="selected"' : ''); ?>>Bottom</option>
                      <option value="left" <?php echo (($row->lightbox_filmstrip_pos == "left") ? 'selected="selected"' : ''); ?>>Left</option>
                    </select>
                  </td>
                </tr>
                <tr id="lightbox_filmstrip2">
                  <td class="spider_label"><label for="lightbox_filmstrip_thumb_margin">Filmstrip thumbnail margin: </label></td>
                  <td>
                    <input type="text" name="lightbox_filmstrip_thumb_margin" id="lightbox_filmstrip_thumb_margin" value="<?php echo $row->lightbox_filmstrip_thumb_margin; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr id="lightbox_filmstrip3">
                  <td class="spider_label"><label for="lightbox_filmstrip_thumb_border_width">Filmstrip thumbnail border width: </label></td>
                  <td>
                    <input type="text" name="lightbox_filmstrip_thumb_border_width" id="lightbox_filmstrip_thumb_border_width" value="<?php echo $row->lightbox_filmstrip_thumb_border_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr id="lightbox_filmstrip9">
                  <td class="spider_label"><label for="lightbox_filmstrip_thumb_border_style">Filmstrip thumbnail border style: </label></td>
                  <td>
                    <select name="lightbox_filmstrip_thumb_border_style" id="lightbox_filmstrip_thumb_border_style">
                      <?php
                      foreach ($border_styles as $key => $border_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->lightbox_filmstrip_thumb_border_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $border_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr id="lightbox_filmstrip10">
                  <td class="spider_label"><label for="lightbox_filmstrip_thumb_border_color">Filmstrip thumbnail border color: </label></td>
                  <td>
                    <input type="text" name="lightbox_filmstrip_thumb_border_color" id="lightbox_filmstrip_thumb_border_color" value="<?php echo $row->lightbox_filmstrip_thumb_border_color; ?>" class="color" />
                  </td>
                </tr>
                <tr id="lightbox_filmstrip4">
                  <td class="spider_label"><label for="lightbox_filmstrip_thumb_border_radius">Filmstrip thumbnail border radius: </label></td>
                  <td>
                    <input type="text" name="lightbox_filmstrip_thumb_border_radius" id="lightbox_filmstrip_thumb_border_radius" value="<?php echo $row->lightbox_filmstrip_thumb_border_radius; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr id="lightbox_filmstrip6">
                  <td class="spider_label"><label for="lightbox_filmstrip_thumb_active_border_width">Filmstrip thumbnail active border width: </label></td>
                  <td>
                    <input type="text" name="lightbox_filmstrip_thumb_active_border_width" id="lightbox_filmstrip_thumb_active_border_width" value="<?php echo $row->lightbox_filmstrip_thumb_active_border_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr id="lightbox_filmstrip11">
                  <td class="spider_label"> <label for="lightbox_filmstrip_thumb_active_border_color">Filmstrip thumbnail active border color:</label></td>
                  <td>
                    <input type="text" name="lightbox_filmstrip_thumb_active_border_color" id="lightbox_filmstrip_thumb_active_border_color" value="<?php echo $row->lightbox_filmstrip_thumb_active_border_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr id="lightbox_filmstrip5">
                  <td class="spider_label"><label for="lightbox_filmstrip_thumb_deactive_transparent">Filmstrip thumbnail deactive transparency: </label></td>
                  <td>
                    <input type="text" name="lightbox_filmstrip_thumb_deactive_transparent" id="lightbox_filmstrip_thumb_deactive_transparent" value="<?php echo $row->lightbox_filmstrip_thumb_deactive_transparent; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> %
                    <div class="spider_description">Value must be between 0 to 100.</div>
                  </td>
                </tr>
                <tr id="lightbox_filmstrip1">
                  <td class="spider_label"><label for="lightbox_filmstrip_rl_btn_size">Filmstrip right, left buttons size: </label></td>
                  <td>
                    <input type="text" name="lightbox_filmstrip_rl_btn_size" id="lightbox_filmstrip_rl_btn_size" value="<?php echo $row->lightbox_filmstrip_rl_btn_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr id="lightbox_filmstrip7">
                  <td class="spider_label"><label for="lightbox_filmstrip_rl_btn_color">Filmstrip right, left buttons color: </label></td>
                  <td>
                    <input type="text" name="lightbox_filmstrip_rl_btn_color" id="lightbox_filmstrip_rl_btn_color" value="<?php echo $row->lightbox_filmstrip_rl_btn_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr id="lightbox_filmstrip8">
                  <td class="spider_label"><label for="lightbox_filmstrip_rl_bg_color">Filmstrip right, left button background color:</label></td>
                  <td>
                    <input type="text" name="lightbox_filmstrip_rl_bg_color" id="lightbox_filmstrip_rl_bg_color" value="<?php echo $row->lightbox_filmstrip_rl_bg_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_rate_pos1">Rating position: </label></td>
                  <td>
                    <input type="radio" name="lightbox_rate_pos" id="lightbox_rate_pos1" value="top" <?php if ($row->lightbox_rate_pos == "top") echo 'checked="checked"'; ?> />
                    <label for="lightbox_rate_pos1" id="lightbox_rate_pos1_lbl">Top</label>
                    <input type="radio" name="lightbox_rate_pos" id="lightbox_rate_pos0" value="bottom" <?php if ($row->lightbox_rate_pos == "bottom") echo 'checked="checked"'; ?> />
                    <label for="lightbox_rate_pos0" id="lightbox_rate_pos0_lbl">Bottom</label>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_rate_align">Rating alignment: </label></td>
                  <td>
                    <select name="lightbox_rate_align" id="lightbox_rate_align">
                      <?php
                      foreach ($aligns as $key => $align) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->lightbox_rate_align == $key) ? 'selected="selected"' : ''); ?>><?php echo $align; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_rate_icon">Rating icon: </label></td>
                  <td>
                    <select name="lightbox_rate_icon" id="lightbox_rate_icon">
                      <?php
                      foreach ($rate_icons as $key => $rate_icon) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->lightbox_rate_icon == $key) ? 'selected="selected"' : ''); ?>><?php echo $rate_icon; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_rate_color">Rating color: </label></td>
                  <td>
                    <input type="text" name="lightbox_rate_color" id="lightbox_rate_color" value="<?php echo $row->lightbox_rate_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_rate_hover_color">Rating hover color: </label></td>
                  <td>
                    <input type="text" name="lightbox_rate_hover_color" id="lightbox_rate_hover_color" value="<?php echo $row->lightbox_rate_hover_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_rate_size">Rating size: </label></td>
                  <td>
                    <input type="text" name="lightbox_rate_size" id="lightbox_rate_size" value="<?php echo $row->lightbox_rate_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_rate_stars_count">Rating icon count: </label></td>
                  <td>
                    <input type="text" name="lightbox_rate_stars_count" id="lightbox_rate_stars_count" value="<?php echo $row->lightbox_rate_stars_count; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_rate_padding">Rating padding: </label></td>
                  <td>
                    <input type="text" name="lightbox_rate_padding" id="lightbox_rate_padding" value="<?php echo $row->lightbox_rate_padding; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label>Hit counter position: </label></td>
                  <td>
                    <input type="radio" name="lightbox_hit_pos" id="lightbox_hit_pos1" value="top" <?php if ($row->lightbox_hit_pos == "top") echo 'checked="checked"'; ?> />
                    <label for="lightbox_hit_pos1" id="lightbox_hit_pos1_lbl">Top</label>
                    <input type="radio" name="lightbox_hit_pos" id="lightbox_hit_pos0" value="bottom" <?php if ($row->lightbox_hit_pos == "bottom") echo 'checked="checked"'; ?> />
                    <label for="lightbox_hit_pos0" id="lightbox_hit_pos0_lbl">Bottom</label>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_hit_align">Hit counter alignment: </label></td>
                  <td>
                    <select name="lightbox_hit_align" id="lightbox_hit_align">
                      <?php
                      foreach ($aligns as $key => $align) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->lightbox_hit_align == $key) ? 'selected="selected"' : ''); ?>><?php echo $align; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_hit_bg_color">Hit counter background color: </label></td>
                  <td>
                    <input type="text" name="lightbox_hit_bg_color" id="lightbox_hit_bg_color" value="<?php echo $row->lightbox_hit_bg_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_hit_bg_transparent">Hit counter background transparency: </label></td>
                  <td>
                    <input type="text" name="lightbox_hit_bg_transparent" id="lightbox_hit_bg_transparent" value="<?php echo $row->lightbox_hit_bg_transparent; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> %
                    <div class="spider_description">Value must be between 0 to 100.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_hit_border_width">Hit counter border width: </label></td>
                  <td>
                    <input type="text" name="lightbox_hit_border_width" id="lightbox_hit_border_width" value="<?php echo $row->lightbox_hit_border_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_hit_border_style">Hit counter border style: </label></td>
                  <td>
                    <select name="lightbox_hit_border_style" id="lightbox_hit_border_style">
                      <?php
                      foreach ($border_styles as $key => $border_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->lightbox_hit_border_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $border_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_hit_border_color">Hit counter border color: </label></td>
                  <td>
                    <input type="text" name="lightbox_hit_border_color" id="lightbox_hit_border_color" value="<?php echo $row->lightbox_hit_border_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_hit_border_radius">Hit counter border radius: </label></td>
                  <td>
                    <input type="text" name="lightbox_hit_border_radius" id="lightbox_hit_border_radius" value="<?php echo $row->lightbox_hit_border_radius; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_hit_padding">Hit counter padding: </label></td>
                  <td>
                    <input type="text" name="lightbox_hit_padding" id="lightbox_hit_padding" value="<?php echo $row->lightbox_hit_padding; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_hit_margin">Hit counter margin: </label></td>
                  <td>
                    <input type="text" name="lightbox_hit_margin" id="lightbox_hit_margin" value="<?php echo $row->lightbox_hit_margin; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_hit_color">Hit counter font color: </label></td>
                  <td>
                    <input type="text" name="lightbox_hit_color" id="lightbox_hit_color" value="<?php echo $row->lightbox_hit_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_hit_font_style">Hit counter font family: </label></td>
                  <td>
                    <select name="lightbox_hit_font_style" id="lightbox_hit_font_style">
                      <?php
                      foreach ($font_families as $key => $font_family) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->lightbox_hit_font_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $font_family; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_hit_font_weight">Hit counter font weight: </label></td>
                  <td>
                    <select name="lightbox_hit_font_weight" id="lightbox_hit_font_weight">
                      <?php
                      foreach ($font_weights as $key => $font_weight) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->lightbox_hit_font_weight == $key) ? 'selected="selected"' : ''); ?>><?php echo $font_weight; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_hit_font_size">Hit counter font size: </label>
                  </td>
                  <td>
                    <input type="text" name="lightbox_hit_font_size" id="lightbox_hit_font_size" value="<?php echo $row->lightbox_hit_font_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
              </tbody>
            </table>
          </fieldset>
          <fieldset class="spider_child_fieldset" id="Lightbox_3">
            <table style="clear:both;">
              <tbody>
                <tr>
                  <td class="spider_label"><label>Info position: </label></td>
                  <td>
                    <input type="radio" name="lightbox_info_pos" id="lightbox_info_pos1" value="top" <?php if ($row->lightbox_info_pos == "top") echo 'checked="checked"'; ?> />
                    <label for="lightbox_info_pos1" id="lightbox_info_pos1_lbl">Top</label>
                    <input type="radio" name="lightbox_info_pos" id="lightbox_info_pos0" value="bottom" <?php if ($row->lightbox_info_pos == "bottom") echo 'checked="checked"'; ?> />
                    <label for="lightbox_info_pos0" id="lightbox_info_pos0_lbl">Bottom</label>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_info_align">Info alignment: </label></td>
                  <td>
                    <select name="lightbox_info_align" id="lightbox_info_align">
                      <?php
                      foreach ($aligns as $key => $align) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->lightbox_info_align == $key) ? 'selected="selected"' : ''); ?>><?php echo $align; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_info_bg_color">Info background color: </label></td>
                  <td>
                    <input type="text" name="lightbox_info_bg_color" id="lightbox_info_bg_color" value="<?php echo $row->lightbox_info_bg_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_info_bg_transparent">Info background transparency: </label></td>
                  <td>
                    <input type="text" name="lightbox_info_bg_transparent" id="lightbox_info_bg_transparent" value="<?php echo $row->lightbox_info_bg_transparent; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> %
                    <div class="spider_description">Value must be between 0 to 100.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_info_border_width">Info border width: </label></td>
                  <td>
                    <input type="text" name="lightbox_info_border_width" id="lightbox_info_border_width" value="<?php echo $row->lightbox_info_border_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_info_border_style">Info border style: </label></td>
                  <td>
                    <select name="lightbox_info_border_style" id="lightbox_info_border_style">
                      <?php
                      foreach ($border_styles as $key => $border_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->lightbox_info_border_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $border_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_info_border_color">Info border color: </label></td>
                  <td>
                    <input type="text" name="lightbox_info_border_color" id="lightbox_info_border_color" value="<?php echo $row->lightbox_info_border_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_info_border_radius">Info border radius: </label></td>
                  <td>
                    <input type="text" name="lightbox_info_border_radius" id="lightbox_info_border_radius" value="<?php echo $row->lightbox_info_border_radius; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_info_padding">Info padding: </label></td>
                  <td>
                    <input type="text" name="lightbox_info_padding" id="lightbox_info_padding" value="<?php echo $row->lightbox_info_padding; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_info_margin">Info margin: </label></td>
                  <td>
                    <input type="text" name="lightbox_info_margin" id="lightbox_info_margin" value="<?php echo $row->lightbox_info_margin; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_title_color">Title font color: </label></td>
                  <td>
                    <input type="text" name="lightbox_title_color" id="lightbox_title_color" value="<?php echo $row->lightbox_title_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_title_font_style">Title font family: </label></td>
                  <td>
                    <select name="lightbox_title_font_style" id="lightbox_title_font_style">
                      <?php
                      foreach ($font_families as $key => $font_family) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->lightbox_title_font_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $font_family; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_title_font_weight">Title font weight: </label></td>
                  <td>
                    <select name="lightbox_title_font_weight" id="lightbox_title_font_weight">
                      <?php
                      foreach ($font_weights as $key => $font_weight) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->lightbox_title_font_weight == $key) ? 'selected="selected"' : ''); ?>><?php echo $font_weight; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_title_font_size">Title font size: </label>
                  </td>
                  <td>
                    <input type="text" name="lightbox_title_font_size" id="lightbox_title_font_size" value="<?php echo $row->lightbox_title_font_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_description_color">Description font color: </label></td>
                  <td>
                    <input type="text" name="lightbox_description_color" id="lightbox_description_color" value="<?php echo $row->lightbox_description_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_description_font_style">Description font family: </label></td>
                  <td>
                    <select name="lightbox_description_font_style" id="lightbox_description_font_style">
                      <?php
                      foreach ($font_families as $key => $font_family) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->lightbox_description_font_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $font_family; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_description_font_weight">Description font weight: </label></td>
                  <td>
                    <select name="lightbox_description_font_weight" id="lightbox_description_font_weight">
                      <?php
                      foreach ($font_weights as $key => $font_weight) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->lightbox_description_font_weight == $key) ? 'selected="selected"' : ''); ?>><?php echo $font_weight; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_description_font_size">Description font size: </label>
                  </td>
                  <td>
                    <input type="text" name="lightbox_description_font_size" id="lightbox_description_font_size" value="<?php echo $row->lightbox_description_font_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="lightbox_comment_width">Comments Width: </label></td>
                  <td>
                    <input type="text" name="lightbox_comment_width" id="lightbox_comment_width" value="<?php echo $row->lightbox_comment_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr id="lightbox_comment25">
                  <td class="spider_label"><label>Comments position: </label></td>
                  <td>
                    <input type="radio" name="lightbox_comment_pos" id="lightbox_comment_pos1" value="left"<?php if ($row->lightbox_comment_pos == "left") echo 'checked="checked"'; ?> />
                    <label for="lightbox_comment_pos1" id="lightbox_comment_pos1_lbl">Left</label>
                    <input type="radio" name="lightbox_comment_pos" id="lightbox_comment_pos0" value="right"<?php if ($row->lightbox_comment_pos == "right") echo 'checked="checked"'; ?> />
                    <label for="lightbox_comment_pos0" id="lightbox_comment_pos0_lbl">Right</label>
                  </td>
                </tr>
                <tr id="lightbox_comment13">
                  <td class="spider_label"><label for="lightbox_comment_bg_color">Comments background color: </label></td>
                  <td>
                    <input type="text" name="lightbox_comment_bg_color" id="lightbox_comment_bg_color" value="<?php echo $row->lightbox_comment_bg_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr id="lightbox_comment2">
                  <td class="spider_label"><label for="lightbox_comment_font_size">Comments font size: </label></td>
                  <td>
                    <input type="text" name="lightbox_comment_font_size" id="lightbox_comment_font_size" value="<?php echo $row->lightbox_comment_font_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr id="lightbox_comment14">
                  <td class="spider_label"><label for="lightbox_comment_font_color">Comments font color:</label></td>
                  <td>
                    <input type="text" name="lightbox_comment_font_color" id="lightbox_comment_font_color" value="<?php echo $row->lightbox_comment_font_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr id="lightbox_comment15">
                  <td class="spider_label"><label for="lightbox_comment_font_style">Comments font family: </label></td>
                  <td>
                    <select name="lightbox_comment_font_style" id="lightbox_comment_font_style">
                      <?php
                      foreach ($font_families as $key => $font_family) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->lightbox_comment_font_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $font_family; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr id="lightbox_comment10">
                  <td class="spider_label"><label for="lightbox_comment_author_font_size">Comments author font size: </label>
                  </td>
                  <td>
                    <input type="text" name="lightbox_comment_author_font_size" id="lightbox_comment_author_font_size" value="<?php echo $row->lightbox_comment_author_font_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr id="lightbox_comment11">
                  <td class="spider_label"><label for="lightbox_comment_date_font_size">Comments date font size: </label></td>
                  <td>
                    <input type="text" name="lightbox_comment_date_font_size" id="lightbox_comment_date_font_size" value="<?php echo $row->lightbox_comment_date_font_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr id="lightbox_comment12">
                  <td class="spider_label"><label for="lightbox_comment_body_font_size">Comments body font size: </label></td>
                  <td>
                    <input type="text" name="lightbox_comment_body_font_size" id="lightbox_comment_body_font_size" value="<?php echo $row->lightbox_comment_body_font_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr id="lightbox_comment6">
                  <td class="spider_label"><label for="lightbox_comment_input_border_width">Comment input border width: </label></td>
                  <td>
                    <input type="text" name="lightbox_comment_input_border_width" id="lightbox_comment_input_border_width" value="<?php echo $row->lightbox_comment_input_border_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr id="lightbox_comment21">
                  <td class="spider_label"><label for="lightbox_comment_input_border_style">Comment input border style: </label></td>
                  <td>
                    <select name="lightbox_comment_input_border_style" id="lightbox_comment_input_border_style">
                      <?php
                      foreach ($border_styles as $key => $border_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->lightbox_comment_input_border_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $border_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr id="lightbox_comment20">
                  <td class="spider_label"><label for="lightbox_comment_input_border_color">Comment input border color: </label></td>
                  <td>
                    <input type="text" name="lightbox_comment_input_border_color" id="lightbox_comment_input_border_color" value="<?php echo $row->lightbox_comment_input_border_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr id="lightbox_comment7">
                  <td class="spider_label"><label for="lightbox_comment_input_border_radius">Comment input border radius: </label></td>
                  <td>
                    <input type="text" name="lightbox_comment_input_border_radius" id="lightbox_comment_input_border_radius" value="<?php echo $row->lightbox_comment_input_border_radius; ?>" class="spider_char_input"/>
                  </td>
                </tr>
                <tr id="lightbox_comment8">
                  <td class="spider_label"><label for="lightbox_comment_input_padding">Comment input padding: </label></td>
                  <td>
                    <input type="text" name="lightbox_comment_input_padding" id="lightbox_comment_input_padding" value="<?php echo $row->lightbox_comment_input_padding; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr id="lightbox_comment19">
                  <td class="spider_label"><label for="lightbox_comment_input_bg_color">Comment input background color: </label></td>
                  <td>
                    <input type="text" name="lightbox_comment_input_bg_color" id="lightbox_comment_input_bg_color" value="<?php echo $row->lightbox_comment_input_bg_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr id="lightbox_comment16">
                  <td class="spider_label"><label for="lightbox_comment_button_bg_color">Comment button background color: </label></td>
                  <td>
                    <input type="text" name="lightbox_comment_button_bg_color" id="lightbox_comment_button_bg_color" value="<?php echo $row->lightbox_comment_button_bg_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr id="lightbox_comment5">
                  <td class="spider_label"><label for="lightbox_comment_button_padding">Comment button padding: </label></td>
                  <td>
                    <input type="text" name="lightbox_comment_button_padding" id="lightbox_comment_button_padding" value="<?php echo $row->lightbox_comment_button_padding; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr id="lightbox_comment3">
                  <td class="spider_label"><label for="lightbox_comment_button_border_width">Comment button border width: </label></td>
                  <td>
                    <input type="text" name="lightbox_comment_button_border_width" id="lightbox_comment_button_border_width" value="<?php echo $row->lightbox_comment_button_border_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr id="lightbox_comment18">
                  <td class="spider_label"><label for="lightbox_comment_button_border_style">Comment button border style: </label></td>
                  <td>
                    <select name="lightbox_comment_button_border_style" id="lightbox_comment_button_border_style">
                      <?php
                      foreach ($border_styles as $key => $border_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->lightbox_comment_button_border_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $border_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr id="lightbox_comment17">
                  <td class="spider_label"><label for="lightbox_comment_button_border_color">Comment button border color: </label></td>
                  <td>
                    <input type="text" name="lightbox_comment_button_border_color" id="lightbox_comment_button_border_color" value="<?php echo $row->lightbox_comment_button_border_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr id="lightbox_comment4">
                  <td class="spider_label"><label for="lightbox_comment_button_border_radius">Comment button border radius: </label></td>
                  <td>
                    <input type="text" name="lightbox_comment_button_border_radius" id="lightbox_comment_button_border_radius" value="<?php echo $row->lightbox_comment_button_border_radius; ?>" class="spider_char_input" />
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr id="lightbox_comment9">
                  <td class="spider_label"><label for="lightbox_comment_separator_width">Comment separator width: </label></td>
                  <td>
                    <input type="text" name="lightbox_comment_separator_width" id="lightbox_comment_separator_width" value="<?php echo $row->lightbox_comment_separator_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr id="lightbox_comment22">
                  <td class="spider_label"><label for="lightbox_comment_separator_style">Comment separator style: </label></td>
                  <td>
                    <select name="lightbox_comment_separator_style" id="lightbox_comment_separator_style">
                      <?php
                      foreach ($border_styles as $key => $border_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->lightbox_comment_separator_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $border_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr id="lightbox_comment23">
                  <td class="spider_label"><label for="lightbox_comment_separator_color">Comment separator color: </label></td>
                  <td>
                    <input type="text" name="lightbox_comment_separator_color" id="lightbox_comment_separator_color" value="<?php echo $row->lightbox_comment_separator_color; ?>" class="color"/>
                  </td>
                </tr>
              </tbody>
            </table>
          </fieldset>
        </fieldset>

        <fieldset class="spider_type_fieldset" id="Navigation">
          <fieldset class="spider_child_fieldset" id="Navigation_1">
            <table style="clear:both;">
              <tbody>
                <tr>
                  <td class="spider_label"><label for="page_nav_font_size">Font size: </label></td>
                  <td>
                    <input type="text" name="page_nav_font_size" id="page_nav_font_size" value="<?php echo $row->page_nav_font_size; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="page_nav_font_color">Font color: </label></td>
                  <td>
                    <input type="text" name="page_nav_font_color" id="page_nav_font_color" value="<?php echo $row->page_nav_font_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="page_nav_font_style">Font family: </label></td>
                  <td>
                    <select name="page_nav_font_style" id="page_nav_font_style">
                      <?php
                      foreach ($font_families as $key => $font_family) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->page_nav_font_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $font_family; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="page_nav_font_weight">Font weight: </label></td>
                  <td>
                    <select name="page_nav_font_weight" id="page_nav_font_weight">
                      <?php
                      foreach ($font_weights as $key => $font_weight) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->page_nav_font_weight == $key) ? 'selected="selected"' : ''); ?>><?php echo $font_weight; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="page_nav_border_width">Border width: </label></td>
                  <td>
                    <input type="text" name="page_nav_border_width" id="page_nav_border_width" value="<?php echo $row->page_nav_border_width; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> px
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="page_nav_border_style">Border style: </label></td>
                  <td>
                    <select name="page_nav_border_style" id="page_nav_border_style">
                      <?php
                      foreach ($border_styles as $key => $border_style) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->page_nav_border_style == $key) ? 'selected="selected"' : ''); ?>><?php echo $border_style; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="page_nav_border_color">Border color:</label></td>
                  <td>
                    <input type="text" name="page_nav_border_color" id="page_nav_border_color" value="<?php echo $row->page_nav_border_color; ?>" class="color"/>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="page_nav_border_radius">Border radius: </label></td>
                  <td>
                    <input type="text" name="page_nav_border_radius" id="page_nav_border_radius" value="<?php echo $row->page_nav_border_radius; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
              </tbody>
            </table>
          </fieldset>
          <fieldset class="spider_child_fieldset" id="Navigation_2" style="display:block">
            <table style="clear:both;">
              <tbody>
                <tr>
                  <td class="spider_label"><label for="page_nav_margin">Margin: </label></td>
                  <td>
                    <input type="text" name="page_nav_margin" id="page_nav_margin" value="<?php echo $row->page_nav_margin; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="page_nav_padding">Padding: </label></td>
                  <td>
                    <input type="text" name="page_nav_padding" id="page_nav_padding" value="<?php echo $row->page_nav_padding; ?>" class="spider_char_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="page_nav_button_bg_color">Button background color: </label></td>
                  <td>
                    <input type="text" name="page_nav_button_bg_color" id="page_nav_button_bg_color" value="<?php echo $row->page_nav_button_bg_color; ?>" class="color" />
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="page_nav_button_bg_transparent">Button background transparency: </label></td>
                  <td>
                    <input type="text" name="page_nav_button_bg_transparent" id="page_nav_button_bg_transparent" value="<?php echo $row->page_nav_button_bg_transparent; ?>" class="spider_int_input" onkeypress="return spider_check_isnum(event)"/> %
                    <div class="spider_description">Value must be between 0 to 100.</div>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label>Button transition: </label></td>
                  <td>
                    <input type="radio" name="page_nav_button_transition" id="page_nav_button_transition1" value="1"<?php if ($row->page_nav_button_transition == 1) echo 'checked="checked"'; ?> />
                    <label for="page_nav_button_transition1" id="page_nav_button_transition1_lbl">Yes</label>
                    <input type="radio" name="page_nav_button_transition" id="page_nav_button_transition0" value="0"<?php if ($row->page_nav_button_transition == 0) echo 'checked="checked"'; ?> />
                    <label for="page_nav_button_transition0" id="page_nav_button_transition0_lbl">No</label>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="page_nav_box_shadow">Box shadow: </label></td>
                  <td>
                    <input type="text" name="page_nav_box_shadow" id="page_nav_box_shadow" value="<?php echo $row->page_nav_box_shadow; ?>" class="spider_box_input"/>
                    <div class="spider_description">Use CSS type values.</div>
                  </td>
                </tr>
              </tbody>
            </table>
          </fieldset>
          <fieldset class="spider_child_fieldset" id="Navigation_3">
            <table style="clear:both;">
              <tbody>
                <tr>
                  <td class="spider_label"><label>Position: </label></td>
                  <td id="page_nav_position">
                    <input type="radio" name="page_nav_position" id="page_nav_position1" value="top"<?php if ($row->page_nav_position == "top") echo 'checked="checked"'; ?> />
                    <label for="page_nav_position1" id="page_nav_position1_lbl">Top</label>
                    <input type="radio" name="page_nav_position" id="page_nav_position0" value="bottom"<?php if ($row->page_nav_position == "bottom") echo 'checked="checked"'; ?> />
                    <label for="page_nav_position0" id="page_nav_position0_lbl">Bottom</label>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label for="page_nav_align0">Alignment: </label></td>
                  <td>
                    <select name="page_nav_align" id="page_nav_align">
                      <?php
                      foreach ($aligns as $key => $align) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo (($row->page_nav_align == $key) ? 'selected="selected"' : ''); ?>><?php echo $align; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label>Numbering: </label></td>
                  <td>
                    <input type="radio" name="page_nav_number" id="page_nav_number1" value="1"<?php if ($row->page_nav_number == 1) echo 'checked="checked"'; ?> />
                    <label for="page_nav_number1" id="page_nav_number1_lbl">Yes</label>
                    <input type="radio" name="page_nav_number" id="page_nav_number0" value="0"<?php if ($row->page_nav_number == 0) echo 'checked="checked"'; ?> />
                    <label for="page_nav_number0" id="page_nav_number0_lbl">No</label>
                  </td>
                </tr>
                <tr>
                  <td class="spider_label"><label>Button text: </label></td>
                  <td>
                    <input type="radio" name="page_nav_button_text" id="page_nav_button_text1" value="1"<?php if ($row->page_nav_button_text == 1) echo 'checked="checked"'; ?> />
                    <label for="page_nav_button_text1" id="page_nav_button_text1_lbl">Text</label>
                    <input type="radio" name="page_nav_button_text" id="page_nav_button_text0" value="0"<?php if ($row->page_nav_button_text == 0) echo 'checked="checked"'; ?> />
                    <label for="page_nav_button_text0" id="page_nav_button_text0_lbl">Arrow</label>
                    <div class="spider_description">Next, previous buttons values.</div>
                  </td>
                </tr>
              </tbody>
            </table>
          </fieldset>
        </fieldset>
      </fieldset>
      <input type="hidden" id="task" name="task" value=""/>
      <input type="hidden" id="current_id" name="current_id" value="<?php echo $row->id; ?>"/>
      <input type="hidden" id="default_theme" name="default_theme" value="<?php echo $row->default_theme; ?>"/>
      <script>
        window.onload = bwg_change_theme_type('<?php echo $current_type; ?>');
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