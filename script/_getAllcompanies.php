<?php
session_start();
header('Content-Type: application/json');
error_reporting(0);
require("_access.php");
access([1]);
require("dbconnection.php");
$branch = $_REQUEST['branch'];
try{
  $query = "select companies.* from companies";

  $data = getData($con,$query);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
print_r(json_encode(array("success"=>$success,"data"=>$data)));
?>