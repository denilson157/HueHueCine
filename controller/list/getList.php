<?php

header("Content-Type: application/json");

require_once(dirname(__FILE__) . "./ListController.php");

$list = new ListController();

echo json_encode($list->getList());