<?php

require_once(dirname(__FILE__) . "/../../controller/user/User.php");

$userController = new UserController();

$userController->UpdateUser();
