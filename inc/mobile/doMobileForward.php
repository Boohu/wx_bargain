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
$weid=$_W['uniacid'];//获取当前公众号ID
$level=$_W['account']['level'];//获取公众号类型
$op=$_GPC['op'];//获取操作类型
/*判断用户是否是微信端打开*/
/*if (empty($openid)) {
    echo " 该平台只能在微信端打开";
    exit;
}*/
//判断如果是非认证服务号
//if($level!=4){
//    echo "请先关注公众号，并按公众号的提示帮忙砍价活动！";
//    exit;
//};
$information=$_W['fans'];//获取帮忙砍价用户信息
if($level!=4)$information=mc_fansinfo($openid);
$nickname=$information['nickname'];//获取帮忙砍价用户昵称
$oid = isset($_GPC['oid']) ? trim($_GPC['oid']) : ''; /*获取订单id*/
$order = OrderModel::getOrder($oid); //根据订单ID查询需要帮助用户的订单信息
//判断如果是该订单用户点开分享链接则跳到主页
if($openid==$order[0]['openid']){
    $_GPC['aid']=$order[0]['activity_id'];
    $this->doMobileIndex();
    exit;
}

$activity = ActiveModel::get($order[0]['activity_id']); /*取出当前活动*/
$html=htmlspecialchars_decode($activity[0]["desc_html"]);//将富文本内容转化为html

$timestamp=$_W['timestamp'];//获得当前时间戳
$date=date("Y-m-d");//获得当天日期
$time=date('Y-m-d H:i:s', $timestamp);//将当前时间戳转化为时间格式
$activity_end_time=strtotime($activity[0]['end_time']);//获得本次活动结束时间

$judge=$timestamp>$activity_end_time?1:0;//判断活动是否超时 1=未超时 0=超时
/*活动超时结束*/
if ($judge==1){
    echo "该活动已结束";
    exit;
}
$assist_record=AssistModel::getRecord($openid);//获取是否存在被当前用户砍价记录
$assist_information=AssistModel::getNum($oid); //获取本次订单已被帮忙砍价的信息
$result=AssistModel::getCount($date);//获得今天砍价次数
//判断操作类型如果为help
if ($op=='help'){
        //判断该用户是否帮忙该砍价过,为空则没有帮助过
        if (empty($assist_record)) {
            $count = count($assist_information);//统计本次订单被帮助的次数
            //创建帮忙砍价添加的数据
            $data = array(
                'order_id' => $oid,
                'openid' => $openid,
                'create_time' => $time,
                'nickname' => $nickname

            );
            //判断如果砍价超过三次则执行
            if ($count >= 3) {
                $start = $activity[0]["bargain_section_start"];//获取3次后砍价的起始值
                $end = $activity[0]["bargain_section_end"];//获取3次后砍价的结束值
                $price = mt_rand($start * 10, $end * 10) / 10;//获取3次后砍价的价格随机数
                $data['price'] = $price;//添加3次后砍价的价格
                $new_price = $order[0]['current_price'] - $price;//计算砍价后最新的当前价格
            } else {
                $start = $activity[0]["front_section_start"];//获取3次前砍价的起始值
                $end = $activity[0]["front_section_end"];//获取3次前砍价的结束值
                $price = mt_rand($start * 10, $end * 10) / 10;//获取3次后砍价的价格随机数
                $data['price'] = $price;//添加3次前砍价的价格
                $new_price = $order[0]['current_price'] - $price;//计算砍价后最新的当前价格
            }

            $updata=array('current_price' => $new_price);//将最新价格传给数组

            if (AssistModel::add($data)&&OrderModel::update($updata)) {
                $order = OrderModel::getOrder($oid); //根据订单ID查询帮忙砍价后的最新订单信息
                $current_price=$order[0]['current_price'];//获得砍价后最新的当前价格
                $floor_price=$activity[0]['prize_floor_price'];//取出活动 底价
                //判断如果低于底价则修改订单状态
                if($current_price<=$floor_price){
                    $updata=array('current_price'=>$floor_price);//将该活动底价添加到数组
                    OrderModel::update($updata);//更新订单当前价格价格为底价
                    //判断如果底价为0
                    if($activity[0]['prize_floor_price']==0){
                        $updata=array('order_status' =>2 );//将订单状态2=待核销传给数组
                        OrderModel::update($updata);//更新订单状态
                    }else{
                        $updata=array('order_status' =>1 );//将订单状态1=待付款传给数组
                        OrderModel::update($updata);//更新订单状态
                    }
                }
                message('砍价成功！', '../../app/' . $this->createMobileUrl('forward', array('oid' => $oid), 'success'));
            }
        }
}

include $this->template('forward');