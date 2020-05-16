<?php
if(!isset($_SESSION)){
session_start();
}
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
     $link = "https";
}else{
    $link = "http";
}
// Here append the common URL characters.
$link .= "://";

// Append the host(domain name, ip) to the URL.
$link .= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL
$link .= $_SERVER['REQUEST_URI'];

function access($access_roles = []){
  if(!in_array($_SESSION['user_details']['role_id'],$access_roles) || !isset($_SESSION['userid'])){
    header("location: login.php?redirect=".$GLOBALS['link']);
    die("<h1>لاتمتلك صلاحيات الوصول لهذه الصفحة  (<a href='login.php'>سجل الدخول</a>)</h1>");
  }
}
?>