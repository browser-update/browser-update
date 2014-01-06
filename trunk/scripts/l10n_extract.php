<?php

$dir = dirname(dirname(__FILE__));
chdir($dir);
//exec('xgettext *.php -kT_ngettext:1,2 -kT_ -kT_gettext -L PHP --from-code=utf-8 --package-name=browser-update  -o '.escapeshellarg($dir.DIRECTORY_SEPARATOR.'lang'.DIRECTORY_SEPARATOR.'template.pot'));

exec("xgettext header.php footer.php update-browser.php -kT_ngettext:1,2 -kT_ -kT_gettext -L PHP --from-code=utf-8 --package-name=browser-update-update -o lang/update.pot");
exec("xgettext `ls | egrep '\\.php$' | egrep -v '(header|footer|customize|update(-browser)?)\\.php'` -kT_ngettext:1,2 -kT_ -kT_gettext -L PHP --from-code=utf-8 --package-name=browser-update-site -o lang/site.pot");
exec("xgettext customize.php -kT_ngettext:1,2 -kT_ -kT_gettext -L PHP --from-code=utf-8 --package-name=browser-update-customize -o lang/customize.pot");
exec("xgettext header.php footer.php update.php -kT_ngettext:1,2 -kT_ -kT_gettext -L PHP --from-code=utf-8 --package-name=browser-update-legacy -o lang/update-legacy.pot");
