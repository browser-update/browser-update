<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

define('BU_PATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
define('BU_LIB_PATH', BU_PATH . 'lib' . DIRECTORY_SEPARATOR);
$default_lang = 'en';


function cache_output($function,$hours=0.1) {
	$cachefile = "cache/" . md5($function) . '.cache.html';

	if (!file_exists($cachefile) || filemtime($cachefile) < (time() - 3600*$hours)) {
                ob_start();
		$dataf = call_user_func($function);
                $data=ob_get_contents().$dataf;
                ob_end_clean();
                file_put_contents($cachefile, $data);
                chmod($cachefile, 0777);
	}
	else {
		$data = file_get_contents($cachefile);
	}
	 return $data;
}
function normalize_ua($uastr) {
    return str_replace("_",".",str_replace(array("/","+","\n","\t")," ", strtolower($uastr)));
}

$ua_=$_SERVER['HTTP_USER_AGENT'];
if (isset($_GET['emulate']))
    $ua_=$_GET['emulate'];
$ua_=normalize_ua($ua_);

$currentbrowsers=False;
function is_outdated($uastr=False) {
    global $ua_,$currentbrowsers;
    if (!$uastr)
        $uastr=$ua_;
    if (!$currentbrowsers) {    
        $browsers_file = file_get_contents(dirname(__FILE__) . "/../browsers.json");
        $currentbrowsers = json_decode($browsers_file, true);
    }

    $vs="?(\d+[.]\d+)";
    
    $bx_=get_browserx($uastr);
    $browid=$bx_[0];
    $brown=$bx_[1];
    $browver=$bx_[2];
    
    
    if($browver<currentv($browid))
        return true;
}

function has($t) {
	global $ua_;
	return !(strpos($ua_,$t)===false);
}

function currentv($browser,$set="desktop"){
    global $currentbrowsers;
    if (!$currentbrowsers) {        
        $browsers_file = file_get_contents("browsers.json");
        $currentbrowsers = json_decode($browsers_file, true);
    }
    return $currentbrowsers["current"][$set][$browser];
}

function countSites() {
    require_once("config.php");
    $r = mysql_query("SELECT COUNT(DISTINCT referer) FROM updates") or die(mysql_error(). $q);
    list($num) = mysql_fetch_row($r);
    return $num;
}
function countUpdates() {
    require_once("config.php");
    $r = mysql_query("SELECT COUNT(*) FROM updates") or die(mysql_error(). $q);
    list($num) = mysql_fetch_row($r);
    return $num;
}

function dice($percentage) {
    //
    return mt_rand(0, 100)<$percentage;
}



function get_system($ua) {
    $vs="?(\d+[.]?\d*)";
    $pats=[
        "windows phone os $vs"=>"Windows Phone",
        "windows nt $vs"=>"Windows",
        "windows $vs"=>"Windows",
        "mac os x 10.(\d*)"=>"MacOS",
        "android $vs"=>"Android",
        "android"=>"Android",
        "os $vs.*like mac OS X"=>"iOS",
        "BlackBerry $vs"=>"BlackBerry",
        "Ubuntu"=>"Ubuntu",
        "Linux"=>"Linux"
    ];
    $ua_r=  str_replace("_", ".", $ua);
    $names=["4.0"=>"NT 4.0","5.0"=>"2000","5.1"=>"XP","5.2"=>"Server 2003","6.0"=>"Vista","6.1"=>"7","6.2"=>"8","6.3"=>"8.1"];
    foreach($pats as $k =>$v) {
        if(preg_match("#".$k."#i", $ua_r, $regs)) {
            $ver=$regs[1];
            $displayname=$v."&nbsp;".$ver;
            $shortname=substr($v,0,1);
            if ($v=="Windows" && isset($names[$ver])) {
                $displayname=$v."&nbsp;".$names[$ver];
            }
            if ($v=="MacOS") {
                $displayname=$v."&nbsp;10.".$regs[1];
            }
            if ($v=="Windows Phone") {
                $shortname="P";
            }
            return array($v,$ver,$displayname,$shortname);
        }
    }
    return array("other system",0,"other&nbsp;system","?");
}

function get_browserx($ua) {
    $pats=[
        ["Trident.*rv:VV","i"],
        ["Trident.VV","io"],
        ["MSIE.VV","i"],
        ["Edge.VV","e"],
        ["OS VV.*like mac","iOS"],
        ["Vivaldi.VV","vivaldi"],
        ["UCBrowser.VV","uc"],
        ["OPR.VV","o"],
        ["YaBrowser.VV","yandex"],
        ["Chrome.VV","c"],
        ["Firefox.VV","f"],
        ["Android.*Webkit.VV","a"],
        ["Version.VV.{0,10}Safari","s"],
        ["Safari.VV","so"],
        ["Opera.*Version.VV","o"],
        ["Opera.VV","o"],
        ["Netscape.VV","n"]
    ];
    $names=[
        'i'=>'Internet Explorer',
        'e'=>"Edge",
        'f'=>'Firefox',
        'o'=>'Opera',
        's'=>'Safari',
        'n'=>'Netscape',
        'c'=>"Chrome",
        'a'=>"Android Browser",
        'yandex'=>"Yandex Browser",
        'vivaldi'=>"Vivaldi",
        'uc'=>"UC Browser",
        'x'=>"other"];
    $id="x";
    foreach($pats as $el) {
        $na=$el[1];
        $pa=str_replace("VV","?(\d+[.]?\d*)",$el[0]);
        if(preg_match("#".$pa."#i", $ua, $regs)) {
            $ver=$regs[1];
            $id=$na;
            if ($id=="vivaldi"||$id=="yandex"||$id=="uc") { //these browser use semver version numbers, add leading zeros to the minor version
                $parts=explode(".",$ver);        
                $ver=floatval($parts[0] . "." . str_pad($parts[1], 2, "0", STR_PAD_LEFT));
            }            
            break;
        }        
    }
    if ($id=="x")
        $ver=0;
    if ($id=="io")
        $id="i";
    if ($id=="so")
        $id="s";
    return [$id,$names[$id],$ver];
}

function get_full_locale() {
    //tries to get full locale. But it may be only the language
    if (isset($_GET["lang"]) && strlen($_GET["lang"])>1)
        if (strlen($_GET["lang"])==5)
            return $_GET["lang"];
        else
            return request_lang();
    else
        $lll = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    
    $lll = explode (",", $lll);
    $lll = explode (";", $lll[0]);
    return substr($lll[0],0,5);
}

function get_country() {
    $ll = trim(strtolower(get_full_locale()));
    if(strlen($ll)==5) {
        $ll = substr($ll, 3, 2);
    }
    return $ll;
}

function get_lang() {
    $ll = trim(strtolower(get_full_locale()));
    if(strlen($ll)==5) {
        $ll = substr($ll, 0, 2);
    }
    return $ll;    
}
 