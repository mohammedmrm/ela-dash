<?php
if(file_exists("script/_access.php")){
require_once("script/_access.php");
access([1,2,3]);
}
?>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">

    </div>
</div>
<!-- end:: Subheader -->
					<!-- begin:: Content -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
			  الطلبيات
			</h3>
		</div>
	</div>

	<div class="kt-portlet__body">
		<!--begin: Datatable -->
		<table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="tb-orders">
			       <thead>
	  						<tr>
										<th></th>
										<th>رقم الوصل</th>
										<th>اسم العميل</th>
										<th>رقم هاتف العميل</th>
										<th>اسم المستلم</th>
										<th>رقم هاتف المستلم</th>
										<th>الفرع المرسل له</th>
										<th>المدينة المرسل لها</th>
										<th>القضاء المرسل له</th>
										<th>السعر</th>
                                        <th>مع التوصيل</th>
										<th>سعر التوصيل</th>
                                        <th>حالة السعر</th>
                                        <th>التاريخ</th>
										<th>تعديل الحالة</th>
										<th>تعديل</th>
										<th>حذف</th>
		  					</tr>
      	            </thead>
                            <tbody id="ordersTable">
                            </tbody>
                            <tfoot>
	                <tr>
										<th></th>
										<th>رقم الوصل</th>
										<th>اسم العميل</th>
										<th>رقم هاتف العميل</th>
										<th>اسم المستلم</th>
										<th>رقم هاتف المستلم</th>
										<th>الفرع المرسل له</th>
										<th>المدينة المرسل لها</th>
										<th>القضاء المرسل له</th>
										<th>السعر</th>
                                        <th>مع التوصيل</th>
										<th>سعر التوصيل</th>
                                        <th>حالة السعر</th>
                                        <th width="100px">التاريخ</th>
										<th>تعديل الحالة</th>
										<th>تعديل</th>
										<th>حذف</th>
					</tr>
	           </tfoot>
		</table>
		<!--end: Datatable -->
	</div>
</div>	</div>
<!-- end:: Content -->				</div>
<!--begin::Page Vendors(used by this page) -->
<script src="assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>

<!--begin::Page Scripts(used by this page) -->
<script src="assets/js/demo1/pages/components/datatables/extensions/responsive.js" type="text/javascript"></script>
<script type="text/javascript">
function getorders(elem){
$.ajax({
  url:"script/_getOrders.php",
  type:"POST",
  success:function(res){
   $("#tb-orders").DataTable().destroy();
   console.log(res);
   elem.html("");
   $.each(res.data,function(){
     elem.append(
       '<tr>'+
            '<td></td>'+
            '<td>'+this.order_no+'</td>'+
            '<td>'+this.client_name+'</td>'+
            '<td>'+this.client_phone+'</td>'+
            '<td>'+this.customer_name+'</td>'+
            '<td>'+this.customer_phone+'</td>'+
            '<td>'+this.to_branch+'</td>'+
            '<td>'+this.to_city+'</td>'+
            '<td>'+this.to_town+'</td>'+
            '<td>'+this.price+'</td>'+
            '<td>'+this.with_dev+'</td>'+
            '<td>'+this.dev_price+'</td>'+
            '<td>'+this.money_status+'</td>'+
            '<td>'+this.date+'</td>'+
            '<td><button class="btn btn-info" onclick="editorderStatus('+this.id+')" data-toggle="modal" data-target="#editorderStatusModal"><span class="flaticon-edit"></sapn></button></td>'+
            '<td><button class="btn btn-warning" onclick="editorders('+this.id+')" data-toggle="modal" data-target="#editordersModal"><span class="flaticon-edit"></sapn></button></td>'+
            '<td><button class="btn btn-danger" onclick="deleteorders('+this.id+')" data-toggle="modal" data-target="#deleteordersModal"><span class="flaticon-delete"></sapn></button></td>'+
        '</tr>');
     });
     var myTable= $('#tb-orders').DataTable({
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        order: [[ 1, 'asc' ]]
});
    },
   error:function(e){
    console.log(e);
  }
});
}
getorders($("#ordersTable"));

function editorderStatus(id){
    d = new Date();
    var datestring = d.getFullYear()  + "-" + ("0"+(d.getMonth()+1)).slice(-2) + "-" + ("0" + d.getDate()).slice(-2) + " " + ("0" + d.getHours()).slice(-2) + ":" + ("0" + d.getMinutes()).slice(-2);
    $('#orderStatus_date').val(datestring);
}
jQuery(document).ready(function() {
        $('#orderStatus_date').datetimepicker({
            format: "yyyy-mm-dd h:i ",
            showMeridian: true,
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'bottom-left',
            defaultDate:'now'
        });
getorderStatus($("#orderStatus"));
});
function getorderStatus(elem){
$.ajax({
  url:"script/_getorderStatus.php",
  type:"POST",
  success:function(res){
   console.log(res);
   elem.html("");
   $.each(res.data,function(){
     elem.append(
       '<option value="'+this.id+'">'+this.status +'</option>'
     );
    });
    elem.selectpicker('refresh');
    },
   error:function(e){
    console.log(e);
  }
});
}

</script>

  <div class="modal fade" id="editorderStatusModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">تحديث حالة الطلب</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
		<div class="kt-portlet">

			<!--begin::Form-->
			<form class="kt-form" id="addClientForm">
				<div class="kt-portlet__body">
					<div class="form-group">
						<label>الحالة</label>
						<select data-show-subtext="true" data-live-search="true" type="text" class="selectpicker form-control dropdown-primary" name="orderStatus" id="orderStatus"  value="">
                        </select>
                        <span class="form-text text-danger" id="orderStatus_err"></span>
					</div>
					<div class="form-group">
						<label>ملاحظات:</label>
						<input type="name" name="rderStatus_note" class="form-control"  placeholder="">
						<span class="form-text  text-danger" id="orderStatus_note_err"></span>
					</div>
                    <div class="input-group date">
						<input size="16" type="text"  readonly class="form-control form_datetime"  placeholder="الوقت والتاريخ" id="orderStatus_date">
						<div class="input-group-append">
							<span class="input-group-text">
							<i class="la la-calendar glyphicon-th"></i>
							</span>
						</div>
						<span class="form-text  text-danger" id="orderStatus_date_err"></span>
					</div>
	            </div>
	            <div class="kt-portlet__foot kt-portlet__foot--solid">
					<div class="kt-form__actions kt-form__actions--right">
						<button type="button" onclick="addClient()" class="btn btn-brand">اضافة</button>
						<button type="reset" data-dismiss="modal" class="btn btn-secondary">الغاء</button>
					</div>
				</div>
			</form>
			<!--end::Form-->
		</div>
		<!--end::Portlet-->
        </div>
      </div>

    </div>
  </div>
            <!--begin::Page Scripts(used by this page) -->
                            <script src="./assets/js/demo1/pages/components/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
