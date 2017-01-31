<?php

class BWGViewEditThumb {
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
    global $WD_BWG_UPLOAD_DIR;
    $popup_width = ((int) (isset($_GET['width']) ? esc_html($_GET['width']) : '800')) - 30;
    $image_width = $popup_width - 40;
    $popup_height = ((int) (isset($_GET['height']) ? esc_html($_GET['height']) : '500')) - 50;
    $image_height = $popup_height - 40;
    $image_id = (isset($_GET['image_id']) ? esc_html($_GET['image_id']) : '0');
    ?>
    <div style="display:table; width:100%; height:<?php echo $popup_height; ?>px;">
      <div id='bwg_container_for_media_1' style="display:table-cell; text-align:center; vertical-align:middle;">
        <img id="image_display" src="" style="max-width:<?php echo $image_width; ?>px; max-height:<?php echo $image_height; ?>px;"/>        
      </div>
    </div>
    <script language="javascript" type="text/javascript" src="<?php echo WD_BWG_URL . '/js/bwg_embed.js?ver='.wd_bwg_version(); ?>"></script>
    <script>
      var file_type = window.parent.document.getElementById("input_filetype_<?php echo $image_id; ?>").value;
      
      var is_embed = file_type.indexOf("EMBED_") > -1 ? true : false;
      var is_instagram_post = file_type.indexOf("INSTAGRAM_POST") > -1 ? true : false;
      if (!is_embed) {
        var image_url = "<?php echo site_url() . '/' . $WD_BWG_UPLOAD_DIR; ?>" + window.parent.document.getElementById("image_url_<?php echo $image_id; ?>").value;
        window.document.getElementById("image_display").src = image_url + "?date=<?php echo date('Y-m-y H:i:s'); ?>";
      }
      else if(is_embed){
        var embed_id = window.parent.document.getElementById("input_filename_<?php echo $image_id; ?>").value;
        window.document.getElementById("image_display").setAttribute('style', 'display: none;');
        
        if(!is_instagram_post){
          window.document.getElementById("bwg_container_for_media_1").innerHTML = spider_display_embed(file_type, embed_id, {class:"embed_display", width:"<?php echo $image_width; ?>", height:"<?php echo $image_height; ?>", frameborder:"0", allowfullscreen:"allowfullscreen", style:"width:<?php echo $image_width; ?>px; height:<?php echo $image_height; ?>px; vertical-align:middle; text-align: center; margin: 0 auto;" });
        }
        else{
          window.document.getElementById("bwg_container_for_media_1").innerHTML = spider_display_embed(file_type, embed_id, {class:"embed_display", width:"<?php echo $image_height -88; ?>", height:"<?php echo $image_height; ?>", frameborder:"0", allowfullscreen:"allowfullscreen", style:"width:<?php echo $image_height -88 ; ?>px; height:<?php echo $image_height; ?>px; vertical-align:middle; text-align: center; margin: 0 auto;" });
        }
      }
    </script>
    <?php
    die();
  }

  public function thumb_display() {
    global $WD_BWG_UPLOAD_DIR;
    $popup_width = ((int) (isset($_GET['width']) ? esc_html($_GET['width']) : '800')) - 30;
    $image_width = $popup_width - 40;
    $popup_height = ((int) (isset($_GET['height']) ? esc_html($_GET['height']) : '500')) - 50;
    $image_height = $popup_height - 40;
    $image_id = (isset($_GET['image_id']) ? esc_html($_GET['image_id']) : '0');
    ?>
    <div style="display:table; width:100%; height:<?php echo $popup_height; ?>px;">
      <div style="display:table-cell; text-align:center; vertical-align:middle;">
        <img id="thumb_view" src="" style="max-width:<?php echo $image_width; ?>px; max-height:<?php echo $image_height; ?>px;"/>
      </div>
    </div>
    <script>
      var image_url = "<?php echo site_url() . '/' . $WD_BWG_UPLOAD_DIR; ?>" + window.parent.document.getElementById("thumb_url_<?php echo $image_id; ?>").value;
      window.document.getElementById("thumb_view").src = image_url + "?date=<?php echo date('Y-m-y H:i:s'); ?>";
    </script>
    <?php
    die();
  }

  public function crop() {
    global $WD_BWG_UPLOAD_DIR;
    $options = $this->model->get_option_data();
    $thumb_width = $options->upload_thumb_width;
    $thumb_height = $options->upload_thumb_height;
    $popup_width = ((int) (isset($_GET['width']) ? esc_html($_GET['width']) : '800')) - 50;
    $image_width = $popup_width - $thumb_width - 70;
    $popup_height = ((int) (isset($_GET['height']) ? esc_html($_GET['height']) : '500')) - 75;
    $image_height = $popup_height - 70;
    $image_id = (isset($_GET['image_id']) ? esc_html($_GET['image_id']) : '0');
    $edit_type = (isset($_POST['edit_type']) ? esc_html($_POST['edit_type']) : '');
    $x = (isset($_POST['x']) ? (int) $_POST['x'] : 0);
    $y = (isset($_POST['y']) ? (int) $_POST['y'] : 0);
    $w = (isset($_POST['w']) ? (int) $_POST['w'] : 0);
    $h = (isset($_POST['h']) ? (int) $_POST['h'] : 0);

    if (isset($_GET['image_url'])) {
      $image_data = new stdClass();
      $image_data->image_url = (isset($_GET['image_url']) ? esc_html($_GET['image_url']) : '');
      $image_data->thumb_url = (isset($_GET['thumb_url']) ? esc_html($_GET['thumb_url']) : '');
      $filename = htmlspecialchars_decode(ABSPATH . $WD_BWG_UPLOAD_DIR . $image_data->image_url, ENT_COMPAT | ENT_QUOTES);
      $thumb_filename = htmlspecialchars_decode(ABSPATH . $WD_BWG_UPLOAD_DIR . $image_data->thumb_url, ENT_COMPAT | ENT_QUOTES);
      $form_action = add_query_arg(array('action' => 'editThumb', 'type' => 'crop', 'image_id' => $image_id, 'image_url' => $image_data->image_url, 'thumb_url' => $image_data->thumb_url, 'width' => '800', 'height' => '500', 'TB_iframe' => '1'), admin_url('admin-ajax.php'));
    }
    else {
      $image_data = $this->model->get_image_data($image_id);
      $filename = htmlspecialchars_decode(ABSPATH . $WD_BWG_UPLOAD_DIR . $image_data->image_url, ENT_COMPAT | ENT_QUOTES);
      $thumb_filename = htmlspecialchars_decode(ABSPATH . $WD_BWG_UPLOAD_DIR . $image_data->thumb_url, ENT_COMPAT | ENT_QUOTES);
      $form_action = add_query_arg(array('action' => 'editThumb', 'type' => 'crop', 'image_id' => $image_id, 'width' => '800', 'height' => '500', 'TB_iframe' => '1'), admin_url('admin-ajax.php'));
    }
    ini_set('memory_limit', '-1');
    list($width_orig, $height_orig, $type_orig) = getimagesize($filename);
    if ($edit_type == 'crop') {
      if ($type_orig == 2) {
        $img_r = imagecreatefromjpeg($filename);
        $dst_r = ImageCreateTrueColor($thumb_width, $thumb_height);
        imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $thumb_width, $thumb_height, $w, $h);
        imagejpeg($dst_r, $thumb_filename, 90);
        imagedestroy($img_r);
        imagedestroy($dst_r);
      }
      elseif ($type_orig == 3) {
        $img_r = imagecreatefrompng($filename);
        $dst_r = ImageCreateTrueColor($thumb_width, $thumb_height);
        imageColorAllocateAlpha($dst_r, 0, 0, 0, 127);
        imagealphablending($dst_r, FALSE);
        imagesavealpha($dst_r, TRUE);
        imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $thumb_width, $thumb_height, $w, $h);
        imagealphablending($dst_r, FALSE);
        imagesavealpha($dst_r, TRUE);
        imagepng($dst_r, $thumb_filename, 9);
        imagedestroy($img_r);
        imagedestroy($dst_r);
      }
      elseif ($type_orig == 1) {
        $img_r = imagecreatefromgif($filename);
        $dst_r = ImageCreateTrueColor($thumb_width, $thumb_height);
        imageColorAllocateAlpha($dst_r, 0, 0, 0, 127);
        imagealphablending($dst_r, FALSE);
        imagesavealpha($dst_r, TRUE);
        imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $thumb_width, $thumb_height, $w, $h);
        imagealphablending($dst_r, FALSE);
        imagesavealpha($dst_r, TRUE);
        imagegif($dst_r, $thumb_filename);
        imagedestroy($img_r);
        imagedestroy($dst_r);
      }
      else {
        ?>
        <div class="thumb_message"><strong>You can't crop this type of image.</strong></div>
        <?php
      }
    }
    ini_restore('memory_limit');
    wp_print_scripts('jquery');
    wp_print_scripts('jcrop');
    wp_print_styles('jcrop');
    ?>
    <style>
      body {
        height: <?php echo $popup_height; ?>px;
      }
      .spider_crop {
        background: linear-gradient(to top, #ECECEC, #F9F9F9) repeat scroll 0 0 #F1F1F1;
        cursor: pointer;
        height: 30px;
        padding: 2px;
        -moz-outline-radius:  2px;
        outline: 1px solid #CCCCCC;
      }
      .spider_crop:hover {
        -moz-outline-radius:  2px;
        outline: 1px solid #999999;
        padding: 2px;
      }
      .jcrop-holder {
        margin: 0 auto;
      }
      .thumb_preview {
        height: <?php echo $thumb_height; ?>px;
        margin: 0 auto;
        overflow: hidden;
        width: <?php echo $thumb_width; ?>px;
      }
      #thumb_image_preview {
        display: none;
      }
      .thumb_preview_td {
        background-color: #F5F5F5;
        border-radius: 3px;
        border: 1px solid #CCCCCC;
        font-family: sans-serif;
        font-size: 12px;
      }
      .thumb_message {
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        background: linear-gradient(to top, #ECECEC, #F9F9F9) repeat scroll 0 0 #F1F1F1;
        background-color: #F5F5F5;
        border: 1px solid #CCCCCC;
        border-radius: 3px 3px 3px 3px;
        box-sizing: border-box;
        color: #333333;
        font-family: sans-serif;
        font-size: 12px;
        margin: 5px auto;
        padding: 8px 5px;
        width: <?php echo $popup_width; ?>;
      }
      #crop_button {
        display: none;
        height: 38px;
        margin-top: 5px;
        text-align: center;
      }
    </style>
    <?php
    if ($edit_type == 'crop') {
      ?><div class="thumb_message" id="croped_message"><strong>The thumbnail successfully croped.</strong></div><?php
    }
    else {
      ?><div class="thumb_message" id="thumb_message"><strong>Select the area for the thumbnail.</strong></div><?php
    }
    ?>
    <form method="post" id="crop_image" action="<?php echo $form_action; ?>" >
      <?php wp_nonce_field( 'editThumb', 'bwg_nonce' ); ?>
      <div style="height:<?php echo $popup_height - 10; ?>px; width:<?php echo $popup_width; ?>; margin: 5px auto;">
        <div id="crop_button">
          <img title="Crop" class="spider_crop" onclick="spider_crop('crop', 'crop_image')" src="<?php echo WD_BWG_URL . '/images/crop.png'; ?>"/>
        </div>
        <table style="height: inherit; top: 45px; position: absolute ;width: inherit; margin: 0 auto;">
          <tr>
            <td class="thumb_preview_td" colspan="2">
              <input type="checkbox" id="chb" onclick="spider_crop_ratio()" checked="checked">
              <label for="chb">Keep aspect ratio</label>
            </td>
          </tr>
          <tr>
            <td class="thumb_preview_td" style="vertical-align: middle; width: <?php echo ($popup_width - $thumb_width) - 40; ?>px;">
              <img id="image_view" src="<?php echo site_url() . '/' . $WD_BWG_UPLOAD_DIR . $image_data->image_url; ?>?date=<?php echo date('Y-m-y H:i:s'); ?>" style="max-width:<?php echo $image_width; ?>px; max-height:<?php echo $image_height; ?>px;" />
            </td>
            <td class="thumb_preview_td" style="width:<?php echo $thumb_width + 20; ?>px;">
              <div class="thumb_preview">
                <img id="thumb_image_preview" src="<?php echo site_url() . '/' . $WD_BWG_UPLOAD_DIR . $image_data->image_url; ?>?date=<?php echo date('Y-m-y H:i:s'); ?>">
              </div>
            </td>
          </tr>
        </table>
      </div>
      <input type="hidden" name="edit_type" id="edit_type" />
      <input id="x" type="hidden" name="x" value="" />
      <input id="y" type="hidden" name="y" value="" />
      <input id="w" type="hidden" name="w" value="" />
      <input id="h" type="hidden" name="h" value="" />
    </form>
    <script language="javascript">
      function spider_crop_ratio() {
        if (document.getElementById("chb").checked == false) {
          spider_crop_fix("", "");
        }
        else {
          spider_crop_fix("<?php echo $options->upload_thumb_width; ?>", "<?php echo $options->upload_thumb_height; ?>");
        }
        jQuery('#crop_button').show();
        jQuery('#thumb_message').hide();
        jQuery('#croped_message').hide();
        jQuery('#thumb_image_preview').show();
      }
      function spider_crop(type, form_id) {
        document.getElementById("edit_type").value = type;
        document.getElementById(form_id).submit();
      }
      var image_src = window.parent.document.getElementById("image_thumb_<?php echo $image_id; ?>").src;
      window.parent.document.getElementById("image_thumb_<?php echo $image_id; ?>").src = image_src + "?date=<?php echo date('Y-m-y H:i:s'); ?>";
      // jQuery('#image_view').Jcrop();
      jQuery(window).load(function() {
        spider_crop_fix("<?php echo $options->upload_thumb_width; ?>", "<?php echo $options->upload_thumb_height; ?>");
      });
      function spider_crop_fix(wi, he) {
        var ratio = parseInt('<?php echo $width_orig; ?>') / jQuery('#image_view').width();
        var thumb_width = parseInt(wi);
        var thumb_height = parseInt(he);
        if (<?php echo $w; ?> == 0) {
          jQuery('#image_view').Jcrop({
            onChange: spider_update_thumb,
            onSelect: spider_update_coords,
            // bgColor: 'black',
            bgOpacity: .7,
            aspectRatio: thumb_width / thumb_height
          });
        }
        else {
          jQuery('#image_view').Jcrop({
            onChange: spider_update_thumb,
            onSelect: spider_update_coords,
            // bgColor: 'black',
            bgOpacity: .7,
            setSelect: [ <?php echo $x; ?> / ratio, <?php echo $y; ?> / ratio, <?php echo $x + $w; ?> / ratio, <?php echo $y + $h; ?> / ratio ],
            aspectRatio: thumb_width / thumb_height
          });
        }
      }
      function spider_update_coords(c) {
        var ratio = parseInt('<?php echo $width_orig; ?>') / jQuery('#image_view').width();
        jQuery('#x').val(c.x * ratio);
        jQuery('#y').val(c.y * ratio);
        jQuery('#w').val(c.w * ratio);
        jQuery('#h').val(c.h * ratio);
        jQuery('#crop_button').show();
        jQuery('#thumb_message').hide();
        jQuery('#croped_message').hide();
        jQuery('#thumb_image_preview').show();
        jQuery('.thumb_preview').css("border", "1px solid #CCCCCC");
      }
      function spider_update_thumb(c) {
        jQuery('#crop_button').hide();
        jQuery('#croped_message').show();
        var thumb_width = parseInt('<?php echo $options->upload_thumb_width; ?>');
        var thumb_height = parseInt('<?php echo $options->upload_thumb_height; ?>');
        jQuery('#thumb_image_preview').css("margin-left", -c.x * (thumb_width / c.w) + "px");
        jQuery('#thumb_image_preview').css("margin-top", -c.y * (thumb_height / c.h) + "px");        
        jQuery('#thumb_image_preview').css("width", ((thumb_width / c.w) * jQuery('#image_view').width()) + "px");
        jQuery('#thumb_image_preview').css("height", ((thumb_height / c.h) * jQuery('#image_view').height()) + "px");
      }
    </script>
    <?php
    die();
  }

  public function rotate() {
    global $WD_BWG_UPLOAD_DIR;
    $popup_width = ((int) (isset($_GET['width']) ? esc_html($_GET['width']) : '650')) - 30;
    $image_width = $popup_width - 40;
    $popup_height = ((int) (isset($_GET['height']) ? esc_html($_GET['height']) : '500')) - 55;
    $image_height = $popup_height - 70;
    $image_id = (isset($_GET['image_id']) ? esc_html($_GET['image_id']) : '0');
    $edit_type = (isset($_POST['edit_type']) ? esc_html($_POST['edit_type']) : '');

    if (isset($_GET['image_url'])) {
      $image_data = new stdClass();
      $image_data->image_url = (isset($_GET['image_url']) ? esc_html($_GET['image_url']) : '');
      $image_data->thumb_url = (isset($_GET['thumb_url']) ? esc_html($_GET['thumb_url']) : '');
      $filename = htmlspecialchars_decode(ABSPATH . $WD_BWG_UPLOAD_DIR . $image_data->image_url, ENT_COMPAT | ENT_QUOTES);
      $thumb_filename = htmlspecialchars_decode(ABSPATH . $WD_BWG_UPLOAD_DIR . $image_data->thumb_url, ENT_COMPAT | ENT_QUOTES);
      $form_action = add_query_arg(array('action' => 'editThumb', 'type' => 'rotate', 'image_id' => $image_id, 'image_url' => $image_data->image_url, 'thumb_url' => $image_data->thumb_url, 'width' => '650', 'height' => '500', 'TB_iframe' => '1'), admin_url('admin-ajax.php'));
    }
    else {
      $image_data = $this->model->get_image_data($image_id);
      $filename = htmlspecialchars_decode(ABSPATH . $WD_BWG_UPLOAD_DIR . $image_data->image_url, ENT_COMPAT | ENT_QUOTES);
      $thumb_filename = htmlspecialchars_decode(ABSPATH . $WD_BWG_UPLOAD_DIR . $image_data->thumb_url, ENT_COMPAT | ENT_QUOTES);
      $form_action = add_query_arg(array('action' => 'editThumb', 'type' => 'rotate', 'image_id' => $image_id, 'width' => '650', 'height' => '500', 'TB_iframe' => '1'), admin_url('admin-ajax.php'));
    }
    ini_set('memory_limit', '-1');
    list($width_rotate, $height_rotate, $type_rotate) = getimagesize($filename);
    if ($edit_type == '270' || $edit_type == '90') {
      if ($type_rotate == 2) {
        $source = imagecreatefromjpeg($filename);
        $thumb_source = imagecreatefromjpeg($thumb_filename);
        $rotate = imagerotate($source, $edit_type, 0);
        $thumb_rotate = imagerotate($thumb_source, $edit_type, 0);
        imagejpeg($thumb_rotate, $thumb_filename, 90);
        imagejpeg($rotate, $filename, 100);
        imagedestroy($source);
        imagedestroy($rotate);
        imagedestroy($thumb_source);
        imagedestroy($thumb_rotate);
      }
      elseif ($type_rotate == 3) {
        $source = imagecreatefrompng($filename);
        $thumb_source = imagecreatefrompng($thumb_filename);
        imagealphablending($source, FALSE);
        imagealphablending($thumb_source, FALSE);
        imagesavealpha($source, TRUE);
        imagesavealpha($thumb_source, TRUE);
        $rotate = imagerotate($source, $edit_type, imageColorAllocateAlpha($source, 0, 0, 0, 127));
        $thumb_rotate = imagerotate($thumb_source, $edit_type, imageColorAllocateAlpha($source, 0, 0, 0, 127));
        imagealphablending($rotate, FALSE);
        imagealphablending($thumb_rotate, FALSE);
        imagesavealpha($rotate, TRUE);
        imagesavealpha($thumb_rotate, TRUE);
        imagepng($rotate, $filename, 9);
        imagepng($thumb_rotate, $thumb_filename, 9);
        imagedestroy($source);
        imagedestroy($rotate);
        imagedestroy($thumb_source);
        imagedestroy($thumb_rotate);
      }
      elseif ($type_rotate == 1) {
        $source = imagecreatefromgif($filename);
        $thumb_source = imagecreatefromgif($thumb_filename);
        imagealphablending($source, FALSE);
        imagealphablending($thumb_source, FALSE);
        imagesavealpha($source, TRUE);
        imagesavealpha($thumb_source, TRUE);
        $rotate = imagerotate($source, $edit_type, imageColorAllocateAlpha($source, 0, 0, 0, 127));
        $thumb_rotate = imagerotate($thumb_source, $edit_type, imageColorAllocateAlpha($source, 0, 0, 0, 127));
        imagealphablending($rotate, FALSE);
        imagealphablending($thumb_rotate, FALSE);
        imagesavealpha($rotate, TRUE);
        imagesavealpha($thumb_rotate, TRUE);
        imagegif($rotate, $filename);
        imagegif($thumb_rotate, $thumb_filename);
        imagedestroy($source);
        imagedestroy($rotate);
        imagedestroy($thumb_source);
        imagedestroy($thumb_rotate);
      }
      else {
        ?>
        <div class="thumb_message"><strong>You can't rotate this type of image.</strong></div>
        <?php
      }
    }
    elseif ($edit_type == 'vertical' || $edit_type == 'horizontal'  || $edit_type == 'both') {
      function bwg_image_flip($imgsrc, $mode) {
        $width = imagesx($imgsrc);
        $height = imagesy($imgsrc);
        $src_x = 0;
        $src_y = 0;
        $src_width = $width;
        $src_height = $height;

        switch ($mode) {
          case 'vertical':
            $src_y = $height - 1;
            $src_height = -$height;
            break;

          case 'horizontal':
            $src_x = $width - 1;
            $src_width = -$width;
            break;

          case 'both':
            $src_x = $width - 1;
            $src_y = $height - 1;
            $src_width = -$width;
            $src_height = -$height;
            break;

          default:
            return $imgsrc;
        }
        $trans_colour = imageColorAllocateAlpha($imgsrc, 0, 0, 0, 127);
        $imgdest = imagecreatetruecolor($width, $height);
        imagefill($imgdest, 0, 0, $trans_colour);
        if (imagecopyresampled($imgdest, $imgsrc, 0, 0, $src_x, $src_y , $width, $height, $src_width, $src_height)) {
          return $imgdest;
        }
        return $imgsrc;
      }
      if ($type_rotate == 2) {
        $source = imagecreatefromjpeg($filename);
        $flip = bwg_image_flip($source, $edit_type);
        imagejpeg($flip, $filename, 100);
        $thumb_source = imagecreatefromjpeg($thumb_filename);
        $thumb_flip = bwg_image_flip($thumb_source, $edit_type);
        imagejpeg($thumb_flip, $thumb_filename, 90);
        imagedestroy($source);
        imagedestroy($flip);
        imagedestroy($thumb_source);
        imagedestroy($thumb_flip);
      }
      elseif ($type_rotate == 3) {
        $source = imagecreatefrompng($filename);
        $thumb_source = imagecreatefrompng($thumb_filename);
        imagealphablending($source, FALSE);
        imagealphablending($thumb_source, FALSE);
        imagesavealpha($source, TRUE);
        imagesavealpha($thumb_source, TRUE);
        $flip = bwg_image_flip($source, $edit_type);
        $thumb_flip = bwg_image_flip($thumb_source, $edit_type);
        imagealphablending($flip, FALSE);
        imagealphablending($thumb_flip, FALSE);
        imagesavealpha($flip, TRUE);
        imagesavealpha($thumb_flip, TRUE);
        imagepng($flip, $filename, 9);
        imagepng($thumb_flip, $thumb_filename, 9);
        imagedestroy($source);
        imagedestroy($flip);
        imagedestroy($thumb_source);
        imagedestroy($thumb_flip);
      }
      elseif ($type_rotate == 1) {
        $source = imagecreatefromgif($filename);
        $thumb_source = imagecreatefromgif($thumb_filename);
        imagealphablending($source, FALSE);
        imagealphablending($thumb_source, FALSE);
        imagesavealpha($source, TRUE);
        imagesavealpha($thumb_source, TRUE);
        $flip = bwg_image_flip($source, $edit_type);
        $thumb_flip = bwg_image_flip($thumb_source, $edit_type);
        imagealphablending($flip, FALSE);
        imagealphablending($thumb_flip, FALSE);
        imagesavealpha($flip, TRUE);
        imagesavealpha($thumb_flip, TRUE);
        imagegif($flip, $filename);
        imagegif($thumb_flip, $thumb_filename);
        imagedestroy($source);
        imagedestroy($flip);
        imagedestroy($thumb_source);
        imagedestroy($thumb_flip);
      }
      else {
        ?>
        <div class="thumb_message"><strong>You can't flip this type of image.</strong></div>
        <?php
      }
    }
    ini_restore('memory_limit');
    ?>
    <style>
      .spider_rotate {
        background: linear-gradient(to top, #ECECEC, #F9F9F9) repeat scroll 0 0 #F1F1F1;
        cursor: pointer;
        height: 30px;
        padding: 2px;
        -moz-outline-radius:  2px;
        outline: 1px solid #CCCCCC;
      }
      .spider_rotate:hover {
        -moz-outline-radius:  2px;
        outline: 1px solid #999999;
        padding: 2px;
      }
      .thumb_message {
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        background: linear-gradient(to top, #ECECEC, #F9F9F9) repeat scroll 0 0 #F1F1F1;
        background-color: #F5F5F5;
        border: 1px solid #CCCCCC;
        border-radius: 3px 3px 3px 3px;
        box-sizing: border-box;
        color: #333333;
        font-family: sans-serif;
        font-size: 12px;
        margin: 5px auto;
        padding: 7px 5px;
        width: <?php echo $popup_width; ?>;
      }
    </style>
    <script>
      function spider_rotate(type, form_id) {
        document.getElementById("edit_type").value = type;
        document.getElementById(form_id).submit();
      }
      var image_src = window.parent.document.getElementById("image_thumb_<?php echo $image_id; ?>").src;
      window.parent.document.getElementById("image_thumb_<?php echo $image_id; ?>").src = image_src + "?date=<?php echo date('Y-m-y H:i:s'); ?>";
    </script>
    <form method="post" id="rotate_image" action="<?php echo $form_action; ?>">
    <?php wp_nonce_field( 'editThumb', 'bwg_nonce' ); ?>
      <div style="text-align:center; width:inherit; height:<?php echo $popup_height; ?>px;">
        <div style="height:40px;">
          <img title="Flip Both" class="spider_rotate" onclick="spider_rotate('both', 'rotate_image')" src="<?php echo WD_BWG_URL . '/images/flip_both.png'; ?>"/>
          <img title="Flip Vertical" class="spider_rotate" onclick="spider_rotate('vertical', 'rotate_image')" src="<?php echo WD_BWG_URL . '/images/flip_vertical.png'; ?>"/>
          <img title="Flip Horizontal" class="spider_rotate" onclick="spider_rotate('horizontal', 'rotate_image')" src="<?php echo WD_BWG_URL . '/images/flip_horizontal.png'; ?>"/>
          <img title="Rotate Left" class="spider_rotate" onclick="spider_rotate('90', 'rotate_image')" src="<?php echo WD_BWG_URL . '/images/rotate_left.png'; ?>"/>
          <img title="Rotate Right" class="spider_rotate" onclick="spider_rotate('270', 'rotate_image')" src="<?php echo WD_BWG_URL . '/images/rotate_right.png'; ?>"/>
        </div>
        <div style="display:table; width:100%; height:<?php echo $popup_height - 40; ?>px;">
          <div style="display:table-cell; vertical-align:middle;">
            <img src="<?php echo site_url() . '/' . $WD_BWG_UPLOAD_DIR . $image_data->image_url; ?>?date=<?php echo date('Y-m-y H:i:s'); ?>" style="margin:0 auto; display:block; max-width:<?php echo $image_width; ?>px;max-height:<?php echo $image_height; ?>px;" />
          </div>
        </div>
      </div>
      <input type="hidden" name="edit_type" id="edit_type" />
      <input type="hidden" name="image_id" id="image_id" value="<?php echo $image_id; ?>" />
    </form>
    <?php
    die();
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