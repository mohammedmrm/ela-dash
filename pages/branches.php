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
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="Quick actions" data-placement="top">
                    <span>اضافة فرع</span>
                    <a data-toggle="modal" data-target="#addBranchModal" class="btn btn-icon btn btn-label btn-label-brand btn-bold" data-toggle="dropdown" data-offset="0px,0px" aria-haspopup="true" aria-expanded="false">
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
				فروع الشركة
			</h3>
		</div>
	</div>

	<div class="kt-portlet__body">
		<!--begin: Datatable -->
		<table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="tb-branch">
			       <thead>
	  						<tr>
										<th>ID</th>
										<th>اسم الفرع</th>
										<th>البريد الالكتروني</th>
										<th>رقم الهاتف</th>
										<th>المدير</th>
										<th>تعديل</th>
							</tr>
      	            </thead>
                            <tbody id="branchesTable">
                            </tbody>
                            <tfoot>
	                <tr>
								<th>ID</th>
								<th>اسم الفرع</th>
								<th>البريد الالكتروني</th>
								<th>رقم الهاتف</th>
								<th>المدير</th>
								<th>تعديل</th>
                    </tr>
	           </tfoot>
		</table>
		<!--end: Datatable -->
	</div>
</div>  </div>
<!-- end:: Content -->              </div>


            <!--begin::Page Vendors(used by this page) -->
                            <script src="assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
                        <!--end::Page Vendors -->



            <!--begin::Page Scripts(used by this page) -->
                            <script src="assets/js/demo1/pages/components/datatables/extensions/responsive.js" type="text/javascript"></script>
                       <script type="text/javascript">
function getbraches(elem){
$.ajax({
  url:"script/_getBranches.php",
  type:"POST",
  success:function(res){
   console.log(res);
   elem.html("");
   $.each(res.data,function(){
     elem.append(
       '<tr>'+
            '<td>'+this.id+'</td>'+
            '<td>'+this.name+'</td>'+
            '<td><a href="mailto:'+this.email+'">'+this.email+'</a></td>'+
            '<td>'+this.phone+'</td>'+
            '<td>'+this.manager+'</td>'+
            '<td><button class="btn btn-link btn-clean" onclick="editBranch('+this.id+')" data-toggle="modal" data-target="#editBranchModal"><span class="flaticon-edit"></sapn></button>'+
            '<button class="btn btn-link btn-clean text-danger" onclick="deleteBranch('+this.id+')" data-toggle="modal" data-target="#deleteBranchModal"><span class="flaticon-delete"></sapn></button></td>'+

       '</tr>');
     });
     $("#tb-branch").DataTable().destroy()
     var myTable= $('#tb-branch').DataTable({
     columns:[
    //"dummy" configuration
        { visible: true }, //col 1
        { visible: true }, //col 2
        { visible: true }, //col 3
        { visible: true }, //col 4
        { visible: true }, //col 5
        { visible: true }, //col 6
        ]
});
    },
   error:function(e){
    console.log(e);
  }
});
}
getbraches($("#branchesTable"));

</script>
<div class="modal fade" id="addBranchModal" role="dialog">
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
			<form class="kt-form" id="addBranchForm">
				<div class="kt-portlet__body">
					<div class="form-group">
						<label>المدينة</label>
						<select data-show-subtext="true" data-live-search="true" type="text" class="selectpicker form-control dropdown-primary" name="branch_city" id="branch_city"  value="">
                        </select>
                        <span class="form-text text-danger" id="branch_city_err"></span>
					</div>
					<div class="form-group">
						<label>الاسم:</label>
						<input type="name" name="branch_name" class="form-control"  placeholder="ادخل الاسم الكامل">
						<span class="form-text  text-danger" id="branch_name_err"></span>
					</div>
					<div class="form-group">
						<label>الايميل:</label>
						<input type="email" name="branch_email" class="form-control" placeholder="ادخل البريد الالكتروني">
						<span class="form-text text-danger" id="branch_email_err"></span>
					</div>
					<div class="form-group">
						<label>رقم الهاتف:</label>
						<input type="phone" name="branch_phone" class="form-control" placeholder="ادخل رقم الهاتف">
						<span id="branch_phone_err" class="form-text  text-danger"></span>
					</div>
					<div class="form-group">
						<label>المدير</label>
						<select data-show-subtext="true" data-live-search="true" type="text" class="selectpicker form-control dropdown-primary" name="branch_manager" id="branch_manager"  value="">
                        </select>
                        <span class="form-text text-danger" id="branch_manager_err"></span>
					</div>
	            </div>
	            <div class="kt-portlet__foot kt-portlet__foot--solid">
					<div class="kt-form__actions kt-form__actions--right">
						<button type="button" onclick="addBranch()" class="btn btn-brand">اضافة</button>
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

<div class="modal fade" id="editBranchModal" role="dialog">
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
			<form class="kt-form" id="editBranchForm">
				<div class="kt-portlet__body">
					<div class="form-group">
						<label>المدينة</label>
						<select data-show-subtext="true" data-live-search="true" type="text" class="selectpicker form-control dropdown-primary" name="e_branch_city" id="e_branch_city"  value="">
                        </select>
                        <span class="form-text text-danger" id="e_branch_city_err"></span>
					</div>
					<div class="form-group">
						<label>الاسم:</label>
						<input type="name" id="e_branch_name" name="e_branch_name" class="form-control"  placeholder="ادخل الاسم الكامل">
						<span class="form-text  text-danger" id="e_branch_name_err"></span>
					</div>
					<div class="form-group">
						<label>الايميل:</label>
						<input type="email"  id="e_branch_email" name="e_branch_email" class="form-control" placeholder="ادخل البريد الالكتروني">
						<span class="form-text text-danger" id="branch_email_err"></span>
					</div>
					<div class="form-group">
						<label>رقم الهاتف:</label>
						<input type="phone" id="e_branch_phone" name="e_branch_phone" class="form-control" placeholder="ادخل رقم الهاتف">
						<span id="e_branch_phone_err" class="form-text  text-danger"></span>
					</div>
					<div class="form-group">
						<label>المدير</label>
						<select data-show-subtext="true" data-live-search="true" type="text" class="selectpicker form-control dropdown-primary" name="e_branch_manager" id="e_branch_manager"  value="">
                        </select>
                        <span class="form-text text-danger" id="e_branch_manager_err"></span>
					</div>
	            </div>
	            <div class="kt-portlet__foot kt-portlet__foot--solid">
					<div class="kt-form__actions kt-form__actions--right">
						<button type="button" onclick="updateBranch()" class="btn btn-brand">حفظ التغيرات</button>
						<button type="reset" data-dismiss="modal" class="btn btn-secondary">الغاء</button>
					</div>
				</div>
                <input type="hidden" name="e_branch_id" id="editbranchid"/>
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
getCities($("#branch_city"));
getManagers($("#branch_manager"));
function addBranch(){
  $.ajax({
    url:"script/_addBranch.php",
    type:"POST",
    data:$("#addBranchForm").serialize(),
    beforeSend:function(){

    },
    success:function(res){
       if(res.success == 1){
         $("#kt_form input").val("");
         Toast.success('تم الاضافة');
         getbraches($("#branchesTable"));
       }else{
           $("#branch_name_err").text(res.error["branch_name_err"]);
           $("#branch_email_err").text(res.error["branch_email_err"]);
           $("#branch_phone_err").text(res.error["branch_phone_err"]);
           $("#branch_manager_err").text(res.error["branch_manager_err"]);
           $("#branch_city_err").text(res.error["branch_city_err"]);
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
function editBranch(id){
  $("#editbranchid").val(id);
  getCities($("#e_branch_city"));
  getManagers($("#e_branch_manager"));
  $.ajax({
    url:"script/_getBranch.php",
    data:{id: id},
    success:function(res){
      if(res.success == 1){
        $.each(res.data,function(){
          $('#e_branch_name').val(this.name);
          $('#e_branch_email').val(this.email);
          $('#e_branch_phone').val(this.phone);
          $('#e_branch_city').val(this.city_id);
          $('#e_branch_manager').val(this.manager);
          $('#e_branch_city').selectpicker('val', this.city_id);
          $('#e_branch_manager').selectpicker('val', this.manager);
        });
      }
      console.log(res);
    },
    error:function(e){
      console.log(e);
    }
  });
}
function updateBranch(){
    $.ajax({
       url:"script/_updateBranch.php",
       type:"POST",
       data:$("#editBranchForm").serialize(),
       beforeSend:function(){

       },
       success:function(res){
       if(res.success == 1){
         $("#kt_form input").val("");
          Toast.success('تم التحديث');
          getbraches($("#branchesTable"));
       }else{
           $("#e_branch_name_err").text(res.error["branch_name_err"]);
           $("#e_branch_email_err").text(res.error["branch_email_err"]);
           $("#e_branch_phone_err").text(res.error["branch_phone_err"]);
           $("#e_branch_manager_err").text(res.error["branch_manager_err"]);
           $("#e_branch_city_err").text(res.error["branch_city_err"]);
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
function deleteBranch(id){
  if(confirm("هل انت متاكد من الحذف")){
      $.ajax({
        url:"script/_deleteBranch.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success('تم الحذف');
           getbraches($("#branchesTable"));
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