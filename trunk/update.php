<?php include("header.php");?>

	<div class="right">
			<h2>Kostenlose Webbrowser</h2>
			<p>Diese Browser sind die neuesten Versionen der meistbenutzten kostenlosen Webbrowser.</p>
			<p>
                Klicken Sie einfach einen Browser an um ihn von der Herstellerseite
                herunterzuladen:
            </p>
			<ul class="browsers">
				<li class="ff">
					<h3><a href="http://www.mozilla.com/firefox/" onmousedown="countBrowser('f')">Firefox 3</a></h3>
					<div>Weit verbreiteter Open-Source-Browser, stark erweiterbar und anpassbar</div>
					<a href="http://www.mozilla.com/firefox/" onmousedown="countBrowser('f')">Download</a>
				</li>
				<li class="op">
					<h3><a href="http://www.opera.com/" onmousedown="countBrowser('o')">Opera 9.6</a></h3>
					<div>Viele integrierte Extrafunktionen</div>
					<a href="http://www.opera.com/" onmousedown="countBrowser('o')">Download</a>
				</li>
				<li class="sa">
					<h3><a href="http://www.apple.com/safari/" onmousedown="countBrowser('s')">Safari 3.2</a></h3>
					<div>Schneller Browser von Apple</div>
					<a href="http://www.apple.com/safari/" onmousedown="countBrowser('s')">Download</a>
				</li>
				<li class="ch">
					<h3><a href="http://www.google.com/chrome" onmousedown="countBrowser('c')">Google Chrome 1.0</a></h3>
					<div>Browser von Google mit kompakter Oberfläche</div>
					<a href="http://www.google.com/chrome" onmousedown="countBrowser('c')">Download</a>
				</li>
				<li class="ie">
					<h3><a href="http://www.microsoft.com/windows/internet-explorer/default.aspx" onmousedown="countBrowser('i')">Internet Explorer 8</a></h3>
					<div>Windows-Standardbrowser</div>
					<a href="http://www.microsoft.com/windows/internet-explorer/default.aspx" onmousedown="countBrowser('i')">Download</a>
				</li>
			</ul>
			<p>
                Alle Browser bieten den selben grundlegenden Funktionsumfang und eine ähnliche Benutzerführung.
               <!-- Wir empfehlen alle Browser – bis auf den Internet Explorer
                wegen seiner begrenzten Funktionen, veralteten Webstandardsunterstützung und
                langsamen Geschwindigkeit.-->
            </p>
	</div>
	<div class="left">

		<div class="message">
			<p>
				Der Browser den Sie benutzen ist veraltet.

				Er besitzt bekannte <strong>Sicherheitsschwachstellen</strong>,
				bietet nur <strong>begrenzten Komfort</strong> und hat viele
				<strong>weitere Nachteile</strong>.
				<!--Sie können nicht alle Funktionen dieser Webseite sehen.-->
			</p>
		</div>

		<div>
			<p>
				Der Wechsel zu einem neueren Browser kann Ihnen eine Menge
				Vorteile bringen:
			</p>
			<ul class="advantages">
				<li class="security">
					<h3>Sicherheit</h3>
					<div>
						Neuere Browser schützen besser vor Betrug, Viren, Trojanern,
						Datendiebstahl und anderen Bedrohungen Ihrer Privatsphäre
						und Sicherheit. Aktuelle Browser schließen Sicherheitslücken,
						durch die Angreifer in Ihren Computer gelangen können.
					</div>
				</li>
				<li class="speed">
					<h3>Geschwindigkeit</h3>
					<div>
						Jede neue Browsergeneration verbessert die Geschwindigkeit,
						mit der Webseiten dargestellt werden.
					</div>
				</li>
				<li class="compatibility">
					<h3>Kompatibilität</h3>
					<div>
						Die auf modernen Webseiten eingesetzten Techniken werden
						durch aktuelle Browser besser unterstützt, wodurch die
						Funktionalität erhöht und die Darstellung verbessert wird.
					</div>
				</li>
				<li class="comfort">
					<h3>Komfort &amp; Leistung</h3>
					<div>
						Mit neuen Funktionen, Erweiterungen und besserer
						Anpassbarkeit aktueller Browser werden Sie schneller und
						einfacher im Internet surfen können.
					</div>
				</li>
			</ul>
		</div>

		<p>
			Ein Update ist einfach, dauert nur wenige Minuten und ist komplett
			kostenlos.
		</p>
		<p>Bitte wählen Sie einen Webbrowser auf der rechten Seite aus.</p>

		<div>
			<h2>Wofür diese Webseite?</h2>
			<p>
				Diese Webseite ist eine Initiative von Webdesignern, Webmastern
				und Bloggern, die ihren Besuchern helfen und das Web
				weiterbringen	wollen:
				Veraltete Browser sind ein <strong>Sicherheitsrisiko</strong>
				und <strong>blockieren den Fortschritt im Internet</strong>
				durch mangelhafte Funktionen und viele <strong>Fehler</strong>.
			</p>
			<p>
				<a href="./">Weitere Informationen</a>
			</p>
		</div>


		<h2>„Ich kann kein Update einspielen“</h2>
		<p>
			Wenn Sie sich an einem Computer in einem Firmennetzwerk befinden
			und keinen neuen Browser installieren können, fragen Sie Ihren
			Netzwerkadministrator nach einem Browserupdate.
    </p>

		<p>
			Wenn Sie auf Grund von Kompatibilitätsproblemen keinen neuen
			Browser installieren können, überlegen Sie sich, ob Sie nicht
			einfach einen zweiten Browser installieren wollen: Den Alten wegen
			der Kompatibilität und den Neuen zum komfortableren Surfen.
		</p>
	</div>


<!--<![CDATA[]]>-->
<script type="text/javascript">


function countBrowser(to) {
		var f=getBrowser();
		//TODO: / davor
        if ((f.n=="f" && f.v>2) ||(f.n=="o" && f.v>9.6) ||(f.n=="s" && f.v>3.1) ||(f.n=="i" && f.v>8))
            return;
        var i=new Image();
		i.src="count.php?ref="+escape(document.referrer)+"&from="+f.n+"&fromv="+f.v+"&to="+to;
		//console.log(i.src);
}
	function getBrowser() {
		var n,v,t,ua = navigator.userAgent;
		var names={i:'Internet Explorer',f:'Firefox',o:'Opera',s:'Apple Safari',n:'Netscape Navigator'};
		if (/MSIE (\d+\.\d+);/.test(ua))					n="i";
		else if (/Firefox.(\d+\.\d+)/.test(ua))				n="f";
		else if (/Version.(\d+.\d+).{0,10}Safari/.test(ua))	n="s";
		else if (/Safari.(\d+)/.test(ua))					n="so";
		else if (/Opera.(\d+\.\d+)/.test(ua))				n="o";
		else if (/Netscape.(\d+)/.test(ua))					n="n";
		else return {};

		v=new Number(RegExp.$1);
		if (n=="so") {
			v=((v<100) && 1.0) || ((v<130) && 1.2) || ((v<320) && 1.3) || ((v<520) && 2.0) || ((v<524) && 3.0) || ((v<526) && 3.2) ||4.0;
			n="s";
		}
		t=names[n];
		return {n:n,v:v,t:t+" "+v}
	}

</script>


<?php include("footer.php");?>
