# Javascript CSRF Prevention #

Purpose:
------------
Provide a simple, transparent authorization mechanism to insure submission authenticity. This example prevents resource abuse and automated access. Simply put, it prevents CSRF, unwanted access to sensitive application resources as well as preventing bot activity (spam).

Replaces CAPTCHA and other CSRF form tokenization techniques, the latter still being susceptible to scraping the form input and submission. By using client side events attached to elements (form submit & link clicks) to store a cookie on the client, we eliminate the ability of a vast majority of tools & techniques to access protected resources. Best of all, it's transparent to the user, replacing the need for CAPTCHA's and other annoying human tests.

Flow:
------------
*  Form Submit (index.php)
*  Triggers event in app.js, calls OBJ.getToken()
*  Synchronous ajax call retrieves a token from ajax.php and sets the token in a cookie (atok)
*  Form is submitted to post_page.php
*  Token is validated (functions.php) and data is either displayed or not.
