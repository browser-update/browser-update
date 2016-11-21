function getlang() {
	var n = window.navigator;
	var l =(n["language"])?n["language"]:n["userLanguage"];
	return l.substr(0,2);
}




function ignore(f) {
    return false;
    /*return (f.n==="f" && f.v>=44) ||
            (f.n==="o" && f.v>=33) ||
            (f.n==="s" && f.v>=9) ||
            (f.n==="i" && f.v>=12)||
            (f.n==="c" && f.v>=45);
    */
}
var ref=(document.referrer||"").substring(0,50);
ref=ref||((window.location.hash||"").match(/.*@(.*)/i)||(window.location.hash||"").match(/.*:(.*)/i)||["",""])[1]||"";
ref=escape(ref);
var tv=((window.location.hash||"").match(/#(\d*)/i)||["",""])[1]||"";

//if (ref.search(/(^|:\/\/)([^\/]{0,8}\.|)(google|bing|yahoo|ask|duckduckgo|blekko|yandex|baidu)\./i)>-1) 
//    tv=-4;

if (!tv && ref.search(/(google|bing|yahoo|ask|duckduckgo|blekko|yandex|baidu)\./i)>-1) 
    tv=-4;
///update.html?Installer=browser_update_bc_965562_pid_adshore_brand_wins
if (window.location.href.search(/Installer=/i)>-1) 
    tv=-5;

var tried=[];

var dice=Math.round(Math.random()*100);
function countBrowser(to) {
        var f=$bu_getBrowser();
        if (ignore(f))
            return;
        var s="";
        if (second)
            s="&second=1";
        var i=new Image();
        i.src="/count.php?cv="+cv+"&tv="+tv+"&ref="+ref+"&from="+f.n+"&fromv="+f.v+"&to="+to + s + "&dice="+dice+"rnd="+Math.random();
        second=true;
        tried.push(to);
}

function countView() {
        var f=$bu_getBrowser();
        if (ignore(f))
            return;
        var i=new Image();
        i.src="/count.php?what=view&cv="+cv+"&tv="+tv+"&ref="+ref+"&from="+f.n+"&fromv="+f.v+ "&dice="+dice+"rnd="+Math.random();
}