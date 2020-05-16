<?php
session_start();
header('Content-Type: application/json');
require("_access.php");
access([1,2,3,4,5,6]);
require("dbconnection.php");
$city = $_REQUEST['city'];
if(empty($city)){
  $city =1;
}
try{
  $query = "select * from towns where city_id=".$city;
  $data = getData($con,$query);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex,'q'=>$query];
   $success="0";
}
print_r(json_encode(array("success"=>$success,"data"=>$data,'q'=>$query,'P'=>$city)));
?>