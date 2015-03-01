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


<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<!--<script type="text/javascript" src="/updatex.js">-->

<script>
var $buoop = {c:2,test:true};

function $buo_f(){ 
 var e = document.createElement("script"); 
 e.src = "//browser-update.org/update.min.js"; 
 document.body.appendChild(e);
};
try {document.addEventListener("DOMContentLoaded", $buo_f,false)}
catch(e){window.attachEvent("onload", $buo_f)}
</script>
	
	

<?php include("footer.php");?>
