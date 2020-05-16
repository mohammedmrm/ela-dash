<?php
session_start();
//error_reporting(0);
header('Content-Type: application/json');
require("_access.php");
access([1]);
$id= $_REQUEST['id'];
$success = 0;
$msg="";
require("dbconnection.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;

$v->validate([
    'id'    => [$id,'required|int']
    ]);

if($v->passes()){

         $sql = "delete from clients where id = ?";
         $result = setData($con,$sql,[$id]);
         if($result > 0){
            $success = 1;
         $sql = "delete from client_dev_price where client_id = ?";
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