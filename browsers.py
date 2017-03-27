def read_file(name):
    with open (name, "r", encoding="utf-8") as f:
        return "".join(str(f.read()))#.replace('\n', '')

def write_file(name,string):
    with open(name, "w", encoding="utf-8") as f:
        f.write(string)

#%%
import urllib.request,re
def get_version(wikiname, regex):
    with urllib.request.urlopen('http://en.wikipedia.org/wiki/%s'%wikiname) as response:
       html = response.read()
    html=html.decode("utf-8") 
    html=re.sub('<[^<]+?>', '', html)#strip tags
    r= re.compile(regex, re.DOTALL|re.MULTILINE)
    version=r.search(html)
    try:
        version=version.group(1)
    except AttributeError:
         ValueError("Could not get Version of %s"%wikiname)
    print("%s has version %s"%(wikiname, version))
    return version
#%%
browsers_d={
    "c":56,
    "f":51,
    "o":42,
    "i":11,
    "s":10,
    "vivaldi": 1.6
}
#%%
browsers_d["f"]=get_version("Firefox",r"Stable release.{0,150}Standard[^\d]*(\d*\.*\d*)")
browsers_d["c"]=get_version("Google_Chrome",r"Stable release.{0,150}Windows[^\d]{0,20}(\d*\.*\d*)")
browsers_d["o"]=get_version("Opera_(web_browser)",r"Stable release[^\d]{0,20}(\d*\.*\d*)")
browsers_d["s"]=get_version("Safari_(web_browser)",r"Stable release[^\d]{0,20}(\d*\.*\d*)")
browsers_d["pale"]=get_version("Pale_Moon_(web_browser)",r"Stable release[^\d]{0,20}(\d*\.*\d*)")
browsers_d["yandex"]=get_version("Yandex_Browser",r"Stable release.{0,50}Windows[^\d]{0,20}(\d*\.*\d*)")
browsers_d["vivaldi"]=get_version("Vivaldi_(web_browser)",r"Stable release[^\d]{0,20}(\d*\.*\d*)")
browsers_d
#%%

browsers_m={
    "android":0,
    "c": 0,
    "f":0,
    "o":0
}        

#%%
browsers_m["o"]=get_version("Opera_Mobile",r"Stable release.*Android[^\d]*(\d*\.*\d*).*Android.*Preview release")
browsers_m["c"]=get_version("Google_Chrome",r"Stable release.{0,150}Android[^\d]{0,20}(\d*\.*\d*)")
browsers_m["f"]=get_version("Firefox_for_mobile",r"Stable release[^\d]{0,20}(\d*\.*\d*)")
#%%
browsers_m
#%%

#%%
import json
j={"current":{"desktop":browsers_d,"mobile":browsers_m}}
with open("browsers.json", 'w') as f:
    json.dump(j, f, sort_keys=True, indent=4, separators=(',', ': '))  
