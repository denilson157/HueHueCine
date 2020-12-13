<?php
session_start();

if (isset($_SESSION['user']))
    Header("Location: /HUEHUECINE/view/register/login.php");
else
    Header("Location: /HUEHUECINE/view/register/logout.php");
