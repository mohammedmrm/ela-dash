<?php
if(file_exists("script/_access.php")){
require_once("script/_access.php");
access([1,2]);
}
?>
<style>
.userimg{
  width: 100px;
  height: auto;
}

</style>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="Quick actions" data-placement="top">
                    <span>اضافة موظف</span>
                    <a data-toggle="modal" data-target="#addstaffModal" class="btn btn-icon btn btn-label btn-label-brand btn-bold" data-toggle="dropdown" data-offset="0px,0px" aria-haspopup="true" aria-expanded="false">
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
			  موظفين الشركة
			</h3>
		</div>
	</div>

	<div class="kt-portlet__body">
		<!--begin: Datatable -->
		<table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="tb-staff">
			       <thead>
	  						<tr>
										<th>ID</th>
										<th>الاسم</th>
										<th>رقم الهاتف</th>
										<th>الحاله</th>
										<th>تعديل</th>

		  					</tr>
      	            </thead>
                            <tbody id="staffTable">
                            </tbody>
                            <tfoot>
	                <tr>
										<th>ID</th>
										<th>الاسم</th>
										<th>رقم الهاتف</th>
									    <th>الحاله</th>
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
            <!--begin::Page Scripts(used by this page) -->
                            <script src="./assets/js/demo1/pages/custom/profile/overview-3.js" type="text/javascript"></script>
                            <script src="./assets/js/demo1/pages/custom/profile/profile.js" type="text/javascript"></script>
<script src="js/getBraches.js" type="text/javascript"></script>
<script src="js/getRoles.js" type="text/javascript"></script>
<script type="text/javascript">
function getStaff(elem){
$.ajax({
  url:"script/_getEMStaff.php",
  type:"POST",
  success:function(res){
   $("#tb-staff").DataTable().destroy()
   console.log(res);
   elem.html("");
   $.each(res.data,function(){
     if(this.status == 1){
       status = "<h5 class='text-success'>مفعل</h5>";
       btn = '<button class="btn btn-danger " onclick="unactive('+this.id+')" data-toggle="modal">الغا التفعيل</button>'+
             '<button class="btn btn-link " onclick="editStaff('+this.id+')" data-toggle="modal" data-target="#editstaffModal"><span class="flaticon-edit"></sapn></button>'+
             '<button class="btn btn-link text-danger" onclick="deleteStaff('+this.id+')" data-toggle="modal" data-target="#deletestaffModal"><span class="flaticon-delete"></sapn></button>';

     }else{
       btn = '<button class="btn btn-success" onclick="active('+this.id+')" data-toggle="modal">تفعيل</button>';
       status = "<h5 class='text-danger'>غير مفعل</h5>";
     }
     elem.append(
       '<tr>'+
            '<td>'+this.id+'</td>'+
            '<td>'+this.name+'</td>'+
            '<td>'+this.phone+'</td>'+
            '<td>'+status +'</td>'+
            '<td>' +
              btn  +
            '</td>'+
        '</tr>');
     });
     var myTable= $('#tb-staff').DataTable({
     columns:[
    //"dummy" configuration
        { visible: true }, //col 1
        { visible: true }, //col 2
        { visible: true }, //col 3
        { visible: true }, //col 4
        { visible: true }, //col 5
       ],
      "oLanguage": {
        "sLengthMenu": "عرض_MENU_سجل",
        "sSearch": "بحث:"
      }
});
    },
   error:function(e){
    console.log(e);
  }
});
}
getStaff($("#staffTable"));

</script>
<div class="modal fade" id="addstaffModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">اضافة موظف</h4>
        </div>
        <div class="modal-body">
    <!--Begin:: App Content-->
    <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
        <div class="kt-portlet">
            <form class="kt-form kt-form--label-right" id="addStaffForm">
                <div class="kt-portlet__body">
                    <div class="kt-section kt-section--first">
                        <div class="kt-section__body">
                            <div class="row">
                                <label class="col-xl-3"></label>
                                <div class="col-lg-9 col-xl-6">
                                    <h3 class="kt-section__title kt-section__title-sm">معلومات الموظف:</h3>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">الاسم الكامل</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input class="form-control" id="staff_name" name="staff_name" type="text" value="">
                                </div>
                                <span class="form-text text-danger" id="staff_name_err"></span>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">رقم الهاتف</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                        <input type="text" id="staff_phone" name="staff_phone" class="form-control" value="" placeholder="" aria-describedby="basic-addon1">
                                    </div>
                                    <span class="form-text text-danger" id="staff_phone_err"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">كلمة المرور</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input class="form-control" type="password" id="staff_password" name="staff_password" value="">
                                </div>

                            </div>
                            <span class="form-text text-danger" id="staff_password_err"></span>
                        </div>
                    </div>

                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-3 col-xl-3">
                            </div>
                            <div class="col-lg-9 col-xl-9">
                                <button type="button" onclick="addStaff()" class="btn btn-success">اضافة</button>&nbsp;
                                <button type="reset" data-dismiss="modal" class="btn btn-secondary">الغأ</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--End:: App Content-->
        </div>
      </div>

    </div>
  </div>

<div class="modal fade" id="editstaffModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">تعديل بينات الموظف</h4>
        </div>
        <div class="modal-body">
    <!--Begin:: App Content-->
    <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
        <div class="kt-portlet">
            <form class="kt-form kt-form--label-right" id="editStaffForm">
                <div class="kt-portlet__body">
                    <div class="kt-section kt-section--first">
                        <div class="kt-section__body">
                            <div class="row">
                                <label class="col-xl-3"></label>
                                <div class="col-lg-9 col-xl-6">
                                    <h3 class="kt-section__title kt-section__title-sm">معلومات الموظف:</h3>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">الاسم الكامل</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input class="form-control" id="e_staff_name" name="e_staff_name" type="text" value="">
                                </div>
                                <span class="form-text text-danger" id="e_staff_name_err"></span>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">رقم الهاتف</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                        <input type="text" id="e_staff_phone" name="e_staff_phone" class="form-control" value="" placeholder="" aria-describedby="basic-addon1">
                                    </div>
                                    <span class="form-text text-danger" id="e_staff_phone_err"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">كلمة المرور</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-lock"></i></span></div>
                                        <input type="password" id="e_staff_password" name="e_staff_password" class="form-control" value="" placeholder="" aria-describedby="basic-addon1">
                                    </div>
                                    <span class="form-text text-danger" id="e_staff_password_err"></span>
                                </div>
                            </div>
                            <span class="form-text text-danger" id="e_staff_password_err"></span>
                            <input type="hidden" name="editstaffid" id="editstaffid" />
                        </div>
                    </div>

                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-3 col-xl-3">
                            </div>
                            <div class="col-lg-9 col-xl-9">
                                <button type="button" onclick="updateStaff()" class="btn btn-success">حفظ التغيرات</button>&nbsp;
                                <button type="reset" data-dismiss="modal" class="btn btn-secondary">الغاء</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--End:: App Content-->
        </div>
      </div>

    </div>
  </div>
<script>
function addStaff(){
    var myform = document.getElementById('addStaffForm');
    var fd = new FormData(myform);
  $.ajax({
    url:"script/_addEMStaff.php",
    type:"POST",
    data:fd,
    processData: false,  // tell jQuery not to process the data
    contentType: false,
   	cache: false,
    beforeSend:function(){
      $("#addStaffForm").addClass('loading');
    },
    success:function(res){
      $("#addStaffForm").removeClass('loading');
       if(res.success == 1){
         $("#addStaffForm input").val("");
         Toast.success('تم الاضافة');
         getStaff($("#staffTable"));
         $("#staffTable input").val("");
         $("#addstaffModal").modal('hide');
       }else{
           $("#staff_name_err").text(res.error["staff_name_err"]);
           $("#staff_phone_err").text(res.error["staff_phone_err"]);
           $("#staff_password_err").text(res.error["staff_password_err"]);
           Toast.warning("هناك بعض المدخلات غير صالحة",'خطأ');
       }
      console.log(res);
    },
    error:function(e){
     $("#addStaffForm").removeClass('loading');
     console.log(e);
     Toast.error('خطأ');
    }
  });
}
function active(id){
  $.ajax({
        url:"script/_activeStaff.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success('تم');
           getStaff($("#staffTable"));
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
function unactive(id){
  $.ajax({
        url:"script/_unactiveStaff.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success('تم');
           getStaff($("#staffTable"));
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
function editStaff(id){
  $("#editstaffid").val(id);
  $.ajax({
    url:"script/_getStaff1.php",
    data:{id: id},
    success:function(res){
      if(res.success == 1){
        $.each(res.data,function(){
          $('#e_staff_name').val(this.name);
          $('#e_staff_phone').val(this.phone);
        });
      }
      console.log(res);
    },
    error:function(e){
      console.log(e);
    }
  });
}
function updateStaff(){
   var myform = document.getElementById('editStaffForm');
    var fd = new FormData(myform);
    $.ajax({
       url:"script/_updateEMStaff.php",
       type:"POST",
       data:fd,
       processData: false,  // tell jQuery not to process the data
       contentType: false,
       cache: false,
       beforeSend:function(){

       },
       success:function(res){
       if(res.success == 1){
         $("#editStaffForm input").val("");
          Toast.success('تم التحديث');
          getStaff($("#staffTable"));
          $("#editstaffModal").modal('hide');
       }else{
           $("#e_img_err").text(res.error["staff_img_err"]);
           $("#e_staff_name_err").text(res.error["staff_name_err"]);
           $("#e_staff_email_err").text(res.error["staff_email_err"]);
           $("#e_staff_phone_err").text(res.error["staff_phone_err"]);
           $('#e_staff_password').val(res.error["staff_password_err"]);
           $("#e_staff_role_err").text(res.error["staff_role_err"]);
           $("#e_staff_branch_err").text(res.error["staff_branch_err"]);
           Toast.warning("هناك بعض المدخلات غير صالحة",'خطأ');
       }
        console.log(res);
       },
       error:function(e){
        Toast.error('خطأ');
        console.log(e);
       }
    })
}
function deleteStaff(id){
  if(confirm("هل انت متاكد من الحذف")){
      $.ajax({
        url:"script/_deleteStaff.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success('تم الحذف');
           getStaff($("#staffTable"));
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
getBraches($("#staff_branch"));
getRoles($("#staff_role"));

</script>