<?php function vtw_howto() { ?>
<h2>VIVVO 2 WordPress HOWTO</h2>
<div class="wrap">
<h3>1. Preparing for migration - Importing VIVVO tables to your WordPress database</h3>
	<p>First thing you need to do is to temporary import your VIVVO tables into the WordPress database. Recommended way is by using phpmyadmin or command line interface. Here is the example how to do it with mysql command line utilities.</p>
		
	<p>We will assume that your VIVVO database name is vivvo_db and that tables have prefix v45_ (v45_users, v45_categories, v45_tags, v45_articles and v45_articles_tags)</p>
		root@myvivvo_server:~# <strong>mysqldump vivvo_db v45_users > v45_users.sql</strong><br />
                root@myvivvo_server:~# <strong>mysqldump vivvo_db v45_categories > v45_categories.sql</strong><br />
                root@myvivvo_server:~# <strong>mysqldump vivvo_db v45_tags > v45_tags.sql</strong><br />
                root@myvivvo_server:~# <strong>mysqldump vivvo_db v45_articles > v45_articles.sql</strong><br />
                root@myvivvo_server:~# <strong>mysqldump vivvo_db v45_articles_tags > v45_articles_tags.sql</strong><br />
	<p>Now we will assume that you have moved dumped *.sql files to your WordPress server and that your WordPress database name is wordpress_db</p>
		root@mywordpress_server:~# <strong>mysql wordpress_db < v45_users.sql</strong><br />
		root@mywordpress_server:~# <strong>mysql wordpress_db < v45_categories.sql</strong><br />
		root@mywordpress_server:~# <strong>mysql wordpress_db < v45_tags.sql</strong><br />
		root@mywordpress_server:~# <strong>mysql wordpress_db < v45_articles.sql</strong><br />
		root@mywordpress_server:~# <strong>mysql wordpress_db < v45_articles_tags.sql</strong><br />

	<p><strong>Note:</strong> You can change your VIVVO table prefix in wp-vivvo.php by changing VIVVO_TABLE_PREFIX constant</p>
<h3>2. Importing Users</h3>
        <p>After importing users to WordPress you need to go to Users -> All Users and set password and <strong>role</strong> for each imported user.</p>
<h3>3. Tags OFFSET</h3>
	<p>VIVVO works in a different way than WordPress. It uses different tables in database for categories and tags. Therefore, categories and tags can have the same ID in the VIVVO database which is not the case with WordPress database since it uses wp_term_taxonomy table for both categories, tags and other taxonomies. This is why we need offset. If still unsure, just leave it on 100000.</p>
<h3>4. Important note </h3>
	<p><font color="#FF0000">This plugin is intended to be used on fresh and new WordPress installation. It will delete all existing posts, categories, tags and users (except admin user). In no event shall CodeHub or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the wp-vivvo plugin even if CodeHub authorized representative has been notified orally or in writing of the possibility of such damage.</font></p>
<h3>5. Images migration support</h3>
	<p>Images migration from VIVVO to WordPress is not supported in the plugin at the moment as it can be case specific and requires advanced knowledge.</p>
<h3>6. Commercial service</h3>
	<p>CodeHub offers commercial service for migrating (including images) your VIVVO CMS website to WordPress for <font color="00aa00"><strong>$200</strong></font> per website. Please contact us at  <a href="mailto: development@codehub.us" target="_blank">development@codehub.us</a> if you are interested.</p>
</div>
<?php } ?>
