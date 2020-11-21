<?php

header("Content-Type: application/json");

require_once(dirname(__FILE__) . "./User.php");
require_once(dirname(__FILE__) . "./Database.php");

class Comment
{
    public function insertComment($userEmail, $comment, $movieId)
    {
        global $db;


        $user = new User();

        $userId = $user->returnUser($userEmail);

        $stmt = $db->prepare('INSERT INTO Comentarios (comentario, dataComentario, idFilme, idUsuario) VALUES (:comm, GETDATE(), :filmId, :userId)');


        $movieId = $movieId;
        $userId = (int)$userId[0]['id'];

        $stmt->bindParam(':comm', $comment);
        $stmt->bindParam(':filmId', $movieId);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();


        return $stmt;
    }

    public function getComments($movieId)
    {
        global $db;

        $stmt = $db->prepare("SELECT U.nome, U.email, U.sobrenome, C.id, C.comentario, C.dataComentario, C.likes, C.deslikes FROM Comentarios as C
        INNER JOIN Usuario as U on c.idUsuario = U.id
        WHERE C.idFilme = $movieId");
        $stmt->execute();

        if ($stmt->rowCount() != 0)
            return $stmt->fetchAll(PDO::FETCH_ASSOC);


        return null;
    }

    public function deleteComment($commentId)
    {
        global $db;

        $stmt = $db->prepare("DELETE FROM Comentarios where id = $commentId");
        $stmt->execute();

        if ($stmt->rowCount() != 0)
            return $stmt->fetchAll(PDO::FETCH_ASSOC);


        return null;
    }
}
