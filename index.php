<?php
var_dump('a');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if ($_SESSION['user'])
    Header("Location: /view/home/login.php");
else
    Header("Location: /view/login/");
