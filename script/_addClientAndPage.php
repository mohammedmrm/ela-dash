<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require("_access.php");
access([1,2,5]);
require("dbconnection.php");
require("_crpt.php");
require("../config.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;


$success = 0;
$name    = $_REQUEST['client_name'];
$email   = $_REQUEST['client_email'];
$password= $_REQUEST['client_password'];
$phone   = $_REQUEST['client_phone'];
$branch  = $_REQUEST['client_branch'];
$dev_b  = $_REQUEST['client_dev_price_b'];
$dev_o  = $_REQUEST['client_dev_price_o'];
$dev_e  = $_REQUEST['client_dev_price_e'];
$city_e  = $_REQUEST['client_dev_city_e'];
$page  = $_REQUEST['page'];


$v->addRuleMessage('isPhoneNumber', ' رقم هاتف غير صحيح ');

$v->addRule('isPhoneNumber', function($value, $input, $args) {
    return   (bool) preg_match("/^[0-9]{10,15}$/",$value);
});
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
    'client_name'    => [$name,    'required|min(3)|max(100)'],
    'client_email'   => [$email,   'email'],
    'client_password'=> [$password,'required|min(6)|max(16)'],
    'client_phone'   => [$phone,   "required|isPhoneNumber|unique(clients,phone)"],
    'client_branch'  => [$branch,  'required|int|max(2)'],
    'page'  => [$page,  'required|min(3)|max(100)'],
    'client_dev_price_b'=> [$dev_b,  'int|max(5)'],
    'client_dev_price_o'=> [$dev_o ,  'int|max(5)'],
]);

if($v->passes()) {
  $password = hashPass($password);
  $sql = 'insert into clients (name,phone,email,password,branch_id) values
                              (?,?,?,?,?)';
  $result = setData($con,$sql,[$name,$phone,$email,$password,$branch]);
  if($result > 0){
    $success = 1;
    $sql = "select * from clients where phone=? and branch_id=?";
    $result2 = getData($con,$sql,[$phone,$branch]);

    $sql = "insert into stores (name,client_id) values(?,?)";
    $result = setData($con,$sql,[$page,$result2[0]['id']]);
  }
}else{
  $error = [
           'client_name_err'=> implode($v->errors()->get('client_name')),
           'client_email_err'=>implode($v->errors()->get('client_email')),
           'client_password_err'=>implode($v->errors()->get('client_password')),
           'client_phone_err'=>implode($v->errors()->get('client_phone')),
           'client_branch_err'=>implode($v->errors()->get('client_branch')),
           'page_err'=>implode($v->errors()->get('page')),
           ];
}
echo json_encode(['success'=>$success, 'error'=>$error]);
?>