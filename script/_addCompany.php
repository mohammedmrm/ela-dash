<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require("_access.php");
access([1,2,5]);
require("dbconnection.php");
require("_crpt.php");
require_once("_vaildFile.php");
require("../config.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;


$success = 0;
$name    = $_REQUEST['Company_name'];
$logo   = $_FILES['Company_logo'];
$text2   = $_REQUEST['Company_text2'];
$text1 = $_REQUEST['Company_text1'];
$phone   = $_REQUEST['Company_phone'];



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
    $exists = getData($GLOBALS['con'],"SELECT * FROM Companys WHERE phone =".$value);
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
    'Company_name'    => [$name,    'required|min(3)|max(100)'],
    'Company_text1'   => [$text1, 'max(500)'],
    'Company_text2'   => [$text2,'max(500)'],
    'Company_phone'   => [$phone,   "required|isPhoneNumber"],
]);
$logo_err = image($logo,[".jpg", ".jpeg", ".png"],1);
if($v->passes() && $logo_err == "") {
  if($logo['size'] != 0){
    $id = uniqid();
    mkdir("../img/logo/companies/", 0700);
    $destination = "../img/logos/companies/".$id.".jpg";
    $imgPath = "logos/companies/".$id.".jpg";
    move_uploaded_file($logo["tmp_name"], $destination);
  }else{
    $imgPath = "_";
  }
  $sql = 'insert into companies (name,phone,logo,text1,text2) values
                              (?,?,?,?,?)';
  $result = setData($con,$sql,[$name,$phone,$imgPath,$text1,$text2]);
  if($result > 0){
    $success = 1;
  }
}else{
  $error = [
           'Company_name_err'=> implode($v->errors()->get('Company_name')),
           'Company_text1_err'=>implode($v->errors()->get('Company_text1')),
           'Company_text2_err'=>implode($v->errors()->get('Company_text2')),
           'Company_phone_err'=>implode($v->errors()->get('Company_phone')),
           'Company_logo_err'=>$logo_err,
           ];
}
echo json_encode(['success'=>$success, 'error'=>$error]);
?>