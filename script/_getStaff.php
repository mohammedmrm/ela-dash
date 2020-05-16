<?php
session_start();
header('Content-Type: application/json');
require("_access.php");
access([1,2]);
require("dbconnection.php");
try{
  if($_SESSION['role'] == 1 ){
  $query = "select staff.*,
            branches.name as branch_name,
            role.name as role_name 
            from staff inner join branches on branches.id = staff.branch_id
            inner join role on role.id = staff.role_id
            where account_type <> 2";
  }else{
   $query = "select staff.*,
            branches.name as branch_name,
            role.name as role_name
            from staff inner join branches on branches.id = staff.branch_id
            inner join role on role.id = staff.role_id
            where account_type <> 2 and staff.branch_id = '".$_SESSION['user_details']['branch_id']."'";
  }
  $data = getData($con,$query);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
print_r(json_encode(array("success"=>$success,"data"=>$data)));
?>