<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require("_access.php");
access([1,2,3,4,5]);
require("dbconnection.php");
$user_id = $_SESSION['userid'];
$id = $_REQUEST['id'];

$sql = 'update notification set admin_seen = 1 where for_client = 0 and id = ?';
$result = setData($con,$sql,[$id]);
$success = 1;
echo json_encode([$result,'success'=>$success]);
?>