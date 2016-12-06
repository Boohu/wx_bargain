<?php
/**
 * Created by PhpStorm.
 * User: DoubleWei
 * Date: 2016/12/5
 * Time: 17:58
 */

global $_GPC,$_W;
$weid=$_W['uniacid'];               //获取当前公众号ID
$operation=!empty($_GPC['op'])?$_GPC['op']:'display';//附判断值
$status=$_GPC['status'];
include $this->template('manager');                              //打开后台活动管理页面
