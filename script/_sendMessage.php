<?php
session_start();
//error_reporting(0);
header('Content-Type: application/json');
require("_access.php");
access([1,2,3,4,5]);
require("_sendNoti.php");
require("dbconnection.php");
require("_crpt.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;


$success = 0;
$error = [];
$message  = $_REQUEST['message'];
$order_id = $_REQUEST['order_id'];


$v->addRuleMessages([
    'required' => 'الحقل مطلوب',
    'int'      => 'فقط الارقام مسموع بها',
    'min'      => 'قصير جداً',
    'max'      => 'مسموح ب {value} رمز كحد اعلى ',
]);

$v->validate([
    'message'    => [$message,    'required|min(1)|max(500)'],
    'order_id'   => [$order_id,    'required|int'],
]);

if($v->passes()) {
  $sql = 'insert into message (message,order_id,from_id) values
                             (?,?,?)';
  $result = setData($con,$sql,[$message,$order_id,$_SESSION['userid']]);
  if($result > 0){
    $success = 1;
    $sql = "select staff.token as s_token, clients.token as c_token from orders inner join staff
            on
            staff.id = orders.manager_id
            or
            staff.id = orders.driver_id
            inner join clients on clients.id = orders.client_id
            where orders.id = ?";
    $res =getData($con,$sql,[$order_id]);
    sendNotification([$res[0]['s_token'],$res[1]['s_token'],$res[0]['c_token']],[$order_id],'رساله جديد - '.$order_id,$message,"../orderDetails.php?o=".$order_id);

  }
}else{
  $error = [
           'message'=> implode($v->errors()->get('message')),
           'order_id'=>implode($v->errors()->get('order_id')),
           ];
}
echo json_encode(['success'=>$success,'error'=>$error]);
?>