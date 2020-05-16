<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require("../script/_access.php");
access([1,2,5,3]);
require("../script/dbconnection.php");
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
if($_SESSION['user_details']['role_id'] == 1){
/*  $sql = 'select count(*) as counts,order_status,from_branch,branches.name
           from orders
           INNER join branches on branches.id = orders.from_branch
           right join order_status on order_status.id = orders.order_status
           where date between "'.$start.'" and "'.$end.'"
           GROUP by  from_branch, order_status';*/
$sql = "SELECT
          SUM(IF (order_status_id = '1',1,0)) as  regiserd,
          SUM(IF (order_status_id = '2',1,0)) as  redy,
          SUM(IF (order_status_id = '3',1,0)) as  ontheway,
          SUM(IF (order_status_id = '4',1,0)) as  recieved,
          SUM(IF (order_status_id = '5',1,0)) as  chan,
          SUM(IF (order_status_id = '6',1,0)) as  returnd,
          SUM(IF (order_status_id = '7',1,0)) as  posponded,
          branches.name as branch_name
          FROM orders inner join branches on branches.id = orders.from_branch
          where date between '".$start."' and '".$end."'
          GROUP BY from_branch";
}else{
$sql = "SELECT
          SUM(IF (order_status = '1',1,0)) as  regiserd,
          SUM(IF (order_status = '2',1,0)) as  redy,
          SUM(IF (order_status = '3',1,0)) as  ontheway,
          SUM(IF (order_status = '4',1,0)) as  recieved,
          SUM(IF (order_status = '5',1,0)) as  chan,
          SUM(IF (order_status = '6',1,0)) as  returnd,
          SUM(IF (order_status = '7',1,0)) as  posponded,
          branches.name as branch_name
          FROM orders inner join branches on branches.id = orders.from_branch
          where (date between '".$start."' and '".$end."') and from_branch = '".$_SESSION['user_details']['branch_id']."'
          GROUP BY from_branch";
}
$result = getData($con,$sql);
echo json_encode(['data'=>$result]);
?>