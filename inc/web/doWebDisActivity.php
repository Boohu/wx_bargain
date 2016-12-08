<?php
/**
 * Created by PhpStorm.
 * User: DoubleWei
 * Date: 2016/12/8
 * Time: 9:51
 */
require_once(dirname(__FILE__) . "/../../model/active.php");
global $_GPC, $_W;
$id=$_GPC['id'];
if(ActiveModel::disable($id)){
    message('操作成功！', '../../web/' .  $this->createWebUrl('manager'));
}else{
    message('操作失败');
}