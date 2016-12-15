<?php
require_once(dirname(__FILE__) . "/../../model/click.php");

$clicks=clickModel::getList();
$ts=array();
$click=array();
foreach($clicks as $key=>$val){
    $ts[]=$val['time_section'];
    $click[]=$val['num'];
}

$ts=json_encode($ts);
$click=json_encode($click);


include $this->template('click');