//browser-update.org notification script, <browser-update.org>
//Copyright (c) 2007-2015, MIT Style License <browser-update.org/LICENSE.txt>
//It is RECOMMEDED to directly link to this file and not to use a local copy
//because we update and maintain the detection code

function $bu_getBrowser(ua_str) {
    var n,t,ua=ua_str||navigator.userAgent,donotnotify=false;
    var names={i:'Internet Explorer',e:"Edge",f:'Firefox',o:'Opera',s:'Safari',n:'Netscape',c:"Chrome",a:"Android Browser", y:"Yandex Browser",v:"Vivaldi",x:"Other"};
    if (/bot|googlebot|facebook|slurp|SMART-TV|Dorado|AOLBuild|MIDP|wii|UCBrowser|Puffin|Opera Mini|silk|maxthon|SmartTV|maxton|mediapartners|dolfin|dolphin|adsbot|silk|bingbot|google web preview|chromeframe|seamonkey|opera mini|meego|netfront|moblin|maemo|arora|camino|flot|k-meleon|fennec|kazehakase|galeon|epiphany|konqueror|rekonq|symbian|webos|coolnovo|blackberry|bb10|RIM|PlayBook|PaleMoon|QupZilla|Otter|Midori|qutebrowser/i.test(ua)) 
        return {n:"x",v:0,t:"unknown",donotnotify:"niche browser"};
    if (/iphone|ipod|ipad|kindle/i.test(ua)) //without upgrade path or no landing page
        return {n:"x",v:0,t:"mobile browser",donotnotify:"mobile"};
    var mobile=(/iphone|ipod|ipad|android|mobile|phone|ios|iemobile/i.test(ua));
    var pats=[
        ["Trident.*rv:VV","i"],
        ["Trident.VV","io"],
        ["MSIE.VV","i"],
        ["Edge.VV","e"],
        ["Vivaldi.VV","v"],
        ["OPR.VV","o"],
        ["YaBrowser.*Chrome.VV","y"],
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
 
    //http://stackoverflow.com/questions/14403766/how-to-detect-the-stock-android-browser
    //check for android stock browser
    if (ua.indexOf('Android')>-1) {
        var ver=parseInt((/WebKit\/([0-9]+)/i.exec(ua) || 0)[1],10) || 2000;
        if (ver <= 534)
            return {n:"a",v:ver,t:names["a"],mob:true,donotnotify:donotnotify,mobile:mobile};
        else
            return {n:n,v:v,t:names[n]+" "+v,donotnotify:"mobile on android",mobile:mobile};
    }
    
    //do not notify ver old systems since their is no up-to-date browser available
    if (/windows.nt.5.0|windows.nt.4.0|windows.98|os x 10.4|os x 10.5|os x 10.3|os x 10.2/.test(ua)) 
        donotnotify="oldOS";

    //do not notify firefox ESR
    if (n=="f" && (Math.round(v)==38 || Math.round(v)==45))
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
var jsv=20;
var n = window.navigator,b;
window._buorgres=this.op=op||{};
var langset=this.op.l;
this.op.l = op.l||(n.languages ? n.languages[0] : null) || n.language || n.browserLanguage || n.userLanguage||document.documentElement.getAttribute("lang")||"en";
this.op.l=this.op.l.replace("_","-").toLowerCase();
var apiver=this.op.api||this.op.c||-1;
var ll=this.op.l.substr(0,2);
var vsakt = {i:12,f:49,o:39,s:9.1,n:20,c:53,y:16.4,v:1.4};
var vsdefault = {i:10,f:-3,o:-3,s:7.1,n:12,c:-3,a:534,y:-0.1,v:-0.1};
if (apiver<4)
    var vsmin={i:9,f:10,o:20,s:7,n:12};
else
    var vsmin={i:8,f:5,o:12.5,s:6.2,n:12};
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
this.op.vsf=vs;
if (op.reminder<0.1 || op.reminder===0)
    this.op.reminder=0;
else
    this.op.reminder=op.reminder||24;
this.op.reminderClosed=op.reminderClosed||(24*7);
this.op.onshow = op.onshow||function(o){};
this.op.onclick = op.onclick||function(o){};
this.op.onclose = op.onclose||function(o){};
var pageurl = op.pageurl || location.hostname || "x";
if (langset)
    this.op.url= op.url||"//browser-update.org/"+ll+"/update-browser.html#"+jsv+":"+pageurl;
else
    this.op.url= op.url||"//browser-update.org/update-browser.html#"+jsv+":"+pageurl;
this.op.newwindow=(op.newwindow!==false);

this.op.test=test||op.test||(location.hash=="#test-bu")||false;

var bb=$bu_getBrowser();
if (!this.op.test && (!bb || !bb.n || bb.n=="x" || bb.donotnotify!==false || (document.cookie.indexOf("browserupdateorg=pause")>-1 && this.op.reminder>0) || bb.v>vs[bb.n] || (bb.mobile&&op.mobile===false) ))
    return;
if (this.op.nomessage) {
    op.onshow(this.op);
    return;
}

if (!this.op.test  && Math.random()*100000<1) {
    var i = new Image();
    i.src="//browser-update.org/viewcount.php?n="+bb.n+"&v="+bb.v + "&p="+ escape(pageurl) + "&jsv="+jsv+ "&inv="+this.op.v+"&vs="+myvs.i+","+myvs.f+","+myvs.o+","+myvs.s;
}

function setCookie(hours) {
    var d = new Date(new Date().getTime()+3600000*hours);
    document.cookie = 'browserupdateorg=pause; expires='+d.toGMTString()+'; path=/';
}
if (this.op.reminder>0) {
    setCookie(this.op.reminder);
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
t.en='This website would like to remind you: Your browser (%s) is <b>out of date</b>. <a%s>Update your browser</a> for more security, comfort and the best experience on this site.';
t.de = 'Sie verwenden einen <b>veralteten Browser</b> (%s) mit <b>Sicherheitsschwachstellen</b> und <b>k&ouml;nnen nicht alle Funktionen dieser Webseite nutzen</b>. <a%s>Hier erfahren Sie, wie einfach Sie Ihren Browser aktualisieren k&ouml;nnen</a>.';
t.it = 'Il tuo browser (%s) <b>non è aggiornato</b>. Ha delle <b>falle di sicurezza</b> e potrebbe <b>non visualizzare correttamente</b> le pagine di questo e altri siti. <a%s>Aggiorna il tuo browser</a>!';
t.pl = 'Przeglądarka (%s), której używasz, jest przestarzała. Posiada ona udokumentowane <b>luki bezpieczeństwa, inne wady</b> oraz <b>ograniczoną funkcjonalność</b>. Tracisz możliwość skorzystania z pełni możliwości oferowanych przez niektóre strony internetowe. <a%s>Dowiedz się jak zaktualizować swoją przeglądarkę</a>.';
t.es = 'Su navegador (%s) <b>no está actualizado</b>. Tiene <b>fallos de seguridad</b> conocidos y podría <b>no mostrar todas las características</b> de este y otros sitios web. <a%s>Averigüe cómo actualizar su navegador.</a>';
t.nl = 'Uw browser (%s) is <b>oud</b>. Het heeft bekende <b>veiligheidsissues</b> en kan <b>niet alle mogelijkheden</b> weergeven van deze of andere websites. <a%s>Lees meer over hoe uw browser te upgraden</a>';
t.pt = 'Seu navegador (%s) está <b>desatualizado</b>. Ele possui <b>falhas de segurança</b> e pode <b>apresentar problemas</b> para exibir este e outros websites. <a%s>Veja como atualizar o seu navegador</a>';
t.sl = 'Vaš brskalnik (%s) je <b>zastarel</b>. Ima več <b>varnostnih pomankljivosti</b> in morda <b>ne bo pravilno prikazal</b> te ali drugih strani. <a%s>Poglejte kako lahko posodobite svoj brskalnik</a>';
t.ru = 'Ваш браузер (%s) <b>устарел</b>. Он имеет <b>уязвимости в безопасности</b> и может <b>не показывать все возможности</b> на этом и других сайтах. <a%s>Узнайте, как обновить Ваш браузер</a>';
t.id = 'Browser Anda (%s) sudah <b>kedaluarsa</b>. Browser yang Anda pakai memiliki <b>kelemahan keamanan</b> dan mungkin <b>tidak dapat menampilkan semua fitur</b> dari situs Web ini dan lainnya. <a%s> Pelajari cara memperbarui browser Anda</a>';
t.uk = 'Ваш браузер (%s) <b>застарів</b>. Він <b>уразливий</b> й може <b>не відображати всі можливості</b> на цьому й інших сайтах. <a%s>Дізнайтесь, як оновити Ваш браузер</a>';
t.ko = '지금 사용하고 계신 브라우저(%s)는 <b>오래되었습니다.</b> 알려진 <b>보안 취약점</b>이 존재하며, 새로운 웹 사이트가 <b>깨져 보일 수도</b> 있습니다. <a%s>브라우저를 어떻게 업데이트하나요?</a>';
t.rm = 'Tes navigatur (%s) è <b>antiquà</b>. El cuntegna <b>problems da segirezza</b> enconuschents e mussa eventualmain <b>betg tut las funcziuns</b> da questa ed autras websites. <a%s>Emprenda sco actualisar tes navigatur</a>.';
t.jp = 'お使いのブラウザ「%s」は、<b>時代遅れ</b>のバージョンです。既知の<b>脆弱性</b>が存在するばかりか、<b>機能不足</b>によって、サイトが正常に表示できない可能性があります。 <a%s>ブラウザを更新する方法を確認する</a>';
t.fr = 'Votre navigateur (%s) est <b>périmé</b>. Il contient des <b>failles de sécurité</b> et pourrait <b>ne pas afficher certaines fonctionnalités</b> des sites internet récents. <a%s>Découvrez comment mettre votre navigateur à jour</a>';
t.da = 'Din browser (%s) er <b>for&aelig;ldet</b>. Den har kendte <b>sikkerhedshuller</b> og kan m&aring;ske <b>ikke vise alle funktioner</b> p&aring; dette og andre websteder. <a%s>Se hvordan du opdaterer din browser</a>';
t.sq = 'Shfletuesi juaj (%s) është <b>ca i vjetër</b>. Ai ka <b>të meta sigurie</b> të njohura dhe mundet të <b>mos i shfaqë të gjitha karakteristikat</b> e kësaj dhe shumë faqeve web të tjera. <a%s>Mësoni se si të përditësoni shfletuesin tuaj</a>';
t.ca = 'El teu navegador (%s) està <b>desactualitzat</b>. Té <b>vulnerabilitats</b> conegudes i pot <b>no mostrar totes les característiques</b> d\'aquest i altres llocs web. <a%s>Aprèn a actualitzar el navegador</a>';
t.fa = 'مرورگر شما (%s) <b>از رده خارج شده</b> می باشد. این مرورگر دارای <b>مشکلات امنیتی شناخته شده</b> می باشد و <b>نمی تواند تمامی ویژگی های این</b> وب سایت و دیگر وب سایت ها را به خوبی نمایش دهد. <a%s>در خصوص گرفتن راهنمایی درخصوص نحوه ی به روز رسانی مرورگر خود اینجا کلیک کنید.</a>';
t.sv = 'Din webbläsare (%s) är <b>föråldrad</b>. Den har kända <b>säkerhetshål</b> och <b>kan inte visa alla funktioner korrekt</b> på denna och på andra webbsidor. <a%s>Uppdatera din webbläsare idag</a>';
t.hu = 'Az Ön böngészője (%s) <b>elavult</b>. Ismert <b>biztonsági hiányosságai</b> vannak és esetlegesen <b>nem tud minden funkciót megjeleníteni</b> ezen vagy más weboldalakon. <a%s>Itt talál bővebb információt a böngészőjének frissítésével kapcsolatban</a>		 ';
t.gl = 'O seu navegador (%s) está <b>desactualizado</b>. Ten coñecidos <b>fallos de seguranza</b> e podería <b>non mostrar tódalas características</b> deste e outros sitios web. <a%s>Aprenda como pode actualizar o seu navegador</a>';
t.cs = 'Váš prohlížeč (%s) je <b>zastaralý</b>. Jsou známy <b>bezpečnostní rizika</b> a možná <b>nedokáže zobrazit všechny prvky</b> této a dalších webových stránek. <a%s>Naučte se, jak aktualizovat svůj prohlížeč</a>';
t.he = 'הדפדפן שלך (%s) <b>אינו מעודכן</b>. יש לו <b>בעיות אבטחה ידועות</b> ועשוי <b>לא להציג את כל התכונות</b> של אתר זה ואתרים אחרים. <a%s>למד כיצד לעדכן את הדפדפן שלך</a>';
t.nb='Nettleseren din (%s) er <b>utdatert</b>. Den har kjente <b>sikkerhetshull</b> og <b>kan ikke vise alle funksjonene</b> på denne og andre websider. <a%s>Lær hvordan du kan oppdatere din nettleser</a>';
t["zh-tw"]='您的瀏覽器(%s) 需要更新。該瀏覽器有諸多安全漏洞，無法顯示本網站的所有功能。 <a%s>瞭解如何更新瀏覽器</a>';
t.zh='您的浏览器(%s) 需要更新。该浏览器有诸多安全漏洞，无法显示本网站的所有功能。 <a%s>了解如何更新浏览器</a>';
t.fi='Selaimesi (%s) on <b>vanhentunut</b>. Siinä on tunnettuja tietoturvaongelmia eikä se välttämättä tue kaikkia ominaisuuksia tällä tai muilla sivustoilla. <a%s>Lue lisää siitä kuinka päivität selaimesi</a>.';
t.tr='Tarayıcınız (%s) <b>güncel değil</b>. Eski versiyon olduğu için <b>güvenlik açıkları</b> vardır ve görmek istediğiniz bu web sitesinin ve diğer web sitelerinin <b>tüm özelliklerini hatasız bir şekilde</b> gösteremeyecektir. <a%s>Tarayıcınızı nasıl güncelleyebileceğinizi öğrenin</a>';
t.ro='Browser-ul (%s) tau este <b>invechit</b>. Detine <b>probleme de securitate</b> cunoscute si poate <b>sa nu afiseze corect</b> toate elementele acestui si altor site-uri. <a%s>Invata cum sa-ti actualizezi browserul.</a>';
t.bg='Вашият браузър (%s) <b>не е актуален</b>. Известно е, че има <b>пропуски в сигурността</b> и може <b>да не покаже правилно</b> този или други сайтове. <a%s>Научете как да актуализирате браузъра си</a>.';
t.el = 'Αυτός ο ιστότοπος σας υπενθυμίζει: Ο φυλλομετρητής σας (%s) είναι <b>παρωχημένος</b>. <a%s>Ενημερώστε το πρόγραμμα περιήγησής σας</a> για μεγαλύτερη ασφάλεια και άνεση σε αυτήν την ιστοσελίδα.';
t.ar='متصفحك (%s) <b>منتهى الصلاحيه</b>. ويوجد به <b>ثغرات امنية</b> معروفة وقد <b>لا يُشغل كثير من الميزات</b> المتعلقه بهذه الموقع. <a%s>أضغط هنا</a>لتعرف كيف تقوم بتحديث متصفحك';
t.sr='Vaš pretraživač (%s) je <b>zastareo</b>. Ima poznate <b>sigurnosne probleme</b> i najverovatnije <b>neće prikazati sve funkcionalnisti</b> ovog i drugih sajtova. <a%s>Nauči više o nadogradnji svog pretraživača</a>';
t.la='Mēs vēlamies Jums atgādināt: Jūsu pārlūkprogramma (%s) ir novecojusi. <a>Atjauniniet savu pārlūkprogrammu</a>, lai uzlabotu drošību, ātrumu un pārlūkošanas ērtības šajā un citās lapās.';
t.ga='Tá an líonléitheoir agat (%s) <b>as dáta</b>. Tá <b>laigeachtaí slándála</b> a bhfuil ar eolas ann agus b\'fhéidir <b>nach taispeánfaidh sé gach gné</b> den suíomh gréasáin seo ná cinn eile. <a%s>Foghlaim conas do líonléitheoir a nuashonrú</a>';
t.lv='Jūsu pārlūkprogramma (%s) ir <b>novecojusi</b>.  Tai ir zināmas <b>drošības problēmas</b>, un tā var attēlot šo un citas  tīmekļa lapas <b>nekorekti</b>. <a%s>Uzzini, kā atjaunot savu pārlūkprogrammu</a>';
t.no='Dette nettstedet ønsker å minne deg på: Din nettleser (%s) er <b>utdatert</b>. <a%s>Oppdater nettleseren din </a> for mer sikkerhet, komfort og den beste opplevelsen på denne siden.';
t.th='เว็บไซต์นี้อยากจะเตือนคุณ: เบราว์เซอร์ (%s) ของคุณนั้น <b>ล้าสมัยแล้ว</b> <a%s>ปรับปรุงเบราว์เซอร์ของคุณ</a> เพื่อเพิ่ม ความปลอดภัย ความสะดวกสบายและประสบการณ์ที่ดีที่สุดในเว็บไซต์นี้';

if (op.text)
    t = op.text;
else if (op["text_"+ll])
    t = op["text_"+ll];
else if (t[ll])
    t=t[ll];
else 
    t=t.en;

var tar="";
if (this.op.newwindow)
    tar=' target="_blank"';
this.op.text=busprintf(t,bb.t,' id="buorgul" href="'+this.op.url+'"'+tar);

var div = document.createElement("div");
this.op.div = div;
div.id="buorg";
div.className="buorg";

var style = "<style>.buorg {position:absolute;position:fixed;z-index:111111;\
width:100%; top:0px; left:0px;\
border-bottom:1px solid #A29330;\
background:#FDF2AB no-repeat 14px center url(//browser-update.org/img/small/"+bb.n+".png);\
text-align:left; cursor:pointer;\
font: 13px Arial,sans-serif;color:#000;}\
.buorg div { padding:5px 36px 5px 40px; }\
.buorg>div>a,.buorg>div>a:visited{color:#E25600; text-decoration: underline;}\
#buorgclose{position:absolute;right:6px;top:0px;height:20px;width:12px;font:18px bold;padding:0;}\
#buorga{display:block;}\
#buorgcc{display:block;position:absolute; top:-99999px;}\
@media only screen and (max-width: 700px){.buorg div { padding:5px 15px 5px 9px; }}</style>";
div.innerHTML= '<div>' + this.op.text + '<div id="buorgclose"><a id="buorga"><span id="buorgcc">Close</span><span aria-hiden="true">&times;</span></a></div></div>'+style;
document.body.insertBefore(div,document.body.firstChild);

var me=this;
div.onclick=function(){
    if (me.op.newwindow)
        window.open(me.op.url,"_blank");
    else
        window.location.href=me.op.url;
    setCookie(me.op.reminderClosed);
    me.op.onclick(me.op);
    return false;
};
try {
document.getElementById("buorgul").onclick = function(e) {
    e = e || window.event;
    if (e.stopPropagation) e.stopPropagation();
    else e.cancelBubble = true;
    me.op.onclick(me.op);
    return true;
};
}
catch(e) {}

var hm=document.getElementsByTagName("html")[0]||document.body;
this.op.bodymt = hm.style.marginTop;
hm.style.marginTop = (div.clientHeight)+"px";
(function(me) {
            document.getElementById("buorga").onclick = function(e) {
                e = e || window.event;
                if (e.stopPropagation) e.stopPropagation();
                else e.cancelBubble = true;
                me.op.div.style.display = "none";
                hm.style.marginTop = me.op.bodymt;
                me.op.onclose(me.op);
                setCookie(me.op.reminderClosed);
                return true;
            };
})(me);

op.onshow(this.op);

};

var $buoop = window.$buoop || {};
$buo($buoop);
