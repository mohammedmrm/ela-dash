<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require("_access.php");
require("dbconnection.php");
access([1,2]);
$id= $_REQUEST['id'];
$success = 0;
$msg="";
if($id > 0){

         $sql = "delete from stores where id = ?";
         $result = setData($con,$sql,[$id]);
         if($result > 0){
            $success = 1;
         }else{
            $msg = "فشل الحذف";
         }

}else{
  $msg = "فشل الحذف";
  $success = 0;
}
echo json_encode(['success'=>$success, 'msg'=>$msg]);
?>