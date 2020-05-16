<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,2]);
require_once("dbconnection.php");
require_once("_crpt.php");
require_once("_sendNoti.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;


$success = 0;
$error = [];
$name    = $_REQUEST['staff_name'];
$email   = $_REQUEST['staff_email'];
$phone   = $_REQUEST['staff_phone'];
$password   = $_REQUEST['staff_password'];
$branch   = $_REQUEST['staff_branch'];
$role   = $_REQUEST['staff_role'];
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
    'staff_email'   => [$email,   'email'],
    'staff_phone'   => [$phone,   "required|unique|isPhoneNumber"],
    'staff_branch'  => [$branch,"required|int"],
    'staff_password'=> [$password,  'required|min(6)|max(16)'],
    'staff_role'    => [$role,  'required|int']
]);

if($v->passes() && $img_err == "") {
  $id = uniqid();
  $pass = hashPass($password);
  mkdir("../img/staff/".$branch."/", 0700);
  $destination = "../img/staff/".$branch."/".$id.".jpg";
  $imgPath = $branch."/".$id.".jpg";
  move_uploaded_file($_FILES["staff_id"]["tmp_name"], $destination);
  $sql = 'insert into staff (name,phone,email,branch_id,password,id_copy,role_id) values
                             (?,?,?,?,?,?,?)';
  $result = setData($con,$sql,[$name,$phone,$email,$branch,$pass,$imgPath,$role]);
  if($result > 0){
    $success = 1;
    $sql = 'select token from staff where role_id = 1';
    $res = getData($con,$sql);
    $tokens = [];
    foreach($res as $k => $val){
    $tokens[] = $val['token'];
    }
    $fcm = sendNotification($tokens,'موظف','اضافه موظف جديد','../?page=pages/staff.php');
  }
}else{
  $error = [
           'staff_name_err'=> implode($v->errors()->get('staff_name')),
           'staff_email_err'=>implode($v->errors()->get('staff_email')),
           'staff_phone_err'=>implode($v->errors()->get('staff_phone')),
           'staff_password_err'=>implode($v->errors()->get('staff_password')),
           'staff_branch_err'=>implode($v->errors()->get('staff_branch')),
           'staff_role_err'=>implode($v->errors()->get('staff_role')),
           'staff_id_err'=>$img_err
           ];
}
echo json_encode(['success'=>$success, 'error'=>$error]);
?>