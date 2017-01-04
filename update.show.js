var $buo_show = function() {
var op=this.op=window._buorgres;    
var jsv=24;
var tv=jsv;//"base";
var ll=op.ll;
var pageurl = op.pageurl || location.hostname || "x";
var bb=$bu_getBrowser();
var burl=(/file:/.test(location.href)) ? "":"//browser-update.org/";
if (op.l)
    this.op.url= burl+ll+"/update-browser.html#"+tv+":"+pageurl;
else
    this.op.url= burl+"update-browser.html#"+tv+":"+pageurl;

var frac=1000;
if (Math.random()*frac<1 && !this.op.test && !this.op.betatest) {
    var i = new Image();
    var txt=op["text_"+ll]||op.text||"";
    var extra=encodeURIComponent("frac="+frac+"&txt="+txt+"&apiver="+op.apiver);
    i.src=burl+"count.php?what=noti&from="+bb.n+"&fromv="+bb.v + "&ref="+ escape(pageurl) + "&jsv="+jsv+"&tv="+tv+"&extra="+extra;
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
t.en='<b>Your web browser ({brow_name}) is out of date</b>. For more security, comfort and the best experience on this site: <a{up_but}>Update your browser</a> <a{ignore_but}>Ignore</a>';
t.de = '<b>Ihr Browser ({brow_name}) ist veraltet</b>. Aktualisieren sie ihren Browser für mehr Sicherheit, Komfort und die einwandfreie Nutzung dieser Webseite. <a{up_but}>Browser aktualisieren</a> <a{ignore_but}>Ignorieren</a>';
t.it = '<b>Il tuo browser ({brow_name}) non è aggiornato</b>. Ha delle falle di sicurezza e potrebbe non visualizzare correttamente le pagine di questo e altri siti. <a{up_but}>Actualice su navegador</a> <a{ignore_but}>Chiudi</a>';
t.pl = 'Przeglądarka (%s), której używasz, jest przestarzała. Posiada ona udokumentowane <b>luki bezpieczeństwa, inne wady</b> oraz <b>ograniczoną funkcjonalność</b>. Tracisz możliwość skorzystania z pełni możliwości oferowanych przez niektóre strony internetowe. <a%s>Dowiedz się jak zaktualizować swoją przeglądarkę</a>.';
t.es = '<b>Su navegador ({brow_name}) no está actualizado</b>. Tiene fallos de seguridad conocidos y podría no mostrar todas las características de este y otros sitios web. <a{up_but}>Averigüe cómo actualizar su navegador.</a> <a{ignore_but}>Cerrar</a>';
t.nl = 'Uw browser (%s) is <b>oud</b>. Het heeft bekende <b>veiligheidsissues</b> en kan <b>niet alle mogelijkheden</b> weergeven van deze of andere websites. <a%s>Lees meer over hoe uw browser te upgraden</a>';
t.pt = '<b>Seu navegador ({brow_name}) está desatualizado</b>. Ele possui falhas de segurança e pode apresentar problemas para exibir este e outros websites. <a{up_but}>Veja como atualizar o seu navegador</a> <a{ignore_but}>Fechar</a>';
t.sl = 'Vaš brskalnik (%s) je <b>zastarel</b>. Ima več <b>varnostnih pomankljivosti</b> in morda <b>ne bo pravilno prikazal</b> te ali drugih strani. <a%s>Poglejte kako lahko posodobite svoj brskalnik</a>';
t.ru = 'Ваш браузер (%s) <b>устарел</b>. Он имеет <b>уязвимости в безопасности</b> и может <b>не показывать все возможности</b> на этом и других сайтах. <a%s>Узнайте, как обновить Ваш браузер</a>';
t.id = 'Browser Anda (%s) sudah <b>kedaluarsa</b>. Browser yang Anda pakai memiliki <b>kelemahan keamanan</b> dan mungkin <b>tidak dapat menampilkan semua fitur</b> dari situs Web ini dan lainnya. <a%s> Pelajari cara memperbarui browser Anda</a>';
t.uk = 'Ваш браузер (%s) <b>застарів</b>. Він <b>уразливий</b> й може <b>не відображати всі можливості</b> на цьому й інших сайтах. <a%s>Дізнайтесь, як оновити Ваш браузер</a>';
t.ko = '지금 사용하고 계신 브라우저(%s)는 <b>오래되었습니다.</b> 알려진 <b>보안 취약점</b>이 존재하며, 새로운 웹 사이트가 <b>깨져 보일 수도</b> 있습니다. <a%s>브라우저를 어떻게 업데이트하나요?</a>';
t.rm = 'Tes navigatur (%s) è <b>antiquà</b>. El cuntegna <b>problems da segirezza</b> enconuschents e mussa eventualmain <b>betg tut las funcziuns</b> da questa ed autras websites. <a%s>Emprenda sco actualisar tes navigatur</a>.';
t.jp = 'お使いのブラウザ「%s」は、<b>時代遅れ</b>のバージョンです。既知の<b>脆弱性</b>が存在するばかりか、<b>機能不足</b>によって、サイトが正常に表示できない可能性があります。 <a%s>ブラウザを更新する方法を確認する</a>';
t.fr = '<b>Votre navigateur ({brow_name}) est périmé</b>. Il contient des failles de sécurité et pourrait ne pas afficher certaines fonctionnalités des sites internet récents. <a{up_but}>Mettre le navigateur à jour</a> <a{ignore_but}>Fermer</a>';
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
t.hi='यह वेबसाइट आपको याद दिलाना चाहती हैं: आपका ब्राउज़र (%s) <b> आउट ऑफ़ डेट </ b> हैं। <a%s> और अधिक सुरक्षा, आराम और इस साइट पर सबसे अच्छा अनुभव करने लिए आपके ब्राउज़र को अपडेट करें</a>।';
t.sk='Chceli by sme Vám pripomenúť: Váš prehliadač (%s) je <b>zastaralý</b>. <a%s>Aktualizujte si ho</a> pre viac bezpečnosti, pohodlia a pre ten najlepší zážitok na tejto stránke.';
t.vi='Website này xin nhắc bạn rằng: Trình duyệt (%s) của bạn hiện đã <b>lỗi thời</b>. <a%s>Hãy cập nhật trình duyệt của bạn</a> để tăng thêm tính bảo mật, sự tiện lợi và trải nghiệm tuyệt nhất trên trang web này.';



t=op["text_"+ll]||op.text||t[ll]||t.en;

var tar="";
if (op.newwindow)
    tar=' target="_blank" rel="noopener"';

var div = this.op.div = document.createElement("div");
div.id="buorg";
div.className="buorg";

var style = '<style>.buorg {background: #FDF2AB no-repeat 14px center url('+burl+'img/small/'+bb.n+'.png);}</style>';

if (t.indexOf("{brow_name}")===-1) {//legacy style
    t=busprintf(t,bb.t,' id="buorgul" href="'+this.op.url+'"'+tar);

    style += "<style>.buorg {position:absolute;position:fixed;z-index:111111;    width:100%; top:0px; left:0px;    border-bottom:1px solid #A29330;    text-align:left; cursor:pointer;    font: 13px Arial,sans-serif;color:#000;}\
    .buorg div { padding:5px 36px 5px 40px; }\
    .buorg>div>a,.buorg>div>a:visited{color:#E25600; text-decoration: underline;}\
    #buorgclose{position:absolute;right:6px;top:0px;height:20px;width:12px;font:18px bold;padding:0;}\
    #buorga{display:block;}\
    @media only screen and (max-width: 700px){.buorg div { padding:5px 15px 5px 9px; }}</style>";    
    div.innerHTML= '<div>'+t+'<div id="buorgclose"><a id="buorga">&times;</a></div></div>'+style;    
}
else {
    style += "<style>.buorg {background-position: 8px 17px; position:absolute;position:fixed;z-index:111111;    width:100%; top:0px; left:0px;    border-bottom:1px solid #A29330;    text-align:left; cursor:pointer;        background-color: #fff8ea;    font: 17px Calibri,Helvetica,Arial,sans-serif;    box-shadow: 0 0 5px rgba(0,0,0,0.2);}\
    .buorg div { padding: 12px 12px 12px 30px;  line-height: 1.3em; }\
    .buorg div a,.buorg div a:visited{   text-indent: 0; color: #fff;    text-decoration: none;    box-shadow: 0 0 2px rgba(0,0,0,0.4);    padding: 1px 10px;    border-radius: 4px;    font-weight: normal;    background: #5ab400;    white-space: nowrap;    margin: 0 2px; display: inline-block;}\
    #buorgig{ background-color: #edbc68;}\
    @media only screen and (max-width: 700px){.buorg div { padding:5px 12px 5px 9px; text-indent: 22px;line-height: initial;}.buorg {background-position: 9px 8px;}}</style>";  
    t=t.replace("{brow_name}",bb.t).replace("{up_but}",' id="buorgul" href="'+this.op.url+'"'+tar).replace("{ignore_but}",' id="buorgig" href=""');

    div.innerHTML= '<div>'+t+'</div>'+style;
}
this.op.text=t;
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

var hm=document.getElementsByTagName("html")[0]||document.body;
this.op.bodymt = hm.style.marginTop;
hm.style.marginTop = (div.clientHeight)+"px";
(function(me) {
    (document.getElementById("buorga")||document.getElementById("buorgig")).onclick = function(e) {
        e = e || window.event;
        if (e.stopPropagation) e.stopPropagation();
        else e.cancelBubble = true;
        me.op.div.style.display = "none";
        hm.style.marginTop = me.op.bodymt;
        me.op.onclose(me.op);
        me.op.setCookie(me.op.reminderClosed);
        return false;
    };
})(me);

this.op.onshow(this.op);

};

$buo_show();
