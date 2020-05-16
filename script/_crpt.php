<?php
function encry($string,$key){
      $key = md5($key);
      $iv = substr(sha1($key),4,32);
      $string = rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $string, MCRYPT_MODE_CBC,$iv)));
  return $string;
}
function decry($string,$key){
      $key = md5($key);
      $iv = substr(sha1($key),4,32);
      $string = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($string), MCRYPT_MODE_CBC,$iv));
  return $string;
}


function hashPass ($input, $rounds = 7)
  {
    $salt = "";
    $salt_chars = array_merge(range('A','Z'), range('a','z'), range(0,9));
    for($i=0; $i < 22; $i++) {
      $salt .= $salt_chars[array_rand($salt_chars)];
    }
    return crypt($input, sprintf('$2a$%02d$', $rounds) . $salt);
}
//------ genrate random hash ---------------
function accessKey( $length = 124 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $random = substr(str_shuffle($chars),0,$length);
    return $random;
}
?>