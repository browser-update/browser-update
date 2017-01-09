<?php
T_textdomain('site');
echo '<div class="testwarning">'.
    T_('This is the page that is shown to people with an outdated browser when they get the notification to update their browser.').
    ' ' .T_('Your current browser may actually be up-to-date.'). ' ' . 
    '<a class="greenbut" href="update-browser.html">'.
    T_('Check if my browser is up-to-date!').
'</a></div>';
T_textdomain('update');