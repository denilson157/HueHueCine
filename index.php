<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if ($_SESSION['user'])
    Header("Location: /HUEHUECINE/view/home/login.php");
else
    Header("Location: /HUEHUECINE/view/login/");
