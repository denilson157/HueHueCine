<?php
require_once 'config.php';

try{

    $banco = new PDO( DSN, DB_USER, DB_PASS );

}catch( PDOException $Erro ){

    echo"Falha ao conectar no banco: ". $Erro->getMessage();

    exit();
}