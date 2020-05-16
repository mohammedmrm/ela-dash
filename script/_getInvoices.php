<?php
session_start();
header('Content-Type: application/json');
error_reporting(0);
require("_access.php");
access([1,2,3,4,5]);
$client = $_REQUEST['client'];
$store = $_REQUEST['store'];
$start = $_REQUEST['start'];
$end = $_REQUEST['end'];
if(empty($end)) {
   $end = date('Y-m-d', strtotime(' + 1 day'));
}
if(empty($start)) {
   $start = date('Y-m-d',strtotime(' - 7 day'));
}
require("dbconnection.php");
try{
  $query = "select invoice.*,date_format(invoice.date,'%Y-%m-%d') as in_date,clients.name as client_name,clients.phone as client_phone
           ,stores.name as store_name
           from invoice
           inner join stores on stores.id = invoice.store_id
           inner join clients on stores.client_id = clients.id
           ";

    function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
    if(validateDate($start) && validateDate($end)){
      $filter = "where invoice.date between '".$start."' AND '".$end."'";
    }

    if($client >= 1){
       $filter .= " and stores.client_id =".$client;
    }
    if($store >= 1){
       $filter .= " and invoice.store_id =".$store;
    }

    $query .=  $filter;
    $query .=  " limit 1000";
    $data = getData($con,$query);
    $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
print_r(json_encode(array("success"=>$success,"data"=>$data)));
?>