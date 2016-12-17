# -*- coding: utf-8 -*-
"""
Created on Sun Jun 12 14:21:31 2016

@author: TH
"""
#%%
import polib
#%%

#old (translated) string
#new renamed string
pairs="""
An initiative by web designers to inform users about browser-updates
An initiative by websites to inform users to update their web browser

The Project
About the Project

"I\'m not able to update my browser"
I can\'t update my browser

This website is an initiative by webdesigners, webmasters and bloggers who want to bring the web further and help their visitors.
This is an initiative by websites and blogs to raise security awareness and bring forward the web.

Compatibility
Compatibility & new Technology

Websites using new technology will be displayed more correctly
You can view sites that are using the latest technology

Comfort &amp; better experience
Comfort & better experience

With new features, extensions and better customisability, you will have a more comfortable web-experience
Have a more comfortable experience with new features, extensions and better customisability.

Your browser (%s) is <b>out of date</b>. It has known <b>security flaws</b> and may <b>not display all features</b> of this and other websites. <a%s>Learn how to update your browser</a>
This website would like to remind you: Your browser (%s) is <b>out of date</b>. <a%s>Update your browser</a> for more security, comfort and the best experience on this site.

Newer browsers protect you better against scams, viruses, trojans, phishing and other threats. They also fix security holes in your current browser!
Newer browsers protect you better against viruses, scams and other threats. Outdated browsers have security holes which are fixed in updates.

If you can't change your browser because of compatibility issues, think about installing a second browser for browsing and keep the old one for the compatibility.
If you can't change your browser because of compatibility issues, think about installing a second browser for browsing and keep the old one for compatibility.

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

This service provides a simple and standardized notification to visitors that they need to update their browser in order to use your website.
Browser-update.org is a tool to unobtrusively notify visitors that they should update their web browser in order to use your website.

This service is an  opportunity to inform your visitors  unobtrusively to switch to a newer browser.
This service provides a simple and standardized notification to visitors that they need to update their browser in order to use your website.

Test the notification bar!
Try it out!

Visitors with out-dated browser will be informed by a little, undisturbing bar, that their browser is not up-to-date and it is recommended to update.
Visitors with out-dated browser will be informed by a small, undisturbing message box, that their browser is not up-to-date and it is recommended to update.

By clicking the bar, them will get to <a href="%s">an info page with arguments why to change/update and some browser choices</a>.
By clicking the message, they will get to an <a href="%s">info page with reasons why to update (or change) and a list of browsers</a> available for their system.

If the visitor ignores the advice, it won't appear again for some time.
If the visitor ignores the advice, it won\'t reappear for some time.

The user will be notified only once, and won't be bothered any more. The notification bar is very small and won't affect the browsing experience negatively.
The user will be notified only once a day by default. The notification is small and does not block the user from using the site.

If there come more browser versions which won't be supported by the vendor in the future, exhibit security gaps or have been very old for a long time we are going to add them to our list automatically.
We take care not to erroneously notify users by constantly tweaking and improving the detection code. Users are presented with an up-to-date list of browsers that are available for their system.

Here you can get the code to include in your website. Just include it anywhere in the source of your page.
Just include this code anywhere in the source of your page.

Following browsers will be notified:
The following browsers will be notified:
    
You may also use third-party plugins for: 
There are plugins for:

Newer browsers let you use more features and new technologies (CSS3, SVG, HTML5, RSS, CSS Generated Content, flexible Layouts) on your website, resulting in a better browsing experience for your users.
Newer browsers let you use more features and new technologies on your website, resulting in a better browsing experience for your users.

<strong class="number">%d</strong> sites are using the Browser-Update.org script.
<b>%s</b> sites are using this notification

<strong class="number">%d</strong> visitors have already upgraded their browser.
<b>%s</b> visitors have already updated their browser

Install notification on your site
Install the browser update notification on your site

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


#%% extract strings
import subprocess
subprocess.call(['xgettext',
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

#%% upload new sources for translations
import subprocess
subprocess.call(['crowdin-cli-py', 'upload', 'sources'])

#subprocess.call(['java', '-jar', 'manage\crowdin-cli.jar', 'upload', 'sources','--config','manage\crowdin.yaml'])
#subprocess.call(['java', '-jar', 'manage\crowdin-cli.jar', 'upload', 'sources'])