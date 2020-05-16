<?php
session_start();
require("script/dbconnection.php");
$sql = "select id from staff";
$res = getData($con,$sql);
if(count($res) > 0){
   header("location: login.php");
   die();
}
?>

<!DOCTYPE html>
<script src="bootstrap-4.3.1-dist/js/jquery-3.2.1.min.js"></script>
<script src="js/toast.js"></script>
<!--  Include the above in your HEAD tag -->
<style>
/*
/* Created by Filipe Pina
 * Specific styles of signin, register, component
 */
/*
 * General styles
 */

body, html{
    background-color: #F8F8FF !important;
 	font-family: 'Cairo', sans-serif;
}
body * {
  font-family: 'Cairo', sans-serif;
}

.main{
 	margin-top: 30px;
}

h1.title {
	font-size: 50px;
	font-weight: 400;
}

hr{
	width: 10%;
	color: #fff;
}

.form-group{
	margin-bottom: 5px !important;
}

label{
	margin-bottom: 10px;
}

input,
input::-webkit-input-placeholder {
    font-size: 11px;
    padding-top: 2px;
}

.main-login{
 	background-color: #fff;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);

}

.main-center{
 	margin-top: 30px;
 	margin: 0 auto;
 	max-width: 360px;
    padding: 40px 40px;

}

.login-button{
	margin-top: 5px;
}

.login-register{
	font-size: 11px;
	text-align: center;
}

</style>
<html lang="en" >
    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="bootstrap-4.3.1-dist/css/toast.css">

		<!-- Website CSS style -->
		<link rel="stylesheet" type="text/css" href="assets/css/demo1/style.bundle.rtl.css">

		<!-- Website Font style -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Cairo' rel='stylesheet' type='text/css'>

		<title>Admin</title>
	</head>
	<body dir="rtl">
		<div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h1 class="title">انشاء حساب مدير الشركة</h1>
	               		<hr />
	               	</div>
	            </div>
				<div class="main-login main-center">
					<form class="form-horizontal" method="post" id="installfrom">
                        <div class="form-group">
							<label for="name" class="cols-sm-2 control-label">اسمك</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-text input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="name" id="name"  placeholder="الاسم الكامل"/>
								</div>
							</div>
                            <label for="name" class="control-label text-danger" id="name_err"></label>
						</div>

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">البريد الالكتروني</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-text input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="email" id="email"  placeholder="البريد الالكتروني"/>
								</div>
							</div>
						    <label for="name" class="control-label text-danger" id="email_err"></label>
						</div>

						<div class="form-group">
							<label for="username" class="cols-sm-2 control-label">رقم الهاتف</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-text input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="phone" id="phone"  placeholder="phone"/>
								</div>
							</div>
						    <label for="name" class="control-label text-danger" id="phone_err"></label>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">كلمة المرور</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-text input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password" id="password"  placeholder="كلمة المرور"/>
								</div>
							</div>
						    <label for="name" class="control-label text-danger" id="password_err"></label>
						</div>

						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">اعد كتابة كلمة المرور</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-text input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="confirm" id="confirm"  placeholder="اعد كتابة كلمة المرور"/>
								</div>
							</div>
						    <label for="name" class="control-label text-danger" id="confirm_err"></label>
						</div>
						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">الهوية</label>
							<div class="cols-sm-10">
								<div class="input-group">
    								<div class="input-group-prepend">
    									<span class="input-group-text input-group-addon"><i class="fa fa-file fa-lg" aria-hidden="true"></i></span>
                                    </div>
                                    <input type="file" class="form-control" name="staff_id" id="staff_id"  placeholder="اعد كتابة كلمة المرور"/>
                                </div>
							</div>
						    <label for="name" class="control-label text-danger" id="id_err"></label>
						</div>
						<div class="form-group ">
							<button onclick="install()" type="button" class="btn btn-primary btn-lg btn-block login-button">انشاء</button>
						</div>
					</form>

				</div>
			</div>
                    <div class="row">
                     <br /><hr /><br />
                    </div>
		</div>



</body>
<script>

function install(){
    var myform = document.getElementById('installfrom');
    var fd = new FormData(myform);
  $.ajax({
    url:"script/_install.php",
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
         $("#addStaffForm input").val("");
         Toast.success('تم الاضافة');
         window.location.href = "login.php";
         $("#staffTable input").val("");
       }else{
           $("#name_err").text(res.error["name_err"]);
           $("#email_err").text(res.error["email_err"]);
           $("#phone_err").text(res.error["phone_err"]);
           $("#password_err").text(res.error["password_err"]);
           $("#confirm_err").text(res.error["confirm_err"]);
           $("#id_err").text(res.error["id_err"]);
           Toast.warning("هناك بعض المدخلات غير صالحة",'خطأ');
       }

    },
    error:function(e){
     console.log(e);
     Toast.error('خطأ');
    }
  });
}

</script>
</html>