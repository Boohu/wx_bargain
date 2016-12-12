<?php
/**
 * Created by PhpStorm.
 * User: DoubleWei
 * Date: 2016/12/12
 * Time: 20:39
 */
require_once(dirname(__FILE__) . "/../../model/order.php");
global $_GPC;
$oid=$_GPC['oid'];
var_dump($oid);
$phone=$_GPC['phone'];
$name=$_GPC['name'];
var_dump($phone);
var_dump($name);
$data = array(
    'phone' =>$phone,
    'name' => $name
);
//判断更新成功
/*if(OrderModel::update($data)){
    message('操作成功！', '../../app/' .  $this->createMobleUrl('index'));
}else{
    message('操作失败');
}*/