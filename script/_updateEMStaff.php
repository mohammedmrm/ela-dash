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
$id    = $_REQUEST['editstaffid'];
$name    = $_REQUEST['e_staff_name'];
$phone   = $_REQUEST['e_staff_phone'];
$password   = $_REQUEST['e_staff_password'];


$v->addRuleMessage('isPhoneNumber', ' رقم هاتف غير صحيح  ');

$v->addRule('isPhoneNumber', function($value, $input, $args) {
    return   (bool) preg_match("/^[0-9]{10,15}$/",$value);
});
$v->addRuleMessage('unique', 'القيمة المدخلة مستخدمة بالفعل ');

$v->addRule('unique', function($value, $input, $args) {

    $value  = trim($value);
    $exists = getData($GLOBALS['con'],"SELECT * FROM staff WHERE phone ='".$value."' and id != ".$GLOBALS['id']);
    return ! (bool) count($exists);
});
$v->addRuleMessages([
    'required' => 'الحقل مطلوب',
    'int'      => 'فقط الارقام مسموع بها',
    'regex'      => 'فقط الارقام مسموع بها',
    'min'      => 'قصير جداً',
    'max'      => 'مسموح ب 20 رمز كحد اعلى ',
    'email'      => 'البريد الالكتروني غيز صحيح',
]);

$v->validate([
    'id'            => [$id,    'required|int'],
    'staff_name'    => [$name,    'required|min(4)|max(20)'],
    'staff_phone'   => [$phone,   "required|unique|isPhoneNumber"],
    'staff_password'=> [$password,"min(6)|max(20)"],
]);
$valid_file_extensions = array(".jpg", ".jpeg", ".png");
if(isset($_FILES['e_staff_id']['tmp_name']) && $_FILES['e_staff_id']['size'] != 0) {
   if($_FILES['e_staff_id']['size'] >= "2048000"){
    $img_err =  "يجب تحميل صورة صالحة بحجم اقل من 2M";
   }else{
     $ext = strrchr($_FILES['e_staff_id']["name"], ".");
     if(in_array($ext, $valid_file_extensions) && @getimagesize($_FILES["e_staff_id"]["tmp_name"]) !== false){
       $img_err =  "";
     }else{
      $img_err =  "صورة غير صالحة";
     }
   }
} else {
   $img_err =  "";
}
if($v->passes() && $img_err =="") {
    $sql = 'update staff set name = ?, phone=? where id=?';
    $result = setData($con,$sql,[$name,$phone,$id]);

  if($result > 0){
    $success = 1;
  }
  if(!empty($password)){
     $password = hashPass($password);
     $sql = 'update staff set password=? where id=?';
     $result = setData($con,$sql,[$password,$id]);
     if($result > 0){
       $success = 1;
     }
  }
}else{
  $error = [
           'staff_id_err'   => implode($v->errors()->get('id')),
           'staff_name_err' => implode($v->errors()->get('staff_name')),
           'staff_phone_err'=>implode($v->errors()->get('staff_phone')),
           'staff_password_err'=>implode($v->errors()->get('staff_password')),
           ];
}
echo json_encode(['success'=>$success, 'error'=>$error]);
?>