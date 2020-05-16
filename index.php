<!DOCTYPE html>
<?php
/*if(!isset($_SESSION)){
  session_start();
}
$access_roles = [1,2,3,4,5,6];
if(! in_array($_SESSION['user_details']['role_id'],$access_roles)){
    header("location:".$_SERVER['HOST_NAME']."login.php");
    die();
}*/
require_once("script/_access.php");
access([1,2,3,4,5,6]);
require_once("config.php");


?>
<!-- Theme: Keen - The Ultimate Bootstrap Admin ThemeAuthor: KeenThemesWebsite: http://www.keenthemes.com/Contact: support@keenthemes.comFollow: www.twitter.com/keenthemesDribbble: www.dribbble.com/keenthemesLike: www.facebook.com/keenthemesLicense: You must have a valid license purchased only from https://themes.getbootstrap.com/product/keen-the-ultimate-bootstrap-admin-theme/ in order to legally use the theme for your project.-->
<html  lang="en" >
    <!-- begin::Head -->
    <head>
        <meta charset="utf-8"/>
        <title><?php echo $config['Company_name'];?></title>
        <meta name="description" content="Latest updates and statistic charts">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!--begin::Fonts -->
       <!-- <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
        <script>
        WebFont.load({
                google: {
                        "families":[
                        "Cairo:100,200,300,400,500,600,700,900"]},
                active: function() {
                    sessionStorage.fonts = true; } });
        </script>-->
        <!--end::Fonts -->
        <!--begin::Page Vendors Styles(used by this page) -->
        <link href="./assets/vendors/custom/fullcalendar/fullcalendar.bundle.rtl.css" rel="stylesheet" type="text/css" />
        <!--end::Page Vendors Styles -->
        <!--begin::Global Theme Styles(used by all pages) -->
        <link href="./assets/vendors/global/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />
        <link href="./assets/css/demo1/style.bundle.rtl.css" rel="stylesheet" type="text/css" />
        <!--end::Global Theme Styles -->
        <!--begin::Layout Skins(used by all pages) -->
        <link href="./assets/css/demo1/skins/header/base/light.rtl.css" rel="stylesheet" type="text/css" />
        <link href="./assets/css/demo1/skins/header/menu/light.rtl.css" rel="stylesheet" type="text/css" />
        <link href="./assets/css/demo1/skins/brand/navy.rtl.css" rel="stylesheet" type="text/css" />
        <link href="./assets/css/demo1/skins/aside/navy.rtl.css" rel="stylesheet" type="text/css" />
        <link href="bootstrap-4.3.1-dist/css/toast.css" rel="stylesheet" type="text/css" />
        <link rel="manifest" href="pwa/manifest.webmanifest">
        <!--end::Layout Skins -->
        <link href="" rel="stylesheet">
        <link rel="shortcut icon" href="img/logos/logo.png" />
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
      fieldset {

      		margin: 0;
      		xmin-width: 0;
      		padding: 10px;
      		position: relative;
      		border-radius:4px;
              border-bottom:2px solid #FF6600;
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
        body * :not(.fa):not(.la):not(.kt-widget-20__label):not(.kt-widget-19__label):not(.close) {
          font-family: 'Cairo', sans-serif !important;
        }

        body {
           background-color: #F0F8FF;
           overflow-x: hidden;
        }

        body,body * :not([type="tel"]):not(.other):not(td):not(th) {
            direction: rtl !important;
            text-align: right !important;
        }
        input[type=email],.form_datetime {
          direction: ltr !important;
        }
        .table th {
          font-size: 13px;
          font-weight: 500;
          background-color: #131357;
          color: #F0F8FF !important;
        }
        .table td {
          text-align: center !important;
          font-size: 13px;
          text-shadow: 0px 0px 0px #000000;
          text-outline: 0px #FF3300;
        }
        .nowarp {
          white-space: nowrap !important;
        }
        .dropdown-menu {
          z-index: 100 !important;
        }

        ::placeholder ,:-ms-input-placeholder,::-webkit-input-placeholder {
          color: #FFFFFF !important;
          font-weight: normal !important;
        }
        .close {
          margin-right: 0px !important;
        }

        </style>
    </head>
    <!-- end::Head -->
    <!-- begin::Body -->
    <body class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading" >
        <!-- end::Global Config -->
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
            "focus": "#9816f4"        },
        "base": {
            "label": [
                "#c5cbe3",
                "#a1a8c3",
                "#3d4465",
                "#3e4466"            ],
            "shape": [
                "#f0f3ff",
                "#d9dffa",
                "#afb4d4",
                "#646c9a"            ]        }    }};

function formatMoney(amount, decimalCount = 0, decimal = ".", thousands = ",") {
  try {
    decimalCount = Math.abs(decimalCount);
    decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

    const negativeSign = amount < 0 ? "-" : "";

    let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
    let j = (i.length > 3) ? i.length % 3 : 0;

    return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
  } catch (e) {
    console.log(e)
  }
}

 </script>
        <!--begin::Global Theme Bundle(used by all pages) -->
        <script src="./assets/vendors/global/vendors.bundle.min.js" type="text/javascript"></script>
        <script src="./assets/js/demo1/scripts.bundle.js" type="text/javascript"></script>
        <!--end::Global Theme Bundle -->
        <!--begin::Page Vendors(used by this page) -->
        <script src="./assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
        <!--end::Page Vendors -->
        <!--begin::Page Scripts(used by this page) -->
        <script src="./assets/js/demo1/pages/dashboard.js" type="text/javascript"></script>
        <script src="js/toast.js" type="text/javascript"></script>

        <!--end::Page Scripts -->

        <?php  include_once("partials/_layout-page-loader.php"); ?>
        <!--<?php include("partials/_layout-page-loader.php");?>-->
        <?php include("_layout.php")?>
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
            "focus": "#9816f4"        },
        "base": {
            "label": [
                "#c5cbe3",
                "#a1a8c3",
                "#3d4465",
                "#3e4466"            ],
            "shape": [
                "#f0f3ff",
                "#d9dffa",
                "#afb4d4",
                "#646c9a"            ]        }    }};



                  function increaseFontSize(elem,x){
                    $(elem).each(function (index, value) {
                      current = parseInt($(this).css("font-size"));
                      $(this).css('font-size',current +x+'px'+" !important");
                    });
                  }
                  function fontwight(elem,x){
                    $(elem).each(function (index, value) {
                      current = parseInt($(this).css("font-wight"));
                      $(this).css('font-wight',current +x+" !important");
                    });
                  }
                  function Color(elem,x){
                    $(elem).each(function (index, value) {
                      $(this).css('color',x+" !important");
                    });
                  }
                  $( document ).ready(function(){
                    fontwight('td',100);
                    Color('.dataTables_wrapper .dataTable td',"#abc");
                    increaseFontSize('td',20);
                   });
/*                  increaseFontSize('div',3)
                  increaseFontSize('span',1)
                  increaseFontSize('a',1)
                  increaseFontSize('td',1) */
                </script>
  <!-- Insert these scripts at the bottom of the HTML, but before you use any Firebase services -->

  <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
  <script src="https://www.gstatic.com/firebasejs/7.12.0/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.12.0/firebase-messaging.js"></script>

  <!-- If you enabled Analytics in your project, add the Firebase SDK for Analytics -->
  <!--<script src="https://www.gstatic.com/firebasejs/7.12.0/firebase-analytics.js"></script>
-->
  <!-- Add Firebase products that you want to use -->
  <script src="https://www.gstatic.com/firebasejs/7.12.0/firebase-auth.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.12.0/firebase-firestore.js"></script>
  <script src="js/app.js"></script>
  <script>
  // Check that service workers are supported
  if ('serviceWorker' in navigator) {
     window.addEventListener('load', () => {
      navigator.serviceWorker.register('sw.js')
    });
  }
  </script>
  <script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
      apiKey: "AIzaSyCmIr87Ihp8nXtHrKWZyeH1GcvFrHxmtJw",
      authDomain: "alnahr-3a32e.firebaseapp.com",
      databaseURL: "https://alnahr-3a32e.firebaseio.com",
      projectId: "alnahr-3a32e",
      storageBucket: "alnahr-3a32e.appspot.com",
      messagingSenderId: "410160983978",
      appId: "1:410160983978:web:22a64081a20724ec9185d3",
      measurementId: "G-QYSFSMTB8R"
    };
    // Initialize Firebase
    if (firebase.messaging.isSupported()) {
        firebase.initializeApp(firebaseConfig);
        //  firebase.analytics();
        const messaging = firebase.messaging();
        navigator.serviceWorker.register('js/firebase-sw.js')
        .then((registration) => {
          messaging.useServiceWorker(registration);
          messaging.requestPermission()
          .then(function() {
            console.log(messaging.getToken());
            return messaging.getToken();
          })
          .then(function(token) {
            console.log(token);
            updateUserToken(token);
          })
          .catch(function(err) {
            console.log("error")
          });
          messaging.onMessage(function(payload) {
            console.log('On message', payload);
            Toast.success(payload.notification.body,payload.notification.title);
            getNotification();
          });
        });
    }else{
      Notification.requestPermission().then(function(result) {
        console.log(Notification.getToken());
      });
    }
    function updateUserToken(token){
         $.ajax({
               url:"script/_updateToken.php",
               data:{token : token},
               type:"POST",
               success:function(res){
                console.log(res);
               },
               error:function(e){
                 console.log(e);
               },
         });
    }

function phone_format(text) {
  if(text){
    if(text.length == 10){
      return text.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
    }
    if(text.length == 11){
      return text.replace(/(\d{4})(\d{3})(\d{4})/, '$1-$2-$3');
    }
  }
};
//// ---- indexedDB
function createIndexedDB() {
  var dbName = 'albarqdb';
  var dbVersion = 3;
  var dbRequest = indexedDB.open(dbName, dbVersion);

  dbRequest.onupgradeneeded = function(event) {
    var db = event.target.result;
    db.createObjectStore('orders',{keyPath:"id"});
    db.createObjectStore('clients',{keyPath:"id"});
    db.createObjectStore('branches',{keyPath:"id"});
    db.createObjectStore('cities',{keyPath:"id"});
    db.createObjectStore('towns',{keyPath:"id"});
    db.createObjectStore('stores',{keyPath:"id"});
    db.createObjectStore('companies',{keyPath:"id"});
    db.createObjectStore('role',{keyPath:"id"});
  };

  dbRequest.onerror = function(event) {
    console.log('Error!');
    console.log(event.target.errorCode);
  };

  dbRequest.onsuccess = function(event) {
    console.log('Success');
  };

  dbRequest.onblocked = function(event) {
    console.log('Blocked');
  };
  return  dbRequest;
};
////-- db created
var dbRequest = createIndexedDB();
function saveEventDataLocally(data) {
  if (!('indexedDB' in window)) {return null;}
    var db = dbRequest.result;
    const tx = db.transaction('orders', 'readwrite');
    const store = tx.objectStore('orders');
    return Promise.all(data.map(event => store.put(event)))
    .catch(() => {
      tx.abort();
      throw Error('Events were not added to the store');
    });

}

</script>
    </body>
    <!-- end::Body -->
</html>