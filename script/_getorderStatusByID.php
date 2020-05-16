<?php
session_start();
header('Content-Type: application/json');
require("_access.php");
access([1,2,3]);
require("dbconnection.php");
$id = $_REQUEST['id'];

try{
  $query = "select * from order_status where id=".$id;
  $data = getData($con,$query);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex,'q'=>$query];
   $success="0";
}
echo json_encode(array("success"=>$success,"data"=>$data));
?>