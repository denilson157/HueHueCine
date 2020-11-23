<?php
/*
O registro precisa fazer vericações com data digitadas ainda.
O reset do formulario precisa de atenção para casos como as senhas serem diferentes.

A questão sobre mandar o usuario logar ao cadastrar deve ser discutida(Questão de controle de sessão).
*/

require_once '../../config/database.php'; //Solicita Arquivo para conexão com banco


//Pega valores do formulario
$nome = $_POST['name'];
$sobrenome = $_POST['lastName'];
$email = $_POST['email']; 
$telefone = $_POST['tel'];
$senha = $_POST['password'];
$senhaverify = $_POST['verifyPassword'];

$data = explode('-' ,$_POST['dateBirth']);
$datan = $data[0] . '-' . $data[2] . '-' . $data[1]; // 0 => Ano, 2=> Dia, 1=> Més, ----- Está invertido dia e mes pois é a forma como o banco deve receber

//Verifica se as senhas são iguais
if($senha == $senhaverify){
//Encripta a Senha
$senha = password_hash($_POST['password'], PASSWORD_DEFAULT); //encriptação a Senha

//Prepara o sql para vericação de cadastro
$sqlverif = $banco->prepare("SELECT email FROM dbo.Usuario WHERE email = '".$email."' "); 
$sqlverif->execute();

    //Verifica se o email não esta cadastrado
    if($sqlverif->rowCount() == 0){ //Caso não exista cadastro com email digitado

        //Prepara o cadastro
        $sql = $banco->prepare('INSERT INTO dbo.Usuario (nome, sobrenome, email, dataNascimento, telefone, senha) 
                                                VALUES ( :nome, :sobrenome, :email, :datan, :telefone, :senha)');

        //Binda os parametros do INSERT
        $sql->bindParam(':nome', $nome);
        $sql->bindParam(':sobrenome', $sobrenome);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':datan', $datan);
        $sql->bindParam(':telefone', $telefone);
        $sql->bindParam(':senha', $senha);

        //Verifica a execução do cadastro
        if( $sql->execute() ){ //Caso positivo

            $msg = 'Email cadastrado com sucesso.';
            include '../login/index.php';

        }else{//Falha na execução do cadastro ---------- Arrumar mensagem de erro depois

            $msg = 'Erro ao cadastrar, tente novamente mais tarde.';
            $arr = $sql->errorInfo();
            print_r($arr);
            include './index.php';  

        }



    }else{//Caso email ja tenha sido cadastrado
        
        $msg = 'Email já cadastrado!';
        include './index.php';

    }

}else{ //Caso as senhas sejam diferentes ----------------- Gostaria de não resetar o formulario aqui.

    $msg = "As senhas digitadas não são iguais!";
    include './index.php';

}
