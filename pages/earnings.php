<?php
if(file_exists("script/_access.php")){
require_once("script/_access.php");
access([1,2,5]);
}
?>
<style>
</style>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="Quick actions" data-placement="top">

                </div>
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
				تقرير الارباح
			</h3>
		</div>
	</div>

	<div class="kt-portlet__body">
		<!--begin: Datatable -->
    <div class="row">



                <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                <label>الفترة الزمنية :</label>
                <div class="input-daterange input-group" id="kt_datepicker">
      				<input value="<?php echo date('Y-m-d',strtotime(date('Y-m-d'). ' - 7 day'));?>" onchange="updateDash()" type="text" class="form-control kt-input" name="start" id="start" placeholder="من" data-col-index="5">
      				<div class="input-group-append">
      					<span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
      				</div>
      				<input onchange="updateDash()" type="text" class="form-control kt-input" name="end"  id="end" placeholder="الى" data-col-index="5">
              	</div>
                </div>
                <div class="col-lg-6 kt-margin-b-10-tablet-and-mobile"></div>
                <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                    <label>الفترة الزمنية: <label class="" id="total_peroid"></label></label><br />
                    <label>مجموع الارباح: <label class="text-success" id="total_earnings"></label></label><br />
                    <label>مجموع صافي العملاء: <label class="text-danger" id="total_client_price"></label></label><br />
                    <label>مجموع الخصم: <label class="text-warning" id="total_discount"></label></label><br />
                    <label>عدد الطلبيات: <label class="text-info" id="total_orders"></label></label><br />
                </div>

     </div>
     <div class="row"><hr /> </div>
		<table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="tb-getEarnings">
			       <thead>
	  						<tr>
								<th>ID</th>
								<th>الفرع</th>
								<th>اسم العميل</th>
								<th>رقم الهاتف</th>
								<th>عدد الطلبات</th>
								<th>مجموع الخصم</th>
								<th>الدخل الكلي</th>
								<th>صافي التوصيل</th>
								<th>الصافي للعميل</th>
		  					</tr>
      	            </thead>
                    <tbody id="getEarningsTable">
                    </tbody>
                    <tfoot>
	  						<tr>
								<th>ID</th>
								<th>الفرع</th>
								<th>اسم العميل</th>
								<th>رقم الهاتف</th>
								<th>عدد الطلبات</th>
								<th>مجموع الخصم</th>
								<th>الدخل الكلي</th>
								<th>صافي التوصيل</th>
								<th>الصافي للعميل</th>
		  					</tr>
	              </tfoot>
		</table>
		<!--end: Datatable -->
	</div>
</div>	</div>
<!-- end:: Content -->				</div>


            <!--begin::Page Vendors(used by this page) -->
                            <script src="assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
                        <!--end::Page Vendors -->



            <!--begin::Page Scripts(used by this page) -->
                            <script src="assets/js/demo1/pages/components/datatables/extensions/responsive.js" type="text/javascript"></script>
                       <script type="text/javascript">
$( document ).ready(function(){
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
getEarnings($("#getEarningsTable"));
});
function getEarnings(elem){
$.ajax({
  url:"script/_getEarnings.php",
  type:"POST",
  data: {start:$("#start").val(),end:$("#end").val()},
  success:function(res){
   $("#tb-getEarnings").DataTable().destroy();
   console.log(res);
   elem.html("");
   $("#total_peroid").text(res.total[0].start+" || "+res.total[0].end);
   $("#total_earnings").text(formatMoney(res.total[0].earnings));
   $("#total_discount").text(formatMoney(res.total[0].discount));
   $("#total_client_price").text(formatMoney(res.total[0].client_price));
   $("#total_orders").text(formatMoney(res.total[0].orders));
   $.each(res.data,function(){
     elem.append(
       '<tr>'+
            '<td></td>'+
            '<td>'+this.branch_name+'</td>'+
            '<td>'+this.name+'</td>'+
            '<td>'+this.phone+'</td>'+
            '<td>'+this.orders+'</td>'+
            '<td>'+formatMoney(this.discount)+'</td>'+
            '<td>'+formatMoney(this.income)+'</td>'+
            '<td class="text-success">'+formatMoney(this.earnings)+'</td>'+
            '<td class="text-danger">'+formatMoney(this.client_price)+'</td>'+
       '</tr>');
     });
     var myTable= $('#tb-getEarnings').DataTable({
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
        ],
        className: 'select-checkbox',
        targets: 0,
        "oLanguage": {
        "sLengthMenu": "عرض_MENU_سجل",
        "sSearch": "بحث:" ,
        select: {
        style: 'os',
        selector: 'td:first-child'
    }
      }
});
    },
   error:function(e){
    console.log(e);
  }
});
}
function updateDash() {
getEarnings($("#getEarningsTable"));
}
</script>
