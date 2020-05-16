<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,2,3]);
require_once("dbconnection.php");
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

$v->addRuleMessage('unique', 'القيمة المدخلة مستخدمة بالفعل ');

$v->addRule('unique', function($value, $input, $args) {
    $value  = trim($value);
    $exists = getData($GLOBALS['con'],"SELECT * FROM orders WHERE order_no ='".$value."'");
    return ! (bool) count($exists);
});
$v->addRuleMessages([
    'required' => 'الحقل مطلوب',
    'int'      => 'فقط الارقام مسموع بها',
    'regex'      => 'فقط الارقام مسموع بها',
    'min'      => 'قصير جداً',
    'max'      => 'تم ادخال بيانات اكثر من الحد المسموح',
    'email'      => 'البريد الالكتروني غيز صحيح',
]);
$error = [];
$success = 0;
$manger = $_SESSION['userid'];

$number = $_REQUEST['order_no'];
$order_type = $_REQUEST['order_type'];
$weight = $_REQUEST['weight'];
$qty = $_REQUEST['qty'];
$order_price = $_REQUEST['order_price'];

$branch = $_REQUEST['branch'];
$client = $_REQUEST['client'];
$client_phone = $_REQUEST['client_phone'];

$customer_name = $_REQUEST['customer_name'];
$customer_phone = $_REQUEST['customer_phone'];
$city_to = $_REQUEST['city'];
$town_to = $_REQUEST['town'];
$branch_to = $_REQUEST['branch_to'];
$with_dev = $_REQUEST['with_dev'];
$order_note= $_REQUEST['order_note'];
$order_address= $_REQUEST['order_address'];
if(empty($number)){
  $number = "1";
}
$v->validate([
    'manger'        => [$manger,    'required|int'],
    'order_no'      => [$number,    'required|min(2)|max(100)|unique()'],
    'order_type'    => [$order_type,    'required|min(3)|max(10)'],
    'weight'        => [$weight,   'int'],
    'qty'           => [$qty,'int'],
    'order_price'   => [$order_price,   "required|isPrice"],
    'branch_from'   => [$branch,  'required|int'],
    'client'        => [$client,  'required|int'],
    'client_phone'  => [$client_phone,  'isPhoneNumber'],
    'customer_name' => [$customer_name,  'required|min(3)|max(100)'],
    'customer_phone'=> [$customer_phone,  'required|isPhoneNumber'],
    'city'          => [$city_to,  'required|int'],
    'town'          => [$town_to,  'required|int'],
    'branch_to'     => [$branch_to,  'required|int'],
    'with_dev'      => [$with_dev,  'required'],
    'order_note'    => [$order_note,  'max(250)'],
    'order_address' => [$order_address,  'max(250)'],
]);

if($city_to == 1){
   $dev_price = $config['dev_b'];
}else{
   $dev_price = $config['dev_o'];
}
if(!empty($with_dev)){
   $with_dev = 1;
   $dev_price = 0;
}
if(empty($order_address)){
  $order_address = "";
}
if($v->passes()) {

  $sql = 'insert into orders (manager_id,order_no,order_type,weight,qty,
                              price,dev_price,from_branch,
                              client_id,client_phone,customer_name,
                              customer_phone,to_city,to_town,to_branch,with_dev,note,new_price,address)
                              VALUES
                              (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
  $result = setData($con,$sql,
                   [$manger,$number,$order_type,$weight,$qty,
                    $order_price,$dev_price,$branch,
                    $client,$client_phone,$customer_name,
                    $customer_phone,$city_to,$town_to,$branch_to,$with_dev,$order_note,0,$order_address]);

if(count($result)>=1){
  $success =1;
  $sql = "select * from orders where order_no=? and from_branch = ?";
  $result2 = getData($con,$sql,[$number,$branch]);

  if(count($result2)>=1){
  $sql = "insert into tracking (order_id,order_status_id,note) values(?,?,?)";
  $result3 = setData($con,$sql,[$result2[0]["id"],1,"تم تسجيل الطلب "]);

  }
}
}else{
$error = [
           'manger'=> implode($v->errors()->get('manger')),
           'order_no'=>implode($v->errors()->get('order_no')),
           'order_type'=>implode($v->errors()->get('order_type')),
           'weight'=>implode($v->errors()->get('weight')),
           'qty'=>implode($v->errors()->get('qty')),
           'order_price'=>implode($v->errors()->get('order_price')),
           'branch_from'=>implode($v->errors()->get('branch_from')),
           'client'=>implode($v->errors()->get('client')),
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
echo json_encode(['success'=>$success, 'error'=>$error]);
?>