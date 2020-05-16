  <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
        <div class="kt-portlet">
            <form autocomplete="off" role="presentation"  class="kt-form kt-form--label-right" id="editStaffForm">
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
                                            <input type="file" id="e_staff_id" name="e_staff_id" onchange="imgupdate()" accept=".png, .jpg, .jpeg">
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
                            <input type="hidden" name="editstaffid" id="editstaffid" value="<?php echo $_SESSION['userid'];?>" />
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
<script src="js/getBraches.js" type="text/javascript"></script>
<script src="js/getRoles.js" type="text/javascript"></script>
<script>
function getProfile(){
  $.ajax({
    url:"script/_getProfile.php",
    data:{id: id},
    success:function(res){
      if(res.success == 1){
        $.each(res.data,function(){
          $('#head-name').val(this.name);
          $('#name').val(this.name);
          $('#email').val(this.email);
          $('#phone').val(this.phone);
        });
      }
      console.log(res);
    },
    error:function(e){
      console.log(e);
    }
  });
}
function updateProfile(){
   var myform = document.getElementById('editStaffForm');
    var fd = new FormData(myform);
    $.ajax({
       url:"script/_updateProfile.php",
       type:"POST",
       data:fd,
       processData: false,  // tell jQuery not to process the data
       contentType: false,
       cache: false,
       beforeSend:function(){

       },
       success:function(res){
         console.log(res);
       if(res.success == 1){
         $(".text-danger").text('');
         Toast.success('تم التحديث');
       }else{
           $("#name_err").text(res.error["name_err"]);
           $("#email_err").text(res.error["email_err"]);
           $("#phone_err").text(res.error["phone_err"]);
           $("#password_err").text(res.error["password_err"]);
           Toast.warning("هناك بعض المدخلات غير صالحة",'خطأ');
       }

       },
       error:function(e){
        Toast.error('خطأ');
        console.log(e);
       }
    })
}
$( document ).ready(function(){
getProfile();
});
</script>