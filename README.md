CSRF Prevention using Javascript & Cookies
==========

Purpose:
------------
Provide a simple, transparent authorization mechanism to insure submission authenticity. This example prevents resource abuse, automated and/or remote access. Simply put, it prevents CSRF, unwanted access to sensitive application resources as well as preventing bot activity (spam).

Replaces CAPTCHA and other CSRF form tokenization techniques, the latter still being susceptible to scraping the form input and submission. By using client side events attached to elements (form submit & link clicks) to store a cookie on the client, we eliminate the ability of a vast majority of tools & techniques to access protected resources. Best of all, it's transparent to the user, replacing the need for CAPTCHA's and other annoying human tests.

Usages:
------------
- Using Ajax `$_GET` URL's to retrieve a user's profile information exposes the URL and can be accessed by copying the URL directly into the address bar. Allowing the exposed data to be scraped or exploited (DoS, trickle attacks, etc). Past and current solutions include checking `$_SERVER['HTTP_X_REQUESTED_WITH']` (easily spoofed) or using the `$_POST` method. This technique will protect any URL using any method.
- Most forms these days include a hidden input token also stashed in a session variable. Sessions are generally client agnostic which would allow a remote script to scrape the token value out of the input and post everything to the action URL effectively defeating its purpose. This technique ensures the client triggers a javascript event and is able to store a cookie set by javascript. As a reminder, cookies can only be set on the domain the script is running on (never minding iframes), this ensures that the client is on your site, following the flow required to access the resource.
- You might have links like: `/profile/delete` or `/contact/add/123`. Local or remote links can then be crafted to these URL's baiting unsuspecting users into performing unintended actions. This technique can be attached to any javascript event (ie: click) and resolves this issue by requiring a token obtained by triggering an event (click) to complete the action.
- Another "solution" I've seen is checking the referer to ensure actions taken are verified to be on the local domain. Some browsers and/or firewalls block the referer from being sent, and it can also be easily spoofed. This technique ensures the event was fired on the domain the cookie was created.

Suggestions:
------------
- Change the encryption. I swiped that bit off the internets because I didn't want to deal with noting PHP versions, modules, algorithms, etc.
- You might still want to think about double clicks. You could check if a click has happened and just return `false` instead of creating another token which would prevent extra clicks from propagating and having any effect.
- You could, if you were crafty enough, set tokens by name (eg: `OBJ.setToken('foo');`) and check them by name (eg: `valid_ajax_token('foo');`). It'd be useful if you wanted to fire multiple protected events.

Caveats:
------------
If a user has javascript or cookies disabled (< 2% of users), it will impede functionality. These are testable and left as an exercise for the developer. [(hint)](www.google.com).

Examples:
------------
Examples included. Load up index.php and go.


*Copyright 2009 Devin Hayes, [Public Domain License](http://unlicense.org/UNLICENSE)*
