<?php
require_once '../../config/database.php'; //Solicita Arquivo para conexão com banco

$credentials = [
    0 => ['email' => 'deene67@gmail.com', 'senha' => '123456789'], //Usuario Denilson
    1 => ['email' => 'naranonva@hotmail.com', 'senha' => '123456789'] //Usuario Nicolas
];

session_start();


if (!isset($_POST['logar']))
    include './index.php';
else {
    $email = $_POST['email'];
    $senha = $_POST['password'];

    //Prepara a Query para buscar usuario no bgitanco
    $sql = $banco->prepare("SELECT email, senha FROM dbo.Usuario WHERE email = '".$email."' AND senha = '".$senha."' "); 
    $sql->execute();

    if($sql->rowCount() != 0){ //Verifica se teve retorno positivo

        //Puxa os dados e passa para a sessão
        $usuario = $sql->fetch();   //Puxa apenas 1 registro da consulta
        $_SESSION['user'] = $usuario['email']; //Da para passar outros parametros, de acordo com retorno do SELECT

        Header("Location: /HUEHUECINE/view/home/");

    }else{
        
        $msg = "Credenciais inválidas, tente novamente";
        include './index.php';

    }
    

    //Login com array estatico

    /*if (in_array(['email' => $email, 'senha' => $senha], $credentials)) {

        $user = array_filter($credentials,  function ($user) {
            return $user['email'] == $_POST['email'];
        });
        var_dump($user);
        $_SESSION['user'] = $user;

        Header("Location: /HUEHUECINE/HUEHUECINE/view/home/");
    } else {

        $msg = "Credenciais inválidas, tente novamente";
        include './index.php';
    }*/
}
