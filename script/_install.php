<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require("dbconnection.php");
require("_crpt.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;


$success = 0;
$error = [];
$name    = $_REQUEST['name'];
$email   = $_REQUEST['email'];
$phone   = $_REQUEST['phone'];
$password= $_REQUEST['password'];
$confirm = $_REQUEST['confirm'];
$branch  = 1;
$role    = 1;
$img = $_FILES['staff_id'];
$valid_file_extensions = array(".jpg", ".jpeg", ".png");
if(isset($_FILES['staff_id']['tmp_name'])) {
   if($_FILES['staff_id']['size'] == 0 || $_FILES['staff_id']['size'] >= "2048000"){
    $img_err =  "يجب تحميل صورة صالحة بحجم اقل من 2M";
   }else{
     $ext = strrchr($_FILES['staff_id']["name"], ".");
     if(in_array($ext, $valid_file_extensions) && @getimagesize($_FILES["staff_id"]["tmp_name"]) !== false){
       $img_err =  "";
     }else{
      $img_err =  "صورة غير صالحة";
     }
   }
} else {
   $img_err =  "يجب رفع صورة للهوية";
}

$v->addRuleMessage('isPhoneNumber', ' رقم هاتف غير صحيح  ');

$v->addRule('isPhoneNumber', function($value, $input, $args) {
    return   (bool) preg_match("/^[0-9]{10,15}$/",$value);
});
$v->addRuleMessages([
    'required' => 'الحقل مطلوب',
    'int'      => 'فقط الارقام مسموع بها',
    'regex'      => 'فقط الارقام مسموع بها',
    'min'      => 'قصير جداً',
    'max'      => 'مسموح ب {value} رمز كحد اعلى ',
    'email'      => 'البريد الالكتروني غيز صحيح',
    'matches'      => 'كلمة المرور غير متطابقة',
]);

$v->validate([
    'name'    => [$name,    'required|min(4)|max(50)'],
    'email'   => [$email,   'email'],
    'phone'   => [$phone,   "required|isPhoneNumber"],
    'branch'  => [$branch,"required|int"],
    'password'=> [$password,  'required|min(6)|max(16)'],
    'confirm' => [$confirm,  'required|matches(password)']
]);

if($v->passes() && $img_err == "") {
  $id = uniqid();
  $pass = hashPass($password);
  mkdir("../img/staff/".$branch."/", 0700);
  $destination = "../img/staff/".$branch."/".$id.".jpg";
  $imgPath = $branch."/".$id.".jpg";
  move_uploaded_file($_FILES["id"]["tmp_name"], $destination);
  $sql = 'insert into staff (name,phone,email,branch_id,password,id_copy,role_id) values
                             (?,?,?,?,?,?,?)';
  $result = setData($con,$sql,[$name,$phone,$email,$branch,$pass,$imgPath,$role]);
  if($result > 0){
    $success = 1;
  }
}else{
  $error = [
           'name_err'=> implode($v->errors()->get('name')),
           'email_err'=>implode($v->errors()->get('email')),
           'phone_err'=>implode($v->errors()->get('phone')),
           'password_err'=>implode($v->errors()->get('password')),
           'confirm_err'=>implode($v->errors()->get('confirm')),
           'branch_err'=>implode($v->errors()->get('branch')),
           'id_err'=>$img_err
           ];
}
echo json_encode(['success'=>$success, 'error'=>$error]);
?>