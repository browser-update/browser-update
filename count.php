<?php
function get_domain($domain, $debug = false)
{
	$original = $domain = strtolower($domain);

	if (filter_var($domain, FILTER_VALIDATE_IP)) { return $domain; }

	$debug ? print('<strong style="color:green">&raquo;</strong> Parsing: '.$original) : false;

	$arr = array_slice(array_filter(explode('.', $domain, 4), function($value){
		return $value !== 'www';
	}), 0); //rebuild array indexes

	if (count($arr) > 2)
	{
		$count = count($arr);
		$_sub = explode('.', $count === 4 ? $arr[3] : $arr[2]);

		$debug ? print(" (parts count: {$count})") : false;

		if (count($_sub) === 2) // two level TLD
		{
			$removed = array_shift($arr);
			if ($count === 4) // got a subdomain acting as a domain
			{
				$removed = array_shift($arr);
			}
			$debug ? print("<br>\n" . '[*] Two level TLD: <strong>' . join('.', $_sub) . '</strong> ') : false;
		}
		elseif (count($_sub) === 1) // one level TLD
		{
			$removed = array_shift($arr); //remove the subdomain

			if (strlen($_sub[0]) === 2 && $count === 3) // TLD domain must be 2 letters
			{
				array_unshift($arr, $removed);
			}
			else
			{
				// non country TLD according to IANA
				$tlds = array(
					'aero',
					'arpa',
					'asia',
					'biz',
					'cat',
					'com',
					'coop',
					'edu',
					'gov',
					'info',
					'jobs',
					'mil',
					'mobi',
					'museum',
					'name',
					'net',
					'org',
					'post',
					'pro',
					'tel',
					'travel',
					'xxx',
				);

				if (count($arr) > 2 && in_array($_sub[0], $tlds) !== false) //special TLD don't have a country
				{
					array_shift($arr);
				}
			}
			$debug ? print("<br>\n" .'[*] One level TLD: <strong>'.join('.', $_sub).'</strong> ') : false;
		}
		else // more than 3 levels, something is wrong
		{
			for ($i = count($_sub); $i > 1; $i--)
			{
				$removed = array_shift($arr);
			}
			$debug ? print("<br>\n" . '[*] Three level TLD: <strong>' . join('.', $_sub) . '</strong> ') : false;
		}
	}
	elseif (count($arr) === 2)
	{
		$arr0 = array_shift($arr);

		if (strpos(join('.', $arr), '.') === false
			&& in_array($arr[0], array('localhost','test','invalid')) === false) // not a reserved domain
		{
			$debug ? print("<br>\n" .'Seems invalid domain: <strong>'.join('.', $arr).'</strong> re-adding: <strong>'.$arr0.'</strong> ') : false;
			// seems invalid domain, restore it
			array_unshift($arr, $arr0);
		}
	}

	$debug ? print("<br>\n".'<strong style="color:gray">&laquo;</strong> Done parsing: <span style="color:red">' . $original . '</span> as <span style="color:blue">'. join('.', $arr) ."</span><br>\n") : false;

	return join('.', $arr);
}
require("config.php");


$time	= time();

try {
    $ref = parse_url(urldecode($_GET["ref"]));
    $host = strtolower($ref['host']);
    $host = get_domain($host);
} catch (Exception $e) {
    $host="decodeerror";
}


//preg_match('@^([^/])*(/|$)@i', urldecode($_GET["ref"]), $matches);
//$host=get_domain($matches[1]);

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
    $tv = $_GET["tv"];

if (!isset($_GET["cv"]))
    $cv=0;
else
    $cv = $_GET["cv"];

$s=0;
if (isset($_GET["second"]))
    $s=1;


if (isset($_GET["what"]) && $_GET['what']=="view"){
    $q=sprintf("INSERT DELAYED INTO viewschoice SET referer='%s', fromn='%s', fromv=%f, lang='%s', time=%d, textversion='%s', choiceversion='%s', second=%d",
	mysql_real_escape_string($host),
	mysql_real_escape_string($_GET["from"]),
	mysql_real_escape_string($_GET["fromv"]),
	mysql_real_escape_string($ll),
	$time,
        mysql_real_escape_string($tv),
        mysql_real_escape_string($cv),
        $s
	);
}
else {
$q=sprintf("INSERT DELAYED INTO updates SET referer='%s', fromn='%s', fromv=%f, ton='%s', lang='%s', time=%d, textversion='%s', choiceversion='%s', second=%d",
	mysql_real_escape_string($host),
	mysql_real_escape_string($_GET["from"]),
	mysql_real_escape_string($_GET["fromv"]),
	mysql_real_escape_string($_GET["to"]),
	mysql_real_escape_string($ll),
	$time,
        mysql_real_escape_string($tv),
        mysql_real_escape_string($cv),
        $s
	);
}

mysql_query($q) 
	or die (mysql_error(). $q);
?>
