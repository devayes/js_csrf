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
    <style>
    .box {
        border:1px solid #ccc; padding:5px; margin-top:20px;
    }
    </style>
</head>
<body>
    <h2>CSRF Prevention using Javascript & Cookies</h2>
    <p>How it works: An event is attached to form submit, which then grabs an expiring token via ajax, sets a cookie via javascript, then confirms the validity of the cookie value server side.</p>
    <p>What this does is insures that a client triggers the event (submit, click, focus, hover, etc..) from the element, is able to execute javascript, and is able to store cookies set by javascript. Something bots and scrapers are ill-equipped to do.</p>
    
    <div class="box">
        <p>Basic form usage. Prevents remote posting of data, ensures click came from a human on your site:</p>
        <form action="post_page.php" method="post">
            <p><input type="text" name="text" value="Sample text"></p>
            <p><input type="checkbox" id="tokenize" value="1" checked> Tokenize</p>
            <p>
                <input type="hidden" name="foo" value="bar">
                <input type="submit" value="Post text to post_page.php">
            </p>
        </form>
    </div>
    
    <div class="box">
        <p>Attach to click events on links. Basic CSRF prevention (eg: delete links or logout links):</p>
        <p><a class="csrf" href="post_page.php?foo=bar">Works on links, too.</a> - <a href="post_page.php?foo=bar">Without token</a></p>
    </div>

    <div class="box">
        <p>Use in asynchronous ajax calls to protect internal resources from external access or abuse:</p>
        <pre>
$('a.somelink').on('click', function(){
    // Set token
    if($(this).prop('rel') != 'notoken'){
        OBJ.getToken();
    }
    $.post('post_page.php', {'foo':'bar'}, function(data) {
        alert(data);
    });
});
        </pre>
        <a class="somelink" href="#">Asyncronous ajax link</a> - <a class="somelink" rel="notoken" href="#">Without token</a>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/app.js"></script>
</body>
</html>
