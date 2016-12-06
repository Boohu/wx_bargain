<?php
require_once(dirname(__FILE__)."/../../model/domain.php");
$list = Domain::all();
include $this->template("domain");