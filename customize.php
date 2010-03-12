<?php
require_once("lib/init.php");
require_once("lib/lang.php");
include("header.php");
?>

<div class="left">
<h2 class="top"><?php echo T_('Customize and test'); ?></h2>


<h3><?php echo T_('Test the script'); ?></h3>

<p>
    <?php echo T_('If you open your website with <code>#test-bu</code> appended to the url, the bar will always show up.'); ?>
    <?php echo T_('Example: <code>http://browser-update.org/#test-bu</code>.'); ?>
    <?php echo T_('Make sure the page is properly reloaded by opening the url in an new browser tab.'); ?>
</p>

<h3><?php echo T_('Options'); ?></h3>

<p>
    <?php echo T_('The following options can be passed to the script:'); ?>
</p>

<pre>
var $buoop = {
    vs: {i:6,f:2,o:9.63,s:2,n:10},  // <?php echo T_('browser versions to notify') . "\n"; ?>
    reminder: 24,                   // <?php echo T_('atfer how many hours should the message reappear') . "\n"; ?>
                                    // <?php echo T_('0 = show all the time') . "\n"; ?>
    onshow: function(infos){},      // <?php echo T_('callback function after the bar has appeared') . "\n"; ?>

    l: false,                       // <?php echo T_('set a language for the message, e.g. "en"') . "\n"; ?>
                                    // <?php echo T_('overrides the default detection') . "\n"; ?>
    test: false                     // <?php echo T_('true = always show the bar (for testing)') . "\n"; ?>
    text: ""                        // <?php echo T_('custom notification html text') . "\n"; ?>
    newwindow: false                // <?php echo T_('open link in new window/tab') . "\n"; ?>
}
</pre>
<!--
    url: "http://browser-update.org/update.php",   // url to redirect to
    pageurl: ""                          // url to show in the las    
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
<h3><?php echo T_('Edit the CSS'); ?></h3>

<p>
    <?php echo T_('The following CSS rules are applied by the script. '); ?>
    <?php echo T_('You can overwrite them in your own CSS. To do so you need to add some more specifity to the css-rules: e.g.  <code>body .buorg {font-size:20px}</code>'); ?>
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