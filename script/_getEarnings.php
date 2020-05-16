<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require("../script/_access.php");
access([1,2,5,3]);
require("../script/dbconnection.php");
require_once("../config.php");
$start = trim($_REQUEST['start']);
$end = trim($_REQUEST['end']);
if(empty($end)) {
  $end = date('Y-m-d 00:00:00', strtotime($end. ' + 1 day'));
}else{
   $end =date('Y-m-d', strtotime($end. ' + 1 day'));
   $end .=" 00:00:00";
}
if(empty($start)) {
  $start = date('Y-m-d 00:00:00',strtotime($start. ' - 7 day'));
}else{
   $start .=" 00:00:00";
}
if($_SESSION['user_details']['role_id'] == 1){
  $sql = 'select
            sum(
                if(to_city = 1,
                 if(client_dev_price.price is null,('.$config['dev_b'].' - discount),(client_dev_price.price - discount)),
                 if(client_dev_price.price is null,('.$config['dev_o'].' - discount),(client_dev_price.price - discount))
                )
             ) as earnings,
             sum(
                 new_price -
                 (
                     if(to_city = 1,
                       if(client_dev_price.price is null,('.$config['dev_b'].' - discount),(client_dev_price.price - discount)),
                       if(client_dev_price.price is null,('.$config['dev_o'].' - discount),(client_dev_price.price - discount))
                 )
                )
             ) as client_price,
             sum(new_price) as income,
             sum(discount) as discount,
             count(orders.id) as orders,
            max(clients.name) as name,
            max(clients.phone) as phone,
            max(branches.name) as branch_name
            from orders
            left join clients on clients.id = orders.client_id
            left join branches on  branches.id = clients.branch_id
            left JOIN client_dev_price
            on client_dev_price.client_id = orders.client_id AND client_dev_price.city_id = orders.to_city
            where date between "'.$start.'" and "'.$end.'"
            ';

}else{
  $sql = 'select
            sum(
                 if(order_status_id = 9,
                     0,
                     if(to_city = 1,
                           if(client_dev_price.price is null,('.$config['dev_b'].' - discount),(client_dev_price.price - discount)),
                           if(client_dev_price.price is null,('.$config['dev_o'].' - discount),(client_dev_price.price - discount))
                      )
                  )
             ) as earnings,
             sum(
                 new_price -
                 (
                 if(order_status_id = 9,
                     0,
                     if(to_city = 1,
                           if(client_dev_price.price is null,('.$config['dev_b'].' - discount),(client_dev_price.price - discount)),
                           if(client_dev_price.price is null,('.$config['dev_o'].' - discount),(client_dev_price.price - discount))
                      )
                  )
                )
             ) as client_price,
             sum(new_price) as income,
             sum(discount) as discount,
             count(orders.id) as orders,
            max(clients.name) as name,
            max(clients.phone) as phone,
            max(branches.name) as branch_name
            from orders
            left join clients on clients.id = orders.client_id
            left join branches on  branches.id = clients.branch_id
            left JOIN client_dev_price
            on client_dev_price.client_id = orders.client_id AND client_dev_price.city_id = orders.to_city
            where branch_id ="'.$_SESSION['user_details']['branch_id'].'" and date between "'.$start.'" and "'.$end.'"
            ';

}
$sql1 = $sql."  GROUP by  orders.client_id";
$data =  getData($con,$sql1);
$total=getData($con,$sql);

$total[0]['start'] = date('Y-m-d', strtotime($start));
$total[0]['end'] = date('Y-m-d', strtotime($end." -1 day"));
/*foreach($data as $k=>$v){
  $total['income'] += $data[$i]['new_price'];
  if($v['with_dev'] == 1){
    $data[$i]['with_dev'] = '???';
    if($v['to_city'] == 1){
     $data[$i]['client_price'] = ($data[$i]['new_price'] -  $config['dev_b']) + $data[$i]['discount'];
    }else{
     $data[$i]['client_price'] = ($data[$i]['new_price'] -  $config['dev_o']) + $data[$i]['discount'];
    }

    $data[$i]['with_dev'] = '??';
    if($v['to_city'] == 1){
     $data[$i]['client_price'] = ($data[$i]['new_price'] -  $config['dev_b']) + $data[$i]['discount'];
    }else{
     $data[$i]['client_price'] = ($data[$i]['new_price'] -  $config['dev_o']) + $data[$i]['discount'];
    }
  }
  $total['discount'] += $data[$i]['discount'];
  $total['earnings'] += $data[$i]['earnings'];
  $total['client_price'] += $data[$i]['client_price'];
  $total['orders'] += 1;
  $i++;
}*/
echo json_encode(['data'=>$data,"total"=>$total]);
?>