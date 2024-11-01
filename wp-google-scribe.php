<?php
/*
Plugin Name: WP Google Scribe
Plugin URI: http://phonenotes.org/googlescribe
Description: Google Scribe help you get autocomplete suggestions as you type.
Version: 1.1
Author: Simon
Author URI: http://phonenotes.org/googlescribe
*/
define('GS_VERSION', '1.1');

function gs_init() {
$show_type = get_option('gs_show_type');
if(!$show_type) {
	update_option('gs_show_type', "always");
	$show_type = 'always';
}
$gs_enabled = "false";
$gs_ondemand = "false";
if($show_type != 'never')  {
	if($show_type == 'ondemand') {
		$gs_ondemand = "true";
		$gs_enabled = "true";
	}
	if($show_type == 'always') {
		$gs_enabled = "true";
	}
echo "
<script type='text/javascript'> 
var host = 'scribe.googlelabs.com';
var editor = new GSEditor(
	window.location.protocol + '//' + host, {
	  'commit_on_enter': true,
	  'commit_on_tab': true,
	  'commit_on_space': false
	},
	statusChangeCallback);
	editor.setAutoEnableActiveElement('input');
	editor.setLanguage('en');
	var enabled = ".$gs_enabled.";
	var onDemand = ".$gs_ondemand.";
	editor.setStatus(enabled, enabled ? onDemand : undefined);
	function statusChangeCallback() {
	  //donothing
	}
</script>
";
}
}
function gs_js_css() {
	$show_type = get_option('gs_show_type');
	if($show_type != 'never') {
echo "
<link id='gscss' rel='stylesheet' type='text/css' href='http://scribe.googlelabs.com/cssres/reditorapp.css?vcss=9eff3a764a2a25a5c929e07da70e1b2f'>
<script type='text/javascript'> 
  var src = 'http://scribe.googlelabs.com/jsres/editorapp.js?vjs=482dcad65e6161451d1c3859eda78173';
  document.write('<scr' + 'ipt src=' + src + '></scr' + 'ipt>');
</script>
<script src='http://scribe.googlelabs.com/jsres/rgsbletloader.js?vblet=a2d081d61cc026c3acbe039e199c72ce'></script>
";
	}
}
add_action('admin_head', 'gs_js_css');
add_action('admin_footer', 'gs_init');

### Function: Option Menu
add_action('admin_menu', 'gs_menu');
function gs_menu() {
	if (function_exists('add_options_page')) {
		add_options_page('Google Scribe Option', 'Google Scribe', 'manage_options', 'wp-google-scribe/gs-options.php') ;
	}
}