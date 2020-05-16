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
.tdstyle {
  color: #000000;
  font-weight: bold;
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
  font-size: 18px;
}
#total-section {
  background-color: #242939;
  border-radius: 5px;
  box-shadow: 0px 0px 0px #444444;
  margin-top:5px;
}
.table td {
  padding: 4px !important;
  text-align: center !important;
}
.danger {
  display: block;
  background-color: #990000;
  color:#FFFFFF;
  text-align: center !important;
}
.success {
  display: block;
  background-color: #990000;
  color:#FFFFFF;
  text-align: center !important;
}
.span {
  display: inline-block;
  width: 150px;
}

hr {
  border-bottom: #FF6347 2px solid;
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
    <form id="storedataform" class="kt-form kt-form--fit kt-margin-b-20">
          <fieldset><legend>فلتر</legend>
          <div class="row kt-margin-b-20">
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>السوق او الصفحه:</label>
            	<select onchange="getStoreDetails();storeInfo()" data-show-subtext="true" data-live-search="true"  class="selectpicker form-control kt-input" id="store" name="store" data-col-index="7">
            		<option value="">Select</option>
            	</select>
            </div>
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>الشحنات المستلمة:</label>
            	<button type="button" onclick="getStoreDetails();" class="btn-success btn  kt-input">كشف بالشحنات المستلمة</button>
            </div>
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>الشحنات الراجعه:</label>
            	<button type="button" onclick="getStoreReturned();" class="btn-danger btn  kt-input">كشف بالرواجع</button>
            </div>
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>جميع الشحنات:</label>
            	<button type="button" onclick="getStoreAllOrders();" class="btn-warning btn kt-input">جميع الشحنات</button>
            </div>
          </div>
          </fieldset>
            <div class="row">
              <div class="col-md-3" id="store_info">
              </div>
              <div class="col-md-9" id="store_data">


              </div>
            </div>
            <hr />
  	    	<table class="table  table-bordered  responsive no-wrap" id="tb-invioces">
  			       <thead>
  	  						<tr>
          						<th>#</th>
          						<th>رقم الفاتوره</th>
          						<th>اسم الصفحه</th>
          						<th>اسم العميل</th>
          						<th>رقم هاتف العميل</th>
          						<th>التاريخ</th>
          						<th>الملف</th>
          						<th>حالة الفاتورة</th>
          						<th>تعديل</th>
  		  					</tr>
        	            </thead>
                      <tbody id="invoicesTable">
                      </tbody>
        </table>
		<!--begin: Datatable -->
        </form>
        <!--end: Datatable -->
	</div>

</div>

</div>
<!-- end:: Content -->
</div>
<input type="hidden" id="user_branch" value="<?php echo $_SESSION['user_details']['branch_id'];?>"/>
<input type="hidden" id="user_role" value="<?php echo $_SESSION['role'];?>"/>
            <!--begin::Page Vendors(used by this page) -->
                            <script src="assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
                        <!--end::Page Vendors -->



            <!--begin::Page Scripts(used by this page) -->
                            <script src="assets/js/demo1/pages/components/datatables/extensions/responsive.js" type="text/javascript"></script>
<script src="js/getClients.js" type="text/javascript"></script>
<script src="js/getStores.js" type="text/javascript"></script>
<script type="text/javascript">
$('#tb-invioces').DataTable();
function  getStoreDetails(){
  $.ajax({
    url:"script/_getStoreDetails.php",
    type:"POST",
    data:$("#storedataform").serialize(),
    beforeSend:function(){
       $("#store_data").addClass('loading');
       $("#tb-invioces").DataTable().destroy();
       $("#invoicesTable").html("");
       $("#store_data").html("");
    },
    success:function(res){
      $("#store_data").removeClass('loading');
      console.log(res);
      content ="";
      $.each(res.data,function(k,v){
         content = content + '<h1 style="color:#131357">'+k+'</h1>';
         content = content +
		  `<table class="table table-striped  table-bordered table-hover table-checkable responsive no-wrap" id="tb-orders">
			       <thead>
	  						<tr>
										<th>رقم الشحنه</th>
										<th>رقم الوصل</th>
										<th>تاريخ الطلب</th>
										<th>رقم المستلم</th>
										<th>العنوان</th>
										<th>مبلغ الوصل</th>
										<th>المبلغ المستلم</th>
										<th>الخصم</th>
										<th>سعر التوصيل</th>
										<th>الصافي للعميل</th>
                                        <th>حالة الطلب</th>

                            </tr>
                   </thead>
                   <tbody>`;
             $.each(v,function(){
                   content = content +
                       '<tr>'+
                          '<td>'+this.id+'</td>'+
                          '<td>'+this.order_no+'</td>'+
                          '<td>'+this.dat+'</td>'+
                          '<td>'+this.customer_phone+'</td>'+
                          '<td>'+this.city_name+'-'+this.town_name+'-'+this.address+'</td>'+
                          '<td>'+this.price+'</td>'+
                          '<td>'+this.new_price+'</td>'+
                          '<td>'+this.discount+'</td>'+
                          '<td>'+this.dev_price+'</td>'+
                          '<td>'+this.client_price+'</td>'+
                          '<td>'+this.status_name+'</td>'+
                       '</tr>'
                   ;
             });
         content = content + '</tbody></table><hr>';
         $("#store_data").append(content);
         content = "";
      });
      if(res.success == 1){
      $("#store_data").append(
        '<table class="table table-striped  table-bordered">'+
          '<tr>'+
            '<td>عدد الطلبيات</td>'+
            '<td>المبلغ الكلي</td>'+
            '<td>مبلغ التوصيل</td>'+
            '<td>الخصم</td>'+
            '<td>الصافي للعميل</td>'+
            '<td>انشاء فاتوره</td>'+
          '</tr>'+
          '</tr>'+
            '<td>'+res.pay.orders+'</td>'+
            '<td>'+res.pay.income+'</td>'+
            '<td>'+res.pay.dev+'</td>'+
            '<td>'+res.pay.discount+'</td>'+
            '<td>'+res.pay.client_price+'</td>'+
            '<td><button onclick="makeInvoice()" type="button" class="btn btn-success">انشاء كشف</button></td>'+
          '</tr>'+
        '</table>'
      );
      }
     $.each(res.invoice,function(){
     if(this.orders_status == 4){
       bg = 'success';
     }else if(this.orders_status == 6){
       bg = 'danger';
     }else if(this.orders_status == 7){
       bg = 'warning';
     }else{
       bg = "";
     }
     if(this.invoice_status == 1){
       invoice_status = "تم التحاسب";
       btn = '<button type="button" class="btn btn-danger" onclick="unpayInvoice('+this.id+')" >الغأ التحاسب</button>';
     }else{
       invoice_status = "لم يتم التحاسب";
       btn = '<button type="button" class="btn btn-success" onclick="payInvoice('+this.id+')">تم التحاسب</button>';

     }
      $("#invoicesTable").append(
       '<tr class="">'+
            '<td></td>'+
            '<td>'+this.id+'</td>'+
            '<td>'+this.store_name+'</td>'+
            '<td>'+this.client_name+'</td>'+
            '<td>'+this.client_phone+'</td>'+
            '<td>'+this.in_date+'</td>'+
            '<td><a href="invoice/'+this.path+'" target="_blank">تحميل ملف الفاتوره</a></td>'+
            '<td>'+invoice_status+'</td>'+
            '<td>'+
                btn+
                '<button type="button" class="btn btn-clean btn-link" onclick="deleteInvoice('+this.id+')" data-toggle="modal" data-target="#deleteOrderModal"><span class="flaticon-delete"></sapn></button>'+
            '</td>'+
        '</tr>');
     });

     var table= $('#tb-orders').DataTable();
     var myTable= $('#tb-invioces').DataTable({
      "oLanguage": {
        "sLengthMenu": "عرض_MENU_سجل",
        "sSearch": "بحث:"
      },

      });
    },
    error:function(e){
     $("#store_data").removeClass('loading');
     console.log(e);
    }
  })
}

function  getStoreAllOrders(){
  $.ajax({
    url:"script/_getStoreAllOrders.php",
    type:"POST",
    data:$("#storedataform").serialize(),
    beforeSend:function(){
       $("#store_data").addClass('loading');
       $("#tb-invioces").DataTable().destroy();
       $("#tb-orders").DataTable().destroy();
       $("#invoicesTable").html("");
       $("#store_data").html("");
    },
    success:function(res){
      $("#store_data").removeClass('loading');
      console.log(res);
      content ="";
         content = content + '<h1 style="color:#131357">جميع الطلبيات</h1>';
         content = content +
		  `<table class="table table-striped  table-bordered table-hover table-checkable responsive no-wrap" id="tb-orders">
			       <thead>
	  						<tr>
										<th>رقم الشحنه</th>
										<th>رقم الوصل</th>
										<th>تاريخ الطلب</th>
										<th>رقم المستلم</th>
										<th>العنوان</th>
										<th>مبلغ الوصل</th>
										<th>المبلغ المستلم</th>
										<th>الخصم</th>
										<th>سعر التوصيل</th>
										<th>الصافي للعميل</th>
                                        <th>حالة الطلب</th>

                            </tr>
                   </thead>
                   <tbody>`;
      $.each(res.data,function(){
        content = content +
             '<tr>'+
                '<td>'+this.id+'</td>'+
                '<td>'+this.order_no+'</td>'+
                '<td>'+this.dat+'</td>'+
                '<td>'+this.customer_phone+'</td>'+
                '<td>'+this.city_name+'-'+this.town_name+'-'+this.address+'</td>'+
                '<td>'+this.price+'</td>'+
                '<td>'+this.new_price+'</td>'+
                '<td>'+this.discount+'</td>'+
                '<td>'+this.dev_price+'</td>'+
                '<td>'+this.client_price+'</td>'+
                '<td>'+this.status_name+'</td>'+
             '</tr>';
      });
      content = content + '</tbody></table><hr>';
      $("#store_data").append(content);
      $("#store_data table").DataTable({});
      $("#tb-orders").DataTable();
    },
    error:function(e){
     $("#store_data").removeClass('loading');
     console.log(e);
    }
  })
}

function getStoreReturned(){
  $.ajax({
    url:"script/_getStoreReturned.php",
    type:"POST",
    data:$("#storedataform").serialize(),
    beforeSend:function(){
       $("#store_data").addClass('loading');
       $("#tb-invioces").DataTable().destroy();
       $("#tb-orders").DataTable().destroy();
       $("#invoicesTable").html("");
       $("#store_data").html("");
    },
    success:function(res){
      $("#store_data").removeClass('loading');
      console.log(res);
      content ="";
      content = content + '<h1 style="color:#131357">الروجع</h1>';
      content = content + '<br /><button onclick="makeInvoiceForReturned()" type="button" class="btn btn-danger" name="printreturned">طباعه كشف بالرواجع</button>';
      content = content +
		  `<table class="table table-striped  table-bordered table-hover table-checkable responsive no-wrap" id="tb-orders">
			       <thead>
	  						<tr>
										<th>رقم الشحنه</th>
										<th>رقم الوصل</th>
										<th>تاريخ الطلب</th>
										<th>رقم المستلم</th>
										<th>العنوان</th>
										<th>مبلغ الوصل</th>
										<th>المبلغ المستلم</th>
										<th>الخصم</th>
										<th>سعر التوصيل</th>
										<th>الصافي للعميل</th>
                                        <th>حالة الطلب</th>

                            </tr>
                   </thead>
                   <tbody>`;
           $.each(res.data,function(){
                 content = content +
                       '<tr>'+
                          '<td>'+this.id+'</td>'+
                          '<td>'+this.order_no+'</td>'+
                          '<td>'+this.dat+'</td>'+
                          '<td>'+this.customer_phone+'</td>'+
                          '<td>'+this.city_name+'-'+this.town_name+'-'+this.address+'</td>'+
                          '<td>'+this.price+'</td>'+
                          '<td>'+this.new_price+'</td>'+
                          '<td>'+this.discount+'</td>'+
                          '<td>'+this.dev_price+'</td>'+
                          '<td>'+this.client_price+'</td>'+
                          '<td>'+this.status_name+'</td>'+
                       '</tr>'
                   ;
             });
      content = content + '</tbody></table><hr>';
      $("#store_data").append(content);
      $("#store_data table").DataTable({});
     $.each(res.invoice,function(){
     if(this.orders_status == 4){
       bg = 'success';
     }else if(this.orders_status == 6){
       bg = 'danger';
     }else if(this.orders_status == 7){
       bg = 'warning';
     }else{
       bg = "";
     }
     if(this.invoice_status == 1){
       invoice_status = "راجع للعميل";
       btn = '<button type="button" class="btn btn-danger" onclick="unpayInvoice('+this.id+')" >ارجاع للمخزن الرئيسي</button>';
     }else{
       invoice_status = "رواجع";
       btn = '<button type="button" class="btn btn-success" onclick="payInvoice('+this.id+')">ارجاع للعميل</button>';

     }
      $("#invoicesTable").append(
       '<tr class="">'+
            '<td></td>'+
            '<td>'+this.id+'</td>'+
            '<td>'+this.store_name+'</td>'+
            '<td>'+this.client_name+'</td>'+
            '<td>'+this.client_phone+'</td>'+
            '<td>'+this.in_date+'</td>'+
            '<td><a href="invoice/'+this.path+'" target="_blank">تحميل ملف الفاتوره</a></td>'+
            '<td>'+invoice_status+'</td>'+
            '<td>'+
                btn+
                '<button type="button" class="btn btn-clean btn-link" onclick="deleteInvoice('+this.id+')" data-toggle="modal" data-target="#deleteOrderModal"><span class="flaticon-delete"></sapn></button>'+
            '</td>'+
        '</tr>');
     });
     $("#tb-orders").DataTable();
     var myTable= $('#tb-invioces').DataTable({
      "oLanguage": {
        "sLengthMenu": "عرض_MENU_سجل",
        "sSearch": "بحث:"
      },

      });
    },
    error:function(e){
     $("#store_data").removeClass('loading');
     console.log(e);
    }
  });
}
function storeInfo(){
  $.ajax({
    url:"script/_getStoreInfo.php",
    type:"POST",
    beforeSend:function(){
      $("#store_info").html('');
      $("#store_info").addClass('loading');
    },
    data:$("#storedataform").serialize(),
    success:function(res){
     $("#store_info").removeClass('loading');
     console.log(res);
     $.each(res.data,function(){
       $("#store_info").append(
         '<h2>معلومات الزبون</h2><hr>'+
         '<h5><span class="span">اسم العميل: </span><span  class="res">'+this.client_name+'</span></h5>'+
         '<h5><span class="span">هاتف: </span><span class="res">'+this.client_phone+'</span></h5>'+
         '<h5><span class="span">الشحنات الكلية: </span><span class="res text-info">'+this.total+'</span></h5>'+
         '<h5><span class="span">الشحنات المستلمة: </span><span class="res text-success">'+this.recived+'</span></h5>'+
         '<h5><span class="span">الشحنات الراجعه: </span><span class="res text-danger">'+this.returned+'</span></h5>'+
         '<h5><span class="span">الشحنات المعلقه: </span><span class="res text-warning">'+this.others+'</span></h5>'+
         '<h5><span class="span" >التاريخ: </span><span class="res">'+this.date+'</span></h5>'
       );
     });
    },
    error:function(e){
     $("#store_info").removeClass('loading');
     console.log(e);
    }
  });
}
function makeInvoice() {
 if(Number($("#store").val()) > 0){
        $.ajax({
            url:"script/_makeInvoiceForAll.php",
            type:"POST",
            data: $("#storedataform").serialize(),
            success:function(res){
            console.log(res);
                  if(res.success == 1){
                    getStoreDetails();
                  }else{
                   Toast.warning("خطأ");
                  }
                },
                error:function(e){
                  console.log(e);
                }
              });
    }else{
      Toast.warning("يحب تحديد الصفحه");
    }
}
function makeInvoiceForReturned() {
 if(Number($("#store").val()) > 0){
        $.ajax({
            url:"script/_makeInvoiceForReturned.php",
            type:"POST",
            beforeSend:function(){
              $("#store_data").addClass("loading");
            },
            data: $("#storedataform").serialize()+"&orderStatus=6",
            success:function(res){
              $("#store_data").removeClass("loading");
            console.log(res);
                  if(res.success == 1){
                    getStoreReturned();
                  }else{
                   Toast.warning("خطأ");
                  }
                },
                error:function(e){
                  console.log(e);
                }
              });
    }else{
      $("#store_data").removeClass("loading");
      Toast.warning("يحب تحديد الصفحه");
    }
}
function payInvoice(id){
  if(confirm("هل انت متاكد من دفع الفاتوره")){
      $.ajax({
        url:"script/_payInvoice.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success('تم الدفع');
           getStoreDetails();
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
function deleteInvoice(id){
  if(confirm("هل انت متاكد من الحذف")){
      $.ajax({
        url:"script/_deleteInvoice.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success('تم الحذف');
           getStoreDetails();
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
function unpayInvoice(id){
  if(confirm("هل انت متاكد من الغأ دفع الفاتوره")){
      $.ajax({
        url:"script/_unpayInvoice.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success('تم الدفع');
           getStoreDetails();
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
$( document ).ready(function(){
getStores($("#store"));
});

</script>