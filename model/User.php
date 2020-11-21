<?php

require_once(dirname(__FILE__) . "./Database.php");

class User
{
    public function returnUser($userEmail)
    {
        global $db;

        $sql = "SELECT * FROM Usuario WHERE email = '$userEmail'";

        $stmt = $db->prepare($sql);

        $stmt->execute();

        if ($stmt->rowCount() !=  0)
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        else
            return $sql;
    }
}
