<?php

header("Content-Type: application/json");

require_once(dirname(__FILE__) . "./User.php");
require_once(dirname(__FILE__) . "./Database.php");

class Lista{
    public function insertList($userEmail, $state, $movieId, $typeMTV){

        global $db;

        $user = new User();

        $userId = $user->returnUser($userEmail);

        if($typeMTV === 'tv'){
            $stmt = $db->prepare('INSERT INTO ListaSerie (idFilme, idUsuario, idStatus) VALUES (:filmId, :userId, :stateId)');
        }else{
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
}