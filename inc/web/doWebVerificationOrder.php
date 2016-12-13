<?php
/**
 * Created by PhpStorm.
 * User: DoubleWei
 * Date: 2016/12/13
 * Time: 11:21
 */
require_once(dirname(__FILE__) . "/../../model/order.php");
global $_GPC;
$aid=$_GPC['aid'];//获取活动ID
$data=array(
    'order_status'=>3
);
if(OrderModel::update($data)){
    message('核销成功！', '../../web/' .  $this->createWebUrl('joinList',array('aid'=>$aid)));
}else{
    message('操作失败！');
}