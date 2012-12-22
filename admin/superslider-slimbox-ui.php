<?php
/*
Copyright 2008 daiv Mowbray

This file is part of slimbox

Slimbox is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

slimbox is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Fancy Categories; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
	/**
   * Should you be doing this?
   */ 	
   
	if ( !current_user_can('manage_options') ) {
		// Apparently not.
		die( __( 'ACCESS DENIED: Your don\'t have permission to do this.', 'slimbox' ) );
		}
		if (isset($_POST['set_defaults']))  {
			check_admin_referer('slim_options');
			$Slim_OldOptions = array(
				"slim_shortcode" => "true",
				"auto_slim" =>	"false",
				"auto_scan" =>	"false",
				"load_moo" => "on",
				"css_load" => "default",
				"css_theme" => "default", 
				"opacity" => "0.7",
				"width" => "120",
				"height" => "120",
				"image_dur" => "500",
				"resize_dur" => "800",
				"caption_dur" => "800",
				"trans_type"	=> "sine",
				"trans_typeout" => "in:out",
				"counter_text"  =>  "Image {x} of {y}",
				'delete_options' => '');

			update_option('ssSlimbox_options', $Slim_OldOptions);
				
			echo '<div id="message" class="updated fade"><p><strong>' . __( 'Slimbox Default Options reloaded.', 'slimbox' ) . '</strong></p></div>';
			
		}
		elseif (isset($_POST['action']) && $_POST['action'] == 'update' ) {
			
			check_admin_referer('slim_options'); // check the nonce
					// If we've updated settings, show a message
			echo '<div id="message" class="updated fade"><p><strong>' . __( 'Slimbox Options saved.', 'slimbox' ) . '</strong></p></div>';
			
			$Slim_newOptions = array(			
				'slim_shortcode'=> $_POST['op_shortcode'],
				'auto_slim' 	=> $_POST['op_auto_slim'],
				'auto_scan' 	=> $_POST['op_auto_scan'],
				'load_moo' => isset($_POST['op_load_moo']) ? $_POST["op_load_moo"] : "",
				'css_load'		=> $_POST['op_css_load'],
				'css_theme'		=> $_POST["op_css_theme"],
				'opacity'		=> $_POST["op_overlayOpacity"],				
				'width'			=> $_POST["op_initialWidth"],
				'height'		=> $_POST["op_initialHeight"],
				'image_dur'		=> $_POST["op_image_duration"],
				'resize_dur'		=> $_POST["op_resize_duration"],
				'caption_dur'		   => $_POST["op_caption_dur"],
				'trans_type'		=> $_POST["op_trans_type"],
				'trans_typeout'	=> $_POST["op_trans_typeout"],
				'counter_text'	=> $_POST["op_counter_text"],
				'delete_options' => isset($_POST['op_delete_options']) ? $_POST["op_delete_options"] : ""
			);	

		update_option('ssSlimbox_options', $Slim_newOptions);

		// from here		
		}elseif (isset($_POST['proaction']) && $_POST['proaction'] == 'updatepro' ) {
			
			check_admin_referer('ssPro_options'); // check the nonce
					// If we've updated settings, show a message
			echo '<div id="message" class="updated fade"><p><strong>' . __( 'superslider Pro Options saved.', 'superslider' ) . '</strong></p></div>';
			
			
			$ssPro_newOptions = array(				
				'pro_code' => isset($_POST['op_pro_code']) ? $_POST["op_pro_code"] : ""
				);
			update_option('ssPro_options', $ssPro_newOptions);
	
		}

	$ssPro_newOptions = get_option('ssPro_options'); 
	$ispro = '';
	if($ssPro_newOptions['pro_code'] == "We are all beautiful creative people")$ispro = true;

//to here	

		$Slim_newOptions = get_option('ssSlimbox_options');   

	/**
	*	Let's get some variables for multiple instances
	*/
    $checked = ' checked="checked"';
    $selected = ' selected="selected"';
	$site = get_option('siteurl'); 
	$plugin_name = 'superslider-slimbox';
?>

<div class="wrap">
<div class="ss_column1">

<form name="slim_options" method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
<?php if ( function_exists('wp_nonce_field') )
		wp_nonce_field('slim_options'); echo "\n"; ?>
		
<div style="">
<a href="http://superslider.daivmowbray.com/">
<img src="<?php echo WP_CONTENT_URL ?>/plugins/superslider-slimbox/admin/img/logo_superslider.png" style="margin-bottom: -15px;padding: 20px 20px 0px 20px;" alt="SuperSlider Logo" width="52" height="52" border="0" /></a>
  <h2 style="display:inline; position: relative;">SuperSlider-Slimbox Options</h2>
 </div><br style="clear:both;" />
 
 <script type="text/javascript">
// <![CDATA[
jQuery(document).ready(function ($) {

	$(function() {
        $( "#ssslider" ).tabs({ active: 1 });
    });
});	
// ]]>
</script>
 

<div id="ssslider" class="ui-tabs">
    <ul id="ssnav" class="ui-tabs-nav">
        <li <?php if ($this->base_over_ride != "on") { 
  		 echo '';
  		} else {
  		echo 'style="display:none;"';
  		}?>	class="ui-state-default" ><a href="#fragment-1"><span>Appearance</span></a></li>
        <li class="ui-tabs-selected"><a href="#fragment-2"><span>Slimbox Shortcode</span></a></li>
        <li class="ui-tabs-selected"><a href="#fragment-3"><span>Slimbox Auto Link Images</span></a></li>
        <li class="ui-tabs-selected"><a href="#fragment-4"><span>Slimbox Options</span></a></li>
        <li <?php if ($this->base_over_ride != "on") { 
  		 echo '';
  		} else {
  		echo 'style="display:none;"';
  		}?>	class="ss-state-default" ><a href="#fragment-5"><span>File storage</span></a></li>
    </ul>
    <div id="fragment-1" class="ss-tabs-panel">
 	<div <?php if ($this->base_over_ride != "on") { 
  		 echo '';
  		} else {
  		echo 'style="display:none;"';
  		}?>	
	>
	<h3>Slimbox Appearance</h3>
		<fieldset style="border:1px solid grey;margin:10px;padding:10px 10px 10px 30px;"><!-- Theme options start -->  	
		<legend><b><?php _e(' Themes',$plugin_name); ?>:</b></legend>
	<table width="100%" cellpadding="10" align="center">
	<tr>
		<td width="25%" align="center" valign="top"><img src="<?php echo WP_CONTENT_URL ?>/plugins/superslider-slimbox/admin/img/default.png" alt="default" border="0" width="110" height="25" /></td>
		<td width="25%" align="center" valign="top"><img src="<?php echo WP_CONTENT_URL ?>/plugins/superslider-slimbox/admin/img/blue.png" alt="blue" border="0" width="110" height="25" /></td>
		<td width="25%" align="center" valign="top"><img src="<?php echo WP_CONTENT_URL ?>/plugins/superslider-slimbox/admin/img/black.png" alt="black" border="0" width="110" height="25" /></td>
		<td width="25%" align="center" valign="top"><img src="<?php echo WP_CONTENT_URL ?>/plugins/superslider-slimbox/admin/img/custom.png" alt="custom" border="0" width="110" height="25" /></td>
	</tr>
	<tr>
		<td><label for="op_css_theme1">
			 <input type="radio"  name="op_css_theme" id="op_css_theme1"
			 <?php if($Slim_newOptions['css_theme'] == "default") echo $checked; ?> value="default" />
			</label>
		</td>
		<td> <label for="op_css_theme2">
			 <input type="radio"  name="op_css_theme" id="op_css_theme2"
			 <?php if($Slim_newOptions['css_theme'] == "blue") echo $checked; ?> value="blue" />
			 </label>
  		</td>
		<td><label for="op_css_theme3">
			 <input type="radio"  name="op_css_theme" id="op_css_theme3"
			 <?php if($Slim_newOptions['css_theme'] == "black") echo $checked; ?> value="black" />
			 </label>
  		</td>
		<td> <label for="op_css_theme4">
			 <input type="radio"  name="op_css_theme" id="op_css_theme4"
			 <?php if($Slim_newOptions['css_theme'] == "custom") echo $checked; ?> value="custom" />
			</label>
     </td>
	</tr>
	</table>

  </fieldset>
  </div>
</div><!--  close frag 1-->
 
	
		<div id="fragment-2" class="ss-tabs-panel">
	       <h3 class="title">Slimbox Shortcode</h3>
	       
				<fieldset style="border:1px solid grey;margin:10px;padding:10px 10px 10px 30px;"><!-- Theme options start -->  
   <legend><b><?php _e(' Shortcode',$plugin_name); ?>:</b></legend>
		 <ul style="list-style-type: none;">
		 	<li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px;">
    	
    	<label for="op_shortcodeslimbox">
    		<input type="radio" 
    		<?php if($Slim_newOptions['slim_shortcode'] == "true") echo $checked; ?> name="op_shortcode" id="op_shortcodeslimbox" value="true" /> 
    		<?php _e('Slimbox shortcode metabox in post screen is turned on.',$plugin_name); ?>
    		</label>
    		<br />
    	<label for="op_shortcodepopover">
     		<input type="radio" 
     		<?php if($Slim_newOptions['slim_shortcode'] == "false") echo $checked; ?>  name="op_shortcode" id="op_shortcodepopover" value="false" />
     		<?php _e(' Off, not displayed on post / page screen.',$plugin_name); ?>
     		</label><br />
     		<span class="setting-description">
     		<?php _e('By turning this off the Slimbox shortcode metabox will not be available on your post screen, short code will still work.<br /> Slimbox shortcode allows you to change the way your Slimbox works on a per post / page bases.',$plugin_name); ?>
     		</span>
    		</li>
		 </ul>
	</fieldset>
   </div><!--  close frag 2-->
		
	<div id="fragment-3" class="ss-tabs-panel">
	<h3 class="title">Slimbox Auto Link Images</h3>
	
	
				<fieldset style="border:1px solid grey;margin:10px;padding:10px 10px 10px 30px;">
   <legend><b><?php _e(' Autolink',$plugin_name); ?>:</b></legend>
		 <ul style="list-style-type: none;">
		 	<li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px;">

    	<label for="op_auto_slimon">
    		<input type="radio" 
    		<?php if($Slim_newOptions['auto_slim'] == "true") echo $checked; ?> name="op_auto_slim" id="op_auto_slimon" value="true" /> 
    		<?php _e('Slimbox autolink to images is turned on.',$plugin_name); ?>
    		</label>
    		<br />
    	<label for="op_auto_slimoff">
     		<input type="radio" 
     		<?php if($Slim_newOptions['auto_slim'] == "false") echo $checked; ?>  name="op_auto_slim" id="op_auto_slimoff" value="false" />
     		<?php _e(' Off, required rel="slimbox" not added automatically to your images.',$plugin_name); ?>
     		</label><br />
     		<span class="setting-description">
     		<?php _e('By turning this off the Slimbox plugin will not add the rel="lightbox" code to your images. Slimbox will still work, but you will have to add the rel code manually per image, or use the shortcode metabox to add [slimbox] your content to slim here [/slimbox] to your post.',$plugin_name); ?>
     		</span>
    		</li>
    		
    		<li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px;">

    	<label for="op_auto_scanon">
    		<input type="radio" 
    		<?php if($Slim_newOptions['auto_scan'] == "true") echo $checked; ?> name="op_auto_scan" id="op_auto_scanon" value="true" /> 
    		<?php _e('Slimbox autoscan for posts is turned on.',$plugin_name); ?>
    		</label>
    		<br />
    	<label for="op_auto_scanoff">
     		<input type="radio" 
     		<?php if($Slim_newOptions['auto_scan'] == "false") echo $checked; ?>  name="op_auto_scan" id="op_auto_scanoff" value="false" />
     		<?php _e(' Off, post scan disabled.',$plugin_name); ?>
     		</label><br />
     		<span class="setting-description">
     		<?php _e('By turning this off the Slimbox plugin will not scan your posts for manually added rel="lightbox" .',$plugin_name); ?>
     		</span>
    		</li>
    		
		 </ul>
	</fieldset>
   </div><!--  close frag 3-->
		
	<div id="fragment-4" class="ss-tabs-panel">
	<h3 class="title">Options</h3>

		<fieldset style="border:1px solid grey;margin:10px;padding:10px 10px 10px 30px;"><!-- Slideshow options start -->
   <legend><b><?php _e(' Personalize Transitions',$plugin_name); ?>:</b></legend>
   <p><?php _e('These options are global. You can modify most options within your individual post by adding options to the shortcode.',$plugin_name); ?>
		</p>
   <ul style="list-style-type: none;">
     
     <li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px;">
     <label for="op_trans_type"><?php _e(' Transition type',$plugin_name); ?>:   </label>  
		 <select name="op_trans_type" id="op_trans_type">
			 <option <?php if($Slim_newOptions['trans_type'] == "sine") echo $selected; ?> id="sine" value='sine'> sine</option>
			 <option <?php if($Slim_newOptions['trans_type'] == "elastic") echo $selected; ?> id="elastic" value='elastic'> elastic</option>
			 <option <?php if($Slim_newOptions['trans_type'] == "bounce") echo $selected; ?> id="bounce" value='bounce'> bounce</option>
			 <option <?php if($Slim_newOptions['trans_type'] == "back") echo $selected; ?> id="back" value='back'> back</option>
			 <option <?php if($Slim_newOptions['trans_type'] == "expo") echo $selected; ?> id="expo" value='expo'> expo</option>
			 <option <?php if($Slim_newOptions['trans_type'] == "circ") echo $selected; ?> id="circ" value='circ'> circ</option>
			 <option <?php if($Slim_newOptions['trans_type'] == "quad") echo $selected; ?> id="quad" value='quad'> quad</option>
			 <option <?php if($Slim_newOptions['trans_type'] == "cubic") echo $selected; ?> id="cubic" value='cubic'> cubic</option>
			 <option <?php if($Slim_newOptions['trans_type'] == "linear") echo $selected; ?> id="linear" value='linear'> linear</option>
			</select>
		<label for="op_trans_typeout"><?php _e(' Transition action.',$plugin_name); ?></label>
		<select name="op_trans_typeout" id="op_trans_typeout">
			 <option <?php if($Slim_newOptions['trans_typeout'] == "in") echo $selected; ?> id="in" value='in'> in</option>
			 <option <?php if($Slim_newOptions['trans_typeout'] == "out") echo $selected; ?> id="out" value='out'> out</option>
			 <option <?php if($Slim_newOptions['trans_typeout'] == "in:out") echo $selected; ?> id="inout" value='in:out'> in:out</option>     
		</select><br />
		<span class="setting-description"><?php _e(' IN is the begginning of transition. OUT is the end of transition.',$plugin_name); ?></span>
     </li><!-- //'quad:in:out'sine:out, elastic:out, bounce:out, expo:out, circ:out, quad:out, cubic:out, linear:out, -->    
      	
     <li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px;">
     <label for="op_initialHeight"><?php _e(' Initial height '); ?>:
		 <input type="text" class="span-text" name="op_initialHeight" id="op_initialHeight" size="3" maxlength="6"
		 value="<?php echo ($Slim_newOptions['height']); ?>" /></label> 
		 <span class="setting-description"><?php _e('px, this is the starting height',$plugin_name); ?></span>
	 </li>     
     <li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px;">
     <label for="op_initialWidth"><?php _e(' Initial width '); ?>:
		 <input type="text" class="span-text" name="op_initialWidth" id="op_initialWidth" size="3" maxlength="6"
		 value="<?php echo ($Slim_newOptions['width']); ?>" /></label> 
		 <span class="setting-description"><?php _e('px, this is the starting width',$plugin_name); ?></span>
	 </li>
	 <li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px;">
     <label for="op_overlayOpacity"><?php _e(' Overlay opacity '); ?>:
		 <input type="text" class="span-text" name="op_overlayOpacity" id="op_overlayOpacity" size="3" maxlength="4"
		 value="<?php echo ($Slim_newOptions['opacity']); ?>" /></label> 
		 <span class="setting-description"><?php _e('   (default 0.7)',$plugin_name); ?></span>
	 </li>
      <li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px;">
		 <label for="op_resize_duration"><?php _e(' Resize Transition time '); ?>:
		 <input type="text" class="span-text" name="op_resize_duration" id="op_resize_duration" size="3" maxlength="6"
		 value="<?php echo ($Slim_newOptions['resize_dur']); ?>" /></label> 
		 <span class="setting-description"><?php _e('  In milliseconds, ie: 1000 = 1 second, (default 500)',$plugin_name); ?></span>
	</li>
      
     <li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px;">
     <label for="op_image_duration"><?php _e(' Image fadein duration '); ?>:
		 <input type="text" class="span-text" name="op_image_duration" id="op_image_duration" size="3" maxlength="6"
		 value="<?php echo ($Slim_newOptions['image_dur']); ?>" /></label> 
		 <span class="setting-description"><?php _e('  Image fade in duration, (default 400)',$plugin_name); ?></span>
	 </li>
	 
	  <li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px;">
		 <label for="op_caption_dur"><?php _e(' Caption transition time'); ?>:
		 <input type="text" class="span-text" name="op_caption_dur" id="op_caption_dur" size="3" maxlength="6"
		 value="<?php echo ($Slim_newOptions['caption_dur']); ?>" /></label> 
		 <span class="setting-description"><?php _e('  In milliseconds, (default 800)',$plugin_name); ?></span>
	</li>
	
	<li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px;">
		 <label for="op_counter_text"><?php _e(' Counter text'); ?>:
		 <input type="text" class="span-text" name="op_counter_text" id="op_counter_text" size="16" maxlength="50"
		 value="<?php echo ($Slim_newOptions['counter_text']); ?>" /></label> 
		 <span class="setting-description"><?php _e('  Image {x} of {y}',$plugin_name); ?></span>
	</li>

     </ul>
  </fieldset>
</div><!-- close frag4 -->

<div id="fragment-5" class="ss-tabs-panel">
	
	<div
<?php if ($this->base_over_ride != "on") { 
  		 echo '';
  		} else {
  		echo 'style="display:none;"';
  		}?> 
	>
	<h3 class="title">File Storage</h3>
<fieldset style="border:1px solid grey;margin:10px;padding:10px 10px 10px 30px;"><!-- Header files options start -->
   			<legend><b><?php _e(' Loading Options'); ?>:</b></legend>
  		 <ul style="list-style-type: none;">
  		 
  		<li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px;">
    	<label for="op_load_moo">
    	<input type="checkbox" 
    	<?php if($Slim_newOptions['load_moo'] == "on") echo $checked; ?> name="op_load_moo" id="op_load_moo" />
    	<?php _e(' Load Mootools 1.4 into your theme header.',$plugin_name); ?></label><br />
    	<p><?php _e(' If your theme or any other plugin loads the mootools 1.4.5 javascript framework into your file header, you can de-activate it here.',$plugin_name); ?></p>
	</li>
	
    <li style="border-bottom:1px solid #cdcdcd; padding: 6px 0px 8px 0px;">
  
    	<label for="op_css_load1">
			<input type="radio" name="op_css_load" id="op_css_load1"
			<?php if($Slim_newOptions['css_load'] == "default") echo $checked; ?> value="default" />
			<?php _e(' Load css from default location. slimbox plugin folder.',$plugin_name); ?></label><br />
    	<label for="op_css_load2">
			<input type="radio" name="op_css_load"  id="op_css_load2"
			<?php if($Slim_newOptions['css_load'] == "pluginData") echo $checked; ?> value="pluginData" />
			<?php _e(' Load css from plugin-data folder, see side note. * (Recommended)',$plugin_name); ?></label><br />
    	<label for="op_css_load3">
			<input type="radio" name="op_css_load"  id="op_css_load3"
			<?php if($Slim_newOptions['css_load'] == "theme") echo $checked; ?> value="theme" />
			<?php _e(' Load css from your WordPress them folder, see side note. *',$plugin_name); ?></label><br />
        <label for="op_css_load4">
			<input type="radio" name="op_css_load"  id="op_css_load4"
			<?php if($Slim_newOptions['css_load'] == "off") echo $checked; ?> value="off" />
			<?php _e(' Don\'t load css, manually add to your theme css file.',$plugin_name); ?></label><br />
        	<p><?php _e('* Based on your load css settings you will need to do one of the following. Via ftp, move the folder named plugin-data from this plugin folder into your wp-content folder, or into your WordPress theme folder. This is recomended to avoid over writing any changes you make to the css files when you update this plugin.',$plugin_name); ?>
        	</p>
	
    </li>
    </ul>
     </fieldset>
	</div>		
	</div><!-- close frag 8 -->
</div><!--  close tabs -->

<p>
<label for="op_delete_options">
		      <input type="checkbox" <?php if($Slim_newOptions['delete_options'] == "on") echo $checked; ?> name="op_delete_options" id="op_delete_options" />
		      <?php _e('Remove options. '); ?></label>	
		 <br /><span class="setting-description"><?php _e('Select to have the plugin options removed from the data base upon deactivation.'); ?></span>
		 <br />
</p>
<p class="submit">
		<input type="submit" class="button" name="set_defaults" value="<?php _e(' Reload Default Options',$plugin_name); ?> &raquo;" />
		<input type="submit" id="update2" class="button-primary" value="<?php _e(' Update options',$plugin_name); ?> &raquo;" />
		<input type="hidden" name="action" id="action" value="update" />
 	</p>
 </form>
 
</div><!-- close column1 -->


<div class="ss_column2">

<?php if( $ispro !== true) { ?>

	<div class="ss_donate ss_admin_box"> 
		<h2><span class="promo"><?php _e('Spread the Word!', $plugin_name); ?></span></h2>
		<p><?php _e('Want to help make this plugin even better? All donations are used to improve and maintain this plugin, so donate $5, $10, $20 or $50! We\'ll both be glad you did. Thanx. ', $plugin_name); ?></p>
       <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="N2F3EUVHPYY5G">
            <input type="image" class="paypal_button" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
       </form>
       
       
       <p><?php _e('Better yet, if you would like to join the exclusive pro members club,', $plugin_name); ?> <a href="http://superslider.daivmowbray.com/superslider-pro/"><?php _e('learn more'); ?></a><?php _e('or upgrade now!'); ?> </p>
       <h2><span class="promo">SuperSlider Pro</span></h2>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="83HF3CEUD4976">
			<input type="image" class="paypal_button" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form>

       <p><?php _e('Or if you find this plugin useful you could :'); ?></p><ul>
       	<li><a href="http://wordpress.org/extend/plugins/<?php echo $plugin_name; ?>/"><?php _e('Rate the plugin 5 stars on WordPress.org', $plugin_name); ?></a></li>
       	<li><a href="http://superslider.daivmowbray.com/superslider/<?php echo $plugin_name; ?>/"><?php _e('Blog about it &amp; link to the plugin page', $plugin_name); ?></a></li>
       	<li><a href="http://wordpress.org/support/view/plugin-reviews/<?php echo $plugin_name; ?>"><?php _e('Post a glowing review on WordPress.org, that would be really nice.', $plugin_name); ?></a></li>
       	<li><a href="http://amzn.com/w/2GUXZ71357NX9"><?php _e('or buy me a gift from my wishlist ...', $plugin_name); ?></a></li></ul>
       
    </div>
    <div class="ss_admin_box" id="sitereview">
		<h2><?php _e('Improve your Site!', $plugin_name); ?></h2>
		<p><?php _e('Don\'t know where to start? Order a ', $plugin_name); ?><a href="http://superslider.daivmowbray.com/services/website-review/#order"><?php _e('website review', $plugin_name); ?></a> from SuperSlider!
		<a href="http://superslider.daivmowbray.com/services/website-review/"> Read more ... </a></p>	
	</div>

 
	<div class="ss_admin_box" id="support">
		<h2><?php _e('Need support?', $plugin_name); ?></h2>
		<p><?php _e('If you are having problems with this plugin, please talk about them in the', $plugin_name); ?> <a href="http://wordpress.org/support/plugin/<?php echo $plugin_name; ?>/">Support forums</a>.</p>	
		</div>

 <?php 
 } else { ?>
	
		<div class="ss_donate ss_admin_box"> <h2><span class="promo">SuperSlider Pro</span></h2> </div>
	<div class="ss_admin_box" id="support">
		<h2><?php _e('Need support?', $plugin_name); ?></h2>
		<p><?php _e('If you are having problems with this plugin, please contact me directly via this contact form', $plugin_name); ?><br /><a href="http://superslider.daivmowbray.com/pro-support/">Pro Support</a>.</p>	
		</div>
<?php }?>

	<h2><?php _e('More SuperSlider Plugins', $plugin_name); ?></h2>
	<p><?php _e('There are 11 different SuperSlider plugins. All are free to use. Take a minute and learn what each one can do for you. They save you time and money, while making a better web site.', $plugin_name); ?></p>
	 <div class="ss_plugins_list
	 <?php if (class_exists('ssBase') && class_exists('ssShow') &&  class_exists('ssMenu') && class_exists('ssMenu') && class_exists('ssImage') && class_exists('ssExcerpt') && class_exists('ssMediaPop') && class_exists('perpost_code') && class_exists('ssPnext') && class_exists('ss_postsincat_widget') && class_exists('ssLogin') && class_exists('ssSlim')) { echo "all-installed" ; } ?>
	 "> 
	 
		<div class="ss_plugin <?php if (class_exists('ssBase')) { echo "installed"; }else{ echo "not_installed";} ?>"><p>
		<a href="http://wordpress.org/extend/plugins/superslider/" title="visit this plugin at WordPress.org to learn more">SuperSlider</a>	
		<a href="#ss_tips_info" class="ss_tool" style="padding: 2px 8px;"> info ?  </a><br />
		<a href="plugin-install.php?tab=search&s=superslider&plugin-search-input=Search+Plugins" class="ss_more" title="View this plugin on your plugin install page">View on your Plugin Install page</a></p>
		<div id ="ss_tips_info" class="info_box" style="display:none;">
		<p>SuperSlider base, is a global admin plugin for all SuperSlider plugins and comes stocked full of eye candy in the form of modules.</p>
		</div></div>
		
		<div class="ss_plugin <?php if (class_exists('ssShow')) { echo "installed"; }else{ echo "not_installed";} ?>"><p>
		<a href="http://wordpress.org/extend/plugins/superslider-show/" title="visit this plugin at WordPress.org to learn more">SuperSlider-Show</a>
		<a href="#show_tips_info" class="ss_tool" style="padding: 2px 8px;"> info ?  </a><br />
		<a href="plugin-install.php?tab=search&s=superslider-show&plugin-search-input=Search+Plugins" class="ss_more" title="View this plugin on your plugin install page">View on your Plugin Install page</a></p>
		<div id ="show_tips_info" class="info_box" style="display:none;">
		<p>SuperSlider-Show is your Animated slideshow plugin with automatic thumbnail list inclusion. This slideshow uses javascript to replace your gallery with a Slideshow. Highly configurable, theme based design, css based animations, automatic minithumbnail creation. Shortcode system on post and page screens to make each slideshow unique.</p>
		</div></div>
		
		<div class="ss_plugin <?php if (class_exists('ssMenu')) { echo "installed"; }else{ echo "not_installed";} ?>"><p>
		<a href="http://wordpress.org/extend/plugins/superslider-menu/" title="visit this plugin at WordPress.org to learn more">SuperSlider-Menu</a>		
		<a href="#show_tips_info" class="ss_tool" style="padding: 2px 8px;"> info ?  </a><br />
		<a href="plugin-install.php?tab=search&s=superslider-menu&plugin-search-input=Search+Plugins" class="ss_more" title="View this plugin on your plugin install page">View on your Plugin Install page</a></p>
		<div id ="show_tips_info" class="info_box" style="display:none;">
		<p>SuperSlider-Show is your Animated slideshow plugin with automatic thumbnail list inclusion. This slideshow uses javascript to replace your gallery with a Slideshow. Highly configurable, theme based design, css based animations, automatic minithumbnail creation. Shortcode system on post and page screens to make each slideshow unique.</p>
		</div></div>
		
		<div class="ss_plugin <?php if (class_exists('ssImage')) { echo "installed"; }else{ echo "not_installed";} ?>"><p>
		<a href="http://wordpress.org/extend/plugins/superslider-image/" title="visit this plugin at WordPress.org to learn more">SuperSlider-Image</a>
		<a href="#image_tips_info" class="ss_tool" style="padding: 2px 8px;"> info ?  </a><br />
		<a href="plugin-install.php?tab=search&s=superslider-image&plugin-search-input=Search+Plugins" class="ss_more" title="View this plugin on your plugin install page">View on your Plugin Install page</a></p>
		<div id ="image_tips_info" class="info_box" style="display:none;">
		<p>Take control your photos and image display. Can add a randomly selected image to any post without an image. Provides a shortcode for adding a photo or image to your post. Provides an easy way to change image properties globally. At the click of a button all post size images can be changed from thumbnail size image to medium size image or any available image size.</p>
		</div></div>
		
		<div class="ss_plugin <?php if (class_exists('ssExcerpt')) { echo "installed"; }else{ echo "not_installed";} ?>"><p>
		<a href="http://wordpress.org/extend/plugins/superslider-excerpt/" title="visit this plugin at WordPress.org to learn more">SuperSlider-Excerpt</a>
		<a href="#excerpt_tips_info" class="ss_tool" style="padding: 2px 8px;"> info ?  </a><br />
		<a href="plugin-install.php?tab=search&s=superslider-excerpt&plugin-search-input=Search+Plugins" class="ss_more" title="View this plugin on your plugin install page">View on your Plugin Install page</a></p>
		<div id ="excerpt_tips_info" class="info_box" style="display:none;">
		<p>SuperSlider-Excerpts automatically adds thumbnails wherever you show excerpts (archive page, feed... etc). Mouseover image will then Morph its properties, (controlled with css) You can pre-define the automatic creation of excerpt sized excerpt-nails.(New image size created, upon image upload).</p>
		</div></div>
		
		<div class="ss_plugin <?php if (class_exists('ssMediaPop')) { echo "installed"; }else{ echo "not_installed";} ?>"><p>
		<a href="http://wordpress.org/extend/plugins/superslider-media-pop/" title="visit this plugin at WordPress.org to learn more">SuperSlider-Media-Pop</a>	
		<a href="#media_tips_info" class="ss_tool" style="padding: 2px 8px;"> info ?  </a><br />
		<a href="plugin-install.php?tab=search&s=superslider-media-pop&plugin-search-input=Search+Plugins" class="ss_more" title="View this plugin on your plugin install page">View on your Plugin Install page</a></p>
		<div id ="media_tips_info" class="info_box" style="display:none;">
		<p>Soda pop for your media. Take control of your media. Access all size versions of your uploaded image for insert. SuperSlider-Media-Pop adds numerous image enhancements to your admin panels. Displays all attached files to this post/page in post listing screen. It adds image sizes to the Upload/Insert image screen, making all image sizes available to be inserted and adding to the image link field options. Insert any image size and link to any image size.</p>
		</div></div>
		
		<div class="ss_plugin <?php if (class_exists('perpost_code')) { echo "installed"; }else{ echo "not_installed";} ?>"><p>
		<a href="http://wordpress.org/extend/plugins/superslider-perpost-code/" title="visit this plugin at WordPress.org to learn more">SuperSlider-Perpost-Code</a>
		<a href="#code_tips_info" class="ss_tool" style="padding: 2px 8px;"> info ?  </a><br />
		<a href="plugin-install.php?tab=search&s=superslider-perpost-code&plugin-search-input=Search+Plugins" class="ss_more" title="View this plugin on your plugin install page">View on your Plugin Install page</a></p>
		<div id ="code_tips_info" class="info_box" style="display:none;">
		<p>Write css and javascript code directly on your post edit screen on a per post basis. Meta boxes provide a quick and easy way to enter custom code to each post. It then loads the code into your frontend theme header if the post has custom code. You may also display your custom code directly into your post with the custom_css or custom_js shortcode.</p>
		</div></div>
		
		<div class="ss_plugin <?php if (class_exists('ssPnext')) { echo "installed"; }else{ echo "not_installed";} ?>"><p>
		<a href="http://wordpress.org/extend/plugins/superslider-previousnext-thumbs/" title="visit this plugin at WordPress.org to learn more">SuperSlider-Previousnext-Thumbs</a>
		<a href="#pnext_tips_info" class="ss_tool" style="padding: 2px 8px;"> info ?  </a><br />
		<a href="plugin-install.php?tab=search&s=superslider-previousnext-thumbs&plugin-search-input=Search+Plugins" class="ss_more" title="View this plugin on your plugin install page">View on your Plugin Install page</a></p>
		<div id ="pnext_tips_info" class="info_box" style="display:none;">
		<p>Superslider-previousnext-thumbs is a previous-next post, thumbnail navigation creator. Works specifically on the single post pages. Animated rollover controlled with css and from the plugin options page. Can create custom image sizes. Automaitcally insert before or after post content or both. Or you can manually insert into your single post theme file.</p>
		</div></div>
		
		<div class="ss_plugin <?php if (class_exists('ss_postsincat_widget')) { echo "installed"; }else{ echo "not_installed";} ?>"><p>
		<a href="http://wordpress.org/extend/plugins/superslider-postsincat/" title="visit this plugin at WordPress.org to learn more">SuperSlider-Postsincat</a>
		<a href="#pinc_tips_info" class="ss_tool" style="padding: 2px 8px;"> info ?  </a><br />
		<a href="plugin-install.php?tab=search&s=superslider-postsincat&plugin-search-input=Search+Plugins" class="ss_more" title="View this plugin on your plugin install page">View on your Plugin Install page</a></p>
		<div id ="pinc_tips_info" class="info_box" style="display:none;">
		<p>This widget dynamically creates a list of posts from the active category. Displaying the first image and title. It will display the first image in your post as a thumbnail,it looks first for an attached image, then an embedded image then if it finds the image, it grabs the thumbnail version. Oh, and by the way, it's an animated vertical scroller, way cool.</p>
		</div></div>
		
		<div class="ss_plugin <?php if (class_exists('ssLogin')) { echo "installed"; }else{ echo "not_installed";} ?>"><p>
		<a href="http://wordpress.org/extend/plugins/superslider-login/" title="visit this plugin at WordPress.org to learn more">SuperSlider-Login</a>
		<a href="#login_tips_info" class="ss_tool" style="padding: 2px 8px;"> info ?  </a><br />
		<a href="plugin-install.php?tab=search&s=superslider-login&plugin-search-input=Search+Plugins" class="ss_more" title="View this plugin on your plugin install page">View on your Plugin Install page</a></p>
		<div id ="login_tips_info" class="info_box" style="display:none;">
		<p>A tabbed slide in login panel. Theme based, animated, automatic user detection.</p>
		</div></div>
		
		<div class="ss_plugin <?php if (class_exists('ssSlim')) { echo "installed"; }else{ echo "not_installed";} ?>"><p>
		<a href="http://superslider.daivmowbray.com/superslider/superslider-slimbox/" title="visit this plugin at WordPress.org to learn more">SuperSlider-Slimbox</a>
		<a href="#slim_tips_info" class="ss_tool" style="padding: 2px 8px;"> info ?  </a><br />
		<a href="plugin-install.php?tab=search&s=superslider-slimbox&plugin-search-input=Search+Plugins" class="ss_more" title="View this plugin on your plugin install page">View on your Plugin Install page</a></p>
		<div id ="slim_tips_info" class="info_box" style="display:none;">
		<p>Another pop over light box. Theme based, animated, automatic linking, autoplay show built with slimbox2 , uses mootools 1.4.5 java script</p>
		</div></div>
	
		<br style="clear:both;" />
	 </div>
 <h3><?php _e('Services', $plugin_name); ?></h3>
		<p><?php _e('Custom plugins, custom themes, custom solutions: I\'ve been developing WordPress Themes and plugins for many years. If you need a custom solution or simply some help with your set up I am avaiable at reasonable rates. ', $plugin_name); ?><a href="http://www.daivmowbray.com/contact"><?php _e('Just send a note to me, Daiv Mowbray, through this contact form', $plugin_name); ?></a>.</p>

<?php  if( $ispro !== true) { ?>

	<div class="promo_code_form" style="text-align: center;">
	<form name="ssPro_options" method="post" action="<?php //echo $_SERVER['REQUEST_URI'] ?>">
	<?php if ( function_exists('wp_nonce_field') )
		wp_nonce_field('ssPro_options'); echo "\n"; 
		?>
    		<label for="op_pro_code">
               <input type="text" class="span-text" name="op_pro_code" id="op_pro_code" size="30" maxlength="200"
			 value="<?php echo ($ssPro_newOptions['pro_code']); ?>" />
               <br /> <?php _e('Enter your SuperSlider Pro code.',$plugin_name); ?></label>	
    <p class="margin-top: 5px;">
	
		<input type="submit" id="updatePro" class="button-primary" value="<?php _e('Enter',$plugin_name); ?> &raquo;" />
		<input type="hidden" name="proaction" id="proaction" value="updatepro" />
		
 	</p>
 	</form>
 	</div>
<?php  } ?> 

</div><!-- close column2   --> 
</div><!-- close wrap to here --> 

<?php
	echo "";
?>