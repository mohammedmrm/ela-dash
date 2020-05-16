<?php
 function sendNotification($token,$orders=[],$title= "Title",$body = "Body",$link="", $icon = '../img/logos/logo.png',$data = []){
  global $con;
  foreach($orders as $order){
            $sql = "select * from orders where orders.id =  ?";
            $res =getData($con,$sql,[$order]);
            if(count($res) > 0){
              $sql = "insert into notification (title,body,for_client,staff_id,client_id,order_id)
              values(?,?,?,?,?,?)";
              $res = setData($con,$sql,[$title,$body,0,$res[0]['manager_id'],0,$order]);
              $res = setData($con,$sql,[$title,$body,0,$res[0]['driver_id'],0,$order]);
              $res = setData($con,$sql,[$title,$body,1,0,$res[0]['client_id'],$order]);
            }
     }
     $apikey = 'AAAAX39_76o:APA91bEwobrGZyJSJYoNYPQPa-UgPXsM1kF-r-LiLMcMv8ja-bN4s3q4VRI9_zmpV2XgLwUrWekJa1l1rhOSLJBbdAZeGD2xS3gNiFJpTyWYBEw5Yhz-vDTVyqyxUXD9HrZohdX0oV1E';
     $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
     $notification = [
            'title' =>$title,
            'body' => $body,
            'icon' =>$icon,
            "vibrate"=> [300,100,400,100,400,100,400],
            'sound' => 'mySound',
            'click_action' => $link
        ];
        $extraNotificationData = ["message" => $notification,"moredata" =>$data];

        $fcmNotification = [
            'registration_ids' => $token, //multple token array
            //'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key=' . $apikey,
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
 }
?>