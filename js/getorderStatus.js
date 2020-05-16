function getorderStatus(elem){
$.ajax({
  url:"script/_getorderStatus.php",
  type:"POST",
  success:function(res){
   console.log(res);
   elem.html("");
   elem.append(
       '<option value="">... اختر ...</option>'
   );
   $.each(res.data,function(){
     elem.append(
       '<option value="'+this.id+'">'+this.status +'</option>'
     );
    });
    elem.selectpicker('refresh');
    },
   error:function(e){
    console.log(e);
  }
});
}