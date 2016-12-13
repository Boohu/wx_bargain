<?php

global $_GPC;
require_once(dirname(__FILE__)."/../../model/order.php");

$oid= isset($_GPC['oid'])?$_GPC['oid']:"" ;//获取订单编号
if($oid=="") exit;
$oid=intval($oid);
$remarks=$_GPC['remarks'];
if(OrderModel::update(array('remarks'=>$remarks))){
    message('操作成功！');
}else{
    message('操作失败');
}
