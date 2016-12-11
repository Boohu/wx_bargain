<?php

/**
 * Created by PhpStorm.
 * User: DoubleWei
 * Date: 2016/12/11
 * Time: 15:04
 */
class PayModel
{
    /**
     * 添加付款记录
     * @param $data 要添加的记录的信息
     */
    static function add($data)
    {
        global  $_W;
        $timestamp=$_W['timestamp'];//获得当前时间戳
        $time=date('Y-m-d H:i:s', $timestamp);//将当前时间戳转化为时间格式
        $data['create_time']=$time;//为新增付款记录时间
        $data['update_time']=$time;//为付款记录更新时间
        return $result = pdo_insert('wx_bargain_pay', $data);
    }
}