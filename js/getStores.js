function getStores(elem,branch){
   $.ajax({
     url:"script/_getStores.php",
     type:"POST",
     data:{branch: branch},
     success:function(res){
       elem.html("");
       elem.append(
           '<option value="">... اختر ...</option>'
       );
       $.each(res.data,function(){
         elem.append("<option value='"+this.id+"'>"+this.name+"-"+this.client_name+"-"+this.client_phone+"</option>");
       });
       console.log(res);
       elem.selectpicker('refresh');
     },
     error:function(e){
        elem.append("<option value='' class='bg-danger'>Error</option>");
        console.log(e);
     }
   });
}