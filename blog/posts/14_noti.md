title: Detection improvements
date: 2014-04-22
comment: noti

Several improvements were made to the browser detection code:
We improved the detection of Firefox ESR releases (which are supported by Mozilla for one year) and do not ask them to update.
Although almost all the chrome users use the latest version of chrome because of the built-in auto-update mechanism, it may not work on some of the users.
To keep these users up to date (and safe) we now also notify users that use out of date versions of chrome.
Furthermore we improved the detection of other browsers we do not want to notify erroneously (e.g. Maxthon and Dolphin).
