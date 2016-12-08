<?php
global $_GPC,$_W;
require_once(dirname(__FILE__) . "/../../model/active.php");
$aid= isset($_GPC['aid'])?trim($_GPC['aid']):''; /*获取活动id*/
if($aid=="") exit; /*活动id不存在*/
$activity=ActiveModel::get($aid); /*取出当前活动*/
if(count($activity)!=1) exit; /*活动不存在*/

var_dump($activity[0]);

include $this->template("index");