<?php
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

$slimmed=true;
$extratranslation=true;
require_once("lib/init.php");
require_once("lib/lang.php");

if ($newtrans) {
    header("Location: update-browser.html");
    exit;
}

include("header.php");

$ua=strtolower($_SERVER['HTTP_USER_AGENT']);
function has($t) {
	global $ua;	
	return !(strpos($ua,$t)===false);
}

//not complete list but 99% of systems share where ie10 is not available
//IE 09 is available for vista and up
//IE 10 is only available for win7 and win8 || has("windows nt 6.0")
// 5->2000/xp/2003 6.0->vista
$no_ie = has("windows nt 4") || has("windows nt 5") || has("windows nt 6.0") || has("mac os") || has("linux");
$no_sa = !has("mac os");


$sa_map=array("en"=>"","sv"=>"se","ja"=>"jp","sl"=>"si","uk"=>"ua","rm"=>"de","da"=>"dk","ca"=>"es");
$u_sa=sprintf("https://itunes.apple.com/%s/app/os-x-mavericks/id675248567?mt=12&uo=4",$ll);
if (isset($sa_map[$ll]))
    $u_sa=sprintf("https://itunes.apple.com/%s/app/os-x-mavericks/id675248567?mt=12&uo=4",$sa_map[$ll]);

$u_ff="http://www.mozilla.com/firefox/";
$u_op="http://www.opera.com/browser/";
$u_ch=sprintf("http://www.google.com/chrome?hl=%s",$ll);
$u_ie=sprintf("http://windows.microsoft.com/%s/internet-explorer/downloads/ie",str_replace("_","-",$detected_lang));

T_textdomain('update-legacy');
?>


	<div class="right">
			<h2><?php echo T_('Free webbrowsers'); ?></h2>
			<p><?php echo T_('These browsers are the newest versions of the most used free web browsers.'); ?></p>
			<p><?php echo T_('Just choose a browser to download from the original vendor\'s website:'); ?></p>
			<ul class="browsers">
				<li class="ff">
					<h3><a href="<?php echo $u_ff;?>" target="_blank" onmousedown="countBrowser('f')">Firefox</a></h3>
					<div><?php echo T_('Widely-used open-source browser, highly extendable and customizable'); ?></div>
					<a href="<?php echo $u_ff;?>" target="_blank" onmousedown="countBrowser('f')"><?php echo T_('Download'); ?></a>
				</li>
				<li class="op">
					<h3><a href="<?php echo $u_op;?>" target="_blank" onmousedown="countBrowser('o')">Opera</a></h3>
					<div><?php echo T_('Browser with many features'); ?></div>
					<a href="<?php echo $u_op;?>" target="_blank" onmousedown="countBrowser('o')"><?php echo T_('Download'); ?></a>
				</li>
				<li class="ch">
					<h3><a href="<?php echo $u_ch;?>" target="_blank" onmousedown="countBrowser('c')">Google Chrome</a></h3>
					<div><?php echo T_('Google\'s browser with compact interface.'); ?> <?php echo T_('Automatically always up to date!'); ?></div>
					<a href="<?php echo $u_ch;?>" target="_blank" onmousedown="countBrowser('c')"><?php echo T_('Download'); ?></a>
				</li>
				<?php if ($no_sa) {} else {?>				
				<li class="sa">
					<h3><a href="<?php echo $u_sa;?>" target="_blank" onmousedown="countBrowser('s')">Safari 6</a></h3>
					<div><?php echo T_('Apple\'s fast browser'); ?></div>
					<a href="<?php echo $u_sa;?>" target="_blank" onmousedown="countBrowser('s')"><?php echo T_('Download'); ?></a>
				</li>				
				<?php } if ($no_ie) {?>
				<li class="ie notavailable">
					<h3>Internet Explorer 10</h3>
					<div>
					<?php echo T_('Not available for your System.');?> 
					<!--<?php echo T_('Only for Windows Vista or 7.');?> -->
					<?php echo T_('Please choose another browser.'); ?>
					</div>
				</li>
				<?php } else {?>
				<li class="ie">
					<h3><a href="<?php echo $u_ie;?>" target="_blank" onmousedown="countBrowser('i')">Internet Explorer 11</a></h3>
					<div><?php echo T_('Windows built-in browser'); ?></div>
					<a href="<?php echo $u_ie;?>" target="_blank" onmousedown="countBrowser('i')"><?php echo T_('Download'); ?></a>
				</li>
				<?php }?>
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
					<div><?php echo T_('Every new browser generation gets faster'); ?></div>
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
                <p><?php echo T_('If you are on a computer, that is maintained by a admin and you cannot install a new browser, ask your admin about it.'); ?></p>
		<p><?php echo T_('If you can\'t change your browser because of compatibility issues, think about installing a second browser for browsing and keep the old one for the compatibility.'); ?></p>
	</div>




<script type="text/javascript">
var cv=1;
var second=false;


countView();

</script>


<?php include("footer.php");?>