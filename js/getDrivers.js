function getDrivers(elem,branch){
   $.ajax({
     url:"script/_getDrivers.php",
     type:"POST",
     data:{branch: branch},
     success:function(res){
       elem.html("");
       elem.append("<option>اختر مندوب</option>");
       $.each(res.data,function(){
         elem.append("<option value='"+this.id+"'>"+this.name+"</option>");
       });
       elem.selectpicker('refresh');
       console.log(res);
     },
     error:function(e){
        elem.append("<option value='' class='bg-danger'>خطأ اتصل بمصمم النظام</option>");
        console.log(e);
     }
   });
}