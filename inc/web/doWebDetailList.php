<?php
require_once(dirname(__FILE__)."/../../model/assist.php");

global $_GPC,$_W;

$oid= trim($_GPC['oid']);
if($oid=="") exit;
$oid=floatval($oid);
$p= isset($_GPC['p'])?intval($_GPC['p']):1;
if(empty($p) || intval($p)<1) $p=1;
$assistInfo= AssistModel::getAssistList($oid);
$assist=$assistInfo['list'];
$count=$assistInfo['count'];
$pages=intval((intval($count-1))/intval(10))+1;
include $this->template('detaillist');                              //打开后台活动管理页面
