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
                <div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="اضافة عميل" data-placement="top">
                    <span>اضافة صفحة جديدة</span>
                    <a data-toggle="modal" data-target="#addStoreModal" class="btn btn-icon btn btn-label btn-label-brand btn-bold" data-toggle="dropdown" data-offset="0px,0px" aria-haspopup="true" aria-expanded="false">
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
				العملاء
			</h3>
		</div>
	</div>

	<div class="kt-portlet__body" id="Store_table">
		<!--begin: Datatable -->
		<table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="tb-getAllStores">
			       <thead>
	  						<tr>
								<th>ID</th>
								<th>اسم البيج</th>
								<th>اسم العميل</th>
								<th>رقم الهاتف</th>
								<th>تعديل</th>
		  					</tr>
      	            </thead>
                            <tbody id="getAllStoresTable">
                            </tbody>
                            <tfoot>
	                <tr>
								<th>ID</th>
								<th>اسم العميل</th>
								<th>رقم الهاتف</th>
								<th>البريد الالكتروني</th>
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
function getAllStores(elem){
$.ajax({
  url:"script/_getStores.php",
  type:"POST",
  beforeSend:function(){
    $("#Store_table").addClass('loading');
  },
  success:function(res){
   $("#tb-getAllStores").DataTable().destroy();
   console.log(res);
   elem.html("");
   $("#Store_table").removeClass('loading');
   $.each(res.data,function(){
     elem.append(
       '<tr>'+
            '<td>'+this.id+'</td>'+
            '<td>'+this.name+'</td>'+
            '<td>'+this.client_name+'</td>'+
            '<td>'+this.client_phone+'</td>'+
            '<td width="150px">'+
              '<button class="btn btn-clean btn-icon-lg" onclick="editStore('+this.id+')" data-toggle="modal" data-target="#editStore"><span class="flaticon-edit"></sapn>'+
              '<button class="btn btn-clean btn-icon-lg" onclick="deleteStore('+this.id+')" data-toggle="modal" data-target="#deleteStore"><span class="flaticon-delete"></sapn>'+
            '</button></td>'+
     '</tr>');
     });
     var myTable= $('#tb-getAllStores').DataTable({
     columns:[
    //"dummy" configuration
        { visible: true }, //col 1
        { visible: true }, //col 2
        { visible: true }, //col 3
        { visible: true }, //col 4
        { visible: true }, //col 5
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
    $("#Store_table").removeClass('loading');
    console.log(e);
  }
});
}
getAllStores($("#getAllStoresTable"));

</script>
<div class="modal fade" id="editStore" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">البيجات</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
		<div class="kt-portlet">

			<!--begin::Form-->
			<form class="kt-form" id="editStoreForm">
				<div class="kt-portlet__body">
					<div class="form-group">
						<label>الاسم البيج:</label>
						<input type="name" id="e_Store_name" name="e_Store_name" class="form-control"  placeholder="ادخل الاسم الكامل">
						<span class="form-text  text-danger" id="e_Store_name_err"></span>
					</div>
	            </div>
	            <div class="kt-portlet__foot kt-portlet__foot--solid">
					<div class="kt-form__actions kt-form__actions--right">
						<button type="button" onclick="updateStore()" class="btn btn-brand">تحديث</button>
						<button type="reset" data-dismiss="modal" class="btn btn-secondary">الغاء</button>
					</div>
				</div>
                <input type="hidden" id="editStoreid" name="editStoreid" />
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
<script type="text/javascript" src="js/getBraches.js"></script>
<script>
function editStore(id){
  $(".text-danger").text("");
  $("#editStoreid").val(id);
  getCities($("#e_Store_city"));
  getManagers($("#e_Store_manager"));
  $.ajax({
    url:"script/_getStoreByID.php",
    data:{id: id},
    beforeSend:function(){
      $("#editStoreForm").addClass('loading');
    },
    success:function(res){
       $("#editStoreForm").removeClass('loading');
      if(res.success == 1){
        $.each(res.data,function(){
          $('#e_Store_name').val(this.name);
          $('#e_Store_email').val(this.email);
          $('#e_Store_phone').val(this.phone);
          $('#e_Store_branch').selectpicker('val', this.branch_id);
        });
      }
      console.log(res);
    },
    error:function(e){
      $("#editStoreForm").removeClass('loading');
      console.log(e);
    }
  });
}
function updateStore(){
    $(".text-danger").text("");
    $.ajax({
       url:"script/_updateStore.php",
       type:"POST",
       data:$("#editStoreForm").serialize(),
       beforeSend:function(){
        $("#editStoreForm").addClass('loading');
       },
       success:function(res){
         $("#editStoreForm").removeClass('loading');
         console.log(res);
       if(res.success == 1){
          $("#kt_form input").val("");
          Toast.success('تم التحديث');
          getAllStores($("#getAllStoresTable"));
       }else{
           $("#e_Store_branch_err").text(res.error["Store_branch_err"]);
           $("#e_Store_name_err").text(res.error["Store_name_err"]);
           $("#e_Store_email_err").text(res.error["Store_email_err"]);
           $("#e_Store_phone_err").text(res.error["Store_phone_err"]);
           $("#e_Store_password_err").text(res.error["Store_password_err"]);
           Toast.warning("هناك بعض المدخلات غير صالحة",'خطأ');
       }
       },
       error:function(e){
        $("#editStoreForm").removeClass('loading');
        Toast.error('خطأ');
        console.log(e);
       }
    })
}
function deleteStore(id){
  if(confirm("هل انت متاكد من الحذف")){
      $.ajax({
        url:"script/_deleteStore.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success('تم الحذف');
           getAllStores($("#getAllStoresTable"));
         }else{
           Toast.warning(res.msg);
         }
         console.log(res)
        } ,
        error:function(e){
          console.log(e);
        }
      });
  }
}
</script>
  <!-- Modal -->
  <div class="modal fade " id="addStoreModal" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">اضافة صفحة</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
		<div class="kt-portlet">

			<!--begin::Form-->
			<form class="kt-form" id="addStoreForm">
                <div class="row">
  				  <div class="col-md-12">
  				    <div class="kt-portlet__body">
  					<div class="form-group">
  						<label>العميل</label>
  						<select data-show-subtext="true" data-live-search="true" type="text" class="selectpicker form-control dropdown-primary" name="client" id="client"  value="">
                          </select>
                          <span class="form-text text-danger" id="client_err"></span>
  					</div>
  					<div class="form-group">
  						<label>الاسم الصفحة:</label>
  						<input type="name" name="name" class="form-control"  placeholder="ادخل الاسم الكامل">
  						<span class="form-text  text-danger" id="Store_name_err"></span>
  					</div>
  					<div class="form-group">
  						<label>ملاحظات:</label>
  						<input type="name" name="note" class="form-control"  placeholder="ادخل الاسم الكامل">
  						<span class="form-text  text-danger" id="Store_note_err"></span>
  					</div>
                 </div>
  	            </div>
                </div>
	            <div class="kt-portlet__foot kt-portlet__foot--solid">
					<div class="kt-form__actions kt-form__actions--right">
						<button type="button" onclick="addStore()" class="btn btn-brand">اضافة</button>
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

  <!-- Modal -->
  <div class="modal fade " id="devPriceStore" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">تعديل اسعار التوصيل للعميل</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
		<div class="kt-portlet">

			<!--begin::Form-->
			<form class="kt-form" id="devPriceStoreForm">
                <div class="row">
                <div class="col-md-12">
  				   <div id="devPriceItems" class=""></div>
                   <label class="text-danger" id="devPrice_err"></label>
                </div>
                 </div>
	            <div class="kt-portlet__foot kt-portlet__foot--solid">
					<div class="kt-form__actions kt-form__actions--right">
						<button type="button" onclick="updateDevPriceStore()" class="btn btn-brand">تحديث اسعار التوصيل</button>
						<button type="reset" data-dismiss="modal" class="btn btn-secondary">الغاء</button>
					</div>
				</div>
                <input type="hidden" name="Store_id" id="Store_id"/>
			</form>
			<!--end::Form-->
		</div>
		<!--end::Portlet-->
        </div>
      </div>

    </div>
  </div>

  <script src="assets/js/demo1/pages/custom/profile/overview-3.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/getCities.js"></script>
  <script type="text/javascript">
  getBraches($("#Store_branch"));
  getBraches($("#e_Store_branch"));
  function addStore(){
  $.ajax({
     url:"script/_addStore.php",
     type:"POST",
     data:$("#addStoreForm").serialize(),
     success:function(res){
       console.log(res);
       if(res.success == 1){
         getAllStores($("#getAllStoresTable"));
         $("#addStoreForm input").val("");
         Toast.success('تم الاضافة');
       }else{
           $("#Store_name_err").text(res.error["name"]);
           $("#client_err").text(res.error["client"]);
           $("#Store_note_err").text(res.error["note"]);
           }

     },
     error:function(e){
       console.log(e);
       Toast.error.displayDuration=5000;
       Toast.error('تأكد من المدخلات','خطأ');
     }
  });
}

function getAllClient(ele){
   $.ajax({
     url:"script/_getClientsAll.php",
     type:"POST",
     success:function(res){
       ele.html("");
       ele.append(
           '<option value="">... اختر ...</option>'
       );
       $.each(res.data,function(){
         ele.append("<option value='"+this.id+"'>"+this.name+"-"+this.phone+"</option>");
       });
       console.log(res);
       ele.selectpicker('refresh');
     },
     error:function(e){
        ele.append("<option value='' class='bg-danger'>خطأ اتصل بمصمم النظام</option>");
        console.log(e);
     }
   });
}
getAllClient($("#client"));
 </script>
