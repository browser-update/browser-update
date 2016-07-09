# -*- coding: utf-8 -*-
#%%
#pip install ply==3.4
#pip install slimit
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
#%%
