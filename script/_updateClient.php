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
$id        = $_REQUEST['editclientid'];
$name      = $_REQUEST['e_client_name'];
$email     = $_REQUEST['e_client_email'];
$phone     = $_REQUEST['e_client_phone'];
$branch    = $_REQUEST['e_client_branch'];
$password  = $_REQUEST['e_client_password'];


$v->addRuleMessage('isPhoneNumber', ' رقم هاتف غير صحيح  ');

$v->addRule('isPhoneNumber', function($value, $input, $args) {
    return   (bool) preg_match("/^[0-9]{10,15}$/",$value);
});
$v->addRuleMessage('unique', 'القيمة المدخلة مستخدمة بالفعل ');

$v->addRule('unique', function($value, $input, $args) {
    $exists = getData($GLOBALS['con'],"SELECT * FROM clients WHERE phone ='".$value."' and id !='".$GLOBALS['id']."'");
    return  ! (bool) count($exists);
});
$v->addRuleMessages([
    'required' => 'الحقل مطلوب',
    'int'      => 'فقط الارقام مسموع بها',
    'regex'      => 'فقط الارقام مسموح بها',
    'min'      => 'قصير جداً',
    'max'      => 'مسموح ب {value} رمز كحد اعلى ',
    'email'      => 'البريد الالكتروني غيز صحيح',
]);

$v->validate([
    'id'             => [$id,      'required|int'],
    'client_name'    => [$name,    'required|min(4)|max(20)'],
    'client_email'   => [$email,   'email'],
    'client_phone'   => [$phone,   "required|unique|isPhoneNumber"],
    'client_password'=> [$password,"min(6)|max(18)"],
    'client_branch'  => [$branch,  'required|int']
]);

if($v->passes()) {
   if(empty($password)){
   $sql = 'update clients set name = ?, email=?,phone=?,branch_id=? where id=?';
   $result = setData($con,$sql,[$name,$email,$phone,$branch,$id]);
   }else{
   $password= hashPass($password);
   $sql = 'update clients set password=?,name = ?, email=?,phone=?,branch_id=? where id=?';
   $result = setData($con,$sql,[$password,$name,$email,$phone,$branch,$id]);
   }
  if($result > 0){
    $success = 1;
  }
}else{
  $error = [
           'client_id_err'=> implode($v->errors()->get('id')),
           'client_name_err'=> implode($v->errors()->get('client_name')),
           'client_email_err'=>implode($v->errors()->get('client_email')),
           'client_phone_err'=>implode($v->errors()->get('client_phone')),
           'client_branch_err'=>implode($v->errors()->get('client_branch')),
           'client_password_err'=>implode($v->errors()->get('client_password'))
           ];
}
echo json_encode(['success'=>$success, 'error'=>$error,$_POST]);
?>