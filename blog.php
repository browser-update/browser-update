<?php
require_once("lib/init.php");
require_once("lib/lang.php");
include("header.php");
?>

<!--
<h2>Almost 400.000 Users updated their browser</h2>
<small>August 30th, 2011</small>
<div class="entry">
</div>
-->
<!--
<h2>IE7 moved to the decrepated browsers</h2>
<small>July 30th, 2011</small>
<div class="entry">
Many users have claimed that we should move Internet Explorer 7 to the outdated Browser when IE9 is released.
This has now happend. Users now get warnings when they still use Internet Explorer 7 which was releades
almost 5 years ago, on 31. October 2006.
It currently has a global Marketshare of around 5%.
</div>
-->

<h2>French translation and Drupal module</h2>
<small>July 30th, 2011</small>
<div class="entry">
Finally we can add French to the supported languages list.
Now we have four of the five <a href="http://en.wikipedia.org/wiki/List_of_languages_by_total_number_of_speakers#George_H._J._Weber.27s_estimate">top languages by native and secondary speakers</a>.
Thanks to <a href="http://www.ditwinemploi.com"Médéric</a> for the translation!
<p>
Furthermore, there is now <a href="'https://drupal.org/project/bu'">a module</a> for the Drupal Content management system available. Thanks to <a href="http://pebosi.net/drupal-module/browser-update">Peter</a>.
</p>
</div>
<div class="com"><a href="blog-entry.php?n=frenchdrupal" onclick="SC('frenchdrupal'); return false;">Comments</a></div>



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
<div class="com"><a href="blog-entry.php?n=msie6" onclick="SC('msie6'); return false;">Comments</a></div>


<h2>IE9 released</h2>
<small>March 5th, 2011</small>
<div class="entry">
Internet Explorer 9 has been released today. But it is not available for Windows XP, which has still a significant market share.
Since IE9 is only available for Windows Vista and Windows 7, we have introduced
a message for people using other Systems that they need to choose another browser.

"Internet Explorer 9 - 
Not available for your System. Only for Windows Vista or 7. Please choose another browser."
</div>
<div class="com"><a href="blog-entry.php?n=ie9update" onclick="SC('ie9update'); return false;">Comments</a></div>





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
<div class="com"><a href="blog-entry.php?n=news" onclick="SC('news'); return false;">Comments</a></div>


<!--
<h2>Almost 250.000 Users Updated</h2>
<small>March 5th, 2011</small>
<div class="entry">

</div>
-->
<script>
    function SC(name) {
        document.getElementById('CF').src="blog-entry.php?n="+name;
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
    height: 400px;
    left: 10%;
    overflow: auto;
    position: absolute;
    right: 10%;
    top: 0;
    width: 80%;
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