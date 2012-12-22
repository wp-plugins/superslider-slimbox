<?php
$box = '
<div id="slim-box">
<form id="slimshort" name="slimshort" action="">

			<label class ="ss_label" for="slimopacity">opacity : <input tabindex="30" type="text" style="width:40px;" class="ss_input" name="slimopacity" id="slimopacity"  maxlength="10" value="" /> 0.7</label> 
			
			<label class ="ss_label" for="slimduration">image duration : <input tabindex="34" type="text" style="width:40px;"  class="ss_input" name="slimduration" id="slimduration"  maxlength="10" value="" /></label>
			<label class ="ss_label" for="slimresize_dur">resize duration : <input tabindex="35" type="text" style="width:40px;"  class="ss_input" name="slimresize_dur" id="slimresize_dur" maxlength="10" value="" /> </label>
			<label class ="ss_label" for="slimcaption_dur">caption duration : <input tabindex="36" type="text" style="width:40px;"  class="ss_input" name="slimcaption_dur" id="slimcaption_dur"  maxlength="10" value="" /> </label>			
    
    <br style="clear:both;" />        
	<div class="ss-slim-advanced" style="display: none;">
			<div>			
			
            <label class ="ss_label" for="slimheight">height : <input tabindex="32" type="text" style="width:40px;"  class="ss_input" name="slimheight" id="slimheight"  maxlength="10" value="" /> px.</label>	
			<label class ="ss_label" for="slimwidth">width : <input tabindex="33" type="text" style="width:40px;"  class="ss_input" name="slimwidth" id="slimwidth"  maxlength="10" value="" /> px.</label>
		
			<label class ="ss_label" for="trans_type">Transition
					<select name="trans_type" id="trans_type" tabindex="41" >
						<option id="op_slim_type" value=\'\'> select</option>
						 <option id="op_slim_type1" value=\'sine\'> sine</option>
						 <option id="op_slim_type2" value=\'elastic\'> elastic</option>
						 <option id="op_slim_type3" value=\'bounce\'> bounce</option>
						 <option id="op_slim_type4" value=\'back\'> back</option>
						 <option id="op_slim_type5" value=\'expo\'> expo</option>
						 <option id="op_slim_type6" value=\'circ\'> circ</option>
						 <option id="op_slim_type7" value=\'quad\'> quad</option>
						 <option id="op_slim_type8" value=\'cubic\'> cubic</option>
						 <option id="op_slim_type9" value=\'linear\'> linear</option>
					</select></label>
			<label class ="ss_label" for="trans_typeout">Trans in out
					<select name="trans_typeout" id="trans_typeout" tabindex="42" >
						<option id="op_slim_typeout" value=\'\'> select</option>
						 <option id="op_slim_typeout1" value=\'in\'> in</option>
						 <option id="op_slim_typeout2" value=\'out\'> out</option>
						 <option id="op_slim_typeout3" value=\'in:out\'> in:out</option>
					</select></label>
		<div style=" padding: 10px; clear: left;">
		<a href="" class="ss-toggler-close" >close</a>
	</div>
				</div></div>
				
			<input type="button" tabindex="42" value="Add slimbox" name="sendslimtofield" id="sendslimtofield" class="button-primary action" style="margin:10px 40px 0 10px; float: right;" onclick="addslim(); return false;" />
<div style=" padding: 10px; clear: left;">
		<a href="" class="ss-toggler-open" >advanced</a>
	</div>
</form>
<br style="clear:both;" /><p>This shortcode helper presently only works for the Html view.</p>
</div>
';
?>