=== Advanced post slider ===
Contributors: digontoahsan
Donate link: 
Tags: post slider, wordpress content slider, wordpress slideshow, logo scroller, testimonial scroller, banner rotator, recent post slider, image slider, image slideshow, responsive slider, responsive carousel slider, news slider
Requires at least: 3.0.1
Tested up to: 4.4
Stable tag: 2.5.0
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A multipurpose responsive slideshow plugin powered with three built-in design template, lots of easy customizable options and many more to explore.

== Description ==

Unlimited number of slideshow in a single page or post with different sets of options like post type, category, effect, navigation type.
Create slideshow with single or multiple images per slide, rotate your banner or client logo at sidebar; scroll your testimonial with custom link.

> #### **Live Demos**

> * [Template One](http://www.wpcue.com/wordpress-plugins/advanced-post-slider/template-one/)
> * [Template Two](http://www.wpcue.com/wordpress-plugins/advanced-post-slider/template-two/)
> * [Template Three](http://www.wpcue.com/wordpress-plugins/advanced-post-slider/template-three/)

= Key Feature =

* You can create multiple slideshow with different options at single page or post.
* Create three different type (Standard, Carousel & Ticker) of slideshow with single plugin.
* Three built-in design format and each have a predefined optionset.
* Thumbnail pagination.
* You can customize this in many ways withour changing code.
* Supports post,custom post type and even page content
* Easy option for adjusting slide container width, height, background color, border and box-shadow. You can easily turn on/off border and box-shadow
* Ability to control excerpt length for each slideshow
* Cross browser compatibility

Visit [Wpcue](http://www.wpcue.com/) for more

== Installation ==

Using the WordPress dashboard

1. Login to admin panel
2. Go to Plugins
3. Select Add New
4. Search Advanced post slider
5. Select Install Now
6. Select Activate Plugin

Manual

1. Download the plugin and extract the files
2. Upload the directory "advanced-post-slider" to your wp-content/plugins/ directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Check the "Adv. Slider" Tab created by this plugins for manage options

You will get slideshow shortcode something like [advps-slideshow optset="1"] at very first section of every slideshow option set. Use it at admin panel post/page edit screen.

Use WordPress function "do_shortcode" for use in template or theme PHP file.
`<?php echo do_shortcode( '[advps-slideshow optset="1"]' ); ?>`

== Frequently Asked Questions ==

= Where do I submit a question? =

Dont have any FAQ for now.

== Screenshots ==

1. Templates and options
2. Template one example
3. Template one example
4. Template one example
5. Carousel & Ticker with template one
6. Template three example
7. Template three example
8. Template three carousel example

== Changelog ==

= 1.0 =
* First version.

= 1.1 = 
* Option for title tag
* Option for link target
* Remove auto exclude current post

= 1.2 =
* Fix for exclude option

= 2.0 =
* Before upgrade
	* Database structure of Advanced post slider is changed. Your previous option set and settings will be lost.
    * jQuery plugin is changed to bxSlider. jQuery Cycle plugin lover may consider not to update.
    
* Enhancements & New feature
	* Responsive
	* Thumbnail pagination 
	* Carousel & Ticker mode for all templates
	* Multiple slide for all template
	* Improved design for template one
	* Improved admin UI

= 2.1.0 =
* Bug fix
	* Bug fix for version 2 automatic upgrade.
    * Bug fix for carousel exclude pager and next/previous
    
* Feature added
	* Auto play and play/pause enabled for carousel
    
= 2.1.1 =
* Bug fix
	* Bug fix for slider effect.
    
= 2.1.2 =
* Site down problem for some user is resolved.

= 2.1.3 =
* Small change for image ALT attribute.
* Small change in admin UI.

= 2.1.4 =
* Small change for Advanced post slider built-in image resizing functionality.

= 2.2.0 =
* Database query optimization.
* Pager z-index issue resolved.
* More unique id for container.

= 2.3.0 =
* Option added to centering the slideshow.
* Media query for text size.
* Padding unit for template three
* Rel attribute for link.

Check details here [Advanced post slider 2.3.0](http://www.wpcue.com/advanced-post-slider-2-3-0/)

= 2.3.1 =
* Small fix for template three padding

= 2.3.3 =
* Bug fix and Readme update.

= 2.3.4 =
* Small fix for loading issue and Readme update.

= 2.4.0 =
* Security fix.

= 2.5.0 =
* Important security fix and data cleaning. Upgrade is highly recommended.
* Duplicating option set not working issue resolved.

== Upgrade Notice ==