<?php
ob_start();
session_start();
error_reporting(0);
require("_access.php");
access([1,2,3,5]);
require_once("dbconnection.php");
$style= <<<EOF
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
EOF;
require("../config.php");

$id = $_REQUEST['id'];


try{
  $query = "select orders.*,date_format(orders.date,'%Y-%m-%d') as date,
            clients.name as client_name,clients.phone as client_phone,
            cites.name as city,towns.name as town,branches.name as branch_name,
            stores.name as store_name,
            if(companies.logo is null,'logos/logo.png',companies.logo) as logo,
            companies.text1 as text1,
            companies.text2 as text2,orders.company_id as com_id
            from orders left join
            clients on clients.id = orders.client_id
            left join cites on  cites.id = orders.to_city
            left join towns on  towns.id = orders.to_town
            left join stores on  stores.id = orders.store_id
            left join branches on  branches.id = orders.to_branch
            left join companies on  companies.id = orders.company_id
            where orders.id = ?";

  $data = getData($con,$query,[$id]);
  $data = $data[0];
  $success="1";


} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}


require_once("../tcpdf/tcpdf.php");

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('07822816693');
$pdf->SetTitle('وصل');
$pdf->SetSubject('Receipt');
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

// set default header data
if($data['com_id'] != 0){
  $logo = '../../../img/'.$data['logo'];
}else{
  $logo = "../../../".$config['Company_logo'];
}
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



// ---------------------------------------------------------


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
    <td width="209">تاريخ : '.$data['date'].'</td>
  </tr>
</table>
<br />
<table  border="1" cellpadding="5">
    <tr>
    <td width="153" class="title">اسم الزبون</td>
    <td align="center" width="300">'.$data['customer_name'].'</td>
  </tr>
  <tr>
    <td width="153" class="title">هاتف الزبون</td>
    <td align="center" width="300">'.$data['customer_phone'].'</td>
  </tr>
</table>
<br /><br />
<table cellpadding="2" border="1">
    <tr>
        <td  align="center" class="title">العنوان</td>
    </tr>
    <tr>
        <td colspan="1" height="60" align="center">'.$data['city'].' - '.$data['town'].' - '.$data['address'].'</td>
    </tr>
</table>
<br /><br />
<table  border="1" cellpadding="5">
  <tr>
    <td colspan="6" class="title" align="center">تفاصيل الطلب</td>
  </tr>
  <tr>
    <td colspan="1"  class="title">النوع</td>
    <td colspan="1" align="center" >'.$data['order_type'].'</td>
    <td colspan="1"  class="title">الوزن</td>
    <td colspan="1" align="center" >'.$data['weight'].' كغم</td>
    <td colspan="1" class="title">العدد</td>
    <td colspan="1" align="center" >'.$data['qty'].'</td>
  </tr>
  <tr>
    <td colspan="1" class="title">ملاحظات</td>
    <td colspan="5" align="center" >'.$data['note'].'</td>
  </tr>
  <tr>
    <td colspan="2"  class="title">المبلغ مع التوصيل</td>
    <td colspan="4" align="center">'.number_format($data['price']).' دينار</td>
  </tr>
</table>
';
if($data['com_id'] != 0){
$comp = $data['text1']."<br />".$data['text2'].
"<br /><br /><span>* يسقط حق المطالبة بالوصال بعد مرور شهر من تاريخ الوصل </span>";
}else{
$comp = "
<span>ﺍﻟﺸﺮﻛﻪ ﻣﺴﺠﻠﻪ ﻗﺎﻧﻮﻧﻴﺎ/ ﺭﻗﻢ ﺍﻟﺘﺴﺠﻴﻞ: ﻡ.ﺵ.ﺃ - 20 - 7088 &nbsp;&nbsp;&nbsp; ﺍﻟﺸﺮﻛﻪ ﻣﺴﺆﻭﻟﻪ ﻋﻦ ﺗﻮﺻﻴﻞ ﺍﻟﻄﻠﺒﺎﺕ ﻓﻘﻂ</span>
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
$htmlpersian = $hcontent;
$pdf->cell('','','توقيع العميل','');
$pdf->Ln();
$pdf->SetFont('aealarabiya', '', 10);
//$pdf->writeHTML($style.$comp, true, false, false, false, '');
// set LTR direction for english translation
$pdf->setRTL(true);

$pdf->SetFontSize(10);
// print newline
$style = array(
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
    'label' => $id,
    'font' => 'helvetica',
    'fontsize' => 12,
    'stretchtext' => 1
);
// CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
$pdf->write1DBarcode($id, 'S25+', 0, '', 60, 20, 0.4, $style, 'N');
$pdf->SetTextColor(25,25,112);
$pdf->SetFont('aealarabiya', '', 9);

$pdf->writeHTML("<hr>".$comp, true, false, false, false, '');
$pdf->SetTextColor(55,55,55);
$pdf->setRTL(false);
$pdf->SetFont('aealarabiya', '', 9);
$del = "<br /><hr />Developed and Designed by <a href='http://alnahr.net/'>Ahal Adeqa</a> Company for IT Solutions <br /> 07822816693 , itpcentre@gamil.com, www.alnahr.net";
$pdf->writeHTML($del, true, false, false, false, '');
$pdf->write2DBarcode($id, 'QRCODE,M',0, 0, 30, 30, $style, 'N');
$style['position'] = '';
$pdf->write2DBarcode($id, 'QRCODE,M',70, 130, 30, 30, $style, 'N');



//Close and output PDF document
ob_end_clean();
//print_r($hcontent);
$pdf->Output('Receipt'.date('Y-m-d h:i:s').'.pdf', 'I');
?>