<?php

class BWGControllerOptions_bwg {
  ////////////////////////////////////////////////////////////////////////////////////////
  // Events                                                                             //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Constants                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Variables                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Constructor & Destructor                                                           //
  ////////////////////////////////////////////////////////////////////////////////////////
  public function __construct() {
  }
  ////////////////////////////////////////////////////////////////////////////////////////
  // Public Methods                                                                     //
  ////////////////////////////////////////////////////////////////////////////////////////
  public function execute() {
    $task = ((isset($_POST['task'])) ? esc_html(stripslashes($_POST['task'])) : '');
    $id = ((isset($_POST['current_id'])) ? esc_html(stripslashes($_POST['current_id'])) : 0);
    
    if($task != ''){
      if(!WDWLibrary::verify_nonce('options_bwg')){
        die('Sorry, your nonce did not verify.');
      }
    }


    if (method_exists($this, $task)) {
      $this->$task($id);
    }
    else {
      $this->display();
    }
  }

  public function display() {
    require_once WD_BWG_DIR . "/admin/models/BWGModelOptions_bwg.php";
    $model = new BWGModelOptions_bwg();

    require_once WD_BWG_DIR . "/admin/views/BWGViewOptions_bwg.php";
    $view = new BWGViewOptions_bwg($model);
    $view->display();
  }
  
  public function reset() {
    require_once WD_BWG_DIR . "/admin/models/BWGModelOptions_bwg.php";
    $model = new BWGModelOptions_bwg();

    require_once WD_BWG_DIR . "/admin/views/BWGViewOptions_bwg.php";
    $view = new BWGViewOptions_bwg($model);
    echo WDWLibrary::message('Changes must be saved.', 'error');
    $view->display(true);
  }

  public function save() {
    $this->save_db();
    $this->display();
  }
  
  public function save_db() {
    global $wpdb;
    $id = 1;    
    if (isset($_POST['old_images_directory'])) {
      $old_images_directory = esc_html(stripslashes($_POST['old_images_directory']));
    }
    if (isset($_POST['images_directory'])) {
      $images_directory = esc_html(stripslashes($_POST['images_directory']));
      if (!is_dir(ABSPATH . $images_directory)) {
        echo WDWLibrary::message('Uploads directory doesn\'t exist. Old value is restored.', 'error');
        if ($old_images_directory) {
          $images_directory = $old_images_directory;
        }
        else {
          $upload_dir = wp_upload_dir();
          if (!is_dir($upload_dir['basedir'] . '/photo-gallery')) {
            mkdir($upload_dir['basedir'] . '/photo-gallery', 0777);
          }
          $images_directory = str_replace(ABSPATH, '', $upload_dir['basedir']);
        }
      }
    }
    else {
      $upload_dir = wp_upload_dir();
      if (!is_dir($upload_dir['basedir'] . '/photo-gallery')) {
        mkdir($upload_dir['basedir'] . '/photo-gallery', 0777);
      }
      $images_directory = str_replace(ABSPATH, '', $upload_dir['basedir']);
    }
    $resize_image = (isset($_POST['resize_image']) ? esc_html(stripslashes($_POST['resize_image'])) : 1);

    $masonry = (isset($_POST['masonry']) ? esc_html(stripslashes($_POST['masonry'])) : 'vertical');
    $mosaic = (isset($_POST['mosaic']) ? esc_html(stripslashes($_POST['mosaic'])) : 'vertical');
    $resizable_mosaic = (isset($_POST['resizable_mosaic']) ? esc_html(stripslashes($_POST['resizable_mosaic'])) : 0);
    $mosaic_total_width = (isset($_POST['mosaic_total_width']) ? esc_html(stripslashes($_POST['mosaic_total_width'])) : 100);

    $image_column_number = (isset($_POST['image_column_number']) ? esc_html(stripslashes($_POST['image_column_number'])) : 5);
    $images_per_page = (isset($_POST['images_per_page']) ? esc_html(stripslashes($_POST['images_per_page'])) : 30);
    $thumb_width = (isset($_POST['thumb_width']) ? esc_html(stripslashes($_POST['thumb_width'])) : 120);
    $thumb_height = (isset($_POST['thumb_height']) ? esc_html(stripslashes($_POST['thumb_height'])) : 90);
    $upload_thumb_width = (isset($_POST['upload_thumb_width']) ? esc_html(stripslashes($_POST['upload_thumb_width'])) : 300);
    $upload_thumb_height = (isset($_POST['upload_thumb_height']) ? esc_html(stripslashes($_POST['upload_thumb_height'])) : 300);
	  $upload_img_width = (isset($_POST['upload_img_width']) ? esc_html(stripslashes($_POST['upload_img_width'])) : 1200);
    $upload_img_height = (isset($_POST['upload_img_height']) ? esc_html(stripslashes($_POST['upload_img_height'])) : 1200);	
    $image_enable_page = (isset($_POST['image_enable_page']) ? esc_html(stripslashes($_POST['image_enable_page'])) : 1);
    $image_title_show_hover = (isset($_POST['image_title_show_hover']) ? esc_html(stripslashes($_POST['image_title_show_hover'])) : 'none');
    $album_column_number = (isset($_POST['album_column_number']) ? esc_html(stripslashes($_POST['album_column_number'])) : 5);
    $albums_per_page = (isset($_POST['albums_per_page']) ? esc_html(stripslashes($_POST['albums_per_page'])) : 30);
    $album_title_show_hover = (isset($_POST['album_title_show_hover']) ? esc_html(stripslashes($_POST['album_title_show_hover'])) : 'hover');
    $album_thumb_width = (isset($_POST['album_thumb_width']) ? esc_html(stripslashes($_POST['album_thumb_width'])) : 120);
    $album_thumb_height = (isset($_POST['album_thumb_height']) ? esc_html(stripslashes($_POST['album_thumb_height'])) : 90);
    $album_enable_page = (isset($_POST['album_enable_page']) ? esc_html(stripslashes($_POST['album_enable_page'])) : 1);
    $extended_album_height = (isset($_POST['extended_album_height']) ? esc_html(stripslashes($_POST['extended_album_height'])) : 150);
    $extended_album_description_enable = (isset($_POST['extended_album_description_enable']) ? esc_html(stripslashes($_POST['extended_album_description_enable'])) : 1);
    $image_browser_width = (isset($_POST['image_browser_width']) ? esc_html(stripslashes($_POST['image_browser_width'])) : 800);
    $image_browser_title_enable = (isset($_POST['image_browser_title_enable']) ? esc_html(stripslashes($_POST['image_browser_title_enable'])) : 1);
    $image_browser_description_enable = (isset($_POST['image_browser_description_enable']) ? esc_html(stripslashes($_POST['image_browser_description_enable'])) : 1);
    $blog_style_width = (isset($_POST['blog_style_width']) ? esc_html(stripslashes($_POST['blog_style_width'])) : 800);
    $blog_style_title_enable = (isset($_POST['blog_style_title_enable']) ? esc_html(stripslashes($_POST['blog_style_title_enable'])) : 1);
    $blog_style_images_per_page = (isset($_POST['blog_style_images_per_page']) ? esc_html(stripslashes($_POST['blog_style_images_per_page'])) : 5);
    $blog_style_enable_page = (isset($_POST['blog_style_enable_page']) ? esc_html(stripslashes($_POST['blog_style_enable_page'])) : 1);
    $slideshow_type = (isset($_POST['slideshow_type']) ? esc_html(stripslashes($_POST['slideshow_type'])) : 'fade');
    $slideshow_interval = (isset($_POST['slideshow_interval']) ? esc_html(stripslashes($_POST['slideshow_interval'])) : 5);
    $slideshow_width = (isset($_POST['slideshow_width']) ? esc_html(stripslashes($_POST['slideshow_width'])) : 800);
    $slideshow_height = (isset($_POST['slideshow_height']) ? esc_html(stripslashes($_POST['slideshow_height'])) : 600);
    $slideshow_enable_autoplay = (isset($_POST['slideshow_enable_autoplay']) ? esc_html(stripslashes($_POST['slideshow_enable_autoplay'])) : 1);
    $slideshow_enable_shuffle = (isset($_POST['slideshow_enable_shuffle']) ? esc_html(stripslashes($_POST['slideshow_enable_shuffle'])) : 1);
    $slideshow_enable_ctrl = (isset($_POST['slideshow_enable_ctrl']) ? esc_html(stripslashes($_POST['slideshow_enable_ctrl'])) : 1);
    $slideshow_enable_filmstrip = (isset($_POST['slideshow_enable_filmstrip']) ? esc_html(stripslashes($_POST['slideshow_enable_filmstrip'])) : 1);
    $slideshow_filmstrip_height = (isset($_POST['slideshow_filmstrip_height']) ? esc_html(stripslashes($_POST['slideshow_filmstrip_height'])) : 70);
    $slideshow_enable_title = (isset($_POST['slideshow_enable_title']) ? esc_html(stripslashes($_POST['slideshow_enable_title'])) : 0);
    $slideshow_title_position = (isset($_POST['slideshow_title_position']) ? esc_html(stripslashes($_POST['slideshow_title_position'])) : 'top-right');
	$slideshow_title_full_width = (isset($_POST['slideshow_title_full_width']) ? esc_html(stripslashes($_POST['slideshow_title_full_width'])) : 0);
    $slideshow_enable_description = (isset($_POST['slideshow_enable_description']) ? esc_html(stripslashes($_POST['slideshow_enable_description'])) : 1);
    $slideshow_description_position = (isset($_POST['slideshow_description_position']) ? esc_html(stripslashes($_POST['slideshow_description_position'])) : 'bottom-right');
    $slideshow_enable_music = (isset($_POST['slideshow_enable_music']) ? esc_html(stripslashes($_POST['slideshow_enable_music'])) : 0);
    $slideshow_audio_url = (isset($_POST['slideshow_audio_url']) ? esc_html(stripslashes($_POST['slideshow_audio_url'])) : '');
    $popup_width = (isset($_POST['popup_width']) ? esc_html(stripslashes($_POST['popup_width'])) : 800);
    $popup_height = (isset($_POST['popup_height']) ? esc_html(stripslashes($_POST['popup_height'])) : 600);
    $popup_type = (isset($_POST['popup_type']) ? esc_html(stripslashes($_POST['popup_type'])) : 'fade');
    $popup_interval = (isset($_POST['popup_interval']) ? esc_html(stripslashes($_POST['popup_interval'])) : 5);
    $popup_enable_filmstrip = (isset($_POST['popup_enable_filmstrip']) ? esc_html(stripslashes($_POST['popup_enable_filmstrip'])) : 1);
    $popup_filmstrip_height = (isset($_POST['popup_filmstrip_height']) ? esc_html(stripslashes($_POST['popup_filmstrip_height'])) : 50);
    $popup_enable_ctrl_btn = (isset($_POST['popup_enable_ctrl_btn']) ? esc_html(stripslashes($_POST['popup_enable_ctrl_btn'])) : 1);
    $popup_enable_fullscreen = (isset($_POST['popup_enable_fullscreen']) ? esc_html(stripslashes($_POST['popup_enable_fullscreen'])) : 1);
    $popup_enable_comment = (isset($_POST['popup_enable_comment']) ? esc_html(stripslashes($_POST['popup_enable_comment'])) : 1);
    $popup_enable_email = (isset($_POST['popup_enable_email']) ? esc_html(stripslashes($_POST['popup_enable_email'])) : 0);
    $popup_enable_captcha = (isset($_POST['popup_enable_captcha']) ? esc_html(stripslashes($_POST['popup_enable_captcha'])) : 0);
    $popup_enable_download = (isset($_POST['popup_enable_download']) ? esc_html(stripslashes($_POST['popup_enable_download'])) : 0);
    $popup_enable_fullsize_image = (isset($_POST['popup_enable_fullsize_image']) ? esc_html(stripslashes($_POST['popup_enable_fullsize_image'])) : 0);
    $popup_enable_facebook = (isset($_POST['popup_enable_facebook']) ? esc_html(stripslashes($_POST['popup_enable_facebook'])) : 1);
    $popup_enable_twitter = (isset($_POST['popup_enable_twitter']) ? esc_html(stripslashes($_POST['popup_enable_twitter'])) : 1);
    $popup_enable_google = (isset($_POST['popup_enable_google']) ? esc_html(stripslashes($_POST['popup_enable_google'])) : 1);
    $popup_enable_pinterest = (isset($_POST['popup_enable_pinterest']) ? esc_html(stripslashes($_POST['popup_enable_pinterest'])) : 0);
    $popup_enable_tumblr = (isset($_POST['popup_enable_tumblr']) ? esc_html(stripslashes($_POST['popup_enable_tumblr'])) : 0);
    $watermark_type = (isset($_POST['watermark_type']) ? esc_html(stripslashes($_POST['watermark_type'])) : 'none');
    $watermark_position = (isset($_POST['watermark_position']) ? esc_html(stripslashes($_POST['watermark_position'])) : 'bottom-right');
    $watermark_width = (isset($_POST['watermark_width']) ? esc_html(stripslashes($_POST['watermark_width'])) : 600);
    $watermark_height = (isset($_POST['watermark_height']) ? esc_html(stripslashes($_POST['watermark_height'])) : 600);
    $watermark_url = (isset($_POST['watermark_url']) ? esc_html(stripslashes($_POST['watermark_url'])) : WD_BWG_URL . '/images/watermark.png');
    $watermark_text = (isset($_POST['watermark_text']) ? esc_html(stripslashes($_POST['watermark_text'])) : 'web-dorado.com');
    $watermark_link = (isset($_POST['watermark_link']) ? esc_html(stripslashes($_POST['watermark_link'])) : 'http://www.web-dorado.com');
    $watermark_opacity = (isset($_POST['watermark_opacity']) ? esc_html(stripslashes($_POST['watermark_opacity'])) : 30);
    $watermark_font_size = (isset($_POST['watermark_font_size']) ? esc_html(stripslashes($_POST['watermark_font_size'])) : 20);
    $watermark_font = (isset($_POST['watermark_font']) ? esc_html(stripslashes($_POST['watermark_font'])) : '');
    $watermark_color = (isset($_POST['watermark_color']) ? esc_html(stripslashes($_POST['watermark_color'])) : '');    
    $built_in_watermark_type = (isset($_POST['built_in_watermark_type']) ? esc_html(stripslashes($_POST['built_in_watermark_type'])) : 'none');
    $built_in_watermark_position = (isset($_POST['built_in_watermark_position']) ? esc_html(stripslashes($_POST['built_in_watermark_position'])) : 'middle-center');
    $built_in_watermark_size = (isset($_POST['built_in_watermark_size']) ? esc_html(stripslashes($_POST['built_in_watermark_size'])) : 15);
    $built_in_watermark_url = (isset($_POST['built_in_watermark_url']) ? esc_html(stripslashes($_POST['built_in_watermark_url'])) : WD_BWG_URL . '/images/watermark.png');
    $built_in_watermark_text = (isset($_POST['built_in_watermark_text']) ? esc_html(stripslashes($_POST['built_in_watermark_text'])) : 'web-dorado.com');
    $built_in_watermark_opacity = (isset($_POST['built_in_watermark_opacity']) ? esc_html(stripslashes($_POST['built_in_watermark_opacity'])) : 30);
    $built_in_watermark_font_size = (isset($_POST['built_in_watermark_font_size']) ? esc_html(stripslashes($_POST['built_in_watermark_font_size'])) : 20);
    $built_in_watermark_font = (isset($_POST['built_in_watermark_font']) ? esc_html(stripslashes($_POST['built_in_watermark_font'])) : '');
    $built_in_watermark_color = (isset($_POST['built_in_watermark_color']) ? esc_html(stripslashes($_POST['built_in_watermark_color'])) : '');
    $gallery_role = (isset($_POST['gallery_role']) ? esc_html(stripslashes($_POST['gallery_role'])) : 0);
    $image_right_click = (isset($_POST['image_right_click']) ? esc_html(stripslashes($_POST['image_right_click'])) : 0);
    $popup_fullscreen = (isset($_POST['popup_fullscreen']) ? esc_html(stripslashes($_POST['popup_fullscreen'])) : 0);
    $album_role = (isset($_POST['album_role']) ? esc_html(stripslashes($_POST['album_role'])) : 0);
    $image_role = (isset($_POST['image_role']) ? esc_html(stripslashes($_POST['image_role'])) : 0);
    $popup_autoplay = (isset($_POST['popup_autoplay']) ? esc_html(stripslashes($_POST['popup_autoplay'])) : 0);
    $album_view_type = (isset($_POST['album_view_type']) ? esc_html(stripslashes($_POST['album_view_type'])) : 'thumbnail');
    $show_search_box = (isset($_POST['show_search_box']) ? esc_html(stripslashes($_POST['show_search_box'])) : 0);
    $search_box_width = (isset($_POST['search_box_width']) ? esc_html(stripslashes($_POST['search_box_width'])) : 180);
    $preload_images = (isset($_POST['preload_images']) ? esc_html(stripslashes($_POST['preload_images'])) : 1);
    $preload_images_count = (isset($_POST['preload_images_count']) ? esc_html(stripslashes($_POST['preload_images_count'])) : 10);
    $popup_enable_info = (isset($_POST['popup_enable_info']) ? esc_html(stripslashes($_POST['popup_enable_info'])) : 1);
    $popup_info_always_show = (isset($_POST['popup_info_always_show']) ? esc_html(stripslashes($_POST['popup_info_always_show'])) : 0);
    $popup_enable_rate = (isset($_POST['popup_enable_rate']) ? esc_html(stripslashes($_POST['popup_enable_rate'])) : 0);
    $thumb_click_action = (isset($_POST['thumb_click_action']) ? esc_html(stripslashes($_POST['thumb_click_action'])) : 'open_lightbox');
    $thumb_link_target = (isset($_POST['thumb_link_target']) ? esc_html(stripslashes($_POST['thumb_link_target'])) : 1);
    $comment_moderation = (isset($_POST['comment_moderation']) ? esc_html(stripslashes($_POST['comment_moderation'])) : 0);
    $popup_hit_counter = (isset($_POST['popup_hit_counter']) ? esc_html(stripslashes($_POST['popup_hit_counter'])) : 0);
    $enable_ML_import = (isset($_POST['enable_ML_import']) ? esc_html(stripslashes($_POST['enable_ML_import'])) : 0);
    $autoupdate_interval = (isset($_POST['autoupdate_interval_hour']) && isset($_POST['autoupdate_interval_min']) ? ((int) $_POST['autoupdate_interval_hour'] * 60 + (int) $_POST['autoupdate_interval_min']) : 30);
    /*minimum autoupdate interval is 1 min*/
    $autoupdate_interval = ($autoupdate_interval >= 1 ? $autoupdate_interval : 1 );
    $instagram_client_id = (isset($_POST['instagram_client_id']) ? esc_html(stripslashes($_POST['instagram_client_id'])) : '');
    $showthumbs_name = (isset($_POST['thumb_name']) ? esc_html(stripslashes($_POST['thumb_name'])) : 1);
    $show_album_name = (isset($_POST['show_album_name_enable']) ? esc_html(stripslashes($_POST['show_album_name_enable'])) : 1);
    $show_image_counts = (isset($_POST['show_image_counts']) ? esc_html(stripslashes($_POST['show_image_counts'])) : 0);
    $play_icon = (isset($_POST['play_icon']) ? esc_html(stripslashes($_POST['play_icon'])) : 1);
    $show_masonry_thumb_description = (isset($_POST['show_masonry_thumb_description']) ? esc_html(stripslashes($_POST['show_masonry_thumb_description'])) : 0);
    $popup_info_full_width = (isset($_POST['popup_info_full_width']) ? esc_html(stripslashes($_POST['popup_info_full_width'])) : 0);
		$show_sort_images = (isset($_POST['show_sort_images']) ? esc_html(stripslashes($_POST['show_sort_images'])) : 0);
		$enable_seo = (isset($_POST['enable_seo']) ? esc_html(stripslashes($_POST['enable_seo'])) : 1);
    $autohide_lightbox_navigation = (isset($_POST['autohide_lightbox_navigation']) ? esc_html(stripslashes($_POST['autohide_lightbox_navigation'])) : 1);
    $autohide_slideshow_navigation = (isset($_POST['autohide_slideshow_navigation']) ? esc_html(stripslashes($_POST['autohide_slideshow_navigation'])) : 1);
    $read_metadata = (isset($_POST['read_metadata']) ? esc_html(stripslashes($_POST['read_metadata'])) : 0);

    $save = $wpdb->update($wpdb->prefix . 'bwg_option', array(
      'images_directory' => $images_directory,
      'masonry' => $masonry,
      'mosaic' => $mosaic,
      'resizable_mosaic' => $resizable_mosaic,
      'mosaic_total_width'=> $mosaic_total_width,
      'image_column_number' => $image_column_number,
      'images_per_page' => $images_per_page,
      'thumb_width' => $thumb_width,
      'thumb_height' => $thumb_height,
      'upload_thumb_width' => $upload_thumb_width,
      'upload_thumb_height' => $upload_thumb_height,
	  'upload_img_width' => $upload_img_width, 
      'upload_img_height' => $upload_img_height,
      'image_enable_page' => $image_enable_page,
      'image_title_show_hover' => $image_title_show_hover,
      'album_column_number' => $album_column_number,
      'albums_per_page' => $albums_per_page,
      'album_title_show_hover' => $album_title_show_hover,
      'album_thumb_width' => $album_thumb_width,
      'album_thumb_height' => $album_thumb_height,
      'album_enable_page' => $album_enable_page,
      'extended_album_height' => $extended_album_height,
      'extended_album_description_enable' => $extended_album_description_enable,
      'image_browser_width' => $image_browser_width,
      'image_browser_title_enable' => $image_browser_title_enable,
      'image_browser_description_enable' => $image_browser_description_enable,
      'blog_style_width' => $blog_style_width,
      'blog_style_title_enable' => $blog_style_title_enable,
      'blog_style_images_per_page' => $blog_style_images_per_page,
      'blog_style_enable_page' => $blog_style_enable_page,
      'slideshow_type' => $slideshow_type,
      'slideshow_interval' => $slideshow_interval,
      'slideshow_width' => $slideshow_width,
      'slideshow_height' => $slideshow_height,
      'slideshow_enable_autoplay' => $slideshow_enable_autoplay,
      'slideshow_enable_shuffle' => $slideshow_enable_shuffle,
      'slideshow_enable_ctrl' => $slideshow_enable_ctrl,
      'slideshow_enable_filmstrip' => $slideshow_enable_filmstrip,
      'slideshow_filmstrip_height' => $slideshow_filmstrip_height,
      'slideshow_enable_title' => $slideshow_enable_title,
      'slideshow_title_position' => $slideshow_title_position,
	  'slideshow_title_full_width' => $slideshow_title_full_width,
      'slideshow_enable_description' => $slideshow_enable_description,
      'slideshow_description_position' => $slideshow_description_position,
      'slideshow_enable_music' => $slideshow_enable_music,
      'slideshow_audio_url' => $slideshow_audio_url,
      'popup_width' => $popup_width,
      'popup_height' => $popup_height,
      'popup_type' => $popup_type,
      'popup_interval' => $popup_interval,
      'popup_enable_filmstrip' => $popup_enable_filmstrip,
      'popup_filmstrip_height' => $popup_filmstrip_height,
      'popup_enable_ctrl_btn' => $popup_enable_ctrl_btn,
      'popup_enable_fullscreen' => $popup_enable_fullscreen,
      'popup_enable_comment' => $popup_enable_comment,
      'popup_enable_email' => $popup_enable_email,
      'popup_enable_captcha' => $popup_enable_captcha,
      'popup_enable_download' => $popup_enable_download,
      'popup_enable_fullsize_image' => $popup_enable_fullsize_image,
      'popup_enable_facebook' => $popup_enable_facebook,
      'popup_enable_twitter' => $popup_enable_twitter,
      'popup_enable_google' => $popup_enable_google,
      'popup_enable_pinterest' => $popup_enable_pinterest,
      'popup_enable_tumblr' => $popup_enable_tumblr,
      'watermark_type' => $watermark_type,
      'watermark_position' => $watermark_position,
      'watermark_width' => $watermark_width,
      'watermark_height' => $watermark_height,
      'watermark_url' => $watermark_url,
      'watermark_text' => $watermark_text,
      'watermark_link' => $watermark_link,
      'watermark_font_size' => $watermark_font_size,
      'watermark_font' => $watermark_font,
      'watermark_color' => $watermark_color,
      'watermark_opacity' => $watermark_opacity,    
      'built_in_watermark_type' => $built_in_watermark_type,
      'built_in_watermark_position' => $built_in_watermark_position,
      'built_in_watermark_size' => $built_in_watermark_size,
      'built_in_watermark_url' => $built_in_watermark_url,
      'built_in_watermark_text' => $built_in_watermark_text,
      'built_in_watermark_font_size' => $built_in_watermark_font_size,
      'built_in_watermark_font' => $built_in_watermark_font,
      'built_in_watermark_color' => $built_in_watermark_color,
      'built_in_watermark_opacity' => $built_in_watermark_opacity,          
      'gallery_role' => $gallery_role,
      'image_right_click' => $image_right_click,
      'popup_fullscreen' => $popup_fullscreen,
      'album_role' => $album_role,
      'image_role' => $image_role,
      'popup_autoplay' => $popup_autoplay,
      'album_view_type' => $album_view_type,
      'show_search_box' => $show_search_box,
      'search_box_width' => $search_box_width,
      'preload_images' => $preload_images,
      'preload_images_count' => $preload_images_count,
      'popup_enable_info' => $popup_enable_info,
      'popup_info_always_show' => $popup_info_always_show,
      'popup_enable_rate' => $popup_enable_rate,
      'thumb_click_action' => $thumb_click_action,
      'thumb_link_target' => $thumb_link_target,
      'comment_moderation' => $comment_moderation,
      'popup_hit_counter' => $popup_hit_counter,
      'enable_ML_import' => $enable_ML_import,
      'autoupdate_interval' => $autoupdate_interval,
      'instagram_client_id' => $instagram_client_id,
      'showthumbs_name' => $showthumbs_name,
      'show_album_name' => $show_album_name,
      'show_image_counts' => $show_image_counts,
      'play_icon' => $play_icon,
      'show_masonry_thumb_description' => $show_masonry_thumb_description,
      'popup_info_full_width' => $popup_info_full_width,
      'show_sort_images' => $show_sort_images,
      'enable_seo' => $enable_seo,
      'autohide_lightbox_navigation' => $autohide_lightbox_navigation,
      'autohide_slideshow_navigation' => $autohide_slideshow_navigation,
      'read_metadata' => $read_metadata,
      ), array('id' => 1));

    if ($save !== FALSE) {      
      if ($old_images_directory && $old_images_directory != $images_directory) {
        rename(ABSPATH . $old_images_directory . '/photo-gallery', ABSPATH . $images_directory . '/photo-gallery');
      }
      if (!is_dir(ABSPATH . $images_directory . '/photo-gallery')) {
        mkdir(ABSPATH . $images_directory . '/photo-gallery', 0777);
      }
      echo WDWLibrary::message('Item Succesfully Saved.', 'updated');

    }
    else {
      echo WDWLibrary::message('Error. Please install plugin again.', 'error');
    }
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