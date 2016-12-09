<?php

/**
 * Created by PhpStorm.
 * User: DoubleWei
 * Date: 2016/12/8
 * Time: 15:44
 */
class OrderModel
{

    /**
     * 查询订单是否存在
     * @param $id 要查询的活动id
     */
    static function getExistence($openid)
    {
        global $_GPC;
        $aid=$_GPC['aid'];                  //获取当前活动ID
        return pdo_getall('wx_bargain_order', array('openid' => $openid,'activity_id'=>$aid));
    }
    /**
     * 获取需要帮助用户订单的信息
     * @param $id 要查询的活动id
     */
    static function getOrder($oid)
    {
        return pdo_getall('wx_bargain_order', array('id' => $oid));
    }

    /**
     * 添加订单
     * @param $id 要查询的数据$data
     */
    static function add($data)
    {
        global  $_W;
        $timestamp=$_W['timestamp'];//获得当前时间戳
        $time=date('Y-m-d H:i:s', $timestamp);//将当前时间戳转化为时间格式
        $data['create_time']=$time;//为新增订单添加创建时间
        $data['update_time']=$time;//为新增订单添加更新时间
        return $result = pdo_insert('wx_bargain_order', $data);
    }
    /**
     * 订单更新
     * @param $id 要查询的数据$data
     */
    static function update($data)
    {
        global  $_GPC,$_W;
        $oid=$_GPC;//获取当前订单ID
        $timestamp=$_W['timestamp'];//获得当前时间戳
        $time=date('Y-m-d H:i:s', $timestamp);//将当前时间戳转化为时间格式
        $data['update_time']=$time;//为新增订单添加更新时间
        return $result = pdo_update('wx_bargain_order', $data,array('id'=>$oid));
    }
}