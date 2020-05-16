<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Home</title>
  <style>
        .mybutton {
            margin: 4px;
            height: 100px;
        }

        .jumbotron {
            background-color: #F4511E !important;
            color: #fff;
        }
        .modal-header, h4,.close {
            background-color: #f4511e;
            color: white !important;
            text-align: center;
            font-size: 30px;
        }

        .modal-footer {
            background-color: #f9f9f9;
        }

  </style>
</head>
<body>
   <?php require_once("header.php");?>
   <div class="jumbotron text-center" style="margin-bottom:0">
        <h1> النهر الثالث للتوصيل المحلي</h1>
        <p>مرحبا بكم </p>
        <p>
            <?php
                $t=time();
                echo(date("Y-m-d",$t));
            ?>

        </p>
    </div>
    <div class="container" style="margin-top:30px">
        <div class="row">

            <div class="col-sm-12">
                <div class="row justify-content-center">
                    <h2>سجل دخول للمنصة كـَ:</h2>
                </div>
                <div class="row justify-content-center mh-100">
                    <button type="button" class="btn-lg btn-dark col-10 mybutton shadow p-3 mb-5" id="myBtnManager">المدير العام</button>
                </div>
                <div class="row justify-content-center mh-100">

                    <button type="button" class="btn-lg btn-success col-5 mybutton shadow p-3 mb-5" id="myBtnMBE">موظف الفرع الرئيسي</button>
                    <button type="button" class="btn-lg btn-primary col-5 mybutton shadow p-3 mb-5" id="myBtnMoB">مدير الفرع</button>

                </div>
                <div class="row justify-content-center mh-100">

                    <button type="button" class="btn-lg btn-warning col-5 mybutton shadow p-3 mb-5" id="myBtnDB">مندوب</button>
                    <button type="button" class="btn-lg btn-danger col-5 mybutton shadow p-3 mb-5" id="myBtnEiB">موضف الفرع</button>

                </div>

            </div>

        </div>



        <!-- Modals -->
        <div class="modal fade" id="loginModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="padding:35px 50px;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4><span class="glyphicon glyphicon-lock"></span> ادخل</h4>
                    </div>
                    <div class="modal-body" style="padding:40px 50px;">
                        <form role="form">
                            <div class="form-group">
                                <label id="msg" class="text-danger"></label>

                            </div>
                            <div class="form-group">
                                <label for="uesrname"><span class="glyphicon glyphicon-user"></span> رقم الهاتف</label>
                                <input type="text" class="form-control" id="uesrname" placeholder="ادخل رقم الهاتف">
                            </div>
                            <div class="form-group">
                                <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> الرقم السري</label>
                                <input type="text" class="form-control" id="psw" placeholder="ادخل الرقم السري هنا...">
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" value="" checked> تذكرني </label>
                            </div>
                            <button type="button" class="btn btn-primary shadow p-3 mb-5 btn-block" onclick="login()">ادخل</button>


                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> الغاء</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
<script>
$(document).ready(function() {
    $("#myBtnManager").click(function() {
        $("#loginModal").modal();
    });
    $("#myBtnMBE").click(function() {
        $("#loginModal").modal();
    });
    $("#myBtnMoE").click(function() {
        $("#loginModal").modal();
    });
    $("#myBtnDB").click(function() {
        $("#loginModal").modal();
    });
    $("#myBtnEiB").click(function() {
        $("#loginModal").modal();
    });
});
function login(){
    $.ajax({
    url:"script/_login.php",
    type:"POST",
    data:{username:$("#uesrname").val(), password:$("#psw").val()},
    beforeSend:function(){

    },
    success:function(res){
      console.log(res);
      if(res.msg == 1){
         window.location.href = "index.php";
      }else{
        $("#msg").text(res.msg);
      }
    },
    error:function(e){
      console.log(e.responseText);
    }
  });
}
</script>

<?php include_once("footer.php");?>
</body>

</html>
