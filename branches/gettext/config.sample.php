<?php

/* copy this to config.php */
$db = mysql_connecT_("localhost","username","password")
	or die('database connection problem');
mysql_select_db("database", $db)
	or die('database not found');

$default_lang = 'en';

?>
