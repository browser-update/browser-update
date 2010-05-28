<?php
require_once("config.php");
require_once("lib/init.php");
require_once("lib/lang.php");
include("header.php");
?>

<div class="left">
<h2 class="top"><?php echo T_('Statistics'); ?></h2>

<p>
	<?php
	#$q=sprintf("SELECT 1 FROM updates GROUP BY referer");
        $q=sprintf("SELECT COUNT(DISTINCT referer) FROM views");
	$r = mysql_query($q)
    	or die (mysql_error(). $q);
	list($domainnum) = mysql_fetch_row($r);
	echo sprintf(T_('<strong class="number">%d</strong> sites are using the Browser-Update.org script.'), $domainnum);
	?>
</p>

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
<p>
    <?php
    $visitors_upgraded = get_num();
    echo sprintf(T_('<strong class="number">%d</strong> visitors have already upgraded their browser.'), $visitors_upgraded);
    ?>
</p>
<?php
/*
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
<table>
    <thead>
        <tr><td></td><td>zu Firefox</td><td>zu Opera</td><td>zu Safari</td><td>zu Chrome</td><td>zu IE</td></tr>
    </thead>
    <tbody>
        <tr><th>von IE</th>         <td><?php echo get_num('i','f')?></td><td><?php echo get_num('i','o')?></td><td><?php echo get_num('i','s')?></td><td><?php echo get_num('i','c')?></td><td><?php echo get_num('i','i')?></td></tr>
        <tr><th>von Firefox</th>    <td><?php echo get_num('f','f')?></td><td><?php echo get_num('f','o')?></td><td><?php echo get_num('f','s')?></td><td><?php echo get_num('f','c')?></td><td><?php echo get_num('f','i')?></td></tr>
        <tr><th>von Opera</th>      <td><?php echo get_num('o','f')?></td><td><?php echo get_num('o','o')?></td><td><?php echo get_num('o','s')?></td><td><?php echo get_num('o','c')?></td><td><?php echo get_num('o','i')?></td></tr>
        <tr><th>von Safari</th>     <td><?php echo get_num('s','f')?></td><td><?php echo get_num('s','o')?></td><td><?php echo get_num('s','s')?></td><td><?php echo get_num('s','c')?></td><td><?php echo get_num('s','i')?></td></tr>
    </tbody>
</table>
*/
?>
<table>
    <thead><tr><td><?php echo T_('From'); ?></td><td><?php echo T_('To'); ?></td><td><?php echo T_('Amount'); ?></td></tr></thead>
    <tbody>
    <?php
    $q=mysql_query('SELECT fromn,ton,COUNT(*) as num FROM `updates` GROUP BY fromn, ton ORDER BY num DESC');
     while ($a = mysql_fetch_assoc($q)) {
         echo '<tr><td>'.$names[$a['fromn']].'</td><td>'.$names[$a['ton']].'</td><td>'.$a['num'].'</td></tr>';
     }
    ?>
    </tbody>
</table>


<h3><?php echo T_('Recent browser updates'); ?></h3>

<table>
<thead>
<tr>
<td><?php echo T_('Site'); ?></td>
<td><?php echo T_('Old browser'); ?></td>
<td><?php echo T_('New browser'); ?></td>
<td><?php echo T_('Language'); ?></td>
<td><?php echo T_('Date'); ?></td>
</tr>
</thead>

<?php
$q=sprintf("SELECT * FROM updates ORDER BY time DESC LIMIT 100");

$r = mysql_query($q)
	or die (mysql_error(). $q);



while ($a = mysql_fetch_assoc($r)) {
	echo '<tr><td>'.$a['referer'].'</td><td>'.$names[$a['fromn']].' '.$a['fromv'].'</td><td>'.$names[$a['ton']].'</td><td>'.$a['lang'].'</td><td>'.date("d.m.Y, H:i",$a['time']).'</td></tr>';
        //lisT_($referer, $fromn, $fromv, $ton, $lang, $ip, $time) = mysql_fetch_row($r);
}
?>

</table>


</div>
<?php include("footer.php");?>
