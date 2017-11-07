<?php
require_once("lib/init.php");
require_once("lib/lang.php");
$title="Blog - Inform users to update their browser";
include("header.php");
?>
<!--
<h2>Notification placement</h2>
<small>November 2017</small>
<div class="entry">
    <p>
        
    </p>
</div>
<div class="com"><a href="blog-entry.html?n=placement" onclick="SC('placement'); return false;">Comments</a></div>
-->

<h2>Added more browsers to detection and choices</h2>
<small>October 2017</small>
<div class="entry">
    <p>
        Additionally to the main browsers Firefox, Chrome, Edge, Opera and Safari we are now
         detecting and offering UC Browser(Android), Vivaldi (Windows, MacOS, Linux)<!--, Yandex Browser (Android, Windows, MacOS, Linux)--> and Samsung Internet Browser (Android).
    </p>
    <p>
        We continue to whitelist a lot small niche browsers in order not to annoy people who choose to use a special browser for whatever reason.
    </p>
</div>
<div class="com"><a href="blog-entry.html?n=morebrowsers" onclick="SC('morebrowsers'); return false;">Comments</a></div>

<h2>Notification formats</h2>
<small>September 2017</small>
<div class="entry">
    <p>
        We now offer different formats of notification. 
        Additionally to the default style, showing the notification bar at the top, you can also show it at the top bottom or in the corner of your page.
     </p>
     <p>
         Of course you can still <a href="customize.html">customize</a> the complete bar to your needs.        
    </p>
</div>
<div class="com"><a href="blog-entry.html?n=placement" onclick="SC('placement'); return false;">Comments</a></div>

<h2>NPM installabale version</h2>
<small>April 2017</small>
<div class="entry">
    <p>
        Browser-update can now available as an <a href="https://www.npmjs.com/package/browser-update">npm package</a>. You can now install it easily using your browserify or webpack toolchain.
    </p>
</div>
<div class="com"><a href="blog-entry.html?n=npm" onclick="SC('npm'); return false;">Comments</a></div>



<h2>Shrinked script size: now only 2 kB</h2>
<small>January 2017</small>
<div class="entry">
    <p>
        We've split the oudated browser detection script into two parts: 1) the detection if the browser is outdated and 2) the showing of the message to users with outdated browser.
    </p>
    <p>
        The detection part is what you embed into your site (<code>update.js</code>). This is what all users will have to download. And this is is now only 2.2 kB in size gzipped, five times smaller than before
        (>10kB).
        Then, if the browser is outdated and needs to be notified, the message file (<code>update.show.js</code>) will be loaded, but this will only happen for about 1% of the users.
    </p>
</div>
<div class="com"><a href="blog-entry.html?n=shrinked" onclick="SC('shrinked'); return false;">Comments</a></div>


<h2>New notification bar design with "ignore" button</h2>
<small>January 2017</small>
<div class="entry">
    <p>
        The new notification bar design now offers an Ignore button istead of the "closing cross" to improve the usability and giving the explicit choice betwwen taking action and ignoring the message.
    </p>
    <p>You can <a href="customize.html">hide the ignore button</a>  if you like urge the user a bit more to take action.</p>
</div>
<div class="com"><a href="blog-entry.html?n=newbar" onclick="SC('newbar'); return false;">Comments</a></div>

<h2>Fine-tuned detecion of operating system and adapted choice</h2>
<small>November 2016</small>
<div class="entry">
    <p>
        We improved the detection of browsers in combination with the Operatin System a User has (Android, Windows, MacOS, Linux) and the Version of the Operating System.
    </p>
    <p>
        We keep track which browsers are available for which Operating system.
    </p>
    <p>
        If there is now browser available anymore for the system we hint the user to update their system and link to a site explaining this.
    </p>
   <p>
        Also some browsers (Safari, Microsoft Edge) can only be updated together with the system. Here we tell the user to choose another browser or update their system.
   </p>    
</div>
<div class="com"><a href="blog-entry.html?n=npm" onclick="SC('npm'); return false;">Comments</a></div>



<h2>Collecting Feedback on Browser-Updates</h2>
<small>October 2016</small>
<div class="entry">
    <p>
        We implemented a small <a href="/en/update-browser.html">feedback form on the browser update page</a> 
        where people can report why they can't or don't want to update.
        We are collecting now some data and already got some valuable feedback. 
        With this we can improve our notification and the selection of browsers we offer.
    </p>
    <img src="/img/blog/feedback.png"/>
    <p>
        For now this only on the english language version of the browser update page.
    </p>
</div>
<div class="com"><a href="blog-entry.html?n=feedback" onclick="SC('feedback'); return false;">Comments</a></div>



<h2>Improved notification and more options</h2>
<small>September 2016</small>
<div class="entry">
    <p>
    We now check for more browsers if they are up-to-date: Yandex Browser, Pale Moon Browser, and Vivaldi Browser. 
    </p>
    <p>
    The detection script was slimmed down more and we improved detection of Microsoft Edge.
    </p>
    <p>
        When creating your update-notification code for your site you have now a few new options:
    </p>
    <ul>
        <li>
        You can choose to notifiy browsers that have been outdated for e.g. 3 months instead of specifying a certain browsers versions. This is now the default for Chrome, Firefox and Opera.
        </li>
        <li>
        You can choose wheather to notify users with outdated mobile browsers.
        </li>
        <li>
        You can choose to generally notify all browsers versions which are not supported by the vendor anymore.
        </li>    
        <li>
        You can choose to notify all browsers with security vulnerabilities.
        </li>    
    </ul>   

</div>
<div class="com"><a href="blog-entry.html?n=detectionx" onclick="SC('detectionx'); return false;">Comments</a></div>

<h2>Testing update notification for mobile Browsers: Stock Android Browser</h2>
<small>September 2016</small>
<div class="entry">
    <p>
    For a long time we have ignored mobile Browsers here at browser-update.org on purpose. 
    They are in particular complicated to detect and on many platforms there is no way to 
    update the browser without updating the system or even an operating system update is not possible at all. 
    </p>
    <p>
    Now we started to notify users that are using the outdated stock Android browser if they have an upgrade path to another newer browser on their system.
    We offer a selection of up-to-date browsers for Android to them, currently consisting of Chrome, Firefox and Opera.
    </p>
    <p>
        We investigate including more browsers as choices to update and to notify other mobile platforms like Windows Phone and maybe iOS in the future.
    </p>

</div>
<div class="com"><a href="blog-entry.html?n=mobilean" onclick="SC('mobilean'); return false;">Comments</a></div>



<h2>New translation tool</h2>
<small>August 2016</small>
<div class="entry">
<p>
    This site can now be translated using a <a href="https://crowdin.com/project/browser-update">convenient online tool</a>. 
    Now it should be much easier to create, update and review translations.
</p>
<p>
    Over the last weeks we added new translations for <a href="/no/update-browser.html">norwegian</a>, <a href="/lv/update-browser.html">latvian</a>, <a href="/sr/update-browser.html">serbian</a> and <a href="/ga/update-browser.html">irish</a>.
</p>
<p>
Also, we now added a <a href="/th/update-browser.html">thai translation of browser-update</a>.
</p>

</div>
<div class="com"><a href="blog-entry.html?n=transx" onclick="SC('transx'); return false;">Comments</a></div>


<h2>We passed 10 000 000 browser updates</h2>
<small>March 3rd, 2016</small>
<div class="entry">
<p>
    As of today we convinced a total of 10 million people to update their browser.
    With this we may have protected tens of thousands of people from attacks through security holes in their old outdated browser. 
    And we have improved the browsing experience of all of them with a new, speedy, more functional browser.
</p>
</div>
<div class="com"><a href="blog-entry.html?n=tenmil" onclick="SC('tenmil'); return false;">Comments</a></div>

<h2>Minified browser update notification script</h2>
<small>May 17th, 2015</small>
<div class="entry">
<p>
    We minified the update notification script and tweaked it more to make it smaller and load faster.
</p>
</div>
<div class="com"><a href="blog-entry.html?n=minified" onclick="SC('minified'); return false;">Comments</a></div>




<h2>More user-friendly notifications</h2>
<small>February 11th, 2015</small>
<div class="entry">
<p>
We improved the procedure when to show the notification to be even more user-friendly: 
When the user closes or clicks the notification bar, we know that they noticed the notification.
After this we do not show it again for a week, because this means the user has seen the bar 
but has some reason not to update their browser right now. 
Knowing this, we do not want to bother the users, but only remind them some longer time later.
</p>
<p>
    The time interval to the next notification can be changed using the <code>reminderClosed</code> <a href="customize.html">option</a>. 
    It defaults to about a week.
</p>
</div>
<div class="com"><a href="blog-entry.html?n=imp3" onclick="SC('imp3'); return false;">Comments</a></div>

<h2>IE9, Fixes</h2>
<small>November 3rd, 2014</small>
<div class="entry">
<p>
Internet Explorer 9 was released in March 2011, almost four ago. We will now start 
to notify users of this browser (in the default configuration).
</p>
<p>
We changed the code you have to include in your site. It is a little bit smaller and faster.
</p>
<p>
    In our continouing quest to inform the majority of relevant browser and not to erroneously bother users of small
    browsers we whitelisted a few small browsers (CoolNovo,Blackberry 10,PaleMoon, QupZilla), which will not get the notification.
</p>
</div>
<div class="com"><a href="blog-entry.html?n=ie9" onclick="SC('ie9'); return false;">Comments</a></div>


<h2>More translations</h2>
<small>June 30th, 2014</small>
<div class="entry">
<p>
    The <a href="update-browser.html">browser upgrade page</a> is now available in
    <a href="/fi/update-browser.html">suomi (Finnish)</a>
    <a href="/tr/update-browser.html">Türkçe (Turkish)</a>
    <a href="/ro/update-browser.html">Română (Romanian)</a>
    Also it was updated for
    <a href="/es/update-browser.html">español (Spanish)</a>.
</p>
</div>
<div class="com"><a href="blog-entry.html?n=trans4" onclick="SC('trans4'); return false;">Comments</a></div>


<h2>Detection improvements</h2>
<small>April 22th, 2014</small>
<div class="entry">
<p>
    Several improvements were made to the browser detection code:
    We improved the detection of Firefox ESR releases (which are supported by Mozilla for one year) and do not ask them to update.
    Although almost all the chrome users use the latest version of chrome because of the built-in auto-update mechanism, it may not work on some of the users. 
    To keep these users up to date (and safe) we now also notify users that use out of date versions of chrome.
    Furthermore we improved the detection of other browsers we do not want to notify erroneously (e.g. Maxthon and Dolphin).
</p>
</div>
<div class="com"><a href="blog-entry.html?n=noti" onclick="SC('noti'); return false;">Comments</a></div>

<h2>IE8 users will be notified</h2>
<small>January 26th, 2014</small>
<div class="entry">
<p>
Internet Explorer 8 was released almost five years ago in March 2009. We start now notifying users of this browser. 
Furthermore we notify users of these outdated browsers, which are not supported with security updates anymore:
Firefox 10 or older (released Jan 2012, ≈< 0.5%), Opera 12 or older (released Jun 2012, ≈< 0.1%), Safari 5.0 or older (released Jun 2010, ≈<1%), Chrome 10 or older.
<a href="http://code.google.com/p/browser-update/wiki/BrowsersToNotify">BrowsersToNotify</a>.
</div>
<div class="com"><a href="blog-entry.html?n=ie8" onclick="SC('ie8'); return false;">Comments</a></div>

<h2>New Translations</h2>
<small>January 26th, 2014</small>
<div class="entry">
<p>
    The <a href="update-browser.html">update page</a> is now available in
    <a href="/nb/update-browser.html">Norsk bokmål (norwegian)</a> and 
    <a href="/zh/update-browser.html">中文 (simplified chinese)</a>. 
    Also it was updated for
    <a href="/pl/update-browser.html">polish</a>, 
    <a href="/ru/update-browser.html">russian</a> and
    <a href="/kr/update-browser.html">italian</a>. 
</p>
</div>
<div class="com"><a href="blog-entry.html?n=trans3" onclick="SC('trans3'); return false;">Comments</a></div>


<h2>SSL Support finally arrived</h2>
<small>January 4th, 2014</small>
<div class="entry">
<p>
    Finally, browser-update.org can be used on SSL sites (https://)! Just grab the <a href="./">new code</a> and it will automatically work as expected!
</p>
</div>
<div class="com"><a href="blog-entry.html?n=ssl" onclick="SC('ssl'); return false;">Comments</a></div>

<h2>New and easier update page</h2>
<small>January 4th, 2014</small>
<div class="entry">
<p>
    We simplified the update page a lot. The goal was to focus more on the next step the user has to take to choose 
    an up-to-date browser.
</p>
<img src="/img/browser update screenshot.png"/>
<p>
    This is why the browsers to choose are now on top. With a simple, short message telling the user what to do.
    Furthermore, we removed as many distractions as possible (removed the logo, we simplified the header, smaller menu, less text).
    The details why to update can still be found, but are a but further down the page.
</p>
<p>
    The new page is already available in 
    <a href="/en/update-browser.html">english</a>, 
    <a href="/de/update-browser.html">Deutsch</a>, 
    <a href="/es/update-browser.html">français</a>, 
    <a href="/nl/update-browser.html">Nederlands</a>, 
    <a href="/cs/update-browser.html">Čeština</a>, 
    <a href="/sq/update-browser.html">shqipe</a>, 
    <a href="/he/update-browser.html">עברית</a> and
    <a href="/es/update-browser.html">español</a>. 
    For other languages we need <a href="http://code.google.com/p/browser-update/wiki/HowToTranslate">your help for translating a few sentences</a>.
</p>
<p>
    Along with these changes also the design of the rest page got a refresh.
</p>
</div>
<div class="com"><a href="blog-entry.html?n=newdesign" onclick="SC('newdesign'); return false;">Comments</a></div>



<h2> Small improvements</h2>
<small>January 2nd, 2014</small>
<div class="entry">
<ul>
    <li>The links for Safari now point to (free) OS X operating system upates, since Safari is distirbuted this way</li>
    <li>Added links to new plugins for WCF 2, CMS made simple and XenForo</li>
    <li>Users with Windows 98 and 2000 and on old OS X Versions will not see notifications since there are no up-to-date browsers available for these systems anyway.</li>
    <li>Translators can start with a smaller "core" <a href="http://code.google.com/p/browser-update/wiki/HowToTranslate">translation</a> where only the notification part is translated</li>
    <li>A lot of small bugfixes</li>
    <li>Added <a href="/hu/">Hungarian</a>, <a href="/sv/">Swedish</a>,<a href="/fa/">Farsi</a> and <a href="/gl/">Galician</a> translation. Fixed <a href="/sq/">Albanian</a>. More small fixes.</li>
</ul>
</div>
<div class="com"><a href="blog-entry.html?n=improvements" onclick="SC('improvements'); return false;">Comments</a></div>



<h2>1 000 000 Users updated their browser</h2>
<small>Aug 1st, 2013</small>
<div class="entry">
<p>More than 1 000 000 Users updated their browser so far thanks to this service!</p>
</div>
<div class="com"><a href="blog-entry.html?n=onemillion" onclick="SC('onemillion'); return false;">Comments</a></div>







<h2>IE7 moved to outdated browsers</h2>
<small>June 17th, 2012</small>
<div class="entry">
<p>
Many webdesigners using browser-update.org have told us that we should move Internet 
Explorer 7 to the outdated Browsers since the release of IE9 last year.
</p>
<p>
Users now get warnings when they still use Internet Explorer 7 which was released 
more than 5 years ago in October 2006.
</p>
<p>
IE 7 currently approximately holds a global market share of less than 3%.
</p>
<p>
The default outdated browser list is now:
</p>
<ul>
    <li>Internet Explorer 7 or older (released Oct 2006, market share ≈< 3%)</li>
    <li>Firefox 3.6  or older (released Jul 2010, not supported with security updates anymore, ≈< 3%)</li>
    <li>Opera 10.6 or older (released Jan 2010, not supported with security updates anymore, ≈< 0.1%)</li>
    <li>Safari 4.0 or older (released Feb 2009, not supported with security updates anymore, ≈<0.2%)</li>
</ul>
<p>
    IE7 is after IE6 the browser webdesigners are struggling  the most with when creating their
    sites. It supports almost none of the HTML5/CSS3 features and speed improvements of current browsers.
    An interesting approach to get users to update their browser was chosen by an Australian online shop: 
    They added an <a href="http://gizmodo.com/5918599/australian-electronics-retailer-shame+taxes-customers-who-use-internet-explorer-7-updated">additional tax for users of IE7</a>
    to pay their webdevelopers for optimizing the site for this ancient browser.
</p>
<p>
    Additional information on when we moved browsers to the outdated list and discussion
    about it can be found on the wiki page 
    <a href="http://code.google.com/p/browser-update/wiki/BrowsersToNotify">"BrowsersToNotify"</a>.
</p>
</div>
<div class="com"><a href="blog-entry.html?n=ie7" onclick="SC('ie7'); return false;">Comments</a></div>


<h2>French translation and Drupal module</h2>
<small>July 30th, 2011</small>
<div class="entry">
Finally we can add French to the supported languages list.
Now we have four of the five <a href="http://en.wikipedia.org/wiki/List_of_languages_by_total_number_of_speakers#George_H._J._Weber.27s_estimate">top languages by native and secondary speakers</a>.
Thanks to <a href="http://www.ditwinemploi.com">Médéric</a> for the translation!
<p>
Furthermore, there is now <a href="https://drupal.org/project/bu">a module</a> for the Drupal Content management system available. Thanks to <a href="http://pebosi.net/drupal-module/browser-update">Peter</a>.
</p>
</div>
<div class="com"><a href="blog-entry.html?n=frenchdrupal" onclick="SC('frenchdrupal'); return false;">Comments</a></div>



<h2>Microsoft: "Moving the world off Internet Explorer 6"</h2>
<small>April 19th, 2011</small>
<div class="entry">
Microsoft has also realized the problem about outdated browsers - at least regarding their fossil, Internet Explorer 6.
They created the site <a href="http://www.ie6countdown.com/">"The Internet Explorer 6 Countdown"</a> with the subtitle
"Moving the world off Internet Explorer 6".
Nice to see them join us in the fight.
We, <a href="http://browser-update.org">browser-update.org</a>, already have convinced
about 300&nbsp;000 users to move off Internet Explorer 6!
</div>
<div class="com"><a href="blog-entry.html?n=msie6" onclick="SC('msie6'); return false;">Comments</a></div>


<h2>IE9 released</h2>
<small>March 5th, 2011</small>
<div class="entry">
Internet Explorer 9 has been released today. But it is not available for Windows XP, which has still a significant market share.
Since IE9 is only available for Windows Vista and Windows 7, we have introduced
a message for people using other Systems that they need to choose another browser.

"Internet Explorer 9 - 
Not available for your System. Only for Windows Vista or 7. Please choose another browser."
</div>
<div class="com"><a href="blog-entry.html?n=ie9update" onclick="SC('ie9update'); return false;">Comments</a></div>





<h2>News from Browser-update.org</h2>
<small>January 19th, 2010</small>
<div class="entry">

Its been a long time since the last update here and it may seem like this project is not improving. But we have plenty of updates, changes and achievements to talk about.

<h5>Users</h5>
First of all we have over 6000 Websites using the browser-update.org script now. This is a impressive number but we need to reach more webmasters! So spread the word about this campaign. The Google-Hack showed that a secure and up-to-date browser is very important, with even Microsoft now advising to abandon IE 6.

<h5>Translation</h5>
We moved to a new (and hopefully easier) translation system using gettext. You can find more information on our 
<a href="http://code.google.com/p/browser-update/wiki/HowToTranslate">translation page</a>.

<h5>Customization</h5>
Now you can fully customize the notification using CSS and Javascript. This includes text, language, “open link in new window” and even a Javascript callback function.

<h5>New Server</h5>
We were moving to a faster server in November, because our old server could not handle the load anymore.

<h5>Future</h5>
This year we need to decide if we should move Internet Explorer 7 to the default-list of outdated browsers.
</div>
<div class="com"><a href="blog-entry.html?n=news" onclick="SC('news'); return false;">Comments</a></div>


<!--
<h2>Almost 250.000 Users Updated</h2>
<small>March 5th, 2011</small>
<div class="entry">

</div>
-->
<script>
    function SC(name) {
        document.getElementById('CF').src="blog-entry.html?n="+name;
        window.setTimeout(function(){ document.getElementById('CF').style.visibility="visible";},10);
       
    }
    document.onclick=function HC(name) {
        document.getElementById('CF').style.visibility="hidden";
    }
</script>

<iframe id="CF">


</iframe>

<style>
h2:first-child {
        margin-top: 0;
}
#CF {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 10px solid #000000;
    bottom: 20%;
    height: 60%;
    left: 20%;
    overflow: auto;
    position: fixed;
    right: 20%;
    top: 20%;
    width: 60%;
    visibility: hidden;
}


.com {
    text-align: right;
}

h2 {
    margin-bottom: 0;
    margin-top: .5em;
}
small {
    display: block;
    margin-bottom: .8em;
}

h5 {
    margin-bottom: 0;
}
</style>


<?php include("footer.php");?>
