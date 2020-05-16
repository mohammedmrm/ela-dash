<?php
if(file_exists("script/_access.php")){
require_once("script/_access.php");
access([1,2,3,5,6]);
}
?>
<?
include("config.php");
?>
<style>
fieldset {
		border: 1px solid #ddd !important;
		margin: 0;
		min-width: 0;
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
.success {
 background-color: #CCFFCC;
}
.danger {
background-color: #FFCCCC;
}
.warning{
background-color: #FFFF99;
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
				الفواتير
			</h3>
		</div>
	</div>


	<div class="kt-portlet__body">
    <form id="orderstabledata" class="kt-form kt-form--fit kt-margin-b-20">
          <fieldset><legend>اضافة طلب</legend>
          <div class="row kt-margin-b-20">
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>رقم الشحنه:</label>
            	<input type="text" class="form-control" id="orderId" name="orderId"/>
            </div>
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>اضافه:</label><br />
            	<button type="button" onclick="getOrder($('#orderId').val());" type="text" class="btn btn-success" value="" placeholder="" data-col-index="0">اضافه
                    <span id="search"  role="status"></span>
                </button>
            </div>
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>ادخال للمخزن المحافظه:</label><br />
            	<button type="button" onclick="setOrterToCityStore()" type="text" class="btn btn-success" value="" placeholder="" data-col-index="0">ادخال
                    <span id="search"  role="status"></span>
                </button>
            </div>
            <div class="col-lg-4 kt-margin-b-10-tablet-and-mobile">
            	<label class="text-danger" id="msg"></label>
            </div>
          <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>
          </div>
          </fieldset>

		<!--begin: Datatable -->
        <div class="" id="section-to-print">
		<table class="table  table-bordered  responsive no-wrap" id="tb-orders">
			       <thead>
	  						<tr>
        						<th>#</th>
        						<th>رقم الوصل</th>
        						<th>اسم الصفحه</th>
        						<th>اسم العميل</th>
        						<th>رقم هاتف العميل</th>
        						<th>التاريخ</th>
        						<th>عدد القطع</th>
        						<th>المبلغ المستلم</th>
        						<th>تعديل</th>
		  					</tr>
      	            </thead>
                    <tbody id="ordersTable">
                    </tbody>
                            <tfoot>
	           </tfoot>
		</table>
        <div class="kt-section__content kt-section__content--border">
		<nav aria-label="...">
			<ul class="pagination" id="pagination">

			</ul>
        <input type="hidden" id="p" name="p" value="<?php if(!empty($_GET['p'])){ echo $_GET['p'];}else{ echo 1;}?>"/>
		</nav>
     	</div>
        </div>
        </form>
        <!--end: Datatable -->
	</div>

</div>

</div>
<!-- end:: Content -->
</div>

            <!--begin::Page Vendors(used by this page) -->
                            <script src="assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
                        <!--end::Page Vendors -->



            <!--begin::Page Scripts(used by this page) -->
                            <script src="assets/js/demo1/pages/components/datatables/extensions/responsive.js" type="text/javascript"></script>
<script src="js/getClients.js" type="text/javascript"></script>
<script src="js/scanner-jquery.js" type="text/javascript"></script>
<script type="text/javascript">
function getOrder(id){
$.ajax({
  url:"script/_getOrderById.php",
  type:"POST",
  beforeSend:function(){
  },
  data:{id: id},
  success:function(res){
   console.log(res);
   $("#orderId").val("");
   if(res.success == 1){
   $.each(res.data,function(){
     $("#ordersTable").append(
       '<tr id="ordereNumber'+this.id+'">'+
            '<td>'+this.id+'</td>'+
            '<td>'+this.order_no+'</td>'+
            '<td>'+this.store_name+'</td>'+
            '<td>'+this.client_name+'</td>'+
            '<td>'+this.client_phone+'</td>'+
            '<td>'+this.date+'</td>'+
            '<td>'+this.qty+'</td>'+
            '<td>'+this.new_price+'</td>'+
            '<td>'+
                '<button type="button" class="btn btn-clean btn-link text-danger" onclick="deleteOrder('+this.id+')" data-toggle="modal" data-target="#deleteOrderModal"><span class="flaticon-delete"></sapn></button>'+
                '<input type="hidden" name="ids[]" value="'+this.id+'"/>'+
            '</td>'+
        '</tr>');
     });
     Toast.success("تم الاضافه");
   }else {
     Toast.error("خطأ");
   }

     },
   error:function(e){
   console.log(e);
  }
});
}
$(document).scannerDetection({
	timeBeforeScanTest: 200, // wait for the next character for upto 200ms
	startChar: [120], // Prefix character for the cabled scanner (OPL6845R)
	endChar: [13], // be sure the scan is complete if key 13 (enter) is detected
	avgTimeByChar: 40, // it's not a barcode if a character takes longer than 40ms
	onComplete: function(barcode, qty){
	  getOrder(Number(barcode));
     } // main callback function
});
$(document).keypress(function(event) {
if (event.which === 13 || event.keyCode === 13) {
    event.stopPropagation();
    event.preventDefault();
    getOrder($("#orderId").val());
}
});
function deleteOrder(id){
 $("#ordereNumber"+id).remove();
}
function setOrterToCityStore(){
	  $.ajax({
           url:"script/_setOrterToCityStore.php",
           data:$("#orderstabledata").serialize(),
           type:"POST",
           success:function(res){
            console.log(res)
            if(res.success == 1){
              Toast.success("تم احاله الشحنات الى المخزن");
              $("#ordersTable").html("");
            }else{
              $("#msg").text(res.msg);
            }
           },
           error:function(e){
             console.log(e);
           },
         })

}
</script>