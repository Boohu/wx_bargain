<?php
/**
 * Created by PhpStorm.
 * User: DoubleWei
 * Date: 2016/12/5
 * Time: 17:58
 */

require_once(dirname(__FILE__) . "/../../model/active.php");
global $_GPC, $_W;

$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';//附判断值
$status = $_GPC['status'];            //获取判断值status
load()->func('tpl');            //调用模板

include $this->template('manager');                              //打开后台活动管理页面
