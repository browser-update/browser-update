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




<div class="noti">
    <p>User-Agent-String:<?php echo $_SERVER['HTTP_USER_AGENT'];?></p>
    <p id="det"></p>
	<p>Lang: <?php echo $_SERVER['HTTP_ACCEPT_LANGUAGE'];?></p>
</div>

<script type="text/javascript">
var br=getBrowser();
var aaa="";
if (br.donotnotify)
    aaa="<br/>Not notified because: "+ br.donotnotify;
document.getElementById('det').innerHTML=br.t+aaa;
</script>

<?php include("footer.php");?>
