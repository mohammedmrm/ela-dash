<?php
session_start();
header('Content-Type: application/json');
//error_reporting(0);
require_once("_access.php");
access([1,2,3]);
require_once("dbconnection.php");
require_once("../config.php");
$id = $_SESSION['userid'];
$data = [];
$success =0;
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
          where client_id = ?  and invoice_id = 0 and order_status = 4
          ";
          $res4= getData($con,$sql,[$id]);
          $res4= $res4[0];

$sql2 = "select invoice.*,date_format(invoice.date,'%Y-%m-%d') as in_date,clients.name as client_name,clients.phone as client_phone
           ,stores.name as store_name
           from invoice
           inner join stores on stores.id = invoice.store_id
           inner join clients on stores.client_id = clients.id
           where store_id=?";
$res2 = getData($con,$sql2,[$id]);
echo json_encode(array("success"=>$success,"data"=>$res4,"invoice"=>$res2,'pay'=>$res4));
?>