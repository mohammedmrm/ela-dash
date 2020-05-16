<?php
session_start();
//error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1]);
require_once("dbconnection.php");
require_once("_crpt.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;


$success = 0;
$error = [];
$name    = $_REQUEST['staff_name'];
$phone   = $_REQUEST['staff_phone'];
$password   = $_REQUEST['staff_password'];

$v->addRuleMessage('isPhoneNumber', ' رقم هاتف غير صحيح  ');

$v->addRule('isPhoneNumber', function($value, $input, $args) {
    return   (bool) preg_match("/^[0-9]{10,15}$/",$value);
});
$v->addRuleMessage('unique', 'القيمة المدخلة مستخدمة بالفعل ');

$v->addRule('unique', function($value, $input, $args) {

    $value  = trim($value);
    $exists = getData($GLOBALS['con'],"SELECT * FROM staff WHERE phone  ='".$value."'");
    return ! (bool) count($exists);
});
$v->addRuleMessages([
    'required' => 'الحقل مطلوب',
    'int'      => 'فقط الارقام مسموع بها',
    'regex'      => 'فقط الارقام مسموع بها',
    'min'      => 'قصير جداً',
    'max'      => 'مسموح ب {value} رمز كحد اعلى ',
    'email'      => 'البريد الالكتروني غيز صحيح',
]);

$v->validate([
    'staff_name'    => [$name,    'required|min(4)|max(50)'],
    'staff_phone'   => [$phone,   "required|unique|isPhoneNumber"],
    'staff_password'=> [$password,  'required|min(6)|max(16)'],
]);

if($v->passes()) {
  $id = uniqid();
  $pass = hashPass($password);
  $sql = 'insert into staff (name,phone,password,branch_id,role_id,status,account_type) values
                             (?,?,?,?,?,?,?)';
  $result = setData($con,$sql,[$name,$phone,$pass,1,6,0,2]);
  if($result > 0){
    $success = 1;
  }
}else{
  $error = [
           'staff_name_err'=> implode($v->errors()->get('staff_name')),
           'staff_phone_err'=>implode($v->errors()->get('staff_phone')),
           'staff_password_err'=>implode($v->errors()->get('staff_password')),
           ];
}
echo json_encode(['success'=>$success, 'error'=>$error]);
?>