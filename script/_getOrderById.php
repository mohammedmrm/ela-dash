<?php
session_start();
header('Content-Type: application/json');
require("_access.php");
access([1,2,3,5]);
require("dbconnection.php");
require("../config.php");
$id = $_REQUEST['id'];
$success="0";
try{
  $query = "select orders.*,
            clients.name as client_name,clients.phone as client_phone,
            cites.name as city,towns.name as town,branches.name as branch_name
            from orders left join
            clients on clients.id = orders.client_id
            left join cites on  cites.id = orders.to_city
            left join towns on  towns.id = orders.to_town
            left join branches on  branches.id = orders.to_branch
            where orders.id = ? and
            (
              order_status_id = 1 or
              order_status_id = 2 or
              order_status_id = 3 or
              order_status_id = 5 or
              order_status_id = 6 or
              order_status_id = 7 or
              order_status_id = 8 or
              order_status_id = 9
            )";

  $data = getData($con,$query,[$id]);
  if(count($data) == 1){
      $success="1";
  }

} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
echo json_encode(array("success"=>$success,"data"=>$data));
?>