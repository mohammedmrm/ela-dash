<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require("_access.php");
access([1,2]);
require("dbconnection.php");
require("../config.php");
/*if(isset($_REQUEST['discount'])){
  $discount = $_REQUEST['discount'];
}else{
  $discount = 0;
}

if(isset($_REQUEST['dev_b'])){
  $dev_b = $_REQUEST['dev_b'];
}else{
  $dev_b = $config['dev_b'];
}
if(isset($_REQUEST['dev_o'])){
  $dev_o = $_REQUEST['dev_o'];
}else{
  $dev_o = $config['dev_o'];
}*/
$branch = $_REQUEST['branch'];
$city = $_REQUEST['city'];
$customer = $_REQUEST['customer'];
$order = $_REQUEST['order_no'];
$client= $_REQUEST['client'];
$status = $_REQUEST['orderStatus'];
$start = trim($_REQUEST['start']);
$end = trim($_REQUEST['end']);
$total = [];
$money_status = trim($_REQUEST['money_status']);
if(empty($end)) {
  $end = date('Y-m-d h:i:s', strtotime($end. ' + 1 day'));
}else{
   $end =date('Y-m-d', strtotime($end. ' + 1 day'));
   $end .=" 00:00:00";
}
if(empty($start)) {
  $start = date('Y-m-d 00:00:00');
}else{
   $start .=" 00:00:00";
}

try{
  $count = "select count(*) as count from orders ";
  $query = "select orders.*,
            if(to_city = 1,
                 if(client_dev_price.price is null,(".$config['dev_b']." - discount),(client_dev_price.price - discount)),
                 if(client_dev_price.price is null,(".$config['dev_o']." - discount),(client_dev_price.price - discount))
                ) as dev,
             new_price -
              (if(to_city = 1,
                  if(client_dev_price.price is null,(".$config['dev_b']." - discount),(client_dev_price.price - discount)),
                  if(client_dev_price.price is null,(".$config['dev_o']." - discount),(client_dev_price.price - discount))
                 )
              )  as client_price,
            clients.name as client_name,clients.phone as client_phone,
            cites.name as city,towns.name as town,branches.name as branch_name
            from orders left join
            clients on clients.id = orders.client_id
            left join cites on  cites.id = orders.to_city
            left join towns on  towns.id = orders.to_town
            left join branches on  branches.id = orders.to_branch
            left JOIN client_dev_price on client_dev_price.client_id = orders.client_id AND client_dev_price.city_id = orders.to_city
            ";
  $where = "where";
  if($_SESSION['user_details']['role_id'] == 1){
  $filter = " and order_status = 7";
  }else{
   $filter = " and order_status = 7 and from_branch = ".$_SESSION['user_details']['branch_id'];
  }
  if($branch >= 1){
   $filter .= " and from_branch =".$branch;
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
  if($status >= 1){
    $filter .= " and order_status =".$status;
  }

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

  $data = getData($con,$query);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
try{
 /* $i = 0;
foreach($data as $k=>$v){
  $total['income'] += $data[$i]['new_price'];
  if($v['with_dev'] == 1){
    $data[$i]['with_dev'] = 'نعم';
    if($v['to_city'] == 1){
     $data[$i]['client_price'] = ($data[$i]['new_price'] -  $config['dev_b']) + $data[$i]['discount'];
    }else{
     $data[$i]['client_price'] = ($data[$i]['new_price'] -  $config['dev_o']) + $data[$i]['discount'];
    }

    $data[$i]['with_dev'] = 'لا';
    if($v['to_city'] == 1){
     $data[$i]['client_price'] = ($data[$i]['new_price'] -  $config['dev_b']) + $data[$i]['discount'];
    }else{
     $data[$i]['client_price'] = ($data[$i]['new_price'] -  $config['dev_o']) + $data[$i]['discount'];
    }
  }
  $total['discount'] += $data[$i]['discount'];
  $total['dev_price'] += $data[$i]['dev_price'];
  $total['client_price'] += $data[$i]['client_price'];
  $total['orders'] += 1;
  $i++;
}*/
 $sqlt = "select
          sum(new_price) as income,

          sum(
              if(to_city = 1,
                 if(client_dev_price.price is null,(".$config['dev_b']." - discount),(client_dev_price.price - discount)),
                 if(client_dev_price.price is null,(".$config['dev_o']." - discount),(client_dev_price.price - discount))
                )
          ) as dev,

          sum(new_price -
              (if(to_city = 1,
                  if(client_dev_price.price is null,(".$config['dev_b']." - discount),(client_dev_price.price - discount)),
                  if(client_dev_price.price is null,(".$config['dev_o']." - discount),(client_dev_price.price - discount))
                 )
              )
          ) as client_price,
          sum(discount) as discount,
          count(order_no) as orders
          from orders
          left JOIN client_dev_price on client_dev_price.client_id = orders.client_id AND client_dev_price.city_id = orders.to_city";

if($filter != ""){
    $filter = preg_replace('/^ and/', '', $filter);
    $sqlt .= " ".$filter;
}
$total = getData($con,$sqlt);

if($client >=1){
 $total[0]['client'] = $data[0]['client_name'];
}else{
 $total[0]['client'] = '<span class="text-danger">لم يتم تحديد عميل</span>';
}
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
print_r(json_encode(array("success"=>$success,"data"=>$data,'total'=>$total,'q'=>$query)));
?>