<?php
require_once("lib/init.php");
require_once("lib/lang.php");
include("header.php");
?>



<div class="left">
<h2 class="top"><?php echo t('Contact'); ?></h2>
<?php
if (request_lang() != 'de')
{
	?>
	<hr />
	<h2 style="margin-top: 0">Not yet translated</h2>
	<p>
		This site is not yet translated. Please watch our <a href="/blog/">blog</a>
		for updates. If you are interested in translating Browser-Update.org or
		helping with its development, please contact us (See email adresses below).
	</p>
	<hr />
	<?php
}
?>
<p>
Über aktuelle Ereignisse informieren wir in unserem <a href="/blog/">Blog</a>.
</p>
<h2>Mithelfen</h2>
<p>
    Wir freuen uns über jeden Entwickler, der diese Chance ergreifen will
    um aktiv seine Vorschläge an Browser-Update.org einzubringen.
    Dazu haben wir ein <a href="http://code.google.com/p/browser-update/">Google-Code-Projekt</a>
    gestartet. Hier sammeln wir <a href="http://code.google.com/p/browser-update/issues/list">Ideen und Fehlerberichte</a>,
    die Seite kann übersetzt werden und der Code verbessert.
</p>
<p>
    Wir benötigen noch Programmierer und Übersetzer.
    Interessierte können einfach eine Email schreiben und wir fügen sie dann zum
    Projekt hinzu.
</p>
<h2>Initiatoren</h2>
<p>
Thomas Hümmer<br/>
jossele <var>æ</var> gmx.de<br/>
</p>
<p>
David Danier<br/>
david.danier <var>æ</var> team23.de<br/>
</p>
<p>
Wir sind Webdesigner, Open-Web-Enthusiasten und arbeiten unter anderem an folgenden Projekten:
<a href="http://fc.webmasterpro.de">FlashCounter Webseitenstatistiken</a>,
<a href="http://webmasterpro.de">Webmasterpro.de</a>,
<a href="http://webmasterpro.de/portal/webanalyse.html">Webanalyse</a>,
<a href="http://www.webmasterpro.de/portal/article/editor.html">WMP Editor</a>,
<a href="http://serverstats.berlios.de">Serverstats</a>.
<!--
Ich bin Webdesigner, Open-Web-Enthusiast und arbeite unter anderem an folgenden Projekten:
<a href="http://fc.webmasterpro.de">FlashCounter Webseitenstatistiken</a>,
<a href="http://webmasterpro.de">Webmasterpro.de</a>,
<a href="http://webmasterpro.de/portal/webanalyse.html">Webanalyse</a>,
<a href="http://www.webmasterpro.de/portal/article/editor.html">WMP Editor</a>.
-->
</p>
<p>
<a href="http://webmasterpro.de"><img src="/img/wmp_logo.png" alt="" /></a><br />
Browser-Update.org ist eine von <a href="http://webmasterpro.de">Webmasterpro.de</a>
gestartete Initiative zur Förderung neuer Browserversionen und Webstandards.
</p>

<h2>Copyright</h2>

<p>
    Some Images from this site are taken from the
    <a href="http://tango.freedesktop.org/Tango_Icon_Library">Tango Icon Library</a>
    whis is Licenesed under
    the <a href="http://creativecommons.org/licenses/by-sa/2.5/">CC-BY-SA </a>
</p>


<!--<h2>Privacy policy</h2>
<p>
If you include the script on your site,
no other Information then the  anonymous browser usgage is recorded.
No IP-adresses are recorded.
</p>
-->

</div>

<?php include("footer.php");?>