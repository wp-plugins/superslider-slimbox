=== SuperSlider-Slimbox ===
Contributors: Daiv Mowbray
Plugin URI: http://superslider.daivmowbray.com/superslider/superslider-slimbox
Tags: superslider, animated, lightbox, mootools, popover, gallery, imageshow
Requires at least: 3
Tested up to: 3.5
Stable tag: 1.5

pop over light box built with Slimbox 2, uses mootools 1.4.5

== Description ==

 Another pop over light box. Theme based, animated, automatic linking, autoplay slideshow,  built with Slimbox2 , uses mootools 1.4.5 java script. This plugin is part of the SuperSlider series. Get more supersliders at [supersliders](http://wordpress.org/extend/plugins/superslider/ "SuperSliders")


**Support**

If you have any problems or suggestions regarding this plugin [please speak up](http://wordpress.org/extend/plugins/superslider-slimbox/ "support forum")

**Plugins**
Download These Plugins here:

* [SuperSlider-Show](http://wordpress.org/extend/plugins/superslider-show/ "SuperSlider-Show")
* [SuperSlider-Menu](http://wordpress.org/extend/plugins/superslider-menu/ "SuperSlider-Menu")
* [SuperSlider-Excerpt](http://wordpress.org/extend/plugins/superslider-excerpt/ "SuperSlider-Excerpt")

**NOTICE**

* The downloaded folder's name should be superslider-slimbox
* Probably not compatible with plugins which use jquery. (not tested)


**Features**

* complete global control from options page
* full short code over ride per post
* Endless image animation/transition possibilities
* Control transition time, image display time.
* Uses WordPress native media / images

**Demos**

This plugin can be seen in use here:

* [Demo 1](http://superslider.daivmowbray.com/wp-plugins/superslider-slimbox/slimbox-demo-1 "Demo")


== Screenshots ==

1. ![Slimbox sample](screenshot-1.png "Slimbox sample")
2. ![SuperSlider-Slimbox options screen](screenshot-2.png "SuperSlider-Slimbox options screen")
3. ![SuperSlider-Slimbox MetaBox on post screen](screenshot-3.png "SuperSlider-Slimbox MetaBox screen")

== Installation ==

The Easy Way

    In your WordPress admin, go to 'Plugins' and then click on 'Add New'.
    In the search box, type in 'SuperSlide-Slimboxr' and hit enter. This plugin should be the first and likely the only result.
    Click on the 'Install' link.
    Once installed, click the 'Activate this plugin' link.

The Hard Way

    Download the .zip file containing the plugin, unzip.
    Upload the Superslider-Slimbox folder into your /wp-content/plugins/ directory 
    Find the Superslider-Slimbox plugin in the WordPress admin on the 'Plugins' page and click 'Activate'

* (optional) add slimbox shortcode to your post.
* (optional) move SuperSlider-Slimbox plugin sub folder plugin-data to your wp-content folder,
	under  > settings > SuperSlider-Slimbox > option group, File Storage - Loading Options
	select "Load css from plugin-data folder, see side note. (Recommended)". This will
	prevent plugin uploads from over writing any css changes you may have made.

== USAGE ==

If you are not sure how this plugin works you may want to read the following.

* First ensure that you have uploaded all of the plugin files into wp-content/plugins/superslider-slimbox folder.
* Go to your WordPress admin panel and stop in to the plugins control page. Activate the SuperSlider-Slimbox plugin.
* Go to the SuperSlider-Slimbox settings page and set the auto slimbox option to on.
* Create a new post, use the WordPress built in media uploader, (upload some images).
* Click on insert image from the media uploader popover panel.
* Publish your new post, click on your image, and your new Slimbox popover should appear.
* Alternatively you can modify how the Slimbox popover works per post by adding a shortcode, either manually or via the Slimbox metabox available on your post screen.


You should be able to view your new Slimbox popover in the new post.
You can adjust how the Slimbox popover looks and works by making adjustments in the plugin settings page. (ss-Milk).

== OPTIONS AND CONFIGURATIONS ==

Available under > settings > SuperSlider-Slimbox

* theme css files to use
* shortcode metabox (on or off for the post / page screens)
* autolink (add rel="slimbox" automatically to images)
* transition type
* transition speed
* display time
* Overlay opacity
* transition time
* image border width
* image border color
* image padding
* to load or not Mootools.js
* css files storage loaction
* **numerous more Advanced design options**

----------
Available in the shortcode tag:

* start height="40"
* start width="20"
* Overlay opacity
* transition="elastic:In:Out"
* image delay="milliseconds"
* transition duration="milliseconds"
* image border width
* image border color
* image padding
* titles="true"



== Themes ==

Create your own graphic and animation theme based on one of these provided.

**Available themes**

* default
* blue
* black
* custom

== To Do ==


== Frequently Asked Questions ==	

=  Why isn't my Slimbox working? =

>*You first need to check that your web site page isn't loading more than 1 copy of mootools javascript into the head of your file.
>*While reading the source code of your website files header look to see if another plugin is using jquery. This may cause a javascript conflict. Jquery and mootools are not always compatible.

=  How do I change the style of the Slimbox? =
  
>I recommend that you move the folder plugin-data to your wp-content folder if you already have a plugin-data folder there, just move the superslider folder. Remember to change the css location option in the settings page for this plugin. Or edit directly: **wp-content/plugins/superslider-show/plugin-data/superslider/ssMilk/custom/custom.css** Alternatively, you can copy those rules into your WordPress themes, style file. Then remember to change the css location option in the settings page for this plugin.
  

= The stylesheet doesn't seem to be having any effect? =
 
>Check this url in your browser:
>http://yourblogaddress/wp-content/plugins/superslider-show/plugin-data/superslider/ssMilk/default/default.css
>If you don't see a plaintext file with css style rules, there may be something wrong with your .htaccess file (mod_rewrite). If you don't know how to fix this, you can copy the style rules there into your themes style file.

= How do I use different graphics and symbols for close and next buttons? =

>You can upload your own images to
>http://yourblogaddress/wp-content/plugins/superslider-slimbox/plugin-data/superslider/ssMilk/custom/images


== CAVEAT ==

Currently this plugin relies on Javascript to create the popover.
If a user's browser doesn't support javascript the image will display normally.

== HISTORY ==

* 1.5 (2012/12/20)

  * upgraded to mootools 1.4.5
  * upgraded to WordPress 3.4.2

* 1.4 (2010/06/02)

  * fixed link to settings page
  * added save options upon deactivation option

* 1.3 (2010/04/10)
    
    * upgraded admin options screen
    * upgraded admin post screen meta box shortcode helper

* 1.0 (2009/10/10)

	* fixed the auto scan
	* added manual scan on / off option
	* improved general functionality

* 0.7 (2009/09/27)

	* fixed a css path error

* 0.6 (2009/07/27)

	* updated mootools to 1.2.3

* 0.5 (2009/02/03)
	
	* Added insert at cursor for the shortcode metabox

* 0.4 (2009/1/26)

	* fixed various bugs
	* upgraded slimbox js file

* 0.3 (2009/1/23)

    * fixed various bugs

* 0.2 (2009/1/15)

    * first public launch

---------------------------------------------------------------------------