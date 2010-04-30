<?php
require_once("lib/init.php");
require_once("lib/lang.php");
include("header.php");
?>


	<div class="right">
			<h2><?php echo T_('Free webbrowsers'); ?></h2>
			<p><?php echo T_('These browsers are the newest versions of the most used free web browsers.'); ?></p>
			<p><?php echo T_('Just choose a browser to download from the original vendor\'s website:'); ?></p>
			<ul class="browsers">
				<li class="ff">
					<h3><a href="http://www.mozilla.com/firefox/" onmousedown="countBrowser('f')">Firefox 3.6</a></h3>
					<div><?php echo T_('Widely-used open-source browser, highly extendable and customizable'); ?></div>
					<a href="http://www.mozilla.com/firefox/" onmousedown="countBrowser('f')"><?php echo T_('Download'); ?></a>
				</li>
				<li class="op">
					<h3><a href="http://www.opera.com/" onmousedown="countBrowser('o')">Opera 10</a></h3>
					<div><?php echo T_('Browser with many features'); ?></div>
					<a href="http://www.opera.com/" onmousedown="countBrowser('o')"><?php echo T_('Download'); ?></a>
				</li>
				<li class="sa">
					<h3><a href="http://www.apple.com/safari/" onmousedown="countBrowser('s')">Safari 4</a></h3>
					<div><?php echo T_('Apple\'s fast browser'); ?></div>
					<a href="http://www.apple.com/safari/" onmousedown="countBrowser('s')"><?php echo T_('Download'); ?></a>
				</li>
				<li class="ch">
					<h3><a href="http://www.google.com/chrome" onmousedown="countBrowser('c')">Google Chrome 4</a></h3>
					<div><?php echo T_('Google\'s browser with compact interface'); ?></div>
					<a href="http://www.google.com/chrome" onmousedown="countBrowser('c')"><?php echo T_('Download'); ?></a>
				</li>
				<li class="ie">
					<h3><a href="http://www.microsoft.com/windows/internet-explorer/default.aspx" onmousedown="countBrowser('i')">Internet Explorer 8</a></h3>
					<div><?php echo T_('Windows built-in browser'); ?></div>
					<a href="http://www.microsoft.com/windows/internet-explorer/default.aspx" onmousedown="countBrowser('i')"><?php echo T_('Download'); ?></a>
				</li>
			</ul>
			<p>
                <?php echo T_('All browsers have the same basic features and easy interface.'); ?>
                <!--We recommend all browsers but Internet Explorer due to its small
                feature set and poor webstandards support.-->
            </p>
	</div>
	<div class="left">

		<div class="message">
			<p><?php echo T_('The browser you are using is out of date. It has known <b>security flaws and disadvantages</b> and a <b>limited feature set</b>. You will not see all the features of some websites.'); ?> </p>
		</div>

		<div>
			<p><?php echo T_('Switching to a newer browser could give you a lot of advantages:'); ?></p>
			<ul class="advantages">
				<li class="security">
					<h3><?php echo T_('Security'); ?></h3>
					<div><?php echo T_('Newer browsers protect you better against scams, viruses, trojans, phishing and other threats. They also fix security holes in your current browser!'); ?></div>
				</li>
				<li class="speed">
					<h3><?php echo T_('Speed'); ?></h3>
					<div><?php echo T_('Every new browser generation improves speed'); ?></div>
				</li>
				<li class="compatibility">
					<h3><?php echo T_('Compatibility'); ?></h3>
					<div><?php echo T_('Websites using new technology will be displayed more correctly'); ?></div>
				</li>
				<li class="comfort">
					<h3><?php echo T_('Comfort &amp; better experience'); ?></h3>
					<div><?php echo T_('With new features, extensions and better customisability, you will have a more comfortable web-experience'); ?></div>
				</li>
			</ul>
		</div>
		
		<p><?php echo T_('Updating is easy, takes just a few minutes and is totally free.'); ?></p>
	
		<p><?php echo T_('If you are on a computer, that is maintained by a admin and you cannot install a new browser, ask your admin about it.'); ?></p>

		
		<div>
			<h2><?php echo T_('Why this website?'); ?></h2>
			<p>
				<?php echo T_('This website is an initiative by webdesigners, webmasters and bloggers who want to bring the web further and help their visitors.'); ?>
			</p>
			<p>
				<?php echo T_('Outdated browsers are a <b>security threat</b> and are <b>blocking the advancement of the web</b> because of their limited features and many <b>bugs</b>.'); ?>
			</p>
		</div>


		<h2><?php echo T_('"I\'m not able to update my browser"'); ?></h2>
		<p><?php echo T_('If you can\'t change your browser because of compatibility issues, think about installing a second browser for browsing and keep the old one for the compatibility.'); ?></p>
	</div>


<script type="text/javascript">


function countBrowser(to) {
		var f=getBrowser();
		//TODO: / davor
        if ((f.n=="f" && f.v>=3.7) ||
            (f.n=="o" && f.v>=10.2) ||
            (f.n=="s" && f.v>=4) ||
            (f.n=="i" && f.v>=8))
            return;
        var i=new Image();
		i.src="/count.php?ref="+escape((document.referrer||"unknown").substring(0,35))+"&from="+f.n+"&fromv="+f.v+"&to="+to;
        //console.log(i.src, f);
}
function getBrowser() {
    var n,v,t,ua = navigator.userAgent;
    var names={i:'Internet Explorer',f:'Firefox',o:'Opera',s:'Apple Safari',n:'Netscape Navigator', c:"Chrome", x:"Other"};
    if (/MSIE (\d+\.\d+);/.test(ua))					n="i";
    else if (/Arora.(\d+\.\d+)/.test(ua))               n="x";
    else if (/Chrome.(\d+\.\d+)/.test(ua))              n="c";
    else if (/Firefox.(\d+\.\d+)/.test(ua))				n="f";
    else if (/Version.(\d+.\d+).{0,10}Safari/.test(ua))	n="s";
    else if (/Safari.(\d+)/.test(ua))					n="so";
    else if (/Opera.*Version.(\d+\.\d+)/.test(ua))			n="o";
    else if (/Opera.(\d+\.\d+)/.test(ua))				n="o";
    else if (/Netscape.(\d+)/.test(ua))					n="n";
    else return {n:"x",v:0,t:names[n]};

    v=new Number(RegExp.$1);
    if (n=="so") {
        v=((v<100) && 1.0) || ((v<130) && 1.2) || ((v<320) && 1.3) || ((v<520) && 2.0) || ((v<524) && 3.0) || ((v<526) && 3.2) ||4.0;
        n="s";
    }
    if (n=="i" && v==7 && window.XDomainRequest) {
        v=8;
    }
    return {n:n,v:v,t:names[n]+" "+v}
}

</script>


<?php include("footer.php");?>
