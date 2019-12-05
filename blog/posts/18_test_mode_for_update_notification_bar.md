title: Debug mode for notification bar
date: 2018-04-21

For testing purposes, it was already possible to force to show the outdated browser notification bar. Either by adding
<code>"#bu-test"</code> to the url in the browser or
by adding <code>test: true</code> to the options passed to the script.

Now, if you pass this, the bar is not only shown always, but it enters debug mode, showing additional information:

* It clearly states that the browser may not really be outdated since this is testing mode
* If the notification would be shown normally to this browser
* Reasons why the bar would be shown (minimum requirements not met, browser insecure, browser not supported by the vendor anymore)
* Information on the browsers and system (is it insecure? the latest version?, can the device be updated?)

<a href="/#test-bu">See the test mode in action</a>

<style>
.xxbuorg-test {
    width: 220px;
    top: 5px;
    right: 10px;
    text-align: center;
    color:
#000;
background-color:
    #ff93a8;
    font-size: 10px;
    padding: 5px;
    line-height: 1;
    text-align: left;
}
</style>
<div class="xxbuorg-test">
Browser Notification Debug-Mode (v3.3.3)<br/>
Browser would normally be notified: false<br/>
Browser info<br/>
is_latest:true, is_insecure:false, other:false, no_device_update:false, cookie set:true<br/>
</div>