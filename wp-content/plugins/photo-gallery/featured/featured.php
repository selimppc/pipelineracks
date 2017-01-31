<?php
function spider_featured($current_plugin = '') {
  $plugins = array(
    "form-maker" => array(
      'title'    => 'Form Maker',
      'text'     => 'Wordpress form builder plugin',
      'content'  => 'Form Maker is a modern and advanced tool for creating WordPress forms easily and fast.',
      'href'     => 'http://web-dorado.com/products/wordpress-form.html'
    ),
    "photo-gallery" => array(
      'title'    => 'Photo Gallery',
      'text'     => 'WordPress Photo Gallery plugin',
      'content'  => 'Photo Gallery is a fully responsive WordPress Gallery plugin with advanced functionality. It allows having different image galleries for your posts and pages, as well as different widgets.',
      'href'     => 'http://web-dorado.com/products/wordpress-photo-gallery-plugin.html'
    ),
    "contact-form-builder" => array(
      'title'    => 'Contact Form Builder',
      'text'     => 'WordPress contact form builder plugin',
      'content'  => 'WordPress Contact Form Builder is an intuitive tool for creating contact forms.',
      'href'     => 'http://web-dorado.com/products/wordpress-contact-form-builder.html'
    ),
    "slider" => array(
      'title'    => 'Slider WD',
      'text'     => 'WordPress slider plugin',
      'content'  => 'Slider WD is a responsive plugin for adding sliders to your site. Slides can use individual effects as well as effects for the layers (textual content, images, social sharing buttons).',
      'href'     => 'http://web-dorado.com/products/wordpress-slider-plugin.html'
    ),
    "contact-form-maker" => array(
      'title'    => 'Contact Form Maker',
      'text'     => 'WordPress contact form maker plugin',
      'content'  => 'WordPress Contact Form Maker is an advanced and easy-to-use tool for creating forms.',
      'href'     => 'http://web-dorado.com/products/wordpress-contact-form-maker-plugin.html'
    ),
    "spider-calendar" => array(
      'title'    => 'Spider Calendar',
      'text'     => 'WordPress event calendar plugin',
      'content'  => 'Spider Event Calendar is a highly configurable product which allows you to have multiple organized events.',
      'href'     => 'http://web-dorado.com/products/wordpress-calendar.html'
    ),
    "catalog" => array(
      'title'    => 'Spider Catalog',
      'text'     => 'WordPress product catalog plugin',
      'content'  => 'Spider Catalog for WordPress is a convenient tool for organizing the products represented on your website into catalogs.',
      'href'     => 'http://web-dorado.com/products/wordpress-catalog.html'
    ),
    "player" => array(
      'title'    => 'Video Player',
      'text'     => 'WordPress Video player plugin',
      'content'  => 'Spider Video Player for WordPress is a Flash & HTML5 video player plugin that allows you to easily add videos to your website with the possibility',
      'href'     => 'http://web-dorado.com/products/wordpress-player.html'
    ),
    "contacts" => array(
      'title'    => 'Spider Contacts',
      'text'     => 'Wordpress staff list plugin',
      'content'  => 'Spider Contacts helps you to display information about the group of people more intelligible, effective and convenient.',
      'href'     => 'http://web-dorado.com/products/wordpress-contacts-plugin.html'
    ),
    "facebook" => array(
      'title'    => 'Spider Facebook',
      'text'     => 'WordPress Facebook plugin',
      'content'  => 'Spider Facebook is a WordPress integration tool for Facebook.It includes all the available Facebook social plugins and widgets to be added to your web',
      'href'     => 'http://web-dorado.com/products/wordpress-facebook.html'
    ),
    "twitter-widget" => array(
      'title'    => 'Widget Twitter',
      'text'     => 'WordPress Widget Twitter plugin',
      'content'  => 'The Widget Twitter plugin lets you to fully integrate your WordPress site with your Twitter account.',
      'href'     => 'http://web-dorado.com/products/wordpress-twitter-integration-plugin.html'
    ),
    "faq" => array(
      'title'    => 'Spider FAQ',
      'text'     => 'WordPress FAQ Plugin',
      'content'  => 'The Spider FAQ WordPress plugin is for creating an FAQ (Frequently Asked Questions) section for your website.',
      'href'     => 'http://web-dorado.com/products/wordpress-faq-plugin.html'
    ),
    "zoom" => array(
      'title'    => 'Zoom',
      'text'     => 'WordPress text zoom plugin',
      'content'  => 'Zoom enables site users to resize the predefined areas of the web site.',
      'href'     => 'http://web-dorado.com/products/wordpress-zoom.html'
    ),
    "flash-calendar" => array(
      'title'    => 'Flash Calendar',
      'text'     => 'WordPress flash calendar plugin',
      'content'  => 'Spider Flash Calendar is a highly configurable Flash calendar plugin which allows you to have multiple organized events.',
      'href'     => 'http://web-dorado.com/products/wordpress-events-calendar.html'
    )
  );
  ?>
  <div id="main_featured_plugins_page">
    <h3>Featured Plugins</h3>
    <ul id="featured-plugins-list">
      <?php
      foreach ($plugins as $key => $plugins) {
        if ($current_plugin != $key) {
          ?>
      <li class="<?php echo $key; ?>">
        <div class="product">
          <div class="title">
            <strong class="heading"><?php echo $plugins['title']; ?></strong>
            <p><?php echo $plugins['text']; ?></p>
          </div>
        </div>
        <div class="description">
          <p><?php echo $plugins['content']; ?></p>
          <a target="_blank" href="<?php echo $plugins['href']; ?>" class="download">Download</a>
        </div>
      </li>
          <?php
        }
      }
      ?>
    </ul>
  </div>
  <?php
}
