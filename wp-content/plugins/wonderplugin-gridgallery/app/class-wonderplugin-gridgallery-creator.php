<?php

class WonderPlugin_Gridgallery_Creator {

	private $parent_view, $list_table;
	
	function __construct($parent) {
		
		$this->parent_view = $parent;
	}
	
	function render( $id, $config, $thumbnailsize ) {
		
		?>
		
		<h3><?php _e( 'General Options', 'wonderplugin_gridgallery' ); ?></h3>
		
		<div id="wonderplugin-gridgallery-id" style="display:none;"><?php echo $id; ?></div>
		
		<?php 
		$config = str_replace('\\\"', '"', $config);
		$config = str_replace("\\\'", "'", $config);
		$config = str_replace("<", "&lt;", $config);
		$config = str_replace(">", "&gt;", $config);
		?>
		
		<div id="wonderplugin-gridgallery-id-config" style="display:none;"><?php echo $config; ?></div>
		<div id="wonderplugin-gridgallery-jsfolder" style="display:none;"><?php echo WONDERPLUGIN_GRIDGALLERY_URL . 'engine/'; ?></div>
		<div id="wonderplugin-gridgallery-wp-history-media-uploader" style="display:none;"><?php echo ( function_exists("wp_enqueue_media") ? "0" : "1"); ?></div>
		<div id="wonderplugin-gridgallery-thumbnailsize" style="display:none;"><?php echo $thumbnailsize; ?></div>
		
		<div style="margin:0 12px;">
		<table class="wonderplugin-form-table">
			<tr>
				<th><?php _e( 'Name', 'wonderplugin_gridgallery' ); ?></th>
				<td><input name="wonderplugin-gridgallery-name" type="text" id="wonderplugin-gridgallery-name" value="My Grid Gallery" class="regular-text" /></td>
			</tr>
		</table>
		</div>
		
		<h3><?php _e( 'Designing', 'wonderplugin_gridgallery' ); ?></h3>
		
		<div style="margin:0 12px;">
		<ul class="wonderplugin-tab-buttons" id="wonderplugin-gridgallery-toolbar">
			<li class="wonderplugin-tab-button step1 wonderplugin-tab-buttons-selected"><?php _e( 'Images & Videos', 'wonderplugin_gridgallery' ); ?></li>
			<li class="wonderplugin-tab-button step2"><?php _e( 'Layout', 'wonderplugin_gridgallery' ); ?></li>
			<li class="wonderplugin-tab-button step3"><?php _e( 'Skins', 'wonderplugin_gridgallery' ); ?></li>
			<li class="wonderplugin-tab-button step4"><?php _e( 'Options', 'wonderplugin_gridgallery' ); ?></li>
			<li class="wonderplugin-tab-button step5"><?php _e( 'Preview', 'wonderplugin_gridgallery' ); ?></li>
			<li class="laststep"><input class="button button-primary" type="button" value="<?php _e( 'Save & Publish', 'wonderplugin_gridgallery' ); ?>"></input></li>
		</ul>
				
		<ul class="wonderplugin-tabs" id="wonderplugin-gridgallery-tabs">
			<li class="wonderplugin-tab wonderplugin-tab-selected">	
			
				<div class="wonderplugin-toolbar">	
					<input type="button" class="button" id="wonderplugin-add-image" value="<?php _e( 'Add Image', 'wonderplugin_gridgallery' ); ?>" />
					<input type="button" class="button" id="wonderplugin-add-video" value="<?php _e( 'Add Video', 'wonderplugin_gridgallery' ); ?>" />
					<input type="button" class="button" id="wonderplugin-add-youtube" value="<?php _e( 'Add YouTube', 'wonderplugin_gridgallery' ); ?>" />
					<input type="button" class="button" id="wonderplugin-add-vimeo" value="<?php _e( 'Add Vimeo', 'wonderplugin_gridgallery' ); ?>" />
				</div>
        		
        		<ul class="wonderplugin-table" id="wonderplugin-gridgallery-media-table">
			    </ul>
			    <div style="clear:both;"></div>
      
			</li>
			<li class="wonderplugin-tab">
				<form>
					<fieldset>
						
						<?php 
						$skins = array(
								"tiles" => "Tiles",
								"focus" => "Focus",
								"feature" => "Feature",
								"collage" => "Collage",
								"threecolumns" => "3 Columns",
								"showcase" => "Showcase",
								"highlight" => "Highlight",
								"wall" => "Wall",
								"header" => "Header",
								"fivecolumns" => "5 Columns"
								);
						
						foreach ($skins as $key => $value) {
						?>
							<div class="wonderplugin-tab-skin">
							<label><input checked="checked" type="radio" name="wonderplugin-gridgallery-skin" value="<?php echo $key; ?>"> <?php echo $value; ?> <br /><img class="selected" style="max-width:300px;" src="<?php echo WONDERPLUGIN_GRIDGALLERY_URL; ?>images/<?php echo $key; ?>.png" /></label>
							</div>
						<?php
						}
						?>
						
					</fieldset>
				</form>
			</li>
			<li class="wonderplugin-tab">
				<form>
					<fieldset>
						
						<?php 
						$styles = array(
								"classic" => "Classic",
								"caption" => "Caption",
								"bluetext" => "Blue Text",
								"roundcorner" => "Round Corner",
								"circular" => "Circular Image",
								"circularwithtext" => "Circular Image with Text",
								"border" => "Border"
								);
						
						foreach ($styles as $key => $value) {
						?>
							<div class="wonderplugin-tab-style">
							<label><input checked="checked" type="radio" name="wonderplugin-gridgallery-style" value="<?php echo $key; ?>"> <?php echo $value; ?> <br /><img class="selected" style="max-width:300px;" src="<?php echo WONDERPLUGIN_GRIDGALLERY_URL; ?>images/style_<?php echo $key; ?>.jpg" /></label>
							</div>
						<?php
						}
						?>
						
					</fieldset>
				</form>
			</li>
			<li class="wonderplugin-tab">
			
				<div class="wonderplugin-gridgallery-options">
					<div class="wonderplugin-gridgallery-options-menu" id="wonderplugin-gridgallery-options-menu">
						<div class="wonderplugin-gridgallery-options-menu-item wonderplugin-gridgallery-options-menu-item-selected"><?php _e( 'Options', 'wonderplugin_gridgallery' ); ?></div>
						<div class="wonderplugin-gridgallery-options-menu-item"><?php _e( 'Skin CSS', 'wonderplugin_gridgallery' ); ?></div>
						<div class="wonderplugin-gridgallery-options-menu-item"><?php _e( 'Grid template', 'wonderplugin_gridgallery' ); ?></div>
						<div class="wonderplugin-gridgallery-options-menu-item"><?php _e( 'Lightbox options', 'wonderplugin_gridgallery' ); ?></div>
						<div class="wonderplugin-gridgallery-options-menu-item"><?php _e( 'Advanced options', 'wonderplugin_gridgallery' ); ?></div>
					</div>
					
					<div class="wonderplugin-gridgallery-options-tabs" id="wonderplugin-gridgallery-options-tabs">
					
						<div class="wonderplugin-gridgallery-options-tab wonderplugin-gridgallery-options-tab-selected">
							<table class="wonderplugin-form-table-noborder">
							
								<tr>
									<th>Width / Height of One Grid Cell</th>
									<td><label><input name="wonderplugin-gridgallery-width" type="text" id="wonderplugin-gridgallery-width" value="300" class="small-text" /> / <input name="wonderplugin-gridgallery-height" type="text" id="wonderplugin-gridgallery-height" value="300" class="small-text" /></label>
									</td>
								</tr>
								
								<tr>
									<th>Random</th>
									<td><label><input name='wonderplugin-gridgallery-random' type='checkbox' id='wonderplugin-gridgallery-random'  /> Random</label>
									</td>
								</tr>
								
								<tr>
									<th>Title</th>
									<td><label><input name='wonderplugin-gridgallery-showtitle' type='checkbox' id='wonderplugin-gridgallery-showtitle'  /> Show title&nbsp;&nbsp;</label>
									<label>
										<select name='wonderplugin-gridgallery-titlemode' id='wonderplugin-gridgallery-titlemode'>
											<option value="always">Always Show</option>
											<option value="mouseover">Show On Mouseover</option>
										</select>
									</label>
									<label>&nbsp;&nbsp;Animation effect:
										<select name='wonderplugin-gridgallery-titleeffect' id='wonderplugin-gridgallery-titleeffect'>
											<option value=fade>Fade</option>
											<option value="slide">Slide</option>
										</select>
									</label>
									<label>&nbsp;&nbsp;Effect duration (ms):<input name="wonderplugin-gridgallery-titleeffectduration" type="text" id="wonderplugin-gridgallery-titleeffectduration" value="300" class="small-text" />
									</td>
								</tr>
								
								<tr>
									<th>Google Analytics Tracking ID:</th>
									<td><label><input name="wonderplugin-gridgallery-googleanalyticsaccount" type="text" id="wonderplugin-gridgallery-googleanalyticsaccount" value="" class="medium-text" /></label></td>
								</tr>
								
								<tr>
									<th>Grid gap:</th>
									<td><label><input name="wonderplugin-gridgallery-gap" type="text" id="wonderplugin-gridgallery-gap" value="24" class="small-text" /></label></td>
								</tr>
								
								<tr>
									<th>Grid margin:</th>
									<td><label><input name="wonderplugin-gridgallery-margin" type="text" id="wonderplugin-gridgallery-margin" value="0" class="small-text" /></label></td>
								</tr>
								
								<tr>
									<th>Image border radius:</th>
									<td><label><input name="wonderplugin-gridgallery-borderradius" type="text" id="wonderplugin-gridgallery-borderradius" value="16" class="small-text" /></label></td>
								</tr>
							
								<tr>
									<th>Hover effect</th>
									<td><label><input name='wonderplugin-gridgallery-hoverzoomin' type='checkbox' id='wonderplugin-gridgallery-hoverzoomin'  /> Zoom in (px):</label>
									<label><input name="wonderplugin-gridgallery-hoverzoominvalue" type="text" id="wonderplugin-gridgallery-hoverzoominvalue" value="24" class="small-text" /> Animation duration: <input name="wonderplugin-gridgallery-hoverzoominduration" type="text" id="wonderplugin-gridgallery-hoverzoominduration" value="300" class="small-text" /></label>
									</td>
								</tr>
								
								<tr>
									<th>Circular image</th>
									<td><label><input name='wonderplugin-gridgallery-circularimage' type='checkbox' id='wonderplugin-gridgallery-circularimage'  /> Circular image</label>
									</td>
								</tr>

								<tr>
									<th>Lightbox gallery</th>
									<td><label><input name='wonderplugin-gridgallery-firstimage' type='checkbox' id='wonderplugin-gridgallery-firstimage'  /> Only display first image in grid gallery and create a Lightbox gallery</label>
									</td>
								</tr>
								
								<tr>
									<th>Play video button</th>
									<td>
										<div>
											<div style="float:left;margin-right:12px;">
											<label>
											<img id="wonderplugin-gridgallery-displayvideoplaybutton" style="background-color:#aaa;"/>
											</label>
											</div>
											<div style="float:left;">
											<label>Select play video button</label>
											<label>
												<select name='wonderplugin-gridgallery-videoplaybutton' id='wonderplugin-gridgallery-videoplaybutton'>
												<?php 
													$videoplaybutton_list = array("playvideo-64-64-0.png", "playvideo-64-64-1.png", "playvideo-64-64-2.png");
													foreach ($videoplaybutton_list as $videoplaybutton)
														echo '<option value="' . $videoplaybutton . '">' . $videoplaybutton . '</option>';
												?>
												</select>
											</label>
											</div>
											<div style="clear:both;"></div>
										</div>
										<script language="JavaScript">
										jQuery(document).ready(function(){
											jQuery("#wonderplugin-gridgallery-videoplaybutton").change(function(){
												jQuery("#wonderplugin-gridgallery-displayvideoplaybutton").attr("src", "<?php echo WONDERPLUGIN_GRIDGALLERY_URL . 'engine/skins/default/'; ?>" + jQuery(this).val());
											});
										});
										</script>
									</td>
								</tr>
							</table>
						</div>
						
						<div class="wonderplugin-gridgallery-options-tab">
							<table class="wonderplugin-form-table-noborder">
								<tr>
									<th>Skin CSS</th>
									<td><textarea name='wonderplugin-gridgallery-skincss' id='wonderplugin-gridgallery-skincss' value='' class='large-text' rows="20"></textarea></td>
								</tr>
							</table>
						</div>
						
						<div class="wonderplugin-gridgallery-options-tab">
							<table class="wonderplugin-form-table-noborder">
							
								<tr>
									<th>Grid template</th>
									<td><label>Column: <input name="wonderplugin-gridgallery-column" type="text" id="wonderplugin-gridgallery-column" value="3" class="small-text" /></label></td>
								</tr>
								<tr>
									<th></th>
									<td><textarea name='wonderplugin-gridgallery-gridtemplate' id='wonderplugin-gridgallery-gridtemplate' value='' class='large-text' rows="8"></textarea></td>
								</tr>
								
								<tr>
									<th>Responsive</th>
									<td><label><input name='wonderplugin-gridgallery-responsive' type='checkbox' id='wonderplugin-gridgallery-responsive'  /> Responsive</label>
									</td>
								</tr>
								
								<tr>
									<th>Medium screen</th>
									<td><label><input name='wonderplugin-gridgallery-mediumscreen' type='checkbox' id='wonderplugin-gridgallery-mediumscreen'  /> Apply the following options when screen is smaller than (px): </label><input name="wonderplugin-gridgallery-mediumscreensize" type="text" id="wonderplugin-gridgallery-mediumscreensize" value="800" class="small-text" /></td>
								</tr>
								
								<tr>
									<th></th>
									<td><label>Column: <input name="wonderplugin-gridgallery-mediumcolumn" type="text" id="wonderplugin-gridgallery-mediumcolumn" value="1" class="small-text" /></label></td>
								</tr>
								
								<tr>
									<th>Small screen</th>
									<td><label><input name='wonderplugin-gridgallery-smallscreen' type='checkbox' id='wonderplugin-gridgallery-smallscreen'  /> Apply the following options when screen is smaller than (px): </label><input name="wonderplugin-gridgallery-smallscreensize" type="text" id="wonderplugin-gridgallery-smallscreensize" value="600" class="small-text" /></td>
								</tr>
								
								<tr>
									<th></th>
									<td><label>Column: <input name="wonderplugin-gridgallery-smallcolumn" type="text" id="wonderplugin-gridgallery-smallcolumn" value="1" class="small-text" /></label></td>
								</tr>
								
							</table>
						</div>
						
						<div class="wonderplugin-gridgallery-options-tab">
							<table class="wonderplugin-form-table-noborder">
								<tr valign="top">
									<th scope="row">Responsive</th>
									<td><label><input name="wonderplugin-gridgallery-lightboxresponsive" type="checkbox" id="wonderplugin-gridgallery-lightboxresponsive" /> Responsive</label></td>
								</tr>
								
								<tr>
									<th>Thumbnails</th>
									<td><label><input name='wonderplugin-gridgallery-shownavigation' type='checkbox' id='wonderplugin-gridgallery-shownavigation'  /> Show thumbnails</label>
									</td>
								</tr>
								<tr>
									<th></th>
									<td><label>Size: <input name="wonderplugin-gridgallery-thumbwidth" type="text" id="wonderplugin-gridgallery-thumbwidth" value="96" class="small-text" /> x <input name="wonderplugin-gridgallery-thumbheight" type="text" id="wonderplugin-gridgallery-thumbheight" value="72" class="small-text" /></label> 
									<label>Top margin: <input name="wonderplugin-gridgallery-thumbtopmargin" type="text" id="wonderplugin-gridgallery-thumbtopmargin" value="12" class="small-text" /> Bottom margin: <input name="wonderplugin-gridgallery-thumbbottommargin" type="text" id="wonderplugin-gridgallery-thumbbottommargin" value="12" class="small-text" /></label>
									</td>
								</tr>
								<tr>
									<th>Maximum text bar height</th>
									<td><label><input name="wonderplugin-gridgallery-barheight" type="text" id="wonderplugin-gridgallery-barheight" value="48" class="small-text" /></label>
									</td>
								</tr>
								
								<tr valign="top">
									<th scope="row">Title</th>
									<td><label><input name="wonderplugin-gridgallery-lightboxshowtitle" type="checkbox" id="wonderplugin-gridgallery-lightboxshowtitle" /> Show title</label></td>
								</tr>
								
								<tr>
									<th>Title CSS</th>
									<td><label><textarea name="wonderplugin-gridgallery-titlebottomcss" id="wonderplugin-gridgallery-titlebottomcss" rows="2" class="large-text code"></textarea></label>
									</td>
								</tr>
								
								<tr valign="top">
									<th scope="row">Description</th>
									<td><label><input name="wonderplugin-gridgallery-lightboxshowdescription" type="checkbox" id="wonderplugin-gridgallery-lightboxshowdescription" /> Show description</label></td>
								</tr>
								
								<tr>
									<th>Description CSS</th>
									<td><label><textarea name="wonderplugin-gridgallery-descriptionbottomcss" id="wonderplugin-gridgallery-descriptionbottomcss" rows="2" class="large-text code"></textarea></label>
									</td>
								</tr>
								
							</table>
						</div>
						
						<div class="wonderplugin-gridgallery-options-tab">
							<table class="wonderplugin-form-table-noborder">
								<tr>
									<th>Custom CSS</th>
									<td><textarea name='wonderplugin-gridgallery-custom-css' id='wonderplugin-gridgallery-custom-css' value='' class='large-text' rows="10"></textarea></td>
								</tr>
								<tr>
									<th>Advanced Options</th>
									<td><textarea name='wonderplugin-gridgallery-data-options' id='wonderplugin-gridgallery-data-options' value='' class='large-text' rows="10"></textarea></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<div style="clear:both;"></div>
				
			</li>
			<li class="wonderplugin-tab">
				<div id="wonderplugin-gridgallery-preview-tab">
					<div id="wonderplugin-gridgallery-preview-container">
					</div>
				</div>
			</li>
			<li class="wonderplugin-tab">
				<div id="wonderplugin-gridgallery-publish-loading"></div>
				<div id="wonderplugin-gridgallery-publish-information"></div>
			</li>
		</ul>
		</div>
		
		<?php
	}
	
	function get_list_data() {
		return array();
	}
}