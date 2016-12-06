<?php
/**
 * 砍价模块微站定义
 *
 * @author DoubleWei
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');

class Wx_bargainModuleSite extends WeModuleSite {

    public function __construct(){
        error_reporting(E_ALL ^ E_NOTICE );
    }

	public function doMobileBargain() {
		//这个操作被定义用来呈现 功能封面
	}
	public function doWebDetails() {
		//这个操作被定义用来呈现 管理中心导航菜单
	}
	public function doWebOrder() {
    //这个操作被定义用来呈现 管理中心导航菜单
        require_once(dirname(__FILE__)."/inc/web/doWebOrder.php");
    }
    public function doWebManager() {
        //引用后台活动管理控制器
        require_once(dirname(__FILE__)."/inc/web/doWebManager.php");
    }



    /*移动端测试页面*/
    public function doMobileTest(){
        require_once  ( dirname(__FILE__)."/test/doMobileTest.php" );
    }


    /*手机端测试页面*/
    public function doWebTest(){
        require_once  ( dirname(__FILE__)."/test/doWebTest.php" );
    }

}