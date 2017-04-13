<?php
//language for the download links
if (isset($_GET['lang'])) {
	$ll = $_GET['lang'];
}
else {
	$lll = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
	$lll = explode (",", $lll);
	$lll = explode (";", $lll[0]);
	$ll = trim(strtolower(substr($lll[0],0,5)));
	if(strlen($ll)==5) {
		$ll = substr($ll, 3, 2);
	}
}


require_once("lib/init.php");
require_once("lib/lang.php");
include("header.php");


$bx_=get_browserx($ua_);
$browid=$bx_[0];
$brown=$bx_[1];
$browver=$bx_[2];

$sysx=get_system($ua_);
$sys=$sysx[0];
$ver=$sysx[1];
$sysn=$sysx[2];
?>



<script src="update.js"></script>

<div class="debug">
    <h2>Identification<h2>
    <p>User-Agent-String (HTTP Header):<span id="heua"><?php echo $_SERVER['HTTP_USER_AGENT'];?></span></p>
    <p>User-Agent-String (Javascript): <span id="jsua">Error</span></p>
    
    <h2>Detection<h2>
    <p>Detected Browser as (Javascript):<span id="det">Error</span></p>      
    <p>Browser (Header): <span id=""><?php echo $brown." ". $browver . "($browid)"?></span></p>
    <p>System (Header): <span id=""><?php echo $sysn?></span></p>
    <h2>Language<h2>
    <p>Lang (HTTP Header): <span><?php echo $_SERVER['HTTP_ACCEPT_LANGUAGE']?></span></p>
    <p>Lang (Javascript): <span id="lang">Error</span></p>    
</div>
<style>
.debug span {
    display: block;
}    
</style>    

<script type="text/javascript">
var br=$bu_getBrowser();
var aaa="";
if (br.donotnotify)
    aaa+="<br/>Not notified because: "+ br.donotnotify;
if (navigator.userAgent!="<?php echo $_SERVER['HTTP_USER_AGENT']?>") {
    aaa+="<br/>Warning: Your browser is misconfigured. Identification via Javascript and and HTTP-Headers does not match!";
}
document.getElementById('det').innerHTML=br.t+aaa;
document.getElementById('jsua').innerHTML=navigator.userAgent;
document.getElementById('lang').innerHTML=$buoop.ll;
</script>

<?php include("footer.php");?>
