# browser-update
Many internet users are still using very old, out-dated browsers – most of them for no actual reason. 
We want to remind these unobtrusively to update their browser.

## Goals
1. Provide webdesigners a unified way to tell the user that they need a newer browser to use this website in all its beauty.
2. Improve the security, comfort and overall experiance of users by convincing them to update
3. But: do not annoy or lock out users

## How to use
Go to [browser-update.org](http://browser-update.org), choose the browsers you want to be notified and embed the code into your website.

## Unobtrusive
Unobtrusive here means:
* We take care not to  erroneously notify users by constantly tweaking the detection code
* users of small niche browsers are not notified, users who have no possibility to update are not notified
* We do not block the users form using a website in any way
* The website can be used without any additional step
* The notification will only appear once a day by default
* If the user **activly** closes the notification, it will reappear after a week


## More features
* Translated into >30 languages
* Giving users reasons why an [up-to-date browser is important](http://browser-update.org/update.html)
* Only showing browsers that are available for the users operating system.

More infos, our motivation and the features can be found on our [web site](http://browser-update.org).

## Browsers to be notified
The browsers which are currently [notified in the default configuration](https://github.com/josselex/browser-update/wiki/BrowsersToNotify)

## Translations
The page currently translated into more than 30 languages.
If you want to improve the translations or translate into a new language please
see our [translation manual](https://github.com/browser-update/browser-update/wiki/How-to-Translate).

## Cross-Browser-Testing

We are using the [browserstack.com](http://browserstack.com) cross browser testing tool to make sure the notification and website is shown correctly on all kinds of browsers and devices.
