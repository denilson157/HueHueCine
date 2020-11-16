<?php
require_once 'database.php';

//Teste de Conexão com banco
$sql = "SELECT id, nome, email FROM dbo.Usuario";

echo"<table border='1'>";
echo"<tr><td>id</td><td>Nome</td><td>E-mail</td></tr>";
foreach ($banco->query($sql) as $row) {
  
    echo "<tr> <td>{$row['id']}</td> <td>{$row['nome']}</td> <td>{$row['email']}</td> </tr>";
}

echo"</table>";

?>