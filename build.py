# -*- coding: utf-8 -*-
"""

"""

#%% Build translations
#crowdin-cli-py download
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
        print("no file found")
        
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
from slimit import minify

def read_file(name):
    with open (name, "r", encoding="utf-8") as f:
        return "".join(str(f.read()))#.replace('\n', '')

def write_file(name,string):
    with open(name, "w", encoding="utf-8") as f:
        f.write(string)

add="""//(c)2015, MIT Style License <browser-update.org/LICENSE.txt>
//recommended to directly link to this file because we update the detection code
"""

text=read_file("update.js")
minned=minify(text, mangle=False, mangle_toplevel=False)
write_file("update.min.js",add+minned)


