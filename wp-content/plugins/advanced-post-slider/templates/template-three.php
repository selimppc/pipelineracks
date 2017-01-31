<?php
if ( ! defined( 'ABSPATH' ) || ! current_user_can( 'manage_options' ) ) exit;
?>

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
<?php
$tcount = $wpdb->get_results("SHOW TABLE STATUS WHERE name = '".$wpdb->prefix."advps_optionset'");
foreach( $res3 as $dset){ 
	$plist = unserialize($dset->plist);
	$query = unserialize($dset->query);
	$slider = unserialize($dset->slider);
	$caro_ticker = unserialize($dset->caro_ticker);
	$container = unserialize($dset->container);
	$content = unserialize($dset->content);
	$navigation = unserialize($dset->navigation);
	
	if( !isset( $content['advps_link_rel'] )) $content['advps_link_rel'] = 'none';
	if(!isset($container['advps_padu1'])) $container['advps_padu1'] = 'px';
	if(!isset($container['advps_padu2'])) $container['advps_padu2'] = 'px';
	if(!isset($container['advps_padu3'])) $container['advps_padu3'] = 'px';
	if(!isset($container['advps_padu4'])) $container['advps_padu4'] = 'px';
?>
<div class="metabox-holder" style="margin-top:20px;">
  <div class="postbox-container" style="width:100%">
    <div class="postbox closed">
      <div class="handlediv down" title="Click to toggle"> <br>
      </div>
      <h3 style="cursor:pointer; text-align:center" class="advps-expand <?php if(isset($_POST['advps_submit']) && $_POST['advps_submit'] == 'Add new slideshow' && $_POST['nextoptid'] == intval( $dset->id )){echo 'advps-highlight';}?>" id="lbltxt<?php echo intval( $dset->id );?>">
        <?php if(get_option('optset'.intval( $dset->id ))){echo esc_html( get_option('optset'.intval( $dset->id )) );}else{echo 'Slider '.intval( $dset->id );}?>
      </h3>
      <div class="inside">
        <fieldset>
          <legend class="advps-legend" style="width:97px;"><strong>Label & Usage</strong></legend>
          <table class="form-table">
            <tr>
              <th scope="row">Label</th>
              <td><input type="text" style="width:px;" value="<?php if(get_option('optset'.intval( $dset->id ))){echo esc_attr( get_option('optset'.intval( $dset->id )) );}else{echo 'Slider '.intval( $dset->id );}?>" name="optset<?php echo intval( $dset->id );?>" class="advps-optset-label" onchange="advpsUpdateLabel(this.name,this.value,<?php echo intval( $dset->id );?>)" />
                <span id="lbludtSts<?php echo intval( $dset->id );?>" style="padding-left:10px; display:none;"><img src="<?php echo esc_url( advps_url );?>/images/ajax-loader.gif" /></span></td>
            </tr>
            <tr>
              <th scope="row">Usage</th>
              <td><input style="width:200px; font-size:12px; text-align:center;" type="text" value='[advps-slideshow optset="<?php echo intval( $dset->id );?>"]' readonly="readonly"  /></td>
            </tr>
          </table>
        </fieldset>
        <fieldset>
          <legend class="advps-legend" style="width:80px; background-position:79px 6px;"><strong>Select Post</strong></legend>
          <div id="advps-sel<?php echo intval( $dset->id );?>">
            <table class="form-table">
              <tr>
                <th scope="row">Select post using</th>
                <td><select name="advpssmethod<?php echo intval( $dset->id )?>" onchange="updateSm(this,<?php echo intval( $dset->id );?>);">
                    <option value="plist" <?php if(get_option('advpssmethod'.intval( $dset->id )) == 'plist'){echo 'selected="selected"';}?>>Post list</option>
                    <option value="query" <?php if(get_option('advpssmethod'.intval( $dset->id )) == 'query'){echo 'selected="selected"';}?>>Query</option>
                  </select>
                  <span id="smudtsts<?php echo intval( $dset->id );?>" style="padding-left:10px; display:none;"><img src="<?php echo esc_url( advps_url );?>/images/ajax-loader.gif" /></span></td>
              </tr>
            </table>
            <form method="post" onsubmit="return false" id="plist<?php echo intval( $dset->id );?>">
              <table class="form-table <?php if(get_option('advpssmethod'.intval( $dset->id )) == 'query'){echo 'advps-hide';}?>">
                <tr>
                  <th scope="row">Listing option</th>
                  <td><select title="Post type" name="advps_post_stypes">
                      <option value="post" <?php if($plist['advps_post_stypes'] == 'post'){echo 'selected="selected"';}?>>post</option>
                      <option value="page" <?php if($plist['advps_post_stypes'] == 'page'){echo 'selected="selected"';}?>>page</option>
                      <?php
                              foreach ($customPostTypes  as $post_type ) {
                          ?>
                      <option value="<?php echo $post_type;?>" <?php if($plist['advps_post_stypes'] == $post_type){echo 'selected="selected"';}?>><?php echo $post_type;?></option>
                      <?php		
                              }
                          ?>
                    </select>
                    <span style="padding-left:10px;">
                    <input type="text" name="advps_plistmax" value="<?php echo esc_attr( $plist['advps_plistmax'] );?>" style="width:40px;" onkeypress="return onlyNum(event);" title="Max number of post to list" />
                    </span> <span style="padding-left:10px;">
                    <select name="advps_plistorder_by" title="Order by">
                      <option value="date" <?php if($plist['advps_plistorder_by'] == 'date'){echo 'selected="selected"';}?>>Date</option>
                      <option value="ID" <?php if($plist['advps_plistorder_by'] == 'ID'){echo 'selected="selected"';}?>>ID</option>
                      <option value="author" <?php if($plist['advps_plistorder_by'] == 'author'){echo 'selected="selected"';}?>>Author</option>
                      <option value="title" <?php if($plist['advps_plistorder_by'] == 'title'){echo 'selected="selected"';}?>>Title</option>
                      <option value="name" <?php if($plist['advps_plistorder_by'] == 'name'){echo 'selected="selected"';}?>>Name</option>
                      <option value="rand" <?php if($plist['advps_plistorder_by'] == 'rand'){echo 'selected="selected"';}?>>Random</option>
                      <option value="menu_order" <?php if($plist['advps_plistorder_by'] == 'menu_order'){echo 'selected="selected"';}?>>Menu order</option>
                      <option value="comment_count" <?php if($plist['advps_plistorder_by'] == 'comment_count'){echo 'selected="selected"';}?>>Comment count</option>
                    </select>
                    </span> <span style="padding-left:10px;">
                    <select name="advps_plistorder" title="Order">
                      <option value="ASC" <?php if($plist['advps_plistorder'] == 'ASC'){echo 'selected="selected"';}?>>Ascending</option>
                      <option value="DESC" <?php if($plist['advps_plistorder'] == 'DESC'){echo 'selected="selected"';}?>>Descending</option>
                    </select>
                    </span> <span style="padding-left:10px;">
                    <button class="button-secondary" value="" onclick="listPost(<?php echo intval( $dset->id );?>)">List</button>
                    </span> <span class="ajx-loaderp" style="padding-left:12px; display:none;"><img src="<?php echo esc_url( advps_url );?>/images/ajax-loader.gif" /></span></td>
                </tr>
                <tr>
                  <th scope="row">Select post from list</th>
                  <td><select name="advps_plist[]" multiple="multiple" style="min-height:250px; min-width:300px;" id="advps-plist-field<?php echo intval( $dset->id );?>">
                      <?php 
						$lpargs = array(
								'post_type'      => ($plist['advps_post_stypes']) ? esc_html( $plist['advps_post_stypes'] ) : 'post',
								'posts_per_page' => ($plist['advps_plistmax']) ? esc_html( $plist['advps_plistmax'] ) : 99,
								'orderby'		 => ($plist['advps_plistorder_by']) ? esc_html( $plist['advps_plistorder_by'] ) : 'date',
								'order'			 => ($plist['advps_plistorder']) ? esc_html( $plist['advps_plistorder'] ) : 'DESC'
						);
					 	$pl_query = new WP_Query($lpargs); while ($pl_query->have_posts()) : $pl_query->the_post();?>
                      <option value="<?php the_id();?>" <?php if(isset($plist['advps_plist']) && in_array(get_the_id(),$plist['advps_plist'])){echo 'selected="selected"';}?>>
                      <?php the_title();?>
                      </option>
                      <?php endwhile;wp_reset_query();?>
                    </select>
                    <span style="padding-left:10px; font-size:10px; font-style:italic; vertical-align:top;">[ * You can select multiple ]</span></td>
                </tr>
                <tr>
                  <th scope="row">&nbsp;</th>
                  <td><input type="submit" name="advps_submit" value="Save changes" class="button-primary" onclick="updateOptionSet('plist<?php echo intval( $dset->id );?>')" />
                    <span class="ajx-loader" style="padding-left:15px; display:none;"><img src="<?php echo esc_url( advps_url );?>/images/ajax-loader.gif" /></span><span class="ajx-sts"></span></td>
                </tr>
              </table>
              <input type="hidden" name="opt_field" value="plist" />
              <input type="hidden" value="<?php echo intval( $dset->id );?>" name="opt_id" />
            </form>
            <form method="post" onsubmit="return false" id="query<?php echo intval( $dset->id );?>">
              <table class="form-table <?php if(!get_option('advpssmethod'.intval( $dset->id )) || get_option('advpssmethod'.intval( $dset->id )) == 'plist'){echo 'advps-hide';}?>">
                <tr>
                  <th scope="row">Post Type</th>
                  <td><select name="advps_post_types" onchange="advpsCheckCat(this.value,<?php echo intval( $dset->id );?>)">
                      <option value="post" <?php if($query['advps_post_types'] == 'post'){echo 'selected="selected"';}?>>post</option>
                      <option value="page" <?php if($query['advps_post_types'] == 'page'){echo 'selected="selected"';}?>>page</option>
                      <?php
                              foreach ($customPostTypes  as $post_type ) {
                          ?>
                      <option value="<?php echo esc_attr( $post_type );?>" <?php if($query['advps_post_types'] == $post_type){echo 'selected="selected"';}?>><?php echo $post_type;?></option>
                      <?php		
                              }
                          ?>
                    </select></td>
                </tr>
                <tr id="advps-cat-field<?php echo intval( $dset->id );?>">
                  <?php  
					$posttypeobj = get_post_type_object( esc_html( $query['advps_post_types']) );
					if($query['advps_post_types'] != "page" && ($query['advps_post_types'] == 'post' || in_array('category',$posttypeobj->taxonomies))){
				?>
                  <th scope="row">Category</th>
                  <td><select name="advps_category[]" multiple="multiple">
                      <?php 
					  	$catList = get_categories();
						foreach($catList as $scat){
					  ?>
                      <option value="<?php echo $scat->term_id;?>" <?php if(isset($query['advps_category']) && in_array($scat->term_id,$query['advps_category'])){echo 'selected="selected"';}?>><?php echo esc_html( $scat->name );?></option>
                      <?php }?>
                    </select>
                    <span style="padding-left:10px; font-size:10px; font-style:italic; vertical-align:top">[ * You can select multiple category ]</span></td>
                  <?php }?>
                </tr>
                <tr>
                  <th scope="row">Max. Number of post</th>
                  <td><input type="text" name="advps_maxpost" value="<?php echo esc_attr( $query['advps_maxpost'] );?>" style="width:60px;" onkeypress="return onlyNum(event);" /></td>
                </tr>
                <tr>
                  <th scope="row">Offset (optional)</th>
                  <td><input type="text" name="advps_offset" value="<?php echo esc_attr( $query['advps_offset'] );?>" style="width:60px;" onkeypress="return onlyNum(event);" /></td>
                </tr>
                <tr>
                  <th scope="row">Exclude (optional)</th>
                  <td><input type="text" name="advps_exclude" value="<?php echo esc_attr( $query['advps_exclude'] );?>" style="width:100px;" />
                    <span style="padding-left:10px; font-size:10px; font-style:italic;">[ Ex. 1,5,10 Comma separated post IDs that need to exclude from slideshow ]</span></td>
                </tr>
                <tr>
                  <th scope="row">Order by</th>
                  <td><select name="advps_order_by">
                      <option value="date" <?php if($query['advps_order_by'] == 'date'){echo 'selected="selected"';}?>>Date</option>
                      <option value="ID" <?php if($query['advps_order_by'] == 'ID'){echo 'selected="selected"';}?>>ID</option>
                      <option value="author" <?php if($query['advps_order_by'] == 'author'){echo 'selected="selected"';}?>>Author</option>
                      <option value="title" <?php if($query['advps_order_by'] == 'title'){echo 'selected="selected"';}?>>Title</option>
                      <option value="name" <?php if($query['advps_order_by'] == 'name'){echo 'selected="selected"';}?>>Name</option>
                      <option value="rand" <?php if($query['advps_order_by'] == 'rand'){echo 'selected="selected"';}?>>Random</option>
                      <option value="menu_order" <?php if($query['advps_order_by'] == 'menu_order'){echo 'selected="selected"';}?>>Menu order</option>
                      <option value="comment_count" <?php if($query['advps_order_by'] == 'comment_count'){echo 'selected="selected"';}?>>Comment count</option>
                    </select></td>
                </tr>
                <tr>
                  <th scope="row">Order</th>
                  <td><select name="advps_order">
                      <option value="ASC" <?php if($query['advps_order'] == 'ASC'){echo 'selected="selected"';}?>>Ascending</option>
                      <option value="DESC" <?php if($query['advps_order'] == 'DESC'){echo 'selected="selected"';}?>>Descending</option>
                    </select></td>
                </tr>
                <tr>
                  <th scope="row">&nbsp;</th>
                  <td><input type="submit" name="advps_submit" value="Save changes" class="button-primary" onclick="updateOptionSet('query<?php echo intval( $dset->id );?>')" />
                    <span class="ajx-loader" style="padding-left:15px; display:none;"><img src="<?php echo esc_url( advps_url );?>/images/ajax-loader.gif" /></span><span class="ajx-sts"></span></td>
                </tr>
              </table>
              <input type="hidden" name="opt_field" value="query" />
              <input type="hidden" value="<?php echo intval( $dset->id );?>" name="opt_id" />
            </form>
          </div>
        </fieldset>
        <fieldset>
          <legend class="advps-legend" style="width:50px; background-position:49px 6px;"><strong>Slider</strong></legend>
          <form method="post" id="slider<?php echo intval( $dset->id );?>" onsubmit="return false">
            <table class="form-table">
              <tr>
                <th scope="row">Slider Type</th>
                <td><select name="advps_slider_type" onchange="sliderType(this.value,<?php echo intval( $dset->id );?>);">
                    <option value="standard" <?php if($slider['advps_slider_type'] == 'standard'){echo 'selected="selected"';}?>>Standard</option>
                    <option value="carousel" <?php if($slider['advps_slider_type'] == 'carousel'){echo 'selected="selected"';}?>>Carousel</option>
                    <option value="ticker" <?php if($slider['advps_slider_type'] == 'ticker'){echo 'selected="selected"';}?>>Ticker</option>
                  </select></td>
              </tr>
              <tr>
                <th scope="row">Transitions type </th>
                <td><select name="advps_transition">
                    <option value="css3" <?php if($slider['advps_transition'] == 'css3'){echo 'selected="selected"';}?>>CSS3</option>
                    <option value="jquery" <?php if($slider['advps_transition'] == 'jquery'){echo 'selected="selected"';}?>>jQuery animation</option>
                  </select>
                  <span style="padding-left:10px; font-size:10px; font-style:italic;">[ N.B. CSS3 transitions is recommended ]</span></td>
              </tr>
              <tr>
                <th scope="row">Effect</th>
                <td><select name="advps_effects">
                    <option value="horizontal" <?php if($slider['advps_effects'] == 'horizontal'){echo 'selected="selected"';}?>>Horizontal</option>
                    <option value="vertical" <?php if($slider['advps_effects'] == 'vertical'){echo 'selected="selected"';}?>>Vertical</option>
                    <option value="fade" <?php if($slider['advps_effects'] == 'fade'){echo 'selected="selected"';}?>>Fade</option>
                  </select></td>
              </tr>
              <tr>
                <th scope="row">Speed</th>
                <td><input type="text" name="advps_speed" value="<?php echo esc_attr( $slider['advps_speed'] );?>" style="width:60px;" onkeypress="return onlyNum(event);" /></td>
              </tr>
              <tr>
                <th scope="row">Auto play</th>
                <td><select name="advps_autoplay">
                    <option value="yes" <?php if($slider['advps_autoplay'] == 'yes'){echo 'selected="selected"';}?>>Yes</option>
                    <option value="no" <?php if($slider['advps_autoplay'] == 'no'){echo 'selected="selected"';}?>>No</option>
                  </select></td>
              </tr>
              <tr>
                <th scope="row">Pause</th>
                <td><input type="text" name="advps_timeout" value="<?php echo esc_attr( $slider['advps_timeout'] );?>" style="width:60px;" onkeypress="return onlyNum(event);" /></td>
              </tr>
              <tr>
                <th scope="row">Slide margin</th>
                <td><input type="text" name="advps_sldmargin" value="<?php echo esc_attr( $slider['advps_sldmargin'] );?>" style="width:60px;" onkeypress="return onlyNum(event);" /></td>
              </tr>
              <tr>
                <th scope="row">Enable pause on hover</th>
                <td><select name="advps_ps_hover">
                    <option value="yes" <?php if($slider['advps_ps_hover'] == 'yes'){echo 'selected="selected"';}?>>Yes</option>
                    <option value="no" <?php if($slider['advps_ps_hover'] == 'no'){echo 'selected="selected"';}?>>No</option>
                  </select></td>
              </tr>
              <tr>
                <th scope="row">&nbsp;</th>
                <td><input type="submit" name="advps_submit" value="Save changes" class="button-primary" onclick="updateOptionSet('slider<?php echo intval( $dset->id );?>')" />
                  <span class="ajx-loader" style="padding-left:15px; display:none;"><img src="<?php echo esc_url( advps_url );?>/images/ajax-loader.gif" /></span><span class="ajx-sts"></span></td>
              </tr>
            </table>
            <input type="hidden" name="opt_field" value="slider" />
            <input type="hidden" value="<?php echo intval( $dset->id );?>" name="opt_id" />
          </form>
        </fieldset>
        <fieldset>
          <legend class="advps-legend" style="width:121px; background-position:120px 6px;"><strong>Carousel & Ticker</strong></legend>
          <form method="post" onsubmit="return false" id="caro_ticker<?php echo intval( $dset->id );?>">
            <table class="form-table">
              <tr>
                <th scope="row">Number of slide</th>
                <td><input type="text" name="advps_caro_slds" value="<?php if(isset($caro_ticker['advps_caro_slds'])){echo esc_attr( $caro_ticker['advps_caro_slds'] );}?>" style="width:60px;" onkeypress="return onlyNum(event);" />
                  <span style="padding-left:20px; font-size:10px; font-style:italic;">[ N.B. For slider type Carousel or Ticker. ]</span></td>
              </tr>
              <tr>
                <th scope="row">Slide width</th>
                <td><input type="text" name="advps_caro_sldwidth" value="<?php if(isset($caro_ticker['advps_caro_sldwidth'])){echo esc_attr( $caro_ticker['advps_caro_sldwidth'] );}?>" style="width:60px;" onkeypress="return onlyNum(event);" />
                  <span style="padding-left:20px; font-size:10px; font-style:italic;">[ N.B. For slider type Carousel or Ticker. ]</span></td>
              </tr>
              <tr>
                <th scope="row">&nbsp;</th>
                <td><input type="submit" name="advps_submit" value="Save changes" class="button-primary" onclick="updateOptionSet('caro_ticker<?php echo intval( $dset->id );?>')" />
                  <span class="ajx-loader" style="padding-left:15px; display:none;"><img src="<?php echo esc_url( advps_url );?>/images/ajax-loader.gif" /></span><span class="ajx-sts"></span></td>
              </tr>
            </table>
            <input type="hidden" name="opt_field" value="caro_ticker" />
            <input type="hidden" value="<?php echo intval( $dset->id );?>" name="opt_id" />
          </form>
        </fieldset>
        <fieldset>
          <legend class="advps-legend" style="width:155px; background-position:154px 6px;"><strong>Container & Thumbnail</strong></legend>
          <form method="post" onsubmit="return false" id="container<?php echo intval( $dset->id );?>">
            <table class="form-table">
              <tr>
                <th scope="row">Select Thumbnail</th>
                <td><select name="advps_thumbnail">
                    <option value="thumbnail" <?php if($container['advps_thumbnail'] == 'thumbnail'){echo 'selected="selected"';}?>>thumbnail</option>
                    <option value="medium" <?php if($container['advps_thumbnail'] == 'medium'){echo 'selected="selected"';}?>>medium</option>
                    <option value="large" <?php if($container['advps_thumbnail'] == 'large'){echo 'selected="selected"';}?>>large</option>
                    <option value="full" <?php if($container['advps_thumbnail'] == 'full'){echo 'selected="selected"';}?>>full</option>
                    <?php 
                        global $_wp_additional_image_sizes;
                        unset($_wp_additional_image_sizes['post-thumbnail']);
                        foreach($_wp_additional_image_sizes as $tkey => $tval){
                        ?>
                    <option value="<?php echo esc_attr( $tkey );?>" <?php if($container['advps_thumbnail'] == $tkey){echo 'selected="selected"';}?>><?php echo esc_html( $tkey );?></option>
                    <?php
                        }
                        ?>
                  </select></td>
              </tr>
              <tr>
                <th scope="row">Default image url</th>
                <td><input type="text" name="advps_default_image" value="<?php if(isset($container['advps_default_image'])){ echo $container['advps_default_image'];}?>" style="width:250px;" />
                  <span style="padding-left:10px; font-size:10px; font-style:italic;"> [ N.B. If any post doesn't have featured image then default image will be shown.]</span></td>
              </tr>
              <tr>
                <th scope="row">Slide Container Width</th>
                <td><input type="text" name="advps_sld_width" value="<?php echo esc_attr( $container['advps_sld_width'] );?>" style="width:45px;" onkeypress="return onlyNum(event);" />
                  &nbsp;px </td>
              </tr>
              <tr>
                <th scope="row">Center whole slideshow</th>
                <td><select name="advps_centering">
                	<option value="no" <?php if(isset($container['advps_centering']) && $container['advps_centering'] == 'no'){echo 'selected="selected"';}?>>No</option>
                    <option value="yes" <?php if(isset($container['advps_centering']) && $container['advps_centering'] == 'yes'){echo 'selected="selected"';}?>>Yes</option>
                  </select></td>
              </tr>
              <tr>
                <th scope="row">Padding</th>
                <td><input type="text" name="advps_contpad1" value="<?php echo esc_attr( $container['advps_contpad1'] );?>" style="width:40px; height:25px;" />
                  <select name="advps_padu1" style="vertical-align:top; width:46px; height:25px;">
                    <option value="vw" <?php if(isset($container['advps_padu1']) && $container['advps_padu1'] == 'vw'){echo 'selected="selected"';}?>>vw</option>
                    <option value="vh" <?php if(isset($container['advps_padu1']) && $container['advps_padu1'] == 'vh'){echo 'selected="selected"';}?>>vh</option>
                    <option value="%" <?php if(isset($container['advps_padu1']) && $container['advps_padu1'] == '%'){echo 'selected="selected"';}?>>%</option>
                    <option value="em" <?php if(isset($container['advps_padu1']) && $container['advps_padu1'] == 'em'){echo 'selected="selected"';}?>>em</option>
                    <option value="px" <?php if(isset($container['advps_padu1']) && $container['advps_padu1'] == 'px'){echo 'selected="selected"';}?>>px</option>
                    <option value="pt" <?php if(isset($container['advps_padu1']) && $container['advps_padu1'] == 'pt'){echo 'selected="selected"';}?>>pt</option>
                  </select>
                  <input type="text" name="advps_contpad2" value="<?php echo esc_attr( $container['advps_contpad2'] );?>" style="width:40px; height:25px;" />
                  <select name="advps_padu2" style="vertical-align:top;width:46px; height:25px;">
                    <option value="vw" <?php if(isset($container['advps_padu2']) && $container['advps_padu2'] == 'vw'){echo 'selected="selected"';}?>>vw</option>
                    <option value="vh" <?php if(isset($container['advps_padu2']) && $container['advps_padu2'] == 'vh'){echo 'selected="selected"';}?>>vh</option>
                    <option value="%" <?php if(isset($container['advps_padu2']) && $container['advps_padu2'] == '%'){echo 'selected="selected"';}?>>%</option>
                    <option value="em" <?php if(isset($container['advps_padu2']) && $container['advps_padu2'] == 'em'){echo 'selected="selected"';}?>>em</option>
                    <option value="px" <?php if(isset($container['advps_padu2']) && $container['advps_padu2'] == 'px'){echo 'selected="selected"';}?>>px</option>
                    <option value="pt" <?php if(isset($container['advps_padu2']) && $container['advps_padu2'] == 'pt'){echo 'selected="selected"';}?>>pt</option>
                  </select>
                  <input type="text" name="advps_contpad3" value="<?php echo esc_attr( $container['advps_contpad3'] );?>" style="width:40px; height:25px;" />
                  <select name="advps_padu3" style="vertical-align:top;width:46px; height:25px;">
                    <option value="vw" <?php if(isset($container['advps_padu3']) && $container['advps_padu3'] == 'vw'){echo 'selected="selected"';}?>>vw</option>
                    <option value="vh" <?php if(isset($container['advps_padu3']) && $container['advps_padu3'] == 'vh'){echo 'selected="selected"';}?>>vh</option>
                    <option value="%" <?php if(isset($container['advps_padu3']) && $container['advps_padu3'] == '%'){echo 'selected="selected"';}?>>%</option>
                    <option value="em" <?php if(isset($container['advps_padu3']) && $container['advps_padu3'] == 'em'){echo 'selected="selected"';}?>>em</option>
                    <option value="px" <?php if(isset($container['advps_padu3']) && $container['advps_padu3'] == 'px'){echo 'selected="selected"';}?>>px</option>
                    <option value="pt" <?php if(isset($container['advps_padu3']) && $container['advps_padu3'] == 'pt'){echo 'selected="selected"';}?>>pt</option>
                  </select>
                  <input type="text" name="advps_contpad4" value="<?php echo esc_attr( $container['advps_contpad4'] );?>" style="width:40px; height:25px;" />
                  <select name="advps_padu4" style="vertical-align:top;width:46px; height:25px;">
                    <option value="vw" <?php if(isset($container['advps_padu4']) && $container['advps_padu4'] == 'vw'){echo 'selected="selected"';}?>>vw</option>
                    <option value="vh" <?php if(isset($container['advps_padu4']) && $container['advps_padu4'] == 'vh'){echo 'selected="selected"';}?>>vh</option>
                    <option value="%" <?php if(isset($container['advps_padu4']) && $container['advps_padu4'] == '%'){echo 'selected="selected"';}?>>%</option>
                    <option value="em" <?php if(isset($container['advps_padu4']) && $container['advps_padu4'] == 'em'){echo 'selected="selected"';}?>>em</option>
                    <option value="px" <?php if(isset($container['advps_padu4']) && $container['advps_padu4'] == 'px'){echo 'selected="selected"';}?>>px</option>
                    <option value="pt" <?php if(isset($container['advps_padu4']) && $container['advps_padu4'] == 'pt'){echo 'selected="selected"';}?>>pt</option>
                  </select></td>
              </tr>
              <tr>
                <th scope="row">Background Color</th>
                <td><input id="advpscolor<?php echo ++$flg?>" class="advps-color-picker" type="text" name="advps_bgcolor" value="<?php echo esc_attr( $container['advps_bgcolor'] );?>" style="width:100px;" />
                  <div class="advpsfarb" style="padding-left:22%"></div></td>
              </tr>
              <tr>
                <th scope="row">Border</th>
                <td><span style="vertical-align:top">
                  <input type="text" name="advps_border_size" value="<?php echo esc_attr( $container['advps_border_size'] );?>" style="width:40px;" onkeypress="return onlyNum(event);" />
                  px &nbsp;&nbsp;
                  <select name="advps_border_type">
                    <option value="dashed" <?php if($container['advps_border_type'] == 'dashed'){echo 'selected="selected"';}?>>dashed</option>
                    <option value="dotted" <?php if($container['advps_border_type'] == 'dotted'){echo 'selected="selected"';}?>>dotted</option>
                    <option value="double" <?php if($container['advps_border_type'] == 'double'){echo 'selected="selected"';}?>>double</option>
                    <option value="solid" <?php if($container['advps_border_type'] == 'solid'){echo 'selected="selected"';}?>>solid</option>
                    <option value="inset" <?php if($container['advps_border_type'] == 'inset'){echo 'selected="selected"';}?>>inset</option>
                    <option value="outset" <?php if($container['advps_border_type'] == 'outset'){echo 'selected="selected"';}?>>outset</option>
                  </select>
                  &nbsp;&nbsp;</span>
                  <input class="advps-color-picker" type="text" name="advps_border_color" id="advpscolor<?php echo ++$flg?>" value="<?php echo esc_attr( $container['advps_border_color'] );?>" style="width:100px;" />
                  <div class="advpsfarb" style="padding-left:22%"></div></td>
              </tr>
              <tr>
                <th scope="row">Remove Border</th>
                <td><select name="advps_remove_border">
                    <option value="yes" <?php if($container['advps_remove_border'] == 'yes'){echo 'selected="selected"';}?>>Yes</option>
                    <option value="no" <?php if($container['advps_remove_border'] == 'no'){echo 'selected="selected"';}?>>No</option>
                  </select></td>
              </tr>
              <tr>
                <th scope="row">Box Shadow</th>
                <td><span style="vertical-align:top">
                  <input type="text" name="advps_bxshad1" value="<?php echo esc_attr( $container['advps_bxshad1'] );?>" style="width:40px;" onkeypress="return onlyNum(event);" />
                  px &nbsp;&nbsp;
                  <input type="text" name="advps_bxshad2" value="<?php echo esc_attr( $container['advps_bxshad2'] );?>" style="width:40px;" onkeypress="return onlyNum(event);" />
                  px&nbsp;&nbsp;
                  <input type="text" name="advps_bxshad3" value="<?php echo esc_attr( $container['advps_bxshad3'] );?>" style="width:40px;" onkeypress="return onlyNum(event);" />
                  px&nbsp;&nbsp;</span>
                  <input class="advps-color-picker" type="text" name="advps_bxshadcolor" value="<?php echo esc_attr( $container['advps_bxshadcolor'] );?>" style="width:100px;" id="advpscolor<?php echo ++$flg?>" />
                  <div class="advpsfarb" style="padding-left:22%"></div></td>
              </tr>
              <tr>
                <th scope="row">Remove Shadow</th>
                <td><select name="advps_remove_shd">
                    <option value="yes" <?php if($container['advps_remove_shd'] == 'yes'){echo 'selected="selected"';}?>>Yes</option>
                    <option value="no" <?php if($container['advps_remove_shd'] == 'no'){echo 'selected="selected"';}?>>No</option>
                  </select></td>
              </tr>
              <tr>
                <th scope="row">&nbsp;</th>
                <td><input type="submit" name="advps_submit" value="Save changes" class="button-primary" onclick="updateOptionSet('container<?php echo intval( $dset->id );?>')" />
                  <span class="ajx-loader" style="padding-left:15px; display:none;"><img src="<?php echo esc_url( advps_url );?>/images/ajax-loader.gif" /></span><span class="ajx-sts"></span></td>
              </tr>
            </table>
            <input type="hidden" name="opt_field" value="container" />
            <input type="hidden" value="<?php echo intval( $dset->id );?>" name="opt_id" />
          </form>
        </fieldset>
        <fieldset>
          <legend class="advps-legend" style="width:66px; background-position:65px 6px;"><strong>Content</strong></legend>
          <form method="post" onsubmit="return false" id="content<?php echo intval( $dset->id );?>">
            <table class="form-table">
              <tr>
                <th scope="row">Show on slide</th>
                <td><select name="advps_content_set[]" multiple="multiple">
                    <option value="thumb" <?php if(in_array('thumb',$content['advps_content_set'])){echo 'selected="selected"';}?>>Thumbnail</option>
                    <option value="title" <?php if(in_array('title',$content['advps_content_set'])){echo 'selected="selected"';}?>>Title</option>
                    <option value="excerpt" <?php if(in_array('excerpt',$content['advps_content_set'])){echo 'selected="selected"';}?>>Excerpt</option>
                    <option value="content" <?php if(in_array('content',$content['advps_content_set'])){echo 'selected="selected"';}?>>Content</option>
                  </select>
                  <span style="padding-left:10px; font-size:10px; font-style:italic; vertical-align:top">[ * You can select multiple ]</span></td>
              </tr>
              <tr>
                <th scope="row">Content width</th>
                <td><input type="text" name="advps_cont_width" value="<?php echo esc_attr( $content['advps_cont_width'] );?>" style="width:60px;" onkeypress="return onlyNum(event);" />
                  px</td>
              </tr>
              <tr>
                <th scope="row">Title tag</th>
                <td><select name="advps_ttitle_tag">
                    <option value="h1" <?php if($content['advps_ttitle_tag'] == 'h1'){echo 'selected="selected"';}?>>h1</option>
                    <option value="h2" <?php if($content['advps_ttitle_tag'] == 'h2'){echo 'selected="selected"';}?>>h2</option>
                    <option value="h3" <?php if($content['advps_ttitle_tag'] == 'h3'){echo 'selected="selected"';}?>>h3</option>
                    <option value="div" <?php if($content['advps_ttitle_tag'] == 'div'){echo 'selected="selected"';}?>>div</option>
                  </select></td>
              </tr>
              <tr>
                <th scope="row">Title font Color</th>
                <td><input id="advpscolor<?php echo ++$flg?>" type="text" name="advps_titleFcolor" value="<?php echo esc_attr( $content['advps_titleFcolor'] );?>" style="width:100px;" class="advps-color-picker" />
                  <div class="advpsfarb" style="padding-left:22%"></div></td>
              </tr>
              <tr>
                <th scope="row">Title hover Color</th>
                <td><input id="advpscolor<?php echo ++$flg?>" type="text" name="advps_titleHcolor" value="<?php echo esc_attr( $content['advps_titleHcolor'] );?>" style="width:100px;" class="advps-color-picker" />
                  <div class="advpsfarb" style="padding-left:22%"></div></td>
              </tr>
              <tr>
                <th scope="row">Title font size</th>
                <td><input type="text" name="advps_titleFsizeL" value="<?php if(isset($content['advps_titleFsizeL'])){ echo esc_attr( $content['advps_titleFsizeL'] );}else{echo 20;}?>" style="width:40px;" onkeypress="return onlyNum(event);" title="For desktop, laptop and larger width device." />
                  &nbsp;px&nbsp;&nbsp;
                  <input type="text" name="advps_titleFsize1" value="<?php if(isset($content['advps_titleFsize1'])){ echo esc_attr( $content['advps_titleFsize1'] );}else{echo 18;}?>" style="width:40px;" onkeypress="return onlyNum(event);" title="For media screen smaller than 1024" />
                  &nbsp;px&nbsp;&nbsp;
                  <input type="text" name="advps_titleFsize2" value="<?php if(isset($content['advps_titleFsize2'])){echo esc_attr( $content['advps_titleFsize2'] );}else{echo 16;}?>" style="width:40px;" onkeypress="return onlyNum(event);" title="For media screen smaller than 768" />
                  &nbsp;px&nbsp;&nbsp;
                  <input type="text" name="advps_titleFsize3" value="<?php if(isset($content['advps_titleFsize3'])){echo esc_attr( $content['advps_titleFsize3'] );}else{echo 15;}?>" style="width:40px;" onkeypress="return onlyNum(event);" title="For media screen smaller than 650" />
                  &nbsp;px&nbsp;&nbsp;
                  <input type="text" name="advps_titleFsize4" value="<?php if(isset($content['advps_titleFsize4'])){echo esc_attr( $content['advps_titleFsize4'] );}else{echo 15;}?>" style="width:40px;" onkeypress="return onlyNum(event);" title="For media screen smaller than 480" />
                  &nbsp;px&nbsp;&nbsp;
                  <input type="text" name="advps_titleFsize5" value="<?php if(isset($content['advps_titleFsize5'])){echo esc_attr( $content['advps_titleFsize5'] );}else{echo 15;}?>" style="width:40px;" onkeypress="return onlyNum(event);" title="For media screen smaller than 320" />
                  &nbsp;px&nbsp;&nbsp; <span style="padding-left:10px; font-size:10px; font-style:italic;">[ N.B. Different sizes for different media screen width. Hover the field to know which field is for which width. ]</span></td>
              </tr>
              <tr>
                <th scope="row">Title line height</th>
                <td><input type="text" name="advps_titleLheightL" value="<?php if(isset($content['advps_titleLheightL'])){ echo esc_attr( $content['advps_titleLheightL'] );}else{echo 20;}?>" style="width:40px;" onkeypress="return onlyNum(event);" title="For desktop, laptop and larger width device." />
                  &nbsp;px&nbsp;&nbsp;
                  <input type="text" name="advps_titleLheight1" value="<?php if(isset($content['advps_titleLheight1'])){ echo esc_attr( $content['advps_titleLheight1'] );}else{echo 18;}?>" style="width:40px;" onkeypress="return onlyNum(event);" title="For media screen smaller than 1024" />
                  &nbsp;px&nbsp;&nbsp;
                  <input type="text" name="advps_titleLheight2" value="<?php if(isset($content['advps_titleLheight2'])){echo esc_attr( $content['advps_titleLheight2'] );}else{echo 16;}?>" style="width:40px;" onkeypress="return onlyNum(event);" title="For media screen smaller than 768" />
                  &nbsp;px&nbsp;&nbsp;
                  <input type="text" name="advps_titleLheight3" value="<?php if(isset($content['advps_titleLheight3'])){echo esc_attr( $content['advps_titleLheight3'] );}else{echo 15;}?>" style="width:40px;" onkeypress="return onlyNum(event);" title="For media screen smaller than 650" />
                  &nbsp;px&nbsp;&nbsp;
                  <input type="text" name="advps_titleLheight4" value="<?php if(isset($content['advps_titleLheight4'])){echo esc_attr( $content['advps_titleLheight4'] );}else{echo 15;}?>" style="width:40px;" onkeypress="return onlyNum(event);" title="For media screen smaller than 480" />
                  &nbsp;px&nbsp;&nbsp;
                  <input type="text" name="advps_titleLheight5" value="<?php if(isset($content['advps_titleLheight5'])){echo esc_attr( $content['advps_titleLheight5'] );}else{echo 15;}?>" style="width:40px;" onkeypress="return onlyNum(event);" title="For media screen smaller than 320" />
                  &nbsp;px&nbsp;&nbsp; <span style="padding-left:10px; font-size:10px; font-style:italic;">[ N.B. Each for different media screen width. Hover the field to know which field is for which width. ]</span></td>
              </tr>
              <tr>
                <th scope="row">Excerpt/Content font color</th>
                <td><input id="advpscolor<?php echo ++$flg?>" class="advps-color-picker" type="text" name="advps_excptFcolor" value="<?php echo esc_attr( $content['advps_excptFcolor'] );?>" style="width:100px;" />
                  <div class="advpsfarb" style="padding-left:22%"></div></td>
              </tr>
              <tr>
                <th scope="row">Excerpt/Content font size</th>
                <td><input type="text" name="advps_excptFsizeL" value="<?php if(isset($content['advps_excptFsizeL'])){ echo esc_attr( $content['advps_excptFsizeL'] );}else{echo 14;}?>" style="width:40px;" onkeypress="return onlyNum(event);" title="For desktop, laptop and larger width device." />
                  &nbsp;px&nbsp;&nbsp;
                  <input type="text" name="advps_excptFsize1" value="<?php if(isset($content['advps_excptFsize1'])){ echo esc_attr( $content['advps_excptFsize1'] );}else{echo 12;}?>" style="width:40px;" onkeypress="return onlyNum(event);" title="For media screen smaller than 1024" />
                  &nbsp;px&nbsp;&nbsp;
                  <input type="text" name="advps_excptFsize2" value="<?php if(isset($content['advps_excptFsize2'])){echo esc_attr( $content['advps_excptFsize2'] );}else{echo 12;}?>" style="width:40px;" onkeypress="return onlyNum(event);" title="For media screen smaller than 768" />
                  &nbsp;px&nbsp;&nbsp;
                  <input type="text" name="advps_excptFsize3" value="<?php if(isset($content['advps_excptFsize3'])){echo esc_attr( $content['advps_excptFsize3'] );}else{echo 12;}?>" style="width:40px;" onkeypress="return onlyNum(event);" title="For media screen smaller than 650" />
                  &nbsp;px&nbsp;&nbsp;
                  <input type="text" name="advps_excptFsize4" value="<?php if(isset($content['advps_excptFsize4'])){echo esc_attr( $content['advps_excptFsize4'] );}else{echo 12;}?>" style="width:40px;" onkeypress="return onlyNum(event);" title="For media screen smaller than 480" />
                  &nbsp;px&nbsp;&nbsp;
                  <input type="text" name="advps_excptFsize5" value="<?php if(isset($content['advps_excptFsize5'])){echo esc_attr( $content['advps_excptFsize5'] );}else{echo 12;}?>" style="width:40px;" onkeypress="return onlyNum(event);" title="For media screen smaller than 320" />
                  &nbsp;px&nbsp;&nbsp; </td>
              </tr>
              <tr>
                <th scope="row">Excerpt line height</th>
                <td><input type="text" name="advps_excptLheightL" value="<?php if(isset($content['advps_excptLheightL'])){ echo esc_attr( $content['advps_excptLheightL'] );}else{echo 14;}?>" style="width:40px;" onkeypress="return onlyNum(event);" title="For desktop, laptop and larger width device." />
                  &nbsp;px&nbsp;&nbsp;
                  <input type="text" name="advps_excptLheight1" value="<?php if(isset($content['advps_excptLheight1'])){ echo esc_attr( $content['advps_excptLheight1'] );}else{echo 12;}?>" style="width:40px;" onkeypress="return onlyNum(event);" title="For media screen smaller than 1024" />
                  &nbsp;px&nbsp;&nbsp;
                  <input type="text" name="advps_excptLheight2" value="<?php if(isset($content['advps_excptLheight2'])){echo esc_attr( $content['advps_excptLheight2'] );}else{echo 12;}?>" style="width:40px;" onkeypress="return onlyNum(event);" title="For media screen smaller than 768" />
                  &nbsp;px&nbsp;&nbsp;
                  <input type="text" name="advps_excptLheight3" value="<?php if(isset($content['advps_excptLheight3'])){echo esc_attr( $content['advps_excptLheight3'] );}else{echo 12;}?>" style="width:40px;" onkeypress="return onlyNum(event);" title="For media screen smaller than 650" />
                  &nbsp;px&nbsp;&nbsp;
                  <input type="text" name="advps_excptLheight4" value="<?php if(isset($content['advps_excptLheight4'])){echo esc_attr( $content['advps_excptLheight4'] );}else{echo 12;}?>" style="width:40px;" onkeypress="return onlyNum(event);" title="For media screen smaller than 480" />
                  &nbsp;px&nbsp;&nbsp;
                  <input type="text" name="advps_excptLheight5" value="<?php if(isset($content['advps_excptLheight5'])){echo esc_attr( $content['advps_excptLheight5'] );}else{echo 12;}?>" style="width:40px;" onkeypress="return onlyNum(event);" title="For media screen smaller than 320" />
                  &nbsp;px&nbsp;&nbsp; </td>
              </tr>
              <tr>
                <th scope="row">Excerpt length</th>
                <td><input type="text" name="advps_excerptlen" value="<?php echo esc_attr( $content['advps_excerptlen'] );?>" style="width:60px;" onkeypress="return onlyNum(event);" />
                  &nbsp;words</td>
              </tr>
              <tr>
                <th scope="row">Enable/Disable link</th>
                <td><select name="advps_ed_link">
                    <option value="enable" <?php if($content['advps_ed_link'] == 'enable'){echo 'selected="selected"';}?>>Enable</option>
                    <option value="disable" <?php if($content['advps_ed_link'] == 'disable'){echo 'selected="selected"';}?>>Disable</option>
                  </select></td>
              </tr>
              <tr>
                <th scope="row">link type</th>
                <td><select name="advps_link_type">
                    <option value="permalink" <?php if($content['advps_link_type'] == 'permalink'){echo 'selected="selected"';}?>>Permalink</option>
                    <option value="custom" <?php if($content['advps_link_type'] == 'custom'){echo 'selected="selected"';}?>>Custom</option>
                  </select>
                  <span style="padding-left:10px; font-size:10px; font-style:italic;">[ N.B. For custom link create a custom field with name 'advps_custom_link' ]</span></td>
              </tr>
              <tr>
                <th scope="row">Link rel</th>
                <td><select name="advps_link_rel">
                    <option value="none" <?php if($content['advps_link_rel'] == 'none'){echo 'selected="selected"';}?>>None</option>
                    <option value="alternate" <?php if($content['advps_link_rel'] == 'alternate'){echo 'selected="selected"';}?>>Alternate</option>
                    <option value="archives" <?php if($content['advps_link_rel'] == 'archives'){echo 'selected="selected"';}?>>Archives</option>
                    <option value="author" <?php if($content['advps_link_rel'] == 'author'){echo 'selected="selected"';}?>>Author</option>
                    <option value="bookmark" <?php if($content['advps_link_rel'] == 'bookmark'){echo 'selected="selected"';}?>>Bookmark</option>
                    <option value="external" <?php if($content['advps_link_rel'] == 'external'){echo 'selected="selected"';}?>>External</option>
                    <option value="first" <?php if($content['advps_link_rel'] == 'first'){echo 'selected="selected"';}?>>First</option>
                    <option value="help" <?php if($content['advps_link_rel'] == 'help'){echo 'selected="selected"';}?>>Help</option>
                    <option value="icon" <?php if($content['advps_link_rel'] == 'icon'){echo 'selected="selected"';}?>>Icon</option>
                    <option value="index" <?php if($content['advps_link_rel'] == 'index'){echo 'selected="selected"';}?>>Index</option>
                    <option value="last" <?php if($content['advps_link_rel'] == 'last'){echo 'selected="selected"';}?>>Last</option>
                    <option value="license" <?php if($content['advps_link_rel'] == 'license'){echo 'selected="selected"';}?>>License</option>
                    <option value="next" <?php if($content['advps_link_rel'] == 'next'){echo 'selected="selected"';}?>>Next</option>
                    <option value="nofollow" <?php if($content['advps_link_rel'] == 'nofollow'){echo 'selected="selected"';}?>>Nofollow</option>
                    <option value="noreferrer" <?php if($content['advps_link_rel'] == 'noreferrer'){echo 'selected="selected"';}?>>Noreferrer</option>
                    <option value="pingback" <?php if($content['advps_link_rel'] == 'pingback'){echo 'selected="selected"';}?>>Pingback</option>
                    <option value="prefetch" <?php if($content['advps_link_rel'] == 'prefetch'){echo 'selected="selected"';}?>>Prefetch</option>
                    <option value="prev" <?php if($content['advps_link_rel'] == 'prev'){echo 'selected="selected"';}?>>Prev</option>
                  </select></td>
              </tr>
              <tr>
                <th scope="row">link target</th>
                <td><select name="advps_link_target">
                    <option value="_self" <?php if($content['advps_link_target'] == '_self'){echo 'selected="selected"';}?>>_self</option>
                    <option value="_blank" <?php if($content['advps_link_target'] == '_blank'){echo 'selected="selected"';}?>>_blank</option>
                    <option value="_new" <?php if($content['advps_link_target'] == '_new'){echo 'selected="selected"';}?>>_new</option>
                    <option value="_top" <?php if($content['advps_link_target'] == '_top'){echo 'selected="selected"';}?>>_top</option>
                    <option value="_parent" <?php if($content['advps_link_target'] == '_parent'){echo 'selected="selected"';}?>>_parent</option>
                  </select></td>
              </tr>
              <tr>
                <th scope="row">&nbsp;</th>
                <td><input type="submit" name="advps_submit" value="Save changes" class="button-primary" onclick="updateOptionSet('content<?php echo intval( $dset->id );?>')" />
                  <span class="ajx-loader" style="padding-left:15px; display:none;"><img src="<?php echo esc_url( advps_url );?>/images/ajax-loader.gif" /></span><span class="ajx-sts"></span></td>
              </tr>
            </table>
            <input type="hidden" name="opt_field" value="content" />
            <input type="hidden" value="<?php echo intval( $dset->id );?>" name="opt_id" />
          </form>
        </fieldset>
        <fieldset>
          <legend class="advps-legend" style="width:79px; background-position:78px 6px;"><strong>Navigation</strong></legend>
          <form method="post" onsubmit="return false" id="navigation<?php echo intval( $dset->id );?>">
            <table class="form-table">
              <tr>
                <th scope="row">Exclude pager</th>
                <td><select name="advps_exclude_pager">
                    <option value="yes" <?php if($navigation['advps_exclude_pager'] == 'yes'){echo 'selected="selected"';}?>>Yes</option>
                    <option value="no" <?php if($navigation['advps_exclude_pager'] == 'no'){echo 'selected="selected"';}?>>No</option>
                  </select></td>
              </tr>
              <tr>
                <th scope="row">Pager type</th>
                <td><span style="padding-right:5px;">Number</span>
                  <input type="radio" name="advps_pager_type" value="number" <?php if(isset($navigation['advps_pager_type']) && $navigation['advps_pager_type'] == 'number'){echo 'checked="checked"';}?>>
                  <span style="padding:0px 5px 0px 10px;">Bullet</span>
                  <input type="radio" name="advps_pager_type" value="bullet" <?php if(isset($navigation['advps_pager_type']) && $navigation['advps_pager_type'] == 'bullet'){echo 'checked="checked"';}?>>
                  <span id="advps-pthumb-lvl<?php echo intval( $dset->id );?>" style="padding:0px 5px 0px 10px;" class="<?php if($slider['advps_slider_type'] != 'standard'){echo 'advps-fade';}?>">Thumbnail</span>
                  <input id="advps-pthumb<?php echo intval( $dset->id );?>" <?php if($slider['advps_slider_type'] != 'standard'){echo 'disabled="disabled"';}?> type="radio" name="advps_pager_type" value="thumb" <?php if(isset($navigation['advps_pager_type']) && $navigation['advps_pager_type'] == 'thumb'){echo 'checked="checked"';}?>></td>
              </tr>
              <tr>
                <th scope="row">Thumbnail Width</th>
                <td><input type="text" name="advps_pthumb_width" value="<?php echo esc_attr( $navigation['advps_pthumb_width'] );?>" style="width:50px;" onkeypress="return onlyNum(event);" />
                  &nbsp;% <span style="padding-left:10px; font-size:10px; font-style:italic;">[ N.B. For pager type thumbnail. ]</span></td>
              </tr>
              <tr>
                <th scope="row">Pager align</th>
                <td><select name="advps_pager_align">
                    <option value="center" <?php if($navigation['advps_pager_align'] == 'center'){echo 'selected="selected"';}?>>Center</option>
                    <option value="left" <?php if($navigation['advps_pager_align'] == 'left'){echo 'selected="selected"';}?>>Left</option>
                    <option value="right" <?php if($navigation['advps_pager_align'] == 'right'){echo 'selected="selected"';}?>>Right</option>
                  </select></td>
              </tr>
              <tr>
                <th scope="row">Pager position from bottom</th>
                <td><input type="text" name="advps_pager_bottom" value="<?php echo esc_attr( $navigation['advps_pager_bottom'] );?>" style="width:50px;" onkeypress="return NumNdNeg(event);" />
                  &nbsp;px</td>
              </tr>
              <tr>
                <th scope="row">Exclude Play/Pause</th>
                <td><select name="advps_exclude_playpause">
                    <option value="yes" <?php if($navigation['advps_exclude_playpause'] == 'yes'){echo 'selected="selected"';}?>>Yes</option>
                    <option value="no" <?php if($navigation['advps_exclude_playpause'] == 'no'){echo 'selected="selected"';}?>>No</option>
                  </select>
                  <span style="padding-left:10px; font-size:10px; font-style:italic;">[ N.B. Play/Pause works when Slider Type is standard or carousel and auto play is enabled. ]</span></td>
              </tr>
              <tr>
                <th scope="row">Play/Pause align</th>
                <td><select name="advps_ppause_align">
                    <option value="center" <?php if($navigation['advps_ppause_align'] == 'center'){echo 'selected="selected"';}?>>Center</option>
                    <option value="left" <?php if($navigation['advps_ppause_align'] == 'left'){echo 'selected="selected"';}?>>Left</option>
                    <option value="right" <?php if($navigation['advps_ppause_align'] == 'right'){echo 'selected="selected"';}?>>Right</option>
                  </select></td>
              </tr>
              <tr>
                <th scope="row">Play/Pause position from bottom</th>
                <td><input type="text" name="advps_ppause_bottom" value="<?php echo $navigation['advps_ppause_bottom'];?>" style="width:50px;" onkeypress="return NumNdNeg(event);" />
                  &nbsp;px</td>
              </tr>
              <tr>
                <th scope="row">Exclude Next/Previous</th>
                <td><select name="advps_exclude_nxtprev">
                    <option value="yes" <?php if($navigation['advps_exclude_nxtprev'] == 'yes'){echo 'selected="selected"';}?>>Yes</option>
                    <option value="no" <?php if($navigation['advps_exclude_nxtprev'] == 'no'){echo 'selected="selected"';}?>>No</option>
                  </select></td>
              </tr>
              <tr>
                <th scope="row">&nbsp;</th>
                <td><input type="submit" name="advps_submit" value="Save changes" class="button-primary" onclick="updateOptionSet('navigation<?php echo intval( $dset->id );?>')" />
                  <span class="ajx-loader" style="padding-left:15px; display:none;"><img src="<?php echo esc_url( advps_url );?>/images/ajax-loader.gif" /></span><span class="ajx-sts"></span></td>
              </tr>
            </table>
            <input type="hidden" name="opt_field" value="navigation" />
            <input type="hidden" value="<?php echo intval( $dset->id );?>" name="opt_id" />
          </form>
        </fieldset>
        <form method="post" id="frmOptDel<?php echo intval( $dset->id );?>" onsubmit="return false">
          <input type="hidden" value="<?php echo intval( $dset->id );?>" name="optset-id" />
          <input type="hidden" value="<?php echo intval( $tcount[0]->Auto_increment );?>" name="nextoptid" />
          <p>
            <input type="submit" name="del-optset" value="Delete" class="button-secondary" onclick="deleteOptSet(<?php echo intval( $dset->id );?>)" style="width:12%;" />
            <span style="margin-left:5px;">
            <input type="submit" name="dup-optset" value="Duplicate" class="button-secondary" onclick="duplicateOptSet(<?php echo intval( $dset->id );?>)" style="width:12%;" />
            </span> </p>
          <?php wp_nonce_field('advps-checkauthnonce','advps_wpnonce'); ?>
        </form>
      </div>
    </div>
  </div>
</div>
<?php 
}
$tcount = $wpdb->get_results("SHOW TABLE STATUS WHERE name = '".$wpdb->prefix."advps_optionset'");
?>
<div style="position:relative; float:left; width:72%">
  <form method="post">
    <input type="hidden" name="nextoptid" value="<?php echo intval( $tcount[0]->Auto_increment );?>" />
    <input type="hidden" name="template" value="three" />
    <?php wp_nonce_field('advps-checkauthnonce','advps_wpnonce'); ?>
    <input type="submit" name="advps_submit" value="Add new slideshow" class="button-primary" style="font-weight:bold" />
  </form>
</div>
