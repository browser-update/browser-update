### Goals ###
  * Cleaner, easier
  * Prettier
  * More trusworthy image

  * the "language"-selector is a mess right now. Takes up to much space.

### Goals ###
  * Change not to much strings or none at all to keep the old translations.

### Concept ###

A concept version of a redesign can be viewed at http://browser.nabble.nl/.

I started this design a while ago, and adapted it recently to be used at browser-update.org, looking forward to your response!
It radically changes the layout of the current website, and this concept is built with the MVC framework [Ajde](http://code.google.com/p/ajde) to better seperate application logic, templates and data (browser definitions). It includes a simple [CRUD administrator page](http://browser.nabble.nl/admin/browser) to easily update browser definitions and I plan to further expand it so the widget (browser bar) also uses this centrally stored (MySQL) information.

A major point - in my point of view - is that a lot of text should be changed to represent a more positive approach of trying to convince users to update their browser. What I mean is, not focus on possible security flaws and outdated browsers, but instead on awesome new features and a much faster user experience. This would mean, however, that a lot of already translated strings would be discarded.

This design is largely a rough concept, and a lot of changes are still possible. But I'd like your feedback first, before I continue working on more functionality.

The list of things still to do will continue to grow, but here is a start:

  * Is the current hosting provider capable of MySQL / gettext?
  * Update CSS to be compatible with older browsers (HA HA)
  * Overview of translation strings can be recycled / should be updated
  * Adaptation of current features (blog etc.)
  * Logo redesign?
  * Inline style elements in template
  * New widget look-and-feel
  * Update of update.js (rewrite needed???)