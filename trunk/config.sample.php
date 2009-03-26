<?php

/* copy this to config.php */
$db = mysql_connect("localhost","username","password")
	or die('database connection problem');
mysql_select_db("database", $db)
	or die('database not found');

?>
