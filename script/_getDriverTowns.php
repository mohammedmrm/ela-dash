<?php
session_start();
header('Content-Type: application/json');
error_reporting(0);
require("dbconnection.php");
require("../config.php");
$id= $_REQUEST['id'];
$success=0;
$i=0;
try{
  $query = "select driver_towns.*,towns.name as town_name, cites.name as city_name
            from driver_towns
            left join towns on towns.id = driver_towns.town_id
            left join cites on cites.id = towns.city_id
            where driver_id =?";
  $data = getData($con,$query,[$id]);

  $sql = "select * from staff where id=?";
  $res = getData($con,$sql,[$id]);
  $res =$res[0];
  $success = 1;
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
echo json_encode(array($id,"success"=>$success,"data"=>$data,'driver_info'=>$res));
?>