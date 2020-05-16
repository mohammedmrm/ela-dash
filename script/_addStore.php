<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,2,5]);
require_once("dbconnection.php");
require_once("_crpt.php");
require_once("_sendNoti.php");
require_once("../config.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;


$success = 0;
$client    = $_REQUEST['client'];
$name    = $_REQUEST['name'];
$note   = $_REQUEST['note'];



$v->addRuleMessage('unique', ' القيمة المدخلة مستخدمة بالفعل ');

$v->addRule('unique', function($value, $input, $args) {
    $table  = $args[0];
    $column = $args[1];
    $value  = trim($value);
    if(!empty($value)){
    $exists = getData($GLOBALS['con'],"SELECT * FROM clients WHERE phone =".$value);
    }else{
      $exists = 0;
    }
    return ! (bool) count($exists);
});
$v->addRuleMessages([
    'required' => ' الحقل مطلوب',
    'int'      => ' فقط الارقام مسموح بها',
    'regex'    => ' فقط الارقام مسموح بها',
    'min'      => ' قصير جداً',
    'max'      => ' ( {value} ) قيمة كبيرة جداً غير مسموح بها ',
    'email'    => ' البريد الالكتروني غيز صحيح',
]);

$v->validate([
    'name'  => [$name,  'required|min(3)|max(100)'],
    'client'=> [$client,'required|int'],
    'note'  => [$note,  'max(250)'],
]);

if($v->passes()) {
  $sql = 'insert into stores (name,client_id,note) values
                              (?,?,?)';
  $result = setData($con,$sql,[$name,$client,$note]);
  if($result > 0){
    $success = 1;
    $sql = "select token from clients where id = ?";
    $res = setData($con,$sql,[$client]);
    sendNotification([$res[0]['token']],[],'تم اضافه سوق','تم اضافه سوق جديد الى ملفك','../');
  }
}else{
  $error = [
           'name'=> implode($v->errors()->get('name')),
           'client'=>implode($v->errors()->get('client')),
           'note'=>implode($v->errors()->get('note')),
           ];
}
echo json_encode(['success'=>$success, 'error'=>$error]);
?>