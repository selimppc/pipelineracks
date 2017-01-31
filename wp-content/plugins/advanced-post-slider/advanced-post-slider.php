<?php
/*
	Plugin Name: Advanced post slider
	Plugin URI: www.wpcue.com
	Description: A multipurpose responsive slideshow plugin powered with three built-in design template, lots of easy customizable options and many more to explore.
	Version: 2.5.0
	Author: digontoahsan
	Author URI: www.wpcue.com
	License: GPL2
*/

	function advps_modify_menu(){
		add_menu_page( 'Advanced post slider', 'Adv. Slider', 'manage_options', 'advps-slideshow', 'advps_options' );
	}
	
	add_action('admin_menu','advps_modify_menu');

	function advps_options(){
		require 'advps-admin.php';
	}
	
	define('advps_url',WP_PLUGIN_URL."/advanced-post-slider/");
	
	require 'advps-db.php';
	
	/* ---------------------------------------------------------------------------------*/
	function advps_enqueue() {
		wp_register_style('advpsStyleSheet', advps_url.'advps-style.css');
		wp_enqueue_style( 'advpsStyleSheet');
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'advps_front_script',advps_url.'js/advps.frnt.script.js' );
		wp_enqueue_script( 'advps_jbx',advps_url.'bxslider/jquery.bxslider.min.js',array( 'jquery' ) );	
	}
	add_action( 'wp_enqueue_scripts', 'advps_enqueue' );
	
	function load_custom_wp_admin_style() {
		global $wp_version;		
		if(isset($_GET['page'])){
		$pgslug = $_GET['page'];
		$menuslug = array('advps-slideshow');
		
			if(!in_array($pgslug,$menuslug))
        		return;
       		 
			if($wp_version >= '3.5'){
				wp_enqueue_script( 'wp-color-picker' );
				wp_enqueue_style( 'wp-color-picker' );
			}
			else
			{
				wp_enqueue_style( 'farbtastic' );
  				wp_enqueue_script( 'farbtastic' );
			}
			wp_enqueue_script( 'advps-js-script', advps_url . 'js/advps.script.js', array( 'jquery' ) );
			wp_localize_script( 'advps-js-script', 'advpsajx', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),'advpsAjaxReqChck' => wp_create_nonce( 'advpsauthrequst' )));
			
		}
	
	}
	add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );
	
	/* ---------------------------------------------------------------------------------------*/
	
	register_activation_hook(WP_PLUGIN_DIR.'/advanced-post-slider/advanced-post-slider.php','set_advps_options');
	register_deactivation_hook(WP_PLUGIN_DIR.'/advanced-post-slider/advanced-post-slider.php','unset_advps_options');	
	
	
	function unset_advps_options(){
	}
	
	function advps_update_db(){
		if(get_option('advps-db-version') < 2){
			set_advps_options();
		}
		if(get_option('advps-db-version') && !get_option('advps-update-notification')){
			update_option('advps-update-notification','show');
		}
		update_option('advps-curr-version','2.5.0');
	}
	add_action( 'plugins_loaded', 'advps_update_db' );
	/* ---------------------------------------------------------------------------------------*/
	function advps_image_sizes(){
	  if ( function_exists( 'add_image_size' ) ) { 
		  global $wpdb;
		  $rth = $wpdb->get_results( "select * from ".$wpdb->prefix."advps_thumbnail");		
		  foreach($rth as $th){
			  add_image_size( $th->thumb_name,$th->width,$th->height, true); 
		  }
	  }
	  if(!function_exists('aq_resize') && !class_exists('Aq_Resize'))
		require_once( 'aq_resizer.php' );
	}
	add_action('wp_loaded', 'advps_image_sizes');
	
	function advps_excerpt_length_one( $length ) {
		
		return get_option('advps_excerptlen_one');
	}
	
	function advps_excerpt_length( $length ) {
		return get_option('advps_excerptlen');
	}	
	add_action( "wp_ajax_chkCaetegory", "chkCaetegory" );
	add_action( "wp_ajax_advpsUpdateLabel", "advpsUpdateLabel" );
	add_action( "wp_ajax_advpsUpdateOpt", "advpsUpdateOpt" );
	add_action( "wp_ajax_advpsListPost", "advpsListPost" );
	add_action( "wp_ajax_advpsUpdateSmethod", "advpsUpdateSmethod" );
	
	function advpsUpdateLabel(){
		$nonce = sanitize_text_field(  $_POST['checkReq'] );
		$fname = sanitize_text_field( $_POST['f_name'] );
		$fvalue = trim( sanitize_text_field( $_POST['f_value']) );
		if(! defined( 'ABSPATH' ) || !wp_verify_nonce( $nonce, 'advpsauthrequst' )){
			echo "Unauthorized request.";
			exit;
		}
		update_option($fname,$fvalue);
		exit;
	}
	
	function advpsSanit($str){
		return sanitize_text_field($str);
	}

	function chkCaetegory(){
		$nonce = sanitize_text_field( $_POST['checkReq'] );
		$posttype = sanitize_text_field( $_POST['post_type'] );
		if(! defined( 'ABSPATH' ) || !wp_verify_nonce( $nonce, 'advpsauthrequst' )){
			echo "Unauthorized request.";
			exit;
		}
		$catHtml = '';
		if($posttype == 'post'){
			$catHtml = '<th scope="row">Category</th><td><select name="advps_category[]" multiple="multiple">';    
			$catList = get_categories();
			foreach($catList as $scat){	 
    			$catHtml .= '<option value="'.$scat->term_id.'">'.$scat->name.'</option>';
    		}
  		$catHtml .= '</select><span style="padding-left:10px; font-size:10px; font-style:italic; vertical-align:top;">[ * You can select multiple category ]</span></td>';			
		}
		else
		{
			$posttypeobj = get_post_type_object($posttype);
			if(in_array('category',$posttypeobj->taxonomies)){
				$catHtml = '<th scope="row">Category</th><td><select name="advps_category[]" multiple="multiple">';    
				$catList = get_categories();
				foreach($catList as $scat){	 
					$catHtml .= '<option value="'.$scat->term_id.'">'.$scat->name.'</option>';
				}
			$catHtml .= '</select><span style="padding-left:10px; font-size:10px; font-style:italic; vertical-align:top;">[ * You can select multiple category ]</span></td>';
			}
		}
		echo $catHtml;
		exit;
	}
	function advpsUpdateOpt(){
		$nonce = sanitize_text_field( $_POST['checkReq'] );
		$optdata = $_POST['optdata'];
		
		if(! defined( 'ABSPATH' ) || !wp_verify_nonce( $nonce, 'advpsauthrequst' )){
			echo "Unauthorized request.";
			exit;
		}
		
		global $wpdb;
		$all_field = array();
		parse_str($optdata,$all_field);
		
		$optID = sanitize_text_field($all_field['opt_id']);
		$optfield = sanitize_text_field($all_field['opt_field']);
		
		unset($all_field['opt_id']);
		unset($all_field['opt_field']);
		
		$update_data = array();
		foreach($all_field as $fkey => $fval){
			if(is_array($fval)){
				$update_data[$fkey] = array_map('advpsSanit',$fval);
			}
			else
			{
				$update_data[$fkey] = sanitize_text_field($fval);
			}
		}
		
		$update_data = serialize($update_data);
		
		$q_chk = $wpdb->prepare("select template from ".$wpdb->prefix."advps_optionset where ".$optfield." = '%s' and id = %d",$update_data,$optID);
		if(!$wpdb->get_results($q_chk)){
			$q_upd = $wpdb->prepare("update ".$wpdb->prefix."advps_optionset set ".$optfield." = '%s' where id = %d",$update_data,$optID);
			if($wpdb->query($q_upd)){
				echo "Updated successfully.";
			}	
		}
		else
		{
			echo 'No change.';
		}
		exit;
	}
	function advpsListPost(){
		$nonce = sanitize_text_field( $_POST['checkReq'] );
		$ptype = sanitize_text_field( $_POST['ptype'] );
		$pmax = sanitize_text_field( $_POST['pmax'] );
		$porderBy = sanitize_text_field( $_POST['porderBy'] );
		$porder = sanitize_text_field( $_POST['porder'] );
		$plist = explode(',', sanitize_text_field( $_POST['plist'] ) ) ;
		
		if(! defined( 'ABSPATH' ) || !wp_verify_nonce( $nonce, 'advpsauthrequst' )){
			echo "Unauthorized request.";
			exit;
		}
		$plistHtml = '';
		$lpargs = array(
				'post_type'      => $ptype,
				'posts_per_page' => $pmax,
				'orderby'		 => $porderBy,
				'order'			 => $porder
		);
		$pl_query = new WP_Query($lpargs); while ($pl_query->have_posts()) : $pl_query->the_post();
		if($plist && in_array(get_the_id(),$plist)){
			$plistHtml .= '<option value="'.get_the_id().'" selected="selected">'.get_the_title().'</option>';
		}
		else{
			$plistHtml .= '<option value="'.get_the_id().'">'.get_the_title().'</option>';
		}
		endwhile;wp_reset_query();
		echo $plistHtml;
		exit;
	}
	function advpsUpdateSmethod(){
		$nonce = sanitize_text_field( $_POST['checkReq'] );
		$selnam = sanitize_text_field( $_POST['selnam'] );
		$selval = sanitize_text_field( $_POST['selval'] );
		
		if(! defined( 'ABSPATH' ) || !wp_verify_nonce( $nonce, 'advpsauthrequst' )){
			echo "Unauthorized request.";
			exit;
		}
		update_option($selnam,$selval);
		exit;
	}
	/* ---------------------------------------------------------------------------------------*/
	
	function advps_slideshow($atts) {
		global $post;
		global $wpdb;
		$current = $post->ID;
		
		if(is_array($atts) && array_key_exists('optset',$atts)){	
			$q1 = "select * from ".$wpdb->prefix."advps_optionset where id = ".intval($atts['optset']);
			$res1 = $wpdb->get_results($q1);
			if($res1){
				$plist = unserialize($res1[0]->plist);
				$query = unserialize($res1[0]->query);
				$slider = unserialize($res1[0]->slider);
				$caro_ticker = unserialize($res1[0]->caro_ticker);
				$container = unserialize($res1[0]->container);
				$content = unserialize($res1[0]->content);
				$navigation = unserialize($res1[0]->navigation);
			}
			else return;	
			$sldshowID = $atts['optset'];	
		}
		else return;
		
		if($query['advps_exclude']){
			$exclude = explode(',',$query['advps_exclude']);
		}
		else
		{
			$exclude = '';
		}
		
		$qtype = get_option('advpssmethod'.$sldshowID);		
		if($qtype == 'query'){
			$query_arg = array(
				'post_type' 	 => ($query['advps_post_types']) ? $query['advps_post_types'] : 'post',
				'post__not_in'   => $exclude,
				'offset'         => ($query['advps_offset']) ? $query['advps_offset'] : 0,
				'posts_per_page' =>	($query['advps_maxpost']) ? $query['advps_maxpost'] : 10,
				'orderby'		 => ($query['advps_order_by']) ? $query['advps_order_by'] : 'date',
				'order'			 => ($query['advps_order']) ? $query['advps_order'] : 'DESC'
			);
			
			if($query['advps_post_types'] && $query['advps_post_types'] != "page"){
				if($query['advps_post_types'] == "post"){
					if(isset($query['advps_category'])){
						$query_arg['cat'] = implode(',',$query['advps_category']);
					}
				}
				else
				{
					$post_type_obj = get_post_type_object( $query['advps_post_types'] );
					if(in_array('category',$post_type_obj->taxonomies)){
						if(isset($query['advps_category'])){
							$query_arg['cat'] = implode(',',$query['advps_category']);
						}
					}
				}
			}
		}
		elseif($qtype == 'plist'){
			$query_arg = array(
				'post_type' 	 => ($plist['advps_post_stypes']) ? $plist['advps_post_stypes'] : 'post',
				'post__in'   	 => $plist['advps_plist'],
				'posts_per_page' =>	($plist['advps_plistmax']) ? $plist['advps_plistmax'] : 10,
				'orderby'		 => ($plist['advps_plistorder_by']) ? $plist['advps_plistorder_by'] : 'date',
				'order'			 => ($plist['advps_plistorder']) ? $plist['advps_plistorder'] : 'DESC'
			);
		}
		
		$template = $res1[0]->template; 
		
		if(($template == "one" || $template == "two") && !post_type_supports( $query['advps_post_types'], 'thumbnail' )){
			return;				
		}
		
		if($template != 'two'){
			if($content['advps_excerptlen']){
				update_option('advps_excerptlen',$content['advps_excerptlen']);
			}
			else
			{
				update_option('advps_excerptlen',30);
			}
			add_filter( 'excerpt_length', 'advps_excerpt_length', 999 );
		}
		
		ob_start();
	?>
<!-- This slideshow output is generated with Advanced post slider a multipurpose responsive WordPress slideshow plugin - http://www.wpcue.com/wordpress-plugins/advanced-post-slider/ -->
<style>
#advps_container<?php echo $sldshowID;?> .bx-wrapper .bx-viewport {
	<?php if($container['advps_remove_shd'] == 'no'):?>
	-moz-box-shadow: <?php echo $container['advps_bxshad1'].'px '.$container['advps_bxshad2'].'px '.$container['advps_bxshad3'].'px '.$container['advps_bxshadcolor'];?>;
	-webkit-box-shadow: <?php echo $container['advps_bxshad1'].'px '.$container['advps_bxshad2'].'px '.$container['advps_bxshad3'].'px '.$container['advps_bxshadcolor'];?>;
	box-shadow: <?php echo $container['advps_bxshad1'].'px '.$container['advps_bxshad2'].'px '.$container['advps_bxshad3'].'px '.$container['advps_bxshadcolor'];?>;
	<?php endif;if($container['advps_remove_border'] == 'no'):?>
	border: <?php echo $container['advps_border_size'].'px '.$container['advps_border_type'].' '.$container['advps_border_color'];?>;
	<?php endif;?>
	background:<?php echo $container['advps_bgcolor'];?>;
}
#advps_container<?php echo $sldshowID;?> .bx-wrapper .bx-pager{
	text-align: <?php echo $navigation['advps_pager_align'];?>;
	<?php if($navigation['advps_pager_align'] == 'right'){echo 'padding-right:5px';}elseif($navigation['advps_pager_align'] == 'left'){echo 'padding-left:5px';}?>;
}
#advps_container<?php echo $sldshowID;?> .bx-wrapper .bx-pager
{
	bottom:<?php echo $navigation['advps_pager_bottom'];?>px;
	z-index:999;
}
#advps_container<?php echo $sldshowID;?> .bx-wrapper .bx-controls-auto
{
	bottom:<?php echo $navigation['advps_ppause_bottom'];?>px;
}
#advps_container<?php echo $sldshowID;?> .bx-wrapper .bx-controls.bx-has-controls-auto.bx-has-pager .bx-pager {
	text-align: <?php echo $navigation['advps_pager_align'];?>;
}
#advps_container<?php echo $sldshowID;?> .bx-wrapper .bx-controls-auto {
	z-index:99999;
	<?php if($navigation['advps_ppause_align'] == 'left'){echo 'left:5px;width:35px;';}elseif($navigation['advps_ppause_align'] == 'right'){echo 'right:0px;width:35px;';}else{echo 'text-align:center;width:100%;';}?>
}

<?php if($navigation['advps_exclude_pager'] == 'no' && (isset($navigation['advps_pager_type']) && $navigation['advps_pager_type'] == 'number')):?>
#advps_container<?php echo $sldshowID;?> .bx-wrapper .bx-pager.bx-default-pager a {
	margin: 2px 2px 2px 0;
	padding:3px 8px 3px 8px !important;
	text-decoration:none;
	width:auto;
	display:block;
	color:#FFFFFF;
	font-size:11px;
	font-weight:bold;
	text-shadow: 0px 1px 1px #666666;
	background-color:#333333;
	background: -webkit-gradient(linear, 0 top, 0 bottom, from(#666666), to(#000000));
	background: -moz-linear-gradient(#555555, #000000);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#666666', endColorstr='#000000',GradientType=0 );
	background-image: -ms-linear-gradient(top, #666666 0%, #000000 100%);
	background-image: -o-linear-gradient(top, #666666 0%, #000000 100%);
	background-repeat:no-repeat !important;
	background-position:center !important;
	-moz-border-radius:2px;
	-webkit-border-radius:2px;
	border-radius:2px;
}
#advps_container<?php echo $sldshowID;?> .bx-wrapper .bx-pager.bx-default-pager a:hover, #advps_container<?php echo $sldshowID;?> .bx-wrapper .bx-pager.bx-default-pager a.active{
	color:#000000;
	text-shadow: 0 1px 0 #FFFFFF;
	background-color:#FFFFFF;
	background:-moz-linear-gradient(#FFFFFF, #E0E0E0);
	background:-webkit-gradient(linear, 0 top, 0 bottom, from(#FFFFFF), to(#E0E0E0));
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#FFFFFF', endColorstr='#E0E0E0',GradientType=0 );
	background-image: -ms-linear-gradient(top, #FFFFFF 0%, #E0E0E0 100%);
	background-image: -o-linear-gradient(top, #FFFFFF 0%, #E0E0E0 100%);
}
<?php elseif($navigation['advps_exclude_pager'] == 'no' && (!isset($navigation['advps_pager_type']) || ($navigation['advps_pager_type'] == 'bullet' || ($slider['advps_slider_type'] != 'standard' && $navigation['advps_pager_type']=='thumb')))):?>
#advps_container<?php echo $sldshowID;?> .bx-wrapper .bx-pager.bx-default-pager a {
	background: #666;
	text-indent: -9999px;
	display: block;
	width: 10px;
	height: 10px;
	margin: 0 5px;
	outline: 0;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
	text-align:left;
}
#advps_container<?php echo $sldshowID;?> .bx-wrapper .bx-pager.bx-default-pager a:hover,
#advps_container<?php echo $sldshowID;?> .bx-wrapper .bx-pager.bx-default-pager a.active {
	background: #000;
}
<?php endif;?>

/* thumbnail pager*/
#advps_container<?php echo $sldshowID;?> #bx-pager
{
	width:100%;
	position:absolute;
	bottom:<?php echo $navigation['advps_pager_bottom'];?>px;
    text-align: <?php echo $navigation['advps_pager_align'];?>;
	z-index: 9999;
}
#advps_container<?php echo $sldshowID;?> #bx-pager a img
{
	border: 1px solid #CCCCCC;
    padding: 3px;
}
#advps_container<?php echo $sldshowID;?> #bx-pager a:hover img, #advps_container<?php echo $sldshowID;?> #bx-pager a.active img
{
	border: 1px solid #666666;
}
/* medai queries */
#advps_container<?php echo $sldshowID;?> .advs-title,#advps_container<?php echo $sldshowID;?> .advs-title a
{
	font-size:<?php if(isset($content['advps_titleFsizeL'])){echo $content['advps_titleFsizeL'];}else{echo 20;}?>px;
	line-height:<?php if(isset($content['advps_titleLheightL'])){echo $content['advps_titleLheightL'];}else{echo 20;}?>px;
}
#advps_container<?php echo $sldshowID;?> .advps-slide p
{
	font-size:<?php if(isset($content['advps_excptFsizeL'])){echo $content['advps_excptFsizeL'];}else{echo 14;}?>px;
	line-height:<?php if(isset($content['advps_excptLheightL'])){echo $content['advps_excptLheightL'];}else{echo 14;}?>px;
}
@media screen and (max-width: 1024px){
	#advps_container<?php echo $sldshowID;?> .advs-title,#advps_container<?php echo $sldshowID;?> .advs-title a
	{
		font-size:<?php if(isset($content['advps_titleFsize1'])){echo $content['advps_titleFsize1'];}else{echo 18;}?>px;
		line-height:<?php if(isset($content['advps_titleLheight1'])){echo $content['advps_titleLheight1'];}else{echo 18;}?>px;
	}
	#advps_container<?php echo $sldshowID;?> .advps-slide p
	{
		font-size:<?php if(isset($content['advps_excptFsize1'])){echo $content['advps_excptFsize1'];}else{echo 12;}?>px;
		line-height:<?php if(isset($content['advps_excptLheight1'])){echo $content['advps_excptLheight1'];}else{echo 12;}?>px;
	}
}
@media screen and (max-width: 768px){
	#advps_container<?php echo $sldshowID;?> h2.advs-title, #advps_container<?php echo $sldshowID;?> h2.advs-title a
	{
		font-size:<?php if(isset($content['advps_titleFsize2'])){echo $content['advps_titleFsize2'];}else{echo 16;}?>px;
		line-height:<?php if(isset($content['advps_titleLheight2'])){echo $content['advps_titleLheight2'];}else{echo 16;}?>px;
	}
	#advps_container<?php echo $sldshowID;?> .advps-slide p
	{
		font-size:<?php if(isset($content['advps_excptFsize2'])){echo $content['advps_excptFsize2'];}else{echo 12;}?>px;
		line-height:<?php if(isset($content['advps_excptLheight2'])){echo $content['advps_excptLheight2'];}else{echo 12;}?>px;
	}
}
@media screen and (max-width: 650px){
	#advps_container<?php echo $sldshowID;?> h2.advs-title, #advps_container<?php echo $sldshowID;?> h2.advs-title a
	{
		font-size:<?php if(isset($content['advps_titleFsize3'])){echo $content['advps_titleFsize3'];}else{echo 15;}?>px;
		line-height:<?php if(isset($content['advps_titleLheight3'])){echo $content['advps_titleLheight3'];}else{echo 15;}?>px;
	}
	#advps_container<?php echo $sldshowID;?> .advps-slide p
	{
		font-size:<?php if(isset($content['advps_excptFsize3'])){echo $content['advps_excptFsize3'];}else{echo 12;}?>px;
		line-height:<?php if(isset($content['advps_excptLheight3'])){echo $content['advps_excptLheight3'];}else{echo 12;}?>px;
	}
}
@media screen and (max-width: 480px){
	#advps_container<?php echo $sldshowID;?> h2.advs-title, #advps_container<?php echo $sldshowID;?> h2.advs-title a
	{
		font-size:<?php if(isset($content['advps_titleFsize4'])){echo $content['advps_titleFsize4'];}else{echo 15;}?>px;
		line-height:<?php if(isset($content['advps_titleLheight4'])){echo $content['advps_titleLheight4'];}else{echo 15;}?>px;
	}
	#advps_container<?php echo $sldshowID;?> .advps-slide p
	{
		font-size:<?php if(isset($content['advps_excptFsize4'])){echo $content['advps_excptFsize4'];}else{echo 12;}?>px;
		line-height:<?php if(isset($content['advps_excptLheight4'])){echo $content['advps_excptLheight4'];}else{echo 12;}?>px;
	}
}
@media screen and (max-width: 320px){
	#advps_container<?php echo $sldshowID;?> h2.advs-title, #advps_container<?php echo $sldshowID;?> h2.advs-title a
	{
		font-size:<?php if(isset($content['advps_titleFsize5'])){echo $content['advps_titleFsize5'];}else{echo 15;}?>px;
		line-height:<?php if(isset($content['advps_titleLheight5'])){echo $content['advps_titleLheight5'];}else{echo 15;}?>px;
	}
	#advps_container<?php echo $sldshowID;?> .advps-slide p
	{
		font-size:<?php if(isset($content['advps_excptFsize5'])){echo $content['advps_excptFsize5'];}else{echo 12;}?>px;
		line-height:<?php if(isset($content['advps_excptLheight5'])){echo $content['advps_excptLheight5'];}else{echo 12;}?>px;
	}
}
</style>
<script type="text/javascript">
		jQuery(document).ready(function($){
			$('#advpsslideshow_<?php echo $sldshowID;?>').bxSlider({
				useCSS:<?php if($slider['advps_transition']=='css3'){echo 1;}else{echo 0;}?>,
				slideMargin: <?php echo $slider['advps_sldmargin'];?>,
				speed: <?php echo $slider['advps_speed'];?>,				
				<?php if($slider['advps_slider_type'] == 'carousel' || $slider['advps_slider_type'] == 'ticker'){?>
				minSlides: <?php echo $caro_ticker['advps_caro_slds']?>,
  				maxSlides: <?php echo $caro_ticker['advps_caro_slds']?>,
  				slideWidth: <?php echo $caro_ticker['advps_caro_sldwidth']?>,
				<?php }else{if($navigation['advps_pager_type']=='thumb'){?>
				pagerCustom: '#bx-pager',
				<?php }?>
				mode: '<?php echo $slider['advps_effects'];?>',
				<?php }?>
				<?php if($slider['advps_slider_type'] != 'ticker'){?>
				auto: <?php if($slider['advps_autoplay']=='yes'){echo 1;}else{echo 0;}?>,
				autoHover: <?php if($slider['advps_ps_hover']=='yes'){echo 1;}else{echo 0;}?>,
				pause: <?php echo $slider['advps_timeout'];?>,
				easing: 'linear',
				controls: <?php if($navigation['advps_exclude_nxtprev']=='no'){echo 1;}else{echo 0;}?>,
				pager: <?php if($navigation['advps_exclude_pager']=='no'){echo 1;}else{echo 0;}?>,
  				autoControls: <?php if($navigation['advps_exclude_playpause']=='no'){echo 1;}else{echo 0;}?>
				<?php }else{?>
				ticker: true,
				tickerHover:<?php if($slider['advps_ps_hover']=='yes'){echo 1;}else{echo 0;}?>
				<?php }?>
			});
			<?php if($template == "one" || $template == "three"):?>
				$("#advpsslideshow_<?php echo $sldshowID;?> .advs-title a").hover(function(){
					$(this).css('color','<?php echo $content['advps_titleHcolor']?>');
				},function(){
					$(this).css('color','<?php echo $content['advps_titleFcolor']?>');
				});
			<?php endif;?>
			$("#advpsslideshow_<?php echo $sldshowID;?> .advps-slide").hover(function(){
				  <?php if($template == 'one'  && $content['advps_excpt_visibility']=='show on hover'):?>
				  if(!$(this).find(".advps-excerpt-one").is(":animated")){					  
					  $(this).find(".advps-excerpt-one").fadeIn(200,'linear',function(){});
				  }
				  <?php endif;?>
			},function(){
				<?php if($template == 'one' && $content['advps_excpt_visibility']=='show on hover'):?>
				$(this).find(".advps-excerpt-one").fadeOut(200,'linear',function(){});
				<?php endif;?>
			});
		});
	</script>
<div id="advps_container<?php echo $sldshowID;?>" class="advps-slide-container" style="overflow:hidden;max-width:<?php echo $container['advps_sld_width'];?>px;<?php if(isset($container['advps_centering']) && $container['advps_centering'] == 'yes'){echo 'margin:auto;';}?>">
 
  <div id="<?php echo "advpsslideshow_".$sldshowID;?>">
    <?php $count = 1;$the_query = new WP_Query($query_arg); while ($the_query->have_posts()) : $the_query->the_post();if($template == 'one'):
	?>
    <div class="advps-slide">
	<?php if( $content['advps_ed_link']=='enable'){?><a target="<?php echo $content['advps_link_target'];?>" href="<?php if($content['advps_link_type'] == 'permalink'){the_permalink();}else{echo get_post_meta($post->ID,'advps_custom_link',true);}?>" <?php if(isset($content['advps_link_rel']) && $content['advps_link_rel'] != 'none'){?>rel="<?php echo $content['advps_link_rel'];?>"<?php }?>><?php }?>
      <?php 
	  		if(has_post_thumbnail()){
				$advps_custom_thumb = $wpdb->get_results("select width,height,crop from ".$wpdb->prefix."advps_thumbnail where thumb_name = '".$container['advps_thumbnail']."'");
				if($advps_custom_thumb){
					$thmb_image = wp_get_attachment_url( get_post_thumbnail_id());
					$advps_image = aq_resize( $thmb_image, $advps_custom_thumb[0]->width, $advps_custom_thumb[0]->height,$advps_custom_thumb[0]->crop,true,true);
					echo '<img src="'.$advps_image.'" width="'.$advps_custom_thumb[0]->width.'" height="'.$advps_custom_thumb[0]->height.'" alt="'.get_the_title().'" />';
				}
				else
				{
					the_post_thumbnail($container['advps_thumbnail']);
				}
			}
			elseif(isset($container['advps_default_image']) && $container['advps_default_image'] != '')
			{
		?>
        		<img src="<?php echo $container['advps_default_image'];?>" class="wp-post-image" alt="<?php the_title();?>" />
         <?php
			}
	  ?>
      <?php if( $content['advps_ed_link']=='enable'){?></a><?php }?>
       
      <div class="advps-excerpt-<?php echo $template?>" style="width:<?php echo $content['advps_overlay_width'];?>%;height:<?php echo  $content['advps_overlay_height'];?>%;<?php if($content['advps_excpt_visibility'] == 'show on hover'){?>display:none;<?php }if($content['advps_excpt_position'] == 'left'){?>top:0; left:0;<?php }elseif($content['advps_excpt_position'] == 'right'){?>top:0; right:0;<?php }elseif($content['advps_excpt_position'] == 'bottom'){?>bottom:0; left:0;<?php }?>">
      	<div class="advps-overlay-<?php echo $template?>" style="background-color:<?php echo $content['advps_overlay_color'];?>; -moz-opacity:<?php echo $content['advps_overlay_opacity'];?>;filter:alpha(opacity=<?php echo $content['advps_overlay_opacity']*100;?>);opacity:<?php echo $content['advps_overlay_opacity'];?>;"></div>
        <div class="advps-excerpt-block-<?php echo $template?>" style="text-align:<?php echo $content['advps_text_align'];?>;color:<?php echo $content['advps_excptFcolor'];?>;-moz-opacity:<?php echo $content['advps_text_opacity'];?>;filter:alpha(opacity=<?php echo $content['advps_text_opacity']*100;?>);opacity:<?php echo $content['advps_text_opacity'];?>;">        
        <<?php echo $content['advps_ttitle_tag'];?> class="advs-title" style="margin:5px 0px 10px 0px;color:<?php echo $content['advps_titleFcolor'];?>"><?php if( $content['advps_ed_link']=='enable'){?><a target="<?php echo $content['advps_link_target'];?>" href="<?php if($content['advps_link_type'] == 'permalink'){the_permalink();}else{echo get_post_meta($post->ID,'advps_custom_link',true);}?>" style="margin:5px 0px 10px 0px;color:<?php echo $content['advps_titleFcolor'];?>" <?php if(isset($content['advps_link_rel']) && $content['advps_link_rel'] != 'none'){?>rel="<?php echo $content['advps_link_rel'];?>"<?php }?>><?php }?><?php the_title();?><?php if( $content['advps_ed_link']=='enable'){?></a><?php }?></<?php echo $content['advps_ttitle_tag'];?>>
          
            <?php if($content['advps_exclude_excpt'] == 'no'){the_excerpt();}?>
        </div>
      </div>
    </div>
    <?php elseif($template == 'two'):?>
    <div class="advps-slide">
    	<?php if( $container['advps_ed_link']=='enable'){?><a target="<?php echo $container['advps_link_target'];?>" href="<?php if($container['advps_link_type'] == 'permalink'){the_permalink();}else{echo get_post_meta($post->ID,'advps_custom_link',true);}?>" <?php if(isset($container['advps_link_rel']) && $container['advps_link_rel'] != 'none'){?>rel="<?php echo $container['advps_link_rel'];?>"<?php }?>><?php }?>
        <?php 
	  		if(has_post_thumbnail()){
				$advps_custom_thumb = $wpdb->get_results("select width,height,crop from ".$wpdb->prefix."advps_thumbnail where thumb_name = '".$container['advps_thumbnail']."'");
				if($advps_custom_thumb){
					$thmb_image = wp_get_attachment_url( get_post_thumbnail_id());
					$advps_image = aq_resize( $thmb_image, $advps_custom_thumb[0]->width, $advps_custom_thumb[0]->height,$advps_custom_thumb[0]->crop,true,true);
					echo '<img src="'.$advps_image.'" width="'.$advps_custom_thumb[0]->width.'" height="'.$advps_custom_thumb[0]->height.'" alt="'.get_the_title().'" />';
				}
				else
				{
					the_post_thumbnail($container['advps_thumbnail']);
				}
			}
			elseif(isset($container['advps_default_image']) && $container['advps_default_image'] != '')
			{
		?>
        		 <img src="<?php echo $container['advps_default_image'];?>" class="wp-post-image" alt="<?php the_title();?>" />
        <?php
			}
	  ?>
        <?php if( $container['advps_ed_link']=='enable'){?></a><?php }?>
    </div>
    <?php 
		elseif($template == 'three'):
			if(!isset($container['advps_padu1'])) $container['advps_padu1'] = 'px';
			if(!isset($container['advps_padu2'])) $container['advps_padu2'] = 'px';
			if(!isset($container['advps_padu3'])) $container['advps_padu3'] = 'px';
			if(!isset($container['advps_padu4'])) $container['advps_padu4'] = 'px';
	?>
    <div class="advps-slide">
        <div class="advps-slide-field-three" style="position:relative;float:left;padding:<?php echo $container['advps_contpad1'].$container['advps_padu1'].' '.$container['advps_contpad2'].$container['advps_padu2'].' '.$container['advps_contpad3'].$container['advps_padu3'].' '.$container['advps_contpad4'].$container['advps_padu4'];?>;">
         <?php if(in_array('thumb',$content['advps_content_set'])):if( $content['advps_ed_link']=='enable'){?><a target="<?php echo $content['advps_link_target'];?>" href="<?php if($content['advps_link_type'] == 'permalink'){the_permalink();}else{echo get_post_meta($post->ID,'advps_custom_link',true);};?>" <?php if(isset($content['advps_link_rel']) && $content['advps_link_rel'] != 'none'){?>rel="<?php echo $content['advps_link_rel'];?>"<?php }?>><?php }?>
          	<?php 
				if(has_post_thumbnail()){
					$advps_custom_thumb = $wpdb->get_results("select width,height,crop from ".$wpdb->prefix."advps_thumbnail where thumb_name = '".$container['advps_thumbnail']."'");
					if($advps_custom_thumb){
						$thmb_image = wp_get_attachment_url( get_post_thumbnail_id());
						$advps_image = aq_resize( $thmb_image, $advps_custom_thumb[0]->width, $advps_custom_thumb[0]->height,$advps_custom_thumb[0]->crop,true,true);
						echo '<img src="'.$advps_image.'" width="'.$advps_custom_thumb[0]->width.'" height="'.$advps_custom_thumb[0]->height.'" alt="'.get_the_title().'" />';
					}
					else
					{
						the_post_thumbnail($container['advps_thumbnail']);
					}
				}
				elseif(isset($container['advps_default_image']) && $container['advps_default_image'] != '')
				{
			?>
        		 <img src="<?php echo $container['advps_default_image'];?>" class="wp-post-image" alt="<?php the_title();?>" />
        	<?php
				}
			?>
         <?php if( $content['advps_ed_link']=='enable'){?></a><?php }endif;?>
          <div class="advps-excerpt-<?php echo $template?>" style="position:relative;float:left;max-width:<?php echo $content['advps_cont_width'] - ($container['advps_contpad2']+$container['advps_contpad4']);?>px;z-index:0; color:<?php echo $content['advps_excptFcolor'];?>;">
            <?php if(in_array('title',$content['advps_content_set'])){?><<?php echo $content['advps_ttitle_tag'];?> class="advs-title" style="color:<?php echo $content['advps_titleFcolor'];?>;margin:5px 0px 10px 0px;"> <?php if( $content['advps_ed_link']=='enable'){?><a target="<?php echo $content['advps_link_target'];?>" href="<?php if($content['advps_link_type'] == 'permalink'){the_permalink();}else{echo get_post_meta($post->ID,'advps_custom_link',true);}?>" style="color:<?php echo $content['advps_titleFcolor'];?>;margin:5px 0px 10px 0px;" <?php if(isset($content['advps_link_rel']) && $content['advps_link_rel'] != 'none'){?>rel="<?php echo $content['advps_link_rel'];?>"<?php }?>><?php }?>
              <?php the_title();?>
              <?php if( $content['advps_ed_link']=='enable'){?></a><?php }?></<?php echo $content['advps_ttitle_tag'];?>><?php }?>
              <?php if(in_array('content',$content['advps_content_set'])){
            			the_content();
					}
					elseif(in_array('excerpt',$content['advps_content_set'])){
						the_excerpt();
					}
				?>
          </div>
          </div>
	</div>

	<?php endif;$count++;endwhile; wp_reset_query(); ?>
  </div>
  <?php if($slider['advps_slider_type'] == 'standard' && $navigation['advps_pager_type']=='thumb' && $navigation['advps_exclude_pager']=='no'){?>
  <div id="bx-pager">
   <?php 
   		$count = 0;
		$the_query = new WP_Query($query_arg); while ($the_query->have_posts()) : $the_query->the_post();
		
   		if (has_post_thumbnail()){
	   		$thmb_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );
	?>
			<a data-slide-index="<?php echo $count;?>" href=""><img src="<?php echo $thmb_image[0];?>" style="width:<?php echo $navigation['advps_pthumb_width'];?>%; height:auto;<?php if($count+1 < $the_query->post_count){echo 'margin-right:5px;';}?>" /></a>
    <?php
		}
		elseif(isset($container['advps_default_image']) && $container['advps_default_image'] != '')
		{
			$thmb_image = $container['advps_default_image'];
	?>
    		<a data-slide-index="<?php echo $count;?>" href=""><img src="<?php echo $thmb_image;?>" style="width:<?php echo $navigation['advps_pthumb_width'];?>%; height:auto;<?php if($count+1 < $the_query->post_count){echo "margin-right:5px;";}?>" /></a>
    <?php
		}
	?>
   <?php $count++;endwhile; wp_reset_query(); ?>
   </div>
   <?php }?>
</div><!-- end advps-slide-container -->
<!-- / Advanced post slider a multipurpose responsive slideshow plugin -->
<?php   
		$advps_res = ob_get_contents();
		ob_end_clean();
		return $advps_res;
	}
	
	add_shortcode('advps-slideshow', 'advps_slideshow');