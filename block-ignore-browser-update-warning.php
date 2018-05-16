<?php
$extratranslation=true;
require_once("lib/init.php");
require_once("lib/lang.php");

$title=T_("Ignore outdated browser warning");
include("header.php");

$bx_=get_browserx($ua_);
$browid=$bx_[0];
$brown=$bx_[1];
$browver=$bx_[2];

$sysx=get_system($ua_);
$sys=$sysx[0];
$ver=$sysx[1];
$sysn=$sysx[2];

?>
<div class="msg noti">
    <p>
        <b>You will now no longer see warnings about your outdated browsers on this site.</b>
    </p>

    <p>
        Please keep in mind that the site may not be working properly in your outdated browser. So don't complain.
    </p>
</div>

<div class="msg noti">
    <p>
        We would like you to reconsider. It takes just a few minutes to update your browser and you will be more <b>safe</b> and <b>comfortable</b>.
    </p>
    <p>
        <a href="update-browser.html" class="update-button">Update my browser</a>
    </p>
</div> 

<style>
    body div .msg {
        text-align: center;
        margin: 30px 25px;
        font-size: 20px;
        font-family: 'Open Sans',sans-serif;
        font-weight: 300;
        padding: 20px 20px;
        background-color: #FFFCE6;
        border: none;
        box-shadow: none;
    }
    
    .msg p { 
        font-family: 'Open Sans',sans-serif;
        font-weight: 300;
    }
    
    .update-button {
        box-shadow: 0 0 2px rgba(0,0,0,0.4); 
        padding: 5px 37px; 
        border-radius: 4px; 
        font-weight: normal; 
        background: #5ab400;   
        white-space: nowrap;    
        margin: 0 2px; 
        display: inline-block;
        color: #fff;
        text-decoration: none;
    }    
</style>

<?php
include("ads.php");
?>
<div class="cookiebar" id="cookiebar"><?php echo T_('This website uses cookies')?> <a onclick="document.getElementById('cookiebar').style.display='none'"><?php echo T_('Close'); ?></a></div>


<script async src="https://www.googletagmanager.com/gtag/js?id=UA-110098170-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  var myref=((window.location.hash||"").match(/.*@(.*)/i)||(window.location.hash||"").match(/.*:(.*)/i)||["",""])[1]||"";
  if (myref)
      myref="https://"+myref;
  gtag('set', {
      'document_referrer': document.referrer|| myref,
      'referrer': document.referrer|| myref,
      'dr': document.referrer|| myref,
    'source': "referral"
  });
  gtag('config', 'UA-110098170-1',{
  'page_title': 'Ignore notifications on outdated browser',
  'page_location': 'http://browser-update.org/block-ignore-browser-update-warning.html',
  'page_path': '/block-ignore-browser-update-warning.html',
  'campaignName': "standard",
  'anonymize_ip': true,
    'document_referrer': document.referrer|| myref,
    'referrer': document.referrer|| myref,
    'dr': document.referrer|| myref,
    'source': "referral"
});
</script>
<!-- 
<script>
    /*
var myref=((window.location.hash||"").match(/.*@(.*)/i)||(window.location.hash||"").match(/.*:(.*)/i)||["",""])[1]||"";
if (myref)
    myref="http://"+myref;
  */
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-110098170-1', 'auto');
//ga('set', 'referrer', myref);
ga('set', 'location', 'http://browser-update.org/update-browser.html');
ga('set', 'hostname', 'browser-update.org');
ga('set', 'page', '/update-browser.html');
ga('set', 'title', 'Update Page',);
ga('send', 'pageview');
</script>
-->
<?php 
include("footer.php");