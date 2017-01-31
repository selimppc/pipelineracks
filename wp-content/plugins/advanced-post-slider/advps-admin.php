<?php
	if ( ! defined( 'ABSPATH' ) || ! current_user_can( 'manage_options' ) ) exit;
	
	global $wpdb;
	global $wp_version;
	$stsMgs = '';
	$flg = 0;
	
	if(isset($_GET['tab'])){
		$currTab = sanitize_text_field( $_GET['tab'] );
	}
	else
	{
		$currTab = 'one';
	}
	if(isset($_GET['hide'])){
		update_option('advps-update-notification','hide');
	}
	if(isset($_POST['optset-id'])){
		$optset_id = intval( $_POST['optset-id'] );
		
		if ( !isset($_POST['advps_wpnonce']) || !wp_verify_nonce($_POST['advps_wpnonce'],'advps-checkauthnonce') )
		{
			print 'Sorry, your nonce did not verify.';
			exit;
		}
		
		if(isset($_POST['del-optset'])){
			$q_del = $wpdb->prepare("delete from ".$wpdb->prefix."advps_optionset where id = %d",$optset_id);			
			if($wpdb->query($q_del)){
				delete_option('optset'.$optset_id);
				$stsMgs =  "Deleted successfully.";
			}
		}
		elseif(isset($_POST['dup-optset'])){
			$nextopt_id = intval( $_POST['nextoptid'] );
			
			$q_sel = $wpdb->prepare( "select * from ".$wpdb->prefix."advps_optionset where id = %d",$optset_id );
			$res = $wpdb->get_results($q_sel);
			
			$q_add = $wpdb->prepare("insert into ".$wpdb->prefix."advps_optionset (template,plist,query,slider,caro_ticker,container,content,navigation) values(%s,%s,%s,%s,%s,%s,%s,%s)",$res[0]->template,$res[0]->plist,$res[0]->query,$res[0]->slider,$res[0]->caro_ticker,$res[0]->container,$res[0]->content,$res[0]->navigation);
			
			if($wpdb->query($q_add)){
				update_option('advpssmethod'.$nextopt_id,get_option('advpssmethod'.$optset_id ));
				$stsMgs =  "Duplicated successfully.";
			}
		}
	}
	if(isset($_POST['advps_submit'])){
		
		if($_POST['advps_submit'] == 'Add new slideshow'){
			
			if ( !isset($_POST['advps_wpnonce']) || !wp_verify_nonce($_POST['advps_wpnonce'],'advps-checkauthnonce') )
			{
			   print 'Sorry, your nonce did not verify.';
			   exit;
			}
			
			//$all_field = $_POST;
			$nextopt_id = intval( $_POST['nextoptid'] );
			$tem_list = array('one','two','three');
			$template = sanitize_text_field($_POST['template']);
			if( ! in_array( $template, $tem_list )){
				exit;
			}
			global $advpsPlist;
			global $advpsQuery;
			global $advpsSlide;
			//global $advpsSlide2;
			global $advpsCaroTicker;
			global $advpsContainer;
			global $advpsContainer2;
			global $advpsContainer3;
			global $advpsContent;
			global $advpsContent2;
			global $advpsNavigation;
			
			if( $template == 'one'){
				$q_add = $wpdb->prepare("insert into ".$wpdb->prefix."advps_optionset (template,plist,query,slider,caro_ticker,container,content,navigation) values(%s,%s,%s,%s,%s,%s,%s,%s)",$template,serialize($advpsPlist),serialize($advpsQuery),serialize($advpsSlide),serialize($advpsCaroTicker),serialize($advpsContainer),serialize($advpsContent),serialize($advpsNavigation));
			}
			elseif( $template == 'two'){
				$q_add = $wpdb->prepare("insert into ".$wpdb->prefix."advps_optionset (template,plist,query,slider,caro_ticker,container,navigation) values(%s,%s,%s,%s,%s,%s,%s)",$template,serialize($advpsPlist),serialize($advpsQuery),serialize($advpsSlide),serialize($advpsCaroTicker),serialize($advpsContainer2),serialize($advpsNavigation));
			}
			elseif($template == 'three'){
				$q_add = $wpdb->prepare("insert into ".$wpdb->prefix."advps_optionset (template,plist,query,slider,caro_ticker,container,content,navigation) values(%s,%s,%s,%s,%s,%s,%s,%s)",$template,serialize($advpsPlist),serialize($advpsQuery),serialize($advpsSlide),serialize($advpsCaroTicker),serialize($advpsContainer3),serialize($advpsContent2),serialize($advpsNavigation));
			}
			if($wpdb->query($q_add)){
				update_option('advpssmethod'.$nextopt_id,'plist');
				$stsMgs =  "Added successfully.";
			}
		}
		
	}
	
	if(isset($_POST['advps_add_thumb'])){
		if($_POST['advps_add_thumb'] == 'Add'){
			
			if ( !isset($_POST['advps_wpnonce']) || !wp_verify_nonce($_POST['advps_wpnonce'],'advps-checkauthnonce') )
			{
			   print 'Sorry, your nonce did not verify.';
			   exit;
			}
			
			$thumb_name = sanitize_text_field($_POST['advps_thumb_name']);
			$width = intval($_POST['advps_thumb_width']);
			$height = intval($_POST['advps_thumb_height']);
			$crop = sanitize_text_field($_POST['advps_crop']);
	
			$q = $wpdb->prepare("insert into ".$wpdb->prefix."advps_thumbnail (thumb_name,width,height,crop) values(%s,%d,%d,%s)",$thumb_name,$width,$height,$crop);
			 if($wpdb->query($q)){
				$stsMgs =  "Added successfully.";
			}				
		}
	}
	if(isset($_POST['update_thumb'])){
		
		if ( !isset($_POST['advps_wpnonce']) || !wp_verify_nonce($_POST['advps_wpnonce'],'advps-checkauthnonce') )
		{
		   print 'Sorry, your nonce did not verify.';
		   exit;
		}
		
		$thumb_id = intval($_POST['thumb_id']);
		$thumb_name = sanitize_text_field($_POST['advps_thumb_name']);
		$width = intval($_POST['advps_thumb_width']);
		$height = intval($_POST['advps_thumb_height']);
		$crop = sanitize_text_field($_POST['advps_crop']);
			
		$q = $wpdb->prepare("update ".$wpdb->prefix."advps_thumbnail set thumb_name = '%s',width = %d, height = %d, crop = '%s' where id = %d",$thumb_name,$width,$height,$crop,$thumb_id);
		if($wpdb->query($q)){
			$stsMgs =  "Updated successfully.";
		}
	}
	
	$q1 = "select * from ".$wpdb->prefix."advps_optionset where template = 'one'";
	$q2 = "select * from ".$wpdb->prefix."advps_optionset where template = 'two'";
	$q3 = "select * from ".$wpdb->prefix."advps_optionset where template = 'three'";
	$res1 = $wpdb->get_results($q1);
	$res2 = $wpdb->get_results($q2);
	$res3 = $wpdb->get_results($q3);
	
	$q_thumb = "select * from ".$wpdb->prefix."advps_thumbnail";
	$res_thumb = $wpdb->get_results($q_thumb);
	$catList = get_categories();	
	$customPostTypes = get_post_types(array('public' => true, '_builtin' => false)); 
?>
<script>
	jQuery(document).ready(function($) {
        $("legend.advps-legend").click(function(){
			if($(this).hasClass('advpssm')){
				$(this).parent().find("div").eq(0).slideToggle(100,'linear',function(){});
			}
			else{
				$(this).parent().find("table").slideToggle(100,'linear',function(){});
			}
			if($(this).hasClass('closed')){
				$(this).css('background-image','url(<?php echo esc_url( advps_url );?>images/up.png)');
				$(this).removeClass('closed');
			}
			else
			{
				$(this).css('background-image','url(<?php echo esc_url( advps_url );?>images/down.png)');
				$(this).addClass('closed');
			}
		})
    });
</script>
<style>
.metabox-holder {
	width:72%;
}
.advps-col-right {
	width:22%;
	float:right;
	position:relative;
	background-color:#fff;
	margin-top:30px;
	padding:10px;
}
.advps-col-right li {
	list-style:inside;
	color:#0074a2;
	text-decoration:underline;
}
.form-table th {
	font-size:12px;
}
fieldset {
	border:1px solid #999999;
	margin-bottom:20px;
	padding:0px 5px 10px 20px;
}
.advps-legend {
	background-color:#6E6E6E;
 background-image:url(<?php echo esc_url( advps_url );?>images/up.png);
	background-repeat:no-repeat;
	background-position: 96px 6px;
	color:#FFF;
	border:1px solid #999;
	padding:4px 10px;
	font-size:12px;
	margin-left:10px;
	cursor:pointer;
	border-radius:4px;
}
.postbox .inside {
	position:relative;
	margin: 15px 25px;
}
.wp-admin select {
	font-size:12px;
}
.wp-admin select[multiple], #wpcontent select[multiple] {
	height: auto;
}
.form-table, .form-table td, .form-table th, .form-table td p, .form-wrap label {
	font-size:12px;
}
.advps-optset-label {
	width:200px;
}
.ajx-sts {
	color: #298A08;
	font-size: 12px;
	font-style: italic;
	font-weight: bold;
	padding-left: 20px;
}
.postbox .down {
 background-image:url(<?php echo esc_url( advps_url );?>images/downb.png);
	background-repeat:no-repeat;
	background-position: 4px 10px;
}
.postbox .up {
 background-image:url(<?php echo esc_url( advps_url );?>images/upb.png);
	background-repeat:no-repeat;
	background-position: 4px 10px;
}
.advps-highlight {
	border: 1px solid #7AD03A !important;
}
.advps-hide {
	display:none;
}
.advps-fade {
	color:#D1D0CE;
}
</style>
<div class="wrap">
  <?php if(get_option('advps-update-notification') && get_option('advps-update-notification') == 'show'){?>
  <div id="message" class="updated below-h2">
    <p>Advanced post slider is updated. <span style="margin:0 10px;"><input class="button" type="button" onclick="document.location.href='http://www.wpcue.com/advanced-post-slider-2-3-0/';" value="Check what's new in version 2.3"></span>
    <input class="button" type="button" onclick="document.location.href='admin.php?page=advps-slideshow&hide=1';" value="Hide this message">
    </p>
  </div>
  <?php }?>
  <?php if($stsMgs != ''){?>
  <div id="message" class="updated below-h2">
    <p><?php echo esc_html( $stsMgs );?></p>
  </div>
  <?php }?>
  <h2 class="nav-tab-wrapper"> <a href="?page=advps-slideshow&tab=one" class="nav-tab <?php if($currTab == 'one'){echo 'nav-tab-active';}?>" title="Thumbnail and overlaid title excerpt">Template One</a> <a href="?page=advps-slideshow&tab=two" class="nav-tab <?php if($currTab == 'two'){echo 'nav-tab-active';}?>" title="Thumbnail only">Template Two</a> <a href="?page=advps-slideshow&tab=three" class="nav-tab <?php if($currTab == 'three'){echo 'nav-tab-active';}?>" title="Thumbnail, title, excerpt or simply full content">Template Three</a><a href="?page=advps-slideshow&tab=thumb" class="nav-tab <?php if($currTab == 'thumb'){echo 'nav-tab-active';}?>" title="Create or manage thumbnail size">Thumbnails</a> </h2>
  <?php if($currTab == 'one'){
	  		require 'templates/template-one.php';
		}elseif($currTab == 'two'){
			require 'templates/template-two.php';
		}elseif($currTab == 'three'){
			require 'templates/template-three.php';
		}elseif($currTab == 'thumb'){?>
  <div class="advps-col-right">
    <h2>Advanced post slider <?php echo esc_html( get_option('advps-curr-version') );?></h2>
    <ul>
      <li><a href="http://www.wpcue.com/wordpress-plugins/advanced-post-slider/" target="_blank">Plugin Homepage</a></li>
      <li><a href="http://www.wpcue.com/support/forum/advanced-post-slider/" target="_blank">Help / Support</a></li>
      <li><a href="http://www.wpcue.com/resources/advanced-post-slider-documentaion/" target="_blank">Getting Started</a></li>
      <li><a href="http://www.wpcue.com/faq/" target="_blank">FAQ</a></li>
    </ul>
    <h3>Do you like this Plugin?</h3>
    <p>We spend lots of hours to develop, maintain and providing support to this plugin.  Any kind of participation will be highly appreciated and real inspiration for us to work more.</p>
    <ul>
      <li>Write a small blog for Advanced post slider and give link to our site.</li>
      <li>Share it to your social media.</li>
      <li><a href="http://wordpress.org/support/view/plugin-reviews/advanced-post-slider" target="_blank">Give it a good rating and review</a></li>
      <li><a href="http://wordpress.org/plugins/advanced-post-slider/" target="_blank">Vote that it work</a></li>
    </ul>
  </div>
  <div class="metabox-holder" style="margin-top:20px;">
    <div class="postbox-container" style="width:100%">
      <div class="postbox" style="margin-bottom:15px;">
        <h3><strong>Thumbnail settings</strong></h3>
        <table class="form-table" style="margin-left:12px;">
          <?php foreach( $res_thumb as $thmb){?>
          <tr>
            <form method="post">
              <th scope="row">Name&nbsp;
                <input type="text" name="advps_thumb_name" value="<?php echo esc_attr( $thmb->thumb_name );?>" style="width:140px" /></th>
              <td>Width&nbsp;
                <input type="text" name="advps_thumb_width" value="<?php echo esc_attr( $thmb->width );?>" style="width:80px;" onkeypress="return onlyNum(event);" />
                px&nbsp;&nbsp;&nbsp;Height&nbsp;
                <input type="text" name="advps_thumb_height" value="<?php echo esc_attr( $thmb->height );?>" style="width:80px;" onkeypress="return onlyNum(event);" />
                px <span style="margin-left:20px;">Crop&nbsp;
                <select name="advps_crop">
                  <option value="yes" <?php if($thmb->crop == 'yes'){echo 'selected="selected"';}?>>true</option>
                  <option value="no" <?php if($thmb->crop == 'no'){echo 'selected="selected"';}?>>false</option>
                </select>
                </span> <span style="margin-left:20px;">
                <input type="submit" value="Save" class="button-secondary" name="update_thumb" />
                </span></td>
              <input type="hidden" value="<?php echo esc_attr( $thmb->id );?>" name="thumb_id" />
              <?php wp_nonce_field('advps-checkauthnonce','advps_wpnonce'); ?>
            </form>
          </tr>
          <?php }?>
        </table>
        <p style="margin-left:12px; font-style:italic; font-size:12px; font-weight:bold;"><span style="text-decoration:underline; font-weight:bolder;">N.B.</span> From version 2 you dont need to re-generate your existing post thumbnail after creating a new thumbnail size or changing dimensions of existing advps thumbnail size.</p>
      </div>
      <?php if(!isset($_POST['advps_add_thumb']) || $_POST['advps_add_thumb'] != 'Add New'){?>
      <div style="position:relative; float:left; width:100%;">
        <form method="post">
          <input type="submit" class="button-secondary" value="Add New" name="advps_add_thumb" style="width:80px;" />
        </form>
      </div>
      <?php }else{?>
      <div class="postbox">
        <h3><strong>Add thumbnail</strong></h3>
        <form method="post">
          <table class="form-table">
            <tr>
              <th scope="row">Name&nbsp;
                <input type="text" name="advps_thumb_name" value="" style="width:140px" /></th>
              <td>Width&nbsp;
                <input type="text" name="advps_thumb_width" value="" style="width:80px;" onkeypress="return onlyNum(event);" />
                px&nbsp;&nbsp;&nbsp;Height&nbsp;
                <input type="text" name="advps_thumb_height" value="" style="width:80px;" onkeypress="return onlyNum(event);" />
                px <span style="margin-left:20px;">Crop&nbsp;
                <select name="advps_crop">
                  <option value="yes">true</option>
                  <option value="no" selected="selected">false</option>
                </select>
                </span> <span style="margin-left:20px;">
                <?php wp_nonce_field('advps-checkauthnonce','advps_wpnonce'); ?>
                <input type="submit" value="Add" class="button-secondary" name="advps_add_thumb" />
                </span></td>
            </tr>
          </table>
        </form>
      </div>
      <?php }?>
    </div>
  </div>
  <?php }?>
</div>
<meta name="wpversion" content="<?php echo esc_attr( $wp_version );?>" />
