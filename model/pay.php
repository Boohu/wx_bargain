<?php

/**
 * Created by PhpStorm.
 * User: DoubleWei
 * Date: 2016/12/11
 * Time: 15:04
 */
class PayModel
{
    /**
    * 查询订单id
    * @param $pid 要查询记录的条件支付id
    */
    static function get($pid)
    {
        return pdo_get('wx_bargain_pay', array('pay_id' => $pid),'order_id');
    }
    /**
     * 查询订单状态
     * @param $oid 要查询条件订单ID
     */
    static function getStatus($oid)
    {
        global  $_W;
        $openid = $_W['openid'];//获取单前用户ID
        $weid=$_W['uniacid'];//获取当前公众号ID
        return pdo_get('wx_bargain_pay', array('weid' => $weid,'openid'=>$openid,'order_id'=>$oid),'status');
    }
    /**
     * 添加付款记录
     * @param $data 要添加的记录的信息
     */
    static function add($data)
    {
        global  $_W;
        $timestamp=$_W['timestamp'];//获得当前时间戳
        $time=date('Y-m-d H:i:s', $data['tid']);//将当前时间戳转化为时间格式
        $data['create_time']=$time;//为新增付款记录时间
        $data['update_time']=$time;//为付款记录更新时间
        return   pdo_insert('wx_bargain_pay', $data);
    }    /**
 * 更新付款记录
 * @param $data 要更新的记录的信息
 */
    static function update($data)
    {
        global  $_W,$_GPC;
        $pid=$_GPC['pid'];//获得支付id
        $timestamp=$_W['timestamp'];//获得当前时间戳
        $time=date('Y-m-d H:i:s', $timestamp);//将当前时间戳转化为时间格式
        $data['update_time']=$time;//为付款记录更新时间
        return $result = pdo_update('wx_bargain_pay', $data,array('pay_id'=>$pid));
    }
}