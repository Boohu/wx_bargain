<?php
/**
 * Created by PhpStorm.
 * User: DoubleWei
 * Date: 2016/12/12
 * Time: 20:39
 */
require_once(dirname(__FILE__) . "/../../model/order.php");
global $_GPC;
$oid=$_GPC['oid'];//获取订单ID
$aid=$_GPC['aid'];//获取活动ID
$phone=$_GPC['phone'];//获得输入的手机号
$name=$_GPC['name'];//获得输入的姓名
$data = array(
    'phone' =>$phone,
    'name' => $name
);
//判断更新成功
if(OrderModel::update($data)){
    message('信息保存成功！', '../../app/'.$this->createMobileUrl('index',array('aid'=>$aid),'success'));
}else{
    message('保存失败失败');
}