var domain = window.location.hostname;
if(domain == 'localhost') domain = '';
var path = window.location.pathname;
var dir = path.substring(0, path.lastIndexOf('/'));

var OBJ = {
    // Get basePath
    getOrigin:function(){ return window.location.protocol + '//' + window.location.hostname + (window.location.port ? ':' + window.location.port: '') + dir; },
    // Cookie set and get methods.
    cookie:{set:function(n,v,e){document.cookie=n+'='+escape(v)+((e)?';expires='+e.toUTCString():'')+';domain='+domain+';path=/';},get:function(n){n=n+'=';var c=document.cookie,t=c.indexOf(n);if(t==-1){return '';}var v=c.indexOf(';',t+n.length);if(v==-1){v=c.length;}return unescape(c.substring(t+n.length,v));}},
    // Change the url to your tokenizer (in this case, ajax.php)
    getToken:function(){var token=$.ajax({type:"POST",data:'ajax=1',url:OBJ.getOrigin()+'/ajax.php',async:false,cache:false}).responseText;OBJ.cookie.set('atok',token);return token;}
}

$(function(){
    // All forms will generate a token on submit
    $('form').on('submit', function(){
        if($('form input#tokenize').is(':checked')){
            OBJ.getToken();
        }
        return true;
    });
    // Works for links too:
    // <a class="csrf" href="safe_page.php">link</a>
    $('.csrf').on('click', function(){
        OBJ.getToken();
        return true;
    });

    // Asynchrounous resource access
    $('a.somelink').on('click', function(e){
        e.preventDefault();
        // Set token
        if($(this).prop('rel') != 'notoken'){
            OBJ.getToken();
        }
        $.post('post_page.php', {'asynctest':'1', 'foo': 'bar'}, function(data) {
            alert(data);
        }, 'text');
    });
});
