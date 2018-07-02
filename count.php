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
require("lib/init.php");

$time	= time();

try {
    $ref = parse_url(urldecode($_GET["ref"]));
    $host = strtolower($ref['host']);
    $host = get_domain($host);
} catch (Exception $e) {
    $host="decodeerror";
}

$ll=get_country();

if (!isset($_GET["tv"]))
    $tv=0;
else
    $tv = $_GET["tv"];

if (!isset($_GET["cv"]))
    $cv=0;
else
    $cv = $_GET["cv"];

if (!isset($_GET["jsv"]))
    $jsv=0;
else
    $jsv = $_GET["jsv"];

$s=0;
if (isset($_GET["second"]))
    $s=1;

$what=filter_input(INPUT_GET, 'what');
$sys=get_system($ua_);

$bx_=get_browserx($ua_);
$browid=$bx_[0];
$brown=$bx_[1];
$browver=$bx_[2];

$q=False;
require_once("config.php");

if ($what=="brow"){
    
    $q=sprintf("INSERT INTO browsers SET ua='%s', info='%s', country='%s', lang='%s', time=NOW(),sysn='%s', sysv=%f, n='%s',v='%d',outdated='%d'",
        $mysqli->real_escape_string($_SERVER['HTTP_USER_AGENT']),
        $mysqli->real_escape_string($_SERVER['HTTP_ACCEPT_LANGUAGE']),
        $mysqli->real_escape_string(get_country()),
        $mysqli->real_escape_string(get_lang()),
        $mysqli->real_escape_string($sys[3]),
        $mysqli->real_escape_string($sys[1]),
        $mysqli->real_escape_string($browid),
        $mysqli->real_escape_string($browver),
        is_outdated() ? 1 : 0
    );
}
else if ($what=="view"){
    /*
    $q=sprintf("INSERT DELAYED INTO viewschoice SET referer='%s', fromn='%s', fromv=%f, lang='%s', time=%d, textversion='%s', choiceversion='%s', second=%d, sysn='%s', sysv=%f",
	$mysqli->real_escape_string($host),
	$mysqli->real_escape_string($_GET["from"]),
	$mysqli->real_escape_string(floatval($_GET["fromv"])),
	$mysqli->real_escape_string(get_lang()),
	$time,
        $mysqli->real_escape_string($tv),
        $mysqli->real_escape_string($cv),
        $s,
        $mysqli->real_escape_string($sys[3]),
        $mysqli->real_escape_string($sys[1])
	);
     */
}
else if ($what=="noti"){
    /*
    $q=sprintf("INSERT DELAYED INTO noti SET referer='%s', fromn='%s', fromv=%f, lang='%s', time=NOW(), scriptversion='%d', textversion='%s', ua='%s',more='%s'",
        $mysqli->real_escape_string(filter_input(INPUT_GET, 'ref')),
        $mysqli->real_escape_string($_GET["from"]),
        $mysqli->real_escape_string(floatval($_GET["fromv"])),
        $mysqli->real_escape_string(get_lang()),
        $mysqli->real_escape_string($jsv),
        $mysqli->real_escape_string($tv),
        "",//$mysqli->real_escape_string($_SERVER['HTTP_USER_AGENT']),        
        $mysqli->real_escape_string(urldecode(filter_input(INPUT_GET, 'extra')))
    );   
     */ 
}
else {//updates
    try {
        require_once 'lib/geoip.php';
        $country_=get_country_from_ip($_SERVER['REMOTE_ADDR']);
    } catch (Exception $e) {
        $country_="xx";
    }    
    $q=sprintf("INSERT DELAYED INTO updates SET referer='%s', fromn='%s', fromv=%f, ton='%s', lang='%s',country='%s', time=%d, textversion='%s', choiceversion='%s', second=%d, sysn='%s', sysv=%f",
	$mysqli->real_escape_string($host),
	$mysqli->real_escape_string($_GET["from"]),
	$mysqli->real_escape_string(floatval($_GET["fromv"])),
	$mysqli->real_escape_string($_GET["to"]),
	$mysqli->real_escape_string(get_lang()),
        $mysqli->real_escape_string($country_),
	$time,
        $mysqli->real_escape_string($tv),
        $mysqli->real_escape_string($cv),
        $s,
        $mysqli->real_escape_string($sys[3]),
        $mysqli->real_escape_string($sys[1])
	);
}
if ($q) {
    $mysqli->query($q)
		or trigger_error($mysqli->sqlstate(). $q, E_USER_ERROR);
}
