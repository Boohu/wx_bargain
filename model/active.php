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
        return pdo_delete('wx_bargain_activity', array('id' => $id, 'weid' => $weid));
    }
    /**
     * 禁用活动活动
     * @param $state 要删除的活动id
     */
    static function disable($id)
    {
        global $_W;
        $weid = $_W['uniacid'];               //获取当前公众号ID
        $result= pdo_get('wx_bargain_activity', array('weid' => $weid,'id'=>$id),'active_state');
        var_dump($result['active_state']);
        if ($result['active_state']==1){
            $result=pdo_update('wx_bargain_activity',array('active_state'=>0),array('id' => $id, 'weid' => $weid));
        }else{
            $result=pdo_update('wx_bargain_activity', array('active_state'=>1),array('id' => $id, 'weid' => $weid));
        }
        return $result;
    }

    /***
     * 创建或者修改活动
     * @param $data 要保存的信息，包含id字段为修改操作，不包含id字段为添加操作
     */
    static function save($data)
    {
        global $_GPC, $_W;
        $weid = $_W['uniacid'];               //获取当前公众号ID
        $timestamp=$_W['timestamp'];//获得当前时间戳
        $time=date('Y-m-d H:i:s', $timestamp);//将当前时间戳转化为时间格式
        if (!empty($data['id'])) {
            /*修改操作*/

            $data['update_time']=$time;
            $result = pdo_update('wx_bargain_activity', $data,array('id'=>$data['id'],'weid'=>$weid));
        } else {
            /*添加操作*/
            $data['create_time']=$time;
            $data['update_time']=$time;
            $result = pdo_insert('wx_bargain_activity', $data);
        }
        return $result;
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
