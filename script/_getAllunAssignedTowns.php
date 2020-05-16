<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require("_access.php");
access([1,2,3]);
require("dbconnection.php");
$query = "select
           towns.name as town,cites.name as city, towns.id as id,
           towns.center as center
           from towns
           inner join cites on cites.id = towns.city_id
           where towns.id NOT in (SELECT town_id from driver_towns) ";

try{

  $data = getData($con,$query);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex,'q'=>$query];
   $success="0";
}
print_r(json_encode(array("success"=>$success,"data"=>$data,'P'=>$city)));
?>