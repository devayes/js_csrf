# Javascript CSRF Prevention #

Flow:
1. Form Submit (index.php)
2. Triggers event in app.js, calls OBJ.getToken()
3. Synchronous ajax call retrieves a token from ajax.php and sets the token in a cookie (atok)
4. Form is submitted to post_page.php
5. Token is validated (functions.php) and data is either displayed or not.

Cookies are set to domain localhost. If you are not running this example on localhost, change all instances to your domain. js/app.js line 2 & functions.php line 32.