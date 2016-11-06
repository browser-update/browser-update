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
$extratranslation=true;
require_once("lib/init.php");
require_once("lib/lang.php");
$choiceversion="base";

//language for IE download link: Full locale form. e.g. en-GB
$lll = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
$lll = explode (",", $lll);
$lll = explode (";", $lll[0]);
$lr=$lll[0];
//echo $lr . "a" .$detected_lang . "xx";
if(strlen($lr)!=5) {
    $lr=$detected_lang;
}
$lr=str_replace("_","-",$lr);

include("header.php");

$ua=str_replace(array("/","+","_","\n","\t",".")," ", strtolower($_SERVER['HTTP_USER_AGENT']));
function has($t) {
	global $ua;
	return !(strpos($ua,$t)===false);
}

//IE 11 is only available for win7 and win8 || has("windows nt 6.0")
// 5->2000/xp/2003 6.0->vista, 6.1->win7, 6.2->win8, 6.3->win 8.1
$no_ie = has("os x") || has("linux") || has("android");
$no_ie_system = has("windows nt 4") || has("windows nt 5") || has("windows nt 6 0")|| has("os x") || has("linux");
$no_sa = !has("os x");
$no_sa_system =  has("os x 10 4") || has("os x 10 5") || has("os x 10 6") || has("os x 10 7");


//$u_sa="http://www.apple.com/safari/";
$sa_map=array("en"=>"","sv"=>"se","ja"=>"jp","sl"=>"si","uk"=>"ua","rm"=>"de","da"=>"dk","ca"=>"es");
$sal="https://itunes.apple.com/%s/app/os-x-yosemite/id915041082?mt=12";
//if (in_array($ll, array("de","es","pl","pt","fr","nl")))
//    $sal="http://clkuk.tradedoubler.com/click?p=23761&a=2364610&url=https%%3A%%2F%%2Fitunes.apple.com%%2F%s%%2Fapp%%2Fos-x-mavericks%%2Fid675248567%%3Fmt%%3D12%%26uo%%3D4%%26partnerId%%3D2003";
$u_sa=sprintf($sal,$ll);
if (isset($sa_map[$ll]))
    $u_sa=sprintf($sal,$sa_map[$ll]);

$u_ff="https://www.mozilla.com/firefox/";
$u_op="https://www.opera.com/?utm_medium=roc&utm_source=team23_de&utm_campaign=browser-update_org";
$u_ch="https://www.google.com/chrome/browser/desktop/";
$u_ie=sprintf("https://www.microsoft.com/%s/windows/microsoft-edge",$lr);

if (has("android")) {
    $u_ff="https://play.google.com/store/apps/details?id=org.mozilla.firefox";
    $u_op="https://www.opera.com/mobile/operabrowser?utm_medium=roc&utm_source=team23_de&utm_campaign=browser-update_org";
    $u_ch="https://play.google.com/store/apps/details?id=com.android.chrome";
    $no_ie=True;
}
    
function brow($name, $url, $vendor, $char, $na=False) {
    echo '<td class="b b'.$char.'">';
    if (!$na) {
        echo '<a class="l" href="'.$url.'" target="_blank" title="'.sprintf(T_("Download updated %s web browser from %s website!"),$name,$vendor).'" onmousedown="countBrowser(\''.$char.'\')">';
    }
    else {
        echo' <a class="l notavailable">';
    }
    echo '<span class="bro">'.$name.'</span>';
    echo '<span class="vendor">'.$vendor.'</span>';
    if ($na) {
        echo '
        <span class="na">'. T_('Most recent version not available for your system.').' '.
        T_('Please choose another browser.').'</span>';
    }
    echo '
        </a>
    </td> 
    ';
}

if (False) {
    echo T_("Checking if your browser is up-to-date ..."); //Just for the translation right now
}

if (!is_outdated() and !(isset($_GET['force_outdated']) and $_GET['force_outdated'])) {
?>
<div class="noti">
<h2 class="whatnow">
    <b><?php echo (T_('Your browser is up-to-date.'))?></b>
</h2>
</div>
<?php
}
else {
?>

<div class="noti">
<h2 class="whatnow">
    <b><?php echo T_('Your browser is out-of-date. Please download one of these up-to-date, free and excellent browsers:'); ?></b>
</h2>

<table class="logos">
    <tr>
        <?php
        brow("Firefox",$u_ff,"Mozilla Foundation","f");
        brow("Opera",$u_op,"Opera Software","o");
        brow("Chrome",$u_ch,"Google","c");
        if (!$no_sa)
            brow("Safari",$u_sa,"Apple","s",$no_sa_system);
        if (!$no_ie)
            brow("Edge",$u_ie,"Microsoft","i",$no_ie_system);        
        ?>
    </tr>
</table>
<?php

/*
display_browser("Yandex Browser", "https://browser.yandex.com",)
display_browser("Seamonkey", "http://www.seamonkey-project.org/releases/#2.33")
display_browser("Maxthon", "http://maxthon.com")
display_browser("Vivaldi", "https://vivaldi.com/")
*/


?>
<h2 class="whatnow">
    <?php echo sprintf(T_('For more <a href="%s">security</a>,    <a href="%s">speed</a>,    <a href="%s">comfort</a> and    <a href="%s">fun</a>.'),'#security','#speed','#comfort','#fun');?>
</h2>
</div>

<?php
}
include("ads.php");

if (false) {
    //for translations
    T_("Advertisement");
    T_("Sponsored");
    sprintf(T_('This website would like to remind you: Your browser (%s) is <b>out of date</b>. <a%s>Update your browser</a> for more security, comfort and the best experience on this site.'),'Internet Explorer 6',' href="update.html"');
    //sprintf(T_('Your browser (%s) is <b>out of date</b>. It has known <b>security flaws</b> and may <b>not display all features</b> of this and other websites. <a%s>Learn how to update your browser</a>'),'Internet Explorer 6',' href="update.html"');
}
?>

<div>
    <h2><?php echo T_('Why do I need an up-to-date browser?'); ?></h2>
    <div id="advc">
        <ul class="advantages">
            <li class="security" id="security">
                <h3><?php echo T_('Security'); ?></h3>
                <div><?php echo T_('Newer browsers protect you better against viruses, scams and other threats. Outdated browsers have security holes which are fixed in updates.')?></div>
            </li>
            <li class="speed" id="speed">
                <h3><?php echo T_('Speed'); ?></h3>
                <div><?php echo T_('Every new browser generation improves speed')?></div>
            </li>
            <li class="compatibility" id="fun">
                <h3><?php echo T_('Compatibility & new Technology')?></h3>
                <div><?php echo T_('You can view sites that are using the latest technology')?></div>
            </li>
            <li class="comfort" id="comfort">
                <h3><?php echo T_('Comfort & better experience')?></h3>
                <div><?php echo T_('Have a more comfortable experience with new features, extensions and better customisability.')?></div>
            </li>
        </ul>
    </div>

    <div>
        <h2><?php echo T_('Why this website?')?></h2>
        <p>
            <?php echo T_('This is an initiative by websites and blogs to raise security awareness and bring forward the web.'); ?>
            <a href="./"><?php echo T_('About the Project')?></a>
        </p>
    </div>


    <h2><?php echo T_('I can\'t update my browser')?></h2>
    <ul>
    <li><?php echo T_('If you can\'t change your browser because of compatibility issues, think about installing a second browser for browsing and keep the old one for compatibility.'); ?></li>
    <li><?php echo T_('Ask your admin to update your browser if you cannot install updates yourself.')?></li>
    <?php
    if ($ll=="en") {
        ?>
            <li>Consider <a href="http://portableapps.com/apps/internet" target="_blank" title="install portable browser" onmousedown="countBrowser('port')">installing a portable version of the browser</a></li>
        <?php        
        if (isset($_POST) && isset($_POST['feedback'])) {
            $arr=$_POST;
            $arr['ua']=$_SERVER['HTTP_USER_AGENT'];
            $arr['lang']=$_SERVER['HTTP_ACCEPT_LANGUAGE'];
            $arr['ref']=$_SERVER['HTTP_REFERER'];
            $fi = fopen("adm/raw/feedback.txt", "a") or die("Unable to open file!");
            $text=json_encode($arr,$options=JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
            fwrite($fi, ",\n".$text);
            fclose($fi);
            echo '<li>Thank you for your Feedback.</li>';
        }
        else  {
            echo '<form method="post" onsubmit="document.getElementById(\'triedfield\').value=window.tried.join(\',\');f=$bu_getBrowser();document.getElementById(\'detectedfield\').value=f.n+f.v;"><li>Give us Feedback: I cannot update because... <input name="feedback" value=""/><input type="hidden" name="tried" id="triedfield" value=""> <input type="hidden" name="detected" id="detectedfield" value=""><input type="hidden" name="site" value="'.$_SERVER['HTTP_REFERER'].'">&nbsp;<input type="submit" value="Send Feedback"/></li></form>';
        }
    }
    ?>
    </ul>
    

</div>
<script>
var $buoop = {nomessage:true};    
</script>
<script src="/update.min.js"></script>
<script>
var cv="<?php echo $choiceversion;?>";
var second=false;
countView();
</script>
<div class="cookiebar" id="cookiebar"><?php echo T_('This website uses cookies')?> <a onclick="document.getElementById('cookiebar').style.display='none'"><?php echo T_('Close'); ?></a></div>
<?php 
include("footer.php");
?>
