# -*- coding: utf-8 -*-
"""

"""


#%% download latest translations from crowdin
import subprocess
subprocess.call(['crowdin-cli-py', 'download'])

#%% Build translations
import polib
from glob import glob
paths = glob('lang/*/LC_MESSAGES/')
paths=[p[5:10] for p in paths]
for p in paths:
    print("build %s"%p)
    try:
        po = polib.pofile('lang/%s/LC_MESSAGES/customize.po'%p)
        po.save_as_mofile('lang/%s/LC_MESSAGES/customize.mo'%p)
    except OSError:        
        print("no customize.po found")
        
    try:
        po = polib.pofile('lang/%s/LC_MESSAGES/update.po'%p)
        po.save_as_mofile('lang/%s/LC_MESSAGES/update.mo'%p)
    except OSError:        
        print("no update.po found")
        
    try:
        po = polib.pofile('lang/%s/LC_MESSAGES/site.po'%p)
        po.save_as_mofile('lang/%s/LC_MESSAGES/site.mo'%p)
    except OSError:        
        print("no site.po found")
                
    
#%% Build minified version
#pip install ply==3.4
#pip install slimit
from slimit import minify

def read_file(name):
    with open (name, "r", encoding="utf-8") as f:
        return "".join(str(f.read()))#.replace('\n', '')

def write_file(name,string):
    with open(name, "w", encoding="utf-8") as f:
        f.write(string)

add="""//(c)2017, MIT Style License <browser-update.org/LICENSE.txt>
//it is recommended to directly link to this file because we update the detection code
"""

text=read_file("update.js")
minned=minify(text, mangle=False, mangle_toplevel=False)
write_file("update.min.js",add+minned)

text=read_file("update.show.js")
minned=minify(text, mangle=False, mangle_toplevel=False)
write_file("update.show.min.js",minned)


#%% Convert strings to javascript format
st='<b>Your web browser ({brow_name}) is out-of-date</b>. Update your browser for more security, comfort and the best experience on this site. <a{up_but}>Update browser</a> <a{ignore_but}>Ignore</a>'
import polib
from glob import glob
paths = glob('lang/*/LC_MESSAGES/')
paths=[p[5:10] for p in paths]
for p in paths:
    #print("build %s"%p)
    #if p[:2] not in ["vi","hi","sk"]:
    #    continue
    
    try:
        po = polib.pofile('lang/%s/LC_MESSAGES/update.po'%p)
    except OSError:        
        print("no update.po found")
    if p in ["rm_CH","en_SE"]:
        continue
        
    if p in ["zh_TW"]:
         for i in po:
            if i.msgid==st:
                print("t[\"%s\"]='%s';"%(p[:5].lower().replace("_","-"),i.msgstr.replace("\n","").replace("'","\\'")))
                break
    else:
        for i in po:
            if i.msgid==st:
                #if i.msgstr!="":
                print("t.%s='%s';"%(p[:2],i.msgstr.replace("\n","").replace("'","\\'")))
                break
        
#%% download maxmind geoip database

#wget http://geolite.maxmind.com/download/geoip/database/GeoLite2-Country.mmdb.gz
#gunzip GeoLite2-Country.mmdb.gz
