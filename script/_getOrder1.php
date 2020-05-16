<?php
session_start();
header('Content-Type: application/json');
require("_access.php");
access([1,2,3,5]);
require("dbconnection.php");
require("../config.php");
$id = $_REQUEST['order_no'];
try{
  if($_SESSION['role'] == 1 || $_SESSION['role'] == 5){
  $query = "select orders.*,
            clients.name as client_name,clients.phone as client_phone,
            cites.name as city,towns.name as town,branches.name as branch_name
            from orders left join
            clients on clients.id = orders.client_id
            left join cites on  cites.id = orders.to_city
            left join towns on  towns.id = orders.to_town
            left join branches on  branches.id = orders.to_branch
            where order_no = ?";
    }else{
    $query = "select orders.*,
            clients.name as client_name,clients.phone as client_phone,
            cites.name as city,towns.name as town,branches.name as branch_name
            from orders left join
            clients on clients.id = orders.client_id
            left join cites on  cites.id = orders.to_city
            left join towns on  towns.id = orders.to_town
            left join branches on  branches.id = orders.to_branch
            where order_no link ? and from_branch = '".$_SESSION['user_details']['branch_id']."'";

    }
  $data = getData($con,$query,[$id]);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
echo json_encode(array("success"=>$success,"data"=>$data));
?>