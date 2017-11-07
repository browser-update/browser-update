<?php
require_once("lib/init.php");

$apiver=5;

//rederict people coming from search engines that have outdated browsers to the update page
if (preg_match('#(\.|/)(google|bing|yahoo)\.#i',$_SERVER['HTTP_REFERER'])
        &&
        !preg_match('#bot|googlebot|slurp|mediapartners|adsbot|silk|android|phone|bingbot|google web preview|like firefox|chromeframe|seamonkey|opera mini|min|meego|netfront|moblin|maemo|arora|camino|flot|k-meleon|fennec|kazehakase|galeon|android|mobile|iphone|ipod|ipad|epiphany|rekonq|symbian|webos#i',$_SERVER['HTTP_REFERER'])
        ) {
    if (is_outdated()) {
        header("Location: update-browser.html#2");
        exit;
    }
}

require_once("lib/lang.php");
T_textdomain('site');
$title=T_("Notifies visitors to update their browser");
T_textdomain('update');
include("header.php");
?>
    
<div class="message">
    <p id="mainmessage">
    <?php echo (T_("Browser-update.org is a tool to unobtrusively notify visitors that they should update their web browser in order to use your website."))?>
    </p>
    <p>
    <?php echo (T_("This is done with care not to annoy, lock out or erroneously notify visitors!"))?>
    </p>    
</div>

<div class="numbs">
    <p>
        <?php echo sprintf(str_replace('%d','%s',T_('<b>%s</b> sites are using this notification')), number_format(intval(cache_output('countSites')),0,".", " ")) ?>
    </p>
    <p>
        <?php echo sprintf(str_replace('%d','%s',T_('<b>%s</b> visitors have already updated their browser')), number_format(intval(cache_output('countUpdates')),0,".", " ")) ?>
    </p>
</div>
    
<h2><?php echo T_('How it works')?></h2>
<ol class="steps">
    <li>
        <?php echo sprintf(T_('Include our small javascript <a href="%s">notification</a> on your website'), '#install')?>
    </li>
    <li>
        <?php echo T_('Visitors with out-dated browser will be informed by a small, undisturbing message box, that their browser is not up-to-date and it is recommended to update.')?>
        (<a href="#test-bu" onclick="test_bar()"><?php echo T_('Try it out!')?></a>)
        <div class="example">
            <div><?php          
            
            T_textdomain('update');
            $str_='<b>Your web browser ({brow_name}) is out-of-date</b>. Update your browser for more security, comfort and the best experience on this site. <a{up_but}>Update browser</a> <a{ignore_but}>Ignore</a>'; 
            if (is_translated($str_)) {
                $tt=T_ig($str_);
                $tt=str_replace('{brow_name}', 'Internet Explorer 6', $tt);
                $tt=str_replace('{ignore_but}', ' id="buorgig"', $tt);
                $tt=str_replace('{up_but}', ' href="update.html?force_outdated=true"', $tt);
                echo $tt;
                T_textdomain('site');
            }
            else
                echo sprintf(T_ig('Your browser (%s) is <b>out of date</b>. It has known <b>security flaws</b> and may <b>not display all features</b> of this and other websites. <a%s>Learn how to update your browser</a>'),'Internet Explorer 6',' href="update.html?force_outdated=true"');
            ?>
            </div>
        </div>
    </li>
    <li>
        <?php echo sprintf(T_('By clicking the message, they will get to an <a href="%s">info page with reasons why to update (or change) and a list of browsers</a> available for their system.'), 'update.html?force_outdated=true')?>
        <div style="text-align: center"><a href="update.html?force_outdated=true" title="<?php T_textdomain('update'); echo T_ig('update browser'); T_textdomain('site');?>"><img alt="download firefox/internet explorer/chrome/opera to update your browser" src="/img/shot update.png" style="width:400px"/></a></div>
    </li>
    <li>
        <?php echo T_('If the visitor ignores the advice, it won\'t reappear for some time.')?>
    </li>
</ol>
                
<h2><?php echo T_('Advantages and features')?></h2>
<ul class="advantages">
    <li>
        <h3><?php echo T_('Unobtrusive')?></h3>
        <?php echo T_('The user will be notified only once a day by default. The notification is small and does not block the user from using the site.'); ?>
    </li>
    <li>
        <h3><?php echo T_('Low maintenance and up-to-date')?></h3>
        <?php echo T_('We take care not to erroneously notify users by constantly tweaking and improving the detection code. Users are presented with an up-to-date list of browsers that are available for their system.')?>
    </li>
    <li>
        <h3><?php echo T_('Customizable')?></h3>
            <?php echo sprintf(T_('You can <a href="%s">customize</a> the style of the message, the text and other options.'), 'customize.html')?>
    </li>
    <li>
        <h3><?php echo T_('Localized')?></h3>
        <?php echo T_('The message is automatically displayed in the user\'s language.')?>
    </li>
</ul>

<h2 id="install"><?php echo T_('Install the browser update notification on your site')?></h2>
<p>
    <?php echo T_('Just include this code anywhere in the source of your page.')?>
</p>
		
<div class="generate">


<textarea id="f-code" rows="9">&lt;script>
var $buoop = {api:<?php echo $apiver?>};
function $buo_f(){ 
 var e = document.createElement("script"); 
 e.src = "//browser-update.org/update.min.js"; 
 document.body.appendChild(e);
};
try {document.addEventListener("DOMContentLoaded", $buo_f,false)}
catch(e){window.attachEvent("onload", $buo_f)}
&lt;/script></textarea>
<p><?php echo T_('The following browsers will be notified:')?></p>
<?php
function p_dates($browserid,$default) {
    /*
    $releases_per_month=array('f'=>7/12,'c'=>8/12,'o'=>8/12,'i'=>1,'s'=>1,'v'=>8/12*0.1);
    foreach (array(3,6,12,24) as $ms) {
        p_month($ms,currentv($browserid)-int($ms*$releases_per_month[$browserid]),$ms==-$default);
    }
    */
    $tt=sprintf(T_('Every outdated version'));
    echo '<option value="'.(-0.01).'"' .($default==-0.01 ? 'selected' : '').'>'.$tt.'</option>';  
    
    foreach (array_reverse(range(currentv($browserid)-6,currentv($browserid)-1)) as $v) {
        p_ver($v,$v==-$default);
    }
    foreach (array_reverse(range(1,6)) as $v) {
        $tt=sprintf(T_('more than %g versions behind (currently <= %g)'),$v,currentv($browserid)-$v);
        echo '<option value="'.(-$v).'"' .($default==-$v ? 'selected' : '').'>'.$tt.'</option>';
    }
}

function p_month($months,$version, $selected=false) {
    echo '<option value="-'.$months.'m" '.($selected ? 'selected' : '').'>';
    echo sprintf(T_('older than %g months (currently <=%g)'), $months,  $version);
    echo '</option>';
}
function p_ver($version, $selected=false) {
    $tt="<= $version";
    echo '<option value="'.$version.'" '.($selected ? 'selected' : '').'>'.$tt.'</option>';    
}
?>
<ul id="browserversionchooser">
    <li class="bi">
        <label for="f-i">IE/Edge</label> 
        <select id="f-i" onchange="code()">    
        <?php 
            p_dates("i",-5);
        ?>
        </select>
    </li>
    <li class="bf">
        <label for="f-f">Firefox</label>  
        <select id="f-f" onchange="code()">
            <?php 
                p_dates("f",-4);
            ?>
        </select>
    </li>
    <li class="bo">
        <label for="f-o">Opera</label> 
        <select id="f-o" onchange="code()">
            <?php 
                p_dates("o",-4);
            ?>
        </select>
    </li>
    <li class="bs">
        <label for="f-s">Safari</label>  
        <select id="f-s" onchange="code()">
            <?php
                p_dates("s",-2);
            ?>            
        </select>
    </li>
    <li class="bc">
        <label for="f-c">Chrome</label>
        <select id="f-c" onchange="code()">
            <?php                
                p_dates("c",-4);
            ?>
        </select>            
    </li>
</ul>
<div>
    <input type="checkbox" checked="checked" id="opinsecure" onchange="code();"/>
    <label for="opinsecure">
    <?php echo T_('Notify all browser versions with severe security issues.')?>
    </label>
</div>
<div>
    <input type="checkbox" id="opunsupported" onchange="code();"/>
    <label for="unsupported">
    <?php echo T_('Also notify all browsers that are not supported by the vendor anymore.')?>
    </label>
</div>
<!--
<div>
    
    <input type="checkbox" checked="checked" id="opnewos" onchange="code();"/>
    <label for="opnewos">
    <?php /*echo T_('Only notify users that can install a new browser without having to update their operating system.')*/?>
    </label>
</div>
-->
<div>
    <input type="checkbox" checked="checked" id="opmobile" onchange="code();"/>
    <label for="opmobile">
    <?php echo T_('Notify mobile browsers.')?>
    </label>
</div>
<div>
    <label for="f-style"><?php echo T_('Position')?></label>
    <select id="f-style" onchange="code()">
        <option value="" selected><?php echo T_('top')?></option>
        <option value="bottom"><?php echo T_('bottom')?></option>            
        <option value="corner"><?php echo T_('corner')?></option>
    </select>
    <button onclick="test_bar()"><?php echo T_('Try it out!')?></button>
</div>
<p>
    <?php echo sprintf(T_('The script and service is open source under the <a%s>MIT License</a>.'),' href="https://github.com/browser-update/browser-update/blob/master/LICENSE.txt"')?>
</p>    
<p>
    <?php echo sprintf(T_('You can <a href="%s">customize</a> the style of the message, the text and other options.'), 'customize.html'); ?>
</p>
</div>

<p>
    <?php echo T_('There are plugins for:');?>
</p>
<div class="plugins">
    <a href="https://www.npmjs.com/package/browser-update">npm</a>
    <a href="http://wordpress.org/extend/plugins/wp-browser-update">WordPress</a>
    <a href="https://www.npmjs.com/package/vue-browserupdate">vue.js</a>
    <a href="https://www.npmjs.com/package/ember-cli-browser-update">ember-cli</a>
    <a href="http://typo3.org/extensions/repository/view/browserupdnotify/current/">TYPO3</a>
    <a href="https://contao.org/de/extension-list/view/browser_update.html">Contao</a>
    <a href="http://www.vbulletin.org/forum/showthread.php?t=239559">vBulletin</a>
    <a href="http://www.concrete5.org/marketplace/addons/scala-it-browser-update-notification/">concrete5</a>
    <a href="http://modxcms.com/extras/package/737">MODx</a>
    <a href="https://drupal.org/project/bu">Drupal</a>
    <a href="http://trac.habariproject.org/habari-extras/browser/plugins/browserupdate">Habari</a>
    <a href="http://www.rapidcommerce.eu/en/blog/2012/10/magento-browser-update-notice/">Magento</a>
    <a href="https://www.woltlab.com/pluginstore/index.php/File/1363-Warnhinheis-bei-veralteten-Browsern/">WCF2</a>
    <a href="http://dev.cmsmadesimple.org/projects/browserupdate">CMS made simple</a>
    <a href="http://xenforo.com/community/resources/customisable-browser-update-org-widget.764/">XenForo</a>
    <a href="http://modules.processwire.com/modules/markup-browser-update/">ProcessWire</a>
    <a href="http://rapidweaver.marathia.com/stacks/BrowserUpdate/">Rapidweaver</a>
</div>

<h2><?php echo T_('Why you should tell users to update')?></h2>
<ul>
    <li><?php echo T_('Reduced development costs and time')?></li>
    <li><?php echo T_('Newer browsers let you use more features and new technologies on your website, resulting in a better browsing experience for your users.')?></li>
    <li><?php echo sprintf(T_('Numerous <a%s>benefits for your visitors</a>: security, speed, features, ...'), ' href="update.html"')?></li>
</ul>

<h2 class="help"><?php echo sprintf(T_('Help this project by <a%s>using the update-notification</a> on your site, <a%s>sharing</a> or <a%s>translating</a> this page.'),' href="#install"',' href="#sharebuttons" onclick="document.getElementById(\'sharebuttons\').style.display=\'block\';"',' href="contact.html"')?></h2>
<div id="sharebuttons"> <div class="addthis_inline_share_toolbox"></div></div>



<script>
var $buoop = {api:4};
</script>
<script src="/update.min.js"></script>	

<style>
    .generate {
        border: none;
        padding: 10px 10px;
    }
    .generate #browserversionchooser label {
        width: 75px;
        display: inline-block;
    }
    .generate textarea {
        height: 13em;
        width: 97%;
        border: none;
    }
    
    #sharebuttons {
        display:none;
        min-height: 60px;
        text-align: center;
    }
    #sharebuttons:target {
        display: block;
    }
    #browserversionchooser select {
        background: white;
        padding: 5px;
    }    
    #browserversionchooser li {
        background-size: 28px 28px;
        background-repeat: no-repeat;
        padding-left: 28px;
        display: block;
        padding: 9px;
        background-position: left center;
        padding-left: 40px;
    }
    .bf {	background-image: url('/img/big/ff.png');}
    .bi {	background-image: url('/img/big/ie.png');}
    .bo {	background-image: url('/img/big/op.png');}
    .bc {	background-image: url('/img/big/ch.png');}
    .bs {	background-image: url('/img/big/sa.png');}
    
    .plugins a {
        text-decoration: none;
        display: inline-block;
        margin: 4px;
        padding: 10px;
        background-color: #fff8ea;
        width: 117px;  
        color: #000;
        text-align: center;
        border-radius: 8px;
        
    }
    
    h2 {
        text-align: center;
        font-size: 33px;
    }
    
    .advantages li {
        margin: 10px;
        padding-left: 40px;
        background-repeat: no-repeat;
        background-position: left top;
        color: #777;
        display: inline-block;
        width: 300px;
        height: 150px;
        text-align: center;
        vertical-align: top;
    }    
    
    .advantages li h3 {
        font-size: 20px;
        line-height: 30px;
        margin-bottom: 6px;
    }    
    
    .help {
        font-size: 20px;
        margin: 30px;
        margin-bottom: 60px;
    }
    
</style>

<script>
    
function _get(name,defaultval) {
    if (document.getElementById("op"+name).checked!==defaultval)
        return name+":"+(!defaultval)+",";
    else
        return "";
}
function getomat(name) {
    return document.getElementById('f-'+ name).value;
}
function _get2(name,defaultval) {
    var val=document.getElementById("f-"+name).value;
    if (val!==defaultval)
        return name+':"'+val+'",';
    else
        return "";
}

function test_bar() {
    var el=document.getElementById("buorg");
    if (el)
        el.parentNode.removeChild(el);
    $buo({'position':getomat('style')},true);
}
//+_get("newos",true)
function code() {
    var notify = 'notify:{i:'+ getomat('i') +',f:'+ getomat('f') +',o:'+ getomat('o') +',s:'+ getomat('s') +',c:'+ getomat('c') +'},';
    var code = '<'+'script> \n\
var $buoop = {'+notify+_get("insecure",false)+_get("unsupported",true)+_get("mobile",true)+_get2("style","")+'api:<?php echo $apiver?>}; \n\
function $buo_f(){ \n\
 var e = document.createElement("script"); \n\
 e.src = "//browser-update.org/update.min.js"; \n\
 document.body.appendChild(e);\n\
};\n\
try {document.addEventListener("DOMContentLoaded", $buo_f,false)}\n\
catch(e){window.attachEvent("onload", $buo_f)}\n\
<'+'/script>';
	document.getElementById('f-code').value=code;
}    
code();
</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58186ba14c41b9a2"></script>
<?php
if (!in_array($ll,['en','de'])){//,'es','fr','pl'])) {       
?>
<div class="cookiebar" id="cookiebar" style='right:auto;font-size:16px'>This site is not yet fully translated into your language. <a href="contact.html">Please help by translating it!</a></div>
<?php
}
include("footer.php");
