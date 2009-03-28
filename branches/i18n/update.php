<?php
require_once("lib/init.php");
require_once("lib/lang.php");
include("header.php");
?>


	<div class="right">
			<h2><?php echo t('Free webbrowsers'); ?></h2>
			<?php tt('update-browsers.php'); ?>
	</div>
	<div class="left">

		<div class="message">
			<?php tt('update-message.php'); ?>
		</div>

		<div>
			<?php tt('update-advantages.php'); ?>
		</div>
		
		<?php tt('update-action.php'); ?>
		
		<div>
			<h2><?php echo t('Why this website?'); ?></h2>
			<?php tt('update-why.php'); ?>
		</div>


		<h2><?php echo t('"I\'m not able to update my Browser"'); ?></h2>
		<?php tt('update-employee.php'); ?>
	</div>


<!--<![CDATA[]]>-->
<script type="text/javascript">


function countBrowser(to) {
		var f=getBrowser();
		//TODO: / davor
        if ((f.n=="f" && f.v>2) ||(f.n=="o" && f.v>9.6) ||(f.n=="s" && f.v>3.1) ||(f.n=="i" && f.v>7))
            return;
        var i=new Image();
		i.src="count.php?ref="+escape(document.referrer)+"&from="+f.n+"&fromv="+f.v+"&to="+to;
		//console.log(i.src);
}
	function getBrowser() {
		var n,v,t,ua = navigator.userAgent;
		var names={i:'Internet Explorer',f:'Firefox',o:'Opera',s:'Apple Safari',n:'Netscape Navigator'};
		if (/MSIE (\d+\.\d+);/.test(ua))					n="i";
		else if (/Firefox.(\d+\.\d+)/.test(ua))				n="f";
		else if (/Version.(\d+.\d+).{0,10}Safari/.test(ua))	n="s";
		else if (/Safari.(\d+)/.test(ua))					n="so";
		else if (/Opera.(\d+\.\d+)/.test(ua))				n="o";
		else if (/Netscape.(\d+)/.test(ua))					n="n";
		else return {};

		v=new Number(RegExp.$1);
		if (n=="so") {
			v=((v<100) && 1.0) || ((v<130) && 1.2) || ((v<320) && 1.3) || ((v<520) && 2.0) || ((v<524) && 3.0) || ((v<526) && 3.2) ||4.0;
			n="s";
		}
		t=names[n];
		return {n:n,v:v,t:t+" "+v}
	}

</script>


<?php include("footer.php");?>
