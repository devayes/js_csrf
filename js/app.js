var OBJ={
    cookie:{set:function(n,v,e){document.cookie=n+'='+escape(v)+((e)?';expires='+e.toUTCString():'')+';domain=localhost;path=/';},get:function(n){n=n+'=';var c=document.cookie,t=c.indexOf(n);if(t==-1){return '';}var v=c.indexOf(';',t+n.length);if(v==-1){v=c.length;}return unescape(c.substring(t+n.length,v));}},
    getToken:function(){var token=$.ajax({type:"POST",data:'ajax=1',url:'ajax.php',async:false,cache:false}).responseText;OBJ.cookie.set('atok',token);return token;}
}

$(function(){
    $('form').submit(function(){
        var tok = OBJ.getToken();
        return true;
    });
});