<?php
$slimmed=true;
$extratranslation=true;
require_once("lib/init.php");
require_once("lib/lang.php");
$choiceversion="base";
$force_outdated=filter_input(INPUT_GET, 'force_outdated');

$full_locale=get_full_locale();
if (isset($_GET['lang'])) {
    $ll = $_GET['lang'];
}
else {
    $ll = get_lang();
}

//language for IE/Safari download link: Full locale form. e.g. en-GB
if(strlen($full_locale)!=5) {
    $full_locale=$detected_lang;
}
$full_locale_minus=str_replace("_","-",$full_locale);

include("header.php");

$bx_=get_browserx($ua_);
$browid=$bx_[0];
$brown=$bx_[1];
$browver=$bx_[2];

function is($name) {
    global $brown;
    if ($brown==$name)
        return True;
    return False;
}

$sysx=get_system($ua_);
$sys=$sysx[0];
$ver=$sysx[1];
$sysn=$sysx[2];

$u_ff="https://www.mozilla.com/firefox/";
$u_op="https://www.opera.com/";
$u_ch="https://www.google.com/chrome/browser/desktop/";
$u_ie=sprintf("https://www.microsoft.com/%s/windows/microsoft-edge",$full_locale_minus);
$u_vivaldi="https://vivaldi.com/";
 
function brow($name, $url, $vendor, $char, $na=False,$add="",$add2="") {
    global $choiceversion,$ll;
    echo '<td class="b b'.$char.'">';
    if (!$na) {
        echo '<a class="l" href="'.$url.'" target="_blank" rel="noopener" title="'.sprintf(T_("Download updated %s web browser from %s website!"),$name,$vendor).'" onmousedown="countBrowser(\''.$char.'\')">';
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
        </a>'.$add2.'
    </td> 
    ';
}

if (False) {
    echo T_("Checking if your browser is up-to-date ..."); //Just for the translation right now
    
    //How can I update?
}

function m_ancient_os($system_name, $os_update_url="") {
    echo '<h2 class="whatnow"><b>';
    echo T_('Your browser is out-of-date.');
    echo '<br/>';
    echo sprintf(T_('On top of that your operating system (%s) is so old and unsecure that there is no up-to-date browser available anymore.'),$system_name);
    echo '<br/>';
    echo sprintf(T_('Please try to <a href="%s">update %s</a> to get the latest version of your browser.'),$os_update_url.'" onmousedown="countBrowser(\'os\')',$system_name);
    echo '</b></h2>';
}
function m_discontinued() {
    global $sysn,$brown;
    echo '<h2 class="whatnow"><b>';
    //echo T_('Your browser is out-of-date.');
    echo sprintf(T_('Your browser, %s, is out-of-date and it is not updated anymore for %s.'),
            '<span class="curb">'.$brown.'</span>',
            $sysn
    );
    echo '<br/>';
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
    echo '<br/>';
    echo T_('Please download one of these up-to-date, free and excellent browsers:'); 
    echo '</b></h2>';
}

function start_browserlist() {
    echo '<table class="logos" id="browserlist">    <tr>';
}

function end_browserlist() {
    echo '</tr></table>';
}


if (isset($_GET['emulate']) || $force_outdated) {
    include("update.testing.php");
}

?>
<div class="noti">
<?php
if (!is_outdated() and !$force_outdated) {
    m_uptodate();
    $choiceversion="uptod";
} else {

if ($sys=="Windows") {
    // 5->2000/5.x=>xp/2003 6.0->vista, 6.1->win7, 6.2->win8, 6.3->win 8.1            
    if ($ver<5.1 || $ver>90) {#before xp                
        $choiceversion="osup";
        $u_upwin=sprintf("https://support.microsoft.com/%s/help/14223/windows-xp-end-of-support",$full_locale_minus);
        m_ancient_os("Windows",$u_upwin);
    }
    else if ($ver<=6) {#xp,vista
        if (is("Chrome")|| is("Internet Explorer")||is("Opera"))
            m_discontinued();
        else
            m_outofdate();      
        start_browserlist();                       
        brow("Firefox",$u_ff,"Mozilla Foundation","f");
        if (is("Chrome"))
            brow("Chrome",$u_ch,"Google","c",True);
        if (is("Internet Explorer"))
            brow("Edge",$u_ie,"Microsoft","i",True);
        if (is("Opera"))                
            brow("Opera",$u_op,"Opera Software","o",True);
        end_browserlist();
    }
    else {# 7 and above
        if (is("Internet Explorer") && $ver<10)
            m_discontinued();
        else
            m_outofdate();

        start_browserlist();
        brow("Firefox",$u_ff,"Mozilla Foundation","f");
        brow("Opera",$u_op,"Opera Software","o");                
        brow("Chrome",$u_ch,"Google","c");
        if (is("Internet Explorer"))
            brow("Edge",$u_ie,"Microsoft","i",$ver<10); 
        else
            brow("Vivaldi",$u_vivaldi,"Vivaldi Technologies","vi",False,"<style>.bvi a { background-image: url('/img/big/vi.png'); background-size: 110px auto;}</style>");
        end_browserlist();
    }
}
if ($sys=="MacOS") {
    if ($ver<9) {
        if ($ll=="en")
            $u_mac="http://www.apple.com/macos/how-to-upgrade/";
        else
            $u_mac=sprintf("http://www.apple.com/%s/macos/how-to-upgrade/",$county);
        $choiceversion="osup";
        m_ancient_os("Mac OS", $u_mac);               
    }
    else {
        m_outofdate();
    }

    start_browserlist();
    $u_sa=sprintf("https://support.apple.com/%s/HT204416",strtolower($full_locale_minus));                       
    brow("Firefox",$u_ff,"Mozilla Foundation","f",$ver<9);
    brow("Opera",$u_op,"Opera Software","o",$ver<9);
    brow("Chrome",$u_ch,"Google","c",$ver<9);            
    brow("Safari",$u_sa,"Apple","s",$ver<10);
    end_browserlist();
}
if ($sys=="Android") {
    $u_ff="https://play.google.com/store/apps/details?id=org.mozilla.firefox";
    $u_op="https://play.google.com/store/apps/details?id=com.opera.browser";
    $u_ch="https://play.google.com/store/apps/details?id=com.android.chrome";

    if ($ver<1)#old firefox did not give a version info
        $ver="4.1";

    if ($ver<4.0) {
        $choiceversion="osup";
        m_ancient_os("Android");
    }
    else {
        if (is("Android Browser"))
            m_discontinued();
        else 
            m_outofdate();

        start_browserlist();
        brow("Firefox",$u_ff,"Mozilla Foundation","f");
        brow("Opera",$u_op,"Opera Software","o",$ver<4.1);
        brow("Chrome",$u_ch,"Google","c",$ver<4.1);
        if (is("UC Browser"))
            brow("UC Browser","https://play.google.com/store/apps/details?id=com.UCMobile.intl","UCWeb","uc",False,"<style>.buc a { background-image: url('/img/big/uc.png'); background-size: 110px auto;}</style>");

        end_browserlist();
    }
}
if ($sys=="Windows Phone") {
    $choiceversion="osup";
    $url=sprintf("https://support.microsoft.com/%s/help/12662/windows-phone-update-your-windows-phone",strtolower($full_locale_minus));
    echo sprintf(T_('On %s the built-in browser can only be updated together with the operating system.'),"Windows Phone");
    echo sprintf(T_('Please try to <a href="%s">update %s</a> to get the latest version of your browser.'),"Windows Phone",$url);
    //echo T_("Or download this alternative browsers:");

    start_browserlist();
    brow("Opera Mini","http://www.opera.com/mobile/mini/windows","Opera Software","o");           
    end_browserlist();
}
if ($sys=="Ubuntu"||$sys=="Linux") {            
    m_outofdate();

    start_browserlist();
    brow("Firefox",$u_ff,"Mozilla Foundation","f");
    brow("Chrome",$u_ch,"Google","c");
    brow("Opera",$u_op,"Opera Software","o");
    //brow("Chromium",,"Open Source","cm");
    //brow("Pale Moon","http://linux.palemoon.org/","Open Source","pa");   
    end_browserlist();
}
if ($sys=="iOS") {
    $url=sprintf("https://support.apple.com/%s/HT204204",strtolower($full_locale_minus));
    echo '<h2 class="whatnow"><b>'.T_('Your browser is out-of-date.')."</b></h2>";

    echo '<h2>'.sprintf(T_('On %s the built-in browser can only be updated together with the operating system.'),"iPad/iPhone").'</h2>';
    echo '<h2>';
    if ($ver<=6) {
        $choiceversion="osna";
        echo sprintf(T_("Unfortunately, %s has stopped supporting your device with updates."),"Apple");                
    }
    else {
        $choiceversion="osup";
        echo sprintf(T_('Please try to <a href="%s">update %s</a> to get the latest version of your browser.'),$url.'" onmousedown="countBrowser(\'os\')',"iOS");
    }
}
?>

<h2 class="whatnow">
    <?php echo sprintf(T_('For more <a href="%s">security</a>,    <a href="%s">speed</a>,    <a href="%s">comfort</a> and    <a href="%s">fun</a>.'),'#security','#speed','#comfort','#fun');?>
</h2>    
<?php

/*
display_browser("Yandex Browser", "https://browser.yandex.com",)
display_browser("Seamonkey", "http://www.seamonkey-project.org/releases/#2.33")
display_browser("Maxthon", "http://maxthon.com")
*/
}

?>
</div>

<?php
include("ads.php");

if (false) {
    //for translations
    T_("Advertisement");
    T_("Sponsored");
    T_('<b>Your web browser ({brow_name}) is out-of-date</b>. Update your browser for more security, comfort and the best experience on this site. <a{up_but}>Update browser</a> <a{ignore_but}>Ignore</a>');
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
        <li>Consider <a href="http://portableapps.com/apps/internet" target="_blank" rel="noopener" title="install portable browser" onmousedown="countBrowser('port')">installing a portable version of the browser</a></li>        
        <?php
        include("update.feedback.php");
    }
    ?>
    </ul>
    
    <?php
    if ($ll=="en") {
        include("update.moreinfo.php");
    }
    ?>
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