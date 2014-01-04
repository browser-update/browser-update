<?php

$dir = dirname(dirname(__FILE__));
chdir($dir);
//exec('xgettext *.php -kT_ngettext:1,2 -kT_ -kT_gettext -L PHP --from-code=utf-8 --package-name=browser-update  -o '.escapeshellarg($dir.DIRECTORY_SEPARATOR.'lang'.DIRECTORY_SEPARATOR.'template.pot'));

echo exec('xgettext updatex.php -kT_ngettext:1,2 -kT_ -kT_gettext -L PHP --from-code=utf-8 --package-name=browser-update-core  -o '.escapeshellarg($dir.DIRECTORY_SEPARATOR.'lang'.DIRECTORY_SEPARATOR.'template-core.pot'));
//xgettext updatex.php header.php -kT_ngettext:1,2 -kT_ -kT_gettext -L PHP --from-code=utf-8 --package-name=browser-update-core  -o lang/template-core.pot
?>
