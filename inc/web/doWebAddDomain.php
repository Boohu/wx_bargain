<?php
require_once(dirname(__FILE__)."/../../model/domain.php");
global $_GPC,$_W;

$url=isset($_GPC['url'])?trim($_GPC['url']):"";
if($url==""){
    message('url不能为空');
    exit;
}
if(Domain::add($url)){
    message('操作成功');
} else{
    message('操作失败');
}