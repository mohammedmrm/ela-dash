<?php
session_start();
header('Content-Type: application/json');
require("_access.php");
access([1,2]);
$id = $_REQUEST['id'];
if(!empty($id)){
require("dbconnection.php");
try{
  $query = "select name,id,email,phone,branch_id from clients where id=?";
  $data = getData($con,$query,[$id]);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
}
echo json_encode(array("success"=>$success,"data"=>$data));
?>