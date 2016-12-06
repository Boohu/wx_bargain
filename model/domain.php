<?php
class Domain{
    /**添加域名
     * @param $url 域名
     */
    static function add($url){
        global $_W;
        $weid=$_W['uniacid'];               //获取当前公众号ID
        return pdo_insert('wx_bargain_domain', array('domain'=>$url,'weid'=>$weid));
    }
    

    /**
     * 删除域名
     * @param $id 域名id
     */
    static function del($id){
        global $_W;
        $weid=$_W['uniacid'];               //获取当前公众号ID
        return  pdo_delete('wx_bargain_domain',array('id'=>$id,'weid'=>$weid));
    }

    /**
     * 获得域名列表
     */
    static function all(){
        global $_W;
        $weid=$_W['uniacid'];               //获取当前公众号ID
        return pdo_getall('wx_bargain_domain', array('weid' => $weid));
    }
}
