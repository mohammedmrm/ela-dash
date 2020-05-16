<?php
session_start();
header('Content-Type: application/json');
//error_reporting(0);
require_once("_access.php");
access([1,2,3]);
require_once("dbconnection.php");
require_once("../config.php");
$id = $_REQUEST['store'];
$data = [];
$success =0;
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
          where store_id = ? and invoice_id = 0  and (order_status_id = 6 or order_status_id = 9 or order_status_id = 10 or order_status_id = 11 or order_status_id = 5)
          ";
$res3= getData($con,$sql,[$id]);
$data= $res3;
$sql2 = "select invoice.*,date_format(invoice.date,'%Y-%m-%d') as in_date,clients.name as client_name,clients.phone as client_phone
           ,stores.name as store_name
           from invoice
           inner join stores on stores.id = invoice.store_id
           inner join clients on stores.client_id = clients.id
           where store_id=? and invoice.orders_status=6";
$res2 = getData($con,$sql2,[$id]);
echo json_encode(array("success"=>$success,"data"=>$data,"invoice"=>$res2));
?>