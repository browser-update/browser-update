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

?>



<script src="update.js"></script>

<div class="noti">
    <p>User-Agent-String (Header):<span id="heua"><?php echo $_SERVER['HTTP_USER_AGENT'];?></span></p>
    <p>User-Agent-String (Javascript): <span id="jsua"></span></p>
    <p>Lang: <?php echo $_SERVER['HTTP_ACCEPT_LANGUAGE'];?></p>
    Detected Browser as:
    <p id="det"></p>        
</div>

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

</script>

<?php include("footer.php");?>
