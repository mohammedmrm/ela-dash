<?php
session_start();
//error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,2,3]);
require_once("dbconnection.php");
require_once("_crpt.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;


$success = 0;
$error = [];
$name    = $_REQUEST['orderStatus_name'];
$note   = $_REQUEST['orderStatus_note'];

$v->addRuleMessages([
    'required' => 'الحقل مطلوب',
    'int'      => 'فقط الارقام مسموع بها',
    'min'      => 'قصير جداً',
    'max'      => 'مسموح ب {value} رمز كحد اعلى '
]);

$v->validate([
    'orderStatus_name'   => [$name,   'required|max(50)|min(3)'],
    'orderStatus_note'   => [$note,   'max(250)']
]);

if($v->passes()) {
  $sql = 'insert into order_status (status,note) values
                             (?,?)';
  $result = setData($con,$sql,[$name,$note]);
  if($result > 0){
    $success = 1;
  }
}else{
  $error = [
           'orderStatus_name_err'=> implode($v->errors()->get('orderStatus_name')),
           'orderStatus_note_err'=>implode($v->errors()->get('orderStatus_note')),
           ];
}
echo json_encode(['success'=>$success, 'error'=>$error]);
?>