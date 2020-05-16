<style type="text/css">
.unseen {
 background-color: #F0F8FF;

}

</style>
<div class="kt-head" style="background-image: url(./assets/media/misc/head_bg_sm.jpg)">
    <h3 class="kt-head__title">
        User Notifications
    </h3>
    <div class="kt-head__sub"><span class="kt-head__desc" id='noti-count'></span></div>
</div>
<div class="kt-notification kt-margin-t-30 kt-margin-b-20 kt-scroll" id="noti_menu" data-scroll="true" data-height="270" data-mobile-height="220">
<!--    <a href="#" class="kt-notification__item">
        <div class="kt-notification__item-icon"> <i class="flaticon2-line-chart kt-font-success"></i> </div>
        <div class="kt-notification__item-details">
            <div class="kt-notification__item-title"> New order has been received </div>
            <div class="kt-notification__item-time"> 2 hrs ago </div>
        </div>
    </a>
    <a href="#" class="kt-notification__item">
        <div class="kt-notification__item-icon"> <i class="flaticon2-box-1 kt-font-brand"></i> </div>
        <div class="kt-notification__item-details">
            <div class="kt-notification__item-title"> New customer is registered </div>
            <div class="kt-notification__item-time"> 3 hrs ago </div>
        </div>
    </a>
    <a href="#" class="kt-notification__item">
        <div class="kt-notification__item-icon"> <i class="flaticon2-chart2 kt-font-danger"></i> </div>
        <div class="kt-notification__item-details">
            <div class="kt-notification__item-title"> Application has been approved </div>
            <div class="kt-notification__item-time"> 3 hrs ago </div>
        </div>
    </a>
    <a href="#" class="kt-notification__item">
        <div class="kt-notification__item-icon"> <i class="flaticon2-image-file kt-font-warning"></i> </div>
        <div class="kt-notification__item-details">
            <div class="kt-notification__item-title"> New file has been uploaded </div>
            <div class="kt-notification__item-time"> 5 hrs ago </div>
        </div>
    </a>
    <a href="#" class="kt-notification__item">
        <div class="kt-notification__item-icon"> <i class="flaticon2-bar-chart kt-font-info"></i> </div>
        <div class="kt-notification__item-details">
            <div class="kt-notification__item-title"> New user feedback received </div>
            <div class="kt-notification__item-time"> 8 hrs ago </div>
        </div>
    </a>
    <a href="#" class="kt-notification__item">
        <div class="kt-notification__item-icon"> <i class="flaticon2-pie-chart-2 kt-font-success"></i> </div>
        <div class="kt-notification__item-details">
            <div class="kt-notification__item-title"> System reboot has been successfully completed </div>
            <div class="kt-notification__item-time"> 12 hrs ago </div>
        </div>
    </a>
    <a href="#" class="kt-notification__item">
        <div class="kt-notification__item-icon"> <i class="flaticon2-favourite kt-font-focus"></i> </div>
        <div class="kt-notification__item-details">
            <div class="kt-notification__item-title"> New order has been placed </div>
            <div class="kt-notification__item-time"> 15 hrs ago </div>
        </div>
    </a>
    <a href="#" class="kt-notification__item kt-notification__item--read">
        <div class="kt-notification__item-icon"> <i class="flaticon2-safe kt-font-primary"></i> </div>
        <div class="kt-notification__item-details">
            <div class="kt-notification__item-title"> Company meeting canceled </div>
            <div class="kt-notification__item-time"> 19 hrs ago </div>
        </div>
    </a>
    <a href="#" class="kt-notification__item">
        <div class="kt-notification__item-icon"> <i class="flaticon2-psd kt-font-success"></i> </div>
        <div class="kt-notification__item-details">
            <div class="kt-notification__item-title"> New report has been received </div>
            <div class="kt-notification__item-time"> 23 hrs ago </div>
        </div>
    </a>
    <a href="#" class="kt-notification__item">
        <div class="kt-notification__item-icon"> <i class="flaticon-download-1 kt-font-danger"></i> </div>
        <div class="kt-notification__item-details">
            <div class="kt-notification__item-title"> Finance report has been generated </div>
            <div class="kt-notification__item-time"> 25 hrs ago </div>
        </div>
    </a>
    <a href="#" class="kt-notification__item">
        <div class="kt-notification__item-icon"> <i class="flaticon-security kt-font-warning"></i> </div>
        <div class="kt-notification__item-details">
            <div class="kt-notification__item-title"> New customer comment recieved </div>
            <div class="kt-notification__item-time"> 2 days ago </div>
        </div>
    </a>
    <a href="#" class="kt-notification__item">
        <div class="kt-notification__item-icon"> <i class="flaticon2-pie-chart kt-font-focus"></i> </div>
        <div class="kt-notification__item-details">
            <div class="kt-notification__item-title"> New customer is registered </div>
            <div class="kt-notification__item-time"> 3 days ago </div>
        </div>
    </a>-->
</div>
<input type="hidden" value="<?php echo $_GET['notification'];?>" id="notification_seen_id"  />
<script>
function getNotification(){
    $.ajax({
    url:"script/_getNotification.php",
    beforeSend:function(){
      $("#noti_menu").html("");
    },
    success:function(res){
      //console.log(res);
      if(res.success == 1){
        $("#noti-count").text(res.unseen + ' اشعار جديد');
        $("#noti-new").text(res.unseen);
        $.each(res.data,function(){
          if(this.admin_seen == 0){
            bg = 'unseen';
          }else{
            bg = "";
          }
         $("#noti_menu").append(
         '<a href="?page=pages/reports.php&order_no='+this.order_no+'&notification='+this.n_id+'" class="'+bg+' kt-notification__item">'+
            '<div class="kt-notification__item-icon"> <i class="flaticon2-pie-chart kt-font-focus"></i> </div>'+
            '<div class="kt-notification__item-details">'+
                '<div class="kt-notification__item-title"><b>'+this.title+'</b><br />'+this.body+'</div>'+
                '<div class="kt-notification__item-time">'+this.date+'</div>'+
            '</div>'+
         '</a>'

         );
        });
      }
    },
    error:function(e){
      console.log(e);
    }
  });
}
getNotification();
if($("#notification_seen_id").val() > 0){
   $.ajax({
    url:"script/_setNotificationSeen.php",
    type:"POST",
    data:{id:$("#notification_seen_id").val()},
/*    success:function(res){ console.log(res,'seeeeeeeeen');},
    error:function(res){ console.log(res,'seeeeeeeeen');},*/
  });
}
</script>