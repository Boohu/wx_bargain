<?php
/**
 * 砍价模块处理程序
 *
 * @author DoubleWei
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');

class Wx_bargainModuleProcessor extends WeModuleProcessor
{
    public function respond()
    {
        require_once(dirname(__FILE__) . "/model/active.php");
        require_once(dirname(__FILE__) . "/model/order.php");
        global $_W;
        $content = $this->message['content'];//获取回复消息
        //这里定义此模块进行消息处理时的具体过程, 请查看微擎文档来编写你的代码
        $op = preg_replace('/[\d]/u', '', $content);//获取要执行的操作
        $id = preg_replace('/[^\d]/', '', $content);//获取用户输入的编号
        //判断回复内容
        if ($op == "cj") {
            $activity = ActiveModel::get($id);//获取活动信息
            if (empty($activity)) {
                $reply = "活动编号错误";
                return $this->respText($reply);
            } else {
                return $this->respNews(array(
                    'Title' => $activity[0]['name'],
                    'Description' => $activity[0]['desc'],
                    'PicUrl' => tomedia($activity[0]['head_pic']),
                    'Url' => $this->createMobileUrl('index', array('aid' => $id)),
                ));
            }
        } elseif ($op == "kj") {
            $order = OrderModel::getOrder($id);
            if (empty($order)) {
                $reply = "订单编号错误";
                return $this->respText($reply);

            } else {
                return $this->respNews(array(
                    'Title' => "订单编号" . $order[0]['id'],
                    'Description' => 快点开链接帮你的小伙伴砍价吧,
                    'PicUrl' => tomedia('/preview.jpg'),
                    'Url' => $this->createMobileUrl('forward', array('oid' => $id)),
                ));
            }
        }
    }
}