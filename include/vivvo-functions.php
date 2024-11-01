<?php
function vtw_import_vivvo_users() {

	global $wpdb;

	$sql = "DELETE FROM {$wpdb->prefix}users where ID > 1";
	$wpdb->query($sql);

	$sql = "INSERT INTO {$wpdb->prefix}users(ID, user_login, user_pass, user_nicename, user_email, user_url, user_registered, display_name) " .
		"SELECT userid, username, password, username, email_address, www, created, username FROM " . VIVVO_TABLE_PREFIX . "users WHERE userid > 1";

	echo 'Importing VIVVO Users ... ';
	$wpdb->show_errors();
	if ($wpdb->query($sql) !== FALSE)
		echo '[ <font color="#00aa00"><strong>DONE</strong></font> ]<br>';
}

function vtw_import_vivvo_categories_and_tags($offset = 100000) {

	global $wpdb;

	/* cleanup wp_terms, wp_term_taxonomy, wp_term_relationships */
	$sql_0 = "DELETE FROM {$wpdb->prefix}terms";
	$sql_1 = "DELETE FROM {$wpdb->prefix}term_taxonomy";
	$sql_2 = "DELETE FROM {$wpdb->prefix}term_relationships";

	/* insert categories */
	$sql_3 = "INSERT INTO {$wpdb->prefix}terms(term_id, name, slug) SELECT id, category_name, sefriendly FROM " . VIVVO_TABLE_PREFIX . "categories";
	$sql_4 = "INSERT INTO {$wpdb->prefix}term_taxonomy(term_taxonomy_id, term_id, taxonomy, description, parent) SELECT id,id,'category',category_name,parent_cat FROM " . VIVVO_TABLE_PREFIX . "categories";
	$sql_5 = "INSERT INTO {$wpdb->prefix}term_relationships(object_id, term_taxonomy_id) SELECT id, category_id FROM " . VIVVO_TABLE_PREFIX . "articles";

	/* insert tags */
	$sql_6 = "INSERT INTO {$wpdb->prefix}terms(term_id, name, slug) SELECT %d+id, name, sefriendly FROM " . VIVVO_TABLE_PREFIX . "tags";
	$sql_7 = "INSERT INTO {$wpdb->prefix}term_taxonomy(term_taxonomy_id, term_id, taxonomy, description) SELECT term_id, term_id, 'post_tag', name FROM {$wpdb->prefix}terms WHERE term_id > %d - 1";
	$sql_8 = "INSERT INTO {$wpdb->prefix}term_relationships(object_id, term_taxonomy_id) SELECT article_id,%d+tag_id FROM " . VIVVO_TABLE_PREFIX . "articles_tags";
	
	echo 'Importing VIVVO Categories & Tags ... ';

	/* execute cleanup */
	$wpdb->query($sql_0);
	$wpdb->query($sql_1);
	$wpdb->query($sql_2);

	/* import categories & tags */
        $wpdb->show_errors();
	if (($wpdb->query($sql_3) && $wpdb->query($sql_4) && $wpdb->query($sql_5) && $wpdb->query($wpdb->prepare($sql_6, absint($offset))) && $wpdb->query($wpdb->prepare($sql_7, absint($offset), absint($offset))) && $wpdb->query($wpdb->prepare($sql_8, absint($offset)))) !== FALSE)
	echo '[ <font color="#00aa00"><strong>DONE</strong></font> ]<br>';
}

function vtw_import_vivvo_articles() {

	global $wpdb;

	$sql_0 = "DELETE FROM {$wpdb->prefix}posts";
	$wpdb->query($sql_0);

	$sql_1 = "INSERT INTO {$wpdb->prefix}posts(ID, post_date, post_status, post_author, post_title, post_name, post_excerpt, post_content) SELECT id, created, 'publish', user_id, title, sefriendly, abstract, body from " . VIVVO_TABLE_PREFIX . "articles";
	
	echo 'Importing VIVVO Articles ... ';
 
	$wpdb->show_errors();
	if ($wpdb->query($sql_1) !== FALSE)
	echo '[ <font color="#00aa00"><strong>DONE</strong></font> ]<br>';
}
?>
