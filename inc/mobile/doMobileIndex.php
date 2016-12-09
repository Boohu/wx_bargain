<?php
global $_GPC, $_W;
require_once(dirname(__FILE__) . "/../../model/active.php");
require_once(dirname(__FILE__) . "/../../model/order.php");
require_once(dirname(__FILE__) . "/../../model/assist.php");
$openid = $_W['openid'];//获取单前用户ID
$information=$_W['fans'];//获取单前用户信息
$nickname=$information['nickname'];//获取当前用户昵称
//判断用户是否是微信端打开
if (empty($openid)) {
    echo " 该平台只能在微信端打开";
    exit();
}

$aid = isset($_GPC['aid']) ? trim($_GPC['aid']) : ''; /*获取活动id*/
if ($aid == "") exit; /*活动id不存在*/
$activity = ActiveModel::get($aid); /*取出当前活动*/
$active_state=$activity[0]['active_state'];//取出当前活动状态
if (count($activity) != 1||$active_state==0) exit; /*活动不存在*/
$timestamp=$_W['timestamp'];//获得当前时间戳
$activity_end_time=strtotime($activity[0]['end_time']);//获得本次活动结束时间
$judge=$timestamp>$activity_end_time?1:0;//判断活动是否超时 1=未超时 0=超时
//活动超时结束
if ($judge==0){
    echo "该活动已结束";
    exit();
}
$html=htmlspecialchars_decode($activity[0]["desc_html"]);//将富文本内容转化为html
$order = OrderModel::getExistence($openid); //查询当前用户是否存在当前活动订单
$assist_information=AssistModel::getNum($order[0]['id']); //获取本次订单已被帮忙砍价的信息
$op = $_GPC['op']; //获取操作类型

//判断如果操作为join 执行
if ($op == 'join') {

        //判断该用户是否已经参与过该活动
        if (!empty($order)) {
            message('你已经加入过了！', '../../app/' . $this->createMobileUrl('index',array('aid'=>$aid), 'error'));
            exit();
        }
        $data = array(
            'activity_id' => $activity[0]['id'],
            'openid' => $openid,
            'old_price' => $activity[0]['prize_old_price'],
            'current_price' => $activity[0]['prize_old_price'],
            'nickname'=>$nickname,

        );
        //订单表新增订单
        if (OrderModel::add($data)) {
            message('成功发起活动！', '../../app/' . $this->createMobileUrl('index',array('aid'=>$aid),'success'));
        } else {
            message('操作失败');
        }

}
include $this->template("index");//读取模板