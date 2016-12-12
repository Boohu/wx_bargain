<?php
/**
 * Created by PhpStorm.
 * User: DoubleWei
 * Date: 2016/12/12
 * Time: 10:35
 */
require_once(dirname(__FILE__) . "/../../model/order.php");
global $_GPC;
$oid = $_GPC['oid'];//获得订单ID
var_dump($oid);
$order = OrderModel::getOrder($oid);//根据订单ID查询订单信息


include $this->template(information);