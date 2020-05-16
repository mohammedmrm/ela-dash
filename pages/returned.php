<?php
if(file_exists("script/_access.php")){
require_once("script/_access.php");
access([1,2]);
}
?>
<?
include("config.php");
?>
<style>
fieldset {
		border: 1px solid #ddd !important;
		margin: 0;
		xmin-width: 0;
		padding: 10px;
		position: relative;
		border-radius:4px;
		background-color:#f5f5f5;
		padding-left:10px !important;
		width:100%;
}
legend
{
	font-size:14px;
	font-weight:bold;
	margin-bottom: 0px;
	width: 55%;
	border: 1px solid #ddd;
	border-radius: 4px;
	padding: 5px 5px 5px 10px;
	background-color: #ffffff;
}
@media print {
  body * {
    visibility: hidden;

  }
  #printReportForm, .header{
    display: none;
  }

  #section-to-print, #section-to-print * {
    visibility: visible;
    color: #000000;

  }
  #section-to-print {
    //position: absolute;
    margin:0px;
    padding: 0px;
    left: 0;

  }
  .dele, .edit{
   visibility: hidden;
   display: none;
  }
}
.text-white {
  color: #FFFFFF;
  padding: 15px;
  font-size: 18px;
}

@page {
  size: landscape;
  margin: 5mm 5mm 5mm 5mm;
  }
</style>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">

            </div>
        </div>
    </div>
</div>
<!-- end:: Subheader -->
					<!-- begin:: Content -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
				الطلبات الراجعة
			</h3>
		</div>
	</div>


	<div class="kt-portlet__body">
    <form id="ordertabledata" class="kt-form kt-form--fit kt-margin-b-20">
          <fieldset><legend>فلتر</legend>
          <div class="row kt-margin-b-20">
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>الفرع:</label>
            	<select onchange="getclient()" class="form-control kt-input" id="branch" name="branch" data-col-index="6">
            	</select>
            </div>
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>العميل:</label>
            	<select onchange="getorders()" data-show-subtext="true" data-live-search="true"  class="selectpicker form-control kt-input" id="client" name="client" data-col-index="7">
            		<option value="">Select</option>
            	</select>
            </div>
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>الحالة:</label>
            	<select onchange="getorders()" class="form-control kt-input" id="orderStatus" name="orderStatus" data-col-index="7">
            		<option value="">Select</option>
            	</select>
            </div>
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>المحافظة المرسل لها:</label>
            	<select id="city" name="city" onchange="getorders()" class="form-control kt-input" data-col-index="2">
            		<option value="">Select</option>
                </select>
            </div>
            <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
            <label>الفترة الزمنية :</label>
            <div class="input-daterange input-group" id="kt_datepicker">
  				<input value="<?php echo date('Y-m-d');?>" onchange="getorders()" type="text" class="form-control kt-input" name="start" id="start" placeholder="من" data-col-index="5">
  				<div class="input-group-append">
  					<span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
  				</div>
  				<input onchange="getorders()" type="text" class="form-control kt-input" name="end"  id="end" placeholder="الى" data-col-index="5">
          	</div>
            </div>
          </div>
          <div class="row kt-margin-b-20">
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>رقم الوصل:</label>
            	<input id="order_no" name="order_no" onkeyup="getorders()" type="text" class="form-control kt-input" placeholder="" data-col-index="0">
            </div>
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>اسم او هاتف المستلم:</label>
            	<input name="customer" onkeyup="getorders()" type="text" class="form-control kt-input" placeholder="" data-col-index="1">
            </div>
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>حالة تسليم المبلغ للعميل:</label>
                <select name="money_status" onchange="getorders()" class="form-control kt-input" data-col-index="2">
            		<option value="">... اختر...</option>
            		<option value="1">تم تسليم المبلغ</option>
            		<option value="0">لم يتم تسليم المبلغ</option>
                </select>
            </div>
<!--            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>السعر التوصيل(بغداد):</label>
            	<input value="<?php echo $config['dev_b'];?>" step="50" id="dev_b" name="dev_b" onchange="getorders()" onkeyup="getorders()" type="number" class="form-control kt-input" placeholder="" data-col-index="0">
            </div>
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>السعر التوصيل(محافظات):</label>
            	<input value="<?php echo $config['dev_o'];?>" step="50" id="dev_o" name="dev_o" onchange="getorders()" onkeyup="getorders()" type="number" class="form-control kt-input" placeholder="" data-col-index="0">
            </div>
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>الخصم:</label>
            	<input value="0.0" step="50" id="discount" name="discount" onchange="getorders()" onkeyup="getorders()" type="number" class="form-control kt-input" placeholder="" data-col-index="0">
            </div>-->
          <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>
          </div>
          </fieldset>
        </form>
		<!--begin: Datatable -->
        <div class="" id="section-to-print">
          <div class="row kt-margin-b-20 text-white bg-danger" id="total-section">
               <div class="col-sm-6 kt-margin-b-10-tablet-and-mobile">
                 <div class="row kt-margin-b-20">
                    <label>العميل: </label><label id="total-client">لم يتم تحديد عميل</label>
                 </div>
                 <div class="row">
                    <label>السعر الصافي: </label><label id="total-price">0.0</label>
                 </div>
               </div>
               <div class="col-sm-6 kt-margin-b-10-tablet-and-mobile">
                   <div class="row kt-margin-b-20">
                    <label>مجوع الخصم: </label><label id="total-discount">0.0</label>
                   </div>
                   <div class="row kt-margin-b-20">
                    <label>عدد الطلبات: </label><label id="total-orders">0</label>
                   </div>
               </div>
          </div>
		<table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="tb-orders">
			       <thead>
	  						<tr>
										<th>#</th>
										<th>رقم الوصل</th>
										<th>من الفرع</th>
                                        <th>اسم العميل</th>
										<th>رقم هاتف العميل</th>
										<th>اسم المستلم</th>
										<th>رقم هاتف المستلم</th>
										<th>عنوان الارسال</th>
                                        <th>حالة السعر</th>
                                        <th>التاريخ</th>
										<th>مبلغ الوصل</th>
                                        <th>المبلغ المستلم</th>
										<th>سعر التوصيل</th>
										<th>الخصم</th>
										<th>السعر الصافي للعميل</th>
		  					</tr>
      	            </thead>
                            <tbody id="ordersTable">
                            </tbody>
                            <tfoot>
	                <tr>
										<th>#</th>
										<th>رقم الوصل</th>
										<th>من الفرع</th>
                                        <th>اسم العميل</th>
										<th>رقم هاتف العميل</th>
										<th>اسم المستلم</th>
										<th>رقم هاتف المستلم</th>
										<th>عنوان الارسال</th>
                                        <th>حالة السعر</th>
                                        <th>التاريخ</th>
										<th>مبلغ الوصل</th>
                                        <th>المبلغ المستلم</th>
										<th>سعر التوصيل</th>
										<th>الخصم</th>
										<th>السعر الصافي للعميل</th>
					</tr>
	           </tfoot>
		</table>
        </div>
        <input type="button" class="btn text-center btn-danger" onclick="window.print()" value="طباعة" />
		<!--end: Datatable -->
	</div>

</div>	</div>
<!-- end:: Content -->				</div>


            <!--begin::Page Vendors(used by this page) -->
                            <script src="assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
                        <!--end::Page Vendors -->



            <!--begin::Page Scripts(used by this page) -->
                            <script src="assets/js/demo1/pages/components/datatables/extensions/responsive.js" type="text/javascript"></script>
<script src="js/getBraches.js" type="text/javascript"></script>
<script src="js/getClients.js" type="text/javascript"></script>
<script src="js/getorderStatus.js" type="text/javascript"></script>
<script src="js/getCities.js" type="text/javascript"></script>
<script type="text/javascript">
function getorders(){
$.ajax({
  url:"script/_getReturnedOrders.php",
  type:"POST",
  data:$("#ordertabledata").serialize(),
  beforeSend:function(){
    $("#section-to-print").addClass('loading');
  },
  success:function(res){
   $("#section-to-print").removeClass('loading');
   console.log(res);
   $("#tb-orders").DataTable().destroy();
   $("#ordersTable").html("");

   $("#total-client").html(res.total[0].client);
   $("#total-price").text(formatMoney(res.total[0].client_price));
   $("#total-discount").text(formatMoney(res.total[0].discount));
   $("#total-orders").text(res.total[0].orders);

   $.each(res.data,function(){
     if(this.money_status == 1){
       money = '<td class="bg-success">'+this.money_status+'</td>';
     }else{
       money = '<td>'+this.money_status+'</td>';
     }

     $("#ordersTable").append(
       '<tr>'+
            '<td></td>'+
            '<td>'+this.order_no+'</td>'+
            '<td>'+this.from_branch+'</td>'+
            '<td>'+this.client_name+'</td>'+
            '<td>'+this.client_phone+'</td>'+
            '<td>'+this.customer_name+'</td>'+
            '<td>'+this.customer_phone+'</td>'+
            '<td>'+this.city+'/'+this.town+'</td>'+
             money +
            '<td>'+this.date+'</td>'+
            '<td>'+formatMoney(this.price)+'</td>'+
            '<td>'+formatMoney(this.new_price)+'</td>'+
            '<td>'+formatMoney(this.dev_price)+'</td>'+
            '<td>-'+formatMoney(this.discount)+'</td>'+
            '<td>'+formatMoney(this.client_price)+'</td>'+
        '</tr>');
     });

     var myTable= $('#tb-orders').DataTable({
     columns:[
    //"dummy" configuration
        { visible: true }, //col 1
        { visible: true }, //col 2
        { visible: true }, //col 3
        { visible: true }, //col 4
        { visible: true }, //col 5
        { visible: true }, //col 6
        { visible: true }, //col 7
        { visible: true }, //col 8
        { visible: true }, //col 9
        { visible: true }, //col 10
        { visible: true }, //col 11
        { visible: true }, //col 12
        { visible: true }, //col 13
        { visible: true }, //col 14
        { visible: true }, //col 15
        ],
      "oLanguage": {
        "sLengthMenu": "عرض_MENU_سجل",
        "sSearch": "بحث:"
      },
       "bPaginate": false,
       "bLengthChange": false,
       "bFilter": false,
       serverPaging: true
      });
    },
   error:function(e){
    $("#section-to-print").removeClass('loading');
    console.log(e);
  }
});
}

function getclient(){
 getClients($("#client"),$("#branch").val());
 getorders();
}
$( document ).ready(function(){
getorders($("#ordersTable"));
$("#allselector").change(function() {
    var ischecked= $(this).is(':checked');
    if(!ischecked){
      $('input[name="id\[\]"]').attr('checked', false);;
    }else{
      $('input[name="id\[\]"]').attr('checked', true);;
    }
});
$('#start').datepicker({
    format: "yyyy-mm-dd",
    showMeridian: true,
    todayHighlight: true,
    autoclose: true,
    pickerPosition: 'bottom-left',
    defaultDate:'now'
});
$('#end').datepicker({
    format: "yyyy-mm-dd",
    showMeridian: true,
    todayHighlight: true,
    autoclose: true,
    pickerPosition: 'bottom-left',
    defaultDate:'now'
});
getBraches($("#branch"));
getorderStatus($("#orderStatus"));
getorderStatus($("#status_action"));
getCities($("#city"));

});
</script>