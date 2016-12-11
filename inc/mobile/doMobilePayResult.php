<?php
/**
 * Created by PhpStorm.
 * User: DoubleWei
 * Date: 2016/12/11
 * Time: 13:31
 */
require_once(dirname(__FILE__) . "/../../model/order.php");
require_once(dirname(__FILE__) . "/../../model/pay.php");
global $_W,$_GPC;
$weid=$_W['uniacid'];//获取当前公众号ID
$openid=$_W['openid'];//获得当前用户ID
$pid=$params['tid'];//获取订单ID
$result=PayModel::get($pid);//获取订单编号信息
$oid=$result['order_id'];//将订单编号赋值
$_GPC['oid']=$oid;//把oid赋予全局
$order=OrderModel::getOrder($oid);//获取订单信息
/*判断输入金额与应付金额是否相同*/
if($params['result'] == 'success' && $params['from'] == 'notify'){
    if($params['fee']==$order[0]['current_price']){
        exit('用户支付的金额与订单金额不符合');
    }

}

/*调微擎支付页面，并跟新未支付订单为已支付*/
if ($params['from'] == 'return') {
    if ($params['result'] == 'success') {
        $order_data=array('order_status'=>2);//订单状态为2=待核销赋值给数组
        OrderModel::update($order_data); //更新订单状态
        $pay_date=array('status'=>1);
        $_GPC['pid']=$params['tid'];//获取支付编号
        PayModel::update($pay_date);//更新支付表信息
        message('支付成功！', '../../app/' . $this->createMobileUrl('index',array('aid'=>$order[0]['activity_id'])), 'success');
    } else {
        message('支付失败！', '../../app/' .  $this->createMobileUrl('index',array('aid'=>$order[0]['activity_id'])), 'error');
    }
}