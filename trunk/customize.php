<?php
require_once("lib/init.php");
require_once("lib/lang.php");
include("header.php");
?>

<div class="left">
<h2 class="top"><?php echo t('Customize and test'); ?></h2>


<h3>Test the script</h3>

<p>
    If you open your website with <code>#test-bu</code> appended to the url, the bar will always show up.
    Example: <code>http://browser-update.org/#test-bu</code>.
    Make sure the page is properly reloaded by opening the url in an new browser tab.
</p>

<h3>Options</h3>

<p>
    The following options can be passed to the script:
</p>

<pre>
var $buoop = {
    vs: {i:6,f:2,o:9.63,s:2,n:10},  // browser versions to notify
    reminder: 24,                   // afer how many hours should the message reappear.
                                    // 0 = show all the time
    onshow: function(infos){},      // callback function after the bar has appeared

    l: false,                       // set a language for the message, e.g. "en"
                                    // overrides the default detection
    test: false                     // true = always show the bar (for tesing)
}
</pre>
<!--
    url: "http://browser-update.org/update.php",   // url to redirect to
    pageurl: ""                          // url to show in the las
    text: ""                            // custom notification html text
-->
<!--
<p>
    The following options can be passed to the Javascript.
</p>

<table>
<thead>
<th>Name</th><th>Description</th><th>Type</th><th>Default value</th>
</thead>
<tbody>
<tr><td>username</td><td>Your AddThis username. Always global to a page.</td><td>string</td><td>none</td></tr>
<tr><td>services_exclude</td><td>Services to exclude from all menus. For example, setting this to <code>'facebook,myspace'</code> would hide Facebook and MySpace on all our menus. Always global.</td><td>string (csv)</td><td>none</td></tr>
<tr><td>services_compact</td><td>Services to use in the compact menu. For example, setting this to <code>'print,email,favorites'</code> would result in only those three services appearing. Always global.</td><td>string (csv)</td><td>We regularly optimize the default list based on our data.</td></tr>
</tbody>
</table>
-->
<h3>Edit the CSS</h3>

<p>
    The following CSS rules are applied by the script.
    You can overwrite them in your own CSS.
    To do so you need to add some more specifity to the css-rules: e.g.  <code>body .buorg {font-size:20px}</code>
</p>

<pre>
.buorg {
    position:absolute;
    width:100%;
    top:0px;
    left:0px;
    border-bottom:1px solid #A29330;
    background:#FDF2AB no-repeat 1em 0.55em url(http://browser-update.org/img/dialog-warning.gif);\
    text-align:left;
    cursor:pointer;
    font-family: Arial,Helvetica,sans-serif; color:#000;
    font-size: 12px;
}
.buorg div {
    padding:5px 36px 5px 40px;
}
.buorg a {
    color:#E25600;
}
#buorgclose {
    position: absolute;
    right: .5em;
    top:.2em;
    height: 20px;
    width: 12px;
    font-weight: bold;
    font-size:14px;
    padding:0;
}

</pre>

</div>

<?php include("footer.php");?>