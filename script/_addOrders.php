<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,2,3,5,6]);
require_once("dbconnection.php");
require_once("_sendNoti.php");
require_once("../config.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;


$v->addRuleMessage('isPhoneNumber', 'رقم هاتف غير صحيح ');

$v->addRule('isPhoneNumber', function($value, $input, $args) {
  if(preg_match("/^[0-9]{10,15}$/",$value) || empty($value)){
    $x=(bool) 1;
  }
    return $x;
});

$v->addRuleMessage('isPrice', 'المبلغ غير صحيح');

$v->addRule('isPrice', function($value, $input, $args) {
  if(preg_match("/^(0|[1-9]\d*)(\.\d{2})?$/",$value) || empty($value)){
    $x=(bool) 1;
  }
  return   $x;
});

$v->addRuleMessage('unique', 'هناك تكرار برقم الوصل وهاتف المستلم');

$v->addRule('unique', function($value, $input, $args) {
    $value  = trim($value);
    if($args['0'] == 1){
        $exists = getData($GLOBALS['con'],"SELECT * FROM orders WHERE customer_phone ='".$value."' and order_no=".$args['1']);
      return ! (bool) count($exists);
    }else{
      return (bool) 1;
    }
});
$v->addRuleMessages([
    'required' => 'الحقل مطلوب',
    'int'      => 'فقط الارقام مسموع بها',
    'regex'      => 'فقط الارقام مسموع بها',
    'min'      => 'قصير جداً',
    'max'      => 'تم ادخال بيانات اكثر من الحد المسموح',
    'email'      => 'البريد الالكتروني غيز صحيح',
]);
$tokens = [];

$error = [];
$success = 0;
$manger = $_SESSION['userid'];
$orders = [];
$onumber = $_REQUEST['order_no'];
$order_id = $_REQUEST['order_id'];
$prefix = $_REQUEST['prefix'];
$order_type = "multi";//$_REQUEST['order_type'];
$weight = 1;//$_REQUEST['weight'];
$qty = 1;//$_REQUEST['qty'];
$order_price = str_replace(',','',$_REQUEST['order_price']);
$order_price = str_replace('.','',$order_price);

$branch = $_REQUEST['branch'];
$store = $_REQUEST['store'];
$client_phone = $_REQUEST['client_phone'];
$company = $_REQUEST['company'];
$customer_name = "";//$_REQUEST['customer_name'];
$customer_phone =  str_replace('-','',$_REQUEST['customer_phone']);
$city_to = $_REQUEST['city'];
$town_to = $_REQUEST['town'];
$branch_to = 1;//$_REQUEST['branch_to'];
$with_dev = 1;
$order_note= $_REQUEST['order_note'];
$order_address= $_REQUEST['order_address'];
$mainstore= $_REQUEST['mainstore'];
$maincity= $_REQUEST['maincity'];
$mainbranch= 1;//$_REQUEST['mainbranch'];
$by= $_REQUEST['by'];
if(empty($number)){
  $number = "1";
}
$no = 0;
foreach($onumber as $k=>$val){
  $no=$_REQUEST['num'][$k];
  if($_REQUEST['check'][$k] == 1){
   $check = 0;
  }else{
   $check = 1;
  }

  if($by == 'store'){
      $v->validate([
          'manger'        => [$manger,    'required|int'],
          'order_no'      => [$prefix.$onumber[$k],  'required|min(2)|max(100)'],
          'prefix'        => [$prefix,  'min(1)|max(10)'],
          'order_type'    => [$order_type/*$order_type[$k]*/,    'required|min(3)|max(10)'],
          'weight'        => [$weight/*$weight[$k]*/,   'int'],
          'qty'           => [$qty/*$qty[$k]*/,'int'],
          'order_price'   => [$order_price[$k],   "required|isPrice"],
          'store'         => [$mainstore,  'required|int'],
          'customer_phone'=> [$customer_phone[$k],  'required|isPhoneNumber|unique('.$check.',"'.$prefix.$onumber[$k].'")'],
          'city'          => [$city_to[$k],  'required|int'],
          'town'          => [$town_to[$k],  'required|int'],
          'branch_to'     => [$branch_to/*$branch_to[$k]*/,  'required|int'],
          'with_dev'      => [$with_dev,  'required'],
          'order_note'    => [$order_note[$k],  'max(250)'],
          'order_address' => [$order_address[$k],  'max(250)'],
          'company' => [$company,  'int'],
      ]);

      }else{
      $v->validate([
          'mainbranch'    => [$mainbranch,    'required|int'],
          'manger'        => [$manger,    'required|int'],
          'order_no'      => [$onumber[$k],    'required|min(2)|max(100)'],
          'prefix'        => [$prefix,  'min(1)|max(10)'],
          'order_type'    => [$order_type/*$order_type[$k]*/,    'required|min(3)|max(10)'],
          'weight'        => [$weight/*$weight[$k]*/,   'int'],
          'qty'           => [$qty/*$qty[$k]*/,'int'],
          'order_price'   => [$order_price[$k],   "required|isPrice"],
          'store'         => [$store[$k],  'required|int'],
          'customer_phone'=> [$customer_phone[$k],  'required|isPhoneNumber|unique('.$check.',"'.$onumber[$k].'")'],
          'city'          => [$maincity,  'required|int'],
          'town'          => [$town_to[$k],  'required|int'],
          'branch_to'     => [$branch_to/*$branch_to[$k]*/,  'required|int'],
          'with_dev'      => [$with_dev,  'required'],
          'order_note'    => [$order_note[$k],  'max(250)'],
          'order_address' => [$order_address[$k],  'max(250)'],
          'company' => [$company,  'int'],
      ]);

      }
      if(!$v->passes()) {
        break;

       }
}

if($v->passes()) {
 if($by == 'store'){
  $sql = 'select *,clients.id as c_id from stores inner join clients on clients.id = stores.client_id where stores.id=?';
  $res = getData($con,$sql,[$mainstore]);
  $branch = $res[0]['branch_id'];
  $client = $res[0]['c_id'];
      foreach($onumber as $k=>$val){
            $sql = "select * from driver_towns where town_id = ?";
            $getdriver = getData($con,$sql,[$town_to[$k]]);
            if(count($getdriver) > 0){
                $driver = $getdriver[0]['driver_id'];
            }else{
             $driver = 0;
            }
            if($city_to[$k] == 1){
               $dev_price = $config['dev_b'];
            }else{
               $dev_price = $config['dev_o'];
            }
            if(!empty($with_dev)){
               $with_dev = 1;
               $dev_price = 0;
            }
            if(empty($order_address[$k])){
              $order_address[$k] = "";
            }
       if($order_id[$k] > 0 && !empty($order_id[$k])){
               $sql = 'update orders set driver_id=?, manager_id =? ,order_no = ?,order_type =? ,weight =? ,qty =?,
                                    price=?,dev_price=?,client_phone = ?,customer_name = ?  ,
                                    customer_phone=?,to_city=?,to_town = ?,to_branch = ?,with_dev = ?,note = ?,address = ? , confirm = ? , date = ?
                                    where id = ?
                                    ';

        $result = setData($con,$sql,
                         [$driver,$manger,$prefix.$onumber[$k],$order_type,$weight,$qty,
                          $order_price[$k],$dev_price,$client_phone[$k],$customer_name,
                          $customer_phone[$k],$city_to[$k],$town_to[$k],$branch_to,$with_dev,$order_note[$k],$order_address[$k],1,$order_id[$k],date('Y-m-d H:m:i')]);
         // get nofificaton tokens
         $sql = 'select token from orders
                  inner join clients on clients.id = orders.client_id
                   where id = ? group by client_id';
          $res = getData($con,$sql,[$order_id[$k]]);
          $orders[] = $order_id[$k];
          foreach($res as $k => $val){
          $tokens[] = $val['token'];
          }

      $a = "update";
      }else{
        $sql = 'insert into orders (driver_id,manager_id,order_no,order_type,weight,qty,
                                    price,dev_price,from_branch,
                                    client_id,client_phone,store_id,customer_name,
                                    customer_phone,to_city,to_town,to_branch,with_dev,note,new_price,address,company_id,confirm)
                                    VALUES
                                    (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
        $result = setData($con,$sql,
                         [$driver,$manger,$prefix.$onumber[$k],$order_type,$weight,$qty,
                          $order_price[$k],$dev_price,$branch,
                          $client,$client_phone[$k],$mainstore,$customer_name,
                          $customer_phone[$k],$city_to[$k],$town_to[$k],$branch_to,$with_dev,$order_note[$k],0,$order_address[$k],$company,1]);
          $sqlNote = 'select token from clients where id ='.$client;
          $res = getData($con,$sqlNote,[$client]);
          foreach($res as $k => $val){
          $tokens[] = $val['token'];
          }
          $a =  "insert ";
      }
      //---Start-- this for add order tracking record
      if(count($result)>=1){
        $success =1;
        $sql = "select * from orders where order_no=? and from_branch = ?";
        $result2 = getData($con,$sql,[$prefix.$onumber[$k],$branch]);

        if(count($result2)>=1){
        if($driver == 0){
          $sql = "insert into tracking (order_id,order_status_id,note,staff_id) values(?,?,?,?)";
          $result3 = setData($con,$sql,[$result2[0]["id"],1,"تم تسجيل الطلب ",$_SESSION['userid']]);

        }else{
          $sql = "insert into tracking (order_id,order_status_id,note,staff_id) values(?,?,?,?)";
          $result3 = setData($con,$sql,[$result2[0]["id"],3,"بالطريق مع المندوب",$_SESSION['userid']]);
        }
        $orders[] = $result2[0]["id"];
        }
      }
      //---END-- this for add order tracking record
   }
   }else{
   foreach($onumber as $k=>$val){
            $sql = "select * from driver_towns where town_id = ?";
            $getdriver = getData($con,$sql,[$town_to[$k]]);
            if(count($getdriver) > 0){
            $driver = $getdriver[0]['driver_id'];
            }else{
             $driver = 0;
            }

            $sql = 'select *,clients.id as c_id from stores inner join clients on clients.id = stores.client_id where stores.id=?';
            $res = getData($con,$sql,[$store[$k]]);
            $client = $res[0]['c_id'];

            if($maincity == 1){
               $dev_price = $config['dev_b'];
            }else{
               $dev_price = $config['dev_o'];
            }
            if(!empty($with_dev)){
               $with_dev = 1;
               $dev_price = 0;
            }
            if(empty($order_address[$k])){
              $order_address[$k] = "";
            }
      if($order_id[$k] > 0 && !empty($order_id[$k])){
               $sql = 'update orders set driver_id=?,manager_id =? ,order_no = ?,order_type =? ,weight =? ,qty =?,
                                    price=?,dev_price=?,client_phone = ?,customer_name = ?  ,
                                    customer_phone=?,store_id=?,to_town = ?,to_branch = ?,with_dev = ?,note = ?,address = ? , confirm = ? , date = ?
                                    where id = ?
                                    ';
        $result = setData($con,$sql,
                         [$driver,$manger,$prefix.$onumber[$k],$order_type,$weight,$qty,
                          $order_price[$k],$dev_price,$client_phone[$k],$customer_name,
                          $customer_phone[$k],$store[$k],$town_to[$k],$branch_to,$with_dev,$order_note[$k],$order_address[$k],1,$order_id[$k],date('Y-m-d H:m:i')]);
          $sql = 'select token from clients where id = ? ';
          $res = getData($con,$sql,[$client]);
          foreach($res as $k => $val){
          $tokens[] = $val['token'];
          }
          $orders[] =$order_id[$k];
      $a = "update";
      }else{
        $sql = 'insert into orders (driver_id,manager_id,order_no,order_type,weight,qty,
                                    price,dev_price,from_branch,
                                    client_id,client_phone,store_id,customer_name,
                                    customer_phone,to_city,to_town,to_branch,with_dev,note,new_price,address,company_id,confirm)
                                    VALUES
                                    (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
        $result = setData($con,$sql,
                         [$driver,$manger,$prefix.$onumber[$k],$order_type[$k],$weight[$k],$qty[$k],
                          $order_price[$k],$dev_price,$mainbranch,
                          $client,$client_phone[$k],$store[$k],$customer_name[$k],
                          $customer_phone[$k],$maincity,$town_to[$k],$branch_to[$k],$with_dev,$order_note[$k],0,$order_address[$k],$company,1]);
          $sql = 'select token from clients where id = ? ';
          $res = getData($con,$sql,[$client]);
          foreach($res as $k => $val){
          $tokens[] = $val['token'];
          }
       $a = "insert";
      }
      //---Start-- this for add order tracking record
      if(count($result)>=1){
        $success =1;
        $sql = "select * from orders where order_no=? and from_branch = ?";
        $result2 = getData($con,$sql,[$prefix.$onumber[$k],$mainbranch]);

        if(count($result2)>=1){
          if($driver == 0){
            $sql = "insert into tracking (order_id,order_status_id,note,staff_id) values(?,?,?,?)";
            $result3 = setData($con,$sql,[$result2[0]["id"],1,"تم تسجيل الطلب ",$_SESSION['userid']]);

          }else{
            $sql = "insert into tracking (order_id,order_status_id,note,staff_id) values(?,?,?,?)";
            $result3 = setData($con,$sql,[$result2[0]["id"],3,"بالطريق مع المندوب",$_SESSION['userid']]);
          }
          $orders[] = $result2[0]["id"];
        }
      }
      //--- END-- this for add order tracking record
   }
   }
}else{
$error = [
           'no'=>$no,
           'manger'=> implode($v->errors()->get('manger')),
           'order_no'=>implode($v->errors()->get('order_no')),
           'prefix'=>implode($v->errors()->get('prefix')),
           'order_type'=>implode($v->errors()->get('order_type')),
           'weight'=>implode($v->errors()->get('weight')),
           'qty'=>implode($v->errors()->get('qty')),
           'order_price'=>implode($v->errors()->get('order_price')),
           'branch_from'=>implode($v->errors()->get('mainbranch')),
           'store'=>implode($v->errors()->get('store')),
           'client_phone'=>implode($v->errors()->get('client_phone')),
           'customer_name'=>implode($v->errors()->get('customer_name')),
           'customer_phone'=>implode($v->errors()->get('customer_phone')),
           'city'=>implode($v->errors()->get('city')),
           'town'=>implode($v->errors()->get('town')),
           'branch_to'=>implode($v->errors()->get('branch_to')),
           'with_dev'=>implode($v->errors()->get('with_dev')),
           'order_note'=>implode($v->errors()->get('order_note')),
           'order_address'=>implode($v->errors()->get('order_address'))
           ];
}
$fcm = sendNotification($tokens,$orders,'طلبات','اضافه مجموعه طلبيات','orderDetails.php');
echo json_encode([$_REQUEST,'success'=>$success, 'error'=>$error]);
?>