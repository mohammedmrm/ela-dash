<?php
session_start();
header('Content-Type: application/json');
require("dbconnection.php");
$id = $_REQUEST['id'];
try{
  $query = "select * from staff where id = ?";
  $data = getData($con,$query,[$id]);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
print_r(json_encode(array("success"=>$success,"data"=>$data)));
?>