<?php
session_start();
//error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,2,3,5,6]);
require_once("dbconnection.php");

$success = 0;
$id        = $_SESSION['userid'];
$ids    = $_REQUEST['ids'];
$msg ="";
foreach($ids as $k=>$val){
   if(!is_int($val) && $val <= 0){
     $msg = "شحنه غير صالحه ". $val;
     $success = 0;
     break;
   }
}

if($msg=="") {
   foreach($ids as $k=>$val)
   $sql = 'update orders set order_status_id =?,driver_id = 0 where id=?';
   $result = setData($con,$sql,['10',$val]);
   if($result > 0){
    $success = 1;
    $sql = 'insert into tracking (order_status_id,order_id) values(?,?)';
    $result = setData($con,$sql,['10',$val]);
   }


}
echo json_encode([$val,'success'=>$success, 'msg'=>$msg]);
?>