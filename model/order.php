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
     * 根据openid查询当前用户是否有订单存在
     * @param $id 要查询的活动id
     */
    static function getExistence($openid)
    {
        global $_GPC;
        $aid=$_GPC['aid'];                  //获取当前活动ID
        return pdo_getall('wx_bargain_order', array('openid' => $openid,'activity_id'=>$aid));
    }
    /**
     * 根据订单ID获取需要帮助用户订单的信息
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
        $oid=$_GPC['oid'];//获取当前订单ID
        $timestamp=$_W['timestamp'];//获得当前时间戳
        $time=date('Y-m-d H:i:s', $timestamp);//将当前时间戳转化为时间格式
        $data['update_time']=$time;//为新增订单添加更新时间
        return $result = pdo_update('wx_bargain_order', $data,array('id'=>$oid));
    }



    /*获得满足条件的订单条数*/
    static function queryOrderCount($condition){
        $table_wx_bargain_order=tablename("wx_bargain_order");
        $sql="select count(*) as count from $table_wx_bargain_order where $condition";
        return pdo_fetchall($sql);
    }


    static function queryOrder($aid){
        $table_wx_bargain_order=tablename("wx_bargain_order");
        $condition="activity_id= $aid";
        global  $_GPC;
        $page= isset($_GPC['p'])?intval($_GPC['p']):1;
        if(empty($page) || intval($page)<1) $page=1;
        $page=($page-1)*10;
        $count=self::queryOrderCount($condition);
        $count=$count[0]['count']; /*取出总的条数*/
        $sql="select * from $table_wx_bargain_order where $condition
        limit $page , 10";
        return array(
            'list'=>pdo_fetchall($sql),
            'count'=>$count
        );
    }

}