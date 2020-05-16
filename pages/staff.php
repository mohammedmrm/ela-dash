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
										<th>الفرع</th>
										<th>رقم الهاتف</th>
										<th>الوظيفة</th>
										<th>المناطق</th>
										<th>الهوية</th>
										<th>تعديل</th>
										
		  					</tr>
      	            </thead>
                            <tbody id="staffTable">
                            </tbody>
                            <tfoot>
	                <tr>
										<th>ID</th>
										<th>الاسم</th>
										<th>الفرع</th>
										<th>رقم الهاتف</th>
										<th>الوظيفة</th>
										<th>المناطق</th>
										<th>الهوية</th>
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
<script src="js/getAllunAssignedTowns.js" type="text/javascript"></script>
<script type="text/javascript">
function getStaff(elem){
$.ajax({
  url:"script/_getStaff.php",
  type:"POST",
  success:function(res){
   $("#tb-staff").DataTable().destroy();
   console.log(res);
   elem.html("");
   $.each(res.data,function(){
      btn ='';
     if(this.role_id == 4){
       btn = "<button data-toggle='modal' data-target='#driverTownsModal' class='btn btn-warning text-white' onclick='getDriverTowns("+this.id+")'>مناطق</button>"
     }
     elem.append(
       '<tr>'+
            '<td>'+this.id+'</td>'+
            '<td>'+this.name+'</td>'+
            '<td>'+this.branch_name+'</td>'+
            '<td>'+this.phone+'</td>'+
            '<td>'+this.role_name+'</td>'+
            '<td>'+btn+'</td>'+
            '<td><a href="img/staff/'+this.id_copy+'"><img class="userimg" src="img/staff/'+this.id_copy+'"></a></td>'+
            '<td><button class="btn btn-link " onclick="editStaff('+this.id+')" data-toggle="modal" data-target="#editstaffModal"><span class="flaticon-edit"></sapn></button>'+
            '<button class="btn btn-link text-danger" onclick="deleteStaff('+this.id+')" data-toggle="modal" data-target="#deletestaffModal"><span class="flaticon-delete"></sapn></button></td>'+
        '</tr>');
     });
     var myTable= $('#tb-staff').DataTable({
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
                                <label class="col-xl-3 col-lg-3 col-form-label">صورة من الهوية</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_profile_avatar">
                                        <div class="kt-avatar__holder" style="background-image: url('');"></div>
                                        <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
                                            <i class="fa fa-pen"></i>
                                            <input type="file" id="staff_id" name="staff_id" accept=".png, .jpg, .jpeg">
                                        </label>
                                        <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
                                                    <i class="fa fa-times"></i>
                                        </span>
                                    </div>
                                </div>
                                <span class="form-text text-danger" id="staff_id_err"></span>
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
                                <label class="col-xl-3 col-lg-3 col-form-label">الفرع</label>
                                <div class="col-lg-9 col-xl-6">
                                  <select data-show-subtext="true" data-live-search="true" type="text" class="selectpicker form-control dropdown-primary"  id="staff_branch" name="staff_branch"  value="">
                                  </select>
                                  <span class="form-text text-danger" id="staff_branch_err"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">العنوان الوظيفي</label>
                                <div class="col-lg-9 col-xl-6">
                                  <select data-show-subtext="true" data-live-search="true" type="text" class="selectpicker form-control dropdown-primary"  id="staff_role" name="staff_role"  value="">
                                  </select>
                                  <span class="form-text text-danger" id="staff_role_err"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">البريد الالكتروني</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                        <input type="email" class="form-control" id="staff_email" name="staff_email" placeholder="Email" aria-describedby="basic-addon1">
                                    </div>
                                    <span class="form-text text-danger" id="staff_email_err"></span>
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
                                <label class="col-xl-3 col-lg-3 col-form-label">صورة من الهوية</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_profile_avatar">
                                        <div class="kt-avatar__holder" id="img" style="background-image: url('');"></div>
                                        <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
                                            <i class="fa fa-pen"></i>
                                            <input type="file" id="e_staff_id" name="e_staff_id"  accept=".png, .jpg, .jpeg">
                                        </label>
                                        <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
                                                    <i class="fa fa-times"></i>
                                        </span>
                                    </div>
                                </div>
                                <span class="form-text text-danger" id="e_img_err"></span>
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
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">الفرع</label>
                                <div class="col-lg-9 col-xl-6">
                                  <select data-show-subtext="true" data-live-search="true" type="text" class="selectpicker form-control dropdown-primary"  id="e_staff_branch" name="e_staff_branch"  value="">
                                  </select>
                                  <span class="form-text text-danger" id="e_staff_branch_err"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">العنوان الوظيفي</label>
                                <div class="col-lg-9 col-xl-6">
                                  <select data-show-subtext="true" data-live-search="true" type="text" class="selectpicker form-control dropdown-primary"  id="e_staff_role" name="e_staff_role"  value="">
                                  </select>
                                  <span class="form-text text-danger" id="e_staff_role_err"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">البريد الالكتروني</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                        <input type="email" class="form-control" id="e_staff_email" name="e_staff_email" placeholder="Email" aria-describedby="basic-addon1">
                                    </div>
                                    <span class="form-text text-danger" id="e_staff_email_err"></span>
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

<div class="modal fade" id="driverTownsModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">مناطق المندوب</h4>
        </div>
        <div class="modal-body">
        <!--Begin:: App Content-->
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="kt-portlet">
                <form class="kt-form kt-form--label-right" id="driverTownsForm">
                  <fieldset><legend>اضافه منطقه للمندوب</legend>
                  <div class="row kt-margin-b-20">
                    <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                    	<label>المنطقه:</label>
                        <select data-live-search="true" class="form-control selectpicker" id="town" name="town"></select>
                    </div>
                    <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                    	<label>اضافه:</label><br>
                    	<button type="button" onclick="setTownToDriver()" class="btn btn-success" value="" placeholder="" data-col-index="0">اضافه

                        </button>
                    </div>
                    <div class="col-lg-4 kt-margin-b-10-tablet-and-mobile">
                    	<label>اسم المندوب:</label><br>
                    	<label id="driver_name"></label><br>
                    </div>
                  </div>
                  </fieldset>
		<!--begin: Datatable -->
		<table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="tb-driverTown">
			       <thead>
	  						<tr>
										<th>ID</th>
										<th>المحافظه</th>
										<th>المنطقه</th>
										<th>حذف</th>

		  					</tr>
      	            </thead>
                    <tbody id="driverTown">
                    </tbody>
		</table>
		<!--end: Datatable -->
        <input type="hidden" value="" id="driver_id" name="driver_id" />
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
    url:"script/_addStaff.php",
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
           $("#staff_email_err").text(res.error["staff_email_err"]);
           $("#staff_phone_err").text(res.error["staff_phone_err"]);
           $("#staff_branch_err").text(res.error["staff_branch_err"]);
           $("#staff_password_err").text(res.error["staff_password_err"]);
           $("#staff_role_err").text(res.error["staff_role_err"]);
           $("#staff_id_err").text(res.error["staff_id_err"]);
           Toast.warning("هناك بعض المدخلات غير صالحة",'خطأ');
       }
      console.log(res);
    },
    error:function(e){
     $("#addStaffForm").addClass('loading');
     console.log(e);
     Toast.error('خطأ');
    }
  });
}
function editStaff(id){
  $("#editstaffid").val(id);
  getBraches($("#e_staff_branch"));
  getRoles($("#e_staff_role"));
  $.ajax({
    url:"script/_getStaff1.php",
    data:{id: id},
    success:function(res){
      if(res.success == 1){
        $.each(res.data,function(){
          $('#e_staff_name').val(this.name);
          $('#e_staff_email').val(this.email);
          $('#e_staff_phone').val(this.phone);
          //$('#img').css('background-image','url("img/staff/'+this.id_copy+'")');
          $('select[name=e_staff_branch]').val(this.branch);
          $('#e_staff_role').val(this.role_id);
          $('.selectpicker').selectpicker('refresh')
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
       url:"script/_updateStaff.php",
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
$("#tb-driverTown").DataTable();
function getDriverTowns(id){
      $('#driver_id').val(id);
      $.ajax({
        url:"script/_getDriverTowns.php",
        type:"POST",
        data:{id:id},
        beforeSend:function(){
          $("#tb-driverTown").DataTable().destroy();
        },
        success:function(res){
         if(res.success == 1){
          $('#driverTown').html("");
          $('#driver_name').text(res.driver_info.name);

          $.each(res.data,function(){
            $('#driverTown').append(
            '<tr>'+
              '<td>'+this.id+'</td>'+
              '<td>'+this.city_name+'</td>'+
              '<td>'+this.town_name+'</td>'+
              '<td><button type="button" onclick="deleteDriverTown('+this.id+')" class="btn btn-icon btn-danger"><span class="flaticon-delete"></span></button></td>'+
            '</tr>'
            );
          });
          $("#tb-driverTown").DataTable();
         }else{

         }
         console.log(res)
        } ,
        error:function(e){
          console.log(e);
        }
      });
}
function setTownToDriver(){
      $.ajax({
        url:"script/_setTownToDriver.php",
        type:"POST",
        data:$("#driverTownsForm").serialize(),
        beforeSend:function(){
          $("#driverTownsForm").addClass("loading");
        },
        success:function(res){
        $("#driverTownsForm").removeClass("loading");
         if(res.success == 1){
           Toast.success(res.msg);
           getDriverTowns($('#driver_id').val());
           getAllunAssignedTowns($("#town"));
         }else{
           Toast.warning(res.msg);
         }
         console.log(res)
        } ,
        error:function(e){
          $("#driverTownsForm").removeClass("loading");
          console.log(e);
        }
      });
}
function deleteDriverTown(id){
  if(confirm("هل انت متاكد من الحذف")){
      $.ajax({
        url:"script/_deleteDriverTown.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success('تم الحذف');
          getDriverTowns($('#driver_id').val());
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
getAllunAssignedTowns($("#town"));
</script>