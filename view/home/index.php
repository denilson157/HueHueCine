<?php
session_start();

if (isset($_SESSION['user']))
    Header("Location: /HUEHUECINE/HUEHUECINE/view/home/login.php");
else
    Header("Location: /HUEHUECINE/HUEHUECINE/view/home/logout.php");
