<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require("_access.php");
access([1,2]);
require("dbconnection.php");
require("_crpt.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;


$success = 0;
$error = [];
$id    = $_REQUEST['e_orderStatus_id'];
$note  = $_REQUEST['e_orderStatus_note'];
$name  = $_REQUEST['e_orderStatus_name'];
if(empty($note)){
  $note = "";
}
$v->addRuleMessages([
    'required' => 'الحقل مطلوب',
    'int'      => 'فقط الارقام مسموع بها',
    'regex'      => 'فقط الارقام مسموع بها',
    'min'      => 'قصير جداً',
    'max'      => 'مدخل  غير صالح ',
    'email'      => 'البريد الالكتروني غيز صحيح',
]);

$v->validate([
    'orderStatus_name' => [$name,'required|min(2)|max(20)'],
    'orderStatus_note' => [$note,'max(200)'],
    'orderStatus_id'   => [$id,  'required|int'],
]);

if($v->passes()) {
  $sql = 'update order_status set status = ?, note=? where id=?';
  $result = setData($con,$sql,[$name,$note,$id]);
  if($result > 0){
    $success = 1;
  }
}else{
  $error = [
           'orderStatus_id_err'=>  implode($v->errors()->get('orderStatus_id')),
           'orderStatus_name_err'=>implode($v->errors()->get('orderStatus_name')),
           'orderStatus_note_err'=>implode($v->errors()->get('orderStatus_note'))
           ];
}
echo json_encode(['success'=>$success, 'error'=>$error,[$name,$note,$id]]);
?>