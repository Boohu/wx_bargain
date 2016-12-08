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
     * 获取帮忙砍价订单信息
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
    static function sava($data)
    {

        return $result = pdo_insert('wx_bargain_order', $data);
    }
}