
<?php
require_once(dirname(__FILE__)."/../../model/domain.php");
global $_GPC,$_W;

$id=isset($_GPC['domain_id'])?intval($_GPC['domain_id']):"";

var_dump($id);
die();
if($url==""){
    message('url不能为空');
    exit;
}
if(Domain::add($url)){
    message('操作成功');
} else{
    message('操作失败');
}
