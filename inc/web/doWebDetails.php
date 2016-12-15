<?php
require_once(dirname(__FILE__) . "/../../model/active.php");
require_once(dirname(__FILE__) . "/../../model/report.php");

global $_GPC, $_W;
$weid=$_W['uniacid'];    //获取公众号ID

$datas= ActiveModel::get(null);

foreach($datas as $key=>$val){
    $id=$val['id'];
    $datas[$key]['parNum']=repoModel::getParNum($id);
    $datas[$key]['num']=repoModel::getNum($id);


}

include $this->template("details");