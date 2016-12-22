<?php
/**
 * Created by PhpStorm.
 * User: DoubleWei
 * Date: 2016/12/22
 * Time: 15:05
 */
require_once(dirname(__FILE__) . "/../../model/active.php");
require_once(dirname(__FILE__) . "/../../model/order.php");
global $_W,$_GPC;
$openid = $_W['openid'];//获取单前用户ID
$op=$_GPC['op'];//获取当前操作类型
$oid=$_GPC['oid'];//获得当前订单信息
$aid=$_GPC['aid'];//获得当前活动ID
$order=OrderModel::getOrder($oid);//获取当前订单信息
var_dump($op);
var_dump($oid);
var_dump($aid);

/*//如果操作为verification执行核销操作
if($op=='verification'){
    $input_verification_code=$_GPC['verification_code'];//获取输入的核销码
    $order=OrderModel::getExistence($openid);//根据openid和活动ID查询当前订单信息
    $activity=ActiveModel::get($aid);//根据活动ID获取活动信息

    //判断如果输入的核销码=活动核销码
    if ($input_verification_code==$activity[0]['verification_code']&&$order[0]['id']==$oid){
        $data=array('order_status'=>3);
        OrderModel::update($data);
        message('核销成功！', '../../app/' . $this->createMobileUrl('index',array('aid'=>$aid),'success'));
    }else{
        message('核销失败活动！', '../../app/' . $this->createMobileUrl('index',array('aid'=>$aid),'error'));

    }
}*/
