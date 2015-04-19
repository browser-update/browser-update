<?php
require_once("lib/init.php");

//rederict people coming from search engines that have outdated browsers to the update page
if (preg_match('#(\.|/)(google|bing|yahoo)\.#i',$_SERVER['HTTP_REFERER'])
        &&
        !preg_match('#bot|googlebot|slurp|mediapartners|adsbot|silk|android|phone|bingbot|google web preview|like firefox|chromeframe|seamonkey|opera mini|min|meego|netfront|moblin|maemo|arora|camino|flot|k-meleon|fennec|kazehakase|galeon|android|mobile|iphone|ipod|ipad|epiphany|rekonq|symbian|webos#i',$_SERVER['HTTP_REFERER'])
        ) {
    $vs="?(\d+[.]\d+)";
    $__uastr=str_replace(array("/","+","_","\n","\t")," ", strtolower($_SERVER['HTTP_USER_AGENT']));
    function det($str, $version) {
        global $__uastr;
        if(!preg_match("#".$str."#", $__uastr, $regs))
            return false;
        return $regs[1]<$version;
    }
    if(det("opera.*version $vs",16)||det("trident.$vs",7)||det("trident.*rv:$vs",10)||det("msie $vs",10)||det("firefox $vs",23)||det("version $vs.*safari",6)) {
        header("Location: update-browser.html#2");
        exit;
    }
}

require_once("lib/lang.php");
include("header.php");

?>

   
<div class="left">
	<div class="message">
		<p>
			<b>
			<?php echo T_('This service is an  opportunity to inform your visitors  unobtrusively to switch to a newer browser.'); ?>
			</b>
		</p>
		<p>
			<?php echo T_('Many internet users are still using very old, out-dated browsers – most of them for no actual reason. ' . 
				'Switching to an newer browser is better for them and for you as a webdesigner.'); ?>
			<!--They just have to be told, that using an old browser gives them disadvantages.-->
		</p>
		<!--<p>
			The more Websites Participate, the more the awareness to update will increase and old browser market share will drop faster!
		</p>-->
	</div>
        <?php
        #"it,sl,jp,nb,ch"
        function countSites() {
            require_once("config.php");
            $r = mysql_query("SELECT COUNT(DISTINCT referer) FROM updates") or die(mysql_error(). $q);
            list($num) = mysql_fetch_row($r);
            return $num;
        }
        function countUpdates() {
            require_once("config.php");
            $r = mysql_query("SELECT COUNT(*) FROM updates") or die(mysql_error(). $q);
            list($num) = mysql_fetch_row($r);
            return $num;
        }

        ?>
        <div class="numbs">
        <p>
            <?php
            echo sprintf(T_('<strong class="number">%s</strong> sites are using the Browser-Update.org script.'), number_format(intval(cache_output('countSites')),0,".", " "));
            ?>
        </p>
        <p>
            <?php
            echo sprintf(T_('<strong class="number">%s</strong> visitors have already upgraded their browser.'), number_format(intval(cache_output('countUpdates')),0,".", " "));
            ?>
        </p>
        </div>
		<h2><?php echo T_('How it works'); ?></h2>
		<ol class="steps">
			<li><div>
                <?php echo sprintf(T_('Include our small javascript <a href="%s">notification</a> on your website'), '#install'); ?>
            </div></li>
			<li><div>
                <?php echo T_('Visitors with out-dated browser will be informed by a little, ' . 
					'undisturbing bar, that his browser is not up-to-date and it ' . 
					'is recommended to update.'); ?>
				(<a href="#" onclick="$buo({},true);"><?php echo T_('Test the notification bar!'); ?></a>)<br/>
				<div class="example">
					<?php echo sprintf(T_('Your browser (%s) is <b>out of date</b>. ' .
					'It has known <b>security flaws</b> and may <b>not ' .
					'display all features</b> of this and other websites. ' .
					'<a%s>Learn how to update your browser</a>'),'Internet Explorer 6',' href="update.html"');?>
				</div>
			</div></li>
			<li><div>
                <?php echo sprintf(T_('By clicking the bar, he will get to <a href="%s">an info page ' . 
					'with arguments why to change/update and some browser choices</a>.'), 'update.html'); ?>
            </div></li>
            <li><div>
                <?php echo T_('If the visitor ignores the advice, it won\'t appear again for some time.'); ?>
			</div></li>
		</ol>
		<h2><?php echo T_('Advantages and features'); ?></h2>
		<ul class="advantages">
			<li>
				<h3><?php echo T_('Subtle'); ?><!--Unobtrusive / Non-Intrusive--></h3>
				<?php echo T_('The user will be notified only once, and won\'t be bothered any more. ' . 
					'The notification bar is very small and won\'t affect the browsing experience negatively.'); ?>
			</li>
			<li>
				<h3><?php echo T_('Informative'); ?></h3>
				<?php echo T_('Tell the users that they are using an out-dated browser ' . 
					'and that your website looks even better with a newer one.'); ?>
			</li>
			<li>
				<h3><?php echo T_('Idealistic'); ?></h3>
				<?php echo T_('Help evolve the web!'); ?>
				<?php echo T_('Support the standards-based web!'); ?>
				<?php echo T_('Support Open Source software projects!'); ?>
				<?php echo T_('Help your visitors!'); ?>
				<?php echo T_('Help increase security awareness!'); ?>
				<?php echo T_('Support your favorite webbrowser!'); ?>
			</li>
			<li>
				<h3><?php echo T_('Low maintenance and up-to-date'); ?></h3>
                <?php echo T_('If there come more browser versions which won\'t be supported by the vendor ' . 
                'in the future, exhibit security gaps or have been very old for a ' . 
                'long time we are going to add them to our list automatically.'); ?>
			</li>
			<li>
				<h3><?php echo T_('Customizable'); ?></h3>
				<?php echo T_('You can customize the browsers and versions to notify.<br/> ' . 
				'In future releases you can also customize the text that should be shown, ' . 
				'the frequency of the bar to appear and many other things.'); ?>
			</li>
			<li>
				<h3><?php echo T_('Localized'); ?></h3>
				<?php echo T_('The message is automatically displayed in the user\'s language.'); ?>
			</li>
			<li>

		</ul>
		<h2 id="install"><?php echo T_('Install notification on your site'); ?></h2>
		<p>
			<?php echo T_('Here you can get the code to include in your website. ' .
				'Just include it anywhere in the source of your page.'); ?>
		</p>
		
		<div class="generate">


		<textarea id="f-code" rows="10" cols="80">
&lt;script>
var $buoop = {};
function $buo_f(){ 
 var e = document.createElement("script"); 
 e.src = "//browser-update.org/update.js"; 
 document.body.appendChild(e);
};
try {document.addEventListener("DOMContentLoaded", $buo_f,false)}
catch(e){window.attachEvent("onload", $buo_f)}
&lt;/script>
		</textarea>
        <p><?php echo T_('Following browsers will be notified:'); ?></p>
        <div id="browserversionchooser">
		<span class="browser">
			<label for="f-i">IE</label> 
			<select id="f-i" onchange="code();">
				<option value="7">&lt;= 7</option>
				<option value="8">&lt;= 8</option>
				<option value="9" selected>&lt;= 9</option>
                                <option value="10">&lt;= 10</option>
			</select>
		</span>
		<span class="browser">
			<label for="f-f">Firefox</label>  
			<select id="f-f" onchange="code();">
				<option value="5">&lt;= 5</option>
				<option value="10">&lt;= 10</option>
				<option value="15">&lt;= 15</option>
				<option value="20">&lt;= 20</option>
                                <option value="25" selected>&lt;= 25</option>
                                <option value="30">&lt;= 30</option>
                                <option value="35">&lt;= 35</option>
			</select>
		</span>
		<span class="browser">
			<label for="f-o">Opera</label> 
			<select id="f-o" onchange="code();">
                                <option value="12">&lt;= 12</option>
                                <option value="12.1" selected>&lt;= 12.1</option>
                                <option value="15">&lt;= 15</option>
                                <option value="20">&lt;= 20</option>
                                <option value="25">&lt;= 25</option>
			</select>
		</span>
		<span class="browser">
			<label for="f-s">Safari</label>  
			<select id="f-s" onchange="code();">
				<option value="4.1">&lt;= 4.1</option>
				<option value="5">&lt;= 5</option>
                                <option value="5.1">&lt;= 5.1</option>
                                <option value="6" selected>&lt;= 6</option>
                                <option value="7">&lt;= 7</option>
			</select>
		</span>
		<span class="browser">
			<label for="f-s">Chrome: </label>
			<span class="popupinfo">auto<span class="popup"><?php echo T_('Google Chrome will automatically itself and is therefor always up to date'); ?>.</span></span>
		</span>
        </div>
        <div>
            <input type="checkbox" checked="checked" id="autoupdate" onchange="code();"/>
            <label for="autoupdate">
				<?php echo T_('<b>Notify recommended set of browsers and adjust it automatically over time:</b>' .
					'If a browser is no longer supported by the vendor or has security vulnerabilities, ' .
					'it will be added to the set.'); ?>
			</label>
        </div>		
		</div>
		<p>
			<?php echo sprintf(
					T_('You can <a href="%s">customize</a> the style of the message, the text and other options.'),
					'customize.html'
					);
			?>
		</p>
<p>
			<?php echo T_('You may also use third-party plugins for: ');
                                echo sprintf(' '.
                                            '<a href="%s">WordPress</a>, ' .
                                            '<a href="%s">ember-cli</a>, ' .
                                            '<a href="%s">TYPO3</a>, ' .
                                            '<a href="%s">TYPOlight</a> (german), ' .
                                '<a href="%s">vBulletin</a>, ' .
                                '<a href="%s">concrete5</a>, ' .
								'<a href="%s">MODx</a>, ' .
                                '<a href="%s">Drupal</a>, ' .
								'<a href="%s">Habari</a>, '.
								'<a href="%s">Magento</a>, <a href="%s">WCF 2</a>, <a href="%s">CMS made simple</a>, <a href="%s">XenForo</a>.',
				'http://wordpress.org/extend/plugins/wp-browser-update',
                                'https://www.npmjs.com/package/ember-cli-browser-update',
                                'http://typo3.org/extensions/repository/view/browserupdnotify/current/',
				'http://typolight.org/erweiterungsliste/view/browser_update.html',
                                'http://www.vbulletin.org/forum/showthread.php?t=239559',
                                'http://www.concrete5.org/marketplace/addons/scala-it-browser-update-notification/',
								'http://modxcms.com/extras/package/737',
                                        'https://drupal.org/project/bu',										
										'http://trac.habariproject.org/habari-extras/browser/plugins/browserupdate',
                                        'http://www.rapidcommerce.eu/blog/2012/10/magento-browser-update-notice/',
                                        'https://www.woltlab.com/pluginstore/index.php/File/1363-Warnhinheis-bei-veralteten-Browsern/',
                                        'http://dev.cmsmadesimple.org/projects/browserupdate',
                                        'http://xenforo.com/community/resources/customisable-browser-update-org-widget.764/'
										);
								?>
		</p>

		<h2><?php echo T_('Why you should tell users to update'); ?></h2>
		<ul class="advantages">
			<li>
				<h3><?php echo T_('Reduced development costs and time'); ?></h3>
				<div><?php echo T_('Optimizing websites for old browsers is time consuming and thus expensive.'); ?></div> 
			</li>
			<li>
				<h3><?php echo T_('Webdesign technologies and features'); ?></h3>
				<div><?php echo T_('There are all these great new web development standards and they are supported by modern browsers... but you may not use them.'); ?> 
				<br/>
				<?php echo T_('Newer browsers let you use more features and new technologies (CSS3, SVG, HTML5, RSS, CSS Generated Content, flexible Layouts) on your website, resulting in a better browsing experience for your users.'); ?></div>
			</li>
			<li>
				<h3><?php echo T_('Security and benefits for the user'); ?></h3>
				<div><?php echo sprintf(T_('Numerous benefits: security, speed, features, ... Look at the <a href="%s">update page</a>. The security-threats of outdates browsers are listed in this <a href="%s">paper</a>.'), 'update.html', 'http://www.techzoom.net/publications/insecurity-iceberg/index.en'); ?></div>
			</li>
			<li>	
				<h3><?php echo T_('The web has to evolve...'); ?></h3>
				<div>
					<?php echo T_("But that's only possible if the browsers also evolve."); ?>
				</div>
			</li>
			<li>
				<h3><?php echo T_('Users don\'t oppose updating...'); ?></h3>
				<?php echo T_('... they often just do not appreciate the need to update or the existence of the "webbrowser" as a software at all.'); ?>
			</li>
		</ul>
		<h2><?php echo T_('Help this project'); ?></h2>
		<ul class="advantages">
			<li>
				<h3><?php echo T_('Participate!'); ?></h3>
				<?php echo T_('Include the notification code in your page to inform users about browser updates.'); ?>
			</li>
			<li>
				<h3><?php echo T_('Spread the word!'); ?></h3>
				<?php echo T_('Tell others about this initiative! In your blog, on your webpage, ...'); ?>
			</li>
			<li>
				<h3><?php echo T_('Translate this page'); ?></h3>
				<?php echo T_('Translate this page into your language.'); ?>
			</li>
		</ul>
</div>

<script>
var $buoop = {c:2};
function $buo_f(){ 
 var e = document.createElement("script"); 
 e.src = "//browser-update.org/update.js"; 
 document.body.appendChild(e);
};
try {document.addEventListener("DOMContentLoaded", $buo_f,false)}
catch(e){window.attachEvent("onload", $buo_f)}
code();
</script>
	

<?php include("footer.php");?>

