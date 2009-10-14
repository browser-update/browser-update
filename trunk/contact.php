<?php
require_once("lib/init.php");
require_once("lib/lang.php");
include("header.php");
?>

<div class="left">
<h2 class="top"><?php echo T_('Contact'); ?></h2>

<?php tt('contact-intro.php'); ?>

<?php tt('contact-contact.php'); ?>

<h2>Copyright</h2>

<p>
    Some Images from this site are taken from the
    <a href="http://tango.freedesktop.org/Tango_Icon_Library">Tango Icon Library</a>
    whis is Licenesed under
    the <a href="http://creativecommons.org/licenses/by-sa/2.5/">CC-BY-SA </a>
</p>

<!--
<h2>Privacy policy</h2>
<p>
If you include the script on your site, no IP-adresses of your visitors are recorded
and we can not track visitors.
no other Information then the  anonymous browser usgage is recorded.
No IP-adresses are recorded.
</p>
-->

</div>

<?php include("footer.php");?>