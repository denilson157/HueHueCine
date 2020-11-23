<?php
require_once '../../config/database.php'; //Solicita Arquivo para conexão com banco

session_start();


if (!isset($_POST['logar']))
    include './index.php';
else {
    $email = $_POST['email'];
    $senha = $_POST['password'];

    $sql = $banco->prepare("SELECT email, senha FROM dbo.Usuario WHERE email = '$email'"); 
    $sql->execute();

    if($sql->rowCount() != 0){ //Verifica se existe o email cadastrado

        $registro = $sql->fetch(PDO::FETCH_ASSOC); //Puxa os dados desse email
        $senhaH = $registro['senha'];

        if( password_verify($senha, $senhaH) ){ //Verifica a senha

        $_SESSION['user'] = $registro['email']; 
        Header("Location: /HUEHUECINE/view/home/");

        }else{
            $msg = "Credenciais inválidas, tente novamente";
            include './index.php';
        }
        

    }else{

        $msg = "Credenciais inválidas, tente novamente";
        include './index.php';

    }
}
