<?php
header('Content-Type: application/json');
require("../script/dbconnection.php");
session_start();
//error_reporting(0);
require("../script/_access.php");
access([1,2,4,5,3,6]);
$start = trim($_REQUEST['start']);
$end = trim($_REQUEST['end']);
if(empty($end)) {
  $end = date('Y-m-d h:i:s', strtotime($end. ' + 1 day'));
}else{
   $end =date('Y-m-d', strtotime($end. ' + 1 day'));
   $end .=" 00:00:00";
}
if(empty($start)) {
  $start = date('Y-m-d h:i:s',strtotime($start. ' - 7 day'));
}else{
   $start .=" 00:00:00";
}

if($_SESSION['role'] != 1){
  $s = "select sum(new_price) as total, count(*) as orders from orders where from_branch=? and
        date between '".$start."' and '".$end."' and confirm=1";
  $r= getData($con,$s,[$_SESSION['user_details']['branch_id']]);
}else{
  $s = "select sum(new_price) as total, count(*) as orders from orders where
        date between '".$start."' and '".$end."' and confirm = 1";
  $r= getData($con,$s);
}
echo json_encode(['data'=>$r]);
?>