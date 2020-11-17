<?php

require_once "/HUEHUECINE/model/User.php";

class Comment
{
    public function insertComment($userEmail, $comment, $movieId)
    {
        global $db;

        $user = new User();

        $userId = $user->returnUser($userEmail);

        $stmt = $db->prepare("INSERT INTO Comentarios 
        (comentario, dataComentario, likes, deslikes, idFilme, idUsuario) values
        (:comm, :dateComm,:nLikes, :nDeslikes, :filmId, :userId)
        ");

        $stmt->bindParam(":comm", $comment);
        $stmt->bindParam(":dateComm", 'GETDATE()');
        $stmt->bindParam(":nLikes", 0);
        $stmt->bindParam(":nDeslikes", 0);
        $stmt->bindParam(":filmId", $movieId);
        $stmt->bindParam(":userId", $userId['id']);


        return $userEmail;
    }
}
