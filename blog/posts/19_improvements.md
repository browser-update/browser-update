title: Custom text and various other improvements
date: 2019-09-13

A custom text for the update message can can now be specified for each browser separately. [See documentation for details](https://github.com/browser-update/browser-update/wiki/Details-on-configuration#custom-text).

In the last year a lot of work was put into improvements, new features and fixing edge-case bugs.

* reminderClosed: 0 can be passed. Then the user cannot close the bar
* add option "notify_lts" to also notify firefox browser that has still "Long term support" (LTS). Normal behaviour is to ignore this version as long as it is supported
* require instead of notify: specify version which is required on the site. This is easier with minor version comparison
* better detection if iOS devices can be updated to the latest version of iOS

Some of the fixes:

* fixed bug where specifying required version "0" did not mean "latest version", as specified in the docs
* Fix keyboard accessibility for the "Ignore" button-link
* fix when permanently ignoring did not work on some sites (where reminder=0 was set)
* do not make whole bar clickable if custom text is set

As always, we also worked on improving the detection, reduce false positive notifications and are whitelisting small niche browsers.