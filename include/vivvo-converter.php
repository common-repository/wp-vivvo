<?php function vtw_convert_tool() { ?>
<div class="wrap">
	<h2>VIVVO 2 WordPress Database Migration Tool</h2>
<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if ((!isset($_POST["vivvo_users"])) && (!isset($_POST["vivvo_categories_and_tags"])) && (!isset($_POST["vivvo_articles"]))) $not_set = 1;
?>
		<div class="<?php echo $not_set ? 'error' : 'updated'; ?>" id="message">
			<p>
<?php
			if ($not_set) echo 'You must check <strong>at least one option</strong> to import users, categories, tags or articles.';

			if ($_POST["vivvo_users"] == 'on') vtw_import_vivvo_users();
			if ($_POST["vivvo_categories_and_tags"] == 'on') vtw_import_vivvo_categories_and_tags();
			if ($_POST["vivvo_articles"] == 'on') vtw_import_vivvo_articles();
?>
			</p>
		</div>
<?php
	};
?>
	<p>Use this tool if you want to migrate from your VIVVO CMS based website to WordPress. Please read <a href="tools.php?page=wp-vivvo/include/vivvo-tools.php&tab=howto">HOWTO</a> first</p>
	<p><strong>Important note:</strong><font color="#FF0000"> This will delete all categories, posts and articles in your current WordPress database!</font></p>
	<form action="<?php echo admin_url('tools.php?page=wp-vivvo/include/vivvo-tools.php'); ?>" method="post">
		<table class="form-table">
		<tbody>
		<tr valign="top">
			<th scope="row">WordPress table prefix</th>
			<td><?php global $wpdb; echo $wpdb->prefix; ?></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="vt_prefix">VIVVO table prefix (if any)</label></th>
			<td><?php echo VIVVO_TABLE_PREFIX; ?><p class="description">e.g. v460_, change VIVVO_TABLE_PREFIX constant in wp-vivvo.php</p></td>
		</tr>
		<tr valign="top">
			<th scope="row">Choose tables to import:</th>
			<td><input type="checkbox" id="vivvo_users" name="vivvo_users"><label for="vivvo_users"> VIVVO Users</label></td>
		</tr>
		<tr valign="top">
			<th scope="row"></th>
			<td><input type="checkbox" id="vivvo_categories_and_tags" name="vivvo_categories_and_tags"><label for="vivvo_categories_and_tags"> VIVVO Categories & Tags</label></td>
		</tr>
		<tr valign="top">
			<th scope="row"></label></th>
			<td><input type="checkbox" id="vivvo_articles" name="vivvo_articles"><label for="vivvo_articles"> VIVVO Articles</label></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="wp_tags_offset">Tags Offset</label></th>
			<td><input type="text" class="regular-text code" value="100000" id="wp_tags_offset" name="wp_tags_offset">
			<p class="description">Don't change if you don't know what are you doing</p></td>
		</tr>
		</tbody>
		</table>
		<p class="submit"><input type="submit" value="Import & Convert" class="button button-primary" id="submit_vivvo_convert" name="submit"></p>
	</form>
	<p><strong>Do you like the project ? Contact us at <a href="mailto: development@codehub.us" target="_blank">development@codehub.us</a>
and order professional<br>VIVVO CMS to WordPress migration for a one time <font color="00aa00">$200</font> fee (including images migration).</strong></p><p><strong>Or just donate to the free project on the paypal button below.</strong></p>
	<p><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="G6YJGKHKVZ9KN">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form></p>
</div>
<?php } ?>
