<?php
if(file_exists("script/_access.php")){
require_once("script/_access.php");
access([1,2]);
}
?>
<style>
table.dataTable tr th.select-checkbox.selected::after {
    content: "✔";
    margin-top: -11px;
    margin-left: -4px;
    text-align: center;
    text-shadow: rgb(176, 190, 217) 1px 1px, rgb(176, 190, 217) -1px -1px, rgb(176, 190, 217) 1px -1px, rgb(176, 190, 217) -1px 1px;
}
</style>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="Quick actions" data-placement="top">
                    <span>اضافة حالة</span>
                    <a data-toggle="modal" data-target="#addorderStatusModal" class="btn btn-icon btn btn-label btn-label-brand btn-bold" data-toggle="dropdown" data-offset="0px,0px" aria-haspopup="true" aria-expanded="false">
                        <i class="flaticon2-add-1"></i>

                    </a>
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
				حلات الطلب
			</h3>
		</div>
	</div>

	<div class="kt-portlet__body">
		<!--begin: Datatable -->
		<table class="table table-striped table-bordered table-hover table-checkable responsive no-wrap" id="tb-orderStatus">
			       <thead>
	  						<tr>
								<th>ID</th>
								<th>عنوان الحالة</th>
								<th>ملاحاظات</th>
								<th>تعديل</th>
                            </tr>
      	            </thead>
                            <tbody id="orderStatusTable">
                            </tbody>
                            <tfoot>
	                <tr>
	 							<th>ID</th>
								<th>عنوان الحالة</th>
								<th>ملاحاظات</th>
								<th>تعديل</th>
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
function getorderStatus(elem){
$.ajax({
  url:"script/_getorderStatus.php",
  type:"POST",
  success:function(res){
   $("#tb-orderStatus").DataTable().destroy()
   console.log(res);
   elem.html("");
   $.each(res.data,function(){
     elem.append(
       '<tr>'+
            '<td>'+this.id+'</td>'+
            '<td>'+this.status+'</td>'+
            '<td>'+this.note+'</td>'+
            '<td><button class="btn btn-link btn-clean" onclick="editorderStatus('+this.id+')" data-toggle="modal" data-target="#editorderStatusModal"><span class="flaticon-edit"></sapn></button></td>'+

       '</tr>');
     });
     var myTable= $('#tb-orderStatus').DataTable({
     columns:[
    //"dummy" configuration
        { visible: true }, //col 1
        { visible: true }, //col 2
        { visible: true }, //col 3
        { visible: true }, //col 4
        ],
        "iDisplayLength": 50,
         "aLengthMenu": [[10, 25, 50, 100,500,1000,-1], [10, 25, 50,100,500,1000, "All"]],
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
getorderStatus($("#orderStatusTable"));

</script>
<div class="modal fade" id="addorderStatusModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">اضافة فرع</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
		<div class="kt-portlet">

			<!--begin::Form-->
			<form class="kt-form" id="addorderStatusForm">
				<div class="kt-portlet__body">
					<div class="form-group">
						<label>اسم الحالة:</label>
						<input type="name" name="orderStatus_name" class="form-control"  placeholder="اسم الحالة">
						<span class="form-text  text-danger" id="orderStatus_name_err"></span>
					</div>
					<div class="form-group">
						<label>ملاحظات:</label>
						<input type="email" name="orderStatus_note" class="form-control" placeholder="ملاحظات">
						<span class="form-text text-danger" id="orderStatus_email_err"></span>
					</div>
	            </div>
	            <div class="kt-portlet__foot kt-portlet__foot--solid">
					<div class="kt-form__actions kt-form__actions--right">
						<button type="button" onclick="addorderStatus()" class="btn btn-brand">اضافة</button>
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

<div class="modal fade" id="editorderStatusModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">اضافة فرع</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
		<div class="kt-portlet">

			<!--begin::Form-->
			<form class="kt-form" id="editorderStatusForm">
								<div class="kt-portlet__body">
					<div class="form-group">
						<label>اسم الحالة:</label>
						<input type="name" id="e_orderStatus_name"  name="e_orderStatus_name" class="form-control"  placeholder="اسم الحالة">
						<span class="form-text  text-danger" id="e_orderStatus_name_err"></span>
					</div>
					<div class="form-group">
						<label>ملاحظات:</label>
						<input type="text" id="e_orderStatus_note" name="e_orderStatus_note" class="form-control" placeholder="ملاحظات">
						<span class="form-text text-danger" id="e_orderStatus_note_err"></span>
					</div>
	            </div>
	            <div class="kt-portlet__foot kt-portlet__foot--solid">
					<div class="kt-form__actions kt-form__actions--right">
						<button type="button" onclick="updateorderStatus()" class="btn btn-brand">تحديث</button>
						<button type="reset" data-dismiss="modal" class="btn btn-secondary">الغاء</button>
					</div>
				</div>
                <input type="hidden" name="e_orderStatus_id" id="editorderStatusid"/>
			</form>
			<!--end::Form-->
		</div>
		<!--end::Portlet-->
        </div>
      </div>

    </div>
  </div>

<script type="text/javascript" src="js/getCities.js"></script>
<script type="text/javascript" src="js/getManagers.js"></script>
<script>
getCities($("#orderStatus_city"));
getManagers($("#orderStatus_manager"));
function addorderStatus(){
  $.ajax({
    url:"script/_addorderStatus.php",
    type:"POST",
    data:$("#addorderStatusForm").serialize(),
    beforeSend:function(){

    },
    success:function(res){
       if(res.success == 1){
         $("#kt_form input").val("");
         Toast.success('تم الاضافة');
         getorderStatus($("#orderStatusTable"));
       }else{
           $("#orderStatus_name_err").text(res.error["orderStatus_name_err"]);
           $("#orderStatus_note_err").text(res.error["orderStatus_note_err"]);
           Toast.warning("هناك بعض المدخلات غير صالحة",'خطأ');
       }
      console.log(res);
    },
    error:function(e){
     console.log(e);
     Toast.error('خطأ');
    }
  });
}
function editorderStatus(id){
  $("#editorderStatusid").val(id);
  $.ajax({
    url:"script/_getorderStatusByID.php",
    data:{id: id},
    success:function(res){
      console.log(res);
      if(res.success == 1){
        $.each(res.data,function(){
          $('#e_orderStatus_name').val(this.status);
          $('#e_orderStatus_note').val(this.note);
         });
      }
    },
    error:function(e){
      console.log(e);
    }
  });
}
function updateorderStatus(){
    $.ajax({
       url:"script/_updateorderStatus.php",
       type:"POST",
       data:$("#editorderStatusForm").serialize(),
       beforeSend:function(){

       },
       success:function(res){
        console.log(res);
       if(res.success == 1){
         $("#kt_form input").val("");
          Toast.success('تم التحديث');
          getorderStatus($("#orderStatusTable"));
       }else{
           $("#e_orderStatus_name_err").text(res.error["orderStatus_name_err"]);
           $("#e_orderStatus_note_err").text(res.error["orderStatus_not_err"]);
           Toast.warning("هناك بعض المدخلات غير صالحة",'خطأ');
       }
       },
       error:function(e){
        Toast.error('خطأ');
        console.log(e);
       }
    })
}

</script>