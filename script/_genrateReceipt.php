<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,2,3]);
$company = $_REQUEST['company'];
$number = $_REQUEST['number'];
$success = 0;
$msg="";
require_once("dbconnection.php");
require_once("_sendNoti.php");
require_once("../config.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;
if(empty($company)){
  $company = 0;
}
if($number <= 100 && $number > 1 ){
  $msg = "";
}else{
  $msg = "ادخل عدد بين 1-100";
}
$style= '
<style>
  .title {
    background-color: #FFFACD;
  }
  .head-tr {
   background-color: #ddd;
   color:#111;
  }
  .col-50 {
      position: relative;
      display: inline-block;
      width:180px;
  }
  .client {
        position: relative;
      display: inline-block;
      width:180px;
  }
  .albarq {
    color :red;

  }
</style>
';
if($msg == ""){
    $sql = "select max(order_no) as max FROM orders";
    $res = getData($con,$sql);
    $order_no = (int) $res[0]['max'];
    if($order_no > 0){
      for ($x = 1; $x <= $number; $x++) {
         $new_order_no = $order_no + $x;
         $sql = "insert into orders (company_id,order_no,confirm) values (?,?,?)";
         $res4 = setData($con,$sql,[$company,$new_order_no,2]);

         $sql = "select id from orders where order_no=? order by date DESC limit 1";
         $res5 = getData($con,$sql,[$new_order_no]);
         $ids[]=$res5[0]['id'];
      }
    }
}

require_once("../tcpdf/tcpdf.php");

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('07822816693');
$pdf->SetTitle('وصل');
$pdf->SetSubject('Receipt');
// set some language dependent data:


if($msg == ""){
$pdf_name = date('Y-m-d')."_".uniqid().".pdf";
$sql = "insert into company_receipt (path,company_id) values(?,?)";
$res = setData($con,$sql,[$pdf_name,$company]);
try{
      $sql = "select * from companies where id=?";
      $company_info = getData($con,$sql,[$company]);
      $company_info = $company_info[0];
      if(count($company_info) > 0){
        $logo = '../../../img/'.$company_info['logo'];
      }else{
        $logo = "../../../".$config['Company_logo'];
      }
  foreach($ids as $k=>$val) {
    $query = "select orders.*, date_format(orders.date,'%y-%m-%d') as date,
              clients.name as client_name,clients.phone as client_phone,
              cites.name as city,towns.name as town,branches.name as branch_name,
              stores.name as store_name
              from orders
              left join clients on clients.id = orders.client_id
              left join cites on  cites.id = orders.to_city
              left join stores on  stores.id = orders.store_id
              left join towns on  towns.id = orders.to_town
              left join branches on  branches.id = orders.to_branch
              where orders.id=?";

    $data = getData($con,$query,[$ids[$k]]);
    $data = $data[0];
    $success="1";
$lg = Array();
$lg['a_meta_charset'] = 'UTF-8';
$lg['a_meta_dir'] = 'rtl';
$lg['a_meta_language'] = 'ar';
$lg['w_page'] = 'page';

// set some language-dependent strings (optional)
$pdf->setLanguageArray($lg);
// set font
$pdf->SetFont('aealarabiya', '', 12);

// set default header data

      $pdf->SetHeaderData($logo,33,"");

      // set header and footer fonts
      $pdf->setHeaderFont(Array('aealarabiya', '', 12));
      //$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));


      // set margins
      $pdf->SetMargins(10, 30,10, 10);
      $pdf->SetHeaderMargin(5);
      //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
      // set auto page breaks
      $pdf->SetAutoPageBreak(TRUE, 5);

      // set image scale factor
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
  // add a page
$pdf->AddPage('P', 'A5');

  // Persian and English content
  $tbl = '
  <table  cellpadding="5">
      <tr>
      <td width="209">اسم السوق : '.$data['store_name'].'</td>
      <td width="209">هاتف : '.$data['client_phone'].'</td>
    </tr>
    <tr>
      <td width="209" >رقم الوصل : '.$data['order_no'].'</td>
      <td width="209">تاريخ : '.'   &nbsp;&nbsp; -   &nbsp;&nbsp;  -  &nbsp;&nbsp; 20'.'</td>
    </tr>
  </table>
  <br />
  <table  border="1" cellpadding="5">
      <tr>
      <td width="153" class="title">اسم الزبون</td>
      <td align="center" width="300"></td>
    </tr>
    <tr>
      <td width="153" class="title">هاتف الزبون</td>
      <td align="center" width="300"></td>
    </tr>
  </table>
  <br /><br />
  <table cellpadding="2" border="1">
      <tr>
          <td  align="center" class="title">العنوان</td>
      </tr>
      <tr>
          <td colspan="1" height="60" align="center"></td>
      </tr>
  </table>
  <br /><br />
  <table  border="1" cellpadding="5">
    <tr>
      <td colspan="6" class="title" align="center">تفاصيل الطلب</td>
    </tr>
    <tr>
      <td colspan="1"  class="title">النوع</td>
      <td colspan="1" align="center" ></td>
      <td colspan="1"  class="title">الوزن</td>
      <td colspan="1" align="center" ></td>
      <td colspan="1" class="title">العدد</td>
      <td colspan="1" align="center" ></td>
    </tr>
    <tr>
      <td colspan="1" class="title">ملاحظات</td>
      <td colspan="5" align="center" ></td>
    </tr>
    <tr>
      <td colspan="2"  class="title">المبلغ مع التوصيل</td>
      <td colspan="4" align="center"></td>
    </tr>
  </table>
  ';
  if($company > 0){
    $comp = $company_info['text1']."<br />".$company_info['text2'].
    "<br /><br /><span>* يسقط حق المطالبة بالوصال بعد مرور شهر من تاريخ الوصل </span>";
  }else{
  $comp = "
  <span>ﺍﻟﺸﺮﻛﻪ ﻣﺴﺠﻠﻪ ﻗﺎﻧﻮﻧﻴﺎ/ ﺭﻗﻢ ﺍﻟﺘﺴﺠﻴﻞ: ﻡ.ﺵ.ﺃ - 20 - 8807 &nbsp;&nbsp;&nbsp; ﺍﻟﺸﺮﻛﻪ ﻣﺴﺆﻭﻟﻪ ﻋﻦ ﺗﻮﺻﻴﻞ ﺍﻟﻄﻠﺒﺎﺕ ﻓﻘﻂ</span>
  <br /> <br />
  <span>ﺷﺮﻛﺔ ﺍﻟﺒﺮﻕ ﻟﻠﺘﻮﺻﻴﻞ ﺍﻟﺴﺮﻳﻊ, ﺍﻟﻔﺮﻉ ﺍﻟﺮﺋﻴﺴﻲ : ﺑﻐﺪﺍﺩ - ﺍﻟﻤﻨﺼﻮﺭ- ﺣﻲ ﺍﻟﻌﺮﺑﻲ </span>
  <span>078-780-0898 / 077-789-8898</span>
  <br />
  <span>فرع كركوك - فرع ديالى - فرع بابل - فرع كربلاء - فرع واسط - فرع ذي قار - فرع اربيل - فرع صلاح الدين - فرع الموصل</span>
  <br /><br />
  <span>* يسقط حق المطالبة بالوصال بعد مرور شهر من تاريخ الوصل </span>
  ";
  }
  $pdf->writeHTML($style.$tbl, true, false, false, false, '');

  $pdf->cell('','','توقيع العميل','');
  $pdf->Ln();
  $pdf->SetFont('aealarabiya', '', 10);
  $pdf->setRTL(true);

  $pdf->SetFontSize(10);
  // print newline
  $style2 = array(
      'position' => 'L',
      'align' => 'L',
      'stretch' => false,
      'fitwidth' => false,
      'cellfitalign' => '',
      'border' => false,
      'hpadding' => 'auto',
      'vpadding' => 'auto',
      'fgcolor' => array(0,0,0),
      'bgcolor' => "",
      'text' => true,
      'label' => $ids[$k],
      'font' => 'helvetica',
      'fontsize' => 12,
      'stretchtext' => 1
  );
  // CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
  $pdf->write1DBarcode($ids[$k], 'S25+', 0, '', 60, 20, 0.4, $style2, 'N');
  $pdf->SetTextColor(25,25,112);
  $pdf->SetFont('aealarabiya', '', 9);

  $pdf->writeHTML("<hr>".$comp, true, false, false, false, '');
  $pdf->SetTextColor(55,55,55);
  $pdf->setRTL(false);
  $pdf->SetFont('aealarabiya', '', 9);
  $del = "<br /><hr />Developed and Designed by <a href='http://alnahr.net/'>Ahal Adeqa</a> Company for IT Solutions <br /> 07822816693 , itpcentre@gamil.com, www.alnahr.net";
  $pdf->writeHTML($del, true, false, false, false, '');
  $pdf->write2DBarcode($ids[$k], 'QRCODE,M',0, 0, 30, 30, $style2, 'N');
  $style2['position'] = '';
  $pdf->write2DBarcode($ids[$k], 'QRCODE,M',70, 130, 30, 30, $style2, 'N');
 }


  } catch(PDOException $ex) {
     $data=["error"=>$ex];
     $success="0";
  }
  ob_end_clean();
  $pdf->Output(dirname(__FILE__).'/../companyReceipt/'.$pdf_name, 'F');
  $seccuss = 1;
}else{
   $seccuss = 0;
}



echo json_encode(['success'=>$success, 'msg'=>$msg]);
?>