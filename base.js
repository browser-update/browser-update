
function code() {
    var autoupdate = document.getElementById("autoupdate");
    var vc = document.getElementById("browserversionchooser");
    //getomat('i')=="6" && getomat('f')=="2" && getomat('o')=="9.2" && getomat('s')=="2"
    if (autoupdate.checked) {
        var notify = "";
        setomatdefault('i',2);
        setomatdefault('f',2);
        setomatdefault('o',1);
        setomatdefault('s',2);
        vc.className = "disabled";
    }
    else {
        var notify = 'vs:{i:'+ getomat('i') +',f:'+ getomat('f') +',o:'+ getomat('o') +',s:'+ getomat('s') +'}';
        vc.className = "enabled";
    }
	var code="";
	code = '\
<script type="text/javascript"> \n\
var $buoop = {'+notify+'}; \n\
$buoop.ol = window.onload; \n\
window.onload=function(){ \n\
 try {if ($buoop.ol) $buoop.ol();}catch (e) {} \n\
 var e = document.createElement("script"); \n\
 e.setAttribute("type", "text/javascript"); \n\
 e.setAttribute("src", "//browser-update.org/update.js"); \n\
 document.body.appendChild(e); \n\
} \n\
</script> \n\
	';
	document.getElementById('f-code').value=code;
}

function getomat(id) {
    document.getElementById('f-'+ id).disabled=false;
	return document.getElementById('f-'+ id).value;
}

function setomatdefault(id, index) {
	document.getElementById('f-'+ id).selectedIndex=index;
    document.getElementById('f-'+ id).disabled=true;
}


function getlang() {
	var n = window.navigator;
	var l =(n["language"])?n["language"]:n["userLanguage"];
	return l.substr(0,2);
}




function ignore(f) {
    return false;
    return (f.n=="f" && f.v>=27) ||
            (f.n=="o" && f.v>=16) ||
            (f.n=="s" && f.v>=7) ||
            (f.n=="i" && f.v>=11)||
            (f.n=="c" && f.v>=32);
}

var ref=escape((document.referrer||"").substring(0,50)||((window.location.hash||"").match(/.*@(.*)/i)||["",""])[1]||"");
var tv=((window.location.hash||"").match(/#(\d*)/i)||["",""])[1]||"";

//if (ref.search(/(^|:\/\/)([^\/]{0,8}\.|)(google|bing|yahoo|ask|duckduckgo|blekko|yandex|baidu)\./i)>-1) 
//    tv=-4;

if (!tv && ref.search(/(google|bing|yahoo|ask|duckduckgo|blekko|yandex|baidu)\./i)>-1) 
    tv=-4;
///update.html?Installer=browser_update_bc_965562_pid_adshore_brand_wins
if (window.location.href.search(/Installer=/i)>-1) 
    tv=-5;

function countBrowser(to) {
        var f=getBrowser();
        if (ignore(f))
            return;
        var s="";
        if (second)
            s="&second=1";
        var i=new Image();
        i.src="/count.php?cv="+cv+"&tv="+tv+"&ref="+ref+"&from="+f.n+"&fromv="+f.v+"&to="+to + s + "&rnd="+Math.random();
        second=true;
}

function countView() {
        var f=getBrowser();
        if (ignore(f))
            return;
        var i=new Image();
        i.src="/countchoice.php?cv="+cv+"&tv="+tv+"&ref="+ref+"&from="+f.n+"&fromv="+f.v+ "&rnd="+Math.random();
}

function getBrowser() {
    var n,v,t,ua = navigator.userAgent;
    var names={i:'Internet Explorer',f:'Firefox',o:'Opera',s:'Apple Safari',n:'Netscape Navigator', c:"Chrome", x:"Other"};
    if (/bot|googlebot|facebook|slurp|wii|silk|blackberry|mediapartners|adsbot|silk|android|phone|bingbot|google web preview|like firefox|chromeframe|seamonkey|opera mini|min|meego|netfront|moblin|maemo|arora|camino|flot|k-meleon|fennec|kazehakase|galeon|android|mobile|iphone|ipod|ipad|epiphany|rekonq|symbian|webos/i.test(ua)) n="x";
    else if (/Trident.*rv:(\d+\.\d+)/i.test(ua)) n="i";
    else if (/Trident.(\d+\.\d+)/i.test(ua)) n="io";
    else if (/MSIE.(\d+\.\d+)/i.test(ua)) n="i";
    else if (/OPR.(\d+\.\d+)/i.test(ua)) n="o";
    else if (/Chrome.(\d+\.\d+)/i.test(ua)) n="c";
    else if (/Firefox.(\d+\.\d+)/i.test(ua)) n="f";
    else if (/Version.(\d+.\d+).{0,10}Safari/i.test(ua))	n="s";
    else if (/Safari.(\d+)/i.test(ua)) n="so";
    else if (/Opera.*Version.(\d+\.\d+)/i.test(ua)) n="o";
    else if (/Opera.(\d+\.?\d+)/i.test(ua)) n="o";
    else if (/Netscape.(\d+)/i.test(ua)) n="n";
    else return {n:"x",v:0,t:names[n]};
    
    var v=new Number(RegExp.$1);
    var donotnotify=false;
    //do not notify ver old systems since their is no up-to-date browser available
    if (/windows.nt.5.0|windows.nt.4.0|windows.98|os x 10.4|os x 10.5|os x 10.3|os x 10.2/.test(ua)) donotnotify="oldOS";
    
    //do not notify firefox ESR
    if (n=="f" && Math.round(v)==24)
        donotnotify="ESR";
    //do not notify opera 12 on linux since it is the latest version
    if (/linux|x11|unix|bsd/.test(ua) && n=="o" && v>12) 
        donotnotify="Opera12Linux";
    
    if (n=="x") return {n:"x",v:v||0,t:names[n]};
    

    if (n=="so") {
        v=((v<100) && 1.0) || ((v<130) && 1.2) || ((v<320) && 1.3) || ((v<520) && 2.0) || ((v<524) && 3.0) || ((v<526) && 3.2) ||4.0;
        n="s";
    }
    if (n=="i" && v==7 && window.XDomainRequest) {
        v=8;
    }
    if (n=="io") {
        n="i";
        if (v>6) v=11;
        else if (v>5) v=10;
        else if (v>4) v=9;
        else if (v>3.1) v=8;
        else if (v>3) v=7;
        else v=9;
    }	
    return {n:n,v:v,t:names[n]+" "+v,donotnotify:donotnotify};
}