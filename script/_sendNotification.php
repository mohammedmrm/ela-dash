<?php
define('API_ACCESS_KEY', 'AAAAX39_76o:APA91bEwobrGZyJSJYoNYPQPa-UgPXsM1kF-r-LiLMcMv8ja-bN4s3q4VRI9_zmpV2XgLwUrWekJa1l1rhOSLJBbdAZeGD2xS3gNiFJpTyWYBEw5Yhz-vDTVyqyxUXD9HrZohdX0oV1E');
 $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
 $token= 'cPScyOX3Nrwg42amVXmMib:APA91bE1P6WUCfddxjyW07dULVN62eu3reGXyy7IJioK66QMqz4lkQaCSgdPLa2JVBFMm-NtKU0FU7nn8P43md8W8x4vgpa5T8J9tYyzgyt8noZjp3TNMtDcUIswgS9dG1HyrK0YLadk';

     $notification = [
            'title' =>'title',
            'body' => 'body of message.',
            'icon' =>'myIcon',
            'sound' => 'mySound'
        ];
        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

        $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key=' . API_ACCESS_KEY,
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


        echo $result;
 ?>