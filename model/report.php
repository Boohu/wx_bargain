<?php
class repoModel{
    /*获得活动参加人数*/
    static  function getParNum($id){
        global $_GPC, $_W;
        $weid = $_W['uniacid'];               //获取当前公众号ID
        $table_wx_bargain_order= tablename("wx_bargain_order");
        $sql="select count(*) as count from $table_wx_bargain_order
        where activity_id= $id";
        return pdo_fetchall($sql);
    }

    /*获得影响人数*/
    static function getNum($id){
        global $_GPC, $_W;
        $weid = $_W['uniacid'];               //获取当前公众号ID
        $table_wx_bargain_order= tablename("wx_bargain_order");
        $table_wx_bargain_assist= tablename("wx_bargain_assist");
        $sql="select count(*) as count from $table_wx_bargain_order,$table_wx_bargain_assist
        where  $table_wx_bargain_order.id= $table_wx_bargain_assist.order_id
        and $table_wx_bargain_order.activity_id = $id";
        return pdo_fetchall($sql);
    }

}