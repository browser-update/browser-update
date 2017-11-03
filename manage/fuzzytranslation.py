# -*- coding: utf-8 -*-
"""
replacing new strings with old translations
"""
import polib

#old (translated) string
#new renamed string
pairs="""
An initiative by web designers to inform users about browser-updates
An initiative by websites to inform users to update their web browser

If you are on a computer that is maintained by an admin and you cannot install a new browser, ask your admin about it.
Ask your admin to update your browser if you cannot install updates yourself.

blaasdasdfsdaf
faselsdfsadf""";

pairs=pairs.replace("\r","")[1:-1].split("\n\n")
mappings={s.split("\n")[0]:s.split("\n")[1] for s in pairs}
#%%

po = polib.pofile('lang/de_DE/LC_MESSAGES/update.po')
valid_entries = [e for e in po if not e.obsolete]
for entry in valid_entries:
    #print(entry.msgid)
    if entry.msgid in mappings:
        print("replacing", entry.msgid[:10], "with",mappings[entry.msgid][:10])
        entry.msgid=mappings[entry.msgid]
po.save()

po.save_as_mofile('lang/de_DE/LC_MESSAGES/update.mo')


#%%
pairs="""aaa
bbb

Subtle
Unobtrusive

bla
fasel"""

pairs=pairs.replace("\r","")[1:-1].split("\n\n")
mappings={s.split("\n")[0]:s.split("\n")[1] for s in pairs}

#%%
    
po = polib.pofile('lang/de_DE/LC_MESSAGES/site.po')
valid_entries = [e for e in po if not e.obsolete]
for entry in valid_entries:
    #print(entry.msgid)
    if entry.msgid in mappings:
        print("replacing", entry.msgid[:10], "with",mappings[entry.msgid][:10])
        entry.msgid=mappings[entry.msgid]
po.save()

po.save_as_mofile('lang/de_DE/LC_MESSAGES/site.mo')




#%%
pot = polib.pofile('lang/update.pot')
for entry in pot:
    print (entry.msgid, entry.msgstr)
    
#%%
    
#%% display old translations
po = polib.pofile('lang/de_DE/LC_MESSAGES/update.po')
valid_entries = [e for e in po if not e.obsolete]
for entry in valid_entries:
    print(entry.msgid)
#%%


#%% getting files
from glob import glob
paths = glob('lang/*/LC_MESSAGES/')
paths=[p[5:10] for p in paths]
paths

#%% updating all site.po
for p in paths:
    print("updating %s"%p)
    try:
        po = polib.pofile('lang/%s/LC_MESSAGES/site.po'%p)
    except OSError:
        print("no file found")
        continue
    valid_entries = [e for e in po if not e.obsolete]
    for entry in valid_entries:
        #print(entry.msgid)
        if entry.msgid in mappings:
            print("  ", entry.msgid[:10], "-->",mappings[entry.msgid][:10])
            entry.msgid=mappings[entry.msgid]
    po.save()
    
    po.save_as_mofile('lang/%s/LC_MESSAGES/site.mo'%p)


#%% updating all update.po
for p in paths:
    print("updating %s"%p)
    try:
        po = polib.pofile('lang/%s/LC_MESSAGES/update.po'%p)
    except OSError:
        print("no file found")
        continue
    valid_entries = [e for e in po if not e.obsolete]
    for entry in valid_entries:
        #print(entry.msgid)
        if entry.msgid in mappings:
            print("  ", entry.msgid[:10], "-->",mappings[entry.msgid][:10])
            entry.msgid=mappings[entry.msgid]
    po.save()
    
    po.save_as_mofile('lang/%s/LC_MESSAGES/update.mo'%p)

#%%

pairs="""aaa
bbb

Optionally include up to two placeholders "%s" which will be replaced with the browser version and contents of the link tag. Example: "Your browser (%s) is old.  Please &lt;a%s&gtupdate&lt;/a&gt;"
Optionally include up to two placeholders "%s" which will be replaced with the browser version and contents of the link tag. Example: "Your browser (%s) is old.  Please &lt;a%s&gt;update&lt;/a&gt;"

bla
fasel"""
pairs=pairs.replace("\r","")[1:-1].split("\n\n")
mappings={s.split("\n")[0]:s.split("\n")[1] for s in pairs}
#%%

from glob import glob
paths = glob('lang/*/LC_MESSAGES/')
paths=[p[5:10] for p in paths]
paths

#%% updating all site.po
for p in paths:
    print("customize %s"%p)
    try:
        po = polib.pofile('lang/%s/LC_MESSAGES/customize.po'%p)
    except OSError:
        print("no file found")
        continue
    valid_entries = [e for e in po if not e.obsolete]
    for entry in valid_entries:
        #print(entry.msgid)
        if entry.msgid in mappings:
            print("  ", entry.msgid[:10], "-->",mappings[entry.msgid][:10])
            entry.msgid=mappings[entry.msgid]
    po.save()
    
    po.save_as_mofile('lang/%s/LC_MESSAGES/customize.mo'%p)
