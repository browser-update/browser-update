<?php
require_once("lib/init.php");
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

		<h2><?php echo T_('How it works'); ?></h2>
		<ol class="steps">
			<!--<li><div>You should (of course) code the Website that it is accessible by old webbrowsers, but you can leave some features/gimmicks out.</div></li>-->
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
				<?php echo T_('You can customize the browsers and versions to notifiy.<br/> ' . 
				'In future releases you can also customize the text that should be shown, ' . 
				'the frequency of the bar to appear and many other things.'); ?>
			</li>
			<li>
				<h3><?php echo T_('Localized'); ?></h3>
				<?php echo T_('The message is automatically displayed in the user\'s language.'); ?>
			</li>
			<li>
				<h3><?php echo T_('Statistics'); ?> <?php echo T_('<span class="workingonit">work in progress</span>'); ?></h3>
				<?php echo sprintf(T_('You get <a href="%s">statistics</a> about which browsers your ' . 
                'visitors are using and how much users got proselyted: How many users ' . 
                'updated or changed their browser through your advice.'), 'stat.html'); ?>
			</li>

		</ul>
		<h2 id="install"><?php echo T_('Install notification on your site'); ?></h2>
		<p>
			<?php echo T_('Here you can get the code to include in your website. ' .
				'Just include it anywhere in the source of your page.'); ?>
		</p>
		<p>
			<?php echo T_('You may also use third-party plugins for: ');
                                echo sprintf(
				'<a href="%s">WordPress</a> (german), ' .
				'<a href="%s">TYPO3</a>, ' .
				'<a href="%s">TYPOlight</a> (german), ' .
                                '<a href="%s">vBulletin</a>, ' .
                                '<a href="%s">concrete5</a>.',
				'http://dvnr.de/wordpress/browser-update/',
                                'http://typo3.org/extensions/repository/view/browserupdnotify/current/',
				'http://typolight.org/erweiterungsliste/view/browser_update.html',
                                'http://www.vbulletin.org/forum/showthread.php?t=239559',
                                'http://www.concrete5.org/marketplace/addons/scala-it-browser-update-notification/'); ?>
		</p>
		<p>
			<?php echo sprintf(
					T_('You can <a href="%s">customize</a> the style of the message, the text and other options.'),
					'customize.html'
					);
			?>
		</p>
		<div class="generate">
        <p><?php echo T_('Following browsers will be notified:'); ?></p>
        <div id="browserversionchooser">
		<span class="browser">
			<label for="f-i">IE</label> 
			<select id="f-i" onchange="code();">
				<option value="5.5">&lt;= 5.5</option>
				<option value="6" selected="selected">&lt;= 6</option>
				<option value="7">&lt;= 7</option>
			</select>
		</span>
		<span class="browser">
			<label for="f-f">Firefox</label>  
			<select id="f-f" onchange="code();">
				<option value="1">&lt;= 1.0</option>
				<option value="1.5">&lt;= 1.5</option>
				<option value="2" selected="selected">&lt;= 2.0</option>
                <option value="3" selected="selected">&lt;= 3.0</option>
			</select>
		</span>
		<span class="browser">
			<label for="f-o">Opera</label> 
			<select id="f-o" onchange="code();">
				<option value="9.0">&lt;= 9.0</option>
                <option value="9.64" selected="selected">&lt;= 9.64</option>
				<option value="10.01">&lt;= 10.01</option>
			</select>
		</span>
		<span class="browser">
			<label for="f-s">Safari</label>  
			<select id="f-s" onchange="code();">
				<option value="1">&lt;= 1.0</option>
				<option value="1.2">&lt;= 1.2</option>
				<option value="2" selected="selected">&lt;= 2.0</option>
				<option value="3">&lt;= 3.0</option>
                <option value="3">&lt;= 3.2</option>
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
		<h3><?php echo T_('Your Code'); ?></h3>
		<textarea id="f-code" rows="10" cols="80">
&lt;script type="text/javascript">
var $buoop = {}
$buoop.ol = window.onload;
window.onload=function(){
     if ($buoop.ol) $buoop.ol();
     var e = document.createElement("script");
     e.setAttribute("type", "text/javascript");
     e.setAttribute("src", "http://browser-update.org/update.js");
     document.body.appendChild(e);
}
&lt;/script>
		</textarea>
		
		</div>
		<p>
		</p>
		<h2><?php echo T_('Why you should tell users to update'); ?></h2>
		<ul class="advantages">
			<li>
				<h3><?php echo T_('Reduced development costs and time'); ?></h3>
				<div><?php echo T_('Optimizing websites for old browsers is time consuming and thus expensive.'); ?></div> 
			</li>
			<li>
				<h3><?php echo T_('Webdesign technologies and features'); ?></h3>
				<div><?php echo T_('There are all these great new webdevlopment standards and they are supported by modern browsers... but you may not use them.'); ?> 
				<br/>
				<?php echo T_('Newer browsers let you use more features and new technologies (CSS3, SVG, HTML5, RSS, CSS Generated Content, flexible Layouts) on your website, resulting in a better browsing experience for your users.'); ?></div>
			</li>
			<li>
				<h3><?php echo T_('Security and benefits for the user'); ?></h3>
				<div><?php echo sprintf(T_('Numerous benefits: security, speed, features, ... Look at the <a href="%s">update page</a>. The security-threads of outdates browsers are listed in this <a href="%s">paper</a>.'), 'update.html', 'http://www.techzoom.net/publications/insecurity-iceberg/index.en'); ?></div>
			</li>
			<li>	
				<h3><?php echo T_('The web has to evolve...'); ?></h3>
				<div>
					<?php echo T_("But that's only possible if the browsers also evolve."); ?>
					<?php echo T_('The strong market share of a 8 years old webbrowser (Internet Explorer 6) is something new in the history of the web. If we take no action now, we will have to code websites like in 2001 even if it is 2011.'); ?>
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

<script type="text/javascript">
var $buoop = {};
$buoop.ol = window.onload;
window.onload=function(){
     var e = document.createElement("script");
     e.setAttribute("type", "text/javascript");
     e.setAttribute("src", "/update.js");
     document.body.appendChild(e);
     if ($buoop.ol) $buoop.ol();
}
code();
</script>
	

<?php include("footer.php");?>

