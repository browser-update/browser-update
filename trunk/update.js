//browser-update.org notification script, <browser-update.org>
//Copyright (c) 2007-2009, MIT Style License <browser-update.org/LICENSE.txt>
var $buo = function(op,test) {

var jsv=4;
var n = window.navigator,b;
this.op=op||{};
//options
this.op.l = op.l||n["language"]||n["userLanguage"]||document.documentElement.getAttribute("lang")||"en";
this.op.vsakt = {i:8,f:3.5,o:9.64,s:4,n:10};
this.op.vsdefault = {i:6,f:2,o:9.63,s:3,n:10};
this.op.vs =op.vs||this.op.vsdefault;
for (b in this.op.vsakt)
    if (this.op.vs[b]>=this.op.vsakt[b])
        this.op.vs[b]=this.op.vsdefault[b];

this.op.reminder=op.reminder||24;
this.op.onshow = op.onshow||function(o){};
this.op.url= op.url||"http://browser-update.org/update.html";
this.op.pageurl = op.pageurl || window.location.hostname || "unknown";
this.op.newwindow=op.newwindow||false;

this.op.test=test||op.test||false;
if (window.location.hash=="#test-bu")
    this.op.test=true;

function getBrowser() {
    var n,v,t,ua = navigator.userAgent;
    var names={i:'Internet Explorer',f:'Firefox',o:'Opera',s:'Apple Safari',n:'Netscape Navigator', c:"Chrome", x:"Other"};
    if (/MSIE (\d+\.\d+);/.test(ua)) n="i";
    else if (/Arora|Camino/.test(ua)) n="x";
    else if (/Chrome.(\d+\.\d+)/.test(ua)) n="c";
    else if (/Firefox.(\d+\.\d+)/.test(ua)) n="f";
    else if (/Version.(\d+.\d+).{0,10}Safari/.test(ua))	n="s";
    else if (/Safari.(\d+)/.test(ua)) n="so";
    else if (/Opera.*Version.(\d+\.\d+)/.test(ua)) n="o";
    else if (/Opera.(\d+\.\d+)/.test(ua)) n="o";
    else if (/Netscape.(\d+)/.test(ua)) n="n";
    else return {n:"x",v:0,t:names[n]};

    v=new Number(RegExp.$1);
    if (n=="so") {
        v=((v<100) && 1.0) || ((v<130) && 1.2) || ((v<320) && 1.3) || ((v<520) && 2.0) || ((v<524) && 3.0) || ((v<526) && 3.2) ||4.0;
        n="s";
    }
    if (n=="i" && v==7 && window.XDomainRequest) {
        v=8;
    }
    return {n:n,v:v,t:names[n]+" "+v}
}

this.op.browser=getBrowser();
if (!this.op.test && (!this.op.browser || !this.op.browser.n || this.op.browser.n=="x" || this.op.browser.n=="c" || document.cookie.indexOf("browserupdateorg=pause")>-1 || this.op.browser.v>this.op.vs[this.op.browser.n]))
    return;

if (!this.op.test) {
    var i = new Image();
    i.src="http://browser-update.org/viewcount.php?n="+this.op.browser.n+"&v="+this.op.browser.v + "&p="+ escape(this.op.pageurl) + "&jsv="+jsv;
}
if (this.op.reminder!=0) {
    var d = new Date(new Date().getTime() +1000*3600*this.op.reminder);
    document.cookie = 'browserupdateorg=pause; expires='+d.toGMTString()+'; path=/';
}
var ll=this.op.l.substr(0,2);
var languages = "de,en";
if (languages.indexOf(ll)!==false)
    this.op.url="http://browser-update.org/"+ll+"/update.html";

if (ll=="de")
    this.op.text = 'Sie verwenden einen <b>veralteten Browser</b> ('+this.op.browser.t+') \
        mit <b>Sicherheitsschwachstellen</b> und <b>k&ouml;nnen nicht alle \
        Funktionen dieser Webseite nutzen</b>. \
        <a href="'+this.op.url+'">Hier erfahren Sie, wie einfach Sie Ihren Browser aktualisieren k&ouml;nnen</a>.';
else
    this.op.text = 'Your browser ('+this.op.browser.t+') is <b>out of date</b>. It has known <b>security flaws</b> and may <b>not display all features</b> of this and other websites. \
         <a href="'+this.op.url+'">Learn how to update your browser</a>';


var div = document.createElement("div");
this.op.div = div;
div.id="buorg";
div.className="buorg";
div.innerHTML= '<div>' + this.op.text + '<div id="buorgclose">X</div></div>';

var sheet = document.createElement("style");
//sheet.setAttribute("type", "text/css");
var style = ".buorg {position:absolute; \
width:100%; top:0px; left:0px; \
border-bottom:1px solid #A29330; \
background:#FDF2AB no-repeat 1em 0.55em url(http://browser-update.org/img/dialog-warning.gif);\
text-align:left; cursor:pointer; \
font-family: Arial,Helvetica,sans-serif; color:#000; font-size: 12px;}\
.buorg div { padding:5px 36px 5px 40px; } \
.buorg a {color:#E25600; text-decoration: underline;}\
#buorgclose { position: absolute; right: .5em; top:.2em; height: 20px; width: 12px; font-weight: bold;font-size:14px; padding:0; }";
document.body.appendChild(div);
document.getElementsByTagName("head")[0].appendChild(sheet);
try {
    sheet.innerText=style;
    sheet.innerHTML=style;
}
catch(e) {
    try {
        sheet.styleSheet.cssText=style;
    }
    catch(e) {
        return;
    }
}
var me=this;
div.onclick=function(){
    if (me.op.newwindow)
        window.open(me.op.url,"_blank");
    else
        window.location.href=me.op.url;
};
this.op.bodymt = document.body.style.marginTop;
document.body.style.marginTop = (div.clientHeight)+"px";
document.getElementById("buorgclose").onclick = function(e) {
    var e = e || window.event;
    if (e.stopPropagation) e.stopPropagation();
    else e.cancelBubble = true;
    me.op.div.style.display="none";
    document.body.style.marginTop = me.op.bodymt;
    return true;
}
op.onshow(this.op);

}
var $buoop = $buoop||{};
$bu=$buo($buoop);
