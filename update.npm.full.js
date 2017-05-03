//(c)2017, MIT Style License <browser-update.org/LICENSE.txt>
//it is recommended to directly link to this file because we update the detection code

function $bu_getBrowser(ua_str) {
    var n,t,ua=ua_str||navigator.userAgent,donotnotify=false;
    var names={i:'Internet Explorer',e:"Edge",f:'Firefox',o:'Opera',s:'Safari',n:'Netscape',c:"Chrome",a:"Android Browser", y:"Yandex Browser",v:"Vivaldi",x:"Other"};
    function ignore(reason,pattern){if (RegExp(pattern,"i").test(ua)) return reason;}
    var ig=ignore("bot","bot|spider|archiver|transcoder|crawl|checker|monitoring|screenshot|python-|php|uptime|validator|fetcher|facebook|slurp|google|yahoo|microsoft|node|mail.ru|github|cloudflare|addthis|thumb|proxy|feed|fetch|favicon|link|http|scrape|seo|page|search console|AOLBuild|Teoma|Gecko Expeditor")||
        ignore("discontinued browser","camino|flot|k-meleon|fennec|galeon|chromeframe|coolnovo") ||
        ignore("complicated device browser","SMART-TV|SmartTV") ||
        ignore("niche browser","Dorado|Whale|SamsungBrowser|MIDP|wii|UCBrowser|Chromium|Puffin|Opera Mini|maxthon|maxton|dolfin|dolphin|seamonkey|opera mini|netfront|moblin|maemo|arora|kazehakase|epiphany|konqueror|rekonq|symbian|webos|PaleMoon|QupZilla|Otter|Midori|qutebrowser") ||
        ignore("mobile without upgrade path or landing page","kindle|silk|blackberry|bb10|RIM|PlayBook|meego|nokia|ZuneWP7|537.85.10") ||
        ignore("android(chrome) web view","; wv");
    var mobile=(/iphone|ipod|ipad|android|mobile|phone|ios|iemobile/i.test(ua));
    if (ig) 
        return {n:"x",v:0,t:"other browser",donotnotify:ig};    

    var pats=[
        ["CriOS.VV","c"],
        ["FxiOS.VV","f"],
        ["Trident.*rv:VV","i"],
        ["Trident.VV","io"],
        ["MSIE.VV","i"],
        ["Edge.VV","e"],
        ["Vivaldi.VV","v"],
        ["OPR.VV","o"],
        ["YaBrowser.VV","y"],
        ["Chrome.VV","c"],
        ["Firefox.VV","f"],
        ["Version.VV.*Safari","s"],
        ["Safari.VV","so"],
        ["Opera.*Version.VV","o"],
        ["Opera.VV","o"],
        ["Netscape.VV","n"]
    ];
    for (var i=0; i < pats.length; i++) {
        if (ua.match(new RegExp(pats[i][0].replace("VV","(\\d+\\.?\\d?)"),"i"))) {
            n=pats[i][1];
            break;
        }        
    }
    if (n==="v"||n==="y") {//zero pad semver for easy comparing
        var parts = (RegExp.$1).split('.');
        var v=parseFloat(parts[0] + "." + ("00".substring(0, 2 - parts[1].length) + parts[1]));
    }
    else
        var v=parseFloat(RegExp.$1); 
    
    if (!n)
        return {n:"x",v:0,t:names[n],mobile:mobile};
    
    //do not notify old systems since there is no up-to-date browser available
    if (/windows.nt.5.0|windows.nt.4.0|windows.95|windows.98|os x 10.2|os x 10.3|os x 10.4|os x 10.5|os x 10.6|os x 10.7/i.test(ua)) 
        donotnotify="oldOS";
    
    //iOS
    if (/iphone|ipod|ipad|ios/i.test(ua)) {
        ua.replace("_",".").match(new RegExp("OS.(\\d+\\.?\\d?)","i"));//
        n="iOS";
        v=parseFloat(RegExp.$1); 
        var h = Math.max(window.screen.height, window.screen.width);
        if (h<=480 || window.devicePixelRatio<2) //iphone <5 and old iPads  // (h>568 -->iphone 6+)
              return {n:"s",v:v,t:"iOS "+v,donotnotify:"iOS without upgrade path",mobile:mobile};
        return {n:"s",v:v,t:"iOS "+v,donotnotify:false,mobile:mobile};//identify as safari
    }
    //check for android stock browser
    if (ua.indexOf('Android')>-1 && n==="s") {
        var ver=parseInt((/WebKit\/([0-9]+)/i.exec(ua) || 0)[1],10) || 2000;
        if (ver <= 534)
            return {n:"a",v:ver,t:names["a"],mob:true,donotnotify:donotnotify,mobile:mobile};
        //else
        //    return {n:n,v:v,t:names[n]+" "+v,donotnotify:"mobile on android",mobile:mobile};
    }

    //do not notify firefox ESR
    if (n=="f" && (Math.round(v)==45 || Math.round(v)==52))
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
var n = window.navigator,b,vsmin;
window._buorgres=this.op=op||{};
var ll = op.l||(n.languages ? n.languages[0] : null) || n.language || n.browserLanguage || n.userLanguage||document.documentElement.getAttribute("lang")||"en";
op.ll=ll=ll.replace("_","-").toLowerCase().substr(0,2);
op.apiver=op.api||op.c||-1;
var vsakt = {i:12,f:53,o:44,s:10.1,n:20,c:58,y:17.04,v:1.10};
var vsdefault = {i:-2,f:-4,o:-4,s:-1.7,n:12,c:-4,a:534,y:-0.2,v:-0.2};
if (op.apiver<4)
    vsmin={i:9,f:10,o:20,s:7};
else
    vsmin={i:8,f:5,o:12.5,s:6.2};
var myvs=op.vs||{};
var vs =op.vs||vsdefault;
for (b in vsdefault) {
    if (!vs[b])
        vs[b]=vsdefault[b];    
    if (vsakt[b] && vs[b]>=vsakt[b])
        vs[b]=vsakt[b]-0.2;
    if (vsakt[b] && vs[b]<0)
        vs[b]=vsakt[b]+vs[b];
    if (vsmin[b] && vs[b]<vsmin[b])
        vs[b]=vsmin[b];    
}
op.vsf=vs;
if (op.reminder<0.1 || op.reminder===0)
    op.reminder=0;
else
    op.reminder=op.reminder||24;
op.reminderClosed=op.reminderClosed||(24*7);
op.onshow = op.onshow||function(o){};
op.onclick = op.onclick||function(o){};
op.onclose = op.onclose||function(o){};
op.pageurl = op.pageurl || location.hostname || "x";
op.newwindow=(op.newwindow!==false);

op.test=test||op.test||(location.hash==="#test-bu")||(location.hash==="#test-bu-beta")||false;

var bb=$bu_getBrowser();
if (!op.test) {
    if (!bb || !bb.n || bb.n==="x" || bb.donotnotify!==false || (document.cookie.indexOf("browserupdateorg=pause")>-1 && op.reminder>0))
        return;
    if (bb.v>vs[bb.n] || (bb.mobile&&op.mobile===false) )    
        return;
}

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

var $buo_show = function() {
var op=this.op=window._buorgres;    
var jsv=24;
var tv=jsv;//"base";
var ll=op.ll;
var bb=$bu_getBrowser();
var burl=op.burl || "https://browser-update.org/";
if (!op.url) {
    if (op.l)
        op.url= burl+ll+"/update-browser.html#"+tv+":"+op.pageurl;
    else
        op.url= burl+"update-browser.html#"+tv+":"+op.pageurl;
}
var frac=1000;
if (Math.random()*frac<1 && !op.test && !op.betatest) {
    var i = new Image();
    var txt=op["text_"+ll]||op.text||"";
    var extra=encodeURIComponent("frac="+frac+"&txt="+txt+"&apiver="+op.apiver);
    i.src=burl+"count.php?what=noti&from="+bb.n+"&fromv="+bb.v + "&ref="+ escape(op.pageurl) + "&jsv="+jsv+"&tv="+tv+"&extra="+extra;
}

function busprintf() {
    var args=arguments;
    var data = args[ 0 ];
    for( var k=1; k<args.length; ++k ) {
        data = data.replace( /%s/, args[ k ] );
    }
    return data;
}


var t={};
t.en='<b>Your web browser ({brow_name}) is out of date.</b> Update your browser for more security, speed and the best experience on this site. <a{up_but}>Update your browser</a> <a{ignore_but}>Ignore</a>';


//t.af='';
t.ar='<b> متصفح الويب ({brow_name}) الخاص بك قديم.</b> قُم بتحديث متصفحك للحصول على مزيدٍ من الحماية والراحة وتجربة أفضل على هذا الموقع. <a{up_but}> تحديث المتصفح</a> <a{ignore_but}> تجاهل</a>';
t.bg='<b>Вашият браузър ({brow_name}) не е актуализиран.</b> Актуализирайте го за повече сигурност, удобство и най-добро изживяване на сайта. <a{up_but}>Актуализирайте браузъра</a> <a{ignore_but}>Игнорирайте</a>';
t.ca='El teu navegador (%s) està <b>desactualitzat.</b> Té <b>vulnerabilitats</b> conegudes i pot <b>no mostrar totes les característiques</b> d\'aquest i altres llocs web. <a%s>Aprèn a actualitzar el navegador</a>';
t.cs='<b>Váš webový prohlížeč ({brow_name}) je zastaralý .</b> Pro větší bezpečnost, pohodlí a optimální zobrazení této stránky si prosím svůj prohlížeč aktualizujte. <a{up_but}>Aktualizovat prohlížeč</a> <a{ignore_but}>Ignorovat</a>';
t.da='<b>Din netbrowser ({brow_name}) er forældet.</b> Opdater din browser for mere sikkerhed, komfort og den bedste oplevelse på denne side. <a{up_but}>Opdater browser</a> <a{ignore_but}>Ignorer</a>';
t.de='<p><b>Ihr Browser ({brow_name}) ist veraltet.</b> Aktualisieren Sie Ihren Browser für mehr Sicherheit, Komfort und die einwandfreie Nutzung dieser Webseite.</p> <a{up_but}>Browser aktualisieren</a> <a{ignore_but}>Ignorieren</a>';
t.el='<b>Η έκδοση του προγράμματος περιήγησής σας ({brow_name}) είναι παλιά.</b> Ενημερώστε τον περιηγητή σας για περισσότερη ασφάλεια, άνεση και την βέλτιστη εμπειρία σε αυτή την ιστοσελίδα. <a{up_but}>Αναβάθμιση περιηγητή</a> <a{ignore_but}>Παράβλεψη</a>';
t.es='<b>Tu navegador web ({brow_name}) no está actualizado.</b> Actualiza tu navegador para tener más seguridad y comodidad y tener la mejor experiencia en este sitio. <a{up_but}>Actualizar navegador</a> <a{ignore_but}>Ignorar</a>';
//t.et='';
t.fa = 'مرورگر شما (%s) <b>از رده خارج شده</b> می باشد. این مرورگر دارای <b>مشکلات امنیتی شناخته شده</b> می باشد و <b>نمی تواند تمامی ویژگی های این</b> وب سایت و دیگر وب سایت ها را به خوبی نمایش دهد. <a%s>در خصوص گرفتن راهنمایی درخصوص نحوه ی به روز رسانی مرورگر خود اینجا کلیک کنید.</a>';
t.fi='<b>Selaimesi ({brow_name}) on vanhentunut.</b> Päivitä selaimesi parantaaksesi turvallisuutta, mukavuutta ja käyttökokemusta tällä sivustolla. <a{up_but}>Päivitä selain</a> <a{ignore_but}>Ohita</a>';
t.fr='<b>Votre navigateur web ({brow_name}) n\'est pas à jour.</b> Mettez votre navigateur à jour pour plus de sécurité, de confort et une expérience optimale sur ce site. <a{up_but}>Mettre le navigateur à jour</a> <a{ignore_but}>Ignorer</a>';
t.ga='Tá an líonléitheoir agat (%s) <b>as dáta.</b> Tá <b>laigeachtaí slándála</b> a bhfuil ar eolas ann agus b\'fhéidir <b>nach taispeánfaidh sé gach gné</b> den suíomh gréasáin seo ná cinn eile. <a%s>Foghlaim conas do líonléitheoir a nuashonrú</a>';
t.gl = 'O seu navegador (%s) está <b>desactualizado.</b> Ten coñecidos <b>fallos de seguranza</b> e podería <b>non mostrar tódalas características</b> deste e outros sitios web. <a%s>Aprenda como pode actualizar o seu navegador</a>';
t.he = 'הדפדפן שלך (%s) <b>אינו מעודכן.</b> יש לו <b>בעיות אבטחה ידועות</b> ועשוי <b>לא להציג את כל התכונות</b> של אתר זה ואתרים אחרים. <a%s>למד כיצד לעדכן את הדפדפן שלך</a>';
t.hi='यह वेबसाइट आपको याद दिलाना चाहती हैं: आपका ब्राउज़र (%s) <b> आउट ऑफ़ डेट </ b> हैं। <a%s> और अधिक सुरक्षा, आराम और इस साइट पर सबसे अच्छा अनुभव करने लिए आपके ब्राउज़र को अपडेट करें</a>।';
//t.hr='';
t.hu='<b>Az ön ({brow_name}) böngészője elavult.</b> Frissítse a böngészőjét több biztonság, kényelem és a legjobb felhasználói élmény érdekében ezen az oldalon. <a{up_but}>Böngésző frissítése</a> <a{ignore_but}>Mellőzés</a>';
t.id='<b>Peramban web Anda ({brow_name}) sudah lawas.</b> Perbarui peramban Anda untuk pengalaman terbaik yang lebih aman dan nyaman di situs ini. <a{up_but}>Perbarui peramban</a> <a{ignore_but}>Abaikan</a>';
t.it='<b>Il suo browser web ({brow_name}) non è aggiornato.</b> Aggiorni il suo browser per ottenere maggiore sicurezza, comfort, e la migliore esperienza possibile su questo sito. <a{up_but}>Aggiorna il browser</a> <a{ignore_but}>Ignora</a>';
t.ja='<b>お使いのウェブブラウザ ({brow_name}) は古すぎます。</b>安全性と快適さを向上させ、このサイトで最高の体験が出来るよう、お使いのブラウザをアップデートしましょう。<a{up_but}>ブラウザをアップデートする</a> <a{ignore_but}>無視する</a>';
t.ko='<b>현재 귀하의 웹브라우저 ({brow_name})은(는) 구버전입니다.</b> 본 사이트의 향상된 보안 및 최고 품질의 편안한 서비스를 사용하기 위해서 브라우저를 업데이트해 주십시오. <a{up_but}>브라우저 업데이트</a> <a{ignore_but}>무시하기</a>';
//t.lt='';
t.lv='Jūsu pārlūkprogramma (%s) ir <b>novecojusi.</b>  Tai ir zināmas <b>drošības problēmas</b>, un tā var attēlot šo un citas  tīmekļa lapas <b>nekorekti.</b> <a%s>Uzzini, kā atjaunot savu pārlūkprogrammu</a>';
t.ms='<b>Pelayar web ({brow_name}) anda sudah usang.</b> Kemas kini pelayar anda untuk memperoleh lebih keselamatan, keselesaan dan pengalaman terbaik di tapak ini. <a{up_but}>Kemas kini pelayar</a> <a{ignore_but}>Abaikan</a>';
t.nl='<b>Uw webbrowser ({brow_name}) is verouderd.</b> Update uw browser voor meer veiligheid, comfort en de beste ervaring op deze site. <a{up_but}>Update browser</a> <a{ignore_but}>Negeer</a>';
t.no='<b>Nettleseren din,({brow_name}), er utdatert.</b> Oppdater nettleseren din for mer sikkerhet, komfort og den beste opplevelsen på denne siden. <a{up_but}>Oppdater nettleser</a> <a{ignore_but}>Ignorer</a>';
t.pl='<b>Państwa przeglądarka ({brow_name}) jest nieaktualna.</b> Aby zapewnić większe bezpieczeństwo, wygodę i komfort użytkowania w tej witrynie, proszę zaktualizować swoją przeglądarkę. <a{up_but}>Zaktualizuj przeglądarkę</a> <a{ignore_but}>Zignoruj</a>';
t.pt='<b>Seu navegador de internet ({brow_name}) está desatualizado.</b> Atualize seu navegador para obter mais segurança, conforto e a melhor experiência neste site. <a{up_but}>Atualizar navegador</a> <a{ignore_but}>Ignorar</a>';
t.ro='<b>Browserul dumneavoastră ({brow_name}) nu este actualizat.</b> Actualizați-vă browserul pentru securitate sporită, confort și cea mai bună experiență pe site. <a{up_but}>Actualizează browser</a><a{ignore_but}>Ignoră</a>';
t.ru='<b>Ваш веб-браузер ({brow_name}) устарел.</b> Обновите свой браузер, чтобы сделать пребывание на этом сайте более безопасным, комфортным и продуктивным. <a{up_but}>Обновить браузер</a> <a{ignore_but}>Игнорировать</a>';
t.sk='<b> Váš internetový prehliadač ({brow_name}) je zastaraný.</b> Aktualizujte váš prehliadač pre vyššiu bezpečnosť, komfort a najlepší zážitok na tejto stránke. <a{up_but}>Aktualizovať prehliadač</a><a{ignore_but}>Ignorovať</a>';
t.sl = 'Vaš brskalnik (%s) je <b>zastarel.</b> Ima več <b>varnostnih pomankljivosti</b> in morda <b>ne bo pravilno prikazal</b> te ali drugih strani. <a%s>Poglejte kako lahko posodobite svoj brskalnik</a>';
t.sq = 'Shfletuesi juaj (%s) është <b>ca i vjetër.</b> Ai ka <b>të meta sigurie</b> të njohura dhe mundet të <b>mos i shfaqë të gjitha karakteristikat</b> e kësaj dhe shumë faqeve web të tjera. <a%s>Mësoni se si të përditësoni shfletuesin tuaj</a>';
t.sr='Vaš pretraživač (%s) je <b>zastareo.</b> Ima poznate <b>sigurnosne probleme</b> i najverovatnije <b>neće prikazati sve funkcionalnisti</b> ovog i drugih sajtova. <a%s>Nauči više o nadogradnji svog pretraživača</a>';
t.sv='<b>Din webbläsare ({brow_name}) är föråldrad.</b> Uppdatera din webbläsare för bättre säkerhet, bekvämlighet och den bästa upplevelsen på den här sidan. <a{up_but}>Uppdatera webbläsare</a> <a{ignore_but}>Avstå</a>';
t.th='เว็บไซต์นี้อยากจะเตือนคุณ: เบราว์เซอร์ (%s) ของคุณนั้น <b>ล้าสมัยแล้ว</b> <a%s>ปรับปรุงเบราว์เซอร์ของคุณ</a> เพื่อเพิ่ม ความปลอดภัย ความสะดวกสบายและประสบการณ์ที่ดีที่สุดในเว็บไซต์นี้';
t.tr='<b>({brow_name}) internet tarayıcınız güncel değil.</b> Bu sitede daha fazla güvenlik, konfor ve en iyi deneyim için tarayıcınızı güncelleyin. <a{up_but}>Tarayıcıyı güncelle</a> <a{ignore_but}>Yoksay</a>';
t.uk='<b>Ваш браузер ({brow_name}) є застарілим.</b> Оновіть його заради безпечнішого, зручнішого та приємнішого перегляду цього та інших сайтів. <a{up_but}>Оновити</a> <a{ignore_but}>Скасувати</a>';
t.vi='<b>Trình duyệt web của bạn ({brow_name}) đã cũ.</b> Hãy nâng cấp trình duyệt của bạn để được an toàn và thuận lợi hơn đồng thời có được trải nghiệm tốt nhất với trang này. <a{up_but}>Nâng cấp trình duyệt</a> <a{ignore_but}>Bỏ qua</a>';
t.zh='<b>您的网页浏览器 ({brow_name}) 已过期。</b>更新您的浏览器，以提高安全性和舒适性，并获得访问本网站的最佳体验。<a{up_but}>更新浏览器</a> <a{ignore_but}>忽略</a>';
t["zh-tw"]='<b>您的網頁瀏覽器  ({brow_name}) 已經過時。</b> 請更新您的瀏覽器，以在此網站取得更安全、舒適的最佳瀏覽體驗。<a{up_but}>更新瀏覽器</a><a{ignore_but}>忽略</a>';


t=op["text_"+ll]||op.text||t[ll]||t.en;

var tar="";
if (op.newwindow)
    tar=' target="_blank" rel="noopener"';

var div = op.div = document.createElement("div");
div.id="buorg";
div.className="buorg";

var style='<style>.buorg {background: #FDF2AB no-repeat 14px center url('+burl+'img/small/'+bb.n+'.png);}</style>';
var style2='<style>.buorg {background-color: #edbc68; background-position: 8px 17px; position:absolute;position:fixed;z-index:111111; width:100%; top:0px; left:0px; border-bottom:1px solid #A29330; text-align:left; cursor:pointer;        background-color: #fff8ea;    font: 17px Calibri,Helvetica,Arial,sans-serif;    box-shadow: 0 0 5px rgba(0,0,0,0.2); animation: buorgfly 1s ease-out;}\
    .buorg p { padding: 11px 12px 11px 30px; margin: 0; line-height: 1.7em; }\
    .buorg-button { text-indent: 0; color: #fff; text-decoration: none; box-shadow: 0 0 2px rgba(0,0,0,0.4); padding: 1px 10px; border-radius: 4px; font-weight: normal; background: #5ab400; white-space: nowrap; margin: 0 2px; display: inline-block;}\
    .buorg-update {margin-left: 5px}\
    .buorg-ignore {background:#edbc68}\
    @media only screen and (max-width: 700px){.buorg p { padding:5px 12px 5px 9px; text-indent: 22px;line-height: 1.3em;}.buorg {background-position: 9px 8px;}}\
    @keyframes buorgfly {from {opacity:0;transform:translateY(-50px)} to {opacity:1;transform:translateY(0px)}}</style>';

if (t.indexOf("{brow_name}")===-1) {//legacy style
    t=busprintf(t,bb.t,' id="buorgul" href="'+op.url+'"'+tar);

    style += "<style>.buorg {position:absolute;position:fixed;z-index:111111; width:100%; top:0px; left:0px; border-bottom:1px solid #A29330; text-align:left; cursor:pointer; font: 13px Arial,sans-serif;color:#000;}\
    .buorg div { padding:5px 36px 5px 40px; }\
    .buorg>div>a,.buorg>div>a:visited{color:#E25600; text-decoration: underline;}\
    #buorgclose{position:absolute;right:6px;top:0px;height:20px;width:12px;font:18px bold;padding:0;}\
    #buorga{display:block;}\
    @media only screen and (max-width: 700px){.buorg div { padding:5px 15px 5px 9px; }}</style>";
    div.innerHTML= '<div>'+t+'<div id="buorgclose"><a id="buorga">&times;</a></div></div>'+style;
    op.addmargin=true;
}
else {
    if (op.position === "bottom") {
        style2 += "<style>.buorg {bottom:0; top:auto; border-top:1px solid #A29330; } @keyframes buorgfly {from {opacity:0;transform:translateY(50px)} to {opacity:1;transform:translateY(0px)}} \</style>";
    }
    else if (op.position === "corner") {
        style2 += "<style>.buorg { width:300px; top:50px; right:50px; left:auto; border:1px solid #A29330; } .buorg div b {display:block;} .buorg div span { display: block; } .buorg div a {margin: 4px 2px;}</style>";
    }
    else {
        op.addmargin = true;
    }
    t = t.replace("{brow_name}", bb.t).replace("{up_but}", ' id="buorgul" class="buorg-button buorg-update" href="' + op.url + '"' + tar).replace("{ignore_but}", ' id="buorgig" class="buorg-button buorg-ignore" href=""');
    div.innerHTML = '<p>' + t + '</p>' + style+style2;
}

op.text=t;
if (op.container) {
    op.container.appendChild(div);
    op.addmargin=false;
}
else
    document.body.insertBefore(div,document.body.firstChild);

var me=this;
div.onclick=function(){
    if (me.op.newwindow)
        window.open(me.op.url,"_blank");
    else
        window.location.href=me.op.url;
    me.op.setCookie(me.op.reminderClosed);
    me.op.onclick(me.op);
    return false;
};
try {
document.getElementById("buorgul").onclick = function(e) {
    e = e || window.event;
    if (e.stopPropagation) e.stopPropagation();
    else e.cancelBubble = true;
    me.op.div.style.display = "none";
    hm.style.marginTop = me.op.bodymt;    
    me.op.onclick(me.op);    
    return true;
};
}
catch(e) {}

if (op.addmargin) {
    var hm=document.getElementsByTagName("html")[0]||document.body;
    op.bodymt = hm.style.marginTop;
    hm.style.marginTop = (div.clientHeight)+"px";
}
(function(me) {
    (document.getElementById("buorga")||document.getElementById("buorgig")).onclick = function(e) {
        e = e || window.event;
        if (e.stopPropagation) e.stopPropagation();
        else e.cancelBubble = true;
        me.op.div.style.display = "none";
        if (me.op.addmargin)
            hm.style.marginTop = me.op.bodymt;
        me.op.onclose(me.op);
        me.op.setCookie(me.op.reminderClosed);
        return false;
    };
})(me);

if (op.noclose) {
    var el=(document.getElementById("buorga")||document.getElementById("buorgig"));
    el.parentNode.removeChild(el);
}
op.onshow(op);

};


