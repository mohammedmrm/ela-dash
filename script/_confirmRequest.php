<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,2,3]);
$id= $_REQUEST['id'];
$success = 0;
$msg="";
require_once("dbconnection.php");
require_once("_sendNoti.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;

$v->validate([
    'id'    => [$id,'required|int']
    ]);

if($v->passes()){
       $sql = "select receipt.*, token from receipt
               inner join stores on stores.id = receipt.store_id
               inner join clients on clients.id = stores.client_id
               where receipt.id = '".$id."'";
       $cash = getData($con,$sql);
       if(count($cash) <= 0){
         $success = 0;
         $msg = "هناك خطأ بالمعلومات";
       }else if($cash[0]['status'] == 1){
         $msg = "تم تاكيد  مسبقاً";
       }else{
         $sql = "update receipt set status=? where id = ?";
         $update = setData($con,$sql,['1',$id]);

         if($update > 0){
            sendNotification([$cash[0]['token']],'تاكيد الوصولات','تم تاكيد طلب الوصولات الخاص بك','../');
            $success = 1;
            $msg = "تم تاكيد ";
         }else{
            $msg = "فشل";
         }

       }
}else{
  $msg = "فشل";
  $success = 0;
}
echo json_encode(['success'=>$success, 'msg'=>$msg]);
?>