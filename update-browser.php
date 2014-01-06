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


$slimmed=true;
require_once("lib/init.php");
require_once("lib/lang.php");


if (!$newtrans) {
    header("Location: update.html");
    exit;
}
    

include("header.php");

$ua=str_replace(array("/","+","_","\n","\t",".")," ", strtolower($_SERVER['HTTP_USER_AGENT']));
function has($t) {
	global $ua;	
	return !(strpos($ua,$t)===false);
}

//not complete list but 99% of systems share where ie10 is not available
//IE 09 is available for vista and up
//IE 10 is only available for win7 and win8 || has("windows nt 6.0")
//IE 11 is only available for win7 and win8 || has("windows nt 6.0")
// 5->2000/xp/2003 6.0->vista, 6.1->win7, 6.2->win8, 6.3->win 8.1
$no_ie = has("mac os") || has("linux");
$no_ie_system = has("windows nt 4") || has("windows nt 5") || has("windows nt 6 0")|| has("mac os") || has("linux");
$no_sa = !has("mac os");
$no_sa_system =  has("os x 10 4") || has("os x 10 5") || has("os x 10 6") || has("os x 10 7");
#echo $no_sa;
#
//$u_sa="http://www.apple.com/safari/";
$sa_map=array("en"=>"","sv"=>"se","ja"=>"jp","sl"=>"si","uk"=>"ua","rm"=>"de","da"=>"dk","ca"=>"es");
$u_sa=sprintf("https://itunes.apple.com/%s/app/os-x-mavericks/id675248567?mt=12&uo=4",$ll);
if (isset($sa_map[$ll]))
    $u_sa=sprintf("https://itunes.apple.com/%s/app/os-x-mavericks/id675248567?mt=12&uo=4",$sa_map[$ll]);

$u_ff="http://www.mozilla.com/firefox/";
$u_op="http://www.opera.com/browser/";
$u_ch=sprintf("http://www.google.com/chrome?hl=%s",$ll);
$u_ie=sprintf("http://windows.microsoft.com/%s/internet-explorer/downloads/ie",str_replace("_","-",$detected_lang));
?>




<div class="noti">
<h2 class="whatnow">
    <b><?php echo T_('Your browser is out-of-date. Please download one of these up-to-date, free and excellent browsers:');?></b>
</h2>

<table class="logos">
    <tr>
    <td class="b bf">
        <a class="l" href="<?php echo $u_ff;?>" target="_blank" onmousedown="countBrowser('f')"><span class="bro">Firefox</span>   
        <span class="vendor">Mozilla Foundation</span></a>
    </td>
    <td class="b bo">
        <a class="l" href="<?php echo $u_op;?>" target="_blank" onmousedown="countBrowser('o')"><span class="bro">Opera</span>   
        <span class="vendor">Opera Software</span>  </a>
    </td>
    <td class="b bc">
        <a class="l" href="<?php echo $u_ch;?>" target="_blank" onmousedown="countBrowser('c')"><span class="bro">Chrome</span>   
        <span class="vendor">Google</span>           </a>
    </td>
    <?php if ($no_sa_system) {?>
    <td class="b bs">
        <a class="l notavailable"><span class="bro">Safari</span>   
        <span class="vendor">Apple</span>   
        <span class="na"><?php echo T_('Most recent version not available for your system.');?> <?php echo T_('Please choose another browser.'); ?> </span>
        </a>
    </td>
    <?php } else if ($no_sa) {?>
    <?php } else {?>
    <td class="b bs">
        <a class="l" href="<?php echo $u_sa;?>" target="_blank" onmousedown="countBrowser('s')"><span class="bro">Safari</span>   
        <span class="vendor">Apple</span>         </a>
    </td>
    <?php } if ($no_ie) {?>
    <?php } else if ($no_ie_system) {?>
    <td class="b bi">
        <a class="l notavailable"><span class="bro">Internet Explorer 11</span>   
        <span class="vendor">Microsoft</span>   
        <span class="na"><?php echo T_('Most recent version not available for your system.');?> <?php echo T_('Please choose another browser.'); ?> </span>
        </a>
    </td>      
    <?php } else {?>
    <td class="b bi">
        <a class="l" href="<?php echo $u_ie;?>" target="_blank" onmousedown="countBrowser('i')"><span class="bro">Internet Explorer</span>   
        <span class="vendor">Microsoft</span>        </a>
    </td>
    <?php }?>

    </tr>
</table>
    
<h2 class="whatnow"> 
    <?php echo sprintf(T_('For more <a href="%s">security</a>,    <a href="%s">speed</a>,    <a href="%s">comfort</a> and    <a href="%s">fun</a>.'),'#security','#speed','#comfort','#fun');?>
</h2>
</div>

<?php
if ($ll=="de" && mt_rand(0, 30)==0) {
?>
<div class="adc">
    <?php echo T_("Advertisement");?>
    <div class="ad">
        <script async
        src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- BU-CAD1 -->
        <ins class="adsbygoogle"
             style="display:inline-block;width:300px;height:250px"
             data-ad-client="ca-pub-6685985339905097"
             data-ad-slot="5009871584"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>        
        
    </div>
</div>
<?php }
else if ($ll=="de" && mt_rand(0, 1)==0) {
?>
<div class="adc">
    <?php echo T_("Advertisement");?>
    <div class="ad">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- BU-Image-CAD -->
        <ins class="adsbygoogle"
             style="display:inline-block;width:300px;height:250px"
             data-ad-client="ca-pub-6685985339905097"
             data-ad-slot="7819966782"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>      
    </div>
</div>
<?php }?>

<?php
if (false) {
    //for translations
    //T_(Der Download erfolgt von der Herstellerwebseite.);
?>
<div class="example">
        <?php echo sprintf(T_('Your browser (%s) is <b>out of date</b>. ' .
        'It has known <b>security flaws</b> and may <b>not ' .
        'display all features</b> of this and other websites. ' .
        '<a%s>Learn how to update your browser</a>'),'Internet Explorer 6',' href="update.html"');?>
</div>
<?php
}
?>


<div>
    <h2><?php echo T_('Why do I need an up-to-date browser?'); ?></h2>
        <div>
                <ul class="advantages">
                        <li class="security" id="security">
                                <h3><?php echo T_('Security'); ?></h3>
                                <div><?php echo T_('Newer browsers protect you better against scams, viruses, trojans, phishing and other threats. They also fix security holes in your current browser!'); ?></div>
                        </li>
                        <li class="speed" id="speed">
                                <h3><?php echo T_('Speed'); ?></h3>
                                <div><?php echo T_('Every new browser generation improves speed'); ?></div>
                        </li>
                        <li class="compatibility" id="fun">
                                <h3><?php echo T_('Compatibility'); ?></h3>
                                <div><?php echo T_('Websites using new technology will be displayed more correctly'); ?></div>
                        </li>
                        <li class="comfort" id="comfort">
                                <h3><?php echo T_('Comfort &amp; better experience'); ?></h3>
                                <div><?php echo T_('With new features, extensions and better customisability, you will have a more comfortable web-experience'); ?></div>
                        </li>
                </ul>
        </div>



        <div>
                <h2><?php echo T_('Why this website?'); ?></h2>
                <p>
                        <?php echo T_('This website is an initiative by webdesigners, webmasters and bloggers who want to bring the web further and help their visitors.'); ?>
                </p>
                <p>
                        <?php echo T_('Outdated browsers are a <b>security threat</b> and are <b>blocking the advancement of the web</b> because of their limited features and many <b>bugs</b>.'); ?>
                </p>
                <p>
                    <a href="./"><?php echo T_('More information about the Project Browser-Update.org'); ?></a>
                </p>
        </div>


        <h2><?php echo T_('"I\'m not able to update my browser"'); ?></h2>
        <p><?php echo T_('If you can\'t change your browser because of compatibility issues, think about installing a second browser for browsing and keep the old one for the compatibility.'); ?></p>
        <p><?php echo T_('If you are on a computer that is maintained by an admin and you cannot install a new browser, ask your admin about it.'); ?></p>

</div>


<script type="text/javascript">
var cv=2;
var second=false;

function countBrowser(to) {
        var f=getBrowser();
        if ((f.n=="f" && f.v>=3.6) ||
            (f.n=="o" && f.v>=10.5) ||
            (f.n=="s" && f.v>=5) ||
            (f.n=="i" && f.v>=8))
            return;
        var s="";
        if (second)
            s="&second=1";
        var i=new Image();
        i.src="/count.php?cv="+cv+"&tv="+window.location.hash.substr(1, 3)+"&ref="+escape((document.referrer||"").substring(0,35))+"&from="+f.n+"&fromv="+f.v+"&to="+to + s + "&rnd="+Math.random();
        second=true;
        //console.log(i.src, f);
}
function getBrowser() {
    var n,v,t,ua = navigator.userAgent;
    var names={i:'Internet Explorer',f:'Firefox',o:'Opera',s:'Apple Safari',n:'Netscape Navigator', c:"Chrome", x:"Other"};
    if (/bot|googlebot|slurp|mediapartners|adsbot|silk|android|phone|bingbot|google web preview|like firefox|chromeframe|seamonkey|opera mini|min|meego|netfront|moblin|maemo|arora|camino|flot|k-meleon|fennec|kazehakase|galeon|android|mobile|iphone|ipod|ipad|epiphany|rekonq|symbian|webos/i.test(ua)) n="x";
    else if (/Trident.*rv:(\d+\.\d+)/i.test(ua)) n="i";
    else if (/Trident.(\d+\.\d+)/i.test(ua)) n="io";
    else if (/MSIE.(\d+\.\d+)/i.test(ua)) n="i";
    else if (/OPR.(\d+\.\d+)/i.test(ua)) n="o";
    else if (/Chrome.(\d+\.\d+)/i.test(ua)) n="c";
    else if (/Firefox.(\d+\.\d+)/i.test(ua)) n="f";
    else if (/Version.(\d+.\d+).{0,10}Safari/i.test(ua))	n="s";
    else if (/Safari.(\d+)/i.test(ua)) n="so";
    else if (/Opera.*Version.(\d+\.?\d+)/i.test(ua)) n="o";
    else if (/Opera.(\d+\.?\d+)/i.test(ua)) n="o";
    else if (/Netscape.(\d+)/i.test(ua)) n="n";
    else return {n:"x",v:0,t:names[n]};
    
    if (/windows.nt.5.0|windows.nt.4.0|windows.98|os x 10.4|os x 10.5|os x 10.3|os x 10.2/.test(ua)) n="x";
    
    if (n=="x") return {n:"x",v:0,t:names[n]};
    
    v=new Number(RegExp.$1);
    if (n=="so") {
        v=((v<100) && 1.0) || ((v<130) && 1.2) || ((v<320) && 1.3) || ((v<520) && 2.0) || ((v<524) && 3.0) || ((v<526) && 3.2) ||4.0;
        n="s";
    }
    if (n=="i" && v==7 && window.XDomainRequest) {
        v=8;
    }
    if (n=="io") {
        n="i";
        if (v>6) v=11;
        else if (v>5) v=10;
        else if (v>4) v=9;
        else if (v>3.1) v=8;
        else if (v>3) v=7;
        else v=9;
    }	
    return {n:n,v:v,t:names[n]+" "+v}
}



function countView() {
        var f=getBrowser();
        if ((f.n=="f" && f.v>=3.6) ||
            (f.n=="o" && f.v>=10.5) ||
            (f.n=="s" && f.v>=5) ||
            (f.n=="i" && f.v>=8))
            return;
        var i=new Image();
        i.src="/countchoice.php?cv="+cv+"&tv="+window.location.hash.substr(1, 3)+"&ref="+escape((document.referrer||"").substring(0,35))+"&from="+f.n+"&fromv="+f.v+ "&rnd="+Math.random();
}

countView();

</script>

<?php include("footer.php");?>
