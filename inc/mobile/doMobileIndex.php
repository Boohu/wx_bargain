<?php
global $_GPC, $_W;
require_once(dirname(__FILE__) . "/../../model/active.php");
require_once(dirname(__FILE__) . "/../../model/order.php");
require_once(dirname(__FILE__) . "/../../model/assist.php");
require_once(dirname(__FILE__) . "/../../model/pay.php");


$openid = $_W['openid'];//获取单前用户ID
$weid=$_W['uniacid'];//获取当前公众号ID
$level=$_W['account']['level'];//获取公众号类型
$information=$_W['fans'];//获取单前用户信息

if($level!=4)$information=mc_fansinfo($openid);
$nickname=$information['nickname'];//获取当前用户昵称



//判断用户是否是微信端打开
//if (empty($openid)) {
//    echo "该平台只能在微信端打开";
//    exit;
//}
//判断如果是非认证服务号
//if($level!=4){
//    echo "请先关注公众号，并按公众号的提示参加活动！";
//    exit;
//};
$aid = isset($_GPC['aid']) ? trim($_GPC['aid']) : ''; /*获取活动id*/
if ($aid == "") exit; /*活动id不存在*/
$top_data=OrderModel::getTop($aid);//查询本次活动价格最低排名前20的用户

$activity = ActiveModel::get($aid); /*取出当前活动*/
$active_state=$activity[0]['active_state'];//取出当前活动状态
if (count($activity) != 1||$active_state==0) exit; /*活动不存在*/
$timestamp=$_W['timestamp'];//获得当前时间戳
$activity_end_time=strtotime($activity[0]['end_time']);//获得本次活动结束时间
$activity_start_time=strtotime($activity[0]['start_time']);//获得本次活动开始时间
$judge=$timestamp>$activity_end_time?1:0;//判断活动是否超时 1=未超时 0=超时
$judge2=$timestamp>$activity_start_time?1:0;//判断活动是否开始
//活动超时结束
if ($judge==1){
    echo "该活动已结束";
    exit;
}
$result=OrderModel::getCount($aid);//获取该活动完成订单数
$success_order_num=$result['count'];//获取该活动完成订单数
$new_prize_num=$activity[0]['prize_num']-$success_order_num;//计算当前剩余奖品数
$html=htmlspecialchars_decode($activity[0]["desc_html"]);//将富文本内容转化为html
$order = OrderModel::getExistence($openid); //查询当前用户是否存在当前活动订单
$_GPC['oid']=$order[0]['id'];//将订单ID付给全局
if(!empty($order)){
    $assist_information=AssistModel::getOrder($order[0]['id']); //获取本次订单已被帮忙砍价的信息
    $result = AssistModel::getNum($order[0]['id']); //获取本次订单已被帮忙砍价次数
    $bargain_num=$result['count'];
}
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
//判断如果操作为pay则调微擎支付
if($op=='pay'){
        //判断是否该支付是否已经完成
    if ($order[0]['order_status']==2){
        message('该订单已经支付完成！', '../../app/' .  $this->createMobileUrl('index',array('aid'=>$aid), 'error'));
        exit;
    }
        $pay_data = array(
            'pay_id' => $timestamp,
            'openid' => $openid,
            'weid' => $weid,
            'order_id' => $order[0]['id'],
            'num' => $order[0]['current_price'],
        );

        $params = array(
            'tid' => $timestamp,      //充值模块中的订单号，此号码用于业务模块中区分订单，交易的识别码
            'ordersn' => $order[0]['id'],  //收银台中显示的订单号
            'title' => $activity[0]['prize_name'],          //收银台中显示的标题
            'fee' => $order[0]['current_price'],      //收银台中显示需要支付的金额,只能大于 0
            'user' => $_W['member']['uid'],     //付款用户, 付款的用户名(选填项)
        );

        $status = $order[0]['order_status'];
        $this->pay($params);
        PayModel::add($pay_data);//添加一条支付记录
    exit;
}
include $this->template("index");//读取模板