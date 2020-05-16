<?php
if(file_exists("script/_access.php")){
require_once("script/_access.php");
access([1,2,3,5,6]);
}
?>

<style>
#order_map {
  height: 400px;
}
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
#dev_price_div {
  display: none;
}
.toast-message {
  color: #222222 !important;
  font-size:16px !important;
}

</style>
<link href="assets/css/demo1/pages/wizards/wizard-v2.rtl.css" rel="stylesheet" type="text/css" />
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
                            <h3 class="kt-subheader__title">اضافة طلب</h3>

                            <span class="kt-subheader__separator kt-hidden"></span>
        </div>

    </div>
</div>
<!-- end:: Subheader -->
					<!-- begin:: Content -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet">
	<div class="kt-portlet__body kt-portlet__body--fit">
		<div class="kt-grid kt-grid--desktop-xl kt-grid--ver-desktop-xl  kt-wizard-v2" id="kt_wizard_v2" data-ktwizard-state="step-first">
			<div class="kt-grid__item kt-wizard-v2__aside">

				<!--begin: Form Wizard Nav -->
				<div class="kt-wizard-v2__nav">
					<div class="kt-wizard-v2__nav-items">
						<!--doc: Replace A tag with SPAN tag to disable the step link click -->
						<a class="kt-wizard-v2__nav-item" id="s1" href="#" data-ktwizard-type="step" data-ktwizard-state="current">
							<span>1</span><i class="fa fa-check"></i> معلومات الوصل
						</a>
						<a class="kt-wizard-v2__nav-item" id="s2" href="#" data-ktwizard-type="step">
							<span>2</span><i class="fa fa-check"></i> معلومات العميل
						</a>
						<a class="kt-wizard-v2__nav-item" id="s3" href="#" data-ktwizard-type="step">
							<span>3</span><i class="fa fa-check"></i> معلومات المستلم
						</a>
						<a class="kt-wizard-v2__nav-item" id="s4" href="#" data-ktwizard-type="step">
							<span>4</span><i class="fa fa-check"></i> معلومات الفرع
						</a>
						<a class="kt-wizard-v2__nav-item" id="s5" href="#" data-ktwizard-type="step">
							<span>5</span><i class="fa fa-check"></i> اكمال واضافة
						</a>
					</div>
				</div>
				<!--end: Form Wizard Nav -->

			</div>
			<div class="kt-grid__item kt-grid__item--fluid kt-wizard-v2__wrapper">
				<!--begin: Form Wizard Form-->
				<form class="kt-form" id="kt_form">

					<!--begin: Form Wizard Step 1-->
					<div class="kt-wizard-v2__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
						<div class="kt-heading kt-heading--md">معلومات الوصل</div>
						<div class="kt-separator kt-separator--height-xs"></div>
						<div class="kt-form__section kt-form__section--first">
							<div class="row">
								<div class="col-xl-6">
                                    <fieldset><legend>معلومات الوصل</legend>
  								 	<div class="form-group">
  										<label>رقم الوصل</label>
  										<input type="text" class="form-control" name="order_no" placeholder="رقم الطلب" value="">
  										<span id="order_no_err" class="form-text text-danger"></span>
  									</div>
  									<div class="form-group">
  										<label>المبلغ الكلي</label>
  										<input type="text" class="form-control" name="order_price" placeholder="المبلغ" value="">
  										<span id="order_price_err" class="form-text text-danger"></span>
  									</div>
  									<div class="form-group">
                                        <label  class="" style="font-size: 15px;">
                                            مع التوصيل<input id="with_dev_err"  type="checkbox" name="with_dev" id="with_dev" checked >
                                            <span></span>
                                        </label>
                                    </div>
                                    </fieldset>
								</div>
								<div class="col-xl-6">
                                    <fieldset><legend>معلومات محتوى الطرد</legend>
									<div class="form-group">
										<label>نوع الطلب</label>
										<select data-show-subtext="true" data-live-search="true" class="selectpicker form-control" name="order_type" placeholder="نوع الطلب" value="">
                                          <option value="عام">عامة</option>
                                          <option value="ملابس">ملابس</option>
                                          <option value="الكترونيات">الكترونيات</option>
                                          <option value="وثائق">وثائق</option>
                                          <option value="اثاث">اثاث</option>
                                        </select>
										<span id="order_type_err" class="form-text text-danger"></span>
									</div>
									<div class="form-group">
										<label>العدد</label>
										<input type="number" class="form-control" id="qty" name="qty" value="1"/>
										<span id="qty_err" class="form-text text-danger"></span>
									</div>
									<div class="form-group">
										<label>الوزن</label>
										<input type="number" class="form-control" id="weight" name="weight" value="1"/>
										<span id="weight_err" class="form-text text-danger"></span>
									</div>
                                    </fieldset>
								</div>
							</div>
						</div>
					</div>
					<!--end: Form Wizard Step 1-->

					<!--begin: Form Wizard Step 2-->
					<div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
						<div class="kt-heading kt-heading--md">معلومات العميل</div>
						<div class="kt-separator kt-separator--height-xs"></div>
						<div class="kt-form__section kt-form__section--first">
							<div class="row">

								<div class="col-xl-6">
                                    <fieldset><legend>معلومات العميل</legend>
									<div class="form-group">
										<label>الفرع</label>
                                        <select data-show-subtext="true" data-live-search="true" type="text" class="selectpicker form-control dropdown-primary" name="branch" id="branch"  value="">

                                        </select>
                                        <span id="branch_err" class="form-text text-danger"></span>
									</div>
                                    <div class="form-group">
										<label>العميل</label>
                                        <select data-show-subtext="true" data-live-search="true" type="text" class="selectpicker form-control dropdown-primary" name="client" id="client"  value="">

                                        </select>
                                        <span id="client_err" class="form-text text-danger"></span>
									</div>
							        <div class="form-group">
										<label>هاتف</label>
										<input class="form-control" name="client_phone" id="client_phone" value="" />
                                        <span id="client_phone_err" class="form-text text-danger"></span>
									</div>
                                    </fieldset>
								</div>
                                <div class="col-xl-6">
                                   <fieldset><legend>اضافة عميل</legend>
							        <div class="form-group">
                                        <input data-toggle="modal" data-target="#addClientModal" type="button" class="btn btn-primary" name="add_client" id="add_client" value="اضافة عميل"/>
                                    </div>
                                   </fieldset>
                                </div>
							</div>
						</div>
					</div>
					<!--end: Form Wizard Step 2-->

					<!--begin: Form Wizard Step 3-->
					<div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
						<div class="kt-heading kt-heading--md">العنوان</div>
						<div class="kt-separator kt-separator--height-xs"></div>
						<div class="kt-form__section kt-form__section--first">
                            <div class="row">
								<div class="col-xl-6">
                                <fieldset><legend>معلومات المستلم</legend>
									<div class="form-group">
										<label>الاسم</label>
										<input type="text" class="form-control" name="customer_name" value="">
										<span id="customer_name_err" class="form-text text-danger"></span>
									</div>
                                    <div class="form-group">
										<label>رقم الهاتف</label>
										<input type="text" class="form-control" name="customer_phone" value="" />
										<span id="customer_phone_err" class="form-text text-danger"></span>
									</div>
                                    </fieldset>
								</div>
								<div class="col-xl-6">
                                <fieldset><legend>العنوان</legend>
									<div class="form-group">
										<label>المحافظة</label>
										<select data-show-subtext="true" data-live-search="true" type="text" class="selectpicker form-control dropdown-primary" name="city" id="city"  value="">

                                        </select>
                                        <span id="city_err"class="form-text text-danger"></span>
									</div>
                                    <div class="form-group">
										<label>الدينة (القضاء)</label>
										<select data-show-subtext="true" data-live-search="true" type="text" class="selectpicker form-control dropdown-primary" name="town" id="town"  value="">

                                        </select>
                                        <span id="town_err" class="form-text text-danger"></span>
									</div>
                                    <div class="form-group">
										<label>تفاصيل اكثر عن العنوان (اختياري)</label>
										<textarea type="text" class="form-control" name="order_address" value="" ></textarea>
										<span id="order_address_err" class="form-text text-danger"></span>
									</div>
                                    </fieldset>
								</div>
							</div>

							<div class="row">
                            <div class="kt-heading kt-heading--md"></div>
                            <!--<div class="col-xl-12" id="order_map">

                            </div>
                             <div class="text-red" id="markerStatus"><i>Click and drag the marker. Zoom in for good postion or use
                             <a href='#' id='gps'> GPS </a> </i> Please click the map after get the position by GPS</div>
                             <br /><br />
                             <div class="text-info" id='longlat'></div>
                             <br />
                             <div class="text-primary" id='address'></div>
                             <br />
                             <div class='input-group'>
                              <span class="text-red error" id="err_map" ></span>
                             </div>
                             <div class="text-red input-group err"></div>-->
						</div>
					</div>
                    </div>
					<!--end: Form Wizard Step 3-->

					<!--begin: Form Wizard Step 4-->
					<div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
						<div class="kt-heading kt-heading--md">معلومات الفرع</div>
						<div class="kt-separator kt-separator--height-xs"></div>
						<div class="kt-form__section kt-form__section--first">
                            <div class="row">
								<div class="col-xl-6">
                                   <fieldset><legend>الفرع</legend>
									<div class="form-group">
										<label>الفرع المرسل له</label>
										<select data-show-subtext="true" data-live-search="true" type="text" class="selectpicker form-control dropdown-primary" name="branch_to" id="branch_to"  value="">

                                        </select>
                                        <span id="branch_to_err" class="form-text text-danger"></span>
									</div>
                                    </fieldset>
								</div>

							</div>
						</div>
					</div>
					<!--end: Form Wizard Step 4-->

					<!--begin: Form Wizard Step 5-->
					<div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
						<div class="kt-heading kt-heading--md">الشروط و الملاحظات</div>
						<div class="kt-separator kt-separator--height-xs"></div>
						<div class="kt-form__section kt-form__section--first">
                         <div class="row">
                         <fieldset><legend>ملاحظات</legend>
								<div class="col-xl-6">
                                    <div class="form-group">
										<label>ملاحظات</label>
										<textarea type="text" class="form-control" name="order_note" value="" ></textarea>
										<span id="order_note_err" class="form-text text-danger"></span>
									</div>
						  		</div>
                         </fieldset>
						 </div>

			                <div class="kt-separator kt-separator--border-dashed"></div>
			                <div class="kt-separator kt-separator--height-md"></div>
                            <div class="form-group">
								<label class="kt-checkbox">
                                  بالضغط على اضافة انت توافق شروط الخصوصية الاستخدام <a href="terms.php" target="_blank">Terms and Conditions agreement</a>
		                        </label>
			                </div>
						</div>
					</div>
					<!--end: Form Wizard Step 5-->

					<!--begin: Form Actions -->
					<div class="kt-form__actions">
						<div class="btn btn-outline-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-type="action-prev">
							السابق
						</div>
						<div onclick="addOrder()" class="btn btn-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-type="action-submit">
							اضافة
						</div>
						<div class="btn btn-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-type="action-next">
							التالي
						</div>
					</div>
					<!--end: Form Actions -->
				</form>
				<!--end: Form Wizard Form-->
                <div id="msg"></div>
			</div>
		</div>
	</div>
</div>
</div>
<!-- end:: Content -->				</div>
<script src="assets/js/demo1/pages/custom/wizards/wizard-v2.js" type="text/javascript"></script>

<script type="text/javascript" src="js/location.js"></script>
<script type="text/javascript" src="js/alert.js"></script>
<script type="text/javascript" src="js/getCities.js"></script>
<script type="text/javascript" src="js/getTowns.js"></script>
<script type="text/javascript" src="js/getBraches.js"></script>
<script type="text/javascript" src="js/getClients.js"></script>
<script type="text/javascript">
 getCities($("#city"));
$("#city").change(function() {
 getTowns($("#town"),$("#city").val());
});
 getTowns($("#town"),$("#city").val());


/*var map;
var markersArray = [];
function updateMarkerStatus(str) {
  document.getElementById('markerStatus').innerHTML = str;
}
function updateMarkerAddress(str) {
  document.getElementById('address').innerHTML = str;
}
var geocoder = new google.maps.Geocoder();

function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('Cannot determine address at this location.');
    }
  });
}
function updateMarkerPosition(latLng) {
   document.getElementById('longlat').innerHTML =
    "<input type='hidden' name='lat' value='"+latLng.lat().toFixed(4)+"'/>"+
    "<input type='hidden' name='lng' value='"+latLng.lng().toFixed(4)+"'/>"+
    "Lat: "+latLng.lat().toFixed(6)+" <br /> Lng"+latLng.lng().toFixed(6)+" ";
     geocodePosition(latLng);
}
function initMap()
{
            var latlng = new google.maps.LatLng(40, 12);
            var myOptions = {
                zoom: 2,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("order_map"), myOptions);

            // add a click event handler to the map object
            google.maps.event.addListener(map, "click", function(event)
            {
              // place a marker
              placeMarker(event.latLng);
              // display the lat/lng in your form's lat/lng fields
              updateMarkerPosition(event.latLng);
              updateMarkerPosition(event.latLng);
              geocodePosition(event.latLng);
            });
//            google.maps.event.addListener(marker, 'dragend', function() {
//              placeMarker(event.latLng);
//              // display the lat/lng in your form's lat/lng fields
//              updateMarkerPosition(event.latLng);
//              updateMarkerPosition(event.latLng);
//              geocodePosition(event.latLng);
//            });
}
        function placeMarker(location) {
            // first remove all markers if there are any
            deleteOverlays();

            var marker = new google.maps.Marker({
                position: location,
                map: map,
                draggable: true
            });

            // add marker in markers array
            markersArray.push(marker);

            //map.setCenter(location);
        }

        // Deletes all markers in the array by removing references to them
        function deleteOverlays() {
            if (markersArray) {
                for (i in markersArray) {
                    markersArray[i].setMap(null);
                }
            markersArray.length = 0;
            }
        }
document.getElementById('gps').onclick = function(){
var success  = function(pos){
  var latt    = pos.coords.latitude,
      long   = pos.coords.longitude,
      coords = latt + ',' + long;

map.setCenter({lat: latt, lng: long});
map.setZoom(16);
}
var error = function(){
  alert('Sorry, there is an error unable using GPS');
}
  if (geoPosition.init()){
       geoPosition.getCurrentPosition(success,error,{enableHighAccuracy:true});
  }
  return false;
}
// Onload handler to fire off the app.
google.maps.event.addDomListener(window, 'load', initMap);
*/
function addOrder(){
  $.ajax({
    url:"script/_addOrder.php",
    type:"POST",
    data:$("#kt_form").serialize(),
    beforeSend:function(){
      $("#s1").removeClass("text-danger");
      $("#s2").removeClass("text-danger");
      $("#s3").removeClass("text-danger");
      $("#s4").removeClass("text-danger");
    },
    success:function(res){
        console.log(res);
       if(res.success == 1){
         $("#kt_form input[name='order_no']").val("");
         $("#kt_form input[name='order_price']").val("");
         $("#kt_form input[name='customer_name']").val("");
         $("#kt_form input[name='customer_phone']").val("");
         $("#kt_form input[name='order_note']").val("");
         Toast.success('تم الاضافة');
         $("#kt_form .text-danger").text("");
       }else{
           $("#order_no_err").text(res.error["order_no"]);
           $("#order_type_err").text(res.error["order_type"]);
           $("#order_price_err").text(res.error["order_price"]);
           $("#weight_err").text(res.error["weight"]);
           $("#qty_err").text(res.error["qty"]);
           $("#client_err").text(res.error["client"]);
           $("#client_phone_err").text(res.error["client_phone"]);
           $("#customer_name_err").text(res.error["customer_name"]);
           $("#customer_phone_err").text(res.error["customer_phone"]);
           $("#city_err").text(res.error["city"]);
           $("#town_err").text(res.error["town"]);
           $("#branch_err").text(res.error["branch_from"]);
           $("#branch_to_err").text(res.error["branch_to"]);
           $("#town_err").text(res.error["town"]);
           $("#with_dev_err").text(res.error["with_dev"]);
           $("#order_note_err").text(res.error["order_note"]);
           $("#order_address_err").text(res.error["order_address"]);

           if(
           res.error["order_no"] != null ||
           res.error["order_type"] != null ||
           res.error["order_price"] != null ||
           res.error["dev_price"] != null ||
           res.error["weight"] != null   ||
           res.error["qty"] != null
           ){$("#s1").addClass("text-danger");}
           if(
           res.error["branch_from"] != null ||
           res.error["client_phone"] != null ||
           res.error["client"] != null
           ){$("#s2").addClass("text-danger");}
           if(
           res.error["customer_name"] != null ||
           res.error["customer_phone"] != null ||
           res.error["city"]!= null ||
           res.error["town"]!= null
           ){$("#s3").addClass("text-danger");}
           if(
           res.error["branch_to"] != null
           ){$("#s4").addClass("text-danger");}
           Toast.warning("هناك بعض المدخلات غير صالحة",'خطأ');
       }
    },
    error:function(e){
      console.log(e);
       Toast.error('خطأ');
    }
  });
}

getBraches($("#branch"));
getBraches($("#branch_to"));

$("#branch").change(function(){
  getClients($("#client"),$("#branch").val());
});
  getClients($("#client"),$("#branch").val());

</script>



  <!-- Modal -->
  <div class="modal fade" id="addClientModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">اضافة عميل</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
		<div class="kt-portlet">

			<!--begin::Form-->
			<form class="kt-form" id="addClientForm">
                <div class="row">
  				  <div class="col-md-6">
  				    <div class="kt-portlet__body">
  					<div class="form-group">
  						<label>الفرع</label>
  						<select data-show-subtext="true" data-live-search="true" type="text" class="selectpicker form-control dropdown-primary" name="client_branch" id="client_branch"  value="">
                          </select>
                          <span class="form-text text-danger" id="client_branch_err"></span>
  					</div>
  					<div class="form-group">
  						<label>الاسم الكامل:</label>
  						<input type="name" name="client_name" class="form-control"  placeholder="ادخل الاسم الكامل">
  						<span class="form-text  text-danger" id="client_name_err"></span>
  					</div>
  					<div class="form-group">
  						<label>الايميل:</label>
  						<input type="email" name="client_email" class="form-control" placeholder="ادخل البريد الالكتروني">
  						<span class="form-text text-danger" id="client_email_err"></span>
  					</div>
  					<div class="form-group">
  						<label>رقم الهاتف:</label>
  						<input type="text" name="client_phone" class="form-control" placeholder="ادخل رقم الهاتف">
  						<span  id="client_phone_err"class="form-text  text-danger"></span>
  					</div>
  					<div class="form-group">
  						<label>كلمة السر:</label>
  						<input type="password" name="client_password" class="form-control" placeholder="ادخل كلمة السر">
  						<span class="form-text  text-danger" id="client_password_err"></span>
  					</div>
  	            </div>
  	            </div>
                  <div class="col-md-6">
                    <div class="kt-portlet__body">
    					<div class="form-group">
    						<label>سعر التوصيل بغداد:</label>
    						<input type="text" name="client_dev_price_b" class="form-control" placeholder="">
    						<span class="form-text  text-danger" id="client_dev_price_b_err"></span>
    					</div>
    					<div class="form-group">
    						<label>سعر التوصيل باقي المحافضات:</label>
    						<input type="text" name="client_dev_price_o" class="form-control" placeholder="">
    						<span class="form-text  text-danger" id="client_dev_price_o_err"></span>
    					</div>
    					<div class="form-group">
    						<label>استثنائات:</label>
    						<button type="button" onclick="addexpetionprice()" name="" class="btn btn-success" placeholder="">
                             <span class="flaticon-add"></span>&nbsp;&nbsp;اضافة سعر توصيل لمحافظة معينة
                            </button>
    					 </div>
                         <div id="exceptionCities"></div>
                    </div>
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

<script src="assets/js/demo1/pages/custom/profile/overview-3.js" type="text/javascript"></script>
<script type="text/javascript">
  getBraches($("#client_branch"));
  function addClient(){
  $.ajax({
     url:"script/_addClient.php",
     type:"POST",
     data:$("#addClientForm").serialize(),
     success:function(res){
       if(res.success == 1){
         getClients($("#client"),$("#branch").val());
         $("#addClientForm input").val("");
         Toast.success('تم الاضافة');
       }else{
           $("#client_name_err").text(res.error["client_name_err"]);
           $("#a_client_phone_err").text(res.error["client_phone_err"]);
           $("#client_email_err").text(res.error["client_email_err"]);
           $("#client_branch_err").text(res.error["client_branch_err"]);
           $("#client_password_err").text(res.error["client_password_err"]);

       }
       console.log(res);
     },
     error:function(e){
       console.log(e);
       Toast.error.displayDuration=5000;
       Toast.error('تأكد من المدخلات','خطأ');
     }
  });
  }

indecater = 1;
function addexpetionprice(){
 city =     			'<div class="form-group">'+
    						'<label>سعر توصيل مستثنى</label><br />'+
  					        '<select indecater="'+indecater+'" data-show-subtext="true" data-live-search="true" type="text" class="form-control dropdown-primary" name="client_dev_city_e[]" id="client_dev_city_e[]"  value="">'+
                            '<option>اختر</option>'+
                            '</select>'+
                            '<input type="text" name="client_dev_price_e[]" class="form-control" placeholder="سعر التوصيل">'+
    						'<span class="form-text  text-danger" id="client_dev_price_o_err"></span>'+
    					'</div>'
$("#exceptionCities").append(city);
 getCities($('[indecater="'+indecater+'"]'));
 indecater = indecater +1;
}
  </script>