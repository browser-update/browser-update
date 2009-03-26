<?php

require("config.php");

//$ip 	= crc32(ip2long($_SERVER['REMOTE_ADDR']));
$time	= time();
$host	= urldecode($_GET["p"]);
if ($host=='browser-update.org' || $host=='www.browser-update.org')
    return;

$lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
$lang = explode (",", $lang);
$lang = explode (";", $lang[0]);
$ll = trim(strtolower(substr($lang[0],0,5)));
if(strlen($ll)==5) 
{
	$ll = substr($ll, 3, 2);
}


$q=sprintf("INSERT DELAYED INTO views SET referer='%s', fromn='%s', fromv=%f, lang='%s', time=%d",
	mysql_real_escape_string($host),
	mysql_real_escape_string($_GET["n"]),
	mysql_real_escape_string($_GET["v"]),
	mysql_real_escape_string($ll),
	$time
	);

mysql_query($q) 
	or die (mysql_error(). $q);
?>
