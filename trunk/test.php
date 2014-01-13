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
</div>

<script type="text/javascript">
br=getBrowser();
document.getElementById('det').innerHTML=br.t;
</script>

<?php include("footer.php");?>
