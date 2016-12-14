<?php
require_once(dirname(__FILE__) . "/../../model/order.php");

global $_GPC, $_W;
$aid= trim($_GPC['aid']);

if(!isset($_GPC['st'])){
    $st=-1;
}else{
    $st= intval($_GPC['st']) ;
}





if($aid=="") exit;
$aid=intval($aid);

$p= isset($_GPC['p'])?intval($_GPC['p']):1;
if(empty($p) || intval($p)<1) $p=1;

$orderInfo=OrderModel::queryOrder($aid,$st);
$order=$orderInfo['list'];
$count=$orderInfo['count'];
$pages=intval((intval($count-1))/intval(10))+1;
include $this->template("joinlist");