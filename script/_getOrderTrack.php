<?php
session_start();
header('Content-Type: application/json');
require("_access.php");
access([1,2,3]);
require("dbconnection.php");
$id= $_REQUEST['id'];
$success=0;
try{
  $query = "select tracking.*,order_status.status as status,staff.name as staff_name,
  DATE_FORMAT(date,'%Y-%m-%d') as date,DATE_FORMAT(date,'%H:%i') as hour
  from tracking
  left join order_status on tracking.order_status_id = order_status.id
  left join staff on tracking.staff_id = staff.id
  where order_id=".$id." order by date";
  $data = getData($con,$query);
  if(count($data) > 0){
  $success="1";
  }
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
echo json_encode(array("success"=>$success,"data"=>$data));
?>