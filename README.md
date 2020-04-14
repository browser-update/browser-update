# browser-update
Many internet users are still using very old, out-dated browsers – most of them for no actual reason. 
We want to remind these unobtrusively to update their browser.

## Goals
1. Provide webdesigners a unified way to tell the user that they need a newer browser to use this website in all its beauty.
2. Improve the security, comfort and overall experience of users by convincing them to update
3. But: do not annoy or lock out users

## How to use
Go to [browser-update.org](http://browser-update.org), choose the browsers you want to be notified and embed the code into your website.

Or use the npm package:

## npm usage
Install it using npm:

    npm install browser-update --save

And load it (using browserify, webpack or similar):

````js
var browserUpdate = require('browser-update');
browserUpdate({ [configuration-options] })
````

If you want to include only the browser-detection script and
the notification will be loaded from our cdn only if
 really an outdated browser is detected (to save some kilobytes), use this:

````js
var browserUpdate = require('browser-update/update.npm.js');
browserUpdate({ [configuration-options] })
````

If you have an ES6 compatible build environment, you can of course use the import statement:

````js
import browserUpdate from 'browser-update';
````

Options can be something like:
````js
{
    required: {
        e:-2,
        i:11,
        f:-3,
        o:-3,
        s:10.1,
        c:"64.0.3282.16817",
        samsung: 7.0,
        vivaldi: 1.2
    },
    insecure:true
}
````
See the [available options](http://browser-update.org/customize.html) to see how you can customize it to your needs.

## Features
* Unobtrusive
    * We take care not to  erroneously notify users by constantly tweaking the detection code
    * users of small niche browsers and users who have no possibility to update are not notified
    * We do not block the users form using a website in any way
    * The website can be used without taking additional steps
    * The notification will only appear once a day by default
    * If the user **actively** closes the notification, it will reappear after a week
* Translated into > 30 languages
* Browser detection less than 3kb gzipped + rest gets only lazy loaded when an outdated browser was detected
* Giving users reasons why an [up-to-date browser is important](http://browser-update.org/update.html)
* Only showing browsers that are actually available for the users device and operating system (Android, Windows Phone, Windows, MacOS, iOS).
* Only notify users that actually can update to a newer browser on their devices
* Hide notification from bots
* Well tested

More information, our motivation and the features can be found on our [web site](http://browser-update.org).

## Translations
The page currently translated into more than 30 languages.
If you want to improve the translations or translate into a new language please
see our [translation manual](https://github.com/browser-update/browser-update/wiki/How-to-Translate).

## Cross-Browser-Testing

We are using the [browserstack.com](http://browserstack.com) cross browser testing tool to make sure the notification and website is shown correctly on all kinds of browsers and devices.
