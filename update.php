<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/5 0005
 * Time: 下午 5:00
 */
$ret= system("git fetch --all");
$ret.="\n".system("git reset --hard origin/master");
echo "<pre>".$ret."</pre>";
