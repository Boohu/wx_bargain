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
     * 要查询的是否被该用户帮忙砍价记录
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
        $result=pdo_fetch("select count(*) as count from".tablename('wx_bargain_assist')."where order_id=$oid");
        return $result;

    }
    /**
     * 查询当前用户今日帮忙砍价次次数
     * $date 要添加的日期
     */
    static function getCount($date)
    {
        global $_GPC;
        $oid=$_GPC['oid'];
        $today_start=$date." 00:00:00";//获得当天0点时间
        $today_end=$date." 23:59:59";//获得当天23:59:59时间
        $result=pdo_fetch("select count(*) as count from".tablename('wx_bargain_assist')."where create_time>= '$today_start' and create_time<='$today_end'");
        return $result;

    }


    static function getAssistListCount($condition){
        $table_wx_bargain_assist=tablename("wx_bargain_assist");

        $sql="select count(*) as count from  $table_wx_bargain_assist
        WHERE $condition ";
        return pdo_fetchall($sql);

    }

    static function getAssistList($oid){
        global $_GPC;
        $page= isset($_GPC['p'])?intval($_GPC['p']):1;
        if(empty($page) || intval($page)<1) $page=1;
        $page=($page-1)*10;
        $table_wx_bargain_assist=tablename("wx_bargain_assist");
        $condition="order_id= $oid";
        $sql="select * from  $table_wx_bargain_assist
         WHERE $condition
         limit $page , 10";
        $count=self::getAssistListCount($condition);
        $count=$count[0]['count']; /*取出总的条数*/
        return array(
            'list'=>pdo_fetchall($sql),
            'count'=>$count
        );
    }

}