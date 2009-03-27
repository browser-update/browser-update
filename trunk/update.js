$addE = function ( obj, type, fn ) {
    if (obj.addEventListener) obj.addEventListener( type, fn, false );
    else if (obj.attachEvent) {
        obj["e"+type+fn] = fn;
        obj[type+fn] = function() { obj["e"+type+fn]( window.event ); }
        obj.attachEvent( "on"+type, obj[type+fn] );
    }
}

var $buo = function(op,test) {
    var jsv=1;
	var n = window.navigator;
	var l =(n["language"])?n["language"]:n["userLanguage"];
	var vs =op.vs||{i:6,f:2,o:9.3,s:2,n:10};
	var hours=op.reminder||24;
	var url="http://browser-update.org/update.php";
	var d = new Date(new Date().getTime() +1000*3600*hours);


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

	var b=getBrowser(),t;

	if (!test && (!b.n || document.cookie.indexOf("browserupdateorg=pause")>-1 || b.v>vs[b.n]))
		return;

	var i = new Image();
    i.src="http://browser-update.org/viewcount.php?n="+b.n+"&v="+b.v + "&p="+ escape(window.location.hostname) + "&jsv="+jsv;

	document.cookie = 'browserupdateorg=pause; expires='+d.toGMTString()+'';
	
	var ll=l.substr(0,2);
	if (ll=="de")// <b>Sicherheitsl&uuml;cken</b>
		t = 'Sie verwenden einen <b>veralteten Browser</b> ('+b.t+') \
            mit <b>Sicherheitsschwachstellen</b> und <b>k&ouml;nnen nicht alle \
            Funktionen dieser Webseite nutzen</b>. \
            <a href="'+url+'" style="color:#E25600;">Hier erfahren Sie, wie einfach Sie Ihren Browser aktualisieren k&ouml;nnen</a>.';
	else 
		t = 'Your Browser ('+b.t+') <b>is long time out of date</b>. It has known <b>security flaws</b> and may <b>not display all features</b> of this and other websites.<br> For your own security and advantages: <a href="'+url+'">Please Upgade your Browser by clicking here</a>';
	

	var languages = "de,xx";
    //todo
	//if (languages.indexOf(ll)!==false)
	//	var url="http://browser-update.org/lang/"+ll+"/update.php";
	
	var div = document.createElement("div"); 
	div.style.cssText = "position:absolute; \
    width:100%;\
    top:0px; left:0px; cursor:pointer; border-bottom:1px solid #A29330; \
    background:#FDF2AB no-repeat 1em 0.55em url(http://browser-update.org/img/dialog-warning.gif);\
    text-align:left; \
    font-family: Arial,Helvetica,sans-serif; \
    color:#000; \
    font-size: 12px;";
	//div.setAttribute("style", div.style.cssText);
	div.innerHTML= '<div style="padding:5px 36px 5px 40px;">' + t + '\
    <div id="buoclose" style="position: absolute; right: .5em; top:.2em; height: 20px; width: 12px; font-weight: bold;font-size:14px;">X</div>\
    </div>';
	div.onclick=function(){window.location.href=url;};
    //document.getElementsByTagName("body")[0];
	document.body.appendChild(div);
	var mt = document.body.style.marginTop;
	document.body.style.marginTop = (div.clientHeight+5)+"px";
    document.getElementById("buoclose").onclick = function(e) {
      var event = e || window.event;
        if (event.stopPropagation) {
            event.stopPropagation();
        } else {
            event.cancelBubble = true;
        }
        div.style.display="none";
        document.body.style.marginTop = mt;
        return true;
    }
}
var $buoop = $buoop||{};
$bu=$buo($buoop);
