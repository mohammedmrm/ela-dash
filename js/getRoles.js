function getRoles(elem){
$.ajax({
  url:"script/_getRoles.php",
  type:"POST",
  success:function(res){
   console.log(res);
   elem.html("");
   $.each(res.data,function(){
     elem.append(
       '<option value="'+this.id+'">'+this.name +'</option>'
     );
     elem.selectpicker('refresh');
   });
  },
  error:function(e){
    console.log(e);
  }
});
}