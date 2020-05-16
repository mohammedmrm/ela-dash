<?php
session_start();
header('Content-Type: application/json');
require("_access.php");
access([1]);
require("dbconnection.php");
try{
  $query = "select staff.* from staff where account_type=2";


  $data = getData($con,$query);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
print_r(json_encode(array("success"=>$success,"data"=>$data)));
?>