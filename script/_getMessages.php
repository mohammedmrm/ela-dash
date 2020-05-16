<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require("_access.php");
access([1,2,3,4,5]);
require("dbconnection.php");
require("_crpt.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;


$success = 0;
$error = [];
$order_id = $_REQUEST['order_id'];
$last = $_REQUEST['last'];
$result = "";
if (empty($last)){
 $last = 0;
}
$v->addRuleMessages([
    'required' => 'الحقل مطلوب',
    'int'      => 'فقط الارقام مسموع بها',
]);

$v->validate([
    'order_id'=> [$order_id,'required|int'],
]);

if($v->passes()) {

  $sql = 'select message.*, date_format(message.date," %y %b %d %h:%i %p") as date, clients.name as client_name,
          staff.name as staff_name,
          role.name as role_name
          from message
          left join clients on from_id = clients.id
          left join staff on from_id = staff.id
          left join role on role.id = staff.role_id
          where order_id = ? and message.id > ? order by message.date
          ';
  $result = getData($con,$sql,[$order_id,$last]);
  if(count($result) > 0){
    $success = 1;
  }
}else{
  $error = [
           'order_id'=>implode($v->errors()->get('order_id')),
           ];
}
echo json_encode(['last'=>$last,'success'=>$success,"data"=>$result,'error'=>$error]);
?>