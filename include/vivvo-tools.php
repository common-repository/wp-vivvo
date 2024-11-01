<?php

require_once SYS_VTW . '/include/vivvo-converter.php';
require_once SYS_VTW . '/include/vivvo-howto.php';

add_action('admin_menu', 'vtw_admin_menu');

function vtw_admin_menu() {
	add_management_page('VIVVO 2 WordPress', 'VIVVO 2 WordPress', 'manage_options', __FILE__, 'vtw_tools_page');
}

function vtw_tools_tabs($current = 'importer') {
	$tabs = array(
		'converter' => 'VIVVO 2 WordPress Database Migration',
		'howto' => 'HOWTO'
	);
?>
	<div id="icon-tools" class="icon32"><br></div>
	<h2 class="nav-tab-wrapper">
<?php
	foreach($tabs as $tab => $name) {
		$class = ($tab == $current) ? ' nav-tab-active' : '';
?>
		<a class="nav-tab<?php echo $class;?>" href="?page=<?php echo __FILE__; ?>&tab=<?php echo $tab;?>"><?php echo $name;?></a>
<?php
	}
?>
		</h2>
<?php
}

function vtw_tools_page() { ?>
<div class="wrap">
<?php
	global $pagenow;

	if (isset ($_GET['tab'])) vtw_tools_tabs($_GET['tab']);
		else vtw_tools_tabs('converter');

	if (isset ($_GET['tab'])) $tab = $_GET['tab'];
		else $tab = 'converter';

	switch ($tab) {
		case 'converter':
			vtw_convert_tool();
		break;
		case 'howto':
			vtw_howto();
		break;
	}
}
?>
