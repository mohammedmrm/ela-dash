<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require("_access.php");
access([1,2,3]);
require("dbconnection.php");
$store = $_REQUEST['store'];
$status = $_REQUEST['status'];
try{
  $query = "select receipt.*,clients.name as client_name , stores.name as store_name from receipt
  inner join stores on stores.id = receipt.store_id
  inner join clients on stores.client_id = clients.id";
  $where = "where";
  $filter = "";
  if($store >= 1){
   $filter .= " and receipt.store_id =".$store;
  }

  if($status == 1){
   $filter .= " and receipt.status =".$status;
  }else if($status == 2){
    $filter .= " and receipt.status =0";
  }
  if($filter != ""){
    $filter = preg_replace('/^ and/', '', $filter);
    $filter = $where." ".$filter;
    $query .= " ".$filter;
  }

  $data = getData($con,$query);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
echo json_encode(["success"=>$success,"data"=>$data]);
?>