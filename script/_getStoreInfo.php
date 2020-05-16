<?php
session_start();
header('Content-Type: application/json');
error_reporting(0);
require("_access.php");
access([1,2,3,4,5]);
$id = $_REQUEST['store'];
require("dbconnection.php");
try{
  $query = "select stores.*,
    count(orders.id) as total, date_format(stores.date,'%Y-%m-%d') as date,
    sum(if(order_status_id = 4 ,1,0)) as recived,
    sum(if(
    order_status_id = 6 or
    order_status_id = 9 or
    order_status_id = 10 or  
    order_status_id = 11

     ,1,0)) as returned,
    sum(if(
    order_status_id <> 4 and
    order_status_id <> 6 and
    order_status_id <> 9 and
    order_status_id <> 10 and
    order_status_id <> 11

    ,1,0)) as others,
    clients.name as client_name , clients.phone as client_phone
   from stores
   inner join clients on clients.id = stores.client_id
   inner join orders on orders.store_id = stores.id
   where stores.id=? group by orders.store_id";
  $data = getData($con,$query,[$id]);

  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
echo (json_encode(array("success"=>$success,"data"=>$data)));
?>