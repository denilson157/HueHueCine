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

    public function updateUser(
        $nome,
        $sobrenome,
        $email,
        $telefone,
        $senha,
        $data
    ) {
        global $db;

        $sql = $db->prepare("UPDATE Usuario 
        set  nome = :nome,  sobrenome = :sobrenome,  email = :email,  dataNascimento = :datan,  telefone = :telefone, senha = :senha
        WHERE email = :mail");


        $sql->bindParam(':nome', $nome);
        $sql->bindParam(':sobrenome', $sobrenome);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':mail', $email);
        $sql->bindParam(':datan', $data);
        $sql->bindParam(':telefone', $telefone);
        $sql->bindParam(':senha', $senha);

        
        if ($sql->execute())
            return true;
        else
            return false;
    }
}
