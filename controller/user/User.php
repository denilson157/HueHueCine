<?php
session_start();
require_once(dirname(__FILE__) . "/../../model/User.php");

class UserController
{
    function UpdateUser()
    {

        $nome = $_POST['name'];
        $sobrenome = $_POST['lastName'];
        $email = $_POST['email'];
        $telefone = $_POST['tel'];
        $senha = $_POST['password'];
        $senhaverify = $_POST['verifyPassword'];

        $data = explode('-', $_POST['dateBirth']);
        $datan = $data[0] . '-' . $data[2] . '-' . $data[1];


        if ($senha == $senhaverify) {

            $senha = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $user = $this->getUser($email);

            $userClass = new User();
            $user = $user[0];

            if ($user['email']) {

                if ($userClass->updateUser(
                    $nome,
                    $sobrenome,
                    $email,
                    $telefone,
                    $senha,
                    $datan
                )) {

                    $msg = 'Usuário editado com sucesso.';
                    include dirname(__FILE__) . '/../../view/register/login.php';
                } else {

                    $msg = 'Erro ao editar, tente novamente mais tarde.';
                    include dirname(__FILE__) . '/../../view/register/login.php';
                }
            } else {

                $msg = 'Email não encontrado!';
                include dirname(__FILE__) . '/../../view/register/login.php';
            }
        } else {

            $msg = "As senhas digitadas não são iguais!";
            include dirname(__FILE__) . '/../../view/register/login.php';
        }
    }


    function getUser($email)
    {
        $userClass = new User();
        $user = $userClass->returnUser($email);

        return $user;
    }
}
