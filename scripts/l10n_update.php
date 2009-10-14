<?php

if (count($_SERVER['argv']) != 2)
	die('Usage: '.$_SERVER['argv'][0]. ' <LOCALE>');

$locale = $_SERVER['argv'][1];
$dir = dirname(dirname(__FILE__));
$lang_dir = $dir.DIRECTORY_SEPARATOR.'lang'.DIRECTORY_SEPARATOR.$locale.DIRECTORY_SEPARATOR.'LC_MESSAGES'.DIRECTORY_SEPARATOR;
chdir($dir);
exec('msgmerge -U '.escapeshellarg($lang_dir.'browser-update.po').' '.escapeshellarg($dir.DIRECTORY_SEPARATOR.'lang'.DIRECTORY_SEPARATOR.'template.pot'));

?>
