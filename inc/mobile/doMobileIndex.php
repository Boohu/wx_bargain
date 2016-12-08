<?php
global $_GPC, $_W;
require_once(dirname(__FILE__) . "/../../model/active.php");
require_once(dirname(__FILE__) . "/../../model/order.php");
$openid = $_W['openid'];//获取单前用户ID
$information=$_W['fans'];//获取单前用户信息
$nickname=$information['nickname'];//获取当前用户昵称
$aid = isset($_GPC['aid']) ? trim($_GPC['aid']) : ''; /*获取活动id*/
if ($aid == "") exit; /*活动id不存在*/
$activity = ActiveModel::get($aid); /*取出当前活动*/
if (count($activity) != 1) exit; /*活动不存在*/
$order = OrderModel::getExistence($openid); //查询单前用户是否存在当前活动订单
$html=htmlspecialchars_decode($activity[0]["desc_html"]);//将富文本内容转化为html

//获取不到用户ID停止
if (empty($openid)) {
    echo " 该平台只能在微信端打开";
    exit();
}
$op = $_GPC['op']; //获取操作类型
//判断如果操作为join 执行
if ($op == 'join') {
    if (!empty($order)) {
        message('你已经加入过了！', '../../app/' . $this->createMobileUrl('index',array('aid'=>$aid), 'error'));
        exit();
    }
    $data = array(
        'activity_id' => $activity[0]['id'],
        'openid' => $openid,
        'old_price' => $activity[0]['prize_old_price'],
        'current_price' => $activity[0]['prize_old_price'],
        'phone' => 123,
        'name' => doubleWEI,
        'nickname'=>$nickname,

    );
    if (OrderModel::sava($data)) {
        message('操作成功！', '../../app/' . $this->createMobileUrl('index',array('aid'=>$aid),'success'));
    } else {
        message('操作失败');
    }
}
include $this->template("index");