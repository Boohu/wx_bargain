<?php
class clickModel{
    static function add(){


        global $_W,$_GPC;
        if($_GPC['c']!='entry')
            return;
        $weid = $_W['uniacid'];               //获取当前公众号ID
        $t=time();
        $t= intval(($t/3600)) *3600;
        $t=date("Y-m-d H:i:s", $t);

        $res=pdo_get('wx_bargain_click', array('weid' => $weid, 'time_section' => $t));

        if( !$res){
            pdo_insert('wx_bargain_click',array('weid' => $weid, 'time_section' => $t,'num'=>1));
        }else{
            $table_wx_bargain_click=tablename(wx_bargain_click);
            $id=$res['id'];

            pdo_fetch("update $table_wx_bargain_click set num=num+1
                              where id= $id ");

        }
    }
}