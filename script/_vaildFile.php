<?php
function image($file , $valid_file_extensions = array(".jpg", ".jpeg", ".png"), $required = 0){
    if($file['size'] > 0) {
       if($file['size'] == 0 ||$file['size'] >= "2048000"){
        $img_err =  "حجم الصور يجب ان يكون اقل من  2M";
       }else{
         $ext = strrchr($file["name"], ".");
         if(in_array($ext, $valid_file_extensions) && @getimagesize($file["tmp_name"]) !== false){
           $img_err =  "";
         }else{
          $img_err =  "صورة غير صالحة";
         }
       }
    }else{
       if($required) {
           $img_err =  "يجب تحميل صورة";
        }else{
          $img_err =  "";
        }
    }

return $img_err;
}
?>