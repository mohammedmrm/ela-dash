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
         $sql ="select * from company_receipt where id=?";
         $re=getData($con,$sql,[$id]);
         if($re['0']['print_times'] >= 1){
             $sql = "delete from company_receipt where id = ?";
             $result = setData($con,$sql,[$id]);
             if($result > 0){
                 $success = 1;
                 unlink('../companyReceipt/'.$re[0]['path']);
             }else{
                $msg = "فشل  حذف كشف";
             }
         }else{
           $msg="لايمكن حذف الملف لم يطبع";
         }
}else{
  $msg = "فشل الحذف";
  $success = 0;
}
echo json_encode([$result,'success'=>$success, 'msg'=>$msg]);
?>