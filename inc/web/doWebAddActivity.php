<?php
/**
 * Created by PhpStorm.
 * User: DoubleWei
 * Date: 2016/12/7
 * Time: 15:39
 */
require_once(dirname(__FILE__) . "/../../model/active.php");
global $_GPC, $_W;

$weid=$_W['uniacid'];;            //获取当前公众号ID
$id=$_GPC['id'];                //获取id值
$name = $_GPC['name'];          //获取活动名称
if(trim($name)==""){
  message('操作失败,套餐名称不能为空');exit;
}
$start_time = $_GPC['time'];        //获取活动开始和结束时间
$end_time=$_GPC['time'];                //获取活动开始和结束时间
$head_pic = $_GPC['event_head'];        //获取活动头像
if(trim($head_pic)==""){
  message('操作失败,活动头像必须上传');exit;
}
$head_pic_url = $_GPC['link'];   //获取头图点击之后跳转的链接
$desc = $_GPC['desc'];            //获取活动简介
$prize_name = $_GPC['prize_name'];    //获取奖品名称
if(trim($prize_name)==""){
  message('操作失败,奖品名称必须填写');exit;
}
$prize_old_price = $_GPC['prize_old_price']; //获取活动奖品原价
if(trim($prize_old_price)==""){
  message('操作失败,活动奖品原价必须填写');exit;
}
$prize_floor_price = $_GPC['prize_floor_price']; //获取活动底价
if(trim($prize_floor_price)==""){
  message('操作失败,活动奖品底价必须填写');exit;
}
$bargain_max = $_GPC['bargain_max'];              //获取最大砍价次数
if(trim($bargain_max)==""){
  message('操作失败,最大砍价次数必须填写');exit;
}
$prize_num = $_GPC['prize_num'];              //获取活动奖品总数
if(trim($bargain_max)==""){
  message('操作失败,活动奖品总数必须填写');exit;
}
$is_subscription_launch = $_GPC['is_subscription_launch'];  //获取订阅才发起是否开启
$is_subscription_lassist = $_GPC['is_subscription_lassist']; //获取订阅才发起帮助是否开启*/
$bargain_time_astrict = $_GPC['bargain_time_astrict'];   //获取砍价限时
$bargain_section_start = $_GPC['bargain_section_start'];  //获取砍价区间-开始值
$bargain_section_end = $_GPC['bargain_section_end'];       //获取砍价区间-结束值
$front_section_start = $_GPC['front_section_start'];        //获取前三次砍价区间-开始值
$front_section_end = $_GPC['front_section_end'];            //获取前三次砍价区间-结束
$desc_html = $_GPC['content'];           //获取富文本编译器内容
$wx_pic = $_GPC['wx_icon'];               //获取微信分享图标
$wx_title = $_GPC['wx_title'];         //获取微信分享标题
$wx_friend_centent = $_GPC['wx_friend_centent'];      //微信分享好友内容
/*$wx_circle_centent = $_GPC['wx_circle_centent'];      //微信分享朋友圈内容*/
$wx_qr_code = $_GPC['qr_code'];                   //获取微信二维码

$data = array(
    'id'=>$id,
    'weid'=>$weid,
    'name' => $name,
    'start_time' => $start_time['start'],
    'end_time'=>$end_time['end'],
    'head_pic' => $head_pic,
    'head_pic_url' => $head_pic_url,
    'desc' => $desc,
    'prize_name' => $prize_name,
    'prize_old_price' => $prize_old_price,
    'prize_floor_price' => $prize_floor_price,
    'bargain_max' => $bargain_max,
    'prize_num' => $prize_num,
    'is_subscription_launch' => $is_subscription_launch,
    'is_subscription_lassist' => $is_subscription_lassist,
    'bargain_time_astrict' => $bargain_time_astrict,
    'bargain_section_start' => $bargain_section_start,
    'bargain_section_end' => $bargain_section_end,
    'front_section_start' => $front_section_start,
    'front_section_end' => $front_section_end,
    'desc_html' => $desc_html,
    'wx_pic' => $wx_pic,
    'wx_title' => $wx_title,
    'wx_friend_centent' => $wx_friend_centent,
/*    'wx_circle_centent' => $wx_circle_centent,*/
    'wx_qr_code' => $wx_qr_code
);
if(ActiveModel::save($data)){
    message('操作成功！', '../../web/' .  $this->createWebUrl('manager'));
}else{
    message('操作失败');
}

