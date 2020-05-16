
<!-- end:: Subheader -->
					<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h1 class="">
				الوصولات
			</h1>
		</div>
	</div>

	<div class="kt-portlet__body">
     <form id="filtterRequestForm">
		<!--begin: Datatable -->
          <fieldset><legend>طبات الوصولات</legend>
          <div class="row kt-margin-b-20">
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>السوق:</label>
            	<select onchange="getRequest()" data-show-subtext="true" data-live-search="true"  class="selectpicker form-control kt-input" id="store" name="store" data-col-index="7">
            		<option value="">Select</option>
            	</select>
            </div>
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>الحاله:</label>
            	<select onchange="getRequest()" data-show-subtext="true" data-live-search="true"  class="selectpicker form-control kt-input" id="status" name="status" data-col-index="7">
            		<option value="n">-- Select --</option>
            		<option value="2">الطلبات الجديد</option>
            		<option value="1">المؤكده</option>
            	</select>
            </div>
          <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>
          </div>
          </fieldset>
          <div class="row kt-margin-b-20">
            <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
              	<label>عدد السجلات في الصفحة الواحدة</label>
              	 <select onchange="getRequest()" class="form-control kt-input" name="limit" data-col-index="7">
              		<option value="10">10</option>
              		<option value="15">15</option>
              		<option value="20">20</option>
              		<option value="25">25</option>
              		<option value="30">30</option>
              		<option value="50">50</option>
              	</select>
              </div>
            </div>
		<table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="tb-Request">
			       <thead>
	  						<tr>
								<th>العميل</th>
                                <th>السوق</th>
								<th>العدد</th>
								<th>الحالة</th>
								<th>تعديل</th>
							</tr>
      	            </thead>
                            <tbody id="RequestesTable">
                            </tbody>
		</table>
        <div class="kt-section__content kt-section__content--border">
		<nav aria-label="...">
			<ul class="pagination" id="pagination">

			</ul>
        <input type="hidden" id="p" name="p" value="<?php if(!empty($_GET['p'])){ echo $_GET['p'];}else{ echo 1;}?>"/>
		</nav>
     	</div>
        </form>
		<!--end: Datatable -->
	</div>
</div>
</div>
<!-- end:: Content -->

<div class="modal fade" id="printReceipt" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">الوصولات</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
		<div class="kt-portlet">

			<!--begin::Form-->
			<form class="kt-form" id="printReceiptForm">
				<div class="kt-portlet__body">

					<div class="form-group">
						<label>عدد الوصولات:</label>
						<input type="number" id="number" name="number" class="form-control" placeholder="">
						<span  id="number_err"class="form-text  text-danger"></span>
					</div>
	            </div>
	            <div class="kt-portlet__foot kt-portlet__foot--solid">
					<div class="kt-form__actions kt-form__actions--right">
						<button type="button" onclick="printReceipt()" class="btn btn-brand">طباعه</button>
						<button type="reset" data-dismiss="modal" class="btn btn-secondary">الغاء</button>
					</div>
				</div>
                <input type="hidden" id="printid" name="printid" />
			</form>
			<!--end::Form-->
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
<script src="js/getStores.js" type="text/javascript"></script>
<script type="text/javascript">
getStores($("#store"));
function getRequest(){
$.ajax({
  url:"script/_getRequest.php",
  type:"POST",
  data:$("#filtterRequestForm").serialize(),
  beforeSend:function(){
    $("#pagination").html("");
    $("#tb-Request").addClass('loading');
  },
  success:function(res){
    $("#tb-Request").removeClass('loading');
   console.log(res);
   $("#tb-Request").DataTable().destroy();
   $("#RequestesTable").html("");
   $("#RequestesTable").html("");
    $.each(res.data,function(){
     if(this.status == 0 ){
       status = "غير مؤكد";
       color = "text-warning";
       btn =  '<button type="button" class="btn btn-clean btn-icon-lg" onclick="editRequest('+this.id+')" data-toggle="modal" data-target="#editStore"><span class="flaticon-edit"></span></button>';
       btn += '<button type="button" class="btn btn-clean btn-icon-lg" onclick="deleteRequest('+this.id+')"><span class="flaticon-delete"></span></button>';
       btn += '<button type="button" class="btn btn-clean btn-success btn-icon-lg" onclick="confirmRequest('+this.id+')" ><span class="fa fa-check"></span></button>';
     }else{
       status = "مؤكد";
       color = "text-info";
        btn = '<button  type="button" class="btn btn-clean btn-icon-lg" onclick="deleteRequest('+this.id+')" data-toggle="modal" data-target="#editStore"><span class="flaticon-delete"></span></button>';
        btn+= '<button type="button" class="btn btn-clean btn-icon-lg" onclick="updateID('+this.id+')" data-toggle="modal" data-target="#printReceipt"><span class="fa fa-print"></span></button>';
     }

     $("#RequestesTable").append(
       '<tr>'+
            '<td>'+this.client_name+'</td>'+
            '<td>'+this.store_name+'</td>'+
            '<td>'+this.qty+'</td>'+
            '<td class="'+color+'">'+status+'</td>'+
            '<td>'+btn+'</td>'+
      '</tr>');
     });
     $("#tb-Request").DataTable().destroy();
     var myTable= $('#tb-Request').DataTable({
     columns:[
    //"dummy" configuration
        { visible: true }, //col 1
        { visible: true }, //col 2
        { visible: true }, //col 3
        { visible: true }, //col 4
        { visible: true }, //col 5

        ],
       "bPaginate": false,
       "bLengthChange": false,
       "bFilter": false,
       serverPaging: true
});
    },
   error:function(e){
     $("#tb-Request").removeClass('loading');
    console.log(e);
  }
});
}
function printReceipt(){
  window.open("script/_printReceipt.php?printid="+$('#printid').val()+"&number="+$('#number').val(), '_blank');

}
function updateID (id){
    $("#printid").val(id);
}
function confirmRequest(id){
  if(confirm("هل متاكد من تاكيد الطلب")){
      $.ajax({
        url:"script/_confirmRequest.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success(res.msg);
           getRequest();
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
function deleteRequest(id){
  if(confirm("هل متاكد من حذف الطلب ؟")){
      $.ajax({
        url:"script/_deleteRequest.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success(res.msg);
           getRequest();
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
function getRequestPage(page){
    $("#p").val(page);
    getRequest();
}
getRequest();
</script>
<script>


</script>