<?php
/**
 * Created by PhpStorm.
 * User: DoubleWei
 * Date: 2016/12/8
 * Time: 20:35
 */
require_once(dirname(__FILE__) . "/../../model/active.php");
require_once(dirname(__FILE__) . "/../../model/order.php");
global $_GPC, $_W;
$openid = $_W['openid'];//获取单前用户ID
$aid = isset($_GPC['aid']) ? trim($_GPC['aid']) : ''; /*获取活动id*/
$order = OrderModel::get($openid); //查询单前用户是否存在当前活动订单
$activity = ActiveModel::get($aid); /*取出当前活动*/
include $this->template('forward');