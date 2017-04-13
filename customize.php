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

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.10.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.10.0/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
<pre><code class="javascript">$buoop = {
    vs: {i:8,f:25,o:17,s:9,c:22},  
    // <?php echo T_('Specifies browser versions to notify. Negative numbers specify how much versions behind current version to notify.') . "\n"; ?> 
    // f:22 ---> Firefox <= 22
    // c:-5 ---> Chrome <= 35 if current Chrome version is 40.

    reminder: 24,                  
    // <?php echo T_('after how many hours should the message reappear') . "\n"; ?>
    // <?php echo T_('0 = show all the time') . "\n"; ?>

    reminderClosed: 150,           
    // <?php echo T_('if the user explicitly closes message it reappears after x hours') . "\n"; ?>

    onshow: function(infos){},     
    onclick: function(infos){},
    onclose: function(infos){},
    // <?php echo T_('callback functions after notification has appeared / was clicked / closed') . "\n"; ?>

    l: false,                       
    // <?php echo T_('set a fixed language for the message, e.g. "en". This overrides the default detection.') . "\n"; ?>

    test: false,                    
    // <?php echo T_('true = always show the bar (for testing)') . "\n"; ?>

    text: "",                       
    // <?php echo T_('custom notification text (html)') . "\n"; ?>
    // <?php echo T_('Placeholders {brow_name} will be replaced with the browser name, {up_but} with contents of the update link tag and {ignore_but} with contents for the ignore link.'). "\n";?>
    // <?php echo T_('Example:'). ' '; echo T_('Your browser, {brow_name}, is too old: &lt;a{up_but}&gt;update&lt;/a&gt; or &lt;a{ignore_but}&gt;ignore&lt;/a&gt;.'). "\n";?>

    text_xx: "",                    
    // <?php echo T_('custom notification text for language "xx"') . "\n"; ?>                                  
    // <?php echo T_('e.g. text_de for german and text_it for italian') . "\n"; ?>

    newwindow: true,                
    // <?php echo T_('open link in new window/tab') . "\n"; ?>

    url: null,                      
    // <?php echo T_('the url to go to after clicking the notification') . "\n"; ?>

    noclose:false,                  
    // <?php echo T_('Do not show the "ignore" button to close the notification') . "\n"; ?>

    nomessage: false,               
    // <?php echo T_('Do not show a message if the browser is out of date, just call the onshow callback function') . "\n"; ?>

    jsshowurl: "//browser-update.org/update.show.min.js", 
    // <?php echo T_('URL where the script, that shows the notification, is located. This is only loaded if the user actually has an outdated browser.') . "\n"; ?>

    container: document.body, 
    // <?php echo T_('Element where the notification will be injected.') . "\n"; ?>

    api: xxx                        
    // <?php echo T_('This is the version of the browser-update api to use. Please do not remove.') . "\n"; ?>

};</code></pre>

<h3><?php echo T_('Change the style'); ?></h3>

<p>
    <?php echo T_('The following CSS rules are applied by the notification. You can overwrite them in your own CSS. To do so you need to add some more specificity to the css-rules: e.g. '); ?>
    <code>body .buorg {font-size:20px}</code> 
</p>

<pre><code class="css">.buorg {
    background-position: 8px 17px; 
    position:absolute;
    position:fixed;
    z-index:111111;    
    width:100%; 
    top:0px; 
    left:0px;    
    border-bottom:1px solid #A29330;    
    text-align:left; 
    cursor:pointer;        
    background-color: #fff8ea;    
    font: 17px Calibri,Helvetica,Arial,sans-serif;    
    box-shadow: 0 0 5px rgba(0,0,0,0.2);
}
.buorg div { 
    padding: 11px 12px 11px 30px;  
    line-height: 1.7em; 
}
.buorg div a,.buorg div a:visited { 
    text-indent: 0; 
    color: #fff;    
    text-decoration: none;    
    box-shadow: 0 0 2px rgba(0,0,0,0.4);    
    padding: 1px 10px;    
    border-radius: 4px;    
    font-weight: normal;    
    background: #5ab400;    
    white-space: nowrap;   
    margin: 0 2px; display: inline-block;
}

#buorgig{ 
    background-color: #edbc68;
}

@media only screen and (max-width: 700px){
.buorg div { 
    padding:5px 12px 5px 9px; 
    text-indent: 22px;
    line-height: 1.3em;
}
.buorg {
    background-position: 9px 8px;}
}</code></pre>

</div>

<?php include("footer.php");?>
