<?php

/**
 * Get the token to set in cookie
 *
 * @return string encrypted timestamp
 **/
function get_ajax_token()
{
    return simple_encrypt(time());
}

/**
 * Validate the cookie token.
 *
 * @param string token can be passed in for validation
 * @param int TTL of token.
 * @return bool whether the token validated or not.
 **/
function valid_ajax_token($tok = null, $seconds = 10)
{       
    if (is_null($tok) && isset($_COOKIE['atok'])) {
        $tok = $_COOKIE['atok'];
    }
    $return = false;
    $tok = str_replace(' ', '+', trim($tok));
    $detok = simple_decrypt($tok);
    if ($detok >= strtotime('-'.(int)$seconds.' seconds')) {
        $return = true;
    }
    if (isset($_COOKIE['atok'])) {
        setcookie('atok', null, time()-100, '/', $_SERVER['SERVER_NAME']);
    }
    return $return;
}

/**
 * encrypt a string, based on a key value
 *
 * @param input_str	string or array to be encrypted
 * @param key		key used to encrypt string
 * @return result	encrypted string or false on error
 **/
function simple_encrypt($str='', $key='' )
{
    if($key == '') {
        $key = 'somekey';
    }

    $result = '';
    for($i = 1; $i <= strlen($str); $i++){
        $char = substr($str, $i-1, 1);
        $keychar = substr($key, ($i % strlen($key)) -1, 1);
        $char = chr(ord($char) + ord($keychar));
        $result .= $char;
    }

    return base64_encode($result);
}
     
/**
 * decrypt a string, based on a key value
 *
 * @param input_str	string or array to be decrypted
 * @param key		key used to encrypt original string
 * @return result	decrypted string or false on error
 **/
function simple_decrypt($str='', $key='')
{
        if($key==''){
            $key = 'somekey';
        }
        
        $str = base64_decode(str_replace(' ','+',$str));
        $result = '';
        for($i = 1; $i <= strlen($str); $i++){
            $char = substr($str, $i-1, 1);
            $keychar = substr($key, ($i % strlen($key)) -1, 1);
            $char = chr(ord($char) - ord($keychar));
            $result .= $char;
        }
        
    return $result;
}
