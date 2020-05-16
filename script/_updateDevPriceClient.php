<?php
session_start();
//error_reporting(0);
header('Content-Type: application/json');
require("_access.php");
access([1,2,5]);
require("dbconnection.php");
require("_crpt.php");
require("../config.php");


$success = 0;
$client  = $_REQUEST['client_id'];
$dev  = $_REQUEST['devPrice'];
$city  = $_REQUEST['devCity'];
$msg = "";
$j = 0;
foreach ($dev as $k=>$v){
  if(empty($v)){
    $msg = "السعر غير صالح -".$j."-";
    break;
  }else if(empty($city[$j])){
    $msg = "اسم المدينة غير معروف -".$j."-";
    break;
  }

  $j++;
}
if($msg == ""){
    $i=0;
    foreach ($city as $k=>$v){
    if($city == 1){
            $sql1 = "select * from client_dev_price where client_id=? and city_id=?";
            $res = getData($con,$sql1,[$client,$v]);
            if(count($res) == 1){
              if($dev[$i] != $config['dev_b']){
                  $sql2="update client_dev_price set price = ? where client_id=? and city_id=?";
                  $res = setData($con,$sql2,[$dev[$i],$client,$v]);
                  if($res == 1){
                    $success =1;
                  }
              }else{
                    $sql2="delete from client_dev_price where city_id=? and client_id=?";
                    $res = setData($con,$sql2,[$v,$client]);
                    if($res == 1){
                      $success =1;
                    }
              }
            }else{
                if($dev[$i] != $config['dev_b']){
                    $sql2="insert into client_dev_price (price,city_id,client_id) values(?,?,?)";
                    $res = setData($con,$sql2,[$dev[$i],$v,$client]);
                    if($res == 1){
                      $success =1;
                    }
                 }else{
                    $sql2="delete from client_dev_price where city_id=? and client_id=?";
                    $res = setData($con,$sql2,[$v,$client]);
                    if($res == 1){
                      $success =1;
                    }
                }
            }
    }else{
            $sql1 = "select * from client_dev_price where client_id=? and city_id=?";
            $res = getData($con,$sql1,[$client,$v]);
            if(count($res) == 1){
              if($dev[$i] != $config['dev_o']){
                $sql2="update client_dev_price set price = ? where client_id=? and city_id=?";
                $res = setData($con,$sql2,[$dev[$i],$client,$v]);
                if($res == 1){
                  $success =1;
                }
              }else{
                $sql2="delete from client_dev_price where city_id=? and client_id=?";
                $res = setData($con,$sql2,[$v,$client]);
                if($res == 1){
                  $success =1;
                }
              }
            }else{
              if($dev[$i] != $config['dev_o']){
                $sql2="insert into client_dev_price (price,city_id,client_id) values(?,?,?)";
                $res = setData($con,$sql2,[$dev[$i],$v,$client]);
                if($res == 1){
                  $success =1;
                }
              }else{
                $sql2="delete from client_dev_price where city_id=? and client_id=?";
                $res = setData($con,$sql2,[$v,$client]);
                if($res == 1){
                  $success =1;
                }
              }
            }

    }
    $i++;
 }
}
echo json_encode(['success'=>$success, 'error'=>$msg]);
?>