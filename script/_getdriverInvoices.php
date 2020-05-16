<?php
session_start();
header('Content-Type: application/json');
error_reporting(0);
require_once("_access.php");
access([1,2,3]);
require_once("dbconnection.php");
require_once("../config.php");
$id = $_REQUEST['store'];
$data = [];
$end = $_REQUEST['end'];
$start = $_REQUEST['start'];
$success =0;
if(empty($end)) {
  $end = date('Y-m-d', strtotime(' + 1 day'));
}else{
   $end =date('Y-m-d', strtotime($end. ' + 1 day'));
}
if(empty($start)) {
  $start = date('Y-m-d', strtotime(' - 1 day'));
}

$sql ="select  date_format(orders.date,'%Y-%m-%d') as dat from orders where store_id = ? and order_status_id = 4  and invoice_id = 0 GROUP by dat";
$res = getData($con,$sql,[$id]);
if(count($res) > 0){
  $success =1;
}
foreach($res as $k=>$val){
  $sql = "select orders.*,date_format(orders.date,'%Y-%m-%d') as dat,  order_status.status as status_name,
          cites.name as city_name,
          towns.name as town_name,
            if(to_city = 1,
                 if(client_dev_price.price is null,(".$config['dev_b']." - discount),(client_dev_price.price - discount)),
                 if(client_dev_price.price is null,(".$config['dev_o']." - discount),(client_dev_price.price - discount))
            )as dev_price,
            new_price -
              (if(to_city = 1,
                  if(client_dev_price.price is null,(".$config['dev_b']." - discount),(client_dev_price.price - discount)),
                  if(client_dev_price.price is null,(".$config['dev_o']." - discount),(client_dev_price.price - discount))
                 )
             ) as client_price
          from orders
          inner join order_status on orders.order_status_id = order_status.id
          inner join cites on orders.to_city = cites.id
          inner join towns on orders.to_town = towns.id
          left JOIN client_dev_price on client_dev_price.client_id = orders.client_id AND client_dev_price.city_id = orders.to_city
          where store_id = ? and date(date) = ? and invoice_id = 0  and order_status_id = 4
          ";
  $res3= getData($con,$sql,[$id,$val['dat']]);
  $data[$val['dat']] = $res3;
  $sql = "select
          sum(new_price) as income,

          sum(
                 if(order_status_id = 9,
                     0,
                     if(to_city = 1,
                           if(client_dev_price.price is null,(".$config['dev_b']." - discount),(client_dev_price.price - discount)),
                           if(client_dev_price.price is null,(".$config['dev_o']." - discount),(client_dev_price.price - discount))
                      )
                  )
          ) as dev,

          sum(new_price -
              (
                 if(order_status_id = 9,
                     0,
                     if(to_city = 1,
                           if(client_dev_price.price is null,(".$config['dev_b']." - discount),(client_dev_price.price - discount)),
                           if(client_dev_price.price is null,(".$config['dev_o']." - discount),(client_dev_price.price - discount))
                      )
                  )
              )
          ) as client_price,
          sum(discount) as discount,
          count(order_no) as orders
          from orders
          left JOIN client_dev_price on client_dev_price.client_id = orders.client_id AND client_dev_price.city_id = orders.to_city
          where store_id = ?  and drivre_invoice_id = 0 and order_status_id = 4
          ";
          $res4= getData($con,$sql,[$id]);
          $res4= $res4[0];
}
$sql2 = "select driver_invoice.*,date_format(driver_invoice.date,'%Y-%m-%d') as in_date,clients.name as client_name,clients.phone as client_phone
           ,stores.name as store_name
           from driver_invoice
           inner join stores on stores.id = driver_invoice.store_id
           inner join clients on stores.client_id = clients.id
           where driver_id=? and driver_invoice.date between ? AND ? ";
$res2 = getData($con,$sql2,[$id,$start,$end]);
echo json_encode(array($sql2,$start,"success"=>$success,"data"=>$data,"invoice"=>$res2,'pay'=>$res4));
?>