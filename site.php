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
    public function doWebAdd() {
        //引用后台活动管理添加数据控制器控制器
        require_once(dirname(__FILE__)."/inc/web/doWebAdd.php");
    }



    public function doWebDomain(){
    //多域名管理
        require_once(dirname(__FILE__)."/inc/web/doWebDomain.php");
    }

    public function doWebAddDomain(){
	//添加域名
        require_once(dirname(__FILE__)."/inc/web/doWebAddDomain.php");
    }
    
    public function doWebDelDomain(){
	//删除域名
	require_once(dirname(__FILE__)."/inc/web/doWebDelDomain.php");
    }


    public function doMobileIndex(){
    //活动主页
        require_once(dirname(__FILE__)."/inc/mobile/doMobileIndex.php");

    }


    /*移动端测试页面*/
    public function doMobileTest(){
        require_once  ( dirname(__FILE__)."/test/doMobileTest.php" );
    }

    /*web端测试页面*/
    public function doWebTest(){
        require_once  ( dirname(__FILE__)."/test/doWebTest.php" );
    }

}
