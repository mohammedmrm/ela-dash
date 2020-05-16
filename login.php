<?php
session_start();
require("script/dbconnection.php");
$sql = "select id from staff";
$res = getData($con,$sql);
if(count($res) == 0){
   header("location: install.php");
   die();
}
?>
<!DOCTYPE html>
<!--
Theme: Keen - The Ultimate Bootstrap Admin Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: You must have a valid license purchased only from https://themes.getbootstrap.com/product/keen-the-ultimate-bootstrap-admin-theme/ in order to legally use the theme for your project.
-->
<?php
include_once("config.php");
?>
<html lang="en" >
    <!-- begin::Head -->
    <head><!--begin::Base Path (base relative path for assets of this page) -->
<base href=""><!--end::Base Path -->
        <meta charset="utf-8"/>

        <title>Al-Nahar Al-Thalath</title>
        <meta name="description" content="User login example">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />


            <!--begin::Page Custom Styles(used by this page) -->
                             <link href="./assets/css/demo1/pages/login/login-v2.css" rel="stylesheet" type="text/css" />
                        <!--end::Page Custom Styles -->

        <!--begin::Global Theme Styles(used by all pages) -->
                    <link href="./assets/vendors/global/vendors.bundle.css" rel="stylesheet" type="text/css" />
                    <link href="./assets/css/demo1/style.bundle.css" rel="stylesheet" type="text/css" />
                <!--end::Global Theme Styles -->

	    <!--begin::Layout Skins(used by all pages) -->

<link href="./assets/css/demo1/skins/header/base/light.css" rel="stylesheet" type="text/css" />
<link href="./assets/css/demo1/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
<link href="./assets/css/demo1/skins/brand/navy.css" rel="stylesheet" type="text/css" />
<link href="./assets/css/demo1/skins/aside/navy.css" rel="stylesheet" type="text/css" />	    <!--end::Layout Skins -->
<link rel="shortcut icon" href="./assets/media/logos/favicon.ico" />
<style>

     /* arabic */
        @font-face {
          font-family: 'Cairo';
          font-style: normal;
          font-weight: 400;
          font-display: swap;
          src: local('Cairo'), local('Cairo-Regular'), url(Cairofont.woff2) format('woff2');
          unicode-range: U+0600-06FF, U+200C-200E, U+2010-2011, U+204F, U+2E41, U+FB50-FDFF, U+FE80-FEFC;
        }
        /* latin-ext */
        @font-face {
          font-family: 'Cairo';
          font-style: normal;
          font-weight: 400;
          font-display: swap;
          src: local('Cairo'), local('Cairo-Regular'), url(Cairofont.woff2) format('woff2');
          unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        body * :not(.fa):not(.la):not(.kt-widget-20__label):not(.kt-widget-19__label) {
          font-family: 'Cairo', sans-serif !important;
          direction: rtl;
        }

        body {

        }
</style>
</head>
    <!-- end::Head -->

    <!-- begin::Body -->
    <body  class="kt-login-v2--enabled kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading"  >
<!-- begin:: Page -->
	<div class="kt-grid kt-grid--ver kt-grid--root">
		<div class="kt-grid__item   kt-grid__item--fluid kt-grid  kt-grid kt-grid--hor kt-login-v2" id="kt_login_v2">
	<!--begin::Item-->
	<div class="kt-grid__item  kt-grid--hor">
		<!--begin::Heade-->
		<div class="kt-login-v2__head">
           <div class="col-md-4"></div>
<!--           <div class="col-md-4">
             <div class="text-center">
                  <h1>السكة</h1>
                  <h2>للتوصيل السريع</h2>
                  <p>
                      <?php $t=time(); echo(date("Y-m-d",$t));  ?>

                  </p>
              </div>
            </div>-->
            <div class="col-md-4">
              <div class="kt-login-v2__logo">
  				<a href="#">
  					<img height="120px" src="<?php echo $config['Company_logo'];?>" alt="" />
  				</a>
  			</div>
			</div>
            <div class="col-md-4"></div>
		</div>
		<!--begin::Head-->
	</div>
	<!--end::Item-->

	<!--begin::Item-->
	<div class="kt-grid__item  kt-grid  kt-grid--ver  kt-grid__item--fluid">
		<!--begin::Body-->
		<div class="kt-login-v2__body">
			<!--begin::Wrapper-->
			<div class="kt-login-v2__wrapper">
				<div class="kt-login-v2__container">
					<div class="kt-login-v2__title">
						<h3>سجل الدخول لحسابك</h3>
					</div>

					<!--begin::Form-->
					<form class="kt-login-v2__form kt-form" action="" autocomplete="off">
                        <div class="form-group">
                            <label id="msg" class="text-danger"></label>

                        </div>
                        <div class="form-group">
							<input class="form-control" type="text" placeholder="رقم الهاتف" name="username" id="username" autocomplete="off">
						</div>
						<div class="form-group">
							<input class="form-control" type="password" placeholder="كلمة المرور" name="password" id="password" autocomplete="off">
						</div>
						<!--begin::Action-->
						<div class="kt-login-v2__actions">
							<a href="#" class="kt-link kt-link--brand">
								نسيت كلمة السر ؟
							</a>
							<button type="button" onclick="login()" class="btn btn-primary btn-brand">سجل الدخول</button>
						</div>
                        <input type="hidden" id="redirect" value="<?php echo $_REQUEST['redirect'];?>"/>
						<!--end::Action-->
					</form>
					<!--end::Form-->

					<!--begin::Separator-->
					<div class="kt-separator kt-separator--space-lg  kt-separator--border-solid"></div>
					<!--end::Separator-->
				</div>
			</div>
			<!--end::Wrapper-->

			<!--begin::Image-->
			<div class="kt-login-v2__image">
				<img src="./assets/media/misc/bg_icon.svg" alt="">
			</div>
			<!--begin::Image-->
		</div>
		<!--begin::Body-->
	</div>
	<!--end::Item-->

	<!--begin::Item-->
	<div class="kt-grid__item">
		<div class="kt-login-v2__footer">
			<div class="kt-login-v2__link">
				<a href="#" class="kt-link kt-font-brand">Privacy</a>
				<a href="#" class="kt-link kt-font-brand">Legal</a>
				<a href="#" class="kt-link kt-font-brand">Contact</a>
			</div>

			<div class="kt-login-v2__info">
				<a href="#" class="kt-link">&copy; 2019 Mohammed Ridha Mohammed</a>
			</div>
		</div>
	</div>
	<!--end::Item-->
</div>	</div>
	<!-- end:: Page -->



        <!-- begin::Global Config(global config for global JS sciprts) -->
        <script>
            var KTAppOptions = {
    "colors": {
        "state": {
            "brand": "#5d78ff",
            "metal": "#c4c5d6",
            "light": "#ffffff",
            "accent": "#00c5dc",
            "primary": "#5867dd",
            "success": "#34bfa3",
            "info": "#36a3f7",
            "warning": "#ffb822",
            "danger": "#fd3995",
            "focus": "#9816f4"
        },
        "base": {
            "label": [
                "#c5cbe3",
                "#a1a8c3",
                "#3d4465",
                "#3e4466"
            ],
            "shape": [
                "#f0f3ff",
                "#d9dffa",
                "#afb4d4",
                "#646c9a"
            ]
        }
    }
};
function login(){
    $.ajax({
    url:"script/_login.php",
    type:"POST",
    data:{username:$("#username").val(), password:$("#password").val(), redirect:$("#redirect").val()},
    beforeSend:function(){

    },
    success:function(res){
      console.log(res);
      if(res.msg == 1){
        if(ValidURL(res.redirect)){
         window.location.href = res.redirect;
        }else{
         window.location.href = "index.php";
       }
      }else{
        $("#msg").text(res.msg);
      }
    },
    error:function(e){
      console.log(e.responseText);
    }
  });
}
function ValidURL(str) {
  var regex = /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
  if(!regex .test(str)) {
    return false;
  } else {
    return true;
  }
}

</script>

<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="./assets/vendors/global/vendors.bundle.js" type="text/javascript"></script>
<script src="./assets/js/demo1/scripts.bundle.js" type="text/javascript"></script>
<!--end::Global Theme Bundle -->

<!--begin::Page Scripts(used by this page) -->
<script src="./assets/js/demo1/pages/custom/user/login.js" type="text/javascript"></script>
<!--end::Page Scrip