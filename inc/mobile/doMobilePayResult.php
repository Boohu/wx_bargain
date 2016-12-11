<?php
/**
 * Created by PhpStorm.
 * User: DoubleWei
 * Date: 2016/12/11
 * Time: 13:31
 */
global $_W,$_GPC;
var_dump($result);
//判断输入金额与应付金额是否相同
//if($params['result'] == 'success' && $params['from'] == 'notify'){
//    if($params['fee']==$data['price']){
//        exit('用户支付的金额与订单金额不符合');
//    }
//
//}

//调微擎支付页面，并跟新未支付订单为已支付
//if ($params['from'] == 'return') {
//    if ($params['result'] == 'success') {
//        $data=array('type'=>1);
//        $condition = array('weid'=>$weid,'openid' => $openid);
//        $result = pdo_update('wx_bookcar_order',$data, $condition);
//        $user_data = array(
//            'open_id' => $openid,
//            'weid' => $weid,
//            'create_time'=>$time,
//        );
//        $result = pdo_insert('wx_bookcar_drivers', $user_data);
//
//        message('支付成功！', '../../app/' . $this->createMobileUrl('index'), 'success');
//    } else {
//        message('支付失败！', '../../app/' .  $this->createMobileUrl('index'), 'error');
//    }
//}