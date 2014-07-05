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
    $detok = simple_decrypt(trim($tok));
    if ($detok >= strtotime('-'.(int)$seconds.' seconds')) {
        $return = true;
    }
    if (isset($_COOKIE['atok'])) {
        $host = $_SERVER['SERVER_NAME'];
        if($host == 'localhost'){
            $host = '';
        }
        setcookie('atok', null, time()-100, '/', $host);
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

    return base64_url_encode($result);
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
        
        $str = base64_url_decode($str);
        $result = '';
        for($i = 1; $i <= strlen($str); $i++){
            $char = substr($str, $i-1, 1);
            $keychar = substr($key, ($i % strlen($key)) -1, 1);
            $char = chr(ord($char) - ord($keychar));
            $result .= $char;
        }
        
    return $result;
}

function base64_url_encode($input) 
{
    return strtr(base64_encode($input), '+/=', '-_,');
}

function base64_url_decode($input) 
{
    return base64_decode(strtr($input, '-_,', '+/='));
}
