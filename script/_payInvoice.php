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
         $sql ="select * from invoice where id=?";
         $re=getData($con,$sql,[$id]);
         if($re['0']['invoice_status'] != 1){
             $sql = "update invoice set invoice_status = 1 where id = ?";
             $result = setData($con,$sql,[$id]);
             if($result > 0){
                 $success = 1;
                 $sql = "update orders set money_status = 1,order_status_id = 12 where invoice_id=?";
                 $result = setData($con,$sql,[$id]);
             }else{
                $msg = "مدفوعه مسبقاً";
             }
         }else{
           $msg="لايمكن دفع فاتوره مدفوعه";
         }
}else{
  $msg = "فشل ";
  $success = 0;
}
echo json_encode(['success'=>$success, 'msg'=>$msg]);
?>