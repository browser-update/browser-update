<?php
include("header.php");
require("config.php");
?>

<div class="left">
<h2 class="top">Statistiken</h2>

<p>
	<?php
	#$q=sprintf("SELECT 1 FROM updates GROUP BY referer");
    $q=sprintf("SELECT COUNT(DISTINCT referer) FROM views");
	$r = mysql_query($q)
    	or die (mysql_error(). $q);
	list($domainnum) = mysql_fetch_row($r);
	echo $domainnum . ' Seiten verwenden das Browser-Update.org Script';
	?>
</p>

<h3>Browserupdates</h3>
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



?>
<p>
	<?php
	echo get_num() . ' Benutzer haben Ihre Browser schon aktualisiert.';
	?>
</p>

<ul class="statleft">
	<li>to FF: <?php echo get_num(false,'f')?></li>
	<li>to Opera: <?php echo get_num(false,'o')?></li>
	<li>to Safari: <?php echo get_num(false,'s')?></li>
	<li>to IE: <?php echo get_num(false,'i')?></li>
</ul>

<ul>
	<li>from FF: <?php echo get_num('f',false)?></li>
	<li>from Opera: <?php echo get_num('o',false)?></li>
	<li>from Safari: <?php echo get_num('s',false)?></li>
	<li>from IE: <?php echo get_num('i',false)?></li>
</ul>




<h3>Geplante Statistiken</h3>
<ul>
    <li>Statistiken pro Seite</li>
    <li>Angezeigte Benachrichtigungen</li>
    <li>Klickraten</li>
    <li>Wie gut wirken verschiedene Formulierungen in den Benachrichtigungen</li>
</ul>


<h3>Kürzlich aktualisierte Browser </h3>

<table>
<thead>
<tr>
<td>Site</td>
<td>Old Browser</td>
<td>New Browser</td>
<td>Language</td>
<td>Date</td>
</tr>
</thead>

<?php


$names = array(
	"i"=>'Internet Explorer',
	"f"=>'Firefox',
	"o"=>'Opera',
	"s"=>'Apple Safari',
	"n"=>'Netscape Navigator'
);


$q=sprintf("SELECT * FROM updates ORDER BY time DESC LIMIT 100");

$r = mysql_query($q)
	or die (mysql_error(). $q);



while ($a = mysql_fetch_assoc($r)) {

	echo '<tr><td>'.$a['referer'].'</td><td>'.$names[$a['fromn']].' '.$a['fromv'].'</td><td>'.$names[$a['ton']].'</td><td>'.$a['lang'].'</td><td>'.date("d.m.Y, H:i",$a['time']).'</td></tr>';
//list($referer, $fromn, $fromv, $ton, $lang, $ip, $time) = mysql_fetch_row($r);

}
?>

</table>


</div>
<?php include("footer.php");?>