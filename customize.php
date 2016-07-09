<?php
require_once("lib/init.php");
require_once("lib/lang.php");

$extratranslation=true;
include("header.php");
T_textdomain('customize');
?>

<div class="left">
<h2 class="top"><?php echo T_('Customize and test'); ?></h2>


<h3><?php echo T_('Test the script'); ?></h3>

<p>
    <?php echo T_('If you open your website with <code>#test-bu</code> appended to the url, the bar will always show up. Example: <code>http://browser-update.org/#test-bu</code>. Make sure the page is properly reloaded by opening the url in an new browser tab.'); ?>
</p>

<h3><?php echo T_('Options'); ?></h3>

<p>
    <?php echo T_('The following options can be passed to the script:'); ?>
</p>

<pre>
var $buoop = {
    vs: {i:6,f:2,o:9.63,s:2,c:10},  // <?php echo T_('specify minimum browser versions to notify') . "\n"; ?>
    reminder: 24,                   // <?php echo T_('after how many hours should the message reappear') . "\n"; ?>
                                    // <?php echo T_('0 = show all the time') . "\n"; ?>
    reminderClosed: 150             // <?php echo T_('if the user explicitly closes message it reappears after x hours') . "\n"; ?>
    onshow: function(infos){},      // <?php echo T_('callback function after the bar has appeared') . "\n"; ?>
    onclick: function(infos){},     // <?php echo T_('callback function if bar was clicked') . "\n"; ?>
    onclose: function(infos){},     //

    l: false,                       // <?php echo T_('set a language for the message, e.g. "en"') . "\n"; ?>
                                    // <?php echo T_('overrides the default detection') . "\n"; ?>
    test: false,                    // <?php echo T_('true = always show the bar (for testing)') . "\n"; ?>
    text: "",                       // <?php echo T_('custom notification html text') . "\n"; ?>
                                    // <?php echo T_('Optionally include up to two placeholders "%s" which will be replaced with the browser version and contents of the link tag. Example: "Your browser (%s) is old.  Please &lt;a%s&gtupdate&lt;/a&gt;"'). "\n";?>
    text_xx: "",                    // <?php echo T_('custom notification text for language "xx"') . "\n"; ?>
                                    // <?php echo T_('e.g. text_de for german and text_it for italian') . "\n"; ?>
    newwindow: true                 // <?php echo T_('open link in new window/tab') . "\n"; ?>
    url: null                       // <?php echo T_('the url to go to after clicking the notification') . "\n"; ?>
};
</pre>
<h3><?php echo T_('Change the style'); ?></h3>

<p>
    <?php echo T_('The following CSS rules are applied by the notification. You can overwrite them in your own CSS. To do so you need to add some more specificity to the css-rules: e.g. '); ?>
    <code>body .buorg {font-size:20px}</code> 
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
