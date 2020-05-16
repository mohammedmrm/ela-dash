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
				تقرير الطبات
			</h3>
		</div>
	</div>


	<div class="kt-portlet__body">
    <form id="ordertabledata" class="kt-form kt-form--fit kt-margin-b-20">
          <fieldset><legend>تعديل او حذف طلبية</legend>
          <div class="row kt-margin-b-20">
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>رقم الوصل:</label>
            	<input id="order_no" name="order_no"  type="text" class="form-control kt-input" placeholder="" data-col-index="0">
            </div>
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>بحث:</label><br />
            	<button type="button" onclick="getorder()" type="text" class="btn btn-success" value="" placeholder="" data-col-index="0">بحث
                    <span id="search"  role="status"></span>
                </button>
            </div>
          <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>
          </div>
          </fieldset>

		<!--begin: Datatable -->
        <div class="" id="section-to-print">
		<table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="tb-orders">
			       <thead>
	  						<tr>
										<th>#</th>
										<th>رقم الوصل</th>
										<th>اسم العميل</th>
										<th>رقم هاتف العميل</th>
										<th>اسم المستلم</th>
										<th>رقم هاتف المستلم</th>
										<th>الفرع المرسل له</th>
										<th>عنوان الارسال</th>
                                        <th>حالة السعر</th>
                                        <th>التاريخ</th>
										<th>مع التوصيل</th>
										<th>سعر التوصيل</th>
										<th>المبلغ المستلم</th>
										<th>الخصم</th>
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
<div class="modal fade" id="editOrderModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">تعديل الطلب</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
		<div class="kt-portlet">

			<!--begin::Form-->
			<form class="kt-form" id="editOrderForm">
				<div class="kt-portlet__body">
                    <div class="form-group">
						<label>رقم الطلب:</label>
						<input type="name" id="e_order_no" name="e_order_no" class="form-control"  placeholder="">
						<span class="form-text  text-danger" id="e_order_no_err"></span>
					</div>
                    <div class="form-group">
						<label>السعر:</label>
						<input type="name" id="e_price" name="e_price" class="form-control"  placeholder="">
						<span class="form-text  text-danger" id="e_price_err"></span>
					</div>
                  <div class="form-group">
  						<label>نوع الطلب:</label>
  						<select data-show-subtext="true" data-live-search="true" type="text" class="selectpicker form-control dropdown-primary" name="e_order_type" id="e_order_type"  value="">
                          <option value="عام">عامة</option>
                          <option value="ملابس">ملابس</option>
                          <option value="الكترونيات">الكترونيات</option>
                          <option value="وثائق">وثائق</option>
                          <option value="اثاث">اثاث</option>
                         </select>
                          <span class="form-text text-danger" id="e_order_type_err"></span>
  				</div>
                  <div class="form-group">
  						<label>الوزن:</label>
  						<input type="number" id="e_weight" name="e_weight" class="form-control"  placeholder="">
  						<span class="form-text text-danger" id="e_weight_err"></span>
  				</div>
                  <div class="form-group">
  						<label>العدد:</label>
  						<input type="number" id="e_qty" name="e_qty" class="form-control"  placeholder="">
  						<span class="form-text text-danger" id="e_qty_err"></span>
  				</div>
                  <div class="form-group">
  						<label>الفرع:</label>
  						<select onchange="updateClient()" data-show-subtext="true" data-live-search="true" type="text" class="selectpicker form-control dropdown-primary" name="e_branch" id="e_branch"  value="">
                          </select>
                          <span class="form-text text-danger" id="e_branch_err"></span>
  				</div>
                  <div class="form-group">
  						<label>العميل:</label>
  						<select data-show-subtext="true" data-live-search="true" type="text" class="selectpicker form-control dropdown-primary" name="e_client" id="e_client"  value="">
                          </select>
                          <span class="form-text text-danger" id="e_client_err"></span>
  				</div>
                  <div class="form-group">
  						<label>اسم المستلم:</label>
  						<input type="text" id="e_customer_name" name="e_customer_name" class="form-control"  placeholder="">
  						<span class="form-text text-danger" id="e_customer_name_err"></span>
  				</div>
                  <div class="form-group">
  						<label>اسم المستلم:</label>
  						<input type="text" id="e_customer_phone" name="e_customer_phone" class="form-control"  placeholder="">
  						<span class="form-text text-danger" id="e_customer_phone_err"></span>
  				</div>
                  <div class="form-group">
  						<label>المحافظة:</label>
  						<select onchange="updateTown()" data-show-subtext="true" data-live-search="true" type="text" class="selectpicker form-control dropdown-primary" name="e_city" id="e_city"  value="">
                          </select>
                          <span class="form-text text-danger" id="e_city_err"></span>
  				</div>
                  <div class="form-group">
  						<label>المدينة(القضاء او الحي):</label>
  						<select data-show-subtext="true" data-live-search="true" type="text" class="selectpicker form-control dropdown-primary" name="e_town" id="e_town"  value="">
                          </select>
                          <span class="form-text text-danger" id="e_town_err"></span>
  				</div>
                  <div class="form-group">
  						<label>الفرع المرسل له:</label>
  						<select data-show-subtext="true" data-live-search="true" type="text" class="selectpicker form-control dropdown-primary" name="e_branch_to" id="e_branch_to"  value="">
                          </select>
                          <span class="form-text text-danger" id="e_branch_to_err"></span>
  				</div>
                  <div class="form-group">
      				<label>ملاحظات</label>
      				<textarea type="text" class="form-control" id="e_order_note" name="e_order_note" value=""></textarea>
      				<span id="e_order_note_err" class="form-text text-danger"></span>
      			</div>
                </div>
	            <div class="kt-portlet__foot kt-portlet__foot--solid">
					<div class="kt-form__actions kt-form__actions--right">
						<button type="button" onclick="updateOrder()" class="btn btn-brand">حفظ التغيرات</button>
						<button type="reset" data-dismiss="modal" class="btn btn-secondary">الغاء</button>
					</div>
				</div>
                <input type="hidden" name="e_Orderid" id="editOrderid"/>
			</form>
			<!--end::Form-->
		</div>
		<!--end::Portlet-->
        </div>
      </div>

    </div>
  </div>
<div class="modal fade" id="trackOrderModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">حالة الطلب</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
<div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">تتبع الطلبية</h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kt-scroll ps ps--active-y" data-scroll="true" data-mobile-height="764" style="">
                    <!--Begin::Timeline -->
                    <div class="kt-timeline" id="orderTimeline">
                    </div>
                    <!--End::Timeline 1 -->
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 946px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 300px;"></div></div></div>
            </div>
        </div>
        <!--end::Portlet-->
        </div>
      </div>

    </div>
  </div>

            <!--begin::Page Vendors(used by this page) -->
                            <script src="assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
                        <!--end::Page Vendors -->



            <!--begin::Page Scripts(used by this page) -->
                            <script src="assets/js/demo1/pages/components/datatables/extensions/responsive.js" type="text/javascript"></script>
<script src="js/getBraches.js" type="text/javascript"></script>
<script src="js/getClients.js" type="text/javascript"></script>
<script src="js/getorderStatus.js" type="text/javascript"></script>
<script src="js/getDrivers.js" type="text/javascript"></script>
<script src="js/getCities.js" type="text/javascript"></script>
<script src="js/getTowns.js" type="text/javascript"></script>
<script type="text/javascript">
function getorder(){
$.ajax({
  url:"script/_getOrder1.php",
  type:"POST",
  beforeSend:function(){
   $("#search").addClass('spinner-grow');
  },
  data:$("#ordertabledata").serialize(),
  success:function(res){
     $("#search").removeClass('spinner-grow');
   console.log(res);
   $("#tb-orders").DataTable().destroy();
   $("#ordersTable").html("");

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
            '<td>'+this.client_name+'</td>'+
            '<td>'+this.client_phone+'</td>'+
            '<td>'+this.customer_name+'</td>'+
            '<td>'+this.customer_phone+'</td>'+
            '<td>'+this.to_branch+'</td>'+
            '<td>'+this.city+'/'+this.town+'<br />'+this.address+'</td>'+
            money +
            '<td>'+this.date+'</td>'+
            '<td>'+this.with_dev+'</td>'+
            '<td>'+this.dev_price+'</td>'+
            '<td>'+this.new_price+'</td>'+
            '<td>-'+this.discount+'</td>'+
            '<td>'+
                '<button type="button" class="btn btn-clean btn-link" onclick="editOrder('+this.id+')" data-toggle="modal" data-target="#editOrderModal"><span class="flaticon-edit"></sapn></button>'+
                '<button type="button" class="btn btn-clean btn-link text-danger" onclick="deleteOrder('+this.id+')" data-toggle="modal" data-target="#deleteOrderModal"><span class="flaticon-delete"></sapn></button>'+
                '<button type="button" class="btn btn-clean btn-link" onclick="OrderTracking('+this.id+')" data-toggle="modal" data-target="#trackOrderModal"><span class="flaticon-information"></sapn></button>'+
            '</td>'+
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
      });
    },
   error:function(e){
      $("#search").removeClass('spinner-grow');
   console.log(e);
  }
});
}

function editOrder(id){
  $("#editOrderid").val(id);
  getBraches($("#e_branch"));
  getBraches($("#e_branch_to"));
  getCities($("#e_city"));
  $.ajax({
    url:"script/_getOrder.php",
    data:{id: id},
    success:function(res){
      console.log(res);
      if(res.success == 1){
        $.each(res.data,function(){
          $('#e_order_no').val(this.order_no);
          $('#e_price').val(this.price);
          $('#e_customer_phone').val(this.customer_phone);
          $('#e_customer_name').val(this.customer_name);
          $('#e_order_type').selectpicker('val', this.order_type);
          $('#e_city').selectpicker('val', this.to_city);
          $('#e_branch').selectpicker('val', this.from_branch);
          getTowns($('#e_town'),$('#e_city').val());
          getClients($('#e_client'),$('#e_branch').val());
          $("#e_weight").val(this.weight);
          $("#e_qty").val(this.qty);
          $("#e_order_note").val(this.note);
          $('#e_client').selectpicker('val', this.client_id);
          $('#e_town').selectpicker('val', this.to_town);
          $('#e_branch_to').selectpicker('val', this.to_branch);
        });
      }
    },
    error:function(e){
      console.log(e);
    }
  });
}
function updateClient(){
 getClients($('#e_client'),$('#e_branch').val());
}
function updateTown(){
 getTowns($('#e_town'),$('#e_city').val());
}
function updateOrder(){
  $.ajax({
    url:"script/_updateOrder.php",
    type:"POST",
    data:$("#editOrderForm").serialize(),
    beforeSend:function(){
    },
    success:function(res){
        console.log(res);
       if(res.success == 1){
         getorder();
         Toast.success('تم الاضافة');
         $("#kt_form .text-danger").text("");
       }else{
           $("#e_order_no_err").text(res.error["order_no"]);
           $("#e_order_type_err").text(res.error["order_type"]);
           $("#e_order_price_err").text(res.error["order_price"]);
           $("#e_weight_err").text(res.error["weight"]);
           $("#e_qty_err").text(res.error["qty"]);
           $("#e_client_err").text(res.error["client"]);
           $("#e_client_phone_err").text(res.error["client_phone"]);
           $("#e_customer_name_err").text(res.error["customer_name"]);
           $("#e_customer_phone_err").text(res.error["customer_phone"]);
           $("#e_city_err").text(res.error["city"]);
           $("#e_town_err").text(res.error["town"]);
           $("#e_branch_err").text(res.error["branch_from"]);
           $("#e_branch_to_err").text(res.error["branch_to"]);
           $("#e_town_err").text(res.error["town"]);
           $("#e_with_dev_err").text(res.error["with_dev"]);
           $("#e_order_note_err").text(res.error["order_note"]);
           Toast.warning("هناك بعض المدخلات غير صالحة",'خطأ');
       }
    },
    error:function(e){
      console.log(e);
       Toast.error('خطأ');
    }
  });
}
function deleteOrder(id){
  if(confirm("هل انت متاكد من الحذف")){
      $.ajax({
        url:"script/_deleteOrder.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success('تم الحذف');
           getorder();
         }else{
           Toast.warning(res.msg);
         }
         console.log(res);
        },
        error:function(e){
          console.log(e);
        }
      });
  }
}

function getclient(){
 getClients($("#client"),$("#branch").val());
 getorder();
 getDrivers($("#driver_action"),$("#branch").val());
}
function OrderTracking(id){
   $.ajax({
     url:"script/_getOrderTrack.php",
     data:{id: id},
     beforeSend:function(){

     },
     success:function(res){
       $("#orderTimeline").html('');
       console.log(res);
     if(res.success == 1){
       $.each(res.data,function(){
         if(this.order_status_id == 1){
             icon = "flaticon-attachment kt-font-primary";
             color = "primary";
         }else if(this.order_status_id == 2){
            icon = "flaticon-open-box kt-font-info";
            color = "info";
         }else if(this.order_status_id == 3){
            icon = "flaticon2-lorry kt-font-accent";
            color = "success";
         }else if(this.order_status_id == 4){
            icon = "flaticon-bus-stop kt-font-success";
            color = "success";
         }else if(this.order_status_id == 5){
            icon = "flaticon2-refresh kt-font-warning";
            color = "warning";
         }else if(this.order_status_id == 6){
            icon = "flaticon-reply kt-font-danger";
            color = "danger";
         }else if(this.order_status_id == 7){
            icon = "flaticon-clock-2 kt-font-warning";
            color = "warning";
         }else{
            icon = "flaticon-exclamation-1 kt-font-info";
            color = "info";
         }
         $("#orderTimeline").append(
                    '<div class="kt-timeline__item kt-timeline__item--'+color+'">'+
                            '<div class="kt-timeline__item-section">'+
                                '<div class="kt-timeline__item-section-border">'+
                                    '<div class="kt-timeline__item-section-icon">'+
                                        '<i class="'+ icon +'"></i>'+
                                    '</div>'+
                                '</div>'+
                               '<span class="kt-timeline__item-datetime">'+this.date+'</span>'+
                            '</div>'+
                            '<a href="" class="kt-timeline__item-text">'+

                            '</a>'+
                            '<div class="kt-timeline__item-info">'+
                                this.status+
                            '</div>'+
                        '</div>'
            );
        });
       }else{
         $("#orderTimeline").append("<h2>لا يوجد معلومات</h2>")
       }
     },
     error:function(e){
       console.log(e);
     }
   });
}
$( document ).ready(function(){
getorder($("#ordersTable"));
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