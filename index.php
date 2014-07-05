<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8" />

  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width" />

  <title>CSRF Prevention Using Cookies</title>
  
  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

</head>
<body>
    <h2>CSRF Prevention using Javascript & Cookies</h2>
    <p>How it works: An event is attached to form submit, which then grabs an expiring token via ajax, sets a cookie via javascript, then confirms the validity of the cookie value server side.</p>
    <p>What this does is insures a client triggers the submit event (or any event attached, really.) from the element, is able to execute javascript, is able to store cookies set by javascipt. Something bots and scrapers are ill-equipped to do.</p>
    <form action="post_page.php" method="post">
        <p><input type="text" name="text" value="Sample text"></p>
        <p>
            <input type="hidden" name="foo" value="bar">
            <input type="submit" value="Post text to post_page.php">
        </p>
    </form>
    
    <script src="js/jquery.js"></script>
    <script src="js/app.js"></script>
</body>
</html>
