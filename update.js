//(c)2017, MIT Style License <browser-update.org/LICENSE.txt>
//it is recommended to directly link to this file because we update the detection code

function $bu_getBrowser(ua_str) {
    var n,t,ua=ua_str||navigator.userAgent,donotnotify=false;
    var names={i:'Internet Explorer',e:"Edge",f:'Firefox',o:'Opera',s:'Safari',n:'Netscape',c:"Chrome",a:"Android Browser", y:"Yandex Browser",v:"Vivaldi",x:"Other"};
    function ignore(reason,pattern){if (RegExp(pattern,"i").test(ua)) return reason;}
    var ig=ignore("bot","bot|spider|googlebot|facebook|slurp|bingbot|google web preview|mediapartnersadsbot|AOLBuild|Baiduspider|DuckDuckBot|Teoma")||
        ignore("discontinued browser","camino|flot|k-meleon|fennec|galeon|chromeframe|coolnovo") ||
        ignore("complicated device browser","SMART-TV|SmartTV") ||
        ignore("niche browser","Dorado|SamsungBrowser|MIDP|wii|UCBrowser|Chromium|Puffin|Opera Mini|maxthon|maxton|dolfin|dolphin|seamonkey|opera mini|netfront|moblin|maemo|arora|kazehakase|epiphany|konqueror|rekonq|symbian|webos|PaleMoon|QupZilla|Otter|Midori|qutebrowser") ||
        ignore("mobilew without upgrade path or landing page","iphone|ipod|ipad|kindle|silk|blackberry|bb10|RIM|PlayBook|meego|nokia") ||
        ignore("android(chrome) web view","; wv");
    if (ig) 
        return {n:"x",v:0,t:"other browser",donotnotify:ig};    

    var mobile=(/iphone|ipod|ipad|android|mobile|phone|ios|iemobile/i.test(ua));
    var pats=[
        ["Trident.*rv:VV","i"],
        ["Trident.VV","io"],
        ["MSIE.VV","i"],
        ["Edge.VV","e"],
        ["Vivaldi.VV","v"],
        ["OPR.VV","o"],
        ["YaBrowser.VV","y"],
        ["Chrome.VV","c"],
        ["Firefox.VV","f"],
        ["Version.VV.{0,10}Safari","s"],
        ["Safari.VV","so"],
        ["Opera.*Version.VV","o"],
        ["Opera.VV","o"],
        ["Netscape.VV","n"]
    ];
    for (var i=0; i < pats.length; i++) {
        if (ua.match(new RegExp(pats[i][0].replace("VV","(\\d+\\.?\\d?)")),"i")) {            
            n=pats[i][1];
            break;
        }        
    }
    var v=parseFloat(RegExp.$1); 
    
    if (!n)
        return {n:"x",v:0,t:names[n],mobile:mobile};
    
    //check for android stock browser
    if (ua.indexOf('Android')>-1) {
        var ver=parseInt((/WebKit\/([0-9]+)/i.exec(ua) || 0)[1],10) || 2000;
        if (ver <= 534)
            return {n:"a",v:ver,t:names["a"],mob:true,donotnotify:donotnotify,mobile:mobile};
        //else
        //    return {n:n,v:v,t:names[n]+" "+v,donotnotify:"mobile on android",mobile:mobile};
    }
    
    //do not notify ver old systems since their is no up-to-date browser available
    if (/windows.nt.5.0|windows.nt.4.0|windows.95|windows.98|os x 10.2|os x 10.3|os x 10.4|os x 10.5|os x 10.6|os x 10.7/.test(ua)) 
        donotnotify="oldOS";

    //do not notify firefox ESR
    if (n=="f" && (Math.round(v)==38 || Math.round(v)==45 || Math.round(v)==52))
        donotnotify="ESR";

    if (n=="so") {
        v=4.0;
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
    if (n=="e") {
        return {n:"i",v:v,t:names[n]+" "+v,donotnotify:donotnotify,mobile:mobile};
    }
    return {n:n,v:v,t:names[n]+" "+v,donotnotify:donotnotify,mobile:mobile};
}

var $buo = function(op,test) {
var jsv=24;
var n = window.navigator,b;
window._buorgres=this.op=op||{};
var ll = op.l||(n.languages ? n.languages[0] : null) || n.language || n.browserLanguage || n.userLanguage||document.documentElement.getAttribute("lang")||"en";
this.op.ll=ll=ll.replace("_","-").toLowerCase().substr(0,2);
this.op.apiver=this.op.api||this.op.c||-1;
var vsakt = {i:12,f:50,o:42,s:10,n:20,c:55,y:16.9,v:1.5};
var vsdefault = {i:10,f:-4,o:-4,s:-2,n:12,c:-4,a:534,y:-1,v:-0.1};
if (this.op.apiver<4)
    var vsmin={i:9,f:10,o:20,s:7,n:12};
else
    var vsmin={i:8,f:5,o:12.5,s:6.2,n:12};
var myvs=op.vs||{};
var vs =op.vs||vsdefault;
for (b in vsdefault) {
    if (vs[b] === 0)
        continue;
    if (!vs[b])
        vs[b]=vsdefault[b];    
    if (vsakt[b] && vs[b]>=vsakt[b])
        vs[b]=vsakt[b]-0.2;
    if (vsakt[b] && vs[b]<0)
        vs[b]=vsakt[b]+vs[b];
    if (vsmin[b] && vs[b]<vsmin[b])
        vs[b]=vsmin[b];    
}
this.op.vsf=vs;
if (op.reminder<0.1 || op.reminder===0)
    this.op.reminder=0;
else
    this.op.reminder=op.reminder||24;
this.op.reminderClosed=op.reminderClosed||(24*7);
this.op.onshow = op.onshow||function(o){};
this.op.onclick = op.onclick||function(o){};
this.op.onclose = op.onclose||function(o){};
var pageurl = this.op.pageurl = op.pageurl || location.hostname || "x";
if (op.l)
    this.op.url= op.url||"//browser-update.org/"+ll+"/update-browser.html#"+jsv+":"+pageurl;
else
    this.op.url= op.url||"//browser-update.org/update-browser.html#"+jsv+":"+pageurl;
this.op.newwindow=(op.newwindow!==false);

this.op.test=test||op.test||(location.hash=="#test-bu")||(location.hash=="#test-bu-beta")||false;

var bb=$bu_getBrowser();
if (!this.op.test && bb && bb.n && vs[bb.n] && (bb.n=="x" || bb.donotnotify!==false || (document.cookie.indexOf("browserupdateorg=pause")>-1 && this.op.reminder>0) || bb.v>vs[bb.n] || (bb.mobile&&op.mobile===false) ))
    return;

this.op.setCookie=function(hours) {
    document.cookie = 'browserupdateorg=pause; expires='+(new Date(new Date().getTime()+3600000*hours)).toGMTString()+'; path=/';
}
if (this.op.reminder>0)
    this.op.setCookie(this.op.reminder);

if (this.op.nomessage) {
    op.onshow(this.op);
    return;
}

/*
if (this.op.betatest || (location.hash=="#test-bu-beta") || (!this.op.test && (ll==="en"||ll==="de") && this.op.reminder>1 && Math.random()*50<1)) {
    var e=document.createElement("script");
    e.src=(/file:/.test(location.href)) ? "update.showx.js":"//browser-update.org/update.showx.js"; 
    return document.body.appendChild(e);
}
*/

var e=document.createElement("script");
e.src="//browser-update.org/update.show.min.js"; 
e.src=(/file:/.test(location.href)) ? "update.show.js":"//browser-update.org/update.show.min.js"; //REMOVE
document.body.appendChild(e);

};

var $buoop = window.$buoop || {};
$buo($buoop);
