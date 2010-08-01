<?php

require("config.php");


$ip 	= crc32(ip2long($_SERVER['REMOTE_ADDR']));
$time	= time();
/*
$q=sprintf("SELECT 1 FROM updates WHERE ip=%d AND time>%d LIMIT 1",
	$ip,
	$time-3600
	);
$r = mysql_query($q)
	or die (mysql_error(). $q);
if (mysql_num_rows($r)>0)
	exit;
*/

$ref	= parse_url(urldecode($_GET["ref"]));
$host	= strtolower($ref['host']);

$lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
$lang = explode (",", $lang);
$lang = explode (";", $lang[0]);
$ll = trim(strtolower(substr($lang[0],0,5)));
if(strlen($ll)==5) {
	$ll = substr($ll, 3, 2);
}
if (!isset($_GET["tv"]))
    $tv=0;
else
    $tv = intval($_GET["tv"]);

if (!isset($_GET["cv"]))
    $cv=0;
else
    $cv = intval($_GET["cv"]);

$s=0;
if (isset($_GET["second"]))
    $s=1;

$inbar=0;
if (isset($_GET["inbar"]))
    $inbar=1;

$q=sprintf("INSERT DELAYED INTO updates SET referer='%s', fromn='%s', fromv=%f, ton='%s', lang='%s', ip=%d, time=%d, textversion=%d, choiceversion=%d, second=%d, inbar=%d",
	mysql_real_escape_string($host),
	mysql_real_escape_string($_GET["from"]),
	mysql_real_escape_string($_GET["fromv"]),
	mysql_real_escape_string($_GET["to"]),
	mysql_real_escape_string($ll),
	$ip,
	$time,
        $tv,
        $cv,
        $s,
        $inbar
	);

mysql_query($q) 
	or die (mysql_error(). $q);
?>
