<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require("_access.php");
access([1,2,3]);
require("dbconnection.php");
$company = $_REQUEST['company'];
$start = $_REQUEST['start'];
$end = $_REQUEST['end'];
if(empty($end)) {
   $end = date('Y-m-d', strtotime(' + 1 day'));
}
if(empty($start)) {
   $start = date('Y-m-d',strtotime(' - 1 day'));
}

try{
  $query = "select *, company_receipt.id as f_id,
      if(companies.logo is null,'logos/logo.png',companies.logo) as logo,
      if(companies.name is null,'الشركه الرئسيه',companies.name) as name
  from company_receipt
  left join companies on companies.id = company_receipt.company_id";

  $where = "where";
  $filter = "";
     function validateDate($date, $format = 'Y-m-d')
     {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
     }
    if(validateDate($start) && validateDate($end)){
        $filter .= " and company_receipt.date between '".$start."' AND '".$end."'";
    }

  if($company >= 1){
   $filter .= " and company_receipt.company_id =".$company;
  }


  if($filter != ""){
    $filter = preg_replace('/^ and/', '', $filter);
    $filter = $where." ".$filter;
    $query .= " ".$filter;
  }
  $query .= " order by company_receipt.id DESC";
  $data = getData($con,$query);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
echo json_encode([$query,"success"=>$success,"data"=>$data]);
?>