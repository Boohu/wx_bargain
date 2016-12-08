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
$information=$_W['fans'];//获取单前用户信息
$nickname=$information['nickname'];//获取当前用户昵称
$oid = isset($_GPC['oid']) ? trim($_GPC['oid']) : ''; /*获取订单id*/
$order = OrderModel::getOrder($oid); //查询单前用户是否存在当前活动订单
$activity = ActiveModel::get($order[0]['activity_id']); /*取出当前活动*/
$html=htmlspecialchars_decode($activity[0]["desc_html"]);//将富文本内容转化为html
include $this->template('forward');