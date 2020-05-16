<?php
session_start();
header('Content-Type: application/json');
error_reporting(0);
require("_access.php");
access([1,2,3]);
require("dbconnection.php");
$branch = $_REQUEST['branch'];
try{
  if($_SESSION['user_details']['role_id'] == 1){
  $query = "select clients.*,branches.name as branch from clients
  inner join branches on branches.id = clients.branch_id";
  }else{
  $query = "select clients.*,branches.name as branch from clients
  inner join branches on branches.id = clients.branch_id where branch_id = ?";
  }
  $data = getData($con,$query,[$_SESSION['user_details']['branch_id']]);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
print_r(json_encode(array("success"=>$success,"data"=>$data)));
?>