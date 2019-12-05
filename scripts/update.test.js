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
        '.buorg-test {position:absolute;width: 220px; top:5px; right:10px; text-align:center; color:#000; background-color: #ff93a8;font-size: 10px; padding:5px;line-height:1;text-align:left;}' +
        '.buorg-test-sub {}' +
        '.buorg-test div {padding:0;line-height:1;}' +
        '</style>';

    if (op.style === "bottom")
        style += '<style>.buorg-test {top:auto; bottom:5px;} </style>';
    if (op.style === "corner")
        style += '<style>.buorg-test {top:auto; bottom:-100px;} </style>';

    var h = '<div>Browser Notification Debug-Mode (v'+op.jsv+')</div>' + style;


    h += '<div class="buorg-test-sub">'
    h += "<div>Browser would normally be notified: " + op.notified + "</div>";

    if (op.reasons.length>0)
        h += "<div><b>Reasons to show</b>: " + op.reasons.join(",") + "</div>";

    if (op.hide_reasons.length>0)
        h += "<div><b>Reasons to hide</b>: " + op.hide_reasons.join(",") + "</div>"

    h += "<div><b>Browser info</b></div>";
    h += "<span>is_latest:" + bb.is_latest + "</span>, ";
    h += "<span>is_insecure:" + bb.is_insecure + "</span>, ";
    h += "<span>other:" + bb.other + "</span>, ";
    h += "<span>no_device_update:" + bb.no_device_update + "</span>, ";
    h += "<span>cookie set:" + (document.cookie.indexOf("browserupdateorg=pause")>-1) + "</span>";

    h += '</div>'

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
