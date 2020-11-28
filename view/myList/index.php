<?php
session_start();

if (isset($_SESSION['user']))
    Header("Location: /HUEHUECINE/view/myList/login.php");
else
    Header("Location: /HUEHUECINE/view/home/logout.php");
