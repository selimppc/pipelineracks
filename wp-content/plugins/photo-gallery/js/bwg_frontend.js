function spider_frontend_ajax(form_id, current_view, id, album_gallery_id, cur_album_id, type, srch_btn, title, sortByParam) {
  var page_number = jQuery("#page_number_" + current_view).val();
  var bwg_previous_album_ids = jQuery('#bwg_previous_album_id_' + current_view).val();
  var bwg_previous_album_page_numbers = jQuery('#bwg_previous_album_page_number_' + current_view).val();
  var post_data = {};
  if (album_gallery_id == 'back') { // Back from album.
    var bwg_previous_album_id = bwg_previous_album_ids.split(",");
    album_gallery_id = bwg_previous_album_id[0];
    jQuery('#bwg_previous_album_id_' + current_view).val(bwg_previous_album_ids.replace(bwg_previous_album_id[0] + ',', ''));
    var bwg_previous_album_page_number = bwg_previous_album_page_numbers.split(",");
    page_number = bwg_previous_album_page_number[0];
    jQuery('#bwg_previous_album_page_number_' + current_view).val(bwg_previous_album_page_numbers.replace(bwg_previous_album_page_number[0] + ',', ''));
  }
  else if (cur_album_id != '') { // Enter album (not change the page).
    jQuery('#bwg_previous_album_id_' + current_view).val(cur_album_id + ',' + bwg_previous_album_ids);
    if (page_number) {
      jQuery('#bwg_previous_album_page_number_' + current_view).val(page_number + ',' + bwg_previous_album_page_numbers);
    }
    page_number = 1;
  }
  if (srch_btn) { // Start search.
    page_number = 1; 
  }
  if (typeof title == "undefined") {
    var title = "";
  }
  if (typeof sortByParam == "undefined") {
    var sortByParam = jQuery(".bwg_order_" + current_view).val();
  }
  post_data["page_number_" + current_view] = page_number;
  post_data["album_gallery_id_" + current_view] = album_gallery_id;
  post_data["bwg_previous_album_id_" + current_view] = jQuery('#bwg_previous_album_id_' + current_view).val();
  post_data["bwg_previous_album_page_number_" + current_view] = jQuery('#bwg_previous_album_page_number_' + current_view).val();
  post_data["type_" + current_view] = type;
  post_data["title_" + current_view] = title;
	post_data["sortImagesByValue_" + current_view] = sortByParam;
  if (jQuery("#bwg_search_input_" + current_view).length > 0) { // Search box exists.
    post_data["bwg_search_" + current_view] = jQuery("#bwg_search_input_" + current_view).val();
  }
  // Loading.
  jQuery("#ajax_loading_" + current_view).css('display', '');
  jQuery.post(
    window.location,
    post_data,
    function (data) {
      var str = jQuery(data).find('#' + form_id).html();
      jQuery('#' + form_id).html(str);
      // There are no images.
      if (jQuery("#bwg_search_input_" + current_view).length > 0 && album_gallery_id == 0) { // Search box exists and not album view.
        var bwg_images_count = jQuery('#bwg_images_count_' + current_view).val();
        if (bwg_images_count == 0) {
          var cont = jQuery("#" + id).parent().html();
          var error_msg = '<div style="width:95%"><div class="error"><p><strong>' + bwg_objectL10n.bwg_search_result + '</strong></p></div></div>';
          jQuery("#" + id).parent().html(error_msg + cont)
        }
      }
    }
  ).success(function(jqXHR, textStatus, errorThrown) {
    jQuery("#ajax_loading_" + current_view).css('display', 'none');
    // window.scroll(0, spider_get_pos(document.getElementById(form_id)));
    jQuery("html, body").animate({scrollTop: jQuery('#' + form_id).offset().top - 150}, 500);
    /* For all*/
    window["bwg_document_ready_" + current_view]();
    /* For masonry view.*/
    /*
    var cccount_masonry = 0;
    var tot_cccount_masonry = jQuery(".bwg_masonry_thumb_spun_" + current_view + " img").length;
    jQuery(".bwg_masonry_thumb_spun_" + current_view + " img").on("load", function() {
      if (++cccount_masonry == tot_cccount_masonry) {
        window["bwg_masonry_" + current_view]();
      }
    });
    jQuery(".bwg_masonry_thumb_spun_" + current_view + " img").error(function() {
      
      jQuery(this).height(100);
      jQuery(this).width(100);
      if (++cccount_masonry == tot_cccount_masonry) {
        
        window["bwg_masonry_" + current_view]();

      }
    });
    */

    /* For Blog style view.*/
    jQuery(".blog_style_images_conteiner_" + current_view + " .bwg_embed_frame_16x9_" + current_view).each(function (e) {
      jQuery(this).width(jQuery(this).parent().width());
      jQuery(this).height(jQuery(this).width() * 0.5625);
    });
    jQuery(".blog_style_images_conteiner_" + current_view + " .bwg_embed_frame_instapost_" + current_view).each(function (e) {
      jQuery(this).width(jQuery(this).parent().width());
      jQuery(this).height(jQuery(this).width() +88);
    });
    


    /* For Image browser view.*/
    
    jQuery('#bwg_embed_frame_16x9_'+current_view).width(jQuery('#bwg_embed_frame_16x9_'+current_view).parent().width());
    jQuery('#bwg_embed_frame_16x9_'+current_view).height(jQuery('#bwg_embed_frame_16x9_'+current_view).width() * 0.5625);
    jQuery('#bwg_embed_frame_instapost_'+current_view).width(jQuery('#bwg_embed_frame_16x9_'+current_view).parent().width());
    jQuery('#bwg_embed_frame_instapost_'+current_view).height(jQuery('#bwg_embed_frame_instapost_'+current_view).width() +88);
    

    /* For mosaic view.*/
    /*
    var cccount_mosaic = 0;
    var tot_cccount_mosaic = jQuery(".bwg_mosaic_thumb_spun_" + current_view + " img").length;

    jQuery(".bwg_mosaic_thumb_spun_" + current_view + " img").on("load", function() {

      if (++cccount_mosaic == tot_cccount_mosaic) {
        
        window["bwg_mosaic_" + current_view]("load");

      }
    });
    jQuery(".bwg_mosaic_thumb_spun_" + current_view + " img").error(function() {

      jQuery(this).height(100);
      jQuery(this).width(100);
      if (++cccount_mosaic == tot_cccount_mosaic) {
        
        window["bwg_mosaic_" + current_view]("load");

      }
    });*/
    
  });
  // if (event.preventDefault) {
    // event.preventDefault();
  // }
  // else {
    // event.returnValue = false;
  // }
  return false;
}
