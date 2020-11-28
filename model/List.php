<?php

header("Content-Type: application/json");

require_once(dirname(__FILE__) . "./User.php");
require_once(dirname(__FILE__) . "./Database.php");

class Lista
{

    public function getListByUser($userEmail, $typeMTV)
    {
        global $db;
        $tableConsulta = "ListaFilme";
        $user = new User();

        $userId = $user->returnUser($userEmail);

        if ($typeMTV == 'tv')
            $tableConsulta = "ListaSerie";


        $stmt = $db->prepare("SELECT idFilme FROM " . $tableConsulta . " WHERE idUsuario = :userId");

        $userId = (int)$userId[0]['id'];

        $stmt->bindParam(':userId', $userId);

        $stmt->execute();

        if ($stmt->rowCount() != 0) {
            return $stmt->fetch();
        }
        return null;
    }

    public function insertList($userEmail, $state, $movieId, $typeMTV)
    {

        global $db;

        $user = new User();

        $userId = $user->returnUser($userEmail);

        if ($typeMTV === 'tv') {
            $stmt = $db->prepare('INSERT INTO ListaSerie (idFilme, idUsuario, idStatus) VALUES (:filmId, :userId, :stateId)');
        } else {
            $stmt = $db->prepare('INSERT INTO ListaFilme (idFilme, idUsuario, idStatus) VALUES (:filmId, :userId, :stateId)');
        }

        $movieId = $movieId;
        $userId = (int)$userId[0]['id'];

        $stmt->bindParam(':stateId', $state);
        $stmt->bindParam(':filmId', $movieId);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();


        return $stmt;
    }

    public function getList($userEmail, $movieId, $typeMTV)
    {
        global $db;

        $user = new User();
        $userId = $user->returnUser($userEmail);
        $userId = (int)$userId[0]['id']; // Pega id do usuario

        $movieId = $movieId;

        if ($typeMTV == 'tv') { //Verifica se é tipo TV ou Filme e faz a consulta de acordo
            $stmt = $db->prepare("SELECT id, idStatus FROM ListaSerie WHERE idUsuario = :userId and idFilme = :filmId ");
        } else {
            $stmt = $db->prepare("SELECT id, idStatus FROM ListaFilme WHERE idUsuario = :userID and idFilme = :filmId ");
        }

        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':filmId', $movieId);


        $stmt->execute();

        //  $teste = array("a" => $userId, "b" => $typeMTV, "c" => $movieId);
        //  return $teste;

        if ($stmt->rowCount() != 0) {
            return $stmt->fetch();
        }
        return null;
    }

    public function deleteList($userEmail, $movieId, $typeMTV)
    {
        global $db;

        $user = new User();
        $userId = $user->returnUser($userEmail);
        $userId = (int)$userId[0]['id']; // Pega id do usuario

        $movieId = $movieId;

        if ($typeMTV == 'tv') { //Verifica se é tipo TV ou Filme e faz a consulta de acordo
            $stmt = $db->prepare("DELETE FROM ListaSerie where idUsuario = :userId and idFilme = :filmId ");
        } else {
            $stmt = $db->prepare("DELETE FROM ListaFilme where idUsuario = :userId and idFilme = :filmId ");
        }

        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':filmId', $movieId);

        $stmt->execute();

        if ($stmt->rowCount() != 0)
            return $stmt->fetchAll(PDO::FETCH_ASSOC);


        return null;
    }

    public function updateList($userEmail, $state, $movieId, $typeMTV)
    {
        global $db;

        $user = new User();
        $userId = $user->returnUser($userEmail);
        $userId = (int)$userId[0]['id']; // Pega id do usuario

        $movieId = $movieId;

        if ($typeMTV == 'tv') { //Verifica se é tipo TV ou Filme e faz a consulta de acordo
            $stmt = $db->prepare("UPDATE ListaSerie SET idStatus = :stateId WHERE idUsuario = :userId and idFilme = :filmId");
        } else {
            $stmt = $db->prepare("UPDATE ListaFilme SET idStatus = :stateId WHERE idUsuario = :userId and idFilme = :filmId");
        }

        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':stateId', $state);
        $stmt->bindParam(':filmId', $movieId);

        $stmt->execute();

        if ($stmt->rowCount() != 0)
            return $stmt->fetchAll(PDO::FETCH_ASSOC);


        return null;
    }
}
