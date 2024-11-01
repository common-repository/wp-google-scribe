<?php
// Update Options
if(!empty($_POST['Submit'])) {

	$show_type = $_POST['showtype'];

	$is_udpated = update_option('gs_show_type', $show_type);

	$text = '';

	if($is_udpated) {
		$text .= '<div style="margin-left:330px;font-size:14px;border:1px solid #cccddd;background:#eefefe;padding:2px;width:230px;"><font color="green">'.__('Google Scribe Option Updated!', 'googlescribe').'</font><br /></div>';
	}

	if(empty($text)) {
		$text = '<div style="margin-left:330px;font-size:14px;border:1px solid #cccddd;background:#eefefe;padding:2px;width:230px;"><font color="red">'.__('No Option Updated!', 'googlescribe').'</font></div>';
	}
}

$the_option = get_option('gs_show_type');
if(!$the_option) {
	$the_option = 'always';
	update_option('gs_show_type', 'always');
}
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=<?php echo plugin_basename(__FILE__); ?>">
<div class="wrap">
	<?php screen_icon(); ?>
	<h2><?php _e('Google Scribe Options', 'googlescribe'); ?></h2>
	<?php echo $text; ?>
	<table class="form-table">
		<tr>
			<td valign="top" width="30%"><strong style="font-size:12px;"><?php _e('Show suggestions', 'googlescribe'); ?></strong></td>
			<td valign="top">
				<input type="radio" name="showtype" id="o1" value="always" <?php if($the_option == 'always') {echo 'checked';} ?>/><label for="o1">&nbsp;As I type (Always)</label><br />
				<input type="radio" name="showtype" id="o2" value="ondemand" <?php if($the_option == 'ondemand') {echo 'checked';} ?>/><label for="o2">&nbsp;On Tab (On demand)</label><br />
				<input type="radio" name="showtype" id="o3" value="never"  <?php if($the_option == 'never') {echo 'checked';} ?>/><label for="o3">&nbsp;Never (Close Google Scribe)</label><br />
			</td>
		</tr>
		<tr>
			<td valign="top" width="30%"><strong style="font-size:12px;"></strong></td>
			<td valign="top">
				<div><a href="http://scribe.googlelabs.com/static/help.html" target="_blank">Google Scribe Help</a>&nbsp;&nbsp;<a href="http://phonenotes.org/googlescribe" target="_blank">Send feedback to Author</a></div>
				<div></div>
			</td>
		</tr>
	</table>

	<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="<?php _e('Save Changes', 'googlescribe'); ?>" />
	</p>
</div>
</form>