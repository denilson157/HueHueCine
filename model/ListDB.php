<?php

require_once(dirname(__FILE__) . "./User.php");
require_once(dirname(__FILE__) . "./Database.php");

class ListaDB
{

    public function getListByUser($userEmail, $typeMTV)
    {
        global $db;
        $tableConsulta = "ListaFilme";
        $user = new User();

        $userId = $user->returnUser($userEmail);

        if ($typeMTV == 'tv')
            $tableConsulta = "ListaSerie";


        $stmt = $db->prepare("SELECT idFilme, idStatus FROM " . $tableConsulta . " WHERE idUsuario = :userId");

        $userId = (int)$userId[0]['id'];

        $stmt->bindParam(':userId', $userId);



        $stmt->execute();

        if ($stmt->rowCount() != 0)
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        return null;
    }
}
