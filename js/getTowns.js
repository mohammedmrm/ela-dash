function getTowns(elem,city){
   $.ajax({
     url:"script/_getTowns.php",
     type:"POST",
     data:{city: city},
     beforeSent:function(){

     },
     success:function(res){
       elem.html("");
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