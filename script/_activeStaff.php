<?php
session_start();
//error_reporting(0);
header('Content-Type: application/json');
require("_access.php");
access([1,2]);
$id= $_REQUEST['id'];
$success = 0;
$msg="";
require("dbconnection.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;

$v->validate([
    'branch_id'    => [$id,'required|int']
    ]);

if($v->passes()){

         $sql = "update staff set status=1 where id = ?";
         $result = setData($con,$sql,[$id]);
         if($result > 0){
            $success = 1;
         }else{
            $msg = "فشل ";
         }

}else{
  $msg = "فشل ";
  $success = 0;
}
echo json_encode(['success'=>$success, 'msg'=>$msg]);
?>