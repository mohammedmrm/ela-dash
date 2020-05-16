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
                    <span>اضافة قضاء، ناحية، حي</span>
                    <a data-toggle="modal" data-target="#addtownsModal" class="btn btn-icon btn btn-label btn-label-brand btn-bold" data-toggle="dropdown" data-offset="0px,0px" aria-haspopup="true" aria-expanded="false">
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
				الاقضية والنواحي والاحياء
			</h3>
		</div>
	</div>
    <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
    	<label>المدينة:</label>
    	<select onchange="gettowns()" id="city" name="city" class="form-control kt-input" id="branch" name="branch" data-col-index="6">
    	</select>
    </div>
	<div class="kt-portlet__body">
		<!--begin: Datatable -->
		<table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="tb-towns">
			       <thead>
	  						<tr>
	 							<th>ID</th>
								<th>المدينة</th>
								<th>المنطقة</th>
								<th>مركز؟</th>
								<th>تعديل</th>
                            </tr>
      	            </thead>
                            <tbody id="townsTable">
                            </tbody>
                            <tfoot>
	                <tr>
	 							<th>ID</th>
								<th>المدينة</th>
								<th>المنطقة</th>
								<th>مركز؟</th>
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
function gettowns(){
$.ajax({
  url:"script/_getAllTowns.php",
  type:"POST",
  data:{city: $("#city").val()},
  success:function(res){
   console.log(res);
   $("#tb-towns").DataTable().destroy();
   $("#townsTable").html("");
   $.each(res.data,function(){
     $("#townsTable").append(
       '<tr>'+
            '<td>'+this.id+'</td>'+
            '<td>'+this.city+'</td>'+
            '<td>'+this.town+'</td>'+
            '<td>'+this.center+'</td>'+
            '<td>'+
                '<button class="btn btn-clean btn-link" onclick="edittowns('+this.id+')" data-toggle="modal" data-target="#edittownsModal"><span class="flaticon-edit"></sapn></button>'+
                '<button class="btn btn-clean btn-link" onclick="deletetowns('+this.id+')" data-toggle="modal" data-target="#deletetownsModal"><span class="flaticon-delete"></sapn></button>'+
            '</td>'+

       '</tr>');
     });
     var myTable= $('#tb-towns').DataTable({
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
    console.log(e);
  }
});
}
gettowns();

</script>
<div class="modal fade" id="addtownsModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">اضافة قضاء او ناحية او حي</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
		<div class="kt-portlet">

			<!--begin::Form-->
			<form class="kt-form" id="addtownsForm">
				<div class="kt-portlet__body">
					<div class="form-group">
						<label>المدينة</label>
						<select data-show-subtext="true" data-live-search="true" type="text" class="selectpicker form-control dropdown-primary" name="town_city" id="town_city"  value="">
                        </select>
                        <span class="form-text text-danger" id="town_city_err"></span>
					</div>
                    <div class="form-group">
						<label>اسم المنطقة:</label>
						<input type="name" name="town_name" class="form-control"  placeholder="اسم الحالة">
						<span class="form-text  text-danger" id="town_name_err"></span>
					</div>
					<div class="form-group">
                     <input type="checkbox" name="center" id="center" /> مركز
                    </div>
	            </div>
	            <div class="kt-portlet__foot kt-portlet__foot--solid">
					<div class="kt-form__actions kt-form__actions--right">
						<button type="button" onclick="addtowns()" class="btn btn-brand">اضافة</button>
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

<div class="modal fade" id="edittownsModal" role="dialog">
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
			<form class="kt-form" id="edittownsForm">
				<div class="kt-portlet__body">
					<div class="form-group">
						<label>المدينة</label>
						<select data-show-subtext="true" data-live-search="true" type="text" class="selectpicker form-control dropdown-primary" name="e_town_city" id="e_town_city"  value="">
                        </select>
                        <span class="form-text text-danger" id="e_town_city_err"></span>
					</div>
					<div class="form-group">
						<label>الاسم:</label>
						<input type="name" id="e_town_name" name="e_town_name" class="form-control"  placeholder="ادخل الاسم الكامل">
						<span class="form-text  text-danger" id="e_town_name_err"></span>
					</div>
	            </div>
	            <div class="kt-portlet__foot kt-portlet__foot--solid">
					<div class="kt-form__actions kt-form__actions--right">
						<button type="button" onclick="updatetowns()" class="btn btn-brand">حفظ التغيرات</button>
						<button type="reset" data-dismiss="modal" class="btn btn-secondary">الغاء</button>
					</div>
				</div>
                <input type="hidden" name="e_town_id" id="edittownsid"/>
			</form>
			<!--end::Form-->
		</div>
		<!--end::Portlet-->
        </div>
      </div>

    </div>
  </div>

<script type="text/javascript" src="js/getCities.js"></script>
<script>
getCities($("#town_city"));
getCities($("#city"));
function addtowns(){
  $.ajax({
    url:"script/_addtowns.php",
    type:"POST",
    data:$("#addtownsForm").serialize(),
    beforeSend:function(){

    },
    success:function(res){
       console.log(res);
       if(res.success == 1){
         $("#kt_form input").val("");
         Toast.success('تم الاضافة');
         gettowns($("#townsesTable"));
       }else{
           $("#town_name_err").text(res.error["town_err"]);
           $("#town_city_err").text(res.error["city_err"]);
           $("#center_err").text(res.error["center_err"]);
           Toast.warning("هناك بعض المدخلات غير صالحة",'خطأ');
       }

    },
    error:function(e){
     console.log(e);
     Toast.error('خطأ');
    }
  });
}
function edittowns(id){
  $("#edittownsid").val(id);
  getCities($("#e_town_city"));
  $.ajax({
    url:"script/_getTown.php",
    data:{id: id},
    success:function(res){
      if(res.success == 1){
        $.each(res.data,function(){
          $('#e_town_name').val(this.name);
          $('#e_town_city').selectpicker('val', this.city_id);
        });
      }
      console.log(res);
    },
    error:function(e){
      console.log(e);
    }
  });
}
function updatetowns(){
    $.ajax({
       url:"script/_updateTown.php",
       type:"POST",
       data:$("#edittownsForm").serialize(),
       beforeSend:function(){

       },
       success:function(res){
          console.log(res);
       if(res.success == 1){
         $("#kt_form input").val("");
          Toast.success('تم التحديث');
          gettowns($("#townsesTable"));
       }else{
           $("#e_town_name_err").text(res.error["town_name_err"]);
           $("#e_town_city_err").text(res.error["town_city_err"]);
           Toast.warning("هناك بعض المدخلات غير صالحة",'خطأ');
       }

       },
       error:function(e){
        Toast.error('خطأ');
        console.log(e);
       }
    })
}
function deletetowns(id){
  if(confirm("هل انت متاكد من الحذف")){
      $.ajax({
        url:"script/_deleteTown.php",
        type:"POST",
        data:{id:id},
        success:function(res){
          console.log(res);
         if(res.success == 1){
           Toast.success('تم الحذف');
           gettowns($("#townsesTable"));
         }else{
           Toast.warning(res.msg);
         }
        } ,
        error:function(e){
          console.log(e);
        }
      });
  }
}
</script>