<?php
require_once(dirname(__FILE__) . "/../../model/order.php");

global $_GPC, $_W;
$aid= trim($_GPC['aid']);
if($aid=="") exit;
$aid=intval($aid);
$order=OrderModel::queryOrder($aid);
include $this->template("joinlist");