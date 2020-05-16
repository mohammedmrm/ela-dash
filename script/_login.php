<?php
header('Content-type:application/json');
//error_reporting(0);
session_start();
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

if(empty($username) || empty($password)){
  $msg = "جميع الحقول مطلوبة";
}else{
  require_once("dbconnection.php");
  $sql = "select * from staff where phone = ? and status=1";
  $result = getData($con,$sql,[$username]);
  if(count($result) != 1 || !password_verify($password,$result[0]['password']) ){
    $msg = "اسم المستخدم او كلمة المرور غير صحيحة";
  }else{
    $msg = 1;
    $_SESSION['login']=1;
    $_SESSION['username']=$result[0]['phone'];
    $_SESSION['userid']=$result[0]['id'];
    $_SESSION['role']=$result[0]['role_id'];
    $_SESSION['user_details']=$result[0];
  }
}
echo json_encode(['msg'=>$msg,"redirect"=>$_REQUEST['redirect'] ]);
?>