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
$oid=$params['tid'];//获取订单ID
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
        $data=array('order_status'=>2);//订单状态为2=待核销赋值给数组
        OrderModel::update($data); //更新订单状态
        $pay_data = array(
            'openid' => $openid,
            'weid' => $weid,
            'order_id'=>$oid,
            'num'=>$params['fee'],
        );
        PayModel::add($pay_data);
        message('支付成功！', '../../app/' . $this->createMobileUrl('index',array('aid'=>$order[0]['activity_id'])), 'success');
    } else {
        message('支付失败！', '../../app/' .  $this->createMobileUrl('index',array('aid'=>$order[0]['activity_id'])), 'error');
    }
}