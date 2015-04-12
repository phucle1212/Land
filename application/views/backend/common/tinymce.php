<script type="text/javascript" src="<?php echo base_url(); ?>public/template/backend/plugins/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>

<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		editor_selector: "mceEditor", // use with class
		entity_encoding: "raw", // Thay CH&agrave;o c&aacute;c bạn = Chào các bạn
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

		file_browser_callback : 'openKCFinder',

		// Theme options
		theme_advanced_buttons1 : "preview, |, bold, italic, underline, strikethrough, |, justifyleft, justifycenter, justifyright, justifyfull, |, formatselect,fontselect,fontsizeselect,|, bullist,numlist,|, blockquote, |,sub,sup ",
		theme_advanced_buttons2 : "tablecontrols,|,charmap,emotions,image,iespell,media,advhr,|,hr,removeformat,visualaid,|,fullscreen,|,code",
		
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Skin options
		skin : "o2k7",
		skin_variant : "silver",

		language : "en", 

		// Example content CSS (should be your site CSS)
		content_css : "",

		// Cấu hình để font-size mặc định to hơn
		setup : function(ed){
			ed.onInit.add(function(ed){
				ed.getDoc().body.style.fontSize = '11px';
			});
		},

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}

		// relative_urls : 0,
  //       remove_script_host: 0,
  //       convert_urls : false,
	});

function openKCFinder(field_name, url, type, win){
	tinyMCE.activeEditor.windowManager.open({
		file: '<?php echo base_url(); ?>public/template/backend/plugins/kcfinder/browse.php?opener=tinymce&lang=vi&type='+type,
		title: 'KCFinder',
		width: 700,
		height: 500,
		resizable: "yes",
		inline: true,
		close_previous: "no",
		popup_css: false
	}, {
		window: win,
		input: field_name
	});
	return false;
}

function browserKCFinder(field, type){
	window.KCFinder = {
		callBack: function(url){
			document.getElementById(field).value = url;
			window.KCFinder = null;
		}
	};
	window.open('<?php echo base_url(); ?>public/template/backend/plugins/kcfinder/browse.php?type='+type+'&lang=vi', 'kcfinder_textbox', 
		'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
		'resizable = 1, scrollbar=0, width=800, height=600'
		);
}

</script> <!-- tinyMCE -->