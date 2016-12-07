<?php
/*活动模型*/
class ActiveModel
{

    /**
     * 删除活动
     * @param $id 要删除的活动id
     */
    static function del($id)
    {
        global $_W;
        $weid = $_W['uniacid'];               //获取当前公众号ID
        return pdo_delete('wx_bargain_active', array('id' => $id, 'weid' => $weid));
    }

    /***
     * 创建或者修改活动
     * @param $data 要保存的信息，包含id字段为修改操作，不包含id字段为添加操作
     */
    static function save($data)
    {
        global $_GPC, $_W;
        $weid = $_W['uniacid'];               //获取当前公众号ID
        if (!empty($data['id'])) {
            /*修改操作*/
            return b;
        } else {
            /*添加操作*/
            $result = pdo_insert('wx_bargain_activity', $data);
            return $result;
            global $_W;
            $weid = $_W['uniacid'];               //获取当前公众号ID
        }
    }

        /***
         * 获得单个活动信息
         * @param $id 要获取活动的id
         */
        static function get($id)
        {
            global $_GPC, $_W;
            $weid=$_W['uniacid'];            //获取当前公众号ID
            if(empty($id)) {
                $datas = pdo_getall('wx_bargain_activity', array('weid' => $weid));
            }else{
                $datas = pdo_getall('wx_bargain_activity', array('weid' => $weid, 'id' => $id));
            }
            return $datas;

        }

        /***
         * 带分页的活动搜索页面
         * @param $data 查找条件
         * @param $page 分页信息
         */
        static function pageList($data, $page)
        {

        }

}
