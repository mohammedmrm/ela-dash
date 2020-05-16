<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require("_access.php");
access([1,2,3,5]);
require("dbconnection.php");
$branch = $_REQUEST['branch'];
$to_branch = $_REQUEST['to_branch'];
$city = $_REQUEST['city'];
$customer = $_REQUEST['customer'];
$order = $_REQUEST['order_no'];
$client= $_REQUEST['client'];
$status = $_REQUEST['orderStatus'];
$start = trim($_REQUEST['start']);
$end = trim($_REQUEST['end']);
$limit = trim($_REQUEST['limit']);
$page = trim($_REQUEST['p']);
$money_status = trim($_REQUEST['money_status']);
if(empty($end)) {
  $end = date('Y-m-d h:i:s', strtotime($end. ' + 1 day'));
}else{
   $end .=" 23:59:59";
}
$start .=" 00:00:00";
try{
  $count = "select count(*) as count from orders ";
  $query = "select orders.*,DATE_FORMAT(orders.date,'%Y-%m-%d') as date,
            clients.name as client_name,clients.phone as client_phone,
            cites.name as city,towns.name as town,branches.name as branch_name
            from orders left join
            clients on clients.id = orders.client_id
            left join cites on  cites.id = orders.to_city
            left join towns on  towns.id = orders.to_town
            left join branches on  branches.id = orders.to_branch
            ";
  $where = "where";
  $filter = " and orders.confirm = 1";
  if($branch >= 1){
   $filter .= " and from_branch =".$branch;
  }
  if($to_branch >= 1){
   $filter .= " and to_branch =".$to_branch;
  }
  if($city >= 1){
    $filter .= " and to_city=".$city;
  }
  if(($money_status == 1 || $money_status == 0) && $money_status !=""){
    $filter .= " and money_status='".$money_status."'";
  }
  if($client >= 1){
    $filter .= " and client_id=".$client;
  }
  if(!empty($customer)){
    $filter .= " and (customer_name like '%".$customer."%' or
                      customer_phone like '%".$customer."%')";
  }
  if(!empty($order)){
    $filter .= " and order_no like '%".$order."%'";
  }
  ///-----------------status
  if($status == 4){
    $filter .= " and (order_status_id =".$status." or order_status_id = 6)";
  }else if($status == 9){
    $filter .= " and (order_status_id =".$status." or order_status_id = 6 or order_status_id = 5)";
  }else  if($status >= 1){
    $filter .= " and order_status_id =".$status;
  }
  //---------------------end of status

  function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
  if(validateDate($start) && validateDate($end)){
      $filter .= " and date between '".$start."' AND '".$end."'";
     }
  if($filter != ""){
    $filter = preg_replace('/^ and/', '', $filter);
    $filter = $where." ".$filter;
    $count .= " ".$filter;
    $query .= " ".$filter;
  }
  if($page != 0){
    $page = $page -1;
  }
  $query .= ' order by orders.date DESC limit '.($page * $limit).",".$limit;
  $data = getData($con,$query);
  $ps = getData($con,$count);
  $pages= ceil($ps[0]['count']/$limit);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
if($success == '1'){
  foreach($data as $k=>$v){
    if($v['with_dev'] == 1){
      $data[$k]['with_dev'] = "نعم";
    }else{
      $data[$k]['with_dev'] = "لا";
    }
    if($v['money_status'] == 1){
      $data[$k]['money_status'] = "مدفوع";
    }else{
      $data[$k]['money_status'] = "غير مدفوع";
    }
  }
}
print_r(json_encode(array("success"=>$success,"data"=>$data,'pages'=>$pages,'page'=>$page+1)));
?>