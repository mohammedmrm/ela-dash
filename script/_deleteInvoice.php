<?php
session_start();
error_reporting(0);
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
             $sql = "delete from invoice where id = ?";
             $result = setData($con,$sql,[$id]);
             if($result > 0){
                 $success = 1;
                 if($re['0']['orders_status'] == 4){
                   $sql = "update orders set invoice_id = 0  where invoice_id=?";
                   $result = setData($con,$sql,[$id]);
                 }else if($re['0']['orders_status'] == 9){
                   $sql = "update orders set invoice_id2 = 0  where invoice_id2=?";
                   $sql2 = "update orders set invoice_id = 0  where invoice_id=?";
                   $result = setData($con,$sql,[$id]);
                   $result = setData($con,$sql2,[$id]);
                 }else{
                   $sql = "update orders set invoice_id2 = 0,invoice_id2 = 0  where invoice_id=?";
                   $result = setData($con,$sql,[$id]);
                 }
                 unlink('../invoice/'.$re[0]['path']);
             }else{
                $msg = "فشل  حذف كشف";
             }
         }else{
           $msg="لايمكن حذف كشف تم التحاسب عليه";
         }
}else{
  $msg = "فشل الحذف";
  $success = 0;
}
echo json_encode([$result,'success'=>$success, 'msg'=>$msg]);
?>