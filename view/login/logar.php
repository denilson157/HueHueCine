<?php
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

    if (in_array(['email' => $email, 'senha' => $senha], $credentials)) {

        $user = array_filter($credentials,  function ($produto) {
            return $produto['email'] == $_POST['email'];
        });
        $_SESSION['user'] = $user;

        Header("Location: /view/home/");
    } else {

        $msg = "Credenciais inválidas, tente novamente";
        include './index.php';
    }
}
