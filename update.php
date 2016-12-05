<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/5 0005
 * Time: 下午 5:00
 */

ignore_user_abort();           // 即使Client断开(如关掉浏览器)，PHP脚本也可以继续执行.
set_time_limit(0);             // 执行时间为无限制，php默认的执行时间是30秒，通过set_time_limit(0)可以让程序无

$ret= system("git fetch --all");
$ret.="\n".system("git reset --hard origin/master");
echo "<pre>".$ret."</pre>";
