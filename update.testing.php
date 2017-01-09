<?php
T_textdomain('site');
if (is_translated("Check if my browser is up-to-date!")) {
    echo '<div class="testwarning">'.
        T_('This is the page that is shown to visitors with an out-of-date browser after they clicked the notification to update their browser.').
        ' ' .T_('This is not the information for your currently used browser.'). ' ' . 
        '<a class="greenbut" href="update-browser.html">'.
        T_('Check if my browser is up-to-date!').
    '</a></div>';
}
T_textdomain('update');