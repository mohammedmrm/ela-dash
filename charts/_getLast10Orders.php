<?php
session_start();
//error_reporting(0);
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
  $sql = 'select  orders.* , cites.name as city_name,towns.name as town_name from orders
           left join cites on cites.id = orders.to_city
           left join towns on towns.id = orders.to_town
         where date between "'.$start.'" and "'.$end.'" limit 25';

}else{
   $sql = 'select orders.* , cites.name as city_name,towns.name as town_name from orders
           left join cites on cites.id = orders.to_city
           left join towns on towns.id = orders.to_town
           where  from_branch="'.$_SESSION['user_details']['branch_id'].'" and date between "'.$start.'" and "'.$end.'" limit 25';
}

$data =  getData($con,$sql);
echo json_encode(['data'=>$data]);
?>
