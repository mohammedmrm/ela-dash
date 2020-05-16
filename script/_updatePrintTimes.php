<?php
session_start();
error_reporting(0);
require("_access.php");
access([1]);
$id= $_REQUEST['id'];
require_once("dbconnection.php");
$sql = "update company_receipt set print_times = print_times + 1 where id=?";
$res3 = setData($con,$sql,[$id]);
?>