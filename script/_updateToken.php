<?php
session_start();
header('Content-Type: application/json');
require("_access.php");
access([1,2,3,4,5,6]);
require("dbconnection.php");
$token = $_REQUEST['token'];
try{
  if(!empty($token)){
    $query = "update staff set token= ? where id = ?";
    $data = getData($con,$query,[$token,$_SESSION['userid']]);
    $success="1";
  }
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
print_r(json_encode(array("success"=>$success,"data"=>$data)));
?>