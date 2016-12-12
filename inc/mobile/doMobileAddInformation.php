<?php
/**
 * Created by PhpStorm.
 * User: DoubleWei
 * Date: 2016/12/12
 * Time: 20:39
 */
require_once(dirname(__FILE__) . "/../../model/order.php");
global $_GPC;
$aid=$_GPC['aid'];//获取活动ID
$phone=$_GPC['phone'];//获得输入的手机号
$name=$_GPC['name'];//获得输入的姓名
$data = array(
    'phone' =>$phone,
    'name' => $name
);
//判断更新成功
if(OrderModel::update($data)){
    message('操作成功！', '../../app/' .  $this->createMobleUrl('index',array('aid'=>$aid)));
}else{
    message('操作失败');
}