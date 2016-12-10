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
    static function getRecord($openid)
    {
        global $_GPC;
        $oid=$_GPC['oid'];//获取帮助用户订单ID
        return  pdo_get('wx_bargain_assist', array('order_id' => $oid, 'openid' => $openid));

    }
    /**
     * 查询本次订单已被帮忙砍价的次数
     * @param $state 要添加的$openid
     */
    static function getNum($oid)
    {
        return  pdo_getall('wx_bargain_assist', array('order_id' => $oid));

    }
    /**
     * 查询查询本订单当天被帮忙砍价的次数
     * $date 要添加的日期
     */
    static function getCount($date)
    {
        $today_start=$date." 00:00:00";//获得当天0点时间
        $today_end=$date." 23:59:59";//获得当天23:59:59时间
        $result=pdo_fetch("select count(*) as count from".tablename('wx_bargain_assist')."where  create_time>= '$today_start' and create_time<='$today_end'");
        return $result;

    }
}