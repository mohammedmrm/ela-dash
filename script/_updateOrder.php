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
    $exists = getData($GLOBALS['con'],"SELECT * FROM orders WHERE order_no ='".$value."' and id <> '".$GLOBALS['id']."'");
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

$id = $_REQUEST['e_Orderid'];
$number = $_REQUEST['e_order_no'];
$order_type = 'multi';//$_REQUEST['e_order_type'];
$weight = $_REQUEST['e_weight'];
$qty = $_REQUEST['e_qty'];
$order_price = $_REQUEST['e_price'];
$order_iprice= $_REQUEST['e_iprice'];

$branch = $_REQUEST['e_branch'];
$store = $_REQUEST['e_store'];
$client_phone = $_REQUEST['e_client_phone'];

$customer_name = $_REQUEST['e_customer_name'];
$customer_phone = $_REQUEST['e_customer_phone'];
$city_to = $_REQUEST['e_city'];
$town_to = $_REQUEST['e_town'];
$branch_to = $_REQUEST['e_branch_to'];
$order_note= $_REQUEST['e_order_note'];
if(empty($number)){
  $number = "1";
}
$v->validate([
    'manger'        => [$manger,    'required|int'],
    'id'            => [$id,    'required|int'],
    'order_no'      => [$number,    'required|min(1)|max(100)'],
    'weight'        => [$weight,   'int'],
    'qty'           => [$qty,'int'],
    'order_price'   => [$order_price,   "required|isPrice"],
    'order_iprice'  => [$order_iprice,   "isPrice"],
    'branch_from'   => [$branch,  'required|int'],
    'store'        => [$store,  'required|int'],
    'client_phone'  => [$client_phone,  'isPhoneNumber'],
    'customer_phone'=> [$customer_phone,  'required|isPhoneNumber'],
    'city'          => [$city_to,  'required|int'],
    'town'          => [$town_to,  'required|int'],
    'branch_to'     => [$branch_to,  'int'],
    'order_note'    => [$order_note,  'max(250)'],
]);

if($v->passes()) {

  $sql = 'update orders set
  order_no=?,order_type=?,weight=?,qty=?,price=?,new_price=?,
  from_branch=?,store_id=?,customer_name=?,customer_phone=?,
  to_city=?,to_town=?,to_branch=?,note=? where id = ?';
 $result = setData($con,$sql,
                   [$number,$order_type,$weight,$qty,$order_price,$order_iprice,
                   $branch,$store,$customer_name,$customer_phone,
                   $city_to,$town_to,$branch_to,$order_note,$id]);
if($result > 0){
  $success = 1;
}
}else{
$error = [
           'manger'=> implode($v->errors()->get('manger')),
           'id'=> implode($v->errors()->get('id')),
           'order_no'=>implode($v->errors()->get('order_no')),
           'order_type'=>implode($v->errors()->get('order_type')),
           'weight'=>implode($v->errors()->get('weight')),
           'qty'=>implode($v->errors()->get('qty')),
           'order_price'=>implode($v->errors()->get('order_price')),
           'order_iprice'=>implode($v->errors()->get('order_iprice')),
           'branch_from'=>implode($v->errors()->get('branch_from')),
           'store'=>implode($v->errors()->get('store')),
           'client_phone'=>implode($v->errors()->get('client_phone')),
           'customer_name'=>implode($v->errors()->get('customer_name')),
           'customer_phone'=>implode($v->errors()->get('customer_phone')),
           'city'=>implode($v->errors()->get('city')),
           'town'=>implode($v->errors()->get('town')),
           'branch_to'=>implode($v->errors()->get('branch_to')),
           'order_note'=>implode($v->errors()->get('order_note'))
           ];
}
echo json_encode(['success'=>$success, 'error'=>$error,$_POST]);
?>