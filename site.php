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
    public function doWebAddActivity() {
        //引用后台活动管理添加更新数据控制器控制器
        require_once(dirname(__FILE__) . "/inc/web/doWebAddActivity.php");
    }

    public function doWebDelActivity() {
        //引用后台活动管理删除数据控制器控制器
        require_once(dirname(__FILE__)."/inc/web/doWebDelActivity.php");
    }
    public function doWebDisActivity() {
        //引用后台活动管理禁用恢复活动的控制器控制器
        require_once(dirname(__FILE__)."/inc/web/doWebDisActivity.php");
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


    /*参与列表*/
    public function doWebJoinList(){
        require_once(dirname(__FILE__)."/inc/web/doWebJoinList.php");

    }

    /*详细列表*/
    public function doWebDetailList(){
        require_once(dirname(__FILE__)."/inc/web/doWebDetailList.php");
    }


    public function doMobileIndex(){
    //活动主页
        require_once(dirname(__FILE__)."/inc/mobile/doMobileIndex.php");

    }
    public function doMobileForward(){
        //个人活动主页
        require_once(dirname(__FILE__) . "/inc/mobile/doMobileForward.php");

    }
    /*web端付款放回结果*/
    public function payResult($params){
        require_once  (dirname(__FILE__)."/inc/mobile/doMobilePayResult.php" );
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
