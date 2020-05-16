<?php
use Violin\Violin;
require_once('../vendor/autoload.php');
$v = new Violin;


$v->addFieldMessage('name', 'min', 'قصير جدااً');
$v->validate([
    'name'  => ['tr', 'required|min(3)|max(100)'],
    'age'   => [20, 'required|int']
]);

if($v->passes()) {
    echo 'Validation passed, woo!';
} else {
    echo '<pre>', var_dump($v->errors()->all()), '</pre>';
}


?>