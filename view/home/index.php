<?php
session_start();

if (isset($_SESSION['user']))
    Header("Location: /view/home/login.php");
else
    Header("Location: /view/home/logout.php");
