<?php
session_start();
//error_reporting(0);
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
$id    = $_REQUEST['e_town_id'];
$city  = $_REQUEST['e_town_city'];
$name  = $_REQUEST['e_town_name'];
$v->addRuleMessages([
    'required' => 'الحقل مطلوب',
    'int'      => 'فقط الارقام مسموع بها',
    'regex'      => 'فقط الارقام مسموع بها',
    'min'      => 'قصير جداً',
    'max'      => 'مسموح ب {value} رمز كحد اعلى ',
    'email'      => 'البريد الالكتروني غيز صحيح',
]);

$v->validate([
    'town_name' => [$name,'required|min(2)|max(20)'],
    'town_city' => [$city,'required|int'],
    'town_id'   => [$id,  'required|int'],
]);

if($v->passes()) {
  $sql = 'update towns set name = ?, city_id=? where id=?';
  $result = setData($con,$sql,[$name,$city,$id]);
  if($result > 0){
    $success = 1;
  }
}else{
  $error = [
           'town_id_err'=>  implode($v->errors()->get('town_id')),
           'town_name_err'=>implode($v->errors()->get('town_name')),
           'town_city_err'=>implode($v->errors()->get('town_city'))
           ];
}
echo json_encode(['success'=>$success, 'error'=>$error,[$name,$city,$id]]);
?>