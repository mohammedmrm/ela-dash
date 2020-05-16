<?php
session_start();
header('Content-Type: application/json');
require("_access.php");
access([1,2,3]);
require("dbconnection.php");
try{
  $query = "select * from order_status";
  $data = getData($con,$query);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
print_r(json_encode(array("success"=>$success,"data"=>$data)));
?>