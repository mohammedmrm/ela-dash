<?php
ob_start();
session_start();
error_reporting(0);
header('Content-Type: application/json');
require("_access.php");
access([1,2,3,5]);
require_once("dbconnection.php");
$style='
<style>

  td,th{
    padding:3px;
    text-align:center;
  }
  .head-tr {
    background-color:#00008B;
    color:#F5F5F5;
    padding:5px;
  }
</style>' ;
require("../config.php");



$driver= $_REQUEST['driver'];
$price = $_REQUEST['price'];

$start = trim($_REQUEST['start']);
$end = trim($_REQUEST['end']);


$total = [];
$money_status = trim($_REQUEST['money_status']);
if(empty($end)) {
  $end = "";
}else{
   $end =date('Y-m-d', strtotime($end. ' + 1 day'));
   $end .=" 00:00:00";
}
if(empty($start)) {
  $start = "";
}else{
   $start .=" 00:00:00";
}
if($_REQUEST['price'] > 0){
  $driver_price =    $_REQUEST['price'];
}else {
  $driver_price = $config['driver_price'];
}




try{
 $count = "select count(*) as count from orders";
 $query = "select orders.*,date_format(orders.date,'%Y-%m-%d') as dat,  order_status.status as status_name,
          cites.name as city_name,
          towns.name as town_name,
            if(to_city = 1,
                 if(client_dev_price.price is null,(".$config['dev_b']." - discount),(client_dev_price.price - discount)),
                 if(client_dev_price.price is null,(".$config['dev_o']." - discount),(client_dev_price.price - discount))
            ) as dev_price,
            new_price -
              (if(to_city = 1,
                  if(client_dev_price.price is null,(".$config['dev_b']." - discount),(client_dev_price.price - discount)),
                  if(client_dev_price.price is null,(".$config['dev_o']." - discount),(client_dev_price.price - discount))
                 )
             ) as client_price,
             if(orders.order_status_id=4 or order_status_id = 6,'".$driver_price."',0) as driver_price,
             staff.name as driver
          from orders
          inner join order_status on orders.order_status_id = order_status.id
          inner join cites on orders.to_city = cites.id
          inner join towns on orders.to_town = towns.id
          inner join staff on orders.driver_id = staff.id
          left JOIN client_dev_price on client_dev_price.client_id = orders.client_id AND client_dev_price.city_id = orders.to_city
          ";
  $where = "where driver_invoice_id = 0 and driver_id=".$driver;
  $filter = "";
  function validateDate($date, $format = 'Y-m-d H:i:s')
  {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
  }
 $filter = preg_replace('/^ and/', '', $filter);
 $filter = $where." ".$filter;
 $count .= " ".$filter;
 $query .= " ".$filter." order by orders.date";


  $count1 = getData($con,$count);
  $orders = $count1[0]['count'];
  $data = getData($con,$query);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}

if($orders > 0){
    try{
        $i = 0;
        $content = "";
        $success = 0;
        $pdf_name = date('Y-m-d')."_".uniqid().".pdf";
        $sql = "insert into driver_invoice (path,driver_id) values(?,?)";
        $res = setData($con,$sql,[$pdf_name,$driver]);
        if($res > 0){
          $success = 1;
          $sql = "select *,date_format(date,'%Y-%m-%d') as date from driver_invoice where path=? and driver_id =? order by date DESC limit 1";
          $res = getdata($con,$sql,[$pdf_name,$driver]);
          $invoice = $res[0]['id'];
          $date = $res[0]['date'];

            foreach($data as $k=>$v){
              $total['income'] += $data[$i]['new_price'];
              $hcontent .=
               '<tr>
                 <td width="30" align="center">'.($i+1).'</td>
                 <td width="100" align="center">'.$data[$i]['dat'].'</td>
                 <td align="center">'.$data[$i]['order_no'].'</td>
                 <td width="120" align="center">'.phone_number_format($data[$i]['customer_phone']).'</td>
                 <td width="180" align="center">'.$data[$i]['city_name'].' - '.$data[$i]['town_name'].' - '.$data[$i]['adress'].'</td>
                 <td align="center">'.number_format($data[$i]['price']).'</td>
                 <td align="center">'.number_format($data[$i]['new_price']).'</td>
                 <td align="center">'.number_format($data[$i]['driver_price']).'</td>
                 <td align="center">'.$data[$i]['status_name'].'</td>
               </tr>';
              $total['discount'] += $data[$i]['discount'];
              $total['dev_price'] += $data[$i]['dev_price'];
              $total['driver_price'] += $data[$i]['driver_price'];
              //--- update invoice for each order
              $sql = "update orders set driver_invoice_id =? where id=?";
              $res = setData($con,$sql,[$invoice,$data[$i]['id']]);
              $i++;
           }
           $total['invoice'] = $invoice;
           $total['date'] = $date;
              $hcontent .=
               '<tr>
                 <td colspan="3" align="center">المجموع</td>

                 <td width="120" align="center"></td>
                 <td width="180" align="center"></td>
                 <td align="center"></td>
                 <td align="center">'.number_format($total['income']).'</td>
                 <td align="center">'.number_format($total['driver_price']).'</td>
                 <td align="center"></td>
               </tr>';
        }
        $total['orders'] = $orders;
        if($driver >=1){
         $total['driver'] = $data[0]['driver'];
        }else{
         $total['driver'] = 'لم يتم تحديد عميل';
        }

    } catch(PDOException $ex) {
       $data=["error"=>$ex];
       $success="0";
    }

require_once("../tcpdf/tcpdf.php");
class MYPDF extends TCPDF {
    public function Header() {
        // Set font
        $t = $GLOBALS['total'];
        $this->SetFont('aealarabiya', 'B', 12);
        // Title
        $this->writeHTML('
         <table>
         <tr>
          <td rowspan="4"><img src="../img/logos/logo.png" height="90px"/></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
         </tr>
         <tr>
          <td width="230px">اسم المندوب:'. $t['driver'].'</td>
          <td width="400px" style="color:#00008B;text-align:center;display:block;">كشف حسااب المندوب</td>
          <td >التاريخ:'.$t['date'].'</td>
         </tr>
         <tr>
          <td width="230px">الصافي للمندوب:'.$t['driver_price'].'</td>
          <td width="400px" style="text-align:center;display:block;">عدد الطلبيات:'.$t['orders'].'</td>
          <td >رقم الكشف:'.$t['invoice'].'</td>
         </tr>
        </table>
        ');
    }
}
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('07822816693');
$pdf->SetTitle('تقرير الطلبيات');
$pdf->SetSubject($start."-".$end);
// set some language dependent data:
$lg = Array();
$lg['a_meta_charset'] = 'UTF-8';
$lg['a_meta_dir'] = 'rtl';
$lg['a_meta_language'] = 'ar';
$lg['w_page'] = 'page';

// set some language-dependent strings (optional)
$pdf->setLanguageArray($lg);
// set font
$pdf->SetFont('aealarabiya', '', 12);


//$pdf->SetHeaderData("../../../".$config['Company_logo'],30, ' اسم الصفحه او البيح: '.$total['store']."               "." الفترة الزمنية: ".date("Y-m-d",strtotime($start))." || ".date("Y-m-d",strtotime($end))," حالة الطلبات : ".$status_name."\n"."السعر الصافي للعميل: ".number_format($total['client_price'])."                "."\n"."عدد الطلبيات: ".$total['orders']." ");

// set header and footer fonts
$pdf->setHeaderFont(Array('aealarabiya', '', 12));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));


// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(5);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);



// ---------------------------------------------------------


// add a page
$pdf->AddPage('L', 'A4');

// Persian and English content

$htmlpersian = '		<table border="1" class="table" cellpadding="2">
			       <thead>
	  						<tr class="head-tr">
                                        <th  width="30">#</th>
                                        <th width="100">تاريخ الادخال</th>
										<th>رقم الوصل</th>
										<th width="120">هاتف المستلم</th>
										<th width="180">عنوان المستلم</th>
                                        <th>مبلغ الوصل</th>
										<th>المبلغ المستلم</th>
										<th>المبلغ الصافي للمندوب</th>
										<th>الحاله</th>
							</tr>
      	            </thead>
                            <tbody id="ordersTable">'
                            .$hcontent.
                            '</tbody>
		</table>
        ';
$pdf->WriteHTML($style.$htmlpersian, true, 0, true, 0);

// set LTR direction for english translation
$pdf->setRTL(false);

$pdf->SetFontSize(10);
// print newline
$pdf->Ln();
//Close and output PDF document
ob_end_clean();
//print_r($hcontent);

$pdf->Output(dirname(__FILE__).'/../driver_invoice/'.$pdf_name, 'F');
}else{
  $success = 2;
}
echo json_encode(['success'=>$success,'invoice'=>$pdf_name]);
?>