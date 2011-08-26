
function code() {
    var autoupdate = document.getElementById("autoupdate");
    var vc = document.getElementById("browserversionchooser");
    //getomat('i')=="6" && getomat('f')=="2" && getomat('o')=="9.2" && getomat('s')=="2"
    if (autoupdate.checked) {
        var notify = "";
        setomatdefault('i',2);
        setomatdefault('f',4);
        setomatdefault('o',2);
        setomatdefault('s',4);
        vc.className = "disabled";
    }
    else {
        var notify = 'vs:{i:'+ getomat('i') +',f:'+ getomat('f') +',o:'+ getomat('o') +',s:'+ getomat('s') +',n:9}';
        vc.className = "enabled";
    }
	var code="";
	code = '\
<script type="text/javascript"> \n\
var $buoop = {'+notify+'} \n\
$buoop.ol = window.onload; \n\
window.onload=function(){ \n\
 try {if ($buoop.ol) $buoop.ol();}catch (e) {} \n\
 var e = document.createElement("script"); \n\
 e.setAttribute("type", "text/javascript"); \n\
 e.setAttribute("src", "http://browser-update.org/update.js"); \n\
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

var languages = "en,de";
function redirect() {
	return;
	if (
		window.location.href.indexOf("/lang/")!=-1 ||
		window.location.href.indexOf("/blog/")!=-1 ||
		window.location.href.indexOf("/help")!=-1 ||
		window.location.href.indexOf("/contact")!=-1
		)
		return;
	var l = getlang(), r;
	if (languages.indexOf(l)!==false)
		window.location.href="/lang/"+l+"/";
}
