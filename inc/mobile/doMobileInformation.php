<?php
/**
 * Created by PhpStorm.
 * User: DoubleWei
 * Date: 2016/12/12
 * Time: 10:35
 */
require_once(dirname(__FILE__) . "/../../model/order.php");
global $_GPC,$_W;
$openid=$_W['openid'];//获得公众号ID
$oid = $_GPC['oid'];//获得订单ID
$order = OrderModel::getOrder($oid);//根据订单ID查询订单信息
//非本人或非微信端点开信息填写连接
//if($openid!=$order[0]['openid']){
//  echo "错误";
//    exit;
//}

include $this->template('information');