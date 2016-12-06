<?php
/*活动模型*/
class ActiveModel{

    /**
     * 删除活动
     * @param $id 要删除的活动id
     */
    static function del($id){

    }

    /***
     * 创建或者修改活动
     * @param $data 要保存的信息，包含id字段为修改操作，不包含id字段为添加操作
     */
    static function save($data){
        if(isset($data['id'])){
            /*修改操作*/
        }else{
            /*添加操作*/
        }
    }

    /***
     * 获得单个活动信息
     * @param $id 要获取活动的id
     */
    static function get($id){

    }

    /***
     * 带分页的活动搜索页面
     * @param $data 查找条件
     * @param $page 分页信息
     */
    static function pageList($data,$page){

    }
}