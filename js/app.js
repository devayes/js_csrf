var OBJ={
    // Change the domain here
    cookie:{set:function(n,v,e){document.cookie=n+'='+escape(v)+((e)?';expires='+e.toUTCString():'')+';domain=localhost;path=/';},get:function(n){n=n+'=';var c=document.cookie,t=c.indexOf(n);if(t==-1){return '';}var v=c.indexOf(';',t+n.length);if(v==-1){v=c.length;}return unescape(c.substring(t+n.length,v));}},
    // Change the url to your tokenizer
    getToken:function(){var token=$.ajax({type:"POST",data:'ajax=1',url:'ajax.php',async:false,cache:false}).responseText;OBJ.cookie.set('atok',token);return token;}
}

$(function(){
    // All forms will generate a token on submit
    $('form').on('submit', function(){
        OBJ.getToken();
        return true;
    });
    // Works for links too:
    // <a class="csrf" href="safe_page.php">link</a>
    $('a.csfr').on('click', function(){
        OBJ.getToken();
        return true;
    });
});
