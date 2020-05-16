<?php
session_start();
header('Content-Type: application/json');
require("_access.php");
access([1,2,3,5,6]);
require("dbconnection.php");
require("../config.php");
$id = $_REQUEST['id'];
$success=0;
try{

    $query = "select orders.*,
            clients.name as client_name,clients.phone as client_phone,
            cites.name as city,towns.name as town,branches.name as branch_name
            from orders left join
            clients on clients.id = orders.client_id
            left join cites on  cites.id = orders.to_city
            left join towns on  towns.id = orders.to_town
            left join branches on  branches.id = orders.to_branch
            where orders.id=? ";
  $data = getData($con,$query,[$id]);
  if(count($data) > 0){
   $success=1;
  }

} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
echo json_encode(array($id,"success"=>$success,"data"=>$data));
?>