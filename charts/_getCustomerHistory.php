<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require("../script/_access.php");
access([1,2,4,5,3,6]);
$phone = str_replace('-','',$_REQUEST['phone']);;
$success = 0;
require("../script/dbconnection.php");
$sql = "SELECT
          max(note) as note,
          SUM(IF (order_status_id = '4',1,0)) as  recieved,
          SUM(IF (order_status_id = '6' or order_status_id = '9' ,1,0)) as  returnd
          FROM orders
          where customer_phone=?
          ";

$result = getData($con,$sql,[$phone]);
if(count($result) == 1){
  $success = 1;
}
echo json_encode(['data'=>$result,'success'=>$success]);
?>