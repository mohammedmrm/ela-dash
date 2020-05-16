<?php
session_start();
header('Content-Type: application/json');
require("_access.php");
access([1,2,3]);
require("dbconnection.php");
$id = $_REQUEST['id'];
if(empty($city)){
  $city =1;
}
try{
  $query = "select * from towns where id=".$id;
  $data = getData($con,$query);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex,'q'=>$query];
   $success="0";
}
print_r(json_encode(array("success"=>$success,"data"=>$data,'q'=>$query,'P'=>$city)));
?>              