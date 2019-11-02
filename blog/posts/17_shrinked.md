title: Shrinked script size, now only 2 kB
date: 2017-01-01
comment: shrinked


We've split the oudated browser detection script into two parts: 1) the detection if the browser is outdated and 2) the showing of the message to users with outdated browser.


The detection part is what you embed into your site (<code>update.js</code>). This is what all users will have to download. And this is is now only 2.2 kB in size gzipped, five times smaller than before
(>10kB).


Then, if the browser is outdated and needs to be notified, the message file (<code>update.show.js</code>) will be loaded, but this will only happen for about 1% of the users.
