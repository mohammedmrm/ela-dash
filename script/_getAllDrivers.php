<?php
session_start();
header('Content-Type: application/json');
error_reporting(0);
require("_access.php");
access([1,2,3]);
require("dbconnection.php");
$branch = $_REQUEST['branch'];
try{
  if($branch > 0){
  $query = "select * from staff where role_id=4 and branch_id=?";
  $data = getData($con,$query,[$branch]);
  }else{
  $query = "select * from staff where role_id=4";
  $data = getData($con,$query);
  }
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
print_r(json_encode(array("success"=>$success,"data"=>$data)));
?>