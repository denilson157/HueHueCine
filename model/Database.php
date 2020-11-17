<?php

require_once '/HUEHUECINE/config/config.php';

try{

    $db = new PDO( DSN, DB_USER, DB_PASS );

}catch( PDOException $Erro ){

    echo"Falha ao conectar no banco: ". $Erro->getMessage();

    exit();
}
