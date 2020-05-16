<?php
session_start();
//error_reporting(0);
header('Content-Type: application/json');
require("_access.php");
access([1,2,3,5]);
$id= $_REQUEST['id'];
$success = 0;
$msg="";
require("dbconnection.php");
use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;

$v->validate([
    'order_id'    => [$id,'required|int']
    ]);

if($v->passes()){
         if($_SESSION['role'] == 1 || $_SESSION['role'] == 5){
            $sql = "delete from orders where id = ?";
         }else{
            $sql = "delete from orders where id = ? and from_branch = '".$_SESSION['user_details']['branch_id']."'";
         }
         $result = setData($con,$sql,[$id]);
         if($result > 0){
            $success = 1;
            $sql = "delete from tracking where order_id = ?";
            $result = setData($con,$sql,[$id]);
         }else{
            $msg = "فشل الحذف";
         }
}else{
  $msg = "فشل الحذف";
  $success = 0;
}
echo json_encode(['success'=>$success, 'msg'=>$msg]);
?>