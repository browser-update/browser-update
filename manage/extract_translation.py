# -*- coding: utf-8 -*-
"""
Extract strings from php files and upload them
"""

#%% extract strings
import subprocess
subprocess.call(['manage/xgettext',
                 "header.php", 
                 "footer.php", 
                 "update-browser.php",
                 "--keyword=T_gettext", 
                 "--keyword=T_", 
                 "--keyword=T_ngettext:1,2", 
                 "--from-code=utf-8", 
                 "--package-name=browser-update-update", 
                 "--language=PHP",
                 "--output=lang/update.pot"])
#%% extract site strings
import subprocess
subprocess.call(['manage/xgettext',
                 "blog.php",
                 "stat.php",
                 "index.php", 
                 "contact.php",
                 "update.testing.php", 
                 "--keyword=T_gettext", 
                 "--keyword=T_", 
                 "--keyword=T_ngettext:1,2", 
                 "--from-code=utf-8", 
                 "--package-name=browser-update-site", 
                 "--language=PHP",
                 "--output=lang/site.pot"])     
#%% extract customize strings
import subprocess
subprocess.call(['manage/xgettext',
                 "customize.php", 
                 "--keyword=T_gettext", 
                 "--keyword=T_", 
                 "--keyword=T_ngettext:1,2", 
                 "--from-code=utf-8", 
                 "--package-name=browser-update-customize", 
                 "--language=PHP",
                 "--output=lang/customize.pot"])    
                 

#%% upload new sources for translations
import subprocess
subprocess.call(['crowdin-cli-py', 'upload', 'sources'])

