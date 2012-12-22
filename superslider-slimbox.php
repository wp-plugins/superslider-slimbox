<?php
/*
Plugin Name: SuperSlider-Slimbox
Plugin URI: http://superslider.daivmowbray.com/superslider/superslider-slimbox
Description:  Another pop over light box. Theme based, animated, automatic linking, autoplay show built with slimbox2 , uses mootools 1.4.5 java script.
Author: Daiv Mowbray
Author URI: superslider.daivmowbray.com
Version: 1.5

*/ 

/*  Copyright 2008  Daiv Mowbray  (email : daiv.mowbray@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if (!class_exists('ssSlim')) {
    class ssSlim	{
				/**
		* @var string   The name the options are saved under in the database.
		*/
		var $js_path;
		var $css_path;
		var $auto_slim;
		var $slimOpOut;
		var $optionsName = "ssSlimbox_options";
		var $plugin_name = 'superslider-slimbox';
		var $base_over_ride;
		var $slim_is_called;
		var $ssBaseOpOut;
		
		function set_slim_paths($css_load, $css_theme) {
			if ( !defined( 'WP_CONTENT_URL' ) )
				define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
			if ( !defined( 'WP_CONTENT_DIR' ) )
				define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
			if ( !defined( 'WP_PLUGIN_URL' ) )
				define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
			if ( !defined( 'WP_PLUGIN_DIR' ) )
				define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );
			if ( !defined( 'WP_LANG_DIR') )
				define( 'WP_LANG_DIR', WP_CONTENT_DIR . '/languages' );
            
            switch ($css_load) {
            case 'default':
                $this->css_path = WP_PLUGIN_URL.'/superslider-slimbox/plugin-data/superslider/ssSlimbox/'.$css_theme.'/'.$css_theme.'.css';
                break;
            case 'pluginData':
                $this->css_path = WP_CONTENT_URL.'/plugin-data/superslider/ssSlimbox/'.$css_theme.'/'.$css_theme.'.css';
                break;
            case 'theme':
                $this->css_path = get_stylesheet_directory_uri().'/plugin-data/superslider/ssSlimbox/'.$css_theme.'/'.$css_theme.'.css';
                break;
            case 'off':
                $this->css_path = '';
                break;
            }

		}
		/**
		* PHP 4 Compatible Constructor
		*/
		function ssSlim(){//$this->__construct();
			
			ssSlim::slim();
		
		}
		
		/**
		* PHP 5 Constructor
		*/		
		function __construct(){
		
			self::slim();
		
		}
		
		function language_switcher() {
			$superslider_slimbox_locale = get_locale();
			$superslider_slimbox_mofile = dirname(__FILE__) . "/lang/superslider-slimbox-".$superslider_slimbox_locale.".mo";
			load_textdomain("superslider_slimbox", $superslider_slimbox_mofile);		
		}
		
		/**
		* Retrieves the options from the database.
		* @return array
		*/
		function get_slim_options() {
			$slimOptions = array(
				"slim_shortcode" => "true",
				"auto_slim" =>	"false",
				"auto_scan" =>	"false",
				"load_moo" => "on",
				"css_load" => "default",
				"css_theme" => "default", 
				"opacity" => "0.7",
				"width" => "120",
				"height" => "120",
				"image_dur" => "800",
				"resize_dur" => "800",
				"caption_dur" => "800",
				"trans_type"	=> "sine",
				"trans_typeout" => "in:out",
				"counter_text"  =>  "Image {x} of {y}",
				'delete_options' => ''
				);

		
			$savedOptions = get_option($this->optionsName);
				if (!empty($savedOptions)) {
					foreach ($savedOptions as $key => $option) {
						$slimOptions[$key] = $option;
					}
			}
			update_option($this->optionsName, $slimOptions);
				return $slimOptions;
		}
		
		/**
		* Saves the admin options to the database.
		*/
		function saveslimOptions(){
			update_option($this->optionsName, $this->slimOptions);
		}
		
		/**
		* Loads functions into WP API
		* 
		*/
		function slim_init() {

			$this->js_path = WP_CONTENT_URL . '/plugins/'. plugin_basename(dirname(__FILE__)) . '/js/';
			
			// lets see if the base plugin is here and get its options
            if (class_exists('ssBase')) {
                    $this->ssBaseOpOut = get_option('ssBase_options');
                    extract($this->ssBaseOpOut);
                    $this->base_over_ride = $ss_global_over_ride;
            }else{
                $this->base_over_ride = 'false';
            }
            
            $this->slimOptions = $this->get_slim_options();
            extract($this->slimOpOut);

			$this->set_slim_paths($css_load, $css_theme);
  			
			wp_register_script('moocore',$this->js_path.'mootools-core-1.4.5-full-compat-yc.js',NULL, '1.4.5');			
			wp_register_script('moomore',$this->js_path. 'mootools-more-1.4.0.1.js',array( 'moocore' ), '1.4.0.1');
			wp_register_script('slimbox',$this->js_path.'slimbox.js',array( 'moocore' ), '2', false);		
			wp_register_style('lightbox_style',$this->css_path);
			
			$cssAdminFile = WP_PLUGIN_URL.'/superslider-show/admin/ss_admin_style.css';    			
				
		    wp_register_style('superslider_admin', $cssAdminFile);

		}
		
		function slim() {
			
			$this->slimOpOut = get_option($this->optionsName);
			
			$this->auto_slim = $this->slimOpOut['auto_slim'];
			
			register_activation_hook(__FILE__, array(&$this,'slim_init') ); //http://codex.wordpress.org/Function_Reference/register_activation_hook
			register_deactivation_hook( __FILE__, array(&$this,'slim_ops_deactivation') ); //http://codex.wordpress.org/Function_Reference/register_deactivation_hook
			
			add_action ( "init", array(&$this,"slim_init" ) );
			
			add_action ( "admin_menu", array(&$this,"slim_setup_optionspage"));					
			add_action ( "admin_init", array(&$this,"slim_print_box")); // adds the shortcode meta box
			
			add_action ( "init", array(&$this,"slim_add_shortcode" ) );	
			add_action ( 'template_redirect' , array(&$this,'slim_scan') );


		    if ( $this->auto_slim == 'true'){		    
			     add_filter ( "the_content", array(&$this, "slimboxrel_replace"), 12);
			     add_action ( 'wp_print_styles', array(&$this,'slim_add_css'));
			     //add_action ( 'wp_print_scripts', array(&$this,'slim_add_scripts')); //this loads the mootools scripts.
				 add_action('wp_enqueue_scripts', array(&$this,'slim_add_scripts'),3);
				 add_action ( "wp_footer", array(&$this,"slimbox_starter"));		

			}elseif ($this->slimOpOut['auto_scan'] == 'true') {

			     add_action ( 'template_redirect' , array(&$this,'slim_manual_scan') );
			}else {
			     add_action ( 'template_redirect' , array(&$this,'slim_scan') );
			}
			
			$this->slim_is_called = 'false';
			$slim_is_setup = 'true';
		}
		
		function slim_add_shortcode(){
		
		    add_shortcode ( 'slimbox' , array(&$this, 'slim_shortcode_out') );
		}
		/**
		* Outputs the HTML for the admin sub page.
		*/
		public function ssSlim_ui(){
			global $base_over_ride;
			global $plugin_name;
			include_once 'admin/superslider-slimbox-ui.php';
		} 
		
		function slim_setup_optionspage(){
			if( function_exists('add_options_page') && current_user_can('manage_options') ) {
						
       			   if (!class_exists('ssBase')) $plugin_page = add_options_page(__('Superslider Slimbox'),__('SuperSlider-Slimbox'), 'manage_options', 'superslider-slimbox', array(&$this, 'ssSlim_ui'));
					add_filter('plugin_action_links_' . plugin_basename(__FILE__), array(&$this, 'filter_plugin_slim'), 10, 2 );	
					
					if (!class_exists('ssBase')) add_action('admin_print_scripts-'.$plugin_page, array(&$this,'slim_admin_style'));
				    if (!class_exists('ssBase')) add_action('admin_print_scripts-'.$plugin_page, array(&$this,'slim_admin_script')); 
				}
		}
				
		function slim_admin_style(){
                wp_enqueue_style( 'superslider_admin');
				
		}
		function slim_admin_script(){
		      wp_enqueue_script('jquery-ui-tabs');
		
	   }
	   
		/**
		* format an array output for testing
		*/
		function print_format_array($array_name) { 
			echo 'this array contains: ';
	 		 echo '<pre>'; 
	  		ksort($array_name); 
	  		print_r($array_name); 
	  		echo '</pre>'; 
	  		echo '--- end array listing ----';
		} 
		
		/**
		* Add link to options page from plugin list.
		*/
        function filter_plugin_slim($links, $file) {
             static $this_plugin;
                if (  ! $this_plugin ) $this_plugin = plugin_basename(__FILE__);
    
            if (  $file == $this_plugin )
                $settings_link = '<a href="admin.php?page=superslider-slimbox">'.__('Settings').'</a>';
                array_unshift( $links, $settings_link ); //  before other links
                return $links;
        }		
		/**
		*	remove options from DB upon deactivation
		*/
		function slim_ops_deactivation(){
		   if($this->slimOpOut['delete_options'] == true){
			 delete_option($this->optionsName);
		   }
		}

		function slim_change_options($atts){	
			//global $atts;
			$this->slimOpOut = array_merge($this->slimOpOut, array_filter($atts));
  			return $this->slimOpOut;

		}
			
		/**
		* slim_shortcode_out - produces and returns the content to replace the shortcode tag
		*
		* @param array $atts  An array of attributes passed from the shortcode
		* @param string $content   If the shortcode wraps round some html, this will be passed.
		*/
      function slim_shortcode_out( $atts, $content = null ) { 
      
		global $post;
			extract(shortcode_atts(array(
            'opacity' => '',
            'top' => '',
            'height' => '',
            'width' => '',            
            'duration' => '',
            'play' => '',
            'delay' => '',
            'borderwidth' => '',
            'bordercolor' => '',
            'canvaspad' => '',
            'trans_type' => '',
            'trans_typeout' => '',
            'title'	=>	''
            ), $atts));
            
		// opdate options if any changes with shortcode
		if ($atts !='') $this->slim_change_options($atts);
        
				$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)><(.*?)title=('|\")(.*?)('|\")(.*?)><\/a>/i";
				$replacement = '<a$1href=$2$3.$4$5 title="$9" rel="lightbox[%slimID%]"$6><$7title=$8$9$10 $11></a>';
				$content = preg_replace($pattern, $replacement, $content);
				$content = str_replace("%slimID%", $post->ID, $content);
				/*$this->slimboxrel_replace($content);*/

        return do_shortcode($content);
        
		}
        function slim_links_out( $content ) {
			global $post;
			$short_tag = '[slimbox';
			
			$pos = strpos($content,$short_tag);
			if($pos === false) {
			return $content;
			}
			else {
				$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)><(.*?)title=('|\")(.*?)('|\")(.*?)><\/a>/i";
				$replacement = '<a$1href=$2$3.$4$5 title="$9" rel="lightbox[%slimID%]"$6><$7title=$8$9$10 $11></a>';
				$content = preg_replace($pattern, $replacement, $content);
				$content = str_replace("%slimID%", $post->ID, $content);
				/*$this->slimboxrel_replace($content);*/
			}
			return $content;
		}

        function slimboxrel_replace ($content) {
        		global $post;
        		extract($this->slimOpOut);
        		$this->auto_slim = $auto_slim;

        		if ( $this->auto_slim == 'true'){	
            		$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)><(.*?)title=('|\")(.*?)('|\")(.*?)><\/a>/i";
					$replacement = '<a$1href=$2$3.$4$5 title="$9" rel="lightbox[%slimID%]"$6><$7title=$8$9$10 $11></a>';
					$content = preg_replace($pattern, $replacement, $content);
					$content = str_replace("%slimID%", $post->ID, $content);

				}
				return $content;
        }
		
		/**
		* Tells WordPress to load the scripts
		*/
        function slim_add_scripts() {
			global $base_over_ride;
			extract($this->slimOpOut);
			
			if ((!is_admin()) && (function_exists('wp_enqueue_script'))){				

						if ($this->base_over_ride != "on") {
							if ($load_moo == 'on'){								
								wp_enqueue_script('moocore');		
								wp_enqueue_script('moomore');
							}
						}							  
						  wp_enqueue_script('slimbox');					
						 // wp_enqueue_script('slimbox_loader');	
					      $this->slim_is_called = 'true';				
			}
		}
		
		/**
		* Adds a link to the stylesheet to the header
		*/
		function slim_add_css() {
		     
		     wp_enqueue_style( 'lightbox_style');					
		
		}
		
		/**
		* 
		*/
		
		function slimbox_starter(){
			extract($this->slimOpOut);						
            $slim_overlayFadeDur = ' 600 ';
            $slim_resizeTrans = $trans_type.':'.$trans_typeout;

			//$resizeTrans = 'Fx.Transitions.'.$trans_type.'.'.$trans_typeout;

			$myslimbox ="<script type=\"text/javascript\">
				Slimbox.scanPage = function() {
					$$('a[rel^=lightbox]').slimbox({
						loop: true,
						overlayOpacity: ".$opacity.",
						overlayFadeDuration: ".$slim_overlayFadeDur.",
						resizeDuration: ".$resize_dur.",
						resizeTransition: \"".$slim_resizeTrans."\",
						initialWidth: ".$width.",
						initialHeight: ".$height.",
						imageFadeDuration: ".$image_dur.",
						captionAnimationDuration: ".$caption_dur.",
						counterText: '".$counter_text."' 
		
					}, null, function(el) {
					return (this == el) || ((this.rel.length > 8) && (this.rel == el.rel));
					});
				};
				window.addEvent(\"domready\", Slimbox.scanPage);
				</script>";
			
			echo $myslimbox;

		}	
		
		function slim_manual_scan() { 
		  global $posts; 	
			if ( !is_array ( $posts ) ) 
					return; 	 
			foreach ( $posts as $mypost ) { 

					if ( false != strpos ( $mypost->post_content, 'lightbox' )) { // && ($this->slim_is_called != 'true') 
							
							add_action ( "wp_print_scripts", array(&$this,"slim_add_scripts"));							
							add_action ( 'wp_print_styles', array(&$this,'slim_add_css'));
							add_action ( "wp_footer", array(&$this,"slimbox_starter"));
						
					} 	
			}
		}
		/**
		*	Look ahead to check if any posts contain the [slimbox] shortcode
		*/
		function slim_scan() { 

			global $posts; 	
			if ( !is_array ( $posts ) ) 
					return; 	 
			foreach ( $posts as $mypost ) { 

					if ( false !== strpos ( $mypost->post_content, '[slimbox') ) { 	
							add_action ( "wp_print_scripts", array(&$this,"slim_add_scripts"));
							add_action ( 'wp_print_styles', array(&$this,'slim_add_css'));
							add_action ( "wp_footer", array(&$this,"slimbox_starter"));			
					} 	
			}

		}
		function slimbox_loader() { 
		  add_action ( "wp_print_scripts", array(&$this,"slim_add_scripts"));
		  add_action ( 'wp_print_styles', array(&$this,'slim_add_css'));
		  add_action ( "wp_footer", array(&$this,"slimbox_starter"));
		}
			/**
		*	creates slim options tab in post-page window
		*/	
		function slim_print_box() {
			global $plugin_name;
			extract($this->slimOpOut);
			if	($slim_shortcode == 'true')	{
				if (is_admin ()) {
				//Abort early if the user will never see TinyMCE
				if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages'))
			   	return;
					if( function_exists( 'add_meta_box' )) {
						add_meta_box( 'ss_slim', __( 'SuperSlider-Slimbox', $plugin_name ), array(&$this,'slim_writebox'), 'post', 'advanced', 'high');
						add_meta_box( 'ss_slim', __( 'SuperSlider-Slimbox', $plugin_name ), array(&$this,'slim_writebox'), 'page', 'advanced', 'high' );
						
					}
				}
			}
		}
		
		function slim_writebox() {			
			include_once 'admin/superslider-slim-box.php';
			echo $box;	
			include_once 'admin/js/superslider-slim-box.js';
			
			$toggler = '<script type="text/javascript">

             jQuery(document).ready(function(){

              jQuery("#slim-box .ss-toggler-open").click(function(){
                jQuery("#slim-box .ss-slim-advanced").slideToggle(1200);
                jQuery(this).hide();
                return false;
              
            });
            
            jQuery("#slim-box .ss-toggler-close").click(function(){
                jQuery("#slim-box .ss-slim-advanced").slideToggle("slow");
                jQuery("#slim-box .ss-toggler-open").show();
                return false;
              
            });
        
            });

                // ]]>
                </script>';

        echo $toggler;
		}

    }// end class slim
}// end if class slim

//instantiate the class
if (class_exists('ssSlim')) {
	$myssSlim = new ssSlim();
}
?>