<?php
session_start();
header('Content-Type: application/json');
require("_access.php");
access([1,2,5]);
require("dbconnection.php");
try{
  if($_SESSION['role'] == 1 ){
   $query = "select * from role";
  }else if($_SESSION['role'] == 5){
   $query = "select * from role where id != 1 and id != 5 and id != 2";
  }else{
    $query = "select * from role where id != 1 and id != 5 and id != 2";
  }
  $data = getData($con,$query);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
print_r(json_encode(array("success"=>$success,"data"=>$data)));
?>