
<?php
require_once(dirname(__FILE__)."/../../model/domain.php");
global $_GPC,$_W;

$id=isset($_GPC['domain_id'])?intval($_GPC['domain_id']):"";
if(Domain::del($id)){
    message('操作成功');
} else{
    message('操作失败');
}
