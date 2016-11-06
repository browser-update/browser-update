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

$__uastr=str_replace(array("/","+","_","\n","\t")," ", strtolower($_SERVER['HTTP_USER_AGENT']));
function det($str, $version) {
    global $__uastr;
    if(!preg_match("#".$str."#", $__uastr, $regs))
        return false;
    return $regs[1]<$version;
}
$currentbrowsers=False;

function is_outdated() {
    global $currentbrowsers;
    if (!$currentbrowsers) {        
        $browsers_file = file_get_contents("browsers.json");
        $currentbrowsers = json_decode($browsers_file, true);
    }

    $vs="?(\d+[.]\d+)";
    if(det("opr.$vs",39)||
            det("opera.*version $vs",39)||
            det("trident.$vs",9)||
            det("trident.*rv:$vs",10)||
            det("msie $vs",11)||
            det("firefox $vs",49)||
            det("version $vs.*safari",10)||
            det("chrome.$vs",53))
        return true;
}

function currentv($browser,$set="desktop"){
    global $currentbrowsers;
    if (!$currentbrowsers) {        
        $browsers_file = file_get_contents("browsers.json");
        $currentbrowsers = json_decode($browsers_file, true);
    }
    return $currentbrowsers["current"][$set][$browser];
}

#"it,sl,jp,nb,ch"
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
?>
