//browser-update.org notification script, <browser-update.org>
//Copyright (c) 2007-2014, MIT Style License <browser-update.org/LICENSE.txt>
//It is RECOMMEDED to directly link to this file and not to use a local copy
//because we update and maintain the detection code
var $buo = function(op,test) {
var jsv=14;
var n = window.navigator,b;
this.op=op||{};
//options
this.op.l = op.l||n["language"]||n["userLanguage"]||document.documentElement.getAttribute("lang")||"en";
var ll=this.op.l.substr(0,2);
this.op.vsakt = {i:11,f:28,o:12.1,s:7,n:20,c:32};
//this.op.vsdefault = {i:8,f:10,o:12,s:5,n:10};
this.op.vsdefault = {i:8,f:23,o:12,s:5.2,n:12,c:28};
this.op.vsmin={i:7,f:5,o:12,s:5,n:10,c:28};
var myvs=op.vs||{};
this.op.vs =op.vs||this.op.vsdefault;
for (b in this.op.vsakt) {
    if (this.op.vs[b]>=this.op.vsakt[b])
        this.op.vs[b]=this.op.vsakt[b]-0.2;
    if (!this.op.vs[b])
        this.op.vs[b]=this.op.vsdefault[b];
    if (this.op.vs[b]<this.op.vsmin[b])
        this.op.vs[b]=this.op.vsmin[b];      
}
if (op.reminder<0.1 || op.reminder===0)
    this.op.reminder=0;
else
    this.op.reminder=op.reminder||24;

this.op.onshow = op.onshow||function(o){};
this.op.onclick = op.onclick||function(o){};
this.op.url= op.url||"http://browser-update.org/update-browser.html#"+jsv+"@"+(location.hostname||"x");
if (op.l)
	this.op.url= op.url||"http://browser-update.org/"+ll+"/update-browser.html#"+jsv+"@"+(location.hostname||"x");
this.op.pageurl = op.pageurl || window.location.hostname || "unknown";
this.op.newwindow=(op.newwindow!==false);

this.op.test=test||op.test||false;
if (window.location.hash=="#test-bu")
    this.op.test=true;


if (op.exp || (ll==="en" && !this.op.test && Math.round(Math.random()*200)<1)) { //test new script
     var e = document.createElement("script");
     e.setAttribute("type", "text/javascript");
     e.setAttribute("src", "//browser-update.org/updatex.js");
     document.body.appendChild(e);
     return;
}


function getBrowser() {
    var n,v,t,ua = navigator.userAgent;
    var names={i:'Internet Explorer',f:'Firefox',o:'Opera',s:'Apple Safari',n:'Netscape Navigator', c:"Chrome", x:"Other"};
    if (/bot|googlebot|facebook|slurp|wii|silk|blackberry|maxthon|maxton|mediapartners|dolfin|dolphin|adsbot|silk|android|phone|bingbot|google web preview|like firefox|chromeframe|seamonkey|opera mini|min|meego|netfront|moblin|maemo|arora|camino|flot|k-meleon|fennec|kazehakase|galeon|android|mobile|iphone|ipod|ipad|epiphany|rekonq|symbian|webos/i.test(ua)) n="x";
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
    
    var v= parseFloat(RegExp.$1);
    var donotnotify=false;
    //do not notify ver old systems since their is no up-to-date browser available
    if (/windows.nt.5.0|windows.nt.4.0|windows.98|os x 10.4|os x 10.5|os x 10.3|os x 10.2/.test(ua)) donotnotify="oldOS";
    
    //do not notify firefox ESR
    if (n=="f" && Math.round(v)==24)
        donotnotify="ESR";
    //do not notify opera 12 on linux since it is the latest version
    if (/linux|x11|unix|bsd/.test(ua) && n=="o" && v>12) 
        donotnotify="Opera12Linux";
    
    if (n=="x") return {n:"x",v:v||0,t:names[n],donotnotify:donotnotify};
    

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

this.op.browser=getBrowser();
if (!this.op.test && (!this.op.browser || !this.op.browser.n || this.op.browser.n=="x" || this.op.browser.donotnotify!==false || document.cookie.indexOf("browserupdateorg=pause")>-1 || this.op.browser.v>this.op.vs[this.op.browser.n]))
    return;


if (!this.op.test  && Math.round(Math.random()*100)<1) {
    var i = new Image();
    i.src="//browser-update.org/viewcount.php?n="+this.op.browser.n+"&v="+this.op.browser.v + "&p="+ escape(this.op.pageurl) + "&jsv="+jsv+"&vs="+myvs.i+","+myvs.f+","+myvs.o+","+myvs.s;
}
if (this.op.reminder>0) {
    var d = new Date(new Date().getTime() +1000*3600*this.op.reminder);
    document.cookie = 'browserupdateorg=pause; expires='+d.toGMTString()+'; path=/';
}

var languages = "xx,jp,sl,id,uk,rm,da,ca,sv,hu,fa,gl";
if (languages.indexOf(ll)>0)
    this.op.url="http://browser-update.org/update.html#"+jsv+"@"+(location.hostname||"x");
var tar="";
if (this.op.newwindow)
    tar=' target="_blank"';

function busprintf() {
    var args=arguments;
    var data = args[ 0 ];
    for( var k=1; k<args.length; ++k ) {
        data = data.replace( /%s/, args[ k ] );
    }
    return data;
}

var t = 'This website would like to remind you: Your browser (%s) is <b>out of date</b>.\
         <a%s>Update your browser</a> for more security, comfort and the best experience on this site.';
if (ll=="de")
    t = 'Sie verwenden einen <b>veralteten Browser</b> (%s) mit <b>Sicherheitsschwachstellen</b> und <b>k&ouml;nnen nicht alle Funktionen dieser Webseite nutzen</b>. \
        <a%s>Hier erfahren Sie, wie einfach Sie Ihren Browser aktualisieren k&ouml;nnen</a>.';
else if (ll=="it")
    t = 'Il tuo browser (%s) <b>non è aggiornato</b>. Ha delle <b>falle di sicurezza</b> e potrebbe <b>non visualizzare correttamente</b> le \
        pagine di questo e altri siti. \
        <a%s>Aggiorna il tuo browser</a>!';
else if (ll=="pl")
    t = 'Przeglądarka (%s), której używasz, jest przestarzała. Posiada ona udokumentowane <b>luki bezpieczeństwa, inne wady</b> oraz <b>ograniczoną funkcjonalność</b>. Tracisz możliwość skorzystania z pełni możliwości oferowanych przez niektóre strony internetowe. <a%s>Dowiedz się jak zaktualizować swoją przeglądarkę</a>.';
else if (ll=="es")
    t = 'Su navegador (%s) <b>no está actualizado</b>. Tiene <b>fallos de seguridad</b> conocidos y podría <b>no mostrar todas las características</b> de este y otros sitios web. <a%s>Averigüe cómo actualizar su navegador.</a>';
else if (ll=="nl")
    t = 'Uw browser (%s) is <b>oud</b>. Het heeft bekende <b>veiligheidsissues</b> en kan <b>niet alle mogelijkheden</b> weergeven van deze of andere websites. <a%s>Lees meer over hoe uw browser te upgraden</a>';
else if (ll=="pt")
    t = 'Seu navegador (%s) está <b>desatualizado</b>. Ele possui <b>falhas de segurança</b> e pode <b>apresentar problemas</b> para exibir este e outros websites. <a%s>Veja como atualizar o seu navegador</a>';
else if (ll=="sl")
    t = 'Vaš brskalnik (%s) je <b>zastarel</b>. Ima več <b>varnostnih pomankljivosti</b> in morda <b>ne bo pravilno prikazal</b> te ali drugih strani. \
        <a%s>Poglejte kako lahko posodobite svoj brskalnik</a>';
else if (ll=="ru")
    t = 'Ваш браузер (%s) <b>устарел</b>. Он имеет <b>уязвимости в безопасности</b> и может <b>не показывать все возможности</b> на этом и других сайтах. <a%s>Узнайте, как обновить Ваш браузер</a>';
else if (ll=="id")
    t = 'Browser Anda (% s) sudah <b>kedaluarsa</b>. Browser yang Anda pakai memiliki <b>kelemahan keamanan</b> dan mungkin <b>tidak dapat menampilkan semua fitur</b> dari situs Web ini dan lainnya. <a%s> Pelajari cara memperbarui browser Anda</a>';
else if (ll=="uk")
    t = 'Ваш браузер (%s) <b>застарів</b>. Він <b>уразливий</b> й може <b>не відображати всі можливості</b> на цьому й інших сайтах. <a%s>Дізнайтесь, як оновити Ваш браузер</a>';
else if (ll=="ko")
    t = '지금 사용하고 계신 브라우저(%s)는 <b>오래되었습니다.</b> 알려진 <b>보안 취약점</b>이 존재하며, 새로운 웹 사이트가 <b>깨져 보일 수도</b> 있습니다. <a%s>브라우저를 어떻게 업데이트하나요?</a>';
else if (ll=="rm")
    t = 'Tes navigatur (%s) è <b>antiquà</b>. El cuntegna <b>problems da segirezza</b> enconuschents e mussa eventualmain <b>betg tut las funcziuns</b> da questa ed autras websites. <a%s>Emprenda sco actualisar tes navigatur</a>.';
else if (ll=="ja")	
	t = 'お使いのブラウザ「%s」は、<b>時代遅れ</b>のバージョンです。既知の<b>脆弱性</b>が存在するばかりか、<b>機能不足</b>によって、サイトが正常に表示できない可能性があります。 \
         <a%s>ブラウザを更新する方法を確認する</a>';
else if (ll=="fr")
	t = 'Votre navigateur (%s) est <b>périmé</b>. Il contient des <b>failles de sécurité</b> et pourrait <b>ne pas afficher certaines fonctionalités</b> des sites internet récents. <a%s>Découvrez comment mettre votre navigateur à jour</a>';
else if (ll=="da")
        t = 'Din browser (%s) er <b>for&aelig;ldet</b>. Den har kendte <b>sikkerhedshuller</b> og kan m&aring;ske <b>ikke vise alle funktioner</b> p&aring; dette og andre websteder. <a%s>Se hvordan du opdaterer din browser</a>';
else if (ll=="sq")
        t = 'Shfletuesi juaj (%s) është <b>ca i vjetër</b>. Ai ka <b>të meta sigurie</b> të njohura dhe mundet të <b>mos i shfaqë të gjitha karakteristikat</b> e kësaj dhe shumë faqeve web të tjera. <a%s>Mësoni se si të përditësoni shfletuesin tuaj</a>';
else if (ll=="ca")
        t = 'El teu navegador (%s) està <b>desactualitzat</b>. Té <b>vulnerabilitats</b> conegudes i pot <b>no mostrar totes les característiques</b> d\'aquest i altres llocs web. <a%s>Aprèn a actualitzar el navegador</a>';
else if (ll=="tr")
    t = 'Tarayıcınız (%s) <b>güncel değildir.</b>. Eski versiyon olduğu için <b>güvenlik açıkları</b> vardır ve görmek istediğiniz bu web sitesinin ve diğer web sitelerinin <b>tüm özelliklerini hatasız bir şekilde</b> gösteremeyecektir. \
         <a%s>Tarayıcınızı nasıl güncelleyeceğinizi öğrenin!</a>';
else if (ll=="fa")
    t = 'مرورگر شما (%s) <b>از رده خارج شده</b> می باشد. این مرورگر دارای <b>مشکلات امنیتی شناخته شده</b> می باشد و <b>نمی تواند تمامی ویژگی های این</b> وب سایت و دیگر وب سایت ها را به خوبی نمایش دهد. \
         <a%s>در خصوص گرفتن راهنمایی درخصوص نحوه ی به روز رسانی مرورگر خود اینجا کلیک کنید.</a>';
else if (ll=="sv")
    t = 'Din webbläsare (%s) är <b>föråldrad</b>. Den har kända <b>säkerhetshål</b> och <b>kan inte visa alla funktioner korrekt</b> på denna och på andra webbsidor. <a%s>Uppdatera din webbläsare idag</a>';
else if (ll=="hu")
    t = 'Az Ön böngészője (%s) <b>elavult</b>. Ismert <b>biztonsági hiányosságai</b> vannak és esetlegesen <b>nem tud minden funkciót megjeleníteni</b> ezen vagy más weboldalakon. <a%s>Itt talál bővebb információt a böngészőjének frissítésével kapcsolatban</a>		 ';
else if (ll=="gl")
    t = 'O seu navegador (%s) está <b>desactualizado</b>. Ten coñecidos <b>fallos de seguranza</b> e podería <b>non mostrar tódalas características</b> deste e outros sitios web. <a%s>Aprenda como pode actualizar o seu navegador</a>';
else if (ll=="cs")
    t = 'Váš prohlížeč (%s) je <b>zastaralý</b>. Jsou známy <b>bezpečnostní rizika</b> a možná <b>nedokáže zobrazit všechny prvky</b> této a dalších webových stránek. <a%s>Naučte se, jak aktualizovat svůj prohlížeč</a>';
else if (ll=="he")
    t = 'הדפדפן שלך (%s) <b>אינו מעודכן</b>. יש לו <b>בעיות אבטחה ידועות</b> ועשוי <b>לא להציג את כל התכונות</b> של אתר זה ואתרים אחרים. <a%s>למד כיצד לעדכן את הדפדפן שלך</a>';
else if (ll=="nb")
    t='Nettleseren din (%s) er <b>utdatert</b>. Den har kjente <b>sikkerhetshull</b> og <b>kan ikke vise alle funksjonene</b> på denne og andre websider. <a%s>Lær hvordan du kan oppdatere din nettleser</a>';
else if (ll=="zh")
    t='您的浏览器(%s) 需要更新。该浏览器有诸多安全漏洞，无法显示本网站的所有功能。 <a%s>了解如何更新浏览器</a>';
else if (ll=="fi")
    t='Selaimesi (%s) on <b>vanhentunut</b>. Siinä on tunnettuja tietoturvaongelmia eikä se välttämättä tue kaikkia ominaisuuksia tällä tai muilla sivustoilla. <a%s>Lue lisää siitä kuinka päivität selaimesi</a>.';
else if (ll=="tr")
    t='Tarayıcınız (%s) <b>güncel değil</b>. Eski versiyon olduğu için <b>güvenlik açıkları</b> vardır ve görmek istediğiniz bu web sitesinin ve diğer web sitelerinin <b>tüm özelliklerini hatasız bir şekilde</b> gösteremeyecektir. <a%s>Tarayıcınızı nasıl güncelleyebileceğinizi öğrenin</a>';
else if (ll=="ro")
    t='Browser-ul (%s) tau este <b>invechit</b>. Detine <b>probleme de securitate</b> cunoscute si poate <b>sa nu afiseze corect</b> toate elementele acestui si altor site-uri. <a%s>Invata cum sa-ti actualizezi browserul.</a>';
if (op.text)
    t = op.text;
if (op["text_"+ll])
    t = op["text_"+ll];

this.op.text=busprintf(t,this.op.browser.t,' href="'+this.op.url+'"'+tar);

var div = document.createElement("div");
this.op.div = div;
div.id="buorg";
div.className="buorg";
div.innerHTML= '<div>' + this.op.text + '<div id="buorgclose">&times;</div></div>';

var sheet = document.createElement("style");
//sheet.setAttribute("type", "text/css");
var style = ".buorg {position:absolute;position:fixed;z-index:111111;\
width:100%; top:0px; left:0px; \
border-bottom:1px solid #A29330; \
background:#FDF2AB no-repeat 13px center url(//browser-update.org/img/small/"+this.op.browser.n+".gif);\
text-align:left; cursor:pointer; \
font-family: Arial,Helvetica,sans-serif; color:#000; font-size: 12px;}\
.buorg div { padding:5px 36px 5px 40px; } \
.buorg a,.buorg a:visited  {color:#E25600; text-decoration: underline;}\
#buorgclose { position: absolute; right: 6px; top:-2px; height: 20px; width: 12px; font-weight: bold;font-size:18px; padding:0; }";
document.body.insertBefore(div,document.body.firstChild);
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
    me.op.onclick(me.op);
    return false;
};
try {
div.getElementsByTagName("a")[0].onclick = function(e) {
    var e = e || window.event;
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
document.getElementById("buorgclose").onclick = function(e) {
    var e = e || window.event;
    if (e.stopPropagation) e.stopPropagation();
    else e.cancelBubble = true;
    me.op.div.style.display="none";
    hm.style.marginTop = me.op.bodymt;
    return true;
};
op.onshow(this.op);

};

var $buoop = $buoop||{};
$bu=$buo($buoop);
