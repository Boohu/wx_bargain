<?php
/**
 * Created by PhpStorm.
 * User: DoubleWei
 * Date: 2016/12/7
 * Time: 21:54
 */
require_once(dirname(__FILE__) . "/../../model/active.php");
global $_GPC, $_W;
$id=$_GPC['id'];
var_dump($id);
if(ActiveModel::del($id)){
    message('操作成功！', '../../web/' .  $this->createWebUrl('manager'));
}else{
    message('操作失败');
}