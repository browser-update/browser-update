title: Edge and IE separately, notify minor versions
date: 2018-04-14

It is now possible to configure the notification for Microsoft Edge and Microsoft Internet Explorer separately. 

Before, Edge was treated as the direct successor of IE (what it actually is). 
But some users wanted to notify outdated Edge versions but keep supporting Internet Explorer 11.

Now you can pass for example `required:{'e':15,'i':11}` to require Internet Explorer >=11 and Edge >=15 on your site.

By default, passing only one of "i" or "e" options falls back to the old mode and treats both the same.
 
It is also now possible to notify minor, patch and build version numbers of browsers. This means you can now pass a string, e.g. 
`c:"64.0.3282.16817"` to require at least Chrome Version 64.0.3282.16817 which uses version numbers like `MAJOR.MINOR.BUILD.PATCH`.
And this is also useful for Microsoft Edge which uses  `MAJOR.BUILD` as the version number pattern, for example
`15.15254`, `14.14332` or `12.10136`, to address versions between major releases. 
 
 
[Detailed documentation of notification options](https://github.com/browser-update/browser-update/wiki/Details-on-configuration)