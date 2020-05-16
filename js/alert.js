function success(text){
  var  content =
               '<div class="alert alert-success fade show" id="alert" role="alert">'+
					'<div class="alert-icon"><i class="flaticon-warning"></i></div>'+
				  	'<div class="alert-text">'+text+'</div>'+
				  	'<div class="alert-close">'+
					  	'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
					    	'<span aria-hidden="true"><i class="la la-close"></i></span>'+
					  	'</button>'+
					'</div>'+
				'</div>';
return content;
}
function error(text){
  var  content =
               '<div class="alert alert-danger fade show" id="alert" role="alert">'+
					'<div class="alert-icon"><i class="flaticon-warning"></i></div>'+
				  	'<div class="alert-text">'+text+'</div>'+
				  	'<div class="alert-close">'+
					  	'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
					    	'<span aria-hidden="true"><i class="la la-close"></i></span>'+
					  	'</button>'+
					'</div>'+
				'</div>';
return content;
}

function warning(text){
  var  content =
               '<div class="alert alert-danger fade show" id="alert" role="alert">'+
					'<div class="alert-icon"><i class="flaticon-warning"></i></div>'+
				  	'<div class="alert-text">'+text+'</div>'+
				  	'<div class="alert-close">'+
					  	'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
					    	'<span aria-hidden="true"><i class="la la-close"></i></span>'+
					  	'</button>'+
					'</div>'+
				'</div>';

return content;
}