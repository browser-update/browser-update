<?php include("header.php");?>
   
<div class="left">
	<div class="message">

		<p>
            <b>
			Dieser Service bietet eine dezente und unaufdringliche Möglichkeit, Ihre Besucher darüber zu
            informieren, dass sie zu einem neueren Browser wechseln sollten.
            </b>
		</p>
		<p>
            Viele Internetbenutzer verwenden sehr alte und überholte Browser
            (z.B. den mittlerweile acht Jahre alten <b>Internet Explorer 6</b>) – meist ohne wirklichen Grund.

            Der Wechsel zu einem neueren Browser bietet für den Benutzer und für Sie als Webdesigner viele Vorteile.
			
			<!--They just have to be told, that using an old browser gives them disadvantages.-->
		</p>
		<!--<p>
			The more Websites Participate, the more the awareness to update will increase and old browser market share will drop faster!
		</p>-->
	</div>

		<h2>Wie funktioniert's?</h2>
		<ol class="steps">
			<li><div>
                Javascript-Benachrichtigungscode in Webseite <a href="#install">einbinden</a>
                </div></li>
			<li><div>
                Besucher mit veralteten Browsern erhalten eine
                unaufdringliche Meldung, dass
                ihr Browser nicht aktuell ist und es besser wäre auf eine neuere
                Version zu updaten
                (<a href="#" onclick="$bu=new $buo({},true);">Benachrichtigung testen!</a>)<br/>
                <a href="#" onclick="$bu=new $buo({},true);"><img src="img/bar-small.png" alt="" style="padding-top:6px;"/></a>
                </div></li>
			<li><div>
                Durch Anklicken der Meldung gelangt der Besucher auf eine
                <a href="update.php">Seite mit Argumenten für ein Update
                und einer Auswahl von aktuellen Browsern</a>.
			</div></li>
			<li><div>
                Der Besucher muss der Empfehlung nicht folgen
                und wird dann längere Zeit von einer erneuten
                Benachrichtigung verschont.
			</div></li>
        </ol>
        <!--
		<ol class="steps">
            <!-
			<li><div>
                You should (of course) code the Website that it is accessible by old webbrowsers, but you can leave some features/gimmicks out.
            </div></li>
            ->
			<li><div>
                Sie binden einen kleinen Javascript-Code <!-from browser-update.org-> in Ihre Webseite ein
                </div></li>
			<li><div>
                Wenn ein Besucher die Webseite mit einem veralteten Browser besucht,
                wird er durch eine nicht störende Meldung informiert, dass
                sein Browser nicht aktuell ist und es besser wäre auf eine neuere
                Version zu wechseln
                (<a href="#" onclick="$buo({},true);">Testen Sie die Benachrichtigung hier</a>)
                <!-, to see all the features of this website.->
                </div></li>
			<li><div>
                Er kann der Empfehlung folgen oder sie ignorieren.
                Eine erneute Benachrichtigung wird erst nach einigen Tagen 
                wieder erscheinen um den Benutzer nicht zu belästigen.
                <!- or taking no note of it and it will close automaitcally after some seconds.->
			</div></li>
			<li><div>
                Durch anklicken der Meldung gelangt der Besucher auf eine 
                <a href="update.php">Seite mit Argumenten für ein Update
                und einer Auswahl von aktuellen Browsern</a>.
			</div></li>
		</ol>
        -->
		<h2>Vorteile und Funktionen</h2>
		<ul class="advantages">
			<li>
				<h3>Unaufdringlich</h3>
                Der User wird nur einmal benachrichtigt und dann eine Zeitlang "verschont".
				Die Benachrichtigung ist sehr klein und behindert nicht bei der Seitenbenutzung.
			</li>
			<li>
				<h3>Informativ</h3>
                Informieren Sie Ihre Besucher, dass sie einen veralteten Browser verwenden
                und Ihre Webseite mit einem neueren Browser besser zu verwenden ist und mehr Funktionen bietet.
                Das Ganze können Sie mit unserem Werkzeug auf "standardisierte Art",
                zusammen mit vielen weiteren Webseiten machen.
			</li>
			<li>
				<h3>Idealistisch</h3>
                Helfen Sie das Web voranzubringen!
                Helfen Sie der Durchsetzung von Webstandards!
                Helfen Sie Open-Source-Software-Projekten!
                Helfen Sie Ihren Besuchern!
                Helfen Sie das Sicherheitsbewusstsein zu schärfen!
                Unterstützten Sie Ihren favorisierten Browser!
			</li>
			<li>
				<h3>Wartungsarm und aktuell</h3>
                Wenn weitere Browserversionen vom Hersteller <b>in Zukunft</b>
                nicht mehr unterstützt werden, Sicherheitslücken aufweisen oder
                sehr lange veraltet sind nehmen wir sie automatisch in unsere Liste auf.
			</li>
			<li>
				<h3>Statistiken</h3>
				Sie erhalten <a href="/stat.php">Statistiken</a> darüber, welche Browser
                Ihre Besucher benutzen und wie viele Benutzer durch Ihre Benachrichtigung
                "bekehrt" wurden.
			</li>
			<li>
				<h3>Anpassbar <span class="workingonit">in Arbeit...</span></h3>
				Sie können einstellen, bei welchen Browsern und Versionen die Meldung
                erscheinen soll.
				In Zukunft werden auch der angezeigte Text, die Häufigkeit der Benachrichtigung, das Design, die Größe
                und viele weitere Dinge anpassbar sein.
			</li>
            <li>
				<h3>Lokalisierung <span class="workingonit">in Arbeit...</span></h3>
				Die Benachrichtigung wird automatisch in der Sprache des Besuchers angezeigt.
			</li>


		</ul>

		
		
		<h2 id="install">Installation &amp; Konfiguration</h2>
		
		<p>
            Binden Sie einfach den hier generierten Code an bliebiger Stelle in Ihre Webseite ein.
		</p>
        <!--
		<p>
			You can customize the message or leave the defaults (recommended).
		</p>
        -->
		<div class="generate">
        <p>Bei folgenden Browserversionen soll die Benachrichtigung erscheinen:</p>
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
			</select>
		</span>
		<span class="browser">
			<label for="f-o">Opera</label> 
			<select id="f-o" onchange="code();">
				<option value="8">&lt;= 8.0</option>
				<option value="9">&lt;= 9.0</option>
				<option value="9.2" selected="selected">&lt;= 9.2</option>
			</select>
		</span>
		<span class="browser">
			<label for="f-s">Safari</label>  
			<select id="f-s" onchange="code();">
				<option value="1">&lt;= 1.0</option>
				<option value="1.2">&lt;= 1.2</option>
				<option value="2" selected="selected">&lt;= 2.0</option>
				<option value="3">&lt;= 3.0</option>
			</select>
		</span>
		<span class="browser">
			<label for="f-s">Chrome: </label>
			<span class="popupinfo">auto<span class="popup">Google Chrome besitzt eine immer aktive automatische Update-Funktion und ist deshalb immer aktuell.</span></span>
		</span>
        </div>
        <div>
            <input type="checkbox" checked="checked" id="autoupdate" onchange="code();"/>
            <label for="autoupdate"><b>Browservorgabe verwenden und automatisch aktualisieren</b> wenn Browser vom Hersteller
            nicht mehr unterstützt werden, Sicherheitslücken aufweisen oder
            sehr lange veraltet sind. </label>
        </div>
		
		<!--
		<h3>Break</h3>
		<div>
			The message should be shown again after <input id="pause" value="24" class="small"  onchange="code();" /> hours 
		</div>
		<div>
			or every time <input type="checkbox"  onchange="code();"/>.
		</div>
		
		
		<h3>Promote browsers</h3>
		
		<p>When the user reaches this page, he will be presented a collection of browsers he can download. You can modify this collection by your preferences.</p>
		
		<div>
			<label for="pie">IE</label> 
			<select id="pie">
				<option>recommend</option>
				<option selected="selected">neutral</option>
				<option>disadvise</option>
			</select>
		</div>
		<div>
			<label for="pop">Opera</label> 
			<select id="pop">
				<option>recommend</option>
				<option selected="selected">neutral</option>
				<option>disadvise</option>
			</select>
		</div>
		<div>	
			<label for="psa">Safari</label>  
			<select id="psa">
				<option>recommend</option>
				<option selected="selected">neutral</option>
				<option>disadvise</option>
			</select>
		</div>
		<div>
			<label for="pff">Firefox</label>  
			<select id="pff">
				<option>recommend</option>
				<option selected="selected">neutral</option>
				<option>disadvise</option>
			</select>
		</div>
		-->
		<h3>Der Code</h3>
		<textarea id="f-code" rows="10" cols="80">
&lt;script type="text/javascript">
var $buoop = {reminder:24}
$buoop.ol = window.onload;
window.onload=function(){
     var e = document.createElement("script");
     e.setAttribute("type", "text/javascript");
     e.setAttribute("src", "http://browser-update.org/update.js");
     document.body.appendChild(e);
     if ($buoop.ol) $buoop.ol();
}
&lt;/script>
		</textarea>
		
		</div>
		<p>
		</p>
		
		
		
		
		
		<h2>Warum Sie Ihre Besucher über Browserupdates informieren sollten</h2>
		<ul class="advantages">
			<li>
				<h3>Langfristige Senkung der Entwicklungskosten und -zeit</h3>
				<div>Webseiten für veraltete Browser zu optimieren ist äußerst zeitaufwendig, lästig und teuer.</div>
			</li>
			<li>
				<h3>Webdesign-Technologien und Funktionen</h3>
				<div>Es gibt all diese großartigen neuen Webstandards, sie werden auch schon in aktuellen Browsern
                unterstützt... aber wir können sie nicht benutzen!!
                <br/>
				Durch neuere Browser können Sie beim Webdesign mehr Funktionen und bessere Technologien benutzen
                (CSS3, SVG, HTML5, RSS, CSS Generated Content, flexible Layouts)
                und damit Ihren Besuchern auch eine besser bedienbare Webseite bieten.
                </div>
			</li>
			<li>
				<h3>Sicherheitsvorteile für den Benutzer</h3>
				<div>
                Zahlreiche Vorteile für den Benutzer: Sicherheit, Geschwindigkeit, Funktionen, Komfort, ... Alle aufgelistet auf der <a href="update.php">Update-Seite</a>
                Die Sicherheitsproblematik veralteter Browser wird
                <a href="http://www.techzoom.net/publications/insecurity-iceberg/index.en">
                in dieser Veröffentlichung ausführlich behandelt
                </a>.
                </div>
			</li>
			<li>
				<h3>Das Web muss sich weiterentwickeln...</h3>
				<div>...und das geht nur wirklich, wenn die Browser das auch tun.</div>
				Das Web hat sich immer weiterentwickelt. Aber der starke Marktanteil
                eines acht Jahre alten Webbrowsers (IE6) ist neu. <br/>
                Wenn wir nicht jetzt etwas unternehmen, müssen wir sogar noch im Jahr 2012 Webseiten programmieren,
                als wäre es noch 2001.
			</li>
			<li>
				<h3>Benutzer lehnen Updates nicht ab...</h3>
				...sie wissen nur meist einfach nicht, dass sie updaten sollten
                oder sind sich sogar der Existenz eines "Webbrowsers" als Software
                gar nicht bewusst.
			</li>
		</ul>
		
		
		
		
		
		
		<h2>Helfen Sie diesem Projekt</h2>
		<ul class="advantages">
			<li>
				<h3>Mitmachen!</h3>
                Binden Sie die automatische Benachrichtigung in Ihre Webseite ein
                und informieren Sie so Ihre Besucher über Browserupdates.
			</li>
			<li>
				<h3>Weitersagen!</h3>
				Erzählen Sie anderen Webdesignern und Webmastern über die Initiative!
                In Ihrem Blog, auf Ihrer Webseite, ...
			</li>
			<li>
				<h3>Übersetzen</h3>
				Übersetzen Sie diese Webseite in Ihre Sprache!
			</li>
		</ul>
		
	
</div>

<script type="text/javascript">
var $buoop = {reminder:24};
$buoop.ol = window.onload;
window.onload=function(){
     var e = document.createElement("script");
     e.setAttribute("type", "text/javascript");
     e.setAttribute("src", "update.js");
     document.body.appendChild(e);
     if ($buoop.ol) $buoop.ol();
}
code();
//redirect();
</script>
	

<?php include("footer.php");?>

