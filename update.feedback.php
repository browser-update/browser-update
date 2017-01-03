<?php        
if (isset($_POST) && isset($_POST['feedback']) && trim($_POST['feedback'])!="" && strlen($_POST['feedback'])<301) {
    $arr=$_POST;
    $arr['ua']=$_SERVER['HTTP_USER_AGENT'];
    $arr['lang']=$_SERVER['HTTP_ACCEPT_LANGUAGE'];
    $arr['ref']=$_SERVER['HTTP_REFERER'];
    $arr['date']=date('c');
    $fi = fopen("adm/raw/feedback.txt", "a") or die("Unable to send feedback!");
    $text=json_encode($arr,$options=JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    fwrite($fi, ",\n".$text);
    fclose($fi);
    echo '<li>Thank you for your Feedback.</li>';
}
else  {
    echo '<form id="feedbackform" method="post" action="#feedbackform" onsubmit="document.getElementById(\'triedfield\').value=window.tried.join(\',\');f=$bu_getBrowser();document.getElementById(\'detectedfield\').value=f.n+f.v;"><li>Give us Feedback: I cannot/won\'t update because... ';
    if (isset($_POST) && isset($_POST['feedback'])) {
        echo'<input name="feedback" value="" maxlength="300"/>';
        if  (trim($_POST['feedback'])=="")
            echo'<span style="color:#ff0000">Please enter a reason</span>';
    }
    else {
        echo'<input name="feedback" value="" maxlength="300"/>';
    }
    echo'<input type="hidden" name="tried" id="triedfield" value=""> <input type="hidden" name="detected" id="detectedfield" value=""><input type="hidden" name="site" value="'.$_SERVER['HTTP_REFERER'].'">&nbsp;<input type="submit" value="Send Feedback"/></li></form>';
}
