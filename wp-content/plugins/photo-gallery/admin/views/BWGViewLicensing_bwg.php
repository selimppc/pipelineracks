<?php

class BWGViewLicensing_bwg {
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
    ?>
    <div id="featurs_tables">
      <div id="featurs_table1">
        <span>WordPress 3.4+ ready</span>
        <span>SEO-friendly</span>
        <span>Responsive Design and Layout</span>
        <span>5 Standard Gallery/Album Views</span>
        <span>Watermarking/ Advertising Possibility</span>
        <span>Basic Tag Cloud Widget</span>
        <span>Image Download</span>
        <span>Photo Gallery Slideshow Widget</span>
        <span>Photo Gallery Widget</span>
        <span>Slideshow/Lightbox Effects</span>
        <span>Possibility of Editing/Creating New Themes</span>
        <span>9 Pro Gallery/Album Views</span>
        <span>Image Commenting</span>
        <span>Image Social Sharing</span>
        <span>Photo Gallery Tags Cloud Widget</span>
        <span>Instagram Integration</span>
      </div>
      <div id="featurs_table2">
        <span style="padding-top: 18px;height: 39px;">Free</span>
        <span class="yes"></span>
        <span class="yes"></span>
        <span class="yes"></span>
        <span class="yes"></span>
        <span class="yes"></span>
        <span class="yes"></span>
        <span class="yes"></span>
        <span class="yes"></span>
        <span class="yes"></span>
        <span>1</span>
        <span class="no"></span>
        <span class="no"></span>
        <span class="no"></span>
        <span class="no"></span>
        <span class="no"></span>
        <span class="no"></span>
      </div>
      <div id="featurs_table3">
        <span>Pro Version</span>
        <span class="yes"></span>
        <span class="yes"></span>
        <span class="yes"></span>
        <span class="yes"></span>
        <span class="yes"></span>
        <span class="yes"></span>
        <span class="yes"></span>
        <span class="yes"></span>
        <span class="yes"></span>
        <span>15</span>
        <span class="yes"></span>
        <span class="yes"></span>
        <span class="yes"></span>
        <span class="yes"></span>
        <span class="yes"></span>
        <span class="yes"></span>
      </div>
    </div>
    <div style="float: right; text-align: right;">
        <a style="text-decoration: none;" target="_blank" href="http://web-dorado.com/products/wordpress-photo-gallery-plugin.html">
          <img width="215" border="0" alt="web-dorado.com" src="<?php echo WD_BWG_URL . '/images/logo.png'; ?>" />
        </a>
      </div>
    <div style="float: left; clear: both;">
      <p>After purchasing the commercial version follow these steps:</p>
      <ol>
        <li>Deactivate Photo Gallery plugin.</li>
        <li>Delete Photo Gallery plugin.</li>
        <li>Install the downloaded commercial version of the plugin.</li>
      </ol>
    </div>
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