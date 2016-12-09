<?php
/**
 * Created by PhpStorm.
 * User: DoubleWei
 * Date: 2016/12/8
 * Time: 20:35
 */
require_once(dirname(__FILE__) . "/../../model/active.php");
require_once(dirname(__FILE__) . "/../../model/order.php");
require_once(dirname(__FILE__) . "/../../model/assist.php");
global $_GPC, $_W;
$openid=$_W['openid'];//获取帮忙砍价用户openid
$op=$_GPC['op'];//获取操作类型
//判断用户是否是微信端打开
if (empty($openid)) {
    echo " 该平台只能在微信端打开";
    exit();
}
$information=$_W['fans'];//获取帮忙砍价用户信息
$nickname=$information['nickname'];//获取帮忙砍价用户昵称
$oid = isset($_GPC['oid']) ? trim($_GPC['oid']) : ''; /*获取订单id*/
$order = OrderModel::getOrder($oid); //根据订单ID查询需要帮助用户的订单信息
$activity = ActiveModel::get($order[0]['activity_id']); /*取出当前活动*/
$html=htmlspecialchars_decode($activity[0]["desc_html"]);//将富文本内容转化为html

/*判断当前订单状态
    *0砍价进行中
 * 1待付款
 * 2已付款
 * 3待核销
 * 4已核销
 * 5超时结束*/
$order_status=$order[0]['order_status'];//获取订单状态
$order_create_time=strtotime($order[0]['create_time']);//将订单创建时间转化为时间戳格式
$timestamp=$_W['timestamp'];//获得当前时间戳
$time=date('Y-m-d H:i:s', $timestamp);//将当前时间戳转化为时间格式
$time_interval=$timestamp-$order_create_time;//计算本次订单发起了多久
$duration=$activity[0]['bargain_time_astrict']*60*60;//计算活动持续时间
if($order_status==0){

}
$result=AssistModel::get($openid);//获取砍价信息
//判断操作类型如果为help
if ($op=='help'){
    //判断该用户是否帮忙该砍价过
    if(empty($result)){
        $data=array(
            'order_id'=>$oid,
            'openid'=>$openid,
            'price'=>10,
            'create_time'=>$time,
            'nickname'=>$nickname

        );
        if(AssistModel::add($data)){
            message('砍价成功！', '../../app/' . $this->createMobileUrl('forward',array('oid'=>$oid),'success'));

        }else{

        }
    }
}


include $this->template('forward');