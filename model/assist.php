<?php

/**
 * Created by PhpStorm.
 * User: DoubleWei
 * Date: 2016/12/8
 * Time: 21:09
 */
class AssistModel
{
    /**
     * 帮忙砍价记录
     * @param $state 要添加的$data
     */
    static function add($data)
    {
        return $result = pdo_insert('wx_bargain_assist', $data);

    }
    /**
     * 要查询的帮忙砍价记录
     * @param $state 要添加的$openid
     */
    static function get($openid)
    {
        global $_GPC;
        $oid=$_GPC['oid'];//获取帮助用户订单ID
        return  pdo_getall('wx_bargain_assist', array('order_id' => $oid, 'openid' => $openid));

    }
}