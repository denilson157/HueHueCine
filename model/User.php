<?php

require_once "/HUEHUECINE/model/Database.php";

class User
{
    public function returnUser($userEmail)
    {
        global $db;

        $sql = $db->query("SELECT * from usuario where email = $userEmail");

        $reg = $sql->fetchAll();

        return $reg;
    }
}
