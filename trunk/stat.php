<?php
require_once("config.php");
require_once("lib/init.php");
require_once("lib/lang.php");
include("header.php");
?>

<div class="left">
<h2 class="top"><?php echo T_('Statistics'); ?></h2>
<?php
#"it,sl,jp,nb,ch"
function countSites() {
    $r = mysql_query("SELECT COUNT(DISTINCT referer) FROM updates") or die(mysql_error(). $q);
    list($num) = mysql_fetch_row($r);
    return $num;
}
function countUpdates() {
    $r = mysql_query("SELECT COUNT(*) FROM updates") or die(mysql_error(). $q);
    list($num) = mysql_fetch_row($r);
    return $num;
}

?>
<style>
    .numbs p {width: 360px;display: inline-block;text-align: center;}
    .numbs strong {display: block;
    font-size: 35px;
color: #E97A00;
margin-bottom: -13px;}
</style>
<div class="numbs">
<p>
    <?php
    echo sprintf(T_('<strong class="number">%d</strong> sites are using the Browser-Update.org script.'), number_format(cache_output('countSites'),0,".", ""));
    ?>
</p>
<p>
    <?php
    echo sprintf(T_('<strong class="number">%d</strong> visitors have already upgraded their browser.'), number_format(cache_output('countUpdates'),0,".", ""));
    ?>
</p>
</div>

<h3><?php echo T_('Browser updates'); ?></h3>
<?php




function get_num($fromn=false, $ton=false) {
	if (!$fromn AND !$ton)
		$q=sprintf("SELECT COUNT(*) FROM updates");
	elseif (!$fromn)
		$q=sprintf("SELECT COUNT(*) FROM updates WHERE ton='$ton'");
	elseif (!$ton)
		$q=sprintf("SELECT COUNT(*) FROM updates WHERE fromn='$fromn'");
	else
		$q=sprintf("SELECT COUNT(*) FROM updates WHERE fromn='$fromn' AND ton='$ton'");
	$r = mysql_query($q)
		or die (mysql_error(). $q);
	list($num) = mysql_fetch_row($r);
	return $num;
}


function browserMigration() {
$names = array(
	"i"=>'Internet Explorer',
	"f"=>'Firefox',
	"o"=>'Opera',
	"s"=>'Apple Safari',
	"n"=>'Netscape Navigator',
        "c"=>'Google Chrome',
        ""=>'?'
);


?>

<table>
    <thead><tr><td><?php echo T_('From'); ?></td><td><?php echo T_('To'); ?></td><td><?php echo T_('Amount'); ?></td></tr></thead>
    <tbody>
    <?php
    $q=mysql_query('SELECT fromn,ton,COUNT(*) as num FROM `updates` GROUP BY fromn, ton ORDER BY num DESC');
     while ($a = mysql_fetch_assoc($q)) {
         if ($names[$a['fromn']]==""||$names[$a['fromn']]=="?")
             continue;
         echo '<tr><td>'.$names[$a['fromn']].'</td><td>'.$names[$a['ton']].'</td><td>'.$a['num'].'</td></tr>';
     }
    ?>
    </tbody>
</table>


<?php


}
echo cache_output('browserMigration');
?>

</div>
<?php include("footer.php");?>
