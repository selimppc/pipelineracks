<?php
	if ( ! defined( 'ABSPATH' ) ) exit;
	
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
	
	$advpsPlist = array(
			"advps_post_stypes" => "post",
			"advps_plistmax" => "99", 
			"advps_plistorder_by" => "name",
			"advps_plistorder" => "ASC",
			"advps_plist" => array()
	);
	
	$advpsQuery = array(
			"advps_post_types" => "post",
			"advps_maxpost" => "10",
			"advps_offset" => "",
			"advps_exclude" => "", 
			"advps_order_by" => "date",
			"advps_order" => "DESC"
	);
	
	$advpsSlide = array(
			"advps_slider_type" => "standard",
			"advps_transition" => "css3",
			"advps_effects" => "fade",
			"advps_speed" => "2000",
			"advps_autoplay" => "yes",
			"advps_timeout" => "3000",	
			"advps_sldmargin" => "0",		
			"advps_ps_hover" => "yes"
	);	
	//$advpsSlide2 = array_merge($advpsSlide,array("advps_slider_type" => "standard"));
	
	$advpsCaroTicker = array(
			"advps_caro_slds" => "3",
			"advps_caro_sldwidth" => "180",
	);
	
	$advpsContainer = array(
			"advps_thumbnail" => "advps-thumb-one",
			"advps_default_image" => "",
			"advps_sld_width" => "600",
			"advps_centering" => "no",
			"advps_bgcolor" => "#FFFFFF",
			"advps_border_size" => "1", 
			"advps_border_type" => "solid",
			"advps_border_color" => "#444444",
			"advps_remove_border" => "no",
			"advps_bxshad1" => "0", 
			"advps_bxshad2" => "1", 
			"advps_bxshad3" => "4", 
			"advps_bxshadcolor" => "#000000",
			"advps_remove_shd" => "no"
	);
	$advpsContainer2 = array_merge($advpsContainer,array("advps_ed_link" => "enable","advps_link_type" => "permalink","advps_link_target" => "_self"));
	
	$advpsContainer3 = array_merge($advpsContainer,array("advps_contpad1" => "0.8","advps_contpad2" => "0.8","advps_contpad3" => "0.8","advps_contpad4" => "0.8","advps_thumbnail" => "medium","advps_padu1"=>"vw","advps_padu2"=>"vw","advps_padu3"=>"vw","advps_padu4"=>"vw"));
	
	$advpsContent = array(
			"advps_overlay_width" => "30", 
			"advps_overlay_height" => "100", 
			"advps_overlay_color" => "#000000", 
			"advps_overlay_opacity" => "0.6", 
			"advps_text_opacity" => "1", 
			"advps_text_align" => "left",
			"advps_ttitle_tag" => "h2",
			"advps_titleFcolor" => "#FFFFFF",
			"advps_titleHcolor" => "#c9c9c9", 
			"advps_titleFsizeL" => "20",
			"advps_titleFsize1" => "18",
			"advps_titleFsize2" => "16",
			"advps_titleFsize3" => "15",
			"advps_titleFsize4" => "15",
			"advps_titleFsize5" => "15",
			"advps_titleLheightL" => "20",
			"advps_titleLheight1" => "18",
			"advps_titleLheight2" => "16",
			"advps_titleLheight3" => "15",
			"advps_titleLheight4" => "15",
			"advps_titleLheight5" => "15",
			"advps_excptFcolor" => "#FFFFFF", 
			"advps_excptFsizeL" => "14", 
			"advps_excptFsize1" => "12",
			"advps_excptFsize2" => "12",
			"advps_excptFsize3" => "12",
			"advps_excptFsize4" => "12",
			"advps_excptFsize5" => "12",
			"advps_excptLheightL" => "14", 
			"advps_excptLheight1" => "12",
			"advps_excptLheight2" => "12",
			"advps_excptLheight3" => "12",
			"advps_excptLheight4" => "12",
			"advps_excptLheight5" => "12",
			"advps_excerptlen" => "25", 
			"advps_excpt_visibility" => "always show",
			"advps_excpt_position" => "left",
			"advps_exclude_excpt" => "no",
			"advps_ed_link" => "enable",
			"advps_link_type" => "permalink",
			"advps_link_rel" => "none",
			"advps_link_target" => "_self"
	);
	$advpsContent2 = array(
			"advps_content_set" => array(0=>"thumb",1=>"title",2=>"excerpt"),
			"advps_cont_width" => "250",
			"advps_ttitle_tag" => "h2",
			"advps_titleFcolor" => "#565656",
			"advps_titleHcolor" => "#000000", 
			"advps_titleFsizeL" => "20",
			"advps_titleFsize1" => "18",
			"advps_titleFsize2" => "16",
			"advps_titleFsize3" => "15",
			"advps_titleFsize4" => "15",
			"advps_titleFsize5" => "15",
			"advps_titleLheightL" => "20",
			"advps_titleLheight1" => "18",
			"advps_titleLheight2" => "16",
			"advps_titleLheight3" => "15",
			"advps_titleLheight4" => "15",
			"advps_titleLheight5" => "15", 
			"advps_excptFcolor" => "#444444", 
			"advps_excptFsizeL" => "14", 
			"advps_excptFsize1" => "12",
			"advps_excptFsize2" => "12",
			"advps_excptFsize3" => "12",
			"advps_excptFsize4" => "12",
			"advps_excptFsize5" => "12",
			"advps_excptLheightL" => "14", 
			"advps_excptLheight1" => "12",
			"advps_excptLheight2" => "12",
			"advps_excptLheight3" => "12",
			"advps_excptLheight4" => "12",
			"advps_excptLheight5" => "12",
			"advps_excerptlen" => "25", 
			"advps_ed_link" => "enable",
			"advps_link_type" => "permalink",
			"advps_link_rel" => "none",
			"advps_link_target" => "_self"
	);
	$advpsNavigation = array(
			"advps_exclude_pager" => "no",
			"advps_pager_type" => "bullet",
			"advps_pthumb_width" => "10",
			"advps_pager_align" => "center",
			"advps_pager_bottom" => "-35",
			"advps_exclude_playpause" => "no",
			"advps_ppause_align" => "center",
			"advps_ppause_bottom" => "6",
			"advps_exclude_nxtprev" => "no"
	);
	
	function set_advps_options(){
		global $wpdb;
		global $advpsPlist;
		global $advpsQuery;
		global $advpsSlide;
		global $advpsSlide2;
		global $advpsCaroTicker;
		global $advpsContainer;
		global $advpsContainer2;
		global $advpsContainer3;
		global $advpsContent;
		global $advpsContent2;
		global $advpsNavigation;
		
		$db_version = get_option('advps-db-version');
		$advps_opt_table = $wpdb->prefix.'advps_optionset';
		
		/*if($db_version){
			update_option('advps-update-notification','show');
		}*/
		
		if(!get_option('advpssmethod1')){
			add_option('advpssmethod1','plist');
		}
		if(!get_option('advpssmethod2')){
			add_option('advpssmethod2','plist');
		}
		if(!get_option('advpssmethod3')){
			add_option('advpssmethod3','plist');
		}		
		
		if( $wpdb->get_results("SHOW TABLES LIKE '".$advps_opt_table."'") && $db_version < 2 ){
			$wpdb->query("DROP TABLE ".$advps_opt_table);			
		}
		
		$ins_q = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."advps_optionset (
  				`id` int(5) NOT NULL AUTO_INCREMENT,
  				`template` varchar(10) CHARACTER SET utf8 NOT NULL,
				`plist` text CHARACTER SET utf8 NOT NULL,
  				`query` text CHARACTER SET utf8 NOT NULL,
  				`slider` text NOT NULL,
  				`caro_ticker` text NOT NULL,
  				`container` text NOT NULL,
  				`content` text NOT NULL,
  				`navigation` text NOT NULL,
  				PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
		$wpdb->query($ins_q);
		
		$ins_q2 = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."advps_thumbnail (
				`id` int(2) NOT NULL AUTO_INCREMENT,
				`thumb_name` varchar(500) NOT NULL,
				`width` int(4) NOT NULL,
				`height` int(4) NOT NULL,
				`crop` varchar(5) NOT NULL,
				PRIMARY KEY (`id`)
			  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
		$wpdb->query($ins_q2);
		
		$q1 = "insert into ".$advps_opt_table." (template,plist,query,slider,caro_ticker,container,content,navigation) values('one','".serialize($advpsPlist)."','".serialize($advpsQuery)."','".serialize($advpsSlide)."','".serialize($advpsCaroTicker)."','".serialize($advpsContainer)."','".serialize($advpsContent)."','".serialize($advpsNavigation)."')";
		$q2 = "insert into ".$advps_opt_table." (template,plist,query,slider,caro_ticker,container,navigation) values('two','".serialize($advpsPlist)."','".serialize($advpsQuery)."','".serialize($advpsSlide)."','".serialize($advpsCaroTicker)."','".serialize($advpsContainer2)."','".serialize($advpsNavigation)."')";
		$q3 = "insert into ".$advps_opt_table." (template,plist,query,slider,caro_ticker,container,content,navigation) values('three','".serialize($advpsPlist)."','".serialize($advpsQuery)."','".serialize($advpsSlide)."','".serialize($advpsCaroTicker)."','".serialize($advpsContainer3)."','".serialize($advpsContent2)."','".serialize($advpsNavigation)."')";
		
		if(!$wpdb->get_results("select id from ".$advps_opt_table." where template = 'one'")){
			$wpdb->query($q1);
		}
		if(!$wpdb->get_results("select id from ".$advps_opt_table." where template = 'two'")){
			$wpdb->query($q2);
		}
		if(!$wpdb->get_results("select id from ".$advps_opt_table." where template = 'three'")){
			$wpdb->query($q3);
		}
		
		if(!$wpdb->get_results("select id from ".$wpdb->prefix."advps_thumbnail where thumb_name = 'advps-thumb-one'")){
			$wpdb->query( "insert into ".$wpdb->prefix."advps_thumbnail (thumb_name,width,height,crop) values('advps-thumb-one',600,220,'yes')");
		}
		update_option('advps-db-version',2);
	}