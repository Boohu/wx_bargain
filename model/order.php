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
     * 查询订单
     * @param $id 要查询的活动id
     */
    static function get($id)
    {
        global $_W,$_GPC;
        $weid = $_W['uniacid'];               //获取当前公众号ID
        $aid=$_GPC['aid'];                  //获取当前活动ID
        return pdo_getall('wx_bargain_order', array('openid' => $id,'activity_id'=>$aid));
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