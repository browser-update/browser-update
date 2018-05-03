//(c)2017, MIT Style License <browser-update.org/LICENSE.txt>
// this script is loaded when the bar is shown in testing mode.
// shows debug information and a note that the browser may actually not be outdated
"use strict";
var $buo_test_ = function () {
    var op = window._buorgres;
    var bb = $bu_getBrowser();

    var div = document.createElement("div");
    div.className = "buorg-test";


    var style = '<style>' +
        '.buorg-test {position:absolute;width: 130px; bottom:-15px; right:10px; text-align:center; color:#000; background-color: #ff93a8;font-size: 10px; padding:5px;line-height:1;}' +
        '.buorg-test-sub {position:absolute; width: 100%; top:20px; left:0; background-color: #ff93a8; padding: 5px;}' +
        '.buorg-test div {padding:0;line-height:1;}' +
        '</style>';

    var h = '<div>Test-Mode</div>' + style;

    h += '<div class="buorg-test-sub">'
    h += "<div>Browser would normally be notified: " + op.notified + "</div>";

    if (op.notified !== false)
        h += "<div>Reasons: " + op.reasons.join(",") + "</div>";

    h += "<div>Browser info</div>";
    h += "<span>is_latest:" + bb.is_latest + "</span>, ";
    h += "<span>is_insecure:" + bb.is_insecure + "</span>, ";
    h += "<span>other:" + bb.other + "</span>, ";
    h += "<span>no_os_update:" + bb.no_os_update + "</span>";

    h += "</div>";
    div.innerHTML = h;
    div.onclick = function (e) {
        e = e || window.event;
        if (e.stopPropagation) e.stopPropagation();
        else e.cancelBubble = true;

        div.parentNode.removeChild(div);
        return false;
    }
    op.div.appendChild(div);


}();
