<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require("_access.php");
access([1,2,5]);
require("dbconnection.php");
require("../config.php");

$branch = $_REQUEST['branch'];
$city = $_REQUEST['city'];
$customer = $_REQUEST['customer'];
$order = $_REQUEST['order_no'];
$store= $_REQUEST['store'];
$invoice= $_REQUEST['invoice'];
$status = $_REQUEST['orderStatus'];
$driver = $_REQUEST['driver'];
$repated = $_REQUEST['repated'];
$start = trim($_REQUEST['start']);
$end = trim($_REQUEST['end']);
$limit = 10;
$sort ="";
$page = trim($_REQUEST['p']);
if(empty($page) || $page <=0){
  $page =1;
}
$total = [];
$money_status = trim($_REQUEST['money_status']);
if(!empty($end)) {
   $end =date('Y-m-d', strtotime($end. ' + 1 day'));
}else{
  $end =date('Y-m-d', strtotime(' + 1 day'));
}

try{
  $count = "select count(*) as count from orders
            left join (
             select order_no,count(*) as rep from orders
              GROUP BY order_no
              HAVING COUNT(orders.id) > 1
            ) b on b.order_no = orders.order_no";

  $query = "select orders.*, date_format(orders.date,'%Y-%m-%d') as date,
            if(to_city = 1,
                 if(client_dev_price.price is null,(".$config['dev_b']." - discount),(client_dev_price.price - discount)),
                 if(client_dev_price.price is null,(".$config['dev_o']." - discount),(client_dev_price.price - discount))
            )as dev_price,
            new_price -
              (if(to_city = 1,
                  if(client_dev_price.price is null,(".$config['dev_b']." - discount),(client_dev_price.price - discount)),
                  if(client_dev_price.price is null,(".$config['dev_o']." - discount),(client_dev_price.price - discount))
                 )
             ) as client_price,
            clients.name as client_name,clients.phone as client_phone,
            stores.name as store_name,a.nuseen_msg,
            cites.name as city,towns.name as town,branches.name as branch_name,
            order_status.status as status_name,staff.name as staff_name,b.rep as repated , driver.name as driver_name
            from orders left join
            clients on clients.id = orders.client_id
            left join cites on  cites.id = orders.to_city
            left join stores on  orders.store_id = stores.id
            left join towns on  towns.id = orders.to_town
            left join branches on  branches.id = orders.from_branch
            left join staff on  staff.id = orders.manager_id
            left join staff as driver on  driver.id = orders.driver_id
            left join order_status on  order_status.id = orders.order_status_id
            left JOIN client_dev_price on client_dev_price.client_id = orders.client_id AND client_dev_price.city_id = orders.to_city
            left join (
             select count(*) as nuseen_msg, max(order_id) as order_id from message
             where is_client = 0 and admin_seen = 0
             group by message.order_id
            ) a on a.order_id = orders.id

            left join (
             select order_no,count(*) as rep from orders
              GROUP BY order_no
              HAVING COUNT(orders.id) > 1
            ) b on b.order_no = orders.order_no

            ";
$where = "where";
if($_SESSION['role'] != 1){
 $where = "where from_branch = '".$_SESSION['user_details']['branch_id']."' and ";
}
  $filter = " and orders.confirm = 1 ";
  if($branch >= 1){
   $filter .= " and from_branch =".$branch;
  }
  if($driver >= 1){
   $filter .= " and driver_id =".$driver;
  }
  $sort = " order by orders.date DESC ";
  if($repated == 1){
   $filter .= " and b.rep >= 2";
  }else if($repated == 2){
   $filter .= " and b.rep < 2";

  }
  if($city >= 1){
    $filter .= " and to_city=".$city;
  }
  if(($money_status == 1 || $money_status == 0) && $money_status !=""){
    $filter .= " and money_status='".$money_status."'";
  }
  if($store >= 1){
    $filter .= " and orders.store_id=".$store;
  }
  if($invoice == 1){
    $filter .= " and ((orders.invoice_id ='' or orders.invoice_id =0) or ((order_status_id=6 or order_status_id=5) and (orders.invoice_id2 ='' or orders.invoice_id2 =0)))";
  }else if($invoice == 2){
    $filter .= " and ((orders.invoice_id !='' and orders.invoice_id != 0))";
  }
  if(!empty($customer)){
    $filter .= " and (customer_name like '%".$customer."%' or
                      customer_phone like '%".$customer."%')";
  }
  if(!empty($order)){
    $filter .= " and orders.order_no like '%".$order."%'";
  }
  ///-----------------status
  if($status == 4){
    $filter .= " and (order_status_id =".$status." or order_status_id = 6 or order_status_id = 5)";
  }else if($status == 9){
    $filter .= " and (order_status_id =".$status." or order_status_id = 6 or order_status_id = 5)";
  }else  if($status >= 1){
    $filter .= " and order_status_id =".$status;
  }
  //---------------------end of status
  function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
  if(validateDate($start) && validateDate($end)){
      $filter .= " and orders.date between '".$start."' AND '".$end."'";
     }
  if($filter != ""){
    $filter = preg_replace('/^ and/', '', $filter);
    $filter = $where." ".$filter;
    $count .= " ".$filter;
    $query .= " ".$filter;
  }

  $count = getData($con,$count);
  $orders = $count[0]['count'];
  $pages= ceil($count[0]['count'] / $limit);
  $lim = " limit ".(($page-1) * $limit).",".$limit;

  $query .= $sort.$lim;
  $data = getData($con,$query);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
try{

 $sqlt = "select
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
          count(orders.order_no) as orders
          from orders

          left JOIN client_dev_price on client_dev_price.client_id = orders.client_id AND client_dev_price.city_id = orders.to_city
          left join (
             select order_no,count(*) as rep from orders
              GROUP BY order_no
              HAVING COUNT(orders.id) > 1
            ) b on b.order_no = orders.order_no
          ";

if($filter != ""){
    $filter = preg_replace('/^ and/', '', $filter);
    $sqlt .= " ".$filter;
}
$total = getData($con,$sqlt);

/*  $i = 0;
foreach($data as $k=>$v){
        $total['income'] += $data[$i]['new_price'];
        $sql = "select * from client_dev_price where client_id=? and city_id=?";
        $dev_price  = getData($con,$sql,[$v['client_id'],$v['to_city']]);
        if(count($dev_price) > 0){
           $dev_p = $dev_price[0]['price'];
        }else{
          if($v['to_city'] == 1){
           $dev_p = $config['dev_b'];
          }else{
           $dev_p = $config['dev_o'];
          }
        }
        $data[$i]['dev_price'] = $dev_p;
        $data[$i]['client_price'] = ($data[$i]['new_price'] -  $dev_p) + $data[$i]['discount'];

        if($v['with_dev'] == 1){
          $data[$i]['with_dev'] = 'نعم';
        }else{
        $data[$i]['with_dev'] = 'لا';
        }
        if($v['money_status'] == 1){
          $data[$i]['money_status1'] = 'تم تسليم المبلغ للعميل';
        }else{
        $data[$i]['money_status1'] = 'لم يتم تسليم المبلغ';
        }
  $total['discount'] += $data[$i]['discount'];
  $total['dev_price'] += $dev_p - $data[$i]['discount'];
  $total['client_price'] += $data[$i]['client_price'];
  $i++;
}*/
 $total[0]['orders'] = $orders;
if($store >=1){
 $total[0]['store'] = $data[0]['store_name'];
}else{
 $total[0]['store'] = '<span class="text-danger">لم يتم تحديد صفحة</span>';
}
  $success="1";
} catch(PDOException $ex) {
   $total=["error"=>$ex];
   $success="0";
}
echo json_encode(array($query,$sqlt,"success"=>$success,"data"=>$data,'total'=>$total,"pages"=>$pages,"page"=>$page));
?>