//(c)2017, MIT Style License <browser-update.org/LICENSE.txt>
//it is recommended to directly link to this file because we update the detection code
"use strict";

var $bu_= new function() {
    var s=this;
    this.vsakt={e:18,i:15,f:66,o:60,o_a:50.3,s:"12.1",c:74,y:"19.4",v:2.4,uc:"12.10",samsung:9.2,ios:12.1};
    //severly insecure below(!) this version, insecure means remote code execution that is actively being exploited
    this.vsinsecure_below = {i:11,e:15,c:64,f:59,y:18.4,s:"10.1.2",ios:"9.3.5",v:"1.14",uc:"12.6",samsung:"6.4",o_a:44,o:51};
    this.vsdefault = {e:-3,i:11,f:-3,o:-3,o_a:-3,s:-1,c:-3,a:535,y:18.6,v:1.12,uc:12.1,samsung:6.4,ios:9};
    this.names={i:'Internet Explorer',e:"Edge",f:'Firefox',o:'Opera',o_a:'Opera',s:'Safari',c:"Chrome",a:"Android Browser", y:"Yandex Browser",v:"Vivaldi",uc:"UC Browser",samsung:"Samsung Internet",x:"Other",ios:"iOS",silk:"Silk"};

    this.get_browser = function(ua) {
    var n,ua=(ua||navigator.userAgent).replace("_","."),r={n:"x",v:0,t:"other browser",age_years:undefined,no_device_update:false,available:s.vsakt};
    function ignore(reason,pattern){if (new RegExp(pattern,"i").test(ua)) return reason;return false}
    r.other=ignore("bot","bot|spider|archiver|transcoder|crawl|checker|monitoring|prerender|screenshot|python-|php|uptime|validator|fetcher|facebook|slurp|google|yahoo|node|mail.ru|github|cloudflare|addthis|thumb|proxy|feed|fetch|favicon|link|http|scrape|seo|page|search console|AOLBuild|Teoma|Expeditor")||
//        ignore("discontinued browser","camino|flot|fennec|galeon|coolnovo") ||
        ignore("TV","SMART-TV|SmartTV") ||
        ignore("niche browser","Dorado|LBBROWSER|waterfox|Firefox/56.2|Firefox/56.3|Whale|MIDP|k-meleon|sparrow|wii|Chromium|Puffin|Opera Mini|maxthon|maxton|dolfin|dolphin|seamonkey|opera mini|netfront|moblin|maemo|arora|kazehakase|epiphany|konqueror|rekonq|symbian|webos|PaleMoon|QupZilla|Otter|Midori|qutebrowser") ||
        ignore("mobile without upgrade path or landing page","cros|kindle|tizen|silk|blackberry|bb10|RIM|PlayBook|meego|nokia|ucweb|ZuneWP7|537.85.10");
//        ignore("android(chrome) web view","; wv");
    r.mobile=(/iphone|ipod|ipad|android|mobile|phone|ios|iemobile/i.test(ua));

    var pats=[
        ["CriOS.VV","c",'ios'],
        ["FxiOS.VV","f",'ios'],
        ["Trident.*rv:VV","i",'i'],
        ["Trident.VV","io",'i'],
        ["UCBrowser.VV","uc",'c'],
        ["MSIE.VV","i",'i'],
        ["Edge.VV","e",'e'],
        ["Vivaldi.VV","v",'c'],
        ["Android.*OPR.VV","o_a",'c'],
        ["OPR.VV","o",'c'],
        ["YaBrowser.VV","y",'c'],
        ["SamsungBrowser.VV","samsung",'c'],
        ["Silk.VV","silk",'c'],
        ["Chrome.VV","c",'c'],
        ["Firefox.VV","f",'f'],
        [" OS.VV.*Safari","ios",'ios'],
        ["Version.VV.*Safari","s",'s'],
        ["Safari.VV","so",'s'],
        ["Opera.*Version.VV","o"],
        ["Opera.VV","o"]
    ];
    var VV="(\\d+\\.?\\d+\\.?\\d*\\.?\\d*)";
    for (var i=0; i < pats.length; i++) {
        if (ua.match(new RegExp(pats[i][0].replace("VV",VV),"i"))) {
            r.n=pats[i][1];
            r.engine=pats[i][2];
            break;
        }        
    }
    r.fullv=RegExp.$1;
    r.v=parseFloat(r.fullv);

    // Special treatment of some systems
    //do not notify old systems since there is no up-to-date browser available
    if (/windows.nt.5.0|windows.nt.4.0|windows.95|windows.98|os x 10.2|os x 10.3|os x 10.4|os x 10.5/i.test(ua)) {
        r.no_device_update=true;
        r.available={}
    }
    //iOS
    if (/iphone|ipod|ipad|ios/i.test(ua)) {
        ua.match(new RegExp("OS."+VV,"i"));//
        r.n="ios";
        r.fullv=RegExp.$1;
        r.v=parseFloat(r.fullv);
        r.engine='ios';
        r.available = {"ios": s.available_ios(ua,v)}
        if (r.available.ios<11)
            r.no_device_update=true;
    }
    //winxp/vista/2003
    if (/windows.nt.5.1|windows.nt.5.2|windows.nt.6.0/i.test(ua)) {
        r.available={"c":49.9,"f":52.9}
    }
    //old mac
    if (/os x 10.6/i.test(ua)) {
        r.available = {"s": "5.1.10", "c": 49.9, "f": 48}
        r.no_device_update=true;
    }

    if (/os x 10.7|os x 10.8/i.test(ua)) {
        r.available = {"s": "6.2.8", "c": 49.9, "f": 48}
        r.no_device_update=true;
    }
    if (/os x 10.9/i.test(ua))
        r.available.s="9.1.3"

    if (/os x 10.10/i.test(ua))
        r.available.s="10.1.2"

    //check for android stock browser
    if (ua.indexOf('Android')>-1 && r.n==="s") {
        var v=parseInt((/WebKit\/([0-9]+)/i.exec(ua) || 0)[1],10) || 2000;
        if (v <= 534) {
            r.n="a";
            r.fullv=r.v=v;
            r.is_insecure=true;
        }
    }

    // Special treatment of some browsers
    if (r.n==="so") {
        r.v=r.fullv=4.0;
        r.n="s";
    }
    if (r.n==="io") {
        r.n="i";
        if (r.v>6) r.v=11;
        else if (r.v>5) r.v=10;
        else if (r.v>4) r.v=9;
        else if (r.v>3.1) r.v=8;
        else if (r.v>3) r.v=7;
        else r.v=9;
        r.fullv=r.v;
    }
    r.t=s.names[r.n]+" "+r.v;
    r.is_supported=r.is_latest= !s.vsakt[r.n] ? undefined : s.less(r.fullv,s.vsakt[r.n])<=0;
    
    r.vmaj=Math.round(r.v);

    r.is_insecure= r.is_insecure|| !s.vsinsecure_below[r.n] ? undefined :  s.less(r.fullv,s.vsinsecure_below[r.n])===1;
    
    if ((r.n==="f" && (r.vmaj===52 || r.vmaj===60)) || (r.n==="i" && r.vmaj===11)) {
        r.is_supported=true;
        r.is_insecure=false;
        if (r.n==="f")
            r.esr=true;
    }
    if ((r.n==="c"||r.n==="f"||r.n==="o") && s.less(r.fullv,parseFloat(s.vsakt[r.n])-1)<=0)
        r.is_supported=true; //mark also the version before the current version as supported to make the transitions smoother
    if (r.n==="ios" && r.v>10.3)
        r.is_supported=true;
    if (r.n==="a" || r.n==="x")
        r.t=s.names[r.n];
    if (r.n==="e")
        r.t=s.names[r.n]+" "+r.vmaj;    
    var releases_per_year={'f':7,'c':8,'o':8,'i':1,'e':1,'s':1}//,'v':1}
    if (releases_per_year[r.n]) {
        r.age_years=Math.round(((s.vsakt[r.n]-r.v)/releases_per_year[r.n])*10)/10 || 0
    }
    var engines={e:"Edge.VV",c:"Chrome.VV",f:"Firefox.VV",s:"Version.VV",i:"MSIE.VV","ios":" OS.VV"}
    if (r.engine) {
        ua.match(new RegExp(engines[r.engine].replace("VV",VV),"i"))
        r.engine_version=parseFloat(RegExp.$1)
    }    
    return r;
}
this.semver = function(vstr) {
    if (vstr instanceof Array)
        return vstr
    var x = (vstr+(".0.0.0")).split('.')
    return [parseInt(x[0]) || 0, parseInt(x[1]) || 0, parseInt(x[2]) || 0, parseInt(x[3]) || 0]
}
this.less= function(v1,v2) {
    //semantic version comparison: returns 1 if v1<v2 , 0 if equal, -1 if v1>v2
    v1=s.semver(v1)
    v2=s.semver(v2)
    for (var i=0; ;i++) {
        if (i>=v1.length) return i>=v2.length ? 0 : 1;
        if (i>=v2.length) return -1;
        var diff = v2[i]-v1[i]
        if (diff) return diff>0 ? 1 : -1;
    }
}
this.available_ios=function(ua,v) {
    var h = Math.max(window.screen.height, window.screen.width),pr = window.devicePixelRatio
    if (/ipad/i.test(ua)) {
        if (h == 1024 && pr == 2) // iPad 3 (iOS 9), 4, 5, Mini 2, Mini 3, Mini 4, Air, Air 2, Pro 9.7
            return 10//? only ipad 4 has ios 10, all other can have ios 11
        if (h == 1112)// iPad Pro 10.5
            return 15;
        if (h == 1366)//iPad Pro 12.9, Pro 12.9 (2nd Gen)
            return 15
        if (h == 1024 && v < 6)
            return 5 // iPad
        return 9 // iPad 2, iPad Mini
    }
    if (pr == 1)// 1/3G/3GS
        return 6//for 3GS
    if (h == 812)// && pr == 3)// X
        return 11 + 4
    if ((h == 736 || h == 667))// && pr == 3)// 6+/6s+/7+ and 8+ or // 6+/6s+/7+ and 8+ in zoom mode + // 6/6s/7 and 8
        return 8 + 5
    if (h == 568) // 5/5C/5s/SE or 6/6s/7 and 8 in zoom mode
        return 10
    if (h == 480) // i4/4s
        return 7
    return 6
}
/*
this.sub= function(v,minus) {
    //semantic version subtraction
    v=s.semver(v)
    minus=s.semver(minus)
    for (var i=0; ;i++) {
        if (i>=v.length||i>minus.length) break;
        v[i]-=v[minus];
    }
    return v.join('.')
}
*/
}

window.$bu_getBrowser=$bu_.get_browser;

var $buo = function(op,test) {
var n = window.navigator,b;
op=window._buorgres=op||{};
var ll = op.l||(n.languages ? n.languages[0] : null) || n.language || n.browserLanguage || n.userLanguage||document.documentElement.getAttribute("lang")||"en";
op.llfull=ll.replace("_","-").toLowerCase().substr(0,5);
op.ll=op.llfull.substr(0,2);
op.domain=op.domain!==undefined?op.domain:(/file:/.test(location.href)?"https:":"")+"//browser-update.org";
op.apiver=op.api||op.c||-1;
op.jsv="3.2.2npm";

var required_min=(op.apiver<2018&&{i:10,f:11,o:21,s:8,c:30})||{};

var vs=op.notify||op.vs||{};//old style config: maximum version to notify
vs.e=vs.e||vs.i;
vs.i=vs.i||vs.e;
var required=op.required||{};//minimum browser versions needed
required.e=required.e||required.i;
required.i=required.i||required.e;
for (b in $bu_.vsdefault) {
    if (vs[b]) {//old style: browsers to notify
        if ($bu_.less(vs[b],0)>=0) // required <= 0
            required[b]= parseFloat($bu_.vsakt[b])+parseFloat(vs[b])+0.01
        else
            required[b] = parseFloat(vs[b]) + 0.01
    }
    if (!required[b])
        required[b]=$bu_.vsdefault[b]
    if ($bu_.less(required[b],0)>=0) // required <= 0
        required[b]=$bu_.vsakt[b]+required[b]
    if (required_min[b] && $bu_.less(required[b],required_min[b])===1) // required < required_min
        required[b]=required_min[b]
}
required.ios=required.ios||required.s;

op.required=required;
op.reminder=op.reminder<0.1 ? 0 : op.reminder||(24*7);
op.reminderClosed=op.reminderClosed<1 ? 0 : op.reminderClosed||(24*7);
op.onshow = op.onshow||function(o){};
op.onclick = op.onclick||function(o){};
op.onclose = op.onclose||function(o){};
op.pageurl = op.pageurl || location.hostname || "x";
op.newwindow=(op.newwindow!==false);

op.test=test||op.test||(location.hash==="#test-bu")||false;

if (Math.random()*1200<1 && !op.test) {
    var i = new Image();    
}

op.test=test||op.test||location.hash==="#test-bu";

op.reasons=[];
op.hide_reasons=[];
function check_show(op) {
    var bb=$bu_.get_browser(op.override_ua);
    op.is_below_required = required[bb.n] && $bu_.less(bb.fullv,required[bb.n])===1; //bb.fullv<required
    if (bb.other!==false)
        op.hide_reasons.push("is other browser:" + bb.other)
    if ( bb.esr && !op.notify_esr)// || (bb.is_supported && !op.notify_also_supported))
        op.hide_reasons.push("Extended support (ESR)")
    if (bb.mobile&&op.mobile===false)
        op.hide_reasons.push("do not notify mobile")
    if (bb.no_device_update)
        op.hide_reasons.push("no device update")
    if (op.is_below_required)
        op.reasons.push("below required")
    if ((op.insecure||op.unsecure) && bb.is_insecure)
        op.reasons.push("insecure")
    if (op.unsupported && !bb.is_supported)
        op.reasons.push("no vendor support")
    if (op.hide_reasons.length>0)
        return false
    if (op.reasons.length>0)
        return true
    return false
 }

op.notified=check_show(op);
op.already_shown=document.cookie.indexOf("browserupdateorg=pause")>-1;

if (!op.test && (!op.notified || op.already_shown))
    return;

op.setCookie=function(hours) {
    document.cookie = 'browserupdateorg=pause; expires='+(new Date(new Date().getTime()+3600000*hours)).toGMTString()+'; path=/';
};
if (op.reminder>0)
    op.setCookie(op.reminder);

if (op.nomessage) {
    op.onshow(op);
    return;
}

$buo_show();
};

module.exports = $buo;



"use strict";
var $buo_show = function () {
    var op = window._buorgres;
    var bb = $bu_getBrowser();
    var burl = op.burl || ("http" + (/MSIE/i.test(navigator.userAgent) ? "" : "s") + "://browser-update.org/");
    if (!op.url) {
        op.url = burl + ((op.l && (op.l + "/")) || "") + "update-browser.html" + (op.test ? "?force_outdated=true" : "") + "#" + op.jsv ;
    }
    op.url_permanent_hide=op.url_permanent_hide || (burl + "block-ignore-browser-update-warning.html");
    /*
     if (Math.random()*1000<1 && !op.test && !op.betatest) {
     var i = new Image();
     var txt=op["text_"+ll]||op.text||"";
     var extra=encodeURIComponent("frac="+frac+"&txt="+txt+"&apiver="+op.apiver);
     
     }
     */
    function busprintf() {
        var args = arguments;
        var data = args[0];
        for (var k = 1; k < args.length; ++k) {
            data = data.replace(/%s/, args[k]);
        }
        return data;
    }


var t = {}, ta;
t.en = {
    msg: 'Your web browser ({brow_name}) is out of date.', msgmore: 'Update your browser for more security, speed and the best experience on this site.',        bupdate: 'Update browser',        bignore: 'Ignore',        remind: 'You will be reminded in {days} days.',        bnever: 'Never show again'    }
t.ar= {'msg': 'متصفح الإنترنت الخاص بك ({brow_name}) غير مُحدّث.','msgmore': 'قم بتحديث المتصفح الخاص بك لمزيد من الأمان والسرعة ولأفضل تجربة على هذا الموقع.','bupdate': 'تحديث المتصفح','bignore': 'تجاهل', 'remind': 'سيتم تذكيرك في غضون {days} أيام.', 'bnever': 'لا تظهر مرة أخرى'}
t.bg = '<b>Вашият браузър ({brow_name}) не е актуализиран.</b> Актуализирайте го за повече сигурност, удобство и най-добро изживяване на сайта. <a{up_but}>Актуализирайте браузъра</a> <a{ignore_but}>Игнорирайте</a>';
t.ca = 'El teu navegador ({brow_name}) està <b>desactualitzat.</b> Té <b>vulnerabilitats</b> conegudes i pot <b>no mostrar totes les característiques</b> d\'aquest i altres llocs web. <a{up_but}>Aprèn a actualitzar el navegador</a>';
t.cs = '<b>Váš webový prohlížeč ({brow_name}) je zastaralý .</b> Pro větší bezpečnost, pohodlí a optimální zobrazení této stránky si prosím svůj prohlížeč aktualizujte. <a{up_but}>Aktualizovat prohlížeč</a> <a{ignore_but}>Ignorovat</a>';
t.da= {'msg': 'Din web browser ({brow_name}) er forældet','msgmore': 'Opdater din browser for mere sikkerhed, hastighed og den bedste oplevelse på denne side.','bupdate': 'Opdater browser','bignore': 'Ignorer', 'remind': 'Du vil blive påmindet om {days} dage.', 'bnever': 'Vis aldrig igen'}
t.de= {'msg': 'Ihr Webbrowser ({brow_name}) ist veraltet.','msgmore': 'Aktualisieren Sie Ihren Browser für mehr Sicherheit, Geschwindigkeit und den besten Komfort auf dieser Seite.','bupdate': 'Browser aktualisieren','bignore': 'Ignorieren', 'remind': 'Sie werden in {days} Tagen wieder erinnert.', 'bnever': 'Nie wieder anzeigen'}
t.el= {'msg': 'Το πρόγραμμα περιήγησής σας ({brow_name}) είναι απαρχαιωμένο.','msgmore': 'Ενημερώστε το πρόγραμμα περιήγησής σας για περισσότερη ασφάλεια, ταχύτητα και την καλύτερη εμπειρία σ\' αυτόν τον ιστότοπο.','bupdate': 'Ενημερώστε το πρόγραμμα περιήγησης','bignore': 'Αγνοήστε', 'remind': 'Θα σας το υπενθυμίσουμε σε {days} ημέρες.', 'bnever': 'Να μην εμφανιστεί ξανά'}
t.es= {'msg': 'Su navegador web ({brow_name}) está desactualizado.','msgmore': 'Actualice su navegador para obtener más seguridad, velocidad y para disfrutar de la mejor experiencia en este sitio.','bupdate': 'Actualizar navegador','bignore': 'Ignorar', 'remind': 'Se le recordará en {days} días.', 'bnever': 'No mostrar de nuevo'}
t.fa = '<b> متصفح الويب ({brow_name}) الخاص بك قديم</b>. قُم بتحديث متصفحك للحصول على مزيدٍ من الحماية والراحة وتجربة أفضل على هذا الموقع. <a{up_but}> تحديث المتصفح</a> <a{ignore_but}> تجاهل</a>';
t.fi = '<b>Selaimesi ({brow_name}) on vanhentunut.</b> Päivitä selaimesi parantaaksesi turvallisuutta, mukavuutta ja käyttökokemusta tällä sivustolla. <a{up_but}>Päivitä selain</a> <a{ignore_but}>Ohita</a>';
t.fr= {'msg': 'Votre navigateur Web ({brow_name}) n\'est pas à jour.','msgmore': 'Mettez à jour votre navigateur pour plus de sécurité et de rapidité et la meilleure expérience sur ce site.','bupdate': 'Mettre à jour le navigateur','bignore': 'Ignorer', 'remind': 'Vous serez rappelé dans {days} jours.', 'bnever': 'Ne plus afficher'}
t.gl = 'Tá an líonléitheoir agat (%s) <b>as dáta.</b> Tá <b>laigeachtaí slándála</b> a bhfuil ar eolas ann agus b\'fhéidir <b>nach taispeánfaidh sé gach gné</b> den suíomh gréasáin seo ná cinn eile. <a%s>Foghlaim conas do líonléitheoir a nuashonrú</a>';
t.he= {'msg': 'דפדפן ({brow_name}) שלך אינו מעודכן.','msgmore': 'עדכן/י את הדפדפן שלך לשיפור האבטחה והמהירות וכדי ליהנות מהחוויה הטובה ביותר באתר זה.','bupdate': 'עדכן דפדפן','bignore': 'התעלם', 'remind': 'תקבל/י תזכורת בעוד  {days} ימים.', 'bnever': 'אל תציג שוב'}
t.hi= {'msg': 'आपका वेब ब्राउज़र ({brow_name}) पुराना है।','msgmore': 'इस साइट पर अधिक सुरक्षा, गति और सर्वोत्तम अनुभव करने के लिए अपने ब्राउज़र को अपडेट करें ।','bupdate': 'ब्राउज़र अपडेट करें','bignore': 'नजरअंदाज करें', 'remind': 'आपको {days} दिनों में याद दिलाया जाएगा।', 'bnever': 'फिर कभी मत दिखाना'}
t.hu = '<b>Az ön ({brow_name}) böngészője elavult.</b> Frissítse a böngészőjét több biztonság, kényelem és a legjobb felhasználói élmény érdekében ezen az oldalon. <a{up_but}>Böngésző frissítése</a> <a{ignore_but}>Mellőzés</a>';
t.id = '<b>Browser Anda ({brow_name}) sudah usang.</b> Perbarui browser Anda untuk pengalaman terbaik yang lebih aman dan nyaman di situs ini. <a{up_but}>Perbarui Browser</a> <a{ignore_but}>Abaikan</a>';
t.it= {'msg': 'Il tuo browser ({brow_name}) non è aggiornato.','msgmore': 'Aggiorna il browser per una maggiore sicurezza, velocità e la migliore esperienza su questo sito.','bupdate': 'Aggiorna browser','bignore': 'Ignora', 'remind': 'Riceverai un promemoria tra {days} giorni.', 'bnever': 'Non mostrare di nuovo'}
t.ja= {'msg': 'お使いのブラウザ ({brow_name}) は最新版ではございません。','msgmore': 'このサイトでのさらなるセキュリティ、速度および最高の体験のためにお使いのブラウザーを更新してください。','bupdate': 'ブラウザをアップデートする','bignore': '無視する', 'remind': '{days}後にお知らせします。', 'bnever': '今後表示しない'}
t.ko= {'msg': '귀하의 웹 브라우저({brow_name})는 오래되었습니다.','msgmore': '이 사이트에서 보안, 속도와 최상의 경험을 얻으려면 브라우저를 업데이트하십시오.','bupdate': '브라우저 업데이트하기','bignore': '무시하기', 'remind': '{days}일 후에 알려 드립니다.', 'bnever': '다시 표시하지 않기'}
t.lv = 'Jūsu pārlūkprogramma (%s) ir <b>novecojusi.</b>  Tai ir zināmas <b>drošības problēmas</b>, un tā var attēlot šo un citas  tīmekļa lapas <b>nekorekti.</b> <a%s>Uzzini, kā atjaunot savu pārlūkprogrammu</a>';
t.ms = '<b>Pelayar web ({brow_name}) anda sudah usang.</b> Kemas kini pelayar anda untuk memperoleh lebih keselamatan, keselesaan dan pengalaman terbaik di tapak ini. <a{up_but}>Kemas kini pelayar</a> <a{ignore_but}>Abaikan</a>';
t.nl= {'msg': 'Uw webbrowser ({brow_name}) is verouderd.','msgmore': 'Update uw browser voor meer veiligheid, snelheid en om deze site optimaal te kunnen gebruiken.','bupdate': 'Browser updaten','bignore': 'Negeren', 'remind': 'We zullen u er in {days} dagen aan herinneren.', 'bnever': 'Nooit meer tonen'}
t.no= {'msg': 'Nettleseren din ({brow_name}) er utdatert.','msgmore': 'Oppdater nettleseren din for økt sikkerhet, hastighet og den beste opplevelsen på dette nettstedet.','bupdate': 'Oppdater nettleser','bignore': 'Ignorer', 'remind': 'Du vil få en påminnelse om {days} dager.', 'bnever': 'Aldri vis igjen'}
t.pl= {'msg': 'Twoja przeglądarka ({brow_name}) jest nieaktualna.','msgmore': 'Zaktualizuj przeglądarkę, by korzystać z tej strony bezpieczniej, szybciej i po prostu sprawniej.','bupdate': 'Aktualizuj przeglądarkę','bignore': 'Ignoruj', 'remind': 'Przypomnimy o tym za {days} dni.', 'bnever': 'Nie pokazuj więcej'}
t.pt= {'msg': 'Seu navegador da web ({brow_name}) está desatualizado.','msgmore': 'Atualize seu navegador para ter mais segurança e velocidade, além da melhor experiência neste site.','bupdate': 'Atualizar navegador','bignore': 'Ignorar', 'remind': 'Você será relembrado em {days} dias.', 'bnever': 'Não mostrar novamente'}
t.ro = '<b>Browserul dumneavoastră ({brow_name}) nu este actualizat.</b> Actualizați-vă browserul pentru securitate sporită, confort și cea mai bună experiență pe site. <a{up_but}>Actualizează browser</a><a{ignore_but}>Ignoră</a>';
t.ru= {'msg': 'Ваш браузер ({brow_name}) устарел.','msgmore': 'Обновите ваш браузер для повышения уровня безопасности, скорости и комфорта использования этого сайта.','bupdate': 'Обновить браузер','bignore': 'Игнорировать', 'remind': 'Вы получите напоминание через {days} дней.', 'bnever': 'Больше не показывать '}
t.sk= {'msg': 'Váš internetový prehliadač ({brow_name}) je zastaraný.','msgmore': 'Pre väčšiu bezpečnosť, rýchlosť a lepšiu skúsenosť s touto stránkou si aktualizujte svoj prehliadač.','bupdate': 'Aktualizovať prehliadač','bignore': 'Ignorovať', 'remind': 'Bude vám to pripomenuté o {days} dní.', 'bnever': 'Už nikdy viac neukazovať'}
t.sl = 'Vaš brskalnik (%s) je <b>zastarel.</b> Ima več <b>varnostnih pomankljivosti</b> in morda <b>ne bo pravilno prikazal</b> te ali drugih strani. <a%s>Poglejte kako lahko posodobite svoj brskalnik</a>';
t.sq = '<b>Shfletuesi juaj ({brow_name}) është i vjetruar.</b> Përditësojeni shfletuesin tuaj për më tepër siguri, rehati dhe për funksionimin më të mirë në këtë sajt. <a{up_but}>Përditësojeni shfletuesin</a> <a{ignore_but}>Shpërfille</a>';
t.sr = 'Vaš pretraživač (%s) je <b>zastareo.</b> Ima poznate <b>sigurnosne probleme</b> i najverovatnije <b>neće prikazati sve funkcionalnisti</b> ovog i drugih sajtova. <a%s>Nauči više o nadogradnji svog pretraživača</a>';
t.sv= {'msg': 'Din webbläsare ({brow_name}) är föråldrad. ','msgmore': 'Uppdatera din webbläsare för mer säkerhet, hastighet och den bästa upplevelsen på den här sajten. ','bupdate': 'Uppdatera webbläsaren','bignore': 'Ignorera', 'remind': 'Du får en påminnelse om {days} dagar.', 'bnever': 'Visa aldrig igen'}
t.th = '<b>เว็บเบราว์เซอร์ ({brow_name}) ของคุณตกรุ่นแล้ว </b> อัพเดทเบราว์เซอร์ของคุณเพื่อเพิ่มความปลอดภัย ความสะดวกและประสบการณ์การใช้งานที่ดีที่สุดในเว็บไซท์นี้ <a{up_but}>อัพเดทเบราว์เซอร์</a> <a{ignore_but}>ไม่สนใจ</a>';
t.tr= {'msg': 'Web tarayıcınız ({brow_name}) güncel değil.','msgmore': 'Daha fazla güvenlik ve hız ile bu sitede en iyi deneyim için tarayıcınızı güncelleyin.','bupdate': 'Tarayıcıyı güncelle','bignore': 'Yok say', 'remind': '{days} gün sonra bir hatırlatma alacaksınız.', 'bnever': 'Bir daha gösterme'}
t.uk= {'msg': 'Ваш браузер ({brow_name}) застарілий.','msgmore': 'Оновіть свій браузер для більшої безпеки, швидкості та повноцінної роботи цього сайту.','bupdate': 'Оновити браузер','bignore': 'Пропустити', 'remind': 'Ви отримаєте нагадування через {days} днів.', 'bnever': 'Більше не показувати'}
t.vi = '<b>Trình duyệt web của bạn ({brow_name}) đã cũ.</b> Hãy nâng cấp trình duyệt của bạn để được an toàn và thuận lợi hơn đồng thời có được trải nghiệm tốt nhất với trang này';
t.zh= {'msg': '您的网页浏览器（{brow_name}）已过期。','msgmore': '更新您的浏览器，以便在该网站上获得更安全、更快速和最好的体验。','bupdate': '更新浏览器','bignore': '忽略', 'remind': '会在{days}天后提醒您。', 'bnever': '不再显示'}
t["zh-tw"]=t["zh-hans-cn"] = {'msg': '您的網路瀏覽器（{brow_name}）已過舊。','msgmore': '更新您的瀏覽器以獲得更佳的安全性、速度以及在此網站的最佳體驗。','bupdate': '更新瀏覽器','bignore': '忽略', 'remind': '您將在 {days} 天後收到提醒。', 'bnever': '不要再顯示'}
var custom_text = op["text_" + op.llfull] || op["text_" + op.ll] || op.text
t = ta = custom_text || t[op.llfull] || t[op.ll] || t.en;
if (ta.msg)
    t = '<b class="buorg-mainmsg">' + t.msg + '</b> <span class="buorg-moremsg">' + t.msgmore + '</span> <span class="buorg-buttons"><a{up_but}>' + t.bupdate + '</a> <a{ignore_but}>' + t.bignore + '</a></span>'

var tar = "";
if (op.newwindow)
    tar = ' target="_blank" rel="noopener noreferrer"';

var div = op.div = document.createElement("div");
div.id = div.className= "buorg";

var style = '<style>.buorg-icon {width: 22px; height: 16px; vertical-align: middle; position: relative; top: -0.05em; display: inline-block; background: no-repeat 0px center ;}</style>';
var style2 = '<style>.buorg {position:absolute;position:fixed;z-index:111111; width:100%; top:0px; left:0px; border-bottom:1px solid #A29330; text-align:center;  color:#000; background-color: #fff8ea; font: 18px Calibri,Helvetica,sans-serif; box-shadow: 0 0 5px rgba(0,0,0,0.2);animation: buorgfly 1s ease-out 0s;}'
    + '.buorg-pad { padding: 9px;  line-height: 1.7em; }'
    + '.buorg-buttons { display: block; text-align: center; }'
    + '#buorgig,#buorgul,#buorgpermanent { color: #fff; text-decoration: none; cursor:pointer; box-shadow: 0 0 2px rgba(0,0,0,0.4); padding: 1px 10px; border-radius: 4px; font-weight: normal; background: #5ab400;    white-space: nowrap;    margin: 0 2px; display: inline-block;}'
    + '#buorgig { background-color: #edbc68;}'
    + '@media only screen and (max-width: 700px){.buorg div { padding:5px 12px 5px 9px; line-height: 1.3em;}}'
    + '@keyframes buorgfly {from {opacity:0;transform:translateY(-50px)} to {opacity:1;transform:translateY(0px)}}'
    + '.buorg-fadeout {transition: visibility 0s 8.5s, opacity 8s ease-out .5s;}</style>';
if (ta.msg && (op.ll=="ar"||op.ll=="he"||op.ll=="fa"))
    style2+='<style>.buorg {direction:RTL; unicode-bidi:embed;}</style>';
if (!ta.msg && t.indexOf && t.indexOf("%s") !== -1) {//legacy style
    t = busprintf(t, bb.t, ' id="buorgul" href="' + op.url + '"' + tar);

    style += '<style>.buorg {position:absolute;position:fixed;z-index:111111; width:100%; top:0px; left:0px; border-bottom:1px solid #A29330; text-align:left; cursor:pointer; color:#000; font: 13px Arial,sans-serif;color:#000;}'
        + '.buorg div { padding:5px 36px 5px 40px; }'
        + '.buorg>div>a,.buorg>div>a:visited{color:#E25600; text-decoration: underline;}'
        + '#buorgclose{position:absolute;right:6px;top:0px;height:20px;width:12px;font:18px bold;padding:0;}'
        + '#buorga{display:block;}'
        + '@media only screen and (max-width: 700px){.buorg div { padding:5px 15px 5px 9px; }}</style>';
    div.innerHTML = '<div>' + t + '<div id="buorgclose"><a id="buorga">&times;</a></div></div>' + style;
    op.addmargin = true;
}
else {
    if (op.style === "bottom") {
        style2 += '<style>.buorg {bottom:0; top:auto; border-top:1px solid #A29330; } @keyframes buorgfly {from {opacity:0;transform:translateY(50px)} to {opacity:1;transform:translateY(0px)}}</style>';
    }
    else if (op.style === "corner") {
        style2 += '<style> .buorg { text-align: left; width:300px; top:50px; right:50px; left:auto; border:1px solid #A29330; } .buorg-buttons, .buorg-mainmsg, .buorg-moremsg { display: block; } .buorg-buttons a {margin: 4px 2px;} .buorg-icon {display: none;}</style>';
    }
    else {
        op.addmargin = true;
    }
    t = t.replace("{brow_name}", bb.t).replace("{up_but}", ' id="buorgul" href="' + op.url + '"' + tar).replace("{ignore_but}", ' id="buorgig"');
    div.innerHTML = '<div class="buorg-pad"><span class="buorg-icon"> </span>' + t + '</div>' + style + style2;
}

op.text = t;
if (op.container) {
    op.container.appendChild(div);
    op.addmargin = false;
}
else
    document.body.insertBefore(div, document.body.firstChild);

var updatebutton=document.getElementById("buorgul");
if (updatebutton) {
    updatebutton.onclick = function (e) {
        div.onclick = null;
        op.onclick(op);
        if (op.noclose)
            return
        op.setCookie(op.reminderClosed);
        if (!op.noclose) {
            div.style.display = "none";
            if (op.addmargin)
                hm.style.marginTop = op.bodymt;
        }
    };
}
if (!custom_text) {//make whole bar clickable except if custom text is set
    div.style.cursor="pointer";
    div.onclick = function () {
        if (op.newwindow)
            window.open(op.url, "_blank");
        else
            window.location.href = op.url;
        op.setCookie(op.reminderClosed);
        op.onclick(op);
    };
}

if (op.addmargin && op.shift_page_down !== false) {
    var hm = document.getElementsByTagName("html")[0] || document.body;
    op.bodymt = hm.style.marginTop;
    hm.style.marginTop = (div.clientHeight) + "px";
}
var ignorebutton = document.getElementById("buorga") || document.getElementById("buorgig");
if (ignorebutton) {
    ignorebutton.onclick = function (e) {
        div.onclick = null;
        op.onclose(op);
        if (op.addmargin && op.shift_page_down !== false)
            hm.style.marginTop = op.bodymt;
        op.setCookie(op.reminderClosed);
        if (!op.no_permanent_hide && ta.bnever && ta.remind) {
            op.div.innerHTML = '<div class="buorg-pad"><span class="buorg-moremsg">' + (op.reminderClosed > 24 ? ta.remind.replace("{days}", Math.round(op.reminderClosed/24)):"") + '</span> <span class="buorg-buttons"><a id="buorgpermanent" href="' + op.url_permanent_hide +'"' + tar + '>' + ta.bnever + '</a></span></div>' + style + style2;
            div.className = "buorg buorg-fadeout";
            document.getElementById("buorgpermanent").onclick = function (e) {
                op.setCookie(24 * 365);
                op.div.style.display = "none";
            }
            op.div.style.opacity = 0;
            op.div.style.visibility = "hidden";
            return false;
        }
        op.div.style.display = "none";
        return false;
    }
    if (op.noclose || op.reminderClosed==0) {
        ignorebutton.parentNode.removeChild(ignorebutton)
    }
}


op.onshow(op);
/*
if (op.test && !op.dont_show_debuginfo) {
    var e = document.createElement("script");
    e.src = op.domain + "/update.test.js";
    document.body.appendChild(e);
}
*/
};


