=== Plugin Name ===
Contributors: royaltechbd
Donate link: http://royaltechbd.com/donate.html
Tags: jQuery Lightbox, jQuery, jQuery PrettyPhoto, Lightbox, PrettyPhoto
Requires at least: 3.3
Tested up to: 3.6
Stable tag: 1.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin will automatic add lightbox in wordpress post/page without disturbance.


== Description ==

This plugin will automatic add lightbox in wordpress post/page without disturbance.

### Features
* Easy to use.
* Support Images, Youtube Video, Vimeo video, iFrame, DEV. 
* For image not need to add rel

### Browser support
* Firefox 3.0+ Google 
* Chrome 10.0+ 
* Internet Explorer 6.0+ 
* Safari 3.1.1+ 
* Opera 9+

### More
* Thank you for using our plugin.
* Vist the [blog post](http://royaltechbd.com/rt-prettyphoto/) to know more.
* [Give a Rating & Write a Review](http://goo.gl/3lNO1R)


### Special Thanks
* [No Margin For Errors](http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone)
* [Rasel Ahmed](http://rrfoundation.net)

== Installation ==


1. Upload the plugin to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Add Images as like you upload (with media link)


### Examples:

= To add a Single Video =
`<a href="Full Video Link" rel="prettyPhoto" ><img src="Full Thumbnial Path" alt=""/></a>`

= To add video with default image gallery =
`<a href="Full Video Link" rel="prettyPhoto[Your_Post_ID]" ><img src="Full Thumbnial Path" alt=""/></a>`
If you post ID is 708 rel should rel="prettyPhoto[708]".

= Aditional Gallery with Image, Youtube Video, Vimeo Video or DIV =
`<div id="complexgallery">
	<a href="Internal or External Full Image Link" rel="prettyPhoto[galleryname]"><img src="Full Thumbnial Path" alt=""/></a>
	<a href="Youtube Full Video Link" rel="prettyPhoto[galleryname]"><img src="Full Thumbnial Path" alt=""/></a>
	<a href="Vimeo Full Video Link" rel="prettyPhoto[galleryname]"><img src="Full Thumbnial Path" alt=""/></a>
	<a href="#DIV_ID_NAME" rel="prettyPhoto[galleryname]"><img src="Full Thumbnial Path" alt=""/></a>
	<a href="#DIV_ID_NAME" rel="prettyPhoto[galleryname]">Text for Link</a>
</div>`
For DIV you should add a div like below.
`<div id="DIV_ID_NAME" style="display:none">
<p>This is inline DEV content for prettyPhoto.</p>
<p>Your DIV full conent here.</p><p>Your DIV full conent here.</p><p>Your DIV full conent here.</p><p>Your DIV full conent here.</p></div>
</div>`


= iframe =
`
<a href="http://royaltechbd.com/?iframe=true&width=100%&height=100%" rel="prettyPhoto[iframes]" title="royaltechbd.com opened at 100%">royaltechbd.com</a>
<a href="http://shamokaldarpon.com/?iframe=true&width=500&height=250" rel="prettyPhoto[iframes]">shamokaldarpon.com</a>
`


= Flash content =
`<a href="http://www.adobe.com/jp/events/cs3_web_edition_tour/swfs/perform.swf?width=792&amp;height=294" rel="prettyPhoto[flash]" title="Flash">
<img src="Full Thumbnial Path" alt="Flash content" /></a>
`

= QuickTime movies =
`
<a title="QuickTime movies" rel="prettyPhoto[movies]" href="http://trailers.apple.com/movies/universal/despicableme/despicableme-tlr1_r640s.mov?width=640&height=360">
<img src="Full Thumbnial Path" alt="QuickTime movies" /></a>
`


== Frequently asked questions ==

= Is it need rel="" =

No, Just add photo, It autometic add rel="".


== Screenshots ==
1. Royal PrettyPhoto Seetings.
2. Royal PrettyPhoto in action.


== Changelog ==

= 1.0.1 =
* Add Seetings

= 1.0.0 =
* Initial release


== Upgrade notice ==
= 1.0.0 =
It is Initial release