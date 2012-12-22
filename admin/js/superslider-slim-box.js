<script language="javascript" type="text/javascript">
		function insertAtCursor(myField, myValue) {
		//IE support
		if (document.selection) {
			myField.focus();
			sel = document.selection.createRange();
			sel.text = myValue;
		}
		//MOZILLA/NETSCAPE support
		else if (myField.selectionStart || myField.selectionStart == '0') {
			var startPos = myField.selectionStart;
			var endPos = myField.selectionEnd;
			myField.value = myField.value.substring(0, startPos)
			+ myValue
			+ myField.value.substring(endPos, myField.value.length);
		} else {
			myField.value += myValue;
		}
	}
	function addslim() {
		//var form = 'document.showshortcode';
		var slim_code = '[slimbox ';

		var f = document.getElementById('slimopacity'); 
		if (f.value != "") {
			slim_code = slim_code+'opacity="'+f.value+'" ';
			}
		var f = document.getElementById('slimheight'); 
		if (f.value != "") {
			slim_code = slim_code+'height="'+f.value+'" ';
			}
		var f = document.getElementById('slimwidth'); 
		if (f.value != "") {
			slim_code = slim_code+'width="'+f.value+'" ';
			}
		var f = document.getElementById('slimduration'); 
		if (f.value != "") {
			slim_code = slim_code+'image_dur="'+f.value+'" ';
			}
		var f = document.getElementById('slimresize_dur'); 
		if (f.value != "") {
			slim_code = slim_code+'resize_dur="'+f.value+'" ';
			}
		var f = document.getElementById('slimcaption_dur'); 
		if (f.value != "") {
			slim_code = slim_code+'caption_dur="'+f.value+'" ';
			}
		
		var f = document.getElementById('trans_type'); 
		if (f.value != "") {
			slim_code = slim_code+'trans_type="'+f.value+'" ';
			}
		var f = document.getElementById('trans_typeout'); 
		if (f.value != "") {
		    
			slim_code = slim_code+'trans_typeout="'+f.value+'" ';
			}
			slim_code = slim_code+'] Put your content to be slimed here. [/slimbox]';
				
				var destination1 = document.getElementById('content');
				
				if (destination1) {
					// calling the function
				insertAtCursor(destination1, slim_code);
					}
				
				/*var destination2 = content_ifr.tinymce;
				var destination2 = window.frames[0].document.getelementbyid('tinymce')
				if (destination2) {
					destination2.value += slim_code;
					 alert(document.frames("content_ifr").document.getelementbyid('tinymce').value);
					}*/
			
}

</script>