<?php
/**
 * Created by PhpStorm.
 * User: DoubleWei
 * Date: 2016/12/5
 * Time: 17:58
 */

require_once(dirname(__FILE__) . "/../../model/active.php");
global $_GPC, $_W;
$id=$_GPC['id'];            //获取跳转传过来的ID
$weid=$_W['uniacid'];    //获取公众号ID
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';//附判断值
$status = $_GPC['status'];            //获取判断值status
load()->func('tpl');            //调用模板

//判断状态为0时调用查询语句
if($status==0){
    $datas=ActiveModel::get($id);
}
//判断状态为2时调用更新语句
if($status==2){
    $datas=ActiveModel::get($id);
}
include $this->template('manager');                              //打开后台活动管理页面
