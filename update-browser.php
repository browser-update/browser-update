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

$ua=str_replace("_",".",str_replace(array("/","+","\n","\t")," ", strtolower($_SERVER['HTTP_USER_AGENT'])));
function has($t) {
	global $ua;
	return !(strpos($ua,$t)===false);
}


function get_system($ua) {
    $vs="?(\d+[.]?\d*)";
    $pats=[
        "windows phone os $vs"=>"Windows Phone",
        "windows nt $vs"=>"Windows",
        "windows $vs"=>"Windows",
        "mac os x $vs"=>"Mac OS",
        "android $vs"=>"Android",
        "os $vs like mac OS X"=>"iOS",
        "BlackBerry $vs"=>"BlackBerry",
        "Ubuntu"=>"Ubuntu",
        "Linux"=>"Linux"
    ];
    $names=["4.0"=>"NT 4.0","5.0"=>"2000","5.1"=>"XP","5.2"=>"Server 2003","6.0"=>"Vista","6.1"=>"7","6.2"=>"8","6.3"=>"8.1"];
    foreach($pats as $k =>$v) {
        if(preg_match("#".$k."#i", $ua, $regs)) {
            if (isset($names[$regs[1]])) 
                return array($v,$regs[1],$v." ".$names[$regs[1]]);
            return array($v,$regs[1],$v." ".$regs[1]);
        }
    }
    return array("other system","?","other system");
}

function get_browser($ua) {
    $pats=[
        ["Trident.*rv:VV","i"],
        ["Trident.VV","io"],
        ["MSIE.VV","i"],
        ["Edge.VV","e"],
        ["Vivaldi.VV","v"],
        ["OPR.VV","o"],
        ["YaBrowser.*Chrome.VV","y"],
        ["Chrome.VV","c"],
        ["Firefox.VV","f"],
        ["Version.VV.{0,10}Safari","s"],
        ["Safari.VV","so"],
        ["Opera.*Version.VV","o"],
        ["Opera.VV","o"],
        ["Netscape.VV","n"]
    ];
    $names=[
        'i'=>'Internet Explorer',
        'e'=>"Edge",
        'f'=>'Firefox',
        'o'=>'Opera',
        's'=>'Safari',
        'n'=>'Netscape',
        'c'=>"Chrome",
        'a'=>"Android Browser",
        'y'=>"Yandex Browser",
        'v'=>"Vivaldi",
        'x'=>"Other"];
    $name="";
    foreach($pats as $el) {
        $na=$el[1];
        $pa=str_replace("VV","?(\d+[.]?\d*)",$el[0]);
        if(preg_match("#".$pa."#i", $ua, $regs)) {
            $ver=$regs[1];
            $name=$na;
            break;
        }        
    }
    if ($name=="")
        return "other";
    if ($name=="io")
        $name="i";
    if ($name=="so")
        $name="s";
    return $names[$name];
}

$brown=get_browser($ua);
function is($name) {
    global $brown;
    if ($brown==$name);
        return True;
    return False;
}

$sysx=get_system($ua);
$sys=$sysx[0];
$ver=$sysx[1];
$sysn=$sysx[2];

$u_ff="https://www.mozilla.com/firefox/";
$u_op="https://www.opera.com/?utm_medium=roc&utm_source=team23_de&utm_campaign=browser-update_org";
$u_ch="https://www.google.com/chrome/browser/desktop/";
$u_ie=sprintf("https://www.microsoft.com/%s/windows/microsoft-edge",$lr);

 
function brow($name, $url, $vendor, $char, $na=False,$add="") {
    global $choiceversion,$ll;
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
    echo $add;
    /*
    if (!$na && $ll="en" && dice(10)) {
        $choiceversion="down"; 
        echo '<span class="download" style="border-radius: 2px;        background-color: rgb(69,190,98);        padding: 4px;        color: #fff;        text-decoration: none;        font-size: 13px;">Download</span><style>a .vendor {margin-bottom: 6px;}</style>';
    }
    */
    
    echo '
        </a>
    </td> 
    ';
}

if (False) {
    echo T_("Checking if your browser is up-to-date ..."); //Just for the translation right now
    
    //How can I update?
}

function m_ancient_os() {
    echo '<h2 class="whatnow"><b>';
    echo T_('Your browser is out-of-date.');
    echo sprintf(T_('On top your operating system (%s) is so old and unsecure that there is no up-to date browser available.'),$sysn);
    echo T_('Please update your operating system');
    echo '</b></h2>';
}
function m_discontinued() {
    global $sysn,$brown;
    echo '<h2 class="whatnow"><b>';
    echo sprintf(T_('Your browser, %s, is out-of-date and it is discontinued by the vendor for %s.'),
            '<span class="curb">'.$brown.'</span>',
            $sysn
    );
    echo T_('Please download one of these up-to-date, free and excellent browsers:');
    //echo T_('Please download one of these alternative up-to-date, free and excellent browsers, which are even better:');
    echo '</b></h2>';
}
function m_uptodate() {
    echo '<h2 class="whatnow"><b>';
    echo T_('Your browser is up-to-date.');
    echo '</b></h2>';
}
function m_outofdate() {
    echo '<h2 class="whatnow"><b>';
    echo T_('Your browser is out-of-date.');
    echo T_('Please download one of these up-to-date, free and excellent browsers:'); 
    echo '</b></h2>';
}
?>
<div class="noti">
<?php
if (!is_outdated() and !filter_input(INPUT_GET, 'force_outdated')) {
    m_uptodate();
} else {
?>
<table class="logos">
    <tr>
        <?php
        if ($sys=="Windows") {
            // 5->2000/5.x=>xp/2003 6.0->vista, 6.1->win7, 6.2->win8, 6.3->win 8.1            
            if ($ver<5.1) {#before xp
                m_ancient_os();
            }
            else if ($ver<=6) {#xp,vista
                if (is("Chrome")|| is("Internet Explorer")||is("Opera"))
                    m_discontinued();
                else
                    m_outofdate();
                brow("Cliqz Browser","https://cliqz.com/","Cliqz","cl");
                brow("Firefox",$u_ff,"Mozilla Foundation","f");                
                if (is("Chrome"))
                    brow("Chrome",$u_ch,"Google","c",True);
                if (is("Internet Explorer"))
                    brow("Edge",$u_ie,"Microsoft","i",True);
                if (is("Opera"))                
                    brow("Opera",$u_op,"Opera Software","o",True);
            }
            else {
                if (is("Internet Explorer") && $ver<10)
                    m_discontinued();
                else
                    m_outofdate();
                brow("Firefox",$u_ff,"Mozilla Foundation","f");
                brow("Opera",$u_op,"Opera Software","o",True);
                brow("Chrome",$u_ch,"Google","c");
                if (is("Internet Explorer"))
                    brow("Edge",$u_ie,"Microsoft","i",$ver<10);                
            }
        }
        if ($sys=="Mac OS") {
            $u_sa=sprintf("https://support.apple.com/de-de/HT204416",strtolower($lr));           
            brow("Firefox",$u_ff,"Mozilla Foundation","f",$ver<=10.9);
            brow("Opera",$u_op,"Opera Software","o",$ver<=10.9);
            brow("Chrome",$u_ch,"Google","c",$ver<=10.9);            
            brow("Safari",$u_sa,"Apple","s",$ver<=10.10);
        }
        if ($sys=="Android") {
            $u_ff="https://play.google.com/store/apps/details?id=org.mozilla.firefox";
            $u_op="https://www.opera.com/mobile/operabrowser?utm_medium=roc&utm_source=team23_de&utm_campaign=browser-update_org";
            $u_ch="https://play.google.com/store/apps/details?id=com.android.chrome";            
            if ($ver<4.0) {
                m_ancient_os();
            }
            else {
                if (is("Android Browser"))
                    m_discontinued();
                else 
                    m_outofdate();
                brow("Firefox",$u_ff,"Mozilla Foundation","f");
                brow("Opera",$u_op,"Opera Software","o",$ver<4.1);
                brow("Chrome",$u_ch,"Google","c",$ver<4.1);
            }
        }
        if ($sys=="Windows Phone") {
            $url=sprintf("https://support.microsoft.com/de-de/help/12662/windows-phone-update-your-windows-phone",strtolower($lr));
            echo sprintf(T_('On %s the built-in browser can only be updated together with the operating system.'),"Windows Phone");
            echo sprintf(T_('Please try to <a href="%s">update %s</a> to get the latest version of your browser.'),"Windows Phone",$url);
            echo T_("Or download this alternative browser:");
            brow("Opera Mini","http://www.opera.com/mobile/mini/windows","Opera Software","o");            
        }
        if ($sys=="Ubuntu"||$sys=="Linux") {            
            m_outofdate();
            brow("Firefox",$u_ff,"Mozilla Foundation","f");
            brow("Chrome",$u_ch,"Google","c");
            brow("Opera",$u_op,"Opera Software","o");
            //brow("Chromium",,"Open Source","cm");
            brow("Pale Moon","http://linux.palemoon.org/","Open Source","pa");           
        }
        if ($sys=="iOS") {
            $url=sprintf("https://support.apple.com/%s/HT204204",strtolower($lr));
            echo sprintf(T_('On %s the built-in browser can only be updated together with the operating system.'),"iPads and iPhones");
            if ($ver<=6)
                echo T_("Unfortunately, Apple has stopped supporting your device with updates.");
            else
                echo sprintf(T_('Please try to <a href="%s">update %s</a> to get the latest version of your browser.'),"iOS",$url);
        }
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
}

?>
<h2 class="whatnow">
    <?php echo sprintf(T_('For more <a href="%s">security</a>,    <a href="%s">speed</a>,    <a href="%s">comfort</a> and    <a href="%s">fun</a>.'),'#security','#speed','#comfort','#fun');?>
</h2>
</div>

<?php
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
        if (isset($_POST) && isset($_POST['feedback']) && trim($_POST['feedback'])!="") {
            $arr=$_POST;
            $arr['ua']=$_SERVER['HTTP_USER_AGENT'];
            $arr['lang']=$_SERVER['HTTP_ACCEPT_LANGUAGE'];
            $arr['ref']=$_SERVER['HTTP_REFERER'];
            $arr['date']=date('c');
            $fi = fopen("adm/raw/feedback.txt", "a") or die("Unable to open file!");
            $text=json_encode($arr,$options=JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
            fwrite($fi, ",\n".$text);
            fclose($fi);
            echo '<li>Thank you for your Feedback.</li>';
        }
        else  {
            echo '<form id="feedbackform" method="post" action="#feedbackform" onsubmit="document.getElementById(\'triedfield\').value=window.tried.join(\',\');f=$bu_getBrowser();document.getElementById(\'detectedfield\').value=f.n+f.v;"><li>Give us Feedback: I cannot/won\'t update because... ';
            if (isset($_POST) && isset($_POST['feedback'])) {
                if  (trim($_POST['feedback'])!="")
                    echo'<input name="feedback" value="'.$_POST['feedback'].'"/>';
                else
                    echo'<input name="feedback" value=""/> <span style="color:#ff0000">Please enter a reason</span>';
            }
            else {
                echo'<input name="feedback" value=""/>';
            }
            echo'<input type="hidden" name="tried" id="triedfield" value=""> <input type="hidden" name="detected" id="detectedfield" value=""><input type="hidden" name="site" value="'.$_SERVER['HTTP_REFERER'].'">&nbsp;<input type="submit" value="Send Feedback"/></li></form>';
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