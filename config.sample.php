<?php

/* copy this to config.php */
$db = mysql_connect("localhost","username","password")
	or die(T_('database connection problem'));
mysql_select_db("database", $db)
	or die(T_('database not found'));

$default_lang = 'en';

?>
