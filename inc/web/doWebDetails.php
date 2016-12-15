<?php
require_once(dirname(__FILE__) . "/../../model/active.php");
global $_GPC, $_W;
$weid=$_W['uniacid'];    //获取公众号ID

$datas= ActiveModel::get(null);

include $this->template("details");