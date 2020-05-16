<div class="row">

<hr />

            <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
            <label>الفترة الزمنية :</label>
            <div class="input-daterange input-group" id="kt_datepicker">
  				<input value="<?php echo date('Y-m-d',strtotime(date('Y-m-d'). ' - 7 day'));?>" onchange="updateDash()" type="text" class="form-control kt-input" name="start" id="start" placeholder="من" data-col-index="5">
  				<div class="input-group-append">
  					<span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
  				</div>
  				<input onchange="updateDash()" type="text" class="form-control kt-input" name="end"  id="end" placeholder="الى" data-col-index="5">
          	</div>
            </div>
</div>
<div class="row">
	<div class="col-lg-6 col-xl-6 order-lg-1 order-xl-1">
    		<!--begin::Portlet-->
          <div class="kt-portlet kt-portlet--height-fluid">
          	<div class="kt-portlet__head kt-portlet__head--noborder">
          		<div class="kt-portlet__head-label">
          			<h3 class="kt-portlet__head-title">الدخل الكلي</h3>
          		</div>
          		<div class="kt-portlet__head-toolbar">
          			<div class="kt-portlet__head-toolbar-wrapper">
          			</div>
          		</div>
          	</div>
          	<div class="kt-portlet__body kt-portlet__body--fluid">
          		<div class="kt-widget-19">
          			<div class="kt-widget-19__title">
          				<div class="kt-widget-19__label">
                            <span id="total-income"></span>
                           <small>الف</small>
                        </div>
          				<img class="kt-widget-19__bg"  src="./assets/media/misc/iconbox_bg.png" alt="bg"/>
          			</div>
          			<div class="kt-widget-19__data">
          				<!--Doc: For the chart bars you can use state helper classes: kt-bg-success, kt-bg-info, kt-bg-danger. Refer: components/custom/colors.html -->
          				<div class="kt-widget-19__chart">
          					<div class="kt-widget-19__bar"><div class="kt-widget-19__bar-45" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="45"></div></div>
          					<div class="kt-widget-19__bar"><div class="kt-widget-19__bar-95" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="95"></div></div>
          					<div class="kt-widget-19__bar"><div class="kt-widget-19__bar-63" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="63"></div></div>
          					<div class="kt-widget-19__bar"><div class="kt-widget-19__bar-11" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="11"></div></div>
          					<div class="kt-widget-19__bar"><div class="kt-widget-19__bar-46" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="46"></div></div>
          					<div class="kt-widget-19__bar"><div class="kt-widget-19__bar-88" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="88"></div></div>
          				</div>
          			</div>
          		</div>
          	</div>
          </div>
          <!--end::Portlet-->
</div>

<div class="col-lg-6 col-xl-6 order-lg-1 order-xl-1">
		<!--begin::Portlet-->
<div class="kt-portlet kt-portlet--height-fluid">
	<div class="kt-portlet__head  kt-portlet__head--noborder">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">عدد الطلبات الكلي</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-toolbar-wrapper">

			</div>
		</div>
	</div>
	<div class="kt-portlet__body kt-portlet__body--fluid">
		<div class="kt-widget-20">
			<div class="kt-widget-20__title">
				<div class="kt-widget-20__label">
                <span class='la' id="orders"></span>
                </div>
				<img class="kt-widget-20__bg" src="./assets/media/misc/iconbox_bg.png" alt="bg"/>
			</div>
			<div class="kt-widget-20__data">
				<div class="kt-widget-20__chart">
					<!--Doc: For the chart initialization refer to "widgetTotalOrdersChart" function in "src\theme\app\scripts\custom\dashboard.js" -->
					<canvas id="kt_widget_total_orders_chart"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>
<!--end::Portlet-->
</div>
</div>
<div class="row">
  <div class="col-lg-6 col-xl-6 order-lg-1 order-xl-1">
          <div class="kt-portlet">
  			<div class="kt-portlet__head">
  				<div class="kt-portlet__head-label">
  					<h3 class="kt-portlet__head-title">الارباح</h3>
  				</div>
  			</div>
  			<div class="kt-portlet__body" id="">
                 <canvas id="earnings"></canvas>
            </div>
  		</div>
  </div>
  <div class="col-lg-6 col-xl-6 order-lg-1 order-xl-1">
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">اخر 25 طلب</h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div id="last10" class="" style="height: 300px; overflow-x:hidden; overflow-y: scroll"></div>
        </div>
    </div>
</div>
</div>
<div class="row">
  <div class="col-lg-6 col-xl-6 order-lg-1 order-xl-1">
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">الارباح لاخر 10 عملاء و للفترة المحددة</h3>
            </div>
        </div>
        <div class="kt-portlet__body">
        <table class="table table-striped table-bordered table-hover table-checkable responsive no-wrap" id="tb-clientEarnings">
			       <thead>
					<tr>
				  		<th></th>
						<th>الفرع</th>
						<th>العميل</th>
						<th>التاريخ</th>
                        <th>الدخل الكلي</th>
						<th>صافي التوصيل</th>
						<th>الصافي للعميل</th>
						<th>الخصم</th>
                    </tr>
      	            </thead>
                    <tbody id="clientEarnings">
                    </tbody>
		</table>
        </div>
    </div>
</div>

  <div class="col-lg-6 col-xl-6 order-lg-1 order-xl-1">
    <div class="kt-portlet" id="order_count">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">احصائيات بالطلبات</h3>
            </div>
        </div>
        <div class="kt-portlet__body">
        <table class="table table-striped table-bordered table-hover table-checkable responsive no-wrap" id="tb-ordersCount">
			       <thead>
	  						<tr>
								  		<th></th>
										<th>الفرع</th>
                                        <th>المسجلة</th>
										<th>المستلمة</th>
										<th>الراجعه</th>
										<th>المؤجلة</th>						   </tr>
      	            </thead>
                            <tbody id="ordersCount">
                            </tbody>

		</table>
        </div>
    </div>
</div>

</div>
<div class="row">
<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
          <div class="kt-portlet">
  			<div class="kt-portlet__head">
  				<div class="kt-portlet__head-label">
  					<h3 class="kt-portlet__head-title">مخطط حلات الطلبات</h3>
  				</div>
  			</div>
  			<div class="kt-portlet__body" id="">
                 <canvas id="cearnings"></canvas>
            </div>
  		</div>
  </div>
</div>
<!--begin::Page Scripts(used by this page) -->
<script src="assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
<script src="assets/js/demo1/pages/components/datatables/extensions/responsive.js" type="text/javascript"></script>
<script src="js/charts.js"></script>
<!--end::Page Scripts -->
<script>
$( document ).ready(function(){
$('#start').datepicker({
    format: "yyyy-mm-dd",
    showMeridian: true,
    todayHighlight: true,
    autoclose: true,
    pickerPosition: 'bottom-left',
    defaultDate:'now'
});
$('#end').datepicker({
    format: "yyyy-mm-dd",
    showMeridian: true,
    todayHighlight: true,
    autoclose: true,
    pickerPosition: 'bottom-left',
    defaultDate:'now'
});
earnings();
});
function earnings(){
  i = 0
  var income =[],earnings=[],days=[];
  $.ajax({
    url:"charts/_earnings.php",
    type:'POST',
    data:{start: $("#start").val(),end:$("#end").val()},
    beforeSend:function(){
      $("#earnings").addClass("loading");
    },
    success:function(res){
      $("#earnings").removeClass("loading");
      console.log(res);
      $.each(res.data, function(){
        console.log();
        income[i] =this.income;
        earnings[i] = this.earnings;
        days[i] = this.day;

      i++;
      });
      var ctx = document.getElementById('earnings').getContext('2d');
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              datasets: [{
                  label: 'الربح',
                  data: earnings,
                  backgroundColor: 'rgb(115, 222, 10,0.4)',
                  type: 'line',
                  borderColor:  'rgb(105, 202, 10,0.9)',
                  borderWidth:2,hitRadius:0,hoverRadius:0,
                  borderWidth:2,
              },{
                  label: 'الدخل الكلي',
                  data: income,
                  backgroundColor: 'rgb(255, 109, 142,0.4)',
                  borderColor: 'rgb(255, 109, 142,0.9)',
                  borderWidth:2,hitRadius:0,hoverRadius:0,
                  type: 'line',
              }],
              labels: days,
          },
          options: {
              scales: {
                  yAxes: [{
                    scaleLabel: {
                      display: true,
                      labelString: 'المبلغ  IQD',
                    },
                    ticks: {
                        beginAtZero: true
                    }
                  }],
                  xAxes: [{
                    scaleLabel: {
                      display: true,
                      labelString: 'التاريخ'
                    }
                  }],
              },
              elements: {
                    point:{
                        radius: 1.2
                    }
             }
          }
      });
    },
    error:function(e){
     $("#earnings").removeClass("loading");
     console.log(e);
    }
  });

}
function getLast10Orders(){
  $.ajax({
    url:"charts/_getLast10Orders.php",
    type:'POST',
    data:{start: $("#start").val(),end:$("#end").val()},
    beforeSend:function(){
      $("#last10").addClass("loading");
    },
    success:function(res){
      $("#last10").removeClass("loading");
      console.log(res);
      $("#last10").html('');
      $.each(res.data, function(){
        $("#last10").append(
          '<div class="row">'+
          '<div class="col-sm-2 text-center">'+
          '<h1><i class="flaticon-paper-plane-1 kt-font-success 2"></i></h1>'+
          '</div>'+
          '<div class="col-sm-8">'+
                  '<div class="">'+
                      'رقم الطلب : '+this.order_no+"<br />"+
                      'التاريخ : '+this.date+
                  '</div>'+
                  '<div class="">'+
                      'عنوان الطلب : '+this.city_name +"-"+ this.town_name+
                  '</div>'+
          '</div>'+
          '</div>'+
          '<div class="row"><hr></div>'
          )
      });
    },
    error:function(e){
     $("#last10").removeClass("loading");
     console.log(e);
    }

  });
}
function getOrdersCount(){
$.ajax({
  url:"charts/_getOrdersCount.php",
  type:"POST",
  data:{start: $("#start").val(),end:$("#end").val()},
  beforeSend:function(){
    $("#order_count").addClass("loading");
  },
  success:function(res){
    $("#order_count").removeClass("loading");
   console.log(res);
   $("#tb-ordersCounts").DataTable().destroy();
   $('#ordersCount').html("");
   $.each(res.data,function(){
      $('#ordersCount').append(
       '<tr>'+
            '<td>'+'</td>'+
            '<td>'+this.branch_name+'</td>'+
            '<td class="bg-info">'+this.regiserd+'</td>'+
            '<td class="bg-success">'+this.recieved+'</td>'+
            '<td class="bg-danger">'+this.returnd+'</td>'+
            '<td class="bg-warning">'+this.posponded+'</td>'+
       '</tr>'
      )
     });

     var myTable= $('#tb-ordersCounts').DataTable({
     columns:[
    //"dummy" configuration
        { visible: true }, //col 1
        { visible: true }, //col 2
        { visible: true }, //col 3
        { visible: true }, //col 4
        { visible: true }, //col 5
        { visible: true }, //col 6
        ],
      "oLanguage": {
        "sLengthMenu": "عرض_MENU_سجل",
        "sSearch": "بحث:"
      },
       "bPaginate": false,
       "bLengthChange": false,
       "bFilter": false,
       serverPaging: true
      });
    },
   error:function(e){
     $("#order_count").removeClass("loading");
    console.log(e);
  }
});
}
function getEraningsLast10Clients(){
  $.ajax({
    url:"charts/_getEraningsLast10Clients.php",
    type:"POST",
    data:{start: $("#start").val(),end:$("#end").val()},
    beforeSend:function(){
      $("#tb-clientEarnings").addClass("loading");
    },
    success:function(res){
     $("#tb-clientEarnings").removeClass("loading");
      console.log(res);

   $("#tb-clientEarnings").DataTable().destroy();
   $('#clientEarnings').html("");
   $.each(res.data,function(){
      $('#clientEarnings').append(
       '<tr>'+
            '<td>'+'</td>'+
            '<td>'+this.branch_name+'</td>'+
            '<td class="">'+this.client_name+'</td>'+
            '<td class="">'+this.date+'</td>'+
            '<td class="">'+formatMoney(this.income)+'</td>'+
            '<td class="bg-success">'+formatMoney(this.earnings)+'</td>'+
            '<td class="">'+formatMoney(Number(this.income - this.earnings)) +'</td>'+
            '<td class="bg-warning">'+formatMoney(this.discount)+'</td>'+
       '</tr>'
      )
     });
     var myTable= $('#tb-clientEarnings').DataTable({
     columns:[
    //"dummy" configuration
        { visible: true }, //col 1
        { visible: true }, //col 2
        { visible: true }, //col 3
        { visible: true }, //col 4
        { visible: true }, //col 5
        { visible: true }, //col 6
        { visible: true }, //col 7
        { visible: true }, //col 8
        ],
      "oLanguage": {
        "sLengthMenu": "عرض_MENU_سجل",
        "sSearch": "بحث:"
      },
       "bPaginate": false,
       "bLengthChange": false,
       "bFilter": false,
       serverPaging: true
      });
    },
    error:function(e){
      $("#tb-clientEarnings").removeClass("loading");
      console.log(e);
    }
  });
}
function ceranings(){
  $.ajax({
    url:"charts/_getOrdersCount.php",
    type:"POST",
    data:{start: $("#start").val(),end:$("#end").val()},
    beforeSend:function(){
      $("#cearnings").addClass("loading");
    },
    success:function(res){
      $("#cearnings").removeClass("loading");
      console.log(res);
      content =[];
      color =[
       'rgb(255, 109, 142,0.5)',
       'rgb(44, 209, 100,0.5)',
       'rgb(20, 119, 212,0.5)',
       'rgb(5, 129, 255,0.5)',
       'rgb(100, 12, 155,0.5)',
       'rgb(255, 109, 142,0.5)',
       'rgb(205, 139, 112,0.5)',
       'rgb(55, 129, 122,0.5)',
       'rgb(255, 119, 132,0.5)',
      ];
      i =0;
      $.each(res.data, function(){
        console.log();
        content[i] = {
          label:this.branch_name,
          data: [this.regiserd,this.redy,this.returnd,this.posponded,this.ontheway,this.recieved],
          backgroundColor: color[i],
          pointLabels: {
                    fontSize: 25
          }
          };
        i++;
      });
      mydata = {
        labels: ["المسجلة", "جاهز للارسال", "راجع", "مؤجل", "بالطريق","مستلمة"],
        datasets:content,
        options: {
          scale: {
            pointLabels: {
              fontSize: 20
            }
          }
        }
      }
      console.log(content);
      var ctx = document.getElementById('cearnings').getContext('2d');
      var myChart = new Chart(ctx, {
          type: 'radar',
          data: mydata
      });
    },
    error:function(e){
      $("#cearnings").removeClass("loading");
      console.log(e);
    }
  });
}
function totalIcome(){
$.ajax({
  url:"charts/_totalIncome.php",
  type:"POST",
  data:{start: $("#start").val(),end:$("#end").val()},
  beforeSend:function(){
    $("#total-income").addClass("loading");
    $("#orders").addClass("loading");
  },
  success:function(res){
    $("#total-income").removeClass("loading");
     $("#orders").removeClass("loading");
     $("#total-income").text(formatMoney(Number(res.data[0]['total'])));
     $("#orders").text(formatMoney(Number(res.data[0]['orders'])));
  },
  error:function(e){
    $("#total-income").removeClass("loading");
    $("#orders").removeClass("loading");
  }
  });
}
totalIcome();
ceranings();
getEraningsLast10Clients();
getOrdersCount();
getLast10Orders();
function updateDash() {
 earnings();
 getLast10Orders();
 getOrdersCount();
 getEraningsLast10Clients();
 ceranings();
 totalIcome();
}
</script>